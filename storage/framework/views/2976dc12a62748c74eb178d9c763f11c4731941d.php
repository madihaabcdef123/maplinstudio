<?php $__env->startSection('content'); ?>
<style>
footer
{
    display: none;
}

</style>

    <div class="main-slider">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

            <div class="carousel-inner" role="listbox">
                <div class="item active">

                    <video id="vid" autoplay muted="" loop="true" title="<?php echo e(((isset($banner) && isset($banner->name))?$banner->name:Helper::config('websitename'))); ?>">

                        <source src="<?php echo e(asset((isset($banner) && isset($banner->img))?$banner->img:'web/images/test.mp4')); ?>" type="video/mp4">

                        Your browser does not support the video tag.
                    </video>
                    <div class="carousel-caption">
                        <!-- <h2 class="wow fadeInLeft" data-wow-duration="2s" data-wow-delay="0.2s">WELCOME TO</h2>
                        <h1 class="wow lightSpeedIn " data-wow-duration="2s" data-wow-delay="0.8s">MAPLIN STUDIO</h1> -->

                        <!-- <a href="<?php echo e(route('book_expert')); ?>" class="wow lightSpeedIn btnv-vs" data-wow-duration="4s" data-wow-delay="0.8s">Book a Free Site Visit</a> -->

                    </div>

                </div>
            </div>

        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

    <style type="text/css">
    </style>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/maplin/resources/views/web/index.blade.php ENDPATH**/ ?>