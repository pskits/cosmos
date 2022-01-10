<?php
class MobileAPIClass extends CI_Model
{
		//Alter_Password
	function Alter_Password()
	{
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		if ($this->form_validation->run() == FALSE) {
			return false;
		} else {
			$qry =  "cosmo.dbo.Alter_Password '" . md5($_POST['password']) . "'			
			,'" . $_POST['User_Id'] . "'	,'" . $_POST['User_Id'] . "'	
		";
		$query = $this->db->query($qry);
		if($query)
		{return true;
		}
		else
		{
			return false;
		}
	}
	}
	//Collection
	function Collection_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('db', 'db', 'required');
		$this->form_validation->set_rules('URole', 'URole', 'required');
		$this->form_validation->set_rules('Portal_Id', 'Portal_Id', 'required');
		$this->form_validation->set_rules('AddCollection_Dealer', 'AddCollection_Dealer', 'required');
		//$this->form_validation->set_rules('lat', 'lat', 'required');
		//$this->form_validation->set_rules('lng', 'lng', 'required');
		$this->form_validation->set_rules('AmountMode_id', 'AmountMode_id', 'required');
		// $this->form_validation->set_rules('collectiontype_id', 'collectiontype_id', 'required');
		$this->form_validation->set_rules('collectiontypeagainst_id[]', 'collectiontypeagainst_id', 'required');
		$this->form_validation->set_rules('collectionprocess_id', 'collectionprocess_id', 'required');
		$this->form_validation->set_rules('collectionprocessagainst_id', 'collectionprocessagainst_id', 'required');
		$this->form_validation->set_rules('amount', 'amount', 'required');
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
		$this->form_validation->set_rules('description', 'description', 'required');
		$this->form_validation->set_rules('collection_status_id', 'collection_status_id', 'required');
		$this->form_validation->set_rules('Abut', 'Abut', 'required');
		if ($this->form_validation->run() == FALSE) {
			return false;
		} else {
			return true;
		}
	}
	function Collection_Save()
	{
		$qry =  $_POST['db'] . ".dbo.Exec_Collection '" . $_POST['AddCollection_Dealer'] . "'
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
			$query = true;
			foreach ($collectiontypeagainst_id as $key => $n) {
				$qry = '';
				if ($query == false) {
					return false;
					exit;
				}
				if ($InvoicePayAmount[$key] > 0) {
					if ($collectiontypeagainst_id[$key] == '-1') {
						$_POST['collectiontype_id'] = '1';
					} else {
						$_POST['collectiontype_id'] = '2';
					}
					$qry = $_POST['db'] . ".dbo.Exec_CollectionAmount '" . $lastid . "'	
						,'" . $_POST['collectiontype_id'] . "'
						,'" . $collectiontypeagainst_id[$key] . "'		
						,'" . $InvoicePayAmount[$key] . "'	
						,'" . $_POST['User_Id'] . "'	
						,'1'
						,'" . $_POST['Abut'] . "'	
						";
					$query = $this->GM->prdinsert($qry);
				}
			}
			if ($query == false) {
				return false;
			} else {
				return true;
			}
		} else {
			return false;
		}
	}
	//Attendance
	function AttendanceTime_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('db', 'db', 'required');
		$this->form_validation->set_rules('URole', 'URole', 'required');
		$this->form_validation->set_rules('Attendance_type_id', 'Attendance_type_id', 'required');
		$this->form_validation->set_rules('lat', 'lat', 'required');
		$this->form_validation->set_rules('lng', 'lng', 'required');
		$this->form_validation->set_rules('description', 'description', 'required');
		$this->form_validation->set_rules('But', 'But', 'required');
		$this->form_validation->set_rules('AttendanceTime_Id', 'AttendanceTime_Id', 'required');
		if ($this->form_validation->run() == FALSE) {
			return false;
		} else {
			return true;
		}
	}
	function AttendanceTime_Save()
	{
		$qry = $_POST['db'] . ".dbo.Exec_Attendance 
		'" . $_POST['URole'] . "'
		,'" . $_POST['User_Id'] . "'
		,'" . $_POST['Attendance_type_id'] . "'
		,'" . $_POST['lat'] . "'
		,'" . $_POST['lng'] . "'
		,'" . $_POST['description'] . "'
		,'" . $_POST['User_Id'] . "','1'
		,'" . $_POST['But'] . "'
		,'" . $_POST['AttendanceTime_Id'] . "'";
		$query = $this->db->query($qry);
		if ($query) {
			$MGS = $query->row();
			$message = $MGS->MGS;
		} else {
			$message = "Attendance Not Saved";
		}
		return $message;
	}
	//Trip Start
	function TripStatusloaded_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('UId', 'UId', 'required');
		$this->form_validation->set_rules('db', 'db', 'required');
		$this->form_validation->set_rules('URole', 'URole', 'required');
		$this->form_validation->set_rules('tripstatus_Id', 'tripstatus_Id', 'required');
		$this->form_validation->set_rules('GoodsStatus_Id', 'GoodsStatus_Id', 'required');
		$this->form_validation->set_rules('TripInvoiceStatus_Id', 'TripInvoiceStatus_Id', 'required');
		$this->form_validation->set_rules('TripSalesReturnStatus_Id', 'TripSalesReturnStatus_Id', 'required');
		$this->form_validation->set_rules('trip_Id', 'trip_Id', 'required');
		if ($this->form_validation->run() == FALSE) {
			return false;
		} else {
			return true;
		}
	}
	function TripStatusloaded_Save()
	{
		$qry = $_POST['db'] . ".dbo.Exec_TripStatusloaded 
		'" . $_POST['tripstatus_Id'] . "'
		,'" . $_POST['GoodsStatus_Id'] . "'
		,'" . $_POST['TripInvoiceStatus_Id'] . "'
		,'" . $_POST['TripSalesReturnStatus_Id'] . "'
		,'" . $_POST['UId'] . "'
		,'" . $_POST['trip_Id'] . "'";
		$query = $this->db->query($qry);
		if ($query) {
			$MGS = $query->row();
			$message = $MGS->MGS;
		} else {
			$err = $this->db->error();
			$err = $err['message'];
			$data = "The duplicate key value is";
			if (($out = strpos($err, "$data")) !== FALSE) {
				$Values_of_the_Message = substr($err, strpos($err, "$data") + 26);
				$message = $Values_of_the_Message . "Same Data Already Exist";
			} else {
				$message = "Same Data Already Exist";
			}
		}
		return $message;
	}
	//deposit
	function AddDeposit_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('db', 'db', 'required');
		$this->form_validation->set_rules('URole', 'URole', 'required');
		$this->form_validation->set_rules('Bank_Id', 'Bank_Id', 'required');
		//$this->form_validation->set_rules('lat', 'lat', 'required');
		//$this->form_validation->set_rules('lng', 'lng', 'required');
		$this->form_validation->set_rules('AmountMode_id', 'AmountMode_id', 'required');
		$this->form_validation->set_rules('Collection_Id[]', 'Collection_Id', 'required');
		$this->form_validation->set_rules('Branch', 'Branch', 'required');
		$this->form_validation->set_rules('description', 'description', 'required');
		$this->form_validation->set_rules('Deposit_status_id', 'Deposit_status_id', 'required');
		$this->form_validation->set_rules('Abut', 'Abut', 'required');
		if ($this->form_validation->run() == FALSE) {
			return false;
		} else {
			return true;
		}
	}
	function AddDeposit_Save()
	{
		$qry = $_POST['db'] . ".dbo.Exec_Deposit '" . $_POST['Bank_Id'] . "'
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
			$qry = '';
			foreach ($Collection_Id as $key => $n) {
				
				$qry .="Exec ". $_POST['db'] . ".dbo.Exec_Depositcollection '" . $lastid . "'				
												,'" . $Collection_Id[$key] . "'			
												,'" . $_POST['User_Id'] . "'
												,'1'
												,'" . $_POST['Abut'] . "';";
				
			}
			$query = $this->GM->prdinsert($qry);
			return $lastid;
		} else {
			return false;
		}
	}
	// Exec_TripSalesReturn_Pickup
	function TripSalesReturnPickup_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('UId', 'UId', 'required');
		$this->form_validation->set_rules('db', 'db', 'required');
		$this->form_validation->set_rules('URole', 'URole', 'required');
		$this->form_validation->set_rules('SalesReturn_id', 'SalesReturn_id', 'required');
		$this->form_validation->set_rules('tripSalesReturnstatus_id', 'tripSalesReturnstatus_id', 'required');
		$this->form_validation->set_rules('GoodsReturned_status_id', 'GoodsReturned_status_id', 'required');
		$this->form_validation->set_rules('GoodsDelivered_status_id', 'GoodsDelivered_status_id', 'required');
		$this->form_validation->set_rules('lat', 'lat', 'required');
		$this->form_validation->set_rules('lng', 'lng', 'required');
		if ($this->form_validation->run() == FALSE) {
			return false;
		} else {
			return true;
		}
	}
	function TripSalesReturnPickup_Save()
	{
		$qry = $_POST['db'] . ".dbo.Exec_TripSalesReturn_Pickup 
		'" . $_POST['SalesReturn_id'] . "'
		,'" . $_POST['tripSalesReturnstatus_id'] . "'
		,'" . $_POST['GoodsReturned_status_id'] . "'
		,'" . $_POST['GoodsDelivered_status_id'] . "'
		,'" . $_POST['lat'] . "','" . $_POST['lng'] . "','" . $_POST['UId'] . "'";
		$query = $this->db->query($qry);
		if ($query) {
			$MGS = $query->row();
			$message = $MGS->MGS;
		} else {
			$err = $this->db->error();
			$err = $err['message'];
			$data = "The duplicate key value is";
			if (($out = strpos($err, "$data")) !== FALSE) {
				$Values_of_the_Message = substr($err, strpos($err, "$data") + 26);
				$message = $Values_of_the_Message . "Same Data Already Exist";
			} else {
				$message = "Same Data Already Exist";
			}
		}
		return $message;
	}
	//Trip End
	function TripStatusCompleted_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('db', 'db', 'required');
		$this->form_validation->set_rules('URole', 'URole', 'required');
		$this->form_validation->set_rules('tripstatus_Id', 'tripstatus_Id', 'required');
		$this->form_validation->set_rules('trip_Id', 'trip_Id', 'required');
		if ($this->form_validation->run() == FALSE) {
			return false;
		} else {
			return true;
		}
	}
	function TripStatusCompleted_Save()
	{
		$qry = $_POST['db'] . ".dbo.Exec_TripStatusCompleted 
		'" . $_POST['tripstatus_Id'] . "'	
		,'" . $_POST['User_Id'] . "'
		,'" . $_POST['trip_Id'] . "'";
		$query = $this->db->query($qry);
		if ($query) {
			$MGS = $query->row();
			$message = $MGS->MGS;
		} else {
			$err = $this->db->error();
			$err = $err['message'];
			$data = "The duplicate key value is";
			if (($out = strpos($err, "$data")) !== FALSE) {
				$Values_of_the_Message = substr($err, strpos($err, "$data") + 26);
				$message = $Values_of_the_Message . "Same Data Already Exist";
			} else {
				$message = "Same Data Already Exist";
			}
		}
		return $message;
	}
	function TripStart_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('db', 'db', 'required');
		$this->form_validation->set_rules('URole', 'URole', 'required');
		$this->form_validation->set_rules('tripstatus_Id', 'tripstatus_Id', 'required');
		$this->form_validation->set_rules('trip_Id', 'trip_Id', 'required');
		if ($this->form_validation->run() == FALSE) {
			return false;
		} else {
			return true;
		}
	}
	function TripStart_Save()
	{
		$qry = $_POST['db'] . ".dbo.Exec_TripStart 
		'" . $_POST['trip_Id'] . "'	
		,'" . $_POST['tripstatus_Id'] . "'
		,'" . $_POST['User_Id'] . "'";
		$query = $this->db->query($qry);
		if ($query) {
			$MGS = $query->row();
			$message = $MGS->MGS;
		} else {
			$err = $this->db->error();
			$err = $err['message'];
			$data = "The duplicate key value is";
			if (($out = strpos($err, "$data")) !== FALSE) {
				$Values_of_the_Message = substr($err, strpos($err, "$data") + 26);
				$message = $Values_of_the_Message . "Same Data Already Exist";
			} else {
				$message = "Same Data Already Exist";
			}
		}
		return $message;
	}
	function TripEnd_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('db', 'db', 'required');
		$this->form_validation->set_rules('URole', 'URole', 'required');
		$this->form_validation->set_rules('tripstatus_Id', 'tripstatus_Id', 'required');
		$this->form_validation->set_rules('trip_Id', 'trip_Id', 'required');
		if ($this->form_validation->run() == FALSE) {
			return false;
		} else {
			return true;
		}
	}
	function TripEnd_Save()
	{
		$qry = $_POST['db'] . ".dbo.Exec_TripEnd 
		'" . $_POST['trip_Id'] . "'	
		,'" . $_POST['tripstatus_Id'] . "'
		,'" . $_POST['User_Id'] . "'";
		$query = $this->db->query($qry);
		if ($query) {
			$MGS = $query->row();
			$message = $MGS->MGS;
		} else {
			$err = $this->db->error();
			$err = $err['message'];
			$data = "The duplicate key value is";
			if (($out = strpos($err, "$data")) !== FALSE) {
				$Values_of_the_Message = substr($err, strpos($err, "$data") + 26);
				$message = $Values_of_the_Message . "Same Data Already Exist";
			} else {
				$message = "Same Data Already Exist";
			}
		}
		return $message;
	}
	//Trip checkpoints
	function TripCheckpoint_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('db', 'db', 'required');
		$this->form_validation->set_rules('URole', 'URole', 'required');
		$this->form_validation->set_rules('trip_Id', 'trip_Id', 'required');
		$this->form_validation->set_rules('trip_km', 'trip_km', 'required');
		//$this->form_validation->set_rules('lat', 'lat', 'required');
		//$this->form_validation->set_rules('lng', 'lng', 'required');
		$this->form_validation->set_rules('checkpointstype_id', 'checkpointstype_id', 'required');
		if ($this->form_validation->run() == FALSE) {
			return false;
		} else {
			return true;
		}
	}
	function TripCheckpointMidway_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('db', 'db', 'required');
		$this->form_validation->set_rules('URole', 'URole', 'required');
		$this->form_validation->set_rules('trip_Id', 'trip_Id', 'required');
		$this->form_validation->set_rules('lat', 'lat', 'required');
		$this->form_validation->set_rules('lng', 'lng', 'required');
		$this->form_validation->set_rules('checkpointstype_id', 'checkpointstype_id', 'required');
		if ($this->form_validation->run() == FALSE) {
			return false;
		} else {
			return true;
		}
	}
	function TripCheckpoint_Save()
	{
		$qry = $_POST['db'] . ".dbo.Exec_TripCheckpoint 	'" . $_POST['trip_Id'] . "'
        ,'" . $_POST['checkpointstype_id'] . "'
		,'" . $_POST['trip_km'] . "'
		,'" . $_POST['lat'] . "'
		,'" . $_POST['lng'] . "'
		,'" . $_POST['User_Id'] . "'
		,1";
		$query = $this->db->query($qry);
		if ($query) {
			$MGS = $query->row();
			$message = $MGS->MGS;
		} else {
			$err = $this->db->error();
			$err = $err['message'];
			$data = "The duplicate key value is";
			if (($out = strpos($err, "$data")) !== FALSE) {
				$Values_of_the_Message = substr($err, strpos($err, "$data") + 26);
				$message = $Values_of_the_Message . "Same Data Already Exist";
			} else {
				$message = "Same Data Already Exist";
			}
		}
		return $message;
	}
	//Addinvoicegoods
	function addInvoicegoods_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('Serial_No', 'Serial_No', 'required');
		$this->form_validation->set_rules('goods_status_Id', 'goods_status_Id', 'required');
		$this->form_validation->set_rules('invoiceid', 'invoiceid', 'required');
		$this->form_validation->set_rules('productid', 'productid', 'required');
		$this->form_validation->set_rules('db', 'db', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', 'Fill in All Required Details');
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function addInvoicegoods_Save()
	{
		$_POST['Serial_No'] = explode(" ", $_POST['Serial_No']);
		$_POST['Serial_No']=array_unique($_POST['Serial_No']);
		$qry = "";
		foreach($_POST['Serial_No'] as $Serial_No)
		{
		 $qry .= "Exec ".$_POST['db'].".dbo.exec_Invoicegoods '" . $Serial_No . "'		
		,'" . $_POST['productid'] . "'
			,'" . $_POST['invoiceid'] . "'
			,'" . $_POST['goods_status_Id'] . "'
     		,'" . $_POST['User_Id'] . "';";
		
		
	}
	$query = $this->db->query($qry);
	
		if ($query) {
			$message['GoodsStatus_Id']=$_POST['goods_status_Id'];
		} else {
			$err = $this->db->error();
			$err = $err['message'];
			$data = "The duplicate key value is";
			if (($out = strpos($err, "$data")) !== FALSE) {
				$Values_of_the_Message = substr($err, strpos($err, "$data") + 26);
				$message = $Values_of_the_Message . "Same Data Already Exist";
			} else {
				$message = "Same Data Already Exist";
			}
		}
		return $message;
	}
	
	
	function addReplacementgoods_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('Serial_No', 'Serial_No', 'required');
		$this->form_validation->set_rules('goods_status_Id', 'goods_status_Id', 'required');
		$this->form_validation->set_rules('SalesReturn_Id', 'SalesReturn_Id', 'required');
		$this->form_validation->set_rules('productid', 'productid', 'required');
		$this->form_validation->set_rules('db', 'db', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', 'Fill in All Required Details');
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function addReplacementgoods_Save()
	{
		$qry = $_POST['db'] . ".dbo.exec_Replacementgoods '" . $_POST['Serial_No'] . "'		
		,'" . $_POST['productid'] . "'
			,'" . $_POST['SalesReturn_Id'] . "'
			,'" . $_POST['goods_status_Id'] . "'
     		,'" . $_POST['User_Id'] . "'";
		//print_r($qry); exit;
		$query = $this->db->query($qry);
		if ($query) {			
			$message = $query->row();
		} else {
			$message = "Not Processed";
		}
		return $message;
	}
	//InvoicegoodsDelivery
	function InvoicegoodsDelivery_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('Serial_No', 'Serial_No', 'required');
		$this->form_validation->set_rules('goods_status_Id', 'goods_status_Id', 'required');
		$this->form_validation->set_rules('invoiceid', 'invoiceid', 'required');
		$this->form_validation->set_rules('productid', 'productid', 'required');
		$this->form_validation->set_rules('db', 'db', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', 'Fill in All Required Details');
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function InvoicegoodsDelivery_Save()
	{
			$_POST['Serial_No'] = explode(" ", $_POST['Serial_No']);
			$_POST['Serial_No'] = array_unique($_POST['Serial_No']);
			$qry = "";
		foreach($_POST['Serial_No'] as $Serial_No)
		{
	
		$qry .= "Exec ".$_POST['db'] . ".dbo.exec_InvoicegoodsDelivery '" . trim($Serial_No) . "'		
		,'" . $_POST['productid'] . "'
			,'" . $_POST['invoiceid'] . "'
			,'" . $_POST['goods_status_Id'] . "'
     		,'" . $_POST['User_Id'] . "';";
		}	
	$query = $this->db->query($qry);
		if ($query) {
			$message['GoodsStatus_Id']=$_POST['goods_status_Id'];
		} else {

			$message = "Not Proceesed";
		}
		return $message;
	}
	function SalesReturngoodsDelivery_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('Serial_No', 'Serial_No', 'required');
		$this->form_validation->set_rules('goods_status_Id', 'goods_status_Id', 'required');
		$this->form_validation->set_rules('SalesReturn_Id', 'SalesReturn_Id', 'required');
		$this->form_validation->set_rules('productid', 'productid', 'required');
		$this->form_validation->set_rules('db', 'db', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', 'Fill in All Required Details');
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function SalesReturngoodsDelivery_Save()
	{
		$qry = $_POST['db'] . ".dbo.exec_SalesReturngoodsDelivery '" . $_POST['Serial_No'] . "'		
		,'" . $_POST['productid'] . "'
		,'" . $_POST['SalesReturn_Id'] . "'
		,'" . $_POST['goods_status_Id'] . "'
     	,'" . $_POST['User_Id'] . "'";
		$query = $this->db->query($qry);
		if ($query) {
			$message = $query->row();
		} else {

			$message = "Not Proceesed";
		}
		return $message;
	}
	function SalesReturnClaimedgoodsDelivery_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('Serial_No', 'Serial_No', 'required');
		$this->form_validation->set_rules('goods_status_Id', 'goods_status_Id', 'required');
		$this->form_validation->set_rules('SalesReturn_Id', 'SalesReturn_Id', 'required');
		$this->form_validation->set_rules('productid', 'productid', 'required');
		$this->form_validation->set_rules('db', 'db', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', 'Fill in All Required Details');
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}
	function SalesReturnClaimedgoodsDelivery_Save()
	{
		$qry = $_POST['db'] . ".dbo.exec_SalesReturnClaimedgoodsDelivery '" . $_POST['Serial_No'] . "'		
		,'" . $_POST['productid'] . "'
			,'" . $_POST['SalesReturn_Id'] . "'
			,'" . $_POST['goods_status_Id'] . "'
     		,'" . $_POST['User_Id'] . "'";
		$query = $this->db->query($qry);
		if ($query) {
			$message = $query->row();
		} else {

			$message = "Not Proceesed";
		}
		return $message;
	}
	//Exec_InvoiceStatusDelivered
	function InvoiceStatusDelivered_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('db', 'db', 'required');
		$this->form_validation->set_rules('URole', 'URole', 'required');
		$this->form_validation->set_rules('trip_Id', 'trip_Id', 'required');
		$this->form_validation->set_rules('AgainstType_Id', 'AgainstType_Id', 'required');
		$this->form_validation->set_rules('TripDeliveriestatus_Id', 'TripDeliveriestatus_Id', 'required');
		$this->form_validation->set_rules('Against_Id', 'Against_Id', 'required');
		//$this->form_validation->set_rules('lat', 'lat', 'required');
		//$this->form_validation->set_rules('lng', 'lng', 'required');
		if ($this->form_validation->run() == FALSE) {
			return false;
		} else {
			return true;
		}
	}
	function InvoiceStatusDelivered_Save()
	{
		$qry = $_POST['db'] . ".dbo.Exec_InvoiceStatusDelivered '" . $_POST['trip_Id'] . "'
        ,'" . $_POST['AgainstType_Id'] . "'
		  ,'" . $_POST['TripDeliveriestatus_Id'] . "'
		  ,'" . $_POST['Against_Id'] . "'
		,'" . $_POST['lat'] . "'
		,'" . $_POST['lng'] . "'		
		,'" . $_POST['User_Id'] . "'
		";
		$query = $this->db->query($qry);
		if ($query) {
			$MGS = $query->row();
			$message = $MGS->MGS;
		} else {
			$err = $this->db->error();
			$err = $err['message'];
			$data = "The duplicate key value is";
			if (($out = strpos($err, "$data")) !== FALSE) {
				$Values_of_the_Message = substr($err, strpos($err, "$data") + 26);
				$message = $Values_of_the_Message . "Same Data Already Exist";
			} else {
				$message = "Same Data Already Exist";
			}
		}
		return $message;
	}
	//Trip Delivery
	function TripInvoiceDelivery_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('UId', 'UId', 'required');
		$this->form_validation->set_rules('db', 'db', 'required');
		$this->form_validation->set_rules('URole', 'URole', 'required');
		$this->form_validation->set_rules('tripinvoicestatus_Id', 'tripinvoicestatus_Id', 'required');
		$this->form_validation->set_rules('Invoice_Id', 'Invoice_Id', 'required');
		$this->form_validation->set_rules('GoodsDeliveredStatus_Id', 'GoodsDeliveredStatus_Id', 'required');
		$this->form_validation->set_rules('lat', 'lat', 'required');
		$this->form_validation->set_rules('lng', 'lng', 'required');
		if ($this->form_validation->run() == FALSE) {
			return false;
		} else {
			return true;
		}
	}
	function TripInvoiceDelivery_Save()
	{
		$qry = $_POST['db'] . ".dbo.Exec_TripInvoice_delivery '" . $_POST['tripinvoicestatus_Id'] . "',	'" . $_POST['GoodsDeliveredStatus_Id'] . "'
      	,'" . $_POST['lat'] . "'
		,'" . $_POST['lng'] . "'
		,'" . $_POST['UId'] . "'
		,'" . $_POST['Invoice_Id'] . "'";
		$query = $this->db->query($qry);
		if ($query) {
			$MGS = $query->row();
			$message = $MGS->MGS;
		} else {
			$err = $this->db->error();
			$err = $err['message'];
			$data = "The duplicate key value is";
			if (($out = strpos($err, "$data")) !== FALSE) {
				$Values_of_the_Message = substr($err, strpos($err, "$data") + 26);
				$message = $Values_of_the_Message . "Same Data Already Exist";
			} else {
				$message = "Same Data Already Exist";
			}
		}
		return $message;
	}
	//GoodsStatusLoaded
	function GoodsStatusLoaded_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('db', 'db', 'required');
		$this->form_validation->set_rules('URole', 'URole', 'required');
		$this->form_validation->set_rules('Invoice_Id', 'Invoice_Id', 'required');
		$this->form_validation->set_rules('Product_Id', 'Product_Id', 'required');
		$this->form_validation->set_rules('fromgoodsstatus_id', 'fromgoodsstatus_id', 'required');
		$this->form_validation->set_rules('togoodsstatus_id', 'togoodsstatus_id', 'required');
		if ($this->form_validation->run() == FALSE) {
			return false;
		} else {
			return true;
		}
	}
	function GoodsStatusLoaded_Save()
	{
		$qry = $_POST['db'] . ".dbo.Exec_GoodsStatusLoaded '" . $_POST['Invoice_Id'] . "'
        ,'" . $_POST['Product_Id'] . "'
      	,'" . $_POST['fromgoodsstatus_id'] . "'
		,'" . $_POST['togoodsstatus_id'] . "'
		,'" . $_POST['User_Id'] . "'
		";
		$query = $this->db->query($qry);
		if ($query) {
			$MGS = $query->row();
			$message = $MGS->MGS;
		} else {

			$message = "Not Added";
		}
		return $message;
	}
	function ReplacementGoodsStatusLoaded_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('db', 'db', 'required');
		$this->form_validation->set_rules('URole', 'URole', 'required');
		$this->form_validation->set_rules('SalesReturn_Id', 'SalesReturn_Id', 'required');
		$this->form_validation->set_rules('Product_Id', 'Product_Id', 'required');
		$this->form_validation->set_rules('fromgoodsstatus_id', 'fromgoodsstatus_id', 'required');
		$this->form_validation->set_rules('togoodsstatus_id', 'togoodsstatus_id', 'required');
		if ($this->form_validation->run() == FALSE) {
			return false;
		} else {
			return true;
		}
	}
	function ReplacementGoodsStatusLoaded_Save()
	{
		$qry = $_POST['db'] . ".dbo.Exec_ReplacementGoodsStatusLoaded '" . $_POST['SalesReturn_Id'] . "'
        ,'" . $_POST['Product_Id'] . "'
      	,'" . $_POST['fromgoodsstatus_id'] . "'
		,'" . $_POST['togoodsstatus_id'] . "'
		,'" . $_POST['User_Id'] . "'
		";
		$query = $this->db->query($qry);
		if ($query) {
			$MGS = $query->row();
			$message = $MGS->MGS;
		} else {

			$message = "Not Added";
		}
		return $message;
	}
	function InvoiceStatusLoaded_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('db', 'db', 'required');
		$this->form_validation->set_rules('URole', 'URole', 'required');
		$this->form_validation->set_rules('trip_Id', 'trip_Id', 'required');
		$this->form_validation->set_rules('AgainstType_Id', 'AgainstType_Id', 'required');
		$this->form_validation->set_rules('TripDeliveriestatus_Id', 'TripDeliveriestatus_Id', 'required');
		$this->form_validation->set_rules('Against_Id', 'Against_Id', 'required');
		if ($this->form_validation->run() == FALSE) {
			return false;
		} else {
			return true;
		}
	}
	function InvoiceStatusLoaded_Save()
	{
		$qry = $_POST['db'] . ".dbo.Exec_InvoiceStatusLoaded '" . $_POST['trip_Id'] . "'
        ,'" . $_POST['AgainstType_Id'] . "'
      	,'" . $_POST['TripDeliveriestatus_Id'] . "'
		,'" . $_POST['Against_Id'] . "'
		,'" . $_POST['User_Id'] . "'
		";
		$query = $this->db->query($qry);
		if ($query) {
			$MGS = $query->row();
			$message = $MGS->MGS;
		} else {
			$err = $this->db->error();
			$err = $err['message'];
			$data = "The duplicate key value is";
			if (($out = strpos($err, "$data")) !== FALSE) {
				$Values_of_the_Message = substr($err, strpos($err, "$data") + 26);
				$message = $Values_of_the_Message . "Same Data Already Exist";
			} else {
				$message = "Same Data Already Exist";
			}
		}
		return $message;
	}
	// Trip Checkpoints End
	//Trip End
	//Dealer start
	function AddDealer_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('db', 'db', 'required');
		$this->form_validation->set_rules('URole', 'URole', 'required');
		$this->form_validation->set_rules('Area_id', 'Area_id', 'required');
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('shortname', 'shortname', 'required');
		$this->form_validation->set_rules('mobile', 'mobile', 'required');
		$this->form_validation->set_rules('alt_mobile', 'alt_mobile', 'required');
		$this->form_validation->set_rules('address', 'address', 'required');
		$this->form_validation->set_rules('city', 'city', 'required');
		$this->form_validation->set_rules('postcode', 'postcode', 'required');
		$this->form_validation->set_rules('State_Id', 'State_Id', 'required');
		$this->form_validation->set_rules('Country_Id', 'Country_Id', 'required');
		$this->form_validation->set_rules('lat', 'lat', 'required');
		$this->form_validation->set_rules('lng', 'lng', 'required');
		$this->form_validation->set_rules('TradeLicenceNumber', 'TradeLicenceNumber', 'required');
		$this->form_validation->set_rules('trn_no', 'trn_no', 'required');
		if ($this->form_validation->run() == FALSE) {
			return false;
		} else {
			return true;
		}
	}
	function AddDealer_Save()
	{
		$qry = $_POST['db'] . ".dbo.Create_Dealer '" . $_POST['Area_id'] . "'
		,'" . $_POST['name'] . "'
        ,'" . $_POST['shortname'] . "'
		,'" . $_POST['email'] . "'
		,'" . $_POST['mobile'] . "'
		,'" . $_POST['alt_mobile'] . "'		
		,'" . $_POST['address'] . "'
		,'" . $_POST['city'] . "'
		,'" . $_POST['postcode'] . "'
		,'" . $_POST['State_Id'] . "'
		,'" . $_POST['Country_Id'] . "'
		,'" . $_POST['lat'] . "'
		,'" . $_POST['lng'] . "'
		,'" . $_POST['TradeLicenceNumber'] . "'	
		,'" . $_POST['trn_no'] . "'	
		,'2'			
		,'" . $_POST['User_Id'] . "'		
		";
		$query = $this->db->query($qry);
		if ($query) {
			$MGS = $query->row();
			$message = $MGS->MGS;
		} else {
			$err = $this->db->error();
			$err = $err['message'];
			$data = "The duplicate key value is";
			if (($out = strpos($err, "$data")) !== FALSE) {
				$Values_of_the_Message = substr($err, strpos($err, "$data") + 26);
				$message = $Values_of_the_Message . "Same Data Already Exist";
			} else {
				$message = "Same Data Already Exist";
			}
		}
		return $message;
	}
	//Dealer End
	//Plumber start
	function Plumber_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('db', 'db', 'required');
		$this->form_validation->set_rules('URole', 'URole', 'required');
		$this->form_validation->set_rules('Salut_Id', 'Salut_Id', 'required');
		$this->form_validation->set_rules('firstname', 'firstname', 'required');
		$this->form_validation->set_rules('lastname', 'lastname', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('mobile', 'mobile', 'required');
		$this->form_validation->set_rules('alt_mobile', 'alt_mobile', 'required');
		$this->form_validation->set_rules('Gender', 'Gender', 'required');
		$this->form_validation->set_rules('address', 'address', 'required');
		$this->form_validation->set_rules('city', 'city', 'required');
		$this->form_validation->set_rules('postcode', 'postcode', 'required');
		$this->form_validation->set_rules('State_Id', 'State_Id', 'required');
		$this->form_validation->set_rules('Country_Id', 'Country_Id', 'required');
		$this->form_validation->set_rules('Geo', 'Geo', 'required');
		$this->form_validation->set_rules('TradeLicenceNumber', 'TradeLicenceNumber', 'required');
		if ($this->form_validation->run() == FALSE) {
			return false;
		} else {
			return true;
		}
	}
	function EditPlumber_Save()
	{
		$qry = $_POST['db'] . ".dbo.Alter_Plumber '" . $_POST['Salut_Id'] . "'
		,'" . $_POST['firstname'] . "'
		,'" . $_POST['lastname'] . "'
        ,'" . $_POST['email'] . "'      
		,'" . $_POST['mobile'] . "'
		,'" . $_POST['alt_mobile'] . "'		
		,'" . $_POST['Gender'] . "'	
		,'" . $_POST['TradeLicenceNumber'] . "'	
		,'" . $_POST['address'] . "'
		,'" . $_POST['city'] . "'
		,'" . $_POST['postcode'] . "'
		,'" . $_POST['State_Id'] . "'
		,'" . $_POST['Country_Id'] . "'		
		,'" . $_POST['Geo'] . "'			
		,'" . $_POST['User_Id'] . "'
		,'1'
		";
		$query = $this->db->query($qry);
		if ($query) {
			$MGS = $query->row();
			$message = $MGS->MGS;
		} else {
			$err = $this->db->error();
			$err = $err['message'];
			$data = "The duplicate key value is";
			if (($out = strpos($err, "$data")) !== FALSE) {
				$Values_of_the_Message = substr($err, strpos($err, "$data") + 26);
				$message = $Values_of_the_Message . "Same Data Already Exist";
			} else {
				$message = "Same Data Already Exist";
			}
		}
		return $message;
	}
	function AddPlumber_Save()
	{
		$qry = $_POST['db'] . ".dbo.Create_Plumber '" . $_POST['Salut_Id'] . "'
		,'" . $_POST['firstname'] . "'
		,'" . $_POST['lastname'] . "'
        ,'" . $_POST['email'] . "'      
		,'" . $_POST['mobile'] . "'
		,'" . $_POST['alt_mobile'] . "'		
		,'" . $_POST['Gender'] . "'	
		,'" . $_POST['TradeLicenceNumber'] . "'	
		,'" . $_POST['address'] . "'
		,'" . $_POST['city'] . "'
		,'" . $_POST['postcode'] . "'
		,'" . $_POST['State_Id'] . "'
		,'" . $_POST['Country_Id'] . "'		
		,'" . $_POST['Geo'] . "'			
		,'" . $_POST['User_Id'] . "'
		,'1'
		";
		$query = $this->db->query($qry);
		if ($query) {
			$MGS = $query->row();
			$message = $MGS->MGS;
		} else {
			$err = $this->db->error();
			$err = $err['message'];
			$data = "The duplicate key value is";
			if (($out = strpos($err, "$data")) !== FALSE) {
				$Values_of_the_Message = substr($err, strpos($err, "$data") + 26);
				$message = $Values_of_the_Message . "Same Data Already Exist";
			} else {
				$message = "Same Data Already Exist";
			}
		}
		return $message;
	}
	//Plumber End
	//device start
	function devicedetails_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		// $this->form_validation->set_rules('UId', 'UId', 'required');
		// $this->form_validation->set_rules('URole', 'URole', 'required');
		$this->form_validation->set_rules('db', 'db', 'required');
		$this->form_validation->set_rules('isVirtual', 'isVirtual', 'required');
		$this->form_validation->set_rules('manufacturer', 'manufacturer', 'required');
		$this->form_validation->set_rules('model', 'model', 'required');
		$this->form_validation->set_rules('platform', 'platform', 'required');
		$this->form_validation->set_rules('serial', 'serial', 'required');
		// $this->form_validation->set_rules('uuid', 'uuid', 'required');
		$this->form_validation->set_rules('version', 'version', 'required');
		$this->form_validation->set_rules('our_uid', 'our_uid', 'required');
		if ($this->form_validation->run() == FALSE) {
			return false;
		} else {
			return true;
		}
	}
	function devicedetails_Save()
	{
		 $qry = "exec cosmo.dbo.register_device '" . $_POST['isVirtual'] . "'
		,'" . $_POST['manufacturer'] . "'
		,'" . $_POST['model'] . "'
		,'" . $_POST['platform'] . "'
		,'" . $_POST['serial'] . "'
		,'" . $_POST['uuid'] . "'
		,'" . $_POST['version'] . "'
		,'" . $_POST['our_uid'] . "'
		,'" . $_POST['UId'] . "'
		,'1';        "; 
		$query = $this->db->query($qry);
		$id = false;
		$data = $query->result();
		if ($data[0]->Device_Id) {		
			
				$id = $data[0]->Device_Id;
			
		}
		return $id;
	}
	function DeviceCodeConfirmation_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('devicecode', 'devicecode', 'required');
		$this->form_validation->set_rules('deviceid', 'deviceid', 'required');
		if ($this->form_validation->run() == FALSE) {
			return false;
		} else {
			return true;
		}
	}
	function DeviceCodeConfirmation_Save()
	{
		 $qry = "exec cosmo.dbo.mobile_DeviceCodeConfirmation '" . $_POST['deviceid'] . "'
		,'" . $_POST['devicecode'] . "'	
        "; 
		$query = $this->db->query($qry);
		if ($query) {
			foreach ($query->result() as $Row) {
				$id = $Row->Device_Id;
			}
		}
		if (!empty($id)) {
			return $id;
		} else {
			return false;
		}
	}
	// Device end 
	//order start
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
					,'" . $_POST['User_Id'] . "'
					,'1'
					,'SAVE'
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
			$prdqry .= "Exec ".$_POST['db'] . ".dbo.Exec_AutoOrderApproval '" . $lastid . "', '" . $_POST['orders_dealer_id'] . "'";
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
	//SalesReturn start
	function SalesReturnRequest_Validation()
	{
		$_POST['AddSalesReturn_userid'] = $_POST['User_Id'];
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('db', 'db', 'required');
		$this->form_validation->set_rules('AddSalesReturnRequest_Dealer', 'AddSalesReturnRequest_Dealer', 'required');
		$this->form_validation->set_rules('AddSalesReturn_userid', 'AddSalesReturn_userid', 'required');
		$this->form_validation->set_rules('salesreturnrequest_reason', 'salesreturnrequest_reason', 'required');
		$this->form_validation->set_rules('serialnolist[]', 'serialnolist[]', 'required');
		$this->form_validation->set_rules('serialnoInvoice', 'serialnoInvoice', 'required');
		//$this->form_validation->set_rules('block', 'block', 'required');
		if ($this->form_validation->run() == FALSE) {
			return false;
		} else {
			return true;
		}
	}
	function SalesReturnRequest_Save()
	{
		$qry = $_POST['db'] . ".dbo.Exec_TransSalesReturnRequest '" . $_POST['AddSalesReturnRequest_Dealer'] . "'
		,'" . $_POST['AddSalesReturn_userid'] . "'	
		,'" . $_POST['salesreturnrequest_reason'] . "'	
		,'" . $_POST['User_Id'] . "'
		,'1'	
		";
		$query = $this->db->query($qry);
		$query = $query->result();
		foreach ($query as $Row) {
			$lastid =  $Row->LastID;
		}
		$this->db->close();
		if ($lastid) {
			//$this->db = $this->load->database($_POST['db'], TRUE);

			$serialnolist = $_POST['serialnolist'];
			foreach ($serialnolist as $key => $n) {
				$prdquery = false;
				$prdqry = "nil";
				$prdqry = $_POST['db'] . ".dbo.Exec_TransSalesReturnGoodsRequest '" . $lastid . "'	
									,'" . $_POST['serialnoInvoice'] . "'									
									,'" . $serialnolist[$key] . "'								
									,'" . $_POST['User_Id'] . "'
									,'1'
									 ";

				$prdquery = $this->GM->prdinsert($prdqry);
			}

			if ($prdquery) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	    function SalesReturnPaymentAdjust_Validation()
    {
        $this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
        $this->form_validation->set_rules('User_Id', 'User_Id', 'required');
        $this->form_validation->set_rules('SalesReturn_Id', 'SalesReturn_Id', 'required');
        $this->form_validation->set_rules('InvoicePayAmount[]', 'InvoicePayAmount', 'required');
        $this->form_validation->set_rules('Adjustableamount', 'Adjustableamount', 'required');
		 $this->form_validation->set_rules('Adjustableamount_check', 'Adjustableamount_check', 'required');
        if ($this->form_validation->run() == FALSE) {			
            return false;
        } else {
            return true;
        }
    }
    function SalesReturnPaymentAdjust_Save()
    {
        $totaladjusmentamount = '0';
        $prdquery = "0";
        $prdqry = "";
        $adjustableamount = $_POST['InvoicePayAmount'];
		$salesreturn_amount = $_POST['Adjustableamount'];
        foreach ($adjustableamount as $key => $n) {
            if (number_format($adjustableamount[$key]) > number_format('0.000')) {
                $totaladjusmentamount += $adjustableamount[$key];
                $prdqry .= "Exec " . $_SESSION['currentdatabasename'] . ".dbo.Exec_PaymentAdjustment '2','" . $_POST['SalesReturn_Id'] . "'
               ,'" . $adjustableamount[$key] . "'
                                 ,'4','" . $key . "'                              
                                 ,'" . $_POST['User_Id'] . "','1';";
            }
        }
        //echo $prdqry;exit;
        if ($salesreturn_amount >= $totaladjusmentamount) {
            $prdquery = $this->GM->prdinsert($prdqry);
            if ($prdquery) {              
				$msg='Saved';
            } else {
				$msg='NOt Saved';
                
            }
        } else {
$msg= 'Total Payment amount should be less than or Equal to SalesReturn Amount!!!';
            
        }
        return $msg ;
    }

	//SalesReturn end
}
