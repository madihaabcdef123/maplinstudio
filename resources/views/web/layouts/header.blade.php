<header>

    <div class="container">

        <div class="bottom-row affix" data-offset-top="190" data-spy="affix">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-xs-12">
                    <div class="logo-brand">
                        <a href="{{route('welcome')}}"> <img src="{{asset('web/images/logo.png')}}" alt=""
                                class="img-responsive"> </a>
                        <div onclick="header()" id="toggle">
                            <div class="one"></div>
                            <div class="two"></div>
                            <div class="three"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 col-md-10 col-xs-12">
                    <nav id="menu" class="navbar custom-navbar navbar-expand-lg navbar-light bg-light">
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

                            <li class="nav-item {{(isset($menu) && $menu == 'planning'?'active':'')}}">
                                <a class="nav-link" href="{{route('planning')}}">Planning</a>
                            </li>
                            <li class="nav-item {{(isset($menu) && $menu == 'projects'?'active':'')}}">
                                <a class="nav-link " href="{{route('project')}}">Projects</a>
                            </li>
                            <li class="nav-item {{(isset($menu) && $menu == 'studio'?'active':'')}}">
                                <a class="nav-link " href="{{route('studio')}}">Studio</a>
                            </li>
                            <li class="nav-item {{(isset($menu) && $menu == 'about'?'active':'')}}">
                                <a class="nav-link " href="{{route('about')}}">about</a>
                            </li>
                            <li class="nav-item {{(isset($menu) && $menu == 'news'?'active':'')}}">
                                <a class="nav-link " href="{{route('news')}}">News</a>
                            </li>
                            <li class="nav-item {{(isset($menu) && $menu == 'career'?'active':'')}}">
                                <a class="nav-link " href="{{route('career')}}">Careers</a>
                            </li>
                            <li class="nav-item {{(isset($menu) && $menu == 'contact'?'active':'')}}">
                                <a class="nav-link " href="{{route('contact')}}">Contact Us</a>
                            </li>
                            <li class="nav-item {{(isset($menu) && $menu == 'book_expert'?'active':'')}}">
                                <a class="nav-link mybutton" href="{{route('book_expert')}}">Book A Free Site Visit</a>
                            </li>
                            @auth
                            <li class="nav-item">
                                <a class="nav-link mybutton" href="{{route('logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                            </li>
                            @endauth
                            @guest
                            <!--<li class="nav-item">-->
                            <!--    <a class="nav-link mybutton" href="{{route('signup')}}">My Account</a>-->
                            <!--</li>-->
                            @endguest

                        </ul>
                    </nav>
                </div>
            </div>
        </div>

    </div>

</header>