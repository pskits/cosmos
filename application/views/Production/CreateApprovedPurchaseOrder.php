<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>PurchaseOrder</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">PurchaseOrder details</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Production/ApprovedPurchaseOrder'); ?>" class="btn btn-flat"><i class="fa fa-caret-left"></i> Back</a>
        </div>
      </div>
      <?php echo form_open_multipart(site_url('Production/ApprovedPurchaseOrder_') . $But . '/', 'role="form"'); ?>
      <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
     <input type="hidden" name="PurchaseOrder_Id" id="PurchaseOrder_Id" value="<?php echo $PurchaseOrder_Id; ?>" />
     <input type="hidden" name="officedbname" id="officedbname" value="<?php echo @set_value('officedbname') . @$officedbname; ?>" />

     <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>PurchaseOrder</label>
              <input type="text" class="form-control input-md" readonly minlength="3" required name="PurchaseOrder_code" placeholder="Enter PurchaseOrder " value="<?php echo @set_value('PurchaseOrder_code') . @$PurchaseOrder_code; ?>">
            
              <?php echo form_error('PurchaseOrder_code'); ?>
            </div>
			</div>
			<div  class="col-md-6">
            <div class="form-group">
              <label>PurchaseOrder Date</label>
              <input type="text" class="form-control input-md" readonly minlength="3" required name="PurchaseOrder_Date" placeholder="Enter PurchaseOrder PurchaseOrder_Date" value="<?php echo @set_value('PurchaseOrder_Date') . @$PurchaseOrder_Date; ?>">
              <?php echo form_error('PurchaseOrder_Date'); ?>
            </div>

          </div>
          <div style="display:none;" class="col-md-6">
            <div class="form-group">
              <label>PurchaseOrder_ExpectedDate</label>
              <input type="text" class="form-control input-md" required name="PurchaseOrder_ExpectedDate" placeholder="Enter PurchaseOrder_ExpectedDate" readonly value="<?php echo @set_value('PurchaseOrder_ExpectedDate') . @$PurchaseOrder_ExpectedDate; ?>">
              <?php echo form_error('PurchaseOrder_ExpectedDate'); ?>
            </div>
            <div class="form-group">
              <label>WarehouseName</label>
              <input type="text" class="form-control input-md" required name="WarehouseName" placeholder="Enter WarehouseName" readonly value="<?php echo @set_value('WarehouseName') . @$WarehouseName; ?>">
              <?php echo form_error('WarehouseName'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="box-footer" >
       <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
        <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
    </div>
    </form>
</div>
</section>
</div>
<?php include('Foot.php'); ?>