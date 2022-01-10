<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');

$id = $_GET['Key'];
$purchaseorder_Id = base64_decode($id);
foreach ($this->GM->PurchaseOrder($status_id = 1, $WarehouseCode = "0", $Supplier_Id = "0", $OrderInvoiceStatus_Id = "0", $purchaseorder_Id) as $Row) 
{
 
?>
<div class="content-wrapper">
  <section class="content-header">
    <!-- <h1>Bill </h1> -->
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Bill Creation</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Purchase/Bill_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
        </div>
      </div>
     
      <?php echo form_open_multipart(site_url('Purchase/Bill_') . $But . '/', 'role="form"'); ?>
      <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
      <input type="hidden" name="Bill_Id" id="Bill_Id" value="<?php echo  @$Bill_Id; ?>" />
	     <input type="hidden" name="PurchaseOrder_Id" id="PurchaseOrder_Id" value="<?php echo $Row->PurchaseOrder_Id ?>" />
      <div class="box-body">
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label>Supplier</label>
              <select onchange='Suppilerdetails(this)' class="form-control select2" required id="Bill_Supplier_Id" name="Bill_Supplier_Id">
                <?php
                $data = $this->GM->Supplier($status_id = "1",$Row->PurchaseOrder_Supplier_Id);
                $this->GM->Option_($data, 'Supplier_Id', 'name', '', 'Select', @set_value('Bill_Supplier_Id') . @$Bill_Supplier_Id);
                ?>
              </select>
              <?php echo form_error('Bill_Supplier_Id'); ?>
            </div>
            <div class="form-group">
              <label>Purchase Date</label>
              <div class="input-group">
                <input type="text" readonly class="form-control input-sm Date" name="Bill_Date" id="Bill_Date"			
				value="<?php echo  date('d-m-Y',strtotime($Row->PurchaseOrder_Date)) ; ?>"			placeholder="Enter Bill Date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
              </div>
              <?php echo form_error('Bill_Date'); ?>
            </div>
            <div class="form-group">
              <label>Due Date</label>
              <div class="input-group">
                <input type="text" readonly class="form-control input-sm Date" name="Bill_DueDate" id="Bill_DueDate" placeholder="Enter  Due Date" 
				value="<?php echo  date('d-m-Y',strtotime($Row->PurchaseOrder_ExpectedDate)) ;  ?>">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
              </div>
              <?php echo form_error('PurchaseOrder_ExpectedDate'); ?>
            </div>
            <div class="form-group">
              <label>Invoice No</label>
              <input type="text" class="form-control input-md" required name="Invoice_no" placeholder="Enter Invoice_no" value="<?php echo @set_value('Invoice_no') . @$Invoice_no; ?>">
              <?php echo form_error('Invoice_no'); ?>
            </div>
            <div class="form-group">
              <label>Reference</label>
              <input type="text" class="form-control input-md" value="<?php echo $Row->PurchaseOrder_reference ?>" required name="Bill_Reference" placeholder="Enter  Reference" value="<?php echo @set_value('Bill_Reference') . @$Bill_Reference; ?>">
              <?php echo form_error('Bill_Reference'); ?>
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
                    <th>Ledger</th>
                    <th>Qty</th>
                    <th>Rate</th>
                    <th>Discount</th>
                    <th>Tax</th>
                    <th>Amount</th>
                    <th>Description</th>
                  </tr>
                </thead>
                <tbody>
				    <?php
                  
                  $count= 0;
                        foreach ($this->GM->PurchaseOrderProduct($status_id = '1', $Row->PurchaseOrder_Id) as $Products)  
                  {
                  ?>
<tr>
<td><?php echo $count+1;?></td>
  <td>
   
				<input readonly id="Product[<?php echo $count;?>]" class="form-control  productname" type="text" required name="Product[<?php echo $count;?>]" value="<?php $data = $this->GM->Product($status = "1", "0", $Products->Product_Id); echo $data[0]->Product?>">
				</td>
				<td><select id="ledger[<?php echo $count;?>]" class="form-control select2 productname" required="" name="ledger_id[<?php echo $count;?>]"> <?php $dataVoucherAgainst = $this->GM->OfficeLedger($OfficeLedger_id = "0", $LedgerType_Id = "14", $Against_Id = "0");$this->GM->Option_($dataVoucherAgainst, 'OfficeLedger_id', 'Ledgername', '', 'Select', 0); ?></select></td>
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
            <input type="text" class="hideinputtext producttaxpercentage" value="0.00" id="Taxpercentage[<?php echo $count;?>]" value="<?php echo $Products->TaxPercentage;?>"></td>
            <td>
              <input type="number" class="form-control input-md" id="productamount" step="0.01" min="0.01" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required="" readonly="" name="productamount[<?php echo $count;?>]" value="<?php echo $Products->Trans_PurchaseOrderProduct_Grandtotal;?>">
              <input type="hidden" id="producttotalamount"></td><td><input type="text" class="form-control input-md productDescription" name="productdesc[<?php echo $count;?>]" placeholder="Enter Description"  value="<?php echo $Products->Trans_PurchaseOrderProduct_Description;?>"></td>
			  </tr>
<?php
$count++;
 }?>     </tbody>
              </table>
              <button onclick="Addrow()" type="button" class="btn btn-tumblr">+ Add New Line</button>
              <br><br>
            </div>
          </div>
          <div class="col-sm-6 pull-right">
            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th style="width:50%">Sub Total</th>
                  <td><input type="text" class="borderless" name="Bill_Subtotal" required readonly id="Bill_Subtotal" value="<?php echo $Row->PurchaseOrder__Subtotal ?>"></td>
                </tr>
                <tr>
                  <th>Discount</th>
                  <td><input type="text" class="borderless" name="Bill_TotalDiscountAmount" required readonly id="Bill_TotalDiscountAmount" value="<?php echo $Row->PurchaseOrder_TotalDiscountAmount ?>"></td>
                </tr>
                <tr>
                  <th>Tax</th>
                  <td><input type="text" class="borderless" id="Bill_TotalTaxAmount" required readonly name="Bill_TotalTaxAmount" value="<?php echo $Row->PurchaseOrder_TotalTaxAmount ?>"></td>
                </tr>
					<tr>
                  <td>Fright</td>
                  <td><input type="number" class="form-control input-md" value="0.00" step="0.01" onchange="Caltotal();" id="Fright" required name="Fright"></td>
                </tr>
				<tr>
                  <td>Insurance</td>
                  <td><input type="number" class="form-control input-md" value="0.00" step="0.01" onchange="Caltotal();" id="Insurance" required name="Insurance"></td>
                </tr>
                <tr>
                  <th>Total</th>
                  <td><input type="text" class="borderless" id="Bill_GrandTotalAmount" required readonly name="Bill_GrandTotalAmount" value="<?php echo $Row->PurchaseOrder_GrandTotalAmount ?>"></td>
                </tr>
              </table>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Terms</label>
              <input type="text" class="form-control input-md"  required name="Bill_terms" placeholder="Enter Terms" value="<?php echo $Row->PurchaseOrder_PaymentTerms ?>">
              <?php echo form_error('Bill_terms'); ?>
            </div>
            <div class="form-group">
              <label>Description</label>
              <input type="text" class="form-control input-md"  required name="Bill_Description" placeholder="Enter Description" value="<?php echo $Row->PurchaseOrder_Description ?>">
              <?php echo form_error('Bill_Description'); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="box-footer">
        <a href="<?php echo site_url("Purchase/Bill"); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
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
  };
