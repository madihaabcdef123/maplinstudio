<?php $__env->startSection('content'); ?>

<div class="main-slider conts">
    <div class="carousel slide" data-ride="carousel" id="carousel-example-generic">

        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <!-- <img src="<?php echo e(asset((isset($banner) && isset($banner->img))?$banner->img:'web/images/expert-ban.png')); ?>" alt="<?php echo e(((isset($banner) && isset($banner->name))?$banner->name:Helper::config('websitename'))); ?>" width="100%"> -->

                <img src="<?php echo e(asset('web/images/808.gif')); ?>" class="head_lazy"
                    data-src="<?php echo e(asset((isset($banner) && isset($banner->img))?$banner->img:'web/images/expert-ban.png')); ?>">


                <div class="carousel-caption">
                    <h1 class="wow zoomInRight" data-wow-delay="0.2s" data-wow-duration="2s">Meet Your Local Experts
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="p_band_38wP p_narrow_cNBm contactinfo_contactpage">
    <div class="p_container_2yE8">
        <div class="p_expert-locator_1UXs">

            <div class="p_search-form_Z_AT wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="2s"
                style="visibility: visible; animation-duration: 2s; animation-delay: 0.3s; animation-name: fadeInUp;">
                <label>Find your local experts</label>
                <div class="p_search-bar-container_DWxI">
                    <form class="p_search-bar_1i-Z"><span class="p_visually-hidden_1Vqi"><label
                                for="expert-search-bar-input">Enter postcode</label></span><input type="text"
                            id="myInput" placeholder="Ex: 10001" class="p_lpe-search-field_3Ys0" name="postcode">
                        <button data-testid="expert-search-bar-button" class="p_search_2IlK"
                            type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="p_band_38wP p_alternate_w8AS contactinfo_contactpage">
    <div class="Particles-js3" id="particles-js"></div>
    <div class="p_container_2yE8">
        <div class="p_intro_30fb p_text-container_3rf0 wow fadeInRight" data-wow-delay="0.3s" data-wow-duration="2s"
            style="visibility: visible; animation-duration: 2s; animation-delay: 0.3s; animation-name: fadeInRight;">

            <?php echo (html_entity_decode(Helper::editck('h2', 'p_heading_V20h p_margin-bottom_15-T p_medium_3Ef4', '', '', 'Local experts focused on your needs', 'h2DiscPrivacLocal experts focused on your needstionn TouhEaah3'))); ?>


            <?php echo (html_entity_decode(Helper::editck('p', '', '', '', 'Our local experts arenbased in branchesYou can book valuations', 'pDiscPOur local experts arenbased in branchesYou can book valuationseedstionn TouhEaah3'))); ?>


        </div>
        <div class="p_container_25sH" id="finder">

            <?php if($experts): ?>
            <?php $__currentLoopData = $experts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="p_item_1WHE col-xs-6 col-sm-4 col-md-2 wow fadeInLeft searching-element"
                data-postcode="<?php echo e($expert->postcode); ?>" data-wow-delay="0.3s" data-wow-duration="2s"
                style="visibility: visible; animation-duration: 2s; animation-delay: 0.3s; animation-name: fadeInLeft;">

                <a href="<?php echo e(route('book_expert_detail', $expert->id)); ?>">
                    <div class="p_tile_28UT">
                        <div class="p_thumbnail_3_IK">
                            <picture>
                                <!-- <source
                                        srcset="<?php echo e(asset($expert->img)); ?>"
                                        media="(min-width: 768px)"> -->

                                <!-- <img src="<?php echo e(asset($expert->img)); ?>"
                                         srcset="<?php echo e(asset($expert->img)); ?>"
                                         alt="<?php echo e($expert->postcode); ?>" width="183" height="183" loading="lazy"> -->

                                <img src="<?php echo e(asset('web/images/1488.gif')); ?>" class="lazy"
                                    data-src="<?php echo e(asset($expert->img)); ?>" alt="" />

                            </picture>
                        </div>
                        <p class="p_title_2QQG"><?php echo e($expert->details); ?></p>
                    </div>
                </a>

            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            

        </div>
    </div>
</div>


<?php echo $__env->make('web.extends.footer-layer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<style type="text/css"></style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
$("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    console.log(value);
    if (value != "") {
        $(".searching-element").each(function(i, e) {
            if ($(e).data("postcode") == value) {
                $(e).show()
            } else {
                $(e).hide()
            }
        })
    } else {
        $(".searching-element").show();
    }

});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\abeer.khan\Desktop\huzaifa\maplin\resources\views/web/book_expert.blade.php ENDPATH**/ ?>