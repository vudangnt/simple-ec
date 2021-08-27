<?php $__env->startSection('title', 'List brands'); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-grid gap-2 mb-3 d-md-flex justify-content-md-end">
            <a href="<?php echo e(route('backend.brands.create')); ?>" class="btn btn-primary me-md-2" type="button">Create</a>
        </div>
        <?php echo $__env->make('includes.table-list', ['columns' => ['name'], 'items' => $brands, 'module' => 'brand'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /app/www/resources/views/brands/index.blade.php ENDPATH**/ ?>