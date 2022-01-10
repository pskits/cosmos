<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Paytype</h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Paytype View</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Category/Paytype'); ?>" class="btn btn-flat bg-grayy" style="background:#f9f9f9;color:#1a2226;"><i class="fa fa-caret-left"></i> Back</a>
                    <a href="<?php echo site_url('Category/Paytype_View'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <div class="box-body">
                <table id="Viewtable" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Paytype Name</th>
                            <th>Starting</th>
                            <th>Pay Calc(in Days)</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cou = 1;
                        foreach ($this->GM->Paytype('0', '0') as $Row) {
                        ?>
                            <tr>
                                <td><b><?php echo $cou; ?></b></td>
                                <td><?php echo $Row->pay_type; ?></td>
                                <td><?php echo $Row->Starting_date . '' . $Row->Starting_day . '' . $Row->Everyday; ?></td>
                                <td><?php echo $Row->Calc_till_noofdays; ?></td>
                                <td><?php echo $Row->StatusName; ?></td>
                            </tr>
                        <?php
                            $cou++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<?php include('Foot.php'); ?>