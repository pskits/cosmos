<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Sales extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (isset($_SESSION['currentdatabasename'])) {
            $this->db = $this->load->database($_SESSION['currentdatabasename'], TRUE);
        }
        $this->load->model('SalesClass');
        $this->load->model('AccountsClass');
    }
    //Orderlist
    public function Orderlist()
    {
        $this->load->view('Sales/Orderlist');
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
        $this->load->view('Sales/SalesOrderprint.php');
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
        $this->load->view('Sales/Invoiceprint.php');
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
    
}
