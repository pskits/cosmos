<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/ReportsHead.php');
include('Includes/ReportsMenu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Sales </h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Motors Sales with Stock</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Reports/salesbyMotorsSaleswithStock'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
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
                            <th>#</th>
                            <th>Invoice</th>
                            <th>Dealer</th>
                            <th>Area</th>
                            <th>Total</th>
                            <th>RPM-50</th>
                            <th>RPM-100</th>
                            <th>RPM-150</th>
                            <th>RPM-200</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cou = 1;
                        $from_date = $this->GM->DateSplit($fromdate);
                        $to_date = $this->GM->DateSplit($todate);
                        foreach ($this->ReportsClass->salesbyMotorsSaleswithStock($from_date, $to_date) as $Row) {
                        ?>
                            <tr>
                            <td><?php echo $Row->FormattedInvoiceDate; ?></td>
                                <td class="reportmain_wrap"><a href="<?php echo site_url("Sales/Invoice_view/?Key=") . base64_encode($Row->Invoice_Id); ?>"><?php echo $Row->Invoice_No; ?></a></td>
                                <td class="reportmain_wrap"><a href="<?php echo site_url("Users/Dealeruser_views/?Key=") . base64_encode($Row->Dealer_Id); ?>"><?php echo $Row->name; ?></a></td>
                                <td><?php echo $Row->AreaName; ?></td>
                                <td class="Currency"><?php echo $Row->TotalWithoutTax; ?></td>
                                <td class="Currency"><?php echo $Row->RPM50; ?></td>
                                <td class="Currency"><?php echo $Row->RPM100; ?></td>
                                <td class="Currency"><?php echo $Row->RPM150; ?></td>
                                <td class="Currency"><?php echo $Row->RPM200; ?></td>
                                <td class="Currency"><?php echo $Row->RPMTotal; ?></td>
                            </tr>
                        <?php
                        
                        }
                        ?>
                    </tbody>
                    <tfoot><?php $tablecolumntotallist = array('4', '5', '6', '7', '8', '9'); ?>
                        <td>Total</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="Currency"></td>
                        <td class="Currency"></td>
                        <td class="Currency"></td>
                        <td class="Currency"></td>
                        <td class="Currency"></td>
                        <td class="Currency"></td>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>
</div>
<?php include('Includes/ReportsFoot.php'); ?>