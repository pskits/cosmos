<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Paytype</h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Paytype Details</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Category/Paytype_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
                </div>
            </div>
            <?php echo form_open_multipart(site_url('Category/Paytype_') . $But . '/', 'role="form"'); ?>
            <input type="hidden" name="Paytype_Id" value="<?php echo @$Paytype_Id; ?>">
            <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
            <div class="box-body">
                <div class="row">
                    <?php
                    print_r(validation_errors());
                    ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Paytype Name</label>
                            <input type="text" class="form-control input-md" minlength="1" required name="PaytypeName" placeholder="Enter PaytypeName" value="<?php echo @set_value('PaytypeName') . @$PaytypeName; ?>">
                            <?php echo form_error('PaytypeName'); ?>
                        </div>
                        <div  id="calc_till_noofdays_segment" style="display: none;" class="form-group">
                            <label>Calc Till No of Days(in Days)</label>
                            <input type="number" required value="1" step="1" class="form-control input-md" min="0" required name="calc_till_noofdays" placeholder="Enter calc_till_noofdays" value="<?php echo @set_value('calc_till_noofdays') . @$calc_till_noofdays; ?>">
                            <?php echo form_error('calc_till_noofdays'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label>Paymode</label>
                            <select id="paymode_id" onchange="paymode(this.value)" required class="form-control select2" name="paymode_id">
                                <?php
                                $data = $this->GM->paymode();

                                $this->GM->Option_($data, 'paymode_id', 'paymode', '', 'Select', @set_value('paymode_id') . @$paymode_id);
                                ?>
                            </select>
                            <?php echo form_error('paymode_id'); ?>
                        </div>
                        <div id="starting_date_segment" style="display: none;" class="form-group">
                            <label>Starting Date(1-28) </label>
                            <input type="number" max="28" min="1" value="1" class="form-control input-md"  name="starting_date" id="starting_date" placeholder="Enter starting_date" value="<?php echo @set_value('starting_date') . @$starting_date; ?>">
                            <?php echo form_error('starting_date'); ?>
                        </div>
                        <div id="starting_day_segment" style="display: none;" class="form-group">
                            <label>Starting Day</label>
                            <select name="starting_day"  id="starting_day" class="form-control select2">
                                <option value="<?php echo null; ?>">None</option>
                                <?php
                                $data = $this->GM->daylist();
                                foreach ($data as $key) {
                                ?>
                                    <option value="<?php echo $key; ?>"><?php echo $key; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <?php echo form_error('starting_day'); ?>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="<?php echo site_url('Category/Paytype'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
                    <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
                        <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
                </div>
                </form>
            </div>
    </section>
</div>
<script>
    function paymode(paymodevalue) {
     
        document.getElementById('starting_day_segment').style.display = 'none';
        document.getElementById('starting_date_segment').style.display = 'none';
        document.getElementById('calc_till_noofdays_segment').style.display = 'none';
        document.getElementById('starting_day_segment').required = false;
        document.getElementById('starting_date_segment').required = false;
        if (paymodevalue == 1) {
            document.getElementById('starting_day_segment').required = true;
            document.getElementById('starting_day_segment').style.display = 'block';
            document.getElementById('calc_till_noofdays_segment').style.display = 'block';
        } else if (paymodevalue == 2) {
            document.getElementById('starting_date_segment').required = true;
            document.getElementById('starting_date_segment').style.display = 'block';
            document.getElementById('calc_till_noofdays_segment').style.display = 'block';
        }
        document.getElementById('starting_date').value = null;
        $('#starting_day').val(null).trigger('change');
        
    }

    paymode(<?php echo  @set_value('paymode_id') . @$paymode_id;?>);
  
</script>
<?php include('Foot.php'); ?>