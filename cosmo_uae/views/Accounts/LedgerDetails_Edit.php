<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Ledger Edit</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Ledger Edit Details</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Accounts/LedgerDetails_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
        </div>
      </div>
      <div style="color:red">
      </div>
      <?php echo form_open_multipart(site_url('Accounts/LedgerDetails_Edit_') . $But . '/', 'role="form"'); ?>
      <input type="hidden" name="OfficeLedger_id" value="<?php echo @$OfficeLedger_id; ?>">
     <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Group </label>
              <select id="AccountsGroup_Id"  required class="form-control select2" name="Accountsgroup_Id">
                <?php
                $status = "1";
                $id = "0";
                $data = $this->GM->AccountsGroup($status, $id);
                $this->GM->Option_($data, 'Accountsgroup_Id', 'Accountsgroup_Name', '', 'Select', @set_value('AccountsGroup_Id') . @$AccountsGroup_Id);
                ?>
              </select>
              <?php echo form_error('AccountsGroup_Id'); ?>
            </div>
       
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Group Name</label>
              <input type="text" class="form-control input-md" required name="LedgerType_Name" placeholder="Enter LedgerType_Name" value="<?php echo @set_value('LedgerType_Name') . @$LedgerType_Name; ?>" readonly>
              <?php echo form_error('LedgerType_Name'); ?>
            </div>
            <div class="form-group">
              <label>Ledger Name</label>
              <input type="text" class="form-control input-md" required name="Ledgername" placeholder="Enter Ledger name" value="<?php echo @set_value('Ledgername') . @$Ledgername; ?>" readonly>
              <?php echo form_error('Ledgername'); ?>
            </div>
          </div>

        </div>
      </div>
      <div class="box-footer" >
        <a href="<?php echo site_url('Accounts/LedgerDetails_Edit'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
        <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
          <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
      </div>
      </form>
    </div>
  </section>
</div>



<?php include('Includes/Foot.php'); ?>