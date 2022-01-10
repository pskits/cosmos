<?php
include 'Security.php';
$title= $_SESSION['office_Name'];
$datatableTitle ='';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $_SESSION['office_Name'];?></title>
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
  <link rel="stylesheet" href="<?php echo base_url('assets/Css/Datepicker.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/Css/Timepicker.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/Css/datatables/jquery.dataTables.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/Css/datatables/rowReorder.dataTables.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/Css/datatables/responsive.dataTables.min.css'); ?>">
  <style>
    .content {
      padding: 2px !important;
      padding-left: 2px !important;
      padding-right: 2px !important;
    }
    .invoice {
      padding: 20px;
      margin: 10px 15px;
    }
    .table>tbody>tr>td {
      border-top: none;
      padding: 1px;
    }
    .invoice-table {
      text-align: left;
      width: 98%;
      margin-left: 1%;
    }
    .table-total {
      color: #7d7d7d !important;
    }
    a {
      color: <?php echo $_SESSION['dbcolor']; ?>
    }
    .table-total>tbody>tr>td,
    .table-total>tbody>tr>th {
      padding: 5px;
      font-weight: bold;
    }
    .table-total>tbody>tr>td:last-child,
    .table-total>tbody>tr>th:last-child {
      text-align: right;
      padding-right: 5px !important;
    }
  </style>
</head>
<body class="hold-transition skin-skasc sidebar-mini">
