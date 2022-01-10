<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/ReportsHead.php');
include('Includes/ReportsMenu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Due Sales </h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Register</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Reports/DueSalesRegister'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <div class="box-body">
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
                            <th>Collection No</th>
                            <th>Collection Date</th>
                            <th>Amount Mode</th>
                            <th>Amount</th>
                            <th>Cheque</th>
                            <th>Deposit no</th>
                            <th>Bank date</th>
                            <th>Collection StatusName</th>
                            <th>Paid </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $currentInv = '0';
                        $invtotal = 0;
                        $collection = 0;
                        $paid = 0;
                        foreach ($this->ReportsClass->DueSalesRegister() as $Row) {
                            if (($currentInv != $Row->Invoice_No) && ($currentInv != '0')) {
                        ?>
                                <tr style="border-bottom:1px solid #000;font-weight:800;" class="success">
                                    <td>Total</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><?php echo $invtotal; ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><?php echo $collection; ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><?php echo $paid; ?></td>
                                </tr>
                            <?php
                                $invtotal = 0;
                                $collection = 0;
                                $paid = 0;
                            }
                            if ($currentInv != $Row->Invoice_No) {
                            ?>
                                <tr class="trlist">
                                    <td class="info"><?php echo $Row->Invoice_No; ?></td>
                                    <td class="info"><?php echo $Row->Invoice_date; ?></td>
                                    <td class="info"><?php echo $Row->name; ?></td>
                                    <td class="info"><?php echo $Row->AreaName; ?></td>
                                    <td class="info"><?php echo $Row->Invoice_total; ?></td>
                                    <td><?php echo $Row->Collection_no; ?></td>
                                    <td><?php echo $Row->CollectionDate; ?></td>
                                    <td><?php echo $Row->AmountModeName; ?></td>
                                    <td><?php echo $Row->amount; ?></td>
                                    <td><?php echo $Row->Cheque_no; ?>
                                        <sub><?php echo $Row->Cheque_date; ?>
                                        </sub>
                                    </td>
                                    <td><?php echo $Row->Deposit_no; ?></td>
                                    <td><?php echo $Row->Bank_date; ?></td>
                                    <td><?php echo $Row->Collection_StatusName; ?></td>
                                    <td><?php echo $Row->paid; ?></td>
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
                                    <td style="border-top: 1px solid #000;"><?php echo $Row->Collection_no; ?></td>
                                    <td style="border-top: 1px solid #000;"><?php echo $Row->CollectionDate; ?></td>
                                    <td style="border-top: 1px solid #000;"><?php echo $Row->AmountModeName; ?></td>
                                    <td style="border-top: 1px solid #000;"><?php echo $Row->amount; ?></td>
                                    <td style="border-top: 1px solid #000;">
                                        <?php echo $Row->Cheque_no; ?>
                                        <sub><?php echo $Row->Cheque_date; ?></sub>
                                    </td>
                                    <td style="border-top: 1px solid #000;"><?php echo $Row->Deposit_no; ?></td>
                                    <td style="border-top: 1px solid #000;"><?php echo $Row->Bank_date; ?></td>
                                    <td style="border-top: 1px solid #000;"><?php echo $Row->Collection_StatusName; ?></td>
                                    <td style="border-top: 1px solid #000;"><?php echo $Row->paid; ?></td>
                                </tr>
                        <?php
                            }
                            $invtotal += $Row->Invoice_total;
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
                            <td><?php echo $invtotal; ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?php echo $collection; ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?php echo $paid; ?></td>
                        </tr>
                    </tbody>
                </table>
                <?php $tablecolumntotallist = array(); ?>
            </div>
        </div>
    </section>
</div>
<?php include('Includes/ReportsFoot.php'); ?>