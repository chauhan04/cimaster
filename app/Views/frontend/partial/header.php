<!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-inner">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="<?=route_to("home")?>">CI</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href=index.html" class="logo"><img src="<?=base_url()?>/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="<?=route_to("home")?>">Home</a></li>
          <li><a class="nav-link scrollto" href="<?=route_to("contactus")?>">Contact Us</a></li>
          <li><a class="nav-link scrollto" href="<?=route_to("aboutus")?>">About Us</a></li>
          <?php
          if ( ! session('isLoggedIn'))
          {
          ?>
          <li><a href="<?=route_to("frontend.login")?>">Sign In</a></li>
          <?php
          } 
          else if ( session('isLoggedIn'))
          {
          ?>
          <li class="dropdown"><a href="<?=route_to("user.dashboard")?>"><span>My Account</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li class="dropdown"><a href="<?=route_to("user.profile")?>"><span>Profile</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="<?=route_to("user.changepassword")?>">Change Password</a></li>
                </ul>
              </li>
              <li><a href="<?=route_to("user.logout")?>">Logout</a></li>
            </ul>
          </li>
          <?php } ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->