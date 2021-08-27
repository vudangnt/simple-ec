<?php $__env->startSection('title', 'Product list'); ?>
<?php $__env->startSection('content'); ?>
    <?php if($products): ?>
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $img = $product->images()->first();
        ?>
        <div class="col">
            <div class="image mb-3">
                <?php if($img): ?>
                    <a href="<?php echo e(route('frontend.product.detail', ['slug' => $product->slug])); ?>">
                        <img src="<?php echo e(images($img->image)); ?>" alt="<?php echo e($img->name); ?>" class="img-thumbnail">
                    </a>
                <?php endif; ?>
            </div>
            <div class="desc pb-3">
                <div class="title mb-1"><a href="<?php echo e(route('frontend.product.detail', ['slug' => $product->slug])); ?>"><?php echo e($product->name); ?></a></div>
                <div class="price mb-1"><span class="me-3">Price: <span> <span class="fw-bolder"> &euro; <?php echo e($product->price); ?></span></div>
                <button class="btn btn-primary btn-add-to-cart" data-id="<?php echo e($product->id); ?>">Add to cart</button>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /app/www/resources/views/frontend/products/list.blade.php ENDPATH**/ ?>