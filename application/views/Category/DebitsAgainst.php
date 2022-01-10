<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Debits Against Creation</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Debits Against Creation Details</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Category/DebitsAgainst_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
        </div>
      </div>
       <?php echo form_open_multipart(site_url('Category/DebitsAgainst_') . $But . '/', 'role="form"'); ?>
      <input type="hidden" name="DebitsAgainst_Id" value="<?php echo @$DebitsAgainst_Id; ?>">
      <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Debits Type </label>
              <select id="Debits_Type_Id"  required class="form-control select2" name="Debits_Type_Id">
                <?php               
                $data = $this->GM->DebitsType('1','0');
                $this->GM->Option_($data, 'Debits_Type_Id', 'Debits_TypeName', '', 'Select', @set_value('Debits_Type_Id') . @$Debits_Type_Id);
                ?>
              </select>
              <?php echo form_error('Debits_Type_Id'); ?>
            </div>
       
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Debits Against</label>
              <input type="text" class="form-control input-md" required name="DebitsAgainst_Name" placeholder="Enter DebitsAgainst_Name" value="<?php echo @set_value('DebitsAgainst_Name') . @$DebitsAgainst_Name; ?>">
              <?php echo form_error('DebitsAgainst_Name'); ?>
            </div>
            <div class="form-group">
              <label>Code</label>
              <input type="text" class="form-control input-md" required name="DebitsAgainst_Code" placeholder="Enter DebitsAgainst_Code" value="<?php echo @set_value('DebitsAgainst_Code') . @$DebitsAgainst_Code; ?>">
              <?php echo form_error('DebitsAgainst_Code'); ?>
            </div>
            </div>

        </div>
      </div>
      <div class="box-footer" >
        <a href="<?php echo site_url('Category/DebitsAgainst'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
        <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
          <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
      </div>
      </form>
    </div>
  </section>
</div>



<?php include('Foot.php'); ?>