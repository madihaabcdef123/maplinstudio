<?php
$user = Auth::user();
$att_tag = App\Models\attributes::where('is_active', 1)->where("model", "!=", null)->select('attribute')->distinct()->get();

$role_assign = App\Models\role_assign::where('is_active', 1)->where("role_id", $user->role_id)->first();

if ($role_assign) {
    $sidebar_data = unserialize($role_assign->assignee);
    $sidebar_data = Helper::create_sidebar($sidebar_data);
    
} else {
    $sidebar_data = [];
}
?>
<div class="sidebar">
    <div class="site-width">
        <!-- START: Menu-->
        <ul id="side-menu" class="sidebar-menu">
            <li class="dropdown active"><a href="#"><i class="icon-home mr-1"></i> Dashboard</a>
      <li class=" active">
                <ul>
                    <?php if(Auth::user()->role_id == 1 ): ?>
                         
                    <?php endif; ?>
                    
                    <?php if(Auth::user()->role_id == 1): ?>
                    

                    <?php endif; ?>

                    <?php if($sidebar_data): ?>

                        <?php $__currentLoopData = $sidebar_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $side): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php if(Auth::user()->role_id == 3): ?>

                                <li>

                                    <a href="<?php echo e(route('invoiceView')); ?>" data-actor="<?php echo e($side); ?>">
                                        <i class="<?php echo e(Helper::get_sidebar_icon($side)); ?>"></i>
                                        <?php echo e(ucwords(str_replace('-', ' ',$side == 'packages' ? 'Services' : $side))); ?> 
                                    </a>

                                </li>

                            <?php else: ?>

                                <li>

                                    <a href="<?php echo e(route('listing',$side)); ?>" data-actor="<?php echo e($side); ?>">
                                        <i class="<?php echo e(Helper::get_sidebar_icon($side)); ?>"></i>
                                        <?php echo e(ucwords(str_replace('-', ' ',$side == 'packages' ? 'Services' : $side))); ?> Management
                                    </a>

                                </li>
                            <?php endif; ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php endif; ?>

                    
                    

                </ul>
            </li>

            <?php if(Auth::user()->role_id == 1 || Auth::user()->role_id == 36): ?>
                <li class="dropdown"><a href="#"><i class="icon-organization mr-1"></i> Tools</a>
                    <ul>
                        <li class="dropdown"><a href="#"><i class="icon-options"></i>Reports</a>
                            <ul class="sub-menu">
                                
                                <li>
                                    <a href="<?php echo e(route('registered_user_report')); ?>"><i class="icon-people"></i> Manage User</a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('inquiry_manage')); ?>"><i class="icon-energy"></i> Manage Inquiry</a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('newsletter_manage')); ?>"><i class="icon-energy"></i> Manage Newletters</a>
                                </li>

                                <li>
                                    <a href="<?php echo e(route('applied_job_view')); ?>"><i class="icon-energy"></i> Applied Jobs inquiry</a>
                                </li>

                               

                                
                            </ul>
                        </li>

                        

                    </ul>
                </li>
            <?php endif; ?>

            <?php if(Auth::user()->role_id == 1): ?>
                <li class="dropdown"><a href="#"><i class="icon-layers mr-1"></i> Web Apps</a>
                    <ul>
                        <?php if(Auth::user()->role_id == 1): ?>
                            <li class="dropdown"><a href="#"><i class="icon-options"></i>Website Settings</a>
                                <ul class="sub-menu">
                                    <li><a href="<?php echo e(route('config')); ?>"><i class="icon-energy"></i> Config</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        
                        <?php if(Auth::user()->role_id == 1 || Auth::user()->role_id == 36): ?>
                            
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            
        </ul>
        <!-- END: Menu-->
        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0 ml-auto">
            <li class="breadcrumb-item"><a href="#">Application</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>
</div>


<?php /**PATH C:\Users\abeer.khan\Desktop\huzaifa\maplin\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>