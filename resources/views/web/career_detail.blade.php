@extends('web.layouts.main')
@section('content')

<div class="main-slider conts">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="{{asset($job->img)}}" alt="{{$job->job_title}}" width="100%">
                <div class="carousel-caption">

                    <h1 class="wow zoomInRight" data-wow-duration="2s" data-wow-delay="0.2s">Career Detail</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="jobDetails opportunities_sec all-section">
    <div class="Particles-js3" id="particles-js"></div>
    <div class="container">
        <div class="col-md-12 col-xs-12 n-featured-jobs">
            <div class="n-featured-job-boxes">
                <!-- Job Box -->
                <div class="n-job-single wow fadeInLeft" data-wow-delay="0.3s" data-wow-duration="2s">
                    <div class="n-job-detail">
                        <ul class="list-inline">
                            <li class="n-job-title-box">
                                <h4><a href="">{{$job->job_title}}</a></h4>
                                <p class="company-name"><a href="" class="">{{$job->company_name}}</a></p>
                                <p><span> <i class="fa fa-building" aria-hidden="true"></i> <a href="">
                                            {{$job->role_location}} </a> </span></p>
                                <p><span> <i class="fa fa-money"></i> <a href=""> {{$job->starting_salary}} -
                                            {{$job->ending_salary}}</a></span></p>
                                <p><span> <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        {{$job->location}}</a></span></p>
                            </li>
                        </ul>
                        <a href="" data-toggle="modal" data-target="#modalForm" class="TopBtn2 tc-image-effect-circle">
                            Apply Now</a>
                        <a href="#" class="TopBtn tc-image-effect-circle"> Save</a>
                    </div>
                </div>
                <!-- Job Box -->
            </div>
            <div class="jobDes wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="2s">
                <h2>Job Description</h2>
                <?php echo html_entity_decode($job->job_description); ?>
                <h2>Job Details</h2>
                <div class="table-responsive">
                    <table class="table ">
                        <tr>
                            <td>Industry:</td>
                            <td>{{$job->company_name}}</td>
                        </tr>
                        <tr>
                            <td>Functional Area:</td>
                            <td>

                                {{$job->functional_area}}
                            </td>
                        </tr>
                        <tr>
                            <td>Total Positions:</td>
                            <td>
                                {{$job->positions}}
                            </td>
                        <tr>
                            <td>Job Shift:</td>
                            <td>{{$job->part_time}}</td>
                        </tr>
                        <tr>
                            <td>Job Type:</td>
                            <td>{{$job->employment_type}}</td>
                        </tr>
                        <tr>
                            <td>Department:</td>
                            <td>
                                {{$job->department}}
                            </td>
                        </tr>
                        <td>Job Location:</td>
                        <td>
                            {{$job->location}}
                        </td>
                        </tr>
                        <tr>
                            <td>Gender:</td>
                            <td>{{$job->gender}}</td>
                        </tr>
                        <tr>
                            <td>Minimum Education:</td>
                            <td>{{$job->min_education}}</td>
                        </tr>
                        <tr>
                            <td>Degree Title:</td>
                            <td>{{$job->degree}}</td>
                        </tr>
                    </table>
                </div>
                <div class="SkillsBox">
                    <?php
                    try {
                        $skills = explode(',', $job->skills);
                    } catch (Exception $e) {
                        $skills = array("Creativity", "Interpersonal Skills", "Critical Thinking", "Problem Solving", "Public Speaking", "Customer Service Skills", "Teamwork Skills", "Communication");
                    }

                    ?>
                    <h2>Skills</h2>
                    @if($skills)
                    @foreach($skills as $skill)
                    <a href="javascript:void(0)">{{$skill}}</a>
                    @endforeach
                    @endif
                    {{--
                        <a href="">Functional Area</a><a href="">Total Positions</a><a href="">ob Shift</a><a href="">Job Type</a><a href="">Department</a><a href="">Job Location</a><a href="">Gender</a>
                        --}}
                </div>
            </div>
            <div class="jobDes wow fadeInRight" data-wow-delay="0.3s" data-wow-duration="2s">
                <h2>About Company</h2>
                <p>{{$job->company_description}}

                </p>
            </div>
            <div class="clearfix"></div>
        </div>
</section>
<!--  Modal Here -->

@include('web.extends.modal')
@include('web.extends.footer-layer')

@endsection
@section('css')


</style>
@endsection
@section('js')
<!-- jQuery library -->

</script>

@endsection