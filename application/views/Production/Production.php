<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Production</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Production details</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Production/Production_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
        </div>
      </div>
      <?php echo form_open_multipart(site_url('Production/Production_') . $But . '/', 'role="form"'); ?>
      <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>office</label>
              <select class="form-control select2" required name="office_id">
                <?php
                $data = $this->GM->Office($officetype = "3", $status = "1", $Id = "0");
                $this->GM->Option_($data, 'office_Id', 'office_Name', '', 'Select', @set_value('office_id') . @$office_id);
                ?>
              </select>
              <?php echo form_error('office_id'); ?>
            </div>
            <div class="form-group">
              <label>Batch No</label>
              <input type="text" class="form-control input-md" minlength="3" required name="batchno" placeholder="Enter Production batchno" value="<?php echo @set_value('batchno') . @$batchno; ?>">
              <?php echo form_error('batchno'); ?>
            </div>
            <div class="form-group">
              <label>Production Order Date</label>
              <div class="input-group">
                <input type="text" readonly class="form-control input-sm Date" name="production_date" id="production_date" placeholder="Enter Production Date" value="<?php echo @set_value('production_date') . @$production_date; ?>">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
              </div>
              <?php echo form_error('production_date'); ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Terms</label>
              <input type="text" class="form-control input-md" required name="terms" placeholder="Enter terms" value="<?php echo @set_value('terms') . @$terms; ?>">
              <?php echo form_error('terms'); ?>
            </div>
            <div class="form-group">
              <label>Description</label>
              <input type="text" class="form-control input-md" required name="description" placeholder="Enter Description" value="<?php echo @set_value('description') . @$description; ?>">
              <?php echo form_error('description'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="box-footer" >
      <a href="<?php echo site_url('Production/Production'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
      <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
        <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
    </div>
    </form>
</div>
</section>
</div>
<?php include('Foot.php'); ?>