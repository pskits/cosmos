<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('ReportsHead.php');
include('ReportsMenu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Sales </h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">By Invoice</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Reports/SalesByInvoice'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
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
                <table id="Reptable" class="display " style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Dealer</th>
                            <th>Area</th>
							 <th>Date</th>
                            <th>Invoice</th>
                            <th>Sub Total</th>
                            <th>Discount</th>
                            <th>Tax</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cou = 1;
                        $from_date = $this->GM->DateSplit($fromdate);
                        $to_date = $this->GM->DateSplit($todate);
                        foreach ($this->ReportsClass->SalesByInvoice($from_date, $to_date) as $Row) {
                        ?>
                            <tr>
                                <td><b><?php echo $cou; ?></b></td>
                                <td class="reportmain_wrap"><a href="<?php echo site_url("Users/Dealeruser_views/?Key=").base64_encode($Row->Dealer_Id);?>"><?php echo $Row->name; ?></a></td>                               
                               
                                <td><?php echo $Row->AreaName; ?></td>
                                <td><?php echo $Row->Invoice_dateFormatted; ?></td>
								  <td><?php echo $Row->Invoice_No; ?></td>
                                <td class="Currency"> <?php echo $Row->Invoice_subtotal; ?></td>
                                <td class="Currency"><?php echo $Row->Invoice_Discounttotal; ?></td>
                                <td class="Currency"><?php echo $Row->Invoice_taxtotal; ?></td>
                                <td class="Currency"><?php echo $Row->Invoice_total; ?></td>
                            </tr>
                        <?php
                            $cou++;
                        }
                        ?>
                    </tbody>
                    <tfoot><?php $tablecolumntotallist = array( '3', '4', '5', '6','7'); ?>
                        <td>Total</td>
                        <td></td>
                        <td></td>
						<td></td>
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