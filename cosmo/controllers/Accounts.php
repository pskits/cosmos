<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Accounts extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
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
    if (isset($_GET['Key'])) {
      $data = array('But' => 'Update', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
      $Id = base64_decode($_GET['Key']);
      $dbdata = $this->GM->Ledger($status = 0, $accountsgroup_id = 0, $Id);
      if ($dbdata[0]) {
        foreach ($dbdata[0] as $key => $value) {
          $_POST[$key] = $value;
        }
      }
    } else {
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
  
 
}
