@extends('web.layouts.main')
@section('content')
<div class="main-slider conts">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <!-- <img src="{{asset('web/images/proj-ban.png')}}" alt="banner" width="100%"> -->
                <img src="{{asset('web/images/808.gif')}}" class="head_lazy"
                    data-src="{{asset('web/images/proj-ban.png')}}" width="100%">
                <div class="carousel-caption">
                    <h1 class="wow zoomInRight" data-wow-duration="2s" data-wow-delay="0.2s">Project Detail</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="porperty-detail-sec contactinfo_contactpage">
    <div class="container">
        <div class="Particles-js3" id="particles-js"> </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="property-detail-heading">
                    <h2>{{$project->name}} Description</h2>
                </div>
            </div>
        </div>
        <div class="row description-sec-main">
            <div class="col-lg-9 col-md-9">
                <div class="detail-content-sec">
                    <div class="proShowCase">
                        <div class="slider-for ">
                            @if($gallery)
                            @foreach($gallery as $image)
                            <div class="item">
                                <img src="{{asset($image->path)}}" alt="{{Helper::config('websitename')}}"
                                    class="img-responsive" data-wah="{{asset($image->path)}}">
                                <div class="overlay-icon-fancy">
                                    <a data-fancybox="gallery" href="{{asset($image->path)}}"><i class="fa fa-arrows"
                                            aria-hidden="true"></i></a>
                                </div>
                            </div>
                            @endforeach
                            @endif

                        </div>
                        <div class="slider-nav ">
                            @if($gallery)
                            @foreach($gallery as $image)
                            <div class="item divAlign">
                                <!-- <img src="{{asset($image->path)}}" alt="" class="img-responsive"> -->
                                <img src="{{asset('web/images/1488.gif')}}" class="lazy"
                                    data-src="{{asset($image->path)}}" />
                            </div>
                            @endforeach
                            @endif

                        </div>
                    </div>
                    <div class="property-description-sec wow fadeInLeft" data-wow-delay="0.3s" data-wow-duration="3s">
                        <h2>Project Detail</h2>
                        <?php echo html_entity_decode($news_details->long_details) ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="properly-search-main">
                    <div class="properly-search-sec">
                        <h2>Latest Project</h2>
                        <div class="latest-property-tab wow fadeInRight" data-wow-delay="0.2s" data-wow-duration="2s">
                            @if($projects)
                            @foreach($projects as $project)
                            <a href="{{route('project_detail',$project->id)}}">
                                <div class="property-sec-tab">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4">
                                            <div class="latest-img-sec">
                                                <img src="{{asset($project->img)}}" class="img-responsive"
                                                    alt="{{Helper::config('websitename')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-sm-8 no_pad">
                                            <div class="latest-content-sec">
                                                <h3>{{$project->name}}</h3>
                                                <span><b>{{$project->price}}</b> </span>
                                                <span> {{$project->size}} </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                            @endif

                        </div>
                    </div>
                    <div class="properly-search-sec wow fadeInRight" data-wow-delay="0.3s" data-wow-duration="3s">
                        <h2>Login </h2>
                        <form>
                            <div class="properly-search-form">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <input type="text" name="username" placeholder="Username" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <input type="password" name="passowrd" placeholder="Password"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="login-btn-form">
                                            <input type="submit" value="Login">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <p>Need an account? Register here! Forgot Password?</p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('web.extends.footer-layer')
@endsection
@section('css')
<style type="text/css"></style>
@endsection
@section('js')
@endsection