<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Bank Approval View</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Bank Approval View</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Collection/BankApproval'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>
      <div class="box-body">
        <br>
        <form class="row form-inline">
          <div class="col-md-1"></div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Bank</label>
              <select id="Bank_Id" required class="form-control select2" name="Bank_Id">
                <?php
                $data = $this->GM->Bank();
                $this->GM->Option_($data, 'Bank_Id', 'BankName', '', 'Select', @$_GET['Bank_Id']);
                ?>
              </select>
              <?php echo form_error('Bank_Id'); ?>
            </div>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-1"></div>
          <div class="col-md-2">
            <div class="form-group">
              <button type="submit" class="btnbg-black text-white btn-flat" name="Abut" value="Show">
                <i class="fa fa-cloud-download"></i>Show</button>
            </div>
          </div>
        </form>
        <hr class="horizondal-splitter">
        <table id="Viewtable" class="display nowrap" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>DepositNo</th>
              <th>Deposit Date</th>
              <th>Deposited User</th>
              <th>Mode</th>
              <th>Amount</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $cou = 1;
            if (isset($_GET['Bank_Id'])) {
              foreach ($this->GM->Deposit($status = "1", $_GET['Bank_Id'], $depositedUser_Id = "0", $DepositStatus_Id = "1", $amountmode_Id = "0", $Id = "0", '', '') as $Row) {
            ?>
                <tr>
                  <td><b><?php echo $cou; ?></b></td>
                  <td><a <?php echo "href='" . site_url('') . "/" . "Collection/Deposit_invoice/?Key=" . base64_encode($Row->Deposit_Id) . "'"; ?>>
                      <?php echo $Row->Deposit_no; ?></a></td>
                  <td><?php echo $Row->Deposit_Dateformatted; ?></td>
                  <td><?php echo $Row->Email; ?></td>
                  <td><?php echo $Row->AmountModeName; ?></td>
                  <td><?php echo $Row->amount; ?></td>
                  <td>
                    <span class="badge" onclick="Accept('<?php echo $Row->Deposit_Id; ?>','<?php echo $Row->AmountMode_Id; ?>')"><i class="fa fa-check"></i></span> <span class="badge" onclick="Reject('<?php echo $Row->Deposit_Id; ?>','<?php echo $Row->AmountMode_Id; ?>')"><i class="fa fa-times"></i></span>
                  </td>
                </tr>
            <?php
                $cou++;
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
<!-- Approved -->
<div class="modal" id="Accept_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Approved</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="<?php echo site_url('Collection/BankApproval_Save') ?>" method="POST">
          <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
          <input type="hidden" class="Deposit_Id" name="Deposit_Id" id="Deposit_Id">
          <input type="hidden" class="AmountMode_id" name="AmountMode_id" id="AmountMode_id">
          
          <input type="hidden" name="Deposit_status_id" id="Deposit_status_id" value="2">
          <input type="hidden" name="reject_reason" id="reject_reason" value="NULL">
          <input type="hidden" name="reject_description" id="reject_description" value="NULL">
          <input type="hidden" name="Abut" id="Abut" value="Accept">
          <div class="form-group">
            <label>Reference</label>
            <input type="text" autocomplete="off" minlength="3" class="form-control input-md" id="Reference" required name="Reference" placeholder="Enter Reference" value="<?php echo @set_value('Reference') . @$Reference; ?>">
            <br> <?php echo form_error('Reference'); ?>
          </div>
          <div class="form-group">
            <label>Bank Date</label>
            <input type="text" autocomplete="off" minlength="3" onkeypress="return false;" class="form-control input-md Date" id="Bank_Date" required name="Bank_Date" placeholder="Enter Bank_Date" value="<?php echo @set_value('Bank_Date') . @$Bank_Date; ?>">
            <br> <?php echo form_error('Bank_Date'); ?>
          </div>
          <button type="submit" class="btn btn-success">Accept</button>
        </form>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end of Approved -->
<!-- Not Rejected -->
<div class="modal" id="Reject_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Rejected</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="<?php echo site_url('Collection/BankApproval_Save') ?>" method="POST">
          <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
          <input type="hidden" class="Deposit_Id" name="Deposit_Id" id="Deposit_Id">
          <input type="hidden" class="AmountMode_id" name="AmountMode_id" id="AmountMode_id">
          <input type="hidden" name="Deposit_status_id" id="Deposit_status_id" value="3"> 
          <input type="hidden" name="Reference" id="Reference" value="NULL">
          <input type="hidden" name="Bank_Date" id="Bank_Date" value="NULL">
          <input type="hidden" name="Abut" id="Abut" value="Reject">
          <div class="form-group">
            <label>Reject Reason</label>
            <input type="text" autocomplete="off" minlength="3" class="form-control input-md" id="reject_reason" required name="reject_reason" placeholder="Enter Reject reason" value="<?php echo @set_value('reject_reason') . @$reject_reason; ?>">
            <br> <?php echo form_error('reject_reason'); ?>
          </div>
          <div class="form-group">
            <label>Reject Description</label>
            <input type="text" autocomplete="off" minlength="3" class="form-control input-md" id="Bank_Date" required name="reject_description" placeholder="Enter Reject description" value="<?php echo @set_value('reject_description') . @$reject_description; ?>">
            <br> <?php echo form_error('reject_description'); ?>
          </div>
          <button type="submit" class="btn btn-success">Reject</button>
        </form>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end of Rejected -->
<?php include('Includes/Foot.php'); ?>
<script>
  function Accept(id,AmountMode_id) {
    $('.Deposit_Id').val(id);
    $('.AmountMode_id').val(AmountMode_id);
    $('#Accept_modal').modal();
  }
  function Reject(id,AmountMode_id) {
    $('.Deposit_Id').val(id);
    $('.AmountMode_id').val(AmountMode_id);
    $('#Reject_modal').modal();
  }
</script>