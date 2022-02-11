@extends('web.layouts.main')
@section('content')

<!-- Begin: Crousel -->
<div class="main-slider conts">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">

                <!-- <img src="{{asset((isset($banner) && isset($banner->img))?$banner->img:'web/images/Layer-22.png')}}" alt="{{((isset($banner) && isset($banner->name))?$banner->name:Helper::config('websitename'))}}" width="100%"> -->


                <img src="{{asset('web/images/808.gif')}}" class="head_lazy"
                    data-src="{{asset((isset($banner) && isset($banner->img))?$banner->img:'web/images/Layer-22.png')}}"
                    width="100%">

                <div class="carousel-caption">

                    <h1 class="wow zoomInRight" data-wow-duration="2s" data-wow-delay="0.2s">Terms & Condition</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="terms contactinfo_contactpage">
    <div class="Particles-js3" id="particles-js"></div>
    <div class="container">

        <div class="row">
            <div class="term-condition">
                <div class="col-12">
                    <?php echo (html_entity_decode(Helper::editck('h2', 'wow zoomIn', '0.3s', '2s', 'Terms & Condition' ,'h2DiscPrivacTerms & Conditionn TouhEaah3')));?>



                    <?php echo (html_entity_decode(Helper::editck('p', 'wow zoomIn', '0.6s', '2s', 'Lorem ipsum dolor sit amet, est id putant fabulas ponderum, mundi libris omnium in sea. Mei porro' ,'pDiscPrivacTerms & ConditLorem ipsum dolor sit amet, est id putant fabulas ponderum, mundi libris omnium in sea. Mei porro TouhEaah3')));?>
                    <?php echo (html_entity_decode(Helper::editck('p', 'wow zoomIn', '0.6s', '2s', 'Lorem ipsum dolor sit amet, est id putant fabulas ponderum, mundi libris omnium in sea. Mei porro' ,'pDiscPrivacTerms & Conditionn TouLorem ipsum dolor sit amet, est id putant fabulas ponderum, mundi libris omnium in sea. Mei poaeagrroh3')));?>
                    <?php echo (html_entity_decode(Helper::editck('p', 'wow zoomIn', '0.6s', '2s', 'Lorem ipsum dolor sit amet, est id putant fabulas ponderum, mundi libris omnium in sea. Mei porro' ,'pDiscPrivacTerms & Lorem ipsum dolor sit amet, est id putant fabulas ponderum, mundi libris omnium in sea. Mei porroitionn TouhEaah3')));?>
                    <?php echo (html_entity_decode(Helper::editck('p', 'wow zoomIn', '0.6s', '2s', 'Lorem ipsum dolor sit amet, est id putant fabulas ponderum, mundi libris omnium in sea. Mei porro' ,'pDiscPrivacTerms & Conditionn ToLorem ipsum dolor sit amet, est id putant fabulas ponderum, mundi libris omnium in sea. Mei porroaah3')));?>
                </div>
            </div>
        </div>
    </div>
</section>

@include('web.extends.footer-layer')

@endsection @section('css')
<style type="text/css"></style>
@endsection @section('js') @endsection