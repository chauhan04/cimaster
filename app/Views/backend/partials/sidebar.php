
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="<?php echo route_to('admin.profile'); ?>" class="d-block"><?=session()->get('full_name')?></a>
        </div>
      </div>



<!-- Sidebar Menu -->
      <nav class="mt-2">

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <! -- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -- >


          <li class="nav-item">
            <a href="<?php echo route_to('admin.list'); ?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Admins</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo route_to('user.list'); ?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Users</p>
            </a>
          </li>
          
          <!--
          <li class="nav-item">
            <a href="pages/examples/blank.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Blank Page</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="starter.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Starter Page</p>
            </a>
          </li> -->

          <li class="nav-item">
            <a href="<?=route_to("admin.logout")?>" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Logout</p>
            </a>
          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

