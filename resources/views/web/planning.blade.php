@extends('web.layouts.main')
@section('content')

<div class="main-slider conts">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">

                <!-- <img src="{{asset((isset($banner) && isset($banner->img))?$banner->img:'web/images/bi.png')}}"
                    alt="{{((isset($banner) && isset($banner->name))?$banner->name:Helper::config('websitename'))}}"
                    width="100%"> -->

                <img src="{{asset('web/images/808.gif')}}" class="head_lazy"
                    data-src="{{asset((isset($banner) && isset($banner->img))?$banner->img:'web/images/bi.png')}}">

                <div class="carousel-caption">

                    <h1 class="wow zoomInRight" data-wow-duration="2s" data-wow-delay="0.2s">Planning</h1>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Aboutus End-->

<!-- Floor Plan -->


<!-- Floor Plan End -->

<!-- Video Tour -->

<section class="videotour">

    <div class="container">
        <div class="Particles-js3" id="particles-js"></div>

        <!-- Aboutus -->


        <div class="row">
            <div class="col-md-12 col-sm-12">

                <div class="relative-dev">
                    <?php echo (html_entity_decode(Helper::editck('h2', 'wow fadeInDown', '0.2s', '2s', 'Video TOur' ,'h2PlaVideo TOurplications')));?>

                    <div class="video-counselling-box wow zoomIn" data-wow-duration="2s" data-wow-delay="0.3s">
                        <img src="{{asset($inner_banner_1->img)}}" class="img-responsive"
                            alt="{{$inner_banner_1->details}}">
                        <div class="overlay-counselling-video">
                            <a data-fancybox="" href="{{Helper::config('websitestourguide')}}"><img
                                    src="{{asset('web/images/play-btn.png')}}" class="img-responsive" alt=""></a>
                        </div>
                    </div>

                    <img src="{{asset($inner_banner_2->img)}}" alt="{{$inner_banner_2->details}}" class="relatve">
                </div>
            </div>
        </div>

        <div class="row spac50">
            <div class="col-md-6 col-sm-6">

                <?php echo (html_entity_decode(Helper::editck('h3', 'wow zoomInUp', '0.2s', '2s', 'Planning Applications' ,'h3PlanningApplications')));?>

                <?php echo (html_entity_decode(Helper::editck('p', 'topmaring wow zoomInRight', '0.4s', '2s', 'We provide advice on a wide range of Pre-Planning and Planning Applications Services across England & Wales. Our experienced planning and architecture consultants can offer support in the preparation, submission, and management of all types of planning applications.' ,'pWeprovideadviceonawideandPlanningApplicationsServices')));?>

                <?php echo (html_entity_decode(Helper::editck('ul', 'topmaring wow zoomInRight', '0.4s', '2s', 'Prior approval application for a dwelling house e.g., rear extension or loft conversion' ,'ulPriorapprovalapplicationforadwellingorloftconversion')));?>

            </div>
            <div class="col-md-6 col-sm-6">
                <br>
                <br>
                <br>
                <br>

                <?php echo (html_entity_decode(Helper::editck('p', 'topmaring wow zoomInRight', '0.4s', '2s', 'Using maplin studio, the benefits are simple as we provide:' ,'pUsing maplin studio,thebenefitsaresimpleasweprovide')));?>
                <?php echo (html_entity_decode(Helper::editck('ul', 'topmaring wow zoomInRight', '0.4s', '2s', 'Free Site Visit Quick User-Friendly System' ,'ulFreeQuickUserFriendlySystem')));?>
                <br>
                <?php echo (html_entity_decode(Helper::editck('p', 'topmaring wow zoomInRight', '0.4s', '2s', 'First with your location. A small fee could be admissible for remote locations.' ,'pAsmallfeecouldbeadmissibleforremotelocations')));?>

                <!--    <a href="#" class="btn-default wow zoomInUp" data-wow-duration="2s" data-wow-delay="0.7s">Read More</a> -->
            </div>
        </div>

    </div>
</section>


<!-- Video Tour End -->

<!-- Exlusive Residence -->

<!-- <section class="exlusiveresidence">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="wow fadeInDown" data-wow-duration="2s" data-wow-delay="0.2s">PLANNING APPEALS</h2>
          </div>
          <div class="col-md-6 col-sm-6">
            <img src="{{asset('web/images/exslusive-img.jpg')}}" alt="" width="100%" class="wow zoomInUp" data-wow-duration="2s" data-wow-delay="0.4s">
            <p class="wow zoomIn" data-wow-duration="2s" data-wow-delay="0.6s">No one wants an appeal, but sometimes it’s unavoidable. If a planning permission has been refused by the Local Planning Authority, we would love to evaluate your application for Appeal merits, advise, and represent you, of course. Depending upon complexity and nature of refusal, we’ll advise you on the either of the following types of Appeals to pursue. All this initial advice is FREE OF COST…</p>
            <ul class="wow zoomIn" data-wow-duration="2s" data-wow-delay="0.6s">

              <li>Written Appeal Procedure</li>
     <li>Hearing Appeal, or</li>
     <li>Inquiry Procedure, for the most complex applications and enforcements</li>

            </ul>


            <a href="#" class="btn-default wow zoomIn" data-wow-duration="2s" data-wow-delay="0.7s">READ MORE</a>
          </div>
          <div class="col-md-6 col-sm-6">
            <img src="{{asset('web/images/exslusive-img1.jpg')}}" alt="" width="100%" class="wow zoomInUp" data-wow-duration="2s" data-wow-delay="0.6s">
            <p  class="wow zoomIn" data-wow-duration="2s" data-wow-delay="0.6s">We bring unmatched knowledge, ethos, national and local adopted policies to each Appeal. Our strategy is to focus on the facts and provide your case with the best prospects of winning. Our passionate approach has brought an unmatched Appeals successes. Few of our complex Hearing and Inquiry Appeals work are listed below:</p>
            <ul class="wow zoomIn" data-wow-duration="2s" data-wow-delay="0.6s">
              <li>APP/G5750/W/19/3230147 </li>
              <li>APP/E5900/W/18/3195526</li>
              <li>APP/G5750/C/16/3164465</li>



            </ul>
            <a  href="#" class="btn-default wow zoomIn" data-wow-duration="2s" data-wow-delay="0.7s">READ MORE</a>
          </div>
        </div>
      </div>
    </section> -->


