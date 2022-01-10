<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Warehouse</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Warehouse Details</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Category/Warehouse_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
        </div>
      </div>
      <div style="color:red">
      </div>
      <?php echo form_open_multipart(site_url('Category/Warehouse_') . $But . '/', 'role="form"'); ?>
      <input type="hidden" name="Warehouse_Id" value="<?php echo @$Warehouse_Id; ?>">
      <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Warehouse Name</label>
              <input type="text" class="form-control input-md" minlength="3" required name="WarehouseName" placeholder="Enter WarehouseName" value="<?php echo @set_value('WarehouseName') . @$WarehouseName; ?>">
              <?php echo form_error('WarehouseName'); ?>
            </div>
            <div class="form-group">
              <label>Warehouse Code</label>
              <input type="text" class="form-control input-md" minlength="3" required name="Warehouse_Code" placeholder="Enter Warehouse Code" value="<?php echo @set_value('Warehouse_Code') . @$Warehouse_Code; ?>">
              <?php echo form_error('Warehouse_Code'); ?>
            </div>
            <div class="form-group">
              <label>City</label>
              <input type="text" class="form-control input-md" minlength="3" required name="City" placeholder="Enter City" value="<?php echo @set_value('City') . @$City; ?>">
              <?php echo form_error('City'); ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>State</label>
              <select id="State_Id" required class="form-control select2" name="State_Id">
                <?php
                $data = $this->GM->State();
                $this->GM->Option_($data, 'State_Id', 'StateName', '', 'Select', @set_value('State_Id') . @$State_Id);
                ?>
              </select>
              <?php echo form_error('State_Id'); ?>
            </div>
            <div class="form-group">
              <label>WarehouseIncarge</label>
              <select id="WarehouseIncarge_Id" required class="form-control select2" name="WarehouseIncarge_Id">
                <?php
                $data = $this->GM->WarehouseIncharge($status_id = "1", $id = "0");
                $this->GM->Option_($data, 'WarehouseIncharge_Id', 'email', '', 'Select', @set_value('WarehouseIncarge_Id') . @$WarehouseIncarge_Id);
                ?>
              </select>
              <?php echo form_error('WarehouseIncarge_Id'); ?>
            </div>
            <div class="form-group">
              <label>Country</label>
              <select id="Countryid" required class="form-control select2" name="Country_Id">
                <?php
                $data = $this->GM->Country();
                $this->GM->Option_($data, 'Country_Id', 'CountryName', '', 'Select', @set_value('Country_Id') . @$Country_Id);
                ?>
              </select>
              <?php echo form_error('Country_Id'); ?>
            </div>
            <div class="form-group">
              <label>Geo</label>
              <input type="text" id="geo" onclick="gmap_latlong_modal()" class="form-control input-md" required name="geo" placeholder="Enter geo" value="<?php echo @set_value('geo') . @$geo; ?>">
              <input type="hidden" required name="lat" id="lat">
              <input type="hidden" required name="lng" id="lng">
              <?php echo form_error('geo'); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="box-footer">
        <a href="<?php echo site_url('Category/State'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
        <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
          <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
      </div>
      </form>
    </div>
  </section>
</div>
<?php
include('Foot.php');
include('assets/plugin/gmap_latlong.php');
?>