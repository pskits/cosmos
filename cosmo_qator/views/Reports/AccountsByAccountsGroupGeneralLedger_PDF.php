<?php
defined('BASEPATH') or exit('No direct script access allowed');
include 'Security.php';
$_GET['OfficeLedger_id'] = (!isset($_GET['OfficeLedger_id']))  ? '' : $_GET['OfficeLedger_id'];
$fromdate = (isset($_REQUEST['fromdate'])) ? $_REQUEST['fromdate'] : date('d-m-Y');
$todate = (isset($_REQUEST['todate'])) ? $_REQUEST['todate'] : date('d-m-Y');

$ordering = 'false';
$office = $this->GM->Office($officetype = "0", $status = "1", $Id = "0", $_SESSION['currentdatabasename']);
$office = $office[0];
 $from_date = $this->GM->DateSplit($fromdate);
 $to_date = $this->GM->DateSplit($todate);
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cosmo Pumps Pvt Ltd</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url('assets/Css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/Css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/Css/AdminLTE.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/Css/googlefont.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/Css/skin-cosmo.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/Css/Custom.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/Css/select2.min.css'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/Pics/favicon.png'); ?>" />
    <link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/Pics/favicon.png'); ?>" />
    <style>
        th {
            font-size: 14px;
            color: <?php echo $_SESSION['dbcolor']; ?>;
            width: 10px;
        }
        tfoot{
            background-color: <?php echo $_SESSION['dbcolor']; ?>;
            color: #fff;
        }
        td {
            font-size: 14px;
        }
        .reportmain_wrap {
            min-width: 150px;
        }
        .reportmain_wrap_sm {
            min-width: 50px;
        }
        .Currency {
            width: 10px !important;
        }
        .datatablefilerhead {
            width: 100%;
            border: none;
            background: transparent;
            color: <?php echo $_SESSION['dbcolor']; ?>
        }
        .datatablefilerhead::placeholder {
            color: <?php echo $_SESSION['dbcolor']; ?>
        }
        a {
            color: <?php echo $_SESSION['dbcolor']; ?>
        }
        .box.box-solid.box-form>.box-header {
            color: #fff;
            background-color: <?php echo $_SESSION['dbcolor']; ?>
        }
        table.dataTable tbody td {
            word-break: break-word;
            vertical-align: top;
        }
        div.dt-buttons {
            float: right;
        }
        div.dt-button-collection {
            right: 10px;
            left: auto !important;
        }
    </style>
</head>
<body class="hold-transition skin-skasc sidebar-mini  sidebar-collapse">




          <!-- /.box -->

        <!-- ./col -->
       
          <!-- /.box -->
        
        <!-- ./col -->
     
    <?php if (empty($_GET['OfficeLedger_id'])) { ?>
        <section class="content">
       
                    <div class="box box-solid" style="Text-align:center;">
         
            <!-- /.box-header -->
            <div class="box-body">

              <h4><b><?php echo $office->office_Name; ?></b></h4>
              <h5><?php echo $office->office_address; ?> <br/>
                    TRN: <?php echo $office->office_tax_no; ?><br /></h5>
					<br>
					  <p class="text-muted"><u>Ledger Book</u></p>
						<p class="text-muted"><?php echo date("d M Y", strtotime($fromdate)); ?> - <?php echo date("d M Y", strtotime($todate)); ?></p>
            </div>
            <!-- /.box-body -->
          </div>
				
                <div class="box-body">
                    <table id="" class="table  table-borderless" style="width:100%">
                        <thead>
                            <tr>
                                <th class="info">#</th>
                                <th class="info">Group</th>
                                <th class="success">Ledger Name</th>
                                <th class="success">Debit</th>
                                <th class="success">Credit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cou = 0;
							$debit = 0;
							$credit=0;                          
                            $Accountsgroup_Name = '';
                            foreach ($this->ReportsClass->AccountsByAccountsGroupLedger($from_date, $to_date) as $Row) {
                                if ($Row->Accountsgroup_Name != $Accountsgroup_Name) {
                                    $Accountsgroup_Name = $Row->Accountsgroup_Name;
                                    $cou++;
                            ?>
                                    <tr>
                                        <td class="info"><b><?php echo $cou; ?></b></td>
                                        <td class="info"><?php echo $Row->Accountsgroup_Name; ?></td>
                                        <td class="success">  <?php echo $Row->Ledgername; ?></td>
                                        <td class="success"><?php echo $Row->debit; ?></td>
                                        <td class="success"><?php echo $Row->credit; ?></td>
                                    </tr>
                                <?php
                                } else {
                                ?>
                                    <tr>
                                    <td class="info" style='border-top:none !important;'></td>
                                        <td class="info" style='border-top:none !important;'></td>
                                        <td class="success"><?php echo $Row->Ledgername; ?></td>
                                        <td class="success"><?php echo $Row->debit; ?></td>
                                        <td class="success"><?php echo $Row->credit; ?></td>
                                       
                                    </tr>
                            <?php
                                }
								
								$debit +=$Row->debit;
								$credit +=$Row->credit;
                            }
                            ?>
                        </tbody>
                        <tfoot><?php $ordering = 'false';
                                $tablecolumntotallist = array('3', '4'); ?>
                            <td>Total</td>
                            <td></td>
                            <td></td>
							<td><?php echo $debit;?></td>
                            <td><?php echo $credit;?></td>
                        </tfoot>
                    </table>
                </div>
            </div>
        </section>
    <?php } else { ?>
        <section class="content">
            
              <div class="box box-solid" style="Text-align:center;">
         
            <!-- /.box-header -->
            <div class="box-body">

              <h4><b><?php echo $office->office_Name; ?></b></h4>
              <h5><?php echo $office->office_address; ?> <br/>
                    TRN: <?php echo $office->office_tax_no; ?><br /></h5>
					<br>
              <h4><b><?php $dataVoucherAgainst = $this->GM->OfficeLedger($_GET['OfficeLedger_id'], $LedgerType_Id = "0", $Against_Id = "0");
							echo $dataVoucherAgainst[0]->Ledgername; ?></b></h4>
					  <p class="text-muted"><u>Ledger Book</u></p>
						<p class="text-muted"><?php echo date("d M Y", strtotime($fromdate)); ?> - <?php echo date("d M Y", strtotime($todate)); ?></p>
            </div>
            <!-- /.box-body -->
          </div>
		  
                <div class="box-body">
                     <table id="" class="table" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>  
                               						
                                <th>Voucher</th>
                                <th>Voucher no</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cou = 1;                           
							$debit = 0;
							$credit=0;
                            foreach ($this->ReportsClass->AccountsByGroupLedgertransaction($from_date, $to_date, $_GET['OfficeLedger_id']) as $Row) {
                            ?>
                                <tr>
                                    <td><b><?php echo $cou; ?></b></td>
                                    <td><?php echo $Row->transactiondateformated; ?></td> 																		
                                    <td> <?php echo $Row->AllTransactionName; ?></td>
                                    <td><?php echo $Row->Number; ?></td>
                                    <td><?php echo $Row->debit; ?></td>
                                    <td><?php echo $Row->credit; ?></td>
                                    <td><?php echo $Row->Reference; ?></td>
                                </tr>
                            <?php
                                $cou++;
								$debit +=$Row->debit;
								$credit +=$Row->credit;
                            }
                            ?>
                        </tbody>
                        <tfoot><?php $ordering = 'false';
                                $tablecolumntotallist = array(); ?>
                            <td>Total</td>                           
                            <td></td>
                            <td></td>
                            <td></td>                           
                            <td><?php echo $debit;?></td>
                            <td><?php echo $credit;?></td>
							<td></td>
                        </tfoot>
                    </table>
                </div>
				       <div class="box box-solid">
         
            <!-- /.box-header -->
            <div class="box-body row">
<div class="col-md-8">
                 
            </div>
				<div class="col-md-4">
			  <h4><b>Opening</b> :<?php if($Row->opening>0) { echo $Row->opening.' Dr' ;} else {echo ($Row->opening*-1).' Cr' ;} ?></h4>
			    <h4><b>Current</b> &nbsp;&nbsp;:<?php if($Row->crt>0) { echo $Row->crt.' Dr';} else {echo ($Row->crt*-1).' Cr';} ?> </h4>
				  <h4><b>Closing</b> &nbsp;&nbsp;:<?php if($Row->closing>0) { echo $Row->closing.' Dr';} else { echo ($Row->closing*-1).' Cr' ;} ?></h4>
			</div>
            <!-- /.box-body -->
          </div>
            </div>
        </section>
    <?php } ?>
</div>
