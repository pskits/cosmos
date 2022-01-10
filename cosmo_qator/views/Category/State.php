<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>State</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">State Details</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Category/State_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
        </div>
      </div>
      <div style="color:red">

        <?php if (isset($error)) {
          print $error;
        } ?>
      </div>
      <?php echo form_open_multipart(site_url('Category/State_') . $But . '/', 'role="form"'); ?>
      <input type="hidden" name="State_Id" value="<?php echo @$State_Id; ?>">
      <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>State Name</label>
              <input type="text" class="form-control input-md" minlength="3" required name="StateName" placeholder="Enter StateName" value="<?php echo @set_value('StateName') . @$StateName; ?>">
              <?php echo form_error('StateName'); ?>
            </div>
          </div>
          <div class="col-md-6">
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
          </div>
        </div>
      </div>
      <div class="box-footer" >
        <a href="<?php echo site_url('Category/State'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
        <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
          <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
      </div>
      </form>
    </div>
  </section>
</div>


<?php include('Includes/Foot.php'); ?>