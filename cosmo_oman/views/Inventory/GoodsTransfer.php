<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');

?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Goods Transfer Creation</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Goods Transfer Creation Details</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Inventory/GoodsTransfer_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
        </div>
      </div>
      <div style="color:red">
<?php print_r(validation_errors());?>
      </div>
      <?php echo form_open_multipart(site_url('Inventory/GoodsTransfer_Commit'), 'role="form"'); ?>
      
      <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
      <input type="hidden" name="GoodsTransfer_Id" id="GoodsTransfer_Id" value="<?php echo @set_value('GoodsTransfer_Id') . @$GoodsTransfer_Id ?>" />
     

      <div class="box-body">
        <div class="row">
          <div class="col-sm-6">
          <div class="form-group">
                            <label>Goods TransferType</label>
                            <select id="from_warehouse_id" required class="form-control select2" name="from_warehouse_id">
                                <?php
                                $data = $this->GM->Warehouse();
                                $this->GM->Option_($data, 'Warehouse_Id', 'WarehouseName', '', 'Select', @set_value('from_warehouse_id') . @$from_warehouse_id);
                                ?>
                            </select>
                            <?php echo form_error('from_warehouse_id'); ?>
                        </div>
          <div class="form-group">
                            <label>From Warehouse</label>
                            <select id="from_warehouse_id" required class="form-control select2" name="from_warehouse_id">
                                <?php
                                $data = $this->GM->Warehouse();
                                $this->GM->Option_($data, 'Warehouse_Id', 'WarehouseName', '', 'Select', @set_value('from_warehouse_id') . @$from_warehouse_id);
                                ?>
                            </select>
                            <?php echo form_error('from_warehouse_id'); ?>
                        </div>
                        <div class="form-group">
                            <label>Branch</label>
                            <select id="to_branch_id" onchange="warehouse()"  required class="form-control select2" name="to_branch_id">
                               <option>--select--</option>
                                <?php
                                $data = $this->GM->Office($officetype = "2", $status = "1", $Id = "0", $dbnamer = "Nill");
                               foreach($data as $branch)
                               {
                                   ?>
                                   <option <?php if(strtoupper($branch->office_dbname)==strtoupper($_SESSION['currentdatabasename'])) { echo "Selected"; $currentoffice_Id=$branch->office_Id;}  ?> max="<?php echo $branch->office_dbname; ?>" value="<?php echo $branch->office_Id; ?>"><?php echo $branch->office_Name; ?></option>
                                   <?php

                               }
                                ?>
                            </select>
                            <?php echo form_error('to_branch_id'); ?>
                        </div>
                        <input type="hidden" name="currentoffice_Id" value="<?php echo $currentoffice_Id;?>">

                        </div>  <div class="col-sm-6">
                        <div class="form-group">
                            <label>To warehouse</label>
                            <select id="to_warehouse_id" required class="form-control select2" name="to_warehouse_id">
                            <?php
                                $data = $this->GM->Warehouse();
                                $this->GM->Option_($data, 'Warehouse_Id', 'WarehouseName', '', 'Select', @set_value('from_warehouse_id') . @$from_warehouse_id);
                                ?>
                            </select>
                            <?php echo form_error('to_warehouse_id'); ?>
                        </div>
         
                        <div class="form-group">
                            <label>Date</label>
                            <input type="text" onkeypress="return false;" id="goodstransfer_date" class="form-control input-md Date" required name="goodstransfer_date" placeholder="Enter Date" value="<?php echo @set_value('goodstransfer_date ') . @$goodstransfer_date ; ?>">
                            <?php echo form_error('goodstransfer_date '); ?>
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
                  $_POST['GoodsTransfer_Id'] = (isset($_POST['GoodsTransfer_Id'])) ? $_POST['GoodsTransfer_Id']: - 1;
                  $count= 0;
                        foreach ($this->GM->GoodsTransferProduct($status_id = '1', $_POST['GoodsTransfer_Id']) as $Products)  
                  {
                  ?>
<tr>
  <td>
    <select id="Product[<?php echo $count;?>]" class="form-control select2 productname" required="" name="Product_Id[<?php echo $count;?>]">
    <?php    $data = $this->GM->Product($status = "1", "0", "0");
                $this->GM->Option_($data, 'Product_Id', 'Product', '', 'Select', $Products->Product_Id);
                ?></select></td>
        <td><input type="number" onchange="Caltotal()" class="form-control input-md " id="productqty" step="1" min="1" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required="" name="Qty[<?php echo $count;?>]" placeholder="Enter Quantity" value="<?php echo $Products->Trans_GoodsTransferProduct_Quantity;?>"></td>
        <td><input type="number" onchange="Caltotal()" class="form-control input-md" id="productrate" step="0.01" min="0.01" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required="" name="Rate[<?php echo $count;?>]" placeholder="Enter Rate"  value="<?php echo $Products->Trans_GoodsTransferProduct_Rate;?>"></td>
        <td>
        <div class="row">
          <div class="col-sm-6">
          <select id="productdiscounttype" onchange="Caltotal()" class="form-control select2 productdiscounttype" required="" name="Discounttype[<?php echo $count;?>]">
          <?php $data = $this->GM->Discounttype($id = "0"); $this->GM->Option_($data, 'DiscountType_Id', 'DiscountTypeName', '0', 'Select', $Products->Trans_GoodsTransferProduct_DiscountType_Id); ?>
          </select>
        </div>
        <div class="col-sm-6">
          <input type="number" onchange="Caltotal()" class="form-control input-md productdiscount" step="0.01" min="0.00" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required="" name="Discount[<?php echo $count;?>]" placeholder="Enter Discount" id="productdiscount"  value="<?php echo $Products->Trans_GoodsTransferProduct_Discount;?>"></div>
        </td>
          <td>
            <select id="Tax" onchange="Taxperc(this,0)" class="form-control select2 producttaxes" required="" name="Tax[<?php echo $count;?>]">
            <?php    $data = $this->GM->Taxes($status = "1", "0");
                $this->GM->Option_($data, 'Tax_Id', 'Tax', '', 'Select', $Products->Trans_GoodsTransferProduct_Tax_Id);
                ?></select>
            <input type="hidden" class="producttaxamount" name="Taxamount[<?php echo $count;?>]" id="Taxamount" value="<?php echo $Products->Trans_GoodsTransferProduct_Taxcost;?>">
            <input type="text" class="hideinputtext producttaxpercentage" value="0.00" id="Taxpercentage[<?php echo $count;?>]" value="<?php echo $Products->TaxPercentage;?>"></td>
            <td>
              <input type="number" class="form-control input-md" id="productamount" step="0.01" min="0.01" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required="" readonly="" name="productamount[<?php echo $count;?>]" value="<?php echo $Products->Trans_GoodsTransferProduct_Grandtotal;?>">
              <input type="hidden" id="producttotalamount"></td><td><input type="text" class="form-control input-md productDescription" name="productdesc[<?php echo $count;?>]" placeholder="Enter Description"  value="<?php echo $Products->Trans_GoodsTransferProduct_Description;?>"></td><td><button type="button" class="btn" onclick="Deleterow(this)">Delete</button></td></tr>
<?php }?>               
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
                  <th style="width:50%">Sub Total</th>
                  <td><input type="text" class="borderless" name="GoodsTransfer__Subtotal" required readonly id="GoodsTransfer__Subtotal"></td>
                </tr>
                <tr>
                  <th>Discount</th>
                  <td><input type="text" class="borderless" name="GoodsTransfer_TotalDiscountAmount" required readonly id="GoodsTransfer_TotalDiscountAmount"></td>
                </tr>
                <tr>
                  <th>Tax</th>
                  <td><input type="text" class="borderless" id="GoodsTransfer_TotalTaxAmount" required readonly name="GoodsTransfer_TotalTaxAmount"></td>
                </tr>

                <tr>
                  <th>Total</th>
                  <td><input type="text" class="borderless" id="GoodsTransfer_GrandTotalAmount" required readonly name="GoodsTransfer_GrandTotalAmount"></td>
                </tr>
              </table>
            </div>

          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Reference</label>
              <input type="text" class="form-control input-md" required name="GoodsTransfer_Reference" placeholder="Enter Reference" value="<?php echo @set_value('GoodsTransfer_Reference') . @$GoodsTransfer_Reference; ?>">
              <?php echo form_error('GoodsTransfer_Reference'); ?>
            </div>
            <div class="form-group">
              <label>Description</label>
              <input type="text" class="form-control input-md" required name="GoodsTransfer_Description" placeholder="Enter Description" value="<?php echo @set_value('GoodsTransfer_Description') . @$GoodsTransfer_Description; ?>">
              <?php echo form_error('GoodsTransfer_Description'); ?>
            </div>
          </div>

        </div>
      </div>
      <div class="box-footer">
        <a href="<?php echo site_url('Inventory/GoodsTransfer'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
        <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
          <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
      </div>
      </form>
    </div>
  </section>
