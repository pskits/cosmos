<?php
class PurchaseClass extends CI_Model
{
	/// Supplier Entry
	function Supplier_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('short_name', 'short_name', 'required');
		$this->form_validation->set_rules('registration_no', 'registration_no', 'required');
		$this->form_validation->set_rules('Email', 'Email', 'required');
		$this->form_validation->set_rules('code', 'code', 'required');
		$this->form_validation->set_rules('MobileNo', 'MobileNo', 'required');
		$this->form_validation->set_rules('Address', 'Address', 'required');
		$this->form_validation->set_rules('City', 'City', 'required');
		$this->form_validation->set_rules('Country_Id', 'Country_Id', 'required');
		$this->form_validation->set_rules('Currency_Id', 'Currency_Id', 'required');
		$this->form_validation->set_rules('State_Id', 'State_Id', 'required');
		$this->form_validation->set_rules('Postcode', 'Postcode', 'required');
		$this->form_validation->set_rules('lat', 'lat', 'required');
		$this->form_validation->set_rules('lng', 'lng', 'required');
		$this->form_validation->set_rules('Tax_No', 'Tax_No', 'required');
		$this->form_validation->set_rules('Salut_Id', 'Salut_Id', 'required');
		$this->form_validation->set_rules('Firstname', 'Firstname', 'required');
		$this->form_validation->set_rules('Lastname', 'Lastname', 'required');
		$this->form_validation->set_rules('contact_mobile', 'contact_mobile', 'required');
		$this->form_validation->set_rules('contact_email', 'contact_email', 'required');
		if ($_REQUEST['Abut'] == 'Update') {
			$this->form_validation->set_rules('Supplier_Id', 'Supplier_Id', 'required');
		}
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', 'Fill in All Required Details');
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function Supplier_Save()
	{
		$qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_Supplier '" . $_POST['name'] . "'
		,'" . $_POST['short_name'] . "'
		,'" . $_POST['registration_no'] . "'
		,'" . $_POST['Email'] . "'
		,'" . $_POST['code'] . "'
		,'" . $_POST['MobileNo'] . "'
		,'" . $_POST['Address'] . "'
		,'" . $_POST['City'] . "'
		,'" . $_POST['State_Id'] . "'
		,'" . $_POST['Country_Id'] . "'
		,'" . $_POST['Currency_Id'] . "'	
		,'" . $_POST['Postcode'] . "'
		,'" . $_POST['Tax_No'] . "'
		,'" . $_POST['lat'] . "'
		,'" . $_POST['lng'] . "'
		,'" . $_POST['Salut_Id'] . "'
		,'" . $_POST['Firstname'] . "'
		,'" . $_POST['Lastname'] . "'
		,'" . $_POST['contact_mobile'] . "'
		,'" . $_POST['contact_email'] . "'
		,'" . $_POST['User_Id'] . "'
		,'1'
		,'" . $_POST['Abut'] . "'
		,'" . $_POST['Supplier_Id'] . "'
		";
		$query = $this->db->query($qry);
		if ($query) {
			$this->session->set_flashdata('msgS', 'Success!!!');
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
		}
		echo "<script> history.go(-1);</script>";
	}
	// Supplier Entry
	function PurchaseOrder_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('Warehouse_Id', 'Warehouse_Id', 'required');
		$this->form_validation->set_rules('PurchaseOrder_Supplier_Id', 'PurchaseOrder_Supplier_Id', 'required');
		$this->form_validation->set_rules('PurchaseOrder_Date', 'PurchaseOrder_Date', 'required');
		$this->form_validation->set_rules('PurchaseOrder_ExpectedDate', 'PurchaseOrder_ExpectedDate', 'required');
		$this->form_validation->set_rules('PurchaseOrder_PaymentTerms', 'PurchaseOrder_PaymentTerms', 'required');
		$this->form_validation->set_rules('PurchaseOrder_reference', 'PurchaseOrder_reference', 'required');
		$this->form_validation->set_rules('PurchaseOrder__Subtotal', 'PurchaseOrder__Subtotal', 'required');
		$this->form_validation->set_rules('PurchaseOrder_TotalDiscountAmount', 'PurchaseOrder_TotalDiscountAmount', 'required');
		$this->form_validation->set_rules('PurchaseOrder_TotalTaxAmount', 'PurchaseOrder_TotalTaxAmount', 'required');
		$this->form_validation->set_rules('PurchaseOrder_TotalFrightAmount', 'PurchaseOrder_TotalFrightAmount', 'required');
		$this->form_validation->set_rules('PurchaseOrder_TotalInsuranceAmount', 'PurchaseOrder_TotalInsuranceAmount', 'required');
		$this->form_validation->set_rules('PurchaseOrder_GrandTotalAmount', 'PurchaseOrder_GrandTotalAmount', 'required');
		$this->form_validation->set_rules('PurchaseOrder_terms', 'PurchaseOrder_terms', 'required');
		$this->form_validation->set_rules('PurchaseOrder_Description', 'PurchaseOrder_Description', 'required');
		if ($_REQUEST['Abut'] == 'Update') {
			$this->form_validation->set_rules('PurchaseOrder_Id', 'PurchaseOrder_Id', 'required');
		}
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', 'Fill in All Required Details');
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function PurchaseOrder_Save()
	{
		$PurchaseOrder_ExpectedDate = $this->GM->DateSplit($_POST['PurchaseOrder_ExpectedDate']);
		$PurchaseOrder_Date = $this->GM->DateSplit($_POST['PurchaseOrder_Date']);
		$qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_TransPurchaseOrder '" . $_POST['PurchaseOrder_Supplier_Id'] . "'
		,'" . $_POST['Warehouse_Id'] . "'
		,'" . $PurchaseOrder_Date . "'
		,'" . $PurchaseOrder_ExpectedDate . "'
		,'" . $_POST['PurchaseOrder_PaymentTerms'] . "'
		,'" . $_POST['PurchaseOrder_reference'] . "'
		,'" . $_POST['PurchaseOrder__Subtotal'] . "'
		,'" . $_POST['PurchaseOrder_TotalDiscountAmount'] . "'
		,'" . $_POST['PurchaseOrder_TotalTaxAmount'] . "'
		,'" . $_POST['PurchaseOrder_TotalFrightAmount'] . "'
		,'" . $_POST['PurchaseOrder_TotalInsuranceAmount'] . "'
		,'" . $_POST['PurchaseOrder_GrandTotalAmount'] . "'
		,'" . $_POST['PurchaseOrder_terms'] . "'
		,'" . $_POST['PurchaseOrder_Description'] . "'
		,'1'
		,'" . $_POST['User_Id'] . "'
		,'1'
		,'" . $_POST['Abut'] . "'
		,'" . $_POST['PurchaseOrder_Id'] . "'
		"; 
		
		$query = $this->db->query($qry);
		$query = $query->result();
		foreach ($query as $Row) {
			 $lastid =  $Row->LastID;
		}
		
		if ($lastid) {
			$Trans_PurchaseOrderProduct_Product_Id = $_POST['Product_Id'];
			$Trans_PurchaseOrderProduct_Quantity = $_POST['Qty'];
			$Trans_PurchaseOrderProduct_Rate = $_POST['Rate'];
			$Trans_PurchaseOrderProduct_DiscountType_Id = $_POST['Discounttype'];
			$Trans_PurchaseOrderProduct_Discount = $_POST['Discount'];
			$Trans_PurchaseOrderProduct_Tax_Id = $_POST['Tax'];
			$Trans_PurchaseOrderProduct_Taxcost = $_POST['Taxamount'];
			$Trans_PurchaseOrderProduct_Grandtotal = $_POST['productamount'];
			$Trans_PurchaseOrderProduct_Description = $_POST['productdesc'];
			$prdquery = "0";
				$prdqry = "";
			foreach ($Trans_PurchaseOrderProduct_Product_Id as $key => $n) {
				
				$prdqry .= "Exec ".$_SESSION['currentdatabasename'].".dbo.Exec_TransPurchaseOrderProduct '" . $lastid . "'
						,'" . $Trans_PurchaseOrderProduct_Product_Id[$key] . "'
						,'" . $Trans_PurchaseOrderProduct_Quantity[$key] . "'
						,'" . $Trans_PurchaseOrderProduct_Rate[$key] . "'
						,'" . $Trans_PurchaseOrderProduct_DiscountType_Id[$key] . "'
						,'" . $Trans_PurchaseOrderProduct_Discount[$key] . "'
						,'" . $Trans_PurchaseOrderProduct_Tax_Id[$key] . "'
						,'" . $Trans_PurchaseOrderProduct_Taxcost[$key] . "'
						,'" . $Trans_PurchaseOrderProduct_Grandtotal[$key] . "'
						,'" . $Trans_PurchaseOrderProduct_Description[$key] . "'
						,'" . $_POST['User_Id'] . "'
						,'1'
						,'" . $_POST['Abut'] . "';
						";
				
			}
			//echo $prdqry;exit;
			$prdquery = $this->db->query($prdqry);
			if ($prdquery) {
				$this->session->set_flashdata('msgS', 'Success!!!');
				redirect("Purchase/PurchaseOrder");
			} else {
				$dltqry = "";
				$this->db->query($dltqry);
				$this->session->set_flashdata('msgU', 'Not Saved !!!');
				redirect("Purchase/PurchaseOrder");
			}
		} else {
			$err = $this->db->error();
			$err = $err['message'];
			$data = "The duplicate key value is";
			if (($out = strpos($err, "$data")) !== FALSE) {
				$Values_of_the_Message = substr($err, strpos($err, "$data") + 26);
				$this->session->set_flashdata('msgU', "$Values_of_the_Message Same Data Already Exist for another User");
			} else {
				$this->session->set_flashdata('msgU', "Not Saved");
			}
			$data = array('But' => $_POST['Abut'], 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
			$this->load->view('Purchase/PurchaseOrder', $data);
		}
	}
	//purchaseorderentry
	function PurchaseOrderstatus_Save()
	{
		if ((!isset($_GET['Key'])) && (!isset($_GET['s']))) {
			redirect("Purchase/purchaseorder");
		}
		$id = $this->session->userdata['cosmolog']['UId'];
		$key = $_GET['Key'];
		$qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_TransPurchaseOrderStatus '" . $key . "'
	,'" . $_GET['s'] . "'
	,'" . $id . "'
	";
		$query = $this->db->query($qry);
		if ($query) {
			$this->session->set_flashdata('msgS', 'Success!!!');
			redirect("Purchase/purchaseorder_invoice/?Key=" . base64_encode($key) . "");
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
			$data = array('Emsg' => $err);
			redirect("Purchase/purchaseorder_invoice/?Key=" . base64_encode($key) . "", $data);
		}
	}
	function Bill_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('Bill_Supplier_Id', 'Bill_Supplier_Id', 'required');
		$this->form_validation->set_rules('Bill_Date', 'Bill_Date', 'required');
		$this->form_validation->set_rules('Bill_DueDate', 'Bill_DueDate', 'required');
		$this->form_validation->set_rules('Invoice_no', 'Invoice_no', 'required');
		$this->form_validation->set_rules('Bill_Reference', 'Reference', 'required');
		$this->form_validation->set_rules('Bill_Subtotal', 'Bill__Subtotal', 'required');
		$this->form_validation->set_rules('Bill_TotalDiscountAmount', 'Bill_TotalDiscountAmount', 'required');
		$this->form_validation->set_rules('Bill_TotalTaxAmount', 'Bill_TotalTaxAmount', 'required');
		$this->form_validation->set_rules('Bill_GrandTotalAmount', 'Bill_GrandTotalAmount', 'required');
		$this->form_validation->set_rules('Bill_terms', 'Bill_terms', 'required');
		$this->form_validation->set_rules('Bill_Description', 'Bill_Description', 'required');
		$this->form_validation->set_rules('PurchaseOrder_Id', 'PurchaseOrder_Id', 'required');
		$this->form_validation->set_rules('Fright', 'Fright', 'required');
		$this->form_validation->set_rules('Insurance', 'Insurance', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', "Please Fill all Required Details");
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function Bill_Save()
	{
		$Bill_Date = $this->GM->DateSplit($_POST['Bill_Date']);
		$Bill_DueDate = $this->GM->DateSplit($_POST['Bill_DueDate']);
		$qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_TransBill '" . $_POST['PurchaseOrder_Id'] . "'			
		,'" . $_POST['Bill_Supplier_Id'] . "'
		,'" . $Bill_Date . "'
		,'" . $Bill_DueDate . "'
		,'" . $_POST['Invoice_no'] . "'
		,'" . $_POST['Bill_Reference'] . "'
		,'" . $_POST['Bill_Subtotal'] . "'
		,'" . $_POST['Bill_TotalDiscountAmount'] . "'
		,'" . $_POST['Bill_TotalTaxAmount'] . "'
			,'" . $_POST['Fright'] . "'
				,'" . $_POST['Insurance'] . "'
		,'" . $_POST['Bill_GrandTotalAmount'] . "'
		,'" . $_POST['Bill_terms'] . "'
		,'" . $_POST['Bill_Description'] . "'
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
			$prdquery = "0";
				$prdqry = "";
			$Trans_PurchaseOrderProduct_Product = $_POST['Product'];
			$Trans_BillProduct_Ledger_Id = $_POST['ledger_id'];
			$Trans_PurchaseOrderProduct_Quantity = $_POST['Qty'];
			$Trans_PurchaseOrderProduct_Rate = $_POST['Rate'];
			$Trans_PurchaseOrderProduct_DiscountType_Id = $_POST['Discounttype'];
			$Trans_PurchaseOrderProduct_Discount = $_POST['Discount'];
			$Trans_PurchaseOrderProduct_Tax_Id = $_POST['Tax'];
			$Trans_PurchaseOrderProduct_Taxcost = $_POST['Taxamount'];
			$Trans_PurchaseOrderProduct_Grandtotal = $_POST['productamount'];
			$Trans_PurchaseOrderProduct_Description = $_POST['productdesc'];
			foreach ($Trans_PurchaseOrderProduct_Product as $key => $n) {
				
				$prdqry .= "Exec ".$_SESSION['currentdatabasename'].".dbo.Exec_TransBillProduct '" . $lastid . "'
	,'" . $Trans_PurchaseOrderProduct_Product[$key] . "'
	,'" . $Trans_BillProduct_Ledger_Id[$key] . "'
	,'" . $Trans_PurchaseOrderProduct_Quantity[$key] . "'
	,'" . $Trans_PurchaseOrderProduct_Rate[$key] . "'
	,'" . $Trans_PurchaseOrderProduct_DiscountType_Id[$key] . "'
	,'" . $Trans_PurchaseOrderProduct_Discount[$key] . "'
	,'" . $Trans_PurchaseOrderProduct_Tax_Id[$key] . "'
	,'" . $Trans_PurchaseOrderProduct_Taxcost[$key] . "'
	,'" . $Trans_PurchaseOrderProduct_Grandtotal[$key] . "'
	,'" . $Trans_PurchaseOrderProduct_Description[$key] . "'
	,'" . $_POST['User_Id'] . "'
	,'1'
	,'" . $_POST['Abut'] . "';
	";
				
			}
			$prdqry .="
INSERT INTO ".$_SESSION['currentdatabasename'].".dbo.Trans_AllTransaction 
(OfficeLedger_Id, AgainstType_Id, Against_Id, Transaction_date, amount,  Reference, sorting, Transactions_Status_Id, Status_Id, Created_date, Createdby)
SELECT TOP 1 vol.OfficeLedger_id , 5, tb.Bill_Id, tb.Bill_PurchaseDate, (sum(tbp.Trans_BillProduct_Taxcost)*-1), 'BILL', 1, 1, 1, getdate(), '" . $_POST['User_Id'] . "' FROM 
		 ".$_SESSION['currentdatabasename'].".dbo.Trans_Bill	 tb
		 INNER JOIN ".$_SESSION['currentdatabasename'].".dbo.Trans_BillProduct tbp  ON tbp.Trans_Bill_Id=tb.Bill_Id
		 INNER JOIN ".$_SESSION['currentdatabasename'].".dbo.vw_OfficelegerableList vol ON 
		 (vol.LedgerType_Id=15 AND vol.Against_Id= tbp.Trans_BillProduct_Tax_Id)
		 WHERE Bill_Id='" . $lastid . "' AND vol.OfficeLedger_id NOT IN (SELECT vat.OfficeLedger_Id FROM ".$_SESSION['currentdatabasename'].".dbo.Trans_AllTransaction vat 
		 WHERE vat.AgainstType_Id=5 AND vat.Against_Id=tb.Bill_Id)
		 GROUP BY  vol.OfficeLedger_id ,tb.Bill_Id, tb.Bill_PurchaseDate";
			//echo $prdqry; exit;
			$prdquery = $this->db->query($prdqry);
			if ($prdquery) {
				$this->session->set_flashdata('msgS', 'Success!!!');
				//$this->BillVoucher_Save($lastid);				
			} else {
				$dltqry = "";
				$this->db->query($dltqry);
				$this->session->set_flashdata('msgU', 'Error Contact System Admin !!!');
				
			}
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
			
		}
		echo "<script> history.go(-1);</script>";
	}
	function Import_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('PurchaseOrder_Id', 'PurchaseOrder_Id', 'required');
		$this->form_validation->set_rules('PurchaseOrder_Supplier_Id', 'PurchaseOrder_Supplier_Id', 'required');
		$this->form_validation->set_rules('Import_Date', 'Import_Date', 'required');
		$this->form_validation->set_rules('Invoice_no', 'Invoice_no', 'required');
		$this->form_validation->set_rules('Conversion_Rate', 'Conversion_Rate', 'required');
		$this->form_validation->set_rules('PurchaseOrder__Subtotal', 'PurchaseOrder__Subtotal', 'required');
		$this->form_validation->set_rules('PurchaseOrder_GrandTotalAmount', 'PurchaseOrder_GrandTotalAmount', 'required');
		$this->form_validation->set_rules('PurchaseOrder_terms', 'PurchaseOrder_terms', 'required');
		$this->form_validation->set_rules('PurchaseOrder_Description', 'PurchaseOrder_Description', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', 'Fill in All Required Details');
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function Import_Save()
	{
		$Import_Date = $this->GM->DateSplit($_POST['Import_Date']);
		$qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_TransImport '" . $_POST['PurchaseOrder_Id'] . "'
		,'" . $Import_Date . "'
		,'" . $_POST['Invoice_no'] . "'
		,'" . $_POST['Conversion_Rate'] . "'
		,'" . $_POST['PurchaseOrder_terms'] . "'
		,'" . $_POST['PurchaseOrder_Description'] . "'
		,'" . $_POST['User_Id'] . "'
		,'1'
		,'" . $_POST['Abut'] . "'
		";
		$query = $this->db->query($qry);
		$query = $query->result();
		if ($query[0]->LastID) {
			$prdqry = "".$_SESSION['currentdatabasename'].".dbo.Exec_TransImportProduct '" . $query[0]->LastID . "'
	,'" . $_POST['PurchaseOrder_Id'] . "'
	,'" . $_POST['Conversion_Rate'] . "'
	,'" . $_POST['User_Id'] . "'
	,'1'
	,'" . $_POST['Abut'] . "'
	";
			$prdquery = $this->GM->prdinsert($prdqry);
			if ($prdquery) {
				$this->session->set_flashdata('msgS', 'Success!!!');
				echo "<script> history.go(-2);</script>";
			} else {
				$this->session->set_flashdata('msgU', 'Error Contact System Admin !!!');
				echo "<script> history.go(-1);</script>";
			}
		} else {
			$this->session->set_flashdata('msgU', 'Error Contact System Admin !!!');
			echo "<script> history.go(-1);</script>";
		}
	}
	function InwardProducts_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('PurchaseOrder_factoryid', 'PurchaseOrder_factoryid', 'required');
		$this->form_validation->set_rules('purchaseorder_Id', 'purchaseorder_Id', 'required');
		$this->form_validation->set_rules('data', 'data', 'required');
		$this->form_validation->set_rules('key', 'key', 'required');
		$this->form_validation->set_rules('enteredserialnocount', 'enteredserialnocount', 'required|matches[dbserialnocount]');
		$this->form_validation->set_rules('dbserialnocount', 'dbserialnocount', 'required|matches[enteredserialnocount]');
		$this->form_validation->set_rules('unmatchcount', 'unmatchcount', 'required|less_than_equal_to[0]|greater_than_equal_to[0]');
		if ($this->form_validation->run() == FALSE) {
			$data = array('But' => $_POST['Abut'], 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
			$this->load->view('Purchase/Inward', $data);
		} else {
			return true;
		}
	}
	function InwardProducts_Save()
	{
		 $qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_goods '" . $_POST['PurchaseOrder_factoryid'] . "'
	,'" . $_POST['purchaseorder_Id'] . "'	
		,'" . $_POST['User_Id'] . "'
	";
		$query = $this->db->query($qry);
		if ($query) {
			$this->session->set_flashdata('msgS', 'Success!!!');
		} else {
			$err = $this->db->error();
			$err = $err['message'];
			$this->session->set_flashdata('msgU', "Same Data Already Exist");
		}
		$redirecturl = site_url("Purchase/purchaseorder_invoice/?Key=" . $_POST['key']);
		echo "<script>window.location='$redirecturl';</script>";
	}
	function ImportVoucher_Save($IMPORTID)
	{
		$qry =	'SELECT vol.OfficeLedger_id,ti.Import_GrandTotalAmount AS amount,ti.Import_Id From '.$_SESSION['currentdatabasename'].'.dbo.trans_import ti
		INNER JOIN '.$_SESSION['currentdatabasename'].'.dbo.mas_supplier ms ON ms.Supplier_Id = ti.Import_Supplier_Id
		INNER JOIN '.$_SESSION['currentdatabasename'].'.dbo.vw_OfficelegerableList vol ON (vol.Against_Id = ms.Supplier_Id AND vol.LedgerType_Id=1)
		WHERE ti.Import_Id = ' . $IMPORTID . '';
		$query = $this->db->query($qry);
		$res = $query->result();
		$cashledgerqry = 'SELECT vol.OfficeLedger_id FROM vw_OfficelegerableList vol
		INNER JOIN cosmo.dbo.Mas_Ledger mb ON (mb.Ledger_Id = vol.Against_Id AND vol.LedgerType_Id=14)		
		WHERE  mb.Ledger_Id= 152';
		$cashledgerqry = $this->db->query($cashledgerqry);
		$cashledgerqry = $cashledgerqry->result();
		$ledger_Id = $cashledgerqry[0]->OfficeLedger_id;
		foreach ($res as $row) {
			$_POST['Voucher_date'] = $_POST['Import_Date'];
			$_POST['AllTransaction_type_Id'] = '1';
			$_POST['Voucher_status_id'] = '1';
			$_POST['Credit'] = array($row->amount, '0');
			$_POST['Debit'] = array('0', $row->amount);
			$_POST['Against_Id'] = array($row->OfficeLedger_id, $ledger_Id);
			$_POST['TransactionReference'] = array('IMPORT', 'IMPORT');
			$_POST['creditotal'] = $row->amount;
			$_POST['debittotal'] = $row->amount;
			$this->AccountsClass->VoucherTransaction_Save($row->Import_Id);
		}
	}
	function BillVoucher_Save($BillID)
	{
		error_reporting(-1);
		echo $qry1 =	"SELECT tb.Bill_Id,
					
		tb.Bill_GrandTotalAmount AS billamount,vol.OfficeLedger_id AS supplierledger_id,
		
		tb.Bill_TotalTaxAmount AS taxamount, 
		(SELECT DISTINCT vol.OfficeLedger_id From ".$_SESSION['currentdatabasename'].".dbo.Trans_BillProduct tbp 
		 INNER JOIN ".$_SESSION['currentdatabasename'].".dbo.vw_OfficelegerableList vol ON 
		 (vol.LedgerType_Id=15 AND vol.Against_Id= tbp.Trans_BillProduct_Tax_Id)
		 WHERE tbp.Trans_Bill_Id=tb.Bill_Id) AS taxofficeledgerid,
		
		tb.Bill_TotalDiscountAmount AS discountamount, 
		(SELECT DISTINCT vol.OfficeLedger_id FROM cosmo.dbo.Mas_ledger ml 
		 INNER JOIN ".$_SESSION['currentdatabasename'].".dbo.vw_OfficelegerableList vol ON 
		 (vol.LedgerType_Id=14 AND vol.Against_Id= 44)) AS discountofficeleder_id,
		 (SELECT DISTINCT isnull(vol.OfficeLedger_id,0) FROM cosmo.dbo.Mas_ledger ml 
		 INNER JOIN ".$_SESSION['currentdatabasename'].".dbo.vw_OfficelegerableList vol ON (vol.LedgerType_Id=14 AND vol.Against_Id= 198)) 
		 AS Frieghtofficeleder_id, tb.fright,
		 (SELECT DISTINCT isnull(vol.OfficeLedger_id,0) FROM cosmo.dbo.Mas_ledger ml 
		 INNER JOIN ".$_SESSION['currentdatabasename'].".dbo.vw_OfficelegerableList vol ON (vol.LedgerType_Id=14 AND vol.Against_Id= 199)) 
		 AS InsuranceofficeLedger_id,tb.insurance
		From ".$_SESSION['currentdatabasename'].".dbo.Trans_Bill tb
			INNER JOIN ".$_SESSION['currentdatabasename'].".dbo.mas_supplier ms ON ms.Supplier_Id = tb.Bill_Supplier_Id
			INNER JOIN ".$_SESSION['currentdatabasename'].".dbo.vw_OfficelegerableList vol ON (vol.Against_Id = ms.Supplier_Id AND vol.LedgerType_Id=1)
			WHERE tb.Bill_Id = " . $BillID . "";
			
		$query1 = $this->db->query($qry1);
		print_r($query1);
		$ress = $query1->result();
		//exit;
		foreach ($ress as $row) {
			$_POST['Voucher_date'] = $_POST['Bill_Date'];
			$_POST['AllTransaction_type_Id'] = '5';
			$_POST['Voucher_status_id'] = '1';
			$_POST['Credit'] = 		array($row->billamount,		'0',					$row->discountamount,'0','0');
			$_POST['Debit'] = 		array('0',			   		 $row->taxamount,		 '0',$row->fright,$row->insurance);
			$_POST['Against_Id'] = array($row->supplierledger_id, $row->taxofficeledgerid, $row->discountofficeleder_id,$row->Frieghtofficeleder_id,$row->InsuranceofficeLedger_id);
			$_POST['TransactionReference'] = array('BILL amount', 'BILL Tax', 'BILL Discount');
			$_POST['creditotal'] = $row->billamount;
			$_POST['debittotal'] = $row->billamount;
			$this->AccountsClass->VoucherTransaction_Save($row->Bill_Id);
		}
		$BillProductqry = 'SELECT tb.Bill_Id,vol.OfficeLedger_id, (mbp.Trans_BillProduct_Quantity*mbp.Trans_BillProduct_Rate)
		 AS amount	From '.$_SESSION['currentdatabasename'].'.dbo.Trans_Bill tb
			INNER JOIN '.$_SESSION['currentdatabasename'].'.dbo.Trans_BillProduct mbp ON mbp.Trans_Bill_Id = tb.Bill_Id    
			INNER JOIN cosmo.dbo.mas_ledger ml ON ml.Ledger_Id = mbp.Trans_BillProduct_OfficeLedger_Id
			INNER JOIN '.$_SESSION['currentdatabasename'].'.dbo.vw_OfficelegerableList vol ON (vol.Against_Id = ml.Ledger_Id AND vol.LedgerType_Id=ml.LedgerType_Id)
			WHERE tb.Bill_Id =' . $BillID . '';
		$BillProductqry = $this->db->query($BillProductqry);
		$BillProductqry = $BillProductqry->result();
		foreach ($BillProductqry as $Product) {
			$_POST['Voucher_date'] = $_POST['Bill_Date'];
			$_POST['AllTransaction_type_Id'] = '5';
			$_POST['Voucher_status_id'] = '1';
			$_POST['Credit'] = 		array('0');
			$_POST['Debit'] = 		array($Product->amount);
			$_POST['Against_Id'] = array($Product->OfficeLedger_id);
			$_POST['TransactionReference'] = array('BILL Product Amount');
			$_POST['creditotal'] = $Product->amount;
			$_POST['debittotal'] = $Product->amount;
			$this->AccountsClass->VoucherTransaction_Save($Product->Bill_Id);
		}
	}
}
