<?php if(isset($images) && collect($images)->count()): ?>
<div class="row row-cols-4">
    <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col">
            <img src="<?php echo e(images($img->image)); ?>" alt="<?php echo e($img->name); ?>" class="img-thumbnail">
            <div class="w-100"></div>
            <button type="button" class="btn btn-danger mt-3 delete-img" data-url="<?php echo e(route('backend.images.destroy', ['image' => $img->id])); ?>">Del</button>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php endif; ?>
<?php $__env->startPush('script'); ?>
    <script>
        $(function() {
            $(document).on('click', '.delete-img', function(e) {
                e.preventDefault();
                var $this = $(this);
                $.post({
                    type: 'DELETE',
                    url: $this.data('url')
                }).done(function (data) {
                    $this.parents('.col').remove();
                });
            })
        })
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /app/www/resources/views/includes/images.blade.php ENDPATH**/ ?>