<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>GoodsJournal</h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">GoodsJournal Details</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Inventory/GoodsJournal_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
                </div>
            </div>
            <?php echo form_open_multipart(site_url('Inventory/GoodsJournal_') . $But . '/', 'role="form"'); ?>
            <input type="hidden" name="GoodsJournal_Id" value="<?php echo @$GoodsJournal_Id; ?>">
            <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />


            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>GoodsJournal Type</label>
                            <select id="GoodsJournalType_Id" required class="form-control select2" name="GoodsJournalType_Id">
                                <?php
                                $data = $this->GM->GoodsJournalType();
                                $this->GM->Option_($data, 'GoodsJournalType_Id', 'GoodsJournalTypeName', '', 'Select', @set_value('GoodsJournalType_Id') . @$GoodsJournalType_Id);
                                ?>
                            </select>
                            <?php echo form_error('GoodsJournalType_Id'); ?>
                        </div>

                        <div class="form-group">
                            <label>Warehouse</label>
                            <select id="from_warehouse_id" onchange="from_warehouse_goods()" required class="form-control select2" name="from_warehouse_id">
                                <?php
                                $data = $this->GM->Warehouse();
                                $this->GM->Option_($data, 'Warehouse_Id', 'WarehouseName', '', 'Select', @set_value('from_warehouse_id') . @$from_warehouse_id);
                                ?>
                            </select>
                            <?php echo form_error('from_warehouse_id'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="text" onkeypress="return false;" id="goodsjournal_date" class="form-control input-md Date" required name="goodsjournal_date" placeholder="Enter Date" value="<?php echo @set_value('goodsjournal_date ') . @$goodsjournal_date; ?>">
                            <?php echo form_error('goodsjournal_date '); ?>
                        </div>

                        <div class="form-group">
                            <label>reference</label>
                            <input type="text" id="goodsjournal_reference" class="form-control input-md" required name="goodsjournal_reference" placeholder="Enter Reference" value="<?php echo @set_value('goodsjournal_reference') . @$goodsjournal_reference; ?>">
                            <?php echo form_error('goodsjournal_reference'); ?>
                        </div>
                        <div class="form-group">
                            <label>description</label>
                            <input type="text" id="goodsjournal_description" class="form-control input-md" required name="goodsjournal_description" placeholder="Enter Description" value="<?php echo @set_value('goodsjournal_description') . @$goodsjournal_description; ?>">
                            <?php echo form_error('goodsjournal_description'); ?>
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
include('Includes/Foot.php');
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
    function from_warehouse_goods() {
        if ($.fn.DataTable.isDataTable("#Goodslist")) {
            $('#Goodslist').DataTable().clear().destroy();
        }
        var e = document.getElementById("from_warehouse_id");
        var Id = e.options[e.selectedIndex].value;
        if (Id) {
            $(function() {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url('API/Goods'); ?> ',
                    data: {
                        Warehouse_Id: Id
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