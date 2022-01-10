<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
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
          
          <a href="<?php echo site_url('Accounts/LedgerDetails_View'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>

        </div>
      </div>

      <div class="box-body">
        <table id="Viewtable" class="display nowrap" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Ledgername</th>
              <th>LedgerType_Name</th>
              <th>Accountsgroup_Name</th>             
              <th> Event </th>
              </tr>
          </thead>
          <tbody>
            <?php
            $cou = 1;
            $status = "1";
            $id = "0";
            foreach ($this->GM->AccountsLedgerDetails() as $Row) {
            ?>
              <tr>
                <td ><b><?php echo $cou; ?></b></td>
                <td ><?php echo $Row->Ledgername; ?></td>
                <td ><?php echo $Row->LedgerType_Name; ?></td>
                <td ><?php echo $Row->Accountsgroup_Name; ?></td>                
                <td>
                  <a <?php echo "href='".site_url('')."/"."Accounts/LedgerDetails_Edit/?Key=".base64_encode($Row->OfficeLedger_id)."'"  ; ?>
                  <span class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i>&nbsp; Edit</span>
                  </a>                 
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