<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">

    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Credit Note</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Accounts/CreditNote_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
                    <a href="<?php echo site_url('Accounts/Creditnote'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <?php echo form_open_multipart(site_url('Accounts/Creditnote_Save'), 'role="form"'); ?>
            <input type="hidden" name="Collection_Id" value="<?php echo @$Collection_Id; ?>">
            <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
            <input type="hidden" name="Creditnote_status_Id" id="Creditnote_status_Id" value="1" />
            <div class="box-body">
             
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Dealer</label>
                            <select onchange="Dealerinvoicelist(this)" id="Dealer_Id" required class="form-control select2" name="Dealer_Id">
                                <?php
                                $data = $this->GM->dealer();
                                $this->GM->Option_($data, 'Dealer_Id', 'name', '', 'Select', @set_value('Dealer_Id') . @$Dealer_Id);
                                ?>
                            </select>
                            <?php echo form_error('Dealer_Id'); ?>
                        </div>
                     
                        <div class="form-group">
                            <label>Amount (<?php echo $_SESSION['Currencycode']; ?>)</label>
                            <input type="number" value="0.00" onchange="calAmount()" step="0.01" min="0.00" class="form-control input-md" id="amount" required name="amount" placeholder="Enter amount" value="<?php echo @set_value('amount') . @$amount; ?>">
                            <br> <?php echo form_error('amount'); ?>
                        </div>
						   <div class="form-group">
                            <label>Date</label>
                            <input type="text" class="form-control input-md Date" required readonly name="CreditnoteDate" placeholder="Enter date" value="<?php echo @set_value('CreditnoteDate') . @$CreditnoteDate; ?>">
                            <br> <?php echo form_error('CreditnoteDate'); ?>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" minlength="3" class="form-control input-md" id="description" required name="description" placeholder="Enter description" value="<?php echo @set_value('description') . @$description; ?>">
                            <br> <?php echo form_error('description'); ?>
                        </div>
                       
                    </div>
                
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="Invoice" class="table table-striped">
                                <thead>
								  <tr style="text-align:center;">
                                        <th colspan="2">Credit</th>
                                        <th >Debit</th>
                                        <th colspan="2">Amount</th>
                                    </tr>
                                    <tr>
                                        <th>Invoice No</th>
                                        <th>Invoice Date</th>                                       
										<th>Debit Against</th>
										 <th>Balance Amount</th>
                                        <th>Adjusting Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="<?php echo site_url('Collection'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
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
    cheque();
    function cheque() {
        var id = $("#AmountMode_id").find("option:selected").attr("value");
        if (id == '1') {
            $(".cheque_segment").show();
            $(".cheque_segment").find("input").prop("required", true);
        } else {
            $(".cheque_segment").hide();
            $(".cheque_segment").find("input").removeAttr("required");
        }
    }
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
			var cell4 = row.insertCell(4);
            rows--;
            cell0.innerHTML = data[i].Invoice_No + `<input type="number"  style="width:0px;height:0px;background-color:transparent;color:transparent;border-color:transparent;" id="Against_Id" class="Against_Id" onkeypress="return false;" required name="AdjustmentAgainst_Id[` + rows + `]" value="` + data[i].Invoice_Id + `">`;
            cell1.innerHTML = data[i].FormattedInvoiceDate;
			cell2.innerHTML = `<select id="AgainstOfficeLedger_Id"  style="width: 100%;" class="form-control select2"  name="AgainstOfficeLedger_Id[` + rows + `]" ><?php $dataVoucherAgainst = $this->GM->OfficeLedger($OfficeLedger_id = "0", $LedgerType_Id = "14", $Against_Id = "35");echo "<option value='".$dataVoucherAgainst[0]->OfficeLedger_id."'>".$dataVoucherAgainst[0]->Ledgername."</option>";$dataVoucherAgainst = $this->GM->OfficeLedger($OfficeLedger_id = "0", $LedgerType_Id = "14", $Against_Id = "130");echo "<option value='".$dataVoucherAgainst[0]->OfficeLedger_id."'>".$dataVoucherAgainst[0]->Ledgername."</option>";?></select>`;
            cell3.innerHTML = data[i].Invoice_Due;
            cell4.innerHTML = `<input type="number"  class="form-control input-md InvoicePayAmount" id="InvoicePayAmount" Value="` + payableamount + `" step="0.01" min="0.00" max="` + data[i].Invoice_total + `" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required name="adjustableamount[` + rows + `]" >`;
        }
    }
</script>
<script>
    function Dealerinvoicelist(e) {
        var Id = e.options[e.selectedIndex].value;
        $("#Invoice tbody tr").remove();
        if (Id) {
            $(function() {
                $.ajax({
                    type: 'GET',
                    url: '<?php echo site_url('API/Dealerinvoicelist'); ?> ',
                    data: {
                        Dealer_Id: Id
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
        var amount = (parseFloat($('#amount').val())).toFixed(3);
        var InvoiceTotal = 0.000;
        var InvoicePayTotal = 0.000;
        $(".InvoicePayAmount").each(function(index) {
            InvoicePayTotal = (parseFloat(InvoicePayTotal) + parseFloat($(".InvoicePayAmount").eq(index).val())).toFixed(3);
            InvoiceTotal = (parseFloat(InvoiceTotal) + parseFloat($(".InvoicePayAmount").eq(index).attr('max'))).toFixed(3);
            if ($(".Against_Id").eq(index).val() == '-1') {
                $(".Against_Id").eq(index).closest('tr').remove();
            }
        });
        if (amount == InvoicePayTotal) {} else {
            splitableamount = amount;
            $(".InvoicePayAmount").each(function(index) {
                max = (parseFloat($(".InvoicePayAmount").eq(index).attr('max'))).toFixed(3);
                CurrentInvoiceAmount = (parseFloat($(".InvoicePayAmount").eq(index).val())).toFixed(3);
                CurrentInvoiceAmount = (parseFloat(CurrentInvoiceAmount) >= parseFloat(max)) ? max : CurrentInvoiceAmount;
                if (parseFloat(CurrentInvoiceAmount) > (parseFloat('0.00')).toFixed(3)) {
                    invoicepayableamount = (parseFloat(splitableamount) >= parseFloat(CurrentInvoiceAmount)) ? CurrentInvoiceAmount : splitableamount;
                } else {
                    invoicepayableamount = (parseFloat(splitableamount) >= parseFloat(max)) ? max : splitableamount;
                }
                $(".InvoicePayAmount").eq(index).val(invoicepayableamount);
                splitableamount = (parseFloat(splitableamount) - parseFloat(invoicepayableamount)).toFixed(3);
            });
            if (parseFloat(splitableamount) > parseFloat('0.00')) {
                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();
                today = dd + '/' + mm + '/' + yyyy;
                excess = splitableamount
                var arr = {
                    Invoice_No: 'Excess',
                    Invoice_Id: '-1',
                    Invoice_total: excess,
                    Invoice_Due : '',   
                    FormattedInvoiceDate: today
                };
                mainarr = [arr];
                var serializedArr = JSON.stringify(mainarr);
                Addrow(serializedArr, excess)
            }
        }
        // excess
        amount = 0.000;
        $(".InvoicePayAmount").each(function(index) {
            amount = (parseFloat(amount) + parseFloat($(".InvoicePayAmount").eq(index).val())).toFixed(3);
        });
        $('.amount').val(amount);
    }
</script>