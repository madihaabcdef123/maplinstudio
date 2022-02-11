<?php $__env->startSection('content'); ?>

    <div class="main-slider conts">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">

                    <!-- <img src="<?php echo e(asset((isset($banner) && isset($banner->img))?$banner->img:'web/images/bi.png')); ?>" alt="<?php echo e(((isset($banner) && isset($banner->name))?$banner->name:Helper::config('websitename'))); ?>" width="100%"> -->

                    <img src="<?php echo e(asset('web/images/808.gif')); ?>" class="head_lazy" data-src="<?php echo e(asset((isset($banner) && isset($banner->img))?$banner->img:'web/images/bi.png')); ?>" >

                    <div class="carousel-caption">

                        <h1 class="wow zoomInRight" data-wow-duration="2s" data-wow-delay="0.2s">STUDIO</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="terms contactinfo_contactpage new">
        <div class="Particles-js3" id="particles-js"></div>
        <div class="container">

            <div class="row">
                <div class="term-condition">
                    <div class="col-md-12 col-sm-6">
                        <?php echo (html_entity_decode(Helper::editck('h2', 'wow zoomInRight', '0.3s', '2s', 'STUDIO' ,'h2STUDIOssssssh3')));?>
                        <?php echo (html_entity_decode(Helper::editck('p', 'wow zoomIn', '0.6s', '2s', 'Lorem ipsum dolor sit amet, est id putant fabulas ponderum, mundi libris omnium in sea. Mei porro' ,'pSTUDIOssssssLorem ipsum dolor sit amet, est id putant fabulas ponderum, mundi libris omnium in sea. Mei porroh3')));?>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="sec_one contactinfo_contactpage">
        <div class="container-fluid">
            <div class="row">

                <?php if($studios): ?>
                <?php $__currentLoopData = $studios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $studio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 col-sm-6 col-xs-12 sec_onea">
                    <a href="<?php echo e(route('studio_detail',$studio->id)); ?>">
                        <div class="sec_oneb wow fadeInLeft" data-wow-duration="2s" data-wow-delay="0.3s">
                            <div class="dts">
                                <!-- <img src="<?php echo e(asset($studio->banner_img)); ?>" alt="<?php echo e($studio->name); ?>" class="img-responsive"> -->

                                <img src="<?php echo e(asset('web/images/1488.gif')); ?>" class="lazy" data-src="<?php echo e(asset($studio->banner_img)); ?>" alt="" />
                                <div class="projet">
                                    <h6><?php echo e($studio->name); ?></h6>
                                </div>
                            </div>

                        </div>
                    </a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                

            </div>
        </div>
    </section>



<?php echo $__env->make('web.extends.footer-layer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?> 
<?php $__env->startSection('css'); ?>
    <style type="text/css"></style>
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('js'); ?> 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/maplin/resources/views/web/studio.blade.php ENDPATH**/ ?>