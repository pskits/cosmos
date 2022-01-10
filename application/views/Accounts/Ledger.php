<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Ledger Creation</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Ledger Creation Details</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Accounts/Ledger_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
        </div>
      </div>
      <div style="color:red">
      </div>
      <?php echo form_open_multipart(site_url('Accounts/Ledger_Save'), 'role="form"'); ?>
      <input type="hidden" name="Group_Id" value="<?php echo @$Group_Id; ?>">
      <input type="hidden" name="Ledgertype_Id" value="14">   
 <input type="hidden" name="Ledger_Id" value="<?php echo @set_value('Ledger_Id') . @$Ledger_Id; ?>">  	  
      <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Group </label>
              <select id="Accountsgroup_Id"  required class="form-control select2" name="Accountsgroup_Id">
                <?php
                $status = "1";
                $id = "0";
                $data = $this->GM->AccountsGroup($status, $id);
                $this->GM->Option_($data, 'Accountsgroup_Id', 'Accountsgroup_Name', '', 'Select', @set_value('Accountsgroup_Id') . @$Accountsgroup_Id);
                ?>
              </select>
              <?php echo form_error('Accountsgroup_Id'); ?>
            </div>
       
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control input-md" required name="Ledger_Name" placeholder="Enter Ledger_Name" value="<?php echo @set_value('Ledger_Name') . @$Ledger_Name; ?>">
              <?php echo form_error('Ledger_Name'); ?>
            </div>
            <div class="form-group">
              <label>Code</label>
              <input type="text" class="form-control input-md" required name="Ledger_Code" placeholder="Enter Ledger_Code" value="<?php echo @set_value('Ledger_Code') . @$Ledger_Code; ?>">
              <?php echo form_error('Ledger_Code'); ?>
            </div>
			  <div class="form-group">
              <label>Status</label>
              <select class="form-control select2" required name="Status_Id">
                <?php
                $data = $this->GM->Status();
                $this->GM->Option_($data, 'Status_Id', 'StatusName', '', 'Select', @set_value('Status_Id') . @$Status_Id);
                ?>
              </select>
              <?php echo form_error('Status_Id'); ?>
            </div>
            </div>

        </div>
      </div>
      <div class="box-footer" >
        <a href="<?php echo site_url('Accounts/Ledger'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
        <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
          <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
      </div>
      </form>
    </div>
  </section>
</div>



<?php include('Foot.php'); ?>