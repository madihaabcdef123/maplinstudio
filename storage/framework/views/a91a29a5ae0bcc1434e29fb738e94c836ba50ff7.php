
<?php $__env->startSection('content'); ?>    
    
<div class="main-slider conts">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="<?php echo e(asset('wen/images/Layer-22.png')); ?>" alt="banner" width="100%" />
                <div class="carousel-caption">
                    <h1 class="wow zoomInRight" data-wow-duration="2s" data-wow-delay="0.2s">Reset Password</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="contact-page-main log-in-page-main pt-80 pb-80 contactinfo_contactpage">
    <div class="Particles-js3" id="particles-js"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 wow fadeInLeft" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInLeft;">
                <div class="log-in-wrap">
                    <h2><?php echo e(__('Resets Password')); ?></h2>
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    <form id="forms-signin" method="POST" action="<?php echo e(route('password.email')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input id="emailaddress" placeholder="Enter your email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>

                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="login_btn"><?php echo e(__('Send Password Reset Link')); ?></button>
                        </div>
                        <div class="col-md-12 mt-3">
                            <a class="btn btn-link" href="<?php echo e(url('/signup')); ?>">
                                        Or Login
                                    </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


   
<?php $__env->stopSection(); ?>


<?php echo $__env->make('web.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\abeer.khan\Desktop\huzaifa\maplin\resources\views/auth/passwords/email.blade.php ENDPATH**/ ?>