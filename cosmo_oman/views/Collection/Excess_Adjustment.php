<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
$id = base64_decode($_GET['Key']);
foreach ($this->GM->ExcessCollection($status = "1", $collection = "0", $id) as $Row) {
    // print_r($Row);
?>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Excess</h1>
        </section>
        <section class="content">
            <div class="box box-form box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Excess Adjustment</h3>
                    <div class="box-tools pull-right">
                        <a href="<?php echo site_url('Collection/Excess'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
                    </div>
                </div>
                <?php echo form_open_multipart(site_url('Collection/Excess_') . $But . '/', 'role="form"'); ?>
                <input type="hidden" name="Collection_Id" value="<?php echo $Row->Colletion_Id; ?>">
                <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
                <input type="hidden" name="Portal_Id" id="Portal_Id" value="1" />
                <input type="hidden" name="collectionprocess_id" id="collectionprocess_id" value="2" />
                <input type="hidden" name="collectionprocessagainst_id" id="collectionprocessagainst_id" value="-1" />
                <input type="hidden" name="collection_status_id" id="collection_status_id" value="1" />
                <input type="hidden" name="AmountMode_id" id="AmountMode_id" value="<?php echo $Row->AmountMode_Id; ?>" />
                <input type="hidden" name="Dealer_Id" id="Dealer_Id" value="<?php echo $Row->Dealer_Id; ?>" />
                <div class="box-body">
                    <div style="color:red;">
                        <?php print_r(validation_errors()); ?>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Amount (<?php echo $_SESSION['Currencycode']; ?>)</label>
                                <input type="hidden" id="amount" required name="amount" value="0.00">
                                <input type="number" Readonly class="form-control input-md" required value="<?php echo $Row->Amount;
                                                                                                            $Payableamount = $Row->Amount; ?>">
                                <br> <?php echo form_error('amount'); ?>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" minlength="3" class="form-control input-md" id="description" required name="description" placeholder="Enter description" value="<?php echo @set_value('description') . @$description; ?>">
                                <br> <?php echo form_error('description'); ?>
                            </div>
                            <div class="form-group">
                                <label>Geo</label>
                                <input type="hidden" required name="lat" id="lat">
                                <input type="hidden" required name="lng" id="lng">
                                <input type="text" id="geo" onclick="gmap_latlong_modal()" class="form-control input-md" required name="geo" placeholder="Enter geo">
                                <?php echo form_error('geo'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="Invoice" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Invoice No</th>
                                            <th>Invoice Date</th>
                                            <th>Pending Amount</th>
                                            <th>Paying Amount (<?php echo $_SESSION['Currencycode']; ?>)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="display:none;">
                                            <td>
                                                <input type="hidden" name="collectiontype_id[0]" value="1">
                                                <input type="hidden" required name="collectiontypeagainst_id[0]" value="<?php echo $Row->ColletionAmount_Id; ?>">
                                                <input type="hidden" required name="InvoicePayAmount[0]" value="<?php echo ($Payableamount * (-1)); ?>"></td>
                                            </td>
                                        </tr>
                                        <?php
                                        $count = "1";
                                        foreach ($this->GM->InvoiceDue($status_id = 1, $Row->Dealer_Id, $Invoice_Id = "0", $Salesexecutive_Id  = "0") as $Products) {
                                            if ($Products->balance >= $Payableamount) {
                                                if ($Products->balance > $Payableamount) {
                                                    $InvoicePayableamount = $Payableamount;
                                                } else {
                                                    $InvoicePayableamount = $Products->balance;
                                                }
                                                $Payableamount -= $InvoicePayableamount;
                                            } else {
                                                $InvoicePayableamount = '0.000';
                                            }
                                        ?>
                                            <tr>
                                                <td><?php echo $Products->Invoice_No; ?>
                                                    <input type="hidden" name="collectiontype_id[<?php $count; ?>]" value="2">
                                                    <input type="number" style="width:0px;height:0px;background-color:transparent;color:transparent;border-color:transparent;" id="Against_Id" class="Against_Id" onkeypress="return false;" required name="collectiontypeagainst_id[<?php echo $count; ?>]" value="<?php echo $Products->Invoice_Id; ?>">
                                                </td>
                                                <td><?php echo $Products->FormattedInvoiceDate; ?>
                                                </td>
                                                <td><?php echo $Products->balance; ?>
                                                </td>
                                                <td><input type="number" readonly onchange="calAmount()" class="form-control input-md InvoicePayAmount" id="InvoicePayAmount" step="0.01" min="0.00" max="<?php echo $Products->balance; ?>" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required name="InvoicePayAmount[<?php echo $count; ?>]" value="<?php echo $InvoicePayableamount; ?>"></td>
                                            </tr>
                                        <?php
                                            $count++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="<?php echo site_url('Collection'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
                        <?php if ($Payableamount > 0) {
                            echo "Amount is NON Adjustable because Invoice Amount is not Equal";
                        } else { ?>
                            <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
                                <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
                        <?php } ?>
                    </div>
                    </form>
                </div>
        </section>
    </div>
<?php
}
include('Includes/Foot.php');
include('assets/plugin/gmap_latlong.php');
?>