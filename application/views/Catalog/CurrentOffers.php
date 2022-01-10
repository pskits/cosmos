<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Current Offer Creation</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Current Offer Creation Details</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Catalog/CurrentOffers_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
        </div>
      </div>
      <?php echo form_open_multipart(site_url('Catalog/CurrentOffers_') . $But . '/', 'role="form"'); ?>
      <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Product Category</label>
              <select id="ProductCategory_Id" onchange="GetProduct();" required class="form-control select2" name="ProductCategory_Id">
                <?php
                $status = "1";
                $id = "0";
                $data = $this->GM->ProductCategory($status, $id);
                $this->GM->Option_($data, 'ProductCategory_Id', 'ProductCategory', '', 'Select', @set_value('ProductCategory_Id') . @$ProductCategory_Id);
                ?>
              </select>
              <?php echo form_error('ProductCategory_Id'); ?>
            </div>
            <div class="form-group">
              <label>Product</label>
              <select id="Productlist" class="form-control select2" required name="Product_Id">
              </select>
              <?php echo form_error('Product_Id'); ?>
            </div>
            <div class="form-group">
              <label>Offer</label>
              <select class="form-control select2" required name="Offer_Id" id="Offer_Id" onchange="multipleoffer()">
                <option allowmultipling="0" value="">-Select-</option>
                <?php
                $data = $this->GM->OfferList();
                foreach ($data as $offers) {
                ?>
                  <option allowmultipling="<?php echo $offers->OfferType_Id; ?>" <?php if ($offers->Offer_Id == @set_value('Offer_Id') . @$Offer_Id) echo "Selected"; ?> value="<?php echo $offers->Offer_Id; ?>"><?php echo $offers->OfferName ?></option>
                <?php
                }
                ?>
              </select>
              <?php echo form_error('Offer_Id'); ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group multiply_segment">
              <label>Second Product</label><br>
              <select id="SecondOfficeProduct" class="form-control select2" style="width:100%;" name="SecondOfficeProduct_Id">
                <option value="0">-No Product--</option>
              </select>
              <?php echo form_error('SecondOfficeProduct_Id'); ?>
            </div>
            <div class="form-group multiply_segment">
              <label>Min Quantity</label>
              <input type="number" class="form-control input-md" required step="1" min="1" value="1" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" name="Min_quantity" placeholder="Enter Min_quantity" value="<?php echo @set_value('Min_quantity') . @$Min_quantity; ?>">
              <?php echo form_error('Min_quantity'); ?>
            </div>
            <div class="form-group multiply_segment">
              <label>Max Quantity</label>
              <input type="number" class="form-control input-md" required step="1" min="1" value="1" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" name="Max_quantity" placeholder="Enter Max_quantity" value="<?php echo @set_value('Max_quantity') . @$Max_quantity; ?>">
              <?php echo form_error('Max_quantity'); ?>
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
      </div>
      <div class="box-footer">
        <a href="<?php echo site_url('Catalog/CurrentOffers'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
        <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
          <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
      </div>
      </form>
    </div>
  </section>
</div>
<script src="<?php echo base_url('/assets/Js/ajax.js'); ?>"></script>
<script>
  multipleoffer();
  function multipleoffer() {
    var multiply = $("#Offer_Id").find("option:selected").attr("allowmultipling");
    console.log(multiply);
    if (multiply == '2') {
      $(".multiply_segment").show();
      $(".multiply_segment").find("select").prop("required", true);
    } else {
      $(".multiply_segment").hide();
      $(".multiply_segment").find("select").removeAttr("required");
    }
  }
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
          url: '<?php echo site_url('Api/Productlist'); ?> ',
          data: {
            ProductcategoryId: ProductCategory_Id
          },
          success: function(data) {
            $("#Productlist").html(data);
            $("#SecondOfficeProduct").html(data);
          }
        });
      });
    } else {
      $("#Productlist").html('');
      $("#SecondOfficeProduct").html('');
    }
  }
</script>
<?php include('Foot.php'); ?>