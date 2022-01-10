<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
$UserRole_Id = 4;
?>
<div class="content-wrapper">
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Deviceapproval View</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Category/Device_View'); ?>" class="btn btn-flat bg-grayy" style="background:#f9f9f9;color:#1a2226;"><i class="fa fa-caret-left"></i> Back</a>
                    <a href="<?php echo site_url('Category/Deviceapproval_views') . '/?Key=' . $_GET['Key']; ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <div class="box-body">
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body row">
                        <div class="col-md-6">
                            <?php
                            $cou = 1;
                            foreach ($this->GM->Device(base64_decode($_GET['Key']), '0') as $Device) {
                            ?>
                                <strong><i class="fa fa-book margin-r-5"></i> Device Info</strong>
                                <p class="text-muted">
                                    <br> <label style="width:80px;font-weight:bold;">is Virtual</label> : <?php echo $Device->isVirtual; ?>
                                    <br> <label style="width:80px;font-weight:bold;">Manufacturer</label> : <?php echo $Device->manufacturer; ?>
                                    <br> <label style="width:80px;font-weight:bold;">model</label> : <?php echo $Device->model; ?>
                                    <br> <label style="width:80px;font-weight:bold;">platform</label> : <?php echo $Device->platform; ?>
                                    <br> <label style="width:80px;font-weight:bold;">serial</label> : <?php echo $Device->serial; ?>
                                    <br> <label style="width:80px;font-weight:bold;">uuid</label> : <?php echo $Device->uuid; ?>
                                    <br> <label style="width:80px;font-weight:bold;">version</label> : <?php echo $Device->version; ?>
                                    <br> <label style="width:80px;font-weight:bold;">our_uid</label> : <?php echo $Device->our_uid; ?>
                                    <br> <label style="width:80px;font-weight:bold;">Last Requested User</label> : <?php echo $Device->Email; ?>
                                    <br> <label style="width:80px;font-weight:bold;">StatusName</label> : <?php echo $Device->StatusName; ?>
                                </p>
                        </div>
                        <div class="col-md-4">
                            <strong><i class="fa fa-map-marker margin-r-5"></i> Approval </strong>
                            <p class="text-muted">
                                <br> <label style="width:120px;font-weight:bold;">Last Approved By </label> : <?php echo $Device->approvedemail; ?>
                                <br> <label style="width:120px;font-weight:bold;">Last Approved date</label> : <?php echo $Device->Last_Approved_date; ?>
                                <br> <label style="width:80px;font-weight:bold;">Status</label> :<?php echo $Device->Device_Status_Status_Name; ?>
                                <?php
                                if ($Device->Device_Status_Status_Id == '1') {
                                ?>
                                    <?php echo form_open_multipart(site_url('Category/Deviceapproval_views'), 'role="form"'); ?>
                                    <input type="hidden" name="DeviceId" value="<?php echo $Device->Device_Id; ?>">
                                    <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
                                    <button type="submit" class="btn btn-primary btn-flat" name="Approval">Approve</button>
                                    </form>
                                <?php
                                } else if ($Device->Device_Status_Status_Id == '2') {
                                ?>
                                    <br> <label style="width:80px;font-weight:bold;">Code</label> : <?php echo $Device->Current_Code; ?>
                                <?php
                                } else if ($Device->Device_Status_Status_Id == '5') {
                                ?>
                                    <?php echo form_open_multipart(site_url('Category/Deviceapproval_views'), 'role="form"'); ?>
                                    <input type="hidden" name="DeviceId" value="<?php echo $Device->Device_Id; ?>">
                                    <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
                                    <button type="submit" class="btn btn-primary btn-flat" name="Activate">Activate</button>
                                    </form>
                                <?php
                                }
                                if ($Device->Device_Status_Status_Id != '5') { ?>
                                    <?php echo form_open_multipart(site_url('Category/Deviceapproval_views'), 'role="form"'); ?>
                                    <input type="hidden" name="DeviceId" value="<?php echo $Device->Device_Id; ?>">
                                    <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
                                    <button type="submit" class="btn btn-primary btn-flat" name="DeActivate">DeActivate</button>
                                    </form>
                                <?php
                                }
                                ?>
                            </p>
                        </div>
                    <?php
                            }
                    ?>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- Custom Tabs (Pulled to the right) -->
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