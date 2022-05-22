<!DOCTYPE html>
<html lang="en">

<?php
  include_once('session/checker.php');
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/urlogo.png" rel="icon">
  <title>WBSSRM</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="vendor/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Select2 -->
  <link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" >
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard">
        <div class="sidebar-brand-icon">
          <img src="img/logo/urlogo.png">
        </div>
        <div class="sidebar-brand-text mx-3">WBSSRM</div>
      </a>
      <li class="nav-item <?php if(@$menu=='masterfile'){echo 'active';} ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasterfile"
          aria-expanded="true" aria-controls="collapseMasterfile">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Masterfile</span>
        </a>
        <div id="collapseMasterfile" class="collapse <?php if(@$menu=='masterfile'){echo 'show';} ?>" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Masterfile</h6>
            <a class="collapse-item <?php if(@$submenu=='team'){echo 'active';} ?>" href="team">Participants</a>
            <a class="collapse-item <?php if(@$submenu=='venue'){echo 'active';} ?>" href="venue">Venue</a>
            <!-- <a class="collapse-item <?php if(@$submenu=='events'){echo 'active';} ?>" href="events.php">Event</a> -->
            <a class="collapse-item <?php if(@$submenu=='sports'){echo 'active';} ?>" href="sports">Sports</a>
            <a class="collapse-item <?php if(@$submenu=='user'){echo 'active';} ?>" href="user">User</a>
          </div>
        </div>
      </li>
      <li class="nav-item <?php if(@$menu=='utilities'){echo 'active';} ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
          aria-expanded="true" aria-controls="collapseUtilities">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse <?php if(@$menu=='utilities'){echo 'show';} ?>" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Utilities</h6>
            <a class="collapse-item <?php if(@$submenu=='tournament'){echo 'active';} ?>" href="tournament">Tournament</a>
            <!-- <a class="collapse-item <?php if(@$submenu=='tournament'){echo 'active';} ?>" href="tournament.php">Announcement</a> -->
          </div>
        </div>
      </li>
    </ul>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            <!-- <div class="topbar-divider d-none d-sm-block"></div> -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small"><?php echo $_SESSION['FULL_NAME']; ?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#userSettingsModal" onclick=user_settings(<?php echo $_SESSION['SESS_ID']; ?>)>
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  User Settings
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">