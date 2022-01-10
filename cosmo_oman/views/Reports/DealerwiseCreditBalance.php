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
                <h3 class="box-title">Dealer wise Credit Balance</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Reports/DealerwiseCreditBalance'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <div class="box-body">
                 <table class="table exporttable" style="width:100%">
                    <thead>
                        <tr>
                            <th>Dealer</th>
                            <th>Credit Limit</th>
                            <th>Order Amount</th>
                            <th>SalesReturn(RePay)</th>
                            <th>Collected Amount</th>
                            <th>Due</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($this->ReportsClass->DealerwiseCreditBalance() as $Row) {
                        ?>
                            <tr>
                                <td class="reportmain_wrap"><a href="<?php echo site_url("Users/Dealeruser_views/?Key=") . base64_encode($Row->Dealer_Id); ?>"><?php echo $Row->name; ?></a></td>
                                <td class="Currency"><?php echo $Row->credit_limit; ?></td>
                                <td class="Currency"><?php echo $Row->Invoice_total; ?></td>
                                <td class="Currency"><?php echo $Row->SalesReturnPaidAmount; ?></td>
                                <td class="Currency"><?php echo $Row->CollectionAmount; ?></td>
                                <td class="Currency"><?php echo $Row->Invoice_Due; ?></td>
                            </tr>
                        <?php

                        }
                        ?>
                    </tbody>
                    <tfoot><?php $tablecolumntotallist = array('1', '2', '3', '4', '5'); ?>
                        <td>Total</td>
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