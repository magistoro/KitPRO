

<?php
    $page_scss = 'resources/scss/pages/single-product.scss';
?>

<?php $__env->startSection('content'); ?>
<section class="product">
    <div class="_container">
        <div class="product__body">
            <h1><?php echo e($product->name); ?></h1>
            
            <div class="breadcrumbs">
                <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('categories.index', ['category'=> $breadcrumb['slug']])); ?>" class="breadcrumb"> <?php echo e($breadcrumb['name']); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            PRODUCT <br>    
            <img src="Content/Product/images/<?php echo e($product->image); ?>" alt="<?php echo e($product->slug); ?> image">
            
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\maksi\Desktop\Мои_сайты\kitprotv\resources\views/product/show.blade.php ENDPATH**/ ?>