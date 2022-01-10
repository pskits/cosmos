<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('ReportsHead.php');
include('ReportsMenu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Dealers </h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">All Contacts</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Reports/DealerAllContacts'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <div class="box-body">
                <table class="table exporttable" style="width:100%">
                    <thead>
                        <tr>
                            <th>Dealer</th>
                            <th>Area</th>
                            <th>Contact Number</th>
                            <th>Type</th>
                            <th>Contact Name</th>
                            <th>Address</th>
                            <th>City</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $render = '';
                        foreach($this->ReportsClass->DealerAllContacts() as $Row) {
                            $render .= '<tr>                             
                                <td>' . $Row->name . '</td>
                                <td>' . $Row->AreaName . '</td>                             
                                <td>' . $Row->mobile . '<br>' . $Row->alt_mobile . '</td>
                                <td>' . $Row->DealerContacttype . '</td>
                                <td>' . $Row->firstname . '' . $Row->lastname . '</td>
                                <td>' . $Row->address . '</td>
                                <td>' . $Row->city . '</td>
                            </tr>';
                        }
                        echo $render;
                        ?>
                    </tbody>
                    <tfoot><?php $tablecolumntotallist = array(); ?>
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