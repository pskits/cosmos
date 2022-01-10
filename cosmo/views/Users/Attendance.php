<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">User Attendance View</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Users/AttendanceList_View'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <div class="box-body row">
                <div class="col-md-12">
                    <h3 class="box-title">User Details</h3>
                    <table class="table table-bordered display nowrap" style="width:100%">
                        <tbody>
                            <?php
                            foreach ($this->GM->AttendanceUserlist($status = "1", $id = "0", $_GET['UserRole_Id'], $_GET['User_Id']) as $Attendanceuserlist) {
                            ?>
                                <tr>
                                    <td> <b>Name:</b> <?php echo $Attendanceuserlist->name; ?> <br> (<?php echo $Attendanceuserlist->UserRole; ?> )</td>
                                    <td> <b>Email:</b> <?php echo $Attendanceuserlist->email; ?> </td>
                                    <td><b>Joining Date :</b> <?php echo $Attendanceuserlist->Joining_date; ?> </td>
                                </tr>
                            <?php
                            } ?>
                        </tbody>
                    </table>
                    <form class="container row">
                        <div class="col-md-3">
                            <input type="hidden" name="ur" value="<?php echo $_GET['ur']; ?>">
                            <input type="hidden" name="Key" value="<?php echo $_GET['Key']; ?>">
                            <div class="form-group">
                                <label class="forminline-label">From : </label>
                                <input type="text" class="form-control input-md Date" readonly required name="fromdate" placeholder="Enter Admin fromdate" value="<?php echo $fromdate = (isset($_REQUEST['fromdate'])) ? $_REQUEST['fromdate'] : date('d-m-Y'); ?> ">
                                <?php echo form_error('fromdate'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="forminline-label">To : </label>
                                <input type="text" class="form-control input-md Date" readonly required name="todate" placeholder="Enter Admin todate" value="<?php echo $todate = (isset($_REQUEST['todate'])) ? $_REQUEST['todate'] : date('d-m-Y'); ?> ">
                                <?php echo form_error('todate'); ?>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button type="submit" style="margin-top:20%;" class="btnbg-black text-white btn-flat" name="Abut" value="Show">
                                    <i class="fa fa-cloud-download"></i>Show</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-12">
                    <table id="Viewtable" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>From</th>
                                <th> To</th>
                                <th>Status</th>
                                <th>Tools</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cou = 1;
                            $from_date = $this->GM->DateSplit($fromdate);
                            $to_date = $this->GM->DateSplit($todate);
                            foreach ($this->GM->AttendanceTime($Attendanceuserlist->Attendance_Id, $Attendancetimezone = "0", $status = "1", $Attendance_Status_Id = "0",$userrole="0",$userid="0", $from_date, $to_date) as $AttendanceTime) {
                            ?>
                                <tr>
                                    <td><b><?php echo $cou; ?></b></td>
                                    <td><?php echo $AttendanceTime->AttendanceType; ?></td>
                                    <td><?php echo $this->GM->DateTimeSplitshow($AttendanceTime->from_datetime); ?></td>
                                    <td><?php echo ($AttendanceTime->to_datetime != 'Nill') ? $this->GM->DateTimeSplitshow($AttendanceTime->to_datetime) : $AttendanceTime->to_datetime;  ?></td>
                                    <td><?php echo $AttendanceTime->Attendance_Status_Status_Name; ?></td>
                                    <td>
                                        <a <?php echo "href='" . site_url('Users/Attendance_Edit') . "/?Key=" . base64_encode($AttendanceTime->Attendance_Id) . "'"; ?> <span class="badge"><i class="fa fa-pencil"></i>&nbsp; Edit</span>
                                    </td>
                                </tr>
                            <?php
                                $cou++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include('Includes/Foot.php'); ?>