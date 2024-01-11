

<?php $__env->startSection('content'); ?>
 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Заказы на продажу</h1>
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
        
    </div>
    <div class="card-body">
    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
      <div class="row">
        <div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
    <thead>
    <tr>
      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 7%;">ID</th>
      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Получатель</th>
      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Кол-во товаров</th>
      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Сумма заказа</th>
      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Статус</th>
    </thead>
    <tbody>
      <?php $__currentLoopData = $sold_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $soldOrder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php
          $totalQuantity = $soldOrder->orderSoldProducts->sum('quantity');
          $totalCost = 0;
      ?>
      <?php $__currentLoopData = $soldOrder->orderSoldProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderSoldProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
              $totalCost += $orderSoldProduct->quantity * $orderSoldProduct->product->price;
          ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <tr class="odd" onclick="window.location='<?php echo e(route('admin.sale.show', $soldOrder->id)); ?>';" style="cursor: pointer">
          <td class="dtr-control sorting_1" tabindex="0"><?php echo e($soldOrder->id); ?></td>
          <td><?php echo e($soldOrder->customer_to); ?></td>
          <td><?php echo e($totalQuantity); ?></td>
          <td><?php echo e($totalCost); ?></td>
          <td>
            <?php if($soldOrder->cancelled_at): ?>
            <span class="badge badge-warning">Отменён</span>
            <?php elseif($soldOrder->delivered_at): ?>
                <span class="badge badge-success">Получено</span>
            <?php elseif($soldOrder->dispatched_at): ?>
                <span class="badge badge-warning">Отправлено</span>
            <?php elseif($soldOrder->assembled_at): ?>
                <span class="badge badge-danger">Собран</span>
            <?php else: ?>
                <span class="badge badge-info">Новый</span>
            <?php endif; ?>
          </td>
      </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  
    </tbody>
    <tfoot>
    <tr>
      <th rowspan="1" colspan="1">ID</th>
      <th rowspan="1" colspan="1">Получатель</th>
      <th rowspan="1" colspan="1">Кол-во товаров</th>
      <th rowspan="1" colspan="1">Сумма заказа</th>
      <th rowspan="1" colspan="1">Статус</th>
    </tr>
    </tfoot>
    </table></div></div></div></div></div></div></div></div>
    </section>
  <!-- /.content -->
  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.statusPopUp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\maksi\Desktop\Мои_сайты\kitprotv\resources\views/admin/sale/index.blade.php ENDPATH**/ ?>