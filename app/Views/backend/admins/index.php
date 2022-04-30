<?= $this->extend('layout/backend-layout'); ?>

<?=$this->section("styles")?>
 <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url()?>/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url()?>/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url()?>/backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<?=$this->endSection()?> 

<?= $this->section('content'); ?>

        
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-12">

            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">&nbsp;</h3>
                <div class="text-right">
                <a class="btn btn-primary" href="<?php echo route_to('admin.create'); ?>">Add New Admin</a>
              </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if($admins): ?>
                  <?php foreach($admins as $admin): ?>
                  <tr>
                    <td><?php echo $admin['id']; ?></td>
                    <td><?php echo $admin['first_name']; ?></td>
                    <td><?php echo $admin['last_name']; ?></td>
                    <td><?php echo $admin['username']; ?></td>
                    <td><?php echo $admin['email']; ?></td>
                    <td><?php echo $admin['phone']; ?></td>
                    <td> 
                      <a class="btn btn-info" href="<?php echo route_to('admin.view',$admin['id']); ?>">Show</a>    
                      <a class="btn btn-primary" href="<?php echo route_to('admin.edit',$admin['id']); ?>">Edit</a>   
                      <a class="btn btn-danger" href="<?php echo route_to('admin.delete',$admin['id']); ?>">Delete</a> 
                    </td>
                  </tr>
                  <?php endforeach; ?>
                  <?php endif; ?>               
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">


        </div>
        <!-- /.row (main row) -->
      

<?= $this->endSection('content'); ?>

<?=$this->section("scripts")?>
<!-- DataTables  & Plugins -->
<script src="<?=base_url()?>/backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url()?>/backend/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url()?>/backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?=base_url()?>/backend/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url()?>/backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?=base_url()?>/backend/plugins/jszip/jszip.min.js"></script>
<script src="<?=base_url()?>/backend/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?=base_url()?>/backend/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?=base_url()?>/backend/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?=base_url()?>/backend/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?=base_url()?>/backend/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false
      //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        
  });
</script>
<?=$this->endSection()?>