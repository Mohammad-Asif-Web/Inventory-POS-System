<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.min.js"></script>
<!-- sweet alert 2 CDN -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
include "functions/config.php";
session_start();
error_reporting(0);
/*if we logged to this site, but we can find the login page by url. so to solve this
problem we used this code. After the login to this site, user can not go to again
page, first he have to do log out, then he can do login again*/
if(isset($_SESSION['userRole'])){
  if($_SESSION['userRole'] == 'Admin'){
    header('location: dashboard.php');
  } else{
    header('location: user.php');
  }
}

if(isset($_POST['btn_login'])){
  $email = $_POST['email'];
  $pass = md5($_POST['password']);

  $sql = "SELECT * FROM tbl_user WHERE user_email = ? AND password = ? ";

  $query = $pdo->prepare($sql);
  $query->bindParam(1, $email);
  $query->bindParam(2, $pass);
  $query->execute();

  $result = $query->fetch(PDO::FETCH_ASSOC);

  if($result['user_email'] == $email AND $result['password'] == $pass AND $result['role'] == 'Admin' ){

    
    $_SESSION['userID'] = $result['user_id'];
    $_SESSION['userName'] = $result['username'];
    $_SESSION['userEmail'] = $result['user_email'];
    $_SESSION['userRole'] = $result['role'];

    echo '<script type="text/javascript">
    jQuery(function validation(){
      Swal.fire({
        title: "Good Job! '.strtoupper($_SESSION['userName']).'",
        icon: "success",
        html:
          "<h1>Successfully Sign In</h1>",
        confirmButtonText:
          "Loading...",
      })
    });
    </script>';

    header("refresh:2; dashboard.php");

  } else if($result['user_email'] == $email AND $result['password'] == $pass AND $result['role'] == 'User' ){

    $_SESSION['userID'] = $result['user_id'];
    $_SESSION['userName'] = $result['username'];
    $_SESSION['userEmail'] = $result['user_email'];
    $_SESSION['userRole'] = $result['role'];

    echo '<script type="text/javascript">
    jQuery(function validation(){
      Swal.fire({
        title: "Good Job! '.strtoupper($_SESSION['userName']).'",
        icon: "success",
        html:
          "<h1>Successfully Sign In</h1>",
        confirmButtonText:
          "Loading...",
      })
    });
    </script>';

    header("refresh:2 ;user.php");

  } else {
    echo '<script type="text/javascript">
    jQuery(function validation(){
      Swal.fire({
        title: "Oops...",
        icon: "error",
        html:
          "<h1>Sign In Unsuccessfull</h1>",
        confirmButtonText:
          "Try Again",
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
  <title>POS | Log In</title>

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
  <div class="login-logo">
    <a href="index.php"><b>Inventory </b>POS</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="btn_login" class="btn btn-primary btn-block">Log In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.php">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->



</body>
</html>



