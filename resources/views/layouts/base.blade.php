<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="author" content="Created by P&P">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        {{ isset($title) && $title ? $title . ' | FA BENECOL Košice - futbalová akadémia' : 'FA BENECOL Košice - futbalová akadémia' }}
    </title>
    <meta name="description" content="@yield('description', 'Futbalová Akadémia Košice')" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="apple-touch-icon" href="{{asset('apple-touch-icon.png')}}" />
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/fav.png')}}" />
    <!-- bootstrap v3.3.6 css -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
    <!-- font-awesome css -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" />
    <!-- animate css -->
    <link rel="stylesheet" href="{{asset('css/animate.css')}}" />
    <!-- Main Menu css -->
    <link rel="stylesheet" href="{{asset('css/rsmenu-main.css')}}" />
    <!-- rsmenu transitions css -->
    <link rel="stylesheet" href="{{asset('css/rsmenu-transitions.css')}}" />
    <!-- hover-min css -->
    <link rel="stylesheet" href="{{asset('css/hover-min.css')}}" />
    <!-- magnific-popup css -->
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}" />
    <!-- owl.carousel css -->
    <link rel="stylesheet" href="{{asset('css/owl.carousel.css')}}" />
    <!-- Slick css -->
    <link rel="stylesheet" href="{{asset('css/slick.css')}}" />
    <!-- style css -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}" />
    <!-- responsive css -->
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}" />
    <!-- modernizr js -->
    <script src="{{asset('js/modernizr-2.8.3.min.js')}}"></script>


    @stack('css')

    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '614761429436510');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=614761429436510&ev=PageView&noscript=1" /></noscript>
    <!-- End Facebook Pixel Code -->
</head>

