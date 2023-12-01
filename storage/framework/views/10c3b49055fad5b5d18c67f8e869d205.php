

<?php $__env->startSection('content'); ?>
<section class="home">
    <div class="_container">
        <div class="home__body">
          <h1>Профиль</h1>
          <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
          onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
           <?php echo e(__('Logout')); ?>

       </a>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\maksi\Desktop\Мои_сайты\kitprotv\resources\views/API/profile.blade.php ENDPATH**/ ?>