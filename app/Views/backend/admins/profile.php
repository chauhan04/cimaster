<?= $this->extend('layout/backend-layout'); ?>
<?= $this->section('content'); ?>

<div class="card card-primary card-outline">
<?php
if($isProfile == true) {
?>
  <div class="card-header">

    <div class="card-tools">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
      <a href="<?=route_to("admin.profile.edit")?>" class="btn btn-block btn-primary btn-sm">Edit</a>
    </div>
    <!-- /.card-tools -->
  </div>
<?php
}
?>
  <!-- /.card-header -->
  <div class="card-body">
<?php
//echo "<pre>".print_r($adminData,true)."</pre>";
?>
    <div class=" ">
      <div class=" row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">First Name:</label>
        <div class="col-sm-10">
          <?=$adminData['first_name']?>
        </div>
      </div>
      <div class=" row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Last Name:</label>
        <div class="col-sm-10">
          <?=$adminData['last_name']?>
        </div>
      </div>
      <div class=" row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Username:</label>
        <div class="col-sm-10">
          <?=$adminData['username']?>
        </div>
      </div>
      <div class=" row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Email:</label>
        <div class="col-sm-10">
          <?=$adminData['email']?>
        </div>
      </div>
      <div class=" row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Phone:</label>
        <div class="col-sm-10">
          <?=$adminData['phone']?>
        </div>
      </div>
      <div class=" row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Address Line1:</label>
        <div class="col-sm-10">
          <?=$adminData['address_line1']?>
        </div>
      </div>
      <div class=" row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Address Line2:</label>
        <div class="col-sm-10">
          <?=$adminData['address_line2']?>
        </div>
      </div>
      <div class=" row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Country Code:</label>
        <div class="col-sm-10">
          <?=$adminData['country']?>
        </div>
      </div>
      <div class=" row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">State:</label>
        <div class="col-sm-10">
          <?=$adminData['state']?>
        </div>
      </div>
      <div class=" row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">City:</label>
        <div class="col-sm-10">
          <?=$adminData['city']?>
        </div>
      </div>
      <div class=" row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Zip:</label>
        <div class="col-sm-10">
          <?=$adminData['zip']?>
        </div>
      </div>
    </div>
    <?php
    if($isProfile == false) {
    ?>
    <div class="mt-4">
        <a href="<?=route_to("admin.edit",$adminData['id'])?>" class="btn btn-info">Edit Admin</a>
        <a href="<?=route_to("admin.list")?>" class="btn btn-default">Back</a>
    </div>
    <?php
    }
    ?>
  </div>
  <!-- /.card-body -->

</div>
<!-- /.card -->

<?= $this->endSection('content'); ?>