<?php $__env->startSection('content'); ?>


<div class="main-slider conts">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">

                <!-- <img src="<?php echo e(asset((isset($banner) && isset($banner->img))?$banner->img:'web/images/bi.png')); ?>" alt="<?php echo e(((isset($banner) && isset($banner->name))?$banner->name:Helper::config('websitename'))); ?>" width="100%">
            <div class="carousel-caption"> -->

                <img src="<?php echo e(asset('web/images/808.gif')); ?>" class="head_lazy"
                    data-src="<?php echo e(asset((isset($banner) && isset($banner->img))?$banner->img:'web/images/bi.png')); ?>">

                <h1 class="wow zoomInRight" data-wow-duration="2s" data-wow-delay="0.2s">Our Projects</h1>
            </div>
        </div>
    </div>
</div>
</div>

<section class="terms contactinfo_contactpage new">
    <div class="Particles-js3" id="particles-js"></div>
    <div class="container">

        <div class="row">
            <div class="col-12">
                <div class="term-condition">
                    <?php echo (html_entity_decode(Helper::editck('h2', 'wow zoomIn', '0.3s', '2s', 'OUR PROJECTS' ,'h2OURPROJECTSh1')));?>

                    <?php echo (html_entity_decode(Helper::editck('p', 'wow zoomIn', '0.6s', '2s', 'Lorem ipsum dolor sit amet, est id putant fabulas ponderum, mundi libris omnium in sea. Mei porro' ,'pLorem ipsumdolorsit amet, putantfabulasmundilibrisporroh1')));?>

                </div>
            </div>

        </div>
    </div>
</section>

<section class="sec_one alldat contactinfo_contactpage">
    <div class="Particles-js3" id="particles-js"></div>
    <div class="container-fluid">
        <div class="row">

            <?php if($projects): ?>
            <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-2 col-md-4 col-sm-3 col-xs-12 sec_onea">
                <a href="<?php echo e(route('project_detail',$project->id)); ?>">
                    <div class="sec_oneb wow fadeInLeft" data-wow-duration="2s" data-wow-delay="0.3s">
                        <div class="dts">
                            <img src="<?php echo e(asset($project->img)); ?>" alt="<?php echo e($project->name); ?>" class="img-responsive">

                            <!-- <img src="<?php echo e(asset('web/images/1488.gif')); ?>" class="lazy" data-src="<?php echo e(asset($project->img)); ?>" alt="" /> -->

                            <div class="projet">
                                <h6><?php echo e($project->name); ?></h6>
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

<?php $__env->stopSection(); ?> <?php $__env->startSection('css'); ?>
<style type="text/css"></style>
<?php $__env->stopSection(); ?> <?php $__env->startSection('js'); ?> <?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/maplin/resources/views/web/project.blade.php ENDPATH**/ ?>