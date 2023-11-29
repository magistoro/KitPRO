

<?php $__env->startSection('content'); ?>

<?php
    $page_scss = 'resources/scss/pages/categories.scss';
?>

<section class="categories">
    <div class="_container">
        <div class="categories__body">
            <h1><?php echo e($category->name); ?></h1>
            
            <div class="breadcrumbs">
                <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('categories.index', ['category'=> $breadcrumb['slug']])); ?>" class="breadcrumb"> <?php echo e($breadcrumb['name']); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="categories__grid">
                <?php $__currentLoopData = $children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('categories.index', ['category'=> $child['slug']])); ?>" class="categories__item _ibg">
                        <img src="Content/Category/thumbnails/<?php echo e($child['thumbnail']); ?>" alt="<?php echo e($child['slug']); ?> thumbnail">
                        <p><?php echo e($child['name']); ?></p>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\maksi\Desktop\Мои_сайты\kitprotv\resources\views/category/index.blade.php ENDPATH**/ ?>