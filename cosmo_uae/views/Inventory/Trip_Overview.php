<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
$Id = base64_decode($_GET['Key']);
$tripdata = $this->GM->Trip($status_Id = "1", $warehouse_id = "0", $area_Id = "0", $Truck_Id = "0", $Driver_Id = "0", $Helper_Id = "0", $Trip_status_Id = "0", $Id, '', '');
?>
<div class="content-wrapper">
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Trip View</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Inventory/Trip_View'); ?>" class="btn btn-flat bg-grayy" style="background:#f9f9f9;color:#1a2226;"><i class="fa fa-caret-left"></i> Back</a>
                </div>
            </div>
            <div class="box-body">
                <!-- Custom Tabs (Pulled to the right) -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                        <li class="active"><a href="#tab_1-1" data-toggle="tab" aria-expanded="true">Details</a></li>
                        <li class=""><a href="#tab_2-1" data-toggle="tab" aria-expanded="false">Invoice</a></li>
                        <li class=""><a href="#tab_3-1" data-toggle="tab" aria-expanded="false">Route</a></li>
                        <li class=""><a href="#tab_4-1" data-toggle="tab" aria-expanded="false">Documents</a></li>
                        <li class="pull-left header"><i class="fa fa-user"></i> <?php echo $tripdata[0]->trip_no ;?></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1-1">
                            <b>Details</b>
                            <?php
                            foreach ($tripdata as $Trip) {
                            ?>
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><?php echo $Trip->trip_no; ?></h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body row">
                                        <div class="col-md-6">
                                            <strong><i class="fa fa-pencil margin-r-5"></i> Other Infos</strong>
                                            <p>
                                                <br> <label style="width:75px;font-weight:bold;">Discription</label> : <?php echo $Trip->trip_desc; ?>
                                                <br> <label style="width:75px;font-weight:bold;">Status</label> :
                                                <span class="label label-success"><?php echo $Trip->Trip_StatusName ?></span>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                                            <p class="text-muted">
                                                <br> <label style="width:75px;font-weight:bold;">Warehouse</label> : <?php echo $Trip->WarehouseName; ?>
                                                <br> <label style="width:75px;font-weight:bold;">AreaName</label> : <?php echo $Trip->AreaName; ?>
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <strong><i class="fa fa-book margin-r-5"></i>Info</strong>
                                            <p class="text-muted">
											
												<br> <label style="width:75px;font-weight:bold;">Trip Employee</label> : <?php echo $Trip->TripEmployee; ?>
                                                <br> <label style="width:75px;font-weight:bold;">Driver</label> : <?php echo $Trip->driver; ?>
                                                <br> <label style="width:75px;font-weight:bold;">Helper</label> : <?php echo $Trip->helper; ?>
                                                <br> <label style="width:75px;font-weight:bold;">Date</label> : <?php echo $Trip->Trip_Dateformatted; ?>
                                                <br> <label style="width:75px;font-weight:bold;">Truck</label> : <?php echo $Trip->name; ?>
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
                            <b>Invoice</b>
                            <div class="box box-primary">
                                <?php if ($Trip->TripStatus_Id == '1') { ?>
                                    <form method="post" action="<?php echo site_url("Inventory/TripDeliveries_Save"); ?>" class="form-inline ">
                                        <input type="hidden" name="trip_Id" value="<?php echo $Trip->trip_Id; ?>">
                                        <input type="hidden" name="againsttype_id" value="1">
                                        <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
                                        <br />
                                        <div style="margin-left:5px;" class=" form-group">
                                            <label class="label">Invoice</label>
                                            <select class="form-control select2" required name="against_id">
                                                <?php
                                                $data = $this->GM->AvailableDeliveriesForTrip(0, $Trip->area_Id, '1');
                                                $this->GM->Option_($data, 'ID', 'No', '', 'Select', '0');
                                                ?>
                                            </select>
                                            <?php echo form_error('against_id'); ?>
                                        </div>
                                        <div style="margin-left:5px;" class="form-group">
                                            <label>sortby</label>
                                            <input type="text" id="sortby" class="form-control input-md" required name="sortby" placeholder="Enter sortby" value="<?php echo @set_value('sortby') . @$sortby; ?>">
                                            <?php echo form_error('sortby'); ?>
                                        </div>
                                        <div style="margin-left:5px;" class="form-group">
                                            <button type="submit" class="btn bg-black text-white btn-flat" name="Abut" value="Show">
                                                Add Invoice</button>
                                        </div>
                                    </form>
                                    <form method="post" action="<?php echo site_url("Inventory/TripDeliveries_Save"); ?>" class="form-inline ">
                                        <input type="hidden" name="trip_Id" value="<?php echo $Trip->trip_Id; ?>">
                                        <input type="hidden" name="againsttype_id" value="2">
                                        <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
                                        <br />
                                        <div style="margin-left:5px;" class=" form-group">
                                            <label class="label">Invoice</label>
                                            <select class="form-control select2" required name="against_id">
                                                <?php
                                                $data = $this->GM->AvailableDeliveriesForTrip(0, $Trip->area_Id, '2');
                                                $this->GM->Option_($data, 'ID', 'No', '', 'Select', '0');
                                                ?>
                                            </select>
                                            <?php echo form_error('against_id'); ?>
                                        </div>
                                        <div style="margin-left:5px;" class="form-group">
                                            <label>sortby</label>
                                            <input type="text" id="sortby" class="form-control input-md" required name="sortby" placeholder="Enter sortby" value="<?php echo @set_value('sortby') . @$sortby; ?>">
                                            <?php echo form_error('sortby'); ?>
                                        </div>
                                        <div style="margin-left:5px;" class="form-group">
                                            <button type="submit" class="btn bg-black text-white btn-flat" name="Abut" value="Show">
                                                Add SalesReturn</button>
                                        </div>
                                    </form>
                                <?php } ?>
                                <div class="box-header with-border">
                                    <table class="display table nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Against</th>
                                                <th>No</th>
												<th>Dealer</th>
                                                <th>Trip Invoice Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tbody>
                                            <?php
                                            $cou = 1;
                                            foreach ($this->GM->TripDeliverable($Trip->trip_Id, 0) as $Row) {
                                            ?>
                                                <tr>
                                                    <td><b><?php echo $cou; ?></b></td>
                                                    <td><?php echo $Row->TripDeliverie_Name; ?></td>
                                                    <td><?php echo $Row->Invoice_No . ' ' . $Row->SalesReturn_No; ?></td>
													 <td><?php echo $Row->name; ?></td>
                                                    <td><?php echo $Row->TripDeliverie_status_Name; ?></td>
                                                    <td>
                                                        <?php if ($Row->AgainstType_Id == '1') { ?>
                                                            <a <?php echo "href='" . site_url("Sales/Invoice_view") . "/?Key=" . base64_encode($Row->Against_Id) . "'"; ?>><span class="badge"><i class="fa fa-eye"></i>Invoice</span>
                                                            </a>
                                                        <?php } ?>
                                                        <?php if ($Row->AgainstType_Id == '2') { ?>
                                                            <a <?php echo "href='" . site_url("SalesReturn/SalesReturn_view") . "/?Key=" . base64_encode($Row->Against_Id) . "'"; ?>><span class="badge"><i class="fa fa-eye"></i>Invoice</span>
                                                            </a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php
                                                $cou++;
                                            }
                                            ?>
                                        </tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body row">
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_3-1">
                            <input type="hidden" id="route_start_lat" name="route_start_lat" value="<?php echo $Trip->Warehouse_lat; ?>">
                            <input type="hidden" id="route_start_lng" name="route_start_lng" value="<?php echo $Trip->Warehouse_lng; ?>">
                            <?php
                            foreach ($this->GM->TripRoute($status_Id = "1", $Trip->trip_Id) as $TripRoute) {
                            ?>
                                <input type="hidden" class="route_end_lat" name="route_end_lat" value="<?php echo $TripRoute->lat; ?>">
                                <input type="hidden" class="route_end_lng" name="route_end_lng" value="<?php echo $TripRoute->lng; ?>">
                            <?php
                            } ?>
                            <b>Route</b>
                            <div id="gmap_route" class="box box-primary">
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_4-1">
                            <?php
                            $directory = Trip_directory . "/" . $_SESSION['currentdatabasename'] . "/" . $Trip->trip_Id;
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
<?php include('Includes/Foot.php');
include('assets/plugin/gmap_route.php'); ?>
<style>
    .splituphead {
        text-align: right;
    }
    .splitupval {
        text-align: right;
    }
</style>