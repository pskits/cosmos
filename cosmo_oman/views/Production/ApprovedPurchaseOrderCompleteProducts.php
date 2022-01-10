<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
  <section class="content-header">
    <!-- <h1>Purchase Order Approved View</h1> -->
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Purchase Order Products View</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Production/ApprovedPurchaseOrder') . '?Key=' . base64_encode($officedbname); ?>" class="btn btn-flat bg-grayy" style="background:#f9f9f9;color:#1a2226;"><i class="fa fa-caret-left"></i> Back</a>
          <a href="<?php echo site_url('Production/ApprovedPurchaseOrderProducts') . '?Key=' . base64_encode($officedbname) . '&id=' . base64_encode($PurchaseOrder_Id); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>
      <div class="box-body">
        <div class="container-fluid row ">
          <div class="col-sm-4   invoice-col">
            <h4>Export No:</h4>
            <h4><b><?php echo $_POST['ApprovedPurchaseOrder_Code']; ?></b></h4><br>
          </div>
          <div class="col-sm-4 invoice-col ">
            <h4>Branch :</h4>
            <h4><b><?php echo $_POST['office_Name']; ?></b></h4><br>
          </div>
          <div class="col-sm-4   invoice-col">
            <h4>Export Created date:</h4>
            <h4> <b><?php echo $_POST['Created_date_Dateformatted']; ?></b></h4>
          </div>
          <!-- /.col -->
          <!-- /.col -->
        </div>
        <div class="col-md-12">
          <div class="table-responsive">
            <table id="products" class="table table-striped">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Product</th>
                  <th>Request Quantity</th>
                  <th>Production Quantity</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $count = "0";
                $status_id = "1";
                $data = $this->GM->ApprovedPurchaseOrderProduct($status_id, $PurchaseOrder_Id, $officedbname);
                foreach ($data as $Products) {
                  $count++;
                ?>
                  <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $Products->Product; ?></td>
                    <td><?php echo $Products->Trans_PurchaseOrderProduct_Quantity; ?></td>
                    <td>
                      <?php $productiondbdata = $this->GM->PurchaseorderProductserial($Production_Id = "0", $Category_Id = "0", $Products->Product_Id, $PurchaseOrder_Id, $_POST['office_Id'], $Serial_No = "0", $status_id = "1", $id = "0");
                      if ($productiondbdata) {
                        echo $productiondbdata[0]->ProductCount;
                      } else {
                        echo "0";
                      }
                      ?>
                    </td>
                    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Productshow<?php echo $Products->Product_Id; ?>">
                        View
                      </button>
                      <!-- Show -->
                      <div class="modal" id="Productshow<?php echo $Products->Product_Id; ?>">
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
                                  foreach ($productiondbdata as $ProductionProductserial) {
                                  ?>
                                    <tr>
                                      <td>
                                        <?php echo $ProductionProductserial->Serial_No ?>
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
                      <!-- show end -->
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
            <br>
          </div>
          <!-- Modal footer -->
          </form>
        </div>
      </div>
    </div>
    <br>
</div>
</div>
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
          url: '<?php echo site_url('Category/Productlist'); ?> ',
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
<?php include('Includes/Foot.php'); ?>
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
    Data = Data.replace(/ +(?= )/g, '');
    var splitteddata = Data.split(" ");
    var Count = splitteddata.length;
    document.getElementById('datacount').innerHTML = Count;
    table = document.getElementById("excel_table");
    while (table.rows.length > 0) {
      table.deleteRow(0);
    }
    splitteddata.forEach(addtoexceltable);
    checkduplicates();
  }
  function addtoexceltable(item, index) {
    if (item) {
      var table = document.getElementById("excel_table");
      var row = table.insertRow(-1);
      var cell2 = row.insertCell(0);
      var cell3 = row.insertCell(1);
      var count = index + 1;
      cell2.innerHTML = "<input type='text' required name='serial_no[" + index + "]' value='" + item + "'>";
      cell3.innerHTML = '<button type="button" class="btn"  onclick="Deleterow(this)">Delete</button>';
    }
  }
  function Deleterow(btn) {
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
    document.getElementById('datacount').innerHTML = document.getElementById('datacount').innerHTML - 1;
  }
</script>