</script>
<script>
  function Suppilerdetails() {
    var e = document.getElementById("Bill_Supplier_Id");
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
            var perc = parseFloat(perc).toFixed(3);
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
    var cell8 = row.insertCell(8);
    var qty = "1";
    cell0.innerHTML = rows;
    rows--;
    cell1.innerHTML = '<input id="Product['+rows+']" class="form-control  productname" type="text" required name="Product['+rows+']" value="">';
      cell2.innerHTML =`<select id="ledger[`+rows+`]" class="form-control select2 productname" required="" name="ledger_id[`+rows+`]"> <?php $dataVoucherAgainst = $this->GM->OfficeLedger($OfficeLedger_id = "0", $LedgerType_Id = "14", $Against_Id = "0");$this->GM->Option_($dataVoucherAgainst, 'OfficeLedger_id', 'Ledgername', '', 'Select', 0); ?></select>`;
     cell3.innerHTML = '<input type="number" onchange="Caltotal()" class="form-control input-md " id="productqty" step="1" min="1" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required name="Qty['+rows+']" placeholder="Enter Quantity">';
     cell4.innerHTML = '<input type="number" onchange="Caltotal()" class="form-control input-md" id="productrate" step="0.01" min="0.01" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required name="Rate['+rows+']" placeholder="Enter Rate">';
     cell5.className ='row';
     cell5.innerHTML = '<div class="col-sm-6"><select id="productdiscounttype" onchange="Caltotal()" class="form-control select2 productdiscounttype" required name="Discounttype['+rows+']"><?php $data = $this->GM->Discounttype($id="0");$this->GM->Option_($data, 'DiscountType_Id', 'DiscountTypeName', '0', 'Select', '0' . '0');?></select></div><div class="col-sm-6"><input type="number" onchange="Caltotal()" class="form-control input-md productdiscount" step="0.01" min="0.00" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required name="Discount['+rows+']" placeholder="Enter Discount" id="productdiscount"></div>';
     cell6.innerHTML = '<select id="Tax" onchange="Taxperc(this,'+rows+')" class="form-control select2 producttaxes" required name="Tax['+rows+']"><?php $data = $this->GM->Taxes($status="1",$id="0");$this->GM->Option_($data, 'Tax_Id', 'Tax', '', 'Select', '0' . '0');?></select><input type="hidden" class="producttaxamount" name="Taxamount['+rows+']" id="Taxamount"><input type="text"  class="hideinputtext producttaxpercentage" value="0.00" id="Taxpercentage'+rows+'">';
     cell7.innerHTML = '<input type="number" class="form-control input-md" id="productamount" step="0.01" min="0.01" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required readonly name="productamount['+rows+']" Value="0"><input type="hidden" id="producttotalamount">';
     cell8.innerHTML = '<input type="text" class="form-control input-md productDescription" name="productdesc['+rows+']" placeholder="Enter Description">';
    $('.select2').select2();
  }
