<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/ReportsHead.php');
include('Includes/ReportsMenu.php');
?>
<style>
    .datatablefilerhead::placeholder:not(:first-child) {
        text-align: center;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Accounts</h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Trial Balance</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Reports/AccountsByTrialBalance'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
     <a href="<?php echo site_url('Reports/AccountsByTrialBalance_Oldversion'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> OLd Version</a>
                            
			   </div>
            </div>
            <div class="box-body">
                <br>
                <form class="row form-inline">
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="forminline-label">From : </label>
                            <input type="text" class="form-control input-md Date" readonly required name="fromdate" placeholder="Enter Admin fromdate" value="<?php echo $fromdate = (isset($_REQUEST['fromdate'])) ? $_REQUEST['fromdate'] : '01-01-'.date('Y'); ?> ">
                            <?php echo form_error('fromdate'); ?>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="forminline-label">To : </label>
                            <input type="text" class="form-control input-md Date" readonly required name="todate" placeholder="Enter Admin todate" value="<?php echo $todate = (isset($_REQUEST['todate'])) ? $_REQUEST['todate'] : date('d-m-Y'); ?> ">
                            <?php echo form_error('todate'); ?>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <button type="submit" class="btnbg-black text-white btn-flat" name="Abut" value="Show">
                                <i class="fa fa-cloud-download"></i>Show</button>
                        </div>
                    </div>
                </form>
                <hr class="horizondal-splitter">
                <?php
                if (isset($_REQUEST['INDETAIL'])) {
                ?>
                    <table id="Reptable" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <td colspan="2">Account</td>
                                <td class="text-center" colspan="2">Opening</td>
                                <td class="text-center" colspan="2">Current</td>
                                <td class="text-center" colspan="2">Closing</td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td>Debit</td>
                                <td>Credit</td>
                                <td>Debit</td>
                                <td>Credit</td>
                                <td>Debit</td>
                                <td>Credit</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $Accountsgroup_Name = '';
                            $from_date = $this->GM->DateSplit($fromdate);
                            $to_date = $this->GM->DateSplit($todate);
                            foreach ($this->ReportsClass->AccountsByTrialBalance($from_date, $to_date) as $Row) {
                                if ($Row->mastergroupname != $Accountsgroup_Name) {
                                    $Accountsgroup_Name = $Row->mastergroupname;
                            ?>
                                    <tr>
                                        <td><a href="<?php echo site_url('Reports/AccountsByAccountsGroup') . '/?Accountsgroup_Id=' . $Row->Accountsgroup_ParentId; ?> "><?php echo $Row->mastergroupname; ?></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <tr>
                                    <td></td>
                                    <td><a href="<?php echo site_url('Reports/AccountsByAccountsGroup') . '/?Accountsgroup_Id=' . $Row->Accountsgroup_Id; ?> "><?php echo $Row->Accountsgroup_Name; ?></a></td>
                                    <td><?php echo ($Row->Openingamount < 0) ?  ($Row->Openingamount * -1) : 0; ?></td>
                                    <td><?php echo ($Row->Openingamount > 0) ?  $Row->Openingamount : 0; ?></td>
                                    <td><?php echo ($Row->amount < 0) ?  ($Row->amount * -1) : 0; ?></td>
                                    <td><?php echo ($Row->amount > 0) ?  $Row->amount : 0; ?></td>
                                    <td><?php echo ($Row->Closingamount < 0) ?  ($Row->Closingamount * -1) : 0; ?></td>
                                    <td><?php echo ($Row->Closingamount > 0) ?  $Row->Closingamount : 0; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                        <tfoot><?php $tablecolumntotallist = array('2', '3', '4', '5', '6', '7'); ?>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tfoot>
                    </table>
                <?php } else { ?>
                    <table id="Reptable" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <td style="width:50%;" colspan="2">Account</td>
                                <td  colspan="2">Amount</td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td style="text-align:right;">Debit</td>
                                <td style="text-align:right;">Credit</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $Accountsgroup_Name = '';
                            $from_date = $this->GM->DateSplit($fromdate);
                            $to_date = $this->GM->DateSplit($todate);
                            foreach ($this->ReportsClass->AccountsByTrialBalanceCurrent($from_date, $to_date) as $Row) {
                                if ($Row->mastergroupname != $Accountsgroup_Name) {
                                    $Accountsgroup_Name = $Row->mastergroupname;
                            ?>
                                    <tr>
                                        <td><a href="<?php echo site_url($Row->parentlink); ?> ">
										<?php echo $Row->mastergroupname;?></a> <br>
										<span style="font-size:12px;"><?php echo $Row->calculateddate;?></span></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <tr>
                                    <td></td>
                                    <td><a href="<?php echo site_url($Row->link); ?> "><?php echo $Row->Accountsgroup_Name; ?></a></td>
                                    <td class="Currency"><?php echo ($Row->amount < 0) ?  ($Row->amount * -1) : 0; ?></td>
                                    <td class="Currency"><?php echo ($Row->amount > 0) ?  $Row->amount : 0; ?></td>
                                </tr>
                            <?php
                            }
							$fromdate = date('m/d/Y', strtotime('-1 day', strtotime($fromdate)));
							$from_date = $this->GM->DateSplit($fromdate);
                            foreach ($this->ReportsClass->AccountsByTrialBalanceProfitLoss('01/01/2018', $fromdate) as $ProfitlossRow) {
                            ?>
                                <tr>
                                    <td><a href="<?php echo site_url($ProfitlossRow->parentlink); ?>">Profit and Loss</a>
									<br><span style="font-size:12px;"><?php echo $ProfitlossRow->calculateddate;?></span></td>
                                    <td></td>
                                    <td class="Currency"><?php echo ($ProfitlossRow->NetProfit < 0) ?  ($ProfitlossRow->NetProfit * -1) : 0; ?></td>
                                    <td class="Currency"><?php echo ($ProfitlossRow->NetProfit > 0) ?  $ProfitlossRow->NetProfit : 0; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                        <tfoot><?php $tablecolumntotallist = array('2', '3'); ?>
                            <td></td>
                            <td></td>
                            <td class="Currency"></td>
                            <td class="Currency"></td>
                        </tfoot>
                    </table>
                <?php
                } ?>
            </div>
        </div>
    </section>
</div>
<?php include('Includes/ReportsFoot.php'); ?>