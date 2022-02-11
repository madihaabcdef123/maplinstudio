@extends('web.layouts.main')
@section('content')    
    
<div class="main-slider conts">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="{{asset('wen/images/Layer-22.png')}}" alt="banner" width="100%" />
                <div class="carousel-caption">
                    <h1 class="wow zoomInRight" data-wow-duration="2s" data-wow-delay="0.2s">Reset Password</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="contact-page-main log-in-page-main pt-80 pb-80 contactinfo_contactpage">
    <div class="Particles-js3" id="particles-js"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 wow fadeInLeft" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInLeft;">
                <div class="log-in-wrap">
                    <h2>{{ __('Resets Password') }}</h2>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form id="forms-signin" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <input id="emailaddress" placeholder="Enter your email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="login_btn">{{ __('Send Password Reset Link') }}</button>
                        </div>
                        <div class="col-md-12 mt-3">
                            <a class="btn btn-link" href="{{ url('/signup') }}">
                                        Or Login
                                    </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


   
@endsection

