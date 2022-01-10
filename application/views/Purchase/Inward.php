<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');

foreach ($this->GM->PurchaseOrder($status_id = 1, $WarehouseCode = "0", $Supplier_Id = "0", $OrderInvoiceStatus_Id = "4", $purchaseorder_Id) as $Row) {
?>
  <style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
  </style>
  <div class="content-wrapper">
    <section class="content-header">
      <!-- <h1>Inward </h1> -->
    </section>
    <section class="content">
      <div class="box box-form box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Inward Creation Details</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo site_url('Purchase/purchaseorder_invoice') . '?Key=' . $key; ?>" class="btn btn-flat"><i class="fa fa-arrow-left"></i> Back</a>
          </div>
        </div>
        <?php echo form_open_multipart(site_url('Purchase/InwardProducts_Complete') , 'role="form"'); ?>
        <div class="box-body">
          <div class="container-fluid row ">
            <div class="col-sm-3   invoice-col">
              <h4>Purchase Order:</h4>
              <h4><b><?php echo $Row->PurchaseOrder_code; ?></b></h4><br>
            </div>
            <div class="col-sm-3   invoice-col">
              <h4>Warehouse:</h4>
              <h4><b><?php echo $Row->WarehouseName; ?></b></h4><br>
            </div>
            <div class="col-sm-3 invoice-col pull-right">
              <h4>Supplier :</h4>
              <h4><b><?php echo $Row->name; ?></b></h4><br>
            </div>
            <div class="col-sm-3   invoice-col">
              <h4>Purchase Order date:</h4>
              <h4> <b><?php echo $Row->PurchaseOrder_Dateformatted; ?></b></h4>
            </div>
            <!-- /.col -->
            <!-- /.col -->
            <div class="col-sm-12">
              <div class="form-group">
                <label>Serial No (Paste copied column from EXCEL Sheet)</label>
                <input type="text" required onchange="addtabledata();" id="data" class="form-control" name="data">
                <?php echo form_error('data'); ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
            <div class="table-responsive" style="max-height:300px;">    
              <table name="excel_table"  class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Approved Serial No</th>
                  </tr>
                </thead>
                <tbody> <?php
                        $count = 0;
                        $data = $this->GM->PurchaseorderProductserialfromfactory($Row->PurchaseOrder_factoryid, $Row->PurchaseOrder_Id);
                        foreach ($data as $ProductionProductserial) {
                          $count++;
                        ?>
                    <tr>
                      <td><?php echo $count; ?></td>
                      <td>
                        <?php echo $ProductionProductserial->Product ?>
                      </td>
                      <td>
                        <?php echo $ProductionProductserial->Serial_No ?>
                      </td>
                    </tr>
                  <?php
                        }
                  ?>
                </tbody>
              </table>
            </div></div>
            <div class="col-sm-6">
            <div class="table-responsive" style="max-height:300px;">                              
              <table name="actual_table"  class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Not Found</th>
                 
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td></td>
                    <td>Paste Excel Values</td>
                   
                  </tr>
                </tbody>
              </table>
            </div></div>
          </div>
        </div>
        <div class="box-footer">
          <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
          <input type="hidden" name="PurchaseOrder_factoryid" id="PurchaseOrder_factoryid" value="<?php echo $Row->PurchaseOrder_factoryid; ?>" />
          <input type="hidden" name="purchaseorder_Id" id="purchaseorder_Id" value="<?php echo $Row->PurchaseOrder_Id; ?>" />
          <input type="hidden" name="key" id="key" value="<?php echo  $key; ?>" />
          
         
          <div class="form-group">
             Expected Unique Serial No:  <input type="number" step="1" name="dbserialnocount" onkeyup="return false" onkeydown="return false" required value="<?php echo $count; ?>"  value="0">
                      </div>
        <br>
        <div class="form-group">
           Unique Serial No Count(Excel Data): <input type="number" step="1"  name="enteredserialnocount" onkeyup="return false" onkeydown="return false" required max="<?php echo $count; ?>" min="<?php echo $count; ?>" id="datacount" value="0">
                      </div>
          <br>
          <div class="form-group">
            Not Matching Serial No Count : <input type="number" step="1" name="unmatchcount" onkeyup="return false" onkeydown="return false" required max="0" min="0" id="matchingdatacount" value="0">
          </div>
          <button type="submit" class="btn  btn-flat pull-right" name="Abut" value="Complete">
            <i class="fa fa-check"></i> Complete</button>
          </form>
        </div>
        </form>
      </div>
    </section>
  </div>
<?php
}
?>
<?php include('Foot.php'); ?>
<script>
  function checkval(ArrayFileNameWExt) {
  
var cellValues = document.querySelectorAll('td:nth-child(3)');
var ArrayFileName = [];
cellValues.forEach(function(singleCell) {
  ArrayFileName.push(singleCell.innerText);
});

    var final = ArrayFileNameWExt.filter(function(item) {
      for (var i = 0; i < ArrayFileName.length; i++) {
        if (ArrayFileName[i] === item) return false;
      }
      return true;
    })
    return final;
  }
</script>
<script>
  function addtabledata() {
    var Data = document.getElementById('data').value;
    Data = Data.trim();
    Data = Data.replace(/ +(?= )/g, '');
    while(Data.indexOf('  ')!=-1)Data.replace('  ',' ');
    var splitteddata = Data.split(" ");
    uniqueArray = splitteddata.filter(function(item, pos) {
    return splitteddata.indexOf(item) == pos;
})

splitteddata=uniqueArray;
    var Count = splitteddata.length;
    console.log(Count);
    document.getElementById('datacount').value = Count;
    table = document.getElementsByName("actual_table")[0].getElementsByTagName('tbody')[0];
    while (table.rows.length > 0) {
      table.deleteRow(0);
    }
    var list = checkval(splitteddata);
    
    var Count = list.length;
    
    document.getElementById('matchingdatacount').value = Count;
   if(Count>0)
   {
    list.forEach(addrow);
   }
   
  }
  function addrow(item, index) {
    var table = document.getElementsByName("actual_table")[0].getElementsByTagName('tbody')[0];
    var row = table.insertRow(-1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
   
    var count = index ;
    cell1.innerHTML = count;
    cell2.innerHTML = item+'<input type="text" name="notfound" required style="color:transparent;border:none;width:1px;height:1px;">';
  }
</script>