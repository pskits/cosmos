<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
if (isset($_GET['Key'])) {
  $ProductCategory_Id = base64_decode($_GET['Key']);
 
}
else
{
  $ProductCategory_Id ="0";
  $_GET['Key'] = base64_encode($ProductCategory_Id);
}
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Office Product</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Office Products View</h3>
        <div class="box-tools pull-right">
        <a href="<?php echo site_url('Category/OfficeProducts'); ?>" class="btn btn-flat bg-grayy" style="background:#f9f9f9;color:#1a2226;"><i class="fa fa-caret-left"></i> Back</a>

            <a href="<?php echo site_url('Category/OfficeProducts_View?Key=' . $_GET['Key'] .''); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>

        </div>
      </div>

      <div class="box-body">
        <table id="Viewtable" class="display nowrap" style="width:100%">
          <thead>
            <tr>
            <th>#</th>
              <th>ProductCategory</th>
              <th>Product</th>
              <th>SKU</th>
              <th>Dimension</th>
              <th>Volume</th>
              <th>Description</th>
              <th>Rate</th>  
              <th>Commission</th>
              <th>PlumberCommision</th>
              <th>Status</th>            
            </tr>
          </thead>
          <tbody>
            <?php
            $cou = 1;
            $status = "0";
            $ProductCategory_id = base64_decode($_GET['Key']);
            $id = "0";
            foreach ($this->GM->OfficeProduct($status, $ProductCategory_id, $id) as $Row) {

            ?>
              <tr>
              <td ><b><?php echo $cou; ?></b></td>
                <td ><?php echo $Row->ProductCategory; ?></td>
                <td ><?php echo $Row->Product; ?></td>
                <td ><?php echo $Row->SKU; ?></td>
                <td ><?php echo $Row->Dimension; ?></td>
                <td ><?php echo $Row->Volume; ?></td>
                <td><?php echo $Row->Description; ?></td>      
                <td><?php echo $Row->Rate; ?></td>      
                <td><?php echo $Row->Commission; ?></td>      
                <td><?php echo $Row->PlumberCommision; ?></td>                
                <td><?php echo $Row->StatusName; ?></td>
              
                    
              
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

