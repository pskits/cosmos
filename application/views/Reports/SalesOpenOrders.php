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
                <h3 class="box-title">Open Order</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Reports/SalesOpenOrders'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <div class="box-body">
             
                 <table class="table exporttable" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order No</th>
                            <th>Date</th>
                            <th>Dealer</th>
                            <th>Area</th>
                            <th>Product</th>
                            <th>Offer</th>
                            <th>Credit</th>
                            <th>Quantity</th>
                            <th>Rate</th>
                            <th>Sub Total</th>
                            <th>Discount</th>
                            <th>Tax</th>
                            <th>Total</th>
                            <th>Priyority</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cou = 1;
                      
                        foreach ($this->ReportsClass->SalesOpenOrders() as $Row) {
                        ?>
                            <tr>
                                <td><b><?php echo $cou; ?></b></td>
                                <td class="reportmain_wrap"><a href="<?php echo site_url("Sales/Orderlist_view/?Key=").base64_encode($Row->Order_Id);?>"><?php echo $Row->Order_No; ?></a></td>                               
                              
                                <td><?php echo $Row->FormattedOrderDate; ?></td>
                                <td class="reportmain_wrap"><a href="<?php echo site_url("Users/Dealeruser_views/?Key=").base64_encode($Row->Dealer_Id);?>"><?php echo $Row->name; ?></a></td>                               
                              
                                <td><?php echo $Row->AreaName; ?></td>
                                <td><?php echo $Row->Product; ?></td>
                                <td><?php echo $Row->OfferName; ?></td>
                                <td><?php echo $Row->CreditPeriod; ?></td>
                                <td><?php echo $Row->OrderProduct_Quantity; ?></td>
                                <td><?php echo $Row->OrderProduct_rate; ?></td>
                                <td><?php echo $Row->OrderProduct_subtotal; ?></td>
                                <td><?php echo $Row->OrderProduct_discount_total; ?></td>
                                <td><?php echo $Row->OrderProduct_tax_total; ?></td>
                                <td><?php echo $Row->OrderProduct_total; ?></td>
                                <td><?php echo $Row->Order_Priyority_Name; ?></td>
                                <td><?php echo $Row->Order_status_Name; ?></td>
                            </tr>
                        <?php
                            $cou++;
                        }
                        ?>
                    </tbody>
                    <tfoot><?php $tablecolumntotallist = array('7','8','9','10','11','12','13','14'); ?>
                        <td>Total</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
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
<?php include('ReportsFoot.php'); ?>