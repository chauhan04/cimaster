<?= $this->extend('layout/frontend-layout'); ?>
<?= $this->section('content'); ?>

<!-- ======= Profile Section ======= -->
<section id="edit-profile" class="edit-profile ">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2><?=$pageTitle?></h2>
        </div>
        <div class=" ">
          <?php echo view('frontend/partial/flash-message'); ?>
        </div>
        <form id="userEditForm" name="userEditForm" action="<?=route_to("frontend.makeregister")?>" method="post">

        <div class=" ">
          <div class="form-group row">
            <label for="first_name" class="col-sm-2 col-lg-2 col-form-label">First Name:<span class="text-danger">*</span></label>
            <div class="col-sm-10 col-lg-10">
              <input id="first_name" name="first_name" type="text" class="form-control " placeholder="First Name" value="<?=$userData['first_name']?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="last_name" class="col-sm-2 col-form-label">Last Name:<span class="text-danger">*</span></label>
            <div class="col-sm-10 col-lg-10">
              <input id="last_name" name="last_name" type="text" class="form-control" placeholder="Last Name" value="<?=$userData['last_name']?>">
            </div>
          </div>
          <div class=" form-group row">
            <label for="username" class="col-sm-2 col-form-label">Username:<span class="text-danger">*</span></label>
            <div class="col-sm-10 col-lg-10">
              <input id="username" name="username" type="text" class="form-control" placeholder="Username" value="<?=$userData['username']?>">
            </div>
          </div>
          <div class=" form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email:<span class="text-danger">*</span></label>
            <div class="col-sm-10 col-lg-10">
              <input id="email" name="email" type="email" class="form-control" placeholder="Email Address" value="<?=$userData['email']?>">
            </div>
          </div>
          <div class=" form-group row">
            <label for="password" class="col-sm-2 col-form-label">Password:<span class="text-danger">*</span></label>
            <div class="col-sm-10 col-lg-10">
              <input id="password" name="password" type="password" class="form-control" placeholder="Password" value="">
            </div>
          </div>
          <div class=" form-group row">
            <label for="confirm_password" class="col-sm-2 col-form-label">Confirm Password:<span class="text-danger">*</span></label>
            <div class="col-sm-10 col-lg-10">
              <input id="confirm_password" name="confirm_password" type="password" class="form-control" placeholder="Confirm Password" value="">
            </div>
          </div>
          <div class=" form-group row">
            <label for="phone" class="col-sm-2 col-form-label">Phone:<span class="text-danger">*</span></label>
            <div class="col-sm-10 col-lg-10">
              <input id="phone" name="phone" type="phone" class="form-control" placeholder="Phone" value="<?=$userData['phone']?>">
            </div>
          </div>
          <div class=" form-group row">
            <label for="address_line_1" class="col-sm-2 col-form-label">Address Line1:<span class="text-danger">*</span></label>
            <div class="col-sm-10 col-lg-10">
              <input id="address_line_1" name="address_line_1" type="text" class="form-control" placeholder="Address Line1" value="<?=$userData['address_line1']?>">
            </div>
          </div>
          <div class=" form-group row">
            <label for="address_line_2" class="col-sm-2 col-form-label">Address Line2:</label>
            <div class="col-sm-10 col-lg-10">
              <input id="address_line_2" name="address_line_2" type="text" class="form-control" placeholder="Address Line2" value="<?=$userData['address_line2']?>">
            </div>
          </div>
          <div class=" form-group row">
            <label for="country_code" class="col-sm-2 col-form-label">Country Code:<span class="text-danger">*</span></label>
            <div class="col-sm-10 col-lg-10">
              <input id="country_code" name="country_code" type="text" class="form-control" placeholder="Country Code" value="<?=$userData['country']?>">
            </div>
          </div>
          <div class=" form-group row">
            <label for="state" class="col-sm-2 col-form-label">State:<span class="text-danger">*</span></label>
            <div class="col-sm-10 col-lg-10">
              <input id="state" name="state" type="text" class="form-control" placeholder="State" value="<?=$userData['state']?>">
            </div>
          </div>
          <div class=" form-group row">
            <label for="city" class="col-sm-2 col-form-label">City:<span class="text-danger">*</span></label>
            <div class="col-sm-10 col-lg-10">
              <input id="city" name="city" type="text" class="form-control" placeholder="City" value="<?=$userData['city']?>">
            </div>
          </div>
          <div class=" form-group row">
            <label for="zip" class="col-sm-2 col-form-label">Zip:<span class="text-danger">*</span></label>
            <div class="col-sm-10 col-lg-10">
              <input id="zip" name="zip" type="text" class="form-control" placeholder="Zip" value="<?=$userData['zip']?>">
            </div>
          </div>
        </div>

        <div class="mt-4 form-group row">
          <label for="zip" class="col-sm-2 col-form-label">&nbsp;</label>
          <div class="col-sm-10 col-lg-10">
            <button type="submit" class="btn btn-primary ">Register</button>
          </div>
        </div>
        </form>
        
      </div>
    </section><!-- End Profile Section -->

<?= $this->endSection('content'); ?>