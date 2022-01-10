<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/ReportsHead.php');
include('Includes/ReportsMenu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Return </h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">by Open Returns</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Reports/Returnbyopenreturns'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <div class="box-body">
                 <table class="table exporttable" style="width:100%">
                    <thead>
                        <tr>
                            <th>Return No</th>
                            <th>Return Date</th>
                            <th>Serial </th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($this->ReportsClass->Returnbyopenreturns() as $Row) {
                        ?>
                            <tr>
                                <td><?php echo $Row->SalesReturnRequest_No; ?></td>
                                <td><?php echo $Row->SalesReturnRequest_date; ?></td>
                                <td><?php echo $Row->SerialNo; ?></td>
                                <td><?php echo $Row->SalesReturnRequest_statusName; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot><?php $tablecolumntotallist = array(); ?>
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