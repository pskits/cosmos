<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
$office = $this->GM->Office($officetype = "0", $status = "1", $Id = "0", $_SESSION['currentdatabasename']);
$office = $office[0];
$bankDetails = $this->GM->Bank($StatusID = "1", $office->Invoice_BankId);
$bankDetails = $bankDetails[0];
$id = $_GET['Key'];
$id = base64_decode($id);
foreach ($this->GM->InvoicePreprint($status_id = 1, $Warehouseid = "0", $Dealer_Id = "0", $salesexecutiveuser_Id = "0", $priority_Id = "0", $Invoice_status_Id = "0", $order_Id = "0", $id) as $Row) {
 $title=$Row->Invoice_No;
?>

  <!-- Content Header (Page header) -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          
          <!-- Main content -->
          <div class="invoice p-3 mb-3">
            <!-- title row -->
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-6 invoice-col">
                <img src="<?php echo base_url('assets/Pics/cosmo_pumps.png'); ?>" class="invoice-logo" alt="Cosmo Pumps">
                <address>
                    <strong><?php echo $office->office_Name; ?></strong><br>
                    <?php echo $office->office_address; ?>,,  <?php echo $Row->AreaName; ?> <br> <?php echo $office->City; ?><br>
					   <?php echo $office->StateName; ?> <?php echo $office->CountryName; ?>
                    TRN: <?php echo $office->office_tax_no; ?><br />
                   
                  </address>
              </div>
              <!-- /.col -->
              <!-- /.col -->
              <div class="col-sm-3 invoice-col pull-right">
                <br /> <br />
                <h2 style="color:#0ea3a9;"><b>TAX INVOICE</b></h2>
                <h4><b><?php echo $Row->Invoice_No; ?></b></h4><br>
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
				  <?php echo $Row->address; ?><br>
					     <?php echo $Row->city; ?>,   <?php echo $Row->StateName; ?>
                  </p>
                  Phone:<?php echo $Row->mobile; ?><br>
                   TRN: <?php echo $Row->tax_no; ?><br />
                </address>
              </div>
            </div>
            <!-- /.row -->
            <!-- Table row -->
            <div class="container">
              <div class=" table-responsive">
              <table class="table  table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th style="width:300px;">Item</th>
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
                          <td><?php echo $Products->InvoiceProduct_Quantity; ?>
                          </td>
                          <td><?php echo $Products->InvoiceProduct_rate; ?></td>
                          <td><?php echo $Products->InvoiceProduct_discount_total; ?></td>
                          <td><?php echo $Products->InvoiceProduct_tax_total; ?></td>
                          <td><?php echo $Products->InvoiceProduct_subtotal; ?></td>
                        </tr>
                      <?php
                      }
                      ?>
                    </tbody>
</table>
 <table class="table  table-striped">				
				<tbody>
                    <tr>
					
					<td style="border:none;" colspan="7">
					<br>
					  <strong>BANK ACCOUNT DETAILS </strong>
					</td>
					</tr>
					<tr>
					 <td style="border:none;">Account Name</td>
                      <td style="border:none;"><?php echo $bankDetails->Account_name; ?></td>
					  <td style="border-top:1px solid #555;text-align:right;" colspan="4"><b> Subtotal </b></td>					 
                      <td style="border-top:1px solid #555;"><?php echo $Row->Invoice_subtotal; ?></td>
                    </tr>
                    <tr>
                      
                      <td style="border:none;">Bank Name</td>
                      <td style="border:none;"><?php echo $bankDetails->BankName; ?></td>
					  <td style="border:none;text-align:right;" colspan="4"><b>Tax Total</b></td>
					 
                      <td style="border:none;">  <?php echo $Row->Invoice_taxtotal; ?></td>
                    </tr>
                    <tr><td style="border:none;">Branch</td>
                      <td style="border:none;"><?php echo $bankDetails->branch; ?></td>
					  <td style="border:none;text-align:right;" colspan="4"><b>Discount</b></td>
					  
                      <td style="border:none;"> <?php echo $Row->Invoice_Discounttotal; ?></td>
                    </tr>
                
                    <tr><td style="border:none;">Account No </td>
                      <td style="border:none;"><?php echo $bankDetails->account_no; ?></td>
					  <td style="border:none;text-align:right;background-color:#afafaf;" colspan="4"><b>Total</b></td>
					 
                      <td style="border:none;background-color:#afafaf;"> <?php echo $Row->Invoice_total; ?></td>
                    </tr>
					 <tr><td style="border:none;">Account Type </td>
                      <td style="border:none;"><?php echo $bankDetails->account_type; ?></td>
					  <td style="border:none;text-align:right;" colspan="5"></td>
                    </tr>
					 <tr><td style="border:none;">Branch Code </td>
                      <td style="border:none;"><?php echo $bankDetails->Bankcode; ?></td>
					  <td style="border:none;text-align:right;" colspan="5"></td>
                    </tr>
					 <tr><td style="border:none;">IBAN No </td>
                      <td style="border:none;"><?php echo $bankDetails->iban_code; ?></td>
					  <td style="border:none;text-align:right;" colspan="5"></td>
                    </tr>
					 </tbody>
                  </table>
              </div>
			  <br><br>
			  <h4 style="text-align:center;width:100%;">Thank You for Your Business!</h4>
              <!-- /.col -->
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
<?php
}
?>
<style>
  @page {
    size: auto;
    margin: 0mm;
  }

  @media print {
    table {
      page-break-inside: avoid;
    }
  }
</style>