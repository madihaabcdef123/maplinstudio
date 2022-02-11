<?php $__env->startSection('content'); ?>

    <!-- Begin: Crousel -->
    <div class="main-slider conts">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <!-- <img src="<?php echo e(asset((isset($banner) && isset($banner->img))?$banner->img:'web/images/Layer-22.png')); ?>" alt="<?php echo e(((isset($banner) && isset($banner->name))?$banner->name:Helper::config('websitename'))); ?>" width="100%"> -->


                    <img src="<?php echo e(asset('web/images/808.gif')); ?>" class="head_lazy" data-src="<?php echo e(asset((isset($banner) && isset($banner->img))?$banner->img:'web/images/Layer-22.png')); ?>" width="100%">

                    <div class="carousel-caption">

                        <h1 class="wow zoomInRight" data-wow-duration="2s" data-wow-delay="0.2s">News</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="main_news">
        <div class="Particles-js3" id="particles-js"></div>
        <div class="container">
            <div class="brokrg-head wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="2s">
                <?php echo (html_entity_decode(Helper::editck('h2', '', '', '', 'News & Videos' ,'h2News & VideosEaah3')));?>
                <?php echo (html_entity_decode(Helper::editck('p', '', '', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua' ,'pLorum dolor sit amet, concit, sed do mpor incagna aliquaEaah3')));?>    
              </div>
            <div class="row">
                <?php if($news): ?>
                <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 col-xs-12 col-sm-6">
                    <div class="main-eductn">
                        <div class="row wow fadeInLeft" data-wow-delay="0.3s" data-wow-duration="2s">
                            <div class="col-md-5 col-xs-12 col-sm-5 divAlign">
                                <!-- <img src="<?php echo e(asset($new->img)); ?>" class="img-responsive" alt="<?php echo e($new->name); ?>"> -->


                                <img src="<?php echo e(asset('web/images/1488.gif')); ?>" class="lazy" data-src="<?php echo e(asset($new->img)); ?>" alt="<?php echo e($new->name); ?>" />
                            </div>
                            <div class="col-md-7 col-xs-12 col-sm-7">
                                <div class="kids_txt">
                                    <h2><?php echo e($new->name); ?></h2>
                                 <p><?php echo e($new->details); ?><a href="<?php echo e(route('news_detail_display',$new->id)); ?>">[Details]</a></p>
                                    <span><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo e(date("M d/Y", strtotime($new->created_at))); ?> </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                
            </div>
            

        </div>
    </section>


    <?php echo $__env->make('web.extends.footer-layer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?> <?php $__env->startSection('css'); ?>
    <style type="text/css">
        
    </style>
<?php $__env->stopSection(); ?>
 <?php $__env->startSection('js'); ?>
<script type="text/javascript">
  $("img").lazyload({
        effect : "fadeIn"
    });
</script>


 <?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/maplin/resources/views/web/news.blade.php ENDPATH**/ ?>