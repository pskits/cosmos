<?php
class ProductionClass extends CI_Model
{
	function Production_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('office_id', 'office_id', 'required');
		$this->form_validation->set_rules('batchno', 'batchno', 'required');
		$this->form_validation->set_rules('production_date', 'production_date', 'required');
		$this->form_validation->set_rules('description', 'description', 'required');
		$this->form_validation->set_rules('terms', 'terms', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data = array('But' => $_POST['Abut'], 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
			$this->session->set_flashdata('msgU', "Please Fill in all Required Data's");
			$this->load->view('Production/ProductionProducts', $data);
		} else {
			return true;
		}
	}
	function Production_Save()
	{
		$qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_Production '" . $_POST['office_id'] . "'
		,'" . $_POST['batchno'] . "'
		,'" . $this->GM->DateSplit($_POST['production_date']) . "'
		,'" . $_POST['description'] . "'
		,'" . $_POST['terms'] . "'
		,'" . $_POST['User_Id'] . "'
		,'1'
		,'" . $_POST['Abut'] . "'
		";
		$query = $this->db->query($qry);
	
		if ($query) {
			$query = $query->result();
			foreach ($query as $Row) {
				$lastid =  $Row->LastID;
			}
			$redirecturl = site_url('Production/ProductionProducts');
			echo "<script>window.location='$redirecturl/?Key=" . base64_encode($lastid) . "'</script>";
		} else {
			$err = $this->db->error();
			$err = $err['message'];
			$data = "The duplicate key value is";
			if (($out = strpos($err, "$data")) !== FALSE) {
				$Values_of_the_Message = substr($err, strpos($err, "$data") + 26);
				$this->session->set_flashdata('msgU', "$Values_of_the_Message Same Data Already Exist");
			} else {
				$this->session->set_flashdata('msgU', "Same Data Already Exist");
			}
			$data = array('But' => $_POST['Abut'], 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
			$this->load->view('Production/Production', $data);
		}
	}
	//ProductionProduct
	function ProductionProducts_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('production_id', 'production_id', 'required');
		$this->form_validation->set_rules('category_id', 'category_id', 'required');
		$this->form_validation->set_rules('product_id', 'product_id', 'required');
		$this->form_validation->set_rules('serial_no[]', 'serial_no', 'all_unique');
		if (is_array($_REQUEST['serial_no'])) {
			foreach ($_REQUEST['serial_no'] as $key => $value) {
				$this->form_validation->set_rules('serial_no[' . $key . ']', 'Something', 'required|xss_clean');
			}
		}
		function all_unique()
		{
			$array = $_REQUEST['serial_no'];
			if (count(array_unique($array)) < count($array)) {
				return FALSE;
			} else {
				return TRUE;
			}
		}
		if ($this->form_validation->run() == FALSE) {
			$data = array('But' => $_POST['Abut'], 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
			$this->session->set_flashdata('msgU', "Please Fill in all Required Data's");
			$redirecturl = site_url('Production/ProductionProducts');
			echo "<script>window.location='$redirecturl/?Key=" . base64_encode($_REQUEST['production_id']) . "'</script>";
		} else {
			return true;
		}
	}
	function ProductionProducts_Save()
	{
		foreach ($_REQUEST['serial_no'] as $key => $value) {
			$qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_ProductionProduct '" . $_POST['production_id'] . "'
	,'" . $_POST['category_id'] . "'
	,'" . $_POST['product_id'] . "'
	,'" . $value . "'
	,'" . $_POST['User_Id'] . "'
	,'1'
	,'SAVE'
	";
			$query = $this->GM->prdinsert($qry);
		}
		if ($query) {
			$this->session->set_flashdata('msgS', "Saved Successfully");
		} else {
			$err = $this->db->error();
			$err = $err['message'];
			$data = "The duplicate key value is";
			if (($out = strpos($err, "$data")) !== FALSE) {
				$Values_of_the_Message = substr($err, strpos($err, "$data") + 26);
				$this->session->set_flashdata('msgU', "$Values_of_the_Message Same Data Already Exist for another User");
			} else {
				$this->session->set_flashdata('msgU', "Same Data Already Exist");
			}
		}
		$redirecturl = site_url('Production/ProductionProducts');
		echo "<script>window.location='$redirecturl/?Key=" . base64_encode($_REQUEST['production_id']) . "'</script>";
	}
	//productioncomplete
	function ProductionProductsComplete_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('production_id', 'production_id', 'required');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('Abut', 'Abut', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data = array('But' => $_POST['Abut'], 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
			$this->session->set_flashdata('msgU', "Please Fill in all Required Data's");
			$redirecturl = site_url('Production/ProductionProducts');
			echo "<script>window.location='$redirecturl/?Key=" . base64_encode($_REQUEST['production_id']) . "'</script>";
		} else {
			return true;
		}
	}
	function ProductionProductsComplete_Save()
	{
			$qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_ProductionComplete '" . $_POST['production_id'] . "'	
	,'" . $_POST['User_Id'] . "'
	,'" . $_POST['Abut'] . "'
	";
			$query = $this->GM->prdinsert($qry);
		
		if ($query) {
			$this->session->set_flashdata('msgS', "Saved Successfully");
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
		$redirecturl = site_url('Production/ProductionProducts');
		echo "<script>window.location='$redirecturl/?Key=" . base64_encode($_REQUEST['production_id']) . "'</script>";
	}
	//ApprovedPurchaseOrder
	function ApprovedPurchaseOrder_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('officedbname', 'officedbname', 'required');
		$this->form_validation->set_rules('PurchaseOrder_Id', 'PurchaseOrder_Id', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', "Please Fill in all Required Data's");
			$redirecturl = site_url('Production/ApprovedPurchaseOrderProducts');
			echo "<script>window.location='$redirecturl/?Key=" . base64_encode($_POST['officedbname']) . "&id=" . base64_encode($_POST['PurchaseOrder_Id']) . "';</script>";
		} else {
			return true;
		}
	}
	function ApprovedPurchaseOrder_Save()
	{
		$qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_ApprovedPurchaseOrder '" . $_POST['PurchaseOrder_Id'] . "'
		,'" . $_POST['officedbname'] . "'			
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
			$this->session->set_flashdata('msgS', "Sussessfully Saved");
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
		$redirecturl = site_url('Production/ApprovedPurchaseOrderProducts');
		echo "<script>window.location='$redirecturl/?Key=" . base64_encode($_POST['officedbname']) . "&id=" . base64_encode($_POST['PurchaseOrder_Id']) . "';</script>";
	}
	//ApprovedPurchaseOrderProducts
	function ApprovedPurchaseOrderProducts_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('PurchaseOrder_Id', 'PurchaseOrder_Id', 'required');
		$this->form_validation->set_rules('officedbname', 'officedbname', 'required');
			
		$this->form_validation->set_rules('serial_no[]', 'serial_no', 'all_unique1');
		if (is_array($_REQUEST['serial_no'])) {
			foreach ($_REQUEST['serial_no'] as $key => $value) {
				$this->form_validation->set_rules('serial_no[' . $key . ']', 'Something', 'required|xss_clean');
			}
		}
		function all_unique1()
		{
			$array = $_REQUEST['serial_no'];
			if (count(array_unique($array)) < count($array)) {
				return FALSE;
			} else {
				return TRUE;
			}
		}
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', "Please Fill in all Required Data's");
			$redirecturl = site_url('Production/ApprovedPurchaseOrderProducts');
			echo "<script>window.location='$redirecturl/'</script>";
		} else {
			return true;
		}
	}
	function ApprovedPurchaseOrderProducts_Save()
	{
		foreach ($_REQUEST['serial_no'] as $key => $value) {
			$qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_ApprovedPurchaseOrderProducts '" . $_POST['PurchaseOrder_Id'] . "'
	,'" . $value . "'
	,'" . $_POST['User_Id'] . "'	
	";

			$query = $this->GM->prdinsert($qry);
		}
		if ($query) {
			$this->session->set_flashdata('msgS', "Saved Successfully");
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
	//ApprovedPurchaseOrderComplete
	function ApprovedPurchaseOrderComplete_Validation()
	{
		
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('ApprovedPurchaseOrder_Id', 'ApprovedPurchaseOrder_Id', 'required');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
        $this->form_validation->set_rules('Abut', 'Abut', 'required');
        $this->form_validation->set_rules('officedbname', 'officedbname', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', "Please Fill in all Required Data's");
		
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function ApprovedPurchaseOrderComplete_Save()
	{
		$qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_ApprovedPurchaseOrderComplete '" . $_POST['ApprovedPurchaseOrder_Id'] . "'	
	,'" . $_POST['User_Id'] . "'
	,'" . $_POST['Abut'] . "'
	,'" . $_POST['officedbname'] . "'
	";
	
			$query = $this->GM->prdinsert($qry);
		
		if ($query) {
			$this->session->set_flashdata('msgS', "Saved Successfully");
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
}
