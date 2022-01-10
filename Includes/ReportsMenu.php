<header class="main-header">
  <a href="<?php echo site_url(''); ?>" class="logo" style="background-color: <?php echo $_SESSION['dbcolor'] ?>;">
    <span class="logo-mini"><img src="<?php echo base_url('assets/Pics/icon.png'); ?>" alt="Cosmo Pumps"></span>
    <span class="logo-lg"><img src="<?php echo base_url('assets/Pics/loginlogo.png'); ?>" alt="Cosmo Pumps"></span>
  </a>
  <nav class="navbar navbar-static-top" style="background-color: <?php echo $_SESSION['dbcolor'] ?>;">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar">
      </span> <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>
    <div class="pull-left row" style="padding:8px 0px 0px 8px;">
      <div class="col-sm-6 pull-left">
        <a href="<?php echo base_url('cosmo.php/Welcome/Switch_Office'); ?>" class="btn btn-danger"> <i class="fa fa-toggle-on" aria-hidden="true"></i> Switch </a>
      </div>
    </div>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo base_url('assets/Pics/User.jpg'); ?>" class="user-image" alt="User Image">
            <span class="hidden-xs"></span>
          </a>
          <ul class="dropdown-menu">
            <li class="user-header" style="    height: 100px;">
              <p> Session Expires <br> @ <br> <?php echo $this->GM->DateTimeSplitshow($exptimecheck); ?> </p>
            </li>
            <li class="user-footer">
              <div class="pull-left"> <a href="#" class="btn btn-block btn-flat">Change Password</a> </div>
              <div class="pull-right"> <a href="<?php echo site_url('Welcome/Logout'); ?>" class="btn btn-block btn-flat">Signout</a> </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="image">
        <h4 class="center text-center">
          <?php echo $_SESSION['officename']; ?>
        </h4>
      </div>
    </div>
    <ul class="sidebar-menu" data-widget="tree">
      <?php
      echo $_SESSION['RenderedMenu']['ReportsMenu'];
      ?>
  </section>
</aside>