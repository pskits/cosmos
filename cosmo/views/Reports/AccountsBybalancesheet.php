<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/ReportsHead.php');
include('Includes/ReportsMenu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Accounts</h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Balance Sheet</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Reports/AccountsBybalancesheet'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <div class="box-body row">
                <?php
                $balancesheethead = $this->db->query("select *  
                       FROM cosmo.dbo.mas_accountsgroup where Accountsgroup_Id IN (36,63)");
                $balancesheethead = $balancesheethead->result();
                foreach ($balancesheethead  as $balancesheetheadRow) {
                ?>
                    <div class="col-md-6">
                        <table class="table " style="width:100%">
                            <thead>
                                <tr>
                                    <th colspan="2">
                                        <span style=" width:100%;font-size: 18px;
                                    text-align: left;"><?php echo $balancesheetheadRow->Accountsgroup_Name; ?> </span><br />
                                        <span style=" width:100%;text-align: center;">Accounts</span>
                                    </th>
                                    <th style="text-align: center;" colspan="2">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($this->ReportsClass->AccountsBybalancesheet($balancesheetheadRow->Accountsgroup_Id) as $masterRow) {
                                ?>
                                    <tr>
                                        <td><?php echo $masterRow->Accountsgroup_Name; ?></td>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo ($masterRow->amount < 0) ?  ($masterRow->amount * -1) : 0;
                                            echo ($masterRow->amount > 0) ?  $masterRow->amount : 0; ?></td>
                                    </tr>
                                    <?php
                                    foreach ($this->ReportsClass->AccountsBybalancesheet($masterRow->Accountsgroup_Id) as $Row) {
                                    ?>
                                        <tr>
                                            <td></td>
                                            <td><?php echo $Row->Accountsgroup_Name; ?></td>
                                            <td><?php echo ($Row->amount < 0) ?  ($Row->amount * -1) : 0;
                                                echo ($Row->amount > 0) ?  $Row->amount : 0; ?></td>
                                            <td></td>
                                        </tr>
                                    <?php
                                    }
                                    foreach ($this->ReportsClass->AccountsBybalancesheetLedgerGroupwise($masterRow->Accountsgroup_Id) as $Row) {
                                    ?>
                                        <tr>
                                            <td></td>
                                            <td><?php echo $Row->Ledgername; ?></td>
                                            <td><?php echo ($Row->amount < 0) ?  ($Row->amount * -1) : 0;
                                                echo ($Row->amount > 0) ?  $Row->amount : 0; ?></td>
                                            <td></td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot><?php $tablecolumntotallist = array('2', '3'); ?>
                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tfoot>
                        </table>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
</div>
<?php include('Includes/ReportsFoot.php'); ?>