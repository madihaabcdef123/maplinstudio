<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- START: Head-->

<head>
    <meta charset="UTF-8">
    <title>{{isset($title)?$title:Helper::config('websitename')}}</title>
    <meta name="description" content="{{isset($description)?$description:Helper::config('websitename')}}" />
    <meta name="keywords" content="{{isset($keywords)?$keywords:Helper::config('websitename')}}">

    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- START: Template CSS-->
    @include('web.layouts.links')
    @yield('css')
    <!-- END: Custom CSS-->
</head>
<!-- END Head-->

<!-- START: Body-->

<body class="royal_preloader">
    <div id="myDiv">
        <div>
            <img id="loading-image" src="{{asset('images/payment-animation.gif')}}" style="display:none;" />
        </div>
    </div>

    <div class="main-body">
        <input type="hidden" id="web_url" value="{{url('/')}}" />
        <!-- START: Pre Loader-->
        <div class="se-pre-con">
            <div class="loader"></div>
        </div>
        <!-- END: Pre Loader-->

        <!-- START: Header-->
        @include('web.layouts.header')
        <!-- END: Header-->

        <!-- END: Main Menu-->

        <!-- START: Main Content-->
        @yield('content')
        <!-- END: Content-->



        @include('web.layouts.footer')
        <!-- START: Template JS-->
        @include('web.layouts.scripts')

        @yield('js')

    </div>
</body>
<!-- END: Body-->

</html>