<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Trip Orderlist View</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Orderlist  View</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Sales/Orderlist_ReadyforTrip'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>
      <div class="box-body">
       <hr class="horizondal-splitter">
        <table id="Viewtable" class="display nowrap" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>OrderNo</th>
              <th>Order Date</th>
              <th>Priority</th>
              <th>Dealer</th>           
			  <th>Area</th>
              <th>Executive</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $cou = 1;
            foreach ($this->GM->Orderlist($status_id = 1, $Warehouseid = "0", $Dealer_Id = "0", $salesexecutiveuser_Id = "0", $priority_Id = "0", $Order_status_Id = "3", $Id = "0", $from_date='', $to_date='') as $Row) {
            ?>
              <tr>
                <td><b><?php echo $cou; ?></b></td>
                <td><?php echo $Row->Order_No; ?></td>
                <td><?php echo $Row->FormattedOrderDate; ?></td>
                <td><?php echo $Row->Order_Priyority_Name; ?></td>
                <td><?php echo $Row->name; ?></td>
				  <td><?php echo $Row->AreaName; ?></td>
                <td><?php echo $Row->salesexecutivename; ?></td>
                <td><?php echo $Row->Order_status_Name; ?></td>
                <td>
                  <a <?php echo "href='" . site_url('') . "/" . "Sales/Orderlist_viewReadyfortrip/?Key=" . base64_encode($Row->Order_Id) . "'"; ?>><span class="badge"><i class="fa fa-eye"></i>&nbsp; View</span>
                  </a>
                </td>
              </tr>
            <?php
              $cou++;
            }
                  foreach ($this->GM->Orderlist($status_id = 1, $Warehouseid = "0", $Dealer_Id = "0", $salesexecutiveuser_Id = "0", $priority_Id = "0", $Order_status_Id = "1", $Id = "0", $from_date='', $to_date='') as $Row) {
            ?>
              <tr>
                <td><b><?php echo $cou; ?></b></td>
                <td><?php echo $Row->Order_No; ?></td>
                <td><?php echo $Row->FormattedOrderDate; ?></td>
                <td><?php echo $Row->Order_Priyority_Name; ?></td>
                <td><?php echo $Row->name; ?></td>
                <td><?php echo $Row->AreaName; ?></td>
                <td><?php echo $Row->salesexecutiveemail; ?></td>
                <td><?php echo $Row->Order_status_Name; ?></td>
                <td>
                  <a <?php echo "href='" . site_url('') . "/" . "Sales/Orderlist_viewReadyfortrip/?Key=" . base64_encode($Row->Order_Id) . "'"; ?>><span class="badge"><i class="fa fa-eye"></i>&nbsp; View</span>
                  </a>
                </td>
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
<?php include('Foot.php'); ?>