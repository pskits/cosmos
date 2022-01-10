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
}
