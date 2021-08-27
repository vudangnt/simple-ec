<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="storage-url" content="<?php echo e(url('storage/')); ?>">
    <base href="<?php echo e(url('/')); ?>">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- google fonts icon -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <?php echo $__env->yieldPushContent('style'); ?>
  </head>
  <body>
        <div id="app">
            <header class="mb-3">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="<?php echo e(route('frontend.home')); ?>">Shopinvest</a>
                        </div>
                        <div class="account-cart d-flex align-items-center">
                            <div class="account ">
                                <?php if(!Auth::check()): ?>
                                    <a href="<?php echo e(route('login.index')); ?>" class=" d-flex align-items-center">
                                        <span>Login</span>
                                        <span class="material-icons ps-1">login</span>
                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('user.logout')); ?>" class=" d-flex align-items-center">
                                        <span class="pe-1"><?php echo e(Auth::user()->name); ?></span>
                                        <span class="material-icons">logout</span>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="minicart">
                                <div class=" d-flex align-items-center">
                                    <span>My cart</span>
                                    <span class="material-icons ps-1">shopping_basket</span>
                                </div>
                                <?php echo $__env->make('frontend.includes.minicart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="container">
                <ul id="movieList"></ul>
                <?php echo $__env->yieldContent('content'); ?>
            </div>
            <footer class="text-center">
                Copyright &copy; <?php echo e(date('Y')); ?> Shopinvest
            </footer>
        </div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="http://borismoore.github.io/jquery-tmpl/jquery.tmpl.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script>
        window.listProducts = <?php echo json_encode($viewProducts); ?>;
    </script>
    <script type="text/javascript" src="<?php echo e(asset('js/app.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('script'); ?>
  </body>
</html>
<?php /**PATH /app/www/resources/views/frontend/app.blade.php ENDPATH**/ ?>