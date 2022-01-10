<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
$office = $this->GM->Office($officetype = "0", $status = "1", $Id = "0", $_SESSION['currentdatabasename']);
$office = $office[0];
$Key = $_GET['Key'];
$id = base64_decode($Key);
foreach ($this->GM->PurchaseOrder($status_id = 1, $WarehouseCode = "0", $Supplier_Id = "0", $OrderInvoiceStatus_Id = "0", $id) as $Row) {
?>
 <style>
	.preinvoice-logo{ max-width:12%; width:13%; }
	.PO-Product-List{ margin-top: 20px; }
 </style>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info row">
              <h4 class="col-md-4"><b> <?php echo $Row->PurchaseOrder_code . '(' . $Row->PurchaseOrder_StatusName . ')'; ?></b></h4>
              <div class="col-md-8">
                <a onclick="frames['frame'].print()" style="background-color:#0ea3a9;margin-right:1px;" class="btn btn-flat pull-right"><i class="fa fa-file-pdf-o"></i> PDF</a>
                <?php if ($Row->PurchaseOrder_Status_Id == '1') {
                ?>
                  <a href="<?php echo site_url("Purchase/PurchaseOrderstatus/?s=2&Key=$Row->PurchaseOrder_Id"); ?>" style="background-color:#0ea3a9;margin-right:1px;" class="btn btn-flat pull-right"><i class="fa fa-refresh"></i>Approve</a>
                  <a href="<?php echo site_url("Purchase/PurchaseOrder/?Key=$Key"); ?>" style="background-color:#0ea3a9;margin-right:1px;" class="btn btn-flat pull-right"><i class="fa fa-pen"></i>Edit</a>
                <?php }
                if ($Row->PurchaseOrder_Status_Id == '5') {
                ?>
                  <a href="<?php echo site_url('Purchase/Import/?Key=' . base64_encode($Row->PurchaseOrder_Id)); ?>" style="background-color:#0ea3a9;margin-right:1px;" class="btn btn-flat pull-right"><i class="fa fa-shopping-cart"></i> Import</a>
                  <a href="<?php echo site_url('Purchase/PurchaseBill/?Key=' . base64_encode($Row->PurchaseOrder_Id)); ?>" style="background-color:#0ea3a9;margin-right:1px;" class="btn btn-flat pull-right"><i class="fa fa-shopping-cart"></i> Purchase Bill</a>
                <?php
                }
                if ($Row->PurchaseOrder_Status_Id == '4') {
                ?>
                  <a href="<?php echo site_url('Purchase/Inward/?Key=' . base64_encode($Row->PurchaseOrder_Id)); ?>" style="background-color:#0ea3a9;margin-right:1px;" class="btn btn-flat pull-right"><i class="fa fa-shopping-cart"></i> Inward</a>
                <?php
                }
				 if ($Row->PurchaseOrder_Status_Id == '2') {
                ?>
                  <a href="<?php echo site_url('Purchase/PurchaseBill/?Key=' . base64_encode($Row->PurchaseOrder_Id)); ?>" style="background-color:#0ea3a9;margin-right:1px;" class="btn btn-flat pull-right"><i class="fa fa-shopping-cart"></i> Purchase Bill</a>
                <?php
                }
                ?>
                <a href="<?php echo site_url('Purchase/PurchaseOrder_view'); ?>" style="background-color:#0ea3a9;margin-right:1px;" class="btn btn-flat pull-right"><i class="fa fa-arrow-circle-left"></i> </a>
              </div>
            </div>
            <!-- Main content -->
            
            <!-- .invoice -->
		<div class="invoice">
			<div style="border-bottom:2px solid #666; text-align:center;">
				<img src="<?php echo base_url('assets/Pics/cosmo_pumps.png'); ?>" class="preinvoice-logo" alt="Cosmo Pumps">
				<h3 style="display:inline-block; vertical-align:bottom; padding:0; margin:0;"><b><?php echo $office->office_Name; ?></b></h3>
			</div>
			<div>
				<h3 align="center">PURCHASE ORDER</h3>
			</div>
			<div class="row">
				<div class="col-md-6 col-6 col-sm-6 col-xs-6">
				<h4><b>PO.No: <?php echo $Row->PurchaseOrder_code; ?></b></h4>
				<p>To:</p>
				<address>
                <strong><?php echo $Row->name; ?></strong><br>
                <p style="width:70%;margin:0px;">
				<?php echo $Row->Address; ?>,
				<br><?php echo $Row->City; ?><br>
				<?php echo $Row->StateName; ?> - <?php echo $Row->Postcode; ?>,
				<?php echo $Row->CountryName; ?>
                </p>               
            </address>				
		</div>
		<div class="col-md-6 col-6 col-sm-6 col-xs-6">
			<h4 align="right"><b>Date: <?php echo $Row->PurchaseOrder_Dateformatted; ?></b></h4>
			<p>Ship To:</p>
			<address>
				<strong><?php echo $office->office_Name; ?></strong><br>
				<p style="padding:0;margin:0;"><b>Post Box No: <?php echo $office->office_postcode; ?> </b></p>
                <?php echo $office->office_address; ?> <?php echo $office->City; ?><br>
				<?php echo $office->StateName; ?> <?php echo $office->CountryName; ?>
                
			</address>
		</div>
	</div>
	<div class="PO-Travel-List">
		<table style="width: 100%;"  class="table table-bordered">
			<thead>
				<tr>
					<th align="center" width="100"><b>P.O. Date</b></th>
					<th align="center"><b>Requisitioner</b></th>
					<th align="center"><b>Port of Loading</b></th>
					<th align="center"><b>Final Destination</b></th>
					<th align="center"><b>Terms</b></th>
				<tr>
			</thead>
			<tbody>
				<tr>
					<td><?php $podate =date_create($Row->PurchaseOrder_Dateformatted); echo date_format($podate,'d-m-Y'); ?></td>
					<td><b><?php echo $office->office_Name; ?></b></td>
					<td>Port of Loading Tuticorin</td>
					<td>Dubai-Jebel Ali</td>
					<td>Freight Charges: Paid by The Consignor,</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="PO-Product-List">
		<table style="width: 100%;"  class="table table-bordered">
			<thead>
				<tr>
					<th align="center"><b>Qty</b></th>
					<th align="center"><b>Unit</b></th>
					<th align="center"><b>Description</b></th>					
					<th align="center"><b>Unit Price ( <?php echo $Row->Currencycode; ?> )</b></th>
					<th align="center"><b>Total ( <?php echo $Row->Currencycode; ?> )</b></th>
				<tr>
			</thead>
			<tbody>
			<?php
                $PurchaseOrder_Id = $Row->PurchaseOrder_Id;				
                $status_id = "1";
                foreach ($this->GM->PurchaseOrderProduct($status_id, $PurchaseOrder_Id) as $Products) {                
            ?>
				<tr>
					<td align="center"><?php echo $Products->Trans_PurchaseOrderProduct_Quantity; ?></td>
					<td align="center">Nos</td>
					<td align="left"><b><?php echo $Products->Description; ?></b></td>
					<td align="center"><?php echo $Products->Trans_PurchaseOrderProduct_Rate; ?></td>
					<td align="center"><?php echo $Products->Trans_PurchaseOrderProduct_Grandtotal; ?></td>
				</tr>	
			<?php } ?>
				<tr>
					<td colspan="5">Payment Terms: <br> 100% Payment Against BI Copy</td>
					<!--td></td>
					<td></td-->
				</tr>				
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3"></td>
					<td align="center"><b>Total</b></td>
					<td align="center"><b><?php echo  $Row->PurchaseOrder_GrandTotalAmount; ?></b></td>
				</tr>
			</tfoot>
			
		</table>
	</div>	
	<div class="row">
		<div class="col-md-6 col-6 col-sm-6 col-xs-6">
			<h4><b>Ship as Specified.</b></h4>
			<p>Send All Correspondence To:
				<br><?php echo  $Row->Firstname ." ". $Row->Lastname; ?>
				<br><b><?php echo $office->office_Name; ?></b>
				<br><b> <?php echo $office->office_address; ?></b>
				 <?php echo $office->City; ?>
				<br><b>Post Box No:  <?php echo $office->office_postcode; ?>,</b>
				<?php echo $office->CountryName; ?>						
			</p>			
		</div>
		<div class="col-md-6 col-6 col-sm-6 col-xs-6">
			
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-6 col-sm-6 col-xs-6"></div>
		<div class="col-md-6 col-6 col-sm-6 col-xs-6">
			<h4 style="border-top: 2px solid #000;">
				<span class="pull-left"><b>Authorized by</b></span>
				<span class="pull-right"><b>Date</b></span>
			</h4>
		</div>
	</div>	
	<div style="border-top: 2px solid #000; margin-top: 10px; ">
		<h4><b><?php echo  $office->office_Name ." ". $office->office_address ." ". $office->City;  ?></b></h4>
	</div>
</div>
			
            <!-- /.invoice -->
			
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <iframe style="width:0px;height:0px;" src="<?php echo site_url('Purchase/PurchaseOrder_preinvoicePrint/?Key=' . $_GET['Key']); ?>" name="frame"></iframe>
<?php
}
?>
<?php include('Includes/Foot.php'); ?>