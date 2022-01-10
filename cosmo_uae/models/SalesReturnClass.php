<?php
class SalesReturnClass extends CI_Model
{
    // SalesReturnGoodsResellable Start
    function SalesReturnGoodsResellable_Validation()
    {
        $this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
        $this->form_validation->set_rules('User_Id', 'User_Id', 'required');
        $this->form_validation->set_rules('SalesReturn_Id', 'SalesReturn_Id', 'required');
        $this->form_validation->set_rules('salesreturnrequest_status_id', 'salesreturnrequest_status_id', 'required');
        $this->form_validation->set_rules('SerialNo', 'SerialNo', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msgU', "Please Fill all Required Details");
            echo "<script> history.go(-1);</script>";
        } else {
            return true;
        }
    }
    function SalesReturnGoodsResellable_Save()
    {
        $qry = "" . $_SESSION['currentdatabasename'] . ".dbo.Exec_TransSalesReturnGoods_Resellable '" . $_POST['SerialNo'] . "','" . $_POST['SerialNo'] . "', '" . $_POST['SalesReturn_Id'] . "', '" . $_POST['salesreturnrequest_status_id'] . "','" . $_POST['User_Id'] . "'	";
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
    // SalesReturnGoodsScrab Start
    function SalesReturnGoodsScrab_Validation()
    {
        $this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
        $this->form_validation->set_rules('User_Id', 'User_Id', 'required');
        $this->form_validation->set_rules('SalesReturn_Id', 'SalesReturn_Id', 'required');
        $this->form_validation->set_rules('salesreturnrequest_status_id', 'salesreturnrequest_status_id', 'required');
        $this->form_validation->set_rules('SerialNo', 'SerialNo', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msgU', "Please Fill all Required Details");
            echo "<script> history.go(-1);</script>";
        } else {
            return true;
        }
    }
    function SalesReturnGoodsScrab_Save()
    {
        $qry = "" . $_SESSION['currentdatabasename'] . ".dbo.Exec_TransSalesReturnGoods_Scrab '" . $_POST['SerialNo'] . "', '" . $_POST['SalesReturn_Id'] . "', '" . $_POST['salesreturnrequest_status_id'] . "','" . $_POST['User_Id'] . "'	";
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
    //Exec_TransSalesReturnRequestProductStatus_Old
    function SalesReturnRequestProductStatus_Validation()
    {
        $this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
        $this->form_validation->set_rules('User_Id', 'User_Id', 'required');
        $this->form_validation->set_rules('Product_Id', 'Product_Id', 'required');
        $this->form_validation->set_rules('SerialNo', 'SerialNo', 'required');
        $this->form_validation->set_rules('Status', 'Status', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msgU', "Please Fill all Required Details");
            echo "<script> history.go(-1);</script>";
        } else {
            return true;
        }
    }
    function SalesReturnRequestProductStatus_Save()
    {
        $qry = "" . $_SESSION['currentdatabasename'] . ".dbo.Exec_TransSalesReturnRequestProductStatus_Old '" . $_POST['SerialNo'] . "', '" . $_POST['Product_Id'] . "', '" . $_POST['Status'] . "','" . $_POST['User_Id'] . "'	";
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
    // SalesReturnRequestStatus Start
    function SalesReturnRequestStatus_Validation()
    {
        $this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
        $this->form_validation->set_rules('User_Id', 'User_Id', 'required');
        $this->form_validation->set_rules('SerialNo', 'SerialNo', 'required');
        $this->form_validation->set_rules('Status', 'Status', 'required');
		$this->form_validation->set_rules('SalesReturnRequest_Id', 'SalesReturnRequest_Id', 'required');
		
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msgU', "Please Fill all Required Details");
            echo "<script> history.go(-1);</script>";
        } else {
            return true;
        }
    }
    function SalesReturnRequestStatus_Save()
    {
        $qry = "Exec " . $_SESSION['currentdatabasename'] . ".dbo.Exec_TransSalesReturnRequestProductStatus '" . $_POST['SerialNo'] . "','" . 
		$_POST['SalesReturnRequest_Id'] . "', '" . $_POST['Status'] . "','" . $_POST['User_Id'] . "'	";
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
    //TransSalesReturnStatus
    function TransSalesReturnStatus_Validation()
    {
        $this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
        $this->form_validation->set_rules('User_Id', 'User_Id', 'required');
        $this->form_validation->set_rules('SalesReturn_Id', 'SalesReturn_Id', 'required');
        $this->form_validation->set_rules('SalesReturn_status_Id', 'SalesReturn_status_Id', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msgU', "Please Fill all Required Details");
            echo "<script> history.go(-1);</script>";
        } else {
            return true;
        }
    }
    function TransSalesReturnStatus_Save()
    {
        $qry = "Exec " . $_SESSION['currentdatabasename'] . ".dbo.Exec_TransSalesReturnStatus '" . $_POST['SalesReturn_Id'] . "','" . 
		$_POST['SalesReturn_status_Id'] . "','" . $_POST['User_Id'] . "';";
        $query = $this->db->query($qry);
        if ($query) {
            $this->session->set_flashdata('msgS', 'Success!!!');
        } else {
            $err = $this->db->error();
            $err = $err['message'];
            $this->session->set_flashdata('msgU', "Same Data Already Exist");
        }
        return true;
    }
    //  Order Approval and Invoice  end
    //SalesReturn Request Complete
    function SalesReturnRequestCompletion_Validation()
    {
        $this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
        $this->form_validation->set_rules('User_Id', 'User_Id', 'required');
        $this->form_validation->set_rules('SalesReturnRequest_Id', 'SalesReturn_Id', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msgU', "Please Fill all Required Details");
            echo "<script> history.go(-1);</script>";
        } else {
            return true;
        }
    }
    function SalesReturnRequestCompletion_Save()
    {
        $qry = "" . $_SESSION['currentdatabasename'] . ".dbo.Exec_TransSalesReturnRequestCompleted '" . $_POST['SalesReturnRequest_Id'] . "','" . $_POST['User_Id'] . "'	";
        $query = $this->db->query($qry);
        if ($query) {
            $this->session->set_flashdata('msgS', 'Success!!!');
        } else {
            $err = $this->db->error();
            $err = $err['message'];
            $this->session->set_flashdata('msgU', "Same Data Already Exist");
        }
        echo "<script> history.go(-2);</script>";
    }
    //Exec_TransSalesReturnRequestStatus
    function TransSalesReturnRequestStatus_Validation()
    {
        $this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
        $this->form_validation->set_rules('User_Id', 'User_Id', 'required');
        $this->form_validation->set_rules('SalesReturnRequest_Id', 'SalesReturn_Id', 'required');
        $this->form_validation->set_rules('Status_Id', 'Status_Id', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msgU', "Please Fill all Required Details");
            echo "<script> history.go(-1);</script>";
        } else {
            return true;
        }
    }
    function TransSalesReturnRequestStatus_Save()
    {
        $qry = "Exec " . $_SESSION['currentdatabasename'] . ".dbo.Exec_TransSalesReturnRequestStatus '" . $_POST['SalesReturnRequest_Id'] . "'
		,'" . $_POST['Status_Id'] . "',	'" . $_POST['User_Id'] . "'	";
        $query = $this->db->query($qry);
        if ($query) {
            $this->session->set_flashdata('msgS', 'Success!!!');
        } else {
            $err = $this->db->error();
            $err = $err['message'];
            $this->session->set_flashdata('msgU', "Same Data Already Exist");
        }
        echo "<script> history.go(-2);</script>";
    }
    //SalesReturnReplacement_Save
    function SalesReturnReplacement_Validation()
    {
        $this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
        $this->form_validation->set_rules('User_Id', 'User_Id', 'required');
        $this->form_validation->set_rules('SalesReturn_Id', 'SalesReturn_Id', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msgU', "Please Fill all Required Details");
            echo "<script> history.go(-1);</script>";
        } else {
            return true;
        }
    }
    function SalesReturnReplacement_Save()
    {
        // Turn this On to assign goods automatically for Warrenty Replacement
        // $qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_TransSalesReturnReplacementGoods '" . $_POST['SalesReturn_Id'] . "','" . $_POST['User_Id'] . "'	";
        // $query = $this->db->query($qry); 
          $rqry = "Exec " . $_SESSION['currentdatabasename'] . ".dbo.Exec_TransSalesReturnReplaceable 
		 '" . $_POST['SalesReturn_Id'] . "','" . $_POST['User_Id'] . "'	;";
        
		$query = $this->db->query($rqry);
        if ($query) {
            $this->session->set_flashdata('msgS', 'Success!!!');
            //$this->SalesReturnReplacementVoucher_Save($_POST['SalesReturn_Id']);
            // Do not use this $_POST['SalesReturn_status_Id'] = "2";
            // if ($this->SalesReturnClass->TransSalesReturnStatus_Validation()) {
            //     $this->SalesReturnClass->TransSalesReturnStatus_Save();
            // }
        } else {
            $err = $this->db->error();
            $err = $err['message'];
            $this->session->set_flashdata('msgU', "Same Data Already Exist");
        }
        echo "<script> history.go(-1);</script>";
    }
    // sales return
    function SalesReturn_Validation()
    {
        $this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
        $this->form_validation->set_rules('User_Id', 'User_Id', 'required');
        $this->form_validation->set_rules('SalesReturnRequest_Id', 'SalesReturnRequest_Id', 'required');
        $this->form_validation->set_rules('SalesReturnRequest_Date', 'SalesReturnRequest_Date', 'required');
        $this->form_validation->set_rules('Dealer_Id', 'Dealer_Id', 'required');
        $this->form_validation->set_rules('Invoice_id[]', 'Invoice_id', 'required');
        $this->form_validation->set_rules('Tax_Id[]', 'Tax_Id', 'required');
        $this->form_validation->set_rules('Reason', 'Reason', 'required');
        $this->form_validation->set_rules('SalesReturn_Subtotal', 'SalesReturn_Subtotal', 'required');
        $this->form_validation->set_rules('SalesReturn_TotalDiscountAmount', 'SalesReturn_TotalDiscountAmount', 'required');
        $this->form_validation->set_rules('SalesReturn_TotalTaxAmount', 'SalesReturn_TotalTaxAmount', 'required');
        $this->form_validation->set_rules('SalesReturn_GrandTotalAmount', 'SalesReturn_GrandTotalAmount', 'required');
        $this->form_validation->set_rules('Product_Id[]', 'Product_Id[]', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msgU', 'Fill in All Details !!!');
            echo "<script> history.go(-1);</script>";
        } else {
            return true;
        }
    }
    function SalesReturn_Save()
    {
         $qry = "Exec " . $_SESSION['currentdatabasename'] . ".dbo.Exec_TransSalesReturn '" . $_POST['SalesReturnRequest_Id'] . "'
        ,'" . $_POST['SalesReturnRequest_Date'] . "'
		,'" . $_POST['SalesReturn_Subtotal'] . "'
		,'" . $_POST['SalesReturn_TotalDiscountAmount'] . "'
		,'" . $_POST['SalesReturn_TotalTaxAmount'] . "'
		,'" . $_POST['SalesReturn_GrandTotalAmount'] . "'
		,'" . $_POST['Reason'] . "'
		,'1'
       	,'" . $_POST['User_Id'] . "'
		,'1'		
		"; 
        $query = $this->db->query($qry);
        $query = $query->result();
        
            $lastid =  $query[0]->LastID;
        
		if ($lastid) {
			$_POST['SalesReturn_Id'] = $lastid;
            $Product = $_POST['Product_Id'];
            $Invoice_id = $_POST['Invoice_id'];
            $Tax_Id = $_POST['Tax_Id'];
            $Qty = $_POST['Qty'];
            $Rate = $_POST['Rate'];
            $SubTotal = $_POST['SubTotal'];
            $DiscountPerc = $_POST['DiscountPerc'];
            $Discount = $_POST['Discount'];
            $TaxPerc = $_POST['TaxPerc'];
            $Tax = $_POST['Tax'];
            $Invoice_id = $_POST['Invoice_id'];
            $Total = $_POST['Total'];
			$prdqry = "";
            foreach ($Product as $key => $n) {
                $prdquery = "0";
                
                $prdqry .= "Exec " . $_SESSION['currentdatabasename'] . ".dbo.Exec_TransSalesReturnProduct '" . $lastid . "'
                                ,'" . $Invoice_id[$key] . "'
                                 ,'" . $Product[$key] . "'
                                 ,'" . $Tax_Id[$key] . "'
                                ,'" . $Qty[$key] . "'
                                ,'" . $Rate[$key] . "'
                                ,'" . $SubTotal[$key] . "'
                                ,'" . $DiscountPerc[$key] . "'
                                ,'" . $Discount[$key] . "'                                
                                ,'" . $TaxPerc[$key] . "'
                                ,'" . $Tax[$key] . "'
                                ,'" . $Total[$key] . "'
                                ,'1'
                                ,'" . $_POST['User_Id'] . "';						
                                ";
                //$prdquery = $this->GM->prdinsert($prdqry);
            }
			$prdqry .= "EXEC " . $_SESSION['currentdatabasename'] . ".dbo.Exec_AccountsSalesReturn '" . $lastid . "';
			Exec " . $_SESSION['currentdatabasename'] . ".dbo.Exec_TransSalesReturnReplaceable '" . $lastid . "','" . $_POST['User_Id'] . "'	;";
			$prdquery = $this->db->query($prdqry);
			
			
            if ($prdquery) {
				
                //$this->SalesReturnVoucher_Save($lastid);
				$this->session->set_flashdata('msgS', 'Success!!!');
            } else {
                $dltqry = "";
                $this->db->query($dltqry);
                $this->session->set_flashdata('msgU', 'Error Contact System Admin !!!');
            }
			
            $id = base64_encode($lastid);
            echo "<script> window.location='" . site_url("SalesReturn/SalesReturn_View/?Key=$id") . "';</script>";
        } else {
            $err = $this->db->error();
            $err = $err['message'];
            $data = "The duplicate key value is";
            if (($out = strpos($err, "$data")) !== FALSE) {
                $Values_of_the_Message = substr($err, strpos($err, "$data") + 26);
                $this->session->set_flashdata('msgU', "$Values_of_the_Message Same Data Already Exist for another User");
            } else {
                $this->session->set_flashdata('msgU', "Same Data Already Exist for another User");
            }
            $data = array('But' => $_POST['Abut'], 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
            echo "<script> window.location='" . site_url('SalesReturn/SalesReturnRequest') . "';</script>";
        }
    }
    //Paymentadjust
    function SalesReturnPaymentAdjust_Validation()
    {
        $this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
        $this->form_validation->set_rules('User_Id', 'User_Id', 'required');
        $this->form_validation->set_rules('SalesReturn_Id', 'SalesReturn_Id', 'required');
        $this->form_validation->set_rules('adjustableamount[]', 'adjustableamount', 'required');
        $this->form_validation->set_rules('SalesReturn_Total', 'SalesReturn_Total', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msgU', 'Fill in All Details !!!');
            echo "<script> history.go(-1);</script>";
        } else {
            return true;
        }
    }
    function SalesReturnPaymentAdjust_Save()
    {
        $totaladjusmentamount = '0';
        $prdquery = "0";
        $prdqry = "";
        $adjustableamount = $_POST['adjustableamount'];
        $salesreturn_amount    = $_POST['salesreturn_amount'];
        foreach ($adjustableamount as $key => $n) {
            if (number_format($adjustableamount[$key]) > number_format('0.00')) {
                $totaladjusmentamount += $adjustableamount[$key];
                $prdqry .= "Exec " . $_SESSION['currentdatabasename'] . ".dbo.Exec_PaymentAdjustment '2','" . $_POST['SalesReturn_Id'] . "'
               ,'" . $adjustableamount[$key] . "'
                                 ,'4','" . $key . "'                              
                                 ,'" . $_POST['User_Id'] . "','1';";
            }
        }
        //echo $prdqry;exit;
        if ($salesreturn_amount >= $totaladjusmentamount) {
            $prdquery = $this->GM->prdinsert($prdqry);
            if ($prdquery) {
                $this->session->set_flashdata('msgS', 'Success!!!');
            } else {
                $this->session->set_flashdata('msgD', 'Error Contact System Admin !!!');
            }
        } else {
            $this->session->set_flashdata('msgU', 'Total Payment amount should be less than or Equal to SalesReturn Amount!!!');
        }
        $id = base64_encode($_POST['SalesReturn_Id']);
        echo "<script> window.location='" . site_url("SalesReturn/SalesReturn_View/?Key=$id") . "';</script>";
    }
    // sales return
    function SalesReturnVoucher_Save($SalesReturneID)
    {
        $qry =   'SELECT tsr.SalesReturn_Id,tsr.SalesReturn_date,
        --add
        tsr.SalesReturn_total AS salesreturnamount,vol.OfficeLedger_id AS Dealerledger_id,
        --minus
        tsr.SalesReturn_subtotal AS salesamount,
        (SELECT DISTINCT vol.OfficeLedger_id FROM cosmo.dbo.Mas_ledger ml 
         INNER JOIN ' . $_SESSION['currentdatabasename'] . '.dbo.vw_OfficelegerableList vol ON (vol.LedgerType_Id=14 AND vol.Against_Id= 140)) AS Salesledger_id,
        --minus
        tsr.SalesReturn_taxtotal AS taxamount, 
        (SELECT DISTINCT vol.OfficeLedger_id From ' . $_SESSION['currentdatabasename'] . '.dbo.Trans_SalesReturnproduct tip 
         INNER JOIN ' . $_SESSION['currentdatabasename'] . '.dbo.vw_OfficelegerableList vol ON 
         (vol.LedgerType_Id=15 AND vol.Against_Id= tip.Tax_id)
         WHERE tip.SalesReturn_id=tsr.SalesReturn_Id) AS taxofficeledgerid,
         --add
        tsr.SalesReturn_Discounttotal AS discountamount, 
        (SELECT DISTINCT vol.OfficeLedger_id FROM cosmo.dbo.Mas_ledger ml 
         INNER JOIN ' . $_SESSION['currentdatabasename'] . '.dbo.vw_OfficelegerableList vol ON (vol.LedgerType_Id=14 AND vol.Against_Id= 44)) AS discountofficeleder_id        
        From ' . $_SESSION['currentdatabasename'] . '.dbo.Trans_SalesReturn tsr
        INNER JOIN ' . $_SESSION['currentdatabasename'] . '.dbo.Trans_SalesReturnRequest tsrr ON tsrr.SalesReturnRequest_Id = tsr.SalesReturnRequest_Id
            INNER JOIN ' . $_SESSION['currentdatabasename'] . '.dbo.Mas_Dealer md ON md.Dealer_Id = tsrr.Dealer_Id
            INNER JOIN ' . $_SESSION['currentdatabasename'] . '.dbo.vw_OfficelegerableList vol ON (vol.Against_Id = md.Dealer_Id AND vol.LedgerType_Id=2)
            WHERE tsr.SalesReturn_Id   = ' . $SalesReturneID . '';
        $query = $this->db->query($qry);
        $res = $query->result();
        foreach ($res as $row) {
            $_POST['Voucher_date'] = $row->SalesReturn_date;
            $_POST['AllTransaction_type_Id'] = '2';
            $_POST['Voucher_status_id'] = '1';
            $_POST['Credit'] =         array($row->salesreturnamount, '0',    '0',             $row->discountamount);
            $_POST['Debit'] =         array('0',    $row->salesamount,  $row->taxamount,  '0');
            $_POST['Against_Id'] = array($row->Dealerledger_id, $row->Salesledger_id, $row->taxofficeledgerid, $row->discountofficeleder_id);
            $_POST['TransactionReference'] = array('SALSESRETURN AMOUNT', 'SALSESRETURN SALES', 'SALSESRETURN TAX', 'SALSESRETURN DISCOUNT');
            $_POST['creditotal'] = $row->salesreturnamount;
            $_POST['debittotal'] = $row->salesreturnamount;
            $_POST['Abut'] = 'SAVE';
            $this->AccountsClass->VoucherTransaction_Save($row->SalesReturn_Id);
        }
    }
        // sales return
        function SalesReturnReplacementVoucher_Save($SalesReturneID)
        {
            $qry =   'SELECT tsr.SalesReturn_Id,tsr.SalesReturn_date,
            --minus
            tsr.SalesReturn_total AS salesreturnamount,vol.OfficeLedger_id AS Dealerledger_id,
            --add
            tsr.SalesReturn_subtotal AS salesamount,
            (SELECT DISTINCT vol.OfficeLedger_id FROM cosmo.dbo.Mas_ledger ml 
             INNER JOIN ' . $_SESSION['currentdatabasename'] . '.dbo.vw_OfficelegerableList vol ON (vol.LedgerType_Id=14 AND vol.Against_Id= 140)) AS Salesledger_id,
            --add
            tsr.SalesReturn_taxtotal AS taxamount, 
            (SELECT DISTINCT vol.OfficeLedger_id From ' . $_SESSION['currentdatabasename'] . '.dbo.Trans_SalesReturnproduct tip 
             INNER JOIN ' . $_SESSION['currentdatabasename'] . '.dbo.vw_OfficelegerableList vol ON 
             (vol.LedgerType_Id=15 AND vol.Against_Id= tip.Tax_id)
             WHERE tip.SalesReturn_id=tsr.SalesReturn_Id) AS taxofficeledgerid,
             --minus
            tsr.SalesReturn_Discounttotal AS discountamount, 
            (SELECT DISTINCT vol.OfficeLedger_id FROM cosmo.dbo.Mas_ledger ml 
             INNER JOIN ' . $_SESSION['currentdatabasename'] . '.dbo.vw_OfficelegerableList vol ON (vol.LedgerType_Id=14 AND vol.Against_Id= 44)) AS discountofficeleder_id        
            From ' . $_SESSION['currentdatabasename'] . '.dbo.Trans_SalesReturn tsr
            INNER JOIN ' . $_SESSION['currentdatabasename'] . '.dbo.Trans_SalesReturnRequest tsrr ON tsrr.SalesReturnRequest_Id = tsr.SalesReturnRequest_Id
                INNER JOIN ' . $_SESSION['currentdatabasename'] . '.dbo.Mas_Dealer md ON md.Dealer_Id = tsrr.Dealer_Id
                INNER JOIN ' . $_SESSION['currentdatabasename'] . '.dbo.vw_OfficelegerableList vol ON (vol.Against_Id = md.Dealer_Id AND vol.LedgerType_Id=2)
                WHERE tsr.SalesReturn_Id   = ' . $SalesReturneID . '';
            $query = $this->db->query($qry);
            $res = $query->result();
            foreach ($res as $row) {
                $_POST['Voucher_date'] = $row->SalesReturn_date;
                $_POST['AllTransaction_type_Id'] = '7';
                $_POST['Voucher_status_id'] = '1';
                $_POST['Credit'] =         array('0',                   $row->salesamount,   $row->taxamount,  '0');
                $_POST['Debit'] =         array($row->salesreturnamount,'0' ,  '0',  $row->discountamoun);
                $_POST['Against_Id'] = array($row->Dealerledger_id, $row->Salesledger_id, $row->taxofficeledgerid, $row->discountofficeleder_id);
                $_POST['TransactionReference'] = array('SALSESRETURN AMOUNT', 'SALSESRETURN SALES', 'SALSESRETURN TAX', 'SALSESRETURN DISCOUNT');
                $_POST['creditotal'] = $row->salesreturnamount;
                $_POST['debittotal'] = $row->salesreturnamount;
                $_POST['Abut'] = 'SAVE';
                $this->AccountsClass->VoucherTransaction_Save($row->SalesReturn_Id);
            }
        }
    
}
