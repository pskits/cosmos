<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Department</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Department Details</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Category/Department_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
        </div>
      </div>
      <div style="color:red">

        <?php if (isset($error)) {
          print $error;
        } ?>
      </div>
      <?php echo form_open_multipart(site_url('Category/Department_') . $But . '/', 'role="form"'); ?>
      <input type="hidden" name="Department_Id" value="<?php echo @$Department_Id; ?>">
      <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Department Name</label>
              <input type="text" class="form-control input-md" minlength="3" required name="Department" placeholder="Enter Department" value="<?php echo @set_value('Department') . @$Department; ?>">
              <?php echo form_error('Department'); ?>
            </div>
          </div>

        </div>
      </div>
      <div class="box-footer" >
        <a href="<?php echo site_url('Category/Department'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
        <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
          <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
      </div>
      </form>
    </div>
  </section>
</div>


<?php include('Includes/Foot.php'); ?>