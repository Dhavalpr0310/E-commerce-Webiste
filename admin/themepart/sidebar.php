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
        <div class="image">
          <!--          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">-->
          <img src="<?php echo $imageupload_path . $admin_profile; ?>" style="width: 33.59px;height: 33.59px" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="profile-edit.php" class="d-block"><?php echo $admin_name; ?></a>
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
            <a href="brand-list.php" class="nav-link">
              <i class="nav-icon far fa-circle"></i>
              <p>
                Brand
              </p>
            </a>
          </li>


          <li class="nav-item has-treeview">

            <a href="#" class="nav-link">

              <i class="nav-icon fab fa-cuttlefish"></i>

              <p>
                Manage Category
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="category-add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Category</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="category-list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Category</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">

            <a href="#" class="nav-link">

              <i class="nav-icon fas fa-users"></i>

              <p>
                Manage Seller
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="seller-add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Seller</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="seller-list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Seller</p>
                </a>
              </li>
            </ul>
          </li>



          <li class="nav-item has-treeview">

            <a href="#" class="nav-link">

              <i class="nav-icon fab fa-product-hunt"></i>

              <p>
                Manage Product
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="product-add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Product</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="product-list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Product</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">

            <a href="#" class="nav-link">

              <i class="nav-icon fas fa-users"></i>

              <p>
                Manage Delivery Person
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="delivery-person-add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Delivery Person</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="delivery-person-list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Delivery Person</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="delivery-person-assign-order-list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Order Assign</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- <li class="nav-item has-treeview">

            <a href="#" class="nav-link">

              <i class="nav-icon fab fa-cuttlefish"></i>

              <p>
                Manage Payment Type
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="payment-type-add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Payment Type</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="payment-type-list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Payment Type</p>
                </a>
              </li>
            </ul>
          </li> -->

          <!-- <li class="nav-item has-treeview">

            <a href="#" class="nav-link">

              <i class="nav-icon fab fa-cuttlefish"></i>

              <p>
                Manage Status
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="status-add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Status</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="status-list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Status</p>
                </a>
              </li>
            </ul>
          </li> -->
          <!-- <li class="nav-item has-treeview">
		  
      <a href="#" class="nav-link">
        
        <i class="nav-icon fas fa-images"></i>
         
         <p>
         Manage Product Photo
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
           <li class="nav-item">
          <a href="product-photo-add.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Add Product Photo</p>
          </a>
        </li>
     
        <li class="nav-item">
          <a href="product-photo-list.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>View Product Photo</p>
          </a>
        </li>
      </ul>
    </li> -->

          <li class="nav-item has-treeview">

            <a href="#" class="nav-link">

              <i class="nav-icon fas fa-users"></i>

              <p>
                Manage User
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="user-add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="user-list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View User</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- <li class="nav-item has-treeview">
		  
      <a href="#" class="nav-link">
        
        <i class="nav-icon fas fa-cart-arrow-down"></i>
        
         <p>
         Manage Cart
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
           <li class="nav-item">
          <a href="cart-add.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Add Cart</p>
          </a>
        </li>
     
        <li class="nav-item">
          <a href="cart-list.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>View Cart</p>
          </a>
        </li>
      </ul>
    </li> -->
          <!-- <li class="nav-item has-treeview">
		  
      <a href="#" class="nav-link">
      
        <i class="nav-icon far fa-smile"></i>
        
         <p>
         Manage Feedback
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
   
     
        <li class="nav-item">
          <a href="feedback-list.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>View Feedback</p>
          </a>
        </li>
      </ul>
    </li> -->
          <li class="nav-item has-treeview">

            <a href="#" class="nav-link">

              <i class="nav-icon fas fa-print"></i>

              <p>
                Manage Reports
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">



              <li class="nav-item">
                <a href="rpt-user-wise-order.php" class="nav-link" target="_blank">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User Wise Order</p>
                </a>
              </li>

              <!-- <li class="nav-item">
                <a href="rpt-category-wise-subcategory.php" class="nav-link" target="_blank">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category Wise Subcat</p>
                </a>
              </li> -->

            </ul>
          </li>
          <li class="nav-item">
            <a href="order-list.php" class="nav-link">
              <i class="nav-icon fab fa-first-order-alt"></i>

              <p>
                Order List
              </p>
            </a>
          </li>

          <!-- <li class="nav-item">
              <a href="mail-setting-edit.php" class="nav-link">
                <i class="nav-icon fas fa-mail-bulk"></i>
                
                <p>
              Mail Setting
                </p>
              </a>
            </li> -->
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