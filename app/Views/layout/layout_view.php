<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>GI-GoMekanik Web App</title>

    <?= $this->include('layout/partial/css'); ?>
    <!-- DataTable -->
    <!-- <link rel="stylesheet" href="<//?= base_url(); ?>/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"> -->

    <?= $this->include('layout/partial/js'); ?>
    
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?= $this->include('layout/partial/navbar'); ?>
        <!-- <//?= view_cell('App\Controllers\ViewCells\NavBar::apps'); ?> -->

        <?= view_cell('App\Controllers\ViewCells\LeftSideBar::menus', ['id' => $idRole]); ?>

        <?= $this->renderSection('content'); ?>

        <?= $this->include('layout/partial/footer'); ?>

        <?= $this->include('layout/partial/right_sidebar'); ?>

        <div id="sidebar-overlay"></div>
    </div>

    
</body>

</html>