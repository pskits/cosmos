<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Change Password</h1>
    </section>
    <section class="content">
        <div class="login-box-body">
            <p class="login-box-msg"></p>
            <form id="login-form" action="<?php echo site_url('Welcome/Alter_Password'); ?>" method="post">
            <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />

                <div class="form-group field-password-email required ">
                    <label class="control-label" for="password-email"> New Password</label>
                    <input type="password" id="password-email" class="form-control" name="password" autofocus="" aria-required="true" aria-invalid="true">
                </div>
                <div class="form-group field-Confirm-password required ">
                    <label class="control-label" for="Confirm-password">Confirm Password</label>
                    <input type="password" id="Confirm-password" class="form-control" name="ConfirmPassword" value="" aria-required="true" aria-invalid="true">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="login-button">Change Password</button>
                </div>
            </form>
        </div>
    </section>
</div>
<?php include('Includes/Foot.php'); ?>