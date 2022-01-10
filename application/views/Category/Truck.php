<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Truck</h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Truck</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Category/Truck_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
                </div>
            </div>
      
            <?php echo form_open_multipart(site_url('Category/Truck_') . $But . '/', 'role="form"'); ?>
            <input type="hidden" name="Truck_Id" value="<?php echo @$Truck_Id; ?>">
            <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                   
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control input-md" minlength="3" required name="name" placeholder="Enter Truck First_Name" value="<?php echo @set_value('name') . @$name; ?>">
                            <?php echo form_error('name'); ?>
                        </div>
                        <div class="form-group">
                            <label>Code</label>
                            <input type="text" class="form-control input-md" required minlength="3" name="code" placeholder="Enter Truck code" value="<?php echo @set_value('code') . @$code; ?>">
                            <?php echo form_error('code'); ?>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control input-md" rows="3" minlength="10" name="description" required placeholder="Enter Truck description"><?php echo @set_value('description') . @$description; ?></textarea>
                            <?php echo form_error('description'); ?>
                        </div>
                        <div class="form-group">
                            <label>Registration no</label>
                            <input type="text" class="form-control input-md" required name="registration_no" placeholder="Enter Truck registration_no" value="<?php echo @set_value('registration_no') . @$registration_no; ?>">
                            <?php echo form_error('registration_no'); ?>
                        </div>
                        <div class="form-group">
                            <label>Driver Incharge</label>
                            <select id="Driver_Id" class="form-control select2" required name="Driver_Id">
                                <?php
                                $data = $this->GM->Driver($status_id = "1", $id = "0");
                                $this->GM->Option_($data, 'Driver_Id', 'email', '', 'Select', @set_value('Driver_Id') . @$Driver_Id);
                                ?>
                            </select>
                            <?php echo form_error('Driver_Id'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Insurance no</label>
                            <input type="text" class="form-control input-md" required name="insurance_no" placeholder="Enter Truck registration_no" value="<?php echo @set_value('registration_no') . @$registration_no; ?>">
                            <?php echo form_error('insurance_no'); ?>
                        </div>
                        <div class="form-group">
                            <label>Insurance Renewal</label>
                            <div class="input-group">
                                <input type="text" readonly class="form-control input-sm Date" name="insurance_renewal" id="insurance_renewal" placeholder="Enter insurance renewal" value="<?php echo @set_value('insurance_renewal') . @$insurance_renewal; ?>">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>
                            <?php echo form_error('insurance_renewal'); ?>
                        </div>
                        <div class="form-group">
                            <label>Mulkiya no</label>
                            <input type="text" class="form-control input-md" required name="mulkiya_no" placeholder="Enter Truck mulkiya no" value="<?php echo @set_value('mulkiya_no') . @$mulkiya_no; ?>">
                            <?php echo form_error('mulkiya_no'); ?>
                        </div>
                        <div class="form-group">
                            <label>Mulkiya Renewal</label>
                            <div class="input-group">
                                <input type="text" readonly class="form-control input-sm Date" name="mulkiya_renewal" id="mulkiya_renewal" placeholder="Enter mulkiya renewal " value="<?php echo @set_value('mulkiya_renewal') . @$mulkiya_renewal; ?>">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>
                            <?php echo form_error('mulkiya_renewal'); ?>
                        </div>
                        <div class="form-group">
                            <label>Dimension</label>
                            <div class="row">
                                <div class="col-xs-3">
                                    <input class="form-control" id="val1" onchange="dimention();" value="0" onfocus="dimentionclr();" min="01" required step="1" id="ex1" type="number">
                                </div>
                                <div class="col-xs-3">
                                    <input class="form-control" id="val2" onchange="dimention();" value="0" onfocus="dimentionclr();" min="01" step="1" required id="ex1" type="number">
                                </div>
                                <div class="col-xs-3">
                                    <input class="form-control" id="val3" onchange="dimention();" value="0" onfocus="dimentionclr();" min="01" step="1" id="ex2" required type="number">
                                </div>
                                <div class="col-xs-3">
                                    <input class="form-control" id="val4" onchange="dimention();" value="0" onfocus="dimentionclr();" min="01" step="1" id="ex3" required type="number">
                                </div>
                            </div>
                            <br />
                            <input type="text" id="dimension" readonly class="form-control input-md" required name="dimension" placeholder="Enter Truck dimension" value="<?php echo @set_value('dimension') . @$dimension; ?>">
                            <?php echo form_error('dimension'); ?>
                        </div>
                        <div class="form-group">
                            <label>Volume</label>
                            <input type="text" readonly class="form-control input-md" id="volume" required name="volume" placeholder="Enter Truck volume" value="<?php echo @set_value('volume') . @$volume; ?>">
                            <?php echo form_error('volume'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <a href="<?php echo site_url('Category/Truck'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
                <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
                    <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
            </div>
            </form>
        </div>
    </section>
</div>
<?php include('Foot.php'); ?>
<script>
    function dimention() {
        var val1 = "0",
            val2 = "0",
            val3 = "0",
            val4 = "0",
            volume = "0",
            dimention = "";
        val1 = document.getElementById('val1').value;
        val2 = document.getElementById('val2').value;
        val3 = document.getElementById('val3').value;
        val4 = document.getElementById('val4').value;
        volume = val1 * val2 * val3 * val4;
        document.getElementById('dimension').value = val1 + ' x ' + val2 + ' x ' + val3 + ' x ' + val4;
        if (volume) {
            document.getElementById('volume').value = volume;
        } else {
            document.getElementById('volume').value = "";
        }
    }
    dimentionclr();

    function dimentionclr() {
        document.getElementById('dimension').value = "";
        dimention();
    }
</script>