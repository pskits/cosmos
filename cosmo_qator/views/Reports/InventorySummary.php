<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/ReportsHead.php');
include('Includes/ReportsMenu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Inventory Summary </h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Current Goods</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Reports/InventorySummary'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <div class="box-body">
                 <table class="table exporttable" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Product Category</th>
                            <th>Good</th>
                            <th>Damaged</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cou = 1;
                        foreach ($this->ReportsClass->InventorySummary() as $Row) {
                        ?>
                            <tr>
                                <td><b><?php echo $cou; ?></b></td>
                                <td><?php echo $Row->Product; ?></td>
                                <td><?php echo $Row->ProductCategory; ?></td>
                                <td><?php echo $Row->good; ?></td>                                
                                <td><?php echo $Row->damaged; ?></td>
                            </tr>
                        <?php
                            $cou++;
                        }
                        ?>
                    </tbody>
                    <tfoot><?php $tablecolumntotallist = array('3', '4','5'); ?>
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
</div>
<?php include('Includes/ReportsFoot.php'); ?>