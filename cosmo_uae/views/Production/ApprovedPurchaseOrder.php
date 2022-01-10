<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<style>

  h1
  {
    color: #fff;
    font-size: 25px;
  }
</style>
<div class="content-wrapper">
  <section class="content-header">
    <!-- <h1>Production Approved View</h1> -->
  </section>
  <section class="content">
  
      
    <?php
    if(!isset($_REQUEST['Key']))
    {
    ?>
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">PurchaseOrder Approved  View</h3>
        <div class="box-tools pull-right">
         
   
        <a href="<?php echo site_url('Production/ApprovedPurchaseOrder'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>
      <div class="box-body">
    <br><br><br>
  <section class="container row">
  <?php
  $dbdata = $this->GM->Office($officetype = "2", $status = "1", $Id = "0");
 
  foreach ($dbdata as $Row) {
         
  ?>
  <a href="<?php echo site_url('Production/ApprovedPurchaseOrder').'/?Key='.base64_encode($Row->office_dbname);?>">
  <div class="col-md-3 card  text-white text-center" style="background-color:<?php echo $Row->office_theme;?>;height:110px;line-height:100px;">
    <div class="card-body" >
<h1 ><?php echo $Row->office_Name;?> <br>
(<?php echo $Row->office_ShortName;?>)
</h1>    

  
    </div>
  </div>
  <div class="col-md-1"></div>
  </a>
<?php 
  }
?>

</section>
  </div>
  </div>
<?php
}
else
{
  $officedbname=base64_decode($_REQUEST['Key']);
  ?>

    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Approved PurchaseOrder View</h3>
        <div class="box-tools pull-right">
        <a href="<?php echo site_url('Production/ApprovedPurchaseOrder'); ?>" class="btn btn-flat bg-grayy" style="background:#f9f9f9;color:#1a2226;"><i class="fa fa-caret-left"></i> Back</a>
        
   
        <a href="<?php echo site_url('Production/ApprovedPurchaseOrder').'?Key='.$_REQUEST['Key']; ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>

      <div class="box-body">
        <table id="Viewtable" class="display nowrap" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>OrderNo</th>
              <th>Order Date</th>    
              <th>Supplier Name</th>              
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $cou = 1;
            foreach ($this->GM->ApprovedPurchaseOrder(1,0,0,2,0,$officedbname) as $Row) {
            ?>
              <tr>
              <td ><b><?php echo $cou; ?></b></td>
                <td ><?php echo $Row->PurchaseOrder_code; ?></td>
                <td ><?php echo $Row->PurchaseOrder_Dateformatted; ?></td>
                
                <td ><?php echo $Row->name; ?></td>
                <td ><?php echo $Row->PurchaseOrder_StatusName; ?></td>
                <td >
                  <a <?php echo "href='" . site_url('Production/ApprovedPurchaseOrderProducts') . "/?Key=".$_REQUEST['Key']."=&id=" . base64_encode($Row->PurchaseOrder_Id) . "'"; ?> ><span class="badge"><i class="fa fa-eye"></i>&nbsp; View</span>
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
      
  <?php
}
?>
  </section>
</div>
<?php include('Includes/Foot.php'); ?>