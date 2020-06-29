<?php
include("php/functions.php");
if(empty($_SESSION["admin_id"])){
   header("Location: login");
}
if(isset($_GET["signout"])){
   session_destroy();
   header("Location: login");
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Admin - <?php echo ucfirst($_SERVER['HTTP_HOST']); ?></title>
      <link href="css/sb-admin.min.css" rel="stylesheet">
      <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
      <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
   </head>
   <body id="page-top">
      <div id="wrapper">
         <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion toggled" id="accordionSidebar">
            <a class="sidebar-brand" href="dashboard">
               <div class="sidebar-brand-icon">
                  <img src="https://<?php echo $_SERVER['HTTP_HOST']; ?>/img/logo.png" style="width: 30px" class="rounded" />
               </div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
               <a class="nav-link" href="dashboard">
               <i class="fas fa-fw fa-tachometer-alt"></i>
               <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
               Website
            </div>
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#brands">
               <i class="fas fa-fw fa-star"></i>
               <span>Brands</span>
               </a>
               <div id="brands" class="collapse" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="db?function=add&table=brands">Add Brand</a>
                     <a class="collapse-item" href="db?function=all&table=brands">All Brands</a>
                  </div>
               </div>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#admins">
               <i class="fas fa-fw fa-user"></i>
               <span>Admins</span>
               </a>
               <div id="admins" class="collapse" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="db?function=add&table=admins">Add Admin</a>
                     <a class="collapse-item" href="db?function=all&table=admins">All Admins</a>
                  </div>
               </div>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
               <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
         </ul>
         <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
               <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                  <a href="dashboard" class="navbar-brand d-none d-md-block"><?php echo ucfirst($_SERVER['HTTP_HOST']); ?></a>
                  <button id="sidebarToggleTop" class="btn btn-dark d-md-none rounded-circle mr-3">
                  <i class="fa fa-bars"></i>
                  </button>
                  <ul class="navbar-nav ml-auto">
                     <div class="topbar-divider d-none d-sm-block"></div>
                     <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                           <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION["first_name"].' '.$_SESSION["last_name"]; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
                           <a class="dropdown-item" href="db?function=edit&table=admins&id=<?php echo $_SESSION["admin_id"] ?>">
                           <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                           Profile
                           </a>
                           <div class="dropdown-divider"></div>
                           <a class="dropdown-item" href="?signout">
                           <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                           Logout
                           </a>
                        </div>
                     </li>
                  </ul>
               </nav>
               <div class="container-fluid">
