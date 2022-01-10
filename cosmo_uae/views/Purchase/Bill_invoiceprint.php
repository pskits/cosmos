<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');

$office = $this->GM->Office($officetype = "0", $status = "1", $Id = "0", $_SESSION['currentdatabasename']);
$office = $office[0];
$id = $_GET['Key'];
$id = base64_decode($id);
foreach ($this->GM->Bill($status_id = 1,  $Supplier_Id = "0", $id , $fromdate='',$todate='') as $Row) {
?>
    <!-- Content Header (Page header) -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info row">
              

            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <div class="row invoice-info">
                <div class="col-sm-6 invoice-col">
                  <img src="<?php echo base_url('assets/Pics/cosmo_pumps.png'); ?>" class="invoice-logo" alt="Cosmo Pumps">


                  <address>
                    <strong><?php echo $office->office_Name; ?></strong><br>
                    <?php echo $office->office_address; ?>
                    TRN: <?php echo $office->trn_no; ?><br />
                    Phone: <?php echo $office->office_phone; ?><br />
                  </address>
                </div>
                <!-- /.col -->

                <!-- /.col -->
                <div class="col-sm-3 invoice-col pull-right">
                  <br /> <br />
                  <h2 style="color:#0ea3a9;"><b>Bill</b></h2>
                  <h4><b><?php echo $Row->Bill_code; ?></b></h4>
                  <b>Date:</b> <?php echo $Row->Bill_PurchaseDateformatted; ?><br>
                </div>
              </div>
              <div class="row invoice-info">
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Bill To
                  <address>
                    <strong><?php echo $Row->name; ?></strong><br>
                    <p style="width:70%;margin:0px;">
                      <?php echo $Row->Address; ?>
                    </p>
                    Phone:<?php echo $Row->MobileNo; ?><br>
                    Email:<?php echo $Row->Email; ?>
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
                      $Bill_Id = $Row->Bill_Id;
                      $count = "0";
                      $status_id = "1";
                      foreach ($this->GM->BillProduct($status_id, $Bill_Id) as $Products) {
                        $count++;
                      ?>
                        <tr>
                          <td><?php echo $count; ?></td>
                          <td><?php echo $Products->Trans_BillProduct_Product; ?><br>
                            <sub><?php echo $Products->Trans_BillProduct_Description; ?></sub>
                          </td>
                          <td><?php echo $Products->Trans_BillProduct_Quantity; ?></td>
                          <td><?php echo $Products->Trans_BillProduct_Rate; ?></td>
                          <td><?php echo $Products->Trans_BillProduct_Discount; ?></td>
                          <td><?php echo $Products->Trans_BillProduct_Taxcost; ?></td>
                          <td><?php echo $Products->Trans_BillProduct_Grandtotal; ?></td>
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
                <div class="col-sm-6 pull-right">


                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td><?php echo $Row->Currencycode; ?>   <?php echo $Row->Bill__Subtotal; ?></td>
                      </tr>
                      <tr>
  <tr>
                        <th>Discount:</th>
                        <td><?php echo $Row->Currencycode; ?>   <?php echo $Row->Bill_TotalDiscountAmount; ?></td>
                      </tr>
                        <th>Tax:</th>
                        <td> <?php echo $Row->Currencycode; ?>   <?php echo $Row->Bill_TotalTaxAmount; ?></td>
                      </tr>
                    
					   <tr>
                        <th>Fright:</th>
                        <td> <?php echo  $Row->fright; ?></td>
                      </tr>
					  <tr>
                        <th>Insurance:</tH>
                        <td> <?php echo  $Row->insurance; ?></td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td><?php echo $Row->Currencycode; ?>   <?php echo $Row->Bill_GrandTotalAmount; ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="col-sm-6 pull-left">
                  <p class="lead"><?php echo $Row->Bill_Description; ?></p>
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