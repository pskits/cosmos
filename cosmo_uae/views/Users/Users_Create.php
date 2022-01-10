<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Users</h1>
    </section>
    <section class="content">
        <div class="box box-form box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">User Switch Cration details</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('Users/User_switchrights'); ?>" class="btn btn-flat"><i class="fa fa-search"></i> View</a>
                </div>
            </div>
            <?php echo form_open_multipart(site_url('Users/User_switchrights_Commit'), 'role="form"'); ?>
            <input type="hidden" name="office_dbname" value="<?php echo @$office_dbname; ?>">
            <input type="hidden" name="User_Id" id="User_Id" value="<?php echo $this->session->userdata['cosmolog']['UId'] ?>" />
            <div class="box-body">
                <table id="Viewtable" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Email</th>
                            <th>Office Name</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $logincredentials_Id = base64_decode($_GET['Key']);
                        $data =$this->GM->logincredential_list(1, $logincredentials_Id);
                        foreach ( $data as $Row) {
                        ?>
                       
                            <tr>
                                <td><b>1</b></td>
                                <td> <?php echo $Row->Email; ?></td>
                                <td><?php echo $Office_name; ?></td>
                                <td><?php echo $Row->UserRole; ?></td>
                            </tr>
                        <?php
                        }
                    ?>
                    </tbody>
                </table>
                <br><br><br>
                <div class="row">
                    <div class="col-md-6">
                    <input type="hidden" name="email" value="<?php echo $Row->Email;?>">
                        <input type="hidden" name="UserRole_Id" required value="<?php echo $Row->UserRole_Id;?>">                                         
                        <input type="hidden" name="office_dbname" required value="<?php echo $office_dbname;?>">
                          <input type="hidden" name="logincredentials_Id" required value="<?php echo $logincredentials_Id;?>">
                   
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <a href="<?php echo site_url('Users/Users'); ?>" class="btn btn-flat bg-red"><i class="fa fa-times"></i> Reset</a>
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