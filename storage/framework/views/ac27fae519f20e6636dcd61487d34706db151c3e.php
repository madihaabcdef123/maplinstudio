<header>

    <div class="container">

        <div class="bottom-row affix" data-offset-top="190" data-spy="affix">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-xs-12">
                    <div class="logo-brand">
                        <a href="<?php echo e(route('welcome')); ?>"> <img src="<?php echo e(asset('web/images/logo.png')); ?>" alt=""
                                class="img-responsive"> </a>
                        <div onclick="header()" id="toggle">
                            <div class="one"></div>
                            <div class="two"></div>
                            <div class="three"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 col-md-10 col-xs-12">
                    <nav id="menu" class="navbar custom-navbar navbar-expand-lg navbar-light bg-light">
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('planning')); ?>">Planning</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="<?php echo e(route('project')); ?>">Projects</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="<?php echo e(route('studio')); ?>">Studio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="<?php echo e(route('about')); ?>">People</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="<?php echo e(route('news')); ?>">News</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="<?php echo e(route('career')); ?>">Careers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="<?php echo e(route('contact')); ?>">Contact Us</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link mybutton" href="<?php echo e(route('book_expert')); ?>}">Book A Free Site Visit</a>
                            </li>
                            <?php if(auth()->guard()->check()): ?>
                            <li class="nav-item">
                                <a class="nav-link mybutton" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                    <?php echo csrf_field(); ?>
                                </form>

                            </li>
                            <?php endif; ?>
                            <?php if(auth()->guard()->guest()): ?>
                            <!--<li class="nav-item">-->
                            <!--    <a class="nav-link mybutton" href="<?php echo e(route('signup')); ?>">My Account</a>-->
                            <!--</li>-->
                            <?php endif; ?>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>

    </div>

</header><?php /**PATH /opt/lampp/htdocs/maplin/resources/views/web/layouts/header.blade.php ENDPATH**/ ?>