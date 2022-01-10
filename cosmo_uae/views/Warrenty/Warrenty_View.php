<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Warrenty View </h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Warrenty View </h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Warrenty/Warrenty_View'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>
      <div class="box-body">
        <form class="row form-inline">
          <div class="col-md-3">
            <div class="form-group">
              <label>Warehouse</label>
              <select class="form-control select2" required name="Warehouse_Id">
                <?php
                $data = $this->GM->Warehouse();
                $this->GM->Option_($data, 'Warehouse_Id', 'WarehouseName', '0', 'All', $Warehouse_Id = (isset($_REQUEST['Warehouse_Id'])) ? $_REQUEST['Warehouse_Id'] : 0);
                ?>
              </select>
              <?php echo form_error('Warehouse_Id'); ?>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Products</label>
              <select id="Product_id" required class="form-control select2" name="Product_id">
                <?php
                $data = $this->GM->Product($status = "1", "0", "0");
                $this->GM->Option_($data, 'Product_Id', 'Product', '0', 'All', $Product_id = (isset($_REQUEST['Product_id'])) ? $_REQUEST['Product_id'] : 0);
                ?>
              </select>
              <?php echo form_error('Product_id'); ?>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Status</label>
              <select class="form-control select2" required name="WarrentyStatus_Id">
                <?php
                $data = $this->GM->WarrentyStatus();
                $this->GM->Option_($data, 'WarrentyStatus_Id', 'WarrentyStatus_Name', '0', 'All', $WarrentyStatus_Id = (isset($_REQUEST['WarrentyStatus_Id'])) ? $_REQUEST['WarrentyStatus_Id'] : 0);
                ?>
              </select>
              <?php echo form_error('WarrentyStatus_Id'); ?>
            </div>
          </div>
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
              <th>Serial_No</th>
              <th>ProductCategory</th>
              <th>Product</th>
              <th>Warrenty status</th>
              <th>Warehouse</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $cou = 1;
            foreach ($this->GM->Warrenty($Warrenty_Id = "0", $goods_Id = "0", $Category_Id = "0", $Product_id, $Serial_No = "", $GoodsStatus_Id = "0", $Status_Id = "1", $Warehouse_Id, $WarrentyStatus_Id) as $Row) {
            ?>
              <tr>
                <td><b><?php echo $Row->Warrenty_Id; ?></b></td>
                <td><?php echo $Row->Serial_No; ?></td>
                <td><?php echo $Row->ProductCategory; ?></td>
                <td><?php echo $Row->Product; ?></td>
                <td><?php echo $Row->WarrentyStatus_Name; ?></td>
                <td><?php echo $Row->WarehouseName; ?></td>
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