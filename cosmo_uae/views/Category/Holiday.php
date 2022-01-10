<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Holiday</h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Holiday Details</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Category/Holiday_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
                </div>
            </div>
            <?php echo form_open_multipart(site_url('Category/Holiday_') . $But . '/', 'role="form"'); ?>
            <input type="hidden" name="Holiday_Id" value="<?php echo @$Holiday_Id; ?>">
            <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Holiday </label>
                            <input type="text" class="form-control input-md" name="Holiday" id="Holiday" placeholder="Enter Holiday" value="<?php echo @set_value('Holiday') . @$Holiday; ?>">
                            <?php echo form_error('Holiday'); ?>
                        </div>
                        <div class="form-group">
                            <label>Holiday Type </label>
                            <select id="HolidayType_Id" required class="form-control select2" name="HolidayType_Id">
                                <?php
                                $data = $this->GM->HolidayType(0, 1);
                                $this->GM->Option_($data, 'HolidayType_Id', 'HolidayType', '', 'Select', @set_value('HolidayType_Id') . @$HolidayType_Id);
                                ?>
                            </select>
                            <?php echo form_error('HolidayType_Id'); ?>
                        </div>
                        <div class="form-group">
                            <label>Start Date </label>
                            <input type="text" class="form-control input-md Date" readonly name="Start_datetime" id="Start_datetime" placeholder="Enter Start Date" value="<?php echo @set_value('Start_datetime') . @$Start_datetime; ?>">
                            <?php echo form_error('Start_datetime'); ?>
                        </div>
                        <div class="form-group">
                            <label>End Date </label>
                            <input type="text" class="form-control input-md Date" readonly name="End_datetime" id="End_datetime" placeholder="Enter End Date" value="<?php echo @set_value('End_datetime') . @$End_datetime; ?>">
                            <?php echo form_error('End_datetime'); ?>
                        </div>
                        <div class="form-group">
                            <label>Decription </label>
                            <input type="text" class="form-control input-md " name="decription" id="decription" placeholder="Enter Decription" value="<?php echo @set_value('decription') . @$decription; ?>">
                            <?php echo form_error('decription'); ?>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="<?php echo site_url('Category/Holiday'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
                    <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
                        <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
                </div>
                </form>
            </div>
    </section>
</div>
<?php include('Includes/Foot.php'); ?>