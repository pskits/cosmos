<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
$id = $_GET['Key'];

$office = $this->GM->Office($officetype = "0", $status = "1", $Id = "0", $_SESSION['currentdatabasename']);
$office = $office[0];
$id = base64_decode($id);
foreach ($this->GM->Import($status_id = 1, $WarehouseCode = "0", $Supplier_Id = "0", $id) as $Row) {
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info row">
              <h4 class="col-md-4"><b> <?php echo $Row->Import_code; ?></b></h4>
              <div class="col-md-8">
                <a onclick="frames['frame'].print()" style="background-color:#0ea3a9;margin-right:1px;" class="btn btn-flat pull-right"><i class="fa fa-file-pdf-o"></i> PDF</a>
                <a href="<?php echo site_url('Purchase/Import_View'); ?>" style="background-color:#0ea3a9;margin-right:1px;" class="btn btn-flat pull-right"><i class="fa fa-arrow-circle-left"></i> </a>
              </div>
            </div>
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
                  <h2 style="color:#0ea3a9;"><b>Import</b></h2>
                  <h4><b><?php echo $Row->Import_code; ?></b></h4>
                  <b>Order Date:</b> <?php echo $Row->Import_Dateformatted; ?><br>
                </div>
              </div>
              <div class="row invoice-info">
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Import To
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
                        <th>Amount</th>
                        <th>Converted Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $Import_Id = $Row->Import_Id;
                      $count = "0";
                      $status_id = "1";
                      foreach ($this->GM->ImportProduct($status_id, $Import_Id) as $Products) {
                        // print_r($Products);
                        $count++;
                      ?>
                        <tr>
                          <td><?php echo $count; ?></td>
                          <td><?php echo $Products->Product; ?><br>
                            <sub><?php echo $Products->Trans_ImportProduct_Description; ?></sub>
                          </td>
                          <td><?php echo $Products->Trans_ImportProduct_Quantity; ?></td>
                          <td><?php echo $Products->Trans_ImportProduct_Rate; ?></td>
                          <td><?php echo $Products->ImportProduct_BeforeConvertion; ?></td>
                          <td><?php echo $Products->Trans_ImportProduct_Grandtotal; ?></td>
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
               
                <div class="col-md-8">
                  <p class="lead"><?php echo $Row->Import_Description; ?></p>
                </div>
                <div class="col-md-4 ">
                  <div class="table-responsive">
                    <table class="table table-total">
                    <tr>
                        <td>Before Convertion Total:</td>
                        <td><i class="<?php echo $Row->Currencycode; ?>"></i> <?php echo $Row->Import__Subtotal; ?></td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <th style="padding:0px;"><i class="<?php echo $Row->Currencycode; ?>"></i> <?php echo $Row->Import_GrandTotalAmount; ?></th>
                      </tr>
                    </table>
                  </div>
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
    <!-- /.content -->
  </div>
  <iframe style="width:0px;height:0px;" src="<?php echo site_url('Purchase/Import_invoicePrint/?Key=' . $_GET['Key']); ?>" name="frame"></iframe>
<?php
}
?>
<?php include('Includes/Foot.php'); ?>