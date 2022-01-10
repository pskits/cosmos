<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Sales Order Creation</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Sales Order Creation Details</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Sales/Orderlist'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
        </div>
      </div>
      <div style="color:red">

      </div>
      <?php echo form_open_multipart(site_url('Sales/AddOrder'), 'role="form"'); ?>
      <input type="hidden" name="Order_Id" value="<?php echo @set_value('Order_Id') . @$Order_Id; ?>" >
	  
      <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
	  <input type="hidden" name="db" id="db" value="<?php echo $_SESSION['currentdatabasename']; ?>" />
     
      <div class="box-body">
        <div class="row">
          <div class="col-sm-6">
          <div class="form-group">
                 <label>Dealer</label>
                    <select id="orders_dealer_id" required class="form-control select2" name="orders_dealer_id">
                                <?php
                                $data = $this->GM->dealer();
                                $this->GM->Option_($data, 'Dealer_Id', 'name', '', 'Select', @set_value('Dealer_Id') . @$Dealer_Id);
                                ?>
                            </select>
                            <?php echo form_error('Dealer_Id'); ?>
                        </div>
                        <div class="form-group">
                 <label>Priority</label>
                    <select id="orders_priority_id" required class="form-control select2" name="orders_priority_id">
                                <?php
                                $data = $this->GM->OrderPriyority();
                                $this->GM->Option_($data, 'Order_Priyority_Id', 'Order_Priyority_Name', '', 'Select', @set_value('Priority_Id') . @$Priority_Id);
                                ?>
                            </select>
                            <?php echo form_error('orders_priority_id'); ?>
                        </div>
          
            <div class="form-group">
                            <label>SalesExecutive</label>
                            <select id="orders_user_id" required class="form-control select2" name="orders_user_id">
                                <?php
                                $data = $this->GM->Users($userrole_id = "3", $Status_Id = 0, $id = "0");
								//print_r($data);exit;
                                $this->GM->Option_($data, 'logincredentials_Id', 'name', '', 'Select', @set_value('Salesexecutive_user_Id') . @$Salesexecutive_user_Id);
                                ?>
                            </select>
                            <?php echo form_error('orders_user_id'); ?>
                        </div>
          
            <div class="form-group">
              <label>Orders Description</label>
              <input type="text" class="form-control input-md" required name="orders_description" 
              placeholder="Enter Orders Description" value="<?php echo @set_value('Order_Description') . @$Order_Description; ?>">
              <?php echo form_error('orders_description'); ?>
            </div>
            <div class="form-group">
              <label>Orders Terms</label>
              <input type="text" class="form-control input-md" required name="orders_terms" 
              placeholder="Enter Terms" value="<?php echo @set_value('Order_terms') . @$Order_terms; ?>">
              <?php echo form_error('orders_terms'); ?>
            </div>
          </div>
          <div class="col-sm-6">

            <div id="dealerproductdetailstable" class="table-responsive">
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
                    <th style="width:150px;">Qty & Credit Period</th>
                    <th style="width:150px;">Rate</th>
                    <th style="width:150px;">Discount</th>
                    <th style="width:150px;">Tax</th>
                    <th style="width:150px;">Amount</th>
                    <th style="width:150px;">Tools</th>
                </tr>
				</thead>
                <tbody>
				<?php
				 	if(isset($_POST['Order_Id']))
					{
                        $Order_Id = $_POST['Order_Id'];
						$count = "0";
						$status_id = "1";
						$invoicable = true;
                    foreach ($this->GM->OrderlistProduct($status_id, $Order_Id) as $Products)
					{
                ?>
				<tr>
					<td>
						<select  id="Product[<?php echo  $count;?>]" class="form-control select2 productname" required name="product_id[<?php echo  $count;?>]">
						<?php
							$data = $this->GM->Product($status = "1", $productcategory_id = "0", $id = "0");
							$this->GM->Option_($data, 'Product_Id', 'Product', '', 'Select', '0' . $Products->product_id); 
						?>
						</select>
					</td>
					<td>
						<input type="number" onchange="Caltotal()" class="form-control input-md " id="productqty" step="1" min="1" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required="" name="qty[<?php echo  $count;?>]" placeholder="Enter Quantity" value="<?php echo $Products->OrderProduct_Quantity ?>">
						<br>
						<input type="number" min="0" step="1" value="<?php echo $Products->CreditPeriod ?>" class="form-control input-md " required="" name="CreditPeriod[<?php echo  $count;?>]" placeholder="Credit Period">
						</td>
						<td>
							<input type="number" onchange="Caltotal()" class="form-control input-md" id="productrate" step="0.01" min="0.01" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required="" name="rate[<?php echo  $count;?>]" placeholder="Enter Rate" value="<?php echo $Products->OrderProduct_rate; ?>">
							<input type="hidden" name="transoffer_id[<?php echo  $count;?>]" value="0">
						</td>
						<td class="row">
							<div class="col-sm-12">
							<input type="number" onchange="Caltotal()" class="form-control input-md productdiscount" step="0.01" min="0.00" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required="" name="discountperc[<?php echo  $count;?>]" placeholder="Enter Discount" id="productdiscount" value="<?php echo $Products->OrderProduct_discountperc; ?>"> 
							<input type="number" name="discounttotal[<?php echo  $count;?>]" value="0.00" readonly="" required="" class="form-control input-md " id="discounttotal"></div>
						</td>
						<td>
							<input type="hidden" id="tax_id" required="" name="tax_id[<?php echo  $count;?>]" value="<?php echo $Products->Tax_id; ?>">VAT<br>
							<input type="text" class="producttaxamount" readonly="" name="Taxtotal[<?php echo  $count;?>]" id="Taxamount" value="<?php echo $Products->OrderProduct_taxperc; ?>">
							<input type="text" min="0.00"   name="taxperc[<?php echo  $count;?>]" class="hideinputtext producttaxpercentage" value="<?php echo $Products->OrderProduct_taxperc; ?>" id="Taxpercentage<?php echo  $count;?>">
						</td>
						<td>
						<input type="number" class="form-control input-md" id="ProductTotal" step="0.01" min="0.01" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required="" readonly="" name="ProductTotal[<?php echo  $count;?>]" value="<?php echo $Products->OrderProduct_subtotal; ?>">
						<input type="hidden" id="subtotal" value="<?php echo $Products->OrderProduct_subtotal; ?>" name="subtotal[<?php echo  $count;?>]"></td><td><button type="button" class="btn" onclick="Deleterow(this)">Delete</button></td>						
				</tr>				
				<?php
						$count++;
						}
					}
				?>
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
                  <td><input type="text" class="borderless" name="orders__subtotal" required readonly id="orders__subtotal"></td>
                </tr>
                <tr>
                  <td>Discount</td>
                  <td><input type="text" class="borderless" name="orders_discounttotal" required readonly id="orders_discounttotal"></td>
                </tr>
                <tr>
                  <td>Tax</td>
                  <td><input type="text" class="borderless" id="orders_taxtotal" required readonly name="orders_taxtotal"></td>
                </tr>
                <tr>
                  <td>Round off</td>
                  <td><input type="number" class="borderless" value="0.00" step="0.01" 
                   id="orders_roundofftotal" required name="orders_roundofftotal"></td>
                </tr>
				
                <tr>
                  <td>Total</td>
                  <td><input type="text" class="borderless" id="orders_total" 
                  required readonly name="orders_total"></td>
                </tr>
              </table>
            </div>

          </div>
       
        </div>
      </div>
      <div class="box-footer">
        <a href="<?php echo site_url('Sales/SalesOrder'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
        <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
          <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
      </div>
      </form>
    </div>
  </section>
