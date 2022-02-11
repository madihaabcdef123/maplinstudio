<?php $__env->startSection('content'); ?>

<div class="main-slider conts">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <!-- <img src="<?php echo e(asset((isset($banner) && isset($banner->img))?$banner->img:'web/images/Layer-22.png')); ?>" alt="<?php echo e(((isset($banner) && isset($banner->name))?$banner->name:Helper::config('websitename'))); ?>" width="100%"> -->


                <img src="<?php echo e(asset('web/images/808.gif')); ?>" class="head_lazy"
                    data-src="<?php echo e(asset((isset($banner) && isset($banner->img))?$banner->img:'web/images/Layer-22.png')); ?>"
                    width="100%">

                <div class="carousel-caption">

                    <h1 class="wow zoomInRight" data-wow-duration="2s" data-wow-delay="0.2s">Contact Us</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="contactinfo_contactpage">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php echo (html_entity_decode(Helper::editck('h2', 'wow zoomIn', '0.3s', '2s', 'Get In Touch' ,'h2Get In TouhEaah3')));?>
                <?php echo (html_entity_decode(Helper::editck('p', 'wow zoomIn', '0.6s', '2s', 'Lorem ipsum dolor sit amet, est id putant fabulas ponderum, mundi libris omnium in ' ,'pLorem ipsumit amet, est id putant fabulas um, mundiuin uhEaah3')));?>
            </div>
        </div>
        <div class="Particles-js3" id="particles-js"></div>
        <div class="contact-form col-md-8">
            <div class="row">
                <form method="POST" action="<?php echo e(route('contact_submit')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="user_id" value="<?php echo e(!is_null(Auth::user())?Auth::user()->id:'0'); ?>">
                    <div class="col-md-6 col-sm-6">
                        <div class="name form-group wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.2s">
                            <input type="text" name="first_name" class="form-control" placeholder="Your First name"
                                required="">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="name form-group wow fadeInLeft" data-wow-duration="2s" data-wow-delay="0.3s">
                            <input type="text" name="last_name" class="form-control" placeholder="Your Last name"
                                required="">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="phone form-group wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.4s">
                            <input type="email" name="email" class="form-control" placeholder="Your Email Address"
                                required="">
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12">
                        <div class="details form-group wow fadeInLeft" data-wow-duration="2s" data-wow-delay="0.5s">
                            <textarea name="message" required="" rows="8" class="form-control"
                                placeholder="Comment"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group wow zoomInUp" data-wow-duration="2s" data-wow-delay="0.7s">
                            <button type="submit">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="cont col-md-4">
            <div class="row">
                <div class="contact-info wow zoomInRight" data-wow-duration="2s" data-wow-delay="0.3s">
                    <div class="col-md-3">
                        <div class="cicle-icon">
                            <img src="<?php echo e(asset('web/images/location-icon.png')); ?>" class="img-responsive" alt="">
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="contact_text">
                            <h2>Address</h2>
                            <p><?php echo e(Helper::config('address')); ?></p>
                        </div>
                    </div>
                </div>

                <div class="contact-info wow zoomInLeft" data-wow-duration="2s" data-wow-delay="0.3s">
                    <div class="col-md-3">
                        <div class="cicle-icon">
                            <img src="<?php echo e(asset('web/images/phone.png')); ?>" class="img-responsive" alt="">
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="contact_text">
                            <h2>Phone</h2>
                            <p><a href="tel:<?php echo e(Helper::config('contactnumber')); ?>"><?php echo e(Helper::config('contactnumber')); ?></a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="contact-info wow zoomInLeft" data-wow-duration="2s" data-wow-delay="0.5s">
                    <div class="col-md-3">
                        <div class="cicle-icon">
                            <img src="<?php echo e(asset('web/images/email-icon.png')); ?>" class="img-responsive" alt="">
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="contact_text">
                            <h2>Email</h2>
                            <p><a href="mailto:<?php echo e(Helper::config('emailaddress')); ?>"
                                    class="email-text"><?php echo e(Helper::config('emailaddress')); ?></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<?php echo $__env->make('web.extends.footer-layer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->stopSection(); ?> <?php $__env->startSection('css'); ?>
<style type="text/css"></style>
<?php $__env->stopSection(); ?> <?php $__env->startSection('js'); ?> <?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Mini\V3\maplin\resources\views/web/contact.blade.php ENDPATH**/ ?>