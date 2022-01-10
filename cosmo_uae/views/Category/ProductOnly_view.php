<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');


?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Product</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Product View</h3>
        <div class="box-tools pull-right">
          <?php
        
            $ProductCategory_Id = "0";
            $_GET['Key'] = base64_encode($ProductCategory_Id);
           ?>
          <a href="<?php echo site_url('Category/ProductOnly_View?Key=' . $_GET['Key'] . ''); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>

        </div>

      </div>

      <div class="box-body">
        <table id="Viewtable" class="display nowrap" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>ProductCategory</th>
              <th>Product</th>
              <th>SKU</th>
              <th>Dimension</th>
              <th>Volume</th>
              <th>Description</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $cou = 1;
            $status = "0";
            $ProductCategory_id = base64_decode($_GET['Key']);
            $id = "0";
            foreach ($this->GM->Product($status, $ProductCategory_id, $id) as $Row) {

            ?>
              <tr>
                <td><b><?php echo $cou; ?></b></td>
                <td><?php echo $Row->ProductCategory; ?></td>
                <td><?php echo $Row->Product; ?></td>
                <td><?php echo $Row->SKU; ?></td>
                <td><?php echo $Row->Dimension; ?></td>
                <td><?php echo $Row->Volume; ?></td>
                <td><?php echo $Row->Description; ?></td>
                <td><?php echo $Row->StatusName; ?></td>

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