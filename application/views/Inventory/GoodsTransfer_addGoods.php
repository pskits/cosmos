<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>GoodsTransfer</h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"> GoodsTransfer Serial no</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Inventory/GoodsTransfer_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
                </div>
            </div>
            <?php echo form_open_multipart(site_url('Inventory/GoodsTransfer_') . $But . '/', 'role="form"'); ?>
            <input type="hidden" name="GoodsTransfer_Id" value="<?php echo $_POST['GoodsTransfer_Id'] ; ?>">
            <input type="hidden" name="to_branch_id" value="<?php echo $_POST['to_branch_id'] ; ?>">
            <input type="hidden" name="to_warehouse_id" value="<?php echo $_POST['to_warehouse_id'] ; ?>">
            <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>From Warehouse</label>
                            <select id="from_warehouse_id" onchange="from_warehouse_goods()" required class="form-control select2" name="from_warehouse_id">
                                <?php
                                $data = $this->GM->Warehouse($status = "1", $_POST['from_warehouse_id']);
                                $this->GM->Option_($data, 'Warehouse_Id', 'WarehouseName', '', 'Select', @set_value('from_warehouse_id') . @$from_warehouse_id);
                                ?>
                            </select>
                            <?php echo form_error('from_warehouse_id'); ?>
                        </div>
                    </div>
                   
                    <div class="col-md-12">
                        <table id="Goodslist" class="display nowrap " style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
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
include('Foot.php');
?>
<script>
    function Addrow(data) {
        data = JSON.parse(data);
        var table = document.getElementById("Goodslist").getElementsByTagName('tbody')[0];
        for (i = 0; i < data.length; i++) {
            var rows = document.getElementById("Goodslist").rows.length;
            var row = table.insertRow(-1);
            var cell0 = row.insertCell(0);
            var cell1 = row.insertCell(1);
            var cell2 = row.insertCell(2);
            var cell3 = row.insertCell(3);
            rows--;
            cell0.innerHTML = i+1;
            cell1.innerHTML = data[i].Product;
            cell2.innerHTML = data[i].Serial_No;
            cell3.innerHTML = `<span class="input-group-addon"><input type="checkbox"  class="Goods_Id" id="Goods_Id"  Value="` + data[i].Goods_Id + `" name="Goods_Id[` + rows + `]" ></span>`;
        }
        var table = $('#Goodslist').DataTable({
            responsive: true,
        });
    }
</script>
<script>
from_warehouse_goods();
    function from_warehouse_goods() {
        var product_Id = '<?php echo base64_decode($_GET['Key2']);?>';
        var e = document.getElementById("from_warehouse_id");
        var Id = e.options[e.selectedIndex].value;
        if (Id) {
            $(function() {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url('API/Goods'); ?> ',
                    data: {
                        Warehouse_Id: Id,
                        Product_Id:product_Id
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
        var Id = $('#to_branch_id option:selected').attr('max');
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