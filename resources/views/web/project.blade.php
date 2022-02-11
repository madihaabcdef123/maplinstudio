@extends('web.layouts.main')
@section('content')


<div class="main-slider conts">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">

                <!-- <img src="{{asset((isset($banner) && isset($banner->img))?$banner->img:'web/images/bi.png')}}" alt="{{((isset($banner) && isset($banner->name))?$banner->name:Helper::config('websitename'))}}" width="100%">
            <div class="carousel-caption"> -->

                <img src="{{asset('web/images/808.gif')}}" class="head_lazy"
                    data-src="{{asset((isset($banner) && isset($banner->img))?$banner->img:'web/images/bi.png')}}">

                <h1 class="wow zoomInRight" data-wow-duration="2s" data-wow-delay="0.2s">Our Projects</h1>
            </div>
        </div>
    </div>
</div>
</div>

<section class="terms contactinfo_contactpage new">
    <div class="Particles-js3" id="particles-js"></div>
    <div class="container">

        <div class="row">
            <div class="col-12">
                <div class="term-condition">
                    <?php echo (html_entity_decode(Helper::editck('h2', 'wow zoomIn', '0.3s', '2s', 'OUR PROJECTS' ,'h2OURPROJECTSh1')));?>

                    <?php echo (html_entity_decode(Helper::editck('p', 'wow zoomIn', '0.6s', '2s', 'Lorem ipsum dolor sit amet, est id putant fabulas ponderum, mundi libris omnium in sea. Mei porro' ,'pLorem ipsumdolorsit amet, putantfabulasmundilibrisporroh1')));?>

                </div>
            </div>

        </div>
    </div>
</section>

<section class="sec_one alldat contactinfo_contactpage">
    <div class="Particles-js3" id="particles-js"></div>
    <div class="container-fluid">
        <div class="row">

            @if($projects)
            @foreach($projects as $project)
            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 sec_onea">
                <a href="{{route('project_detail',$project->id)}}">
                    <div class="sec_oneb wow fadeInLeft" data-wow-duration="2s" data-wow-delay="0.3s">
                        <div class="dts">
                            <img src="{{asset($project->img)}}" alt="{{$project->name}}" class="img-responsive">

                            <!-- <img src="{{asset('web/images/1488.gif')}}" class="lazy" data-src="{{asset($project->img)}}" alt="" /> -->

                            <div class="projet">
                                <h6>{{$project->name}}</h6>
                            </div>
                        </div>

                    </div>
                </a>
            </div>
            @endforeach
            @endif

            {{--
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 sec_onea">
                    <a href="{{route('project_detail')}}">
            <div class="sec_oneb wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.3s">
                <div class="dts">
                    <img src="{{asset('web/images/st2.png')}}" alt="image" class="img-responsive">
                    <div class="projet">
                        <h6>Hospitality & Leisure</h6>
                    </div>
                </div>

            </div>
            </a>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 sec_onea">
            <a href="{{route('project_detail')}}">
                <div class="sec_oneb wow fadeInLeft" data-wow-duration="2s" data-wow-delay="0.3s">
                    <div class="dts">
                        <img src="{{asset('web/images/st3.png')}}" alt="image" class="img-responsive">
                        <div class="projet">
                            <h6>Mixed Use</h6>
                        </div>
                    </div>

                </div>
            </a>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 sec_onea">
            <a href="{{route('project_detail')}}">
                <div class="sec_oneb wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.3s">
                    <div class="dts">
                        <img src="{{asset('web/images/st4.png')}}" alt="image" class="img-responsive">
                        <div class="projet">
                            <h6>Healthcare</h6>
                        </div>
                    </div>

                </div>
            </a>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 sec_onea">
            <a href="{{route('project_detail')}}">
                <div class="sec_oneb wow fadeInLeft" data-wow-duration="2s" data-wow-delay="0.3s">
                    <div class="dts">
                        <img src="{{asset('web/images/st5.png')}}" alt="image" class="img-responsive">
                        <div class="projet">
                            <h6>Education</h6>
                        </div>
                    </div>

                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 sec_onea">
            <a href="{{route('project_detail')}}">
                <div class="sec_oneb wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.3s">
                    <div class="dts">
                        <img src="{{asset('web/images/st6.png')}}" alt="image" class="img-responsive">
                        <div class="projet">
                            <h6>Urban Design</h6>
                        </div>
                    </div>

                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 sec_onea">
            <a href="{{route('project_detail')}}">
                <div class="sec_oneb wow fadeInLeft" data-wow-duration="2s" data-wow-delay="0.3s">
                    <div class="dts">
                        <img src="{{asset('web/images/st1.png')}}" alt="image" class="img-responsive">
                        <div class="projet">
                            <h6>Appeals</h6>
                        </div>
                    </div>

                </div>
            </a>
        </div>


        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 sec_onea">
            <a href="{{route('project_detail')}}">
                <div class="sec_oneb wow fadeInLeft" data-wow-duration="2s" data-wow-delay="0.3s">
                    <div class="dts">
                        <img src="{{asset('web/images/st1.png')}}" alt="image" class="img-responsive">
                        <div class="projet">
                            <h6>Residential</h6>
                        </div>
                    </div>

                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 sec_onea">
            <a href="{{route('project_detail')}}">
                <div class="sec_oneb wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.3s">
                    <div class="dts">
                        <img src="{{asset('web/images/st2.png')}}" alt="image" class="img-responsive">
                        <div class="projet">
                            <h6>Hospitality & Leisure</h6>
                        </div>
                    </div>

                </div>
            </a>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 sec_onea">
            <a href="{{route('project_detail')}}">
                <div class="sec_oneb wow fadeInLeft" data-wow-duration="2s" data-wow-delay="0.3s">
                    <div class="dts">
                        <img src="{{asset('web/images/st3.png')}}" alt="image" class="img-responsive">
                        <div class="projet">
                            <h6>Mixed Use</h6>
                        </div>
                    </div>

                </div>
            </a>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 sec_onea">
            <a href="{{route('project_detail')}}">
                <div class="sec_oneb wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.3s">
                    <div class="dts">
                        <img src="{{asset('web/images/st4.png')}}" alt="image" class="img-responsive">
                        <div class="projet">
                            <h6>Healthcare</h6>
                        </div>
                    </div>

                </div>
            </a>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 sec_onea">
            <a href="{{route('project_detail')}}">
                <div class="sec_oneb wow fadeInLeft" data-wow-duration="2s" data-wow-delay="0.3s">
                    <div class="dts">
                        <img src="{{asset('web/images/st5.png')}}" alt="image" class="img-responsive">
                        <div class="projet">
                            <h6>Education</h6>
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

@endsection @section('css')
<style type="text/css"></style>
@endsection @section('js') @endsection