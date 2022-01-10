<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
$UserRole_Id = 3;
?>
<div class="content-wrapper">
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">SalesExecutve View</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Users/SalesExecutve_View'); ?>" class="btn btn-flat bg-grayy" style="background:#f9f9f9;color:#1a2226;"><i class="fa fa-caret-left"></i> Back</a>
                    <a href="<?php echo site_url('Users/SalesExecutveuser_Views') . '/?Key=' . $_GET['Key']; ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <div class="box-body">
                <!-- Custom Tabs (Pulled to the right) -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                        <li class="active"><a href="#tab_1-1" data-toggle="tab" aria-expanded="true">Personal Details</a></li>
                        <li class=""><a href="#tab_2-1" data-toggle="tab" aria-expanded="false">Payable</a></li>
                        <li class=""><a href="#tab_3-1" data-toggle="tab" aria-expanded="false">Attendance</a></li>
                        <li class=""><a href="#tab_4-1" data-toggle="tab" aria-expanded="false">Documents</a></li>
                        <li class="pull-left header"><i class="fa fa-user"></i> User</li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1-1">
                            <b>Personal Details</b>
                            <?php
                            foreach ($this->GM->SalesExecutve(1, $_GET['User_Id']) as $user) {
                            ?>
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><?php echo $user->SalutName . ' ' . $user->firstname . ' ' . $user->lastname; ?></h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body row">
                                        <div class="col-md-4">
                                            <strong><i class="fa fa-book margin-r-5"></i> Contact Info</strong>
                                            <p class="text-muted">
                                                <br> <label style="width:75px;font-weight:bold;">E-Mail</label> : <?php echo $user->email; ?>
                                                <br> <label style="width:75px;font-weight:bold;">Contact No</label> : <?php echo $user->mobile . ',' . $user->alt_mobile; ?>
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                                            <p class="text-muted">
                                                <br> <label style="width:75px;font-weight:bold;">Address</label> : <?php echo $user->address; ?>
                                                <br> <label style="width:75px;font-weight:bold;">city</label> : <?php echo $user->city; ?>
                                                <br> <label style="width:75px;font-weight:bold;">State</label> : <?php echo $user->StateName . '-' . $user->postcode; ?>
                                                <br> <label style="width:75px;font-weight:bold;">Country</label> : <?php echo $user->CountryName; ?>
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <strong><i class="fa fa-pencil margin-r-5"></i> Other Infos</strong>
                                            <p>
                                                <br> <label style="width:75px;font-weight:bold;">Joining date</label> : <?php echo $user->Joining_date; ?>
                                                <br> <label style="width:75px;font-weight:bold;">Nationality</label> : <?php echo $user->nationality; ?>
                                                <br> <label style="width:75px;font-weight:bold;">Gender</label> : <?php echo $user->GenderName; ?>
                                                <br> <label style="width:75px;font-weight:bold;">Date of Birth</label> : <?php echo $user->dateofbirth; ?>
                                                <br> <label style="width:75px;font-weight:bold;">Status</label> :
                                                <?php
                                                if ($user->Status_Id == '1') {
                                                ?>
                                                    <span class="label label-success"><?php echo $user->StatusName ?></span>
                                                <?php
                                                } else {
                                                ?>
                                                    <span class="label label-danger"><?php echo $user->StatusName ?></span>
                                                <?php
                                                } ?>
                                            </p>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            <?php
                            } ?>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2-1">
                            <b>Current Payable</b>
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body row">
                                    <table class="table table-bordered display nowrap" style="width:100%">
                                        <?php
                                        $salarydata = $this->GM->Salary($UserRole_Id, $pay_type = "0", $status = "1", $user->SalesExecutve_Id);
                                        foreach ($salarydata as $Salary) {
                                        ?>
                                            <tr>
                                                <td> <b>Pay Type:</b> <?php echo $Salary->pay_type; ?></td>
                                                <td><b>Joining Date:</b> <?php echo $Salary->Joining_date; ?> </td>
                                                <td> <b>Name:</b> <?php echo $Salary->SalutName . '.' . $Salary->firstname . ' ' . $Salary->lastname; ?> <br> (<?php echo $Salary->UserRole; ?> )</td>
                                            </tr>
                                            </tr>
                                        <?php
                                        } ?>
                                    </table>
                                    <table class="table table-bordered display nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <td>Head</td>
                                                <td>Pay</td>
                                                <td>Deduction</td>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $pay = 0;
                                            $deduction = 0;
                                            foreach ($this->GM->payable($UserRole_Id, $user->SalesExecutve_Id, '') as $SalaryAmount) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $SalaryAmount->pay_head; ?></td>
                                                    <td><?php echo $SalaryAmount->pay; ?></td>
                                                    <td><?php $deductionsettotal = 0;
                                                        foreach ($this->GM->payableDeduction($SalaryAmount->SalaryAmount_Id, '') as $payableDeduction) {
                                                            $deductionsettotal += $payableDeduction->deduction;
                                                        }
                                                        echo $deductionsettotal; ?></td>
                                                    <td><?php echo $SalaryAmount->pay - $deductionsettotal; ?></td>
                                                </tr>
                                            <?php
                                                $pay += $SalaryAmount->pay;
                                                $deduction += $deductionsettotal;
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td><b>Total</b></td>
                                                <td><b><?php echo $pay; ?></b></td>
                                                <td><b><?php echo $deduction; ?></b></td>
                                                <td><b><?php echo $pay - $deduction; ?></b></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_3-1">
                            <b>Attendance
                                ( <?php
                                    $month_ini = new DateTime("first day of last month");
                                    $month_end = new DateTime("last day of this  month");
                                    $from_date = $month_ini->format('m/d/Y');
                                    $to_date =  $month_end->format('m/d/Y');
                                    echo "From :" . date('d-m-Y', strtotime($from_date));
                                    echo " To :" . date('d-m-Y', strtotime($to_date));
                                    ?>)</b>
                            <div class="box box-primary">
                                <?php
                                $Attendanceuserlistdata = $this->GM->AttendanceUserlist($status = "1", $id = "0", $UserRole_Id, $user->SalesExecutve_Id);
                                if ($Attendanceuserlistdata) {
                                ?>
                                    <div class="box-body row">
                                        <table class="table table-bordered" style="width:100%">
                                            <?php
                                            foreach ($Attendanceuserlistdata as $Attendanceuserlist) {
                                            ?>
                                                <tr>
                                                    <td> <b>Name:</b> <?php echo $Attendanceuserlist->SalutName . '.' . $Attendanceuserlist->firstname . ' ' . $Attendanceuserlist->lastname; ?> <br> (<?php echo $Attendanceuserlist->UserRole; ?> )</td>
                                                    <td> <b>Email:</b> <?php echo $Attendanceuserlist->email; ?> </td>
                                                    <td><b>Joining Date :</b> <?php echo $Attendanceuserlist->Joining_date; ?> </td>
                                                </tr>
                                            <?php
                                            } ?>
                                        </table>
                                        <table class="table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Type</th>
                                                    <th>From</th>
                                                    <th> To</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $cou = 1;
                                                foreach ($this->GM->AttendanceTime($Attendanceuserlist->Attendance_Id, $Attendancetimezone = "0", $status = "1", $Attendance_Status_Id = "0", $from_date, $to_date) as $AttendanceTime) {
                                                ?>
                                                    <tr>
                                                        <td><b><?php echo $cou; ?></b></td>
                                                        <td><?php echo $AttendanceTime->AttendanceType; ?></td>
                                                        <td><?php echo $this->GM->DateTimeSplitshow($AttendanceTime->from_datetime); ?></td>
                                                        <td><?php echo ($AttendanceTime->to_datetime != 'Nill') ? $this->GM->DateTimeSplitshow($AttendanceTime->to_datetime) : $AttendanceTime->to_datetime;  ?></td>
                                                        <td><?php echo $AttendanceTime->Attendance_Status_Status_Name; ?></td>
                                                    </tr>
                                                <?php
                                                    $cou++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php
                                } ?>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_4-1">
                            <?php
                            $directory = log_directory ."/" .$_SESSION['currentdatabasename'].  "/" . $UserRole_Id . "/" . $user->SalesExecutve_Id;
                            if (!is_dir($directory)) {
                                mkdir($directory, 0777, TRUE);
                            }
                            $map = directory_map($directory);
                            ?>
                            <b>Documents</b>
                            <div class="box-body row">
                                <?php echo form_open_multipart(site_url('Users/file_upload')); ?>
                                <input type="hidden" name="path" value="<?php echo $directory; ?>">
                                <div class="col-md-5 form-group">
                                    <label>File Name</label>
                                    <input type="text" name="upload_request_filename" class="form-control" required>
                                </div>
                                <div class="col-md-5 form-group">
                                    <label>File (max:5MB (png|JPG|JPEG))</label>
                                    <input type="file" name="upload_request_file" accept="image/png, image/jpeg , image/jpg" class="form-control" required id="upload_request_file" size="5124">
                                </div>
                                <div class="col-md-2 form-group">
                                    <br>
                                    <input type="submit" class="btn btn-primary btn-flat" value="upload" />
                                </div>
                                </form>
                            </div>
                            <div class="row">
                                <?php
                                foreach ($map as $file) {
                                ?>
                                    <div class="col-md-3">
                                        <label><?php echo $file; ?></label>
                                        <img src="<?php echo base_url($directory . "/" . $file); ?>" alt="" class="img-responsive">
                                    </div>
                                <?php
                                } ?>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
        </div>
    </section>
</div>
<?php include('Foot.php'); ?>
<style>
    .splituphead {
        text-align: right;
    }
    .splitupval {
        text-align: right;
    }
</style>