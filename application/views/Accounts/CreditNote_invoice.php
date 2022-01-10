<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
$office = $this->GM->Office($officetype = "0", $status = "1", $Id = "0", $_SESSION['currentdatabasename']);
$office = $office[0];
$id = $_GET['Key'];
$id = base64_decode($id);
foreach ($this->GM->CrediNote($status = "1", $dealer = "0", $CreditNoteUser_Id = "0", $CreditNoteStatus_Id = "0", $id, $from_date = '', $to_date = '')as $Row) {
?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="callout callout-info row">
                            <h4 class="col-md-4"><b> <?php echo $Row->Creditnote_no ; ?></b></h4>
                            <div class="col-md-8">
							<a href="<?php echo site_url('Accounts/CreditNote_View'); ?>" style="background-color:#0ea3a9;margin-right:1px;" class="btn btn-flat pull-right"><i class="fa fa-arrow-circle-left"></i> </a>
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
                                        <?php echo $office->office_address; ?><br />
                                        TRN: <?php echo $office->trn_no; ?><br />                                     
                                    </address>
                                </div>
                                <!-- /.col -->
                                <!-- /.col -->
                                <div class="col-sm-3 invoice-col pull-right">
                                    <br /> <br />
                                    <h2 style="color:#0ea3a9;"><b>Credit Note</b></h2>
                                    <h4><b><?php echo $Row->Creditnote_no; ?></b></h4>
                                    <b>Date:</b> <?php echo $Row->Creditnote_Dateformatted; ?><br>                                   
                                </div>
                            </div>
                            <div class="row invoice-info">
                                <!-- /.col -->
								                <div class="col-sm-4 invoice-col">
                   To
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
                                                    <th>Payment No</th>
                                                    <th>Payment Date</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $total = 0;
                                                foreach ($this->GM->CrediNotePaymentAdjustment($id,$toid="0") as $paymentAdjustmentInfo) {                                                  
                                                ?>
                                                    <tr>
                                                        <td><a href="<?php echo site_url($paymentAdjustmentInfo->Link) . base64_encode($paymentAdjustmentInfo->pyI_id); ?>">
                                                                <?php echo $paymentAdjustmentInfo->code; ?></a></td>
                                                        <td><?php echo $paymentAdjustmentInfo->formattedDate; ?></td>
                                                        <td><?php echo $paymentAdjustmentInfo->amount; ?></td>
                                                    </tr>
                                                <?php } ?>
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
        <!-- /.content -->
    </div>
<?php
}
?>
<?php include('Foot.php'); ?>