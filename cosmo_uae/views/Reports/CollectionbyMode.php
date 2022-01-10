<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/ReportsHead.php');
include('Includes/ReportsMenu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Collection </h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">By Mode</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Reports/CollectionbyMode'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
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
                            <th>#</th>
                            <th>Collection No</th>
                            <th>Collection Date</th>
                            <th>Dealer</th>                           
                            <th>Cash</th>
                            <th>Cheque</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cou = 1;
                        $from_date = $this->GM->DateSplit($fromdate);
                        $to_date = $this->GM->DateSplit($todate);
                        foreach ($this->ReportsClass->CollectionbyMode($from_date, $to_date) as $Row) {
                        ?>
                            <tr>
                                <td><b><?php echo $cou; ?></b></td>
                                <td class="reportmain_wrap"><a href="<?php echo site_url("Collection/Collection_invoice/?Key=").base64_encode($Row->Colletion_Id);?>"><?php echo $Row->Collection_no; ?></a></td>                               
                              
                            
                                <td><?php echo $Row->CollectionDate; ?></td>
                                <td class="reportmain_wrap"><a href="<?php echo site_url("Users/Dealeruser_views/?Key=").base64_encode($Row->Dealer_Id);?>"><?php echo $Row->name; ?></a></td>                               
                              
                                <?php
                                if($Row->AmountMode_Id=='2')
                                {
                                    ?>
                                       <td class="Currency"><?php echo $Row->amount; ?></td>    
                                       <td></td>      
                                    <?php
                                }
                                if($Row->AmountMode_Id=='1')
                                {
                                    ?>                                     
                                       <td></td> 
                                       <td class="Currency"><?php echo $Row->amount; ?></td>         
                                    <?php
                                }?>
                                                 
                            </tr>
                        <?php
                            $cou++;
                        }
                        ?>
                    </tbody>
                    <tfoot><?php $tablecolumntotallist = array('4','5');?>
                        <td>Total</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="Currency"></td>
                        <td class="Currency"></td>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>
</div>
<?php include('Includes/ReportsFoot.php'); ?>