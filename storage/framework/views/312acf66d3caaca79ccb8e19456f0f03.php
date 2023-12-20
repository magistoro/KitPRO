

<?php $__env->startSection('content'); ?>

<?php
    $page_scss = 'resources/scss/pages/cart.scss';
?>

<section class="home">
    <div class="_container">
        <div class="home__body">
          <h1>Корзина</h1>
          
          <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <?php if($purchaseItems->count() > 0): ?>
                                <h3 class="cart-header">Купить</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $purchaseItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <img src="Content/Product/thumbnails/<?php echo e($item->product->thumbnail); ?>" alt="<?php echo e($item->product->name); ?>" width="50px" height="50px">
                                                </td>
                                               <td> <a href="<?php echo e(route('products.show', ['category'=> $item->product->category->slug, 'product'=> $item->product->slug])); ?>"><?php echo e($item->product->name); ?></a></td>
                                                <td><?php echo e($item->product->price); ?></td>
                                                <td>
                                                    <form action="<?php echo e(route('cart.update', $item->id)); ?>" method="POST" class="d-flex">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PUT'); ?>
                                                        <input type="number" name="quantity" value="<?php echo e($item->quantity); ?>" min="1" class="form-control" style="width: 60px; margin-left:10px">
                                                        <button type="submit" class="btn btn-sm btn-primary ml-2">Update</button>
                                                    </form>
                                                </td>
                                                <td><?php echo e($item->product->price * $item->quantity); ?></td>
                                                <td>
                                                    <form action="<?php echo e(route('cart.destroy', $item->id)); ?>" method="POST" class="d-flex">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('delete'); ?>
                                                        <button type="submit" class="btn btn-sm btn-primary ml-2">Удалить</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <a class="cart-order" href="<?php echo e(route('orderBuy')); ?>">Оформить</a>
                            <?php endif; ?>
        
                            <?php if($rentItems->count() > 0): ?>
                                <h3 class="cart-header">Арендовать</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $rentItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <img src="Content/Product/thumbnails/<?php echo e($item->product->thumbnail); ?>" alt="<?php echo e($item->product->name); ?>" width="50px" height="50px">
                                                </td>
                                                <td> <a href="<?php echo e(route('products.show', ['category'=> $item->product->category->slug, 'product'=> $item->product->slug])); ?>"><?php echo e($item->product->name); ?></a></td>
                                                <td><?php echo e($item->product->price); ?></td>
                                                <td>
                                                    <form action="<?php echo e(route('cart.update', $item->id)); ?>" method="POST" class="d-flex">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PUT'); ?>
                                                        <input type="number" name="quantity" value="<?php echo e($item->quantity); ?>" min="1" class="form-control" style="width: 60px; margin-left:10px">
                                                        <button type="submit" class="btn btn-sm btn-primary ml-2">Update</button>
                                                    </form>
                                                </td>
                                                <td><?php echo e($item->product->price * $item->quantity); ?></td>
                                                <td>
                                                    <form action="<?php echo e(route('cart.destroy', $item->id)); ?>" method="POST" class="d-flex">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('delete'); ?>
                                                        <button type="submit" class="btn btn-sm btn-primary ml-2">Удалить</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <a class="cart-order" href="<?php echo e(route('orderRent')); ?>">Арендовать</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\maksi\Desktop\Мои_сайты\kitprotv\resources\views/API/cart.blade.php ENDPATH**/ ?>