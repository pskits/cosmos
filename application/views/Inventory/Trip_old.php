<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Trip</h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Trip Details</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Inventory/Trip_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
                </div>
            </div>
            <?php echo form_open_multipart(site_url('Inventory/Trip_') . $But . '/', 'role="form"'); ?>
            <input type="hidden" name="Trip_Id" value="<?php echo @$Trip_Id; ?>">
            <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
            <input type="hidden" name="Trip_status_id" value="1">

            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Warehouse</label>
                            <select id="Warehouseid" onchange="Area()" required class="form-control select2" name="Warehouseid">
                                <?php
                                $data = $this->GM->Warehouse();
                                $this->GM->Option_($data, 'Warehouse_Id', 'WarehouseName', '', 'Select', @set_value('Warehouseid') . @$Warehouseid);
                                ?>
                            </select>
                            <?php echo form_error('Warehouseid'); ?>
                        </div>
                        <div class="form-group">
                            <label>Area</label>
                            <select id="area_Id" required class="form-control select2" name="area_Id">
                            </select>
                            <?php echo form_error('area_Id'); ?>
                        </div>
                        <div class="form-group">
                            <label>Truck</label>
                            <select id="Truck" required class="form-control select2" name="Truck_Id">
                                <?php
                                $data = $this->GM->Truck();
                                $this->GM->Option_($data, 'Truck_Id', 'name', '', 'Select', @set_value('Truck_Id') . @$Truck_Id);
                                ?>
                            </select>
                            <?php echo form_error('Truck_Id'); ?>
                        </div>
                        <div class="form-group">
                            <label>Driver</label>
                            <select id="Driver" required class="form-control select2" name="Driver_Id">
                                <?php
                                $data = $this->GM->Driver();
                                $this->GM->Option_($data, 'Driver_Id', 'firstname', '', 'Select', @set_value('Driver_Id') . @$Driver_Id);
                                ?>
                            </select>
                            <?php echo form_error('Driver_Id'); ?>
                        </div>
                        <div class="form-group">
                            <label>Helper</label>
                            <select id="Helper" required class="form-control select2" name="Helper_Id">
                                <?php
                                $data = $this->GM->Helper();
                                $this->GM->Option_($data, 'Helper_Id', 'firstname', '', 'Select', @set_value('Helper_Id') . @$Helper_Id);
                                ?>
                            </select>
                            <?php echo form_error('Helper_Id'); ?>
                        </div>
                        <div class="form-group">
                            <label>AssignDate</label>
                            <input type="text" onkeypress="return false;" id="AssignDate" class="form-control input-md Date" required name="AssignDate" placeholder="Enter AssignDate" value="<?php echo @set_value('AssignDate') . @$AssignDate; ?>">
                            <?php echo form_error('AssignDate'); ?>
                        </div>
                        <div class="form-group">
                            <label>AssignTime</label>
                            <input type="text" onkeypress="return false;" id="AssignTime" class="form-control input-md Timepicker" required name="AssignTime" placeholder="Enter AssignTime" value="<?php echo @set_value('AssignTime') . @$AssignTime; ?>">
                            <?php echo form_error('AssignTime'); ?>
                        </div>
                        <div class="form-group">
                            <label>description</label>
                            <input type="text" id="description" class="form-control input-md" required name="description" placeholder="Enter description" value="<?php echo @set_value('description') . @$description; ?>">
                            <?php echo form_error('description'); ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="Invoice" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Invoice No</th>
                                        <th>Invoice Date</th>
                                        <th>Quantity</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-6 pull-right">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Total Quantity:</th>
                                    <td style="width:70%;" id="total"></td>
                                </tr>
                            </table>
                        </div>
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
    function Addrow(data, payableamount = 0.00) {
        data = JSON.parse(data);
        var table = document.getElementById("Invoice").getElementsByTagName('tbody')[0];
        for (i = 0; i < data.length; i++) {
            var rows = document.getElementById("Invoice").rows.length;
            var row = table.insertRow(-1);
            var cell0 = row.insertCell(0);
            var cell1 = row.insertCell(1);
            var cell2 = row.insertCell(2);
            var cell3 = row.insertCell(3);
            rows--;
            cell0.innerHTML = data[i].Invoice_No;
            cell1.innerHTML = data[i].FormattedInvoiceDate;
            cell2.innerHTML = data[i].TotalQty;
            cell3.innerHTML = `<span class="input-group-addon"><input type="checkbox" onclick="calAmount()" class="Invoice_Id" id="Invoice_Id" max="` + data[i].TotalQty + `" Value="` + data[i].Invoice_Id + `" name="Invoice_Id[` + rows + `]" ></span>`;
        }
    }
