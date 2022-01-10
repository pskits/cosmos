<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/ReportsHead.php');
include('Includes/ReportsMenu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Sales </h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Register</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Reports/SalesRegister'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
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
                <style>
                    .table thead tr th,
                    .table tbody tr td {
                        border: none;
                    }
                    .trlist {
                        height: 50px;
                    }
                </style>
                <table id="" class="table table-borderless table-responsive" style="width:100%;border:2px solid #666;">
                    <thead>
                        <tr>
                            <th>Invoice No</th>
                            <th>Invoice Date</th>
                            <th>Dealer</th>
                            <th>Area</th>
                            <th>Total</th>
                            <th>Source</th>
                            <th>Date</th>
                            <th>Amount Mode</th>
                            <th>Cheque</th>
                            <th>collected</th>
                            <th>Collection StatusName</th>
                            <th>Bank date</th>
                            <th>Voucher no</th>
                           
                           
                            <th>Paid </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $from_date = $this->GM->DateSplit($fromdate);
                        $to_date = $this->GM->DateSplit($todate);
                        $currentInv = '0';
                        $invtotal = 0;
                        $collection = 0;
                        $paid = 0;
                        foreach ($this->ReportsClass->SalesRegister($from_date, $to_date) as $Row) {
                            if (($currentInv != $Row->Invoice_No) && ($currentInv != '0')) {
                        ?>
                                <tr style="border-bottom:1px solid #000;font-weight:800;" class="success">
                                    <td>Total</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="Currency"><?php echo $invtotal; ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="Currency"><?php echo $collection; ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="Currency"><?php echo $paid; ?></td>
                                </tr>
                            <?php
                                $invtotal = 0;
                                $collection = 0;
                                $paid = 0;
                            }
                            if ($currentInv != $Row->Invoice_No) {
                                $invtotal += $Row->Invoice_total;
                            ?>
                                <tr class="trlist">
                                <td class="reportmain_wrap info"><a href="<?php echo site_url("Sales/Invoice_view/?Key=").base64_encode($Row->Invoice_Id);?>"><?php echo $Row->Invoice_No; ?></a></td>                               
                              
                                    <td class="info"><?php echo $Row->Invoice_date; ?></td>
                                    <td class="reportmain_wrap info"><a href="<?php echo site_url("Users/Dealeruser_views/?Key=").base64_encode($Row->Dealer_Id);?>"><?php echo $Row->name; ?></a></td>                               
                                    <td class="info"><?php echo $Row->AreaName; ?></td>
                                    <td class="info Currency"><?php echo $Row->Invoice_total; ?></td>
                                    <td><?php echo $Row->Source; ?></td>
                                    <td><?php echo $Row->CollectionDate; ?></td>
                                    <td><?php echo $Row->AmountModeName; ?></td>
                                    <td><?php echo $Row->Cheque_no; ?>
                                        <sub><?php echo $Row->Cheque_date; ?>
                                        </sub>
                                    </td>
                                    <td class="Currency"><?php echo $Row->amount; ?></td>
                                    <td><?php echo $Row->Collection_StatusName; ?></td>
                                    <td><?php echo $Row->Bank_date; ?></td>  
                                    <td><?php echo $Row->Voucher_no; ?></td>
                                                                 
                                    <td class="Currency"><?php echo $Row->paid; ?></td>
                                </tr>
                            <?php
                            } else {
                            ?>
                                <tr>
                                    <td class="info"></td>
                                    <td class="info"></td>
                                    <td class="info"></td>
                                    <td class="info"></td>
                                    <td class="info"></td>
                                    <td style="border-top: 1px solid #000;"><?php echo $Row->Source; ?></td>
                                    <td style="border-top: 1px solid #000;"><?php echo $Row->CollectionDate; ?></td>
                                    <td style="border-top: 1px solid #000;"><?php echo $Row->AmountModeName; ?></td>
                                    <td style="border-top: 1px solid #000;">
                                        <?php echo $Row->Cheque_no; ?>
                                        <sub><?php echo $Row->Cheque_date; ?></sub>
                                    </td>
                                    <td style="border-top: 1px solid #000;" class="Currency"><?php echo $Row->amount; ?></td>
                                    <td style="border-top: 1px solid #000;"><?php echo $Row->Collection_StatusName; ?></td>
                                    <td style="border-top: 1px solid #000;"><?php echo $Row->Bank_date; ?></td>
                                    <td style="border-top: 1px solid #000;"><?php echo $Row->Voucher_no; ?></td>
                       
                                     <td style="border-top: 1px solid #000;" class="Currency"><?php echo $Row->paid; ?></td>
                                </tr>
                        <?php
                            }
                            $collection += $Row->amount;
                            $paid += $Row->paid;
                            $currentInv = $Row->Invoice_No;
                        }
                        ?>
                        <tr class="success" style="border-bottom:1px solid #000;font-weight:800;">
                            <td>Total</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="Currency"><?php echo $invtotal; ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="Currency"><?php echo $collection; ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="Currency"><?php echo $paid; ?></td>
                        </tr>
                    </tbody>
                </table>
                <?php $tablecolumntotallist = array(); ?>
            </div>
        </div>
    </section>
</div>
<?php include('Includes/ReportsFoot.php'); ?>