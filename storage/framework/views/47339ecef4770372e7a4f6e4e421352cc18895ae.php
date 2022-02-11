<?php $__env->startSection('content'); ?>

<div class="main-slider conts">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <!-- <img src="<?php echo e(asset('web/images/ellipsis.gif')); ?>" alt="banner" width="100%" />
 -->                <img src="<?php echo e(asset('web/images/808.gif')); ?>" class="head_lazy" data-src="<?php echo e(asset('web/images/proj-ban.png')); ?>" >
                <div class="carousel-caption">
                    <h1 class="wow zoomInRight" data-wow-duration="2s" data-wow-delay="0.2s">Project Detail</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="porperty-detail-sec contactinfo_contactpage">
    <div class="container">
        <div class="Particles-js3" id="particles-js"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12" style="padding: 30px;">
                <div class="property-detail-heading">
                    <h2><?php echo e($getOneExpert->name); ?></h2>
                </div>
            </div>

            <div class="description-sec-main">
                <div class="col-md-9 col-sm-9">
                    <div class="detail-content-sec">

                        <div class="col-md-4 col-sm-4">


                            <div class="item">
                                  
                                  <!-- <img src="<?php echo e(asset($getOneExpert->img)); ?>" alt="<?php echo e(Helper::config('websitename')); ?>" class="img-responsive" /> -->

                                  <img src="<?php echo e(asset('web/images/1488.gif')); ?>" class="lazy" data-src="<?php echo e(asset($getOneExpert->img)); ?>" alt="" />
                            </div>

                        </div>

                        <div class="col-md-8 col-sm-8">
                            <div class="property-description-sec wow fadeInLeft" data-wow-delay="0.3s" data-wow-duration="3s">
                                <h2>Detail</h2>
                                <?php echo html_entity_decode($getOneExpert->long_details) ?>
                            </div>
                        </div>

                      
                    </div>
                </div>

                <div class="col-md-3 col-sm-3">
                    <div class="properly-search-main">
                        <div class="properly-search-sec">
                            <h2>All Expert</h2>

                            <div class="latest-property-tab wow fadeInRight" data-wow-delay="0.2s" data-wow-duration="2s">
                                
                                <?php if($getAllExpert): ?> <?php $__currentLoopData = $getAllExpert; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <a href="<?php echo e(route('book_expert_detail', $value->id)); ?>">
                                    <div class="property-sec-tab">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-4">
                                                <div class="latest-img-sec">
                                                    <img src="<?php echo e(asset($value->img)); ?>" class="img-responsive" alt="<?php echo e(Helper::config('websitename')); ?>"/>
                                                </div>
                                            </div>

                                            <div class="col-md-8 col-sm-8 no_pad">
                                                <div class="latest-content-sec">
                                                    <h3><?php echo e($value->name); ?></h3>
                                                    <span><b><?php echo e($value->details); ?></b> </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>

                                 
                            </div>
                        </div>

                        <div class="properly-search-sec wow fadeInRight" data-wow-delay="0.3s" data-wow-duration="3s">
                            <h2>Login</h2>

                            <form>
                                <div class="properly-search-form">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <input type="text" name="username" placeholder="Username" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <input type="password" name="passowrd" placeholder="Password" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="login-btn-form">
                                                <input type="submit" value="Login" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <p>Need an account? Register here! Forgot Password?</p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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

<?php echo $__env->make('web.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/maplin/resources/views/web/book_expert_detail.blade.php ENDPATH**/ ?>