<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Attendance Details Edit</h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Enter Details</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Users/Attendance') . "/?Key=" . base64_encode($_POST['User_Id']) . "&ur=" . base64_encode($_POST['UserRole_Id']); ?>" class="btn btn-flat"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
            </div>
            <?php echo form_open_multipart(site_url('Users/Attendance_Save') . '/', 'role="form"'); ?>
            <input type="hidden" name="loginUser_Id" id="loginUser_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
            <input type="hidden" name="AttendanceTime_Id" id="AttendanceTime_Id" value="<?php echo  @set_value('AttendanceTime_Id') . @$AttendanceTime_Id; ?>" />
            <input type="hidden" name="from_datetime" id="from_datetime" value="<?php echo  @set_value('from_datetime') . @$from_datetime; ?>" />
            <input type="hidden" name="from_location" id="from_location" value="<?php echo  @set_value('from_location') . @$from_location; ?>" />
            <input type="hidden" name="to_datetime" id="to_datetime" value="<?php echo  @set_value('to_datetime') . @$to_datetime; ?>" />
            <input type="hidden" name="to_location" id="to_location" value="<?php echo  @set_value('to_location') . @$to_location; ?>" />
            <input type="hidden" name="Attendance_Id" id="Attendance_Id" value="<?php echo  @set_value('Attendance_Id') . @$Attendance_Id; ?>" />
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <table>
                            <tr>
                                <td>From :
                                    <?php echo $this->GM->DateTimeSplitshow($_POST['from_datetime']); ?></td>
                            </tr>
                            <tr>
                                <td>Location : <?php echo $_POST['from_lat'].','.$_POST['from_lng']; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table>
                            <tr>
                                <td>To :
                                    <?php if($_POST['to_datetime']!='Nill'){echo $this->GM->DateTimeSplitshow($_POST['to_datetime']); }?></td>
                            </tr>
                            <tr>
                                <td>Location : <?php echo $_POST['to_lat'].','.$_POST['from_lng']; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <br><br>
                        <div class="form-group">
                            <label>Attendance Type</label>
                            <select id="Mas_AttendanceType_Id" required class="form-control select2" name="Mas_AttendanceType_Id">
                                <?php
                                $data = $this->GM->Attendancetype($AttendanceStatus_Id = "0", $status = "1");
                                $this->GM->Option_($data, 'Mas_AttendanceType_Id', 'AttendanceType', '', 'Select', @set_value('Mas_AttendanceType_Id') . @$Mas_AttendanceType_Id);
                                ?>
                            </select>
                            <?php echo form_error('Mas_AttendanceType_Id'); ?>
                        </div>
                        <div class="form-group">
                            <label>Attendance Status</label>
                            <select id="Attendance_Status_Status_Id" required class="form-control select2" name="Attendance_Status_Status_Id">
                                <?php
                                $data = $this->GM->AttendanceStatus($AttendanceStatus_Id = "0");
                                $this->GM->Option_($data, 'Attendance_Status_Status_Id', 'Attendance_Status_Status_Name', '', 'Select', @set_value('Attendance_Status_Status_Id') . @$Attendance_Status_Status_Id);
                                ?>
                            </select>
                            <?php echo form_error('Attendance_Status_Status_Id'); ?>
                        </div>
                        <div class="form-group">
                            <label>Decription : </label>
                            <input type="text" class="form-control input-md" required name="decription" placeholder="Enter decription" value="<?php echo @set_value('decription') . @$decription; ?> ">
                            <?php echo form_error('decription'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <a href="<?php echo site_url('Users/Attendance') . "/?Key=" . base64_encode($_POST['User_Id']) . "&ur=" . base64_encode($_POST['UserRole_Id']); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
                <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
                    <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
            </div>
            </form>
        </div>
    </section>
</div>
<?php include('Foot.php'); ?>