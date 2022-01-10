<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('ReportsHead.php');
include('ReportsMenu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Receivables </h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Dealer wise Due </h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Reports/DealerWiseDue'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <div class="box-body">
                <table id="" class="table exporttable" style="width:100%">
                    <thead>
                        <tr>
                            <th>Dealer</th>
							<th>Area</th>
                            <th>Due</th>
                            <th>Available Credit</th>
                            <th>Collection</th>
							<th>CrediNote</th>
                            <th>Un Credited Collection</th>
                            <th>Actual Due</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($this->ReportsClass->DealerWiseDue() as $Row) {
                        ?>
                            <tr>
                                <td class="reportmain_wrap"><a href="<?php echo site_url("Users/Dealeruser_views/?Key=") . base64_encode($Row->Dealer_Id); ?>"><?php echo $Row->name; ?></a></td>
                                
								<td class="Currency"><?php echo $Row->AreaName; ?></td>
								<td class="Currency"><?php echo $Row->Invoice_Due; ?></td>
                                <td class="Currency"><?php echo $Row->Credit_balance; ?></td>
                                <td class="Currency"><?php echo $Row->CollectionAmount; ?></td>
								<td class="Currency"><?php echo $Row->CrediNote_total; ?></td>								
                                <td class="Currency"><?php echo $Row->UncreditedCollectionAmount; ?></td>
                                <td class="Currency"><?php echo $Row->Actual_Due ; ?></td>
                                <td><?php echo $Row->address; ?></td>
                                <td><?php echo $Row->city; ?></td>
                                <td><?php echo $Row->mobile; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tbody></tbody>
                    <tfoot><?php $tablecolumntotallist = array('2', '3', '4', '5','6','7'); ?>
                        <td>Total</td>
						 <td></td>
                        <td class="Currency"></td>
                        <td class="Currency"></td>
                        <td class="Currency"></td>
                        <td class="Currency"></td>
                        <td class="Currency"></td>
                        <td class="Currency"></td>
                        <td></td>
                        <td></td>
						 <td></td>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>
</div>
<?php include('ReportsFoot.php'); ?>