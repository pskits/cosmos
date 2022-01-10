<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
$office = $this->GM->Office($officetype = "0", $status = "1", $Id = "0", $_SESSION['currentdatabasename']);
$office = $office[0];
$bankDetails = $this->GM->Bank($StatusID = "1", $office->Invoice_BankId);
$bankDetails = $bankDetails[0];
$id = $_GET['Key'];
$id = base64_decode($id);
foreach ($this->GM->Invoice($status_id = 1, $Warehouseid = "0", $Dealer_Id = "0", $salesexecutiveuser_Id = "0", $priority_Id = "0", $Invoice_status_Id = "0", $order_Id = "0", $id) as $Row) {
 $title=$Row->Invoice_No;
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info row">
              <h4 class="col-md-4"><b> <?php echo $Row->Invoice_No . '(' . $Row->invoice_status_Name . ')'; ?></b></h4>
              <div class="col-md-8">
                <a onclick="frames['frame'].print()" style="background-color:#0ea3a9;margin-right:1px;" class="btn btn-flat pull-right"><i class="fa fa-file-pdf-o"></i> PDF</a>
<a onclick="frames['PreprintedInvoice'].print()" style="background-color:#0ea3a9;margin-right:1px;" class="btn btn-flat pull-right"><i class="fa fa-file-pdf-o"></i> Pre - Print</a>

                <a href="<?php echo site_url('Sales/Invoice'); ?>" style="background-color:#0ea3a9;margin-right:1px;" class="btn btn-flat pull-right"><i class="fa fa-arrow-circle-left"></i> </a>
              <?php
                if ($Row->Invoice_status_Id < '3') {
                ?>
                   <a onclick="askinvoicecancel()" style="background-color:#0ea3a9;margin-right:1px;" class="btn btn-flat pull-right"><i class="fa fa-refresh"></i> Cancel </a>
                  <script>
        function askinvoicecancel() {
          var r = confirm("This action will Cancel this Invoice and Return the Goods if Loaded and Skips its Trip Delivery Status !");
          if (r == true) {
            document.getElementById("askinvoicecancel_form").submit();
          }
        }
      </script>
      <form id="askinvoicecancel_form" method="POST" action="<?php echo site_url('Sales/Invoice_Status'); ?>">
        <input type="hidden" name="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
        <input type="hidden" name="Invoice_Status_Id" id="Order_Status_Id" value="4" />
        <input type="hidden" name="Invoice_Id" id="Invoice_Id" value="<?php echo $Row->Invoice_Id ?>" />
      </form>
				<?php
                }
                ?>
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
                    <?php echo $office->office_address; ?> <?php echo $office->City; ?><br>
					   <?php echo $office->StateName; ?> <?php echo $office->CountryName; ?>
                    TRN: <?php echo $office->office_tax_no; ?><br />
                   
                  </address>
                </div>
                <!-- /.col -->
                <!-- /.col -->
                <div class="col-sm-3 invoice-col pull-right">
                  <br /> <br />
                  <h2 style="color:#0ea3a9;"><b>TAX INVOICE</b></h2>
                  <h4><b><?php echo $Row->Invoice_No; ?></b> for <b><?php echo $Row->Order_No; ?></b> </h4><br>
                  <br>
                  <b>Invoice Date:</b> <?php echo $Row->FormattedInvoiceDate; ?><br>
                </div>
              </div>
              <div class="row invoice-info">
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Bill To
                  <address>
                    <strong><?php echo $Row->name; ?></strong><br>
                    <p style="width:70%;margin:0px;">	
					
                      <?php echo $Row->address; ?>,  <?php echo $Row->AreaName; ?><br>
					     <?php echo $Row->city; ?>,   <?php echo $Row->StateName; ?>
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
                  <table class="table invoice-table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Item</th>
						<th style="width:20%;">Description</th>
                        <th>Qty</th>
                        <th>Rate</th>
                        <th>Discount</th>
                        <th>Tax</th>
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $Invoice_Id = $Row->Invoice_Id;
                      $count = "0";
                      $status_id = "1";
                      foreach ($this->GM->InvoiceProduct($status_id, $Invoice_Id) as $Products) {
                        $count++;
                      ?>
                        <tr>
                          <td><?php echo $count; ?></td>
                          <td><?php echo $Products->Product; ?><br>
                            <sub><?php echo $Products->Serial_No; ?></sub>
                            <br>
							  <sub>Due Terms: <?php echo ($Products->CreditPeriod=='0.00') ? 'Immediate' : $Products->CreditPeriod.'Days' ; ?> </sub>
                         
                          </td>
						   <td><?php echo $Products->Description; ?></td>
                          <td><?php echo $Products->InvoiceProduct_Quantity; ?>
                          </td>
                          <td><?php echo $Products->InvoiceProduct_rate; ?></td>
                          <td><?php echo $Products->InvoiceProduct_discount_total; ?></td>
                          <td><?php echo $Products->InvoiceProduct_tax_total; ?></td>
                          <td><?php echo $Products->InvoiceProduct_total; ?></td>
                        </tr>						
                      <?php
                      }
                      ?>
					  <!--tr><td colspan="7">Description:  &nbsp <?php //echo $Row->Invoice_Description; ?></td></tr-->
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <div class="row">
                <!-- accepted payments column -->
                <!-- /.col -->
                <div class="col-sm-4 pull-right">
                  <div class="table-responsive">
                    <table class="table table-total">
                      <tr>
                        <td style="width:50%">Subtotal:</td>
                        <td><i class="<?php echo $office->Currencycode; ?>"></i> <?php echo $Row->Invoice_subtotal; ?></td>
                      </tr>
                      <tr>
                        <td>Discount:</td>
                        <td><i class="<?php echo $office->Currencycode; ?>"></i> <?php echo $Row->Invoice_Discounttotal; ?></td>
                      </tr>
					  <tr>
                        
                        <td>Tax Total</td>
                        <td> <i class="<?php echo $office->Currencycode; ?>"></i> <?php echo $Row->Invoice_taxtotal; ?></td>
                      </tr>
                       <tr>
                        
                        <td>Round Off</td>
                        <td> <i class="<?php echo $office->Currencycode; ?>"></i> <?php echo $Row->Invoice_roundoff; ?></td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <th style="padding: 0px;"><i class="<?php echo $office->Currencycode; ?>"></i> <?php echo $Row->Invoice_total; ?></th>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="col-sm-8 pull-left">
                  <strong>BANK ACCOUNT DETAILS </strong><br>
                  <table style="color:#7d7d7d;" class="table table-borderless">
                    <tr>
                      <td style="width:30%">Account Name</td>
                      <td><?php echo $bankDetails->Account_name; ?></td>
                    </tr>
                    <tr>
                      <td>Bank Name</td>
                      <td><?php echo $bankDetails->BankName; ?></td>
                    </tr>
                    <tr>
                      <td>Branch</td>
                      <td><?php echo $bankDetails->branch; ?></td>
                    </tr>
                    <tr>
                      <td>Account No</td>
                      <td><?php echo $bankDetails->account_no; ?></td>
                    </tr>
                    <tr>
                      <td>Account Type</td>
                      <td><?php echo $bankDetails->account_type; ?></td>
                    </tr>
                    <tr>
                      <td>Branch Code</td>
                      <td><?php echo $bankDetails->Bankcode; ?></td>
                    </tr>
                    <tr>
                      <td>IBAN No</td>
                      <td><?php echo $bankDetails->iban_code; ?></td>
                    </tr>
                  </table>
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
                foreach ($this->GM->InvoicePaymnetInfo($id) as $paymentAdjustmentInfo) {
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
  <iframe style="width:0px;height:0px;" src="<?php echo site_url('Sales/InvoicePrint/?Key=' . $_GET['Key']); ?>" name="frame"></iframe>
  <iframe style="width:0px;height:0px;" src="<?php echo site_url('Sales/PreprintedInvoice/?Key=' . $_GET['Key']); ?>" name="PreprintedInvoice"></iframe>

  
<?php
}
?>
<?php include('Includes/Foot.php'); ?>