  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <div class="user-panel">
            <div class="image">
              <img src="assets/img/asif.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
          </div>

        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="assets/img/asif.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  <?php
                  echo strtoupper($_SESSION['userName']);
                  ?>
                </h3>
                <span>
                <?php
                  echo $_SESSION['userEmail'];
                  ?>
                </span>
                <div class="d-flex justify-content-between mt-2">
                  <div class="text-sm">
                  <a href="#" class="btn btn-default btn-flat">Change Password</a>
                  </div>
                  <div class="text-sm">
                  <a href="signout.php" class="btn btn-default btn-flat">Sign Out</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- Message End -->
          </div>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->