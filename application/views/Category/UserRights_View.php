<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>

<div class="content-wrapper">

  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">UserRights View</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Category/UserRights'); ?>" class="btn btn-flat bg-grayy" style="background:#f9f9f9;color:#1a2226;"><i class="fa fa-caret-left"></i> Back</a>
          <a href="<?php echo site_url('Category/UserRights_View'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>

      <div class="box-body">
        <table id="Viewtable" class="display nowrap" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>UserRole</th>
              <th>Menu</th>
              <th>Submenu</th>  
<th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $cou = 1;
          	foreach($this->MenuClass->SubMenu_(0,0) as $Row)
		{
            ?>
              <tr>
                <td><b><?php echo $cou; ?></b></td>
                <td ><?php echo $Row->UserRole; ?></td>
                <td><?php echo $Row->Menu; ?></td>
                <td ><?php echo $Row->SubMenu; ?></td>   
<td><?php 
if($Row->Act==1)
{
	?>
	 <?php echo form_open_multipart(site_url('Category/UserRights_Save'), 'role="form"'); ?>
      <input type="hidden" name="UserRole_Id" value="<?php echo $Row->Userrole_Id; ?>">
	   <input type="hidden" name="UserRights_Id" value="<?php echo $Row->UserRights_Id; ?>">
	  
	        <input type="hidden" name="Menu_Id" value="<?php echo $Row->Menu_Id; ?>">
			   <input type="hidden" name="SubMenu_Id" value="<?php echo $Row->SubMenu_Id; ?>">
 <input type="hidden" name="status_Id" value="2">
      <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
	   <button type="submit" class="btn btn-flat" name="Abut" value="UPDATE">In-Activate</button>
	  </form>
	<?php
}
else
{
	?>
	 <?php echo form_open_multipart(site_url('Category/UserRights_Save'), 'role="form"'); ?>
      <input type="hidden" name="UserRole_Id" value="<?php echo $Row->Userrole_Id; ?>">
	   <input type="hidden" name="UserRights_Id" value="<?php echo $Row->UserRights_Id; ?>">
	  
	        <input type="hidden" name="Menu_Id" value="<?php echo $Row->Menu_Id; ?>">
			   <input type="hidden" name="SubMenu_Id" value="<?php echo $Row->SubMenu_Id; ?>">
 <input type="hidden" name="status_Id" value="1">
      <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
	   <button type="submit" class="btn btn-flat" name="Abut" value="UPDATE">Activate</button>
	  </form>
	  <?php
}
?></td>				
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
<?php include('Foot.php'); ?>