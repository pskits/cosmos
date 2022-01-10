<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Deduction</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Deduction View</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Category/Deduction'); ?>" class="btn btn-flat bg-grayy" style="background:#f9f9f9;color:#1a2226;"><i class="fa fa-caret-left"></i> Back</a>
          <a href="<?php echo site_url('Category/Deduction_View'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>

      <div class="box-body">
        <table id="Viewtable" class="display nowrap" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Deduction Name</th>
              <th>Deduction</th>
              <th>Deduction Type</th>
              <th>Status</th>

            </tr>
          </thead>
          <tbody>
            <?php
            $cou = 1;
            foreach ($this->GM->Deduction('0', '0') as $Row) {
            ?>
              <tr>
                <td ><b><?php echo $cou; ?></b></td>

                <td ><?php echo $Row->Deduction_name; ?></td>
                <td ><?php echo $Row->Deduction; ?></td>
                <td ><?php echo $Row->DiscountTypeName; ?></td>

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