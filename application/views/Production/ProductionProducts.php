<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>
<div class="content-wrapper">
  <section class="content-header">
    <!-- <h1>Production Approved View</h1> -->
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Production Products View</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Production/Production_View'); ?>" class="btn btn-flat bg-grayy" style="background:#f9f9f9;color:#1a2226;"><i class="fa fa-caret-left"></i> Back</a>
          <a href="<?php echo site_url('Production/ProductionProducts') . '?Key=' . base64_encode($Production_Id); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>
      <div class="box-body">
        <?php
        $cou = 1;
        foreach ($this->GM->Production($status = "1", $Production_Id) as $Row) {
        ?>
          <div class="container-fluid row ">
            <div class="col-sm-3   invoice-col">
              <h4>Production No:</h4>
              <h4><b><?php echo $Row->Production_Code; ?></b></h4><br>
            </div>
            <div class="col-sm-3   invoice-col">
              <h4>Office:</h4>
              <h4><b><?php echo $Row->office_Name; ?></b></h4><br>
            </div>
            <div class="col-sm-3 invoice-col pull-right">
              <h4>Batch :</h4>
              <h4><b><?php echo $Row->BatchNo; ?></b></h4><br>
            </div>
            <div class="col-sm-3   invoice-col">
              <h4>Production date:</h4>
              <h4> <b><?php echo $Row->Production_date_Dateformatted; ?></b></h4>
            </div>
            <!-- /.col -->
            <!-- /.col -->
          </div>
        <?php
          $cou++;
        }
        ?>
        <div class="col-md-12">
          <div class="table-responsive">
            <table id="products" class="table table-striped">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Category</th>
                  <th>Product</th>
                  <th>Count</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $count = "0";
                $status_id = "1";
                $data = $this->GM->ProductionProduct($Production_Id, $Category_Id = "0", $product_id = "0", $Serial_No = "0", $status_id = "1", $id = "0");
                foreach ($data as $Products) {
                  $count++;
                ?>
                  <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $Products->ProductCategory; ?></td>
                    <td><?php echo $Products->Product; ?></td>
                    <td><?php echo $Products->ProductCount; ?></td>
                    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ProductionProductshow<?php echo $Products->Product_Id; ?>">
                        View
                      </button>
                      <!-- The Modal -->
                      <div class="modal" id="ProductionProductshow<?php echo $Products->Product_Id; ?>">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Serial No List</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                              <div class="table-responsive" style="max-height:300px;">
                                <table class="table table-bordered table-striped">
                                  <?php
                                  $data = $this->GM->ProductionProductserial($Production_Id, $Category_Id = "0", $product_id = $Products->Product_Id, $Serial_No = "0", $status_id = "1", $id = "0");
                                  foreach ($data as $ProductionProductserial) {
                                  ?>
                                    <tr>
                                      <td>
                                        <input type='text' readonly value='<?php echo $ProductionProductserial->Serial_No ?>'>
                                      </td>
                                    </tr>
                                  <?php
                                  }
                                  ?>
                                </table>
                              </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
            <br>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
              Add Product
            </button>
            <!-- The Modal -->
            <div class="modal" id="myModal">
              <div class="modal-dialog">
                <div class="modal-content">
                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Add Product</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <!-- Modal body -->
                  <?php echo form_open_multipart(site_url('Production/ProductionProducts_') . $But . '/', 'role="form"'); ?>
                  <div class="modal-body">
                    <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
                    <input type="hidden" name="production_id" id="production_id" value="<?php echo $Production_Id; ?>" />
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Product Category</label>
                          <select id="category_id" onchange=" GetProduct();" required class="form-control select2" name="category_id">
                            <?php
                            $status = "1";
                            $id = "0";
                            $data = $this->GM->ProductCategory($status, $id);
                            $this->GM->Option_($data, 'ProductCategory_Id', 'ProductCategory', '', 'Select', @set_value('category_id') . @$category_id);
                            ?>
                          </select>
                          <?php echo form_error('category_id'); ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Product</label>
                          <select id="product_id" required class="form-control select2" name="product_id">
                          </select>
                          <?php echo form_error('product_id'); ?>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Serial No</label>
                      <input type="text" onchange="addtabledata();" id="data" class="form-control" name="data">
                      <?php echo form_error('data'); ?>
                    </div>
                    <div class="table-responsive" style="max-height:300px;">
                      <table id="excel_table" class="table table-bordered table-striped">
                      </table>
                    </div>
                  </div>
                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <h4 style="float:left;width:20px;">Count <b id="datacount"></b></h4>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
                      <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <br>
          </div>
        </div>
      </div>
      <div class="box-footer">
        <?php echo form_open_multipart(site_url('Production/ProductionProducts_') . 'Complete/', 'role="form"'); ?>
        <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
        <input type="hidden" name="production_id" id="production_id" value="<?php echo $Production_Id; ?>" />
        <button type="submit" class="btn  btn-flat pull-right" name="Abut" value="Complete">
          <i class="fa fa-check"></i> Complete</button>
        </form>
      </div>
    </div>
  </section>
</div>
<script src="<?php echo base_url('/assets/Js/ajax.js'); ?>"></script>
<script>
  window.onload = function() {
    GetProduct();
  };

  function GetProduct() {
    var e = document.getElementById("category_id");
    var category_id = e.options[e.selectedIndex].value;
    if (category_id) {
      $(function() {
        $.ajax({
          type: 'GET',
          url: '<?php echo site_url('API/Productlist'); ?> ',
          data: {
            ProductcategoryId: category_id
          },
          success: function(data) {
            $("#product_id").html(data);
          }
        });
      });
    } else {
      $("#product_id").html('');
    }
  }
</script>
<?php include('Foot.php'); ?>
<script>
  function checkduplicates() {
    var contents = {},
      duplicates = false;
    $("#excel_table td input").each(function() {
      var tdContent = $(this).val();
      if (contents[tdContent]) {
        duplicates = true;
        return false;
      }
      contents[tdContent] = true;
    });
    if (duplicates)
      alert("There were duplicates.");
  }
</script>
<script>
  function addtabledata() {
    var Data = document.getElementById('data').value;
    Data = Data.trim();
    Data = Data.replace(/,+(?= )/g, '');
    var splitteddata = Data.split(" ");
    var Count = splitteddata.length;
    document.getElementById('datacount').innerHTML = Count;
    table = document.getElementById("excel_table");
    while (table.rows.length > 0) {
      table.deleteRow(0);
    }
    document.getElementById('data').value = '';
    splitteddata.forEach(addtoexceltable);
    checkduplicates();
  }

  function addtoexceltable(item, index) {
    if (item) {
      var table = document.getElementById("excel_table");
      var row = table.insertRow(-1);
      var cell1 = row.insertCell(0);
      var cell2 = row.insertCell(1);
      var count = index + 1;
      cell1.innerHTML = count;
      cell2.innerHTML = "<input type='text' required name='serial_no[" + index + "]' value='" + item + "'>";
    }
  }
</script>