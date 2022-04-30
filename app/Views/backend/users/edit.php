<?= $this->extend('layout/backend-layout'); ?>
<?= $this->section('content'); ?>

<div class="card card-primary card-outline">

<form id="userEditForm" name="userEditForm" action="<?=route_to("user.edit.save")?>" method="post">

  <!-- /.card-header -->
  <div class="card-body">
<?php
//echo "<pre>".print_r($userData,true)."</pre>";
?>
    <?php if(isset($validation)):?>
        <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
    <?php endif;?>
    <input type="hidden" name="id" value="<?=$userData['id']?>">
    <div class="form-group">
      <label for="first_name" class="col-sm-2 col-form-label">First Name:<span class="text-danger">*</span></label>
      <input id="first_name" name="first_name" type="text" class="form-control" placeholder="First Name" value="<?=$userData['first_name']?>">
    </div>
    <div class="form-group">
      <label for="last_name" class="col-sm-2 col-form-label">Last Name:<span class="text-danger">*</span></label>
      <input id="last_name" name="last_name" type="text" class="form-control" placeholder="Last Name" value="<?=$userData['last_name']?>">
    </div>
    <div class=" form-group">
      <label for="username" class="col-sm-2 col-form-label">Username:<span class="text-danger">*</span></label>
      <input id="username" name="username" type="text" class="form-control" placeholder="Username" value="<?=$userData['username']?>">
    </div>
    <div class=" form-group">
      <label for="email" class="col-sm-2 col-form-label">Email:<span class="text-danger">*</span></label>
      <input id="email" name="email" type="email" class="form-control" placeholder="Email Address" value="<?=$userData['email']?>">
    </div>
    <div class=" form-group">
      <label for="password" class="col-sm-2 col-form-label">Password:</label>
      <input id="password" name="password" type="password" class="form-control" placeholder="Password" value="">
    </div>
    <div class=" form-group">
      <label for="confirm_password" class="col-sm-2 col-form-label">Confirm Password:</label>
      <input id="confirm_password" name="confirm_password" type="password" class="form-control" placeholder="Confirm Password" value="">
    </div>
    <div class=" form-group">
      <label for="phone" class="col-sm-2 col-form-label">Phone:<span class="text-danger">*</span></label>
      <input id="phone" name="phone" type="phone" class="form-control" placeholder="Phone" value="<?=$userData['phone']?>">
    </div>
    <div class=" form-group">
      <label for="address_line_1" class="col-sm-2 col-form-label">Address Line1:<span class="text-danger">*</span></label>
      <input id="address_line_1" name="address_line_1" type="text" class="form-control" placeholder="Address Line1" value="<?=$userData['address_line1']?>">
    </div>
    <div class=" form-group">
      <label for="address_line_2" class="col-sm-2 col-form-label">Address Line2:</label>
      <input id="address_line_2" name="address_line_2" type="text" class="form-control" placeholder="Address Line2" value="<?=$userData['address_line2']?>">
    </div>
    <div class=" form-group">
      <label for="country_code" class="col-sm-2 col-form-label">Country Code:<span class="text-danger">*</span></label>
      <input id="country_code" name="country_code" type="text" class="form-control" placeholder="Country Code" value="<?=$userData['country']?>">
    </div>
    <div class=" form-group">
      <label for="state" class="col-sm-2 col-form-label">State:<span class="text-danger">*</span></label>
      <input id="state" name="state" type="text" class="form-control" placeholder="State" value="<?=$userData['state']?>">
    </div>
    <div class=" form-group">
      <label for="city" class="col-sm-2 col-form-label">City:<span class="text-danger">*</span></label>
      <input id="city" name="city" type="text" class="form-control" placeholder="City" value="<?=$userData['city']?>">
    </div>
    <div class=" form-group">
      <label for="zip" class="col-sm-2 col-form-label">Zip:<span class="text-danger">*</span></label>
      <input id="zip" name="zip" type="text" class="form-control" placeholder="Zip" value="<?=$userData['zip']?>">
    </div>
    <div class=" form-group">
      <label for="status" class="col-sm-2 col-form-label">Status:<span class="text-danger">*</span></label>
      <select id="status" name="status" class="custom-select rounded-0" id="exampleSelectRounded0">
        <option value="1" <?=($userData['status']==1)?'selected="selected"':''?>>Active</option>
        <option value="0" <?=($userData['status']==0)?'selected="selected"':''?>>Inactive</option>
      </select>
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

  $('#userEditForm').validate({
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