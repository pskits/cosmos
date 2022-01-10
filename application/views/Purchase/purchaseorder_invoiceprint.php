<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
$office = $this->GM->Office($officetype = "0", $status = "1", $Id = "0", $_SESSION['currentdatabasename']);
$office = $office[0];
$id = $_GET['Key'];
$id = base64_decode($id);
foreach ($this->GM->PurchaseOrder($status_id = 1, $WarehouseCode = "0", $Supplier_Id = "0", $OrderInvoiceStatus_Id = "0", $id) as $Row) {
?>
  <!-- Content Header (Page header) -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="callout callout-info row">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-6 invoice-col">
                  <img src="<?php echo base_url('assets/Pics/cosmo_pumps.png'); ?>" class="invoice-logo" alt="Cosmo Pumps">
                     <address>
                    <strong><?php echo $office->office_Name; ?></strong><br>
                    <?php echo $office->office_address; ?><br>
                    TRN: <?php echo $office->trn_no; ?><br />
                   
                  </address>
                </div>
                <!-- /.col -->
                <!-- /.col -->
                <div class="col-sm-6 invoice-col pull-right">
                  <br /> <br />
                  <h3 style="color:#0ea3a9;"><b>Purchase Order</b></h3>
                  <h4><b><?php echo $Row->PurchaseOrder_code; ?></b></h4>
                  <b>Date:</b> <?php echo $Row->PurchaseOrder_Dateformatted; ?><br>
                </div>
              </div>
              <div class="row invoice-info">
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>PO To:</b>
                 <address>
                    <strong><?php echo $Row->name; ?></strong><br>
                    <p style="width:70%;margin:0px;">
                      <?php echo $Row->Address; ?>,<?php echo $Row->City; ?><br>
					   <?php echo $Row->StateName; ?>,<?php echo $Row->CountryName; ?>
                    </p>
                    Phone:<?php echo $Row->MobileNo; ?><br>
                    TRN:<?php echo $Row->Tax_No; ?>
                  </address>
                </div>
              </div>
              <!-- /.row -->
              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Item & Description</th>
                        <th>Qty</th>
                        <th>Rate</th>
                        <th>Discount</th>
                        <th>Tax</th>
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $PurchaseOrder_Id = $Row->PurchaseOrder_Id;
                      $count = "0";
                      $status_id = "1";
                      foreach ($this->GM->PurchaseOrderProduct($status_id, $PurchaseOrder_Id) as $Products) {
                        $count++;
                      ?>
                     <tr>
                          <td><?php echo $count; ?></td>
                          <td><?php echo $Products->Product; ?><br>
                            <sub><?php echo $Products->Trans_PurchaseOrderProduct_Description; ?></sub>
                          </td>
                          <td><?php echo $Products->Trans_PurchaseOrderProduct_Quantity; ?></td>
                          <td><?php echo $Products->Trans_PurchaseOrderProduct_Rate; ?></td>
                          <td><?php echo number_format((float)$Products->Trans_PurchaseOrderProduct_Discount, 2, '.', '');  ; ?></td>
                          <td><?php echo $Products->Trans_PurchaseOrderProduct_Taxcost; ?></td>
                          <td><?php echo $Products->Trans_PurchaseOrderProduct_Grandtotal ;
						  //($Products->Trans_PurchaseOrderProduct_Quantity * $Products->Trans_PurchaseOrderProduct_Rate); 
						  ?></td>
                        </tr>
                      <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <div class="row">
                <!-- accepted payments column -->
                <!-- /.col -->
                <div class="col-sm-4 pull-right">
                  <div class="table-responsive">
                    <table class="table table-total">
                      <tr>
                        <td style="width:50%">Subtotal</td>
                        <td> <?php echo  $Row->PurchaseOrder__Subtotal; ?></td>
                      </tr>
                      <tr>
                        <td>Tax</td>
                        <td> <?php echo $Row->PurchaseOrder_TotalTaxAmount; ?></td>
                      </tr>
                      <tr>
                        <td>Discount</td>
                        <td> <?php echo  $Row->PurchaseOrder_TotalDiscountAmount; ?></td>
                      </tr>
					   <tr>
                        <td>Fright</td>
                        <td> <?php echo  $Row->fright; ?></td>
                      </tr>
					  <tr>
                        <td>Insurance</td>
                        <td> <?php echo  $Row->insurance; ?></td>
                      </tr>
                      <tr>
                        <th>Total (<?php echo $Row->Currencycode ?>)</th>
                        <th style="padding: 0px;"><?php echo  $Row->PurchaseOrder_GrandTotalAmount; ?></th>
                      </tr>
                    </table>
                  </div>
                </div>
                    <div class="col-sm-6 pull-left">
                  <p  style="font-weight:500;" class="lead">Terms:<br>
				  <span style="font-size:14px;"><?php echo $Row->PurchaseOrder_Description; ?> <br>
				  <?php echo $Row->PurchaseOrder_PaymentTerms; ?></span></p>
                </div>
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
<?php
}
?>