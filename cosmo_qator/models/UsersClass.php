<?php
class UsersClass extends CI_Model
{
	function AllowtoProcess_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
	
		$this->form_validation->set_rules('allowtoprocesstype_id', 'allowtoprocesstype_id', 'required');
		
		$this->form_validation->set_rules('allowtoprocessagainst_id', 'allowtoprocessagainst_id', 'required');
		
		$this->form_validation->set_rules('from_date', 'from_date', 'required');
		$this->form_validation->set_rules('From_time', 'From_time', 'required');
		$this->form_validation->set_rules('to_date', 'to_date', 'required');
		$this->form_validation->set_rules('to_time', 'to_time', 'required');
		$this->form_validation->set_rules('Description', 'Description', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', "Please Fill all Required Details");
            //print_r(validation_errors());
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
		function AllowtoProcess_Save()
	{
		$from_date = $_POST['from_date'] . ' ' . $_POST['From_time'];
		$to_date = $_POST['to_date'] . ' ' . $_POST['to_time'];
			 $qry = $_SESSION['currentdatabasename'].".dbo.Exec_AllowtoProcess '" . $_POST['allowtoprocesstype_id'] . "'
			,'" . $_POST['allowtoprocessagainst_id'] . "'
		,'" . $this->GM->DateTimeSplit($from_date) . "'
		,'" . $this->GM->DateTimeSplit($to_date) . "'
		,'" . $_POST['Description'] . "'
		,'" . $_POST['User_Id'] . "'
		,'1','SAVE'
		";
		$query = $this->db->query($qry);
		if ($query) {
			$MGS = $query->row();
			$message = $MGS->MGS;
			$this->session->set_flashdata('msgS', "$message");			
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
	// User_switchrights Entry
	function User_switchrights_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('UserRole_Id', 'UserRole_Id', 'required');
		$this->form_validation->set_rules('office_dbname', 'office_dbname', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('logincredentials_Id', 'logincredentials_Id', 'required');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', "Please Fill all Required Details");
            echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function User_switchrights_Save()
	{
		$qry = "cosmo.dbo.Create_MultipleLogin " . $_REQUEST['UserRole_Id'] . ',"' . $_REQUEST['office_dbname'] .
			'","' . $_REQUEST['email'] . '",' . $_REQUEST['logincredentials_Id'] .
			',' . $_REQUEST['User_Id'] . ',1';
		$query = $this->db->query($qry);
		if ($query) {
			$MGS = $query->row();
			$message = $MGS->MGS;
			$this->session->set_flashdata('msgS', "$message");
			redirect("Users/User_switchrights");
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
			$data = array('Emsg' => $err, 'But' => $_POST['Abut'], 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
			$this->load->view('Users/User_switchrights_Create', $data);
		}
	}
	// Admin Entry
	function Admin_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('Salut_Id', 'Salut_Id', 'required');
		$this->form_validation->set_rules('firstname', 'firstname', 'required');
		$this->form_validation->set_rules('lastname', 'lastname', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('Password', 'Password', 'required');
		$this->form_validation->set_rules('mobile', 'mobile', 'required');
		$this->form_validation->set_rules('alt_mobile', 'alt_mobile', 'required');
		$this->form_validation->set_rules('nationality', 'nationality', 'required');
		$this->form_validation->set_rules('gender', 'gender', 'required');
		$this->form_validation->set_rules('dateofbirth', 'dateofbirth', 'required');
		$this->form_validation->set_rules('address', 'address', 'required');
		$this->form_validation->set_rules('city', 'city', 'required');
		$this->form_validation->set_rules('postcode', 'postcode', 'required');
		$this->form_validation->set_rules('State_Id', 'State_Id', 'required');
		$this->form_validation->set_rules('Country_Id', 'Country_Id', 'required');
		$this->form_validation->set_rules('Joining_date', 'Joining_date', 'required');
		$this->form_validation->set_rules('Status_Id', 'Status_Id', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', "Please Fill all Required Details");
            echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function Admin_Save()
	{
		if ($_POST['Abut'] == 'Save') {
			$qry = $_SESSION['currentdatabasename'].".dbo.Create_admin '" . $_POST['Salut_Id'] . "'
		,'" . $_POST['firstname'] . "'
		,'" . $_POST['lastname'] . "'
        ,'" . $_POST['email'] . "'
        ,'" . md5($_POST['Password']) . "'	
		,'" . $_POST['mobile'] . "'
		,'" . $_POST['alt_mobile'] . "'
		,'" . $_POST['nationality'] . "'
		,'" . $_POST['gender'] . "'
			,'" . $this->GM->DateSplitwithoutconvert($_POST['dateofbirth']) . "'
		,'" . $_POST['address'] . "'
		,'" . $_POST['city'] . "'
		,'" . $_POST['postcode'] . "'
		,'" . $_POST['State_Id'] . "'
		,'" . $_POST['Country_Id'] . "'
			,'" . $this->GM->DateSplitwithoutconvert($_POST['Joining_date']) . "'
		,''			
		,'" . $_POST['User_Id'] . "'
		,'" . $_POST['Status_Id'] . "'
		";
		} elseif ($_POST['Abut'] == 'Update') {
			$qry = $_SESSION['currentdatabasename'].".dbo.Alter_admin '" . $_POST['Salut_Id'] . "'
	,'" . $_POST['firstname'] . "'
	,'" . $_POST['lastname'] . "'
	,'" . $_POST['email'] . "'
	,'" . md5($_POST['Password']) . "'	
	,'" . $_POST['mobile'] . "'
	,'" . $_POST['alt_mobile'] . "'
	,'" . $_POST['nationality'] . "'
	,'" . $_POST['gender'] . "'
		,'" . $this->GM->DateSplitwithoutconvert($_POST['dateofbirth']) . "'
	,'" . $_POST['address'] . "'
	,'" . $_POST['city'] . "'
	,'" . $_POST['postcode'] . "'
	,'" . $_POST['State_Id'] . "'
	,'" . $_POST['Country_Id'] . "'
		,'" . $this->GM->DateSplitwithoutconvert($_POST['Joining_date']) . "'
	,''			
	,'" . $_POST['User_Id'] . "'
	,'" . $_POST['Status_Id'] . "'
	";
		}
		$query = $this->db->query($qry);
		if ($query) {
			$MGS = $query->row();
			$message = $MGS->MGS;
			$this->session->set_flashdata('msgS', "$message");
			redirect("Users/Admin");
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
			$data = array('Emsg' => $err, 'But' => $_POST['Abut'], 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
			$this->load->view('Users/Admin', $data);
		}
	}
	/// WarehouseIncharge Entry
	function WarehouseIncharge_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('Salut_Id', 'Salut_Id', 'required');
		$this->form_validation->set_rules('firstname', 'firstname', 'required');
		$this->form_validation->set_rules('lastname', 'lastname', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('Password', 'Password', 'required');
		$this->form_validation->set_rules('mobile', 'mobile', 'required');
		$this->form_validation->set_rules('alt_mobile', 'alt_mobile', 'required');
		$this->form_validation->set_rules('nationality', 'nationality', 'required');
		$this->form_validation->set_rules('gender', 'gender', 'required');
		$this->form_validation->set_rules('dateofbirth', 'dateofbirth', 'required');
		$this->form_validation->set_rules('address', 'address', 'required');
		$this->form_validation->set_rules('city', 'city', 'required');
		$this->form_validation->set_rules('postcode', 'postcode', 'required');
		$this->form_validation->set_rules('State_Id', 'State_Id', 'required');
		$this->form_validation->set_rules('Country_Id', 'Country_Id', 'required');
		$this->form_validation->set_rules('Joining_date', 'Joining_date', 'required');
		$this->form_validation->set_rules('Status_Id', 'Status_Id', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', "Please Fill all Required Details");
            echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function WarehouseIncharge_Save()
	{
		if ($_POST['Abut'] == 'Save') {
			$qry = $_SESSION['currentdatabasename'].".dbo.Create_WarehouseIncharge '" . $_POST['Salut_Id'] . "'
		,'" . $_POST['firstname'] . "'
		,'" . $_POST['lastname'] . "'
        ,'" . $_POST['email'] . "'
        ,'" . md5($_POST['Password']) . "'	
		,'" . $_POST['mobile'] . "'
		,'" . $_POST['alt_mobile'] . "'
		,'" . $_POST['nationality'] . "'
		,'" . $_POST['gender'] . "'
			,'" . $this->GM->DateSplitwithoutconvert($_POST['dateofbirth']) . "'
		,'" . $_POST['address'] . "'
		,'" . $_POST['city'] . "'
		,'" . $_POST['postcode'] . "'
		,'" . $_POST['State_Id'] . "'
		,'" . $_POST['Country_Id'] . "'
			,'" . $this->GM->DateSplitwithoutconvert($_POST['Joining_date']) . "'
		,''			
		,'" . $_POST['User_Id'] . "'
		,'" . $_POST['Status_Id'] . "'
		";
		} elseif ($_POST['Abut'] == 'Update') {
			$qry = $_SESSION['currentdatabasename'].".dbo.Alter_WarehouseIncharge '" . $_POST['Salut_Id'] . "'
	,'" . $_POST['firstname'] . "'
	,'" . $_POST['lastname'] . "'
	,'" . $_POST['email'] . "'
	,'" . md5($_POST['Password']) . "'	
	,'" . $_POST['mobile'] . "'
	,'" . $_POST['alt_mobile'] . "'
	,'" . $_POST['nationality'] . "'
	,'" . $_POST['gender'] . "'
		,'" . $this->GM->DateSplitwithoutconvert($_POST['dateofbirth']) . "'
	,'" . $_POST['address'] . "'
	,'" . $_POST['city'] . "'
	,'" . $_POST['postcode'] . "'
	,'" . $_POST['State_Id'] . "'
	,'" . $_POST['Country_Id'] . "'
		,'" . $this->GM->DateSplitwithoutconvert($_POST['Joining_date']) . "'
	,''			
	,'" . $_POST['User_Id'] . "'
	,'" . $_POST['Status_Id'] . "'
	";
		}
		$query = $this->db->query($qry);
		if ($query) {
			$MGS = $query->row();
			$message = $MGS->MGS;
			$this->session->set_flashdata('msgS', "$message");
			redirect("Users/WarehouseIncharge");
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
			$data = array('Emsg' => $err, 'But' => $_POST['Abut'], 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
			$this->load->view('Users/WarehouseIncharge', $data);
		}
	}
	
	/// WarehouseManager Entry
	function WarehouseManager_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('Salut_Id', 'Salut_Id', 'required');
		$this->form_validation->set_rules('firstname', 'firstname', 'required');
		$this->form_validation->set_rules('lastname', 'lastname', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('Password', 'Password', 'required');
		$this->form_validation->set_rules('mobile', 'mobile', 'required');
		$this->form_validation->set_rules('alt_mobile', 'alt_mobile', 'required');
		$this->form_validation->set_rules('nationality', 'nationality', 'required');
		$this->form_validation->set_rules('gender', 'gender', 'required');
		$this->form_validation->set_rules('dateofbirth', 'dateofbirth', 'required');
		$this->form_validation->set_rules('address', 'address', 'required');
		$this->form_validation->set_rules('city', 'city', 'required');
		$this->form_validation->set_rules('postcode', 'postcode', 'required');
		$this->form_validation->set_rules('State_Id', 'State_Id', 'required');
		$this->form_validation->set_rules('Country_Id', 'Country_Id', 'required');
		$this->form_validation->set_rules('Joining_date', 'Joining_date', 'required');
		$this->form_validation->set_rules('Status_Id', 'Status_Id', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', "Please Fill all Required Details");
            echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function WarehouseManager_Save()
	{
		if ($_POST['Abut'] == 'Save') {
			$qry = $_SESSION['currentdatabasename'].".dbo.Create_WarehouseManager '" . $_POST['Salut_Id'] . "'
		,'" . $_POST['firstname'] . "'
		,'" . $_POST['lastname'] . "'
        ,'" . $_POST['email'] . "'
        ,'" . md5($_POST['Password']) . "'	
		,'" . $_POST['mobile'] . "'
		,'" . $_POST['alt_mobile'] . "'
		,'" . $_POST['nationality'] . "'
		,'" . $_POST['gender'] . "'
			,'" . $this->GM->DateSplitwithoutconvert($_POST['dateofbirth']) . "'
		,'" . $_POST['address'] . "'
		,'" . $_POST['city'] . "'
		,'" . $_POST['postcode'] . "'
		,'" . $_POST['State_Id'] . "'
		,'" . $_POST['Country_Id'] . "'
			,'" . $this->GM->DateSplitwithoutconvert($_POST['Joining_date']) . "'
		,''			
		,'" . $_POST['User_Id'] . "'
		,'" . $_POST['Status_Id'] . "'
		";
		} elseif ($_POST['Abut'] == 'Update') {
			$qry = $_SESSION['currentdatabasename'].".dbo.Alter_WarehouseManager '" . $_POST['Salut_Id'] . "'
	,'" . $_POST['firstname'] . "'
	,'" . $_POST['lastname'] . "'
	,'" . $_POST['email'] . "'
	,'" . md5($_POST['Password']) . "'	
	,'" . $_POST['mobile'] . "'
	,'" . $_POST['alt_mobile'] . "'
	,'" . $_POST['nationality'] . "'
	,'" . $_POST['gender'] . "'
		,'" . $this->GM->DateSplitwithoutconvert($_POST['dateofbirth']) . "'
	,'" . $_POST['address'] . "'
	,'" . $_POST['city'] . "'
	,'" . $_POST['postcode'] . "'
	,'" . $_POST['State_Id'] . "'
	,'" . $_POST['Country_Id'] . "'
		,'" . $this->GM->DateSplitwithoutconvert($_POST['Joining_date']) . "'
	,''			
	,'" . $_POST['User_Id'] . "'
	,'" . $_POST['Status_Id'] . "'
	";
		}
		$query = $this->db->query($qry);
		if ($query) {
			$MGS = $query->row();
			$message = $MGS->MGS;
			$this->session->set_flashdata('msgS', "$message");
			redirect("Users/WarehouseManager");
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
			$data = array('Emsg' => $err, 'But' => $_POST['Abut'], 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
			$this->load->view('Users/WarehouseManager', $data);
		}
	}
	
	/// SalesExecutve Entry
	function SalesExecutve_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('Salut_Id', 'Salut_Id', 'required');
		$this->form_validation->set_rules('firstname', 'firstname', 'required');
		$this->form_validation->set_rules('lastname', 'lastname', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('Password', 'Password', 'required');
		$this->form_validation->set_rules('mobile', 'mobile', 'required');
		$this->form_validation->set_rules('alt_mobile', 'alt_mobile', 'required');
		$this->form_validation->set_rules('nationality', 'nationality', 'required');
		$this->form_validation->set_rules('gender', 'gender', 'required');
		$this->form_validation->set_rules('dateofbirth', 'dateofbirth', 'required');
		$this->form_validation->set_rules('address', 'address', 'required');
		$this->form_validation->set_rules('city', 'city', 'required');
		$this->form_validation->set_rules('postcode', 'postcode', 'required');
		$this->form_validation->set_rules('State_Id', 'State_Id', 'required');
		$this->form_validation->set_rules('Country_Id', 'Country_Id', 'required');
		$this->form_validation->set_rules('Joining_date', 'Joining_date', 'required');
		$this->form_validation->set_rules('Status_Id', 'Status_Id', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', "Please Fill all Required Details");
            echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function SalesExecutve_Save()
	{
		if ($_POST['Abut'] == 'Save') {
			$qry = $_SESSION['currentdatabasename'].".dbo.Create_SalesExecutve '" . $_POST['Salut_Id'] . "'
		,'" . $_POST['firstname'] . "'
		,'" . $_POST['lastname'] . "'
        ,'" . $_POST['email'] . "'
        ,'" . md5($_POST['Password']) . "'	
		,'" . $_POST['mobile'] . "'
		,'" . $_POST['alt_mobile'] . "'
		,'" . $_POST['nationality'] . "'
		,'" . $_POST['gender'] . "'
		,'" . $this->GM->DateSplitwithoutconvert($_POST['dateofbirth']) . "'
		,'" . $_POST['address'] . "'
		,'" . $_POST['city'] . "'
		,'" . $_POST['postcode'] . "'
		,'" . $_POST['State_Id'] . "'
		,'" . $_POST['Country_Id'] . "'
		,'" . $this->GM->DateSplitwithoutconvert($_POST['Joining_date']) . "'
		,''					
			,'" . $_POST['Status_Id'] . "'	
		,'" . $_POST['User_Id'] . "'
		";
		} elseif ($_POST['Abut'] == 'Update') {
			$qry = $_SESSION['currentdatabasename'].".dbo.Alter_SalesExecutve '" . $_POST['Salut_Id'] . "'
	,'" . $_POST['firstname'] . "'
	,'" . $_POST['lastname'] . "'
	,'" . $_POST['email'] . "'
	,'" . md5($_POST['Password']) . "'	
	,'" . $_POST['mobile'] . "'
	,'" . $_POST['alt_mobile'] . "'
	,'" . $_POST['nationality'] . "'
	,'" . $_POST['gender'] . "'
		,'" . $this->GM->DateSplitwithoutconvert($_POST['dateofbirth']) . "'
	,'" . $_POST['address'] . "'
	,'" . $_POST['city'] . "'
	,'" . $_POST['postcode'] . "'
	,'" . $_POST['State_Id'] . "'
	,'" . $_POST['Country_Id'] . "'	
	,'" . $this->GM->DateSplitwithoutconvert($_POST['Joining_date']) . "'	
	,''			
	,'" . $_POST['User_Id'] . "'
	,'" . $_POST['Status_Id'] . "'
	";
		}
		// echo $qry; exit;
		$query = $this->db->query($qry);
		if ($query) {
			$MGS = $query->row();
			$message = $MGS->MGS;
			$this->session->set_flashdata('msgS', "$message");
			redirect("Users/SalesExecutve");
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
			$data = array('Emsg' => $err, 'But' => $_POST['Abut'], 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
			$this->load->view('Users/SalesExecutve', $data);
		}
	}
	
	/// SalesManager Entry
	function SalesManager_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('Salut_Id', 'Salut_Id', 'required');
		$this->form_validation->set_rules('firstname', 'firstname', 'required');
		$this->form_validation->set_rules('lastname', 'lastname', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('Password', 'Password', 'required');
		$this->form_validation->set_rules('mobile', 'mobile', 'required');
		$this->form_validation->set_rules('alt_mobile', 'alt_mobile', 'required');
		$this->form_validation->set_rules('nationality', 'nationality', 'required');
		$this->form_validation->set_rules('gender', 'gender', 'required');
		$this->form_validation->set_rules('dateofbirth', 'dateofbirth', 'required');
		$this->form_validation->set_rules('address', 'address', 'required');
		$this->form_validation->set_rules('city', 'city', 'required');
		$this->form_validation->set_rules('postcode', 'postcode', 'required');
		$this->form_validation->set_rules('State_Id', 'State_Id', 'required');
		$this->form_validation->set_rules('Country_Id', 'Country_Id', 'required');
		$this->form_validation->set_rules('Joining_date', 'Joining_date', 'required');
		$this->form_validation->set_rules('Status_Id', 'Status_Id', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', "Please Fill all Required Details");
            echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function SalesManager_Save()
	{
		if ($_POST['Abut'] == 'Save') {
			$qry = $_SESSION['currentdatabasename'].".dbo.Create_SalesManager '" . $_POST['Salut_Id'] . "'
		,'" . $_POST['firstname'] . "'
		,'" . $_POST['lastname'] . "'
        ,'" . $_POST['email'] . "'
        ,'" . md5($_POST['Password']) . "'	
		,'" . $_POST['mobile'] . "'
		,'" . $_POST['alt_mobile'] . "'
		,'" . $_POST['nationality'] . "'
		,'" . $_POST['gender'] . "'
		,'" . $this->GM->DateSplitwithoutconvert($_POST['dateofbirth']) . "'
		,'" . $_POST['address'] . "'
		,'" . $_POST['city'] . "'
		,'" . $_POST['postcode'] . "'
		,'" . $_POST['State_Id'] . "'
		,'" . $_POST['Country_Id'] . "'
		,'" . $this->GM->DateSplitwithoutconvert($_POST['Joining_date']) . "'
		,''					
			,'" . $_POST['Status_Id'] . "'	
		,'" . $_POST['User_Id'] . "'
		";
		} elseif ($_POST['Abut'] == 'Update') {
			$qry = $_SESSION['currentdatabasename'].".dbo.Alter_SalesManager '" . $_POST['Salut_Id'] . "'
	,'" . $_POST['firstname'] . "'
	,'" . $_POST['lastname'] . "'
	,'" . $_POST['email'] . "'
	,'" . md5($_POST['Password']) . "'	
	,'" . $_POST['mobile'] . "'
	,'" . $_POST['alt_mobile'] . "'
	,'" . $_POST['nationality'] . "'
	,'" . $_POST['gender'] . "'
		,'" . $this->GM->DateSplitwithoutconvert($_POST['dateofbirth']) . "'
	,'" . $_POST['address'] . "'
	,'" . $_POST['city'] . "'
	,'" . $_POST['postcode'] . "'
	,'" . $_POST['State_Id'] . "'
	,'" . $_POST['Country_Id'] . "'	
		,'" . $this->GM->DateSplitwithoutconvert($_POST['Joining_date']) . "'	
		
	,'" . $_POST['User_Id'] . "'
	,'" . $_POST['Status_Id'] . "'
	";
		}
		// echo $qry; exit;
		$query = $this->db->query($qry);
		if ($query) {
			$MGS = $query->row();
			$message = $MGS->MGS;
			$this->session->set_flashdata('msgS', "$message");
		
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
	/// AccountsManager Entry
	function AccountsManager_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('Salut_Id', 'Salut_Id', 'required');
		$this->form_validation->set_rules('firstname', 'firstname', 'required');
		$this->form_validation->set_rules('lastname', 'lastname', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('Password', 'Password', 'required');
		$this->form_validation->set_rules('mobile', 'mobile', 'required');
		$this->form_validation->set_rules('alt_mobile', 'alt_mobile', 'required');
		$this->form_validation->set_rules('nationality', 'nationality', 'required');
		$this->form_validation->set_rules('gender', 'gender', 'required');
		$this->form_validation->set_rules('dateofbirth', 'dateofbirth', 'required');
		$this->form_validation->set_rules('address', 'address', 'required');
		$this->form_validation->set_rules('city', 'city', 'required');
		$this->form_validation->set_rules('postcode', 'postcode', 'required');
		$this->form_validation->set_rules('State_Id', 'State_Id', 'required');
		$this->form_validation->set_rules('Country_Id', 'Country_Id', 'required');
		$this->form_validation->set_rules('Joining_date', 'Joining_date', 'required');
		$this->form_validation->set_rules('Status_Id', 'Status_Id', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', "Please Fill all Required Details");
            echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function AccountsManager_Save()
	{
		if ($_POST['Abut'] == 'Save') {
			$qry = $_SESSION['currentdatabasename'].".dbo.Create_AccountsManager '" . $_POST['Salut_Id'] . "'
		,'" . $_POST['firstname'] . "'
		,'" . $_POST['lastname'] . "'
        ,'" . $_POST['email'] . "'
        ,'" . md5($_POST['Password']) . "'	
		,'" . $_POST['mobile'] . "'
		,'" . $_POST['alt_mobile'] . "'
		,'" . $_POST['nationality'] . "'
		,'" . $_POST['gender'] . "'
			,'" . $this->GM->DateSplitwithoutconvert($_POST['dateofbirth']) . "'
		,'" . $_POST['address'] . "'
		,'" . $_POST['city'] . "'
		,'" . $_POST['postcode'] . "'
		,'" . $_POST['State_Id'] . "'
		,'" . $_POST['Country_Id'] . "'
			,'" . $this->GM->DateSplitwithoutconvert($_POST['Joining_date']) . "'
		,''			
		,'" . $_POST['User_Id'] . "'
		,'" . $_POST['Status_Id'] . "'
		";
		} elseif ($_POST['Abut'] == 'Update') {
			$qry = $_SESSION['currentdatabasename'].".dbo.Alter_AccountsManager '" . $_POST['Salut_Id'] . "'
	,'" . $_POST['firstname'] . "'
	,'" . $_POST['lastname'] . "'
	,'" . $_POST['email'] . "'
	,'" . md5($_POST['Password']) . "'	
	,'" . $_POST['mobile'] . "'
	,'" . $_POST['alt_mobile'] . "'
	,'" . $_POST['nationality'] . "'
	,'" . $_POST['gender'] . "'
		,'" . $this->GM->DateSplitwithoutconvert($_POST['dateofbirth']) . "'
	,'" . $_POST['address'] . "'
	,'" . $_POST['city'] . "'
	,'" . $_POST['postcode'] . "'
	,'" . $_POST['State_Id'] . "'
	,'" . $_POST['Country_Id'] . "'
		,'" . $this->GM->DateSplitwithoutconvert($_POST['Joining_date']) . "'
	,''			
	,'" . $_POST['User_Id'] . "'
	,'" . $_POST['Status_Id'] . "'
	";
		}
		$query = $this->db->query($qry);
		if ($query) {
			$MGS = $query->row();
			$message = $MGS->MGS;
			$this->session->set_flashdata('msgS', "$message");
			redirect("Users/AccountsManager");
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
			$data = array('Emsg' => $err, 'But' => $_POST['Abut'], 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
			$this->load->view('Users/AccountsManager', $data);
		}
	}
	/// Driver Entry
	function Driver_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('Salut_Id', 'Salut_Id', 'required');
		$this->form_validation->set_rules('firstname', 'firstname', 'required');
		$this->form_validation->set_rules('lastname', 'lastname', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('Password', 'Password', 'required');
		$this->form_validation->set_rules('mobile', 'mobile', 'required');
		$this->form_validation->set_rules('alt_mobile', 'alt_mobile', 'required');
		$this->form_validation->set_rules('nationality', 'nationality', 'required');
		$this->form_validation->set_rules('gender', 'gender', 'required');
		$this->form_validation->set_rules('dateofbirth', 'dateofbirth', 'required');
		$this->form_validation->set_rules('address', 'address', 'required');
		$this->form_validation->set_rules('city', 'city', 'required');
		$this->form_validation->set_rules('postcode', 'postcode', 'required');
		$this->form_validation->set_rules('State_Id', 'State_Id', 'required');
		$this->form_validation->set_rules('Country_Id', 'Country_Id', 'required');

		$this->form_validation->set_rules('Joining_date', 'Joining_date', 'required');
		$this->form_validation->set_rules('Status_Id', 'Status_Id', 'required');
		if ($this->form_validation->run() == FALSE) {
		
			$this->session->set_flashdata('msgU', "Please Fill all Required Details");
            echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function Driver_Save()
	{
		if ($_POST['Abut'] == 'Save') {
			$qry = $_SESSION['currentdatabasename'].".dbo.Create_Driver '" . $_POST['Salut_Id'] . "'
		,'" . $_POST['firstname'] . "'
		,'" . $_POST['lastname'] . "'
        ,'" . $_POST['email'] . "'
        ,'" . md5($_POST['Password']) . "'	
		,'" . $_POST['mobile'] . "'
		,'" . $_POST['alt_mobile'] . "'
		,'" . $_POST['nationality'] . "'
		,'" . $_POST['gender'] . "'
		,'" . $this->GM->DateSplitwithoutconvert($_POST['dateofbirth']) . "'		
		,'" . $_POST['address'] . "'
		,'" . $_POST['city'] . "'
		,'" . $_POST['postcode'] . "'
		,'" . $_POST['State_Id'] . "'
		,'" . $_POST['Country_Id'] . "'
				,'" . $this->GM->DateSplitwithoutconvert($_POST['Joining_date']) . "'
		,''			
		,'" . $_POST['User_Id'] . "'
		,'" . $_POST['Status_Id'] . "'
		"; 
		} elseif ($_POST['Abut'] == 'Update') {
			$qry = $_SESSION['currentdatabasename'].".dbo.Alter_Driver '" . $_POST['Salut_Id'] . "'
	,'" . $_POST['firstname'] . "'
	,'" . $_POST['lastname'] . "'
	,'" . $_POST['email'] . "'
	,'" . md5($_POST['Password']) . "'	
	,'" . $_POST['mobile'] . "'
	,'" . $_POST['alt_mobile'] . "'
	,'" . $_POST['nationality'] . "'
	,'" . $_POST['gender'] . "'
	,'" . $this->GM->DateSplitwithoutconvert($_POST['dateofbirth']) . "'
	,'" . $_POST['address'] . "'
	,'" . $_POST['city'] . "'
	,'" . $_POST['postcode'] . "'
	,'" . $_POST['State_Id'] . "'
	,'" . $_POST['Country_Id'] . "'
	,'" . $this->GM->DateSplitwithoutconvert($_POST['Joining_date']) . "'
	,''			
	,'" . $_POST['User_Id'] . "'
	,'" . $_POST['Status_Id'] . "'
	";
		}
		$query = $this->db->query($qry);
		
		if ($query) {
			$MGS = $query->row();
			$message = $MGS->MGS;
			$this->session->set_flashdata('msgS', "$message");		
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

	/// Helper Entry
	function Helper_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('Salut_Id', 'Salut_Id', 'required');
		$this->form_validation->set_rules('firstname', 'firstname', 'required');
		$this->form_validation->set_rules('lastname', 'lastname', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('mobile', 'mobile', 'required');
		$this->form_validation->set_rules('alt_mobile', 'alt_mobile', 'required');
		$this->form_validation->set_rules('nationality', 'nationality', 'required');
		$this->form_validation->set_rules('gender', 'gender', 'required');
		$this->form_validation->set_rules('dateofbirth', 'dateofbirth', 'required');
		$this->form_validation->set_rules('address', 'address', 'required');
		$this->form_validation->set_rules('city', 'city', 'required');
		$this->form_validation->set_rules('postcode', 'postcode', 'required');
		$this->form_validation->set_rules('State_Id', 'State_Id', 'required');
		$this->form_validation->set_rules('Country_Id', 'Country_Id', 'required');

		$this->form_validation->set_rules('Joining_date', 'Joining_date', 'required');
		$this->form_validation->set_rules('Status_Id', 'Status_Id', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', "Please Fill all Required Details");
            echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function Helper_Save()
	{
		if ($_POST['Abut'] == 'Save') {
			$qry = $_SESSION['currentdatabasename'].".dbo.Create_Helper '" . $_POST['Salut_Id'] . "'
		,'" . $_POST['firstname'] . "'
		,'" . $_POST['lastname'] . "'
        ,'" . $_POST['email'] . "'        
		,'" . $_POST['mobile'] . "'
		,'" . $_POST['alt_mobile'] . "'
		,'" . $_POST['nationality'] . "'
		,'" . $_POST['gender'] . "'
		,'" . $this->GM->DateSplitwithoutconvert($_POST['dateofbirth']) . "'		
		,'" . $_POST['address'] . "'
		,'" . $_POST['city'] . "'
		,'" . $_POST['postcode'] . "'
		,'" . $_POST['State_Id'] . "'
		,'" . $_POST['Country_Id'] . "'
			,'" . $this->GM->DateSplitwithoutconvert($_POST['Joining_date']) . "'
		,''			
		,'" . $_POST['User_Id'] . "'
		,'" . $_POST['Status_Id'] . "'
		";
		} elseif ($_POST['Abut'] == 'Update') {
			$qry = $_SESSION['currentdatabasename'].".dbo.Alter_Helper '" . $_POST['Salut_Id'] . "'
	,'" . $_POST['firstname'] . "'
	,'" . $_POST['lastname'] . "'
	,'" . $_POST['email'] . "'
	,'" . $_POST['mobile'] . "'
	,'" . $_POST['alt_mobile'] . "'
	,'" . $_POST['nationality'] . "'
	,'" . $_POST['gender'] . "'
	,'" . $this->GM->DateSplitwithoutconvert($_POST['dateofbirth']) . "'
	,'" . $_POST['address'] . "'
	,'" . $_POST['city'] . "'
	,'" . $_POST['postcode'] . "'
	,'" . $_POST['State_Id'] . "'
	,'" . $_POST['Country_Id'] . "'
	,'" . $this->GM->DateSplitwithoutconvert($_POST['Joining_date']) . "'
	,''			
	,'" . $_POST['User_Id'] . "'
	,'" . $_POST['Status_Id'] . "'
	";
		}
		$query = $this->db->query($qry);
		// echo $qry ; exit;
		if ($query) {
			$MGS = $query->row();
			$message = $MGS->MGS;
			$this->session->set_flashdata('msgS', "$message");
			redirect("Users/Helper");
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
			echo "<script> history.go(-1);</script>";
		}
	}
	//Dealer_credit
	function DealerCredit_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('Dealer_Id', 'Dealer_Id', 'required');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('credit_limit', 'credit_limit', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', 'Fill in All Required Details');
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function DealerCredit_Save()
	{
		$qry = "".$_SESSION['currentdatabasename'].".dbo.Dealer_credit '" . $_POST['Dealer_Id'] . "'
,'" . $_POST['credit_limit'] . "'
,'" . $_POST['User_Id'] . "'
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
				$this->session->set_flashdata('msgU', "$Values_of_the_Message Same Data Already Exist");
			} else {
				$this->session->set_flashdata('msgU', "Same Data Already Exist");
			}
		}
		echo "<script> history.go(-1);</script>";
	}
	// Attendance Begin
	function Attendance_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('loginUser_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('Mas_AttendanceType_Id', 'Mas_AttendanceType_Id', 'required');
		$this->form_validation->set_rules('Attendance_Status_Status_Id', 'Attendance_Status_Status_Id', 'required');
		$this->form_validation->set_rules('from_datetime', 'from_datetime', 'required');
		$this->form_validation->set_rules('from_location', 'from_location', 'required');
		$this->form_validation->set_rules('to_datetime', 'to_datetime', 'required');
		$this->form_validation->set_rules('to_location', 'to_location', 'required');
		$this->form_validation->set_rules('to_location', 'to_location', 'required');
		$this->form_validation->set_rules('to_location', 'to_location', 'required');
		$this->form_validation->set_rules('to_location', 'to_location', 'required');
		$this->form_validation->set_rules('Attendance_Id', 'Attendance_Id', 'required');
		if ($_REQUEST['Abut'] == 'Update') {
			$this->form_validation->set_rules('AttendanceTime_Id', 'AttendanceTime_Id', 'required');
		}
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', 'Fill in All Required Details');
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function Attendance_Save()
	{
		$qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_AttendanceTime '" . $_POST['Attendance_Id'] . "'
	,'" . $_POST['Mas_AttendanceType_Id'] . "'
	,'" . $_POST['Attendance_Status_Status_Id'] . "'
	,'" . $_POST['from_datetime'] . "'
	,'" . $_POST['from_location'] . "'
	,'" . $_POST['to_datetime'] . "'
	,'" . $_POST['to_location'] . "'
	,'" . $_POST['decription'] . "'
	,'" . $_POST['loginUser_Id'] . "'
	,'1'
	,'" . $_POST['Abut'] . "'	
	,'" . $_POST['AttendanceTime_Id'] . "'	
	";
		$query = $this->db->query($qry);
		if ($query) {
			$this->session->set_flashdata('msgS', 'Success!!!');
			echo "<script> history.go(-2);</script>";
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
				echo "<script> history.go(-1);</script>";
		}
	}
	/// Attendance End
	// Salary Begin
	function Salary_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('loginUser_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('pay_type_Id', 'pay_type_Id', 'required');
		$this->form_validation->set_rules('UserRole_Id', 'UserRole_Id', 'required');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('salary_from_date', 'salary_from_date', 'required');
		if ($_REQUEST['Abut'] == 'Update') {
			$this->form_validation->set_rules('Salary_Id', 'Salary_Id', 'required');
		}
		if ($this->form_validation->run() == FALSE) {
			$data = array('But' => $_POST['Abut'], 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
			$this->load->view('Users/Salary', $data);
		} else {
			return true;
		}
	}
	function Salary_Save()
	{
		$qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_Salary '" . $_POST['UserRole_Id'] . "'
,'" . $_POST['User_Id'] . "'
,'" . $_POST['pay_type_Id'] . "'
,'" . $this->GM->DateSplit($_POST['salary_from_date']) . "'
,'" . $_POST['loginUser_Id'] . "'
,'1'
,'" . $_POST['Abut'] . "'	
,'" . $_POST['Salary_Id'] . "'	
";
		$query = $this->db->query($qry);
		if ($query) {
			$this->session->set_flashdata('msgS', 'Success!!!');
			redirect("Users/Salary");
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
			$this->load->view('Users/Salary', $data);
		}
	}
	/// Salary End
	//SalaryAmount Begin
	function SalaryAmount_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('loginUser_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('Salary_Id', 'Salary_Id', 'required');
		$this->form_validation->set_rules('UserRole_Id', 'UserRole_Id', 'required');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('pay_head_Id', 'pay_head', 'required');
		$this->form_validation->set_rules('pay_amount', 'pay_amount', 'required');
		if ($_REQUEST['Abut'] == 'Update') {
			$this->form_validation->set_rules('SalaryAmount_Id', 'SalaryAmount_Id', 'required');
		}
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', 'Fill in All Required Details');
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function SalaryAmount_Save()
	{
		$qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_SalaryAmount '" . $_POST['Salary_Id'] . "'
	,'" . $_POST['pay_head_Id'] . "','" . $_POST['pay_amount'] . "','" . $_POST['loginUser_Id'] . "'
	,'1','" . $_POST['Abut'] . "','" . $_POST['SalaryAmount_Id'] . "'";
		$query = $this->db->query($qry);
		if ($query) {
			$this->session->set_flashdata('msgS', 'Success!!!');
		} else {
			$err = $this->db->error();
			$err = $err['message'];
			$data = "The duplicate key value is";
			if ((strpos($err, "$data")) !== FALSE) {
				$Values_of_the_Message = substr($err, strpos($err, "$data") + 26);
				$this->session->set_flashdata('msgU', "$Values_of_the_Message Same Data Already Exist");
			} else {
				$this->session->set_flashdata('msgU', "Same Data Already Exist");
			}
		}
		echo "<script>window.location='" . site_url("Users/Salaryuser_views/?ur=" . base64_encode($_POST['UserRole_Id']) . "&Key=" . base64_encode($_POST['User_Id'])) . "'</script>";
	}
	//SalaryAmount End
	//Hike_Validation
	function Hike_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('loginUser_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('SalaryAmount_Id', 'SalaryAmount_Id', 'required');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('UserRole_Id', 'UserRole_Id', 'required');
		$this->form_validation->set_rules('Hike_pay_amount', 'Hike_pay_amount', 'required');
		$this->form_validation->set_rules('Hike_From_date', 'Hike_From_date', 'required');
		if (($_REQUEST['Abut'] == 'Update') && ($_REQUEST['Abut'] == 'Delete')) {
			$this->form_validation->set_rules('Hike_Id', 'Hike_Id', 'required');
			$this->form_validation->set_rules(
				'Hike_From_date',
				'Hike_From_date',
				function ($date) {
					return ($date < date('d-m-Y')) ? true : false;
				}
			);
		} else {
			$this->form_validation->set_rules(
				'Hike_From_date',
				'Hike_From_date',
				function ($date) {
					return ($date > date('d-m-Y')) ? true : false;
				}
			);
		}
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', validation_errors());
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function Hike_Save()
	{
		$qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_Hike '" . $_POST['SalaryAmount_Id'] . "'
	,'" . $_POST['Hike_pay_amount'] . "','" . $this->GM->DateSplit($_POST['Hike_From_date']) . "','" . $_POST['loginUser_Id'] . "'
	,'1','" . $_POST['Abut'] . "','" . $_POST['Hike_Id'] . "'";
		$query = $this->db->query($qry);
		if ($query) {
			$this->session->set_flashdata('msgS', 'Success!!!');
		} else {
			$err = $this->db->error();
			$err = $err['message'];
			$data = "The duplicate key value is";
			if ((strpos($err, "$data")) !== FALSE) {
				$Values_of_the_Message = substr($err, strpos($err, "$data") + 26);
				$this->session->set_flashdata('msgU', "$Values_of_the_Message Same Data Already Exist");
			} else {
				$this->session->set_flashdata('msgU', "Same Data Already Exist");
			}
		}
		echo "<script>window.location='" . site_url("Users/Salaryuser_views/?ur=" . base64_encode($_POST['UserRole_Id']) . "&Key=" . base64_encode($_POST['User_Id'])) . "'</script>";
	}
	//salarydeduction
	function Deduction_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('loginUser_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('SalaryDeduction_SalaryAmount_Id', 'SalaryDeduction_SalaryAmount_Id', 'required');
		$this->form_validation->set_rules('SalaryDeduction_Deduction_Id', 'SalaryDeduction_Deduction_Id', 'required');
		$this->form_validation->set_rules('SalaryDeduction_From_date', 'SalaryDeduction_From_date', 'required');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('UserRole_Id', 'UserRole_Id', 'required');
		if (($_REQUEST['Abut'] == 'Update') && ($_REQUEST['Abut'] == 'Delete')) {
			$this->form_validation->set_rules('SalaryDeduction_Id', 'SalaryDeduction_Id', 'required');
		}
		if ($_REQUEST['Abut'] == 'Update') {
			$this->form_validation->set_rules(
				'SalaryDeduction_From_date',
				'SalaryDeduction_From_date',
				array(
					'required',
					function ($date) {
						return ($date > date('d-m-Y')) ? true : false;
					}
				)
			);
		}
		if ($this->form_validation->run() == FALSE) {			
			$this->session->set_flashdata('msgU', 'Fill in All Required Details');
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function Deduction_Save()
	{
		$qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_Salarydeduction '" . $_POST['SalaryDeduction_SalaryAmount_Id'] . "'
	,'" . $_POST['SalaryDeduction_Deduction_Id'] . "'
	,'" . $this->GM->DateSplit($_POST['SalaryDeduction_From_date']) . "'
	,'" . $_POST['loginUser_Id'] . "'
	,'1'
	,'" . $_POST['Abut'] . "'	
	,'" . $_POST['SalaryDeduction_Id'] . "'	
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
				$this->session->set_flashdata('msgU', "$Values_of_the_Message Same Data Already Exist");
			} else {
				$this->session->set_flashdata('msgU', "Same Data Already Exist");
			}
		}
		echo "<script>window.location='" . site_url("Users/Salaryuser_views/?ur=" . base64_encode($_POST['UserRole_Id']) . "&Key=" . base64_encode($_POST['User_Id'])) . "'</script>";
	}
}
