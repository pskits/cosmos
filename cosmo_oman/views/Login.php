<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cosmo Pumps</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url('assets/Css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/Css/font-awesome.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/Css/AdminLTE.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/Css/googlefont.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/Css/Custom.css'); ?>">
</head>
<body class="hold-transition " style="background: #ececec;height: auto;">
  <?php echo $this->agent->browser() . ' ' . $this->agent->version() . '<br>'; ?>
  <!--Main Content -->
  <div class="site-login">
    <div style="background-color: #333;" class="login-box">
      <!--login-logo -->
      <div class="login-logo">
        <a href="<?php echo site_url(); ?>" class="logo">
          <span class="logo-lg"><img src="<?php echo base_url('assets/Pics/loginlogo.png'); ?>" alt="Cosmo Pumps"></span>
        </a>
      </div>      
      <!--End of login-logo -->
      <!--login-Box -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in</p>
        <form id="login-form" action="<?php echo site_url('Welcome/Login'); ?>" method="post">
          <div class="form-group field-loginform-email required <?php echo isset($Userclass) ? $Userclass : '' ?>">
            <label class="control-label" for="loginform-email">Email</label>
            <input type="text" id="loginform-email" class="form-control" name="Username" autofocus="" aria-required="true" aria-invalid="true">
            <p class="help-block help-block-error"><?php echo isset($UserErrorMessage) ? $UserErrorMessage : '' ?></p>
          </div>
          <div class="form-group field-loginform-password required <?php echo isset($Passwordclass) ? $Passwordclass : '' ?>">
            <label class="control-label" for="loginform-password">Password</label>
            <input type="password" id="loginform-password" class="form-control" name="Password" value="" aria-required="true" aria-invalid="true">
            <p class="help-block help-block-error"><?php echo isset($PasswordErrorMessage) ? $PasswordErrorMessage : '' ?></p>
          </div>
          
          <div class="form-group field-loginform-password required has-error">
            <p class="help-block help-block-error"><?php echo isset($ErrorMessage) ? $ErrorMessage : '' ?></p>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary" name="login-button">Login</button>
          </div>
        </form>
      </div>
      <!--End of login-Box -->
    </div>
  </div>
  <!--End of Main Content -->
  <script src="<?php echo base_url('assets/Js/jquery.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/Js/bootstrap.min.js'); ?>"></script>
</body>
</html>