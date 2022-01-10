<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/ReportsHead.php');
include('Includes/ReportsMenu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Accounts</h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Profit and Loss (V1)</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Reports/AccountsByProfitLoss_Oldversion'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <div class="box-body">
                <br>
                <form class="row form-inline">
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="forminline-label">From : </label>
                            <input type="text" class="form-control input-md Date" readonly required name="fromdate" placeholder="Enter date" value="<?php echo $fromdate = (isset($_REQUEST['fromdate'])) ? $_REQUEST['fromdate'] : date('d-m-Y'); ?> ">
                            <?php echo form_error('fromdate'); ?>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="forminline-label">To : </label>
                            <input type="text" class="form-control input-md Date" readonly required name="todate" placeholder="Enter date" value="<?php echo $todate = (isset($_REQUEST['todate'])) ? $_REQUEST['todate'] : date('d-m-Y'); ?> ">
                            <?php echo form_error('todate'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <button type="submit" class="btnbg-black text-white btn-flat" name="Abut" value="Show">
                                <i class="fa fa-cloud-download"></i>Show</button>
                        </div>
                    </div>
                </form>
                <hr class="horizondal-splitter">
                <table class="table exporttable" style="width:100%">
                    <thead>
                        <tr>
                            <th colspan="2">Particulars</th>
                            <th colspan="2">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $GROSS_PROFIT = 0;
                        $from_date = $this->GM->DateSplit($fromdate);
                        $to_date = $this->GM->DateSplit($todate);
                        foreach ($this->ReportsClass->AccountsByProfitLossSalesOLD($from_date, $to_date) as $Row) {
                            $amount = ($Row->amount < 0) ? ($Row->amount * -1) : $Row->amount;
                            $GROSS_PROFIT -= (($Row->amounttype == 1) && ($Row->id == 0)) ?  $amount : 0;
                            $GROSS_PROFIT += (($Row->amounttype == 1) && ($Row->id != 0)) ?  $amount : 0;

                        ?>
                            <tr>
                                <td><?php echo $Row->Set_name; ?></td>
                                <td><?php echo $Row->name; ?></td>
                                <td><?php echo ($Row->amounttype != 1) ? $amount : ''; ?></td>
                                <td><?php echo ($Row->amounttype == 1) ?  $amount : ''; ?></td>
                            </tr>
                        <?php

                        }
                        $directexpect = $this->ReportsClass->AccountsByProfitLossLedgerGroupwise($from_date, $to_date, '49');
                        ?>
                        <tr>
                            <td><?php echo ($directexpect[0]->amounttype == 1) ? $directexpect[0]->mastergroupname : '';  ?></td>
                            <td></td>
                            <td></td>
                            <td><?php echo ($directexpect[0]->Master_amount < 0) ? ($directexpect[0]->Master_amount * -1) : $directexpect[0]->Master_amount; ?></td>
                        </tr>
                        <?php
                        $GROSS_PROFIT -= ($directexpect[0]->Master_amount < 0) ? ($directexpect[0]->Master_amount * -1) : $directexpect[0]->Master_amount;
                        foreach ($directexpect as $Row) {
                            $amount = ($Row->amount * -1);

                        ?>
                            <tr>
                                <td></td>
                                <td><?php echo $Row->Accountsgroup_Name;  ?></td>
                                <td><?php echo  $amount; ?></td>
                                <td></td>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <td>GROSS PROFIT</td>
                            <td></td>
                            <td></td>
                            <td><?php echo $GROSS_PROFIT ?></td>
                        </tr>
                        <?php
                        $IndirectIncome = $this->ReportsClass->AccountsByProfitLossLedgerGroupwise($from_date, $to_date, '60');
                        $GROSS_PROFIT += ($IndirectIncome[0]->Master_amount < 0) ? ($IndirectIncome[0]->Master_amount * -1) : $IndirectIncome[0]->Master_amount;
                      
                        ?>
                         <tr>
                            <td><?php echo ($IndirectIncome[0]->amounttype == 1) ? $IndirectIncome[0]->mastergroupname : '';  ?></td>
                            <td></td>
                            <td></td>
                            <td><?php echo ($IndirectIncome[0]->Master_amount < 0) ? ($IndirectIncome[0]->Master_amount * -1) : $IndirectIncome[0]->Master_amount; ?></td>
                        </tr>
                       <?php
                        foreach ($IndirectIncome as $Row) {
                            $amount = ($Row->amount * -1);

                        ?>
                            <tr>
                                <td></td>
                                <td><?php echo $Row->Accountsgroup_Name;  ?></td>
                                <td><?php echo  $amount; ?></td>
                                <td></td>
                            </tr>
                        <?php
                        }
                        $IndirectExpense = $this->ReportsClass->AccountsByProfitLossLedgerGroupwise($from_date, $to_date, '59');
                        $GROSS_PROFIT -= ($IndirectExpense[0]->Master_amount < 0) ? ($IndirectExpense[0]->Master_amount * -1) : $IndirectExpense[0]->Master_amount;
                      
                      ?>
                         <tr>
                            <td><?php echo ($IndirectExpense[0]->amounttype == 1) ? $IndirectExpense[0]->mastergroupname : '';  ?></td>
                            <td></td>
                            <td></td>
                            <td><?php echo ($IndirectExpense[0]->Master_amount < 0) ? ($IndirectExpense[0]->Master_amount * -1) : $IndirectExpense[0]->Master_amount; ?></td>
                        </tr>
                       <?php
                        foreach ($IndirectExpense as $Row) {
                            $amount = ($Row->amount * -1);

                        ?>
                            <tr>
                                <td></td>
                                <td><?php echo $Row->Accountsgroup_Name;  ?></td>
                                <td><?php echo  $amount; ?></td>
                                <td></td>
                            </tr>
                        <?php
                        }
                        ?>
                          <tr>
                            <td>NETT PROFIT</td>
                            <td></td>
                            <td></td>
                            <td><?php echo $GROSS_PROFIT ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<?php include('Includes/ReportsFoot.php'); ?>