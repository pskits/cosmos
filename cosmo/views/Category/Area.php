<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Area</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Area Details</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Category/Area_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
        </div>
      </div>
      <div style="color:red">
        <?php if (isset($error)) {
          print $error;
        } ?>
      </div>
      <?php echo form_open_multipart(site_url('Category/Area_') . $But . '/', 'role="form"'); ?>
      <input type="hidden" name="Area_Id" value="<?php echo @$Area_Id; ?>">
      <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Area Name</label>
              <input type="text" class="form-control input-md" minlength="3" required name="AreaName" placeholder="Enter AreaName" value="<?php echo @set_value('AreaName') . @$AreaName; ?>">
              <?php echo form_error('AreaName'); ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Warehouse</label>
              <select id="Warehouse_Id" required class="form-control select2" name="Warehouse_Id">
                <?php
                $data = $this->GM->Warehouse();
                $this->GM->Option_($data, 'Warehouse_Id', 'WarehouseName', '', 'Select', @set_value('Warehouse_Id') . @$Warehouse_Id);
                ?>
              </select>
              <?php echo form_error('Warehouse_Id'); ?>
            </div>
          </div>
		  <div class="col-md-6">
            <div class="form-group">
              <label>Sales Executive </label>
              <select id="SalesExecutive_Id" required class="form-control select2" name="SalesExecutive_Id">
                <?php
                $data = $this->GM->SalesExecutve();
                $this->GM->Option_($data, 'SalesExecutve_Id', 'firstname', '', 'Select', @set_value('SalesExecutive_Id') . @$SalesExecutive_Id);
                ?>
              </select>
              <?php echo form_error('SalesExecutive_Id'); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="box-footer">
        <a href="<?php echo site_url('Category/Area'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
        <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
          <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
      </div>
      </form>
    </div>
  </section>
</div>
<?php include('Includes/Foot.php'); ?>