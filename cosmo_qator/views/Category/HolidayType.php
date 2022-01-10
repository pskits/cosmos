<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>payhead</h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">HolidayType Details</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Category/HolidayType_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
                </div>
            </div>
            <?php echo form_open_multipart(site_url('Category/HolidayType_') . $But . '/', 'role="form"'); ?>
            <input type="hidden" name="HolidayType_Id" value="<?php echo @$HolidayType_Id; ?>">
            <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Holiday Type </label>
                            <input type="text" class="form-control input-md" name="HolidayType" id="HolidayType" placeholder="Enter HolidayType" value="<?php echo @set_value('HolidayType') . @$HolidayType; ?>">
                            <?php echo form_error('HolidayType'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Decription </label>
                            <input type="text" class="form-control input-md" name="decription" id="decription" placeholder="Enter decription" value="<?php echo @set_value('decription') . @$decription; ?>">
                            <?php echo form_error('decription'); ?>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="<?php echo site_url('Category/HolidayType'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
                    <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
                        <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
                </div>
                </form>
            </div>
    </section>
</div>
<?php include('Includes/Foot.php'); ?>