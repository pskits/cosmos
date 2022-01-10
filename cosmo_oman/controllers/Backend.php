<?php
class Backend extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($_SESSION['UId']!='1') {
		//echo "<script> history.go(-1);</script>";
		}
	}
	public function index()
	{
		echo "<script> history.go(-1);</script>";
	}
	
	 public function GoodsSerialsLoad()
  {
    $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
    $this->load->view('Backend/Goodsload', $data);
  }
	public function GoodsSerialsLoad_Save()
	{
	$_POST['Serial_no'] = explode(" ", $_POST['Serial_no']);
	$qry ='';
		foreach($_POST['Serial_no'] as $Serial_No)
		{
	$qry .= "Exec ".$_SESSION['currentdatabasename'].".dbo.Backend_SerialsLoad 	'" . $_POST['Warehouseid'] . "'
        ,'" . $_POST['Product_id'] . "'	
 ,'" . $Serial_No . "'			
		,'" . $_POST['User_Id'] . "'";
		
		
	}
	//echo $qry;exit;
	$query = $this->db->query($qry);
	
		if ($query) {
			$this->session->set_flashdata('msgS', "Success");
		} else {
			$this->session->set_flashdata('msgU', "Same Data Already Exist");
		}
		echo "<script> history.go(-1);</script>";
	}
	public function Check_InvoiceGoods()
	{
		$qry = "SELECT * FROM (
SELECT ti.Invoice_Id,ti.Invoice_date,ti.Invoice_No,
(SELECT sum(tip.InvoiceProduct_Quantity) FROM ".$_SESSION['currentdatabasename'].".dbo.Trans_Invoiceproduct tip WHERE tip.Invoice_id=ti.Invoice_Id) AS prodTotal,
(SELECT count(DISTINCT  tg.Serial_No) FROM ".$_SESSION['currentdatabasename'].".dbo.Trans_Goods tg WHERE tg.OutwardGoodsType_Id=4 AND tg.OutwardAgainst_Id=ti.Invoice_Id ) AS goodsTotal
FROM ".$_SESSION['currentdatabasename'].".dbo.Trans_Invoice ti 
WHERE ti.Invoice_status_Id=3
)overall
WHERE prodTotal <> goodsTotal";
		$query = $this->db->query($qry);
		$result = $query->result();
		
		foreach($result as $Row)
		{
			print_r($Row);
			echo "<br>";
		}
		
		
	}
	
	public function Check_PurchaseGoods()
	{
		$qry = "
SELECT * FROM (
SELECT tpo.PurchaseOrder_Id,tpo.PurchaseOrder_code,tpo.PurchaseOrder_Date,
(SELECT count(DISTINCT Serial_No) FROM ".$_SESSION['currentdatabasename'].".dbo.Trans_Goods WHERE InwardGoodsType_Id=1 AND InwardAgainst_Id=tpo.PurchaseOrder_Id) AS goods,
(SELECT sum(tpop.Trans_PurchaseOrderProduct_Quantity) FROM ".$_SESSION['currentdatabasename'].".dbo.Trans_PurchaseOrderProduct tpop WHERE tpo.PurchaseOrder_Id=tpop.Trans_PurchaseOrder_Id) AS qty
 FROM ".$_SESSION['currentdatabasename'].".dbo.Trans_PurchaseOrder tpo
 WHERE tpo.PurchaseOrder_status_Id>2
)overall
WHERE goods <> qty";
		$query = $this->db->query($qry);
		$result = $query->result();
		
		foreach($result as $Row)
		{
			print_r($Row);
			echo "<br>";
		}
		
		
	}
		public function Check_InventoryDuplicated()
	{
		$qry = "
SELECT tg.InwardGoodsType_Id,tg.InwardAgainst_Id,tg.Serial_No, count(Serial_No) 
FROM ".$_SESSION['currentdatabasename'].".dbo.Trans_Goods tg
WHERE tg.Inward_date IS NOT NULL 
GROUP BY tg.InwardGoodsType_Id,tg.InwardAgainst_Id,tg.Serial_No
HAVING count(Serial_No) > 1
union all 
SELECT OutwardGoodsType_Id, OutwardAgainst_Id, Serial_No, count(Serial_No) FROM ".$_SESSION['currentdatabasename'].".dbo.Trans_Goods 
GROUP BY OutwardGoodsType_Id, OutwardAgainst_Id, Serial_No
HAVING count(Serial_No) >1
";
		$query = $this->db->query($qry);
		$result = $query->result();
		
		foreach($result as $Row)
		{
			print_r($Row);
			echo "<br>";
		}
		
		
	}
	

	}