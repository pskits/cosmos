<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Group Creation</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Group Creation Details</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Accounts/Group_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
        </div>
      </div>
      <div style="color:red">
      </div>
      <?php echo form_open_multipart(site_url('Accounts/Group_') . $But . '/', 'role="form"'); ?>
      <input type="hidden" name="Group_Id" value="<?php echo @$Group_Id; ?>">
      <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Group </label>
              <select id="Accountsgroup_ParentId"  required class="form-control select2" name="Accountsgroup_ParentId">
                <?php
                $status = "1";
                $id = "0";
                $data = $this->GM->AccountsGroup($status, $id);
                $this->GM->Option_($data, 'Accountsgroup_Id', 'Accountsgroup_Name', '', 'Select', @set_value('Accountsgroup_ParentId') . @$Accountsgroup_ParentId);
                ?>
              </select>
              <?php echo form_error('Accountsgroup_ParentId'); ?>
            </div>
       
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control input-md" required name="Accountsgroup_Name" placeholder="Enter Accountsgroup_Name" value="<?php echo @set_value('Accountsgroup_Name') . @$Accountsgroup_Name; ?>">
              <?php echo form_error('Accountsgroup_Name'); ?>
            </div>
            <div class="form-group">
              <label>Desc</label>
              <input type="text" class="form-control input-md" required name="Accountsgroup_Desc" placeholder="Enter Accountsgroup_Desc" value="<?php echo @set_value('Accountsgroup_Desc') . @$Accountsgroup_Desc; ?>">
              <?php echo form_error('Accountsgroup_Desc'); ?>
            </div>
            <div class="form-group">
              <label>SORT</label>
              <input type="number" class="form-control input-md" step="01" min="01" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required name="Accountsgroup_Sort" placeholder="Enter Accountsgroup_Sort" value="<?php echo @set_value('Accountsgroup_Sort') . @$Accountsgroup_Sort; ?>">
              <?php echo form_error('Accountsgroup_Sort'); ?>
            </div>


          </div>

        </div>
      </div>
      <div class="box-footer" >
        <a href="<?php echo site_url('Accounts/Group'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
        <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
          <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
      </div>
      </form>
    </div>
  </section>
</div>



<?php include('Includes/Foot.php'); ?>