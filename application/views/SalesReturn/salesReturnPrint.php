<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
$office = $this->GM->Office($officetype = "0", $status = "1", $Id = "0", $_SESSION['currentdatabasename']);
$office = $office[0];
$id = $_GET['Key'];
$id = base64_decode($id);
foreach ($this->GM->SalesReturn($status_id = 1, $Dealer_Id = "0", $SalesreturnRequest_Id = "0", $SalesreturnRequest_status_Id = "0", $id) as $Row) {
	 $title=$Row->SalesReturn_No;
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
            <div class="container">
              <div class=" table-responsive">
              <table class="table  table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Invoice</th>
                        <th >Item</th>
                        <th style="width:150px;">Qty</th>
                        <th>Rate</th>
                        <th>Discount</th>
                        <th>Tax</th>
                        <th style="text-align:right;">Amount</th>
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
                            <sub>Return:<?php echo $Products->Serial_No; ?></sub>
							<br>
							  <sub>Replacement : <?php echo $Products->ReplacementSerial_No; ?></sub>
                          </td>
                          <td><?php echo $Products->SalesReturnProduct_rate; ?></td>
                          <td><?php echo $Products->SalesReturnProduct_discount_total; ?></td>
                          <td><?php echo $Products->SalesReturnProduct_tax_total; ?></td>
                          <td style="text-align:right;"><?php echo $Products->SalesReturnProduct_total; ?></td>
                        </tr>
                      <?php
                      }
                      ?>
                    </tbody>				
				<tfoot>
                   
					<tr>
					 <td style="border:none;" colspan="5"></td>
					  <td style="border-top:1px solid #555;text-align:right;" ><b> Subtotal </b></td>					 
                      <td style="border-top:1px solid #555;text-align:right;" colspan="2"><?php echo $Row->SalesReturn_subtotal; ?></td>
                    </tr>
                    <tr>  <td style="border:none;" colspan="5"></td>
					  <td style="border:none;text-align:right;"><b>Tax Total</b></td>
					 
                      <td style="border:none;text-align:right;" colspan="2">  <?php echo $Row->SalesReturn_taxtotal; ?></td>
                    </tr>
                    <tr>   <td style="border:none;" colspan="5"></td>
					  <td style="border:none;text-align:right;" ><b>Discount</b></td>
					  
                      <td style="border:none;text-align:right;" colspan="2"> <?php echo $Row->SalesReturn_Discounttotal; ?></td>
                    </tr>
                
                    <tr>  <td style="border:none;" colspan="5"></td>
					  <td style="border:none;text-align:right;background-color:#afafaf;" ><b>Total</b></td>
					 
                      <td style="border:none;background-color:#afafaf;text-align:right;" colspan="2"> <?php echo $Row->SalesReturn_total; ?></td>
                    </tr>
				
					
					 </tfoot>
                  </table>
              </div>
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