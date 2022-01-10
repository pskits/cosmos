<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
$office = $this->GM->Office($officetype = "0", $status = "1", $Id = "0", $_SESSION['currentdatabasename']);
$office = $office[0];
$id = $_GET['Key'];
$id = base64_decode($id);
foreach ($this->GM->GoodsTransfer($status_Id = "0", $id, $GoodsTransferType_Id = "0", $fromWarehouse_Id = "0", $tobranch_Id = "0", $from_date = '', $to_date = '') as $Row) {
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info row">
              <h4 class="col-md-4"><b> <?php echo $Row->GoodsTransfer_code . '(' . $Row->GoodsTransferTypeName . ')'; ?></b></h4>
              <div class="col-md-8">
                <a onclick="frames['frame'].print()" style="background-color:#0ea3a9;margin-right:1px;" class="btn btn-flat pull-right"><i class="fa fa-file-pdf-o"></i> PDF</a>
                <a href="<?php echo site_url('Inventory/GoodsTransfer_View'); ?>" style="background-color:#0ea3a9;margin-right:1px;" class="btn btn-flat pull-right"><i class="fa fa-arrow-circle-left"></i> </a>
              </div>
            </div>
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
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $GoodsTransfer_Id = $Row->GoodsTransfer_Id;
                      $count = "0";
                      $status_id = "1";
                      foreach ($this->GM->GoodsTransferGoods($status_id, $GoodsTransfer_Id) as $Products) {
                        $count++;
                      ?>
                        <tr>
                          <td><?php echo $count; ?></td>
                          <td><?php echo $Products->Product; ?><br>
                          </td>
                          <td><?php echo $Products->Trans_GoodsTransferProduct_Quantity; ?>
                            <br>
                            <?php if ($Products->Serial_No) { ?>
                              <sub><?php echo $Products->Serial_No; ?></sub>
                            <?php } else { ?>
                              <a href="<?php
                                        $GoodsTransfer_Id = base64_encode($Row->GoodsTransfer_Id);
                                        $Product_Id = base64_encode($Products->Product_Id);
                                        echo  site_url("Inventory/GoodsTransfer_addGoods/?Key=$GoodsTransfer_Id&Key2=$Product_Id"); ?>"><span class="badge"><i class="fa fa-Plus"></i>Add Serial No</span>
                              </a><?php
                                }
                                  ?>
                          </td>
                          <td><?php echo $Products->Trans_GoodsTransferProduct_Quantity; ?></td>
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
                <div class="col-sm-12 pull-left">
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
  </div>
  <iframe style="width:0px;height:0px;" src="<?php echo site_url('Inventory/GoodsTransferInvoicePrint/?Key=' . $_GET['Key']); ?>" name="frame"></iframe>
<?php
}
?>
<?php include('Foot.php'); ?>