<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Excess </h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Excess View</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Collection/Excess'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>
      <div class="box-body">
       
        <hr class="horizondal-splitter">
        <table id="Viewtable" class="display nowrap" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>CollectionNo</th>
              <th>Collection Date</th>
              <th>Collected User</th>
              <th>Dealer</th>
              <th>Mode</th>
              <th>Amount</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $cou = 1;
            foreach ($this->GM->ExcessCollection($status = "1", $collection = "0",  $Id = "0") as $Row) {
                ?>
              <tr>
                <td><b><?php echo $cou; ?></b></td>
                <td><?php echo $Row->Collection_no; ?></td>
                <td><?php echo $Row->Collection_Dateformatted; ?></td>
                <td><?php echo $Row->collecteduseremail; ?></td>
                <td><?php echo $Row->firstname . ' ' . $Row->lastname; ?></td>
                <td><?php echo $Row->AmountModeName; ?></td>
                <td><?php echo $Row->Amount; ?></td>
                <td>
                <a <?php echo "href='" . site_url('Collection/Excess_Adjustment') ."/?Key=" . base64_encode($Row->ColletionAmount_Id) . "'"; ?>><span class="badge">Adjustment</span>
                <br>
                  <a <?php echo "href='" . site_url('Collection/Collection_invoice'). "/?Key=" . base64_encode($Row->ColletionAmount_Id) . "'"; ?>><span class="badge"><i class="fa fa-eye"></i>&nbsp; View</span>
                  </a>
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
<?php include('Includes/Foot.php'); ?>