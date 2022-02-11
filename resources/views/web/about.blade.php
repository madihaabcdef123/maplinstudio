@extends('web.layouts.main')
@section('content')

<div class="main-slider conts">
    <div class="carousel slide" data-ride="carousel" id="carousel-example-generic">

        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <!-- <img src="{{asset((isset($banner) && isset($banner->img))?$banner->img:'web/images/abt_ban.png')}}" alt="{{((isset($banner) && isset($banner->name))?$banner->name:Helper::config('websitename'))}}" width="100%"> -->


                <img src="{{asset('web/images/808.gif')}}" class="head_lazy"
                    data-src="{{asset((isset($banner) && isset($banner->img))?$banner->img:'web/images/abt_ban.png')}}"
                    width="100%">
                <div class="carousel-caption">
                    <h1 class="wow zoomInRight" data-wow-delay="0.2s" data-wow-duration="2s">People</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="aboutus">
    <div class="Particles-js3" id="particles-js"></div>
    <div class="container">


        <div class="row">
            <div class="col-md-6">
                <!-- <h2 class="wow fadeInLeft" data-wow-delay="0.2s" data-wow-duration="2s"><span class="wow fadeInRight" data-wow-delay="0.3s" data-wow-duration="2s"></span></h2> -->
                <!-- <h4 class="wow fadeInLeft" data-wow-delay="0.4s" data-wow-duration="2s">ABOUT US</h4> -->
                <?php echo (html_entity_decode(Helper::editck('h3', 'wow fadeInLeft', '0.6s', '2s', 'WHO WE ARE', 'h3WHO WE AREaah3'))); ?>
                <?php echo (html_entity_decode(Helper::editck('p', 'wow fadeInRight', '0.7s', '2s', 'Maplin Studio is a market leading Planning, Architect, and Structural Engineering', 'pMaplin Studio is a market leading Planning,StructuralEngineeringaah3'))); ?>
                <?php echo (html_entity_decode(Helper::editck('p', 'wow fadeInLeft', '0.8s', '2s', 'With Headquarters in London, Maplin Studio, is a registered trademark, and a wholly owned division of Maplin Energies. We are a team of people with ethnic and', 'pWith Headquarters in London, Maplin Studio, is a registered trademark, and a wholly owned division of MaplinEnergiWe teamandngaah3'))); ?>
                <?php echo (html_entity_decode(Helper::editck('p', 'wow fadeInRight', '0.9s', '2s', 'Sustainability is at the heart of our designs. We assess proj', 'pSustainability is at the heart of our designs.WeasseprojEaah3'))); ?>
            </div>
            <div class="col-md-6">
                <div class="main-img">
                    <div class="relative-dev">


                        <div class="video-counselling-box wow zoomIn" data-wow-duration="2s" data-wow-delay="0.3s"
                            style="visibility: visible; animation-duration: 2s; animation-delay: 0.3s; animation-name: zoomIn;">
                            <img src="{{asset($inner_banner_1->img)}}" class="img-responsive"
                                alt="{{$inner_banner_1->details}}">
                            <div class="overlay-counselling-video">
                                <a data-fancybox="" href="{{Helper::config('websitestourguide')}}"><img
                                        src="{{asset('web/images/play-btn.png')}}" class="img-responsive" alt=""></a>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<div class="special_main">
    <div class="container">

        <div class="special_half_bg">
            <div class="row no-margin">
                <div class="col-md-8 col-sm-8 col-xs-12 no-margin">
                    <div class="special_text wow fadeInLeft" data-wow-delay="0.2s" data-wow-duration="2s">
                        <?php echo (html_entity_decode(Helper::editck('h3', '', '', '', 'SAFETY CULTURE', 'h3SAFETY CULTURE AREaah3'))); ?>
                        <?php echo (html_entity_decode(Helper::editck('p', '', '', '', 'BeyondZERO encompasses an incident and injury free environment. We support our people, contractors, and customers to ensure safety for all. Decisions a', 'pSBeyondZEROecidentandinjuryfreeenvironment We ourpeople for all. Decisions aULTURE AREaah3'))); ?>
                        <!--              <a class="btn white" href="javascript:void(0)">Our Expertise</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="partners_section allpart">
    <div class="container">
        <div class="row">
            <div class="partners_text wow fadeInLeft" data-wow-delay="0.3s" data-wow-duration="1s">
                <div class="col-md-12 col-sm-12 col-xs-12 no-margin">
                    <?php echo (html_entity_decode(Helper::editck('h2', '', '', '', 'Diversity and Inclusion', 'h2SDiversity and InclusionURE AREaah3'))); ?>
                    <?php echo (html_entity_decode(Helper::editck('p', '', '', '', 'Lorem Ipsum is simply dummy text of the printing and typese', 'pSLorem Ipsum is simply dummy text ofprintiypeseURE AREaah3'))); ?>


                </div>
            </div>
        </div>

    </div>
