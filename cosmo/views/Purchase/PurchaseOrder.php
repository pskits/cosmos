<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Purchase Order Creation</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Purchase Order Creation Details</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Purchase/PurchaseOrder_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
        </div>
      </div>
      <div style="color:red">

      </div>
      <?php echo form_open_multipart(site_url('Purchase/PurchaseOrder_Commit'), 'role="form"'); ?>
      
      <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
      <input type="hidden" name="PurchaseOrder_Id" id="PurchaseOrder_Id" value="<?php echo @set_value('PurchaseOrder_Id') . @$PurchaseOrder_Id ?>" />
     
      <div class="box-body">
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label>Supplier</label>
              <select onchange='Suppilerdetails(this)' class="form-control select2" required name="PurchaseOrder_Supplier_Id">
                <?php
                $data = $this->GM->Supplier();
                $this->GM->Option_($data, 'Supplier_Id', 'name', '', 'Select', @set_value('PurchaseOrder_Supplier_Id') . @$PurchaseOrder_Supplier_Id);
                ?>
              </select>
              <?php echo form_error('PurchaseOrder_Supplier_Id'); ?>
            </div>


            <div class="form-group">
              <label>Purchase Order Date</label>
              <div class="input-group">
                <input type="text" readonly class="form-control input-sm Date" name="PurchaseOrder_Date" id="PurchaseOrder_Date" placeholder="Enter PurchaseOrder Date" value="<?php echo (isset($_POST['PurchaseOrder_Date'])) ?  date('d-m-Y',strtotime(@set_value('PurchaseOrder_Date') . @$PurchaseOrder_Date)) : ''; ?>">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
              </div>
              <?php echo form_error('PurchaseOrder_Date'); ?>
            </div>
            <div class="form-group">
                            <label>Warehouse</label>
                            <select id="Warehouse_Id" required class="form-control select2" name="Warehouse_Id">
                                <?php
                                $data = $this->GM->Warehouse();
                                $this->GM->Option_($data, 'Warehouse_Id', 'WarehouseName', '', 'Select', @set_value('Warehouse_Id') . @$Warehouse_Id);
                                ?>
                            </select>
                            <?php echo form_error('Warehouse_Id'); ?>
                        </div>
            <div class="form-group">
              <label>PurchaseOrder Expected Date</label>
              <div class="input-group">
                <input type="text" readonly class="form-control input-sm Date" name="PurchaseOrder_ExpectedDate" id="PurchaseOrder_ExpectedDate" placeholder="Enter PurchaseOrder Expected Date" value="<?php echo (isset($_POST['PurchaseOrder_ExpectedDate'])) ?  date('d-m-Y',strtotime(@set_value('PurchaseOrder_ExpectedDate') . @$PurchaseOrder_ExpectedDate)) : '';  ?>">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
              </div>
              <?php echo form_error('PurchaseOrder_ExpectedDate'); ?>
            </div>

            <div class="form-group">
              <label>PurchaseOrder Payment Terms</label>
              <input type="text" class="form-control input-md" required name="PurchaseOrder_PaymentTerms" placeholder="Enter PurchaseOrder Payment Terms" value="<?php echo @set_value('PurchaseOrder_PaymentTerms') . @$PurchaseOrder_PaymentTerms; ?>">
              <?php echo form_error('PurchaseOrder_PaymentTerms'); ?>
            </div>
            <div class="form-group">
              <label>PurchaseOrder Reference</label>
              <input type="text" class="form-control input-md" required name="PurchaseOrder_reference" placeholder="Enter PurchaseOrder Reference" value="<?php echo @set_value('PurchaseOrder_reference') . @$PurchaseOrder_reference; ?>">
              <?php echo form_error('PurchaseOrder_reference'); ?>
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
                    <th style="width:150px;">Product</th>
                    <th style="width:150px;">Qty</th>
                    <th style="width:150px;">Rate</th>
                    <th style="width:150px;">Discount</th>
                    <th style="width:150px;">Tax</th>
                    <th style="width:150px;">Amount</th>
                    <th style="width:150px;">Description</th>
                    <th style="width:150px;">Tools</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $_POST['PurchaseOrder_Id'] = (isset($_POST['PurchaseOrder_Id'])) ? $_POST['PurchaseOrder_Id']: - 1;
                  $count= 0;
                        foreach ($this->GM->PurchaseOrderProduct($status_id = '1', $_POST['PurchaseOrder_Id']) as $Products)  
                  {
                  ?>
<tr>
  <td>
    <select id="Product[<?php echo $count;?>]" class="form-control select2 productname" required="" name="Product_Id[<?php echo $count;?>]">
    <?php    $data = $this->GM->Product($status = "1", "0", "0");
                $this->GM->Option_($data, 'Product_Id', 'Product', '', 'Select', $Products->Product_Id);
                ?></select></td>
        <td><input type="number" onchange="Caltotal()" class="form-control input-md " id="productqty" step="1" min="1" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required="" name="Qty[<?php echo $count;?>]" placeholder="Enter Quantity" value="<?php echo $Products->Trans_PurchaseOrderProduct_Quantity;?>"></td>
        <td><input type="number" onchange="Caltotal()" class="form-control input-md" id="productrate" step="0.01" min="0.01" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required="" name="Rate[<?php echo $count;?>]" placeholder="Enter Rate"  value="<?php echo $Products->Trans_PurchaseOrderProduct_Rate;?>"></td>
        <td>
        <div class="row">
          <div class="col-sm-6">
          <select id="productdiscounttype" onchange="Caltotal()" class="form-control select2 productdiscounttype" required="" name="Discounttype[<?php echo $count;?>]">
          <?php $data = $this->GM->Discounttype($id = "0"); $this->GM->Option_($data, 'DiscountType_Id', 'DiscountTypeName', '0', 'Select', $Products->Trans_PurchaseOrderProduct_DiscountType_Id); ?>
          </select>
        </div>
        <div class="col-sm-6">
          <input type="number" onchange="Caltotal()" class="form-control input-md productdiscount" step="0.01" min="0.00" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required="" name="Discount[<?php echo $count;?>]" placeholder="Enter Discount" id="productdiscount"  value="<?php echo $Products->Trans_PurchaseOrderProduct_Discount;?>"></div>
        </td>
          <td>
            <select id="Tax" onchange="Taxperc(this,0)" class="form-control select2 producttaxes" required="" name="Tax[<?php echo $count;?>]">
            <?php    $data = $this->GM->Taxes($status = "1", "0");
                $this->GM->Option_($data, 'Tax_Id', 'Tax', '', 'Select', $Products->Trans_PurchaseOrderProduct_Tax_Id);
                ?></select>
            <input type="hidden" class="producttaxamount" name="Taxamount[<?php echo $count;?>]" id="Taxamount" value="<?php echo $Products->Trans_PurchaseOrderProduct_Taxcost;?>">
            <input type="text" class="hideinputtext producttaxpercentage" value="0.00" id="Taxpercentage<?php echo $count;?>" value="<?php echo $Products->TaxPercentage;?>"></td>
            <td>
              <input type="number" class="form-control input-md" id="productamount" step="0.01" min="0.01" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required="" readonly="" name="productamount[<?php echo $count;?>]" value="<?php echo $Products->Trans_PurchaseOrderProduct_Grandtotal;?>">
              <input type="hidden" id="producttotalamount"></td><td><input type="text" class="form-control input-md productDescription" name="productdesc[<?php echo $count;?>]" placeholder="Enter Description"  value="<?php echo $Products->Trans_PurchaseOrderProduct_Description;?>"></td><td><button type="button" class="btn" onclick="Deleterow(this)">Delete</button></td></tr>
<?php 
$count++;
}?>               
</tbody>
              </table>
              <button onclick="Addrow()" type="button" class="btn btn-tumblr">+ Add New Line</button>
              <br><br>
            </div>


          </div>
          <div class="col-sm-6 pull-right">
            <div class="table-responsive">
              <table class="table">
                <tr>
                  <td style="width:50%">Sub Total</td>
                  <td><input type="text" class="borderless" name="PurchaseOrder__Subtotal" required readonly id="PurchaseOrder__Subtotal"></td>
                </tr>
                <tr>
                  <td>Discount</td>
                  <td><input type="text" class="borderless" name="PurchaseOrder_TotalDiscountAmount" required readonly id="PurchaseOrder_TotalDiscountAmount"></td>
                </tr>
                <tr>
                  <td>Tax</td>
                  <td><input type="text" class="borderless" id="PurchaseOrder_TotalTaxAmount" required readonly name="PurchaseOrder_TotalTaxAmount"></td>
                </tr>
