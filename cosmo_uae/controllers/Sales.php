<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Sales extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
       
        $this->load->model('SalesClass');
        $this->load->model('AccountsClass');
		$this->load->model('MobileAPIClass');
    }
    //Orderlist
    public function Orderlist()
    {
        $this->load->view('Sales/Orderlist');
    }
	
	function AddOrder()
	{
		if ($this->SalesClass->orders_Validation()) {
			$result = $this->SalesClass->orders_Save();
			if ($result) {
					$this->session->set_flashdata('msgS', $result);
			
			
			} else {
					$this->session->set_flashdata('msgU', "Not Saved");
						}
		} else {
			$this->session->set_flashdata('msgU', "Missing Details");
		}
		echo "<script> history.go(-1);</script>";
	}
		public function SalesOrder()
    {
		if (isset($_GET['Key']))
		{ 
			$data = array('But' => 'Update', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
			$Key = base64_decode($_GET['Key']);
				$dbdata = $this->GM->Orderlist($status_id = 1, $Warehouseid = "0", $Dealer_Id = "0", $salesexecutiveuser_Id = "0", $priority_Id = "0", $Order_status_Id = "0", $Key );
		
			if ($dbdata[0]) {
				foreach ($dbdata[0] as $key => $value) {
					$_POST[$key] = $value;
				}
			}
		}
		else{
		$data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
		}
		$this->load->view('Sales/SalesOrder', $data);
	
    }
    
    public function Orderlist_ReadyforTrip()
    {
        $this->load->view('Sales/Orderlist_ReadyforTrip');
    }
    public function Orderlist_viewReadyfortrip()
    {
		        $this->load->view('Sales/Orderlist_viewReadyfortrip');
    }
    public function Orderlist_view()
    {
        $this->load->view('Sales/Orderlist_view');
    }
    public function SalesOrderPrint()
    {
        $this->load->view('Sales/SalesOrderprint');
    }
    //Invoice
    public function Invoice()
    {
        $this->load->view('Sales/Invoice');
    }
    public function InvoiceDue()
    {
        $this->load->view('Sales/InvoiceDue');
    }
	 public function InvoiceOverDue()
    {
        $this->load->view('Sales/InvoiceOverDue');
    }
	
    public function Invoice_view()
    {
        $this->load->view('Sales/Invoice_view');
    }
    public function InvoicePrint()
    {
        $this->load->view('Sales/Invoiceprint');
    }
	//Invoiceprintwithoutserialnumber
	 public function Invoiceprintwithoutserialnumber()
	 {
        $this->load->view('Sales/Invoiceprintwithoutserialnumber');
    }
	  public function PreprintedInvoice()
    {
        $this->load->view('Sales/PreprintedInvoice.php');
    }
    //Order to Invoice
    public function Invoice_Save()
    {
        if ($this->SalesClass->Invoice_Validation()) {
            $this->SalesClass->Invoice_Save();
        }
    }
	 public function Invoice_Status()
    {
        if ($this->SalesClass->InvoiceStatus_Validation()) {
            $this->SalesClass->Invoicestatus_Save();
        }
    } 
	
    public function Order_Decline()
    {
        if ($this->SalesClass->Orderstatus_Validation()) {
            $this->SalesClass->Orderstatus_Save();
        }
    } 
     public function Order_Accept()
    {
        if ($this->SalesClass->Orderstatus_Validation()) {
            $this->SalesClass->Orderstatus_Save();
        }
    }
	 public function Orders_CashRate()
    {
        if ($this->SalesClass->OrdersCashRate_Validation()) {
            $this->SalesClass->OrdersCashRate_Save();
        }
    }
    
}
