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
                <h3 class="box-title">Over All Product Stock<h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Reports/Overallproductstock'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <div class="box-body">
            <br>
                <!--form class="row form-inline">
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
                </form-->
                <hr class="horizondal-splitter">
                 <table class="table exporttable" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product</th>                        
                            <th>Product Category</th>
                            <th>Imported</th>
                            <th>invoiced</th>                           
                            <th>Sales return </th>
                            <th>Sales return Replacement</th>
                            <th>Stock</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cou = 1;
                       // $from_date = $this->GM->DateSplit($fromdate);
                        //$to_date = $this->GM->DateSplit($todate);
                        //foreach ($this->ReportsClass->InventoryFlowbyBooks($from_date, $to_date) as $Row) {
                        foreach ($this->ReportsClass->Overallstock() as $Row) {
                        ?>
                            <tr>
                                <td><b><?php echo $cou; ?></b></td>
                                <td><?php echo $Row->Product; ?></td>
                                <td><?php echo $Row->ProductCategory; ?></td>
                                <td><?php echo $Row->Po_Qty; ?></td>
                                <td><?php echo $Row->Invoice_Qty; ?></td>
                                <td><?php echo $Row->SalesRetrun_Qty; ?></td>
                                <td><?php echo $Row->Replacement_Qty; ?></td>
                                <td><?php echo $Row->Stock; ?></td>                               
                            </tr>
                        <?php
                            $cou++;
                        }
                        ?>
                    </tbody>
                    <tfoot><?php $tablecolumntotallist = array('2', '3', '4', '5', '6', '7'); ?>
                        <td>Total</td>
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