<tr>
                  <td>Fright</td>
                  <td><input type="number" class="form-control input-md" value="0.00" step="0.01" onchange="Caltotal();" id="PurchaseOrder_TotalFrightAmount" required name="PurchaseOrder_TotalFrightAmount"></td>
                </tr>
				                <tr>
                  <td>Insurance</td>
                  <td><input type="number" class="form-control input-md" value="0.00" step="0.01" onchange="Caltotal();" id="PurchaseOrder_TotalInsuranceAmount" required name="PurchaseOrder_TotalInsuranceAmount"></td>
                </tr>
                <tr>
                  <td>Total</td>
                  <td><input type="text" class="borderless" id="PurchaseOrder_GrandTotalAmount" required readonly name="PurchaseOrder_GrandTotalAmount"></td>
                </tr>
              </table>
            </div>

          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Terms</label>
              <input type="text" class="form-control input-md" required name="PurchaseOrder_terms" placeholder="Enter Rate" value="<?php echo @set_value('PurchaseOrder_terms') . @$PurchaseOrder_terms; ?>">
              <?php echo form_error('PurchaseOrder_terms'); ?>
            </div>
            <div class="form-group">
              <label>Description</label>
              <input type="text" class="form-control input-md" required name="PurchaseOrder_Description" placeholder="Enter Description" value="<?php echo @set_value('PurchaseOrder_Description') . @$PurchaseOrder_Description; ?>">
              <?php echo form_error('PurchaseOrder_Description'); ?>
            </div>
          </div>

        </div>
      </div>
      <div class="box-footer">
        <a href="<?php echo site_url('Purchase/PurchaseOrder'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
        <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
          <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
      </div>
      </form>
    </div>
  </section>
