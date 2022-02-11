@extends('web.layouts.main')
@section('content')

<div class="main-slider conts">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">

                <!-- <img src="{{asset((isset($banner) && isset($banner->img))?$banner->img:'web/images/bi.png')}}" alt="{{((isset($banner) && isset($banner->name))?$banner->name:Helper::config('websitename'))}}" width="100%"> -->

                <img src="{{asset('web/images/808.gif')}}" class="head_lazy"
                    data-src="{{asset((isset($banner) && isset($banner->img))?$banner->img:'web/images/bi.png')}}">

                <div class="carousel-caption">

                    <h1 class="wow zoomInRight" data-wow-duration="2s" data-wow-delay="0.2s">STUDIO</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="terms contactinfo_contactpage new">
    <div class="Particles-js3" id="particles-js"></div>
    <div class="container">

        <div class="row">
            <div class="term-condition">
                <div class="col-12">
                    <?php echo (html_entity_decode(Helper::editck('h2', 'wow zoomInRight', '0.3s', '2s', 'STUDIO' ,'h2STUDIOssssssh3')));?>
                    <?php echo (html_entity_decode(Helper::editck('p', 'wow zoomIn', '0.6s', '2s', 'Lorem ipsum dolor sit amet, est id putant fabulas ponderum, mundi libris omnium in sea. Mei porro' ,'pSTUDIOssssssLorem ipsum dolor sit amet, est id putant fabulas ponderum, mundi libris omnium in sea. Mei porroh3')));?>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="sec_one contactinfo_contactpage">
    <div class="container-fluid">
        <div class="row">

            @if($studios)
            @foreach($studios as $studio)
            <div class="col-md-6 col-sm-6 col-xs-12 sec_onea">
                <a href="{{route('studio_detail',$studio->id)}}">
                    <div class="sec_oneb wow fadeInLeft" data-wow-duration="2s" data-wow-delay="0.3s">
                        <div class="dts">
                            <!-- <img src="{{asset($studio->banner_img)}}" alt="{{$studio->name}}" class="img-responsive"> -->

                            <img src="{{asset('web/images/1488.gif')}}" class="lazy"
                                data-src="{{asset($studio->banner_img)}}" alt="" />
                            <div class="projet">
                                <h6>{{$studio->name}}</h6>
                            </div>
                        </div>

                    </div>
                </a>
            </div>
            @endforeach
            @endif

            {{--
                <div class="col-md-6 col-sm-6 col-xs-12 sec_onea">
                    <a href="{{route('studio_detail')}}">
            <div class="sec_oneb wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.3s">
                <div class="dts">
                    <img src="{{asset('web/images/st2.png')}}" alt="image" class="img-responsive">
                    <div class="projet">
                        <h6>Structural Engineering</h6>
                    </div>
                </div>

            </div>
            </a>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12 sec_onea">
            <a href="{{route('studio_detail')}}">
                <div class="sec_oneb wow fadeInLeft" data-wow-duration="2s" data-wow-delay="0.3s">
                    <div class="dts">
                        <img src="{{asset('web/images/st3.png')}}" alt="image" class="img-responsive">
                        <div class="projet">
                            <h6>Interiors</h6>
                        </div>
                    </div>

                </div>
            </a>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 sec_onea">
            <a href="{{route('studio_detail')}}">
                <div class="sec_oneb wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.3s">
                    <div class="dts">
                        <img src="{{asset('web/images/st4.png')}}" alt="image" class="img-responsive">
                        <div class="projet">
                            <h6>Environmental Engineering</h6>
                        </div>
                    </div>

                </div>
            </a>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12 sec_onea">
            <a href="{{route('studio_detail')}}">
                <div class="sec_oneb wow fadeInLeft" data-wow-duration="2s" data-wow-delay="0.3s">
                    <div class="dts">
                        <img src="{{asset('web/images/st5.png')}}" alt="image" class="img-responsive">
                        <div class="projet">
                            <h6>Industrial Design</h6>
                        </div>
                    </div>

                </div>
            </a>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 sec_onea">

            <a href="{{route('studio_detail')}}">
                <div class="sec_oneb wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.3s">
                    <div class="dts">
                        <img src="{{asset('web/images/st6.png')}}" alt="image" class="img-responsive">
                        <div class="projet">
                            <h6>Research & Development</h6>
                        </div>
                    </div>

                </div>
            </a>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12 sec_onea">
            <a href="{{route('studio_detail')}}">
                <div class="sec_oneb wow fadeInLeft" data-wow-duration="2s" data-wow-delay="0.3s">
                    <div class="dts">
                        <img src="{{asset('web/images/st1.png')}}" alt="image" class="img-responsive">
                        <div class="projet">
                            <h6>Urban Landscape</h6>
                        </div>
                    </div>

                </div>
            </a>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 sec_onea">
            <a href="{{route('studio_detail')}}">
                <div class="sec_oneb wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.3s">
                    <div class="dts">
                        <img src="{{asset('web/images/st2.png')}}" alt="image" class="img-responsive">
                        <div class="projet">
                            <h6>Sustainability</h6>
                        </div>
                    </div>

                </div>
            </a>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12 sec_onea">
            <a href="{{route('studio_detail')}}">
                <div class="sec_oneb wow fadeInLeft" data-wow-duration="2s" data-wow-delay="0.3s">
                    <div class="dts">
                        <img src="{{asset('web/images/st3.png')}}" alt="image" class="img-responsive">
                        <div class="projet">
                            <h6>Project Management</h6>
                        </div>
                    </div>

                </div>
            </a>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 sec_onea">
            <a href="{{route('studio_detail')}}">
                <div class="sec_oneb wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.3s">
                    <div class="dts">
                        <img src="{{asset('web/images/st4.png')}}" alt="image" class="img-responsive">
                        <div class="projet">
                            <h6>Constructability Reviews
                            </h6>
                        </div>
                    </div>

                </div>
            </a>
        </div>
        --}}

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