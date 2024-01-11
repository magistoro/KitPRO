<?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
    <a  onclick="window.location='<?php echo e(route('admin.sale.show', $notification->id)); ?>';" class="text-muted">Посмотреть</a>
    <button onclick="redirectToOrder('<?php echo e(route('admin.sale.show', '')); ?>/<?php echo e($notification->id); ?>')">Посмотреть</button>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\Users\maksi\Desktop\Мои_сайты\kitprotv\resources\views/layouts/notifications.blade.php ENDPATH**/ ?>