</div>
<?php include('Includes/Foot.php'); ?>
<script>
  function Suppilerdetails(e) {
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
  function Addrow() {
    var table = document.getElementById("products").getElementsByTagName('tbody')[0];
    var rows = document.getElementById("products").rows.length;
    var row = table.insertRow(-1);
    var cell0 = row.insertCell(0);
    var cell1 = row.insertCell(1);
    var cell2 = row.insertCell(2);
    var cell3 = row.insertCell(3);
    var cell4 = row.insertCell(4);
    var cell5 = row.insertCell(5);
    var cell6 = row.insertCell(6);
    var cell7 = row.insertCell(7);
    var qty = "1";
    rows--;
    cell0.innerHTML = '<select  id="Product[' + rows + ']" class="form-control select2 productname" required name="Product_Id[' + rows + ']"><?php $data = $this->GM->Product($status = "1", $productcategory_id = "0", $id = "0");$this->GM->Option_($data, 'Product_Id', 'Product', '', 'Select', '0' . '0'); ?></select>';
    cell1.innerHTML = '<input type="number" onchange="Caltotal()" class="form-control input-md " id="productqty" step="1" min="1" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required name="Qty[' + rows + ']" placeholder="Enter Quantity">';
    cell2.innerHTML = '<input type="number" onchange="Caltotal()" class="form-control input-md" id="productrate" step="0.01" min="0.01" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required name="Rate[' + rows + ']" placeholder="Enter Rate">';
    cell3.className = 'row';
    cell3.innerHTML = '<div class="col-sm-12"><select id="productdiscounttype" onchange="Caltotal()" class="form-control select2 productdiscounttype" required name="Discounttype[' + rows + ']"><?php $data = $this->GM->Discounttype($id = "0");                                                                                                                                                                                               $this->GM->Option_($data, 'DiscountType_Id', 'DiscountTypeName', '0', 'Select', '0' . '0'); ?></select></div><div class="col-sm-12"><input type="number" onchange="Caltotal()" class="form-control input-md productdiscount" step="0.01" min="0.00" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required name="Discount[' + rows + ']" placeholder="Enter Discount" id="productdiscount"></div>';
    cell4.innerHTML = '<select id="Tax" onchange="Taxperc(this,' + rows + ')" class="form-control select2 producttaxes" required name="Tax[' + rows + ']"><?php $data = $this->GM->Taxes($status = "1", $id = "0");$this->GM->Option_($data, 'Tax_Id', 'Tax', '', 'Select', '0' . '0'); ?></select><input type="hidden" class="producttaxamount" name="Taxamount[' + rows + ']" id="Taxamount"><input type="text"  class="hideinputtext producttaxpercentage" value="0.00" id="Taxpercentage' + rows + '">';
    cell5.innerHTML = '<input type="number" class="form-control input-md" id="productamount" step="0.01" min="0.01" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required readonly name="productamount[' + rows + ']" Value="0"><input type="hidden" id="producttotalamount">';
    cell6.innerHTML = '<input type="text" class="form-control input-md productDescription" name="productdesc[' + rows + ']" placeholder="Enter Description">';
    cell7.innerHTML = '<button type="button" class="btn"  onclick="Deleterow(this)">Delete</button>';
    $('.select2').select2();
  }

  function Deleterow(btn) {
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
  }
</script>
<script>
  function Caltotal() {
    var subtotal = "0.00";
    var totalPrice = "0.00";
    var totaldiscount = "0.00";
    var totalTax = "0.00";
var PurchaseOrder_TotalInsuranceAmount = document.getElementById('PurchaseOrder_TotalInsuranceAmount').value; 
	var PurchaseOrder_TotalFrightAmount = document.getElementById('PurchaseOrder_TotalFrightAmount').value; 
		console.log(PurchaseOrder_TotalInsuranceAmount+','+PurchaseOrder_TotalFrightAmount);
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
      rate = parseFloat($("input[id='productrate']").eq(index).val()).toFixed(2);
      productdiscounttype = $('.productdiscounttype option:selected').eq(index).val();
      productdiscount = parseFloat($("input[id='productdiscount']").eq(index).val()).toFixed(2);
      idoftaxpercentageelement = '#Taxpercentage' + index;
      Taxpercentage = parseFloat($(idoftaxpercentageelement).val()).toFixed(2);
      //validation
      Taxpercentage = ((isNaN(Taxpercentage)) ? '0.00' : Taxpercentage);
      discountval = ((isNaN(discountval)) ? '0.00' : discountval);
      qty = ((isNaN(qty)) ? '0' : qty);
      rate = ((isNaN(rate)) ? '0.00' : rate);
      productdiscount = ((isNaN(productdiscount)) ? '0.00' : productdiscount);
      productdiscounttype = ((isNaN(productdiscounttype)) ? '0' : productdiscounttype);

      //calculate amount
      var total = (parseFloat(qty) * parseFloat(rate)).toFixed(2);
      var output = total;
      //check discount type and calculate discountvalue
      if (productdiscounttype == "1") {
        var discountval = ((parseFloat(output) / 100) * parseFloat(productdiscount)).toFixed(2);
        $("input[id='productdiscount']").eq(index).val(productdiscount);
      } else if (productdiscounttype == "2") {
        var discountval = productdiscount;
        var discountval = parseFloat(discountval).toFixed(2);
        $("input[id='productdiscount']").eq(index).val(discountval);
      } else {
        $("input[id='productdiscount']").eq(index).val(discountval);
      }

      //calculate and set tax value
  
      //subract discount from total
      if (!isNaN(discountval)) {
        var total = (parseFloat(total) - parseFloat(discountval)).toFixed(2);
      }
    var Taxval = ((parseFloat(total) / 100) * parseFloat(Taxpercentage)).toFixed(2);

      $("input[id='Taxamount']").eq(index).val(Taxval);


      //add tax
      if (!isNaN(Taxval)) {
        var total = (parseFloat(total) + parseFloat(Taxval)).toFixed(2);
      }
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
      

      subtotal = (parseFloat(subtotal) + parseFloat(output)).toFixed(2);
      subtotal = ((isNaN(subtotal)) ? '0' : subtotal);
      
      totalTax = (parseFloat(totalTax) + parseFloat(Taxval)).toFixed(2);
      totalTax = ((isNaN(totalTax)) ? '0' : totalTax);
     
      totaldiscount = (parseFloat(totaldiscount) + parseFloat(discountval)).toFixed(2);
      totaldiscount = ((isNaN(totaldiscount)) ? '0' : totaldiscount);
     
    });
totalPrice = (parseFloat(totalPrice) + parseFloat(PurchaseOrder_TotalFrightAmount)).toFixed(2);
	
   
			      totalPrice = (parseFloat(totalPrice) + parseFloat(PurchaseOrder_TotalInsuranceAmount)).toFixed(2);
				  
	
				   $("#PurchaseOrder_TotalDiscountAmount").val(totaldiscount);
 $("#PurchaseOrder_TotalTaxAmount").val(totalTax);
$("#PurchaseOrder__Subtotal").val(subtotal);
$("#PurchaseOrder_GrandTotalAmount").val(totalPrice);
				  
  }
  Caltotal();
</script>
