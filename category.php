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

if(isset($_POST['submit'])){
    $category_name = $_POST['category'];

    $sqlCheck = "SELECT category_name FROM category WHERE category_name = :cat_name ";
    $queryCheck = $pdo->prepare($sqlCheck);
    $queryCheck->bindParam(':cat_name', $category_name);
    $queryCheck->execute();
    if($queryCheck->rowCount() > 0){
        echo '<script type="text/javascript">
        jQuery(function validation(){
            Swal.fire({
            title: "Oops ! '.strtoupper($_SESSION['userName']).'",
            icon: "error",
            html:
                "<h1>Category Already Exists !</h1>",
            confirmButtonText:
                "Back",
            })
        });
        </script>';
    } else {
        $sqlInsert = "INSERT INTO category (category_name) VALUES(:cat_name)";
        $queryInsert = $pdo->prepare($sqlInsert);
        $queryInsert->bindParam(':cat_name', $category_name);
        $result = $queryInsert->execute();
        if($result){
            echo '<script type="text/javascript">
            jQuery(function validation(){
                Swal.fire({
                title: "Good Job! '.strtoupper($_SESSION['userName']).'",
                icon: "success",
                html:
                    "<h1>New Category Created !</h1>",
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
            <h1 class="m-0">Dashboard</h1>
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
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title text-white">Add Category</h3>
                    </div>
                    <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                        <!-- card body -->
                        <div class="card-body pb-0">
                            <div class="form-group">
                                <label for="category">Category Name</label>
                                <input type="text" class="form-control" name="category" id="category" placeholder="Enter Category" >
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
                <div class="card card-warning">
                    <table class="table table-bordered responsive">
                        <div class="card-header">
                            <h3 class="card-title text-center text-white">All Categories</h3>
                            <thead>
                                <tr>
                                <th style="width: 10px">#</th>
                                <th>Category Name</th>
                                <th>Edit</th>
                                <th style="width: 40px">Delete</th>
                                </tr>
                            </thead>
                        </div>
                            <!-- card body -->
                        <div class="card-body p-0">
                            <tbody>
                                <?php
                                $sqlSelect = "SELECT * FROM category";
                                $querySelect = $pdo->prepare($sqlSelect);
                                $querySelect->execute();
                                $sl = 1;
                                while($row = $querySelect->fetch(PDO::FETCH_OBJ)){ 
                                ?>
                                <tr>
                                    <td><?php echo $sl++ ?></td>
                                    <td><?php echo $row->category_name ?></td>
                                    <td>
                                        <a href="category.php?<?php echo base64_encode($row->category_name) ?>=<?php echo $row->cat_id?>">
                                            <button class="btn btn-sm btn-success" name="edit">button</button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="category.php?<?php echo base64_encode($row->category_name) ?>=<?php echo $row->cat_id?>">
                                            <button class="btn btn-sm btn-danger" name="delete">delete</button>
                                        </a>
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
