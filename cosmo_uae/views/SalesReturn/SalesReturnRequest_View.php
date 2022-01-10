<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Sales Request Pending View</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Sales Request View</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('SalesReturn/SalesReturnRequest_View'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>
      <div class="box-body">
        <table id="Viewtable" class="display nowrap" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Sales Request No</th>
              <th>Sales Request Date</th>
              <th>Dealer</th>
			  <th>Area</th>
              <th>Sales Executive</th>             
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $cou = 1;
            foreach ($this->GM->SalesReturnRequestPending($status_id = "1", $SalesreturnRequest_Id = "0", $Dealer_Id = "0", $Salesexecutive_user_Id = "0", $SalesreturnRequestType_Id = "0", $salesReturnDone = "1") as $Row) {
                      ?>
              <tr>
                <td><b><?php echo $cou; ?></b></td>
                <td><?php echo $Row->SalesReturnRequest_No; ?></td>
                <td><?php echo $Row->FormattedSalesReturnRequestDate; ?></td>
                <td><?php echo $Row->name; ?></td>
				<td><?php echo $Row->AreaName; ?></td>
                <td><?php echo $Row->SalesExecutiveEmail; ?></td>              
                <td>
                  <a <?php echo "href='" . site_url('') . "/" . "SalesReturn/SalesReturnRequest_Process/?Key=" . base64_encode($Row->SalesReturnRequest_Id) . "'"; ?>><span class="badge"><i class="fa fa-eye"></i>&nbsp; View</span>
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
<?php include('Includes/Foot.php'); ?>