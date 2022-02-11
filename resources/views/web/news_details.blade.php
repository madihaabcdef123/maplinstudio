@extends('web.layouts.main') @section('content')

<div class="main-slider conts">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">

               

                <img src="{{asset('web/images/808.gif')}}" class="head_lazy" data-src="{{asset($project->img)}}"
                    width="100%">

                <div class="carousel-caption">
                    <h1 class="wow zoomInRight" data-wow-duration="2s" data-wow-delay="0.2s">News Detail</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="floor_plan_content">
    <div class="container">
        <div class="row">

            <div class="col-sm-12">

                <div class="detail wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.3s">
                    <h2><h2>{{$project->name}} Description</h2></h2>
                    <p class="wow fadeInLeft" data-wow-duration="3s" data-wow-delay="0.3s">
                        <?php echo html_entity_decode($news_details->long_details) ?>
                </div>

            </div>
            <div class="col-sm-12">
                <div class="row gallery">
                    <h2 class="text-center">GALLERY</h2>
                    <div class="Particles-js3" id="particles-js"></div>
                    <?php
                    $list = array("wow fadeInLeft", "wow fadeInDown", "wow fadeInRight", "wow fadeInUp");
                    ?>
                    @if($gallery)
                    @foreach($gallery as $img)
                    <div class="col-sm-4 {{$list[rand(0,3)]}}" data-wow-duration="2s" data-wow-delay="0.3s">
                        <div class="recent-blk mrgn-btm divAlign">
                            <!-- <img src="{{asset($img->path)}}" /> -->

                            <img src="{{asset('web/images/1488.gif')}}" class="lazy" data-src="{{asset($img->path)}}"
                                alt="" />

                            <a data-fancybox="gallery" href="{{asset($img->path)}}"><i class="fa fa-search"
                                    aria-hidden="true"></i></a>
                        </div>
                    </div>
                    @endforeach
                    @endif

        </div>
    </div>
    </div>
    </div>
</section>

@include('web.extends.footer-layer') @endsection @section('css')
<style type="text/css"></style>
@endsection @section('js') @endsection