<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/ReportsHead.php');
include('Includes/ReportsMenu.php');
$_GET['OfficeLedger_id'] = (!isset($_GET['OfficeLedger_id']))  ? '' : $_GET['OfficeLedger_id'];
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Accounts</h1>
    </section>
    <?php if (empty($_GET['OfficeLedger_id'])) { ?>
        <section class="content">
            <div class="box box-form box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Ledger Book</h3>
                    <div class="box-tools pull-right">
                        <a href="<?php echo site_url('Reports/AccountsByAccountsGroupLedger'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
  <a onclick="frames['LedgerPrint'].print()" class="btn btn-flat"><i class="fa fa-file-pdf-o"></i> </a>
                                      
				   </div>
                </div>
                <div class="box-body">
                    <br>
                    <form class="row form-inline">
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
                        <div class="col-md-1"></div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="forminline-label">Ledger : </label>
                                <select id="Against_Id" style="width: 100%;" class="form-control select2" name="OfficeLedger_id">
                                    <?php $dataVoucherAgainst = $this->GM->OfficeLedger($OfficeLedger_id = "0", $LedgerType_Id = "0", $Against_Id = "0");
                                    $this->GM->Option_($dataVoucherAgainst, 'OfficeLedger_id', 'Ledgername', '', 'All', 0); ?>
                                </select>
                                <?php echo form_error('OfficeLedger_id'); ?>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-1">
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btnbg-black text-white btn-flat" name="Abut" value="Show">
                                    <i class="fa fa-cloud-download"></i>Show</button>
                            </div>
                        </div>
                    </form>
                    <hr class="horizondal-splitter">
                    <table id="Reptable" class="table  table-borderless" style="width:100%">
                        <thead>
                            <tr>
                                <th class="info">#</th>
                                <th class="info">Group</th>
                                <th class="success">Ledger Name</th>
                                <th class="success">Debit</th>
                                <th class="success">Credit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cou = 0;
                            $from_date = $this->GM->DateSplit($fromdate);
                            $to_date = $this->GM->DateSplit($todate);
                            $Accountsgroup_Name = '';
                            foreach ($this->ReportsClass->AccountsByAccountsGroupLedger($from_date, $to_date) as $Row) {
                                if ($Row->Accountsgroup_Name != $Accountsgroup_Name) {
                                    $Accountsgroup_Name = $Row->Accountsgroup_Name;
                                    $cou++;
                            ?>
                                    <tr>
                                        <td class="info"><b><?php echo $cou; ?></b></td>
                                        <td class="info"><?php echo $Row->Accountsgroup_Name; ?></td>
                                        <td class="success"> <a href="<?php echo site_url("Reports/AccountsByAccountsGroupLedger/?fromdate=".$fromdate."&todate=".$todate."&OfficeLedger_id=".$Row->OfficeLedger_Id); ?>"> <?php echo $Row->Ledgername; ?></a></td>
                                        <td class="success Currency"><?php echo $Row->debit; ?></td>
                                        <td class="success Currency"><?php echo $Row->credit; ?></td>
                                    </tr>
                                <?php
                                } else {
                                ?>
                                    <tr>
                                    <td class="info" style='border-top:none !important;'></td>
                                        <td class="info" style='border-top:none !important;'></td>
                                        <td class="success"> <a href="<?php echo site_url("Reports/AccountsByAccountsGroupLedger/?OfficeLedger_id=".$Row->OfficeLedger_Id); ?>"> <?php echo $Row->Ledgername; ?></a></td>
                                        <td class="success Currency"><?php echo $Row->debit; ?></td>
                                        <td class="success Currency"><?php echo $Row->credit; ?></td>
                                       
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot><?php $ordering = 'false';
                                $tablecolumntotallist = array('3', '4'); ?>
                            <td>Total</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tfoot>
                    </table>
                </div>
				
            </div>
        </section>
    <?php } else { ?>
        <section class="content">
            <div class="box box-form box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Ledger Book</h3>
                    <div class="box-tools pull-right">
                        <a href="<?php echo site_url('Reports/AccountsByAccountsGroupLedger'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
<a onclick="frames['LedgerPrint'].print()" class="btn btn-flat"><i class="fa fa-file-pdf-o"></i> </a>
                
				</div>
                </div>
                <div class="box-body">
                    <br>
                    <form class="row form-inline">
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
                        <div class="col-md-1"></div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="forminline-label">Ledger : </label>
                                <select id="Against_Id" style="width: 100%;" class="form-control select2" name="OfficeLedger_id">
                                    <?php $dataVoucherAgainst = $this->GM->OfficeLedger($OfficeLedger_id = "0", $LedgerType_Id = "0", $Against_Id = "0");
                                    $this->GM->Option_($dataVoucherAgainst, 'OfficeLedger_id', 'Ledgername', '', 'All',  $_GET['OfficeLedger_id']); ?>
                                </select>
                                <?php echo form_error('OfficeLedger_id'); ?>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-1">
                            <br>
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
                                <th>#</th>
                                <th>Date</th>
                                <th>Against Ledger</th>
                                <th>Type</th>
                                <th>Transaction no</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cou = 1;
                            $from_date = $this->GM->DateSplit($fromdate);
                            $to_date = $this->GM->DateSplit($todate);
                            foreach ($this->ReportsClass->AccountsByGroupLedgertransaction($from_date, $to_date, $_GET['OfficeLedger_id']) as $Row) {
                            
							?>
                                <tr>
                                    <td><b><?php echo $cou; ?></b></td>
                                    <td><?php echo $Row->transactiondateformated; ?></td>
                                    <td><?php echo $Row->Ledgername; ?></td>
                                    <td> <?php echo $Row->AllTransactionName; ?></td>
                                    <td><a href="<?php echo site_url($Row->Link) . '' . base64_encode($Row->Against_Id); ?> "><?php echo $Row->Number; ?></a></td>
                                    <td><?php echo $Row->debit; ?></td>
                                    <td><?php echo $Row->credit; ?></td>
                                    <td><?php print_r($Row->Reference); ?></td>
                                </tr>
                            <?php
                                $cou++;
                            }
                            ?>
                        </tbody>
                        <tfoot><?php $ordering = 'false';
                                $tablecolumntotallist = array('5', '6'); ?>
                            <td>Total</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tfoot>
                    </table>
                </div>
   <div class="box-body row">
<div class="col-md-8">
                 
            </div>
			<div class="col-md-4">
			  <h4><b>Opening</b> :<?php if($Row->opening>0) { echo $Row->opening.' Dr' ;} else {echo ($Row->opening*-1).' Cr' ;} ?></h4>
			    <h4><b>Current</b> &nbsp;&nbsp;:<?php if($Row->crt>0) { echo $Row->crt.' Dr';} else {echo ($Row->crt*-1).' Cr';} ?> </h4>
				  <h4><b>Closing</b> &nbsp;&nbsp;:<?php if($Row->closing>0) { echo $Row->closing.' Dr';} else { echo ($Row->closing*-1).' Cr' ;} ?></h4>
			</div>
            <!-- /.box-body -->
          </div>
            </div>
        </section>
    <?php } ?>
</div>

  <iframe style="width:0px;height:0px;" src="<?php echo site_url('Reports/AccountsByAccountsGroupLedger_PDF/?OfficeLedger_id=' . $_GET['OfficeLedger_id'].'&fromdate='. $_GET['fromdate'].'&todate'. $_GET['todate']); ?>" name="LedgerPrint"></iframe>
<?php include('Includes/ReportsFoot.php'); ?>