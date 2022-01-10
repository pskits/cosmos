<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
if ((!isset($_GET['Key'])) || (empty($_GET['Key']))) {
    echo "<script> history.go(-1);</script>";
    exit;
}
$id =  base64_decode($_GET['Key']);
foreach ($this->GM->SalesReturnRequestPending($status_id = "1", $id, $Dealer_Id = "0", $Salesexecutive_user_Id = "0", $SalesreturnRequestType_Id = "0")  as $Row) {
?>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Sales Return (Note: All the Amount is in <?php echo $_SESSION['Currencycode']; ?>)</h1>
        </section>
        <section class="content">
            <div class="box box-form box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Sales Return Details</h3>
                </div>
                <div class="box-body">
                    <h3 class="box-title">Approve Products to List Estimate</h3>
                    <div class="row">
                        <div class=" col-md-12 box-title"><b><?php echo $Row->SalesReturnRequest_No; ?> </b><br/>
						Reason:<?php echo $Row->SalesReturnRequest_reason; ?></div>
                        <div class="col-sm-12 table-responsive">
                            <br>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Serial No</th>
                                        <th>Warrenty Status</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = "0";
                                    foreach ($this->GM->SalesReturnRequestGoods($status_id = "1", $Row->SalesReturnRequest_Id, $serialno = "",  $SalesreturnRequest_status_Id = "0") as $Products) {
                                        $count++;
                                    ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $Products->SerialNo; ?></td>
                                            <td><?php echo $Products->WarrentyStatus_Name; ?><br>
                                                <sub>Exp:<?php echo $Products->Expiry_date; ?><br>
                                                    Clm: <?php echo $Products->WarrentyClaim_date; ?> </sub>
                                            </td>
                                            <td><?php echo $Products->SalesReturnRequest_statusName; ?></td>
                                            <td>
                                                <?php
                                                if ($Products->WarrentyStatus_Id == "1") {
                                                ?>
                                                    <form style="width:70%;float:left;" action="<?php echo site_url('SalesReturn/SalsReturnSerialNo_StatusUpdate'); ?>" method="post">
                                                        <input type="hidden" value="<?php echo $Products->SerialNo; ?>" name="SerialNo">
                                                        <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
                                                        <button type="submit" class="btn btn-success btn-flat" name="Status" value="2">Approve</button>
                                                    </form>
                                                    <form style="width:25%;float:left;" action="<?php echo site_url('SalesReturn/SalsReturnSerialNo_StatusUpdate'); ?>" method="post">
                                                        <input type="hidden" value="<?php echo $Products->SerialNo; ?>" name="SerialNo">
                                                        <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
                                                        <button type="submit" class="btn btn-danger btn-flat" name="Status" value="3">Reject</button>
                                                    </form>
                                            </td>
                                        </tr>
                                <?php
                                                } else {
                                                    echo "Not Claimable";
                                                }
                                            }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                        <?php echo form_open_multipart(site_url('SalesReturn/SalesReturnRequest_ProcessSave'), 'role="form"'); ?>
                        <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
                        <input type="hidden" name="SalesReturnRequest_Id" id="SalesReturnRequest_Id" value="<?php echo $Row->SalesReturnRequest_Id ?>" />
                        <input type="hidden" name="SalesReturnRequest_Date" id="SalesReturnRequest_Date" value="<?php echo $Row->SalesReturnRequest_date; ?>" />
                        <div class="col-md-12">
                            <h3 class="box-title">Sales Return Estimate</h3>
                            <div class="table-responsive">
                                <table id="products" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Invoice</th>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Rate</th>
                                            <th>Sub Total</th>
                                            <th>Discount</th>
                                            <th>Tax</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $Totalproductsubtotal = 0;
                                        $Totaldiscounttotal = 0;
                                        $Totaltaxtotal = 0;
                                        $Totalproducttotal = 0;
                                        $count = "0";
                                        $productsdata = $this->GM->SalesReturnRequestProduct($status_id = 1, $Row->SalesReturnRequest_Id, $Invoice_Id = "0", $SalesreturnRequest_status_Id = "2");
                                        foreach ($productsdata as $Products) {
                                            $productsubtotal = (($Products->InvoiceProduct_rate) * ($Products->Qty));
                                            $discounttotal = (($productsubtotal / 100) * ($Products->InvoiceProduct_discountperc));
                                            $taxtotal = ((($productsubtotal-$discounttotal) / 100) * ($Products->InvoiceProduct_taxperc));
                                            $producttotal =  ((($productsubtotal) - ($discounttotal)) + ($taxtotal));
                                            $Totalproductsubtotal += $productsubtotal;
                                            $Totaldiscounttotal += $discounttotal;
                                            $Totaltaxtotal += $taxtotal;
                                            $Totalproducttotal += $producttotal;
                                        ?>
                                            <tr>
                                                <td><?php echo $count + 1; ?></td>
                                                <td><?php echo $Products->Invoice_No; ?></td>
                                                <td>
                                                    <?php
                                                    $data = $this->GM->Product($status = "1", $productcategory_id = "0", $Products->product_id);
                                                    ?>
                                                    <input type="hidden" name="Invoice_id[<?php echo $count; ?>]" readonly required type="hidden" value="<?php echo $Products->Invoice_id; ?>">
                                                    <input id="Product[<?php echo $count; ?>]" readonly required="" name="Product_Id[<?php echo $count; ?>]" type="hidden" value="<?php echo $data[0]->Product_Id; ?>">
                                                    <input id="Productname[<?php echo $count; ?>]" class="form-control input-md " readonly required="" name="Product[<?php echo $count; ?>]" type="text" value="<?php echo $data[0]->Product; ?>">
                                                </td>
                                                <td><input type="number" readonly class="form-control input-md " id="productqty" required="" name="Qty[<?php echo $count; ?>]" value="<?php echo $Products->Qty ?>" placeholder="Enter Quantity"></td>
                                                <td><input readonly type="number" class="form-control input-md" id="productrate" required="" name="Rate[<?php echo $count; ?>]" placeholder="Enter Rate" value="<?php echo $Products->InvoiceProduct_rate ?>"></td>
                                                <td>
                                                    <input readonly type="number" class="form-control input-md " required="" name="SubTotal[<?php echo $count; ?>]" value="<?php echo $productsubtotal; ?>" placeholder="Enter SubTotal" id="SubTotal">
                                                </td>
                                                <td>
                                                    <input readonly type="number" class="form-control input-md " required="" name="Discount[<?php echo $count; ?>]" value="<?php echo $discounttotal; ?>" placeholder="Enter Discount" id="productdiscount">
                                                    <input readonly type="number" class="form-control input-sm " required="" name="DiscountPerc[<?php echo $count; ?>]" value="<?php echo $Products->InvoiceProduct_discountperc; ?>" placeholder="Enter DiscountPerc" id="productdiscountPerc" style="width:90%;float:left;"><span style="width:10%;float:right;">%</span>
                                                </td>
                                                <td>
                                                <input readonly type="hidden" class="form-control input-md " name="Tax_Id[<?php echo $count; ?>]" value="<?php echo $Products->Tax_id; ?>"  id="productTax">
                                                   
                                                    <input readonly type="number" class="form-control input-md " required="" name="Tax[<?php echo $count; ?>]" value="<?php echo $taxtotal; ?>" placeholder="Enter Tax" id="productTax">
                                                    <input readonly type="number" class="form-control input-sm " required="" name="TaxPerc[<?php echo $count; ?>]" value="<?php echo $Products->InvoiceProduct_taxperc; ?>" placeholder="Enter TaxPerc" id="productTaxPerc" style="width:90%;float:left;"><span style="width:10%;float:right;">%</span>
                                                </td>
                                                <td>
                                                    <input readonly type="number" class="form-control input-md " required="" name="Total[<?php echo $count; ?>]" value="<?php echo $producttotal; ?>" placeholder="Enter Total" id="Total">
                                                </td>
                                            </tr>
                                        <?php
                                            $count++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-4 pull-right">
                            <div class="table-responsive">
                                <table class="table table-total">
                                    <tr>
                                        <td style="width:50%">Sub Total</td>
                                        <td><input type="text" class="borderless" name="SalesReturn_Subtotal" required readonly id="SalesReturn_Subtotal" value="<?php echo $Totalproductsubtotal; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <td><input type="text" class="borderless" name="SalesReturn_TotalDiscountAmount" required readonly id="SalesReturn_TotalDiscountAmount" value="<?php echo  $Totaldiscounttotal; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <td><input type="text" class="borderless" id="SalesReturn_TotalTaxAmount" required readonly name="SalesReturn_TotalTaxAmount" value="<?php echo $Totaltaxtotal; ?>"></td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <th style="padding: 0px;"><input type="text" class="borderless" id="SalesReturn_GrandTotalAmount" required readonly name="SalesReturn_GrandTotalAmount" value="<?php echo  $Totalproducttotal; ?>" style="background: transparent;"></th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Dealer</label>
                                <select class="form-control select2" required id="Dealer_Id" name="Dealer_Id">
                                    <?php
                                    $data = $this->GM->Dealer($Row->Dealer_Id, $status = "1", $salesexecutiveid = 0);
                                    ?>
                                    <option value="<?php echo $Row->Dealer_Id; ?>"><?php echo $Row->name; ?></option>
                                </select>
                                <?php echo form_error('Dealer_Id'); ?>
                            </div>
                   
                            <div class="form-group">
                                <label>Reason</label>
                                <input type="text" class="form-control input-md" required name="Reason" placeholder="Enter  Reason" value="<?php echo @set_value('Reason') . @$Reason; ?>">
                                <?php echo form_error('Reason'); ?>
                            </div>
                        </div>
                    </div>
                  
                </div>
     
              
                    <div class="box-footer">
                     
                        <a href="<?php echo site_url("Purchase/Bill/?Key=$id"); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
                        <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
                            <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
                    </div>
           
                </form>
				 <?php echo form_open_multipart(site_url('SalesReturn/SalesReturnRequest_Status'), 'role="form"'); ?>
                        <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
                        <input type="hidden" name="SalesReturnRequest_Id" id="SalesReturnRequest_Id" value="<?php echo $Row->SalesReturnRequest_Id ?>" />
						<input type="hidden" name="Status_Id" id="Status_Id" value="4" />
						  <button type="submit" class="btn bg-red btn-flat" name="Abut" value="Save">
                            Cancell Sales return Request</button>
						 </form>
            </div>
        </section>
    </div>
<?php
}
?>
<?php include('Includes/Foot.php'); ?>