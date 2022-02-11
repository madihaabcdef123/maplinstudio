<?php $__env->startSection('content'); ?>


<div class="main-slider conts">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <!-- <img src="<?php echo e(asset((isset($banner) && isset($banner->img))?$banner->img:'web/images/Layer-22.png')); ?>" alt="<?php echo e(((isset($banner) && isset($banner->name))?$banner->name:Helper::config('websitename'))); ?>" width="100%">
                    <div class="carousel-caption"> -->

                <img src="<?php echo e(asset('web/images/808.gif')); ?>" class="head_lazy"
                    data-src="<?php echo e(asset((isset($banner) && isset($banner->img))?$banner->img:'web/images/Layer-22.png')); ?>"
                    alt="<?php echo e(((isset($banner) && isset($banner->name))?$banner->name:Helper::config('websitename'))); ?>"
                    width="100%">

                <h1 class="wow zoomInRight" data-wow-duration="2s" data-wow-delay="0.2s">Career</h1>
            </div>
        </div>
    </div>
</div>
</div>


<section class="jobListing opportunities_sec all-section">
    <div class="Particles-js3" id="particles-js"></div>
    <div class="container">
        <div class="row">

            <div class="col-md-3 col-xs-12 col-sm-3">
                <div class="sideBar wow fadeInLeft" data-wow-delay="0.3s" data-wow-duration="2s">
                    <div class="panel-group" id="" role="" aria-multiselectable="">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="freshness">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#fresh"
                                        aria-expanded="true" aria-controls="collapseOne">
                                        Freshness <i class="fa fa-angle-down" aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="fresh" class="panel-collapse collapse in" role="tabpanel"
                                aria-labelledby="freshness">
                                <div class="panel-body">
                                    <label class="checkMain">Last 30 days
                                        <input type="checkbox" class="freshness" name="freshness" data-policy="less"
                                            value="30">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="checkMain">Last 15 days
                                        <input type="checkbox" class="freshness" name="freshness" data-policy="less"
                                            value="15">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="checkMain">Last 7 days
                                        <input type="checkbox" class="freshness" name="freshness" data-policy="less"
                                            value="7">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="checkMain">Last 3 days
                                        <input type="checkbox" class="freshness" name="freshness" data-policy="less"
                                            value="3">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="checkMain">Today
                                        <input type="checkbox" class="freshness" name="freshness" data-policy="less"
                                            value="0">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne">
                                        Job Title <i class="fa fa-angle-down" aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                                aria-labelledby="headingOne">
                                <div class="panel-body">

                                    <?php if($job_title): ?>
                                    <?php $__currentLoopData = $job_title; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label class="checkMain"><?php echo e($val->job_title); ?>

                                        <input type="checkbox" class="job_title" data-policy="same"
                                            value="<?php echo e($val->job_title); ?>">
                                        <span class="checkmark"></span>
                                    </label>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                        href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        City <i class="fa fa-angle-down" aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel"
                                aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <?php if($city): ?>
                                    <?php $__currentLoopData = $city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label class="checkMain"><?php echo e($val->city); ?>

                                        <input type="checkbox" class="city" data-policy="same" value="<?php echo e($val->city); ?>">
                                        <span class="checkmark"></span>
                                    </label>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                        href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Experience <i class="fa fa-angle-down" aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse  in" role="tabpanel"
                                aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <label class="checkMain">Fresh
                                        <input type="checkbox" class="experience" data-policy="less" data-policy="less"
                                            value="0">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="checkMain">Less than 1 Year
                                        <input type="checkbox" class="experience" data-policy="less" value="0.5">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="checkMain">1 Year
                                        <input type="checkbox" class="experience" data-policy="less" value="1">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="checkMain">2 Years
                                        <input type="checkbox" class="experience" data-policy="less" value="2">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="checkMain">3 Years
                                        <input type="checkbox" class="experience" data-policy="less" value="3">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="checkMain">4 Years
                                        <input type="checkbox" class="experience" data-policy="less" value="4">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="checkMain">5 Years
                                        <input type="checkbox" class="experience" data-policy="less" value="5">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="checkMain">6 Years
                                        <input type="checkbox" class="experience" data-policy="less" value="6">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingFour">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                        href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        Job Type <i class="fa fa-angle-down" aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse  in" role="tabpanel"
                                aria-labelledby="headingFour">
                                <div class="panel-body">
                                    <?php if($job_type): ?>
                                    <?php $__currentLoopData = $job_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label class="checkMain"><?php echo e($type->employment_type); ?>

                                        <input type="checkbox" class="job_type" data-policy="same"
                                            value="<?php echo e($type->employment_type); ?>">
                                        <span class="checkmark"></span>
                                    </label>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingFive">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                        href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        Skills <i class="fa fa-angle-down" aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse  in" role="tabpanel"
                                aria-labelledby="headingFive">
                                <div class="panel-body">
                                    <?php if($all_skills): ?>
                                    <?php $__currentLoopData = $all_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($val != ""): ?>
                                    <label class="checkMain"><?php echo e($val); ?>

                                        <input type="checkbox" class="skills" data-policy="match" value="<?php echo e($val); ?>">
                                        <span class="checkmark"></span>
                                    </label>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingsix">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                        href="#collapsesix" aria-expanded="false" aria-controls="collapseFive">
                                        Work location <i class="fa fa-angle-down" aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapsesix" class="panel-collapse collapse  in" role="tabpanel"
                                aria-labelledby="headingFive">
                                <div class="panel-body">
                                    <?php if($working_location): ?>
                                    <?php $__currentLoopData = $working_location; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label class="checkMain"><?php echo e($location->role_location); ?>

                                        <input type="checkbox" class="role_location" data-policy="same"
                                            value="<?php echo e($location->role_location); ?>">
                                        <span class="checkmark"></span>
                                    </label>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-9 col-xs-12 col-sm-9 n-featured-jobs">
                <div class="n-featured-job-boxes wow fadeInRight" data-wow-delay="0.3s" data-wow-duration="2s">

                    <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <!-- Job Box -->
                    <?php
                    $now = strtotime(date("Y-m-d")); // or your date as well
                    $your_date = strtotime(date("Y-m-d", strtotime($value->created_at)));
                    $datediff = $now - $your_date;
                    $freshness = round($datediff / (60 * 60 * 24));

                    ?>
                    <div class="n-job-single all-careers" data-job_title="<?php echo e($value->job_title); ?>"
                        data-city="<?php echo e($value->city); ?>" data-freshness="<?php echo e($freshness); ?>"
                        data-experience="<?php echo e($value->experience); ?>" data-skills="<?php echo e($value->skills); ?>"
                        data-job_type="<?php echo e($value->employment_type); ?>" data-role_location="<?php echo e($value->role_location); ?>">

                        <div class="n-job-detail">
                            <ul class="list-inline">
                                <li class="n-job-title-box">
                                    <h4><a href="<?php echo e(route('career_detail',$value->id)); ?>"><?php echo e($value->job_title); ?></a> <i
                                            class="fa fa-star"></i></h4>


                                    <p class="company-name"><a href="" class=""><?php echo e($value->company_name); ?></a></p>

                                    <h6>
                                        <?php echo html_entity_decode(substr($value->job_description, 0, 200) . "...."); ?>
                                    </h6>

                                    <p>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <a href="">
                                                <?php echo e(date("M d,Y" , strtotime($value->created_at))); ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-money"></i>
                                            <a href=""> <?php echo e($value->starting_salary); ?> -
                                                <?php echo e($value->ending_salary); ?></a>
                                        </span>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<script>
$('input[type="checkbox"]').click(function() {
    if ($(this).prop("checked") == true) {
        // Show
        var class_name = $(this).prop("class")
        var vals = $(this).val()
        var policy = $(this).data("policy")
        $(".all-careers").each(function(i, e) {
            if (policy == "less") {
                if ($(e).attr("data-" + class_name) <= vals) {
                    $(e).show()
                } else {
                    if ($(e).is(':visible')) {
                        $(e).hide()
                    }

                }
            } else if (policy == "same") {
                if ($(e).attr("data-" + class_name) == vals) {
                    $(e).show()
                } else {
                    if ($(e).is(':visible')) {
                        $(e).hide()
                    }
                }
            } else {

                if ($(e).attr("data-" + class_name).indexOf(vals)) {
                    $(e).show()
                } else {
                    if ($(e).is(':visible')) {
                        $(e).hide()
                    }
                }
            }

        })
    } else if ($(this).prop("checked") == false) {
        var class_name = $(this).prop("class")
        var vals = $(this).val()
        $(".all-careers").each(function(i, e) {
            //if($(e).attr("data-"+class_name) >= vals){
            $(e).show()
            //}
        })
    }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Mini\V3\maplin\resources\views/web/career.blade.php ENDPATH**/ ?>