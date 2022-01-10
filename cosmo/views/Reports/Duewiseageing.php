<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/ReportsHead.php');
include('Includes/ReportsMenu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Receivables </h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Due Wise ageing </h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Reports/Duewiseageing'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <div class="box-body">
                 <table class="table exporttable" style="width:100%">
                    <thead>
                        <tr>
                            <th>Dealer</th>
                            <th>Area</th>
                            <th>INV <br> No</th>
                            <th>INV <br>Date</td>
                            <th>Due <br> Date</td>
                            <th>Invoice Total</th>
                            <th>Credit</th>
                            <th>Today</th>
                            <th> 7 Days</th>
                            <th> 15 Days</th>
                            <th> 30 Days</th>
                            <th> 60 Days</th>
                            <th>>60 Days</th>
                            <th>Due </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($this->ReportsClass->Duewiseageing() as $Row) {
                        ?>
                            <tr>
                                <td class="reportmain_wrap"><a href="<?php echo site_url("Users/Dealeruser_views/?Key=") . base64_encode($Row->Dealer_Id); ?>"><?php echo $Row->name; ?></a></td>
                                <td class="reportmain_wrap_sm"><?php echo $Row->AreaName; ?></td>
                                <td class="reportmain_wrap_sm"><a href="<?php echo site_url("Sales/Invoice_view/?Key=") . base64_encode($Row->Invoice_Id); ?>"><?php echo $Row->Invoice_No; ?></a></td>
                                <td class="reportmain_wrap_sm"><?php echo $Row->Invoice_dateFormatted; ?></td>
                                <td class="reportmain_wrap_sm"><?php echo $Row->InvoiceDue_DateFormatted; ?></td>
                                <td class="reportmain_wrap_sm Currency"><?php echo $Row->Invoice_total; ?></td>
                                <td class="reportmain_wrap_sm Currency"><?php echo $Row->CreditperiodDue; ?></td>
                                <td class="reportmain_wrap_sm Currency"><?php echo $Row->TodayDue; ?></td>
                                <td class="reportmain_wrap_sm Currency"><?php echo $Row->Todaybove_SevenDaysBelow; ?></td>
                                <td class="reportmain_wrap_sm Currency"><?php echo $Row->SevenDaysAbove_FifeeteenDaysBelow; ?></td>
                                <td class="reportmain_wrap_sm Currency"><?php echo $Row->FifeeteenDaysAbove_ThirtyDaysBelow; ?></td>
                                <td class="reportmain_wrap_sm Currency"><?php echo $Row->ThirtyDaysAbove_SixtyDaysBelow; ?></td>
                                <td class="reportmain_wrap_sm Currency"><?php echo $Row->SixtyDaysAbove; ?></td>
                                <td class="reportmain_wrap_sm Currency"><?php echo $Row->Invoice_Due; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot><?php $tablecolumntotallist = array('5', '6', '7', '8', '9', '10', '11', '12', '13'); ?>
                        <td>Total</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="Currency"></td>
                        <td class="Currency"></td>
                        <td class="Currency"></td>
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