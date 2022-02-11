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

                        <h1 class="wow zoomInRight" data-wow-duration="2s" data-wow-delay="0.2s">Privacy Policy</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="terms contactinfo_contactpage">
        <div class="Particles-js3" id="particles-js"></div>
        <div class="container">

            <div class="row">
                <div class="term-condition">
                    <div class="col-md-12 col-sm-6">
                        <?php echo (html_entity_decode(Helper::editck('h2', 'wow zoomIn', '0.3s', '2s', 'Privacy Policy' ,'h2DiscPrivacy Policymern TouhEaah3')));?>

                        <?php echo (html_entity_decode(Helper::editck('p', 'wow zoomIn', '0.6s', '2s', 'Lorem ipsum dolor sit amet, est id putant fabulas ponderum, mundi libris omnium in sea. Mei poratu voluptatibus no,t id putant fabulas ponderum, mundi lnium in sea.is omnium in sea. Me' ,'pDim ipsum dolor sit amet, est id putant fabulas ponderum, mundi libris omnium in sea. Mei poratu voluptatibus no,t id putaPrivacy Policymern TouhEaah3')));?>

                        <?php echo (html_entity_decode(Helper::editck('p', 'wow zoomIn', '0.6s', '2s', 'Lorem ipsum dolor sit amet, est id putant fabulas ponderum, mundi libris omnium in sea. Mei poratu voluptatibus no,t id putant fabulas ponderum, mundi lnium in sea.is omnium in sea. Me' ,'pDiscPrivacy Policymern m ipsum dolor sit amet, est id putant fabulas ponderum, mundi libris omnium in sea. Mei poratu voluptatibus no,t id putahEaah3')));?>

                        <?php echo (html_entity_decode(Helper::editck('p', 'wow zoomIn', '0.6s', '2s', 'Lorem ipsum dolor sit amet, est id putant fabulas ponderum, mundi libris omnium in sea. Mei poratu voluptatibus no,t id putant fabulas ponderum, mundi lnium in sea.is omnium in sea. Me' ,'pDiscPrivacy Policm ipsum dolor sit amet, est id putant fabulas ponderum, mundi libris omnium in sea. Mei poratu voluptatibus no,t id putamern TouhEaah3')));?>

                        <?php echo (html_entity_decode(Helper::editck('p', 'wow zoomIn', '0.6s', '2s', 'Lorem ipsum dolor sit amet, est id putant fabulas ponderum, mundi libris omnium in sea. Mei poratu voluptatibus no,t id putant fabulas ponderum, mundi lnium in sea.is omnium in sea. Me' ,'p Policm ipsum dolor sit amet, est id putant fabulas ponderum, mundi libris omnium in sea. Mei poratu voluptatibus no,t id putah3')));?>

                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php echo $__env->make('web.extends.footer-layer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?> <?php $__env->startSection('css'); ?>
    <style type="text/css"></style>
<?php $__env->stopSection(); ?> <?php $__env->startSection('js'); ?> <?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\abeer.khan\Desktop\huzaifa\maplin\resources\views/web/privacy.blade.php ENDPATH**/ ?>