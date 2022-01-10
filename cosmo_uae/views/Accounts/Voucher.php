<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Voucher</h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Voucher Details</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Accounts/Voucher_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
                    <a href="<?php echo site_url('Accounts/Voucher'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <?php echo form_open_multipart(site_url('Accounts/Voucher_Save'), 'role="form"'); ?>
            <input type="hidden" name="Voucher_Id" value="<?php echo @set_value('Voucher_Id') . @$Voucher_Id; ?>" >
            <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
            <input type="hidden" name="Source_Id" id="Source_Id" value="4" />
            <input type="hidden" name="VoucherAgainst_Id" id="VoucherAgainst_Id" value="0" />
            <input type="hidden" name="AllTransaction_type_Id" id="AllTransaction_type_Id" value="4" />            
            <input type="hidden" name="Voucher_status_id" id="Voucher_status_id" value="1" />
            <div class="box-body">
                <div style="color:red;">
                    <?php print_r(validation_errors()); ?>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                           <label>Voucher Type</label>
                            <select id="Voucher_Type_Id" required class="form-control select2" name="Voucher_Type_Id">
                                <?php
                                $VoucherType = $this->GM->VoucherType('1', '0');
                                $this->GM->Option_($VoucherType, 'Voucher_Type_Id', 'Voucher_TypeName', '', 'Select', @set_value('Voucher_Type_Id') . @$Voucher_Type_Id);
                                ?>
                            </select>
                            <?php echo form_error('Voucher_Type_Id'); ?>
                        </div>
                        <div class="form-group">
                            <label>Amount Mode</label>
                            <select id="AmountMode_id" required class="form-control select2" name="AmountMode_id">
                                <?php
                                $data = $this->GM->AmountMode($Id = "0", $enable = '2');
                                $this->GM->Option_($data, 'AmountMode_Id', 'AmountModeName', '', 'Select', @set_value('AmountMode_Id') . @$AmountMode_Id);
                                ?>
                            </select>
                            <?php echo form_error('AmountMode_id'); ?>
                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <input type="text" class="form-control input-md Date" required readonly name="Voucher_date" 
							placeholder="Enter date" value="<?php if(isset($_POST['VoucherDate'])) { echo date('d-m-Y',strtotime($_POST['VoucherDate']))  ;} ?>">
                            <br> <?php echo form_error('Voucher_date'); ?>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" minlength="3" class="form-control input-md" id="description" required name="description" 
							placeholder="Enter description" value="<?php echo @set_value('Description') . @$Description; ?>">
                            <br> <?php echo form_error('description'); ?>
                        </div>
                        <div class="form-group">
                            <label>Reference</label>
                            <input type="text" minlength="3" class="form-control input-md" id="Reference" required name="Reference" placeholder="Enter Reference" value="<?php echo @set_value('Reference') . @$Reference; ?>">
                            <br> <?php echo form_error('Reference'); ?>
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
                                        <th>Debit Amount (<?php echo $_SESSION['Currencycode']; ?>)</th>
                                <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                                <?php
												if(isset($_POST['Voucher_Id']))
												{
                                                $count = "0";
                                                $total = 0.00;
                                                foreach ($this->GM->VoucherAmount($status = "1", $_POST['Voucher_Id'], $Id = "0") as $Products) {
                                                    $count++;
                                                ?>
												 <tr>
        <td>
		<select id="Against_Id"  style="width: 100%;" class="form-control select2" required 
		name="Against_Id[<?php echo $count;?>]" >
		<?php $dataVoucherAgainst = $this->GM->OfficeLedger($OfficeLedger_id = "0", $LedgerType_Id = "0", $Against_Id = "0");
		$this->GM->Option_($dataVoucherAgainst, 'OfficeLedger_id', 'Ledgername', '', 'Select', $Products->OfficeLedger_Id); ?>
		</select>
		</td>
        
        <td><input type="text" class="form-control input-md " name="TransactionReference[<?php echo $count;?>]" id="Reference" 
		value="<?php echo $Products->Reference;?>" 
		minlength="1" required="" ></td>
        
        <td><input type="number" onchange="calAmount()" class="form-control input-md Credit" id="InvoicePayAmount"
		value="<?php echo ($Products->amount>0) ?  $Products->amount : 0;?>" 
		step="0.01" min="0.00" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required="" 
		name="Credit[<?php echo $count;?>]"></td>
        
        <td><input type="number" onchange="calAmount()" class="form-control input-md Debit" id="InvoicePayAmount" 
		value="<?php echo ($Products->amount<0) ?  ($Products->amount*-1) : 0;?>" 
		step="0.01" min="0.00" 
		onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required="" name="Debit[<?php echo $count;?>]"></td>
        
        <td><button type="button" class="btn" onclick="Deleterow(this)">Delete</button></td></tr>
                                                
                                                <?php
                                                   
                                                
												}
												}
                                                ?>

                                </tbody>
                                <tfoot>
                                <tr>
                                <td></td>
                                <td>Total</td>
                                <td><input type="number" name="creditotal" id="creditotal" readonly class="form-control"></td>
                                <td><input type="number" name="debittotal" id="debittotal" readonly class="form-control"></td>
                                <td></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <button onclick="AddExpenceRow()" type="button" class="btn btn-tumblr">+ Add New Line</button>
                        <br><br>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="<?php echo site_url('Accounts/Voucher'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
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
function Deleterow(btn) {
    var row = btn.parentNode.parentNode;
    var rowscount = document.getElementById("Invoice").getElementsByTagName('tbody')[0].rows.length;
    if(parseInt(rowscount)>parseInt(2))
    {
        row.parentNode.removeChild(row);
    }
  }
    function AddExpenceRow() {
        var table = document.getElementById("Invoice").getElementsByTagName('tbody')[0];
        var rows = document.getElementById("Invoice").rows.length;
        var row = table.insertRow(-1);
        var cell0 = row.insertCell(0);
        var cell1 = row.insertCell(1);
        var cell2 = row.insertCell(2);
        var cell3 = row.insertCell(3);
        var cell4 = row.insertCell(4);        
        rows--;
        cell0.innerHTML = `<select id="Against_Id"  style="width: 100%;" class="form-control select2" required name="Against_Id[` + rows + `]" ><?php $dataVoucherAgainst = $this->GM->OfficeLedger($OfficeLedger_id = "0", $LedgerType_Id = "0", $Against_Id = "0");$this->GM->Option_($dataVoucherAgainst, 'OfficeLedger_id', 'Ledgername', '', 'Select', 0); ?></select>`;
        cell1.innerHTML = `<input type="text"  class="form-control input-md " name="TransactionReference[` + rows + `]" id="Reference" Value="" minlength="1" required " >`;
        cell2.innerHTML = `<input type="number" onchange="calAmount()" class="form-control input-md Credit" id="InvoicePayAmount" Value="" step="0.01" min="0.00" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required name="Credit[` + rows + `]" >`;
        cell3.innerHTML = `<input type="number" onchange="calAmount()" class="form-control input-md Debit" id="InvoicePayAmount" Value="" step="0.01" min="0.00" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required name="Debit[` + rows + `]" >`;
        cell4.innerHTML = '<button type="button" class="btn"  onclick="Deleterow(this)">Delete</button>';
        $('.select2').select2();
    }
    function deletetablerows() {
        var old_tbody = document.getElementById("Invoice").getElementsByTagName('tbody')[0];
        var new_tbody = document.createElement('tbody');
        if (old_tbody) {
            old_tbody.parentNode.replaceChild(new_tbody, old_tbody);
        }
		var rowscount = document.getElementById("Invoice").getElementsByTagName('tbody')[0].rows.length;

        AddExpenceRow();
        AddExpenceRow();
	
    }

</script>
<script>
    function calAmount() {
        var Credit = 0.00;
        var Debit = 0.00;
        $(".Credit").each(function(index) {
            creditamount = parseFloat($(".Credit").eq(index).val());
            creditamount = (!isNaN(creditamount)) ? creditamount : '0';
            Credit = (parseFloat(Credit) + parseFloat(creditamount )).toFixed(2);
        });
        $(".Debit").each(function(index) {
            debitamount = parseFloat($(".Debit").eq(index).val());
            debitamount = (!isNaN(debitamount)) ? debitamount : '0';
            Debit = (parseFloat(Debit) + parseFloat(debitamount)).toFixed(2);
        });
        document.getElementById("creditotal").value=Credit; 
        document.getElementById("debittotal").value=Debit; 
        // excess     
    }
    calAmount();
</script>