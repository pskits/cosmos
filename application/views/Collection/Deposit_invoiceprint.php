<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
$office = $this->GM->Office($officetype = "0", $status = "1", $Id = "0", $_SESSION['currentdatabasename']);
$office = $office[0];
$id = $_GET['Key'];
$id = base64_decode($id);
foreach ($this->GM->Deposit($status = "1", $bank_id = "0", $depositedUser_Id = "0", $DepositStatus_Id = "0", $amountmode_Id = "0", $id, '', '') as $Row) {
?>
    <!-- Content Header (Page header) -->
    <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="callout callout-info row">
                            <h4 class="col-md-4"><b> <?php echo $Row->Deposit_no . '(' . $Row->Deposit_StatusName . ')'; ?></b></h4>
                    
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
                                        <strong><?php echo $Row->BankName;?></strong><br>
                                        <?php echo $Row->Branch;?><br />
                                        <?php echo $Row->Email;?><br />
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
                                                <th>#</th>
                                                <th>Collection</th>
                                                <th>Collection Date</th>
                                                <th>Amount (<?php echo $_SESSION['Currencycode']; ?>)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = "0";
                                            $total = 0.00;
                                            foreach ($this->GM->DepositCollection($status = "0", $Row->Deposit_Id ,  $Id = "0") as $Products) {
                                                $count++;
                                            ?>
                                                <tr>
                                                    <td><?php echo $count; ?></td>
                                                    <td><?php echo $Products->Collection_no; ?> </td>
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
								<div class="col-sm-4 pull-left">
                                   
									<?php 
									 $directory = Deposit_directory . "/" . $_SESSION['currentdatabasename'] . '/' . $Row->Deposit_Id;
							
									$map = directory_map($directory);
									
                                foreach ($map as $file) {                                ?>
                                   
								 <img src="<?php echo base_url($directory . "/" . $file); ?>" alt="" class="img-responsive" style="max-width:100%;" alt="Deposit Slip">
                                <?php 
}
								?>
								</div>
                                <div class="col-sm-6 pull-right">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th>Total (<?php echo $_SESSION['Currencycode']; ?>):</th>
                                                <td><?php echo  $Row->amount; ?></td>
                                            </tr>
                                        </table>
                                    </div>
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

<?php
}
?>