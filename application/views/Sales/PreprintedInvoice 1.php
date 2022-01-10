<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
$office = $this->GM->Office($officetype = "0", $status = "1", $Id = "0", $_SESSION['currentdatabasename']);
$office = $office[0];
$bankDetails = $this->GM->Bank($StatusID = "1", $office->Invoice_BankId);
$bankDetails = $bankDetails[0];
$id = $_GET['Key'];
$id = base64_decode($id);
foreach ($this->GM->InvoicePreprint($status_id = 1, $Warehouseid = "0", $Dealer_Id = "0", $salesexecutiveuser_Id = "0", $priority_Id = "0", $Invoice_status_Id = "0", $order_Id = "0", $id) as $Row) {
?>
  <!-- Content Header (Page header) -->
  <section class="content">
    <div class="container">
      <div class="container">
        <!-- Main content -->
        <div class="invoice ">
          <!-- title row -->
          <!-- info row -->
          <div class="row invoice-info">           
            <br /> <br />
            <br /> <br />
            <br /> <br />
            <div class="col-sm-10 pull-left">
              <br /> <br />
              <address>
                <strong><?php echo $Row->name; ?></strong><br>
                <?php echo $Row->address; ?><br>
                <?php echo $Row->city; ?>,<?php echo $Row->StateName; ?><br>
                TRN: <?php echo $Row->tax_no; ?><br />
              </address>
            </div>
            <!-- /.col -->
            <!-- /.col -->
            <div style="text-align: left;padding-right:70px;  " class="col-sm-2 pull-right">
              <h4 style=""><b><?php echo $Row->Invoice_No_Id; ?></b></h4>
              <h5 style="line-height :20px;"><?php echo $Row->FormattedInvoiceDate; ?></h5>
              <h5 style="line-height :20px;"><?php echo $Row->Order_No; ?></h5>
              <h5 style="line-height :20px;"><?php echo $Row->FormattedOrderDate; ?></h5>
            </div>
          </div>
          <!-- /.row -->
          <!-- Table row -->
          <br><br><br>
            <table class="table table-noborder ">
              <tbody>
                <?php
                $count = "0";
                foreach ($this->GM->InvoiceProduct($status_id = 1, $Row->Invoice_Id) as $Products) {
                  $count++;
                ?>
                  <tr>
                    <td style="width:30px;"><?php echo $count; ?></td>
                    <td style="width: 350px; padding: 0px 0px 5px 20px;">
                      <?php echo $Products->Product; ?><br>
                      <span><?php echo $Products->Serial_No; ?></span>
                      <br>
                      <sub>Due Term: <?php echo intval($Products->CreditPeriod); ?> Days</sub>
                    </td>
                    <td><?php echo $Products->InvoiceProduct_Quantity; ?></td>
                    <td><?php echo $Products->InvoiceProduct_rate; ?></td>
                    <td><?php echo $Products->InvoiceProduct_discount_total; ?></td>
                    <td><?php echo $Products->InvoiceProduct_tax_total; ?></td>
                    <td><?php echo $Products->InvoiceProduct_total; ?></td>
                  </tr>
                <?php
                }
                $balance = 10 - $count;
                for($i=0;$i<=$balance;$i++)
                {?>
<tr style="height: 19px;">
<td></td><td></td><td></td>
</tr>
                <?php }
                ?>
              </tbody>
            </table>
          
          <!-- /.col -->
          <!-- /.row -->
          <div class="row">
            <!-- accepted payments column -->
            <!-- /.col -->
            <div class="col-sm-6 pull-right">
              <div class="">
                <table class="table table-borderless">
                  <tr>
                    <td class=""><?php echo $Row->Invoice_subtotal; ?></td>
                  </tr>
                  <tr >
                                     
                    <td style="line-height :20px; padding-Top:20px; padding-bottom:20px;" class="">  <?php echo $Row->Invoice_taxtotal; ?></td>
                  </tr>
                  <tr>
                    <td style="line-height :20px; padding-bottom:20px;" class=""> <?php echo $Row->Invoice_Discounttotal; ?></td>
                  </tr>
                  <tr>
                    <td style="line-height :20px; padding-bottom:20px;" class=""> <?php echo $Row->Invoice_total; ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-6 pull-left">
              <div class="">
                <table class="table table-borderless">
                  <tr>
                    <td><?php echo $Row->amountinwords; ?></td>
                  </tr>
                  <tr >
                  </tr></table></div></div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          <!-- this row will not appear when printing -->
        </div>
        <!-- /.invoice -->
      </div><!-- /.col -->
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
  .table>thead>tr>th {
    border-bottom: none;
  }
  .table>thead>tr {
    border: none;
  }
  .table,
  thead,
  th {
    background-color: #fff;
  }
  body{
    font-size: 14px;
  }
</style>
<script>
  rendercurrencyformat();
      function rendercurrencyformat() {
      // Get all the "row_data" elements into an array
      let cells = Array.prototype.slice.call(document.querySelectorAll(".Currency"));
      // Loop over the array
      cells.forEach(function(cell) {
        // Convert cell data to a number, call .toLocaleString()
        // on that number and put result back into the cell
        // cell.textContent = (+cell.textContent).toLocaleString('en-US', { style: 'currency', currency: '' });
        if ((!isNaN(cell.textContent)) && ((cell.textContent)))
          cell.textContent = new Intl.NumberFormat('en-IN').format(parseFloat(cell.textContent));
      });
    }
</script>