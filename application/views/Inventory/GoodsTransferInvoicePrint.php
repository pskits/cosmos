<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
$office = $this->GM->Office($officetype = "0", $status = "1", $Id = "0", $_SESSION['currentdatabasename']);
$office = $office[0];
$id = $_GET['Key'];
$id = base64_decode($id);

foreach ($this->GM->GoodsTransfer($status_Id = "0", $id, $GoodsTransferType_Id = "0", $fromWarehouse_Id = "0", $tobranch_Id = "0", $from_date = '', $to_date = '') as $Row) {
?>

  <!-- Content Header (Page header) -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

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
                <h2 style="color:#0ea3a9;"><b>GoodsTransfer Invoice</b></h2>
                <h4><b><?php echo $Row->GoodsTransfer_code; ?></b> </h4><br>
                <br>
                <b>Date:</b> <?php echo $Row->FormattedGoodsTransferDate; ?><br>
              </div>
            </div>
            <div class="row invoice-info">
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                Bill To
                <address>
                  <strong><?php echo $Row->office_Name; ?></strong><br>
                  <p style="width:70%;margin:0px;">
                    <?php echo $Row->office_address; ?>
                  </p>
                  Phone:<?php echo $Row->office_phone; ?>
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
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Rate</th>
                        <th>Discount</th>
                        <th>Tax</th>
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $GoodsTransfer_Id = $Row->GoodsTransfer_Id;
                      $count = "0";
                      $status_id = "1";
                      foreach ($this->GM->GoodsTransferProduct($status_id, $GoodsTransfer_Id) as $Products) {
                        $count++;
                      ?>
                        <tr>
                          <td><?php echo $count; ?></td>
                          <td><?php echo $Products->Product; ?><br>
                          </td>
                          <td><?php echo $Products->Trans_GoodsTransferProduct_Quantity; ?>
                            <br>
                            <sub><?php echo $Products->Serial_No; ?></sub>
                          </td>
                          <td><?php echo $Products->Trans_GoodsTransferProduct_Quantity; ?></td>
                          <td><?php echo $Products->Trans_GoodsTransferProduct_Discount; ?></td>
                          <td><?php echo $Products->Trans_GoodsTransferProduct_Taxcost; ?></td>
                          <td><?php echo $Products->Trans_GoodsTransferProduct_Grandtotal; ?></td>
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
                        <td><i class="<?php echo $office->Currencycode; ?>"></i> <?php echo $Row->GoodsTransfer_subtotal; ?></td>
                      </tr>
                      <tr>
                        <?php
                        $ttl = $Row->GoodsTransfer_subtotal;
                        ?>
                        <th>Tax Total</th>
                        <td> <i class="<?php echo $office->Currencycode; ?>"></i> <?php echo $Row->GoodsTransfer_taxtotal; ?></td>
                      </tr>
                      <tr>
                        <th>Discount:</th>
                        <td><i class="<?php echo $office->Currencycode; ?>"></i> <?php echo $Row->GoodsTransfer_Discounttotal; ?></td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td><i class="<?php echo $office->Currencycode; ?>"></i> <?php echo $Row->GoodsTransfer_total; ?></td>
                      </tr>
                    </table>
                </div>
              </div>
              <div class="col-sm-6 pull-left">
                <p class="lead"><?php echo $Row->GoodsTransfer_reference; ?></p>
                <br>
                <p class="lead"><?php echo $Row->GoodsTransfer_description; ?></p>
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

<?php
}
?><style>
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