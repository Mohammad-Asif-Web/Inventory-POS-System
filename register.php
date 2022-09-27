<?php
include 'functions/config.php';
if(isset($_POST['register'])){

$username = $_POST['username'];
$email = $_POST['email'];
$password = md5($_POST['password']);
$cpass = md5($_POST['cpass']);
$role = $_POST['role'];
 
  $sql = "SELECT * FROM tbl_user WHERE username = ? AND user_email = ? ";
  $query = $pdo->prepare($sql);
  $query->bindParam(1, $username);
  $query->bindParam(2, $email);
  $query->execute();

  $row = $query->fetch(PDO::FETCH_ASSOC);

if($row){
    echo "<p class='alert alert-warning text-uppercase'> users already exists </p>";

} else {
  // echo "Not Exists";
    if($password == $cpass){

      $sqlInsert = "INSERT INTO tbl_user (username, user_email, password, role)
      VALUES(?, ?, ?, ?)";

      $queryInsert = $pdo->prepare($sqlInsert);
      $queryInsert->bindParam(1, $username);
      $queryInsert->bindParam(2, $email);
      $queryInsert->bindParam(3, $password);
      $queryInsert->bindParam(4, $role);

      $result = $queryInsert->execute();
      if($result){
        header("Location: index.php");
      } else {
        echo "<p class='alert alert-danger text-uppercase'> data not inserted </p>";

      }

    } else {
      echo "<p class='alert alert-danger text-uppercase'> incorrect password </p>";

    }
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Registration Form</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="register.php"><b>Inventory </b>POS System</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
      <!-- username -->
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="User name" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <!-- user email -->
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <!-- user password -->
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <!-- confirm password -->
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="cpass" placeholder="Confirm password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <!-- Role -->
        <div class="input-group mb-3">
          <select class="form-control" name="role">
            <option>----Select Role----</option>
            <option value="Admin">Admin</option>
            <option value="User">User</option>
          </select>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="register" class="btn btn-primary btn-block" id="register">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>

      <a href="index.php" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.min.js"></script>
<script>
  
  let checkbox = document.getElementById("agreeTerms");
  let registerBtn = document.getElementById("register");
  registerBtn.disabled = true

  checkbox.addEventListener("click", ()=>{
    checkbox.checked;
    registerBtn.disabled = false;

    if(checkbox.checked == false){
    registerBtn.disabled = true;
  }
  
  })
  

</script>
</body>
</html>
