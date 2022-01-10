<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
if (isset($_GET['Key'])) {
  $ProductCategory_Id = base64_decode($_GET['Key']);
} elseif (isset($_POST['ProductCategory_Id'])) {
  $id = $_POST['ProductCategory_Id'];
}
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Offer Creation</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Offer List Details</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Catalog/Offerlist_view'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
        </div>
      </div>
      <div style="color:red">
      </div>
      <?php echo form_open_multipart(site_url('Catalog/Offerlist_') . $But . '/', 'role="form"'); ?>
      <input type="hidden" name="Product_Id" value="<?php echo @$Product_Id; ?>">
      <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Offer Name</label>
              <input type="text" class="form-control input-md" minlength="2" required name="OfferName" placeholder="Enter OfferName" value="<?php echo @set_value('OfferName') . @$OfferName; ?>">
              <?php echo form_error('OfferName'); ?>
            </div>
            <div class="form-group">
              <label>Code</label>
              <input type="text" class="form-control input-md" minlength="2" required name="Code" placeholder="Enter Code" value="<?php echo @set_value('Code') . @$Code; ?>">
              <?php echo form_error('Code'); ?>
            </div>
            <div class="form-group">
              <label>Order Quantity</label>
              <input type="number" class="form-control input-md" step="1" min="0" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required name="OrderQuantity" placeholder="Enter OrderQuantity" value="<?php echo @set_value('OrderQuantity') . @$OrderQuantity; ?>">
              <?php echo form_error('OrderQuantity'); ?>
            </div>
            <div class="form-group">
              <label>Offer Quantity</label>
              <input type="number" class="form-control input-md" step="1" min="0" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required name="OfferQuantity" placeholder="Enter OfferQuantity" value="<?php echo @set_value('OfferQuantity') . @$OfferQuantity; ?>">
              <?php echo form_error('OfferQuantity'); ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Credit Period</label>
              <input type="number" class="form-control input-md" step="1" min="0" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required name="CreditPeriod" placeholder="Enter CreditPeriod" value="<?php echo @set_value('CreditPeriod') . @$CreditPeriod; ?>">
              <?php echo form_error('CreditPeriod'); ?>
            </div>
            <div class="form-group">
              <label>Max Multiply</label>
              <input type="number" class="form-control input-md" 
              step="1" min="1" 
              onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" 
              required name="AllowMultiply" placeholder="Enter AllowMultiply" 
              value="<?php echo @set_value('AllowMultiply') . @$AllowMultiply; ?>">
              <?php echo form_error('AllowMultiply'); ?>
              </div>
            <div class="form-group">
              <label>Offer Type</label>
              <select id="OfferType_Id" required class="form-control select2" name="OfferType_Id">
                <?php
                $status = "1";
                $id = "0";
                $data = $this->GM->Offertype($status, $id);
                $this->GM->Option_($data, 'OfferType_Id', 'OfferTypeName', '', 'Select', @set_value('OfferType_Id') . @$OfferType_Id);
                ?>
              </select>
              <?php echo form_error('OfferType_Id'); ?>
            </div>
            <div class="form-group">
              <label>Restriction</label>
              <select id="Restriction_Id" required class="form-control select2" name="Restriction_Id">
                <?php
                $status = "1";
                $id = "0";
                $data = $this->GM->Offerrestrictions($status, $id);
                $this->GM->Option_($data, 'OfferRestrictions_Id', 'OfferRestrictionsName', '', 'Select', @set_value('Restriction_Id') . @$Restriction_Id);
                ?>
              </select>
              <?php echo form_error('Restriction_Id');
              ?>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Sorting</label>
                <input type="number" class="form-control input-md" step="1" min="0" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required name="Sorting" placeholder="Enter Sorting" value="<?php echo @set_value('Sorting') . @$Sorting; ?>">
                <?php echo form_error('Sorting'); ?>
              </div>
            </div>
            <div class="form-group">
              <label>Status</label>
              <select class="form-control select2" required name="Status_Id">
                <?php
                $data = $this->GM->Status();
                $this->GM->Option_($data, 'Status_Id', 'StatusName', '', 'Select', @set_value('Status_Id') . @$Status_Id);
                ?>
              </select>
              <?php echo form_error('Status_Id'); ?>
            </div>
          </div>
        </div>
        <div class="box-footer">
          <a href="<?php echo site_url('Catalog/Offerlist'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
          <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
            <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
        </div>
        </form>
      </div>
  </section>
</div>
<script src="<?php echo base_url('/assets/Js/ajax.js'); ?>"></script>
<script>
  window.onload = function() {
    GetProduct();
  };
  function GetProduct() {
    var e = document.getElementById("ProductCategory_Id");
    var ProductCategory_Id = e.options[e.selectedIndex].value;
    if (ProductCategory_Id) {
      $(function() {
        $.ajax({
          type: 'GET',
          url: '<?php echo site_url('Catalog/Productlist'); ?> ',
          data: {
            ProductcategoryId: ProductCategory_Id
          },
          success: function(data) {
            $("#Productlist").html(data);
          }
        });
      });
    } else {
      $("#Productlist").html('');
    }
  }
</script>
<?php include('Includes/Foot.php'); ?>