<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>UserRights(Web Portal)</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Enter Details</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Category/UserRights_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
        </div>
      </div>
     
      <?php echo form_open_multipart(site_url('Category/UserRights_') . $But . '/', 'role="form"'); ?>
      <input type="hidden" name="UserRights_Id" value="<?php echo @$UserRights_Id; ?>">
	   <input type="hidden" name="status_Id" value="1">
	  
      <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
      <div class="box-body">
        <div class="row">
        <div class="col-md-12">
            <div class="form-group">
              <label>UserRole</label>
              <select id="UserRole_Id" required class="form-control select2" name="UserRole_Id">
                <?php
                $data = $this->GM->UserRole(1,0,1,0);

                $this->GM->Option_($data, 'UserRole_Id', 'UserRole', '', 'Select', @set_value('UserRole_Id') . @$UserRole_Id);
                ?>
              </select>
              <?php echo form_error('UserRole_Id'); ?>
            </div>
          </div>


          <div class="col-md-6">
            <div class="form-group">
              <label>Menu</label>
              <select id="Menu_Id" onchange="GetSubmenu();" required class="form-control select2" name="Menu_Id">
                <?php
                $data = $this->MenuClass->Get_Menu_();

                $this->GM->Option_($data, 'Menu_Id', 'Menu', '', 'Select', @set_value('Menu_Id') . @$Menu_Id);
                ?>
              </select>
              <?php echo form_error('Menu_Id'); ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>SubMenu</label>
              <select id="SubMenu_Id" required class="form-control select2" name="SubMenu_Id">
             
              </select>
              <?php echo form_error('SubMenu_Id'); ?>
            </div>
          </div>

        </div>
      </div>
      <div class="box-footer" >
        <a href="<?php echo site_url('Category/UserRights'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
        <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
          <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
      </div>
      </form>
    </div>
  </section>
</div>


<?php include('Foot.php'); ?>

<script>
    window.onload = function() {
        GetSubmenu();
    };

    function GetSubmenu() {
        var e = document.getElementById("Menu_Id");
        var Menu_Id = e.options[e.selectedIndex].value;
        if (Menu_Id) {
            $(function() {
                $.ajax({
                    type: 'GET',
                    url: '<?php echo site_url('Category/Submenulist'); ?> ',
                    data: {
                        Menu_Id: Menu_Id
                    },
                    success: function(data) {
                        $("#SubMenu_Id").html(data);                     

                    }
                });
            });
        } else {
            $("#SubMenu_Id").html('');           
        }
    }
</script>