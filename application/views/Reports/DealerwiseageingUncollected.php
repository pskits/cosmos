<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('ReportsHead.php');
include('ReportsMenu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Receivables </h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Dealer Wise ageing Uncollected</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Reports/DealerwiseageingUncollected'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <div class="box-body">
                 <table class="table exporttable" style="width:100%">
                    <thead>
                        <tr>
                            <th>Dealer</th>
                            <th>Area</th>
                            <th>Credit Period</th>
                            <th>Today</th>
                            <th>
                                < 7 Days</th>
                            <th>
                                < 15 Days</th>
                            <th>
                                < 30 Days</th>
                            <th>
                                < 60 Days</th>
                            <th> 60 Days ></th>
                            <th> Total OverDue</th>
                            <th> Total Due</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($this->ReportsClass->DealerwiseageingUncollected() as $Row) {
                        ?>
                            <tr>
                            <td class="reportmain_wrap"><a href="<?php echo site_url("Users/Dealeruser_views/?Key=") . base64_encode($Row->Dealer_Id); ?>"><?php echo $Row->name; ?></a></td>
                            
                                <td><?php echo $Row->AreaName; ?></td>
                                <td class="Currency"><?php echo $Row->CreditperiodDue; ?></td>
                                <td class="Currency"><?php echo $Row->TodayDue; ?></td>
                                <td class="Currency"><?php echo $Row->Todaybove_SevenDaysBelow; ?></td>
                                <td class="Currency"><?php echo $Row->SevenDaysAbove_FifeeteenDaysBelow; ?></td>
                                <td class="Currency"><?php echo $Row->FifeeteenDaysAbove_ThirtyDaysBelow; ?></td>
                                <td class="Currency"><?php echo $Row->ThirtyDaysAbove_SixtyDaysBelow; ?></td>
                                <td class="Currency"><?php echo $Row->SixtyDaysAbove; ?></td>
                                <td class="Currency"><?php echo $Row->totaloverdue; ?></td>
                                <td class="Currency"><?php echo $Row->TotalDue; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot><?php $tablecolumntotallist = array('2', '3', '4', '5', '6', '7', '8', '9','10'); ?>
                        <td>Total</td>
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
<?php include('ReportsFoot.php'); ?>