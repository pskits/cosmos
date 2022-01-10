<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>
<style>
  h1 {
    color: #fff;
    font-size: 25px;
  }
</style>
<div class="content-wrapper">
  <section class="content-header">
    <!-- <h1>Production Approved View</h1> -->
  </section>
  <section class="content">

    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Exported PurchaseOrder View</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Production/exportedPurchaseOrder'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>
      <div class="box-body">
        <table id="Viewtable" class="display nowrap" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Export No</th>
              <th>Exported Date</th>
              <th>Branch</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $cou = 1;
            foreach ($this->GM->factoryApprovedPurchaseOrder($status_id = "1", $PurchaseOrder_Id = "0", $Purchaseorderoffice_Id = 0, $ID = "0", $from_date = "", $to_date = "") as $Row) {
            ?>
              <tr>
                <td><b><?php echo $cou; ?></b></td>
                <td><?php echo $Row->ApprovedPurchaseOrder_Code; ?></td>
                <td><?php echo $Row->ApprovedPurchaseOrder_date; ?></td>

                <td><?php echo $Row->office_Name; ?></td>
                <td>
                  <a <?php echo "href='" . site_url('Production/ApprovedPurchaseOrderProducts') . "/?Key=" . base64_encode($Row->office_dbname) . "=&id=" . base64_encode($Row->PurchaseOrder_Id) . "'"; ?>><span class="badge"><i class="fa fa-eye"></i>&nbsp; View</span>
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