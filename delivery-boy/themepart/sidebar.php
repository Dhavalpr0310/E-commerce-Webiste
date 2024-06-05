  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo $project_title; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <?php
        $table = "tbl_delivery_person";
        $primary_key = "delivery_person_id";
        $editid = $_SESSION["delivery_person_id"];
        $query_list = mysqli_query($connection, "select * from $table  where $primary_key='{$editid}'") or die(mysqli_error($connection));
        $row_list = mysqli_fetch_array($query_list);
        $user_image = $imageupload_path . $row_list['delivery_person_image'];
        ?>
        <div class="image">
          <!--          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">-->
          <img src="<?php echo $user_image; ?>" style="width: 33.59px;height: 33.59px" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="profile-edit.php" class="d-block"><?php echo $_SESSION["delivery_person_name"]; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="order-list.php" class="nav-link">
              <i class="nav-icon fab fa-first-order-alt"></i>

              <p>
                Order List
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">

            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>

              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="change-password.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="profile-edit.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>

            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>