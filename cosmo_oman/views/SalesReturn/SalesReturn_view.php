<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
$office = $this->GM->Office($officetype = "0", $status = "1", $Id = "0", $_SESSION['currentdatabasename']);
$office = $office[0];
$id = $_GET['Key'];
$id = base64_decode($id);
foreach ($this->GM->SalesReturn($status_id = 1, $Dealer_Id = "0", $SalesreturnRequest_Id = "0", $SalesreturnRequest_status_Id = "0", $id) as $Row) {
	$title=$Row->SalesReturn_No;
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info row">
              <h4 class="col-md-4"><b> <?php echo $Row->SalesReturn_No . '(' . $Row->SalesReturn_statusName . ')'; ?></b></h4>
              <div class="col-md-8">
                <a href="<?php echo site_url('SalesReturn/SalesReturn'); ?>" style="background-color:#0ea3a9;margin-right:1px;" class="btn btn-flat pull-right"><i class="fa fa-arrow-circle-left"></i> </a>
                <?php if (($Row->SalesReturn_status_Id == '2') && (empty($Row->Replacement))) { ?>
                  <a href="<?php $encodedSalesReturn_Id = base64_encode($Row->SalesReturnRequest_Id);
                            echo site_url("SalesReturn/SalesReturn_PaymentAdjust/?Key=" . $_GET['Key']); ?>" style="background-color:#0ea3a9;margin-right:1px;" class="btn btn-flat pull-right">Payment Adjustment </a>
                <?php }
                ?>
                <!-- SalesReturn Goods Start (Will be Activated when Trip is Completed and Available till Completion Updated in SalesReturnRequest )-->
                <?php
                if ((empty($Row->FormattedSalesReturnRequest_CompletionDate)) && ($Row->TripDeliveriestatus_Id=='3')) { ?>
                  <a href="<?php $encodedSalesReturn_Id = base64_encode($Row->SalesReturnRequest_Id);
                            echo site_url("SalesReturn/SalesReturnGoods_Decide/?Key=$encodedSalesReturn_Id"); ?>" style="background-color:#0ea3a9;margin-right:1px;" class="btn btn-flat pull-right"><i class="fa fa fa-balance-scale"></i> </a>
                <?php }
                ?>
                <!-- SalesReturned Goods Decide end -->
                <!-- Warrenty Replacement is Available till Trip is Made and Replacement Date is in null State -->
                <?php if (($Row->SalesReturn_status_Id == '1') && (empty($Row->Replacement))) {
                ?>
                  <a onclick="askapprovalandinvoice()" style="background-color:#0ea3a9;margin-right:1px;" class="btn btn-flat pull-right"><i class="fa fa-refresh"></i>Warrenty Replacement</a>
                  <!-- <a onclick="askRePay()" style="background-color:#0ea3a9;margin-right:1px;" class="btn btn-flat pull-right"><i class="fa fa-refresh"></i>Re-Pay</a> -->
                <?php
                } ?>
				   
				   
                <a onclick="frames['frame'].print()" style="background-color:#0ea3a9;margin-right:1px;" class="btn btn-flat pull-right"><i class="fa fa-file-pdf-o"></i>PDF</a>
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
                  <h2 style="color:#0ea3a9;"><b>Sales Return</b></h2>
                  <h4><b><?php echo $Row->SalesReturn_No; ?></b> </h4><br>
                  <b>Booking Date:</b> <?php echo $Row->FormattedSAlesReturnBookingDate; ?><br>
                  <b>Sales Return Date:</b> <?php echo $Row->FormattedSalesReturnDate; ?><br>
                  <?php
                  if (!empty($Row->FormattedReplacementDate)) {
                  ?>
                    <b>Replacement Date:</b> <?php echo $Row->FormattedReplacementDate; ?><br>
                  <?php
                  }
                  ?>
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
                        <th>Item</th>
                        <th style="width:300px;">Qty</th>                       
                        <th>Rate</th>
                        <th>Discount</th>
                        <th>Tax</th>
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $count = "0";
                      $invoicable = true;
                      foreach ($this->GM->Get_TransSalesReturnProduct($status_id = "1", $invoice_Id = "0", $Row->SalesReturn_Id) as $Products) {
                        $count++;
                      ?>
                        <tr>
                          <td><?php echo $count; ?></td>
                          <td><?php echo $Products->Invoice_No; ?> </td>
                          <td><?php echo $Products->Product; ?><br>
                          </td>
                          <td><?php echo $Products->SalesReturnProduct_Quantity; ?>
                            <br>
                            <sub>Return: <?php echo $Products->Serial_No; ?></sub>
                          
                            <br>
							<sub>
                            <?php
                            if ($Row->SalesReturn_status_Id == '1') { ?>
                              <?php if ($Products->Available_product_count >= $Products->SalesReturnProduct_Quantity) {
								  echo "Replacement :";
                                if (!empty($Row->Replacement)) {
                                  echo "Applied";
                                } else {
                                  echo "Available";
                                }
                                if ($invoicable == true) {
                                  $invoicable = true;
                                }
                              } else {
                                echo  '<b style="color:red;">Not Available</b>';
                                $invoicable = false;
                              }
                              } elseif (($Row->SalesReturn_status_Id > '1')&&(!empty($Row->Replacement))) {
                              echo "Replacement :".$Products->ReplacementSerial_No;
                            }  ?>
							</sub>
                          </td>
                          <td><?php echo $Products->SalesReturnProduct_rate; ?></td>
                          <td><?php echo $Products->SalesReturnProduct_discount_total; ?></td>
                          <td><?php echo $Products->SalesReturnProduct_tax_total; ?></td>
                          <td><?php echo $Products->SalesReturnProduct_total; ?></td>
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
                        <th style="width:50%">Subtotal:</th>
                        <td><i class="<?php echo $office->Currencycode; ?>"></i> <?php echo $Row->SalesReturn_subtotal; ?></td>
                      </tr>
                      <tr>
                        <?php
                        $ttl = $Row->SalesReturn_subtotal;
                        ?>
                        <th>Tax Total</th>
                        <td> <i class="<?php echo $office->Currencycode; ?>"></i> <?php echo $Row->SalesReturn_taxtotal; ?></td>
                      </tr>
                      <tr>
                        <th>Discount:</th>
                        <td><i class="<?php echo $office->Currencycode; ?>"></i> <?php echo $Row->SalesReturn_Discounttotal; ?></td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td><i class="<?php echo $office->Currencycode; ?>"></i> <?php echo $Row->SalesReturn_total; ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="col-sm-6 pull-left">
                  <p class="lead"><?php echo $Row->SalesReturn_reason; ?></p>
                </div>
                <!-- /.col -->
              </div>
              <?php
              $Excess = 0.000;
              //Option to be Enabled only after Approval
              $approval = False;
              if ((isset($Row->Invoice_Id)) && ($Row->SalesReturn_status_Id == '1') && ($approval)) { ?>
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Invoice No</th>
                        <th>Invoice Amount </th>
                        <th>Collection Amount</th>
                        <th>Sales Return Amount Till Now</th>
                        <th>This Sales Return Amount</th>
                        <th>Amount To be Debitted to Dealer</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($this->GM->InvoiceAgainst_AmountInfo($Row->Invoice_Id) as $InvoiceAmountInfo) {
                      ?>
                        <tr>
                          <td><?php echo $InvoiceAmountInfo->Invoice_No; ?></td>
                          <td><?php echo $InvoiceAmountInfo->Invoice_total; ?></td>
                          <td><?php echo $InvoiceAmountInfo->Collection_Amount; ?>
                          <td><?php echo $InvoiceAmountInfo->SalesReturnPayed_Amount; ?></td>
                          <td><?php echo $Row->SalesReturn_total; ?></td>
                          <td>
                          <?php
                          $AdjustmentAmount = number_format(($InvoiceAmountInfo->Collection_Amount) - ($Row->SalesReturn_total + $InvoiceAmountInfo->SalesReturnPayed_Amount), 3);
                        }
                        if ($InvoiceAmountInfo->Collection_Amount > $InvoiceAmountInfo->Invoice_total) {
                          echo "Contact System Admin";
                        }
                        $AdjustmentAmount = ($AdjustmentAmount > '0.00') ? $AdjustmentAmount : '0.000';
                        echo $AdjustmentAmount; ?></td>
                        </tr>
                    </tbody>
                  </table>
                </div>
            </div>
          <?php } else {
                $AdjustmentAmount = $Row->SalesReturn_total;
              } ?>
          <!-- /.row -->
          <!-- this row will not appear when printing -->
          </div>
          <!-- /.invoice -->
        </div><!-- /.col -->
      </div><!-- /.row -->
  </div><!-- /.container-fluid -->
  </section>
  
  <iframe style="width:0px;height:0px;" src="<?php echo site_url('SalesReturn/SalesReturnPrint/?Key=' . $_GET['Key']); ?>" name="frame"></iframe>
  <!-- /.content -->
  <section class="content">
      <div class="invoice p-3 mb-3">
        <!-- title row -->

        <!-- info row -->
        <div class="row invoice-info">
          <hr class="horizondal-splitter">
          <div class="box-header with-bInvoice">
            <h3 class="box-title">Payment Adjustment Details</h3>
          </div>
          <div class="box-body">
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
                foreach ($this->GM->SalesreturnPaymnetInfo($id) as $paymentAdjustmentInfo) {
                ?>
                  <tr> 
                    <td><a href="<?php echo site_url($paymentAdjustmentInfo->Link). base64_encode($paymentAdjustmentInfo->pyI_id);?>">
                     <?php echo $paymentAdjustmentInfo->code; ?></a></td>
                    <td><?php echo $paymentAdjustmentInfo->formattedDate; ?></td>
                    <td><?php echo $paymentAdjustmentInfo->amount; ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php
  if ($Row->SalesReturn_status_Id == '1') {
    if ($invoicable) {
  ?>
      <script>
        function askapprovalandinvoice() {
          var r = confirm("This action will Approve and Makes a Replacement for this order !");
          if (r == true) {
            document.getElementById("approveandinvoice_form").submit();
          }
        }
      </script>
      <form id="approveandinvoice_form" method="POST" action="<?php echo site_url('SalesReturn/SalesReturnReplacement_Save'); ?>">
        <input type="hidden" name="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
        <input type="hidden" name="SalesReturn_Id" id="Order_Id" value="<?php echo $Row->SalesReturn_Id ?>" />
      </form>
    <?php
    } else {
    ?>
      <script>
        function askapprovalandinvoice() {
          alert("Replacement is not Possible Required Products Quantity is Not Available!");
        }
      </script>
    <?php
    }
    ?>
    <script>
      function askRePay() {
        var r = confirm("This action will Debit(<?php echo $AdjustmentAmount; ?>) Amount against this SalesReturn!");
        if (r == true) {
          document.getElementById("DebitAgainstSalesReturn_form").submit();
        }
      }
    </script>
    <form id="DebitAgainstSalesReturn_form" method="POST" action="<?php echo site_url('Collection/DebitAgainstSalesReturn'); ?>">
      <input type="hidden" name="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
      <input type="hidden" name="SalesReturn_Id" id="SalesReturn_Id" value="<?php echo $Row->SalesReturn_Id ?>" />
      <input type="hidden" name="SalesReturn_No" id="Order_Id" value="<?php echo $Row->SalesReturn_No ?>" />
      <input type="hidden" name="amount" value="<?php echo $AdjustmentAmount; ?>" />
      <input type="hidden" name="Debits_Type_Id" value="2" />
    </form>
	
<?php
  }
}
?>
<?php include('Includes/Foot.php'); ?>