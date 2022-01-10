<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
$office = $this->GM->Office($officetype = "0", $status = "1", $Id = "0", $_SESSION['currentdatabasename']);
$office = $office[0];
$id = $_GET['Key'];
$id = base64_decode($id);
foreach ($this->GM->SalesReturnRequestGoodsable($status_id = "1", $id, $Dealer_Id = "0", $Salesexecutive_user_Id = "0", $SalesreturnRequestType_Id = "0")  as $Row) {
?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="callout callout-info row">
                            <h4 class="col-md-4"><b> <?php echo $Row->SalesReturnRequest_No ; ?></b></h4>
                            <div class="col-md-8">
                                <a href="<?php echo site_url("SalesReturn/SalesReturn_view/?Key=") . base64_encode($Row->SalesReturnRequest_Id); ?>" style="background-color:#0ea3a9;margin-right:1px;" class="btn btn-flat pull-right"><i class="fa fa-arrow-circle-left"></i> </a>
                            </div>
                        </div>
                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                          
                            <div class="row invoice-info">
                                <div class="col-sm-6 invoice-col">
                                    <img src="<?php echo base_url('assets/Pics/cosmo_pumps.png'); ?>" class="invoice-logo" alt="Cosmo Pumps">
                                    <address>
                                        <strong><?php echo $office->office_Name; ?></strong><br>
                                        <?php echo $office->office_address; ?>
                                        TRN: <?php echo $office->trn_no; ?><br />
                                        Phone: <?php echo $office->office_phone; ?><br />
                                    </address>
                                </div>
                                <!-- /.col -->
                                <!-- /.col -->
                                <div class="col-sm-3 invoice-col pull-right">
                                    <br /> <br />
                                    <h2 style="color:#0ea3a9;"><b>Sales Return Request</b></h2>
                                    <h4><b><?php echo $Row->SalesReturn_No; ?></b> For <b><?php echo $Row->SalesReturnRequest_No; ?></b> </h4><br>
                                    <br>
                                    <b>Sales Return Date:</b> <?php echo $Row->FormattedSalesReturn_dateDate; ?><br>
                                </div>
                            </div>
                            <div class="row invoice-info">
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    Bill To
                                    <address>
                                        <strong><?php echo $Row->name; ?></strong><br>
                                        <p style="width:70%;margin:0px;">
                                            <?php echo $Row->address; ?>
                                        </p>
                                        Phone:<?php echo $Row->mobile; ?><br>
                                        Email:<?php echo $Row->email; ?>
                                    </address>
                                </div>
                            </div>
                            <!-- /.row -->
                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Invoice</th>
                                                <th>Serial No</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = "0";
                                            $Completed = true;
                                            foreach ($this->GM->SalesReturnRequestGoods($status_id = "1", $Row->SalesReturnRequest_Id, $serialno = "",  $SalesreturnRequest_status_Id = "2") as $Products) {
                                                $count++;
                                                $Completed = false;
                                            ?>
                                                <tr>
                                                    <td><?php echo $count; ?></td>
                                                    <td><?php echo $Products->Invoice_No; ?></td>
                                                    <td><?php echo $Products->SerialNo; ?></td>
                                                    <td><?php echo $Products->SalesReturnRequest_statusName; ?></td>
                                                    <td>
                                                        <form style="width:25%;float:left;" action="<?php echo site_url('SalesReturn/SalesReturnGoodsScrab_Status'); ?>" method="post">
                                                            <input type="hidden" value="<?php echo $Products->SerialNo; ?>" name="SerialNo">
                                                            <input type="hidden" value="<?php echo $Row->SalesReturn_Id; ?>" name="SalesReturn_Id">
                                                            <input type="hidden" value="5" name="salesreturnrequest_status_id">
                                                            <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
                                                            <button type="submit" class="btn  btn-danger btn-flat">Scrab</button>
                                                        </form>
                                                        <form style="width:25%;float:left;" action="<?php echo site_url('SalesReturn/SalesReturnGoodsResellable_Status'); ?>" method="post">
                                                            <input type="hidden" value="<?php echo $Products->SerialNo; ?>" name="SerialNo">
                                                            <input type="hidden" value="<?php echo $Row->SalesReturn_Id; ?>" name="SalesReturn_Id">
                                                            <input type="hidden" value="5" name="salesreturnrequest_status_id">
                                                            <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
                                                            <button type="submit" class="btn btn-success btn-flat">Re-Sellable</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <br><br>
                                <!-- /.col -->
                                <?php if ($Completed) { ?>
                                    <form style="width:25%;float:left;" action="<?php echo site_url('SalesReturn/SalsReturnRequest_Completion'); ?>" method="post">
                                        <input type="hidden" value="<?php echo $Row->SalesReturnRequest_Id; ?>" name="SalesReturnRequest_Id">
                                        <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
                                        <button type="submit" class="btn btn-success btn-flat">Completed</button>
                                    </form>
                                <?php }
                                ?>
                            </div>
                            <!-- /.row -->
                            <!-- /.row -->
                            <!-- this row will not appear when printing -->
                        </div>
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
<?php
}
?>
<?php include('Includes/Foot.php'); ?>