</div>
<div class="partners_section">
    <div class="container">
        <div class="row">
            <div class="partners_text wow fadeInLeft" data-wow-delay="0.3s" data-wow-duration="1s">
                <div class="col-md-12 col-sm-12 col-xs-12 no-margin">
                    <?php echo (html_entity_decode(Helper::editck('h2', '', '', '', 'Technical Excellence', 'h2STechnical ExcellceURE AREaah3'))); ?>
                    <?php echo (html_entity_decode(Helper::editck('p', '', '', '', 'Embedding technical innovation with perfection in the services brings technical excellence to each project at maplin. To provide best return to our customer and sta', 'pSEmbedding techon with perfectiservices brings teE AREaah3'))); ?>

                </div>
            </div>
        </div>
        <div class="partners_slider">
            <div class="row">
                <div class="owl-carousel wow fadeInUp divAlign" data-wow-delay="0.3s" data-wow-duration="1s"
                    id="product2">
                    @if($teams)
                    @foreach($teams as $team)
                    <div>
                        <div class="partner_box divAlign">
                            <a href="javascript:void(0)">
                                <!-- <img alt="{{$team->name}}" src="{{asset($team->img)}}"> -->

                                <img src="{{asset('web/images/1488.gif')}}" class="lazy"
                                    data-src="{{asset($team->img)}}" alt="{{$team->name}}" />

                                <div class="partner_overlay text-center">
                                    <div class="test">
                                        <h6>{{$team->name}}</h6><span>{{$team->designation}}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    @endif

                    {{--
                        <div>
                            <div class="partner_box">
                                <a href="javascript:void(0)"><img alt="img" src="{{asset('web/images/partner_img2.jpg')}}">
                    <div class="partner_overlay text-center">
                        <div class="test">
                            <h6>LOREM IPSUM</h6><span>Asst Director</span>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
            <div>
                <div class="partner_box">
                    <a href="javascript:void(0)"><img alt="img" src="{{asset('web/images/partner_img3.jpg')}}">
                        <div class="partner_overlay text-center">
                            <div class="test">
                                <h6>LOREM IPSUM</h6><span>Asst Director</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div>
                <div class="partner_box">
                    <a href="javascript:void(0)"><img alt="img" src="{{asset('web/images/partner_img4.jpg')}}">
                        <div class="partner_overlay text-center">
                            <div class="test">
                                <h6>LOREM IPSUM</h6><span>Asst Director</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div>
                <div class="partner_box">
                    <a href="javascript:void(0)"><img alt="img" src="{{asset('web/images/partner_img1.jpg')}}">
                        <div class="partner_overlay text-center">
                            <div class="test">
                                <h6>LOREM IPSUM</h6><span>Asst Director</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div>
                <div class="partner_box">
                    <a href="javascript:void(0)"><img alt="img" src="{{asset('web/images/partner_img2.jpg')}}">
                        <div class="partner_overlay text-center">
                            <div class="test">
                                <h6>LOREM IPSUM</h6><span>Asst Director</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            --}}
        </div>
    </div>
</div>
</div>
</div>

@include('web.extends.footer-layer')


@endsection @section('css')
<style type="text/css"></style>
@endsection
@section('js')
<script>
$('#product2').owlCarousel({

});
</script>
@endsection