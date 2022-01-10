<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');


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
          if (isset($_GET['Key'])) {
            $ProductCategory_Id = base64_decode($_GET['Key']);
          ?>
            <a href="<?php echo site_url('Category/ProductCategory_View'); ?>" class="btn btn-flat bg-grayy" style="background:#f9f9f9;color:#1a2226;"><i class="fa fa-caret-left"></i> Back</a>
          <?php } else {
            $ProductCategory_Id = "0";
            $_GET['Key'] = base64_encode($ProductCategory_Id);
          } ?>
          <a href="<?php echo site_url('Category/Product_View?Key=' . $_GET['Key'] . ''); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>

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
			  <th>Action</th>
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
<td>   <a <?php echo "href='" . site_url('Category/Product') ."/?Product_Id=" . base64_encode($Row->Product_Id) . "'"; ?> <span class="badge"><i class="fa fa-pencil"></i>&nbsp; Edit</span>
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