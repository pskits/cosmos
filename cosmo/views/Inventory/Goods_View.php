<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Goods View </h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Goods View </h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Inventory/Goods_View'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>
      <div class="box-body">
        <form class="row form-inline">
          <div class="col-md-2">
            <div class="form-group">
              <label>Warehouse</label><br>
              <select class="form-control select2" required name="Warehouse_Id">
                <?php
                $data = $this->GM->Warehouse();
                $this->GM->Option_($data, 'Warehouse_Id', 'WarehouseName', '0', 'All', $Warehouse_Id = (isset($_REQUEST['Warehouse_Id'])) ? $_REQUEST['Warehouse_Id'] : 0);
                ?>
              </select>
              <?php echo form_error('Warehouse_Id'); ?>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label>Products</label><br>
              <select id="Product_id" required class="form-control select2" name="Product_id">
                <?php
                $data = $this->GM->Product();
                $this->GM->Option_($data, 'Product_Id', 'Product', '', '',$Product_id= @$_REQUEST['Product_id']);
                ?>
              </select>
              <?php echo form_error('Product_id'); ?>
            </div>
          </div>
		   <div class="col-md-2">
               <div class="form-group">
                            <label>Serial No</label> <br>
                            <input type="text" id="serial_no" class="form-control input-md"  name="serial_no" placeholder="Enter Serial Number" value="<?php echo $serial_no= @$_REQUEST['serial_no']; ?>">
                            <?php echo form_error('serial_no'); ?>
                        </div>
          </div>
          <div class="col-md-2">
          <div class="form-group">
            <label>Goods Status</label><br>
            <select class="form-control select2" required name="GoodsStatus_Id">
              <?php
              $data = $this->GM->Get_Goodsstatus();
              $this->GM->Option_($data, 'Goods_status_Id', 'Goods_status_Name', '0', 'All', $GoodsStatus_Id = (isset($_REQUEST['GoodsStatus_Id'])) ? $_REQUEST['GoodsStatus_Id'] : 0);
              ?>
            </select>
            <?php echo form_error('GoodsStatus_Id'); ?>
          </div>
          </div>
          <div class="col-md-2">
		  <br>
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
              <th>Goods status</th>
              <th>Goods Type</th>
              <th>Warehouse</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if(isset($_REQUEST['Abut']))
            {
            $cou = 1;
            foreach ($this->GM->Goods($Goods_Id = "0", $Category_Id = "0", $Product_id, $serial_no, $GoodsStatus_Id, $status_Id = "1", $Warehouse_Id) as $Row) {
            ?>
              <tr>
                <td><b><?php echo $Row->Goods_Id; ?></b></td>
                <td><?php echo $Row->Serial_No; ?></td>
                <td><?php echo $Row->ProductCategory; ?></td>
                <td><?php echo $Row->Product; ?></td>
                <td><?php echo $Row->Goods_status_Name; ?></td>
                <td><?php echo $Row->GoodsType_StatusName; ?></td>
                <td><?php echo $Row->WarehouseName; ?></td>
              </tr>
            <?php
              $cou++;
            }
          }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
<?php include('Includes/Foot.php'); ?>