</script>
<script>
    function invoicelist() {
        var e = document.getElementById("Warehouseid");
        var Id = e.options[e.selectedIndex].value;
        $("#Invoice tbody tr").remove();
        if (Id) {
            $(function() {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url('API/InvoiceNotTrippedlist'); ?> ',
                    data: {
                        Warehouseid: Id,
                        Invoice_status_Id: '1'
                    },
                    success: function(data) {
                        Addrow(data);
                        calAmount();
                    }
                });
            });
        } else {
            calAmount();
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


//Modal
//Trip
    function Trip_Validation()
    {
        $this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
        $this->form_validation->set_rules('User_Id', 'User_Id', 'required');
        $this->form_validation->set_rules('Warehouseid', 'Warehouseid', 'required');
        $this->form_validation->set_rules('area_Id', 'area_Id', 'required');
        $this->form_validation->set_rules('Truck_Id', 'Truck_Id', 'required');
        $this->form_validation->set_rules('Invoice_Id[]', 'Invoice_Id', 'required');
        $this->form_validation->set_rules('Driver_Id', 'Driver_Id', 'required');
        $this->form_validation->set_rules('Helper_Id', 'Helper_Id', 'required');
        $this->form_validation->set_rules('AssignDate', 'AssignDate', 'required');
        $this->form_validation->set_rules('AssignTime', 'AssignTime', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        $this->form_validation->set_rules('Trip_status_id', 'Trip_status_id', 'required');
        $this->form_validation->set_rules('Abut', 'Abut', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msgU', "Please Fill all Required Details");
            print_r(validation_errors());
            print_r($_POST);
            // echo "<script> history.go(-1); </script>";
        } else {
            return true;
        }
    }
    function Trip_Save()
    {
            $datetime = $_POST['AssignDate'] . ' ' . $_POST['AssignTime'];
            $qry = "Exec_Trip '" . $_POST['Warehouseid'] . "'
							,'" . $_POST['area_Id'] . "'
							,'" . $_POST['Truck_Id'] . "'
							,'" . $_POST['Driver_Id'] . "'
							,'" . $_POST['Helper_Id'] . "'
							,'" .  $this->GM->DateTimeSplit($datetime) . "'
							,'" . $_POST['description'] . "'
							,'" . $_POST['Trip_status_id'] . "'
							,'" . $_POST['User_Id'] . "'
							,'1'
							,'" . $_POST['Abut'] . "'
                            ";
                            $query = $this->db->query($qry);
                            $query = $query->result();
                            foreach ($query as $Row) {
                                $lastid = $Row->LastID;
                                $directory = Trip_directory . "/" . $_SESSION['currentdatabasename'] . "/" . $lastid;
                                if (!is_dir($directory)) {
                                    mkdir($directory, 0777, TRUE);
                                }
                            }
                        if ($lastid) {
                            $Invoice_Id = $_POST['Invoice_Id'];
                            $query = true;
                            foreach ($Invoice_Id as $key => $n) {
                                $qry = '';
                                if ($query == false) {
                                    $this->session->set_flashdata('msgD', 'Partial Trip Amount Not Saved Contact System Admin!');
                                    echo "<script>history.go(-1);</script>";
                                    exit;
                                }
                                $qry = "Exec_TripInvoice '" . $lastid . "'				
                                                                ,'" . $Invoice_Id[$key] . "'
                                                                ,'1'			
                                                                ,'" . $_POST['User_Id'] . "'
                                                                ,'1'
                                                                ,'" . $_POST['Abut'] . "'
                                                                ";
                                $query = $this->GM->prdinsert($qry);
                            }
                            $this->session->set_flashdata('msgS', 'Success!!!');
                        } else {
                            $this->session->set_flashdata('msgU', "Trip Amount Not Saved");
                        }
                        echo "<script> history.go(-1); </script>";
                    }
}
