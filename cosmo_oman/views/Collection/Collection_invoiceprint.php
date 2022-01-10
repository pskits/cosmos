<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');

$office = $this->GM->Office($officetype = "0", $status = "1", $Id = "0", $_SESSION['currentdatabasename']);
$office = $office[0];
$id = $_GET['Key'];
$id = base64_decode($id);
foreach ($this->GM->Collection($status = "1", $dealer = "0", $collectedUser_Id = "0", $portal_Id = "0", $process_Id = "0", $amountmode_Id = "0", $CollectionStatus_Id = "0", $id) as $Row) {
?>
    <!-- Content Header (Page header) -->
    <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="callout callout-info row">
                            <h4 class="col-md-4"><b> <?php echo $Row->Collection_no . '(' . $Row->Collection_StatusName . ')'; ?></b></h4>
                            <div class="col-md-8">
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
                                <!-- /.col -->
                                <!-- /.col -->
                                <div class="col-sm-3 invoice-col pull-right">
                                    <br /> <br />
                                    <h2 style="color:#0ea3a9;"><b>Collection</b></h2>
                                    <h4><b><?php echo $Row->Collection_no; ?></b></h4>
                                    <b>Date:</b> <?php echo $Row->Collection_Dateformatted; ?><br>
                                </div>
                            </div>
                            <div class="row invoice-info">
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <b>To:</b>
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
                                                <th>#</th>
                                                <th>Collection</th>
                                                <th>Amount (<?php echo $_SESSION['Currencycode']; ?>)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = "0";
                                            $total = 0.000;
                                            foreach ($this->GM->CollectionAmount($status = "1", $Row->Colletion_Id, $collectionType_Id = "0",$collectionTypeAgainst_Id="0", $Id = "0") as $Products) {
                                                // print_r($Products);
                                                $count++;
                                            ?>
                                                <tr>
                                                    <td><?php echo $count; ?></td>
                                                    <td><?php echo $Products->CollectionTypeName; ?><br>
                                                        <sub><?php echo $Products->Invoice_No; ?></sub>
                                                    </td>
                                                    <td><?php echo $Products->Amount; ?></td>
                                                </tr>
                                            <?php
                                                $total = $this->GM->AddNumberAsFloat($total, $Products->Amount);
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
                                                <td><?php echo $_SESSION['Currencycode'] . ' ' . $total; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-sm-6 pull-left">
                                    <p class="lead"><?php echo $Row->Description; ?></p>
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