<?php 

include 'functions/config.php';
session_start();

if($_SESSION['userEmail'] == ''){
  header('location: index.php');
}

include 'includes/head.php';
include 'includes/preloader.php';
include 'includes/navbar.php';
include 'includes/sidebar.php'; 

 

$userName = $_SESSION['userName'];
$user_email = $_SESSION['userEmail'];

$sql = "SELECT * FROM tbl_user WHERE user_email = :email ";
$query = $pdo->prepare($sql);
$query->bindParam(':email', $user_email);
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);
// echo "<pre>";
// print_r($row);
// echo "</pre>";

if(isset($_POST['submit'])){
  $old_pass = md5($_POST['old_pass']);
  $new_pass = md5($_POST['new_pass']);
  $c_pass = md5($_POST['c_pass']);

 if($row['password'] == $old_pass){
    if($new_pass == $c_pass){

        $sql_pass = "UPDATE tbl_user SET password = :new_pass  WHERE user_email = :email " ;
        $query_pass = $pdo->prepare($sql_pass);
        $query_pass->bindParam(':new_pass', $new_pass);
        $query_pass->bindParam(':email', $user_email);
        $result = $query_pass->execute();
        
        if($result){
            echo '<script type="text/javascript">
            jQuery(function validation(){
              Swal.fire({
                title: "Aww Full! '.strtoupper($userName).'",
                icon: "success",
                html:
                  "<h1>Password Updated</h1>",
                confirmButtonText:
                  "Ok",
              })
            });
            </script>';
        } else{
          echo "<div class='alert alert-success'>Query Failed: Password Not Updated</div>";
        }

    } else {
        echo '<script type="text/javascript">
        jQuery(function validation(){
          Swal.fire({
            title: "Oops! '.strtoupper($userName).'",
            icon: "error",
            html:
              "<h1>New Password Not Matched</h1>",
            confirmButtonText:
              "Ok",
          })
        });
        </script>';
    }

 } else{
  echo '<script type="text/javascript">
  jQuery(function validation(){
    Swal.fire({
      title: "Oops! '.strtoupper($userName).'",
      icon: "warning",
      html:
        "<h1>You entered wrong password</h1>",
      confirmButtonText:
        "Ok",
    })
  });
  </script>';
 }

} 

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Change Password</h1>
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
    <section class="content">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Change Password Form</h3>
            </div>
            <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                <!-- card body -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="old_password">Old Password</label>
                        <input type="password" class="form-control" name="old_pass" id="old_password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control" name="new_pass" id="new_password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="c_password">Confirm Password</label>
                        <input type="password" class="form-control" name="c_pass" id="c_password" placeholder="Password" required>
                    </div>
                </div>
                <!-- card footer -->
                <div class="card-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
    <!-- main content End -->
  </div>


<?php include 'includes/footer.php'; ?>
