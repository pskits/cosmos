<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Inventory </h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Invoiced Goods View </h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Inventory/GoodsInvoiced'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>
      <div class="box-body">
        <form class="row form-inline">
         
          <div class="col-md-3">
            <div class="form-group">
              <label>Products</label>
              <select id="Product_id" required class="form-control select2" name="Product_id">
                <?php
                $data = $this->GM->Product();
                $this->GM->Option_($data, 'Product_Id', 'Product', '', '',$Product_id= @$_REQUEST['Product_id']);
                ?>
              </select>
              <?php echo form_error('Product_id'); ?>
            </div>
          </div>
		   <div class="col-md-3">
               <div class="form-group">
                            <label>Serial No</label>
                            <input type="text" id="serial_no" class="form-control input-md"  name="serial_no" placeholder="Enter Serial Number" value="<?php echo $serial_no= @$_REQUEST['serial_no']; ?>">
                            <?php echo form_error('serial_no'); ?>
                        </div>
          </div>
          <div class="col-md-3">
          <div class="form-group">
            <label>Goods Status</label>
            <select class="form-control select2" required name="GoodsStatus_Id">
              <?php
              $data = $this->GM->Get_Goodsstatus();
              $this->GM->Option_($data, 'Goods_status_Id', 'Goods_status_Name', '0', 'All', $GoodsStatus_Id = (isset($_REQUEST['GoodsStatus_Id'])) ? $_REQUEST['GoodsStatus_Id'] : 0);
              ?>
            </select>
            <?php echo form_error('GoodsStatus_Id'); ?>
          </div>
          </div>
		   <div class="col-md-3">
               <div class="form-group">
                            <label>Invoice No</label>
                            <input type="text" id="Invoice_no" class="form-control input-md"  name="Invoice_no" placeholder="Enter Invoice Number" value="<?php echo $Invoice_no= @$_REQUEST['Invoice_no']; ?>">
                            <?php echo form_error('Invoice_no'); ?>
                        </div>
          </div>
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
              <th>Serial_No</th>
			  <th>Delivered Date</th>
              <th>Invoice</th>
              <th>Dealer</th>
			  <th>Product</th>
              <th>status</th>
              <th>Warranty</th>  
			  <th>Activation</th> 
			  <th>Expiry</th>  
            </tr>
          </thead>
          <tbody>
            <?php
            if(isset($_REQUEST['Abut']))
            {
            foreach ($this->GM->GoodsInvoiced($Goods_Id = "0", $serial_no, $GoodsStatus_Id , $status_Id = "1", $Invoice_no) as $Row) {
            ?>
              <tr>
                <td><?php echo $Row->Serial_No; ?></td>
                <td><?php echo $Row->FormattedOutwardDate; ?></td>
                <td><a href="<?php echo site_url("$Row->Link").base64_encode($Row->Invoice_Id);?>"><?php echo $Row->Invoice_No; ?></a></td>
                <td><?php echo $Row->name; ?></td>
                <td><?php echo $Row->Product; ?></td>
                <td><?php echo $Row->Goods_status_Name; ?></td>
				<td><?php echo $Row->WarrentyStatus_Name; ?></td>
				<td><?php echo $Row->FormattedActivate_date; ?>	</td>
				<td><?php echo $Row->FormattedExpiryDate; ?>	</td>
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