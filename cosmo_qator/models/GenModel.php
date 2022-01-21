<?php
class GenModel extends CI_Model
{
	//Getting Unique or All Dropdown Values 
	//mobile
	function Checkmobillogin($deviceuuid, $userid)
	{
		// Check_mobillogin
		$res = $this->db->query("exec cosmo.dbo.Check_mobillogin '" . $deviceuuid . "','" . $userid . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function Inventory($from_date, $to_date,$serial_no='', $transaction_no = "",$transaction_id = 0,$goodscondition_id = 0)
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_inventory '" . $from_date . "','" . $to_date."','" . $serial_no."','" . $transaction_no."','". $transaction_id."','". $goodscondition_id."'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	// mobile_profile
	function mobile_profile($uid, $userrole_Id, $db)
	{
		$res = $this->db->query('SELECT TOP 1 mur.user_Id FROM cosmo.dbo.mas_logincredentials ml 
		INNER JOIN cosmo.dbo.mas_Userofficerole mur ON mur.logincredentials_Id = ml.logincredentials_Id
		WHERE mur.user_Id <> 0 AND ml.logincredentials_Id = ' . $uid);
		foreach ($res->result() as $row) {
			$userid = $row->user_Id;
		}
		$res = $this->db->query('SELECT UserGetProcedure_Name FROM cosmo.dbo.Mas_UserRole WHERE UserRole_Id =' . $userrole_Id);
		foreach ($res->result() as $row) {
			$UserGetProcedure_Name = $row->UserGetProcedure_Name;
		}
		$res = $this->db->query('EXECUTE ' . $db . '.dbo.' . $UserGetProcedure_Name . ' ' . $userid);
		// echo $this->db->last_query();exit;
		if ($res) {
			return $res->result();
		} else {
			return false;
		}
	}
	//Get_InvoiceInventoryCount
	function InvoiceInventoryCount($Invoice_Id = "0", $Product_Id = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_InvoiceInventoryCount " . $Invoice_Id  . "," . $Product_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	// mobile_trip
	//Get_DealerAccsstoAllow
	function DealerAccsstoAllow($Dealer_ID = "0", $status = "0", $from_date='', $to_date='')
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_DealerAccsstoAllow " . $Dealer_ID . "," . $status.",'" . $from_date."','". $to_date."'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	// Trip
	function Mobile_Trip($status_Id = "1", $warehouse_id = "0", $area_Id = "0", $Truck_Id = "0", $DriverUser_Id = "0", $Helper_Id = "0", $Trip_status_Id = "0", $Id = "0", $from_date = '', $to_date = '', $db = '')
	{
		$res = $this->db->query('EXECUTE ' . $db . '.dbo.Get_TransDriverTrip ' . $status_Id . ',' . $warehouse_id . ',' . $area_Id . ',' . $Truck_Id . ',' . $DriverUser_Id . ',' . $Helper_Id . ',' . $Trip_status_Id . ',' . $Id . ",'" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Status
	function Status($status = "0")
	{
		$res = $this->db->query('EXECUTE cosmo.dbo.Get_Status ' . $status);
		return $res->result();
	}
	//purchase order and bill product insert
	//this is handled here t avoid a multiple onnection error in multiple product insertion
	function prdinsert($prdqry)
	{
		$res = $this->db->query($prdqry);
		if ($res) {
			return $res->result();
		} else {
			return false;
		}
	}
	//UserRole
	function UserRole($status = "1", $id = "0", $web = "0", $mobile = "0")
	{
		$res = $this->db->query('EXECUTE cosmo.dbo.Get_UserRole ' . $status . ',' . $id . ',' . $web . ',' . $mobile);
		return $res->result();
	}
	//Device
	function Device($status = "1", $id = "0")
	{
		$res = $this->db->query('EXECUTE cosmo.dbo.Get_Device ' . $status . ',' . $id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Supplier
	function Supplier($status_id = "1", $id = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_Supplier ' . $status_id .  ',' . $id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
		//ReturnbyUnadjustedReturns
	function SalesReturnwithUnadjusted($Dealer_ID = "0", $SalesReturn_Id = "0", $from_date='', $to_date='')
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_SalesReturnwithUnadjusted " . $Dealer_ID . "," . $SalesReturn_Id.",'" . $from_date."','". $to_date."'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//salut
	function Salut($status = "1", $id = "0")
	{
		$res = $this->db->query('EXECUTE cosmo.dbo.Get_Salut ' . $status . ',' . $id);
		return $res->result();
	}
	//gender
	function gender($status = "1", $id = "0")
	{
		$res = $this->db->query('EXECUTE cosmo.dbo.Get_gender ' . $status . ',' . $id);
		return $res->result();
	}
	//Currency
	function Currency($StatusID = "1", $id = "0")
	{
		$res = $this->db->query('EXECUTE cosmo.dbo.Get_Currency ' . $StatusID . ',' . $id);
		//echo $this->db->last_query();exit;
		return $res->result();
	}
	//Bank
	function Bank($StatusID = "1", $id = "0")
	{
		$res = $this->db->query('EXECUTE cosmo.dbo.Get_Bank ' . $StatusID . ',' . $id);
		//echo $this->db->last_query();exit;
		return $res->result();
	}
	//country
	function Country($StatusID = "1", $id = "0", $countrycode = "")
	{
		$res = $this->db->query("EXECUTE cosmo.dbo.Get_Country " . $StatusID . "," . $id . ",'" . $countrycode . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//State
	function State($StatusID = "1", $ID = "0", $countryid = "0")
	{
		$res = $this->db->query('EXECUTE cosmo.dbo.Get_State ' . $StatusID . ',' . $ID . ',' . $countryid);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Area
	function Area($StatusID = "1", $ID = "0", $Warehouse_Id = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_Area ' . $StatusID . ',' . $ID . ',' . $Warehouse_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//SalesExecutiveArea
	function SalesExecutiveArea($SalesExecutiveuser_Id, $ID = "0", $StatusID = "0", $Warehouse_Id = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_SalesExecutiveArea ' . $SalesExecutiveuser_Id . ',' . $StatusID . ',' . $ID . ',' . $Warehouse_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Goodsstatus
	function Get_Goodsstatus($id = "0")
	{
		$res = $this->db->query('EXECUTE cosmo.dbo.Get_Goodsstatus ' . $id);
		return $res->result();
	}
	//GoodsJournalType
	function GoodsJournalType($id = "0")
	{
		$res = $this->db->query('EXECUTE cosmo.dbo.Get_GoodsJournalType ' . $id);
		return $res->result();
	}
	// GoodsJournal
	function GoodsJournal($status_Id = "0", $GoodsJournalType_Id = "0", $Product_Id = "0", $Warehouse_Id = "0", $from_date = "", $to_date = "")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_GoodsJournal " . $status_Id . "," . $GoodsJournalType_Id . "," . $Product_Id . "," . $Warehouse_Id . ",'" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//GoodsTransfer
	function GoodsTransfer($status_Id = "0", $GoodsTransfer_Id = "0", $GoodsTransferType_Id = "0", $fromWarehouse_Id = "0", $tobranch_Id = "0", $from_date = "", $to_date = "")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_GoodsTransfer " . $status_Id . "," . $GoodsTransfer_Id . "," . $GoodsTransferType_Id . "," . $fromWarehouse_Id . "," . $tobranch_Id . ",'" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//GoodsTransferGoods
	function GoodsTransferGoods($status_Id = "0", $GoodsTransfer_Id = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_TransGoodsTransferGoods " . $status_Id . "," . $GoodsTransfer_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//TransGoodsTransferProduct
	function GoodsTransferProduct($status_Id = "0", $GoodsTransfer_Id = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_TransGoodsTransferProduct " . $status_Id . "," . $GoodsTransfer_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Warrenty
	function Warrenty($Warrenty_Id = "0", $Goods_Id = "0", $Category_Id = "0", $Product_Id = "0", $Serial_No = "", $GoodsStatus_Id = "0", $status_Id = "1", $warehouse_id = "0", $WarrentyStatus_Id = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_Warrenty " . $Warrenty_Id . "," . $Goods_Id . "," . $Category_Id . "," . $Product_Id . ",'" . $Serial_No . "'," . $GoodsStatus_Id . "," . $status_Id . "," . $warehouse_id . "," . $WarrentyStatus_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//TripRoute
	function TripRoute($status_Id = "1", $trip_Id = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_TripRoute ' . $status_Id . ',' . $trip_Id);
		return $res->result();
	}
	//TripInvoice
	function TripInvoice($status_Id = "1", $trip_Id = "0", $Invoice_Id = "0", $Dealer_Id = "0", $id = "0", $Invoicestatus_Id = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_TripInvoice ' . $status_Id . ',' . $trip_Id  . ',' . $Invoice_Id . ',' . $Dealer_Id . ',' . $Invoicestatus_Id . ',' . $id);
		return $res->result();
	}
	//SalesReturnableInvoice
	function SalesReturnableInvoice($status_Id = "1", $Dealer_Id = "0", $Warehouse_Id = "0", $Salesexecutive_user_Id = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_SalesReturnableInvoice ' . $status_Id . ',' . $Dealer_Id  . ',' . $Warehouse_Id . ',' . $Salesexecutive_user_Id);
		return $res->result();
	}
	//SalesReturnRequestPending
	function SalesReturnRequestPending($status_id = "1", $SalesreturnRequest_Id = "0", $Dealer_Id = "0", $Salesexecutive_user_Id = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_SalesReturnRequestPending ' . $status_id . ',' . $SalesreturnRequest_Id . ',' . $Dealer_Id . ',' . $Salesexecutive_user_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//SalesReturnRequest
	function SalesReturnRequest($status_id = "1", $SalesreturnRequest_Id = "0", $Dealer_Id = "0", $Salesexecutive_user_Id = "0", $SalesreturnRequest_type_Id = "0", $salesReturnDone = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_SalesReturnRequestDone ' . $status_id . ',' . $SalesreturnRequest_Id . ',' . $Dealer_Id . ',' . $Salesexecutive_user_Id . ',' . $SalesreturnRequest_type_Id . ',' . $salesReturnDone);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//SalesReturnRequestGoodsable
	function SalesReturnRequestGoodsable($status_id = "1", $SalesreturnRequest_Id = "0", $Dealer_Id = "0", $Salesexecutive_user_Id = "0", $SalesreturnRequest_type_Id = "0", $salesReturnDone = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_SalesReturnRequestGoodsable ' . $status_id . ',' . $SalesreturnRequest_Id . ',' . $Dealer_Id . ',' . $Salesexecutive_user_Id . ',' . $SalesreturnRequest_type_Id . ',' . $salesReturnDone);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//SalesReturnRequestGoods
	function SalesReturnRequestGoods($status_id = "1", $SalesreturnRequest_Id = "0", $serialno = "", $SalesreturnRequest_status_Id = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_SalesReturnRequestGoods " . $status_id . "," . $SalesreturnRequest_Id . ",'" . $serialno . "'," . $SalesreturnRequest_status_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//TripRoute
	function TripProducts($status_Id = "1", $trip_Id = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_TripProductsToBeLoaded ' . $status_Id . ',' . $trip_Id);
		return $res->result();
	}
	//WarrentyStatus
	function WarrentyStatus($Id = "0")
	{
		$res = $this->db->query('EXECUTE cosmo.dbo.Get_WarrentyStatus ' . $Id);
		return $res->result();
	}
//Get_GoodsInvoiced
	function GoodsInvoiced($Goods_Id = "0", $Serial_No = "", $GoodsStatus_Id = "0", $status_Id = "1", $Invoice_no = "")
	{
				$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_GoodsInvoiced " . $Goods_Id . ",'" . $Serial_No . "'," . $GoodsStatus_Id . "," . $status_Id . ",'" . $Invoice_no . "'");
		// echo $this->db->last_query();exit;
		return $res->result();

	}
	//Goods
	function Goods($Goods_Id = "0", $Category_Id = "0", $Product_Id = "1", $Serial_No = "", $GoodsStatus_Id = "0", $status_Id = "1", $warehouse_id = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_Goods " . $Goods_Id . "," . $Category_Id . "," . $Product_Id . ",'" . $Serial_No . "'," . $GoodsStatus_Id . "," . $status_Id . "," . $warehouse_id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//InvoiceGoods
	function InvoiceGoods($Invoice_Id = "0", $Invoice_status_Id = "0", $Goodstype_Id = "0", $Product_Id = "0", $Serial_No = "", $GoodsStatus_Id = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_InvoiceGoods " . $Invoice_Id   . "," . $Invoice_status_Id   . "," . $Goodstype_Id . "," . $Product_Id . ",'" . $Serial_No . "'," . $GoodsStatus_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
		//Get_TransinvoicePreprint
	function InvoicePreprint($status_id = 1, $Warehouseid = "0", $Dealer_Id = "0", $salesexecutiveuser_Id = "0", $priority_Id = "0", $Invoice_status_Id = "0", $order_Id = "0", $Id = "0", $from_date = '', $to_date = '')
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_TransinvoicePreprint " . $status_id . ',' . $Warehouseid . ',' . $Dealer_Id . ',' . $salesexecutiveuser_Id . ',' . $priority_Id . ',' . $Invoice_status_Id  . ',' . $order_Id . ',' . $Id . ",'" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//InvoiceGoodsCount
	function InvoiceGoodsCount($Invoice_Id = "0", $Product_Id = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_InvoiceGoodsCount " . $Invoice_Id  . "," . $Product_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//SalesReturnReplacementGoods
	function SalesReturnReplacementGoods($SalesReturnReplacement_Id = "0", $SalesReturn_status_Id = "0", $Goodstype_Id = "0", $Product_Id = "0", $Serial_No = "", $GoodsStatus_Id = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_SalesReturnReplacementGoods " . $SalesReturnReplacement_Id   . "," . $SalesReturn_status_Id   . "," . $Goodstype_Id . "," . $Product_Id . ",'" . $Serial_No . "'," . $GoodsStatus_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//SalesReturnGoods
	function SalesReturnGoods($SalesReturn_Id = "0", $SalesReturn_status_Id = "0", $Goodstype_Id = "0", $Product_Id = "0", $Serial_No = "", $GoodsStatus_Id = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_SalesReturnGoods " . $SalesReturn_Id   . "," . $SalesReturn_status_Id   . "," . $Goodstype_Id . "," . $Product_Id . ",'" . $Serial_No . "'," . $GoodsStatus_Id);
		 //echo $this->db->last_query();exit;
		return $res->result();
	}
	//SalesReturnGoodsCount
	function SalesReturnGoodsCount($SalesReturn_Id = "0", $Product_Id = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_SalesReturnGoodsCount " . $SalesReturn_Id  . "," . $Product_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//InvoiceReturnableGoods
	function InvoiceReturnableGoods($Invoice_Id = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_SalesReturnableInvoiceGoods " . $Invoice_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	// Trip
	function Trip($status_Id = "1", $warehouse_id = "0", $area_Id = "0", $Truck_Id = "0", $Driver_Id = "0", $Helper_Id = "0", $Trip_status_Id = "0", $Id = "0", $from_date = '', $to_date = '')
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_Trip ' . $status_Id . ',' . $warehouse_id . ',' . $area_Id . ',' . $Truck_Id . ',' . $Driver_Id . ',' . $Helper_Id . ',' . $Trip_status_Id . ',' . $Id . ",'" . $from_date . "','" . $to_date . "'");
		return $res->result();
	}
	// AmountMode
	function AmountMode($Id = "0", $enable = '1')
	{
		$res = $this->db->query('EXECUTE cosmo.dbo.Get_AmountMode ' . $Id . ',' . $enable);
		return $res->result();
	}
	//Collection
	function Collection($status = "1", $dealer = "0", $collectedUser_Id = "0", $portal_Id = "0", $process_Id = "0", $amountmode_Id = "0", $CollectionStatus_Id = "0", $Id = "0", $from_date = '', $to_date = '')
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_Collection ' . $status . ',' . $dealer . ',' . $collectedUser_Id  . ',' . $portal_Id . ',' . $process_Id . ',' . $amountmode_Id . ',' . $CollectionStatus_Id . ',' . $Id . ",'" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Get_CreditNote
	function CrediNote($status = "1", $dealer = "0", $CreditNoteUser_Id = "0", $CreditNoteStatus_Id = "0", $Id = "0", $from_date = '', $to_date = '')
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_CreditNote ' . $status . ',' . $dealer . ',' . $CreditNoteUser_Id . ',' . $CreditNoteStatus_Id . ',' . $Id . ",'" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Get_CreditNotePaymentAdjustment
	function CrediNotePaymentAdjustment($from_id = 0, $to_id = 0)
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_CreditNotePaymentAdjustment ' . $from_id . ',' . $to_id );
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Get_MobilePaymentInfoDetails
	function MobilePaymentInfoDetails($Invoice_Id)
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_MobilePaymentInfoDetails ' . $Invoice_Id );
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Debits
	function Debits($status = "1", $DebitedUser_Id = "0", $portal_Id = "0", $DebitsType_Id = "0", $amountmode_Id = "0",  $Id = "0", $from_date = '', $to_date = '')
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_Debits ' . $status  . ',' . $DebitedUser_Id  . ',' . $portal_Id . ',' . $DebitsType_Id . ',' . $amountmode_Id  . ',' . $Id . ",'" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//CollectionAmount
	function CollectionAmount($status = "1", $collection = "0", $collectionType_Id = "0", $collectionTypeAgainst_Id = "0", $Id = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_CollectionAmount ' . $status . ',' . $collection . ',' . $collectionType_Id . ',' . $collectionTypeAgainst_Id . ',' . $Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Excess
	function ExcessCollection($status = "1", $collection = "0",  $Id = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_Excess ' . $status . ',' . $collection . ',' . $Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//DebitsAmount
	function DebitsAmount($status = "1", $Debits_Id = "0", $Against_Id = "0", $Id = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_DebitsAmount ' . $status . ',' . $Debits_Id . ',' . $Against_Id  . ',' . $Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//CollectionNotSettled
	function CollectionNotSettled($status = "1", $dealer = "0", $collectedUser_Id = "0", $portal_Id = "0", $process_Id = "0", $amountmode_Id = "0", $CollectionStatus_Id = "0", $Id = "0", $from_date = '', $to_date = '')
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_CollectionNotSettled ' . $status . ',' . $dealer . ',' . $collectedUser_Id  . ',' . $portal_Id . ',' . $process_Id . ',' . $amountmode_Id . ',' . $CollectionStatus_Id . ',' . $Id . ",'" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	// Deposit
	function Deposit($status = "1", $bank_id = "0", $depositedUser_Id = "0", $DepositStatus_Id = "0", $amountmode_Id = "0", $Id = "0", $from_date = '', $to_date = '')
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_Deposit ' . $status . ',' . $bank_id . ',' . $depositedUser_Id . ',' . $DepositStatus_Id . ',' . $amountmode_Id . ',' . $Id . ",'" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//DepositCollection
	function DepositCollection($status = "1", $Deposit_Id = "0",  $Id = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_DepositCollection ' . $status . ',' .  $Deposit_Id . ',' . $Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	// Settlement
	function Settlement($status = "1",  $SettlementedUser_Id = "0", $CollectedUser_Id = "0", $amountmode_Id = "0", $Id = "0", $from_date = '', $to_date = '')
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_Settlement ' . $status  . ',' . $SettlementedUser_Id . ',' . $CollectedUser_Id . ',' . $amountmode_Id . ',' . $Id . ",'" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Get_SettlementNondeposited
	function SettlementNondeposited($status = "1",  $SettlementedUser_Id = "0", $CollectedUser_Id = "0", $amountmode_Id = "0", $Id = "0", $from_date = '', $to_date = '')
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_SettlementNondeposited ' . $status  . ',' . $SettlementedUser_Id . ',' . $CollectedUser_Id . ',' . $amountmode_Id . ',' . $Id . ",'" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//SettlementCollection
	function SettlementCollection($status = "1", $Settlement_Id = "0",  $Id = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_SettlementCollection ' . $status . ',' .  $Settlement_Id . ',' . $Id);
		 //echo $this->db->last_query();exit;
		return $res->result();
	}
	//ProductCategory
	function ProductCategory($status = "1", $id = "0")
	{
		$res = $this->db->query('EXECUTE cosmo.dbo.Get_ProductCategory ' . $status . ',' . $id);
		return $res->result();
	}
	//Taxes
	function Taxes($status = "1", $id = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_Taxes ' . $status . ',' . $id);
		return $res->result();
	}
	//ProductionProduct
	function ProductionProduct($Production_Id = "0", $Category_Id = "0", $Product_Id = "0", $Serial_No = "0", $status_id = "1", $id = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_ProductionProduct ' . $Production_Id . ',' . $Category_Id . ',' . $Product_Id . ',' . $Serial_No . ',' . $status_id . ',' . $id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//ProductionProductserial
	function ProductionProductserial($Production_Id = "0", $Category_Id = "0", $Product_Id = "0", $Serial_No = "0", $status_id = "1", $id = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_ProductionProductserial ' . $Production_Id . ',' . $Category_Id . ',' . $Product_Id . ',' . $Serial_No . ',' . $status_id . ',' . $id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//PurchaseorderProductserial
	function PurchaseorderProductserial($Production_Id = "0", $Category_Id = "0", $Product_Id = "0", $PurchaseOrder_Id = "0", $PurchaseOrderOffice_Id = "0", $Serial_No = "0", $status_id = "1", $id = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_PurchaseorderProductserial ' . $Production_Id . ',' . $Category_Id . ',' . $Product_Id . ',' . $PurchaseOrder_Id . ',' . $PurchaseOrderOffice_Id . ',' . $Serial_No . ',' . $status_id . ',' . $id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//PurchaseorderProductserialfromfactory
	function PurchaseorderProductserialfromfactory($purchaseorder, $factory = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_PurchaseorderProductserialfromfactory ' . $purchaseorder . ','  . $factory);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//ProductionCompletedProductserial
	function ProductionCompletedProductserial($Production_Id = "0", $Category_Id = "0", $Product_Id = "0", $Serial_No = "0", $status_id = "1", $id = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_ProductionCompletedProductserial ' . $Production_Id . ',' . $Category_Id . ',' . $Product_Id . ',' . $Serial_No . ',' . $status_id . ',' . $id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Admin
	function Admin($status_id = "1", $id = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_Admin ' . $id . ',' . $status_id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Driver
	function Driver($status_id = "1", $id = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_Driver ' . $id . ',' . $status_id);
		return $res->result();
	}
	//Helper
	function Helper($status_id = "1", $id = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_Helper ' . $id . ',' . $status_id);
		return $res->result();
	}
	//AccountsManager
	function AccountsManager($status_id = "1", $id = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_AccountsManager ' . $id . ',' . $status_id);
		return $res->result();
	}
	//WarehouseIncharge
	function WarehouseIncharge($status_id = "1", $id = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_WarehouseIncharge ' . $id . ',' . $status_id);
		return $res->result();
	}
	//WarehouseManager
	function WarehouseManager($status_id = "1", $id = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_WarehouseManager ' . $id . ',' . $status_id);
		return $res->result();
	}
	//SalesManager
	function SalesManager($status_id = "1", $id = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_SalesManager ' . $id . ',' . $status_id);
		return $res->result();
	}
	//SalesExecutve
	function SalesExecutve($status_id = "1", $id = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_SalesExecutve ' . $id . ',' . $status_id);
		return $res->result();
	}
	//Product
	function Product($status = "1", $productcategory_id = "0", $id = "0")
	{
		$res = $this->db->query('EXECUTE cosmo.dbo.Get_Product ' . $status . ',' . $productcategory_id . ',' . $id);
		return $res->result();
	}
	//OfficeProduct
	function OfficeProduct($status = "1", $productcategory_id = "0", $id = "0")
	{
		$res = $this->db->query('EXECUTE '.$_SESSION['currentdatabasename'].'.dbo.Get_OfficeProduct ' . $status . ',' . $productcategory_id . ',' . $id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Staff
	function paytype($status = "1", $id = "0")
	{
		$res = $this->db->query("EXECUTE cosmo.dbo.Get_paytype " . $status . ',' . $id);
		return $res->result();
	}
	//VoucherType
	function VoucherType($VoucherType = "0", $id = "0")
	{
		$res = $this->db->query("EXECUTE cosmo.dbo.Get_VoucherType " . $VoucherType . ',' . $id);
		return $res->result();
	}
	//Voucher
	function Voucher($status = "1", $User_Id = "0", $portal_Id = "0", $VoucherType_Id = "0", $amountmode_Id = "0",  $Id = "0",  $from_date = '', $to_date = '')
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_Voucher " . $status . "," . $User_Id . "," . $portal_Id . "," . $VoucherType_Id . "," . $amountmode_Id . "," . $Id . ",'" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		//print_r($res);exit;
		return $res->result();
	}
	function VoucherAmount($status = "1", $Voucher_Id = "0",  $Id = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_VoucherAmount " . $status . "," . $Voucher_Id . "," . $Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	// Salary
	function Salary($userrole_id = "0", $paytype_id = "0", $status = "1", $id = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_Salary " . $userrole_id . ',' . $paytype_id . ',' . $status . ',' . $id);
		// echo $this->db->last_query();
		if (!empty($res)) {
			return $res->result();
		} else {
			return false;
		}
	}
	//SalaryDeduction
	function SalaryDeduction($status = "1", $deduction = "0", $userid = "0", $id = "0", $SalaryDeduction_SalaryAmount_Id = "0", $payhead_id = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_SalaryDeduction " . $status . ',' . $deduction . ',' . $userid . ',' . $id . ',' . $SalaryDeduction_SalaryAmount_Id . ',' . $payhead_id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Payhead
	function Payhead($status = "1", $id = "0")
	{
		$res = $this->db->query("EXECUTE cosmo.dbo.Get_Payhead " . $status . ',' . $id);
		return $res->result();
	}
	// Hike
	function Hike($userrole = "0", $payid = "0", $status = "1", $userid = "0", $hikeid = "0", $Hike_SalaryAmount_Id = 0)
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_Hike " . $userrole . ',' . $payid . ',' . $status . ',' . $userid . ',' . $hikeid . ',' . $Hike_SalaryAmount_Id);
		return $res->result();
	}
	//users
	function Users($userrole_id = "0", $Status_Id = 0, $id = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_users " . $userrole_id . ',' . $Status_Id . ',' . $id);
		if (!empty($res->result())) {
			return $res->result();
		} else {
			return false;
		}
	}
	//Discount Type
	function Discounttype($id = "0")
	{
		$res = $this->db->query("EXECUTE cosmo.dbo.Get_DiscountType " . $id);
		return $res->result();
	}
	//Warehouse
	function Warehouse($status = "1", $id = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_Warehouse " . $status . ',' . $id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//BranchWarehouse
	function BranchWarehouse($status = "1", $id = "0", $db = '')
	{
		$res = $this->db->query("EXECUTE $db.dbo.Get_Warehouse " . $status . ',' . $id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//OfferList(Master)
	function OfferList($status = "1", $offertype_id = "0", $offerrestriction_id = "0", $id = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_Offers " . $status . ',' . $offertype_id . ',' . $offerrestriction_id . ',' . $id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Offertype
	function Offertype($status = "1", $id = "0")
	{
		$res = $this->db->query("EXECUTE cosmo.dbo.Get_Offertype " . $status . ',' . $id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Offertype
	function Offerrestrictions($status = "1", $id = "0")
	{
		$res = $this->db->query("EXECUTE cosmo.dbo.Get_Offerrestrictions " . $status . ',' . $id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//CurrentOffers
	function CurrentOffers($status = "1", $productcategory_id = "0", $Product_Id = "0", $offer_id = "0", $id = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_TransOffer " . $status . ',' . $productcategory_id . ',' . $Product_Id . ',' . $offer_id . ',' . $id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//DealerOffer
	function DealerOffer($dealer_Id, $status = "1", $productcategory_id = "0", $Product_Id = "0", $offer_id = "0", $id = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_DealerAvailableOffer " . $dealer_Id . ',' . $status . ',' . $productcategory_id . ',' . $Product_Id . ',' . $offer_id . ',' . $id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//InvoiceAgainst_AmountInfo
	function InvoiceAgainst_AmountInfo($Invoiceid)
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_InvoiceAgainst_AmountInfo " . $Invoiceid);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//CollectionNotDeposited
	function CollectionNotDeposited($CollectedUser_Id, $amountmode_Id)
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_CollectionNotDeposited " . $CollectedUser_Id . ',' . $amountmode_Id);
		 //echo $this->db->last_query();exit;
		return $res->result();
	}
	//Dealers
	function Dealer($id = "0", $status = "1")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_Dealer " . $id . ',' . $status);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//DealerFOrSalesExecutive
	function DealerForSalesExecutive($id = "0", $status = "1", $salesexecutiveuserid = "0", $limitbegin = "10", $limit = "30")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_DealerForSalesExecutive " . $id . ',' . $status . ',' . $salesexecutiveuserid  . ',' . $limitbegin . ',' . $limit);
		//echo $this->db->last_query();exit;
	
			return $res->result();
	
		
	}
	//DealerAmountInfo
	function DealerAmountInfo($id = "0", $status = "1")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_DealerAmountInfo " . $id . ',' . $status);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Plumbers
	function mobile_Plumber($id = "0", $status = "1", $salesexecutiveid = 0, $db = '')
	{
		$res = $this->db->query("EXECUTE " . $db . ".dbo.Get_Plumber " . $id . ',' . $status . ',' . $salesexecutiveid);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function Plumber($id = "0", $status = "1", $salesexecutiveid = 0)
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_Plumber " . $id . ',' . $status . ',' . $salesexecutiveid);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Truck
	function Truck($status = "1", $id = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_Truck " . $status . ',' . $id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Orderlist
	function Orderlist($status_id = 1, $Warehouseid = "0", $Dealer_Id = "0", $salesexecutiveuser_Id = "0", $priority_Id = "0", $Order_status_Id = "0", $Id = "0", $from_date = '', $to_date = '')
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_TransOrder " . $status_id . ',' . $Warehouseid . ',' . $Dealer_Id . ',' . $salesexecutiveuser_Id . ',' . $priority_Id . ',' . $Order_status_Id . ',' . $Id . ",'" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Get_TransOrderSalesExecutives
	function OrderSalesExecutives($status_id = 1, $Warehouseid = "0", $Dealer_Id = "0", $salesexecutiveuser_Id = "0", $priority_Id = "0", $Order_status_Id = "0", $Id = "0", $from_date = '', $to_date = '')
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_TransOrderSalesExecutives " . $status_id . ',' . $Warehouseid . ',' . $Dealer_Id . ',' . $salesexecutiveuser_Id . ',' . $priority_Id . ',' . $Order_status_Id . ',' . $Id . ",'" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//PurchaseOrderProduct
	function OrderlistProduct($status_id = 1, $Order_Id = 0)
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_TransOrderProduct " . $status_id . ',' . $Order_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//TransPurchaseOrderProductImport
	function TransPurchaseOrderProductImport($status_id = 1, $Order_Id = 0)
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_TransPurchaseOrderProductImport " . $status_id . ',' . $Order_Id);
		 //echo $this->db->last_query();exit;
		return $res->result();
	}
	//Invoice
	function Invoice($status_id = 1, $Warehouseid = "0", $Dealer_Id = "0", $salesexecutiveuser_Id = "0", $priority_Id = "0", $Invoice_status_Id = "0", $order_Id = "0", $Id = "0", $from_date = '', $to_date = '')
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_TransInvoice " . $status_id . ',' . $Warehouseid . ',' . $Dealer_Id . ',' . $salesexecutiveuser_Id . ',' . $priority_Id . ',' . $Invoice_status_Id  . ',' . $order_Id . ',' . $Id . ",'" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function InvoicelistWithDue($status_id = 1, $Dealer_ID = "0", $Invoice_Id = "0", $salesexecutiveid = "0",$from_date = '', $to_date = '')
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_InvoicelistWithDue " . $status_id  . ',' . $Dealer_ID . ',' . $Invoice_Id . ',' . $salesexecutiveid. ",'" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//TransinvoiceNotTripped
	function InvoiceNotTripped($status_id = 1, $Warehouseid = "0", $Dealer_Id = "0", $salesexecutiveuser_Id = "0", $priority_Id = "0", $Invoice_status_Id = "0", $order_Id = "0", $Id = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_TransinvoiceNotTripped " . $status_id . ',' . $Warehouseid . ',' . $Dealer_Id . ',' . $salesexecutiveuser_Id . ',' . $priority_Id . ',' . $Invoice_status_Id  . ',' . $order_Id . ',' . $Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//AvailableDeliveriesForTrip
	function AvailableDeliveriesForTrip($Warehouse_Id = "0", $area_Id = "0", $againstid = 0)
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_TransAvailableDeliveriesForTrip " . $Warehouse_Id . ',' . $area_Id . ',' . $againstid);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//TripDeliverable
	function TripDeliverable($Trip_Id = "0", $TripDeliveriestatus_Id = "0")
	{
		$res = $this->db->query("Execute ".$_SESSION['currentdatabasename'].".dbo.Get_TripDeliverable " . $Trip_Id . "," . $TripDeliveriestatus_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function InvoicePaymnetInfo($Invoice_Id)
	{
		$res = $this->db->query("Execute ".$_SESSION['currentdatabasename'].".dbo.Get_InvoicePaymentInfo " . $Invoice_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function SalesreturnPaymnetInfo($Salesreturn_Id)
	{
		$res = $this->db->query("Execute ".$_SESSION['currentdatabasename'].".dbo.Get_SalesreturnPaymentInfo " . $Salesreturn_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//VoucherPaymentInfo
	function VoucherPaymentInfo($Salesreturn_Id)
	{
		$res = $this->db->query("Execute ".$_SESSION['currentdatabasename'].".dbo.Get_VoucherPaymentInfo " . $Salesreturn_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//TransSalesReturn
	function SalesReturn($status_id = 1, $Dealer_Id = "0", $SalesreturnRequest_Id = "0",  $SalesreturnRequest_status_Id = "0", $SalesReturn_Id = 0)
	{
		$res = $this->db->query("Execute ".$_SESSION['currentdatabasename'].".dbo.Get_TransSalesReturn " . $status_id . "," . $Dealer_Id . "," . $SalesreturnRequest_Id . "," . $SalesreturnRequest_status_Id . "," . $SalesReturn_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//TransSalesReturnInvoiceTotal
	function SalesReturnInvoiceTotal($status_id = 1, $invoice = "0", $Salesreturn_Id = "0",  $Dealer_Id = "0")
	{
		$res = $this->db->query("Execute ".$_SESSION['currentdatabasename'].".dbo.Get_TransSalesReturnInvoiceTotal " . $status_id . "," . $invoice . "," . $Salesreturn_Id . "," . $Dealer_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//TripSalesReturn
	function TripSalesReturn($status_id = 1, $Trip_Id = "0", $Salesreturn_Id = "0", $Dealer_Id = "0", $salesReturn_Status_Id = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_TripSalesReturn " . $status_id . "," . $Trip_Id . "," . $Salesreturn_Id . "," . $Dealer_Id . "," . $salesReturn_Status_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//TransSalesReturnlist
	function TransSalesReturnlist($status_id = 1, $Trip_Id = "0", $Salesreturn_Id = "0", $Dealer_Id = "0", $salesReturn_Status_Id = "0", $from_date = '', $to_date = '')
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_TransSalesReturnlist " . $status_id . "," . $Trip_Id . "," . $Salesreturn_Id . "," . $Dealer_Id . "," . $salesReturn_Status_Id . ",'" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//TripSalesRetunGoodsToBeCollected
	function Get_TripSalesRetunGoodsToBeCollected($status_id = 1, $Trip_Id = "0", $Salesreturn_Id = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_TripSalesRetunGoodsToBeCollected " . $status_id . "," . $Trip_Id . "," . $Salesreturn_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//TransSalesReturnProduct
	function Get_TransSalesReturnProduct($status_id = 1, $Invoice_Id = "0", $SalesreturnRequest_Id = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_TransSalesReturnProduct " . $status_id . "," . $Invoice_Id . "," . $SalesreturnRequest_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//SalesReturnRequestProduct
	function SalesReturnRequestProduct($status_id = 1, $SalesreturnRequest_Id = "0", $Invoice_Id = "0", $SalesreturnRequest_status_Id = "0")
	{
		$res = $this->db->query("Execute ".$_SESSION['currentdatabasename'].".dbo.Get_SalesReturnRequestProduct " . $status_id . "," . $SalesreturnRequest_Id . ",'" . $Invoice_Id . "'," . $SalesreturnRequest_status_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//PurchaseInvoiceProduct
	function InvoiceProduct($status_id = 1, $Invoice_Id = 0)
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_TransInvoiceProduct " . $status_id . ',' . $Invoice_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//InvoiceAmountInfo
	function InvoiceDue($status_id = 1, $Dealer_ID = "0", $Invoice_Id = "0", $salesexecutiveid = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_InvoiceDue " . $status_id  . ',' . $Dealer_ID . ',' . $Invoice_Id . ',' . $salesexecutiveid);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function InvoiceOverDue($status_id = 1, $Dealer_ID = "0", $Invoice_Id = "0", $salesexecutiveid = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_InvoiceOverDue " . $status_id  . ',' . $Dealer_ID . ',' . $Invoice_Id . ',' . $salesexecutiveid);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	
	//AccountsGroup
	function AccountsGroup($status_id = "1", $Id = "0")
	{
		$res = $this->db->query("EXECUTE cosmo.dbo.Get_AccountsGroup " . $status_id . ',' . $Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Ledger
	function Ledger($status_id = "1", $group_id = "0", $Id = "0")
	{
		$res = $this->db->query("EXECUTE cosmo.dbo.Get_Ledger " . $status_id . ',' . $group_id . ',' . $Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//OfficeLedger
	function OfficeLedger($OfficeLedger_id = "0", $LedgerType_Id = "0", $Against_Id = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_OfficeLedger " . $OfficeLedger_id . ',' . $LedgerType_Id . ',' . $Against_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Bill
	function Bill($status_id = "1", $Supplier_Id = "0", $Id = "0", $from_date = '', $to_date = '')
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_TransBill " . $status_id . ',' . $Supplier_Id . ',' . $Id . ",'" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//BillProduct
	function BillProduct($status_id = 1, $Order_Id = 0)
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_TransBillProduct " . $status_id . ',' . $Order_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Import
	function Import($status_id = "1", $WarehouseCode = "0", $Supplier_Id = "0", $Id = "0", $from_date = '', $to_date = '')
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_TransImport " . $status_id . ',' . $WarehouseCode . ',' . $Supplier_Id . ',' . $Id . ",'" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//ImportProduct
	function ImportProduct($status_id = 1, $Order_Id = 0)
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_TransImportProduct " . $status_id . ',' . $Order_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//PurchaseOrder
	function PurchaseOrder($status_id = "1", $WarehouseCode = "0", $Supplier_Id = "0", $PurchaseOrderStatus_Id = "0", $Id = "0", $from_date = '', $to_date = '')
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_TransPurchaseOrder " . $status_id . ',' . $WarehouseCode . ',' . $Supplier_Id . ',' . $PurchaseOrderStatus_Id . ',' . $Id . ",'" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//ApprovedPurchaseOrder
	function ApprovedPurchaseOrder($status_id = "1", $WarehouseCode = "0", $Supplier_Id = "0", $PurchaseOrderStatus_Id = "0", $Id = "0", $dbname = '')
	{
		$res = $this->db->query("EXECUTE $dbname.dbo.Get_TransPurchaseOrder " . $status_id . ',' . $WarehouseCode . ',' . $Supplier_Id . ',' . $PurchaseOrderStatus_Id . ',' . $Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//factoryApprovedPurchaseOrder
	function factoryApprovedPurchaseOrder($status_id = "1", $PurchaseOrder_Id = "0", $Purchaseorderoffice_Id = 0, $ID = "0", $from_date = "", $to_date = "")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_ApprovedPurchaseOrder " . $status_id . "," . $PurchaseOrder_Id  . "," . $Purchaseorderoffice_Id . "," . $ID . ",'" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//ApprovedPurchaseOrderProduct
	function ApprovedPurchaseOrderProduct($status_id = 1, $Order_Id = 0, $officedbname = '')
	{
		$res = $this->db->query("EXECUTE $officedbname.dbo.Get_TransPurchaseOrderProduct " . $status_id . ',' . $Order_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//office
	function Office($officetype = "0", $status = "1", $Id = "0", $dbnamer = "Nill")
	{
		$res = $this->db->query("EXECUTE cosmo.dbo.Get_office " . $officetype . ',' . $status . ',' . $Id . ',' . $dbnamer);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//logincredential_list
	function logincredential_list($status = "1", $Id = "0", $webportal = "0", $mobileportal = "0")
	{
		$res = $this->db->query("EXECUTE cosmo.dbo.Get_logincredential_list " . $status . ',' . $Id . ',' . $webportal . ',' . $mobileportal);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//logincredentialoffice_list
	function logincredentialoffice_list($status = "1", $Id = "0", $webportal = "0", $mobileportal = "0", $offer_dbname = '')
	{
		$res = $this->db->query("EXECUTE cosmo.dbo.Get_logincredentialoffice_list " . $status . ',' . $Id . ',' . $webportal . ',' . $mobileportal . ',"' . $offer_dbname . '"');
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Switchaccesslist
	function Switchaccesslist($officetype = "0", $status = "1", $Id = "0", $officeid = "0")
	{
		$res = $this->db->query("EXECUTE cosmo.dbo.Get_Switchaccesslist " . $officetype . ',' . $status . ',' . $Id . ',' . $officeid);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Production
	function Production($status = "1", $Id = "0", $fromdate = '', $todate = '')
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_Production " . $status . "," . $Id . ",'" . $fromdate . "','" . $todate . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//ProductionComplete
	function ProductionComplete($status = "1", $Id = "0", $fromdate = '', $todate = '')
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_ProductionComplete " . $status . "," . $Id . ",'" . $fromdate . "','" . $todate . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Deduction
	function Deduction($status = "1", $Id = "0")
	{
		$res = $this->db->query("EXECUTE cosmo.dbo.Get_deduction " . $status . "," . $Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//paymode
	function paymode($status = "1", $Id = "0")
	{
		$res = $this->db->query("EXECUTE cosmo.dbo.Get_paymode " . $status . "," . $Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//SalaryAmount
	function SalaryAmount($status = "1", $salary_Id = "0", $payhead_Id = "0", $Id = "0", $salaryfromdate = '')
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_SalaryAmount " . $status . "," . $salary_Id . "," . $payhead_Id . "," . $Id . ",'" . $salaryfromdate . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//payable
	function payable($UserRole_Id = "0", $User_Id = "0",  $salaryfromdate = '')
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_payable " . $UserRole_Id . "," . $User_Id . ",'" . $salaryfromdate . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//payableDeduction
	function payableDeduction($salaryamountid = "0",  $salaryfromdate = '')
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_payableDeduction "  . $salaryamountid . ",'" . $salaryfromdate . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//BankReconcillation_notdone
	function Bankreconciliation_unreconciled($fromdate, $todate, $bankid)
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_Bankreconciliation_unreconciled '"  . $fromdate . "','" . $todate . "','" . $bankid . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//BankReconcillation_notdone
	function Bankreconciliation_reconciled($fromdate, $todate, $bankid)
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_Bankreconciliation_reconciled '"  . $fromdate . "','" . $todate . "','" . $bankid . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Holidaytype
	function Holidaytype($Holidaytype_Id = "0",  $status_Id = "1")
	{
		$res = $this->db->query("EXECUTE cosmo.dbo.Get_Holidaytype "  . $Holidaytype_Id . ",'" . $status_Id . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Holiday
	function Holiday($Holiday_Id = "0", $Holidaytype_Id = "0", $status_Id = "1")
	{
		$res = $this->db->query("EXECUTE cosmo.dbo.Get_Holiday "  . $Holiday_Id . ",'" . $Holidaytype_Id . "','"  . $status_Id . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//AttendanceStatus
	function AttendanceStatus($Get_AttendanceStatus_Id = "0")
	{
		$res = $this->db->query("EXECUTE cosmo.dbo.Get_AttendanceStatus "  . $Get_AttendanceStatus_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//OrderPriyority
	function OrderPriyority($Order_Priyority_Id = "0")
	{
		$res = $this->db->query("EXECUTE cosmo.dbo.Get_OrderPriyority "  . $Order_Priyority_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Attendancetype
	function Attendancetype($Status_Id = "1", $type = "0")
	{
		$res = $this->db->query("EXECUTE cosmo.dbo.Get_Attendancetype " . $Status_Id . "," . $type);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//AttendanceUserlist
	function AttendanceUserlist($status_Id = "1", $AttendanceId = "0", $userrole_Id = "0", $user_Id = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_Attendance " . $status_Id . "," . $AttendanceId . "," . $userrole_Id . "," . $user_Id);
		// echo $this->db->last_query();exit;
		if($res->result())
		{
			return $res->result();
		}
	else
	{
		return false;
	}
		
	
	}
	//AttendanceTime
	function AttendanceTime($AttendanceId = "0", $attendancetime__d = "0", $status_Id = "1", $Attendance_Status_Id = "0", $UserRole_Id = "0", $User_Id = "0", $fromdate = '', $todate = '')
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_AttendanceTime " . $AttendanceId . ","  . $attendancetime__d . "," . $status_Id  . "," . $Attendance_Status_Id . "," . $UserRole_Id . "," . $User_Id . ",'" . $fromdate . "','" . $todate . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//AttendanceTimePerAttendance
	function AttendanceTimePerAttendance($AttendanceId = "0", $attendancetime__d = "0", $status_Id = "1", $Attendance_Status_Id = "0")
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_AttendanceTimePerAttendance " . $AttendanceId . ","  . $attendancetime__d . "," . $status_Id  . "," . $Attendance_Status_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//PurchaseOrderProduct
	function PurchaseOrderProduct($status_id = 1, $Order_Id = 0)
	{
		$res = $this->db->query("EXECUTE ".$_SESSION['currentdatabasename'].".dbo.Get_TransPurchaseOrderProduct " . $status_id . ',' . $Order_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//End of Getting All  Values
	//dropdown formatter
	function Option_($data, $id, $val, $dval, $text, $selected)
	{
		$html = '<option value="' . $dval . '" >' . $text . '</option>';
		foreach ($data as $key) {
			$SEL = "";
			$desgn = "";
			if ($dval != "") {
				$desgn =  @$key->$dval;
			}
			if ($selected == $key->$id) {
				$SEL = "selected";
			}
			$html .= '<option ' . $SEL . ' value="' . @$key->$id . '" >' . @$key->$val . $desgn . '</option>';
		}
		echo $html;
	}
	//utc timezone to client timezone
	function convertUTCtoClient()
	{
		echo date('Y-m-d H:i:s T', time()) . "<br>\n";
		date_default_timezone_set('UTC');
		echo date('Y-m-d H:i:s T', time()) . "<br>\n";
	}
	//changetocurrenttimezone
	function changetocurrenttimezone($dateString, $timeZoneSource = null, $timeZoneTarget = "Asia/Dubai")
	{
		if (empty($timeZoneSource)) {
			$timeZoneSource = date_default_timezone_get();
		}
		$dt = new DateTime($dateString, new DateTimeZone($timeZoneSource));
		$dt->setTimezone(new DateTimeZone($timeZoneTarget));
		return $dt->format("m/d/y h:i:s A");
	}
	//changetoservertimezone
	function changetoservertimezone($dateString, $timeZoneSource = "Asia/Dubai", $timeZoneTarget = null)
	{
		if (empty($timeZoneTarget)) {
			$timeZoneTarget = date_default_timezone_get();
		}
		$data_array =explode('/', $dateString);
		if(count($data_array) > 1){
			if($data_array[1] >12){
				$dateString = $data_array[2] . '-' . $data_array[0] . '-' . $data_array[1];
			}else{
				$date = DateTime::createFromFormat('m/d/y', $dateString); 
				$dateString = $date->format('Y-m-d');
			}
			
		} 
		$dt = new DateTime($dateString, new DateTimeZone($timeZoneSource));
		$dt->setTimezone(new DateTimeZone($timeZoneTarget));
		return $dt->format("d/m/Y h:i:s A");
	}
	//date formatter
	function DateSplit($dat)
	{
		$dat = $this->GM->changetoservertimezone($dat);
		$dat = str_replace('/', '-', $dat);
		$Odate = explode(' ', $dat);
		$date = explode('-', $Odate[0]);
		$month = $date[1];
		$day   = $date[0];
		$year  = $date[2];
		return $month . "-" . $day . "-" . $year;
	}
	//date formatter without convert
	function DateSplitwithoutconvert($dat)
	{
		$dat = str_replace('/', '-', $dat);
		$Odate = explode(' ', $dat);
		$date = explode('-', $Odate[0]);
		$month = $date[1];
		$day   = $date[0];
		$year  = $date[2];
		return $month . "/" . $day . "/" . $year;
	}
	//dateshowfromdb without convert formatter
	function DateSplitshowWithoutConvert($dat)
	{
		$dat = str_replace('/', '-', $dat);
		$Odate = explode(' ', $dat);
		$date = explode('-', $Odate[0]);
		$month = $date[1];
		$dt   = $date[2];
		$year  = $date[0];
		return $dt . "-" . $month . "-" . $year;
	}
	//dateshowfromdb formatter
	function DateSplitshow($dat)
	{
		$dat = $this->GM->changetocurrenttimezone($dat);
		$dat = str_replace('/', '-', $dat);
		$Odate = explode(' ', $dat);
		$date = explode('-', $Odate[0]);
		$month = $date[1];
		$dt   = $date[2];
		$year  = $date[0];
		return $dt . "-" . $month . "-" . $year;
	}
	//dateTime formatter
	function DateTimeSplit($dat)
	{
		$dat = $this->GM->changetoservertimezone($dat);
		$dat = str_replace('/', '-', $dat);
		$Odate = explode(' ', $dat);
		$date = explode('-', $Odate[0]);
		$time = explode(':', $Odate[1]);
		$month = $date[1];
		$day   = $date[0];
		$year  = $date[2];
		$hr = $time[0];
		$min = $time[1];
		$sec = $time[2];
		$type = $Odate[2];
		return $month . "/" . $day . "/" . $year . " " . $hr . ":" . $min . ":" . $sec . " " . $type;
	}
	//date and time showfromdb formatter
	function DateTimeSplitshow($dat)
	{
		$dat = $this->GM->changetocurrenttimezone($dat);
		$Odate = explode(' ', $dat);
		$dat = str_replace('/', '-', $dat);
		$date = explode('/', $Odate[0]);
		$month = $date[0];
		$dt   = $date[1];
		$year  = $date[2];
		$time = explode(':', $Odate[1]);
		$hr = $time[0];
		$min = $time[1];
		$sec = $time[2];
		$type = $Odate[2];
		return $dt . "-" . $month . "-" . $year . "&nbsp;&nbsp;&nbsp;" . $hr . ":" . $min . ":" . $sec . "&nbsp;&nbsp;" . $type;
	}
	function array_key_first(array $arr)
	{
		foreach ($arr as $key => $unused) {
			return $key;
		}
		return NULL;
	}
	//listof weeklydaylist
	function daylist()
	{
		$day = array();
		for ($i = 0; $i <= 6; $i++) {
			$weekstart_temp = '2020-10-05';
			array_push($day, date('l', strtotime($weekstart_temp . "+$i day")));
		}
		return $day;
	}
	// validate a date format
	function validateDate($date, $format = 'd-m-Y')
	{
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}
	//convert percentage to Amount
	function Percentagetoamount($percentage, $amount)
	{
		$onepercentofamount = floatval($amount) / 100;
		$overall = floatval($onepercentofamount) * floatval($percentage);
		$overall = number_format($overall, 2);
		return $overall;
	}
	// add numbers to float
	function AddNumberAsFloat($Total, $addnumber)
	{
		$Total = $Total + $addnumber;
		return number_format((float)$Total, 2, '.', '');
	}
	//Get_Module
	function SupportModule($Module_Id = "0")
	{
		$res = $this->db->query("EXECUTE cosmo_support.dbo.Get_Module '" . $Module_Id . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	// 10-1-2022
	function WarehouseExtrenal($status = "1", $id = "0",$database='cosmo_qatar')
	{
		$res = $this->db->query("EXECUTE ".$database.".dbo.Get_Warehouse " . $status . ',' . $id);
		return $res->result();
	}
}
