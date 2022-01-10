<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Import Entry View</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Import Entry View</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Purchase/Import_View'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>

      <div class="box-body">
      <br>
        <form class="row form-inline">
        <div class="col-md-1"></div>
      <div class="col-md-3">
            <div class="form-group">
              <label class="forminline-label">From : </label>
              <input type="text" class="form-control input-md Date" readonly required name="fromdate" placeholder="Enter Admin fromdate" value="<?php echo $fromdate=(isset($_REQUEST['fromdate'])) ? $_REQUEST['fromdate'] : date('d-m-Y'); ?> ">
              <?php echo form_error('fromdate'); ?>
            </div>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="forminline-label">To : </label>
              <input type="text" class="form-control input-md Date" readonly required name="todate" placeholder="Enter Admin todate" value="<?php echo $todate=(isset($_REQUEST['todate'])) ? $_REQUEST['todate'] : date('d-m-Y'); ?> ">
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
              <th>OrderNo</th>
              <th>Order Date</th>
    
              <th>Supplier Name</th>
             
              <th>Currency</th>
              <th>Warehouse</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $cou = 1;
            $from_date=$this->GM->DateSplit($fromdate);            
            $to_date=$this->GM->DateSplit($todate);

            foreach ($this->GM->Import($status_id = "1", $WarehouseCode = "0", $Supplier_Id = "0", $Id = "0",$from_date,$to_date) as $Row) {
            ?>
              <tr>
                <td ><b><?php echo $cou; ?></b></td>
                <td ><?php echo $Row->Import_code; ?></td>
                <td ><?php echo $Row->Import_Dateformatted; ?></td>               
                <td ><?php echo $Row->name; ?></td>
                <td ><?php echo $Row->Currencycode; ?></td>
                <td ><?php echo $Row->WarehouseName; ?></td>
                <td >
                  <a <?php echo "href='" . site_url('') . "/" . "Purchase/Import_invoice/?Key=" . base64_encode($Row->Import_Id) . "'"; ?> ><span class="badge"><i class="fa fa-eye"></i>&nbsp; View</span>
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