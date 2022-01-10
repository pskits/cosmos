<?php
class Api extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		print_r(1);die;
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
	public function Warehouse()
	{
		$db = $_POST['db'];
		$data = $this->GM->BranchWarehouse($status = "1", $id = "0", $db);
		$file = $this->GM->Option_($data, 'Warehouse_Id', 'WarehouseName', '', 'Select', 0);
		echo "$file";
	}
	public function Goods()
	{
		$Warehouse_Id = $_POST['Warehouse_Id'];
		$Product_Id = (isset($_POST['Product_Id'])) ? $_POST['Product_Id'] : '0';
		$data = $this->GM->Goods($Goods_Id = "0", $Category_Id = "0", $Product_Id, $Serial_No = "", $GoodsStatus_Id = "1", $status_Id = "1", $Warehouse_Id);
		echo json_encode($data);
	}
	public function Area()
	{
		$data = $this->GM->Area($StatusID = "1", $ID = "0", $_POST['warehouse_Id']);
		$file = $this->GM->Option_($data, 'Area_Id', 'AreaName', '', 'Select', $_POST['Area_Id']);
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
	public function Collectioninvoicelist()
	{
		$_POST['AmountMode_Id'] = (isset($_POST['AmountMode_Id'])) ? $_POST['AmountMode_Id'] : '0';
		$_POST['collectedUser_Id'] =	(isset($_POST['collectedUser_Id'])) ? $_POST['collectedUser_Id'] : '0';
		echo json_encode($this->GM->CollectionNotDeposited($_POST['collectedUser_Id'], $_POST['AmountMode_Id']));
	}
	public function CollectionNotSettledinvoicelist()
	{
		$_POST['AmountMode_Id'] = (isset($_POST['AmountMode_Id'])) ? $_POST['AmountMode_Id'] : '0';
		$_POST['collectedUser_Id'] =	(isset($_POST['collectedUser_Id'])) ? $_POST['collectedUser_Id'] : '0';
		echo json_encode($this->GM->CollectionNotSettled($status = "0", $dealer = "0", $_POST['collectedUser_Id'], $portal_Id = "0", $process_Id = "0", $_POST['AmountMode_Id'], $CollectionStatus_Id = "1", $Id = "0", $from_date = '', $to_date = ''));
	}
	public function Dealerinvoicelist()
	{
		error_reporting(-1);
		$data = $this->GM->InvoiceDue($status_id = 1, $_GET['Dealer_Id'], $Invoice_Id = "0", $salesexecutiveid = "0");
		//print_r($data);
		echo json_encode($data);
	}
	public function invoicelist()
	{
		$_POST['Dealer_Id'] = (isset($_POST['Dealer_Id'])) ? $_POST['Dealer_Id'] : '0';
		// $_POST['Warehouseid'] = (isset($_POST['Warehouseid'])) ? $_POST['Warehouseid'] : '0';
		$_POST['Invoice_status_Id'] = (isset($_POST['Invoice_status_Id'])) ? $_POST['Invoice_status_Id'] : '0';
		echo json_encode($this->GM->Invoice($status_id = 1, $_POST['Warehouseid'], $_POST['Dealer_Id'], $salesexecutiveuser_Id = "0", $priority_Id = "0", $_POST['Invoice_status_Id'], $order_Id = "0", $Id = "0"));
	}
	public function InvoiceNotTrippedlist()
	{
		$_POST['Dealer_Id'] = (isset($_POST['Dealer_Id'])) ? $_POST['Dealer_Id'] : '0';
		// $_POST['Warehouseid'] = (isset($_POST['Warehouseid'])) ? $_POST['Warehouseid'] : '0';
		$_POST['Invoice_status_Id'] = (isset($_POST['Invoice_status_Id'])) ? $_POST['Invoice_status_Id'] : '0';
		echo json_encode($this->GM->InvoiceNotTripped($status_id = 1, $_POST['Warehouseid'], $_POST['Dealer_Id'], $salesexecutiveuser_Id = "0", $priority_Id = "0", $_POST['Invoice_status_Id'], $order_Id = "0", $Id = "0"));
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
