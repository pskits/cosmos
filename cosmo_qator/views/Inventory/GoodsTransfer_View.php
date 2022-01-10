<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>GoodsTransfer View</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">GoodsTransfer View</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Inventory/GoodsTransfer_View'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>
      <div class="box-body">
        <br>
        <form class="row form-inline">
          <div class="col-md-1"></div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="forminline-label">From : </label>
              <input type="text" class="form-control input-md Date" readonly required name="fromdate" placeholder="Enter Admin fromdate" value="<?php echo $fromdate = (isset($_REQUEST['fromdate'])) ? $_REQUEST['fromdate'] : date('d-m-Y'); ?> ">
              <?php echo form_error('fromdate'); ?>
            </div>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="forminline-label">To : </label>
              <input type="text" class="form-control input-md Date" readonly required name="todate" placeholder="Enter Admin todate" value="<?php echo $todate = (isset($_REQUEST['todate'])) ? $_REQUEST['todate'] : date('d-m-Y'); ?> ">
              <?php echo form_error('todate'); ?>
            </div>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-2">
            <div class="form-group">
              <button type="submit" class="btnbg-black text-white btn-flat" name="Abut" value="Show">
                <i class="fa fa-cloud-download"></i>Show</button>
            </div>
          </div>
        </form>
        <hr class="horizondal-splitter">
        <table id="Viewtable" class="display nowrap" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>GoodsTransferNo</th>
              <th>GoodsTransfer Date</th>
              <th>From Warehouse</th>
              <th>Type</th>
              <th>To Branch</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $cou = 1;
            $from_date = $this->GM->DateSplit($fromdate);
            $to_date = $this->GM->DateSplit($todate);
            foreach ($this->GM->GoodsTransfer($status_Id = "0", $GoodsTransfer_Id = "0", $GoodsTransferType_Id = "0", $fromWarehouse_Id = "0", $tobranch_Id = "0", $from_date, $to_date) as $Row) {
            ?>
              <tr>
                <td><b><?php echo $cou; ?></b></td>
                <td><?php echo $Row->GoodsTransfer_code; ?></td>
                <td><?php echo $Row->FormattedGoodsTransferDate; ?></td>
                <td><?php echo $Row->WarehouseName; ?></td>
                <td><?php echo $Row->GoodsTransferTypeName; ?></td>
                <td><?php echo $Row->office_Name; ?></td>
                <td> <a href="<?php  $GoodsTransfer_Id = base64_encode($Row->GoodsTransfer_Id);
                              echo  site_url("Inventory/GoodsTransfer_Invoice/?Key=$GoodsTransfer_Id"); ?>"><span class="badge"><i class="fa fa-eye"></i>&nbsp; View</span>
                  </a></td>
              </tr>
            <?php
              $cou++;
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
<?php include('Includes/Foot.php'); ?>