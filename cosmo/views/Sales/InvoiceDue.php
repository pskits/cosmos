<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Includes/Head.php');
include('Includes/Menu.php');
?>
<div class="content-wrapper">
 
  <section class="content">
    <div class="box box-form box-solid">
      <div class="box-header with-bInvoice">
        <h3 class="box-title">Invoice Due View</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo site_url('Sales/InvoiceDue'); ?>" class="btn btn-flat "><i class="fa fa-refresh"></i> Refresh</a>
        </div>
      </div>
      <div class="box-body">
        <table id="Viewtable" class="display nowrap" style="width:100%">
          <thead>
		   <tr >
		 <th style="text-align:center;" Colspan="6"> Due Details</th>
               
              <th style="text-align:center;" colspan="5">Amount <br> <sub><?php echo $_SESSION['Currencycode'];?></sub></th>       
		  </tr>
            <tr>             
			  <th>Status</th>
              <th>Invoice No</th>
			    <th>Dealer Name</th>   
			   <th>Area</th>
              <th>Invoice Date</th>
              <th>Due Date</th>          
            
              <th>Due </th>           
              <th>Invoice </th>
              <th>Collected </th>
              <th>Sales Return </th>           
<th>Credit Note  </th>
            </tr>
            
          </thead>
          <tbody>
            <?php          
            foreach ($this->GM->InvoiceDue($status_id = 1, $Dealer_ID = "0", $Invoice_Id = "0", $salesexecutiveid = "0") as $Row) {
           $status= ($Row->overDueDateDiff>0)?'Overdue <br>'.$Row->overDueDateDiff.' Days':'Due';
             ?>
              <tr >
                <td><b><?php echo $status; ?></b></td>
                <td><a <?php echo "href='" . site_url('') . "/" . "Sales/Invoice_view/?Key=" . base64_encode($Row->Invoice_Id) . "'"; ?>><?php echo $Row->Invoice_No; ?></a></td>
                        <td><a <?php echo "href='" . site_url("Users/Dealeruser_views") . "/?Key=" . base64_encode($Row->Dealer_Id) . "'"; ?>><?php echo $Row->name; ?></a></td>
             <td><?php echo $Row->AreaName; ?></td>
				<td><?php echo $Row->FormattedInvoiceDate; ?></td>
                <td><?php echo $Row->InvoiceDue_DateFormatted; ?></td>                
                
                <td><?php echo $Row->Invoice_Due; ?></td>
                <td><?php echo $Row->Invoice_total; ?></td>
                <td><?php echo $Row->CollectedAmount; ?></td>
                <td><?php echo $Row->SalesReturnAmount; ?></td>               
               <td><?php echo $Row->CreditnoteAmount; ?></td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
<?php include('Includes/Foot.php'); ?>