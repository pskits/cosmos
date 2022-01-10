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
                <h3 class="box-title">Un Credited</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Reports/CollectionUncredited'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <div class="box-body">
            
                 <table class="table exporttable" style="width:100%">
                    <thead>
                        <tr>
                            
                            <th>Collection No</th>
                            <th>Collection Date</th>
                            <th>Dealer</th>
							 <th>Area</th>
							  <th>Collected User</th>
                            <th>Mode</th>
                            <th>Info</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cou = 1;
                      
                        foreach ($this->ReportsClass->CollectionUncredited() as $Row) {
                        ?>
                            <tr>
                                <td class="reportmain_wrap"><a href="<?php echo site_url("Collection/Collection_invoice/?Key=") . base64_encode($Row->Colletion_Id); ?>"><?php echo $Row->Collection_no; ?></a></td>
                              
                                <td><?php echo $Row->CollectionDate; ?></td>
                                <td class="reportmain_wrap"><a href="<?php echo site_url("Users/Dealeruser_views/?Key=") . base64_encode($Row->Dealer_Id); ?>"><?php echo $Row->name; ?></a></td>
   <td><?php echo $Row->AreaName; ?></td>
                                <td><?php echo $Row->collecteduser; ?></td>                             
							 <td><?php echo $Row->AmountModeName; ?></td>
							 
                                <td><?php echo $Row->Cheque_no . ' ' . $Row->Cheque_date . ' ' . $Row->Cheque_bank; ?></td>
                                <td class="Currency"><?php echo $Row->amount; ?></td>
                                <td><?php echo (empty($Row->Settlement_no)) ? $Row->Collection_StatusName : 'Settled'; ?></td>
                            </tr>
                        <?php
                            $cou++;
                        }
                        ?>
                    </tbody>
                    <tfoot><?php $tablecolumntotallist = array('5'); ?>
                        <td>Total</td>
                      
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="Currency"></td>
                        <td></td>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>
</div>
<?php include('Includes/ReportsFoot.php'); ?>