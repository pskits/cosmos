<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>
<div class="content-wrapper">
  <section class="content-header">
    <!-- <h1>Supplier</h1> -->
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Create Supplier</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Purchase/Supplier_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
        </div>
      </div>
      <?php echo form_open_multipart(site_url('Purchase/Supplier_Commit'), 'role="form"'); ?>
      <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
      <input type="hidden" name="Supplier_Id" id="Supplier_Id" value="<?php echo @set_value('Supplier_Id') . @$Supplier_Id; ?>" />
      <div class="box-body">
        <div class="row">
        <div class="col-md-6">
            <h3 style="margin-left:5%;" class="box-title">Supplier details</h3>
        
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control input-md" minlength="3" required name="name" placeholder="Enter Supplier name" value="<?php echo @set_value('name') . @$name; ?>">
              <?php echo form_error('name'); ?>
            </div>
         
            <div class="form-group">
              <label>Short Name</label>
              <input type="text" class="form-control input-md" minlength="3" required name="short_name" placeholder="Enter Supplier short name" value="<?php echo @set_value('short_name') . @$short_name; ?>">
              <?php echo form_error('short_name'); ?>
            </div>
            <div class="form-group">
              <label>Registration no</label>
              <input type="text" class="form-control input-md" minlength="3" required name="registration_no" placeholder="Enter Supplier registration_no" value="<?php echo @set_value('registration_no') . @$registration_no; ?>">
              <?php echo form_error('registration_no'); ?>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="Email" class="form-control input-md" required name="Email" placeholder="Enter Supplier Email" value="<?php echo @set_value('Email') . @$Email; ?>">
              <?php echo form_error('Email'); ?>
            </div>
            <div class="form-group">
              <label>code</label>
              <input type="code" class="form-control input-md" required name="code" placeholder="Enter Supplier code" value="<?php echo @set_value('code') . @$code; ?>">
              <?php echo form_error('code'); ?>
            </div>
            <div class="form-group">
              <label>Mobile</label>
              <div class="mobile-number-box">
                <span id="mobilecode" class="mobile-code  form-control"></span>
                <input type="text" class="mobile-input form-control input-md" required minlength="8" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" maxlength="10" name="MobileNo" placeholder="Enter Supplier Mobile No" value="<?php echo @set_value('MobileNo') . @$MobileNo; ?>">
                <?php echo form_error('MobileNo'); ?>
              </div>
            </div>
            <div class="form-group">
              <label>Currency</label>
              <select required class="form-control select2" name="Currency_Id">
                <?php
                $data = $this->GM->Currency();
                $this->GM->Option_($data, 'Currency_Id', 'CurrencyName', '', 'Select', @set_value('Currency_Id') . @$Currency_Id);
                ?>
              </select>
              <?php echo form_error('Currency_Id'); ?>
            </div>
          </div>
          <div class="col-md-6">
            <h3 style="margin-left:5%;" class="box-title">Address</h3>
            <div class="form-group">
              <label>Address</label>
              <textarea class="form-control input-md" rows="3" minlength="10" name="Address" required placeholder="Enter Supplier Address"><?php echo @set_value('Address') . @$Address; ?></textarea>
              <?php echo form_error('Address'); ?>
            </div>
            <div class="form-group">
              <label>City</label>
              <input type="text" class="form-control input-md" name="City" minlength="2" required placeholder="Enter Supplier City" value="<?php echo @set_value('City') . @$City; ?>">
              <?php echo form_error('City'); ?>
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
              <input type="text" class="form-control input-md" name="Postcode" minlength="2" maxlength="15" required onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" placeholder="Enter Supplier Postcode" value="<?php echo @set_value('Postcode') . @$Postcode; ?>">
              <?php echo form_error('Postcode'); ?>
            </div>
            <div class="form-group">
              <label>Tax No</label>
              <input type="text" class="form-control input-md" name="Tax_No" minlength="2" maxlength="15" required placeholder="Enter Supplier Tax No" value="<?php echo @set_value('Tax_No') . @$Tax_No; ?>">
              <?php echo form_error('Tax_No'); ?>
            </div>
            <div class="form-group">
              <label>Geo</label>
              <input type="text" id="geo" onclick="gmap_latlong_modal()" class="form-control input-md" required name="geo" placeholder="Enter geo" value="<?php echo @set_value('geo') . @$geo; ?>">
              <input type="hidden" required name="lat" id="lat">
              <input type="hidden" required name="lng" id="lng">
              <?php echo form_error('geo'); ?>
            </div>
          </div>
          <div class="col-md-6">
            <h3 style="margin-left:5%;" class="box-title">Contact Person details</h3>
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
              <input type="text" class="form-control input-md" minlength="3" required name="Firstname" placeholder="Enter Supplier First_Name" value="<?php echo @set_value('Firstname') . @$Firstname; ?>">
              <?php echo form_error('Firstname'); ?>
            </div>
            <div class="form-group">
              <label>Last Name</label>
              <input type="text" class="form-control input-md" required minlength="3" name="Lastname" placeholder="Enter Supplier Lastname" value="<?php echo @set_value('Lastname') . @$Lastname; ?>">
              <?php echo form_error('Lastname'); ?>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control input-md" required name="contact_email" placeholder="Enter Contact Email" value="<?php echo @set_value('contact_email') . @$contact_email; ?>">
              <?php echo form_error('contact_email'); ?>
            </div>
           
            <div class="form-group">
              <label>contact mobile</label>
              <div class="mobile-number-box">
                <span id="contactmobilecode" class="mobile-code  form-control"></span>
                <input type="text" class="mobile-input form-control input-md" required minlength="8" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" maxlength="10" name="contact_mobile" placeholder="Enter Contact Mobile No" value="<?php echo @set_value('contact_mobile') . @$contact_mobile; ?>">
                <?php echo form_error('contact_mobile'); ?>
              </div>
            </div>
        
          </div>
        </div>
      </div>
      <div class="box-footer">
        <a href="<?php echo site_url('Purchase/Supplier'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
        <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
          <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
      </div>
      </form>
    </div>
  </section>
</div>
<script src="<?php echo base_url('/assets/Js/ajax.js'); ?>"></script>
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
      $("#mobilecode").html('');
      $("#contactmobilecode").html('');      


    }
  }
  function GetCountrycode(CountryId) {
    if (CountryId) {
      $(function() {
        $.ajax({
          type: 'GET',
          url: '<?php echo site_url('Api/CountryCode'); ?> ',
          data: {
            country: CountryId
          },
          success: function(data) {
            $("#mobilecode").html(data);
            $("#contactmobilecode").html(data);  
          }
        });
      });
    }
  }
</script>
<?php include('Foot.php');
include('assets/plugin/gmap_latlong.php'); ?>