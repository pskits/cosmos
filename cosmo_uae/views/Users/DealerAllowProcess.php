<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Dealer</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Allow to Process details</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Users/DealerAllowProcess_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
        </div>
      </div>
      <div class="box-body row">
                                <?php echo form_open_multipart(site_url('Users/AllowtoProcess_Commit')); ?>
                                <input type="hidden" name="allowtoprocesstype_id" value="1">
								  <input type="hidden" name="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>">
								                    <div class="col-md-3 form-group">
                            <label>Process</label>
                            <select id="allowtoprocesstype_id" required class="form-control select2" name="allowtoprocesstype_id">
                                <?php
                                $data = $this->GM->AllowtoprocessType($AllowtoprocessTypeId = "0");
                                $this->GM->Option_($data, 'AllowtoProcessType_Id', 'AllowtoProcess', '', 'Select', @set_value('allowtoprocesstype_id') . @$allowtoprocesstype_id);
                                ?>
                            </select>
                            <?php echo form_error('allowtoprocesstype_id'); ?>
                        </div>
                  <div class="col-md-3 form-group">
                            <label>Dealer</label>
                            <select id="allowtoprocessagainst_id" required class="form-control select2" name="allowtoprocessagainst_id">
                                <?php
                                $data = $this->GM->dealer();
                                $this->GM->Option_($data, 'Dealer_Id', 'name', '', 'Select', @set_value('allowtoprocessagainst_id') . @$allowtoprocessagainst_id);
                                ?>
                            </select>
                            <?php echo form_error('allowtoprocessagainst_id'); ?>
                        </div>

                                <div class="col-md-3 form-group">
                                    <label>From</label>
                                    <input type="text" name="from_date" class="form-control Date" value="<?php echo date('d-m-Y');?>" required>
                                    <input type="text" name="From_time" class="form-control Timepicker" value="<?php echo date('h:i a');?>" required>
                                </div>
                                <div class="col-md-3 form-group">
                                <label>To</label>
                                <input type="text" name="to_date" class="form-control Date" value="<?php echo date('d-m-Y');?>" required>
                                    <input type="text" name="to_time" class="form-control Timepicker" value="<?php echo date('h:i a');?>"  required>
                                              </div>
											  <div class="col-md-3 form-group">
                                <label>Description</label>
                                <input type="text" name="Description" class="form-control" required>
                                              </div>
                                <div class="col-md-2 form-group">
                                    <br>
                                    <input type="submit" class="btn btn-primary btn-flat" value="Save" />
                                </div>
                                </form>
                            </div>
    </div>
   
</div>
</section>
</div>
<?php include('Includes/Foot.php'); ?>
<script>
  
</script>