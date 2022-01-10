<?php
class CategoryClass extends CI_Model
{
	//DebitsAgainst_Validation
	function DebitsAgainst_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('Debits_Type_Id', 'Debits_Type_Id', 'required');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('DebitsAgainst_Name', 'DebitsAgainst_Name', 'required');
		$this->form_validation->set_rules('DebitsAgainst_Code', 'DebitsAgainst_Code', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', "Please Fill all Required Details");
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function DebitsAgainst_Save()
	{
		$qry = "cosmo.dbo.Exec_DebitsAgainst '" . $_POST['Debits_Type_Id'] . "'
			,'" . $_POST['DebitsAgainst_Name'] . "'
			,'" . $_POST['DebitsAgainst_Code'] . "'
			,'" . $_POST['User_Id'] . "'
			,'1'
			,'" . $_POST['Abut'] . "'	
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
	//Bank
	function Bank_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('BankName', 'BankName', 'required');
		$this->form_validation->set_rules('Bankcode', 'Bankcode', 'required');
		$this->form_validation->set_rules('Country_Id', 'Country_Id', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', "Please Fill all Required Details");
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function Bank_Save()
	{
		$qry = "cosmo.dbo.Exec_Bank '" . $_POST['BankName'] . "'
		,'" . $_POST['Bankcode'] . "'
		,'" . $_POST['Country_Id'] . "'
		,'" . $_POST['User_Id'] . "'
		,'1'
		,'" . $_POST['Abut'] . "'	
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
	//Currency
	function Currency_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('CurrencyName', 'CurrencyName', 'required');
		$this->form_validation->set_rules('Currencycode', 'Currencycode', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', "Please Fill all Required Details");
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function Currency_Save()
	{
		$qry = "cosmo.dbo.Exec_Currency '" . $_POST['CurrencyName'] . "'
		,'" . $_POST['Currencycode'] . "'
		,'" . $_POST['User_Id'] . "'
		,'1'
		,'" . $_POST['Abut'] . "'	
        ";
		$query = $this->db->query($qry);
		if ($query) {
			$this->session->set_flashdata('msgS', 'Success!!!');
			redirect("Category/Currency");
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
			$this->load->view('Category/Currency', $data);
		}
	}
	// Country Begin
	function Country_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('CountryName', 'CountryName', 'required');
		$this->form_validation->set_rules('countrycode', 'countrycode', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', "Please Fill all Required Details");
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function Countryedit_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('CountryName', 'CountryName', 'required');
		$this->form_validation->set_rules('countrycode', 'countrycode', 'required');
		$this->form_validation->set_rules('Status_Id', 'Status_Id', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', "Please Fill all Required Details");
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function Country_Save()
	{
		$countrycode = "+" . $_POST['countrycode'];
		$qry = "cosmo.dbo.Exec_Country '" . $_POST['CountryName'] . "'
		,'" . $countrycode . "'
		,'" . $_POST['User_Id'] . "'
		,'1'
		,'" . $_POST['Abut'] . "'	
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
	function Country_Edit()
	{
		$status = "0";
		$qry = $this->db->query('exec cosmo.dbo.Get_Country ' . $status . ',' . base64_decode($_GET['Key']));
		$res = $qry->row();
		$data = array(
			'Country_Id' => $res->Country_Id,
			'CountryName' => $res->CountryName,
			'countrycode' => $res->countrycode,
			'Status_Id' => $res->Status_Id,
			'But' => 'Update',
			'Icon' => 'fa fa-pencil',
			'BtnColor' => 'bg-blue'
		);
		$this->load->view('Category/Countryedit', $data);
	}
	function Country_Update()
	{
		$qry = "cosmo.dbo.Exec_Country '" . $_POST['CountryName'] . "'
		,'" . $_POST['countrycode'] . "'
		,'" . $_POST['User_Id'] . "'
        ,'" . $_POST['Status_Id'] . "'
        ,'" . $_POST['Abut'] . "'	
        ,'" . $_POST['Country_Id'] . "'
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
	/// Country End
	/// Area Begin
	function Area_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('AreaName', 'AreaName', 'required');
		$this->form_validation->set_rules('Warehouse_Id', 'Warehouse_Id', 'required');
		$this->form_validation->set_rules('SalesExecutive_Id', 'SalesExecutive_Id', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', 'Fill in All Required Details');
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function Area_Save()
	{
		$qry = "" . $_SESSION['currentdatabasename'] . ".dbo.Exec_Area '" . $_POST['AreaName'] . "'
	,'" . $_POST['Warehouse_Id'] . "'
	,'" . $_POST['SalesExecutive_Id'] . "'
	,'" . $_POST['User_Id'] . "'
	,'1'
	,'" . $_POST['Abut'] . "'	
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
	/// Area End
	/// State Begin
	function State_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('StateName', 'StateName', 'required');
		$this->form_validation->set_rules('Country_Id', 'Country_Id', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', "Please Fill all Required Details");
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function Stateedit_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('State_Id', 'State_Id', 'required');
		$this->form_validation->set_rules('StateName', 'StateName', 'required');
		$this->form_validation->set_rules('Country_Id', 'Country_Id', 'required');
		$this->form_validation->set_rules('Status_Id', 'Status_Id', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', "Please Fill all Required Details");
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function State_Save()
	{
		$qry = "cosmo.dbo.Exec_State '" . $_POST['StateName'] . "'
	,'" . $_POST['Country_Id'] . "'
	,'" . $_POST['User_Id'] . "'
	,'1'
	,'" . $_POST['Abut'] . "'	
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
	function State_Edit()
	{
		$status = "0";
		$qry = $this->db->query('exec cosmo.dbo.Get_State ' . $status . ',' . base64_decode($_GET['Key']));
		// echo  $this->db->last_query();exit;
		$res = $qry->row();
		$data = array(
			'State_Id' => $res->State_Id,
			'StateName' => $res->StateName,
			'Country_Id' => $res->Country_Id,
			'Status_Id' => $res->Status_Id,
			'But' => 'Update',
			'Icon' => 'fa fa-pencil',
			'BtnColor' => 'bg-blue'
		);
		$this->load->view('Category/Stateedit', $data);
	}
	function State_Update()
	{
		$qry = "cosmo.dbo.Exec_State '" . $_POST['StateName'] . "'
	,'" . $_POST['Country_Id'] . "'
	,'" . $_POST['User_Id'] . "'
	,'" . $_POST['Status_Id'] . "'
	,'" . $_POST['Abut'] . "'	
	,'" . $_POST['State_Id'] . "'
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
	/// State End
	//payhead Begin
	function payhead_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('pay_head', 'WarehouseName', 'required');
		if ($_REQUEST['Abut'] == 'Update') {
			$this->form_validation->set_rules('pay_head_Id', 'pay_head_Id', 'required');
		}
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', "Please Fill all Required Details");
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function payhead_Save()
	{
		$qry = "cosmo.dbo.Exec_payhead '" . $_POST['pay_head'] . "','" . $_POST['User_Id'] . "','1','" . $_POST['Abut'] . "','" . $_POST['pay_head_Id'] . "'";
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
	//payhead End
	//HolidayType Begin
	function HolidayType_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('HolidayType', 'HolidayType', 'required');
		if ($_REQUEST['Abut'] == 'Update') {
			$this->form_validation->set_rules('HolidayType_Id', 'HolidayType_Id', 'required');
		}
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', 'Fill in All Required Fields');
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function HolidayType_Save()
	{
		$qry = "cosmo.dbo.Exec_HolidayType '" . $_POST['HolidayType'] . "','" . $_POST['decription'] . "','" . $_POST['User_Id'] . "','1','" . $_POST['Abut'] . "','" . $_POST['HolidayType_Id'] . "'";
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
	//HolidayType End
	//Holiday Begin
	function Holiday_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('Holiday', 'Holiday', 'required');
		$this->form_validation->set_rules('HolidayType_Id', 'HolidayType_Id', 'required');
		$this->form_validation->set_rules('Start_datetime', 'Start_datetime', 'required');
		$this->form_validation->set_rules('End_datetime', 'End_datetime', 'required');
		if ($_REQUEST['Abut'] == 'Update') {
			$this->form_validation->set_rules('Holiday_Id', 'Holiday_Id', 'required');
		}
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', 'Fill in All Required Fields');
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function Holiday_Save()
	{
		$qry = "cosmo.dbo.Exec_Holiday '" . $_POST['Holiday'] . "',
		'" . $_POST['HolidayType_Id'] . "','" . $this->GM->DateSplit($_POST['Start_datetime']) . "','" . $this->GM->DateSplit($_POST['End_datetime']) . "',
		'" . $_POST['decription'] . "','" . $_POST['User_Id'] . "','1','" . $_POST['Abut'] . "','" . $_POST['Holiday_Id'] . "'";
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
	//Holiday End
	//Device start
	function DeviceCode_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('DeviceId', 'DeviceId', 'required');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', 'Validation Missing');
			$data = array('But' => $_POST['Abut'], 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
			$this->load->view('Category/Warehouse', $data);
		} else {
			return true;
		}
	}
	function DeviceCode_Save()
	{
		$qry = "cosmo.dbo.Exec_DeviceCode '" . $_POST['DeviceId'] . "'
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
	//Exec_DeviceStatus
	function DeviceStatus_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('DeviceId', 'DeviceId', 'required');
		$this->form_validation->set_rules('devicestatus', 'devicestatus', 'required');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', 'Validation Missing');
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function DeviceStatus_Save()
	{
		$qry = "cosmo.dbo.Exec_DeviceStatus '" . $_POST['DeviceId'] . "'
	,'" . $_POST['devicestatus'] . "'	,'" . $_POST['User_Id'] . "'	
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
	//Device End 
	/// Warehouse Begin
	function Warehouse_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('Warehouse_Code', 'Warehouse_Code', 'required');
		$this->form_validation->set_rules('WarehouseName', 'WarehouseName', 'required');
		$this->form_validation->set_rules('City', 'City', 'required');
		$this->form_validation->set_rules('WarehouseIncarge_Id', 'WarehouseIncarge_Id', 'required');
		$this->form_validation->set_rules('Country_Id', 'Country_Id', 'required');
		$this->form_validation->set_rules('State_Id', 'State_Id', 'required');
		$this->form_validation->set_rules('lat', 'lat', 'required');
		$this->form_validation->set_rules('lng', 'lng', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', 'Fill In All Required Fields');
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function Warehouse_Save()
	{
		$qry = "" . $_SESSION['currentdatabasename'] . ".dbo.Exec_Warehouse '" . $_POST['Warehouse_Code'] . "'
		,'" . $_POST['WarehouseName'] . "'
	,'" . $_POST['City'] . "'
	,'" . $_POST['WarehouseIncarge_Id'] . "'
	,'" . $_POST['Country_Id'] . "'
	,'" . $_POST['State_Id'] . "'
	,'" . $_POST['lat'] . "'
	,'" . $_POST['lng'] . "'
	,'" . $_POST['User_Id'] . "'
	,'1'
	,'" . $_POST['Abut'] . "'	
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
	/// Warehouse End
	//Deduction Begin
	function Deduction_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('Deduction_name', 'Deduction_name', 'required');
		$this->form_validation->set_rules('Deduction', 'Deduction', 'required');
		$this->form_validation->set_rules('DiscountType_Id', 'DiscountType_Id', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', 'Validation Missing');
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function Deduction_Save()
	{
		$qry = "cosmo.dbo.Exec_Deduction '" . $_POST['Deduction_name'] . "'
        ,'" . $_POST['Deduction'] . "'
        ,'" . $_POST['DiscountType_Id'] . "'
        ,'" . $_POST['User_Id'] . "'
	,'1'
	,'" . $_POST['Abut'] . "'	
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
	// Deduction End
	/// Salut Begin
	function Salut_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('SalutName', 'SalutName', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', 'Validation Missing');
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function Salut_Save()
	{
		$qry = "cosmo.dbo.Exec_salut '" . $_POST['SalutName'] . "'
	,'" . $_POST['User_Id'] . "'
	,'1'
	,'" . $_POST['Abut'] . "'	
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
	/// Salut End
	/// Paytype Begin
	function Paytype_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('PaytypeName', 'PaytypeName', 'required');
		$this->form_validation->set_rules('paymode_id', 'paymode_id', 'required');
		$_POST['Everyday'] = '';
		if ($_POST['paymode_id'] == 1) {
			$this->form_validation->set_rules('starting_day', 'starting_day', 'required');
		} elseif ($_POST['paymode_id'] == 2) {
			$this->form_validation->set_rules('starting_date', 'starting_date', 'required');
		} else {
			$_POST['Everyday'] = 'Everyday';
		}
		$this->form_validation->set_rules('calc_till_noofdays', 'calc_till_noofdays', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', 'Validation Missing');
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function Paytype_Save()
	{
		$qry = "cosmo.dbo.Exec_Paytype '" . $_POST['PaytypeName'] . "'
	,'" . $_POST['starting_date'] . "'
	,'" . $_POST['starting_day'] . "'
	,'" . $_POST['Everyday'] . "'
	,'" . $_POST['calc_till_noofdays'] . "'
	,'" . $_POST['paymode_id'] . "'
	,'" . $_POST['User_Id'] . "'
	,'1'
	,'" . $_POST['Abut'] . "'	
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
	/// Paytype End
	/// ProductCategory Begin
	function ProductCategory_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('ProductCategory', 'ProductCategory', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', 'Validation Missing');
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function ProductCategory_Save()
	{
		$qry = "cosmo.dbo.Exec_ProductCategory '" . $_POST['ProductCategory'] . "'
	,'" . $_POST['User_Id'] . "'
	,'1'
	,'" . $_POST['Abut'] . "'	
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
	// ProductCategory End
	// Product
	function Product_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('ProductCategory_Id', 'ProductCategory_Id', 'required');
		$this->form_validation->set_rules('SKU', 'SKU', 'required');
		$this->form_validation->set_rules('Dimension', 'Dimension', 'required');
		$this->form_validation->set_rules('Volume', 'Volume', 'required');
		$this->form_validation->set_rules('Description', 'Description', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', 'Validation Missing');
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function Product_Save()
	{
		 $qry = "cosmo.dbo.Exec_Product'" . $_POST['ProductCategory_Id'] . "'
	,'" . $_POST['Product'] . "'
	,'" . $_POST['SKU'] . "'
	,'" . $_POST['Dimension'] . "'
	,'" . $_POST['Volume'] . "'
	,'" . $_POST['Description'] . "'
  	,'" . $_POST['User_Id'] . "'
	,'1'
	,'" . $_POST['Abut'] . "'
	,'" . $_POST['Product_Id'] . "'	
	";
	//exit;
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
	// Product end
	//OfficeProducts
	function OfficeProducts_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('Tax_id', 'Tax_id', 'required');
		$this->form_validation->set_rules('Product_id', 'Product_id', 'required');
		$this->form_validation->set_rules('Rate', 'Rate', 'required');
		$this->form_validation->set_rules('CashRate', 'CashRate', 'required');
		
		$this->form_validation->set_rules('Commission', 'Commission', 'required');
		$this->form_validation->set_rules('PlumberCommision', 'PlumberCommision', 'required');
		$this->form_validation->set_rules('Warrenty_days', 'Warrenty_days', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', 'Validation Missing');
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function OfficeProducts_Save()
	{
		$qry = "" . $_SESSION['currentdatabasename'] . ".dbo.Exec_OfficeProduct '" . $_POST['Tax_id'] . "'
,'" . $_POST['Product_id'] . "'	
,'" . $_POST['Rate'] . "'
,'" . $_POST['CashRate'] . "'
,'" . $_POST['Commission'] . "'
,'" . $_POST['PlumberCommision'] . "'
,'" . $_POST['Warrenty_days'] . "'
,'" . $_POST['User_Id'] . "'
,'1'
,'" . $_POST['Abut'] . "'	
";
		$query = $this->db->query($qry);
		if ($query) {
			$this->session->set_flashdata('msgS', 'Success!!!');
		} else {
			$this->session->set_flashdata('msgU', "Same Data Already Exist");
		}
		echo "<script> history.go(-1);</script>";
	}
	//EndofOfficeProducts
	// Taxes
	function Taxes_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('Taxes', 'Taxes', 'required');
		$this->form_validation->set_rules('TaxPercentage', 'TaxPercentage', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', 'Validation Missing');
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function Taxes_Save()
	{
		$qry = "" . $_SESSION['currentdatabasename'] . ".dbo.Exec_Taxes'" . $_POST['Taxes'] . "'
	,'" . $_POST['TaxPercentage'] . "'
	,'" . $_POST['User_Id'] . "'
	,'1'
	,'" . $_POST['Abut'] . "'	
	";
		$query = $this->db->query($qry);
		if ($query) {
			$this->session->set_flashdata('msgS', 'Success!!!');
			redirect("Category/Taxes");
		} else {
			$err = $this->db->error();
			$err = $err['message'];
			$this->session->set_flashdata('msgU', "Same Data Already Exist");
		}
		echo "<script> history.go(-1);</script>";
	}
	// Taxes end
	// Truck Begin
	function Truck_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('code', 'code', 'required');
		$this->form_validation->set_rules('description', 'description', 'required');
		$this->form_validation->set_rules('registration_no', 'registration_no', 'required');
		$this->form_validation->set_rules('insurance_no', 'insurance_no', 'required');
		$this->form_validation->set_rules('insurance_renewal', 'insurance_renewal', 'required');
		$this->form_validation->set_rules('mulkiya_no', 'mulkiya_no', 'required');
		$this->form_validation->set_rules('mulkiya_renewal', 'mulkiya_renewal', 'required');
		$this->form_validation->set_rules('dimension', 'dimension', 'required');
		$this->form_validation->set_rules('volume', 'volume', 'required');
		$this->form_validation->set_rules('Driver_Id', 'Driver_Id', 'required');
			$this->form_validation->set_rules('Status_Id', 'Status_Id', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', 'Validation Missing');
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function Truck_Save()
	{
	$qry = "Exec " . $_SESSION['currentdatabasename'] . ".dbo.Exec_Truck '" . $_POST['name'] . "'
	,'" . $_POST['code'] . "'
	,'" . $_POST['description'] . "'
	,'" . $_POST['registration_no'] . "'
	,'" . $_POST['insurance_no'] . "'
	,'" . $this->GM->DateSplitwithoutconvert($_POST['insurance_renewal']) . "'
	,'" . $_POST['mulkiya_no'] . "'
	,'" . $this->GM->DateSplitwithoutconvert($_POST['mulkiya_renewal']) . "'
	,'" . $_POST['dimension'] . "'
	,'" . $_POST['volume'] . "'	
	,'" . $_POST['Driver_Id'] . "'	
	,'" . $_POST['User_Id'] . "'
	,'" . $_POST['Status_Id'] . "'	
	,'" . $_POST['Abut'] . "'
	,'" . $_POST['Truck_Id'] . "'
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
	// End of Truck
	// UserRights
	function UserRights_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('UserRole_Id', 'UserRole_Id', 'required');
		$this->form_validation->set_rules('Menu_Id', 'Menu_Id', 'required');
		$this->form_validation->set_rules('SubMenu_Id', 'SubMenu_Id', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', 'Validation Missing');
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function UserRights_Save()
	{
		 
		 $qry = "".$_SESSION['currentdatabasename'].".dbo.com_Exec_UserRole'" . $_POST['UserRole_Id'] . "'
,'" . $_POST['Menu_Id'] . "'
,'" . $_POST['SubMenu_Id'] . "'
,'".$_POST['status_Id']."'
,'" . $_POST['Abut'] . "'	
,'" . $_POST['UserRights_Id'] . "'
";
		$query = $this->db->query($qry);
		if ($query) {
			$this->session->set_flashdata('msgS', 'User Rights Given !!!');
		} else {
			$this->session->set_flashdata('msgU', "User Rights Already Exist");
		}
		echo "<script> history.go(-1);</script>";
	}
	// UserRights end
}
