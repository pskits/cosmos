<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Truck</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Truck View</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Category/Truck'); ?>" class="btn btn-flat bg-grayy" style="background:#f9f9f9;color:#1a2226;"><i class="fa fa-caret-left"></i> Back</a>
          <a href="<?php echo site_url('Category/Truck_View'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>

      <div class="box-body">
        <table id="Viewtable" class="display nowrap" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Truck Name</th>
              <th>Driver InCharge</th>
              <th>description</th>
              <th>registration_no</th>

              <th>dimension</th>
              <th>volume</th>           
              <th>Status</th>

            </tr>
          </thead>
          <tbody>
            <?php
            $cou = 1;
            $status_id = "0";
            $Warehouse_id = "0";
            $id = "0";
            foreach ($this->GM->Truck($status_id, $id) as $Row) {
            ?>
              <tr>
                <td ><b><?php echo $cou; ?></b></td>
                <td ><?php echo $Row->name; ?></td>
                <td ><?php echo $Row->Firstname . ' ' . $Row->Lastname; ?></td>
                <td ><?php echo $Row->description; ?></td>
                <td ><?php echo $Row->registration_no; ?></td>
                <td ><?php echo $Row->dimension; ?></td>

                <td ><?php echo $Row->volume; ?></td>
              
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