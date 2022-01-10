<?php
class CollectionClass extends CI_Model
{
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
		$qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_Collection '" . $_POST['Dealer_Id'] . "'
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
		,'" . $_POST['description'] . "'
		,'" . $_POST['collection_status_id'] . "'
		,'" . $_POST['User_Id'] . "'	
		,'1'
		,'" . $_POST['Abut'] . "'	
		";
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
		} else {
			$this->session->set_flashdata('msgU', "Collection Amount Not Saved");
		}
		echo "<script> history.go(-1);</script>";
	}
	//Excess Adjustment
	function Excess_Save()
	{
		$qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_Collection '" . $_POST['Dealer_Id'] . "'
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
		,'" . $_POST['description'] . "'
		,'" . $_POST['collection_status_id'] . "'
		,'" . $_POST['User_Id'] . "'	
		,'1'
		,'" . $_POST['Abut'] . "'	
		";
		$query = $this->db->query($qry);
		$query = $query->result();
		foreach ($query as $Row) {
			$lastid =  $Row->LastID;
		}
		if ($lastid) {
			$collectiontype_id = $_POST['collectiontype_id'];
			$collectiontypeagainst_id = $_POST['collectiontypeagainst_id'];
			$InvoicePayAmount = $_POST['InvoicePayAmount'];
			$query = true;
				$qry = '';
			foreach ($collectiontypeagainst_id as $key => $n) {
			
				if(floatval($InvoicePayAmount[$key])>floatval('0.01'))
				{
				if ($collectiontypeagainst_id[$key] == '-1') {
					$_POST['collectiontype_id'] = '1';
				} else {
					$_POST['collectiontype_id'] = '2';
				}
				
				$qry .= "Exec ".$_SESSION['currentdatabasename'].".dbo.Exec_CollectionAmount '" . $lastid . "'
						,'" . $collectiontype_id[$key] . "'
						,'" . $collectiontypeagainst_id[$key] . "'		
						,'" . $InvoicePayAmount[$key] . "'	
						,'" . $_POST['User_Id'] . "'	
						,'1'
						,'" . $_POST['Abut'] . "';	";
				
				}
				
			}
			$query = $this->GM->prdinsert($qry);
			$this->session->set_flashdata('msgS', 'Success!!!');
		} else {
			$this->session->set_flashdata('msgU', "Collection Amount Not Saved");
		}
	}
	//deposit
	function Deposit_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('Bank_Id', 'Bank_Id', 'required');
		$this->form_validation->set_rules('lat', 'lat', 'required');
		$this->form_validation->set_rules('lng', 'lng', 'required');
		$this->form_validation->set_rules('AmountMode_id', 'AmountMode_id', 'required');
		$this->form_validation->set_rules('Collection_Id[]', 'Collection_Id', 'required');
		$this->form_validation->set_rules('Branch', 'Branch', 'required');
		$this->form_validation->set_rules('description', 'description', 'required');
		$this->form_validation->set_rules('Deposit_status_id', 'Deposit_status_id', 'required');
		$this->form_validation->set_rules('Abut', 'Abut', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', "Please Fill all Required Details");
			echo "<script> history.go(-1); </script>";
		} else {
			return true;
		}
	}
	function Deposit_Save()
	{
		$qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_Deposit '" . $_POST['Bank_Id'] . "'
							,'" . $_POST['User_Id'] . "'
							,'" . $_POST['lat'] . "'
							,'" . $_POST['lng'] . "'
							,'" . $_POST['AmountMode_id'] . "'
							,'" . $_POST['Branch'] . "'
							,'" . $_POST['description'] . "'
							,'" . $_POST['Deposit_status_id'] . "'
							,'" . $_POST['User_Id'] . "'
							,'1'
							,'" . $_POST['Abut'] . "'
							";
		$query = $this->db->query($qry);
		$query = $query->result();
		foreach ($query as $Row) {
			$lastid = $Row->LastID;
		}
		if ($lastid) {
			$Collection_Id = $_POST['Collection_Id'];
			$query = true;
			foreach ($Collection_Id as $key => $n) {
				$qry = '';
				if ($query == false) {
					$this->session->set_flashdata('msgD', 'Partial Deposit Amount Not Saved Contact System Admin!');
					echo "<script>history.go(-1);</script>";
					exit;
				}
				$qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_Depositcollection '" . $lastid . "'				
												,'" . $Collection_Id[$key] . "'			
												,'" . $_POST['User_Id'] . "'
												,'1'
												,'" . $_POST['Abut'] . "'
												";
				$query = $this->GM->prdinsert($qry);
			}
			$this->session->set_flashdata('msgS', 'Success!!!');
		} else {
			$this->session->set_flashdata('msgU', "Deposit Amount Not Saved");
		}
		echo "<script> history.go(-1); </script>";
	}
	//Settlement
	function Settlement_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('collectedUser_Id', 'collectedUser_Id', 'required');
		$this->form_validation->set_rules('lat', 'lat', 'required');
		$this->form_validation->set_rules('lng', 'lng', 'required');
		$this->form_validation->set_rules('AmountMode_id', 'AmountMode_id', 'required');
		$this->form_validation->set_rules('Collection_Id[]', 'Collection_Id', 'required');
		$this->form_validation->set_rules('description', 'description', 'required');
		$this->form_validation->set_rules('Abut', 'Abut', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', "Please Fill all Required Details");
			echo "<script> history.go(-1); </script>";
		} else {
			return true;
		}
	}
	function Settlement_Save()
	{
		$qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_Settlement '" . $_POST['collectedUser_Id'] . "'
								,'" . $_POST['User_Id'] . "'
								,'" . $_POST['lat'] . "'
								,'" . $_POST['lng'] . "'
								,'" . $_POST['AmountMode_id'] . "'						
								,'" . $_POST['description'] . "'							
								,'" . $_POST['User_Id'] . "'
								,'1'
								,'" . $_POST['Abut'] . "'
								";
		$query = $this->db->query($qry);
		$query = $query->result();
		foreach ($query as $Row) {
			$lastid = $Row->LastID;
		}
		if ($lastid) {
			$Collection_Id = $_POST['Collection_Id'];
			$query = true;
			foreach ($Collection_Id as $key => $n) {
				$qry = '';
				if ($query == false) {
					$this->session->set_flashdata('msgD', 'Partial Settlement Amount Not Saved Contact System Admin!');
					echo "<script>history.go(-1);</script>";
					exit;
				}
				$qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_Settlementcollection '" . $lastid . "'				
												,'" . $Collection_Id[$key] . "'			
												,'" . $_POST['User_Id'] . "'
												,'1'
												,'" . $_POST['Abut'] . "'
												";
				$query = $this->GM->prdinsert($qry);
			}
			$this->session->set_flashdata('msgS', 'Success!!!');
		} else {
			$this->session->set_flashdata('msgU', "Settlement Amount Not Saved");
		}
		echo "<script> history.go(-1); </script>";
	}
	//BankApproval
	function BankApproval_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('Deposit_Id', 'Deposit_Id', 'required');
		$this->form_validation->set_rules('AmountMode_id', 'AmountMode_id', 'required');
		$this->form_validation->set_rules('Reference', 'Reference', 'required');
		$this->form_validation->set_rules('Bank_Date', 'Bank_Date', 'required');
		$this->form_validation->set_rules('reject_reason', 'reject_reason', 'required');
		$this->form_validation->set_rules('reject_description', 'reject_description', 'required');
		$this->form_validation->set_rules('Deposit_status_id', 'Deposit_status_id', 'required');
		$this->form_validation->set_rules('Abut', 'Abut', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', "Please Fill all Required Details");
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function BankApproval_Save()
	{
		if ($_POST['Bank_Date'] == 'NULL') {
			$_POST['Bank_Date'] = date('d-m-Y');
		}
		$qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_BankApproval '" . $this->GM->DateSplitwithoutconvert($_POST['Bank_Date']) . "'
								,'" . $_POST['Reference'] . "'
								,'" . $_POST['reject_reason'] . "'
								,'" . $_POST['reject_description'] . "'
								,'" . $_POST['Deposit_status_id'] . "'							
								,'" . $_POST['User_Id'] . "'
								,'1'
								,'" . $_POST['Abut'] . "'
								,'" . $_POST['Deposit_Id'] . "'
								";
		$query = $this->db->query($qry);
		if ($query) {
			$this->session->set_flashdata('msgS', 'Success!!!');
			if ($_POST['AmountMode_id'] == '2') {
				$this->CollectionCashVoucher_Save();
			}
			if ($_POST['AmountMode_id'] == '1') {
				$this->CollectionBankVoucher_Save();
			}
		} else {
			$this->session->set_flashdata('msgU', "Not Saved");
		}
		echo "<script> history.go(-1); </script>";
	}
	function CollectionCashVoucher_Save()
	{
		$qry =	'SELECT tc.Colletion_Id,vol.OfficeLedger_id,tc.amount From '.$_SESSION['currentdatabasename'].'.dbo.Trans_Colletion tc
		INNER JOIN '.$_SESSION['currentdatabasename'].'.dbo.Trans_ColletionAmount tca ON tca.Colletion_Id = tc.Colletion_Id
		INNER JOIN '.$_SESSION['currentdatabasename'].'.dbo.Trans_Invoice ti ON (ti.Invoice_Id = tca.CollectionTypeAgainst_Id AND tca.CollectionType_Id=2)
		INNER JOIN '.$_SESSION['currentdatabasename'].'.dbo.Mas_Dealer md ON md.Dealer_Id = tc.Dealer_Id
		INNER JOIN '.$_SESSION['currentdatabasename'].'.dbo.vw_OfficelegerableList vol ON (vol.Against_Id = md.Dealer_Id AND vol.LedgerType_Id=2) 
			  WHERE tc.Status_Id=1 and  tc.Colletion_Id IN (
			  SELECT tdc.Collection_Id From '.$_SESSION['currentdatabasename'].'.dbo.Trans_Deposit td 
			  INNER JOIN '.$_SESSION['currentdatabasename'].'.dbo.trans_depositcollection tdc ON tdc.Deposit_Id = td.Deposit_Id
			  WHERE td.Deposit_Id = ' . $_POST['Deposit_Id'] . ' AND td.Deposit_Status_Id = 2)
			  group by tc.Colletion_Id,vol.OfficeLedger_id,tc.amount';
		$query = $this->db->query($qry);
		$res = $query->result();
		$cashledgerqry = 'SELECT vol.OfficeLedger_id FROM '.$_SESSION['currentdatabasename'].'.dbo.vw_OfficelegerableList vol
		INNER JOIN cosmo.dbo.Mas_Ledger mb ON (mb.Ledger_Id = vol.Against_Id AND vol.LedgerType_Id=13)		
		WHERE  mb.Ledger_Id= 24';
		$cashledgerqry = $this->db->query($cashledgerqry);
		$cashledgerqry = $cashledgerqry->result();
		$ledger_Id = $cashledgerqry[0]->OfficeLedger_id;
		foreach ($res as $row) {
			$_POST['Voucher_Type_Id'] = '7';
			$_POST['Source_Id'] = '1';
			$_POST['VoucherAgainst_Id'] = $row->Colletion_Id;
			$_POST['Voucher_date'] = $this->GM->DateSplitwithoutconvert($_POST['Bank_Date']);
			$_POST['AllTransaction_type_Id'] = '4';
			$_POST['Voucher_status_id'] = '1';
			$_POST['description'] = 'RECEIPT';
			$_POST['Reference'] = 'INVOICE';
			$_POST['Credit'] = array($row->amount, '0');
			$_POST['Debit'] = array('0', $row->amount);
			$_POST['Against_Id'] = array($row->OfficeLedger_id, $ledger_Id); // for cash cash
			$_POST['TransactionReference'] = array('COLLECTION INVOICE', 'COLLECTION INVOICE');
			$_POST['creditotal'] = $row->amount;
			$_POST['debittotal'] = $row->amount;
			
			if ($this->AccountsClass->Voucher_Validation()) {
				$lastid = $this->AccountsClass->Voucher_Save();
				if ($lastid) {
					$this->AccountsClass->VoucherTransaction_Save($lastid);
				}
			}
		}
		$this->DepositCashVoucher_Save($ledger_Id);
	}
	function CollectionBankVoucher_Save()
	{
	

		 $qry =	'SELECT vol.OfficeLedger_id,tdc.Collection_Id ,
		tc.amount AS amount
		From '.$_SESSION['currentdatabasename'].'.dbo.Trans_Deposit td 
		INNER JOIN cosmo.dbo.Mas_bank mb ON mb.Bank_Id = td.Bank_Id 
INNER JOIN '.$_SESSION['currentdatabasename'].'.dbo.Trans_DepositCollection tdc ON tdc.Deposit_Id = td.Deposit_Id
INNER JOIN '.$_SESSION['currentdatabasename'].'.dbo.Trans_Colletion tc ON tc.Colletion_Id=tdc.Collection_Id
INNER JOIN '.$_SESSION['currentdatabasename'].'.dbo.vw_OfficelegerableList vol ON (vol.LedgerType_Id = 2 AND vol.Against_Id=tc.Dealer_Id) 

			  	WHERE td.Deposit_Id = ' . $_POST['Deposit_Id'] . ' AND td.Deposit_Status_Id = 2';
				
		$query = $this->db->query($qry);
		$res = $query->result();
		$bankledgerqry = 'SELECT vol.OfficeLedger_id FROM '.$_SESSION['currentdatabasename'].'.dbo.vw_OfficelegerableList vol
		INNER JOIN cosmo.dbo.mas_bank mb ON (mb.Bank_Id = vol.Against_Id AND vol.LedgerType_Id=12)
		INNER JOIN '.$_SESSION['currentdatabasename'].'.dbo.trans_deposit td ON td.Bank_Id = mb.Bank_Id
		WHERE td.Deposit_Id = ' . $_POST['Deposit_Id'] . '';
		$bankledgerqry = $this->db->query($bankledgerqry);
		$bankledgerqry = $bankledgerqry->result();
		$ledger_Id = $bankledgerqry[0]->OfficeLedger_id;
		foreach ($res as $row) {
			$_POST['Voucher_Type_Id'] = '7';
			$_POST['Source_Id'] = '1';
			$_POST['VoucherAgainst_Id'] = $row->Collection_Id;
			$_POST['Voucher_date'] = $this->GM->DateSplitwithoutconvert($_POST['Bank_Date']);
			$_POST['AllTransaction_type_Id'] = '4';
			$_POST['Voucher_status_id'] = '1';
			$_POST['description'] = 'RECEIPT';
			$_POST['Reference'] = 'COLLECTION';
			$_POST['Credit'] = array($row->amount, '0');
			$_POST['Debit'] = array('0', $row->amount);
			$_POST['Against_Id'] = array($row->OfficeLedger_id, $ledger_Id); // for cheque
			$_POST['TransactionReference'] = array( 'COLLECTION');
			$_POST['creditotal'] = $row->amount;
			$_POST['debittotal'] = $row->amount;
			if ($this->AccountsClass->Voucher_Validation()) {
				$lastid = $this->AccountsClass->Voucher_Save();
				if ($lastid) {
					$this->AccountsClass->VoucherTransaction_Save($lastid);
				}
			}
		}
	}
	function DepositCashVoucher_Save($ledger_Id)
	{
		$qry =	'SELECT vol.OfficeLedger_id,
		(SELECT SUM(tc.amount) From '.$_SESSION['currentdatabasename'].'.dbo.Trans_DepositCollection tdc
		INNER JOIN '.$_SESSION['currentdatabasename'].'.dbo.Trans_Colletion tc ON tc.Colletion_Id = tdc.Collection_Id
		WHERE tdc.Deposit_Id=td.Deposit_Id ) AS amount
		From '.$_SESSION['currentdatabasename'].'.dbo.Trans_Deposit td 
			   INNER JOIN cosmo.dbo.Mas_bank mb ON mb.Bank_Id = td.Bank_Id
			   INNER JOIN '.$_SESSION['currentdatabasename'].'.dbo.vw_OfficelegerableList vol ON (vol.LedgerType_Id = 12 AND vol.Against_Id=mb.Bank_Id)
				WHERE td.Deposit_Id = ' . $_POST['Deposit_Id'] . ' AND td.Deposit_Status_Id = 2';
		$query = $this->db->query($qry);
		$res = $query->result();
		foreach ($res as $row) {
			//Depositvoucher
			$_POST['Voucher_Type_Id'] = '16';
			$_POST['Source_Id'] = '2';
			$_POST['VoucherAgainst_Id'] =  $_POST['Deposit_Id'];
			$_POST['Voucher_date'] = $this->GM->DateSplitwithoutconvert($_POST['Bank_Date']);
			$_POST['AllTransaction_type_Id'] = '4';
			$_POST['Voucher_status_id'] = '1';
			$_POST['description'] = 'CONTRA';
			$_POST['Reference'] = 'DEPOSIT';
			$_POST['Credit'] = array($row->amount, '0');
			$_POST['Debit'] = array('0', $row->amount);
			$_POST['Against_Id'] = array($ledger_Id, $row->OfficeLedger_id);
			$_POST['TransactionReference'] = array('DEPOSIT', 'DEPOSIT');
			$_POST['creditotal'] = $row->amount;
			$_POST['debittotal'] = $row->amount;
			if ($this->AccountsClass->Voucher_Validation()) {
				$lastid = $this->AccountsClass->Voucher_Save();
				if ($lastid) {
					$this->AccountsClass->VoucherTransaction_Save($lastid);
				}
			}
		}
	}
}