<body class="home-two">
    <!--Preloader start here-->
    <div id="preloader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <!--Preloader area end here-->

    @php
    require_once app_path() . '/Functions/simple_html_dom.php';

    $isAdmin = Auth::check() && Auth::user()->user_type == 'admin';
    $isTrainer = Auth::check() && Auth::user()->user_type == 'trainer';
    $unresolvedMatches = $unresolvedTournaments = false;
    if(Auth::check() && !($isTrainer || $isAdmin)){
    $unresolvedMatches = App\Event::whereHas('participants', function ($query) {
    $query->where('player_id', Auth::user()->id)->where('user_submitted', false);
    })
    ->where('event_type', 'match')
    ->where('event_date', '>=', Carbon\Carbon::today())
    ->get();
    $unresolvedMatches = !$unresolvedMatches->isEmpty();

    $unresolvedTournaments = App\Event::whereHas('participants', function ($query) {
    $query->where('player_id', Auth::user()->id)->where('user_submitted', false);
    })
    ->where('event_type', 'tournament')
    ->where('event_date', '>=', Carbon\Carbon::today())
    ->get();
    $unresolvedTournaments = !$unresolvedTournaments->isEmpty();
    }


    $html = file_get_html('https://fanzone.sk/kategoria-produktu/klubove-kolekcie/cft-benecol-kosice/');
    $products = $html->findFirst('.products');
    $prodArray = $products->find('.product-grid-item');
    $finalProducts = [];
    foreach($prodArray as $prod){
    $prodLink = $prod->findFirst('.product-element-top a')->href;
    $imgSrc = $prod->findFirst('.product-element-top a img')->src;
    $prodTitle = $prod->findFirst('.product-title')->plaintext;
    $finalProducts[] = [
    'title' => $prodTitle,
    'img' => $imgSrc,
    'link' => $prodLink
    ];
    }
    @endphp

    <!--Header area start here-->
    <header class="header-inner-page">
        <div class="header-top-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="header-top-left">
                            <ul>
                                <li class="margin-fix">
                                    @guest
                                    <a href="mailto:benecol@benecol.sk"><i class="fa fa-envelope-o"
                                            aria-hidden="true"></i>
                                        benecol@benecol.sk</a>
                                    @else
                                    Prihlásený ako: <span
                                        class="logged-as">{{ Auth::user()->name . ' ' . Auth::user()->surname }}</span>
                                    @endguest
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="social-media-area">
                            <nav>
                                <ul>
                                    <li>
                                        <a href="https://www.facebook.com/fa.benecol" class="active"><i
                                                class="fa fa-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/benecol_kosice/"><i
                                                class="fa fa-instagram"></i></a>
                                    </li>
                                    <li class="log margin-fix">
                                        @guest
                                        <a href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i>
                                            Prihlásiť sa</a>
                                        @else
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                                            Odhlásiť sa
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                        @endguest
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle-area menu-sticky">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-12 col-xs-12 logo">
                        <a href="{{ route('welcome') }}"><img src="{{asset('images/logo.png')}}" alt="logo" /></a>
                    </div>

                    <div class="col-md-10 col-sm-12 col-xs-12 mobile-menu">
                        <div class="main-menu">
                            <a class="rs-menu-toggle"><i class="fa fa-bars"></i>Menu</a>
                            <nav class="rs-menu">
                                <ul class="nav-menu">
                                    <!-- Drop Down -->
                                    <li>
                                        <a href="{{ route('events', ['type' => 'training']) }}">
                                            Tréningy
                                        </a>
                                    </li>
                                    <!-- Drop Down -->
                                    <li class="menu-item-has-children">
                                        <a href="#">
                                            Zápasy
                                        </a>
                                        <ul class="sub-menu">
                                            @foreach (App\Category::whereNotNull('futbalnet_path')->get() as $category)
                                            @if(preg_match('#[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si',$category->futbalnet_path))
                                            <li>
                                                <a href="{{ route('matches', ['category' => $category->id]) }}">
                                                    {{ $category->name }}
                                                </a>
                                            </li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="{{ route('documents') }}">
                                            Dokumenty
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('gallery') }}">
                                            Fotogaléria
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('contact') }}">
                                            Kontakty
                                        </a>
                                    </li>

                                    <li class="menu-item-has-children">
                                        <a href="{{ route('about') }}">
                                            O nás
                                        </a>
                                        <ul class="sub-menu">
                                            <li>
                                                <a href="{{ route('about') }}">
                                                    O nás
                                                </a>
                                            </li>

                                            <li>
                                                <a href="{{ route('trainers') }}">
                                                    Tréneri
                                                </a>
                                            </li>
                                        </ul>
                                    </li>


                                    @if ($isTrainer || $isAdmin)
                                    <li class="menu-item-has-children">
                                        <a href="#">Admin</a>
                                        <ul class="sub-menu">
                                            <li>
                                                <a href="{{ route('password-change.form', ['message' => 'change']) }}">
                                                    Zmena hesla
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('events.index') }}">
                                                    Udalosti
                                                </a>
                                            </li>
                                            @if ($isTrainer)
                                            <li>
                                                <a href="{{ route('trainer.attendance.create') }}">
                                                    Vytvoriť dochádzku
                                                </a>
                                            </li>
                                            @endif
                                            @if ($isAdmin)
                                            <li>
                                                <a href="{{ route('users.index') }}">
                                                    Použivatelia
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('category.index') }}">
                                                    Kategórie
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('attendance.index') }}">
                                                    Dochádzka
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('article.index') }}">
                                                    Novinky
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('membership.index') }}">
                                                    Členské
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('documents.index') }}">
                                                    Dokumenty
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('migration.form') }}">
                                                    Migrácia hráčov
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('notifications')}}">
                                                    Poslať notifikáciu
                                                </a>
                                            </li>
                                            @endif
                                        </ul>
                                    </li>
                                    @endif
                                    @if (Auth::check() && !$isAdmin && !$isTrainer)
                                    <li class="menu-item-has-children">
                                        <a href="javascript:void">Moje konto
                                            @if ($unresolvedMatches || $unresolvedTournaments)
                                            <span class="new-event-notification top-fix"></span>
                                            @endif
                                        </a>
                                        <ul class="sub-menu">
                                            <li>
                                                <a href="{{ route('events', ['type' => 'match']) }}">
                                                    Zápasy
                                                    @if ($unresolvedMatches)
                                                    <span class="new-event-notification"></span>
                                                    @endif
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('events', ['type' => 'tournament']) }}">
                                                    Turnaje
                                                    @if ($unresolvedTournaments)
                                                    <span class="new-event-notification"></span>
                                                    @endif
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('attendance.player') }}">
                                                    Moja Dochádzka
                                                </a>
                                            </li>
                                            <li>
                                                <a href=" {{ route('membership') }}">
                                                    Moje Členské
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('player.profile') }}">
                                                    Môj Profil
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('password-change.form', ['message' => 'change']) }}">
                                                    Zmena hesla
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    @endif
                                    <li>
                                        <a class="eshop-link" target="_blank"
                                            href="https://fanzone.sk/kategoria-produktu/klubove-kolekcie/cft-benecol-kosice/">
                                            E-shop
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--Header area end here-->

    @if (isset($title) && $title)
    <div class="rs-breadcrumbs sec-color">
        <img src="{{asset('images/full-slider/point-table-header.png')}}" alt="Breadcrumbs" />
        <div class="breadcrumbs-inner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1 class="page-title">{{ $title }}</h1>
                        <ul>
                            <li>
                                <a class="active" href="{{route('welcome')}}">Domov</a>
                            </li>
                            @if (isset($extra) && $extra)
                            @foreach ($extra as $item)
                            <li>
                                <a class="active" href="{{ $item['link'] }}">{{ $item['title'] }}</a>
                            </li>
                            @endforeach
                            @endif
                            <li>{{ $title }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @yield('content')

    <!-- Client Logo Section Start Here-->
    <!-- Background Photo by Mario Cuadros from Pexels, Thank you -->
    <div class="clicent-logo-section sec-spacer">
        <div class="overly-bg"></div>
        <!-- Products carousel -->
        @if (isset($finalProducts) && $finalProducts)
        <div class="container partners products-carousel">
            <h3 class="title-bg">Produkty</h3>
            <div id="upcoming" class="rs-carousel owl-carousel" data-loop="true" data-items="4" data-margin="20"
                data-autoplay="true" data-autoplay-timeout="5000" data-smart-speed="2000" data-dots="false"
                data-nav="false" data-nav-speed="false" data-mobile-device="1" data-mobile-device-nav="false"
                data-mobile-device-dots="false" data-ipad-device="2" data-ipad-device-nav="false"
                data-ipad-device-dots="false" data-ipad-device2="2" data-ipad-device-nav2="false"
                data-ipad-device-dots2="false" data-md-device="4" data-md-device-nav="false"
                data-md-device-dots="false">
                @foreach ($finalProducts as $prod)
                <div class="item">
                    <div class="single-logo">
                        <a target="_blank" href="{{ $prod['link'] }}"><img src="{{ $prod['img'] }}"
                                alt="{{ $prod['title'] }}"></a>
                    </div>
                    <h6 class="prod-title">
                        {{ html_entity_decode($prod['title']) }}
                    </h6>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        <!-- END Products carousel -->
        <div class="container partners">
            <h3 class="title-bg">Partneri</h3>
            <div id="upcoming" class="rs-carousel owl-carousel" data-loop="true" data-items="4" data-margin="20"
                data-autoplay="true" data-autoplay-timeout="5000" data-smart-speed="2000" data-dots="false"
                data-nav="false" data-nav-speed="false" data-mobile-device="1" data-mobile-device-nav="false"
                data-mobile-device-dots="false" data-ipad-device="2" data-ipad-device-nav="false"
                data-ipad-device-dots="false" data-ipad-device2="2" data-ipad-device-nav2="false"
                data-ipad-device-dots2="false" data-md-device="4" data-md-device-nav="false"
                data-md-device-dots="false">
                <div class="item">
                    <div class="single-logo">
                        <a target="_blank" href="https://www.coerver.sk/kempy/cft-academy.html"><img
                                src="{{asset('images/brands/JPEG/CFT-coerver-300x115.jpg')}}" alt=""></a>
                    </div>
                </div>
                <div class="item">
                    <div class="single-logo">
                        <a target="_blank" href="https://www.kosice.sk/"><img
                                src="{{asset('images/brands/JPEG/kosice_logo.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="item">
                    <div class="single-logo">
                        <a target="_blank" href="https://postupimska.sk/"><img
                                src="{{asset('images/brands/JPEG/postupimska.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="item">
                    <div class="single-logo">
                        <a target="_blank" href="http://cftacademy.sk/"><img
                                src="{{asset('images/brands/JPEG/CFT_academy-150x150.jpg')}}" alt=""></a>
                    </div>
                </div>
                <div class="item">
                    <div class="single-logo">
                        <a target="_blank" href="https://www.sportkosice.sk/"><img
                                src="{{asset('images/brands/JPEG/Košice-300x127.jpg')}}" alt=""></a>
                    </div>
                </div>
                <div class="item">
                    <div class="single-logo">
                        <a target="_blank" href="https://a4ka.sk/"><img src="{{asset('images/brands/JPEG/a4ka.png')}}"
                                alt="A4ka.sk"></a>
                    </div>
                </div>
                <div class="item">
                    <div class="single-logo">
                        <a target="_blank" href="http://www.cvcchrobak.sk/"><img
                                src="{{asset('images/brands/JPEG/SCVC_beniakovce-300x229.jpg')}}" alt=""></a>
                    </div>
                </div>
                <div class="item">
                    <div class="single-logo">
                        <a target="_blank" href="http://www.kosice-dh.sk/"><img
                                src="{{asset('images/brands/JPEG/furca.jpg')}}" alt=""></a>
                    </div>
                </div>
                <div class="item">
                    <div class="single-logo">
                        <a target="_blank" href="https://www.futbalsfz.sk/"><img
                                src="{{asset('images/brands/JPEG/sfz-logo.png')}}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Client Logo Section End Here-->
    <!-- Footer Start -->
    <footer id="footer-section" class="footer-section">
        <div class="footer-top">
            <div class="container">
                <div class="row footer-top-info">
                    <div class="col-md-12">
                        <h3 class="title-bg">Kontaktné informácie</h3>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <h2>Adresa</h2>
                        <p>Postupimská 37, Košice 040 22</p>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <h2>Telefón</h2>
                        <p><span>0915 650 721</span> – <span>0907 934 814</span></p>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <h2>E-mail</h2>
                        <p>benecol@benecol.sk</p>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <h2>Účet</h2>
                        <p>SK38 0200 0000 0018 8393 3457</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="copyright">
                            <p>
                                &copy; <span id="getCurrentYear"></span>
                                <a href="http://benecol.sk/" target="_blank">BENECOL Košice</a>. Všetky práva
                                vyhradené.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-6">
                        <div class="text-right ft-bottom-right">
                            <div class="footer-bottom-share">
                                <ul>
                                    <li>
                                        <a href="https://www.facebook.com/fa.benecol"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/benecol_kosice/"><i
                                                class="fa fa-instagram"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->

    <!-- Search Modal Start -->
    <div aria-hidden="true" class="modal fade search-modal" role="dialog" tabindex="-1">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="fa fa-close"></span>
        </button>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="search-block clearfix">
                    <form>
                        <div class="form-group">
                            <input class="form-control" placeholder="eg: Soccer News" type="text" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Start scrollUp  -->
    <div id="return-to-top">
        <span>Top</span>
    </div>
    <!-- End scrollUp  -->

    <!-- all js here -->
    <!-- jquery latest version -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <!-- Menu js -->
    <script src="{{asset('js/rsmenu-main.js')}}"></script>
    <!-- jquery-ui js -->
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
    <!-- bootstrap js -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- meanmenu js -->
    <script src="{{asset('js/jquery.meanmenu.js')}}"></script>
    <!-- wow js -->
    <script src="{{asset('js/wow.min.js')}}"></script>
    <!-- Slick js -->
    <script src="{{asset('js/slick.min.js')}}"></script>
    <!-- masonry js -->
    <script src="{{asset('js/masonry.js')}}"></script>
    <!-- magnific-popup js -->
    <!-- owl.carousel js -->
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <!-- magnific-popup js -->
    <script src="{{asset('js/jquery.magnific-popup.js')}}"></script>
    <!-- jquery.counterup js -->
    <script src="{{asset('js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('js/waypoints.min.js')}}"></script>
    <!-- main js -->
    <script src="{{asset('js/main.js')}}"></script>
    <!-- custom js -->
    <script src="{{asset('js/newScript.js')}}"></script>
    <!-- photo -->
    <script src="https://unpkg.com/smartphoto@1.1.0/js/smartphoto.min.js"></script>


    @stack('scripts')

</body>

</html>