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
                <h3 class="box-title">Accounts Group</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Reports/AccountsByAccountsGroup'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <div class="box-body">
                <br>
                <form class="row form-inline">
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="forminline-label">Group</label>
                            <select id="Accountsgroup_Id" required class="form-control select2" name="Accountsgroup_Id">
                                <?php
                                $data = $this->GM->AccountsGroup($status = '1', $id = '0');
                                $Accountsgroup_Id = (!isset($_GET['Accountsgroup_Id'])) ? '0' : $_GET['Accountsgroup_Id'];
                                $this->GM->Option_($data, 'Accountsgroup_Id', 'Accountsgroup_Name', '', 'Select', $Accountsgroup_Id);
                                ?>
                            </select>
                            <?php echo form_error('Accountsgroup_Id'); ?>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="forminline-label">From : </label>
                            <input type="text" class="form-control input-md Date" readonly required name="fromdate" placeholder="Enter date" value="<?php $fromdate = (isset($_REQUEST['fromdate'])) ? $_REQUEST['fromdate'] : date('d-m-Y'); echo $fromdate; ?> ">
                            <?php echo form_error('fromdate'); ?>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="forminline-label">To : </label>
                            <input type="text" class="form-control input-md Date" readonly required name="todate" placeholder="Enter date" value="<?php $todate=(isset($_REQUEST['todate'])) ? $_REQUEST['todate'] : date('d-m-Y'); echo $todate; ?> ">
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
                <table class="table exporttable table-bordered" style="width:100%">
                    <thead>
                        <tr>                           
                            <th>Accounts</th>
                            <td class="text-center" colspan="2">Opening</td>
                            <td class="text-center" colspan="2">Current</td>
                            <td class="text-center" colspan="2">Closing</td>
                        </tr>
						  <tr>
                            <td></td>
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
                        $from_date = $this->GM->DateSplit($fromdate);
                        $to_date = $this->GM->DateSplit($todate);

                        foreach ($this->ReportsClass->AccountsByAccountsGroup($from_date, $to_date, $Accountsgroup_Id) as $Row) {
                        ?>
                            <tr>                               
                               <td><b><a href="<?php echo site_url('Reports/AccountsByAccountsGroup') . '/?Accountsgroup_Id=' . $Row->Accountsgroup_Id.'&fromdate='.$fromdate.'&todate='.$todate; ?> "><?php echo $Row->Accountsgroup_Name; ?></a></b></td>
								<!-- <td  class="Currency"><?php echo ($Row->openingamount < 0) ?  ($Row->openingamount * -1) : 0; ?></td> 
                                <td class="Currency"><?php echo ($Row->openingamount > 0) ?  $Row->openingamount : 0; ?></td>-->
                                 <td  class="Currency"><?php echo $Row->openingdamount; ?></td> 
                                <td class="Currency"><?php echo $Row->openingcamount; ?></td>                               
							   
							<td class="Currency"><?php echo ($Row->amount);  ?></td>
                              <td class="Currency"><?php echo ($Row->camount);  ?></td>
								
								<!-- <td class="Currency"><?php echo ($Row->closingamount < 0) ?  ($Row->closingamount * -1) : 0; ?></td>
                                <td class="Currency"><?php echo ($Row->closingamount > 0) ?  $Row->closingamount : 0; ?></td> -->
                                <td class="Currency"><?php echo $Row->closingdamount; ?></td>
                                <td class="Currency"><?php echo $Row->closingcamount; ?></td>
                            </tr>
                        <?php                        
                        }
                        foreach ($this->ReportsClass->AccountsByAccountsGroupLedgerGroupwise($from_date, $to_date, $Accountsgroup_Id) as $Row) {
                        ?>
                            <tr>                               
                                <td><a href="<?php echo site_url('Reports/AccountsByAccountsGroupGeneralLedger') . '/?OfficeLedger_id='.$Row->OfficeLedger_Id.'&fromdate='.$fromdate.'&todate='.$todate; ?> "><?php echo $Row->Ledgername; ?></a></td>
                                <!-- <td class="Currency"><?php echo ($Row->openingamount < 0) ?  ($Row->openingamount * -1) : 0; ?></td>
                                <td class="Currency"><?php echo ($Row->openingamount > 0) ?  $Row->openingamount : 0; ?></td> -->
                                <td  class="Currency"><?php echo $Row->openingdamount; ?></td> 
                                <td class="Currency"><?php echo $Row->openingcamount; ?></td>
								
								<td class="Currency"><?php echo ($Row->amount);  ?></td>
                              <td class="Currency"><?php echo ($Row->camount);  ?></td>
								
								<!--	<td class="Currency"><?php echo ($Row->amount < 0) ?  ($Row->amount * -1) : 0; ?></td>
                                <td class="Currency"><?php echo ($Row->amount > 0) ?  $Row->amount : 0; ?></td>  -->
								
								<!-- <td class="Currency"><?php echo ($Row->closingamount < 0) ?  ($Row->closingamount * -1) : 0; ?></td>
                                <td class="Currency"><?php echo ($Row->closingamount > 0) ?  $Row->closingamount : 0; ?></td> -->
                                <td  class="Currency"><?php echo $Row->closingdamount; ?></td> 
                                <td class="Currency"><?php echo $Row->closingcamount; ?></td>
                            </tr>
                        <?php
                           
                        }
                        ?>
                    </tbody>
                  <tfoot><?php $tablecolumntotallist = array('1','2', '3', '4', '5', '6', '7'); ?>                      
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
        </div>
    </section>
</div>
<?php include('Includes/ReportsFoot.php'); ?>