

<?php $__env->startSection('content'); ?>
 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Пользователи</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Главная</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
    <div class="row">
    <div class="col-12">
    <div class="card">
      <div class="card-header">
        <a href="<?php echo e(route('admin.user.create')); ?>" class="btn btn-primary">Добавить</a>
    </div>
    <div class="card-body">
    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
      <div class="row">
        <div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
    <thead>
    <tr>
      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 7%;">ID</th>
      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Имя</th>
      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Email</th>
      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Роль</th>
    </thead>
    <tbody>
      <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
      <tr class="odd" onclick="window.location='<?php echo e(route('admin.user.show', $user->id)); ?>';" style="cursor: pointer">
        <td class="dtr-control sorting_1" tabindex="0"><?php echo e($user->id); ?></td>
        <td><?php echo e($user->name); ?></td>
        <td><?php echo e($user->email); ?></td>
        <td><?php echo e($user->role->name); ?></td>
        </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
    <tfoot>
    <tr>
      <th rowspan="1" colspan="1">ID</th>
      <th rowspan="1" colspan="1">Имя</th>
      <th rowspan="1" colspan="1">Email</th>
      <th rowspan="1" colspan="1">Роль</th>
    </tr>
    </tfoot>
    </table></div></div></div></div></div></div></div></div>
    </section>
  <!-- /.content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\maksi\Desktop\Мои_сайты\kitprotv\resources\views/admin/user/index.blade.php ENDPATH**/ ?>