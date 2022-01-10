<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
$office = $this->GM->Office($officetype = "0", $status = "1", $Id = "0", $_SESSION['currentdatabasename']);
$office = $office[0];
$id = $_GET['Key'];
$id = base64_decode($id);
foreach ($this->GM->Orderlist($status_id = 1, $Warehouseid = "0", $Dealer_Id = "0", $salesexecutiveuser_Id = "0", $priority_Id = "0", $Order_status_Id = "0", $id) as $Row) {
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info row">
              <h4 class="col-md-4"><b> <?php echo $Row->Order_No . '(' . $Row->Order_status_Name . ')'; ?></b></h4>
              <div class="col-md-8">
                <?php
                if ($Row->Order_status_Id == '3') {
                ?>
               <a onclick="askapprovalandinvoice()" style="background-color:#0ea3a9;margin-right:1px;" class="btn btn-flat pull-right"><i class="fa fa-refresh"></i> Invoice </a>
                <?php
                }
                ?>
                <a onclick="frames['frame'].print()" style="background-color:#0ea3a9;margin-right:1px;" class="btn btn-flat pull-right"><i class="fa fa-file-pdf-o"></i> PDF</a>
                <a href="<?php echo site_url('Sales/Orderlist_ReadyforTrip'); ?>" style="background-color:#0ea3a9;margin-right:1px;" class="btn btn-flat pull-right"><i class="fa fa-arrow-circle-left"></i> </a>

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
                  <h2 style="color:#0ea3a9;"><b>Sales Order</b></h2>
                  <h4><b><?php echo $Row->Order_No; ?></b></h4><br>
                  <br>
                  <b>Order Date:</b> <?php echo $Row->FormattedOrderDate; ?><br>
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
                    TRN: <?php echo $Row->tax_no; ?><br />
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
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Rate</th>
                        <th>Discount</th>
                        <th>Tax</th>
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $Order_Id = $Row->Order_Id;
                      $count = "0";
                      $status_id = "1";
                      $invoicable = true;
                      foreach ($this->GM->OrderlistProduct($status_id, $Order_Id) as $Products) {
                        $count++;
                      ?>
                        <tr>
                          <td><?php echo $count; ?></td>
                          <td><?php echo $Products->Product; ?><br>
                          <sub>Due Terms: <?php echo ($Products->CreditPeriod=='0.00') ? 'Immediate' : $Products->CreditPeriod.'Days' ; ?> </sub>
                          </td>
                          <td><?php echo $Products->OrderProduct_Quantity; ?><br>
                            <?php
                            if ($Row->Order_status_Id == '3') { ?>
                              <sub><?php if ($Products->Available_product_count >= $Products->OrderProduct_Quantity) {
                                      echo "Available";
                                      if ($invoicable == true) {
                                        $invoicable = true;
                                      }
                                    } else {
                                      echo  '<b style="color:red;">Not Available</b>';
                                      $invoicable = false;
                                    }
                                    ?></sub>
                            <?php } ?>
                          </td>
                          <td><?php echo $Products->OrderProduct_rate; ?></td>
                          <td><?php echo $Products->OrderProduct_discount_total; ?></td>
                          <td><?php echo $Products->OrderProduct_tax_total; ?></td>
                          <td><?php echo $Products->OrderProduct_subtotal; ?></td>
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
                        <td><i class="<?php echo $office->Currencycode; ?>"></i> <?php echo $Row->Order_subtotal; ?></td>
                      </tr>
					   <tr>
                        <th>Discount:</th>
                        <td><i class="<?php echo $office->Currencycode; ?>"></i> <?php echo $Row->Order_Discounttotal; ?></td>
                      </tr>
					  <tr>                        
                        <th>Tax Total</th>
                        <td> <i class="<?php echo $office->Currencycode; ?>"></i> <?php echo $Row->Order_taxtotal; ?></td>
                      </tr>                    
                      <tr><td style="border:none;" colspan="5"></td>
                      <td ><b>Discount</b></td>
					  
                      <td><i class="<?php echo $office->Currencycode; ?>"></i> <?php echo $Row->Order_Discounttotal; ?></td>
                    </tr>
                   
                      <tr>
                        <th>Total:</th>
                        <td><i class="<?php echo $office->Currencycode; ?>"></i> <?php echo $Row->Order_total; ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="col-sm-6 pull-left">
                  <p class="lead"><?php echo $Row->Order_Description; ?></p>
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
  <iframe style="width:0px;height:0px;" src="<?php echo site_url('Sales/SalesOrderPrint/?Key=' . $_GET['Key']); ?>" name="frame"></iframe>
  <?php
  if ($Row->Order_status_Id == '3') {
    if ($invoicable) {
  ?>
      <script>
        function askapprovalandinvoice() {
          var r = confirm("This action will Invoice this order !");
          if (r == true) {
            document.getElementById("approveandinvoice_form").submit();
          }
        }
      </script>
      <form id="approveandinvoice_form" method="POST" action="<?php echo site_url('Sales/Invoice_Save'); ?>">
        <input type="hidden" name="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
        <input type="hidden" name="Order_Status_Id" id="Order_Status_Id" value="3" />
        <input type="hidden" name="Order_Id" id="Order_Id" value="<?php echo $Row->Order_Id ?>" />
      </form>
    <?php
    } else {
    ?>
      <script>
        function askapprovalandinvoice() {
          alert("Order Cant Be Invoiced Required Products Quantity is Not Available!");
        }
      </script>

    <?php
    }
    ?>
   

<?php
  }
}
?>
<?php include('Includes/Foot.php'); ?>