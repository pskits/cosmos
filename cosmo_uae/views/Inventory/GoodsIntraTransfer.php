<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>GoodsTransfer</h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Intra Branch GoodsTransfer Details</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Inventory/GoodsTransfer_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
                </div>
            </div>
            <?php echo form_open_multipart(site_url('Inventory/GoodsTransfer_') . $But . '/', 'role="form"'); ?>
            <input type="hidden" name="GoodsTransfer_Id" value="<?php echo @$GoodsTransfer_Id; ?>">
            <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
            <input type="hidden" name="GoodsTransferType" value="2">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>From Warehouse</label>
                            <select id="from_warehouse_id" onchange="from_warehouse_goods()" required class="form-control select2" name="from_warehouse_id">
                                <?php
                                $data = $this->GM->Warehouse();
                                $this->GM->Option_($data, 'Warehouse_Id', 'WarehouseName', '', 'Select', @set_value('from_warehouse_id') . @$from_warehouse_id);
                                ?>
                            </select>
                            <?php echo form_error('from_warehouse_id'); ?>
                        </div>                       
                        
                                <?php
                                $data = $this->GM->Office($officetype = "2", $status = "1", $Id = "0", $_SESSION['currentdatabasename']);
                               foreach($data as $branch)
                               {
                                   ?>
                                  <input type="hidden" name="to_branch_id" id="to_branch_id" value="<?php echo $branch->office_Id; ?>">
                                   <?php

                               }
                                ?>
                          
                        <div class="form-group">
                            <label>To warehouse</label>
                            <select id="to_warehouse_id" required class="form-control select2" name="to_warehouse_id">
                            <?php
                                $data = $this->GM->Warehouse();
                                $this->GM->Option_($data, 'Warehouse_Id', 'WarehouseName', '', 'Select', @set_value('to_warehouse_id') . @$to_warehouse_id);
                                ?>
                            </select>
                            <?php echo form_error('to_warehouse_id'); ?>
                        </div>
								 <div class="form-group">
                            <label>Product_Id</label>
                            	<select  id="Product_Id" onchange="from_warehouse_goods()" class="form-control select2 productname" required name="Product_Id">
						<?php
							$data = $this->GM->Product($status = "1", $productcategory_id = "0", $id = "0");
							$this->GM->Option_($data, 'Product_Id', 'Product', '', 'Select', '0'); 
						?>
						</select>
                            <?php echo form_error('Product_Id'); ?>
                        </div>
                    </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="text" onkeypress="return false;" id="goodstransfer_date" class="form-control input-md Date" required name="goodstransfer_date" placeholder="Enter Date" value="<?php echo @set_value('goodstransfer_date ') . @$goodstransfer_date ; ?>">
                            <?php echo form_error('goodstransfer_date '); ?>
                        </div>
                       
                        <div class="form-group">
                            <label>reference</label>
                            <input type="text" id="GoodsTransfer_Reference" class="form-control input-md" required name="GoodsTransfer_Reference" placeholder="Enter GoodsTransfer_Reference" value="<?php echo @set_value('GoodsTransfer_Reference') . @$GoodsTransfer_Reference; ?>">
                            <?php echo form_error('GoodsTransfer_Reference'); ?>
                        </div>
                        <div class="form-group">
                            <label>description</label>
                            <input type="text" id="GoodsTransfer_Description" class="form-control input-md" required name="GoodsTransfer_Description" placeholder="Enter GoodsTransfer_Description" value="<?php echo @set_value('GoodsTransfer_Description') . @$GoodsTransfer_Description; ?>">
                            <?php echo form_error('GoodsTransfer_Description'); ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                    <table id="Goodslist" class="display nowrap " style="width:100%">
          <thead>
            <tr>
            
              <th>Product</th>
              <th>Serial_No</th>             
              <th></th>
            </tr>
          </thead>
          <tbody>
           
          </tbody>
        </table>
                    </div>
                </div>

            </div>
            <div class="box-footer">
                <a href="<?php echo site_url('Inventory/State'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
                <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
                    <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
            </div>
            </form>
        </div>
    </section>
</div>
<?php
include('Includes/Foot.php');
?>
<script>
    function Addrow(data) {
        data = JSON.parse(data);
		 if ($.fn.DataTable.isDataTable('#Goodslist')) {
        $('#Goodslist').DataTable().destroy();
      }
        var table = document.getElementById("Goodslist").getElementsByTagName('tbody')[0];
        for (i = 0; i < data.length; i++) {
            var rows = document.getElementById("Goodslist").rows.length;
            var row = table.insertRow(-1);
            var cell0 = row.insertCell(0);
            var cell1 = row.insertCell(1);
            var cell2 = row.insertCell(2);           
            rows--;          
            cell0.innerHTML = data[i].Product;
            cell1.innerHTML = data[i].serial_no;
            cell2.innerHTML = `<span class="input-group-addon"><input type="checkbox"  class="Goods_Id" id="Goods_Id"  Value="` + data[i].serial_no + `" name="Goods_Id[` + rows + `]" ></span>`;
        }
		loaddatatable('#Goodslist');
		
    }
</script>
<script>
    function from_warehouse_goods() {
        var e = document.getElementById("from_warehouse_id");
        var Id = e.options[e.selectedIndex].value;      
		 var e = document.getElementById("Product_Id");
        var Product_Id = e.options[e.selectedIndex].value;      
        if (Id&&Product_Id) {
            $(function() {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url('API/Goods'); ?> ',
                    data: {
                        Warehouse_Id: Id , 
Product_Id	: Product_Id					
                    },
                    success: function(data) {
                        Addrow(data);
                       
                     
                    }
                });
            });
        } 
    }
    function warehouse() {
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
<script>
    function calAmount() {
        var InvoiceTotal = 0.00;
        $(".Invoice_Id:checked").each(function(index) {
            InvoiceTotal = (parseFloat(InvoiceTotal) + parseFloat($(".Invoice_Id").eq(index).attr('max'))).toFixed(2);
        });
        console.log(InvoiceTotal);
        $('#total').html(InvoiceTotal);
    }
</script>
<script>
    function Area() {
        var e = document.getElementById("Warehouseid");
        var Warehouseid = e.options[e.selectedIndex].value;
        var Area_Id = '<?php echo @$Area_Id ?>';
        if (Warehouseid) {
            $(function() {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url('Api/Area'); ?> ',
                    data: {
                        warehouse_Id: Warehouseid,
                        Area_Id: Area_Id
                    },
                    success: function(data) {
                        $("#area_Id").html(data);
                    }
                });
            });
        } else {
            $("#area_Id").html('');
        }
        invoicelist();
    }
</script>