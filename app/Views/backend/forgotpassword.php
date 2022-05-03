<?= $this->extend('layout/backend-auth-layout'); ?>
<?= $this->section('content'); ?>

  <div class="card card-outline card-primary">

    <div class="card-header text-center">
      <a href="<?php echo route_to('admin.login'); ?>" class="h1"><b>CI</b> Master</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Enter email to reset your password</p>

      <form action="<?php echo route_to('admin.forgotpassword.link'); ?>" method="post">
        <div class="input-group mb-3">
          <input name="email" type="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-8">

          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      
      <p class="mb-1">
        <a href="<?php echo route_to('admin.login'); ?>">Sign In</a>
      </p>

    </div>
    <!-- /.card-body -->
  </div>

<?= $this->endSection('content'); ?>
