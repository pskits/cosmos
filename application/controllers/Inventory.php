<?php
class Inventory extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (isset($_SESSION['currentdatabasename'])) {
            $this->db = $this->load->database($_SESSION['currentdatabasename'], TRUE);
        }
        $this->load->model('InventoryClass');
    }
    public function index()
    {
        echo "<script>window.location='" . site_url() . "'</script>";
    }
    public function Goods_View()
    {
        $this->load->view('Inventory/Goods_View');
    }
	 public function GoodsInvoiced()
    {
		$this->load->view('Inventory/GoodsInvoiced');
    }
	
    //Trip
    public function Trip()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('Inventory/Trip', $data);
    }
    public function Trip_Save()
    {
        if ($this->InventoryClass->Trip_Validation()) {
            $this->InventoryClass->Trip_Save();
        }
    }
    public function TripDeliveries_Save()
    {
        if ($this->InventoryClass->TripDeliveries_Validation()) {
            $this->InventoryClass->TripDeliveries_Save();
        }
    }
    public function Trip_View()
    {
        $this->load->view('Inventory/Trip_View');
    }
    public function Trip_Overview()
    {
        $this->load->view('Inventory/Trip_Overview');
    }
    // GoodsJournal
    public function GoodsJournal()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('Inventory/GoodsJournal', $data);
    }
    public function GoodsJournal_Save()
    {
        if ($this->InventoryClass->GoodsJournal_Validation()) {
            $this->InventoryClass->GoodsJournal_Save();
        }
    }
    public function GoodsJournal_View()
    {
        $this->load->view('Inventory/GoodsJournal_View');
    }
    // Goods Transfer
    public function GoodsTransfer()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('Inventory/GoodsIntraTransfer', $data);
    }
    public function GoodsTransfer_addGoods()
    {
        if (isset($_GET['Key'])) {
            $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
            $id = base64_decode($_GET['Key']);
            $dbdata = $this->GM->GoodsTransfer($status_Id = "0", $id, $GoodsTransferType_Id = "0", $fromWarehouse_Id = "0", $tobranch_Id = "0", $from_date = '', $to_date = '');
            if (isset($dbdata[0])) {
                foreach ($dbdata[0] as $key => $value) {
                    $_POST[$key] = $value;
                }
            }
            $this->load->view('Inventory/GoodsTransfer_addGoods', $data);
        } else {
            echo "<script> history.go(-1);</script>";
        }
    }
 
    public function GoodsTransfer_Commit()
    {
        if ($this->InventoryClass->GoodsTransfer_Validation()) {
            $this->InventoryClass->GoodsTransfer_Save();
        }
    }
    public function GoodsTransfer_Save()
    {
        if ($this->InventoryClass->GoodsTransferGoods_Validation()) {
            $this->InventoryClass->GoodsTransferGoods_Save();
        }
    }
    public function GoodsTransfer_View()
    {
        $this->load->view('Inventory/GoodsTransfer_View');
    }
    public function GoodsTransfer_Invoice()
    {
        $this->load->view('Inventory/GoodsTransfer_Invoice');
    }
    public function GoodsTransferInvoicePrint()
    {
        $this->load->view('Inventory/GoodsTransferInvoicePrint');
    }
}