<div class="partners_section">
    <div class="container">
        <div class="row">
            <div class="partners_text wow fadeInLeft" data-wow-delay="0.3s" data-wow-duration="1s">
                <div class="col-md-12 col-sm-12 col-xs-12 no-margin">
                    <?php echo (html_entity_decode(Helper::editck('h2', '', '', '', 'Planning Appeals' ,'h2Planning Appeals')));?>
                    <?php echo (html_entity_decode(Helper::editck('p', '', '', '', 'No one wants an appeal, but sometimes it’s unavoidable. If a planning permission has been refused by the Local Planning Authority, we would love to evaluate your application for Appeal merits, advise, and represent you, of course. Depending upon complexity and nature of refusal, we’ll advise you on the either of the following types of Appeals to pursue. All this initial advice is FREE OF COST…' ,'pNoonewantsanappealbutsometimesitsunavoidable')));?>

                </div>
            </div>
        </div>
        <div class="partners_slider">
            <div class="row">
                <div class="owl-carousel wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1s" id="product3">
                    <div>
                        <div class="partner_box">
                            <a href="project.html"><img alt="img" src="{{asset('web/images/exslusive-img.jpg')}}">
                                <div class="partner_overlay text-center">
                                    <div class="test">
                                        <h6>LOREM IPSUM</h6><span>Appeal</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div>
                        <div class="partner_box">
                            <a href="project.html"><img alt="img" src="{{asset('web/images/exslusive-img.jpg')}}">
                                <div class="partner_overlay text-center">
                                    <div class="test">
                                        <h6>LOREM IPSUM</h6><span>Appeal</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div>
                        <div class="partner_box">
                            <a href="project.html"><img alt="img" src="{{asset('web/images/exslusive-img.jpg')}}">
                                <div class="partner_overlay text-center">
                                    <div class="test">
                                        <h6>LOREM IPSUM</h6><span>Appeal</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div>
                        <div class="partner_box">
                            <a href="project.html"><img alt="img" src="{{asset('web/images/exslusive-img.jpg')}}">
                                <div class="partner_overlay text-center">
                                    <div class="test">
                                        <h6>LOREM IPSUM</h6><span>Appeal</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div>
                        <div class="partner_box">
                            <a href="project.html"><img alt="img" src="{{asset('web/images/exslusive-img.jpg')}}">
                                <div class="partner_overlay text-center">
                                    <div class="test">
                                        <h6>LOREM IPSUM</h6><span>Appeal</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div>
                        <div class="partner_box">
                            <a href="project.html"><img alt="img" src="{{asset('web/images/exslusive-img.jpg')}}">
                                <div class="partner_overlay text-center">
                                    <div class="test">
                                        <h6>LOREM IPSUM</h6><span>Appeal</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="sectors_sec2">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2 col-sm-12 col-sm-offset-2 col-xs-12">
                <div class="sectors_text1 text-center wow zoomInUp" data-wow-duration="2s" data-wow-delay="0.2s">
                    <?php echo (html_entity_decode(Helper::editck('h2', '', '', '', 'Lorem Ipsum' ,'h2LoremIpsumh2')));?>
                    <?php echo (html_entity_decode(Helper::editck('p', '', '', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate' ,'pLorem ipsum dolor sit amet,consecteturadipiscingseddolaboreetdoloremagnaaliqua')));?>
                    <?php echo (html_entity_decode(Helper::editck('p', '', '', '', 'velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed' ,'pvelitessecillumeufugiat sunt in quiofficiadeseruntanim estLoremipsumdolorsited')));?>
                </div>
            </div>
        </div>
    </div>
</div>

<!--
        <section class="Img-sec videotour">
            <div class="container">
              <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                  <img src="{{asset('web/images/img1.jpg')}}" class="img-responsive wow fadeInLeft" data-wow-delay="0.2s" alt="" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInLeft;">
                </div>

                <div class="col-xs-12 col-sm-8 col-md-8">
                   <div class="col-xs-12 col-sm-12 col-md-12 padding-zero">
                      <img src="{{asset('web/images/img2.jpg')}}" class="img-responsive wow fadeInUp" data-wow-delay="0.2s" alt="" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                    </div>

              <div class="col-xs-12 col-sm-6 col-md-6 padding-zero">
              <img src="{{asset('web/images/surveygrading.jpg')}}" class="img-responsive wow fadeInUp" data-wow-delay="0.4s" alt="" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
              </div>

                      <div class="col-xs-12 col-sm-6 col-md-6 padding-zero">
                         <img src="{{asset('web/images/img4.jpg')}}" class="img-responsive wow fadeInUp" data-wow-delay="0.6s" alt="" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">
                      </div>
                </div>
              </div>
            </div>
          </section> -->


@include('web.extends.footer-layer')


@endsection @section('css')
<style type="text/css"></style>
@endsection @section('js') @endsection