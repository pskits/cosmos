<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
if (!isset($_GET['Key'])) {
  redirect("Purchase/purchaseorder");
}
if (empty($_GET['Key'])) {
  redirect("Purchase/purchaseorder");
}
$id = $_GET['Key'];
$purchaseorder_Id = base64_decode($id);
foreach ($this->GM->PurchaseOrder($status_id = 1, $WarehouseCode = "0", $Supplier_Id = "0", $OrderInvoiceStatus_Id = "5", $purchaseorder_Id) as $Row) {
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Import Creation</h1>
    </section>
    <section class="content">
      <div class="box box-form box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Import Creation Details</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo site_url('Purchase/Import_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
          </div>
        </div>

        <?php echo form_open_multipart(site_url('Purchase/Import_') . $But . '/', 'role="form"'); ?>
        <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
        <input type="hidden" name="PurchaseOrder_Id" id="PurchaseOrder_Id" value="<?php echo $purchaseorder_Id ?>" />
        <div class="box-body">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Supplier</label>
                <select onchange='Suppilerdetails(this)' class="form-control select2" required id="PurchaseOrder_Supplier_Id" name="PurchaseOrder_Supplier_Id">
                  <?php
                  $data = $this->GM->Supplier($status_id = "1",  $Row->Supplier_Id);
                  $this->GM->Option_($data, 'Supplier_Id', 'name', '', 'Select', $Row->Supplier_Id);
                  ?>
                </select>
                <?php echo form_error('PurchaseOrder_Supplier_Id'); ?>
              </div>
              <div class="form-group">
                 <label>Import Date</label>
                <div class="input-group">
                  <input type="text" readonly class="form-control input-sm Date" name="Import_Date" id="Import_Date" placeholder="Enter Import Date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                </div>
                <?php echo form_error('Import_Date'); ?>
              </div>
              <div class="form-group">
                <label>Invoice No</label>
                <input type="text" class="form-control input-md" required name="Invoice_no" placeholder="Enter Invoice" value="<?php echo @set_value('Invoice_no') . @$Invoice_no; ?>">
                <?php echo form_error('Invoice_no'); ?>
              </div>
              <div class="form-group">
                <label>Conversion Rate</label>
                <input type="number" value="1.00" min="0.01" step="0.01" class="form-control input-md" onkeyup="Caltotal()" onkeydown="Caltotal()" onchange="Caltotal()" required name="Conversion_Rate" placeholder="Enter Conversion" id="covrate" value="<?php echo @set_value('Conversion_Rate') . @$Conversion_Rate; ?>">
                <?php echo form_error('Conversion_Rate'); ?>
              </div>
            </div>
            <div class="col-sm-6">
              <div id="suppilerdetailstable" class="table-responsive">
              </div>
            </div>
            <style>
              th {
                text-align: center;
              }
            </style>
            <div class="col-md-12">
              <div class="table-responsive">
                <table id="products" class="table table-striped">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Product</th>
                      <th>Qty</th>
                      <th>Rate</th>
                      <th>Amount</th>
                      <th>Description</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $PurchaseOrder_Id = $Row->PurchaseOrder_Id;
                    $count = "0";
                    $status_id = "1";
                    foreach ($this->GM->TransPurchaseOrderProductImport($status_id, $PurchaseOrder_Id) as $Products) {
						
                    ?>
                      <tr>
                        <td><?php echo $count+1; ?></td>
                        <td><select id="Product[<?php echo $count; ?>]" readonly class="form-control select2 productname" required="" name="Product_Id[<?php echo $count; ?>]">
                            <?php
                            $data = $this->GM->Product($status = "1", $productcategory_id = "0", $Products->Trans_PurchaseOrderProduct_Product_Id);
                            $this->GM->Option_($data, 'Product_Id', 'Product', '', 'Select', $Products->Trans_PurchaseOrderProduct_Product_Id); ?>
                          </select>
                        </td>
                        <td>
                          <input type="number" readonly onchange="Caltotal()" class="form-control input-md " id="productqty" step="1" min="1" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required="" name="Qty[<?php echo $count; ?>]" value="<?php echo $Products->Trans_PurchaseOrderProduct_Quantity ?>" placeholder="Enter Quantity">
                        </td>
                        <td>
                          <input type="number" readonly onchange="Caltotal()" class="form-control input-md" id="productrateorg" step="0.01" min="0.01" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required="" name="Rateorg[<?php echo $count; ?>]" placeholder="Enter Rate" value="<?php echo $Products->Trans_PurchaseOrderProduct_Rate ?>">
                          <br>
                          <input type="number" readonly onchange="Caltotal()" class="form-control input-md" id="productrate" step="0.01" min="0.01" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required="" name="Rate[<?php echo $count; ?>]" placeholder="Enter Rate" value="<?php echo $Products->Trans_PurchaseOrderProduct_Rate ?>">
                          <br>
                        </td>
                        <td>
                          <input type="text" class="form-control input-md" id="orgproductamount" step="0.01" min="0.01" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required="" readonly="" name="orgproductamount[<?php echo $count; ?>]" value="<?php echo number_format(($Products->Trans_PurchaseOrderProduct_Rate*$Products->Trans_PurchaseOrderProduct_Quantity), 2) ?>">
                          <br>
                          <input type="number" class="form-control input-md" id="productamount" step="0.01" min="0.01" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required="" readonly="" name="productamount[<?php echo $count; ?>]" value="<?php echo $Products->Trans_PurchaseOrderProduct_Grandtotal ?>">
                          <input type="hidden" id="producttotalamount" value="<?php echo $Products->Trans_PurchaseOrderProduct_Grandtotal + $Products->Trans_PurchaseOrderProduct_Discount; ?>"></td>
                        <td><input type="text" readonly class="form-control input-md productDescription" name="productdesc[<?php echo $count; ?>]" placeholder="Enter Description" value="<?php echo $Products->Trans_PurchaseOrderProduct_Description ?>"></td>
                      </tr>
                    <?php
                      $count++;
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-sm-6 pull-right">
              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th style="width:50%">Before Convertion Total</th>
                    <td><input type="text" class="borderless" name="PurchaseOrder__Subtotal" required readonly id="PurchaseOrder__Subtotal" value="<?php echo $Row->PurchaseOrder__Subtotal; ?>"></td>
                  </tr>
  
                  <tr>
                    <th>Total</th>
                    <td><input type="text" class="borderless" id="PurchaseOrder_GrandTotalAmount" required readonly name="PurchaseOrder_GrandTotalAmount" value="<?php echo $Row->PurchaseOrder_GrandTotalAmount; ?>"></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Terms</label>
                <input type="text" class="form-control input-md" required name="PurchaseOrder_terms" placeholder="Enter Terms" value="<?php echo $Row->PurchaseOrder_terms; ?>">
                <?php echo form_error('PurchaseOrder_terms'); ?>
              </div>
              <div class="form-group">
                <label>Description</label>
                <input type="text" class="form-control input-md" required name="PurchaseOrder_Description" placeholder="Enter Description" value="<?php echo $Row->PurchaseOrder_Description; ?>">
                <?php echo form_error('PurchaseOrder_Description'); ?>
              </div>
            </div>
          </div>
        </div>
        <div class="box-footer">
          <a href="<?php echo site_url("Purchase/Import/?Key=$id"); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
          <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
            <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
        </div>
        </form>
      </div>
    </section>
  </div>
  <script>
    window.onload = function() {
      Suppilerdetails();
      Caltotal();
    };
  </script>
  <script>
    function Suppilerdetails() {
      var e = document.getElementById("PurchaseOrder_Supplier_Id");
      var Id = e.options[e.selectedIndex].value;
      if (Id) {
        $(function() {
          $.ajax({
            type: 'GET',
            url: '<?php echo site_url('Purchase/SupplierDetails'); ?> ',
            data: {
              Supplier_Id: Id
            },
            success: function(data) {
              tableshow = data;
              document.getElementById('suppilerdetailstable').innerHTML = tableshow;
            }
          });
        });
      }
    }

    function Taxperc(e, id) {
      var Tax_Id = e.options[e.selectedIndex].value;
      if (Tax_Id) {
        $(function() {
          $.ajax({
            type: 'GET',
            url: '<?php echo site_url('Purchase/Tax'); ?> ',
            data: {
              tax: Tax_Id
            },
            success: function(data) {
              idofelement = 'Taxpercentage' + id;
              perc = data;
              var perc = parseFloat(perc).toFixed(2);
              document.getElementById(idofelement).value = perc;
              Caltotal();
            }
          });
        });
      }
    }
  </script>
  <script>
    function Caltotal() {
   
      var subtotal = "0.00";
      var totalPrice = "0.00";
      var totaldiscount = "0.00";
      var totalTax = "0.00";
      var covrate = document.getElementById('covrate').value;
      covrate = ((isNaN(covrate)) ? '0.00' : covrate);
      covrate = parseFloat(covrate).toFixed(2);
      $("input[id='productqty']").each(function(index) {
       
        //initiate variables
        var qty = "0";
        var rate = "0.00";
        var productdiscounttype = "0";
        var productdiscount = "0.00";
        var discountval = "0.00";
        var Taxpercentage = "0.00";
        var total = "0.00";
        var output = "0.00";
        //get values
        qty = $("input[id='productqty']").eq(index).val();
        rate = parseFloat($("input[id='productrateorg']").eq(index).val()).toFixed(2);
        //validation
        qty = ((isNaN(qty)) ? '0' : qty);
        rate = (parseFloat(covrate) * parseFloat((isNaN(rate)) ? '0.00' : rate)).toFixed(2);
		console.log(rate+','+qty);
        //calculate amount
        var total = (parseFloat(qty) * parseFloat(rate)).toFixed(2);
     
        var output = total;
		
        //set outputs
        if (!isNaN(total)) {
          $("input[id='productamount']").eq(index).val(total);
          $("input[id='productqty']").eq(index).val(qty);
          $("input[id='productrate']").eq(index).val(rate);
          $("input[id='producttotalamount']").eq(index).val(output);
        } else {
          total = "0.00";
        }
		
        totalPrice = (parseFloat(totalPrice) + parseFloat(total)).toFixed(2);
        totalPrice = ((isNaN(totalPrice)) ? '0' : totalPrice);
        $("#PurchaseOrder_GrandTotalAmount").val(totalPrice);
        subtotal = (parseFloat(subtotal) + parseFloat(output)).toFixed(2);
        subtotal = ((isNaN(subtotal)) ? '0' : subtotal);
        // $("#PurchaseOrder__Subtotal").val(subtotal);
       
      
      });
    }
  </script>
<?php
}
?>
<?php include('Foot.php'); ?>