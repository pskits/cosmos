<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Collection extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
      
        $this->load->model('CollectionClass');
        $this->load->model('AccountsClass');
    }
  
    public function Excess()
    {
        $this->load->view('Collection/Excess');
    }   
	public function CollectionNonDeposited_View()
    {
        $this->load->view('Collection/CollectionNonDeposited');
    }   
	
    
    public function Excess_Adjustment()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
      
        $this->load->view('Collection/Excess_Adjustment', $data);
    }
    
    public function Excess_Save()
    {
        if ($this->CollectionClass->Collection_Validation()) {
            $this->CollectionClass->Excess_Save();
        }
        echo "<script> history.go(-2);</script>";
    }
     
    // Collection
    public function index()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('Collection/Collection', $data);
    }
    public function Collection_Save()
    {
        if ($this->CollectionClass->Collection_Validation()) {
            $this->CollectionClass->Collection_Save();
        }
    }
    public function Collection_View()
    {
        $this->load->view('Collection/Collection_View');
    }
    public function Collection_invoice()
    {
        $this->load->view('Collection/Collection_invoice');
    }
    public function Collection_invoiceprint()
    {
        $this->load->view('Collection/Collection_invoiceprint.php');
    }
    //Deposit
    public function Deposit()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('Collection/Deposit', $data);
    }
    public function Deposit_Save()
    {
        if ($this->CollectionClass->Deposit_Validation()) {
            $this->CollectionClass->Deposit_Save();
        }
        echo "<script> history.go(-1);</script>";
    }
    public function Deposit_View()
    {
        $this->load->view('Collection/Deposit_View');
    }
    public function Deposit_invoice()
    {
        $this->load->view('Collection/Deposit_invoice');
    }
    public function Deposit_invoiceprint()
    {
        $this->load->view('Collection/Deposit_invoiceprint.php');
    }
    //Settlement
    public function Settlement()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('Collection/Settlement', $data);
    }
    public function Settlement_Save()
    {
        if ($this->CollectionClass->Settlement_Validation()) {
            $this->CollectionClass->Settlement_Save();
        }
    }
    public function Settlement_View()
    {
        $this->load->view('Collection/Settlement_View');
    }
	 public function SettlementNonDeposited_View()
    {
        $this->load->view('Collection/SettlementNonDeposited_View');
    }
    public function Settlement_invoice()
    {
        $this->load->view('Collection/Settlement_invoice');
    }
    public function Settlement_invoiceprint()
    {
        $this->load->view('Collection/Settlement_invoiceprint.php');
    }
    //BankApproval
    public function BankApproval()
    {
        $this->load->view('Collection/BankApproval');
    }
    public function BankApproval_Save()
    {
        if ($this->CollectionClass->BankApproval_Validation()) {
            $this->CollectionClass->BankApproval_Save();
        }
    }
}
