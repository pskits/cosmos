<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/ReportsHead.php');
include('Includes/ReportsMenu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Details </h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Product Overall Report Without part payment</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Reports/Productoverall'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <div class="box-body">
                 <table class="table exporttable" style="width:100%">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>ProductCategory</th>
                            <th style="text-align:right;">Invoice Total</th>                            
                            <th style="text-align:right;">Salesreturn Total</th>
                            <th style="text-align:right;">Sales Net Total</th>
							<th style="text-align:right;">Collection Amount</th>
                            <th style="text-align:right;">Due</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($this->ReportsClass->Productoverall() as $Row) {
                        ?>
                            <tr>
                                <!--td class="reportmain_wrap"><a href="<?php //echo site_url("Users/Dealeruser_views/?Key=") . base64_encode($Row->Dealer_Id); ?>"><?php //echo $Row->Product; ?></a></td-->
                                <td align="left" class=""><?php echo $Row->product; ?></td>
                                <td align="left" class=""><?php echo $Row->ProductCategory; ?></td>
                                <td align="left" class="Currency"><?php echo $Row->Invoice_Total; ?></td>                                
                                <td align="left" class="Currency"><?php echo $Row->Sales_Return; ?></td>								
                                <td align="left" class="Currency"><?php echo $Row->Invoice_Net_Total; ?></td>
								<td align="left" class="Currency"><?php echo $Row->Collection_Total; ?></td>
                                <td align="left" class="Currency"><?php echo $Row->Product_Due; ?></td>
                            </tr>
                        <?php

                        }
                        ?>
                    </tbody>
                    <tfoot><?php $tablecolumntotallist = array('1', '2', '3', '4', '5','6'); ?>
                        <td>Total</td>
                        <td class="Currency"></td>
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
<?php include('Includes/ReportsFoot.php'); ?>