<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Bank</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Bank Details</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Category/Bank_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
        </div>
      </div>
       <?php echo form_open_multipart(site_url('Category/Bank_') . $But . '/', 'role="form"'); ?>
      <input type="hidden" name="Bank_Id" value="<?php echo @$Bank_Id; ?>">
      <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Bank Name</label>
              <input type="text" class="form-control input-md" minlength="3" required name="BankName" placeholder="Enter BankName" value="<?php echo @set_value('BankName') . @$BankName; ?>">
              <?php echo form_error('BankName'); ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Bank Code</label>
              <div class="mobile-number-box">
                <input type="text" class="form-control input-md" required minlength="1" name="Bankcode" placeholder="Enter Bankcode" value="<?php echo @set_value('Bankcode') . @$Bankcode; ?>">
                <?php echo form_error('Bankcode'); ?>
              </div>
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
          </div>
        </div>
      </div>
      <div class="box-footer">
        <a href="<?php echo site_url('Category/Bank'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
        <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
          <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
      </div>
      </form>
    </div>
  </section>
</div>
<?php include('Foot.php'); ?>