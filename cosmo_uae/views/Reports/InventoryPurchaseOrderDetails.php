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
                <h3 class="box-title">Inventory Purchase Order Details</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Reports/InventoryPurchaseOrderDetails'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <div class="box-body">
                 <table class="table exporttable" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Purchase Order Code</th>
                            <th>Inward Date</th>
                            <th>Product</th>
                            <th>Product Rate</th>                       
                            <th>Quantity</th>                            
                            <th>Serial</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cou = 1;
                        foreach ($this->ReportsClass->InventoryPurchaseOrderDetails() as $Row) {
                        ?>
                            <tr>
                                <td><b><?php echo $cou; ?></b></td>
                                <td><?php echo $Row->PurchaseOrder_code; ?></td>
                                <td><?php echo $Row->inward_date; ?></td>
                                <td><?php echo $Row->Product; ?></td>
                                <td><?php echo $Row->Trans_PurchaseOrderProduct_Rate; ?></td>
                               <td><?php echo $Row->Trans_PurchaseOrderProduct_Quantity; ?></td>                            
                                <td><?php echo $Row->quantity; ?></td>                            
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