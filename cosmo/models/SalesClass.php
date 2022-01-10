<?php
class SalesClass extends CI_Model
{
    function Orderstatus_Validation()
    {
        $this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
        $this->form_validation->set_rules('User_Id', 'User_Id', 'required');
        $this->form_validation->set_rules('Order_Id', 'Order_Id', 'required');
        $this->form_validation->set_rules('Order_Status_Id', 'Order_Status_Id', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msgU', "Please Fill all Required Details");
            echo "<script> history.go(-1);</script>";
        } else {
            return true;
        }
    }
    function Orderstatus_Save()
    {
        $qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_TransOrderStatus '" . $_POST['Order_Id'] . "','". $_POST['Order_Status_Id'] . "','" . $_POST['User_Id'] . "'	";
        $query = $this->db->query($qry);
        if ($query) {
            $this->session->set_flashdata('msgS', 'Success!!!');
        } else {
            $err = $this->db->error();
            $err = $err['message'];
            $this->session->set_flashdata('msgU', "Same Data Already Exist");
        }
        echo "<script> history.go(-1);</script>";
    }

    // Invoice  Start
	 function InvoiceStatus_Validation()
    {
        $this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
        $this->form_validation->set_rules('User_Id', 'User_Id', 'required');
        $this->form_validation->set_rules('Invoice_Id', 'Invoice_Id', 'required');
        $this->form_validation->set_rules('Invoice_Status_Id', 'Invoice_Status_Id', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msgU', "Please Fill all Required Details");
            echo "<script> history.go(-1);</script>";
        } else {
            return true;
        }
    }
	    function Invoicestatus_Save()
    {
        $qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_TransinvoiceStatus '" . $_POST['Invoice_Id'] . "','". $_POST['Invoice_Status_Id'] . "','" . $_POST['User_Id'] . "'	";
        $query = $this->db->query($qry);
        if ($query) {
            $this->session->set_flashdata('msgS', 'Success!!!');
        } else {
            $err = $this->db->error();
            $err = $err['message'];
            $this->session->set_flashdata('msgU', "Same Data Already Exist");
        }
        echo "<script> history.go(-1);</script>";
    }
    function Invoice_Validation()
    {
        $this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
        $this->form_validation->set_rules('User_Id', 'User_Id', 'required');
        $this->form_validation->set_rules('Order_Id', 'Order_Id', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msgU', "Please Fill all Required Details");
            echo "<script> history.go(-1);</script>";
        } else {
            return true;
        }
    }
    function Invoice_Save()
    {
        $qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_TransInvoice '" . $_POST['Order_Id'] . "','" . $_POST['User_Id'] . "'	";
        $query = $this->db->query($qry);
        if ($query) {
            $this->session->set_flashdata('msgS', 'Success!!!');
            $query = $query->result();
            foreach ($query as $Row) {              
                $this->InvoiceVoucher_Save($Row->LastID);
            }
           
        } else {
            $err = $this->db->error();
            $err = $err['message'];
            $this->session->set_flashdata('msgU', "Same Data Already Exist");
        }
        echo "<script> history.go(-1);</script>";
    }

    function InvoiceVoucher_Save($InvoiceID)
	{
		$qry =	'SELECT ti.Invoice_Id,ti.Invoice_date,
        --minus
        ti.Invoice_total AS invoiceamount,vol.OfficeLedger_id AS Dealerledger_id,
        --add 
        ti.Invoice_subtotal AS salesamount,
        (SELECT DISTINCT vol.OfficeLedger_id FROM cosmo.dbo.Mas_ledger ml 
         INNER JOIN '.$_SESSION['currentdatabasename'].'.dbo.vw_OfficelegerableList vol ON (vol.LedgerType_Id=14 AND vol.Against_Id= 140)) AS Salesledger_id,
        --add
        ti.Invoice_taxtotal AS taxamount, 
        (SELECT DISTINCT vol.OfficeLedger_id From '.$_SESSION['currentdatabasename'].'.dbo.Trans_Invoiceproduct tip 
         INNER JOIN '.$_SESSION['currentdatabasename'].'.dbo.vw_OfficelegerableList vol ON (vol.LedgerType_Id=15 AND vol.Against_Id= tip.Tax_id)
         WHERE tip.Invoice_id=ti.Invoice_Id) AS taxofficeledgerid,
         --minus
        ti.Invoice_Discounttotal AS discountamount, 
        (SELECT DISTINCT vol.OfficeLedger_id FROM cosmo.dbo.Mas_ledger ml 
         INNER JOIN '.$_SESSION['currentdatabasename'].'.dbo.vw_OfficelegerableList vol ON (vol.LedgerType_Id=14 AND vol.Against_Id= 44)) AS discountofficeleder_id        
        From '.$_SESSION['currentdatabasename'].'.dbo.Trans_Invoice ti
            INNER JOIN '.$_SESSION['currentdatabasename'].'.dbo.Mas_Dealer md ON md.Dealer_Id = ti.Dealer_Id
            INNER JOIN '.$_SESSION['currentdatabasename'].'.dbo.vw_OfficelegerableList vol ON (vol.Against_Id = ti.Dealer_Id AND vol.LedgerType_Id=2)
            WHERE ti.Invoice_Id =    ' . $InvoiceID . '';
		$query = $this->db->query($qry);
		$res = $query->result();	
	
		foreach ($res as $row) {
			$_POST['Voucher_date'] = $row->Invoice_date;
			$_POST['AllTransaction_type_Id'] = '3';
			$_POST['Voucher_status_id'] = '1';
			$_POST['Credit'] = 		array('0',		          $row->salesamount,    $row->taxamount,        '0',				);
			$_POST['Debit'] = 		array($row->invoiceamount,	'0'		   		    , '0'          ,         $row->discountamount);
			$_POST['Against_Id'] = array($row->Dealerledger_id,$row->Salesledger_id,$row->taxofficeledgerid,$row->discountofficeleder_id); 
			$_POST['TransactionReference'] = array('INVOICE AMOUNT','INVOICE SALES','INVOICE TAX'				,'INVOICE DISCOUNT');
			$_POST['creditotal'] = $row->invoiceamount;
            $_POST['debittotal'] = $row->invoiceamount;
            $_POST['Abut']='SAVE';
			$this->AccountsClass->VoucherTransaction_Save($row->Invoice_Id);
		}

	}
    //  Invoice  end
}
