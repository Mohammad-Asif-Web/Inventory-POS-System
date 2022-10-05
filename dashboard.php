<?php
include 'functions/config.php';
session_start();
// user can not enter main dashboard page without login first
if($_SESSION['userEmail'] == ''){
  header('location: index.php');
} 
// if the role is user, always redirect to user, he could not enter to dashboard.php page
if($_SESSION['userRole'] == 'User'){
  header('location: user.php');
}


include 'includes/head.php';
include 'includes/preloader.php';
include 'includes/navbar.php';
include 'includes/sidebar.php'; 
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- dashboard main content Start -->
    <section>
      Write Your table here...
      <?php

      echo "this is session";


      ?>
    </section>
    <!-- main content End -->
  </div>


<?php include 'includes/footer.php'; ?>
