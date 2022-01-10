<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>

<div class="content-wrapper">

  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Ticket Details</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Ticketsystem/issuetTicketPendingList'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
        </div>
      </div>
      <div style="color:red">


      </div>
      <?php echo form_open_multipart(site_url('Ticketsystem/CreateTicket_Save'), 'role="form"'); ?>
      <input type="hidden" name="TicketSystem_Id" value="<?php echo @$TicketSystem_Id; ?>">
      <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
	   <input type="hidden" name="office_dbname" id="office_dbname" value="<?php echo $_SESSION['currentdatabasename'] ?>" />
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
		  <div class="form-group">
              <label>Module</label>
              <select  class="form-control select2" required id="module_Id" name="module_id">
                <?php
                $data = $this->GM->SupportModule($Module_Id = "0");
                $this->GM->Option_($data, 'module_Id', 'module_Name', '', 'Select', @set_value('module_id') . @$module_id);
                ?>
              </select>
              <?php echo form_error('module_id'); ?>
            </div>
            
            <div class="form-group">
              <label>Issue</label>
              <textarea type="text" class="form-control input-md" required rows="10" name="issueticket" > <?php echo @set_value('issueticket') . @$issueticket; ?></textarea>
              <?php echo form_error('issueticket'); ?>
            </div>
         
          </div>
     


        </div>
      </div>
      <div class="box-footer" >
        <a href="<?php echo site_url('Ticketsystem/DefaultEntry'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
        <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
          <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
      </div>
      </form>
    </div>
  </section>
</div>


<?php include('Foot.php'); ?>