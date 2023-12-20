

<?php $__env->startSection('content'); ?>
 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Категория</h1>
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
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header d-flex p-3" >
              <div class="mr-3">
                <a href="<?php echo e(route('admin.category.edit', $category->id)); ?>" class="btn btn-primary">Редактировать</a>
              </div>
                <form action="<?php echo e(route('admin.category.destroy', $category->id)); ?>" method="post">
                  <?php echo csrf_field(); ?>
                  <?php echo method_field('delete'); ?>
                  <input type="submit" class="btn btn-danger" value="Удалить">
                </form>
            </div>
            
            <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">

            <tbody>
            <tr>
                <td>ID</td>
                <td><?php echo e($category->id); ?></td>
            </tr>
            <tr>
              <td>Наименование</td>
              <td><?php echo e($category->name); ?></td>
            </tr>

            <tr>
              <td>Транскрипция</td>
              <td><?php echo e($category->slug); ?></td>
            </tr>

            <tr>
              <td>Фото</td>
              <td>
                
                <img src="/Content/Category/thumbnails/<?php echo e($category->thumbnail); ?>" alt="<?php echo e($category->thumbnail); ?>" style="max-width: 30%">
              </td>
            </tr>

            <tr>
              <td>Дочерние категории</td>
            <td>
                <?php if($category->children->count() > 0): ?>
                    <ul>
                        <?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="<?php echo e(route('admin.category.show', $child->id)); ?>" style="color:black"><?php echo e($child->name); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php else: ?>
                    Нет дочерних категорий
                <?php endif; ?>
            </td>
          </tr>
            </tbody>
            </table>
            </div>
            
            </div>
            
            </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.statusPopUp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\maksi\Desktop\Мои_сайты\kitprotv\resources\views/admin/category/show.blade.php ENDPATH**/ ?>