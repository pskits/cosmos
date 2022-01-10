<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/ReportsHead.php');
include('Includes/ReportsMenu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Inventory  </h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Current Serialno</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Reports/InventorySerialno'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <div class="box-body">
                 <table class="table exporttable" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Warehouse</th>
                            <th>Product</th>
                            <th>Product Category</th>
                            <th>Serial_No</th>
                            <th>Goods Status</th>
                            <th>Inward Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cou = 1;
                        foreach ($this->ReportsClass->InventorySerialno() as $Row) {
                        ?>
                            <tr>
                                <td><b><?php echo $cou; ?></b></td>
                                <td><?php echo $Row->WarehouseName; ?></td>
                                <td><?php echo $Row->Product; ?></td>
                                <td><?php echo $Row->ProductCategory; ?></td>
                                <td><?php echo $Row->Serial_No; ?></td>
                                <td><?php echo $Row->Goods_status_Name; ?></td>
                                <td><?php echo $Row->inward_GoodsType_StatusName; ?></td>
                            </tr>
                        <?php
                            $cou++;
                        }
                        ?>
                    </tbody>
                    <?php $tablecolumntotallist = array(); ?>
           
                </table>
            </div>
        </div>
    </section>
</div>
<?php include('Includes/ReportsFoot.php'); ?>