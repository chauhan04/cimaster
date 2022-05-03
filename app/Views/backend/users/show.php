<?= $this->extend('layout/backend-layout'); ?>
<?= $this->section('content'); ?>

<div class="card card-primary card-outline">

  <!-- /.card-header -->
  <div class="card-body">
<?php
//echo "<pre>".print_r($userData,true)."</pre>";
?>
    <div class=" mt-4">
      <div class=" row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">First Name:</label>
        <div class="col-sm-10">
          <?=$userData['first_name']?>
        </div>
      </div>
      <div class=" row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Last Name:</label>
        <div class="col-sm-10">
          <?=$userData['last_name']?>
        </div>
      </div>
      <div class=" row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Username:</label>
        <div class="col-sm-10">
          <?=$userData['username']?>
        </div>
      </div>
      <div class=" row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Email:</label>
        <div class="col-sm-10">
          <?=$userData['email']?>
        </div>
      </div>
      <div class=" row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Phone:</label>
        <div class="col-sm-10">
          <?=$userData['phone']?>
        </div>
      </div>
      <div class=" row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Address Line1:</label>
        <div class="col-sm-10">
          <?=$userData['address_line1']?>
        </div>
      </div>
      <div class=" row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Address Line2:</label>
        <div class="col-sm-10">
          <?=$userData['address_line2']?>
        </div>
      </div>
      <div class=" row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Country Code:</label>
        <div class="col-sm-10">
          <?=$userData['country']?>
        </div>
      </div>
      <div class=" row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">State:</label>
        <div class="col-sm-10">
          <?=$userData['state']?>
        </div>
      </div>
      <div class=" row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">City:</label>
        <div class="col-sm-10">
          <?=$userData['city']?>
        </div>
      </div>
      <div class=" row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Zip:</label>
        <div class="col-sm-10">
          <?=$userData['zip']?>
        </div>
      </div>
    </div>

    <div class="mt-4">
        <a href="<?=route_to("user.edit",$userData['id'])?>" class="btn btn-info">Edit Admin</a>
        <a href="<?=route_to("user.list")?>" class="btn btn-default">Back</a>
    </div>

  </div>
  <!-- /.card-body -->

</div>
<!-- /.card -->

<?= $this->endSection('content'); ?>