<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Production extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (isset($_SESSION['currentdatabasename'])) {
            $this->db = $this->load->database($_SESSION['currentdatabasename'], TRUE);
        }
        $this->load->model('Purchaseclass');
        $this->load->model('Productionclass');
    }
    //approvedpurchaseorder
 
    public function ApprovedPurchaseOrder()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('Production/ApprovedPurchaseOrder', $data);
    }
    public function ExportedPurchaseOrder()
    {
        $this->load->view('Production/ExportedPurchaseOrder');
    }
    public function ApprovedPurchaseOrderProducts()
    {
        if (((!isset($_GET['Key'])) && ((empty($_GET['Key'])))) && ((!isset($_GET['id'])) && ((empty($_GET['id']))))) {
            redirect("Production/ApprovedPurchaseOrder");
        }
        $id = $_GET['id'];
        $PurchaseOrder_Id = base64_decode($id);
        $officedbname = $_GET['Key'];
        $officedbname = base64_decode($officedbname);
        $Purchaseorderoffice_Details = $this->GM->Office($officetype = "0", $status = "1", $Id = "0", $dbnamer = $officedbname);
        $Purchaseorderoffice_Details =  $Purchaseorderoffice_Details[0];
   
        $factorydbdata = $this->GM->factoryApprovedPurchaseOrder(1, $PurchaseOrder_Id,$Purchaseorderoffice_Details->office_Id, 0, '', '');
       
        if ($factorydbdata) {
          
            foreach ($factorydbdata[0] as $key => $value) {
                $_POST[$key] = $value;
            }
            $data = array('PurchaseOrder_Id' => $PurchaseOrder_Id, 'officedbname' => $officedbname, 'But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
           if(!empty($factorydbdata[0]->ApprovedPurchaseOrder_date))
           {
            $this->load->view('Production/ApprovedPurchaseOrderCompleteProducts', $data);
           }
           else
           {
            $this->load->view('Production/ApprovedPurchaseOrderProducts', $data);
           }
           
        } else {
            $dbdata = $this->GM->ApprovedPurchaseOrder(1, 0, 0, 0, $PurchaseOrder_Id, $officedbname);
            if ($dbdata) {
                foreach ($dbdata[0] as $key => $value) {
                    $_POST[$key] = $value;
                }
            }
            $data = array('PurchaseOrder_Id' => $PurchaseOrder_Id, 'officedbname' => $officedbname, 'But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
            $this->load->view('Production/CreateApprovedPurchaseOrder', $data);
        }
    }
    public function ApprovedPurchaseOrder_Save()
    {
        if ($this->Productionclass->ApprovedPurchaseOrder_Validation()) {
            $this->Productionclass->ApprovedPurchaseOrder_Save();
        }
    }
  
    public function ApprovedPurchaseOrderProducts_Save()
    {
        if ($this->Productionclass->ApprovedPurchaseOrderProducts_Validation()) {
            $this->Productionclass->ApprovedPurchaseOrderProducts_Save();
        }
    }
    public function ApprovedPurchaseOrderProducts_Complete()
    {
        if ($this->Productionclass->ApprovedPurchaseOrderComplete_Validation()) {
            $this->Productionclass->ApprovedPurchaseOrderComplete_Save();
        }
    }
    public function ApprovedPurchaseOrderProduct_delete()
    {
      
        if (isset($_REQUEST['Key'])) {
            
           $qry ="Exec_ApprovedPurchaseOrderProductRemove '" . base64_decode($_REQUEST['Key']) . "',
           '" . $this->session->userdata['cosmolog']['UId']. "'";
         
           $query = $this->db->query($qry);
        }
      
        echo "<script> history.go(-1);</script>";
    }
    
    //Production
    public function Production()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('Production/Production', $data);
    }
    public function Production_Save()
    {
        if ($this->Productionclass->Production_Validation()) {
            $this->Productionclass->Production_Save();
        }
    }
    public function Production_View()
    {
        $data = array('But' => 'Show', 'Icon' => 'fa fa-cloud-download', 'BtnColor' => 'bg-black text-white');
        $this->load->view('Production/Production_View', $data);
    }
    public function ProductionProducts()
    {
        if ((!isset($_GET['Key'])) && (empty($_GET['Key']))) {
            redirect("Production/Production");
        } else {
            $id = $_GET['Key'];
            $Production_Id = base64_decode($id);
        }
        $dbdata = $this->GM->ProductionComplete($status = "1", $Production_Id, '', '');
        $data = array('Production_Id' => $Production_Id, 'But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
    
        if ($dbdata) {
         
            $this->load->view('Production/ProductionCompletedProducts', $data);
        } else {
            $this->load->view('Production/ProductionProducts', $data);
        }
    }
    public function ProductionProducts_Save()
    {
        if ($this->Productionclass->ProductionProducts_Validation()) {
            $this->Productionclass->ProductionProducts_Save();
        }
    }
    public function ProductionProducts_Complete()
    {
        if ($this->Productionclass->ProductionProductsComplete_Validation()) {
            $this->Productionclass->ProductionProductsComplete_Save();
        }
    }
}
