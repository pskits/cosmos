<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
  <section class="content-header">
    <!-- <h1>Production Approved View</h1> -->
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">PurchaseOrder Products View</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Production/ApprovedPurchaseOrder') . '?Key=' . base64_encode($officedbname); ?>" class="btn btn-flat "><i class="fa fa-caret-left"></i> Back</a>
          <a href="<?php echo site_url('Production/ApprovedPurchaseOrderProducts') . '?Key=' . base64_encode($officedbname) . '&id=' . base64_encode($PurchaseOrder_Id); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>
      <div class="box-body">
        <div class="container-fluid row ">
          <div class="col-sm-4   invoice-col">
            <h4>Production No:</h4>
            <h4><b><?php echo $_POST['ApprovedPurchaseOrder_Code']; ?></b></h4><br>
          </div>
          <div class="col-sm-4 invoice-col ">
            <h4>Officename :</h4>
            <h4><b><?php echo $_POST['office_Name']; ?></b></h4><br>
          </div>
          <div class="col-sm-4   invoice-col">
            <h4>Purchase Production Created date:</h4>
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
                  $acceptboolian = true;
                ?>
                  <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $Products->Product; ?></td>
                    <td><?php echo $Products->Trans_PurchaseOrderProduct_Quantity; ?></td>
                    <td>
                      <?php $productiondbdata = $this->GM->PurchaseorderProductserial("0", $Category_Id = "0", $Products->Product_Id, $PurchaseOrder_Id,$_POST['office_Id'], $Serial_No = "0", $status_id = "1", $id = "0");
                      if ($productiondbdata) {
                        $acceptboolian = ($productiondbdata[0]->ProductCount == $Products->Trans_PurchaseOrderProduct_Quantity &&  $acceptboolian == true) ? true : false;
                        echo  $productiondbdata[0]->ProductCount;
                      } else {
                        $acceptboolian = false;
                        echo "0";
                      }
                      ?>
                    </td>
                    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Productshow<?php echo $Products->Product_Id; ?>">
                        View
                      </button>
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Productadd<?php echo $Products->Product_Id; ?>">
                        Add Product
                      </button>
                      <!-- List of Serials applied for this purchase order Show -->
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
                                        <input type='text' readonly value='<?php echo $ProductionProductserial->Serial_No ?>'>
                                      </td>
                                      <td>
                                        <a href="<?php echo site_url('Production/ApprovedPurchaseOrderProduct_delete') . '?Key=' . base64_encode($ProductionProductserial->Serial_No); ?>" class="btn btn-flat "> Delete</a>
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
                      <!-- List of Serials Available for this Purchase Order The Modal -->
                      <div class="modal" id="Productadd<?php echo $Products->Product_Id; ?>">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Assign Srial no to Product</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <?php echo form_open_multipart(site_url('Production/ApprovedPurchaseOrderProducts_') . $But . '/', 'role="form"'); ?>
                            <div class="modal-body">
                              <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
                              <input type="hidden" name="PurchaseOrder_Id" id="PurchaseOrder_Id" value="<?php echo $_POST['ApprovedPurchaseOrder_Id']; ?>" />
                              <input type="hidden" name="officedbname" id="officedbname" value="<?php echo $officedbname; ?>" />
                              <input type="hidden" name="Product_Id" id="Product_Id" value="<?php echo $Products->Product_Id; ?>" />
                              <div class="row">
                                <div class="col-md-6 ">
                                  <label>Available Serial No</label>
                                  <div class="table-responsive" style="max-height:300px;">
                                    <table id="data<?php echo $Products->Product_Id; ?>" class="table table-bordered table-striped">
                                      <tbody>
                                        <?php
                                        $productioncompleteddbdata = $this->GM->ProductionCompletedProductserial($Production_Id = "0", $Category_Id = "0", $Products->Product_Id, $Serial_No = "0", $status_id = "1", $id = "0");
                                        foreach ($productioncompleteddbdata as $Row) { ?>
                                          <tr>
                                            <td><?php echo $Row->Serial_No; ?></td>
                                            <td> <button type="button" class="btn btn-Success" onclick="addtabledata(this,'<?php echo $Products->Product_Id; ?>','<?php echo $Row->Serial_No; ?>');">Apply</button>
                                            </td>
                                          </tr>
                                        <?php }
                                        ?>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <label>Applied Serial No</label>
                                  <div class="table-responsive" style="max-height:300px;">
                                  <table id="excel_table<?php echo $Products->Product_Id; ?>" class="table table-bordered table-striped">
                                  </table>
                                </div></div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <h4 style="float:left;width:20px;">Count <b id="datacount<?php echo $Products->Product_Id; ?>"></b></h4>
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
                                <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <script>
                        function checkduplicates<?php echo $Products->Product_Id; ?>() {
                          var contents = {},
                            duplicates = false;
                          $("#excel_table<?php echo $Products->Product_Id; ?> td input").each(function() {
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
                        function addtabledata<?php echo $Products->Product_Id; ?>() {
                          var Data = document.getElementById('data<?php echo $Products->Product_Id; ?>').value;
                          Data = Data.trim();
                          Data = Data.replace(/ +(?= )/g, '');
                          var splitteddata = Data.split(" ");
                          var Count = splitteddata.length;
                          document.getElementById('datacount<?php echo $Products->Product_Id; ?>').innerHTML = Count;
                          table = document.getElementById("excel_table<?php echo $Products->Product_Id; ?>");
                          while (table.rows.length > 0) {
                            table.deleteRow(0);
                          }
                          splitteddata.forEach(addtoexceltable<?php echo $Products->Product_Id; ?>);
                          checkduplicates<?php echo $Products->Product_Id; ?>();
                        }
                        function addtoexceltable<?php echo $Products->Product_Id; ?>(item, index) {
                          if (item) {
                            var table = document.getElementById("excel_table<?php echo $Products->Product_Id; ?>");
                            var row = table.insertRow(-1);
                            var cell2 = row.insertCell(0);
                            var cell3 = row.insertCell(1);
                            var count = index + 1;
                            cell2.innerHTML = "<input type='text' required name='serial_no[" + index + "]' value='" + item + "'>";
                            cell3.innerHTML = '<button type="button" class="btn"  onclick="Deleterow<?php echo $Products->Product_Id; ?>(this)">Remove</button>';
                          }
                        }
                        function Deleterow<?php echo $Products->Product_Id; ?>(btn) {
                          var row = btn.parentNode.parentNode;
                          row.parentNode.removeChild(row);
                          document.getElementById('datacount<?php echo $Products->Product_Id; ?>').innerHTML = document.getElementById('datacount<?php echo $Products->Product_Id; ?>').innerHTML - 1;
                        }
                      </script>
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
      <div class="box-footer">
        <?php
        $acceptboolian = true;
        if ($acceptboolian == true) {
        ?>
          <?php echo form_open_multipart(site_url('Production/ApprovedPurchaseOrderProducts_Complete'), 'role="form"'); ?>
          <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
          <input type="hidden" name="ApprovedPurchaseOrder_Id" id="ApprovedPurchaseOrder_Id" value="<?php echo $_POST['ApprovedPurchaseOrder_Id']; ?>" />
          <input type="hidden" name="officedbname" id="officedbname" value="<?php echo $officedbname; ?>" />
          <button type="submit" class="btn  btn-flat pull-right" name="Abut" value="Complete">
            <i class="fa fa-check"></i> Complete</button>
          </form>
        <?php
        } else {
        ?>
          <button type="button" class="btn  btn-flat pull-right" onclick="alert('Production Quantity doesnt match Required Quantity');">
            <i class="fa fa-check"></i> Complete</button>
        <?php
        }
        ?>
      </div>
    </div>
    <br>
</div>
</div>
</div>
</div>
</section>
</div>
<?php include('Includes/Foot.php'); ?>
<script>
  function addtabledata(eventbtn, product_id, serialno) {
    var Data = serialno;
    Data = Data.trim();
    current_count = document.getElementById('datacount' + product_id).innerHTML;
    document.getElementById('datacount' + product_id).innerHTML = current_count;
    table = document.getElementById("excel_table" + product_id);
    var row = eventbtn.parentNode.parentNode;
    row.parentNode.removeChild(row);
    addtoexceltable(serialno, product_id);
  }
  function addtoexceltable(serialno, product_id) {
    if (serialno, product_id) {
      var table = document.getElementById("excel_table" + product_id);
      var count = table.rows.length;
      count++;
      document.getElementById('datacount' + product_id).innerHTML = count;
      var row = table.insertRow(-1);
      var cell2 = row.insertCell(0);
      var cell3 = row.insertCell(1);
      cell2.innerHTML = "<input type='text' required name='serial_no[" + count + "]' value='" + serialno + "'>";
      cell3.innerHTML = `<button type="button" class="btn"  onclick="Deleterow(this,'` + product_id + `','` + serialno + `')";>Remove</button>`;
    }
  }
  function Deleterow(btn, product_id,Serialno) {
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
    document.getElementById('datacount' + product_id).innerHTML = document.getElementById('datacount' + product_id).innerHTML - 1;
    addtoavailabletable(Serialno, product_id);
  }
  function addtoavailabletable(serialno, product_id) {
    if (serialno, product_id) {
      var table = document.getElementById("data" + product_id);
      var row = table.insertRow(-1);
      var cell2 = row.insertCell(0);
      var cell3 = row.insertCell(1);
      cell2.innerHTML =  serialno ;
      cell3.innerHTML = `<button type="button" class="btn btn-Success" onclick="addtabledata(this,'`+ product_id + `','`+ serialno +`');">Apply</button>`;
    }
  }
</script>