@extends('web.layouts.main')
@section('content')

<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->


<div class="main-slider conts">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="{{asset((isset($banner) && isset($banner->img))?$banner->img:'web/images/abt_ban.png')}}" alt="banner" alt="{{((isset($banner) && isset($banner->name))?$banner->name:Helper::config('websitename'))}}" width="100%" />
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
                    <h2>RESET PASSWORD</h2>

                    <form id="forms-signin" method="POST" action="{{ route('password.update') }}">

                        @csrf

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email" class="col-md-12 col-form-label text-md-right p-0">{{ __('E-Mail Address') }}</label>

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                            </div>
                            
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password" class="col-md-12 col-form-label text-md-right p-0">{{ __('Password') }}</label>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password-confirm" class="col-md-12 col-form-label text-md-right p-0">{{ __('Confirm Password') }}</label>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                            </div>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="login_btn">RESET PASSWORD</button>
                        </div>

                        <div class="col-md-12 mt-3"></div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


@include('web.extends.footer-layer')


@endsection
