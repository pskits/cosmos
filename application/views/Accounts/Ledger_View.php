<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Ledger</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Ledger View</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Accounts/Ledger'); ?>" class="btn btn-flat bg-grayy" style="background:#f9f9f9;color:#1a2226;"><i class="fa fa-caret-left"></i> Back</a>
          <a href="<?php echo site_url('Accounts/Ledger_View'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>

        </div>
      </div>

      <div class="box-body">
        <table id="Viewtable" class="display nowrap" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Group</th>
              <th>Name</th>
              <th>Code</th>
              <th>Status</th>
			   <th>Action</th>
              </tr>
          </thead>
          <tbody>
            <?php
            $cou = 1;
            $status = "0";
            $accountsgroup_id="0";
            $id = "0";
            foreach ($this->GM->Ledger($status,$accountsgroup_id,$id) as $Row) {
            ?>
              <tr>
                <td ><b><?php echo $cou; ?></b></td>
                <td ><?php echo $Row->Accountsgroup_Name; ?></td>
                <td ><?php echo $Row->Ledger_Name; ?></td>
                <td ><?php echo $Row->Ledger_Code; ?></td>
                <td ><?php echo $Row->StatusName; ?></td>

				<td>   <a <?php echo "href='" . site_url('Accounts/Ledger') ."/?Key=" . base64_encode($Row->Ledger_Id) . "'"; ?> <span class="badge"><i class="fa fa-pencil"></i>&nbsp; Edit</span>
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