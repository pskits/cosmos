<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Purchase extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
       
        $this->load->model('Purchaseclass');
        $this->load->model('AccountsClass');
    }

    //Supplier

    public function Supplier()
    {
        if (isset($_GET['Key'])) {
            $data = array('But' => 'Update', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
            $Key = base64_decode($_GET['Key']);
            $dbdata = $this->GM->Supplier($status_id = "1",  $Key);
            if (isset($dbdata[0])) {
                foreach ($dbdata[0] as $key => $value) {
                    $_POST[$key] = $value;
                }
            }
        } else {
            $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        }

        $this->load->view('Purchase/Supplier', $data);
    }


    public function Supplier_Commit()
    {
        if ($this->Purchaseclass->Supplier_Validation()) {
            $this->Purchaseclass->Supplier_Save();
        }
    }

    public function Supplier_View()
    {
        $this->load->view('Purchase/Supplier_View');
    }

    public function Tax()
    {
        $taxid = $_GET['tax'];
        $status = "1";
        $data = $this->GM->Taxes($status, $taxid);
        foreach ($data as $key) {
            $id = "TaxPercentage";
            $datas = $key->$id;
            echo "$datas";
        }
    }

    public function SupplierUser_View()
    {
        $this->load->view('Purchase/Supplieruser_view');
    }
    public function SupplierDetails()
    {
        $status_id = "1";      
        $Supplier_Id = $_GET['Supplier_Id'];
        $data = $this->GM->Supplier($status_id,  $Supplier_Id);
        foreach ($data as $key) {
            $data1 = '
              <table  class="table">
                      <tr>
                        <th style="width:50%">Name</th>
                        <td>' . $key->name  . '</td>
                      </tr>
                   
                      <tr>
                        <th>City</th>
                        <td>' . $key->City . '</td>
                      </tr>
                      <tr>
                      <th>Currency Name</th>
                      <td>' . $key->CurrencyName . '</td>
                    </tr>
                      <tr>
                        <th>Code</th>
                        <td>' . $key->code . '</td>
                      </tr>
                      <tr>
                        <th>Tax No</th>
                        <td>' . $key->Tax_No . '</td>
                      </tr>
                    </table>
              ';
        }
        echo "$data1";
    }

    public function PurchaseOrder()
    {
        if (isset($_GET['Key'])) {
            $data = array('But' => 'Update', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
            $Key = base64_decode($_GET['Key']);
            $dbdata = $this->GM->PurchaseOrder($status_id = "0", $WarehouseCode = "0", $Supplier_Id = "0", $PurchaseOrderStatus_Id = "0", $Key, $from_date = '', $to_date = '');
            if (isset($dbdata[0])) {
                foreach ($dbdata[0] as $key => $value) {
                    $_POST[$key] = $value;
                }
            }
        } else {
            $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        }
        $this->load->view('Purchase/PurchaseOrder', $data);
    }
    public function PurchaseOrder_Commit()
    {
        if ($this->Purchaseclass->PurchaseOrder_Validation()) {
            $this->Purchaseclass->PurchaseOrder_Save();
        }
    }

    public function PurchaseOrder_View()
    {
        $this->load->view('Purchase/PurchaseOrder_View');
    }
    // purchaseorder_invoice
    public function purchaseorder_invoice()
    {
        $this->load->view('Purchase/purchaseorder_invoice');
    }
    public function purchaseorder_invoiceprint()
    {
        $this->load->view('Purchase/purchaseorder_invoiceprint.php');
    }
    // PurchaseOrderstatus

    public function PurchaseOrderstatus()
    {
        $this->Purchaseclass->PurchaseOrderstatus_Save();
    }
    //Bill
    public function Bill()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');

        $this->load->view('Purchase/bill', $data);
    }
	 public function PurchaseBill()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');

        $this->load->view('Purchase/PurchaseBill', $data);
    }
    public function Bill_Save()
    {
        if ($this->Purchaseclass->Bill_Validation()) {
            $this->Purchaseclass->Bill_Save();
        }
    }

    public function Bill_View()
    {
        $this->load->view('Purchase/Bill_View');
    }

    // Bill_invoice
    public function Bill_invoice()
    {
        $this->load->view('Purchase/Bill_invoice');
    }
    public function Bill_invoiceprint()
    {
        $this->load->view('Purchase/Bill_invoiceprint.php');
    }

    //Import
    public function Import()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');

        $this->load->view('Purchase/Import', $data);
    }
    public function Import_Save()
    {
        if ($this->Purchaseclass->Import_Validation()) {
            $this->Purchaseclass->Import_Save();
        }
    }

    public function Import_View()
    {
        $this->load->view('Purchase/Import_View');
    }

    // Import_invoice
    public function Import_invoice()
    {
        $this->load->view('Purchase/Import_invoice');
    }
    public function Import_invoiceprint()
    {
        $this->load->view('Purchase/Import_invoiceprint.php');
    }

    //Inward
    public function Inward()
    {
        if ((!isset($_GET['Key'])) && (empty($_GET['Key']))) {
            redirect("Purchase/purchaseorder");
            exit;
        } else {
            $id = $_GET['Key'];
            $purchaseorder_Id = base64_decode($id);
            $data = array('purchaseorder_Id' => $purchaseorder_Id, 'key' => $id, 'But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');


            $this->load->view('Purchase/Inward', $data);
        }
    }
    public function InwardProducts_Complete()
    {
        if ($this->Purchaseclass->InwardProducts_Validation()) {
            $this->Purchaseclass->InwardProducts_Save();
        }
    }
}
