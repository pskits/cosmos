<?php
defined('BASEPATH') or exit('No direct script access allowed');
$office = $this->GM->Office($officetype = "0", $status = "1", $Id = "0", $_SESSION['currentdatabasename']);
$office = $office[0];
$bankDetails = $this->GM->Bank($StatusID = "1", $office->Invoice_BankId);
$bankDetails = $bankDetails[0];
$id = $_GET['Key'];
$id = base64_decode($id);
foreach ($this->GM->InvoicePreprint($status_id = 1, $Warehouseid = "0", $Dealer_Id = "0", $salesexecutiveuser_Id = "0", $priority_Id = "0", $Invoice_status_Id = "0", $order_Id = "0", $id) as $Row) {
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="<?php echo base_url('assets/Css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/Css/font-awesome.min.css'); ?>">
<title>Invoice</title>
	<style>
		@page 
		{
			size: A4;
			margin: 15mm 0.5mm 0.5mm 0.5mm;
		}
		p{ margin: 0; }	
		.table-bill td, .table-bill th { border-right: 1px solid  #000; }
		.pad{ padding: 0px 5px; }
	</style>
</head>

<body>
<div class="container">
	<div style="border: 1px solid #000;">
		<table style="width: 100%;">
			<tr style="border-bottom: 1px solid #000;">
			<td style="width: 33.3%;" class="pad">
				<p><b><?php echo $office->office_Name; ?></b></p>
				<p>
				  <?php echo $office->office_address; ?> <?php echo $office->City; ?><br>
					   <?php echo $office->StateName; ?> <?php echo $office->CountryName; ?>
                    TRN: <?php echo $office->office_tax_no; ?><br />
				</p>
			</td>
			<td style="vertical-align: bottom; width: 33.3%;">
				<p align="center"><span  style="background: #000; color: #fff; padding: 5px 5px 3px 5px;"><b>TAX INVOICE</b></span></p>
			</td>
			<td style="width: 33.3%;">
				<div style="text-align: right">
					<img alt="Cosmo pumps" src="<?php echo base_url('assets/Pics/cosmo_pumps.png'); ?>" class="img-thumbnail" style="border: none;">
					<p><i class="fa fa-envelope"></i> care@cosmopumps.com</p>
					<p><i class="fa fa-globe"></i> www.cosmopumps.com</p>
				</div>
			</td>
			</tr>
		</table>
<!-- ***************** { Our Address End } ****************** -->
		<div class="container-fluid" >
			<div style="width:60%;float:left;border-right: 1px solid #000;">
				<p class="pad">Bill To:</p>
				<p style="padding: 20px;">
				   <strong><?php echo $Row->name; ?></strong><br>
				 <?php echo $Row->address; ?><br>
					     <?php echo $Row->city; ?>,   <?php echo $Row->StateName; ?>

                   TRN: <?php echo $Row->tax_no; ?><br />
				</p>
			</div>
			<div style="width:40%;float:left;">
				 <table>
					<tr>
						<!--td style="text-align:center;font-weight:600;" colspan="3"></td-->
						 <tr>
						<td>Invoice</td>
						<td>&nbsp; : &nbsp;</td>
						<td><?php echo $Row->Invoice_No; ?></td>
					</tr>
					</tr>
					 <tr>
						<td>Invoice Date </td>
						<td>&nbsp; : &nbsp;</td>
						<td><?php echo $Row->FormattedInvoiceDate; ?></td>
					</tr>
					<tr>
						<td>Reference </td>
						<td>&nbsp; : &nbsp;</td>
						<td><?php echo $Row->Order_No; ?></td>
					</tr>
					<tr>
						<td>Order Date </td>
						<td>&nbsp; : &nbsp;</td>
						<td><?php echo $Row->FormattedOrderDate; ?>1</td>
					</tr>
				</table>
			</div>	
		</div>
<!-- ***************** { Bill Address End } ****************** -->
		<table class="table-bill" style="width: 100%; border-top: 1px solid #000; border-bottom: 1px solid #000;">
		 	<thead>
				<tr align="center">
					<th>S.No</th>
					<th style="width:450px;">Item & Description</th>
					<th>Qty</th>
					<th>Rate</th>
					<th>Discount</th>
					<th>Tax</th>
					<th style="border-right: none;">Amount</th>
				</tr>				
			</thead>
			<tbody>				
				   <?php $Invoice_Id = $Row->Invoice_Id;
                      $count = "0";
                      $status_id = "1";
                      foreach ($this->GM->InvoiceProduct($status_id, $Invoice_Id) as $Products) {
                        $count++;
                      ?>
                        <tr style="border-top: 1px solid #000;">
                          <td align="center"><?php echo $count; ?></td>
                          <td><?php echo $Products->Product; ?> </td>
                          <td><?php echo $Products->InvoiceProduct_Quantity; ?>
                          </td>
                          <td><?php echo $Products->InvoiceProduct_rate; ?></td>
                          <td><?php echo $Products->InvoiceProduct_discount_total; ?></td>
                          <td><?php echo $Products->InvoiceProduct_tax_total; ?></td>
                          <td style="border-right: none;"><?php echo $Products->InvoiceProduct_subtotal; ?></td>
                        </tr>
						   <tr>
                          <td></td>
                          <td><sub><?php echo $Products->Serial_No; ?> <br/>
						       Due Terms: <?php echo ($Products->CreditPeriod=='0.000') ? 'Immediate' : $Products->CreditPeriod.'Days' ; ?> <br/><br/> </sub>
                       </td>
                          <td> </td>
                          <td></td>
                          <td></td>
                          <td ></td>
                          <td style="border-right: none;"></td>
                        </tr>
                      <?php
                      }
                      ?>
			</tbody>
			<tfoot>
				<tr style="border-top: 1px solid #000;">
					<td class="pad" colspan="2"><?php echo $Row->amountinwords; ?></td>
					<td colspan="5">
						<div>
							<p class="pull-left">Subtotal</p>
							<p class="pull-right"><?php echo $Row->Invoice_subtotal; ?></p>
						</div><br>
						<div style="border-bottom: 1px solid #000;">
							<p class="pull-left">Discount</p>
							<p class="pull-right"><?php echo $Row->Invoice_Discounttotal; ?></p>
						</div><br>
						<div style="border-bottom: 1px solid #000;">
							<p class="pull-left">Tax</p>
							<p class="pull-right"><?php echo $Row->Invoice_taxtotal; ?></p>
						</div><br>
						<div style="border-bottom: 1px solid #000;">
							<p class="pull-left">Round Off</p>
							<p class="pull-right"><?php echo $Row->Invoice_roundoff; ?></p>
						</div><br>
						<div style="border-bottom: 1px solid #000;">
							<p class="pull-left">Total</p>
							<p class="pull-right"><?php echo $Row->Invoice_total; ?></p>
						</div><br>
					</td>
				</tr>
			</tfoot>
		</table>
		<p align="center" style="margin-bottom: 5px;"><span  style="background: #000; color: #fff; padding: 2px 5px 5px 5px;"><b>BANK ACCOUNT DETAILS</b></span></p>
		<div class="container-fluid">
			<div style="width:50%;float:left;">
				<div class="pad">
					<p class="pull-left">Account Name &nbsp; :</p>
					<p>&nbsp; <?php echo $bankDetails->Account_name; ?></p>
				</div>
				<div class="pad">
					<p class="pull-left">Bank Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</p>
				<p>&nbsp; <?php echo $bankDetails->BankName; ?></p>
				</div>
				<div class="pad">
					<p class="pull-left">Branch &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</p>
					<p>&nbsp; <?php echo $bankDetails->branch; ?></p>
				</div>
				<div class="pad">
					<p class="pull-left">IBAN NO &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</p>
					<p>&nbsp; <?php echo $bankDetails->iban_code; ?></p>
				</div>
			</div>
			<div  style="width:50%;float:left;">
				<div>
					<p class="pull-left">Account No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</p>
					<p>&nbsp; <?php echo $bankDetails->account_no; ?></p>
				</div>
				<div>
					<p class="pull-left">Account Type &nbsp;&nbsp; :</p>
					<p>&nbsp; <?php echo $bankDetails->account_type; ?></p>
				</div>
			</div>
		</div>
		<div style="border-top: 1px solid #000;">
		 	<div class="row">				
				<div class="col-md-6 col-sm-6">
					<p style=" margin-top: 30px; padding: 5px;">AGREED & ACCEPTED</p>
				</div>				
				<div class="col-md-6 col-sm-6">
					<p style=" margin-top: 30px; padding: 5px;" align="right"><b>تمت الموافقة عليها وقبولها</b></p>
				</div>
			</div>
		</div>
	</div>
	<p class="pull-left pad">Note : This invoice is subject to the terms & conditions mentioned overleaf</p>
	<p class="pull-right pad"><sup>Computer Generated Signature Resust</sup></p><br>
	<p class="pad"><b>ملاحظة: تخضع هذه الفاتورة للشروط والأحكام المذكورة أعلاه</b></p>
</div>

<!-- Optional JavaScript --> 
<!-- jQuery first, then Popper.js, then Bootstrap JS --> 
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script> 
<script type="text/javascript" src="js/bootstrap.min.js"></script> 
<!--  Won Script  --> 
<script>

</script>
</body>
</html>
<?php
}
?>