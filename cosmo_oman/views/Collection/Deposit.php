<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Deposit</h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Deposit Details</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Collection/Deposit_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
                    <a href="<?php echo site_url('Collection/Deposit'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <?php echo form_open_multipart(site_url('Collection/Deposit_') . $But . '/', 'role="form"'); ?>
            <input type="hidden" name="Deposit_Id" value="<?php echo @$Deposit_Id; ?>">
            <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
            <input type="hidden" name="Deposit_status_id" id="Deposit_status_id" value="1" />
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Bank</label>
                            <select id="Bank_Id" required class="form-control select2" name="Bank_Id">
                                <?php
                                $data = $this->GM->Bank();
                                $this->GM->Option_($data, 'Bank_Id', 'BankName', '', 'Select', @set_value('Bank_Id') . @$Bank_Id);
                                ?>
                            </select>
                            <?php echo form_error('Bank_Id'); ?>
                        </div>
                        <div class="form-group">
                            <label>Amount Mode</label>
                            <select id="AmountMode_id" onchange="invoicelist()" required class="form-control select2" name="AmountMode_id">
                                <?php
                                $data = $this->GM->AmountMode();
                                $this->GM->Option_($data, 'AmountMode_Id', 'AmountModeName', '', 'Select', @set_value('AmountMode_id') . @$AmountMode_id);
                                ?>
                            </select>
                            <?php echo form_error('AmountMode_id'); ?>
                        </div>
                        <div class="form-group">
                            <label>Branch</label>
                            <input type="text" minlength="3" class="form-control input-md" id="Branch" required name="Branch" placeholder="Enter Branch" value="<?php echo @set_value('Branch') . @$Branch; ?>">
                            <br> <?php echo form_error('Branch'); ?>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" minlength="3" class="form-control input-md" id="description" required name="description" placeholder="Enter description" value="<?php echo @set_value('description') . @$description; ?>">
                            <br> <?php echo form_error('description'); ?>
                        </div>
                        <div class="form-group">
                            <label>Geo</label>
                            <input type="hidden" required name="lat" id="lat">
                            <input type="hidden" required name="lng" id="lng">
                            <input type="text" id="geo" onclick="gmap_latlong_modal()" class="form-control input-md" required name="geo" placeholder="Enter geo" value="<?php echo @set_value('geo') . @$geo; ?>">
                            <?php echo form_error('geo'); ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="Invoice" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Collection No</th>
                                        <th>Collection Date</th>
                                        <th>Amount</th>
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
                            <table style="display:none;" class="table">
                                <tr>
                                    <th>Total (<?php echo $_SESSION['Currencycode']; ?>):</th>
                                    <td style="width:70%;" id="total"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="<?php echo site_url('Collection/Deposit'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
                    <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
                        <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
                </div>
                </form>
            </div>
    </section>
</div>
<?php
include('Includes/Foot.php');
include('assets/plugin/gmap_latlong.php');
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
            cell0.innerHTML = data[i].Collection_no;
            cell1.innerHTML = data[i].Collection_Dateformatted;
            cell2.innerHTML = data[i].amount;
			var amountmax = data[i].amount;
			amountmax = Number(amountmax).toFixed(3);
            cell3.innerHTML = `<span class="input-group-addon"><input type="checkbox" onclick="calAmount()" class="Collection_Id" id="Collection_Id" max="` + amountmax+ `" Value="` + data[i].Colletion_Id + `" name="Collection_Id[` + rows + `]" ></span>`;
        }
    }
</script>
<script>
    function invoicelist() {
        var e = document.getElementById("AmountMode_id");
        var Id = e.options[e.selectedIndex].value;
        $("#Invoice tbody tr").remove();
        if (Id) {
            $(function() {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url('API/Collectioninvoicelist'); ?> ',
                    data: {
                        AmountMode_Id: Id,
                        collectedUser_Id: <?php echo $this->session->userdata['cosmolog']['UId']; ?>
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
        var InvoiceTotal = 0.000;
        $(".Collection_Id:checked").each(function(index) {
            InvoiceTotal = (parseFloat(InvoiceTotal) + parseFloat($(".Collection_Id").eq(index).attr('max'))).toFixed(3);
        });
        console.log(InvoiceTotal);
        $('#total').html(InvoiceTotal);
    }
</script>