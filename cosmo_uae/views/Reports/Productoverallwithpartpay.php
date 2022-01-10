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
                <h3 class="box-title">Product Overall Report With part payment</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Reports/Productoverall'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <div class="box-body">
                 <table class="table exporttable" style="width:100%">
                    <thead>
                        <tr>
							<th>#</th>
                            <th>Invoice No</th>                            
                            <th style="text-align:right;">Invoice Total</th>                            
                            <th style="text-align:right;">Salesreturn Total</th>
                            <th style="text-align:right;">Net Total</th>
							<th style="text-align:right;">Collection Amount</th>
                            <th style="text-align:right;">Due</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						$count=1;
						
                        foreach ($this->ReportsClass->Productoverallinvoice() as $Row) {
                        ?>
                            <tr>
								<td><?php echo $count ?></td>
                                <td align="left" class=""><?php echo $Row->Invoice_No; ?></td>
                                <td align="left" class="Currency"><?php echo $Row->InvoiceProduct_total; ?></td>
                                <td align="left" class="Currency"><?php echo $Row->SalesReturnProduct_total; ?></td>                                
                                <td align="left" class="Currency"><?php echo $Row->Net_Total; ?></td>								
                                <td align="left" class="Currency"><?php echo $Row->CollectedAmount; ?></td>
								<td align="left" class="Currency"><?php echo $Row->Invoice_Due; ?></td>                                
                            </tr>
							
							<?php
							/*foreach ($this->ReportsClass->Productoverallinvoicepro($Row->Invoice_Id) as $Row) {
							?>							
							<tr style="background: lightgreen;">
																										
								<td align="right"><?php echo $Row->product; ?></td>
                                <td align="right"><?php echo $Row->ProductCategory; ?></td>
                                <td align="right"><?php echo $Row->InvoiceProduct_total; ?></td>                                
                                <td align="right"><?php echo $Row->SalesReturnProduct_total; ?></td>								
                                <td align="right"><?php echo $Row->Product_Net_totel; ?></td>	
								<td>
								<?php 
									
								?>
								</td>
								<td></td>								
							<tr/>							
							<?php }*/ ?>
							
							
                        <?php $count++;
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