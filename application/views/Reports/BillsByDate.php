<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('ReportsHead.php');
include('ReportsMenu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Bills </h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">By Date</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Reports/BillsByDate'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
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
                            <th>Date</th>
							  <th>Bill No</th>
                            <th>Supplier</th>                          
                            <th>Sub Total</th>
                            <th>Discount</th>
                            <th>Tax</th>
							<th>Fright</th>
							<th>Insurance</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $from_date = $this->GM->DateSplit($fromdate);
                        $to_date = $this->GM->DateSplit($todate);
                        foreach ($this->ReportsClass->BillsByDate($from_date, $to_date) as $Row) {
                        ?>
                            <tr>
                                <td><?php echo $Row->FormattedBill_PurchaseDate; ?></td>
								 <td><?php echo $Row->Bill_code; ?></td>
                                <td><?php echo $Row->name; ?></td>                               
                                <td><?php echo $Row->subtotal; ?></td>
                                <td><?php echo $Row->discount; ?></td>
                                <td><?php echo $Row->taxtotal; ?></td>
								 <td><?php echo $Row->fright; ?></td>
								  <td><?php echo $Row->insurance; ?></td>
                                <td><?php echo $Row->total; ?></td>
                            </tr>
                        <?php
                           
                        }
                        ?>
                    </tbody>
                    <tfoot><?php $tablecolumntotallist = array('3', '4', '5', '6','7','8'); ?>
                        <td>Total</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td> <td></td> <td></td>
                       
                       
                      
                    </tfoot>
                </table>
            </div>
        </div>
    </section>
</div>
<?php include('ReportsFoot.php'); ?>