</div>

<script>


  function Taxperc(e, id) {

    var Tax_Id = e.options[e.selectedIndex].value;

    if (Tax_Id) {

      $(function() {
        $.ajax({
          type: 'GET',
          url: '<?php echo site_url('Inventory/Tax'); ?> ',
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
      $("#GoodsTransfer_GrandTotalAmount").val(totalPrice);

      subtotal = (parseFloat(subtotal) + parseFloat(output)).toFixed(3);
      subtotal = ((isNaN(subtotal)) ? '0' : subtotal);
      $("#GoodsTransfer__Subtotal").val(subtotal);

      totalTax = (parseFloat(totalTax) + parseFloat(Taxval)).toFixed(3);
      totalTax = ((isNaN(totalTax)) ? '0' : totalTax);
      $("#GoodsTransfer_TotalTaxAmount").val(totalTax);

      totaldiscount = (parseFloat(totaldiscount) + parseFloat(discountval)).toFixed(3);
      totaldiscount = ((isNaN(totaldiscount)) ? '0' : totaldiscount);
      $("#GoodsTransfer_TotalDiscountAmount").val(totaldiscount);

    });

  }
  function warehouse() {
    $("#to_warehouse_id").html('');
        var e = document.getElementById("to_branch_id");
        var Id =  $('#to_branch_id option:selected').attr('max');     
        if (Id) {
            $(function() {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url('API/Warehouse'); ?> ',
                    data: {
                        db: Id                    
                    },
                    success: function(data) {
                        $("#to_warehouse_id").html(data);
                    }
                });
            });
        } 
    }
</script>
<?php include('Includes/Foot.php'); ?>