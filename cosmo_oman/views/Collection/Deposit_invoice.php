<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');

$office = $this->GM->Office($officetype = "0", $status = "1", $Id = "0", $_SESSION['currentdatabasename']);
$office = $office[0];
$id = $_GET['Key'];
$id = base64_decode($id);
foreach ($this->GM->Deposit($status = "1", $bank_id = "0", $depositedUser_Id = "0", $DepositStatus_Id = "0", $amountmode_Id = "0", $id, '', '') as $Row) {
?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="callout callout-info row">
                            <h4 class="col-md-4"><b> <?php echo $Row->Deposit_no . '(' . $Row->Deposit_StatusName . ')'; ?></b></h4>
                            <div class="col-md-8">
                                <a onclick="frames['frame'].print()" style="background-color:#0ea3a9;margin-right:1px;" class="btn btn-flat pull-right"><i class="fa fa-file-pdf-o"></i> PDF</a>
                                <a href="<?php echo site_url('Collection/Deposit_view'); ?>" style="background-color:#0ea3a9;margin-right:1px;" class="btn btn-flat pull-right"><i class="fa fa-arrow-circle-left"></i> </a>
                            </div>
                        </div>
                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <!-- info row -->
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

                            </div>
                            <div class="row invoice-info">

                                <div class="col-sm-6 invoice-col">
                                    <address>
                                        <strong><?php echo $Row->BankName; ?></strong><br>
                                        <?php echo $Row->Branch; ?><br />
                                        <?php echo $Row->Email; ?><br />
                                    </address>
                                </div>

                            </div>

                            <div class="row invoice-info">
                                <div class="col-sm-1 invoice-col">
                                    <br /> <br />
                                    <address>
                                        Bank <br>
                                        Branch <br />
                                        By <br />
                                    </address>
                                </div>
                                <div class="col-sm-6 invoice-col">
                                    <br /> <br />
                                    <address>
                                        : <strong><?php echo $Row->BankName; ?></strong><br>
                                        : <?php echo $Row->Branch; ?><br />
                                        : <?php echo $Row->Email; ?><br />
                                    </address>
                                </div>
                                <!-- /.col -->
                                <!-- /.col -->
                                <div class="col-sm-3 invoice-col pull-right">
                                    <h2 style="color:#0ea3a9;"><b>Deposit</b></h2>
                                    <h4><b><?php echo $Row->Deposit_no; ?></b></h4>
                                    <b>Date:</b> <?php echo $Row->Deposit_Dateformatted; ?><br>
                                </div>
                            </div>
                            <!-- /.row -->
                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Collection</th>
                                                <th>Collection Date</th>
                                                <th>Amount (<?php echo $_SESSION['Currencycode']; ?>)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = "0";
                                            $total = 0.000;
                                          
                                            foreach ($this->GM->DepositCollection($status = "0", $Row->Deposit_Id ,  $Id = "0") as $Products) {
                                                $count++;
                                            ?>
                                                <tr>
                                                    <td><?php echo $count; ?></td>
                                                    <td><a href="<?php echo site_url('Collection/Collection_invoice').'/?Key='.base64_encode($Products->Collection_Id);?>"> <?php echo $Products->Collection_no; ?> </a></td>
                                                    <td><?php echo $Products->Collection_Dateformatted; ?></td>
                                                    <td><?php echo $Products->amount; ?></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                            <div class="row">
                                <!-- accepted payments column -->
                                <!-- /.col -->
                                <div class="col-sm-6 pull-right">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th>Total:</th>
                                                <td><?php echo $_SESSION['Currencycode'] . ' ' . $Row->amount; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
								
                                <div class="col-sm-6 pull-left">
                                    <p class="lead"><?php echo $Row->Description; ?></p>
									<br>
									<?php 
									 $directory = Deposit_directory . "/" . $_SESSION['currentdatabasename'] . '/' . $Row->Deposit_Id;
							
									$map = directory_map($directory);
									
                                foreach ($map as $file) {                                ?>
                                   
								 <img src="<?php echo base_url($directory . "/" . $file); ?>" alt="" class="img-responsive" alt="Deposit Slip">
                                <?php 
}
								?>
								</div>
                                <!-- /.col -->
                            </div>
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
    <iframe style="width:0px;height:0px;" src="<?php echo site_url('Collection/Deposit_invoicePrint/?Key=' . $_GET['Key']); ?>" name="frame"></iframe>
<?php
}
?>
<?php include('Includes/Foot.php'); ?>