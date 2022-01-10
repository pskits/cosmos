<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>

<div class="content-wrapper">
 
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Dealer  View</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Users/Dealer'); ?>" class="btn btn-flat bg-grayy" style="background:#f9f9f9;color:#1a2226;"><i class="fa fa-caret-left"></i> Back</a>
          <a href="<?php echo site_url('Users/Dealer_View'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>

      <div class="box-body">
        <table id="Viewtable" class="display nowrap" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>  
              <th>Mobile</th> 
			   <th>Area</th> 
				<th>City</th> 			   
              <th>Status</th>   
              <th>Tools</th>     
            </tr>
          </thead>
          <tbody>
            <?php
            $cou = 1;
            foreach ($this->GM->Dealer(0,0) as $Row) {
            ?>
              <tr>
                <td><b><?php echo $cou; ?></b></td>
                <td><?php echo $Row->name; ?></td>            
                             
                <td ><?php echo $Row->mobile; ?></td>           
              <td ><?php echo $Row->AreaName; ?></td>   
                <td ><?php echo $Row->city; ?></td>
                <td ><?php echo $Row->StatusName; ?></td>
                <td >
                     <a <?php echo "href='" . site_url("Users/Dealeruser_views") . "/?Key=" . base64_encode($Row->Dealer_Id) . "'"; ?> <span class="badge"><i class="fa fa-eye"></i>&nbsp; View</span>
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