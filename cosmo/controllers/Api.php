<?php
class Api extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
	}
	
	
	public function index()
	{
		echo "<script> history.go(-1);</script>";
	}
	public function State()
	{
		$countryid = $_GET['country'];
		$State_Id = "";
		$data = $this->GM->State(1, 0, $countryid);
		$file = $this->GM->Option_($data, 'State_Id', 'StateName', '', 'Select', @set_value('State_Id') . @$State_Id);
		echo "$file";
	}

	public function CountryCode()
	{
		$data = $this->GM->Country(1, $_GET['country'], 0);
		foreach ($data as $key) {
			$id = "countrycode";
			$datas = @$key->$id;
			echo "$datas";
		}
	}


	public function	officeStatusupdate()
	{
		$qry = "cosmo.dbo.Exec_userofficestatus " . $_REQUEST['userid'] . ',' . $_REQUEST['Officeid'] .
			',' . $_REQUEST['modifiedby'] . ',' . $_REQUEST['statusid'];
		// echo "$qry"; exit;
		$query = $this->db->query($qry);
		if ($query) {
			$MGS = $query->row();
			echo  $MGS->MSG;
		} else {
			$err = $this->db->error();
			$err = $err['message'];
			$data = "The duplicate key value is";
			if (($out = strpos($err, "$data")) !== FALSE) {
				$Values_of_the_Message = substr($err, strpos($err, "$data") + 26);
				echo $Values_of_the_Message;
			} else {
				echo "msgU', 'Same Data Already Exist for another User";
			}
		}
	}
	public function	userStatusupdate()
	{
		$qry = "cosmo.dbo.Exec_userstatus " . $_REQUEST['userid'] .
			',' . $_REQUEST['modifiedby'] . ',' . $_REQUEST['statusid'];
		// echo "$qry"; exit;
		$query = $this->db->query($qry);
		if ($query) {
			$MGS = $query->row();
			echo  $MGS->MSG;
		} else {
			$err = $this->db->error();
			$err = $err['message'];
			$data = "The duplicate key value is";
			if (($out = strpos($err, "$data")) !== FALSE) {
				$Values_of_the_Message = substr($err, strpos($err, "$data") + 26);
				echo $Values_of_the_Message;
			} else {
				echo "msgU', 'Same Data Already Exist for another User";
			}
		}
	}
	public function Productlist()
	{
		$ProductcategoryId = $_GET['ProductcategoryId'];
		$Status_Id = "1";
		$id = "0";
		$data = $this->GM->OfficeProduct($Status_Id, $ProductcategoryId, $id);
		$file = $this->GM->Option_($data, 'Product_Id', 'Product', '', 'Select', @set_value('Product_Id') . @$id);
		echo "$file";
	}
	public function Userlist()
	{
		$UserRoleId = $_REQUEST['UserRole_Id'];
		$Status_Id = $_REQUEST['Status_Id'];
		$Req_User_Id = $_REQUEST['User_Id'];
		if (empty($Req_User_Id)) {
			$Req_User_Id = "0";
		}
		$data = $this->GM->users($UserRoleId, $Status_Id, $User_Id = 0);
		if (isset($data[0])) {
			$firstKey = $this->GM->array_key_first(get_object_vars($data[0]));
			$show = 'email';
		} else {
			$firstKey = '';
			$show = '';
		}
		$file = $this->GM->Option_($data, "$firstKey", "$show", '', 'Select', $Req_User_Id);
		echo "$file";
	}
}
