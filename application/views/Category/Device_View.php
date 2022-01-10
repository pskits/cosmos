<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Device</h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Device View</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Category/Device'); ?>" class="btn btn-flat bg-grayy" style="background:#f9f9f9;color:#1a2226;"><i class="fa fa-caret-left"></i> Back</a>
                    <a href="<?php echo site_url('Category/Device_View'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <div class="box-body">
                <table id="Viewtable" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>isVirtual</th>
                            <th>manufacturer </th>
                            <th>model </th>
                            <th>platform </th>
                            <th>serial </th>
                            <th>uuid </th>
                            <th>version </th>
                            <th>our_uid </th>
                            <th>Last Requested Email </th>
                            <th>Status</th>
                            <th>Tools</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cou = 1;
                        foreach ($this->GM->Device('0', '0') as $Row) {
                        ?>
                            <tr>
                                <td><?php echo $cou; ?></td>
                                <td><?php echo $Row->isVirtual; ?></td>
                                <td><?php echo $Row->manufacturer; ?></td>
                                <td><?php echo $Row->model; ?></td>
                                <td><?php echo $Row->platform; ?></td>
                                <td><?php echo $Row->serial; ?></td>
                                <td><?php echo $Row->uuid; ?></td>
                                <td><?php echo $Row->version; ?></td>
                                <td><?php echo $Row->our_uid; ?></td>
                                <td><?php echo $Row->Email; ?></td>
                                <td><?php echo $Row->StatusName; ?></td>
                                <td>
                                <a <?php echo "href='" . site_url('Category/Deviceapproval_views') . "/?Key=" . base64_encode($Row->Device_Id) . "'"; ?> <span class="badge"><i class="fa fa-eye"></i>&nbsp; View</span>
                                 </td>
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