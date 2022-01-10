<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
 
  <section class="content-header">
    <h1>SalesExecutve</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Personal details</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Users/SalesExecutve_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
        </div>
      </div>
      <?php echo form_open_multipart(site_url('Users/SalesExecutve_commit') , 'role="form"'); ?>
      <input type="hidden" name="SalesExecutve_Id" value="<?php echo @$SalesExecutve_Id; ?>">
      <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />

      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            
          <div class="form-group">
              <label>Salut</label>
              <select class="form-control select2" required name="Salut_Id">
                <?php
                $data = $this->GM->Salut();
                $this->GM->Option_($data, 'Salut_Id', 'SalutName', '', 'Select', @set_value('Salut_Id') . @$Salut_Id);
                ?>
              </select>
              <?php echo form_error('Salut_Id'); ?>
            </div>
            <div class="form-group">
              <label>First Name</label>
              <input type="text" class="form-control input-md" minlength="3" required name="firstname" placeholder="Enter SalesExecutve First_Name" value="<?php echo @set_value('firstname') . @$firstname; ?>">
              <?php echo form_error('firstname'); ?>
            </div>
            <div class="form-group">
              <label>Last Name</label>
              <input type="text" class="form-control input-md" required minlength="3" name="lastname" placeholder="Enter SalesExecutve lastname" value="<?php echo @set_value('lastname') . @$lastname; ?>">
              <?php echo form_error('lastname'); ?>
            </div>
   
            <div  class="form-group">
              <label>email</label>
              <input type="email"  class="form-control input-md" <?php if(isset($_POST['SalesExecutve_Id'])){echo "readonly";}?> required name="email" placeholder="Enter SalesExecutve email" value="<?php echo @set_value('email') . @$email; ?>">
              <?php echo form_error('email'); ?>
            </div>
            
            <div class="form-group">
              <label>Password</label>
              <input type="Password" class="form-control input-md" required name="Password" placeholder="Enter SalesExecutve Password" >
              <?php echo form_error('Password'); ?>
            </div>
            <div class="form-group">
              <label>Mobile</label>
              <div class="mobile-number-box">
                <span id="mobilecode" class="mobilecode mobile-code  form-control"></span>
                <input type="text" class="mobile-input form-control input-md" required minlength="8" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" maxlength="10" name="mobile" placeholder="Enter SalesExecutve Mobile No" value="<?php echo @set_value('mobile') . @$mobile; ?>">
                <?php echo form_error('mobile'); ?>
              </div>
            </div>
            <div class="form-group">
              <label>Alt mobile No</label>
              <div class="mobile-number-box">
                <span id="mobilecode" class="mobilecode mobile-code  form-control"></span>
                <input type="text" class="mobile-input form-control input-md" required minlength="8" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" maxlength="10" name="alt_mobile" placeholder="Enter SalesExecutve Alt mobile No" value="<?php echo @set_value('alt_mobile') . @$alt_mobile; ?>">
                <?php echo form_error('alt_mobile'); ?>
              </div>
            </div>       
           
            <div class="form-group">
              <label>nationality</label>
              <input type="text" class="form-control input-md" required minlength="3" name="nationality" placeholder="Enter SalesExecutve nationality" value="<?php echo @set_value('nationality') . @$nationality; ?>">
              <?php echo form_error('nationality'); ?>
            </div>
               
          <div class="form-group">
              <label>gender</label>
              <select class="form-control select2" required name="gender">
                <?php
                $data = $this->GM->gender();
                $this->GM->Option_($data, 'Gender_Id', 'GenderName', '', 'Select', @set_value('gender') . @$gender);
                ?>
              </select>
              <?php echo form_error('gender'); ?>
            </div>
            </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Date of Birth</label>
              <input type="text" class="form-control input-md Date" readonly required  name="dateofbirth" placeholder="Enter SalesExecutve dateofbirth" value="<?php @$_POST['dateofbirth']= $this->GM->DateSplitshowWithoutConvert(@$_POST['dateofbirth']);  echo @set_value('dateofbirth') . @$dateofbirth; ?>">
              <?php echo form_error('dateofbirth'); ?>
            </div>
            </div>
            <div class="col-md-6">
         
            <div class="form-group">
              <label>Address</label>
              <textarea class="form-control input-md" rows="3" minlength="10" name="address" required placeholder="Enter SalesExecutve address"><?php echo @set_value('address') . @$address; ?></textarea>
              <?php echo form_error('address'); ?>
            </div>
            <div class="form-group">
              <label>city</label>
              <input type="text" class="form-control input-md" name="city" minlength="2" required placeholder="Enter SalesExecutve city" value="<?php echo @set_value('city') . @$city; ?>">
              <?php echo form_error('city'); ?>
            </div>
            <div class="form-group">
              <label>Country</label>
              <select onchange='Getstate();' id="Countryid" required class="form-control select2" name="Country_Id">
                <?php
                $data = $this->GM->Country();
                $this->GM->Option_($data, 'Country_Id', 'CountryName', '', 'Select', @set_value('Country_Id') . @$Country_Id);
                ?>
              </select>
              <?php echo form_error('Country_Id'); ?>
            </div>
            <div class="form-group">
              <label>State</label>
              <select id="statelist" class="form-control select2" required name="State_Id">
              </select>
              <?php echo form_error('State_Id'); ?>
            </div>            
            <div class="form-group">
              <label>Postal code</label>
              <input type="text" class="form-control input-md" name="postcode" minlength="2" maxlength="15" required onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" placeholder="Enter SalesExecutve Postal Code" value="<?php echo @set_value('postcode') . @$postcode; ?>">
              <?php echo form_error('postcode'); ?>
            </div>
            <div class="form-group">
              <label>Joining Date</label>
              <input type="text" class="form-control input-md Date" readonly name="Joining_date" minlength="2" maxlength="15" required onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" placeholder="Enter SalesExecutve joining date" value="<?php @$_POST['Joining_date']= $this->GM->DateSplitshowWithoutConvert(@$_POST['Joining_date']);  echo @set_value('Joining_date') . @$Joining_date; ?>">
              <?php echo form_error('Joining_date'); ?>
            </div>
            <div class="form-group">
              <label>Status</label>
              <select class="form-control select2" required name="Status_Id">
                <?php
                $data = $this->GM->Status();
                $this->GM->Option_($data, 'Status_Id', 'StatusName', '', 'Select', @set_value('Status_Id') . @$Status_Id);
                ?>
              </select>
              <?php echo form_error('Status_Id'); ?>
            </div>
          </div>
      
          </div>
        </div>
      </div>
      <div class="box-footer">
        <a href="<?php echo site_url('Users/SalesExecutve'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
        <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
          <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
      </div>
      </form>
    </div>
  </section>
</div>
<?php include('Includes/Foot.php'); ?>
<script>
  window.onload = function() {
    Getstate();
  };

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
            GetCountrycode(CountryId);

          }
        });
      });
    } else {
      $("#statelist").html('');
      $(".mobilecode").html('');
    }
  }

  function GetCountrycode(CountryId) {
    if (CountryId) {
      $(function() {
        $.ajax({
          type: 'GET',
          url: '<?php echo site_url('API/CountryCode'); ?> ',
          data: {
            country: CountryId
          },
          success: function(data) {
            $(".mobilecode").html(data);


          }
        });
      });
    }
  }
</script>