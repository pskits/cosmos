<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');

?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Offerlist</h1>
  </section>
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Offerlist View</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Catalog/Offerlist'); ?>" class="btn btn-flat bg-grayy" style="background:#f9f9f9;color:#1a2226;"><i class="fa fa-caret-left"></i> Back</a>
          <a href="<?php echo site_url('Catalog/Offerlist_View'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>

        </div>
      </div>

      <div class="box-body">
        <table id="Viewtable" class="display nowrap" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>OfferName</th>
              <th>Code</th>
              <th>Status</th>
              <th>Order Quantity</th>
              <th>Offer Quantity</th>
              <th>Credit Period</th>
              <th>Allow Multiple</th>
              <th>OfferType_name</th>
              <th>Offer Restrictions Name</th>
              <th>Sorting</th>

            </tr>
          </thead>
          <tbody>
            <?php
            $status = "0";
            $offertype_id = "0";
            $offerrestriction_id = "0";
            $id = "0";
            $cou = '1';
            foreach ($this->GM->Offerlist($status, $offertype_id, $offerrestriction_id, $id) as $Row) {
            ?>
              <tr>
                <td ><b><?php echo $cou; ?></b></td>
                <td ><?php echo $Row->OfferName; ?></td>
                <td ><?php echo $Row->Code; ?></td>
                <td ><?php echo $Row->StatusName; ?></td>
                <td ><?php echo $Row->OrderQuantity; ?></td>
                <td ><?php echo $Row->OfferQuantity; ?></td>
                <td ><?php echo $Row->CreditPeriod; ?></td>
                <td ><?php echo ($Row->AllowMultiply == '1') ? 'Yes' : 'No'; ?></td>
                <td ><?php echo $Row->OfferType_name; ?></td>
                <td ><?php echo $Row->OfferRestrictionsName; ?></td>
                <td ><?php echo $Row->Sorting; ?></td>



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