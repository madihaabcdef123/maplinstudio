 <?php $__env->startSection('content'); ?>

<div class="main-slider conts">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">

                <!-- <img src="<?php echo e(asset($studio->banner_img)); ?>" alt="<?php echo e($studio->name); ?>" width="100%" /> -->

                <img src="<?php echo e(asset('web/images/808.gif')); ?>" class="head_lazy" data-src="<?php echo e(asset($studio->banner_img)); ?>"
                    width="100%">

                <div class="carousel-caption">
                    <h1 class="wow zoomInRight" data-wow-duration="2s" data-wow-delay="0.2s">Studio Detail</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="floor_plan_content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row divAlign">
                    <div class="col-sm-6 wow fadeInLeft" data-wow-duration="2s" data-wow-delay="0.3s">
                        <!-- <img src="<?php echo e(asset($studio->inner_1_img)); ?>" alt="<?php echo e($studio->name); ?>" /> -->
                        <img src="<?php echo e(asset('web/images/1488.gif')); ?>" class="lazy"
                            data-src="<?php echo e(asset($studio->inner_1_img)); ?>" alt="" />
                        <!-- <h2>3D TOUR</h2> -->
                    </div>
                    <div class="col-sm-6 wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.3s">
                        <!-- <img src="<?php echo e(asset($studio->inner_2_img)); ?>" alt="<?php echo e($studio->name); ?>" /> -->
                        <img src="<?php echo e(asset('web/images/1488.gif')); ?>" class="lazy"
                            data-src="<?php echo e(asset($studio->inner_2_img)); ?>" alt="" />
                        <!-- <h2>STUDIO PLAN</h2> -->
                    </div>
                </div>
            </div>
            <div class="col-sm-12">

                <div class="detail wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.3s">
                    <h2>DETAILS</h2>
                    <p class="wow fadeInLeft" data-wow-duration="3s" data-wow-delay="0.3s">
                        <?php echo html_entity_decode($studio->details); ?></p>
                </div>

            </div>
            <div class="col-sm-12">
                <div class="row gallery">
                    <h2 class="text-center">GALLERY</h2>
                    <div class="Particles-js3" id="particles-js"></div>
                    <?php
                    $list = array("wow fadeInLeft", "wow fadeInDown", "wow fadeInRight", "wow fadeInUp");
                    ?>
                    <?php if($gallery): ?>
                    <?php $__currentLoopData = $gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-4 <?php echo e($list[rand(0,3)]); ?>" data-wow-duration="2s" data-wow-delay="0.3s">
                        <div class="recent-blk mrgn-btm divAlign">
                            <!-- <img src="<?php echo e(asset($img->path)); ?>" /> -->

                            <img src="<?php echo e(asset('web/images/1488.gif')); ?>" class="lazy" data-src="<?php echo e(asset($img->path)); ?>"
                                alt="" />

                            <a data-fancybox="gallery" href="<?php echo e(asset($img->path)); ?>"><i class="fa fa-search"
                                    aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    
        </div>
    </div>
    </div>
    </div>
</section>

<?php echo $__env->make('web.extends.footer-layer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php $__env->stopSection(); ?> <?php $__env->startSection('css'); ?>
<style type="text/css"></style>
<?php $__env->stopSection(); ?> <?php $__env->startSection('js'); ?> <?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\abeer.khan\Desktop\huzaifa\maplin\resources\views/web/studio_detail.blade.php ENDPATH**/ ?>