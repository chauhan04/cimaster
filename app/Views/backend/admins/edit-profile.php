<?= $this->extend('layout/backend-layout'); ?>
<?= $this->section('content'); ?>

<div class="card card-primary card-outline">

<form id="adminProfileForm" name="adminProfileForm" action="<?=route_to("admin.profile.store")?>" method="post">

  <!-- /.card-header -->
  <div class="card-body">
<?php
//echo "<pre>".print_r($adminData,true)."</pre>";
?>
    <?php if(isset($validation)):?>
        <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
    <?php endif;?>
    <input type="hidden" name="id" value="<?=$adminData['id']?>">
    <div class="form-group">
      <label for="first_name" >First Name:<span class="text-danger">*</span></label>
      <input id="first_name" name="first_name" type="text" class="form-control" placeholder="First Name" value="<?=$adminData['first_name']?>">
    </div>
    <div class="form-group">
      <label for="last_name" class="col-sm-2 col-form-label">Last Name:<span class="text-danger">*</span></label>
      <input id="last_name" name="last_name" type="text" class="form-control" placeholder="Last Name" value="<?=$adminData['last_name']?>">
    </div>
    <div class=" form-group">
      <label for="username" class="col-sm-2 col-form-label">Username:<span class="text-danger">*</span></label>
      <input id="username" name="username" type="text" class="form-control" placeholder="Username" value="<?=$adminData['username']?>">
    </div>
    <div class=" form-group">
      <label for="email" class="col-sm-2 col-form-label">Email:<span class="text-danger">*</span></label>
      <input id="email" name="email" type="email" class="form-control" placeholder="Email Address" value="<?=$adminData['email']?>">
    </div>
    <div class=" form-group">
      <label for="phone" class="col-sm-2 col-form-label">Phone:<span class="text-danger">*</span></label>
      <input id="phone" name="phone" type="phone" class="form-control" placeholder="Phone" value="<?=$adminData['phone']?>">
    </div>
    <div class=" form-group">
      <label for="address_line_1" class="col-sm-2 col-form-label">Address Line1:<span class="text-danger">*</span></label>
      <input id="address_line_1" name="address_line_1" type="text" class="form-control" placeholder="Address Line1" value="<?=$adminData['address_line1']?>">
    </div>
    <div class=" form-group">
      <label for="address_line_2" class="col-sm-2 col-form-label">Address Line2:</label>
      <input id="address_line_2" name="address_line_2" type="text" class="form-control" placeholder="Address Line2" value="<?=$adminData['address_line2']?>">
    </div>
    <div class=" form-group">
      <label for="country_code" class="col-sm-2 col-form-label">Country Code:<span class="text-danger">*</span></label>
      <input id="country_code" name="country_code" type="text" class="form-control" placeholder="Country Code" value="<?=$adminData['country']?>">
    </div>
    <div class=" form-group">
      <label for="state" class="col-sm-2 col-form-label">State:<span class="text-danger">*</span></label>
      <input id="state" name="state" type="text" class="form-control" placeholder="State" value="<?=$adminData['state']?>">
    </div>
    <div class=" form-group">
      <label for="city" class="col-sm-2 col-form-label">City:<span class="text-danger">*</span></label>
      <input id="city" name="city" type="text" class="form-control" placeholder="City" value="<?=$adminData['city']?>">
    </div>
    <div class=" form-group">
      <label for="zip" class="col-sm-2 col-form-label">Zip:<span class="text-danger">*</span></label>
      <input id="zip" name="zip" type="text" class="form-control" placeholder="Zip" value="<?=$adminData['zip']?>">
    </div>

  </div>
  <!-- /.card-body -->
  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>

  </form>

</div>
<!-- /.card -->

<?= $this->endSection('content'); ?>

<?=$this->section("styles")?>

<?=$this->endSection()?>  
  
<?=$this->section("scripts")?>
<script src="<?= base_url('/backend/plugins/jquery-validation/jquery.validate.min.js') ?>"></script>
<script>
$(function () {
  /*$.validator.setDefaults({
    submitHandler: function () {
      //alert( "Form successful submitted!" );
    }
  });*/
  $('#adminProfileForm').validate({
    rules: {
      first_name: {
        required: true,
      },
      last_name: {
        required: true,
      },
      username: {
        required: true,
        minlength: 5
      },
      email: {
        required: true,
        email: true,
      },
      phone: {
        required: true,
      },
      address_line_1: {
        required: true,
      },
      country_code: {
        required: true,
      },
      state: {
        required: true,
      },
      city: {
        required: true,
      },
      zip: {
        required: true,
      }      
    },
    messages: {
      first_name: {
        required: "Please enter first name"
      },
      last_name: {
        required: "Please enter last name"
      },
      username: {
        required: "Please provide username",
        minlength: "Your username must be at least 5 characters long"
      },
      email: {
        required: "Please enter a email address",
        email: "Please enter a valid email address"
      },
      phone: {
        required: "Please enter phone"
      },
      address_line_1: {
        required: "Please enter Address Line1"
      },
      country_code: {
        required: "Please enter country code"
      },
      state: {
        required: "Please enter state"
      },
      city: {
        required: "Please enter city"
      },
      zip: {
        required: "Please enter zip"
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
<?=$this->endSection()?>