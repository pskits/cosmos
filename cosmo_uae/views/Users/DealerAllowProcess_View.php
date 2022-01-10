<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Dealer Access to Allow </h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-bInvoice">
        <h3 class="box-title">List</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Users/DealerAllowProcess'); ?>" class="btn btn-flat ">back</a>
        </div>
      </div>
      <div class="box-body">
        <br>
        <form class="row form-inline">
          <div class="col-md-1"></div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="forminline-label">From : </label>
              <input type="text" class="form-control input-md Date" readonly required name="fromdate" placeholder="Enter fromdate" value="<?php echo $fromdate = (isset($_REQUEST['fromdate'])) ? $_REQUEST['fromdate'] : date('d-m-Y'); ?> ">
              <?php echo form_error('fromdate'); ?>
            </div>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="forminline-label">To : </label>
              <input type="text" class="form-control input-md Date" readonly required name="todate" placeholder="Enter todate" value="<?php echo $todate = (isset($_REQUEST['todate'])) ? $_REQUEST['todate'] : date('d-m-Y'); ?> ">
              <?php echo form_error('todate'); ?>
            </div>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-2">
            <div class="form-group">
              <button type="submit" class="btnbg-black text-white btn-flat" name="Abut" value="Show">
                <i class="fa fa-cloud-download"></i>Show</button>
            </div>
          </div>
        </form>
        <hr class="horizondal-splitter">
        <table id="Viewtable" class="display nowrap" style="width:100%">
        <thead>
            <tr>             
              <th>Name</th>               
			   <th>Area</th> 
				<th>City</th> 			   
              <th>Time Period</th>   
              <th>Description</th> 
              <th>Created by</th>       
            </tr>
          </thead>
          <tbody>
            <?php           
            $from_date = $this->GM->DateSplit($fromdate);
            $to_date = $this->GM->DateSplit($todate);
            foreach ($this->GM->DealerAccsstoAllow($Dealer_ID  ="0", $status_id = "0",$from_date, $to_date) as $Row) {
            ?>
             <tr>                
                <td> <a <?php echo "href='" . site_url("Users/Dealeruser_views") . "/?Key=" . base64_encode($Row->Dealer_Id) . "'"; ?>>
				<?php echo $Row->name; ?></a></td>            
                              
              <td ><?php echo $Row->AreaName; ?></td>   
                <td ><?php echo $Row->city; ?></td>
                <td ><?php echo $Row->Time_Period; ?></td>
                <td >
                <?php echo $Row->Description; ?>
                </td>
                <td >
                <?php echo $Row->allowedby; ?>
                </td>
              </tr>
            <?php             
            }
            ?>
          </tbody>
        </table>
      </div>
     
    </div>
  </section>
</div>
<?php include('Includes/Foot.php'); ?>