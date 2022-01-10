<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>
<div class="content-wrapper">
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Salary Setting</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Users/Salary_View'); ?>" class="btn btn-flat bg-grayy" style="background:#f9f9f9;color:#1a2226;"><i class="fa fa-caret-left"></i> Back</a>
                    <a href="<?php echo site_url('Users/Salaryuser_Views/?ur=' . $_GET['ur'] . '&Key=' . $_GET['Key']); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="box-title">User Details</h3>
                        <table class="table table-bordered display nowrap" style="width:100%">
                            <?php
                            foreach ($this->GM->Salary($_GET['UserRole_Id'], $pay_type = "0", $status = "1", $_GET['User_Id']) as $Salary) {
                            ?>
                                <tr>
                                    <td> <b>Pay Type:</b> <?php echo $Salary->pay_type; ?></td>
                                    <td> <b>Name:</b> <?php echo $Salary->name; ?> <br> (<?php echo $Salary->UserRole; ?> )</td>
                                    <td> <b>Email:</b> <?php echo $Salary->email; ?> </td>
                                    <td><b>Salary Starting From :</b> <?php echo $this->GM->DateSplitshow($Salary->salary_from_date); ?> </td>
                                </tr>
                            <?php
                            } ?>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <h3 class="box-title">Heads</h3>
                        <table class="table table-bordered display nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Hike</th>
                                    <th>Deduction</th>
                                    <th>Pay Head</th>
                                    <th>Pay From</th>
                                    <th>Starting Amount</th>
                                    <th>Pay Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $cou = 0;
                                $joiningpay = 0;
                                $actualpay = 0;
                                $totalhikepay = 0;

                                $overalldeductiontotal = 0;
                                foreach ($this->GM->SalaryAmount($status = "1", $Salary->Salary_Id, $payhead_Id = "0", $Id = "0") as $SalaryAmount) {
                                    $cou++;
                                ?>
                                    <tr>
                                        <td><b><?php echo $cou; ?></b></td>
                                        <td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#Hike_<?php echo $SalaryAmount->pay_head_Id; ?>">
                                                Add Hike
                                            </button>
                                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#Hikeview_<?php echo $SalaryAmount->pay_head_Id; ?>">
                                                View Hike
                                            </button>
                                            <div class="modal" id="Hike_<?php echo $SalaryAmount->pay_head_Id; ?>">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span></button>
                                                            <h4 class="modal-title">Add Hike</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-12">
                                                                <?php echo form_open_multipart(site_url('Users/Hike_Save') . '/', 'role="form"'); ?>
                                                                <input type="hidden" name="loginUser_Id" id="loginUser_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
                                                                <input type="hidden" name="SalaryAmount_Id" id="SalaryAmount_Id" value="<?php echo $SalaryAmount->SalaryAmount_Id; ?>" />
                                                                <input type="hidden" name="Hike_Id" id="Hike_Id" value="" />
                                                                <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $Salary->User_Id; ?>" />
                                                                <input type="hidden" name="UserRole_Id" id="UserRole_Id" value="<?php echo $Salary->UserRole_Id; ?>" />
                                                                <h3 class="box-title">Add Hike</h3>
                                                                <table class="table table-bordered" style="width:100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Hike_pay_amount</th>
                                                                            <th>Hike Date From</th>
                                                                            <th>Tools</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <input type="number" step="0.01" min="0.00" class="form-control input-md" id="Hike_pay_amount" required name="Hike_pay_amount" placeholder="Enter Hike_pay_amount" value="<?php echo @set_value('Hike_pay_amount') . @$Hike_pay_amount; ?>">
                                                                                <br> <?php echo form_error('Hike_pay_amount'); ?></td>
                                                                            <td>
                                                                                <input type="text" class="form-control input-md Date" readonly required name="Hike_From_date" placeholder="Enter Date" value="<?php echo @set_value('Hike_From_date') . @$Hike_From_date; ?>">
                                                                                <br> <?php echo form_error('Hike_From_date'); ?></td>
                                                                            <td>
                                                                                <button type="submit" id="savebutton" class="btn bg-Green text-Green" name="Abut" value="Save">Save</button>
                                                                                <br><br> <button type="button" style="display: none;" id="reloadbutton" onclick="reload();">Reload</button>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <div class="modal" id="Hikeview_<?php echo $SalaryAmount->pay_head_Id; ?>">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span></button>
                                                            <h4 class="modal-title">View Hike</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-12">
                                                                <h3 class="box-title">Hike</h3>
                                                                <table class="table table-bordered" style="width:100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Tools</th>
                                                                            <th>Pay Head</th>
                                                                            <th>Hike Date From</th>
                                                                            <th>Hike Pay Amount</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $cou = 1;
                                                                        $hikepay = 0;
                                                                        foreach ($this->GM->Hike($_GET['UserRole_Id'], $payid = "0", $status = "1", $_GET['User_Id'], $hikeid = "0", $SalaryAmount->SalaryAmount_Id) as $Hike) {
                                                                        ?>
                                                                            <tr>
                                                                                <td><b><?php echo $cou; ?></b></td>
                                                                                <td>
                                                                                    <?php echo form_open_multipart(site_url('Users/Hike_Save') . '/', 'role="form"'); ?>
                                                                                    <input type="hidden" name="loginUser_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
                                                                                    <input type="hidden" name="SalaryAmount_Id" value="<?php echo $SalaryAmount->SalaryAmount_Id; ?>" />
                                                                                    <input type="hidden" name="Hike_Id" value="<?php echo $Hike->Hike_Id; ?>" />
                                                                                    <input type="hidden" name="User_Id" value="<?php echo $Salary->User_Id; ?>" />
                                                                                    <input type="hidden" name="UserRole_Id" value="<?php echo $Salary->UserRole_Id; ?>" />
                                                                                    <input type="hidden" name="Hike_From_date" value="<?php echo $this->GM->DateSplitshow($Hike->Hike_From_date); ?>">
                                                                                    <input type="hidden" name="Hike_pay_amount" value="<?php echo  $Hike->Hike_pay_amount;  ?>">
                                                                                    <button type="submit" class="btn bg-Green text-Green" name="Abut" value="DELETE">Delete</button>
                                                                                    </form>

                                                                                </td>
                                                                                <td><?php echo $Hike->pay_head; ?></td>
                                                                                <td><?php echo $Hike->Hike_From_date_formatted; ?></td>
                                                                                <td><?php echo $Hike->Hike_pay_amount;
                                                                                    $hikepay += $Hike->Hike_pay_amount;
                                                                                    ?></td>
                                                                            </tr>
                                                                        <?php
                                                                            $cou++;
                                                                        }
                                                                        $totalhikepay += $hikepay;
                                                                        $actualpay += $hikepay;
                                                                        ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <td colspan="4" style="text-align: right; font-weight:700;">Hike Total</td>
                                                                            <td style="font-weight:700;"><?php echo $hikepay; ?></td>
                                                                        </tr>

                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#Deduction_<?php echo $SalaryAmount->pay_head_Id; ?>">
                                                Add Deduction
                                            </button>
                                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#Deductionview_<?php echo $SalaryAmount->pay_head_Id; ?>">
                                                View Deduction
                                            </button>
                                            <div class="modal" id="Deduction_<?php echo $SalaryAmount->pay_head_Id; ?>">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span></button>
                                                            <h4 class="modal-title">Add Deduction</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-12">
                                                                <?php echo form_open_multipart(site_url('Users/Deduction_Save') . '/', 'role="form"'); ?>
                                                                <input type="hidden" name="loginUser_Id" id="loginUser_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
                                                                <input type="hidden" name="SalaryDeduction_SalaryAmount_Id" id="SalaryDeduction_SalaryAmount_Id" value="<?php echo $SalaryAmount->SalaryAmount_Id; ?>" />
                                                                <input type="hidden" name="SalaryDeduction_Id" id="SalaryDeduction_Id" value="0" />
                                                                <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $Salary->User_Id; ?>" />
                                                                <input type="hidden" name="UserRole_Id" id="UserRole_Id" value="<?php echo $Salary->UserRole_Id; ?>" />
                                                                <h3 class="box-title">Add Deduction</h3>
                                                                <table class="table table-bordered display nowrap" style="width:100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Deduction</th>
                                                                            <th>Deduction Date From</th>
                                                                            <th>Tools</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <select id="SalaryDeduction_Deduction_Id" required class="form-control select2" name="SalaryDeduction_Deduction_Id">
                                                                                    <?php
                                                                                    $data =  $this->GM->Deduction('1', '0');
                                                                                    $this->GM->Option_($data, 'Deduction_Id', 'Deduction_name', '', 'Select', @set_value('SalaryDeduction_Deduction_Id') . @$SalaryDeduction_Deduction_Id);
                                                                                    ?>
                                                                                </select>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control input-md Date" readonly required name="SalaryDeduction_From_date" placeholder="Enter Date" value="<?php echo @set_value('SalaryDeduction_From_date') . @$SalaryDeduction_From_date; ?>">
                                                                                <br> <?php echo form_error('SalaryDeduction_From_date'); ?></td>
                                                                            <td>
                                                                                <button type="submit" class="btn bg-Green text-Green" name="Abut" value="Save">Save</button>
                                                                            </td>
                                                                        </tr>

                                                                    </tbody>
                                                                </table>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <div class="modal" id="Deductionview_<?php echo $SalaryAmount->pay_head_Id; ?>">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span></button>
                                                            <h4 class="modal-title">View Deduction</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-12">
                                                                <h3 class="box-title">Deductions</h3>
                                                                <table class="table table-bordered display nowrap" style="width:100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Tools</th>
                                                                            <th>Pay name</th>
                                                                            <th>Deduction_name</th>
                                                                            <th>SalaryDeduction From date</th>
                                                                            <th>Deduction</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $cou = 1;
                                                                        $deductiontotal = 0;
                                                                        $deductionsettotal = 0;
                                                                        foreach ($this->GM->SalaryDeduction($status = "1", $deduction = "0", $_GET['User_Id'], $salarydeductionid = "0", $SalaryAmount->SalaryAmount_Id, $SalaryAmount->pay_head_Id) as $SalaryDeduction) {
                                                                        ?>
                                                                            <tr>
                                                                                <td><b><?php echo $cou; ?></b></td>
                                                                                <td>
                                                                                    <?php echo form_open_multipart(site_url('Users/Deduction_Save') . '/', 'role="form"'); ?>
                                                                                    <input type="hidden" name="loginUser_Id" id="loginUser_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
                                                                                    <input type="hidden" name="SalaryDeduction_SalaryAmount_Id" id="SalaryDeduction_SalaryAmount_Id" value="<?php echo $SalaryDeduction->SalaryDeduction_SalaryAmount_Id; ?>" />
                                                                                    <input type="hidden" name="SalaryDeduction_Id" id="SalaryDeduction_Id" value="<?php echo $SalaryDeduction->SalaryDeduction_Id; ?>" />
                                                                                    <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $Salary->User_Id; ?>" />
                                                                                    <input type="hidden" name="UserRole_Id" id="UserRole_Id" value="<?php echo $Salary->UserRole_Id; ?>" />
                                                                                    <input type="hidden" name="SalaryDeduction_From_date" id="SalaryDeduction_From_date" value="<?php echo $this->GM->Datesplit($SalaryDeduction->SalaryDeduction_From_date); ?>" />
                                                                                    <input type="hidden" name="SalaryDeduction_Deduction_Id" id="SalaryDeduction_Deduction_Id" value="<?php echo $SalaryDeduction->SalaryDeduction_Deduction_Id; ?>" />
                                                                                    <button type="submit" class="btn bg-Green text-Green" name="Abut" value="DELETE">Delete</button>
                                                                                    </form>
                                                                                    <?php
                                                                                    $cou++;
                                                                                    ?>
                                                                                </td>
                                                                                <td><?php echo $SalaryDeduction->pay_head; ?>(<?php echo $SalaryDeduction->Deduction; ?>(<?php echo $SalaryDeduction->DiscountTypeName; ?>))</td>
                                                                                <td><?php echo $SalaryDeduction->Deduction_name; ?></td>
                                                                                <td><?php echo $SalaryDeduction->SalaryDeduction_From_dateformated; ?></td>
                                                                                <?php
                                                                                if ($SalaryDeduction->DiscountType_Id == '1') {
                                                                                    $deductionamount = $this->GM->Percentagetoamount($SalaryDeduction->Deduction, ($hikepay + $SalaryAmount->pay_amount));
                                                                                } else {
                                                                                    $deductionamount = $SalaryDeduction->Deduction;
                                                                                }
                                                                                ?>
                                                                                <td><?php echo $deductionamount; ?></td>
                                                                            </tr>
                                                                        <?php
                                                                            $deductionsettotal += $deductionamount;
                                                                        }

                                                                        ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <td colspan="5">Total</td>
                                                                            <td><?php echo $deductionsettotal; ?></td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                        </td>
                                        <td><?php echo $SalaryAmount->pay_head; ?></td>
                                        <td><?php echo  $this->GM->DateSplitshow($Salary->salary_from_date); ?></td>
                                        <td><?php echo $SalaryAmount->pay_amount; ?></td>
                                        <td><?php echo $hikepay + $SalaryAmount->pay_amount ?></td>
                                    </tr>
                                <?php
                                    $joiningpay += $SalaryAmount->pay_amount;
                                    $overalldeductiontotal += $deductionsettotal;
                                }

                                $actualpay += $joiningpay;
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" style="text-align: right; font-weight:700;">Joining Total</td>
                                    <td style="font-weight:700;"><?php echo $joiningpay; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="text-align: right; font-weight:700;">Hike Total</td>
                                    <td style="font-weight:700;"><?php echo $totalhikepay; ?></td>
                                </tr>

                                <tr>
                                    <td colspan="6" style="text-align: right; font-weight:700;">Actual Total</td>
                                    <td style="font-weight:700;"><?php echo $actualpay; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="text-align: right; font-weight:700;">Deduction Total (-)</td>
                                    <td style="font-weight:700;"><?php echo $overalldeductiontotal; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="text-align: right; font-weight:700;">Payable </td>
                                    <td style="font-weight:700;"><?php echo $actualpay - $overalldeductiontotal; ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>


                </div>
                <div class="col-md-12">
                    <?php echo form_open_multipart(site_url('Users/SalaryAmount_Save') . '/', 'role="form"'); ?>
                    <input type="hidden" name="loginUser_Id" id="loginUser_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
                    <input type="hidden" name="Salary_Id" id="Salary_Id" value="<?php echo $Salary->Salary_Id; ?>" />
                    <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $Salary->User_Id; ?>" />
                    <input type="hidden" name="UserRole_Id" id="UserRole_Id" value="<?php echo $Salary->UserRole_Id; ?>" />
                    <input type="hidden" name="SalaryAmount_Id" id="SalaryAmount_Id" value="" />
                    <h3 class="box-title">Add Pay Head</h3>
                    <table class="table table-bordered display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>pay_head</th>
                                <th>pay_amount</th>
                                <th>Tools</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select id="pay_head_Id" required class="form-control select2" name="pay_head_Id">
                                        <?php
                                        $data =  $this->GM->payhead('1', '0');
                                        $this->GM->Option_($data, 'pay_head_Id', 'pay_head', '', 'Select', @set_value('pay_head_Id') . @$pay_head_Id);
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" class="form-control input-md" min="0.00" step="0.00" id="pay_amount" required name="pay_amount" placeholder="Enter pay_amount" value="<?php echo @set_value('pay_amount') . @$pay_amount; ?>">
                                    <br> <?php echo form_error('pay_amount'); ?></td>
                                <td>
                                    <button type="submit" class="btn bg-Green text-Green" name="Abut" value="Save">Save</button>
                                    <br><br> <button type="button" style="display: none;" onclick="reload();">Reload</button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6">
                               
                                    </td>
                            </tr>
                        </tbody>
                    </table>
                    </form>
                </div>

            </div>
        </div>
</div>
</section>
</div>
<?php include('Foot.php'); ?>