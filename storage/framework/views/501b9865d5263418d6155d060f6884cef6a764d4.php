

<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

<script src="<?php echo e(asset('vendors/ckeditor/ckeditor.js')); ?>" type="text/javascript"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo e(asset('web/js/all.min.js')); ?>"></script>
<script src="<?php echo e(asset('web/js/custom.min.js')); ?>"></script>
<script src="<?php echo e(asset('web/owl-carousel/owl.carousel.js')); ?>"></script>
<script src="<?php echo e(asset('web/js/royal_preloader.min.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>-->


<script>
  document.addEventListener("DOMContentLoaded", function() {
    
  var lazyloadImages = document.querySelectorAll("img.lazy");
  var HeadlazyloadImages = document.querySelectorAll("img.head_lazy");

  var lazyloadThrottleTimeout;
  function lazyload () {
    if(lazyloadThrottleTimeout) {
      clearTimeout(lazyloadThrottleTimeout);
    }
    lazyloadThrottleTimeout = setTimeout(function() {
        var scrollTop = window.pageYOffset;

        lazyloadImages.forEach(function(img) {
            if(img.offsetTop < (window.innerHeight + scrollTop)) {
              img.src = img.dataset.src;
              img.classList.remove('lazy');
              img.classList.add('img-responsive');

            }
        });

        HeadlazyloadImages.forEach(function(img) {
            if(img.offsetTop < (window.innerHeight + scrollTop)) {
              img.src = img.dataset.src;
              img.classList.remove('head_lazy');
              img.classList.add('img-responsive');

            }
        });


        if(lazyloadImages.length == 0) {
          document.removeEventListener("scroll", lazyload);
          window.removeEventListener("resize", lazyload);
          window.removeEventListener("orientationChange", lazyload);
        }

        if(HeadlazyloadImages.length == 0) {
          document.removeEventListener("scroll", lazyload);
          window.removeEventListener("resize", lazyload);
          window.removeEventListener("orientationChange", lazyload);
        }


    }, 20);
  }
  document.addEventListener("scroll", lazyload);
  window.addEventListener("resize", lazyload);
  window.addEventListener("orientationChange", lazyload);
});
</script>



<!-- START: APP JS-->
<!-- END: APP JS-->

<script type="text/javascript">

$(document).on("click", "#cms-generic", function(){
    $("#cms_form").submit();
})

$(document).on("click", ".clickable", function(){
    var element = $(this)
    var desc = $(this).html();
    var slug = $(this).data("slug");
    var clas = $(this).data("class");
    var tag = $(this).data("tag");
    var wow_duration = $(this).data("wowdelay");
    var wow_delay = $(this).data("wowduration");
    console.log(desc);
    console.log(slug);
    console.log(clas);
    console.log(tag);
    console.log(wow_duration);
    console.log(wow_delay);
    $("#addcms").remove();
    $.ajax({
        type : 'POST',
        dataType : 'JSON',
        url: "<?php echo e(route('modalform')); ?>",
        data: {desc:desc, wow_duration:wow_duration, wow_delay:wow_delay, slug:slug, class:clas, tag:tag, _token:"<?php echo e(csrf_token()); ?>"},
        success: function (response) {
            if (response.status == 1) {
                $(response.message).insertAfter(element)
                $("#addcms").modal("show");
                var description = CKEDITOR.replace('description');
                description.on( 'change', function( evt ) {
                    $("#description").text( evt.editor.getData())    
                });
            }
        }
    });
});

</script>

<script type="text/javascript">
    window.jQuery = window.$ = jQuery;
    (function($) { "use strict";

        var image = "<?php echo e(asset('web/images/logo.png')); ?>";
        //Preloader
        Royal_Preloader.config({
            mode           : 'logo',
            logo           : image,
            logo_size      : [190, 90],
            showProgress   : true,
            showPercentage : true,
            text_colour: '#000000',
            background:  '#ffffff'
        });
    })(jQuery);
</script>

<script>
  <?php if(Session::has('message')): ?>
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true,
  	"debug": false,
  	"positionClass": "toast-bottom-right",
  }
  		toastr.success("<?php echo e(session('message')); ?>");
  <?php endif; ?>

  <?php if(Session::has('error')): ?>
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true,
  	"debug": false,
  	"positionClass": "toast-bottom-right",
  }
  		toastr.error("<?php echo e(session('error')); ?>");
  <?php endif; ?>

  <?php if(Session::has('info')): ?>
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true,
  	"debug": false,
  	"positionClass": "toast-bottom-right",
  }
  		toastr.info("<?php echo e(session('info')); ?>");
  <?php endif; ?>

  <?php if(Session::has('warning')): ?>
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true,
  	"debug": false,
  	"positionClass": "toast-bottom-right",
  }
  		toastr.warning("<?php echo e(session('warning')); ?>");
  <?php endif; ?>
</script>

<?php /**PATH C:\Users\abeer.khan\Desktop\huzaifa\maplin\resources\views/web/layouts/scripts.blade.php ENDPATH**/ ?>