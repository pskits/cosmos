<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Attendance View</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Users/AttendanceList_View'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>
      <div class="box-body">
        <table id="Viewtable" class="display nowrap" style="width:100%">
          <thead>
            <tr>            
              <th>Name</th>
              <th>Email</th>
              <th>Joining Date</th>
              <th>Tools</th>
            </tr>
          </thead>
          <tbody>
            <?php
                foreach ($this->GM->AttendanceUserlist($status = "1", $id = "0", $UserRole_Id="0", $userid = "0") as $Row) {
            ?>
                  <tr>           
                    <td><?php echo $Row->name . '<br>' . $Row->UserRole; ?></td>
                    <td><?php echo $Row->email; ?></td>
                    <td><?php echo $this->GM->DateSplitshow($Row->Joining_date); ?></td>
                    <td>
                      <a <?php echo "href='" . site_url('Users/Attendance') . "/?ur=" . base64_encode($Row->UserRole_Id) . "&Key=" . base64_encode($Row->User_Id) . "'"; ?> <span class="badge"><i class="fa fa-pencil"></i>&nbsp; View</span>
                    </td>
                  </tr>
            <?php
                }
            
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
<?php include('Includes/Foot.php'); ?>