<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>

<style>
  .text-center {
    color: #fff;
  }

  h1 {
    color: #fff;
    font-size: 25px;
  }
</style>
<div class="content-wrapper">

  <section class="content">


    <section class="container row">
      <?php
      $dbdata = $this->GM->Switchaccesslist($officetype = "1", $status = "1",  $this->session->userdata['cosmolog']['UId']);

      foreach ($dbdata as $Row) {

      ?>
        <a href="<?php echo site_url('Welcome/Switch_Office_Commit') . '/?Key=' . base64_encode($Row->office_Id); ?>">
          <div class="col-md-3 card  text-white text-center" style="background-color:<?php echo $Row->office_theme; ?>;height:100px;line-height:100px;">
            <div class="card-body">
              <h1><?php echo $Row->office_Name; ?> <br>( <?php echo $Row->office_ShortName; ?>)</h1>
            </div>
          </div>
        </a>
      <?php
      }
      ?>

    </section>
    <br><br><br>

    <section class="container row">
      <?php
      $dbdata = $this->GM->Switchaccesslist($officetype = "2", $status = "1",  $this->session->userdata['cosmolog']['UId']);

      foreach ($dbdata as $Row) {

      ?>
        <a href="<?php echo site_url('Welcome/Switch_Office_Commit') . '/?Key=' . base64_encode($Row->office_Id); ?>">
          <div class="col-md-3 card  text-white text-center" style="background-color:<?php echo $Row->office_theme; ?>;height:100px;line-height:100px;">
            <div class="card-body">
              <h1><?php echo $Row->office_Name; ?><br> (<?php echo $Row->office_ShortName; ?>)</h1>
            </div>
          </div>
          <div class="col-md-1"></div>
        </a>
      <?php
      }
      ?>

    </section>
    <br><br><br>
    <section class="container row">

      <?php
      $dbdata = $this->GM->Switchaccesslist($officetype = "3", $status = "1",  $this->session->userdata['cosmolog']['UId']);

      foreach ($dbdata as $Row) {

      ?>
        <a href="<?php echo site_url('Welcome/Switch_Office_Commit') . '/?Key=' . base64_encode($Row->office_Id); ?>">
          <div class="col-md-3 card  text-white text-center" style="background-color:<?php echo $Row->office_theme; ?>;height:100px;line-height:100px;">
            <div class="card-body">
              <h1><?php echo $Row->office_Name; ?><br> (<?php echo $Row->office_ShortName; ?>)</h1>
            </div>
          </div>
        </a>

      <?php
      }
      ?>

    </section>
  </section>

  </section>
</div>
<?php include('Includes/Foot.php'); ?>