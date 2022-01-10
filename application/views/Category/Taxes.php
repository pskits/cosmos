<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Taxes</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Taxes Details</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Category/Taxes_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
        </div>
      </div>
      <div style="color:red">


      </div>
      <?php echo form_open_multipart(site_url('Category/Taxes_') . $But . '/', 'role="form"'); ?>
      <input type="hidden" name="Taxes_Id" value="<?php echo @$Taxes_Id; ?>">
      <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Taxes</label>
              <input type="text" class="form-control input-md" minlength="3" required name="Taxes" placeholder="Enter Taxes" value="<?php echo @set_value('Taxes') . @$Taxes; ?>">
              <?php echo form_error('Taxes'); ?>
            </div>
            <div class="form-group">
              <label>Tax Percentage</label>
              <input type="number" class="form-control input-md" step=".01" max="100.00" min="0.00" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required name="TaxPercentage" placeholder="Enter TaxPercentage" value="<?php echo @set_value('TaxPercentage') . @$TaxPercentage; ?>">
              <?php echo form_error('TaxPercentage'); ?>
            </div>
          </div>
     


        </div>
      </div>
      <div class="box-footer" >
        <a href="<?php echo site_url('Category/Taxes'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
        <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
          <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
      </div>
      </form>
    </div>
  </section>
</div>


<?php include('Foot.php'); ?>