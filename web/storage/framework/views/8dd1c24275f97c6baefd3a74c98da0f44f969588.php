<?php $__env->startSection('title', 'Product form'); ?>
<?php $__env->startPush('script'); ?>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#idDescription'
        });
    </script>
<?php $__env->stopPush(); ?>
<?php
    $action = isset($product) ? route('backend.products.update', ['product' => $product->id]) : route('backend.products.store');
?>
<?php $__env->startSection('content'); ?>
<form method="POST" action="<?php echo e($action); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php if(isset($product)): ?>
        <input type="hidden" name="_method" value="PUT">
    <?php endif; ?>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="alert alert-danger"><?php echo e($message); ?></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if(session('status')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end sticky-top">
                <a href="<?php echo e(route('backend.products.index')); ?>" class="btn btn-info">Back</a>
                <button class="btn btn-primary">Save</button>
                <?php if(isset($product)): ?>
                <a href="<?php echo e(route('backend.products.create')); ?>" class="btn btn-success">Create</a>
                <?php endif; ?>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label for="idName" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="idName" value="<?php echo e(isset($product) ? $product->name : old('name')); ?>">
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="idPrice" class="form-label">Price</label>
                    <input type="number" step="any" class="form-control" name="price" id="idPrice" value="<?php echo e(isset($product) ? $product->price : old('price')); ?>">
                </div>
                <div class="col-12 mb-3">
                    <label for="idSpecialPrice" class="form-label">Special price</label>
                    <input type="number" step="any" class="form-control" name="special_price" id="idSpecialPrice" value="<?php echo e(isset($product) ? $product->special_price : old('special_price')); ?>">
                </div>
                <div class="col-12 mb-3">
                    <label for="idDescription" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="idDescription" rows="5" style="height: 350px;"> <?php echo e(isset($product) ? $product->description : old('description')); ?></textarea>
                </div>
                <div class="col-lg-6 mb-3">
                    <label class="form-label">Brands</label>
                    <select class="form-select" name="brand_id" aria-label="Default select example">
                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($brand->id); ?>" <?php echo e(isset($product) && $product->brand_id == $brand->id ? 'selected' : ''); ?>><?php echo e($brand->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="idSort" class="form-label">Position</label>
                    <input type="number" class="form-control" name="sort" id="idSort" value="<?php echo e(isset($product) ? $product->sort : old('sort')); ?>">
                </div>
                <div class="col-12 mb-3">
                    <label for="idImage" class="form-label">Images</label>
                    <div class="fallback">
                        <input name="images[]" type="file" multiple />
                    </div>
                </div>
                <?php if(isset($product) && $product->images): ?>
                    <?php echo $__env->make('includes.images', ['images' => $product->images], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /app/www/resources/views/products/form.blade.php ENDPATH**/ ?>