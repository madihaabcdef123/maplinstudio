@extends('web.layouts.main')
@section('content')

    <!-- Begin: Crousel -->
    <div class="main-slider conts">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <!-- <img src="{{asset((isset($banner) && isset($banner->img))?$banner->img:'web/images/Layer-22.png')}}" alt="{{((isset($banner) && isset($banner->name))?$banner->name:Helper::config('websitename'))}}" width="100%"> -->


                    <img src="{{asset('web/images/808.gif')}}" class="head_lazy" data-src="{{asset((isset($banner) && isset($banner->img))?$banner->img:'web/images/Layer-22.png')}}" width="100%">

                    <div class="carousel-caption">

                        <h1 class="wow zoomInRight" data-wow-duration="2s" data-wow-delay="0.2s">News</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="main_news">
        <div class="Particles-js3" id="particles-js"></div>
        <div class="container">
            <div class="brokrg-head wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="2s">
                <?php echo (html_entity_decode(Helper::editck('h2', '', '', '', 'News & Videos' ,'h2News & VideosEaah3')));?>
                <?php echo (html_entity_decode(Helper::editck('p', '', '', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua' ,'pLorum dolor sit amet, concit, sed do mpor incagna aliquaEaah3')));?>    
              </div>
            <div class="row">
                @if($news)
                @foreach($news as $new)
                <div class="col-md-6 col-xs-12 col-sm-6">
                    <div class="main-eductn">
                        <div class="row wow fadeInLeft" data-wow-delay="0.3s" data-wow-duration="2s">
                            <div class="col-md-5 col-xs-12 col-sm-5 divAlign">
                                <!-- <img src="{{asset($new->img)}}" class="img-responsive" alt="{{$new->name}}"> -->


                                <img src="{{asset('web/images/1488.gif')}}" class="lazy" data-src="{{asset($new->img)}}" alt="{{$new->name}}" />
                            </div>
                            <div class="col-md-7 col-xs-12 col-sm-7">
                                <div class="kids_txt">
                                    <h2>{{$new->name}}</h2>
                                 <p>{{$new->details}}<a href="{{route('news_detail_display',$new->id)}}">[Details]</a></p>
                                    <span><i class="fa fa-calendar" aria-hidden="true"></i> {{date("M d/Y", strtotime($new->created_at))}} </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif

                {{--
                <div class="col-md-6 col-xs-12 col-sm-6">
                    <div class="main-eductn">
                        <div class="row wow fadeInRight" data-wow-delay="0.3s" data-wow-duration="2s">
                            <div class="col-md-5 col-xs-12 col-sm-5">
                                <img src="{{asset('web/images/ab2.png')}}" class="img-responsive" alt="img">
                            </div>
                            <div class="col-md-7 col-xs-12 col-sm-7">
                                <div class="kids_txt">
                                    <h2>Lorem Ipsum</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur iscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                                    <span><i class="fa fa-calendar" aria-hidden="true"></i>Dec 15/2019</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                --}}
            </div>
            {{--
            <div class="row">
                <div class="col-md-6 col-xs-12 col-sm-6">
                    <div class="main-eductn">
                        <div class="row wow fadeInLeft" data-wow-delay="0.3s" data-wow-duration="2s">
                            <div class="col-md-5 col-xs-12 col-sm-5">
                                <img src="{{asset('web/images/ab3.png')}}" class="img-responsive" alt="img">
                            </div>
                            <div class="col-md-7 col-xs-12 col-sm-7">
                                <div class="kids_txt">
                                    <h2>Lorem Ipsum</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur iscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                                    <span><i class="fa fa-calendar" aria-hidden="true"></i>Dec 15/2019</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12 col-sm-6">
                    <div class="main-eductn">
                        <div class="row wow fadeInRight" data-wow-delay="0.3s" data-wow-duration="2s">
                            <div class="col-md-5 col-xs-12 col-sm-5">
                                <img src="{{asset('web/images/ab4.png')}}" class="img-responsive" alt="img">
                            </div>
                            <div class="col-md-7 col-xs-12 col-sm-7">
                                <div class="kids_txt">
                                    <h2>Lorem Ipsum</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur iscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                                    <span><i class="fa fa-calendar" aria-hidden="true"></i>Dec 15/2019</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-xs-12 col-sm-6">
                    <div class="main-eductn">
                        <div class="row wow fadeInLeft" data-wow-delay="0.3s" data-wow-duration="2s">
                            <div class="col-md-5 col-xs-12 col-sm-5">
                                <img src="{{asset('web/images/ab5.png')}}" class="img-responsive" alt="img">
                            </div>
                            <div class="col-md-7 col-xs-12 col-sm-7">
                                <div class="kids_txt">
                                    <h2>Lorem Ipsum</h2>
                         <p>Lorem ipsum dolor sit amet, consectetur iscing elit, sed do eiusmod tempor incididunt ut labore et dolore</p>
                                    <span><i class="fa fa-calendar" aria-hidden="true"></i>Dec 15/2019</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12 col-sm-6">
                    <div class="main-eductn">
                        <div class="row wow fadeInRight" data-wow-delay="0.3s" data-wow-duration="2s">
                            <div class="col-md-5 col-xs-12 col-sm-5">
                                <img src="{{asset('web/images/ab6.png')}}" class="img-responsive" alt="img" loading=lazy>
                            </div>
                            <div class="col-md-7 col-xs-12 col-sm-7">
                                <div class="kids_txt">
                                    <h2>Lorem Ipsum</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur iscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                                    <span><i class="fa fa-calendar" aria-hidden="true"></i>Dec 15/2019</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            --}}

        </div>
    </section>


    @include('web.extends.footer-layer')
@endsection @section('css')
    <style type="text/css">
        
    </style>
@endsection
 @section('js')
<script type="text/javascript">
  $("img").lazyload({
        effect : "fadeIn"
    });
</script>


 @endsection
