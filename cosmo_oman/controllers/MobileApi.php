<?php
class MobileApi extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('MobileAPIClass');
		$headers = getallheaders();
		if (isset($headers['Authorization'])) {
			if ($headers['Authorization'] == '00000-00000-00000-00000') {
			} else {
				echo json_encode('Error:Incorrect Authentication');
				exit;
			}
		} else {
			echo json_encode('Error:Authentication Required');
			exit;
		}
	}
	public function index()
	{
		echo "error";
	}
	//InvoiceInventoryCount
	public function InvoiceInventoryCount()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			echo json_encode($this->GM->InvoiceInventoryCount($_POST['Invoice_Id'], $_POST['Product_Id']));
		}
	}
	function Alter_Password()
	{	
	
			if ($this->MobileAPIClass->Alter_Password()) {
				$data = array(
					'responsestatus' => '1',
					'Message' => 'Saved'
				);
			} else {
				$data = array(
					'responsestatus' => '2',
					'Message' => 'Password Not Saved'
				);
			}
	
		echo json_encode($data);
	}
		public function Checkmobillogin()
	{
			echo json_encode($this->GM->Checkmobillogin($_POST['deviceuuid'] , $_POST['userid']));
		
	}
	function Deposit_imageupload()
	{
		error_reporting(0);
		$directory = Deposit_directory . "/" . $_REQUEST['db'] . '/' . $_REQUEST['id'] ;

		$target_file =  $directory. '/' . basename($_REQUEST['title'] .'.' . end((explode(".", $_FILES["path"]["name"]))));
		if (!is_dir($directory)) {
			mkdir($directory, 0777, TRUE);
		}
		if (move_uploaded_file($_FILES["path"]["tmp_name"], $target_file)) {
			echo "The file " . $_REQUEST['title'] . " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
	public function SalesReturnwithUnadjusted()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			$data = $this->GM->SalesReturnwithUnadjusted($_REQUEST["Dealer_ID"], $_REQUEST["SalesReturn_Id"], $from_date='', $to_date='');
			echo json_encode($data);
		}
	}
		public function SalesReturnPaymentAdjust()
	{
		if ($this->MobileAPIClass->SalesReturnPaymentAdjust_Validation()) {
			if ($message = $this->MobileAPIClass->SalesReturnPaymentAdjust_Save()) {
				$data = array(
					'responsestatus' => '1',
					'Message' => $message
				);
			} else {
				$data = array(
					'responsestatus' => '2',
					'Message' => 'Not Saved'
				);
			}
		} else {
			$data = array(
				'responsestatus' => '0',
				'Message' => 'Missing Details'
			);
		}
		echo json_encode($data);
	}
	
	function Trip_imageupload()
	{
		error_reporting(0);
		$directory = Trip_directory . "/" . $_REQUEST['db'] . "/" . $_REQUEST['trip_Id'];
		 $target_file = $directory . '/' . basename($_REQUEST['title'] . '.' . end((explode(".", $_FILES["path"]["name"]))));
                            		 
 

		 if (!is_dir($directory)) {
                                mkdir($directory, 0777, TRUE);
                            }
		if (move_uploaded_file($_FILES["path"]["tmp_name"], $target_file)) {
			echo "The file " . $_REQUEST['title'] . " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
	function Dealer_Fileupload()
	{
		error_reporting(0);
		$directory = log_directory . "/" . $_REQUEST['db'] . "/6/" .$_REQUEST['id'] . '/';
		if (!is_dir($directory)) {
			mkdir($directory, 0777, TRUE);
		}
		$target_file =  $directory. '/' . basename($_REQUEST['title'] .'.' . end((explode(".", $_FILES["path"]["name"]))));
		
		if (move_uploaded_file($_FILES["path"]["tmp_name"], $target_file)) {
			echo "The file " . $_REQUEST['title'] . " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
	function Collection_imageupload()
	{
		error_reporting(0);
		$target_file = Collection_directory . "/" . $_REQUEST['db'] . '/' . $_REQUEST['Collection_Id'] . '/' . basename($_REQUEST['title'] . '.' . end((explode(".", $_FILES["path"]["name"]))));
		if (move_uploaded_file($_FILES["path"]["tmp_name"], $target_file)) {
			echo "The file " . $_REQUEST['title'] . " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
	
	public function Attendancetype()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			echo json_encode($this->GM->Attendancetype($Status_Id = "1", $_POST['Type_Id']));
		}
	}
	public function TodayAttendanceTime()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			$data = $this->GM->AttendanceTime($Attendance_Id = "0", $AttendancetimeId = "0", $status = "1", $Attendance_Status_Id = "0", $userrole = "0", $userid = "0", date('m/d/Y'),  date('m/d/Y'));
			echo json_encode($data);
		}
	}
	//Attendance
	function AttendanceTime()
	{
		$_POST['RequestType'] = 1;
		if ($this->MobileAPIClass->AttendanceTime_Validation()) {
			if ($this->MobileAPIClass->AttendanceTime_Save()) {
				$data = array(
					'responsestatus' => '1',
					'Message' => 'Saved'
				);
			} else {
				$data = array(
					'responsestatus' => '2',
					'Message' => 'Attendance Not Saved'
				);
			}
		} else {
			$data = array(
				'responsestatus' => '0',
				'Message' => 'Missing Details'
			);
		}
		echo json_encode($data);
	}
	// TripStatusloaded
	public function TripStatuspickup()
	{
		$_POST['tripSalesReturnstatus_id'] = "4";
		$_POST['GoodsReturned_status_id'] = "6";
		$_POST['GoodsDelivered_status_id'] = "3";
		if ($this->MobileAPIClass->TripSalesReturnPickup_Validation()) {
			if ($message = $this->MobileAPIClass->TripSalesReturnPickup_Save()) {
				$data = array(
					'responsestatus' => '1',
					'Message' => $message
				);
			} else {
				$data = array(
					'responsestatus' => '2',
					'Message' => 'Not Saved'
				);
			}
		} else {
			$data = array(
				'responsestatus' => '0',
				'Message' => 'Missing Details'
			);
		}
		echo json_encode($data);
	}
	public function Trip_InvoiceDelivered()
	{
		$_POST['tripinvoicestatus_Id'] = 5;
		$_POST['GoodsDeliveredStatus_Id'] = 3;
		if ($this->MobileAPIClass->TripInvoiceDelivery_Validation()) {
			if ($message = $this->MobileAPIClass->TripInvoiceDelivery_Save()) {
				$data = array(
					'responsestatus' => '1',
					'Message' => $message
				);
			} else {
				$data = array(
					'responsestatus' => '2',
					'Message' => 'Not Saved'
				);
			}
		} else {
			$data = array(
				'responsestatus' => '0',
				'Message' => 'Missing Details'
			);
		}
		echo json_encode($data);
	}
	//SalesReturn
	public function SalesReturnable_Invoice()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			echo json_encode($this->GM->SalesReturnableInvoice($status_Id = "1", $_POST['Dealer_Id'], $_POST['Warehouse_Id'], $_POST['Salesexecutive_user_Id']));
		}
	}
	public function SalesReturnRequestPending()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			echo json_encode($this->GM->SalesReturnRequestPending($status_id = "1", $_POST['SalesreturnRequest_Id'], $Dealer_Id = "0", $_POST['Salesexecutive_user_Id']));
		}
	}
	public function SalesReturnRequestProduct()
	{
		if (!isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			echo json_encode($this->GM->SalesReturnRequestGoods($status_id = "1", $_POST['SalesreturnRequest_Id'], $serialno = "",  $SalesreturnRequest_status_Id = "0"));
		}
	}
	public function Invoice_Goods()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			echo json_encode($this->GM->InvoiceGoods($_POST['Invoice_Id'], $Invoice_status_Id = "0", $Goodstype_Id = "0", $_POST['Product_Id'], $Serial_No = "", $GoodsStatus_Id = "0"));
		}
	}
	public function SalesReturnReplacement_Goods()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			echo json_encode($this->GM->SalesReturnReplacementGoods($_POST['SalesReturn_Id'], $SalesReturn_status_Id = "0", $Goodstype_Id = "0", $_POST['Product_Id'], $Serial_No = "", $GoodsStatus_Id = "0"));
		}
	}
	public function SalesReturn_Goods()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			echo json_encode($this->GM->SalesReturnGoods($_POST['SalesReturn_Id'], $SalesReturn_status_Id = "0", $Goodstype_Id = "0", $_POST['Product_Id'], $Serial_No = "", $GoodsStatus_Id = "0"));
		}
	}
	public function addInvoicegoods()
	{
		if ($this->MobileAPIClass->addInvoicegoods_Validation()) {
			if ($message = $this->MobileAPIClass->addInvoicegoods_Save()) {
				$data =  $message;
			} else {
				$data = array(
					'responsestatus' => '2',
					'Message' => 'Not Saved'
				);
			}
		} else {
			$data = array(
				'responsestatus' => '0',
				'Message' => 'Missing Details'
			);
		}
		echo json_encode($data);
	}
	
	public function addReplacementgoods()
	{
		if ($this->MobileAPIClass->addReplacementgoods_Validation()) {
			if ($message = $this->MobileAPIClass->addReplacementgoods_Save()) {
				$data =  $message;
			} else {
				$data = array(
					'responsestatus' => '2',
					'Message' => 'Not Saved'
				);
			}
		} else {
			$data = array(
				'responsestatus' => '0',
				'Message' => 'Missing Details'
			);
		}
		echo json_encode($data);
	}
	public function ReplacementGoodsStatusLoaded()
	{
		if ($this->MobileAPIClass->ReplacementGoodsStatusLoaded_Validation()) {
			if ($message = $this->MobileAPIClass->ReplacementGoodsStatusLoaded_Save()) {
				$data =   array(
					'responsestatus' => '1',
					'Message' => $message
				);
			} else {
				$data = array(
					'responsestatus' => '2',
					'Message' => 'Not Saved'
				);
			}
		} else {
			$data = array(
				'responsestatus' => '0',
				'Message' => 'Missing Details'
			);
		}
		echo json_encode($data);
	}
	public function GoodsStatusLoaded()
	{
		if ($this->MobileAPIClass->GoodsStatusLoaded_Validation()) {
			if ($message = $this->MobileAPIClass->GoodsStatusLoaded_Save()) {
				$data =   array(
					'responsestatus' => '1',
					'Message' => $message
				);
			} else {
				$data = array(
					'responsestatus' => '2',
					'Message' => 'Not Saved'
				);
			}
		} else {
			$data = array(
				'responsestatus' => '0',
				'Message' => 'Missing Details'
			);
		}
		echo json_encode($data);
	}
	public function InvoiceStatusLoaded()
	{
		if ($this->MobileAPIClass->InvoiceStatusLoaded_Validation()) {
			if ($message = $this->MobileAPIClass->InvoiceStatusLoaded_Save()) {
				$data =   array(
					'responsestatus' => '1',
					'Message' => $message
				);
			} else {
				$data = array(
					'responsestatus' => '2',
					'Message' => 'Not Saved'
				);
			}
		} else {
			$data = array(
				'responsestatus' => '0',
				'Message' => 'Missing Details'
			);
		}
		echo json_encode($data);
	}
	public function InvoicegoodsDelivery()
	{
		if ($this->MobileAPIClass->InvoicegoodsDelivery_Validation()) {
			if ($message = $this->MobileAPIClass->InvoicegoodsDelivery_Save()) {
				$data =  $message;
			} else {
				$data = array(
					'responsestatus' => '2',
					'Message' => 'Not Saved'
				);
			}
		} else {
			$data = array(
				'responsestatus' => '0',
				'Message' => 'Missing Details'
			);
		}
		echo json_encode($data);
	}
	public function SalesReturngoodsDelivery()
	{
		if ($this->MobileAPIClass->SalesReturngoodsDelivery_Validation()) {
			if ($message = $this->MobileAPIClass->SalesReturngoodsDelivery_Save()) {
				$data =  $message;
			} else {
				$data = array(
					'responsestatus' => '2',
					'Message' => 'Not Saved'
				);
			}
		} else {
			$data = array(
				'responsestatus' => '0',
				'Message' => 'Missing Details'
			);
		}
		echo json_encode($data);
	}
	public function SalesReturnClaimedgoodsDelivery()
	{
		if ($this->MobileAPIClass->SalesReturnClaimedgoodsDelivery_Validation()) {
			if ($message = $this->MobileAPIClass->SalesReturnClaimedgoodsDelivery_Save()) {
				$data =  $message;
			} else {
				$data = array(
					'responsestatus' => '2',
					'Message' => 'Not Saved'
				);
			}
		} else {
			$data = array(
				'responsestatus' => '0',
				'Message' => 'Missing Details'
			);
		}
		echo json_encode($data);
	}
	public function goods()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			echo json_encode($this->GM->Goods($Goods_Id = "0", $Category_Id = "0", $_POST['Product_Id'], $_POST['Serial_No'], $GoodsStatus_Id = "0", $status_Id = "1", $warehouse_id = "0"));
		}
	}
	public function InvoiceGoodsCount()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			echo json_encode($this->GM->InvoiceGoodsCount($_POST['Invoice_Id'], $_POST['Product_Id']));
		}
	}
	public function SalesReturnGoodsCount()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			echo json_encode($this->GM->SalesReturnGoodsCount($_POST['SalesReturn_Id'], $_POST['Product_Id']));
		}
	}
	public function SalesExecutiveArea()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			echo json_encode($this->GM->SalesExecutiveArea($_POST['SalesExecutiveuser_Id'], $ID = "0", $StatusID = "0", $Warehouse_Id = "0"));
		}
	}
	public function InvoiceStatusDelivered()
	{
		$_POST['TripDeliveriestatus_Id'] = '3';
		if ($this->MobileAPIClass->InvoiceStatusDelivered_Validation()) {
			if ($message = $this->MobileAPIClass->InvoiceStatusDelivered_Save()) {
				$data =   array(
					'responsestatus' => '1',
					'Message' => $message
				);
			} else {
				$data = array(
					'responsestatus' => '2',
					'Message' => 'Not Saved'
				);
			}
		} else {
			$data = array(
				'responsestatus' => '0',
				'Message' => 'Missing Details'
			);
		}
		echo json_encode($data);
	}
	public function AmountMode()
	{
		echo json_encode($this->GM->AmountMode());
	}
	//Collection
	function AddCollection()
	{
		if ($this->MobileAPIClass->Collection_Validation()) {
			if ($this->MobileAPIClass->Collection_Save()) {
				$data = array(
					'responsestatus' => '1',
					'Message' => 'Collected'
				);
			} else {
				$data = array(
					'responsestatus' => '2',
					'Message' => 'Not Saved'
				);
			}
		} else {
			$data = array(
				'responsestatus' => '0',
				'Message' => 'Missing Details'
			);
		}
		echo json_encode($data);
	}
	function AddSalesReturnRequest()
	{
		if ($this->MobileAPIClass->SalesReturnRequest_Validation()) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			if ($this->MobileAPIClass->SalesReturnRequest_Save()) {
				$data = array(
					'responsestatus' => '1',
					'Message' => 'Saved'
				);
			} else {
				$data = array(
					'responsestatus' => '2',
					'Message' => 'Not Saved'
				);
			}
		} else {
			$data = array(
				'responsestatus' => '0',
				'Message' => 'Missing Details'
			);
		}
		echo json_encode($data);
	}
	// DriverMobileTrip Start
	public function DriverCurrentTrip()
	{
		echo json_encode($this->GM->Mobile_Trip($status_Id = "1", $warehouse_id = "0", $area_Id = "0", $Truck_Id = "0", $_POST['UId'], $Helper_Id = "0", $Trip_status_Id = "2", $Id = "0", $from_date = '', $to_date = '', $_POST['db']));
	}
	public function DriverUpcommingTrip()
	{
		echo json_encode($this->GM->Mobile_Trip($status_Id = "1", $warehouse_id = "0", $area_Id = "0", $Truck_Id = "0", $_POST['UId'], $Helper_Id = "0", $Trip_status_Id = "1", $Id = "0", $from_date = '', $to_date = '', $_POST['db']));
	}
	// Trip_Start
	public function Trip_Start()
	{
		$_POST['checkpointstype_id'] = 1;
		if ($this->MobileAPIClass->TripCheckpoint_Validation()) {
			if ($message = $this->MobileAPIClass->TripCheckpoint_Save()) {
				$data = array(
					'responsestatus' => '1',
					'Message' => $message
				);
			} else {
				$data = array(
					'responsestatus' => '2',
					'Message' => 'Not Saved'
				);
			}
		} else {
			$data = array(
				'responsestatus' => '0',
				'Message' => 'Missing Details'
			);
		}
		$_POST['tripstatus_Id'] = 2;
		if ($this->MobileAPIClass->TripStart_Validation()) {
			if ($message = $this->MobileAPIClass->TripStart_Save()) {
				$data = array(
					'responsestatus' => '1',
					'Message' => $message
				);
			} else {
				$data = array(
					'responsestatus' => '2',
					'Message' => 'Not Saved'
				);
			}
		} else {
			$data = array(
				'responsestatus' => '0',
				'Message' => 'Missing Details'
			);
		}
		echo json_encode($data);
	}
	// Trip_Midway
	public function Trip_Midway()
	{
		$_POST['checkpointstype_id'] = 3;
		if ($this->MobileAPIClass->TripCheckpointMidway_Validation()) {
			if ($message = $this->MobileAPIClass->TripCheckpoint_Save()) {
				$data = array(
					'responsestatus' => '1',
					'Message' => $message
				);
			} else {
				$data = array(
					'responsestatus' => '2',
					'Message' => 'Not Saved'
				);
			}
		} else {
			$data = array(
				'responsestatus' => '0',
				'Message' => 'Missing Details'
			);
		}
		echo json_encode($data);
	}
	// Trip_End
	public function Trip_End()
	{
		$_POST['checkpointstype_id'] = 2;
		if ($this->MobileAPIClass->TripCheckpoint_Validation()) {
			if ($message = $this->MobileAPIClass->TripCheckpoint_Save()) {
				$data = array(
					'responsestatus' => '1',
					'Message' => $message
				);
			} else {
				$data = array(
					'responsestatus' => '2',
					'Message' => 'Not Saved'
				);
			}
		} else {
			$data = array(
				'responsestatus' => '0',
				'Message' => 'Missing Details'
			);
		}
		$_POST['tripstatus_Id'] = 3;
		if ($this->MobileAPIClass->TripEnd_Validation()) {
			if ($message = $this->MobileAPIClass->TripEnd_Save()) {
				$data = array(
					'responsestatus' => '1',
					'Message' => $message
				);
			} else {
				$data = array(
					'responsestatus' => '2',
					'Message' => 'Not Saved'
				);
			}
		} else {
			$data = array(
				'responsestatus' => '0',
				'Message' => 'Missing Details'
			);
		}
		echo json_encode($data);
	}
	public function Trip_Deliverable()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			echo json_encode($this->GM->TripDeliverable($_POST['trip_Id'], $TripDeliveriestatus_Id = "0"));
		}
	}
	public function Trip_SalesReturn()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			echo json_encode($this->GM->TripSalesReturn($status_id = 1, $_POST['trip_Id'], $Salesreturn_Id = "0", $Dealer_Id = "0", $salesReturn_Status_Id = "3"));
		}
	}
	public function Trip_SalesRetunGoodsToBeCollected()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			echo json_encode($this->GM->Get_TripSalesRetunGoodsToBeCollected($status_id = 1, $trip_Id = "0", $_POST['Salesreturn_Id']));
		}
	}
	// DriverMobileTrip End
	//Order Start
	public function orders()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			$_POST['id'] = (!isset($_POST['id'])) ? 0 : $_POST['id'];
			$_POST['from'] = (!isset($_POST['from'])) ? '' : $this->GM->DateSplit($_POST['from']);
			$_POST['to'] = (!isset($_POST['to'])) ? '' : $this->GM->DateSplit($_POST['to']);
			echo json_encode($this->GM->OrderSalesExecutives($status_id = 1, $Warehouseid = "0", $Dealer_Id = "0", $salesexecutiveuser_Id = $_POST['UId'], $priority_Id = "0", $Order_status_Id = "0", $_POST['id'],  $_POST['from'], $_POST['to']));
		}
	}
	public function OrdersProducts()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			echo json_encode($this->GM->OrderlistProduct($status_id = 1, $_POST['Order_Id']));
		}
	}
	public function OrderPriyority()
	{
		echo json_encode($this->GM->OrderPriyority());
	}
	public function Productcategory()
	{
		echo json_encode($this->GM->ProductCategory());
	}
	public function Product()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			echo json_encode($this->GM->OfficeProduct(1, $_POST['pcid'], 0));
		}
	}
	public function ProductOffers()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			echo json_encode($this->GM->DealerOffer($_POST['Dealer_Id'], "1", "0", $_POST['pid'], "0", "0"));
		}
	}
	function AddOrder()
	{
		if ($this->MobileAPIClass->orders_Validation()) {
			$result = $this->MobileAPIClass->orders_Save();
			if ($result) {
				$data = array(
					'responsestatus' => '1',
					'Message' => $result
				);
			} else {
				$data = array(
					'responsestatus' => '2',
					'Message' => $result
				);
			}
		} else {
			$data = array(
				'responsestatus' => '0',
				'Message' => 'Missing Details'
			);
		}
		echo json_encode($data);
	}
	//Order End
	//Invoice Start
	public function Invoice()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			$_POST['from'] = (!isset($_POST['from'])) ? '' : $this->GM->DateSplit($_POST['from']);
			$_POST['to'] = (!isset($_POST['to'])) ? '' : $this->GM->DateSplit($_POST['to']);
			$_POST['salesexecutiveuser_Id'] = (!isset($_POST['salesexecutiveuser_Id'])) ? 0 : $_POST['salesexecutiveuser_Id'];
			
			echo json_encode($this->GM->Invoice($status_id = 1, $Warehouseid = "0", $_POST['Dealer_Id'], $_POST['salesexecutiveuser_Id'], $priority_Id = "0", $Invoice_status_Id = "0", $order_Id = "0", $_POST['Invoice_Id'],  $_POST['from'], $_POST['to']));

	
		}
	}
	public function InvoicewithDue()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			$_POST['from'] = (!isset($_POST['from'])) ? '' : $this->GM->DateSplit($_POST['from']);
			$_POST['to'] = (!isset($_POST['to'])) ? '' : $this->GM->DateSplit($_POST['to']);
			$_POST['salesexecutiveuser_Id'] = (!isset($_POST['salesexecutiveuser_Id'])) ? 0 : $_POST['salesexecutiveuser_Id'];
				$_POST['Dealer_Id'] = (!isset($_POST['Dealer_Id'])) ? 0 : $_POST['Dealer_Id'];
			
			echo json_encode($this->GM->InvoicelistWithDue($status_id = 1, $_POST['Dealer_Id'], $_POST['Invoice_Id'], $_POST['salesexecutiveuser_Id'],$_POST['from'], $_POST['to']));

	
		}
	}
	public function InvoiceProducts()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			echo json_encode($this->GM->InvoiceProduct($status_id = 1, $_POST['Invoice_Id']));
		}
	}
	public function InvoiceDue()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			echo json_encode($this->GM->InvoiceDue($status_id = 1, $_POST['Dealer_ID'], $_POST['Invoice_Id'], $_POST['salesexecutiveid']));
		}
	}
	//Invoice End
	//Dealer start
	public function AddDealer()
	{
		if ($this->MobileAPIClass->AddDealer_Validation()) {
			if ($message = $this->MobileAPIClass->AddDealer_Save()) {
				$data = array(
					'responsestatus' => '1',
					'Message' => $message
				);
			} else {
				$data = array(
					'responsestatus' => '2',
					'Message' => 'Dealer is not Saved'
				);
			}
		} else {
			$data = array(
				'responsestatus' => '0',
				'Message' => 'Missing Details'
			);
		}
		echo json_encode($data);
	}
	//Deposit start
	public function AddDeposit()
	{
		if ($this->MobileAPIClass->AddDeposit_Validation()) {
			if ($id = $this->MobileAPIClass->AddDeposit_Save()) {
				$data = array(
					'responsestatus' => '1',
					'Message' => 'Deposited',
					'id' => $id
				);
			} else {
				$data = array(
					'responsestatus' => '2',
					'Message' => 'Not Saved'
				);
			}
		} else {
			$data = array(
				'responsestatus' => '0',
				'Message' => 'Missing Details'
			);
		}
		echo json_encode($data);
	}
	public function CollectionNotDeposited()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			echo json_encode($this->GM->CollectionNotDeposited($_POST['UId'], $_POST['amountmode_Id']));
		}
	}
	//Collection
	public function Collection()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
					$_POST['from'] = (!isset($_POST['from'])) ? '' : $this->GM->DateSplit($_POST['from']);
			$_POST['to'] = (!isset($_POST['to'])) ? '' : $this->GM->DateSplit($_POST['to']);
	
			echo json_encode($this->GM->Collection($status = "1", $dealer = "0", $_POST['UId'], $portal_Id = "0", $process_Id = "0", $amountmode_Id = "0", $CollectionStatus_Id = "0", $_POST['Collection_Id'], $_POST['from'], $_POST['to']));
		
		}
	}
	//Deposit
	public function Deposit()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			
			$_POST['from'] = (!isset($_POST['from'])) ? '' : $this->GM->DateSplit($_POST['from']);
			$_POST['to'] = (!isset($_POST['to'])) ? '' : $this->GM->DateSplit($_POST['to']);
	
			echo json_encode($this->GM->Deposit($status = "1", $bank_id = "0", $_POST['UId'], $DepositStatus_Id = "0", $amountmode_Id = "0", $_POST['Deposit_Id'], $_POST['from'], $_POST['to']));
			}
	}
	//SalesReturnable_Goods
	public function SalesReturnableGoods()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			echo json_encode($this->GM->InvoiceReturnableGoods($_POST['Invoice_Id']));
		}
	}
	//DepositCollection
	public function DepositCollection()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			echo json_encode($this->GM->DepositCollection($status = "1", $_POST['Deposit_Id'],  $Id = "0"));
		}
	}
	//CollectionAmount
	public function CollectionAmount()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			$_POST['collectionTypeAgainst_Id'] = (!isset($_POST['collectionTypeAgainst_Id'])) ? '0' : $_POST['collectionTypeAgainst_Id'];
			echo json_encode($this->GM->CollectionAmount($status = "1", $_POST['Collection_Id'], $collectionType_Id = "2", $_POST['collectionTypeAgainst_Id'], $Id = "0"));
		}
	}
	public function MobilePaymentInfoDetails_list()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];			
			echo json_encode($this->GM->MobilePaymentInfoDetails($_POST['Invoice_Id']));
		}
	}
	public function Bank()
	{
		echo json_encode($this->GM->Bank());
	}
	public function dealer()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			$_POST['limitbegin'] =	(isset($_POST['limitbegin'])) ? $_POST['limitbegin'] : '10';
			$_POST['limit'] =	(isset($_POST['limit'])) ? $_POST['limit'] : '30';
			echo json_encode($this->GM->DealerForSalesExecutive($_POST['id'], 0, $_POST['UId'], $_POST['limitbegin'], $_POST['limit']));
		}
	}
	public function dealerDetails()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			echo json_encode($this->GM->Dealer($_POST['id'], $status = "1"));
		}
	}
	public function dealeroptionload()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			$_POST['limitbegin'] =	0;
			$_POST['limit'] =	0;
			$data = $this->GM->DealerForSalesExecutive($_POST['id'], 1, $_POST['UId'], $_POST['limitbegin'], $_POST['limit']);
			$this->GM->Option_($data, 'Dealer_Id', 'name', '', '', 0);
                             
		}
	}
	public function DriverCollectionDealer()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			echo json_encode($this->GM->Dealer(0, 1, 0));
		}
	}
	public function dealerDocument()
	{
		
		$directory = log_directory . "/" . $_POST['db'] . "/6/" . $_POST['id'];
		if (!is_dir($directory)) {
			mkdir($directory, 0777, TRUE);
		}
		$map = directory_map($directory);
		//print_r($map);
		$count = 0;
		$arrayname = array();
		foreach ($map as $file) {
			$arrayname[$count]['url'] =  base_url($directory . "/" . $file);
			$arrayname[$count]['name'] =   $file;
			$count++;
		}
		echo json_encode($arrayname);
	}
	public function dealerAmountInfo()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			echo json_encode($this->GM->DealerAmountInfo($_POST['id'], 1));
		}
	}
	//Dealer End
	//Plumber start
	public function AddPlumber()
	{
		if ($this->MobileAPIClass->Plumber_Validation()) {
			if ($message = $this->MobileAPIClass->AddPlumber_Save()) {
				$data = array(
					'responsestatus' => '1',
					'Message' => $message
				);
			} else {
				$data = array(
					'responsestatus' => '2',
					'Message' => 'Plumber is not Saved'
				);
			}
		} else {
			$data = array(
				'responsestatus' => '0',
				'Message' => 'Missing Details'
			);
		}
		echo json_encode($data);
	}
	public function EditPlumber()
	{
		if ($this->MobileAPIClass->Plumber_Validation()) {
			if ($message = $this->MobileAPIClass->EditPlumber_Save()) {
				$data = array(
					'responsestatus' => '1',
					'Message' => $message
				);
			} else {
				$data = array(
					'responsestatus' => '2',
					'Message' => 'Plumber is not Saved'
				);
			}
		} else {
			$data = array(
				'responsestatus' => '0',
				'Message' => 'Missing Details'
			);
		}
		echo json_encode($data);
	}
	public function Plumber()
	{
		echo json_encode($this->GM->mobile_Plumber($_POST['id'], 1, $_POST['UId'], $_POST['db']));
	}
	public function Plumber_Doc()
	{
		$directory = log_directory . "" . $_POST['db'] . "/7/" . $_POST['plumber_Id'];
		if (!is_dir($directory)) {
			mkdir($directory, 0777, TRUE);
		}
		$map = directory_map($directory);
		$data = array();
		$i = 0;
		foreach ($map as $file) {
			$data[$i]['url'] = base_url($directory . "/" . $file);
			$i++;
		}
		echo json_encode($data);
	}
	//Plumber End
	//common segment for all mobile users start
	//Common Get Data start
	public function salut()
	{
		echo json_encode($this->GM->Salut());
	}
	public function gender()
	{
		echo json_encode($this->GM->gender());
	}
	public function state()
	{
		$countryid = $_POST['id'];
		echo json_encode($this->GM->State(1, 0, $countryid));
	}
	public function country()
	{
		echo json_encode($this->GM->Country(1, 0, ''));
	}
	//Common Get Data End
	//login start
	public function login()
	{
		if ((!isset($_POST['Username'])) || (!isset($_POST['Password']))) {
			$data = array(
				'status' => '0',
				'Message' => 'Email or Password cannot be blank.'
			);
		} else {
			$qry = "execute cosmo.dbo.Pro_Login '" . $_POST['Username'] . "','" . md5($_POST['Password']) . "','1','0'";
			$Mainresult = $this->db->query($qry);
			$res = $Mainresult->row();
			if (isset($res->status)) {
				if ($res->status == 1) {
					$data = array(
						'UId' => $res->userid,
						'URole' => $res->userroleid,
						'userdatabasename' => $res->Current_Database,
						'switchaccess' => $res->switchaccess,
						'status' => '1',
						'Message' => 'Welcome'
					);
				} else {
					$data = array(
						'status' => '2',
						'Message' => 'Incorrect Email or Password.'
					);
				}
			} else {
				$data = array(
					'status' => '3',
					'Message' => 'Email or Password is Incorrect.'
				);
			}
		}
		echo json_encode($data);
	}
	//login end 
	//Dashboard Start
	public function profile()
	{
		if ((!isset($_POST['UId'])) || (!isset($_POST['URole'])) || (!isset($_POST['db']))) {
			$data = array(
				'responsestatus' => '0',
				'Message' => 'Details Missing!'
			);
		} else {
			$data = $this->GM->mobile_profile($_POST['UId'], $_POST['URole'], $_POST['db']);
			if ($data) {
				$data = $data[0];
				$data->responsestatus = '1';
				$data->Message = 'Welcome';
			} else {
				$data = array(
					'responsestatus' => '2',
					'Message' => 'Not Found'
				);
			}
		}
		echo json_encode($data);
	}
	//Dashboard end
	//Device Start
	public function devicestatus()
	{
		if (isset($_POST['DId'])) {
			$val = false;
			foreach ($this->GM->Device($_POST['DId'], '1') as $Device) {
				if ($Device->Device_Status_Status_Id == '3') {
					$val = $Device->Device_Id;
				}
			}
			if ($val) {
				$data = array(
					'responsestatus' => '1',
					'Device_id' => $val,
					'Message' => 'Device is in Active State'
				);
			} else {
				$data = array(
					'responsestatus' => '2',
					'Message' => '(Re-)Register Device'
				);
			}
		} else {
			$data = array(
				'responsestatus' => '0',
				'Message' => 'Missing Device Details'
			);
		}
		echo json_encode($data);
	}
	public function  devicedetails()
	{
		if ($this->MobileAPIClass->devicedetails_Validation()) {
			if ($val = $this->MobileAPIClass->devicedetails_Save()) {
				$data = array(
					'responsestatus' => '1',
					'Device_id' => $val,
					'Message' => 'Device Registered Successfully'
				);
			} else {
				$data = array(
					'responsestatus' => '2',
					'Device_id' => $val,
					'Message' => 'Device is in InActive State'
				);
			}
		} else {
			$data = array(
				'responsestatus' => '0',
				'Message' => 'Missing Device Details'
			);
		}
		echo json_encode($data);
	}
	public function alldealeroptionload()
	{
		if (isset($_POST['db'])) {
			$_SESSION['currentdatabasename'] = $_POST['db'];
			$_POST['limitbegin'] =	0;
			$_POST['limit'] =	0;
			$data = $this->GM->DealerForSalesExecutive($_POST['id'], 0, $_POST['UId'], $_POST['limitbegin'], $_POST['limit']);
			$this->GM->Option_($data, 'Dealer_Id', 'name', '', '', 0);
                             
		}
	}
	function Device_codeconfirm()
	{
		if ($this->MobileAPIClass->DeviceCodeConfirmation_Validation()) {
			if ($val = $this->MobileAPIClass->DeviceCodeConfirmation_Save()) {
				if (!empty($val)) {
					$data = array(
						'responsestatus' => '1',
						'Device_id' => $val,
						'Message' => 'Device Verified Successfully'
					);
				} else {
					$data = array(
						'responsestatus' => '2',
						'Message' => 'Incorrect Code'
					);
				}
			} else {
				$data = array(
					'responsestatus' => '3',
					'Message' => 'Incorrect Code'
				);
			}
		} else {
			$data = array(
				'responsestatus' => '0',
				'Message' => 'Please enter the Code'
			);
		}
		echo json_encode($data);
	}
	//Device End
	//common segement for all mobile users end
}
