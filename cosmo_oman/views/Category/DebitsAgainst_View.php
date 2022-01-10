<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>DebitsAgainst</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">DebitsAgainst View</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Category/DebitsAgainst'); ?>" class="btn btn-flat bg-grayy" style="background:#f9f9f9;color:#1a2226;"><i class="fa fa-caret-left"></i> Back</a>
          <a href="<?php echo site_url('Category/DebitsAgainst_View'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>
      <div class="box-body">
        <table id="Viewtable" class="display nowrap" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Debits Type Name</th>
              <th>Debits Against Name</th>
              <th>Code</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $cou = 1;
            foreach ($this->GM->DebitsAgainst($status_Id="1",$DebitsMode="0",$DebitsType="0", $DebitsAgainst = "0") as $Row) {
            ?>
              <tr>
                <td><b><?php echo $cou; ?></b></td>
                <td><?php echo $Row->Debits_TypeName; ?></td>
                <td><?php echo $Row->DebitsAgainst_Name; ?></td>
                <td><?php echo $Row->DebitsAgainst_Code; ?></td>
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
<?php include('Includes/Foot.php'); ?>