<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Country</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Country View</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Category/Country'); ?>" class="btn btn-flat bg-grayy" style="background:#f9f9f9;color:#1a2226;"><i class="fa fa-caret-left"></i> Back</a>
          <a href="<?php echo site_url('Category/Country_View'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>

      <div class="box-body">
        <table id="Viewtable" class="display nowrap" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Country Name</th>
              <th>Country Code</th>
             
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $cou = 1;
            foreach ($this->GM->Country('0', '0','') as $Row) {
            ?>
              <tr>
                <td ><b><?php echo $cou; ?></b></td>

                <td ><?php echo $Row->CountryName; ?></td>
                <td ><?php echo $Row->countrycode; ?></td>
            
                <td ><?php echo $Row->StatusName; ?></td>
                <td >
                  <a <?php echo "href='" . site_url('') . "/" . "Category/Country_Edit/?Key=" . base64_encode($Row->Country_Id) . "'"; ?> <span class="badge"><i class="fa fa-pencil"></i>&nbsp; Edit</span>
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
<?php include('Foot.php'); ?>