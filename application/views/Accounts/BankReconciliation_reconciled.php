<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <!-- <h1>Bank Approval View</h1> -->
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Bank Reconciliation (reconciled)</h3>
                <div class="box-tools pull-right">
                <a href="<?php echo site_url('Accounts/BankReconciliation_reconciled'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> reconciled</a>
            
                    <a href="<?php echo site_url('Accounts/BankReconciliation'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Unreconciled</a>
                </div>
            </div>
            <div class="box-body">
                <br>
                <form class="row form-inline">
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="forminline-label">Bank :</label>
                            <select id="Bank_Id" required class="form-control select2" name="Bank_Id">
                                <?php
                                $data = $this->GM->Bank();
                                $this->GM->Option_($data, 'Bank_Id', 'BankName', '', 'Select', @$_GET['Bank_Id']);
                                ?>
                            </select>
                            <?php echo form_error('Bank_Id'); ?>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="forminline-label">From : </label>
                            <input type="text" class="form-control input-md Date" readonly required name="fromdate" placeholder="Enter Admin fromdate" value="<?php echo $fromdate = (isset($_REQUEST['fromdate'])) ? $_REQUEST['fromdate'] : date('d-m-Y'); ?> ">
                            <?php echo form_error('fromdate'); ?>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="forminline-label">To : </label>
                            <input type="text" class="form-control input-md Date" readonly required name="todate" placeholder="Enter Admin todate" value="<?php echo $todate = (isset($_REQUEST['todate'])) ? $_REQUEST['todate'] : date('d-m-Y'); ?> ">
                            <?php echo form_error('todate'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                        <br>
                            <button type="submit" class="btnbg-black text-white btn-flat" name="Abut" value="Show">
                                <i class="fa fa-cloud-download"></i>Show</button>
                        </div>
                    </div>
                </form>
                <hr class="horizondal-splitter">
                <table id="Viewtable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Source</th>
                            <th>Date</th>
                            <th>Ledger</th>
                            <th>Voucher No</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Bank Date</th>
                            <th>Bank Reference</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $from_date = $this->GM->DateSplit($fromdate);
                        $to_date = $this->GM->DateSplit($todate);
                        if (isset($_GET['Bank_Id'])) {
                            foreach ($this->GM->Bankreconciliation_reconciled($from_date, $to_date, $_GET['Bank_Id']) as $Row) {
                        ?>
                                <tr>
                                    <td><?php echo $Row->VoucherSourceName; ?></td>
                                    <td><?php echo $Row->formattedTransaction_date; ?></td>
                                    <td><?php echo $Row->Ledgername; ?></td>
                                    <td><?php echo $Row->Voucher_no; ?></td>
                                    <td><?php echo $Row->credit; ?></td>
                                    <td><?php echo $Row->debit; ?></td>
                                    <td><?php echo $Row->bank_date; ?></td>
                                    <td><?php echo $Row->bank_ref; ?></td>                                  
                                </tr>
                        <?php
                              
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<!-- Approved -->
<div class="modal" id="Accept_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Bank Reconcillation </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="<?php echo site_url('Accounts/BankReconciliation_Save') ?>" method="POST">
                    <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
                    <input type="hidden" class="Transaction_Id" name="Transactions_Id" id="Transactions_Id">       
                    <input type="hidden" name="Abut" id="Abut" value="Accept">
                    <div class="form-group">
                        <label>Bank Reference</label>
                        <input type="text" autocomplete="off" minlength="3" class="form-control input-md" id="bank_ref" required name="bank_ref" placeholder="Enter Reference" value="<?php echo @set_value('bank_ref') . @$bank_ref; ?>">
                        <br> <?php echo form_error('bank_ref'); ?>
                    </div>
                    <div class="form-group">
                        <label>Bank Date</label>
                        <input type="text" autocomplete="off" minlength="3" onkeypress="return false;" class="form-control input-md Date" id="bank_date" required name="bank_date" placeholder="Enter Date" value="<?php echo @set_value('bank_date') . @$bank_date; ?>">
                        <br> <?php echo form_error('bank_date'); ?>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end of Approved -->
<?php include('Foot.php'); ?>
<script>
    function AcceptBankReconcillation(id) {
        $('.Transaction_Id').val(id);
        $('#Accept_modal').modal();
    }

</script>