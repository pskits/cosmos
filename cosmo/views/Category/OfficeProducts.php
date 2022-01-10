<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Office Product Details</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Category/OfficeProducts_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> view</a>
        </div>
      </div>
      <?php echo form_open_multipart(site_url('Category/OfficeProducts_') . $But . '/', 'role="form"'); ?>
      <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Products</label>
              <select id="Product_id" required class="form-control select2" name="Product_id">
                <?php
                $data = $this->GM->Product($status = "1", "0", "0");
                $this->GM->Option_($data, 'Product_Id', 'Product', '', 'Select', @set_value('Product_id') . @$Product_id);
                ?>
              </select>
              <?php echo form_error('Product_id'); ?>
            </div>
            <div class="form-group">
              <label>Taxes</label>
              <select id="Tax_id" required class="form-control select2" name="Tax_id">
                <?php
                $data = $this->GM->Taxes($status = "1", "0");
                $this->GM->Option_($data, 'Tax_Id', 'Tax', '', 'Select', @set_value('Tax_id') . @$Tax_id);
                ?>
              </select>
              <?php echo form_error('Tax_id'); ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Rate</label>
              <input type="number" class="form-control input-md" value="0.00" step=".01" min="0.00" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required name="Rate" placeholder="Enter Rate" value="<?php echo @set_value('Rate') . @$Rate; ?>">
              <?php echo form_error('Rate'); ?>
            </div>
            <div class="form-group">
              <label>Commission</label>
              <input type="number" class="form-control input-md" value="0.00" step=".01" min="0.00" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required name="Commission" placeholder="Enter Commission" value="<?php echo @set_value('Commission') . @$Commission; ?>">
              <?php echo form_error('Commission'); ?>
            </div>
            <div class="form-group">
              <label>PlumberCommision</label>
              <input type="number" class="form-control input-md" value="0.00" step=".01" min="0.00" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required name="PlumberCommision" placeholder="Enter PlumberCommision" value="<?php echo @set_value('PlumberCommision') . @$PlumberCommision; ?>">
              <?php echo form_error('PlumberCommision'); ?>
            </div>
            <div class="form-group">
              <label>Warrenty Days</label>
              <input type="number" class="form-control input-md" value="0" step="1" min="0" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required name="Warrenty_days" placeholder="Enter Warrenty_days" value="<?php echo @set_value('Warrenty_days') . @$Warrenty_days; ?>">
              <?php echo form_error('Warrenty_days'); ?>
            </div>
          </div>
        </div>
        <div class="box-footer">
          <a href="<?php echo site_url('Category/OfficeProducts'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
          <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
            <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
        </div>
        </form>
      </div>
  </section>
</div>
<?php include('Includes/Foot.php'); ?>