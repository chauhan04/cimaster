

  <?php if(session()->getFlashdata('msg')):?>
    <div class="alert alert-success alert-dismissible fade show">
      <button type="button" class="btn-close" data-dismiss="alert"></button>    
      <strong><?= session()->getFlashdata('msg') ?></strong>
    </div>
  <?php endif;?>

  <?php if(session()->getFlashdata('err_msg')):?>
    <div class="alert alert-danger alert-dismissible fade show">
      <button type="button" class="btn-close" data-dismiss="alert"></button>    
      <strong><?= session()->getFlashdata('err_msg') ?></strong>
    </div>
  <?php endif;?>

  <?php if(session()->getFlashdata('info_msg')):?>
    <div class="alert alert-info alert-dismissible fade show">
      <button type="button" class="btn-close" data-dismiss="alert"></button>    
      <strong><?= session()->getFlashdata('info_msg') ?></strong>
    </div>
  <?php endif;?>

  <?php if(session()->getFlashdata('warn_msg')):?>
    <div class="alert alert-warning alert-dismissible fade show">
      <button type="button" class="btn-close" data-dismiss="alert"></button>    
      <strong><?= session()->getFlashdata('warn_msg') ?></strong>
    </div>
<?php endif;?>
