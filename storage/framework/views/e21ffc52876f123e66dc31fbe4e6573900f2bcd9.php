<section class="CallNow wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="2s">
    <div class="container">
        <div class="CallSec">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="col-xs-12 col-md-1 col-sm-1">
                        <i aria-hidden="true" class="fa fa-mobile wow zoomIn"></i>
                    </div>
                    <div class="col-xs-12 col-md-4 col-sm-10">
                        <?php echo (html_entity_decode(Helper::editck('h6', 'wow fadeInRight', '0.2s', '2s', 'Call now' ,'h6Callnowh2')));?>
                        <?php echo (html_entity_decode(Helper::editck('p', 'wow fadeInLeft', '0.4s', '2s', 'for free consultation' ,'pfor free consultationh6')));?>
                    </div>
                    <div class="col-xs-12 col-md-7 col-sm-12">
                        <a class="wow fadeInRight phone_num" data-wow-delay="0.5s" data-wow-duration="2s"
                            href="tel:<?php echo e(Helper::config('contactnumber')); ?>">: <?php echo e(Helper::config('contactnumber')); ?> </a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="col-xs-12 col-md-1 col-sm-1">
                        <i aria-hidden="true" class="fa fa-envelope-open-o wow zoomIn"></i>
                    </div>
                    <div class="col-xs-12 col-md-4 col-sm-10">
                        <!--  <i class="fa fa-envelope-open-o" aria-hidden="true"></i> -->
                        <?php echo (html_entity_decode(Helper::editck('h6', 'wow fadeInLeft', '0.6s', '2s', 'Call now' ,'h6Mailusnowh2')));?>
                        <?php echo (html_entity_decode(Helper::editck('p', 'wow fadeInRight', '0.7s', '2s', 'for free consultation' ,'pfor free consultationh6')));?>
                    </div>
                    <div class="col-xs-12 col-md-7 col-sm-12">
                        <a class="wow fadeInRight email_text" data-wow-delay="0.7s" data-wow-duration="2s"
                            href="mailto:<?php echo e(Helper::config('emailaddress')); ?>"><?php echo e(Helper::config('emailaddress')); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><?php /**PATH /opt/lampp/htdocs/maplin/resources/views/web/extends/footer-layer.blade.php ENDPATH**/ ?>