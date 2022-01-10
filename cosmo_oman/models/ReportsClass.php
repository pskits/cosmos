<?php
class ReportsClass extends CI_Model
{
	//Sales
	//By Dealer
	function SalesByDealer($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_SalesByDealer '" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//By Product
	function SalesByProduct($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_SalesByProduct '" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Rep_SalesByExecutiveProductWise
	function SalesByExecutiveProductWise($from_date, $to_date,$salesexecutiveuser_id)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_SalesByExecutiveProductWise '" . $from_date . "','" . $to_date . "','" . $salesexecutiveuser_id . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//By SalesByExecutive
	function SalesByExecutive($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_SalesByExecutive '" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//SalesOpenOrders
	function SalesOpenOrders()
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_SalesOpenOrders");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//SalesByCreditPeriod
	function SalesByCreditPeriod($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_SalesByCreditPeriod '" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//By SalesByInvoice
	function SalesByInvoice($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_SalesByInvoice '" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function SalesRegister($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_SalesRegister '" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//salesbyMotorsSaleswithStock
	function salesbyMotorsSaleswithStock($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_salesbyMotorsSaleswithStock  '" . $from_date . "','" .  $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//AccessoriesSaleswithStock
	function SalesbyAccessoriesSaleswithStock($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_SalesbyAccessoriesSaleswithStock  '" . $from_date . "','" .  $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function InventorySummary()
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_InventorySummary");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function InventorySummary_DateWise($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_InventorySummary_DateWise  '" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function InventoryFlowbyBooks($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_InventoryFlowbyBooks  '" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function InventoryFlowbyStock($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_InventoryFlowbyStock  '" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	
	function InventorySerialno()
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_InventorySerialno");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	
	function Rep_Inventory_vs_PurchaseOrder()
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_Inventory_vs_PurchaseOrder");
		return $res->result();
	}
	
	function CollectionbyMode($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_CollectionbyMode '" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function CollectionbyStatus($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_CollectionbyStatus '" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function CollectionConverted($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_CollectionConverted '" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function CollectionUncredited()
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_CollectionUncredited");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function DealerwiseCreditBalance()
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_DealerwiseCreditBalance");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function DealerwiseageingUncollected()
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_DealerwiseageingUncollected");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function Duewiseageing()
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_Duewiseageing");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function DueSalesRegister()
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_DueSalesRegister");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function DealerWiseDue()
	{
		 $res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_DealerWiseDue");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function NotYetInvoiced()
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_NotInvoiced");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function DealerAllContacts()
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_DealerAllContacts");
		// echo $this->db->last_query();exit;
	
		return $res->result();
		$this->db->close();
	}
	function ReturnbyInvoiceNo($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_ReturnbyInvoiceNo '" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function ReturnbyReturnNo($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_ReturnbyReturnNo '" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function ReturnbyUnadjustedReturns($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_ReturnbyUnadjustedReturns '" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function Returnbyopenreturns()
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_Returnbyopenreturns ");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function WarrentyByDealer($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_WarrentyByDealer '" . $from_date . "','" . $to_date . "'");
	
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function WarrentyByProduct($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_WarrentyByProduct '" . $from_date . "','" . $to_date . "'");
	
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function WarrentyBySerialNo($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_WarrentyBySerialNo '" . $from_date . "','" . $to_date . "'");
	
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function ReplacementbyProduct($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_ReplacementbyProduct '" . $from_date . "','" . $to_date . "'");
	
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function ReplacementbyDealer($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_ReplacementbyDealer '" . $from_date . "','" . $to_date . "'");
	
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function PayablesBySupplier($to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_PayablesBySupplier '" . $to_date . "'");
	
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	
	
	
	
	function ReturnbyDealer($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_ReturnbyDealer '" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function ReturnbyProduct($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_ReturnbyProduct '" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function ReturnbySerialNo($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_ReturnbySerialNO '" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function ReturnReplacementbySerialNO($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_ReturnReplacementbySerialNO '" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function BillsBySupplier($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_BillsBySupplier '" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	function BillsByDate($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_BillsByDate '" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	
	function ImportsBySupplier($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_ImportsBySupplier '" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//AccountsByAlltransaction
	function AccountsByAlltransaction($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_AccountsByAlltransaction '" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Rep_AccountsByTrialBalanceProfitLoss
	function AccountsByTrialBalanceProfitLoss($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_AccountsByTrialBalanceProfitLoss '" . $from_date . "','" . $to_date . "'");
		 //echo $this->db->last_query();exit;
		return $res->result();
	}
	//Rep_AccountsByTrialBalanceCurrent
	function AccountsByTrialBalanceCurrent($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_AccountsByTrialBalanceCurrent '" . $from_date . "','" . $to_date . "'");
		 //echo $this->db->last_query();exit;
		return $res->result();
	}
	//AccountsByAccountsGroupLedger
	function AccountsByAccountsGroupLedger($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_AccountsByAccountsGroupLedger '" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//AccountsByGroupLedgertransaction
	function AccountsByGroupLedgertransaction($from_date, $to_date, $officeledgerid)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_AccountsByGroupLedgertransaction '" . $from_date . "','" . $to_date . "','" . $officeledgerid . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//AccountsByAccountsGroupGeneralLedger
	function AccountsByAccountsGroupGeneralLedger($from_date, $to_date, $officeledgerid)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_AccountsByAccountsGroupGeneralLedger '" . $from_date . "','" . $to_date . "','" . $officeledgerid . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//AccountsByTrialBalance
	function AccountsByTrialBalance($from_date,$to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_AccountsByTrialBalance '" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//AccountsByAccountsGroup
	function AccountsByAccountsGroup($from_date, $to_date, $AccountsGroupParent_Id)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_AccountsByAccountsGroup  '" . $from_date . "','" .  $to_date . "'," . $AccountsGroupParent_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//AccountsByAccountsGroupLedgerGroupwise
	function AccountsByAccountsGroupLedgerGroupwise($from_date, $to_date, $AccountsGroup_Id)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_AccountsByAccountsGroupLedgerGroupwise  '" . $from_date . "','" .  $to_date . "','" . $AccountsGroup_Id . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//AccountsBybalancesheet
	function AccountsBybalancesheet($AccountsGroupParent_Id)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_AccountsBybalancesheet  '" . $AccountsGroupParent_Id . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//AccountsBybalancesheetLedgerGroupwise
	function AccountsBybalancesheetLedgerGroupwise($AccountsGroupParent_Id)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_AccountsBybalancesheetLedgerGroupwise  '" . $AccountsGroupParent_Id . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//AccountsByProfitLoss
	function AccountsByProfitLoss($from_date, $to_date, $AccountsGroupParent_Id)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_AccountsByProfitLoss  '" . $from_date . "','" .  $to_date . "'," . $AccountsGroupParent_Id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//AccountsByProfitLossLedgerGroupwise
	function AccountsByProfitLossLedgerGroupwise($from_date, $to_date, $AccountsGroup_Id)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_AccountsByProfitLossLedgerGroupwise  '" . $from_date . "','" .  $to_date . "','" . $AccountsGroup_Id . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//AccountsByProfitLossSales
	function AccountsByProfitLossSales($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_AccountsByProfitLossSales  '" . $from_date . "','" .  $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	
	function Productoverall()
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_Productoverall");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	
	
	function Productoverallinvoice()
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_Invoicepartpay");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	
	function Productoverallinvoicepro($id)
	{
		$res = $this->db->query("SELECT  Invoice_Id, product_id, product, ProductCategory, InvoiceProduct_total, SalesReturnProduct_total, [Product Net totel] as Product_Net_totel FROM ".$_SESSION['currentdatabasename'].".dbo.Productoverallwithpartpay where Invoice_Id=".$id);
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//By Sales Net Total
	function Rep_SalesbyNettotal($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_SalesbyNettotal '" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//By Sales Product Net Total
	function Rep_SalesbyProductNettotal($from_date, $to_date)
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_SalesbyProductNettotal '" . $from_date . "','" . $to_date . "'");
		// echo $this->db->last_query();exit;
		return $res->result();
	}
	//Overallstock
	function Overallstock()
	{
		$res = $this->db->query("exec ".$_SESSION['currentdatabasename'].".dbo.Rep_Overallstock");
		 //echo $this->db->last_query();exit;
		return $res->result();
	}
}
