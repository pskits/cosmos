<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
$office = $this->GM->Office($officetype = "0", $status = "1", $Id = "0", $_SESSION['currentdatabasename']);
$office = $office[0];
$id = $_GET['Key'];
$id = base64_decode($id);
foreach ($this->GM->Orderlist($status_id = 1, $Warehouseid = "0", $Dealer_Id = "0", $salesexecutiveuser_Id = "0", $priority_Id = "0", $Order_status_Id = "0", $id) as $Row) {
  ?>

<style type = "text/css">
 @media print {
	 body {
	 margin-top:0.5px;
	  margin-bottom:0.5px;
 }
 }
</style>
  <!-- Content Header (Page header) -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="callout callout-info row">
            <h4 class="col-md-4"><b> <?php echo $Row->Order_No . '(' . $Row->Order_status_Name . ')'; ?></b></h4>
            <div class="col-md-8">
            </div>
          </div>
          <!-- Main content -->
          <div class="invoice p-3 mb-3">
            <!-- title row -->
       
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-6 invoice-col">
                <img src="<?php echo base_url('assets/Pics/cosmo_pumps.png'); ?>" class="invoice-logo" alt="Cosmo Pumps">
               <address>
                    <strong><?php echo $office->office_Name; ?></strong><br>
                    <?php echo $office->office_address; ?> <?php echo $office->City; ?><br>
					   <?php echo $office->StateName; ?> <?php echo $office->CountryName; ?>
                    TRN: <?php echo $office->office_tax_no; ?><br />
                   
                  </address>
              </div>
              <!-- /.col -->
              <!-- /.col -->
              <div class="col-sm-3 invoice-col pull-right">
                <br /> <br />
                <h2 style="color:#0ea3a9;"><b>Sales Order</b></h2>
                <h4><b><?php echo $Row->Order_No; ?></b></h4><br>
                <br>
                <b>Order Date:</b> <?php echo $Row->FormattedOrderDate; ?><br>
              </div>
            </div>
            <div class="row invoice-info">
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                Bill To
                <address>
                  <strong><?php echo $Row->name; ?></strong><br>
                  <p style="width:70%;margin:0px;">
                    <?php echo $Row->address; ?>
                  </p>
                  Phone:<?php echo $Row->mobile; ?><br>
                   TRN: <?php echo $Row->tax_no; ?><br />
                </address>
              </div>
            </div>
            <!-- /.row -->
            <!-- Table row -->
            <div  class="container">
              <div class=" table-responsive">
                <table  class="table  table-striped printtable" style="display:inline;width:100%;">
                  <thead style="display: table-row-group;">
                    <tr class="table-warning" style="">
                      <th style="width:5%;">S.No</th>
                      <th style="width:45%;">Item</th>
                      <th style="width:10%;">Qty</th>
                      <th style="width:10%;">Rate</th>
                      <th style="width:10%;">Discount</th>
                      <th style="width:10%;">Tax</th>
                      <th style="width:10%;">Amount</th>
                    </tr>
                  </thead>
                  <tbody style="">
                    <?php
                    $Order_Id = $Row->Order_Id;
                    $count = "0";
                    $status_id = "1";
                    foreach ($this->GM->OrderlistProduct($status_id, $Order_Id) as $Products) {
                      $count++;
                    ?>
                      <tr style="">
                        <td style="width:5%;"><?php echo $count; ?></td>
                        <td style="width:45%;"><?php echo $Products->Product; ?><br>
                           <sub>Due Terms: <?php echo ($Products->CreditPeriod>0) ? $Products->CreditPeriod.'Days' : 'Immediate' ; ?> </sub>
                        </td>
                        <td style="width:10%;"><?php echo $Products->OrderProduct_Quantity; ?></td>
                        <td style="width:10%;"><?php echo $Products->OrderProduct_rate; ?></td>
                        <td style="width:10%;"><?php echo $Products->OrderProduct_discount_total; ?></td>
                        <td style="width:10%;"><?php echo $Products->OrderProduct_tax_total; ?></td>
                        <td style="width:10%;"><?php echo $Products->OrderProduct_subtotal; ?></td>
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
              <tfoot style="display: table-row-group;">
                    <tr>
					<td style="border:none;" colspan="5"></td>
                      <td ><b> Subtotal </b></td>
					 
                      <td><i class="<?php echo $office->Currencycode; ?>"></i> <?php echo $Row->Order_subtotal; ?></td>
                    </tr>
					 <tr><td style="border:none;" colspan="5"></td>
                      <td ><b>Discount</b></td>
					  
                      <td><i class="<?php echo $office->Currencycode; ?>"></i> <?php echo $Row->Order_Discounttotal; ?></td>
                    </tr>
                    <tr>
                      
                      <td style="border:none;" colspan="5"></td>
                      <td ><b>Tax Total</b></td>
					 
                      <td> <i class="<?php echo $office->Currencycode; ?>"></i> <?php echo $Row->Order_taxtotal; ?></td>
                    </tr>
                   
                 <tr>
                        <th>Round Off:</th>
                        <td><i class="<?php echo $office->Currencycode; ?>"></i> <?php echo $Row->Order_roundoff; ?></td>
                      </tr>
                    <tr><td  style="border:none;" colspan="5"></td>
                      <td ><b>Total</b></td>
					 
                      <td><i class="<?php echo $office->Currencycode; ?>"></i> <?php echo $Row->Order_total; ?></td>
                    </tr>
					 </tfoot>
                  </table>

              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="container " style="text-align:center;">
              <!-- accepted payments column -->
              <!-- /.col -->
			 
			Thank You for Your Business!
              
              <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- this row will not appear when printing -->
          </div>
          <!-- /.invoice -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
<?php
}
?>
<style>
  @page {
    size: auto;
    margin: 0mm;
  }
  @media print {
    table {
      page-break-inside: avoid;
    }
  }
</style>