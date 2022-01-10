<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
$id = $_GET['Key'];
$id = base64_decode($id);
foreach ($this->GM->Settlement($status = "1", $SettlementedUser_Id = "0", $ColectedUser_Id = "0", $amountmode_Id = "0", $id, '', '') as $Row) {
?>
    <!-- Content Header (Page header) -->
    <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="callout callout-info row">
                            <h4 class="col-md-4"><b> <?php echo $Row->Settlement_no ; ?></b></h4>
                           
                        </div>
                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-6 invoice-col">
                                    <img src="<?php echo base_url('assets/Pics/cosmo_pumps.png'); ?>" class="invoice-logo" alt="Cosmo Pumps">
                                </div><div class="col-sm-6 invoice-col">&nbsp;</div>
                            </div>
                            <div class="row invoice-info">
                                <div class="col-sm-2 invoice-col">
                                    <br /> <br />
                                    <address>
                                        Settled To <br>
                                        Collected By <br />                                       
                                    </address>
                                </div>
                                <div class="col-sm-6 invoice-col">
                                    <br /> <br />
                                    <address>
                                        : <strong><?php echo $Row->SettlementedUser; ?></strong><br>
                                        : <strong><?php echo $Row->CollectedUser; ?></strong><br>                                     
                                    </address>
                                </div>
                                <!-- /.col -->
                                <!-- /.col -->
                                <div class="col-sm-3 invoice-col pull-right">
                                    <h2 style="color:#0ea3a9;"><b>Settlement</b></h2>
                                    <h4><b><?php echo $Row->Settlement_no; ?></b></h4>
                                    <b>Date:</b> <?php echo $Row->Settlement_Dateformatted; ?><br>
                                </div>
                            </div>
                            <br><br><br>
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
                                            foreach ($this->GM->SettlementCollection($status = "0", $Row->Settlement_Id = "0",  $Id = "0") as $Products) {
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