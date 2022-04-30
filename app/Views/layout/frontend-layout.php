<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Bootstrap Template - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?=base_url()?>/frontend/img/favicon.png" rel="icon">
  <link href="<?=base_url()?>/frontend/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?=base_url()?>/frontend/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="<?=base_url()?>/frontend/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?=base_url()?>/frontend/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=base_url()?>/frontend/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?=base_url()?>/frontend/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?=base_url()?>/frontend/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?=base_url()?>/frontend/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?=base_url()?>/frontend/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?=base_url()?>/frontend/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Anyar - v4.7.0
  * Template URL: https://bootstrapmade.com/anyar-free-multipurpose-one-page-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="fixed-top d-flex align-items-center topbar-inner">
    <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope-fill"></i><a href="mailto:contact@example.com">developer8here@gmail.com</a>
        
      </div>
      <div class="cta d-none d-md-block">
        <div class="top-social-links">
          <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
          <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
          <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
          <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
          <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
      </div>
    </div>
  </div>

  <!-- include header -->
  <?php echo view('frontend/partial/header'); ?> 


  <main id="main" class="main-inner">

    <?php echo $this->renderSection('content'); ?>  

  </main><!-- End #main -->

  <!-- include footer -->
  <?php echo view('frontend/partial/footer'); ?> 

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="<?=base_url()?>/frontend/js/jquery.min.js"></script>
  <!-- Vendor JS Files -->
  <script src="<?=base_url()?>/frontend/vendor/aos/aos.js"></script>
  <script src="<?=base_url()?>/frontend/vendor/bootstrap/js/bootstrap.js"></script>
  <script src="<?=base_url()?>/frontend/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?=base_url()?>/frontend/vendor/isotope-layout/isotope.pkgd.min.js"></script>
 
  <!-- Template Main JS File -->
  <script src="<?=base_url()?>/frontend/js/main.js"></script>

</body>

</html>