<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
include('assets/plugin/geomarker.php');
$UserRole_Id = 6;
$userdata = $this->GM->Dealer($_GET['User_Id'], 0);
$title=$userdata[0]->name.'- Dealer';
?>
<div class="content-wrapper">
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Dealer View</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Users/Dealer_View'); ?>" class="btn btn-flat bg-grayy" style="background:#f9f9f9;color:#1a2226;"><i class="fa fa-caret-left"></i> Back</a>
                    <a href="<?php echo site_url('Users/Dealeruser_Views') . '/?Key=' . $_GET['Key']; ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <div class="box-body">
                <!-- Custom Tabs (Pulled to the right) -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                        <li class="active"><a href="#tab_1-1" data-toggle="tab" aria-expanded="true">Overview</a></li>
                        <li class=""><a href="#tab_2-1" data-toggle="tab" aria-expanded="false">Amount</a></li>  						
                        <li class=""><a href="#tab_4-1" data-toggle="tab" aria-expanded="false">Documents</a></li>
						<li class=""><a href="#tab_3-1" data-toggle="tab" aria-expanded="false">Invoice</a></li>
                        <li class="pull-left header"><i class="fa fa-user"></i> <?php echo $userdata[0]->name; ?></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1-1">
                            <b>Personal Details</b>
                            <?php
                           
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
                                                <br> <label style="width:75px;font-weight:bold;">E-Mail</label> : <?php echo $user->email; ?>
                                                <br> <label style="width:75px;font-weight:bold;">Contact No</label> : <?php echo $user->mobile . ',' . $user->alt_mobile; ?>
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <strong><i class="fa fa-map-marker margin-r-5"></i> Place</strong>
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
										  <div class="col-md-12">
                                            <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                                            <p class="text-muted">
                                                <br> <label style="width:75px;font-weight:bold;">Area</label> : <?php echo $user->AreaName; ?>
                                            </p>
											<br>
											
    <div id="maplocator"></div>
		                           </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            <?php
                            } ?>
                        </div>
                        <!-- /.tab-pane -->
						           <div class="tab-pane" id="tab_3-1">
                            <b>Invoice</b>
                            <div class="box box-primary">
						
							 <table id="Viewtable" class="display nowrap" style="width:100%">
          <thead>
		  <tr>
		   <tr >
		 <th style="text-align:center;border-right:1px solid #555;" Colspan="3">Invoice Details</th>
               
              <th style="text-align:center;border-right:1px solid #555;" colspan="6">Amount <br> <sub><?php echo $_SESSION['Currencycode'];?></sub></th>       
		  </tr>
		  </tr>
            <tr>
             
              <th>Invoice</th>
              <th>Invoice Date</th>
              <th style="border-right:1px solid #555;">Due Date</th>            
              
              <th>Due </th>           
              <th>Invoice </th>
              <th>Collected </th>
			  <th>Un Credited </th> 
               <th>Sales Return </th>           
				<th>Credit Note  </th>          
             
            </tr>
            
          </thead>
          <tbody>
            <?php
            $cou = 1;
			$datatableTitle = '';
			//$userdata[0]->name.'-Invoice Details';
            foreach ($this->GM->InvoicelistWithDue($status_id = 1, $user->Dealer_Id, $Invoice_Id = "0", $salesexecutiveid = "0") as $Row) {
             ?>
              <tr >               
                <td><a <?php echo "href='" . site_url('') . "/" . "Sales/Invoice_view/?Key=" . base64_encode($Row->Invoice_Id) . "'"; ?>><?php echo $Row->Invoice_No; ?></a></td>
                <td><?php echo $Row->FormattedInvoiceDate; ?></td>
                <td style="border-right:1px solid #555;"><?php echo $Row->InvoiceDue_DateFormatted; ?></td>               
             
                <td><?php echo $Row->Invoice_Due; ?></td>
                <td><?php echo $Row->Invoice_total; ?></td>
                <td><?php echo $Row->CollectedAmount; ?></td>
				<td><?php echo $Row->UncreditedCollectionAmount; ?></td>
                <td><?php echo $Row->SalesReturnAmount; ?></td>
             	<td><?php echo $Row->CreditnoteAmount; ?></td>
              </tr>
            <?php
              $cou++;
            }
            ?>
          </tbody>
        </table>
							</div></div>
                        <div class="tab-pane" id="tab_2-1">
                            <b>Amount Info</b>
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body row">
                                    <?php
                                    foreach ($userdata as $user) {
                                    ?>
                                        <div class="box-body row">
                                            <div class="col-md-6">
                                                <?php echo form_open_multipart(site_url('Users/Dealer_credit'), 'role="form"'); ?>
                                                <input type="hidden" name="Dealer_Id" value="<?php echo $user->Dealer_Id; ?>">
                                                <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
                                                <div class="form-group">
                                                    <label>Credit Limit</label>
                                                    <input type="number" class="form-control input-md" minlength="3" required name="credit_limit" placeholder="Enter credit limit" value="<?php echo $user->credit_limit; ?>">
                                                    <?php echo form_error('credit_limit'); ?>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-flat" name="Abut" value="Update"> Approve and Update</button>
                                                </form>
                                            </div>
                                            <div class="col-md-6">
                                                <?php $useramount = $this->GM->DealerAmountInfo($user->Dealer_Id, $status = "1", $salesexecutiveid = 0);
 
                                               ?>
                                                <p>
                                                  
                                                    <br> <label style="width:200px;font-weight:bold;">Invoice Amount</label> : <?php echo $useramount[0]->Invoice_total; ?>
                                                    <br> <label style="width:200px;font-weight:bold;">Collection Amount (Unsettled)</label> : <?php echo $useramount[0]->UncreditedCollectionAmount; ?>
                                                    <br> <label style="width:200px;font-weight:bold;">Collection Amount (Settled)</label> : <?php echo $useramount[0]->CollectionAmount; ?>
                                               
                                                    <br> <label style="width:200px;font-weight:bold;">Invoice Due</label> : <?php echo $useramount[0]->Invoice_Due; ?>
                                               
                                                    <br> <label style="width:200px;font-weight:bold;">Sales Return Amount</label> : <?php echo $useramount[0]->salesreturn_total; ?>
                                                    <br> <label style="width:200px;font-weight:bold;">Credit Balance Amount</label> : <?php echo $useramount[0]->Credit_balance; ?>
                                                    </p>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_4-1">
                            <?php
                            $directory = log_directory . "/" . $_SESSION['currentdatabasename'] . "/" . $UserRole_Id . "/" . $user->Dealer_Id;
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
                             <!-- /.tab-pane -->
                        
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
        </div>
    </section>
</div>
<?php include('Includes/Foot.php'); ?>
<style>
    .splituphead {
        text-align: right;
    }

    .splitupval {
        text-align: right;
    }
</style>
<script>
loadmap(<?php echo $user->lat.','.$user->lng?>);
</script>