<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Accounts extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
      $this->db = $this->load->database($_SESSION['currentdatabasename'], TRUE);
    
    $this->load->model('AccountsClass');
  }
  //Group start
  public function Group()
  {
    $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
    $this->load->view('Accounts/Group', $data);
  }
  public function Group_Save()
  {
    if ($this->AccountsClass->Group_Validation()) {
      $this->AccountsClass->Group_Save();
    }
  }
  public function Group_View()
  {
    $this->load->view('Accounts/Group_View');
  }
  //Group end 
  //Ledger start
  public function Ledger()
  {
	  	if(isset($_GET['Key']))
{
	 $data = array('But' => 'Update', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
            $Id = base64_decode($_GET['Key']);
            $dbdata = $this->GM->Ledger($status=0,$accountsgroup_id=0,$Id);
            if ($dbdata[0]) { 
                foreach ($dbdata[0] as $key => $value) {
                    $_POST[$key] = $value;
                }
            }
}
else
{
	 $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
      
}

    $this->load->view('Accounts/Ledger', $data);
  }
  public function Ledger_Save()
  {
    if ($this->AccountsClass->Ledger_Validation()) {
      $this->AccountsClass->Ledger_Save();
    }
  }
  public function Ledger_View()
  {
    $this->load->view('Accounts/Ledger_View');
  }
  //Ledger end 
  // Voucher
   public function Creditnote()
  {
    $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
    $this->load->view('Accounts/Creditnote', $data);
  }
  
  public function Voucher()
  {
    $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
    $this->load->view('Accounts/Voucher', $data);
  }
  public function Voucher_View()
  {
    $this->load->view('Accounts/Voucher_View');
  }
  public function CreditNote_View()
  {
    $this->load->view('Accounts/CreditNote_View');
  }
  public function CreditNote_invoice()
  {
	   $this->load->view('Accounts/CreditNote_invoice');
  }
  public function Voucher_invoice()
  {
    $this->load->view('Accounts/Voucher_invoice');
  }
  public function BankReconciliation()
  {
    $this->load->view('Accounts/BankReconciliation');
  }
  public function BankReconciliation_reconciled()
  {
    $this->load->view('Accounts/BankReconciliation_reconciled');
  }
  public function BankReconciliation_Save()
  {
   $this->AccountsClass->BankReconcilation();   
    
    echo "<script> history.go(-1);</script>";
  }
  
  public function Voucher_invoiceprint()
  {
    $this->load->view('Accounts/Voucher_invoiceprint.php');
  }
  public function Voucher_Save()
  {
    if ($this->AccountsClass->Voucher_Validation()) {
      $lastid = $this->AccountsClass->Voucher_Save();
      if ($lastid) {
        $this->AccountsClass->VoucherTransaction_Save($lastid);
      }
    }
    echo "<script> history.go(-1);</script>";
  }
  public function Creditnote_Save()
  {
    if ($this->AccountsClass->Creditnote_Validation()) {
       $this->AccountsClass->Creditnote_Save();    
    }
    echo "<script> history.go(-1);</script>";
  }
  public function VoucherAgainstSalesReturn()
  {
    if ($this->AccountsClass->VoucherAgainstSalesReturnVIEW_Validation()) {
      $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
      $this->load->view('Accounts/VoucherAgainstSalesReturn', $data);
    } else {
      echo "<script> history.go(-1);</script>";
    }
  }
  public function VoucherAgainstSalesReturn_Save()
  {
    if ($this->AccountsClass->Voucher_Validation()) {
      if ($this->AccountsClass->Voucher_Save()) {
        $this->load->model('SalesReturnClass');
        $_POST['SalesReturn_status_Id'] = "3";
        if ($this->SalesReturnClass->TransSalesReturnStatus_Validation()) {
          $this->SalesReturnClass->TransSalesReturnStatus_Save();
        }
        echo "<script> history.go(-2);</script>";
      } else {
        echo "<script> history.go(-1);</script>";
      }
    }
  }
}