</div>
<?php include('Includes/Foot.php'); ?>
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
    var qty = "1";
    rows--;
    cell0.innerHTML = '<select  id="Product[' + rows + ']" class="form-control select2 productname" required name="product_id[' + rows + ']"><?php $data = $this->GM->Product($status = "1", $productcategory_id = "0", $id = "0");$this->GM->Option_($data, 'Product_Id', 'Product', '', 'Select', '0' . '0'); ?></select>';
    cell1.innerHTML = '<input type="number" onchange="Caltotal()" class="form-control input-md " id="productqty" step="1" min="1" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required name="qty[' + rows + ']" placeholder="Enter Quantity"><br><input type="number" min="0" step="1" value="0"  class="form-control input-md "  required name="CreditPeriod[' + rows + ']" placeholder="Credit Period">';
    cell2.innerHTML = '<input type="number" onchange="Caltotal()" class="form-control input-md" id="productrate" step="0.01" min="0.01" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required name="rate[' + rows + ']" placeholder="Enter Rate"><input type="hidden" name="transoffer_id[' + rows + ']" value ="0">';
    cell3.className = 'row';
    cell3.innerHTML = '<div class="col-sm-12"><input type="number" onchange="Caltotal()" class="form-control input-md productdiscount" step="0.01" min="0.00" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required name="discountperc[' + rows + ']" placeholder="Enter Discount" id="productdiscount"> <input type="number" name="discounttotal[' + rows + ']" value="0.00" readonly required  class="form-control input-md " id="discounttotal"></div>';
    cell4.innerHTML = '<input type="hidden" id="tax_id" required name="tax_id[' + rows + ']" value="<?php $tax = $this->GM->Taxes($status = "1", $id = "1"); echo $tax[0]->Tax_Id;?>"><?php echo $tax[0]->Tax;?><br><input type="text" class="producttaxamount" readonly name="Taxtotal[' + rows + ']" id="Taxamount"><input type="text" min="0.00" name="taxperc[' + rows + ']"  class="hideinputtext producttaxpercentage" value="<?php echo $tax[0]->TaxPercentage;?>" id="Taxpercentage' + rows + '">';
    cell5.innerHTML = '<input type="number" class="form-control input-md" id="ProductTotal" step="0.01" min="0.01" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required readonly name="ProductTotal[' + rows + ']" Value="0"><input type="hidden" id="subtotal" value="0.00" name="subtotal[' + rows + ']">';
    cell6.innerHTML = '<button type="button" class="btn"  onclick="Deleterow(this)">Delete</button>';
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
	var totalRoundoff = "0.00";
    var totalTax = "0.00";
    $("input[id='productqty']").each(function(index) {
      //initiate variables
      var qty = "0";
      var rate = "0.00";
      var productdiscounttype = "1";
      var productdiscount = "0.00";
      var discountval = "0.00";
      var Taxpercentage = "0.00";
      var total = "0.00";
      var output = "0.00";
      //get values
      qty = $("input[id='productqty']").eq(index).val();
      rate = parseFloat($("input[id='productrate']").eq(index).val()).toFixed(2);
      productdiscount = parseFloat($("input[id='productdiscount']").eq(index).val()).toFixed(2);
      idoftaxpercentageelement = '#Taxpercentage' + index;
      Taxpercentage = parseFloat($(idoftaxpercentageelement).val()).toFixed(2);
      //validation
      Taxpercentage = ((isNaN(Taxpercentage)) ? '0.00' : Taxpercentage);
      discountval = ((isNaN(discountval)) ? '0.00' : discountval);
      qty = ((isNaN(qty)) ? '0' : qty);
      rate = ((isNaN(rate)) ? '0.00' : rate);
      productdiscount = ((isNaN(productdiscount)) ? '0.00' : productdiscount);

      //calculate amount
      var total = (parseFloat(qty) * parseFloat(rate)).toFixed(2);
      var output = total;
      //check discount type and calculate discountvalue
      if (productdiscounttype == "1") {
        var discountval = ((parseFloat(output) / 100) * parseFloat(productdiscount)).toFixed(2);
        $("input[id='discounttotal']").eq(index).val(productdiscount);
      }  else {
        $("input[id='discounttotal']").eq(index).val(discountval);
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
        $("input[id='ProductTotal']").eq(index).val(total);
        $("input[id='productqty']").eq(index).val(qty);
        $("input[id='productrate']").eq(index).val(rate);
		
        $("input[id='subtotal']").eq(index).val(output);
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
   
				   $("#orders_discounttotal").val(totaldiscount);
 $("#orders_taxtotal").val(totalTax);
$("#orders__subtotal").val(subtotal);

var nearestroundoffval = Math.round(totalPrice);
          var roundofftotal = (nearestroundoffval - totalPrice).toFixed(2);
		  $("#orders_roundofftotal").val(roundofftotal);
$("#orders_total").val(nearestroundoffval);

  }
  Caltotal();
</script>
