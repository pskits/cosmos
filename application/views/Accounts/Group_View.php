<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Group</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Group View</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Accounts/Group'); ?>" class="btn btn-flat bg-grayy" style="background:#f9f9f9;color:#1a2226;"><i class="fa fa-caret-left"></i> Back</a>
          <a href="<?php echo site_url('Accounts/Group_View'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>

        </div>
      </div>

      <div class="box-body">
        <table id="Viewtable" class="display nowrap" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Group Desc</th>
              <th>Sort</th>
              <th>Status</th>
              </tr>
          </thead>
          <tbody>
            <?php
            $cou = 1;
            $status = "1";
            $id = "0";
            foreach ($this->GM->AccountsGroup($status,$id) as $Row) {
            ?>
              <tr>
                <td ><b><?php echo $cou; ?></b></td>
                <td ><?php echo $Row->Accountsgroup_Name; ?></td>
                <td ><?php echo $Row->Accountsgroup_Desc; ?></td>
                <td ><?php echo $Row->Accountsgroup_Sort; ?></td>
                <td ><?php echo $Row->StatusName; ?></td>
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