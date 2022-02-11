



 <meta name="_token" content="<?php echo e(csrf_token()); ?>" />  
<!-- Modal -->
<div class="modal fade" id="modalForm" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Job Applied Form</h4>
            </div>
             <form role="form" id="jobApply" method="POST" enctype="multipart/form-data" files="true">
            <!-- Modal Body -->
            <div class="modal-body">
                <p class="statusMsg"></p>
                      <?php echo csrf_field(); ?>
                    <input type="hidden" id="job_id" name="job_id" value="<?php echo e($job->id); ?>" >
                    <?php if(auth()->guard()->check()): ?>
                     <input type="hidden" id="job_id" name="user_id" value="<?php echo e(Auth::user()->id); ?>" >
                     <?php else: ?>
                     <input type="hidden" id="job_id" name="user_id" value="0" >
                     <?php endif; ?>
                    <div class="form-group">
                        <label for="inputName">Name</label>
                        <input type="text" class="form-control" id="inputName" name="name" value="<?php echo e((isset($user)?$user->name:'')); ?>" placeholder="Enter your name"/>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" name="email"  value="<?php echo e((isset($user)?$user->email:'')); ?>" id="inputEmail" placeholder="Enter your email"/>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail">Contact Number</label>
                        <input type="number" class="form-control" name="contactno"  value="<?php echo e((isset($user)?$user->phonenumber:'')); ?>" id="inputNumber" placeholder="Enter your Contact Number"/>
                    </div>

                    <div class="form-group">
                        <label for="inputMessage">Resume</label>
                        <input type="file" class="form-control" name="resume" id="inputResume" placeholder="Upload Your Resume"></textarea>
                    </div>
                
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary submitBtn" >SUBMIT</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>
    .modal-dialog {
    top: 67px;
}
</style>
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('js'); ?>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<!-- Latest minified bootstrap js -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
   });
$("#jobApply").submit(function(e) {
            e.preventDefault();    
            var formData = new FormData(this);

            $.ajax({
                url: "<?php echo e(route('apply_job')); ?>",
                type: 'POST',
                data: formData,
                success: function (data){
                if(data.status== true){
                    
                  window.location ="<?php echo e(url('thank-you-upload')); ?>";
              }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
//   function submitContactForm(){
//      event.preventDefault();
   
//     var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
//     var name = $('#inputName').val();
//     var email = $('#inputEmail').val();
//     var resume = $('#inputResume').val();
//     var contactno = $('#inputNumber').val();
//     var job_id = $('#job_id').val();
//     if(name.trim() == '' ){
//         alert('Please enter your name.');
//         $('#inputName').focus();
//         return false;
//     }else if(email.trim() == '' ){
//         alert('Please enter your email.');
//         $('#inputEmail').focus();
//         return false;
//     }else if(resume.trim() == '' ){
//         alert('Please enter your resume.');
//         $('#inputMessage').focus();
//         return false;
//     }else{

//         $.ajax({
//             type:'POST',
//             url:"<?php echo e(route('apply_job')); ?>",
//             data:$('#jobApply').serialize(),
//             beforeSend: function () {
//                 $('.submitBtn').attr("disabled","disabled");
//                 $('.modal-body').css('opacity', '.5');
//             },
//             success:function(response){
//                 if(response.msg == 'ok'){
                    
//                   swal('Thank you')
//                 }else{
//             form.closest('.modal-body').append('<div class="error">'+response+'</div>');
                    
//                 }
//                 $('.submitBtn').removeAttr("disabled");
//                 $('.modal-body').css('opacity', '');
//             }
//         });
//     }
// }
</script>

 <?php $__env->stopSection(); ?>
<?php /**PATH E:\Mini\V3\maplin\resources\views/web/extends/modal.blade.php ENDPATH**/ ?>