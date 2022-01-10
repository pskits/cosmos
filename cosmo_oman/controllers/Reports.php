<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Reports extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
      // error_reporting(-1);
        $this->load->model('ReportsClass');
    }
	 public function AccountsByTrialBalance_Oldversion()
    {
        $this->load->view('Reports/AccountsByTrialBalance_Oldversion');
    }
    public function SalesByDealer()
    {
        $this->load->view('Reports/SalesByDealer');
    }
    public function SalesByExecutive()
    {
        $this->load->view('Reports/SalesByExecutive');
    }
    public function SalesByInvoice()
    {
        $this->load->view('Reports/SalesByInvoice');
    }
    public function SalesByProduct()
    {
        $this->load->view('Reports/SalesByProduct');
    }
	 public function SalesByExecutiveProductWise()
    {
        $this->load->view('Reports/SalesByExecutiveProductWise');
    }
	
    public function SalesOpenOrders()
    {
        $this->load->view('Reports/SalesOpenOrders');
    }
    public function SalesByCreditPeriod()
    {
        $this->load->view('Reports/SalesByCreditPeriod');
    }
    public function SalesRegister()
    {
        $this->load->view('Reports/SalesRegister');
    }
    public function InventorySummary()
    {
        $this->load->view('Reports/InventorySummary');
    }
    public function InventorySummary_DateWise()
    {
        $this->load->view('Reports/InventorySummary_DateWise');
    }
    public function InventorySerialno()
    {
        $this->load->view('Reports/InventorySerialno');
    }
    public function InventoryFlowbyBooks()
    {
        $this->load->view('Reports/InventoryFlowbyBooks');
    }
    public function InventoryFlowbyStock()
    {
        $this->load->view('Reports/InventoryFlowbyStock');
    }
	public function Rep_Inventory_vs_PurchaseOrder()
    {
        $this->load->view('Reports/Rep_Inventory_vs_PurchaseOrder');
    }
	
    
    
    public function CollectionbyMode()
    {
        $this->load->view('Reports/CollectionbyMode');
    }
    public function CollectionbyStatus()
    {
        $this->load->view('Reports/CollectionbyStatus');
    }
    public function CollectionConverted()
    {
        $this->load->view('Reports/CollectionConverted');
    }
    public function CollectionUncredited()
    {
        $this->load->view('Reports/CollectionUncredited');
    }
    public function DealerwiseCreditBalance()
    {
        $this->load->view('Reports/DealerwiseCreditBalance');
    }
    public function DealerwiseageingUncollected()
    {
        $this->load->view('Reports/DealerwiseageingUncollected');
    }
    public function Duewiseageing()
    {
        $this->load->view('Reports/Duewiseageing');
    }
    public function DueSalesRegister()
    {
        $this->load->view('Reports/DueSalesRegister');
    }
    public function DealerWiseDue()
    {
        $this->load->view('Reports/DealerWiseDue');
    }
    public function NotYetInvoiced()
    {
        $this->load->view('Reports/NotYetInvoiced');
    }
    public function DealerAllContacts()
    {
        $this->load->view('Reports/DealerAllContacts');
    }
    public function ReturnbyInvoiceNo()
    {
        $this->load->view('Reports/ReturnbyInvoiceNo');
    }
    public function ReturnbyDealer()
    {
        $this->load->view('Reports/ReturnbyDealer');
    }
    public function ReturnbyProduct()
    {
        $this->load->view('Reports/ReturnbyProduct');
    }
    public function ReturnbySerialNo()
    {
        $this->load->view('Reports/ReturnbySerialNo');
    }
    public function ReturnReplacementbySerialNO()
    {
        $this->load->view('Reports/ReturnReplacementbySerialNO');
    }
    public function Returnbyopenreturns()
    {
        $this->load->view('Reports/Returnbyopenreturns');
    }
    
    public function BillsBySupplier()
    {
        $this->load->view('Reports/BillsBySupplier');
    }
	 public function BillsByDate()
    {
        $this->load->view('Reports/BillsByDate');
    }
	
    public function ImportsBySupplier()
    {
        $this->load->view('Reports/ImportsBySupplier');
    }
    //Accounts
    
    public function AccountsByAlltransaction()
    {
        $this->load->view('Reports/AccountsByAlltransaction');
    }
    
    public function AccountsByAccountsGroupLedger()
    {
        $this->load->view('Reports/AccountsByAccountsGroupLedger');
    }
	 public function AccountsByAccountsGroupLedger_PDF()
    {
        $this->load->view('Reports/AccountsByAccountsGroupLedger_PDF');
    }
	 public function AccountsByAccountsGroupGeneralLedger()
    {
        $this->load->view('Reports/AccountsByAccountsGroupGeneralLedger');
    }
	 public function AccountsByAccountsGroupGeneralLedger_PDF()
    { 
        $this->load->view('Reports/AccountsByAccountsGroupGeneralLedger_PDF');
    }
	
    public function AccountsByTrialBalance()
    {
        $this->load->view('Reports/AccountsByTrialBalance');
    }
    public function AccountsByAccountsGroup()
    {
        $this->load->view('Reports/AccountsByAccountsGroup');
    }
    public function AccountsBybalancesheet()
    {
        $this->load->view('Reports/AccountsBybalancesheet');
    }
    public function AccountsByProfitLoss()
    {
        $this->load->view('Reports/AccountsByProfitLoss');
    }
    public function ReturnbyReturnNo()
    {
        $this->load->view('Reports/ReturnbyReturnNo');
    }
    public function ReturnbyUnadjustedReturns()
    {
        $this->load->view('Reports/ReturnbyUnadjustedReturns');
    }
    
   
    public function salesbyMotorsSaleswithStock()
    {
        $this->load->view('Reports/salesbyMotorsSaleswithStock');
    }
    public function SalesbyAccessoriesSaleswithStock()
    {
        $this->load->view('Reports/SalesbyAccessoriesSaleswithStock');
    }
    
    //warrenty
    
    public function WarrentyByDealer()
    {
        $this->load->view('Reports/WarrentyByDealer');
    }
    public function WarrentyByProduct()
    {
        $this->load->view('Reports/WarrentyByProduct');
    }
    public function WarrentyBySerialNo()
    {
        $this->load->view('Reports/WarrentyBySerialNo');
    }
    public function ReplacementbyProduct()
    {
        $this->load->view('Reports/ReplacementbyProduct');
    }
    public function ReplacementbyDealer()
    {
        $this->load->view('Reports/ReplacementbyDealer');
    }
    

    public function PayablesBySupplier()
    {
        $this->load->view('Reports/PayablesBySupplier');
    }
	
	public function Productoverall()
    {		
        $this->load->view('Reports/Productoverall');		
    }
	
	public function Productoverallwithpartpay()
    {		
        $this->load->view('Reports/Productoverallwithpartpay');		
    }
	
	public function Rep_SalesbyNettotal()
    {
        $this->load->view('Reports/Rep_SalesbyNettotal');
    }
	public function Rep_SalesbyProductNettotal()
    {
        $this->load->view('Reports/Rep_SalesbyProductNettotal');
    }
	public function Overallstock()
    {
        $this->load->view('Reports/Overallproductstock');
    }
    
}
