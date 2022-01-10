<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
  <section class="content">
    <div style="color:#fff;background-color:#000;" id="output"></div>
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Web Portal Users View</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Users/User_switchrights'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>
      <div class="box-body">
        <table id="Viewtable" class="display nowrap" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Email</th>
              <!-- <th>Switch access</th> -->
              <!-- <th style="width:0px !important;">Status</th> -->
              <?php foreach ($this->GM->Office($officetype = "0", $status = "1", $Id = "0", $db = "Nill") as $Row) {
              ?>
                <th><?php echo $Row->office_ShortName . '(' . $Row->officetype_Name . ')'; ?></th>
              <?php
              } ?>
            </tr>
          </thead>
          <tbody>
            <?php
            $cou = 1;
            foreach ($this->GM->logincredential_list(1, 0, 1, 0) as $Row) {
            ?>
              <tr>
                <td><b><?php echo $cou; ?></b></td>
                <td><?php echo $Row->Email; ?></td>
                <!-- <td><?php //echo $Row->swstatus; ?> -->
                <!-- <td>
                  <select onchange="UserStatusupdate('<?php //echo $Row->logincredentials_Id; ?>','<?php //echo $this->session->userdata['cosmolog']['UId']; ?>',this)" class="form-control select2" required name="Status_Id">
                    <?php
                    //$data = $this->GM->Status();
                    //$this->GM->Option_($data, 'Status_Id', 'StatusName', '', 'Select', $Row->Status_Id);
                    ?>
                  </select>
                </td> -->
                <td align="center">
                  <?php
                  if (!empty($Row->office_ho)) {
                  ?>
                    <select onchange="Statusupdate('<?php echo $Row->logincredentials_Id; ?>','<?php echo '1'; ?>','<?php echo $this->session->userdata['cosmolog']['UId']; ?>',this)" class="form-control select2" required name="Status_Id">
                      <?php
                      $data = $this->GM->Status();
                      $this->GM->Option_($data, 'Status_Id', 'StatusName', '', 'Select',$Row->office_ho);
                      ?>
                    </select>
                  <?php
                  } else {
                  ?>
                    <a <?php echo "href='" . site_url('Users/User_switchrights_Create') . "/1/?Key=" . base64_encode($Row->logincredentials_Id) . "'"; ?>> Create </a>
                  <?php
                  }
                  ?>
                </td>
                <td align="center">
                  <?php
                  if (!empty($Row->office_uae)) {
                  ?>
                    <select onchange="Statusupdate('<?php echo $Row->logincredentials_Id; ?>','<?php echo '2'; ?>','<?php echo $this->session->userdata['cosmolog']['UId']; ?>',this)" class="form-control select2" required name="Status_Id">
                      <?php
                      $data = $this->GM->Status();
                      $this->GM->Option_($data, 'Status_Id', 'StatusName', '', 'Select',  $Row->office_uae);
                      ?>
                    </select>
                  <?php
                  } else {
                  ?>
                    <a <?php echo "href='" . site_url('Users/User_switchrights_Create') . "/2/?Key=" . base64_encode($Row->logincredentials_Id) . "'"; ?>> Create </a>
                  <?php
                  }
                  ?>
                </td>
                <td align="center">
                  <?php
                  if (!empty($Row->office_factory)) {
                  ?>
                    <select onchange="Statusupdate('<?php echo $Row->logincredentials_Id; ?>','<?php echo '3'; ?>','<?php echo $this->session->userdata['cosmolog']['UId']; ?>',this)" class="form-control select2" required name="Status_Id">
                      <?php
                      $data = $this->GM->Status();
                      $this->GM->Option_($data, 'Status_Id', 'StatusName', '', 'Select',  $Row->office_factory);
                      ?>
                    </select>
                  <?php
                  } else {
                  ?>
                    <a <?php echo "href='" . site_url('Users/User_switchrights_Create') . "/3/?Key=" . base64_encode($Row->logincredentials_Id) . "'"; ?>> Create </a>
                  <?php
                  }
                  ?>
                </td>
                <td align="center">
                  <?php
                  if (!empty($Row->cosmo_qator)) {
                  ?>
                    <select onchange="Statusupdate('<?php echo $Row->logincredentials_Id; ?>','<?php echo '4'; ?>','<?php echo $this->session->userdata['cosmolog']['UId']; ?>',this)" class="form-control select2" required name="Status_Id">
                      <?php
                      $data = $this->GM->Status();
                      $this->GM->Option_($data, 'Status_Id', 'StatusName', '', 'Select', $Row->cosmo_qator);
                      ?>
                    </select>
                  <?php
                  } else {
                  ?>
                    <a <?php echo "href='" . site_url('Users/User_switchrights_Create') . "/4/?Key=" . base64_encode($Row->logincredentials_Id) . "'"; ?>> Create </a>
                  <?php
                  }
                  ?>
                </td>
                <td align="center">
                  <?php
                  if (!empty($Row->cosmo_oman)) {
                  ?>
                    <select onchange="Statusupdate('<?php echo $Row->logincredentials_Id; ?>','<?php echo '5'; ?>','<?php echo $this->session->userdata['cosmolog']['UId']; ?>',this)" class="form-control select2" required name="Status_Id">
                      <?php
                      $data = $this->GM->Status();
                      $this->GM->Option_($data, 'Status_Id', 'StatusName', '', 'Select',  $Row->cosmo_oman);
                      ?>
                    </select>
                  <?php
                  } else {
                  ?>
                    <a <?php echo "href='" . site_url('Users/User_switchrights_Create') . "/5/?Key=" . base64_encode($Row->logincredentials_Id) . "'"; ?>> Create </a>
                  <?php
                  }
                  ?>
                </td>
                
                <td align="center">
                  <?php
                 
                  if (!empty($Row->cosmo_bhrn)) {
                  ?>
                    <select onchange="Statusupdate('<?php echo $Row->logincredentials_Id; ?>','<?php echo '6'; ?>','<?php echo $this->session->userdata['cosmolog']['UId']; ?>',this)" class="form-control select2" required name="Status_Id">
                      <?php
                      $data = $this->GM->Status();
                      $this->GM->Option_($data, 'Status_Id', 'StatusName', '', 'Select',  $Row->cosmo_bhrn);
                      ?>
                    </select>
                  <?php
                  } else {
                  ?>
                    <a <?php echo "href='" . site_url('Users/User_switchrights_Create') . "/6/?Key=" . base64_encode($Row->logincredentials_Id) . "'"; ?>> Create </a>
                  <?php
                  }
                  ?>
                </td>
              </tr>
            <?php
              $cou++;
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
<?php include('Includes/Foot.php'); ?>
<script>
  function Statusupdate(userid, officeid, modifiedbyid, selectObject) {
    var value = selectObject.value;
    if (value > 0) {
      $(function() {
        $.ajax({
          type: 'POST',
          url: '<?php echo site_url('Api/officeStatusupdate'); ?> ',
          data: {
            userid: userid,
            Officeid: officeid,
            modifiedby: modifiedbyid,
            statusid: value
          },
          success: function(data) {
            $("#output").html(data);
            setTimeout(function() {
              $("#output").html('')
            }, 3000);
          }
        });
      });
    } else {
      $("#output").html('Not updated');
      setTimeout(function() {
        $("#output").html('')
      }, 3000);
    }
  }
  function UserStatusupdate(userid, modifiedbyid, selectObject) {
    var value = selectObject.value;
    if (value > 0) {
      $(function() {
        $.ajax({
          type: 'POST',
          url: '<?php echo site_url('Api/userStatusupdate'); ?> ',
          data: {
            userid: userid,
            modifiedby: modifiedbyid,
            statusid: value
          },
          success: function(data) {
            $("#output").html(data);
            setTimeout(function() {
              $("#output").html('')
            }, 3000);
          }
        });
      });
    } else {
      $("#output").html('Not updated');
      setTimeout(function() {
        $("#output").html('')
      }, 3000);
    }
  }
</script>