</script>
<script>
  function Caltotal() {
    var subtotal = "0.00";
    var totalPrice = "0.00";
    var totaldiscount = "0.00";
    var totalTax = "0.00";
	
var Insurance = document.getElementById('Insurance').value; 
	var Fright = document.getElementById('Fright').value; 
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
      rate = parseFloat($("input[id='productrate']").eq(index).val()).toFixed(3);
      productdiscounttype = $('.productdiscounttype option:selected').eq(index).val();
      productdiscount = parseFloat($("input[id='productdiscount']").eq(index).val()).toFixed(3);
      idoftaxpercentageelement = '#Taxpercentage' + index;
      Taxpercentage = parseFloat($(idoftaxpercentageelement).val()).toFixed(3);
      //validation
      Taxpercentage = ((isNaN(Taxpercentage)) ? '0.00' : Taxpercentage);
      discountval = ((isNaN(discountval)) ? '0.00' : discountval);
      qty = ((isNaN(qty)) ? '0' : qty);
      rate = ((isNaN(rate)) ? '0.00' : rate);
      productdiscount = ((isNaN(productdiscount)) ? '0.00' : productdiscount);
      productdiscounttype = ((isNaN(productdiscounttype)) ? '0' : productdiscounttype);
      //calculate amount
      var total = (parseFloat(qty) * parseFloat(rate)).toFixed(3);
      var output = total;
      //check discount type and calculate discountvalue
      if (productdiscounttype == "1") {
        var discountval = ((parseFloat(output) / 100) * parseFloat(productdiscount)).toFixed(3);
        $("input[id='productdiscount']").eq(index).val(productdiscount);
      } else if (productdiscounttype == "2") {
        var discountval = productdiscount;
        var discountval = parseFloat(discountval).toFixed(3);
        $("input[id='productdiscount']").eq(index).val(discountval);
      } else {
        $("input[id='productdiscount']").eq(index).val(discountval);
      }
      //calculate and set tax value
      var Taxval = ((parseFloat(output) / 100) * parseFloat(Taxpercentage)).toFixed(3);
      $("input[id='Taxamount']").eq(index).val(Taxval);
      //subract discount from total
      if (!isNaN(discountval)) {
        var total = (parseFloat(total) - parseFloat(discountval)).toFixed(3);
      }
      //add tax
      if (!isNaN(Taxval)) {
        var total = (parseFloat(total) + parseFloat(Taxval)).toFixed(3);
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
      totalPrice = (parseFloat(totalPrice) + parseFloat(total)).toFixed(3);
      totalPrice = ((isNaN(totalPrice)) ? '0' : totalPrice);
     
      subtotal = (parseFloat(subtotal) + parseFloat(output)).toFixed(3);
      subtotal = ((isNaN(subtotal)) ? '0' : subtotal);

      totalTax = (parseFloat(totalTax) + parseFloat(Taxval)).toFixed(3);
      totalTax = ((isNaN(totalTax)) ? '0' : totalTax);
      
      totaldiscount = (parseFloat(totaldiscount) + parseFloat(discountval)).toFixed(3);
      totaldiscount = ((isNaN(totaldiscount)) ? '0' : totaldiscount);
    
    });
	totalPrice = (parseFloat(totalPrice) + parseFloat(Fright)).toFixed(3);
   
			      totalPrice = (parseFloat(totalPrice) + parseFloat(Insurance)).toFixed(3);
				    $("#Bill_TotalDiscountAmount").val(totaldiscount);
					$("#Bill_TotalTaxAmount").val(totalTax);
					      $("#Bill_Subtotal").val(subtotal);
						   $("#Bill_GrandTotalAmount").val(totalPrice);
  }
</script>
<?php } include('Includes/Foot.php'); ?>