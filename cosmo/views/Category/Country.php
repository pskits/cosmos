<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Country</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Country Details</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Category/Country_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
        </div>
      </div>
      <div style="color:red">

        <?php if (isset($error)) {
          print $error;
        } ?>
      </div>
      <?php echo form_open_multipart(site_url('Category/Country_') . $But . '/', 'role="form"'); ?>
      <input type="hidden" name="Country_Id" value="<?php echo @$Country_Id; ?>">
      <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Country Name</label>
              <input type="text" class="form-control input-md" minlength="3" required name="CountryName" placeholder="Enter CountryName" value="<?php echo @set_value('CountryName') . @$CountryName; ?>">
              <?php echo form_error('CountryName'); ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Country Telephonic Code</label>
              <div class="mobile-number-box">
                <span class="mobile-code  form-control">+</span>
                <input type="text" class="mobile-input form-control input-md" required minlength="1" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" maxlength="10" name="countrycode" placeholder="Enter countrycode" value="<?php echo @set_value('countrycode') . @$countrycode; ?>">
                <?php echo form_error('countrycode'); ?>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="box-footer" >
        <a href="<?php echo site_url('Category/Country'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
        <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
          <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
      </div>
      </form>
    </div>
  </section>
</div>


<?php include('Includes/Foot.php'); ?>