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
                <h3 class="box-title">Balance Sheet</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Reports/AccountsBybalancesheet'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <div class="box-body row">
			 <form class="row form-inline">
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="forminline-label">From : </label>
                            <input type="text" class="form-control input-md Date" readonly required name="fromdate" placeholder="Enter Admin fromdate" value="<?php echo $fromdate = (isset($_REQUEST['fromdate'])) ? $_REQUEST['fromdate'] : '01-01-2018'; ?> ">
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
            <div class="col-md-6">
                        <table class="table " style="width:100%">
                            <thead>
                                <tr>
                                    <th colspan="2">
                                        <span style=" width:100%;font-size: 18px;
                                    text-align: left;">Liabilities </span><br />
                                        <span style=" width:100%;text-align: center;">Accounts</span>
                                    </th>
                                    <th style="text-align: center;" colspan="2">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
								$ltotal=0;
								$from_date = $this->GM->DateSplit($fromdate);
								$to_date = $this->GM->DateSplit($todate);
                                foreach ($this->ReportsClass->AccountsBybalancesheet('63', $from_date, $to_date) as $masterRow) {
                                ?>
                                    <tr>
                                        <td><?php echo $masterRow->Accountsgroup_Name; ?></td>
                                        <td></td>
                                        <td></td>
                                         <td class="Currency"><?php $ltotal += $masterRow->amount; echo $masterRow->amount;
											/*($Row->amount < 0) ?  ($Row->amount * -1) : '';
                                                echo ($Row->amount > 0) ?  $Row->amount : '';*/ ?></td>
                                    </tr>
                                    <?php
                                    foreach ($this->ReportsClass->AccountsBybalancesheet($masterRow->Accountsgroup_Id, $from_date, $to_date) as $Row) {
                                    ?>
                                        <tr>
                                            <td></td>
                                            <td><?php echo $Row->Accountsgroup_Name; ?></td>
                                            <td class="Currency"><?php echo $Row->amount;
											/*($Row->amount < 0) ?  ($Row->amount * -1) : '';
                                                echo ($Row->amount > 0) ?  $Row->amount : '';*/ ?></td>
                                            <td></td>
                                        </tr>
                                    <?php
                                    }
                                    foreach ($this->ReportsClass->AccountsBybalancesheetLedgerGroupwise($masterRow->Accountsgroup_Id, $from_date, $to_date) as $Row) {
                                    ?>
                                        <tr>
                                            <td></td>
                                            <td><?php echo $Row->Ledgername; ?></td>
                                            <td class="Currency"><?php echo ($Row->amount < 0) ?  ($Row->amount * -1) : '';
                                                echo ($Row->amount > 0) ?  $Row->amount : ''; ?></td>
                                            <td></td>
                                        </tr>
                                <?php
                                    }
                                }    
								$fromdate = date('m/d/Y', strtotime('-1 day', strtotime($fromdate)));
								 foreach ($this->ReportsClass->AccountsByTrialBalanceProfitLoss('01/01/2018', $fromdate) as $ProfitlossRow) {
                            ?>
                                <tr>
                                    <td>Opening Balance</td>
                                    <td></td>
                                    <td></td>                                   
                                    <td class="Currency"><?php $ltotal +=$ProfitlossRow->NetProfit; echo $ProfitlossRow->NetProfit ; ?></td>
                                </tr>
                            <?php
                            }
                             foreach ($this->ReportsClass->AccountsByTrialBalanceProfitLoss($from_date, $to_date) as $ProfitlossRow) {
                            ?>
                                <tr>
                                    <td>Current Year</td>
                                    <td></td>
                                    <td></td>
                                    <td class="Currency"><?php $ltotal +=$ProfitlossRow->NetProfit; echo $ProfitlossRow->NetProfit; ?></td>
								</tr>
                            <?php
                            }
                            ?>
								
								
                            </tbody>
                            <tfoot><?php $tablecolumntotallist = array('2', '3'); ?>
                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td><?php echo $ltotal; ?></td>
                            </tfoot>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table " style="width:100%">
                            <thead>
                                <tr>
                                    <th colspan="2">
                                        <span style=" width:100%;font-size: 18px;
                                    text-align: left;">Assets </span><br />
                                        <span style=" width:100%;text-align: center;">Accounts</span>
                                    </th>
                                    <th style="text-align: center;" colspan="2">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
								$atotal=0;
                                foreach ($this->ReportsClass->AccountsBybalancesheet('36', $from_date, $to_date) as $masterRow) {
                                ?>
                                    <tr>
                                        <td><?php echo $masterRow->Accountsgroup_Name; ?></td>
                                        <td></td>
                                        <td></td>
                                       <td class="Currency"><?php $atotal += $masterRow->amount; echo ($masterRow->amount*-1);
											/*($Row->amount < 0) ?  ($Row->amount * -1) : '';
                                                echo ($Row->amount > 0) ?  $Row->amount : '';*/ ?></td>
                                    </tr>
                                    <?php
                                    foreach ($this->ReportsClass->AccountsBybalancesheet($masterRow->Accountsgroup_Id, $from_date, $to_date) as $Row) {
                                    ?>
                                        <tr>
                                            <td></td>
                                            <td><?php echo $Row->Accountsgroup_Name; ?></td>
                                            <td class="Currency"><?php echo ($Row->amount < 0) ?  ($Row->amount * -1) : '';
                                                echo ($Row->amount > 0) ?  $Row->amount : ''; ?></td>
                                            <td></td>
                                        </tr>
                                    <?php
                                    }
                                    foreach ($this->ReportsClass->AccountsBybalancesheetLedgerGroupwise($masterRow->Accountsgroup_Id, $from_date, $to_date) as $Row) {
                                    ?>
                                        <tr>
                                            <td></td>
                                            <td><?php echo $Row->Ledgername; ?></td>
                                            <td class="Currency"><?php echo ($Row->amount < 0) ?  ($Row->amount * -1) : '';
                                                echo ($Row->amount > 0) ?  $Row->amount : ''; ?></td>
                                            <td></td>
                                        </tr>
                                <?php
                                    }
                                }
								foreach ($this->ReportsClass->Get_Stock($to_date) as $Row) {
                                    ?>
                                        <tr>                                            
                                            <td><?php echo $Row->Accountsgroup_Name; ?></td>
											<td></td>
											<td></td>
                                            <td class="Currency"><?php $atotal += $Row->amount; echo ($Row->amount < 0) ?  ($Row->amount * -1) : '';
                                                echo ($Row->amount > 0) ?  $Row->amount : ''; ?></td>
                                          
                                        </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                            <tfoot><?php $tablecolumntotallist = array('2', '3'); ?>
                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td><?php echo $atotal; ?></td>
                            </tfoot>
                        </table>
                    </div>
           
            </div>
        </div>
    </section>
</div>
<?php include('Includes/ReportsFoot.php'); ?>