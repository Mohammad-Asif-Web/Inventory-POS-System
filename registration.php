<?php 
include 'functions/config.php';
session_start();
if($_SESSION['userEmail'] == '' || $_SESSION['userRole'] == 'User'){
    header('location: index.php');
}

include 'includes/head.php'; 
include 'includes/preloader.php'; 
include 'includes/navbar.php'; 
include 'includes/sidebar.php';

// Delete Data 
// error_reporting(0);
if(isset($_GET['id'])){
    $del_id = $_GET['id'];
    $sqlDel = "DELETE FROM tbl_user WHERE user_id = :del_id";
    $delete = $pdo->prepare($sqlDel);
    $delete->bindParam(':del_id', $del_id);
    if($delete->execute()){
        // header("location: registration.php");
        echo '<script type="text/javascript">
        jQuery(function validation(){
            Swal.fire({
            title: "Good Job! '.strtoupper($_SESSION['userName']).'",
            icon: "success",
            html:
                "<h1>Account is Deleted !</h1>",
            confirmButtonText:
                "Ok",
            })
        });
        </script>';
    } 
}

// Insert data
if(isset($_POST['submit'])){
    // echo 'this is registration page';
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['pass']);
    $role = $_POST['role'];

    $sqlEmail = "SELECT user_email FROM tbl_user WHERE user_email = :email ";
    $queryEmail = $pdo->prepare($sqlEmail);
    $queryEmail->bindParam(':email', $email);
    $queryEmail->execute();

    if($queryEmail->rowCount() > 0){
        echo 'Email Already Exists';
    } else {
        $sqlInsert = "INSERT INTO tbl_user (username, user_email, password, role) VALUES(:username, :email, :pass, :role)";
    
        $queryInsert = $pdo->prepare($sqlInsert);
        $queryInsert->bindParam(':username', $name);
        $queryInsert->bindParam(':email', $email);
        $queryInsert->bindParam(':pass', $password);
        $queryInsert->bindParam(':role', $role);
    
        $result = $queryInsert->execute();
        if($result){
            echo '<script type="text/javascript">
            jQuery(function validation(){
                Swal.fire({
                title: "Good Job! '.strtoupper($_SESSION['userName']).'",
                icon: "success",
                html:
                    "<h1>New Account Created !</h1>",
                confirmButtonText:
                    "Ok",
                })
            });
            </script>';
        } else {
            echo "<p class='alert alert-danger text-uppercase'>Query Failed: data not inserted </p>";
    
        }
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
            <h1 class="m-0">Registration Page</h1>
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
        <div class="row">
            <div class="col-md-4">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Register a New User</h3>
                    </div>
                    <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                        <!-- card body -->
                        <div class="card-body pb-0">
                            <div class="form-group">
                                <label for="username">Name</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Your name" >
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your email">
                            </div>
                            <div class="form-group">
                                <label for="pass">password</label>
                                <input type="text" class="form-control" name="pass" id="pass" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control" id="role" name="role">
                                    <option disabled selected>----Select Role----</option>
                                    <option value="Admin">Admin</option>
                                    <option value="User">User</option>
                                </select>
                            </div>
                        </div>
                        <!-- card footer -->
                        <div class="card-footer pt-0 bg-dark">
                            <button type="submit" name="submit" class="btn btn-info">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-info">
                    <table class="table table-bordered">
                        <div class="card-header">
                            <h3 class="card-title text-center">Records of Users</h3>
                            <thead>
                                <tr>
                                <th style="width: 10px">#</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>PASSWORD</th>
                                <th>ROLE</th>
                                <th style="width: 40px">DELETE</th>
                                </tr>
                            </thead>
                        </div>
                            <!-- card body -->
                        <div class="card-body p-0">
                            <tbody>
                            <?php
                            $sql = "SELECT * FROM tbl_user ORDER BY user_id DESC ";
                            $query = $pdo->prepare($sql);
                            $query->execute();
                            $sl = 1;
                            
                            while($row = $query->fetch(PDO::FETCH_OBJ)){
                            ?>
                            <tr>
                                <td><?php echo $sl++ ?></td>
                                <td><?php echo $row->username ?></td>
                                <td>
                                <?php echo $row->user_email ?>
                                </td>
                                <td><?php echo $row->password ?></td>
                                <td><?php echo $row->role ?></td>
                                <td>
                                    <a href="registration.php?id=<?php echo $row->user_id ?>"><button class="btn btn-sm btn-danger"
                                    name="delete">button</button></a>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </div>
                    </table>
                </div>
            </div>

        </div>
    </section>
    <!-- main content End -->
  </div>

<?php include 'includes/footer.php'; ?>
