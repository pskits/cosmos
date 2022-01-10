<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');

?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Sales Return Voucher</h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Sales Return Voucher Details</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Collection/Voucher_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
                    <a href="<?php echo site_url('Collection/Voucher'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <?php echo form_open_multipart(site_url('Collection/DebitAgainstSalesReturn_') . $But . '/', 'role="form"'); ?>
            <input type="hidden" name="Voucher_Id" value="<?php echo @$Voucher_Id; ?>">
            <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
            <input type="hidden" name="Portal_Id" id="Portal_Id" value="1" />
            <input type="hidden" name="Voucher_status_id" id="Voucher_status_id" value="1" />
            <div class="box-body">
                <div style="color:red;">
                    <?php print_r(validation_errors()); ?>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Voucher Type</label>
                            <select  id="Voucher_Type_Id" required class="form-control select2" name="Voucher_Type_Id">
                                <?php
                                $VoucherType = $this->GM->VoucherType('2', @set_value('Voucher_Type_Id') . @$Voucher_Type_Id);
                                $this->GM->Option_($VoucherType, 'Voucher_Type_Id', 'Voucher_TypeName', '', 'Select',  @set_value('Voucher_Type_Id') . @$Voucher_Type_Id);
                                ?>
                            </select>
                            <?php echo form_error('Voucher_Type_Id'); ?>
                        </div>
                        <div class="form-group">
                            <label>Amount Mode</label>
                            <select id="AmountMode_id" onchange="cheque()" required class="form-control select2" name="AmountMode_id">
                                <?php
                                $data = $this->GM->AmountMode();
                                $this->GM->Option_($data, 'AmountMode_Id', 'AmountModeName', '', 'Select', @set_value('AmountMode_id') . @$AmountMode_id);
                                ?>
                            </select>
                            <?php echo form_error('AmountMode_id'); ?>
                        </div>
                        <div class="form-group">
                            <label>Debit Amount (<?php echo $_SESSION['Currencycode']; ?>)</label>
                            <input type="number" value="<?php echo $_POST['amount']; ?>" onchange="calAmount()" step="0.01" min="0.00" class="form-control input-md" id="amount" required readonly name="amount" placeholder="Enter amount">
                            <br> <?php echo form_error('amount'); ?>
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
                    <div class="col-sm-6 cheque_segment">
                        <div class="form-group">
                            <label>Bank</label>
                            <select id="Bank_Id" style="width: 100%;" class="form-control select2" name="Bank_Id">
                                <?php
                                $data = $this->GM->Bank();
                                $this->GM->Option_($data, 'Bank_Id', 'BankName', '', 'Select', @set_value('Bank_Id') . @$Bank_Id);
                                ?>
                            </select>
                            <?php echo form_error('Bank_Id'); ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="Invoice" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Against</th>
                                        <th>Reference</th>
                                        <th>Credit Amount (<?php echo $_SESSION['Currencycode']; ?>)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="hidden" name="SalesReturn_Id" value="<?php echo $_POST['SalesReturn_Id'];?>"><input type="hidden" id="Against_Id" required="" name="Against_Id[0]" value="<?php echo $_POST['SalesReturn_Id']; ?>">
                                            <?php echo $_POST['SalesReturn_No']; ?>
                                        </td>
                                        <td><input type="text" class="form-control input-md " name="Reference" id="Reference" value="" minlength="5" required=""></td>
                                        <td><input type=" number" onchange="calAmount()" class="form-control input-md InvoicePayAmount" value="<?php echo $_POST['amount']; ?>" readonly id="InvoicePayAmount" value="" step="0.01" min="0.00" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required="" name="PayAmount[0]"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="<?php echo site_url('Collection/Voucher'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
                    <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
                        <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
                </div>
                </form>
            </div>
    </section>
</div>
<?php
include('Foot.php');
include('assets/plugin/gmap_latlong.php');
?>
<script>
    cheque();
    function cheque() {
        var id = $("#AmountMode_id").find("option:selected").attr("value");
        if (id == '1') {
            $(".cheque_segment").show();
            $(".cheque_segment").find("Select").prop("required", true);
        } else {
            $(".cheque_segment").hide();
            $(".cheque_segment").find("Select").removeAttr("required");
        }
    }
    function deletetablerows() {
        var old_tbody = document.getElementById("Invoice").getElementsByTagName('tbody')[0];
        var new_tbody = document.createElement('tbody');
        old_tbody.parentNode.replaceChild(new_tbody, old_tbody);
    }
</script>
<script>
    function calAmount() {
        var amount = (parseFloat($('#amount').val())).toFixed(2);
        var InvoicePayTotal = 0.00;
        $(".InvoicePayAmount").each(function(index) {
            InvoicePayTotal = (parseFloat(InvoicePayTotal) + parseFloat($(".InvoicePayAmount").eq(index).val())).toFixed(2);
        });
        if (parseFloat(amount) != parseFloat(InvoicePayTotal)) {
            alert('Debit Amount and Credit Amount is Not Equal');
        }
        // excess     
    }
</script>