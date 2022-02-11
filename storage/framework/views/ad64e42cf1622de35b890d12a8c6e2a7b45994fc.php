
<?php $__env->startSection('content'); ?>

<!-- Begin: Crousel -->
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

                    <h1 class="wow zoomInRight" data-wow-duration="2s" data-wow-delay="0.2s">Sign Up / Log In</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="contact-page-main log-in-page-main pt-80 pb-80 contactinfo_contactpage">
    <div class="Particles-js3" id="particles-js"> </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 wow fadeInLeft" data-wow-delay="0.4s"
                style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInLeft;">
                <div class="log-in-wrap">
                    <h2>Login To Your Account</h2>

                    <form id="forms-signin" method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input id="emailaddress" placeholder="Enter your email" type="email"
                                        class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email"
                                        value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input id="password" type="password"
                                        class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password"
                                        required autocomplete="current-password" placeholder="Enter your password">

                                </div>
                            </div>

                            <div class="col-md-12 ">
                                <button type="submit" class="login_btn">LOGIN</button>
                            </div>
                            <div class="col-md-12 mt-3">

                                <?php if(Route::has('password.request')): ?>
                                <div class="forgot-pass">
                                    <a href="<?php echo e(route('password.request')); ?>"><?php echo e(__('Forgot Your Password?')); ?></a>
                                </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6 wow fadeInRight" data-wow-delay="0.4s"
                style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInRight;">
                <div class="log-in-wrap">
                    <h2>Register Your Account</h2>

                    <form id="forms-signup" method="POST" action="<?php echo e(route('register')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input id="name" type="text"
                                        class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name"
                                        value="<?php echo e(old('name')); ?>" placeholder="Enter your name" required
                                        autocomplete="name" autofocus>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input id="email" type="email"
                                        class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email"
                                        value="<?php echo e(old('email')); ?>" placeholder="Enter your email address" required
                                        autocomplete="email">
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <input id="password" type="password"
                                        class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password"
                                        required placeholder="Enter your Password" autocomplete="new-password">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input id="password-confirm" placeholder="Re-Enter your password" type="password"
                                        class="form-control" name="password_confirmation" required
                                        autocomplete="new-password">
                                </div>
                            </div>


                            <div class="col-md-12">
                                <p class="agree-text">By creating an account, You agree to our <a class="term-condition"
                                        href="<?php echo e(route('terms')); ?>">Terms &amp; Condition</a></p>
                            </div>

                            <div class="col-md-12">
                                <button id="signup-btn" type="submit" class="login_btn">CREATE ACCOUNT</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php echo $__env->make('web.extends.footer-layer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->stopSection(); ?> <?php $__env->startSection('css'); ?>
<style type="text/css"></style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\abeer.khan\Desktop\huzaifa\maplin\resources\views/web/signup.blade.php ENDPATH**/ ?>