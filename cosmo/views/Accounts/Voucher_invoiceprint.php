<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');

$office = $this->GM->Office($officetype = "0", $status = "1", $Id = "0", $_SESSION['currentdatabasename']);
$office = $office[0];
$id = $_GET['Key'];
$id = base64_decode($id);
foreach ($this->GM->Voucher($status = "1", $DebitedUser_Id = "0", $portal_Id = "0", $VoucherType_Id = "0", $amountmode_Id = "0",  $id,  $from_date = '', $to_date = '') as $Row) { ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="callout callout-info row">
                            <h4 class="col-md-4"><b> <?php echo $Row->Voucher_no.'('.$Row->AmountModeName.')'; ?></b></h4>
                        
                        </div>
                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <!-- <div class="col-12">
                  <h4>
                    <i class="fa fa-globe"></i> AdminLTE, Inc.
                    <small class="float-right">Date: 2/10/2014</small>
                  </h4>
                </div> -->
                                <!-- /.col -->
                            </div>
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
                                    <h2 style="color:#0ea3a9;"><b>Voucher</b></h2>
                                    <h4><b><?php echo $Row->Voucher_no.'('.$Row->AmountModeName.')'; ?></b></h4>
                                    <b>Date:</b> <?php echo $Row->VoucherDate_Dateformatted; ?><br>
                                </div>
                            </div>
                            <div class="row invoice-info">
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">

                                </div>
                            </div>
                            <!-- /.row -->
                            <!-- Table row -->
                            <div class="row">
                                <?php if ($Row->VoucherSource_Id == 4) { ?>
                                    <div class="col-12 table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Account</th>
                                                    <th>Description</th>
                                                    <th>Amount (<?php echo $_SESSION['Currencycode']; ?>)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $count = "0";
                                                $total = 0.00;
                                                foreach ($this->GM->VoucherAmount($status = "1", $Row->Voucher_Id, $Id = "0") as $Products) {
                                                    $count++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $count; ?></td>
                                                        <td><?php echo $Products->Ledgername;  ?></td>
                                                        <td><?php echo $Products->Reference;  ?></td>
                                                        <td><?php echo $Products->amount; ?></td>
                                                    </tr>
                                                <?php
                                                    if ($Products->amount > '0') {
                                                        $total = $this->GM->AddNumberAsFloat($total, $Products->amount);
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-12 table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Payment No</th>
                                                    <th>Payment Date</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $total = 0;
                                                foreach ($this->GM->VoucherPaymentInfo($id) as $paymentAdjustmentInfo) {
                                                    $total +=$paymentAdjustmentInfo->amount;
                                                ?>
                                                    <tr>
                                                        <td>
                                                                <?php echo $paymentAdjustmentInfo->code; ?></td>
                                                        <td><?php echo $paymentAdjustmentInfo->formattedDate; ?></td>
                                                        <td><?php echo $paymentAdjustmentInfo->amount; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } ?>
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
        <!-- /.content -->
    </div><?php
}
?>