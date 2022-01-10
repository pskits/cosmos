<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');

?>

<div class="content-wrapper">
<section class="content-header">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Production  View</h3>       
        <div class="box-tools pull-right">
           <a href="<?php echo site_url('Production/Production'); ?>" class="btn btn-flat bg-grayy" style="background:#f9f9f9;color:#1a2226;"><i class="fa fa-caret-left"></i> Back</a>
        
          <a href="<?php echo site_url('Production/Production_View'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>
      
      <div class="box-body">
        <br>
        <form class="row form-inline">
        <div class="col-md-1"></div>
      <div class="col-md-3">
            <div class="form-group">
              <label class="forminline-label">From : </label>
              <input type="text" class="form-control input-md Date" readonly required name="fromdate" placeholder="Enter Admin fromdate" value="<?php echo $fromdate=(isset($_REQUEST['fromdate'])) ? $_REQUEST['fromdate'] : date('d-m-Y'); ?> ">
              <?php echo form_error('fromdate'); ?>
            </div>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="forminline-label">To : </label>
              <input type="text" class="form-control input-md Date" readonly required name="todate" placeholder="Enter Admin todate" value="<?php echo $todate=(isset($_REQUEST['todate'])) ? $_REQUEST['todate'] : date('d-m-Y'); ?> ">
              <?php echo form_error('todate'); ?>
            </div>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-2">
          <div class="form-group">          
          <button type="submit" class="btnbg-black text-white btn-flat" name="Abut" value="Show">
        <i class="fa fa-cloud-download"></i>Show</button>
          </div>
          </div>
</form>
     <hr class="horizondal-splitter">
        <table id="Viewtable" class="display nowrap" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Production No</th>
              <th>Office</th>                 
              <th>BatchNo</th>
              <th>Production date</th>      
              <th>Production Completed Date</th>      
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $cou = 1;
            $from_date=$this->GM->DateSplit($fromdate);            
            $to_date=$this->GM->DateSplit($todate);
            foreach ($this->GM->Production($status="1",$Id="0", $from_date  , $to_date ) as $Row) {
            ?>
              <tr>
                <td ><b><?php echo $cou; ?></b></td>
                <td ><?php echo $Row->Production_Code; ?></td>
                <td ><?php echo $Row->office_Name; ?></td>               
               
                <td ><?php echo $Row->BatchNo; ?></td>
                <td ><?php echo $Row->Production_date_Dateformatted; ?></td>
                <td ><?php echo $Row->Production_Complete_date_Dateformatted; ?></td>
                <td >
                  <a <?php echo "href='" . site_url('') . "/" . "Production/ProductionProducts/?Key=" . base64_encode($Row->Production_Id) . "'"; ?> ><span class="badge"><i class="fa fa-eye"></i>&nbsp; View</span>
                  </a>
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
 function Getstate() {
    var e = document.getElementById("Countryid");
    var CountryId = e.options[e.selectedIndex].value;
    if (CountryId) {
      $(function() {
        $.ajax({
          type: 'GET',
          url: '<?php echo site_url('Api/State'); ?> ',
          data: {
            country: CountryId
          },
          success: function(data) {
            $("#statelist").html(data);
            loaddatatable();
          }
        });
      });
    } else {
      $("#statelist").html('');
 
    }
  }
</script>