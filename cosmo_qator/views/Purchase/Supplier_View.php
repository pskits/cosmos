<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
  <section class="content-header">
    <!-- <h1>Supplier Entry View</h1> -->
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">List of Suppliers</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Purchase/Supplier'); ?>" class="btn btn-flat bg-grayy" style="background:#f9f9f9;color:#1a2226;"><i class="fa fa-caret-left"></i> Back</a>
          <a href="<?php echo site_url('Purchase/Supplier_View'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>
      <div class="box-body">
        <table id="Viewtable" class="display nowrap" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>     
              <th>Country</th>
              <th>Currency</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $cou = 1;
            foreach ($this->GM->Supplier($status_id = "1",  $id = "0") as $Row) {
            ?>
              <tr>
                <td><b><?php echo $cou; ?></b></td>
                <td><?php echo $Row->name; ?></td>                       
                <td><?php echo $Row->CountryName; ?></td>
                <td><?php echo $Row->CurrencyName; ?></td>
                <td><?php echo $Row->StatusName; ?></td>
                <td>
                  <a <?php echo "href='" . site_url('Purchase/Supplier') . "/?Key=" . base64_encode($Row->Supplier_Id) . "'"; ?> <span class="badge"><i class="fa fa-pencil"></i>&nbsp; Edit</span>
                  </a>
                  <a <?php echo "href='" . site_url('Purchase/Supplieruser_View') . "/?Key=" . base64_encode($Row->Supplier_Id) . "'"; ?> <span class="badge"><i class="fa fa-search"></i>View</span>
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