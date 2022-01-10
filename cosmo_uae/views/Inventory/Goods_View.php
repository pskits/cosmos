<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Goods View </h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Goods View </h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Inventory/Goods_View'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>
      <div class="box-body">
        <form class="row form-inline">
      <div class="col-md-2">
            <div class="form-group">
              <label class="forminline-label">From : </label>
              <input type="text" class="form-control input-md Date" readonly required name="fromdate" placeholder="Enter Admin fromdate" 
			  value="<?php echo $fromdate = (isset($_REQUEST['fromdate'])) ? $_REQUEST['fromdate'] : '01-01-2017'; ?> ">
              <?php echo form_error('fromdate'); ?>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label class="forminline-label">To : </label>
              <input type="text" class="form-control input-md Date" readonly required name="todate" placeholder="Enter Admin todate" value="<?php echo $todate = (isset($_REQUEST['todate'])) ? $_REQUEST['todate'] : date('d-m-Y'); ?> ">
              <?php echo form_error('todate'); ?>
            </div>
          </div>
       <div class="col-md-4">
               <div class="form-group">
                            <label>Transaction No <br>(Invoice/salesReturn/PurchaseOrder)</label> <br>
                            <input type="text" id="transaction_no" class="form-control input-md"  name="transaction_no" 
							placeholder="Enter Transaction Number" value="<?php echo $transaction_no= @$_REQUEST['transaction_no']; ?>">
                            <?php echo form_error('transaction_no'); ?>
                        </div>
          </div>
		   <div class="col-md-2">
               <div class="form-group">
                            <label>Serial No</label> <br>
                            <input type="text" id="serial_no" class="form-control input-md"  name="serial_no" 
							placeholder="Enter Serial Number" value="<?php echo $serial_no= @$_REQUEST['serial_no']; ?>">
                            <?php echo form_error('serial_no'); ?>
                        </div>
          </div>
          
          <div class="col-md-2">
		  <br>
            <div class="form-group">
              <button type="submit" class="btnbg-black text-white btn-flat" name="Abut" value="Show">
                <i class="fa fa-cloud-download"></i>Show</button>
            </div>
          </div>
        </form>
        <hr class="horizondal-splitter">
        <table id="Viewtable" class="display " style="width:100%">
          <thead>
            <tr>
              <th>Transaction NO</th>
              <th>Serial No</th>
			  <th>Date</th>
              <th>Transaction</th>
              <th>Source</th>
              <th>Condition</th>              
            </tr>
          </thead>
          <tbody>
            <?php
            if(isset($_REQUEST['Abut']))
            {
				$from_date = $this->GM->DateSplit($fromdate);
            $to_date = $this->GM->DateSplit($todate);
           
            foreach ($this->GM->Inventory($from_date, $to_date,$serial_no, $transaction_no,$transaction_id = 0,$goodscondition_id = 0) as $Row) {
            ?>
              <tr>
                <td><b><a href="<?php echo site_url($Row->Link."".base64_encode($Row->transaction_id))?>"> <?php echo $Row->transaction_no; ?></a></b></td>
                <td><?php echo $Row->serial_no; ?></td>
				 <td><?php echo $Row->InventoryDate; ?></td>
				
                <td><?php echo $Row->InventoryTransaction; ?></td>
                <td><?php echo $Row->InventorySource; ?></td>
                <td><?php echo $Row->InventoryGoodsCondition; ?></td>               
              </tr>
            <?php
             
            }
          }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
<?php include('Includes/Foot.php'); ?>