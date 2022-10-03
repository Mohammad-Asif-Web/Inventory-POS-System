<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.min.js"></script>
<!-- sweet alert 2 CDN -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
include 'functions/config.php';
session_start();

$userID = $_SESSION['userID'];
$userName = $_SESSION['userName'];

if(isset($_POST['submit'])){
  $newPass = md5($_POST['password']);
  $conPass = md5($_POST['cpass']);

  if($newPass == $conPass){
    $sql = "UPDATE tbl_user SET password = ?  WHERE user_id = ? " ;
    $query = $pdo->prepare($sql);
    $query->bindParam(1, $newPass);
    $query->bindParam(2, $userID);
    $result = $query->execute();

    if($result){
      echo '<script type="text/javascript">
      jQuery(function validation(){
        Swal.fire({
          title: "Aww Full! '.strtoupper($userName).'",
          icon: "success",
          html:
            "<h1>Password Updated</h1>",
          showCloseButton: false,
          showCancelButton: false,
          focusConfirm: false,
          confirmButtonText:
            "Loading...",
        })
      });
      </script>';
    header("refresh:3; index.php");

      } else {

         echo "<div class='alert alert-danger'>Query Failed: for password changing</div>";
      }

  } else {
    echo '<script type="text/javascript">
      jQuery(function validation(){
        Swal.fire({
          title: "Oops! '.strtoupper($userName).'",
          icon: "error",
          html:
            "<h1>Password Doesnt Matched</h1>",
          showCloseButton: false,
          showCancelButton: false,
          focusConfirm: false,
          confirmButtonText:
            "Ok",
        })
      });
      </script>';
  }


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>POS | Recover Password (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index.php" class="h1"><b>Inventory</b>POS</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
      <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="cpass" class="form-control" placeholder="Confirm Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Change password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="index.php">Sign in</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

</body>
</html>
