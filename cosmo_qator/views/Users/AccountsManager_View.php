<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>

<div class="content-wrapper">
 
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">AccountsManager  View</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Users/AccountsManager'); ?>" class="btn btn-flat bg-grayy" style="background:#f9f9f9;color:#1a2226;"><i class="fa fa-caret-left"></i> Back</a>
          <a href="<?php echo site_url('Users/AccountsManager_View'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>

      <div class="box-body">
        <table id="Viewtable" class="display nowrap" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>        
              <th>Email</th>        
              <th>Mobile</th>   
              <th>Status</th>   
              <th>Tools</th>     
            </tr>
          </thead>
          <tbody>
            <?php
            $cou = 1;
            foreach ($this->GM->AccountsManager(0,0) as $Row) {
            ?>
              <tr>
                <td><b><?php echo $cou; ?></b></td>
                <td><?php echo $Row->SalutName . ' '.$Row->firstname . ' ' . $Row->lastname; ?></td>             
                <td ><?php echo $Row->email; ?></td>              
                <td ><?php echo $Row->mobile; ?></td>           
            
               
                <td ><?php echo $Row->StatusName; ?></td>
                <td >
                  <a <?php echo "href='" . site_url('Users/AccountsManager') ."/?Key=" . base64_encode($Row->AccountsManager_Id) . "'"; ?> <span class="badge"><i class="fa fa-pencil"></i>&nbsp; Edit</span>
                    <a <?php echo "href='" . site_url('Users/AccountsManageruser_views') . "/?Key=" . base64_encode($Row->AccountsManager_Id) . "'"; ?> <span class="badge"><i class="fa fa-eye"></i>&nbsp; View</span>
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