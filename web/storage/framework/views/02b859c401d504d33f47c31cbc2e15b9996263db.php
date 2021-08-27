<?php $__env->startSection('title', 'Login'); ?>
<?php $__env->startPush('script'); ?>
<script>
    $(function() {
        $('#staticBackdrop').modal('show');
    })
</script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
            <div class="container-fluid">
                <form method="POST" action="<?php echo e(route('login.login')); ?>">
                    <?php echo csrf_field(); ?>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="row mb-3">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" id="inputEmail3">
                        <div class="form-text">Email: admin@gmail.com</div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" id="inputPassword3">
                        <div class="form-text">Password: admin@123</div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </form>
            </div>
        </div>
      </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /app/www/resources/views/login.blade.php ENDPATH**/ ?>