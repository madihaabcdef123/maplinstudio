<footer>
    <!-- Footer Section Starts Here -->
    <div class="footerSec">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="row">
                        <div class="col-sm-3 col-xs-6">
                            <div class="footer-nav footer-content">

                                <h6 class="wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="2s">Navigation
                                </h6>
                                <ul class="wow fadeIn" data-wow-delay="0.4s" data-wow-duration="2s">
                                    <li>
                                        <a href="{{route('planning')}}">Planning</a>
                                    </li>
                                    <li>
                                        <a href="{{route('project')}}">Projects</a>
                                    </li>
                                    <li>
                                        <a href="{{route('studio')}}">Studio</a>
                                    </li>
                                    <li>
                                        <a href="{{route('about')}}">People</a>
                                    </li>
                                    <li>
                                        <a href="{{route('signup')}}">My Account</a>
                                    </li>

                                </ul>

                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div class="footer-nav footer-content">

                                <h6 class="wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="2s">Links</h6>
                                <ul class="wow fadeIn" data-wow-delay="0.4s" data-wow-duration="2s">
                                    <li>
                                        <a href="{{route('career')}}">Careers</a>
                                    </li>
                                    <li>
                                        <a href="{{route('news')}}">News</a>
                                    </li>
                                    <li>
                                        <a href="{{route('terms')}}">Terms & Conditions</a>
                                    </li>
                                    <li>
                                        <a href="{{route('privacy')}}">Privacy Policy</a>
                                    </li>
                                    <li>
                                        <a href="{{route('disclaimer')}}">Disclaimer</a>
                                    </li>

                                </ul>

                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="footer-newsletter footer-content">
                                <?php echo (html_entity_decode(Helper::editck('h6', 'wow fadeInRight', '0.2s', '2s', 'Newsletter', 'h6Newsletter'))); ?>
                                <?php echo (html_entity_decode(Helper::editck('p', 'wow fadeInRight', '0.3s', '2s', 'Enter your email & subcribing newsletter', 'pEnteryouremail&subcribingnewsletter'))); ?>
                                <form class="wow fadeInLeft" data-wow-duration="2s"
                                    action="{{route('newsletter_submit')}}" method="POST">
                                    @csrf
                                    <input class="form-control" name="email" placeholder=" Email Address" type="email">
                                    <div class="btn-signup">
                                        <input class="form-control" type="submit" value="Subscribe">
                                    </div>
                                </form>
                                <ul class="ftr-icon">
                                    <li class="fb wow zoomIn" data-wow-delay="0.2s" data-wow-duration="2s">
                                        <a href="{{'https://'.Helper::config('facebooklink')}}"><i aria-hidden="true"
                                                class="fa fa-facebook"></i></a>
                                    </li>
                                    <li class="g-plus wow zoomIn" data-wow-delay="0.4s" data-wow-duration="2s">
                                        <a href="{{'https://'.Helper::config('twitterlink')}}"><i aria-hidden="true"
                                                class="fa fa-twitter"></i></a>
                                    </li>
                                    <li class="tw wow zoomIn" data-wow-delay="0.6s" data-wow-duration="2s">
                                        <a href="{{'https://'.Helper::config('linkedinlink')}}"><i aria-hidden="true"
                                                class="fa fa-linkedin"></i></a>
                                    </li>

                                    <li class="tw wow zoomIn" data-wow-delay="0.6s" data-wow-duration="2s">
                                        <a href="{{'https://'.Helper::config('instagramlink')}}"><i aria-hidden="true"
                                                class="fa fa-instagram"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copy-right">
                <p>Copyright © 2022 {{Helper::config('websitename')}}.</p>
            </div>
        </div>
    </div><!-- Footer Section Ends Here -->
</footer>