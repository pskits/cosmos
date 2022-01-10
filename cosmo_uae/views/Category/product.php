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
    <h1>Product</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Product Details</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Category/ProductCategory_View'); ?>" class="btn btn-flat bg-grayy" style="background:#f9f9f9;color:#1a2226;"><i class="fa fa-caret-left"></i> Back</a>
        </div>
      </div>
  
      <?php echo form_open_multipart(site_url('Category/Product_Save') , 'role="form"'); ?>
      <input type="hidden" name="Product_Id" value="<?php echo @set_value('Product_Id') . @$Product_Id; ?>">
      <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Product Category</label>
              <select id="ProductCategory_Id" required class="form-control select2" name="ProductCategory_Id">
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
              <label>Product Name</label>
              <input type="text" class="form-control input-md" minlength="3" required name="Product" placeholder="Enter Product" value="<?php echo @set_value('Product') . @$Product; ?>">
              <?php echo form_error('Product'); ?>
            </div>
      
            <div class="form-group">
                            <label>Dimension  (LXBXD or LxBxD) in cm</label>
                            <div class="row">
                                <div class="col-xs-3">
                                    <input class="form-control" id="val1" onchange="dimention();" value="0" onfocus="dimentionclr();" min="01" required step="1" id="ex1" type="number">
                                </div>
                                <div class="col-xs-3">
                                    <input class="form-control" id="val2" onchange="dimention();" value="0" onfocus="dimentionclr();" min="01" step="1" required id="ex1" type="number">
                                </div>
                                <div class="col-xs-3">
                                    <input class="form-control" id="val3" onchange="dimention();" value="0" onfocus="dimentionclr();" min="01" step="1" id="ex2" required type="number">
                                </div>
                            </div>
                            <br />
                            <input type="text" id="dimension" readonly class="form-control input-md" required name="Dimension" placeholder="Enter Dimension" value="<?php echo @set_value('Dimension') . @$Dimension; ?>">
                            <?php echo form_error('Dimension'); ?>
                        </div>
                        <div class="form-group">
              <label>Volume</label>
              <input type="text" class="form-control input-md" id="volume" minlength="3" required name="Volume" readonly placeholder="Enter Volume" value="<?php echo @set_value('Volume') . @$Volume; ?>">
              <?php echo form_error('Volume'); ?>
            </div>
          
          </div>

          <div class="col-md-6">
          <div class="form-group">
              <label>SKU</label>
              <input type="text" class="form-control input-md" minlength="3" required name="SKU" placeholder="Enter SKU" value="<?php echo @set_value('SKU') . @$SKU; ?>">
              <?php echo form_error('SKU'); ?>
            </div>
            <div class="form-group">
              <label>Description</label>
              <input type="text" class="form-control input-md" minlength="3" required name="Description" placeholder="Enter Description" value="<?php echo @set_value('Description') . @$Description; ?>">
              <?php echo form_error('Description'); ?>
            </div>
          </div>
   
        </div>
      </div>
      <div class="box-footer" >
        <a href="<?php echo site_url('Category/Product'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
        <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
          <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
      </div>
      </form>
    </div>
  </section>
</div>


<?php include('Includes/Foot.php'); ?>


<script>


    function dimention() {
        var val1 = "0",
            val2 = "0",
            val3 = "0",
            volume = "0",
            dimention = "";
        val1 = document.getElementById('val1').value;
        val2 = document.getElementById('val2').value;
        val3 = document.getElementById('val3').value;
        volume = val1 * val2 * val3 ;
        document.getElementById('dimension').value = val1 + ' x ' + val2 + ' x ' + val3 ;
        if (volume) {
            document.getElementById('volume').value = volume;
        } else {
            document.getElementById('volume').value = "";

        }
    }
    //dimentionclr();

    function dimentionclr() {
        document.getElementById('dimension').value = "";
        dimention();
    }
</script>
