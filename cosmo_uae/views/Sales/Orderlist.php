<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Orderlist Entry View</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Orderlist Entry View</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Sales/Orderlist'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>
      <div class="box-body">
      <br>
        <form class="row form-inline">
          <div class="col-md-1"></div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="forminline-label">From : </label>
              <input type="text" class="form-control input-md Date" readonly required name="fromdate" placeholder="Enter  fromdate" value="<?php echo $fromdate = (isset($_REQUEST['fromdate'])) ? $_REQUEST['fromdate'] : date('d-m-Y'); ?> ">
              <?php echo form_error('fromdate'); ?>
            </div>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="forminline-label">To : </label>
              <input type="text" class="form-control input-md Date" readonly required name="todate" placeholder="Enter  todate" value="<?php echo $todate = (isset($_REQUEST['todate'])) ? $_REQUEST['todate'] : date('d-m-Y'); ?> ">
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
              <th>OrderNo</th>
              <th>Order Date</th>
              <th>Priority</th>
              <th>Dealer</th>
              <th>Warehouse</th>
			   <th>Area</th>
              <th>Executive</th>
              <th>Status</th>
             
            </tr>
          </thead>
          <tbody>
            <?php          
            $from_date = $this->GM->DateSplit($fromdate);
            $to_date = $this->GM->DateSplit($todate);
            foreach ($this->GM->Orderlist($status_id = 1, $Warehouseid = "0", $Dealer_Id = "0", $salesexecutiveuser_Id = "0", $priority_Id = "0", $Order_status_Id = "0", $Id = "0", $from_date, $to_date) as $Row) {
            ?>
              <tr>
                <td><a <?php echo "href='" . site_url('') . "/" . "Sales/Orderlist_view/?Key=" . base64_encode($Row->Order_Id) . "'"; ?>><?php echo $Row->Order_No; ?></a></td>
                <td><?php echo $Row->FormattedOrderDate; ?></td>
                <td><?php echo $Row->Order_Priyority_Name; ?></td>
                 <td><a <?php echo "href='" . site_url("Users/Dealeruser_views") . "/?Key=" . base64_encode($Row->Dealer_Id) . "'"; ?>><?php echo $Row->name; ?></a></td>
              
                <td><?php echo $Row->WarehouseName; ?></td>
				    <td><?php echo $Row->AreaName; ?></td>   
                <td><?php echo $Row->salesexecutiveemail; ?></td>
                <td><?php echo $Row->Order_status_Name; ?></td>
               
              </tr>
            <?php             
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
<?php include('Includes/Foot.php'); ?>