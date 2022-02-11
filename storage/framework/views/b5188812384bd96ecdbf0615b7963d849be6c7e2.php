<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<!-- START: Head-->

<head>
    <meta charset="UTF-8">
    <title><?php echo e(isset($title)?$title:Helper::config('websitename')); ?></title>
    <meta name="description" content="<?php echo e(isset($description)?$description:Helper::config('websitename')); ?>" />
    <meta name="keywords" content="<?php echo e(isset($keywords)?$keywords:Helper::config('websitename')); ?>">

    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- START: Template CSS-->
    <?php echo $__env->make('web.layouts.links', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('css'); ?>
    <!-- END: Custom CSS-->
</head>
<!-- END Head-->

<!-- START: Body-->

<body class="royal_preloader">
    <div id="myDiv">
        <div>
            <img id="loading-image" src="<?php echo e(asset('images/payment-animation.gif')); ?>" style="display:none;" />
        </div>
    </div>

    <div class="main-body">
        <input type="hidden" id="web_url" value="<?php echo e(url('/')); ?>" />
        <!-- START: Pre Loader-->
        <div class="se-pre-con">
            <div class="loader"></div>
        </div>
        <!-- END: Pre Loader-->

        <!-- START: Header-->
        <?php echo $__env->make('web.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- END: Header-->

        <!-- END: Main Menu-->

        <!-- START: Main Content-->
        <?php echo $__env->yieldContent('content'); ?>
        <!-- END: Content-->



        <?php echo $__env->make('web.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- START: Template JS-->
        <?php echo $__env->make('web.layouts.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->yieldContent('js'); ?>

    </div>
</body>
<!-- END: Body-->

</html><?php /**PATH E:\Mini\V3\maplin\resources\views/web/layouts/main.blade.php ENDPATH**/ ?>