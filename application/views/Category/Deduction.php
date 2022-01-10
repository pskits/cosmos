<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Deduction</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Deduction Details</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Category/Deduction_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
        </div>
      </div>
      <div style="color:red">
        <?php if (isset($error)) {
          print $error;
        } ?>
      </div>
      <?php echo form_open_multipart(site_url('Category/Deduction_') . $But . '/', 'role="form"'); ?>
      <input type="hidden" name="Deduction_Id" value="<?php echo @$Deduction_Id; ?>">
      <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Deduction Name</label>
              <input type="text" class="form-control input-md" minlength="1" required name="Deduction_name" placeholder="Enter Deduction_name" value="<?php echo @set_value('Deduction_name') . @$Deduction_name; ?>">
              <?php echo form_error('Deduction_name'); ?>
            </div>
            <div class="form-group">
              <label>Deduction</label>
              <input type="number" class="form-control input-md" min="0.00" step="0.01" required name="Deduction" placeholder="Enter Deduction" value="<?php echo @set_value('Deduction') . @$Deduction; ?>">
              <?php echo form_error('Deduction'); ?>
            </div>
            <div class="form-group">
              <label>Type</label>
              <select id="DiscountType_Id" class="form-control select2 " required name="DiscountType_Id">
                <?php $data = $this->GM->Discounttype($id = "0");
                $this->GM->Option_($data, 'DiscountType_Id', 'DiscountTypeName', '', 'Select', @set_value('DiscountType_Id') . @$DiscountType_Id); ?>
              </select>
              <?php echo form_error('DiscountType_Id'); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="box-footer">
        <a href="<?php echo site_url('Category/Deduction'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
        <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
          <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
      </div>
      </form>
    </div>
  </section>
</div>
<?php include('Foot.php'); ?>