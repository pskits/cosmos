<?php
include 'Security.php';
$title= $_SESSION['office_Name'];
$ordering = 'false';
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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/Css/datatables/buttons.dataTables.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/Css/datatables/dataTables.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/Css/datatables/jquery.dataTables.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/Css/datatables/responsive.dataTables.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/Css/datatables/rowReorder.dataTables.min.css'); ?>">
    <style>
	.Currency
	{text-align:right;}
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

