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

	function orders_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('db', 'db', 'required');
		$this->form_validation->set_rules('orders_dealer_id', 'orders_dealer_id', 'required');
		$this->form_validation->set_rules('orders_user_id', 'orders_user_id', 'required');
		$this->form_validation->set_rules('orders_priority_id', 'orders_priority_id', 'required');
		$this->form_validation->set_rules('orders__subtotal', 'orders__subtotal', 'required');
		$this->form_validation->set_rules('orders_discounttotal', 'orders_discounttotal', 'required');
		$this->form_validation->set_rules('orders_taxtotal', 'orders_taxtotal', 'required');
		$this->form_validation->set_rules('orders_roundofftotal', 'orders_roundofftotal', 'required');
		$this->form_validation->set_rules('orders_total', 'orders_total', 'required');
		$this->form_validation->set_rules('orders_terms', 'orders_terms', 'required');
		$this->form_validation->set_rules('orders_description', 'orders_description', 'required');
		if ($this->form_validation->run() == FALSE) {
			return false;
		} else {
			return true;
		}
	}
	function orders_Save()
	{
		$qry = $_POST['db'] . ".dbo.Exec_TransOrders '" . $_POST['orders_dealer_id'] . "'
					,'" . $_POST['orders_user_id'] . "'
					,'" . $_POST['orders_priority_id'] . "'
					,'" . $_POST['orders__subtotal'] . "'
					,'" . $_POST['orders_discounttotal'] . "'
					,'" . $_POST['orders_taxtotal'] . "'
					,'" . $_POST['orders_roundofftotal'] . "'
					,'" . $_POST['orders_total'] . "'
					,'" . $_POST['orders_terms'] . "'
					,'" . $_POST['orders_description'] . "'
					,'1'
					,'1'
					,'" . $_POST['User_Id'] . "'
					,'1'
					,'" . $_POST['Abut'] . "'
					,'" . $_POST['Order_Id'] . "'
					";
		$query = $this->db->query($qry);
		$query = $query->result();
		$msg = 'Dealer Has OverDue for more than 30 Days so Order not Saved';
		//print_r($query);
		foreach ($query as $Row) {
			$lastid =  $Row->LastID;
			$msg =  $Row->msg;
					}
		if ($lastid>0) {
			$product_id = $_POST['product_id'];
			$transoffer_id = $_POST['transoffer_id'];
			$tax_id = $_POST['tax_id'];
			$CreditPeriod = $_POST['CreditPeriod'];
			$qty = $_POST['qty'];
			$rate = $_POST['rate'];
			$subtotal = $_POST['subtotal'];
			$discountperc = $_POST['discountperc'];
			$discounttotal = $_POST['discounttotal'];
			$taxperc = $_POST['taxperc'];
			$Taxtotal = $_POST['Taxtotal'];
			$total = $_POST['ProductTotal'];
					$prdqry = "";
			foreach ($product_id as $key => $n) {
			
				$prdqry .= "Exec ".$_POST['db'] . ".dbo.Exec_TransordersProduct '" . $lastid . "'
							,'" . $product_id[$key] . "'
							,'" . $transoffer_id[$key] . "'
							,'" . $tax_id[$key] . "'
							,'" . $CreditPeriod[$key] . "'
							,'" . $qty[$key] . "'
							,'" . $rate[$key] . "'
							,'" . $subtotal[$key] . "'
							,'" . $discountperc[$key] . "'
							,'" . $discounttotal[$key] . "'
							,'" . $taxperc[$key] . "'
							,'" . $Taxtotal[$key] . "'  
							,'" . $total[$key] . "'
							,'" . $_POST['User_Id'] . "'
							,'1'
							,'SAVE' ;";
			
			}
			
		  $prdqry .= "Exec ".$_POST['db'] . ".dbo.Exec_AutoOrderApproval '" . $lastid . "', '" . $_POST['orders_dealer_id'] . "'";
		
			$prdquery = $this->db->query($prdqry);
			if ($prdquery) {							
				return $msg;
			} else {
				$msg = 'Order not saved';
				return $msg;
			}
		} else {
			return $msg;
		}
	}
	//order end
	
//exec_TransOrdersCashRate
 function OrdersCashRate_Validation()
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
	function OrdersCashRate_Save()
    {
        $qry = "Exec ".$_SESSION['currentdatabasename'].".dbo.exec_TransOrdersCashRate '" . $_POST['Order_Id'] . "','" . $_POST['User_Id'] . "'	";
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
            //foreach ($query as $Row) {              
                //$this->InvoiceVoucher_Save($Row->LastID);
            //}
           
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
		  ti.Invoice_roundoff AS roundoff,
        (SELECT DISTINCT vol.OfficeLedger_id FROM  '.$_SESSION['currentdatabasename'].'.dbo.vw_OfficelegerableList vol 
          WHERE (vol.LedgerType_Id=14 AND vol.Against_Id= 130)) AS discountofficeLedgerroundoff_id ,       
         
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
					 if($row->roundoff<0)
	 {
		 $creditroundoff = 0;
		 $debitroundoff = $row->roundoff;
	 }
 else
 {
	 		 $creditroundoff = $row->roundoff;
		 $debitroundoff = 0;
 }
			$_POST['Voucher_date'] = $row->Invoice_date;
			$_POST['AllTransaction_type_Id'] = '3';
			$_POST['Voucher_status_id'] = '1';
			$_POST['Credit'] = 		array('0',		          $row->salesamount,    $row->taxamount,        '0', $creditroundoff				);
			$_POST['Debit'] = 		array($row->invoiceamount,	'0'		   		    , '0'          ,         $row->discountamount , $debitroundoff);
			$_POST['Against_Id'] = array($row->Dealerledger_id,$row->Salesledger_id,$row->taxofficeledgerid,$row->discountofficeleder_id,$row->discountofficeLedgerroundoff_id); 
			$_POST['TransactionReference'] = array('INVOICE AMOUNT','INVOICE SALES','INVOICE TAX'				,'INVOICE DISCOUNT', 'INVOICE ROUNDOFF');
			$_POST['creditotal'] = $row->invoiceamount;
            $_POST['debittotal'] = $row->invoiceamount;
            $_POST['Abut']='SAVE';
			$this->AccountsClass->VoucherTransaction_Save($row->Invoice_Id);
		}

	}
    //  Invoice  end
}
