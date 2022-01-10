<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Backend Goods Load</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"> Please Cross check the serial in view as it may checked later</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Inventory/Goods_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
        </div>
      </div>
      <?php echo form_open_multipart(site_url('Backend/GoodsSerialsLoad_') . $But . '/', 'role="form"'); ?>
      <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
                            <label>Warehouse</label>
                            <select id="Warehouseid" tabindex="0"  required class="form-control select2" name="Warehouseid">
                                <?php
                                $data = $this->GM->Warehouse();
                                $this->GM->Option_($data, 'Warehouse_Id', 'WarehouseName', '', 'Select', 2);
                                ?>
                            </select>
                            <?php echo form_error('Warehouseid'); ?>
                        </div>
						<div class="form-group">
             <label>Products</label>
              <select id="Product_id" tabindex="1" required class="form-control select2" name="Product_id">
                <?php
                $data = $this->GM->Product($status = "1", "0", "0");
                $this->GM->Option_($data, 'Product_Id', 'Product', '', '',0);
                ?>
              </select>
              <?php echo form_error('Product_id'); ?>
            </div>
           
          </div>
          <div class="col-md-6">
           
            <div class="form-group ">
              <label>Serial umber</label>
              <input type="text" class="form-control input-md" required tabindex="2"  name="Serial_no" placeholder="Enter Serial" value="<?php echo @set_value('Serial_no') . @$Serial_no; ?>">
              <?php echo form_error('Serial_no'); ?>
            </div>
            
          </div>
        </div>
      </div>
      <div class="box-footer">
        <a href="<?php echo site_url('Catalog/CurrentOffers'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
        <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
          <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
      </div>
      </form>
    </div>
  </section>
</div>
<?php include('Includes/Foot.php'); ?>