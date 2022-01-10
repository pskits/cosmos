<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('ReportsHead.php');
include('ReportsMenu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Collection </h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Converted</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Reports/CollectionConverted'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <div class="box-body">
                <br>
                <form class="row form-inline">
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="forminline-label">From : </label>
                            <input type="text" class="form-control input-md Date" readonly required name="fromdate" placeholder="Enter Admin fromdate" value="<?php echo $fromdate = (isset($_REQUEST['fromdate'])) ? $_REQUEST['fromdate'] : date('d-m-Y'); ?> ">
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
                 <table class="table exporttable" style="width:100%">
                    <thead>
                        <tr>
                           
                            <th>Collection No</th>
                            <th>Collection Date</th>
                            <th>Dealer</th>
                            <th>Mode</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                  
                        $from_date = $this->GM->DateSplit($fromdate);
                        $to_date = $this->GM->DateSplit($todate);
                        foreach ($this->ReportsClass->CollectionConverted($from_date, $to_date) as $Row) {
                        ?>
                                                    <tr>
                           
                                <td class="reportmain_wrap"><a href="<?php echo site_url("Collection/Collection_invoice/?Key=") . base64_encode($Row->Colletion_Id); ?>"><?php echo $Row->Collection_no; ?></a></td>
                                <td><?php echo $Row->CollectionDate; ?></td>
                                <td class="reportmain_wrap"><a href="<?php echo site_url("Users/Dealeruser_views/?Key=") . base64_encode($Row->Dealer_Id); ?>"><?php echo $Row->name; ?></a></td>
                                <td><?php echo $Row->AmountModeName; ?></td>
                                <td class="Currency"><?php echo $Row->amount; ?></td>
                                <td><?php echo $Row->Collection_StatusName; ?></td>
                            </tr>
                        <?php
                          
                        }
                        ?>
                    </tbody>
                    <tfoot><?php $tablecolumntotallist = array('4'); ?>
                        <td>Total</td>
                       
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="Currency"></td>
                        <td></td>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>
</div>
<?php include('ReportsFoot.php'); ?>