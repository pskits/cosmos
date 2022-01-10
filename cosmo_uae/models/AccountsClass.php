<?php
class AccountsClass extends CI_Model
{
	//BankReconcilation
	function BankReconcilation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('bank_date', 'bank_date', 'required');
		$this->form_validation->set_rules('bank_ref', 'bank_ref', 'required');
		$this->form_validation->set_rules('Transactions_Id', 'Transactions_Id', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', "Please Fill all Required Details");
			return false;
		} else {
			$qry = "".$_SESSION['currentdatabasename'].".Exec_BankReconciliationReconciled'" . $_POST['Transactions_Id'] . "'
    ,'" . $_POST['bank_ref'] . "'
	,'" . $this->GM->DateTimeSplit($_POST['bank_date'])  . "'
	,'" . $_POST['User_Id'] . "'"; 
			$query = $this->db->query($qry);
			if ($query) {
				$this->session->set_flashdata('msgS', 'Success!!!');
				return true;
			} else {
				$this->session->set_flashdata('msgU', "Not Saved");
				return false;
			}
		}
	}
	// AccountsGroup
	function Group_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('Accountsgroup_ParentId', 'Accountsgroup_ParentId', 'required');
		$this->form_validation->set_rules('Accountsgroup_Name', 'Accountsgroup_Name', 'required');
		$this->form_validation->set_rules('Accountsgroup_Desc', 'Accountsgroup_Desc', 'required');
		$this->form_validation->set_rules('Accountsgroup_Sort', 'Accountsgroup_Sort', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', "Please Fill all Required Details");
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function Group_Save()
	{
		$qry = "cosmo.dbo.Exec_AccountsGroup'" . $_POST['Accountsgroup_ParentId'] . "'
    ,'" . $_POST['Accountsgroup_Name'] . "'
    ,'" . $_POST['Accountsgroup_Desc'] . "'
      ,'" . $_POST['Accountsgroup_Sort'] . "'
	,'" . $_POST['User_Id'] . "'
	,'1'
	,'" . $_POST['Abut'] . "'	
	";
		$query = $this->db->query($qry);
		if ($query) {
			$this->session->set_flashdata('msgS', 'Success!!!');
		} else {
			$this->session->set_flashdata('msgU', "Not Saved");
		}
		echo "<script> history.go(-1);</script>";
	}
	// Group end
	// AccountsLedger
	function Ledger_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('Accountsgroup_Id', 'Accountsgroup_Id', 'required');
		$this->form_validation->set_rules('Ledger_Name', 'Ledger_Name', 'required');
		$this->form_validation->set_rules('Ledger_Code', 'Ledger_Code', 'required');
		$this->form_validation->set_rules('Ledgertype_Id', 'Ledgertype_Id', 'required');
		$this->form_validation->set_rules('Status_Id', 'Status_Id', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function Ledger_Save()
	{
		$qry = "cosmo.dbo.Exec_Ledger '" . $_POST['Accountsgroup_Id'] . "'
,'" . $_POST['Ledger_Name'] . "'
,'" . $_POST['Ledger_Code'] . "'
,'" . $_POST['Ledgertype_Id'] . "'
,'" . $_POST['User_Id'] . "'
,'" . $_POST['Status_Id'] . "'
,'" . $_POST['Abut'] . "'	
,'" . $_POST['Ledger_Id'] . "'	
";
		$query = $this->db->query($qry);
		if ($query) {
			$this->session->set_flashdata('msgS', 'Success!!!');
		} else {
			$this->session->set_flashdata('msgU', "Not Saved");
		}
		echo "<script> history.go(-1);</script>";
	}
	// Ledger end
	//Voucher
	function DebitAgainstSalesReturnVIEW_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('amount', 'amount', 'required');
		$this->form_validation->set_rules('SalesReturn_No', 'SalesReturn_No', 'required');
		$this->form_validation->set_rules('SalesReturn_Id', 'SalesReturn_Id', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', "This Sales Return Cant be Debited");
			return true;
		} else {
			return true;
		}
	}
	function Voucher_Validation()
	{
		
		//$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		//$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		//$this->form_validation->set_rules('Voucher_Type_Id', 'Voucher_Type_Id', 'required');
		//$this->form_validation->set_rules('Source_Id', 'Source_Id', 'required');
		//$this->form_validation->set_rules('Voucher_date', 'Voucher_date', 'required');
		//$this->form_validation->set_rules('VoucherAgainst_Id', 'VoucherAgainst_Id', 'required');
		//$this->form_validation->set_rules('AmountMode_id', 'AmountMode_id', 'required');
		//$this->form_validation->set_rules('AllTransaction_type_Id', 'AllTransaction_type_Id', 'required');
		//$this->form_validation->set_rules('Credit[]', 'credit', 'required');
		//$this->form_validation->set_rules('Debit[]', 'debit', 'required');
		//$this->form_validation->set_rules('Against_Id[]', 'Against_Id', 'required');
		//$this->form_validation->set_rules('TransactionReference[]', 'TransactionReference', 'required');
		//$this->form_validation->set_rules('Voucher_status_id', 'Voucher_status_id', 'required');
		//$this->form_validation->set_rules('description', 'description', 'required');
		//$this->form_validation->set_rules('Reference', 'Reference', 'required');
		//$this->form_validation->set_rules('Abut', 'Abut', 'required');
		if ($this->form_validation->run() == FALSE) {
			//$this->session->set_flashdata('msgU', "Please Fill all Required Details");
			 //print_r(validation_errors());
			//echo "<script> history.go(-1); </script>";
			return true;
		} else {
			return true;
		}
	}
	function Voucher_Save()
	{
		 $qry = "Exec ".$_SESSION['currentdatabasename'].".dbo.Exec_Voucher '" . $_POST['User_Id'] . "'		
		,'" . $_POST['Source_Id'] . "'
		,'" . $_POST['Voucher_Type_Id'] . "'			
		,'" . $_POST['AmountMode_id'] . "'	
		,'" . $_POST['VoucherAgainst_Id'] . "'	
		,'" . $this->GM->DateTimeSplit($_POST['Voucher_date'])  . "'
		,'" . $_POST['description'] . "'
		,'" . $_POST['Reference'] . "'	
		,'" . $_POST['User_Id'] . "'
		,'1'	
		,'" . $_POST['Abut'] . "'
		,'" . $_POST['Voucher_Id'] . "';"; 
		
		
		$query = $this->db->query($qry);
		
		
		if ($query) {
			$query = $query->result();	
			
			return $query[0]->LastID;
		} else {
			$this->session->set_flashdata('msgU', "Voucher Not Saved");
			return false;
		}
	}
	function VoucherTransaction_Save($lastid)
	{
		$Against_Id		= $_POST['Against_Id'];
		$credit = $_POST['Credit'];
		$debit = $_POST['Debit'];
		$TransactionReference = $_POST['TransactionReference'];
		$query = true;
		$qry = '';
		foreach ($Against_Id as $key => $n) {
			$PayAmount = ($credit[$key] > 0) ? $credit[$key] : ($debit[$key] * -1);
			
			if ($query == false) {
				$this->session->set_flashdata('msgD', 'Partial Voucher Amount Not Saved Contact System Admin!');
				return false;
			}
			if ($PayAmount != '0') {
				$qry .= "Exec ".$_SESSION['currentdatabasename'].".dbo.Exec_VoucherAmount '" . $Against_Id[$key]  . "'
					,'" . $_POST['AllTransaction_type_Id'] . "'							
					,'" .  $lastid . "'		
					,'" . $this->GM->DateTimeSplit($_POST['Voucher_date'])  . "'
					,'" . $TransactionReference[$key] . "'	
					,'" . $PayAmount . "'	
					,'1'
					,'" . $_POST['User_Id'] . "'	
					,'1'
					,'" . $_POST['Abut'] . "'	
					";				
			}
		}
		
$query = $this->db->query($qry);
		
			$this->session->set_flashdata('msgS', 'Success!!!');
			return true;
		
	}
	 function Creditnote_Validation()
    {
        $this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
        $this->form_validation->set_rules('User_Id', 'User_Id', 'required');
        $this->form_validation->set_rules('Dealer_Id', 'SalesReturn_Id', 'required'); 
 $this->form_validation->set_rules('CreditnoteDate', 'CreditnoteDate', 'required'); 	
 $this->form_validation->set_rules('amount', 'amount', 'required'); 	
 $this->form_validation->set_rules('description', 'description', 'required'); 	 
 $this->form_validation->set_rules('Creditnote_status_Id', 'Creditnote_status_Id', 'required'); 	 
  $this->form_validation->set_rules('Abut', 'Abut', 'required'); 	
        $this->form_validation->set_rules('adjustableamount[]', 'adjustableamount', 'required');
if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msgU', 'Fill in All Details !!!');
			
            return false;          
        } else {
            return true;
        }
    }
	    function Creditnote_Save()
    {
      $qry = "Exec ".$_SESSION['currentdatabasename'].".dbo.Exec_Creditnote '" . $_POST['Dealer_Id'] . "'		
		,'" . $_POST['User_Id'] . "'		
		,'" . $this->GM->DateTimeSplit($_POST['CreditnoteDate'])  . "'
		,'" . $_POST['amount'] . "'
		,'" . $_POST['description'] . "'
		,'" . $_POST['Creditnote_status_Id'] . "'		
		,'" . $_POST['User_Id'] . "'
		,'1'	
		,'" . $_POST['Abut'] . "'			
		";
		$query = $this->db->query($qry);
		$got = $query->result();
		
		if ($lastid=$got[0]->LastID) {
            $adjustableamount = $_POST['adjustableamount'];   
            $AgainstOfficeLedger_Id = $_POST['AgainstOfficeLedger_Id'];  
 $AdjustmentAgainst_Id = $_POST['AdjustmentAgainst_Id'];   			
			    $prdqry = "";
            foreach ($adjustableamount as $key => $n) {
                $prdquery = "0";
            if($adjustableamount[$key]>'0.00')
			{
                $prdqry .= "Exec ".$_SESSION['currentdatabasename'].".dbo.Exec_CreditnotePaymentAdjustment '6',
				'" . $lastid . "'
				,'" . $this->GM->DateTimeSplit($_POST['CreditnoteDate'])  . "'
				,'" . $AgainstOfficeLedger_Id[$key] . "'
               ,'" . $adjustableamount[$key] . "'
                                 ,'4'
								,'" . $AdjustmentAgainst_Id[$key] . "'                            
                                 ,'" . $_POST['User_Id'] . "','1';";
                
            }
			}
			//echo $prdqry; exit;
			$prdquery = $this->db->query($prdqry);
            if ($prdquery) {
                $this->session->set_flashdata('msgS', 'Success!!!');   
			   return true;
            } else {           
   $this->session->set_flashdata('msgU', 'Not Saved');			
                return false;
             
            }

     
    }
	else
	{
		return false;
	}
	}
	
	//Accounts Sales Order Class
	
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
			,'2'
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
			//print_r($_POST);
			//$prdqry .= "Exec ".$_POST['db'] . ".dbo.Exec_AutoOrderApproval '" . $lastid . "', '" . $_POST['orders_dealer_id'] . "'";
			 $prdqry .= "Exec ".$_POST['db'] . ".dbo.Exec_TransInvoice '" . $lastid . "', '" . $_POST['User_Id'] . "'";
			//exit;
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
	//************************ collection ***************
	function Collection_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('Portal_Id', 'Portal_Id', 'required');
		$this->form_validation->set_rules('Dealer_Id', 'Dealer_Id', 'required');
		$this->form_validation->set_rules('lat', 'lat', 'required');
		$this->form_validation->set_rules('lng', 'lng', 'required');
		$this->form_validation->set_rules('AmountMode_id', 'AmountMode_id', 'required');
		// $this->form_validation->set_rules('collectiontype_id', 'collectiontype_id', 'required');
		$this->form_validation->set_rules('collectiontypeagainst_id[]', 'collectiontypeagainst_id', 'required');
		$this->form_validation->set_rules('collectionprocess_id', 'collectionprocess_id', 'required');
		$this->form_validation->set_rules('collectionprocessagainst_id', 'collectionprocessagainst_id', 'required');
		$this->form_validation->set_rules('amount', 'amount', 'required');
		$this->form_validation->set_rules('description', 'description', 'required');
		$this->form_validation->set_rules('collection_status_id', 'collection_status_id', 'required');
		$this->form_validation->set_rules('Abut', 'Abut', 'required');
		$bool = true;
		// Remove this foreach to confirm with accounts before enabling execess
		foreach ($_POST['collectiontypeagainst_id'] as $collectiontypeagainst_id) {
			if ($collectiontypeagainst_id < 0) {
				$bool = false;
			}
		}
		if ($_POST['AmountMode_id'] == '1') {
			$this->form_validation->set_rules('cheque_no', 'cheque_no', 'required');
			$this->form_validation->set_rules('cheque_date', 'cheque_date', 'required');
			$this->form_validation->set_rules('cheque_bank', 'cheque_bank', 'required');
			$_POST['cheque_date']  = $this->GM->DateSplitwithoutconvert($_POST['cheque_date']);
		} else {
			$_POST['cheque_no'] = null;
			$_POST['cheque_date'] = null;
			$_POST['cheque_bank'] = null;
		}
		if (($this->form_validation->run() == FALSE) || ($bool == false)) {
			$this->session->set_flashdata('msgU', "Please Fill all Required Details");
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function Collection_Save()
	{
		$qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_Collection2 '" . $_POST['Dealer_Id'] . "'
		,'" . $_POST['User_Id'] . "'
		,'" . $_POST['Portal_Id'] . "'
		,'" . $_POST['lat'] . "'
		,'" . $_POST['lng'] . "'
		,'" . $_POST['amount'] . "'
		,'" . $_POST['AmountMode_id'] . "'	
		,'" . $_POST['collectionprocess_id'] . "'
		,'" . $_POST['collectionprocessagainst_id'] . "'		
		,'" . $_POST['cheque_no'] . "'
		,'" . $_POST['cheque_date'] . "'
		,'" . $_POST['cheque_bank'] . "'	
		,'" .  $this->GM->DateSplitwithoutconvert($_POST['Bank_date'] ). "'	
		,'" . $_POST['Bank_ref'] . "'	
		,'" . $_POST['description'] . "'
		,'" . $_POST['collection_status_id'] . "'
		,'" . $_POST['User_Id'] . "'	
		,'1'
		,'" . $_POST['Bank_Id'] . "'
		,'2'
		,'" . $_POST['Abut'] . "'	
		";
		//print_r($_POST);
		//exit;
		
		$query = $this->db->query($qry);
		$query = $query->result();
		
		foreach ($query as $Row) {
			$lastid =  $Row->LastID;
		}
		if ($lastid) {
			$collectiontypeagainst_id = $_POST['collectiontypeagainst_id'];
			$InvoicePayAmount = $_POST['InvoicePayAmount'];			
					$qry = '';
			foreach ($collectiontypeagainst_id as $key => $n) {
		
				if(floatval($InvoicePayAmount[$key])>floatval('0.00'))
				{				
				if ($collectiontypeagainst_id[$key] == '-1') {
					$_POST['collectiontype_id'] = '1';
				} else {
					$_POST['collectiontype_id'] = '2';
				}
				$qry .= "Exec ".$_SESSION['currentdatabasename'].".dbo.Exec_CollectionAmount '" . $lastid . "'	
						,'" . $_POST['collectiontype_id'] . "'
						,'" . $collectiontypeagainst_id[$key] . "'		
						,'" . $InvoicePayAmount[$key] . "'	
						,'" . $_POST['User_Id'] . "'	
						,'1'
						,'" . $_POST['Abut'] . "';";
				
			    }
			}
		
			$query = $this->GM->prdinsert($qry);
			$this->session->set_flashdata('msgS', 'Success!!!');
			if ($_POST['AmountMode_id'] == '2') {
				$this->CollectionCashVoucher_Save($lastid);
			}
			if ($_POST['AmountMode_id'] == '1') {
				$this->CollectionBankVoucher_Save($lastid);
			}
		} else {
			$this->session->set_flashdata('msgU', "Collection Amount Not Saved");
		}
			
		echo "<script> history.go(-1);</script>";
	}
	//********************************************* end
	function CollectionCashVoucher_Save($collection_id)
	{
		
		$rowqry = "Exec ".$_SESSION['currentdatabasename'].".dbo.Exec_AccountsDeposit2 " . $collection_id.";";
		$rowqry.= "Exec ".$_SESSION['currentdatabasename'].".dbo.Exec_AccountsCollection " . $collection_id.";";
		
		$query = $this->db->query($rowqry);
	}
	function CollectionBankVoucher_Save($collection_id)
	{
		$rowqry= "Exec ".$_SESSION['currentdatabasename'].".dbo.Exec_AccountsCollectionBank2 " . $collection_id;
		
		$query = $this->db->query($rowqry);
	}
	
	function LedgerDetails_Edit(){
		$qry = $this->db->query("Select * FROM ".$_SESSION['currentdatabasename'].".dbo.vw_OfficelegerableList where OfficeLedger_id = ".base64_decode($_GET['Key'])."");
		$res = $qry->row();
		$data = array(
					'OfficeLedger_id'=>$res->OfficeLedger_id,
					'LedgerType_Id'=>$res->LedgerType_Id,
					'Ledgername'=>$res->Ledgername,
					'LedgerType_Name' => $res->LedgerType_Name,
					'AccountsGroup_Id' => $res->AccountsGroup_Id,
					'Accountsgroup_Name' => $res->Accountsgroup_Name,
					'But'=>'Update',
					'Icon'=>'fa fa-pencil',
					'BtnColor'=>'bg-blue'
				);
		$this->load->view('Accounts/LedgerDetails_Edit',$data);
	}

	function LedgerDetails_Update()
	{
		$qry = "Exec ".$_SESSION['currentdatabasename'].".dbo.Exec_AccountsLedger_update '".$_POST['Accountsgroup_Id']."','".$_POST['User_Id']."','".$_POST['OfficeLedger_id']."' ";
		//print_r($qry); exit;
		$this->db->query($qry);
		$this->session->set_flashdata('msgS', 'Success!!!');	
		redirect("Accounts/LedgerDetails_View");
	}
}
