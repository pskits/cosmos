<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>payhead</h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">payhead Details</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Category/payhead_View'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
                </div>
            </div>
            <?php echo form_open_multipart(site_url('Category/payhead_') . $But . '/', 'role="form"'); ?>
            <input type="hidden" name="pay_head_Id" value="<?php echo @$pay_head_Id; ?>">
            <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div  class="form-group">
                            <label>Pay Head </label>
                            <input type="text" class="form-control input-md" name="pay_head" id="pay_head" placeholder="Enter pay_head" value="<?php echo @set_value('pay_head') . @$pay_head; ?>">
                            <?php echo form_error('pay_head'); ?>
                        </div>
                    </div>  
                </div>
                <div class="box-footer">
                    <a href="<?php echo site_url('Category/Payhead'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
                    <button type="submit" class="btn <?php echo $BtnColor ?> btn-flat" name="Abut" value="<?php echo $But ?>">
                        <i class="<?php echo $Icon ?>"></i> <?php echo $But ?></button>
                </div>
                </form>
            </div>
    </section>
</div>
<?php include('Foot.php'); ?>