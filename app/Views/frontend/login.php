<?= $this->extend('layout/frontend-layout'); ?>
<?= $this->section('content'); ?>

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="signin">
      <div class="container" data-aos="fade-up">

      <div class="row mt-1 d-flex justify-content-center" data-aos="fade-right" data-aos-delay="100">
        <div class="col-lg-6 mt-5 mt-lg-0" data-aos="fade-left" data-aos-delay="100">
        <?php echo view('frontend/partial/flash-message'); ?>
        </div>
      </div>

        <div class="section-title pb-0">
          <h2><?=$pageTitle?></h2>
        </div>

        <div class="row mt-1 d-flex justify-content-center" data-aos="fade-right" data-aos-delay="100">


          <div class="col-lg-6 mt-5 mt-lg-0" data-aos="fade-left" data-aos-delay="100">

            <form action="<?=route_to("frontend.makelogin")?>" method="post" role="form" class="php-email-form">

              <div class="form-group mt-3">
                <input type="text" class="form-control" name="email" id="email" placeholder="Email" required>
              </div>
              <div class="form-group mt-3">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
              </div>
              <div class="form-group mt-3 text-end">
                <span class=""><a href="<?=route_to("frontend.forgotpassword")?>">I forgot my password</a></span>
              </div>
              <div class="text-center mt-4"><button type="submit" class="submit-btn">Sign In</button></div>
              <div class="form-group mt-3 text-end">
                <span class=""><a href="<?=route_to("frontend.register")?>">Don't have account, Sign Up</a></span>
              </div>
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section --> 

<?= $this->endSection('content'); ?>
