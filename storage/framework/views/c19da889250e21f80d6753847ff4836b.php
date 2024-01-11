


<?php $__env->startSection('content'); ?>
 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Заказ</h1>
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
                <a href="<?php echo e(route('admin.sale.edit',  $soldOrder->id)); ?>" class="btn btn-primary">Редактировать</a>
              </div>

            


              <div class="dropdown mr-3">
                <button class="btn btn-primary dropdown-toggle" type="button" id="statusDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Выберите статус
                </button>
                <div class="dropdown-menu" aria-labelledby="statusDropdown">
                    <form action="<?php echo e(route('admin.sale.updateStatus', $soldOrder->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        <button type="submit" name="status" value="Собрано" class="dropdown-item bg-<?php echo e(($soldOrder->status === 'Новый') ? 'success' : 'danger'); ?>">Собрать заказ</button>
                        <button type="submit" name="status" value="Отправлено" class="dropdown-item bg-<?php echo e(($soldOrder->status === 'Собран') ? 'success' : 'danger'); ?>">Отправить заказ</button>
                        <button type="submit" name="status" value="Получено" class="dropdown-item bg-<?php echo e(($soldOrder->status === 'Отправлено') ? 'success' : 'danger'); ?>">Получить заказ</button>

                        <button type="submit" name="status" value="Отменён" class="dropdown-item bg-warning">Отменить</button>
                    </form>
                </div>
            </div>
            

            
              <div class="mr-3">
                <?php if($soldOrder->status === 'Получено'): ?>
                <a class="btn btn-success">Статус: <?php echo e($soldOrder->status); ?></a>
                <?php elseif($soldOrder->status === 'Отменён'): ?>
                <a class="btn btn-dark ">Статус: <?php echo e($soldOrder->status); ?></a>
                <?php elseif($soldOrder->status === 'Отправлено'): ?>
                <a class="btn btn-warning">Статус: <?php echo e($soldOrder->status); ?></a>
                <?php elseif($soldOrder->status === 'Собран'): ?>
                <a class="btn btn-danger">Статус: <?php echo e($soldOrder->status); ?></a>
                <?php else: ?>
                <a class="btn btn-info">Статус: <?php echo e($soldOrder->status); ?></a>
                <?php endif; ?>
              </div>
                
            </div>
            
            <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">

            <tbody>
            <tr>
                <td>ID</td>
                <td><?php echo e($soldOrder->id); ?></td>
            </tr>

            <tr>
                <td>Имя создателя аакаунта</td>
                <td><a href="<?php echo e(route('admin.user.show', $soldOrder->user->id)); ?>"><?php echo e($soldOrder->user->name); ?></a></td>
            </tr>

            <tr>
              <td>Имя получателя заказа</td>
              <td><?php echo e($soldOrder->customer_to); ?></td>
            </tr>

            <tr>
              <td>Телефон</td>
              <td class="text-wrap"><?php echo e($soldOrder->customer_phone); ?></td>
            </tr>

            <tr>
              <td>Email</td>
              <td><?php echo e($soldOrder->customer_email); ?></td>
            </tr>

            <tr>
              <td>Адрес</td>
              <td><?php echo e($soldOrder->address); ?></td>
            </tr>

            <tr>
              <td>Коментарий</td>
              <td><?php echo e($soldOrder->comment); ?></td>
            </tr> 
           
            </tbody>
            </table>

          </div>
        </div>

          <div class="col-12">
            <div class="card">
              <table class="table pt-5">
                <thead>
                    <tr>
                        <th>Товары в заказе</th>
                        <th>Цена товара</th>
                        <th>Количество</th>
                        <th>Общая цена</th>
                        <th>Статус сборки</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $orderSoldProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderSoldProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($orderSoldProduct->product->name); ?></td>
                            <td><?php echo e($orderSoldProduct->product->price); ?></td>
                            <td><?php echo e($orderSoldProduct->quantity); ?></td>
                            <td><?php echo e($orderSoldProduct->product->price *  $orderSoldProduct->quantity); ?></td>
                            <td>
                              <div class="checkbox icheck">
                                  <label>
                                      <input type="checkbox" disabled <?php if($orderSoldProduct->assembled_at): ?> checked <?php endif; ?>>
                                      <span></span>
                                  </label>
                              </div>
                          </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

  <style>

.checkbox.icheck label input[type="checkbox"] {
    display: none;
}

.checkbox.icheck label input[type="checkbox"] + span {
    display: inline-block;
    width: 20px;
    height: 20px;
    position: relative;
    border: 1px solid #ccc;
    background-color: #fa5050;
}

.checkbox.icheck label input[type="checkbox"] + span::before {
    content: "\2713";
    display: none;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
}

.checkbox.icheck label input[type="checkbox"]:checked + span {
    background-color: #51cd51;
}

.checkbox.icheck label input[type="checkbox"]:checked + span::before {
    display: block;
}
  </style>

 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts.statusPopUp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\maksi\Desktop\Мои_сайты\kitprotv\resources\views/admin/sale/show.blade.php ENDPATH**/ ?>