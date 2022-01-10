<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>
<div class="content-wrapper">
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Joining Salary View</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Users/Salary'); ?>" class="btn btn-flat bg-grayy" style="background:#f9f9f9;color:#1a2226;"><i class="fa fa-caret-left"></i> Back</a>
          <a href="<?php echo site_url('Users/Salary_View'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>
      <div class="box-body">
        <table id="Viewtable" class="display nowrap" style="width:100%">
          <thead>
            <tr>              
              <th>Name</th>
              <th>User Role</th>
              <th>Email</th>
              <th>Pay type</th>
              <th>Salary Starting From</th>
              <th>Tools</th>
            </tr>
          </thead>
          <tbody>
            <?php
        
              foreach ($this->GM->Salary($UserRole_Id=0, $paytype_id = "0", $status = "1", $id = "0") as $Row) {
     
            ?>
                <tr>
                <td><?php echo $Row->name; ?></td>
                  <td><?php echo $Row->UserRole; ?></td>
                  <td><?php echo $Row->email; ?></td>
                  <td><?php echo $Row->pay_type; ?></td>
                  <td><?php echo $this->GM->DateSplitshow($Row->salary_from_date); ?></td>
                  <td>
                    <a <?php echo "href='" . site_url('Users/Salary') . "/?ur=" . base64_encode($Row->UserRole_Id) . "&Key=" . base64_encode($Row->Salary_Id) . "'"; ?> <span class="badge"><i class="fa fa-pencil"></i>&nbsp; Edit</span>
                      <a <?php echo "href='" . site_url('Users/Salaryuser_views') . "/?ur=" . base64_encode($Row->UserRole_Id) . "&Key=" . base64_encode($Row->User_Id) . "'"; ?> <span class="badge"><i class="fa fa-eye"></i>&nbsp; View</span>
                      </a>
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
<?php include('Foot.php'); ?>