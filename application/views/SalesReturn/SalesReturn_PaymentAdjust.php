<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
if ((!isset($_GET['Key'])) || (empty($_GET['Key']))) {
    echo "<script> history.go(-1);</script>";
    exit;
}
$id =  base64_decode($_GET['Key']);
foreach ($this->GM->SalesReturn($status_id = 1, $Dealer_Id = "0", $SalesreturnRequest_Id = "0", $SalesreturnRequest_status_Id = "2", $id) as $Row) {
?>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>(Note: All the Amount is in <?php echo $_SESSION['Currencycode']; ?>)</h1>
        </section>
        <section class="content">
            <div class="box box-form box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Payment Adjustment Details</h3>
                </div>
                <?php echo form_open_multipart(site_url('SalesReturn/SalesReturn_PaymentAdjustSave'), 'role="form"'); ?>
                <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
                <input type="hidden" name="SalesReturn_Id" id="SalesReturnRequest_Id" value="<?php echo $Row->SalesReturn_Id ?>" />
                <input type="hidden" name="SalesReturn_Total" id="SalesReturn_Total" value="<?php echo $Row->SalesReturn_total; ?>" />
                <div class="box-body">
                    <h3 class="box-title"></h3>
                    
                    <div class="row">
                    <div class="col-sm-6 table-responsive">    
                    <div class="box-header with-border">
                                <h3 class="box-title">Sales Return Details</h3>
                            </div>                        
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Sales Return Number</th>
                                        <th>Sales Return Total</th>
                                    </tr>
                                </thead>
                              
                                    <tbody>
                                        <tr>
                                            <td><?php echo $Row->SalesReturn_No; ?></td>
                                            <td><?php echo  $Row->SalesReturn_total; $SalesReturn_total=$Row->SalesReturn_total?></td>
                                        </tr>
                                    </tbody>
                              
                            </table>
                        </div>
                        <div class="col-sm-6 table-responsive">
                            <div class="box-header with-border">
                                <h3 class="box-title">Invoices in SalesReturn</h3>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Invoice Number</th>
                                        <th>Sales Return Invoice Total</th>
                                    </tr>
                                </thead>
                                <?php
                                $SalesReturnInvoiceTotal = $this->GM->SalesReturnInvoiceTotal($status_id = 1, $invoice = "0", $Row->SalesReturn_Id,  $Row->Dealer_Id);
                                $adjustableamount = 0;
                                foreach ($SalesReturnInvoiceTotal as $Invoicetotal) {
                                    $adjustableamount += $Invoicetotal->Invoice_total;
                                ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $Invoicetotal->Invoice_No; ?></td>
                                            <td><?php echo  $Invoicetotal->Invoice_total; ?></td>
                                        </tr>
                                    </tbody>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
                        <div class="col-sm-12 table-responsive">
                            <div class="box-header with-border">
                                <h3 class="box-title">Due's Against Dealer</h3>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Invoice Number</th>
                                        <th>Due</th>
                                        <th>Amount to be adjusted</th>
                                    </tr>
                                </thead>
                                <?php
                                $DealerDue = $this->GM->InvoiceDue($status_id = 1, $Row->Dealer_Id, $invoice_id = 0, $salesexecutiveid = "0");
                                foreach ($DealerDue as $Due) {
                                    $dueadjustment = 0;
                                    if ($Due->Invoice_Due >= $adjustableamount) {
                                        $dueadjustment = $Due->Invoice_Due;
                                        $adjustableamount = $Due->Invoice_Due - $adjustableamount;
                                    }
                                ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $Due->Invoice_No; ?></td>
                                            <td><?php echo  $Due->Invoice_Due; ?></td>
                                            <td><input type="number" value="<?php echo  $dueadjustment; ?>" step ="0.01" min="0.00" name="adjustableamount[<?php echo $Due->Invoice_Id; ?>]" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;"  /></td>
                                        </tr>
                                    </tbody>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
                <?php if (true) {
                ?>
				<div class="box-footer">
				<input type="hidden" name="salesreturn_amount" value="<?php echo $SalesReturn_total?>">
                        <a href="<?php echo site_url("SalesReturn/SalesReturn_PaymentAdjust/?Key=" . $_GET['Key']); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
                        <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
                            <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
                    </div>
                    
                <?php
                } else {
                ?>
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo "Excess:$adjustableamount"; ?></h3>
                    </div>
                <?php
                }
                ?>
                </form>
            </div>
        </section>
    </div>
<?php }
include('Foot.php'); ?>