<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
$UserRole_Id = 11;
echo $_GET['User_Id'] = base64_decode($_GET['Key']);
?>
<div class="content-wrapper">
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">View</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Purchase/Supplier_View'); ?>" class="btn btn-flat bg-grayy" style="background:#f9f9f9;color:#1a2226;"><i class="fa fa-caret-left"></i> Back</a>
                    <a href="<?php echo site_url('Purchase/Supplieruser_Views') . '/?Key=' . $_GET['Key']; ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <div class="box-body">
                <!-- Custom Tabs (Pulled to the right) -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                        <li class="active"><a href="#tab_1-1" data-toggle="tab" aria-expanded="true">Personal Details</a></li>
                        <li class=""><a href="#tab_4-1" data-toggle="tab" aria-expanded="false">Documents</a></li>
                        <li class="pull-left header"><i class="fa fa-user"></i> Supplier</li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1-1">
                            <b>Personal Details</b>
                            <?php
                            $userdata = $this->GM->Supplier($status_id = "1",  $_GET['User_Id']);
                            foreach ($userdata as $user) {
                               
                            ?>
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><?php echo $user->name; ?></h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body row">
                                        <div class="col-md-4">
                                            <strong><i class="fa fa-book margin-r-5"></i> Contact Info</strong>
                                            <p class="text-muted">
                                                <br> <label style="width:75px;font-weight:bold;">E-Mail</label> : <?php echo $user->Email; ?>
                                                <br> <label style="width:75px;font-weight:bold;">Contact No</label> : <?php echo $user->MobileNo; ?>
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                                            <p class="text-muted">
                                                <br> <label style="width:75px;font-weight:bold;">Address</label> : <?php echo $user->Address; ?>
                                                <br> <label style="width:75px;font-weight:bold;">city</label> : <?php echo $user->City; ?>
                                                <br> <label style="width:75px;font-weight:bold;">State</label> : <?php echo $user->StateName . '-' . $user->Postcode; ?>
                                                <br> <label style="width:75px;font-weight:bold;">Country</label> : <?php echo $user->CountryName; ?>
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <strong><i class="fa fa-pencil margin-r-5"></i> Contact Person Details</strong>
                                            <p>
                                                <br> <label style="width:75px;font-weight:bold;">Name</label> : <?php echo $user->SalutName.' '.$user->Firstname.''.$user->Lastname; ?>
                                                <br> <label style="width:75px;font-weight:bold;">Contact no</label> : <?php echo $user->contact_mobile; ?>
                                                <br> <label style="width:75px;font-weight:bold;">Email</label> : <?php echo $user->contact_email; ?>
                                          
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
                        
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_4-1">
                            <?php
                            $directory = log_directory . "/" . $_SESSION['currentdatabasename'] . "/" . $UserRole_Id . "/" . $user->Supplier_Id;
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