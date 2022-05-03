<?= $this->extend('layout/backend-layout'); ?>
<?= $this->section('content'); ?>

<div class="card card-primary card-outline">

  <!-- /.card-header -->
  <div class="card-body">
<?php
//echo "<pre>".print_r($userData,true)."</pre>";
?>
          <div class="col-12 text-center d-flex align-items-center justify-content-center">
            <div class="">
              <h2>CI Masster</h2>
              <p class="lead mb-5">Email us at <a href="mailto:developer8here@gmail.com">developer8here@gmail.com</a></p>
            </div>
          </div>
          <!-- <div class="col-7">
            <div class="form-group">
              <label for="inputName">Name</label>
              <input type="text" id="inputName" class="form-control" />
            </div>
            <div class="form-group">
              <label for="inputEmail">E-Mail</label>
              <input type="email" id="inputEmail" class="form-control" />
            </div>
            <div class="form-group">
              <label for="inputSubject">Subject</label>
              <input type="text" id="inputSubject" class="form-control" />
            </div>
            <div class="form-group">
              <label for="inputMessage">Message</label>
              <textarea id="inputMessage" class="form-control" rows="4"></textarea>
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-primary" value="Send message">
            </div>
          </div> -->
    

  </div>
  <!-- /.card-body -->

</div>
<!-- /.card -->

<?= $this->endSection('content'); ?>