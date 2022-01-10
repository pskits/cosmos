<?php
defined('BASEPATH') or exit('No direct script access allowed');
class SalesReturn extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (isset($_SESSION['currentdatabasename'])) {
            $this->db = $this->load->database($_SESSION['currentdatabasename'], TRUE);
        }
        $this->load->model('SalesReturnClass');
        $this->load->model('AccountsClass');
    }
    //SalesReturn start
    public function SalesReturn()
    {
        $this->load->view('SalesReturn/SalesReturn');
    }
	 public function SalesReturnPrint()
    {
        $this->load->view('SalesReturn/salesReturnPrint');
    }
    public function SalesReturnGoods_Decide()
    {
        $this->load->view('SalesReturn/SalesReturnGoods_Decide');
    }
    public function SalesReturn_view()
    {
        $this->load->view('SalesReturn/SalesReturn_View');
    }
    public function SalesReturnRequest_View()
    {
        $this->load->view('SalesReturn/SalesReturnRequest_View');
    }
    public function SalesReturnRequestInvoice_View()
    {
        $this->load->view('SalesReturn/SalesReturnRequestInvoice_View');
    }
    public function SalsReturnSerialNoProduct_StatusUpdate()
    {
        if ($this->SalesReturnClass->SalesReturnRequestProductStatus_Validation()) {
            $this->SalesReturnClass->SalesReturnRequestProductStatus_Save();
        }
    }

    public function SalesReturnGoodsScrab_Status()
    {
        if ($this->SalesReturnClass->SalesReturnGoodsScrab_Validation()) {
            $this->SalesReturnClass->SalesReturnGoodsScrab_Save();
        }
    }
    public function SalesReturnGoodsResellable_Status()
    {
        if ($this->SalesReturnClass->SalesReturnGoodsResellable_Validation()) {
            $this->SalesReturnClass->SalesReturnGoodsResellable_Save();
        }
    }
  
   public function SalesReturnRequest_Status()
    {
        if ($this->SalesReturnClass->TransSalesReturnRequestStatus_Validation()) {
            $this->SalesReturnClass->TransSalesReturnRequestStatus_Save();
        }
    }
    public function SalesReturnReplacement_Save()
    {
        if ($this->SalesReturnClass->SalesReturnReplacement_Validation()) {
            $this->SalesReturnClass->SalesReturnReplacement_Save();
        }
    }
    
    public function SalsReturnSerialNo_StatusUpdate()
    {
        if ($this->SalesReturnClass->SalesReturnRequestStatus_Validation()) {
            $this->SalesReturnClass->SalesReturnRequestStatus_Save();
        }
    }
    public function SalsReturnRequest_Completion()
    {
        if ($this->SalesReturnClass->SalesReturnRequestCompletion_Validation()) {
            $this->SalesReturnClass->SalesReturnRequestCompletion_Save();
        }
    }
    public function SalesReturnRequest_Process()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('SalesReturn/SalesReturnRequest_Process', $data);
    }

    
    public function SalesReturnRequest_ProcessSave()
    {
        if ($this->SalesReturnClass->SalesReturn_Validation()) {
            $this->SalesReturnClass->SalesReturn_Save();
        }
    }
    public function SalesReturn_PaymentAdjust()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('SalesReturn/SalesReturn_PaymentAdjust', $data);
    }
    public function SalesReturn_PaymentAdjustSave()
    {
        if ($this->SalesReturnClass->SalesReturnPaymentAdjust_Validation()) {
            $this->SalesReturnClass->SalesReturnPaymentAdjust_Save();
        }
    }
}
