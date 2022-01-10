<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Currency</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Currency Details</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Category/Currency_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
        </div>
      </div>
      <div style="color:red">

        <?php if (isset($error)) {
          print $error;
        } ?>
      </div>
      <?php echo form_open_multipart(site_url('Category/Currency_') . $But . '/', 'role="form"'); ?>
      <input type="hidden" name="Currency_Id" value="<?php echo @$Currency_Id; ?>">
      <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Currency Name</label>
              <input type="text" class="form-control input-md" minlength="3" required name="CurrencyName" placeholder="Enter CurrencyName" value="<?php echo @set_value('CurrencyName') . @$CurrencyName; ?>">
              <?php echo form_error('CurrencyName'); ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Currency Code</label>
              <div class="mobile-number-box">
                <input type="text" class="form-control input-md" required minlength="1" name="Currencycode" placeholder="Enter Currencycode" value="<?php echo @set_value('Currencycode') . @$Currencycode; ?>">
                <?php echo form_error('Currencycode'); ?>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="box-footer" >
        <a href="<?php echo site_url('Category/Currency'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
        <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
          <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
      </div>
      </form>
    </div>
  </section>
</div>


<?php include('Foot.php'); ?>