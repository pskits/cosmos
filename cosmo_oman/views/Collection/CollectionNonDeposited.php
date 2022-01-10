<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
 
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Non-Deposited Collection</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Collection/CollectionNonDeposited_View'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>
      <div class="box-body">
        <br>
        <form class="row form-inline">
          <div class="col-md-1"></div>
          <div class="col-md-3">
             <div class="form-group">
                            <label>User</label>
                            <select id="collectedUser_Id"  required class="form-control select2" name="collectedUser_Id">
                                <?php
								  $_POST['collectedUser_Id'] = (isset($_REQUEST['collectedUser_Id'])) ? $_REQUEST['collectedUser_Id'] : 0; 
                                $data = $this->GM->logincredentialoffice_list(1, 0, 0, 0, $_SESSION['currentdatabasename']);
                                $this->GM->Option_($data, 'logincredentials_Id', 'Email', '0', 'Select', @set_value('collectedUser_Id') . @$collectedUser_Id);
                                ?>
                            </select>
                            <?php echo form_error('collectedUser_Id'); ?>
                        </div>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-3">
            <div class="form-group">
                            <label>Amount Mode</label>
							<br>
                            <select id="AmountMode_id"  required class="form-control select2" name="AmountMode_id">
                                <?php
								 $_POST['AmountMode_id'] = (isset($_REQUEST['AmountMode_id'])) ? $_REQUEST['AmountMode_id'] : 0; 
                                $data = $this->GM->AmountMode();
                                $this->GM->Option_($data, 'AmountMode_Id', 'AmountModeName', '', 'Select', @set_value('AmountMode_id') . @$AmountMode_id);
                                ?>
                            </select>
                            <?php echo form_error('AmountMode_id'); ?>
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
              <th>CollectionNo</th>
              <th>Collection Date</th>
              <th>Collected User</th>
              <th>Dealer</th>
              <th>Mode</th>
              <th>Amount</th>            
              
            </tr>
          </thead>
          <tbody>
            <?php
			if((isset($_GET['collectedUser_Id']))&&(isset($_GET['AmountMode_id'])))
			{
				
            $cou = 1;
            foreach ($this->GM->CollectionNotDeposited($_GET['collectedUser_Id'], $_GET['AmountMode_id']) as $Row) { 
            ?>
              <tr>
                <td><b><?php echo $cou; ?></b></td>
                <td><a <?php echo "href='" . site_url('') . "/" . "Collection/Collection_invoice/?Key=" . base64_encode($Row->Colletion_Id) . "'"; ?>><?php echo $Row->Collection_no; ?></a></td>
                <td><?php echo $Row->Collection_Dateformatted; ?></td>
                <td><?php echo $Row->collecteduseremail; ?></td>
                <td><?php echo $Row->name; ?></td>
                <td><?php echo $Row->AmountModeName; ?></td>
                <td><?php echo $Row->amount; ?></td>
               
              </tr>
            <?php
              $cou++;
            }
			}
			
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
<?php include('Includes/Foot.php'); ?>