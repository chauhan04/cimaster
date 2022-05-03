<script>
  <?php if(session()->getFlashdata('msg')):?>
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
    toastr.success("<?= session()->getFlashdata('msg') ?>");
  <?php endif;?>

  <?php if(session()->getFlashdata('err_msg')):?>
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
    toastr.error("<?= session()->getFlashdata('err_msg') ?>");
  <?php endif;?>

  <?php if(session()->getFlashdata('info_msg')):?>
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
    toastr.info("<?= session()->getFlashdata('info_msg') ?>");
  <?php endif;?>

  <?php if(session()->getFlashdata('warn_msg')):?>
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
    toastr.warning("<?= session()->getFlashdata('warn_msg') ?>");
<?php endif;?>
</script>