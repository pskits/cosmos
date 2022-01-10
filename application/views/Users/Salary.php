<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Joining Salary Details</h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Enter Details</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Users/Salary_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
                </div>
            </div>
            <?php echo form_open_multipart(site_url('Users/Salary_Save') . '/', 'role="form"'); ?>
            <input type="hidden" name="loginUser_Id" id="loginUser_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
            <input type="hidden" name="Salary_Id" id="Salary_Id" value="<?php echo  @set_value('Salary_Id') . @$Salary_Id; ?>" />
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pay Type</label>
                            <select id="pay_type_Id" required class="form-control select2" name="pay_type_Id">
                                <?php
                                $data = $this->GM->paytype($status = "1", $id = "0");
                                $this->GM->Option_($data, 'pay_type_Id', 'pay_type', '', 'Select', @set_value('pay_type_Id') . @$pay_type_Id);
                                ?>
                            </select>
                            <?php echo form_error('pay_type_Id'); ?>
                        </div>
                        <div class="form-group">
                            <label>Salary Starting From</label>
                            <input type="text" readonly class="form-control input-md Date" id="salary_from_date" required name="salary_from_date" placeholder="Enter salary_from_date" value="<?php if (empty($salary_from_date)) {
                                                                                                                                                                                                    $salary_from_date = date('d-m-Y');
                                                                                                                                                                                                }
                                                                                                                                                                                                echo date('d-m-Y', strtotime(@set_value('salary_from_date') . @$salary_from_date)); ?>">
                            <?php echo form_error('salary_from_date'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>UserRole</label>
                            <select id="UserRole_Id" onchange="Getusers();" required class="form-control select2" name="UserRole_Id">
                                <?php
                                $data = $this->GM->UserRole(1, 0, 1, 0);
                                $this->GM->Option_($data, 'UserRole_Id', 'UserRole', '', 'Select', @set_value('UserRole_Id') . @$UserRole_Id);
                                ?>
                            </select>
                            <?php echo form_error('UserRole_Id'); ?>
                        </div>
                        <div class="form-group">
                            <label>User email</label>
                            <select id="User_Id" required class="form-control select2" name="User_Id">
                            </select>
                            <?php echo form_error('User_Id'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
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
        Getusers();
    };
    function Getusers() {
        var e = document.getElementById("UserRole_Id");
        var UserRole_Id = e.options[e.selectedIndex].value;
        var User_Id = '<?php echo  @set_value('User_Id') . @$User_Id; ?>';
        if (UserRole_Id) {
            $(function() {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url('Api/Userlist'); ?> ',
                    data: {
                        UserRole_Id: UserRole_Id,
                        Status_Id: 1,
                        User_Id: User_Id
                    },
                    success: function(data) {
                        $("#User_Id").html(data);
                    }
                });
            });
        } else {
            $("#User_Id").html('');
        }
    }
</script>