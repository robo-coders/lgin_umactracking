<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>UMAC Tracking</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- add favicon --}}
    <!-- Place favicon.ico in the root directory -->

    
    <!-- CSS here -->
    <link rel="stylesheet" href="{{asset('/frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/frontend/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('/frontend/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('/frontend/css/slicknav.css')}}">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="{{asset('/frontend/css/style.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
    <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
    <script  type="text/javascript">
        $(document).ready(function () {
        // Handler for .ready() called.
        $('html, body').animate({
            scrollTop: $('#scroll').offset().top
        }, 'slow');
    });
    
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
 
<style>

    .overlay {
        display:none;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        position: fixed;
        z-index: 100000;
        background: rgba(0,0,0, 0.6);
    }
    
    .overlay__inner {
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        position: absolute;
    }
    
    .overlay__content {
        left: 50%;
        position: absolute;
        top: 50%;
        transform: translate(-50%, -50%);
    }
    
    .spinner {
        width: 75px;
        height: 75px;
        display: inline-block;
        border-width: 2px;
        border-color: rgba(255, 255, 255, 0.05);
        border-top-color: #fff;
        animation: spin 1s infinite linear;
        border-radius: 100%;
        border-style: solid;
    }
    
    @keyframes  spin {
        100% {
        transform: rotate(360deg);
        }
    }
    
    
</style> 
        
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header-start -->
    <div class="container">
        <div class="row">
            <div class="col-md-3 offset-md-9 mt-2 text-right">
                <div class="btn-group">
                    <button type="button" class="btn text-white" style="background-color: #FF3414;">{{ Auth::user()->name }}</button>
                    <button type="button" class="btn dropdown-toggle" style="background-color: #FF3414;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('adminDashboard') }}">My Dashboard</a></li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}" target="_blank" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                {{ __('Sign Out') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <header class="py-5">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-3">
                    <a href="{{ url('/') }}">
                        <img href="/" src="{{asset('/frontend/img/logo_main.png')}}" class="img-fluid" alt="Responsive image">
                    </a>
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="col py-2">
                            <p class="mb-0" style="color:#000;">UMAC FORWARDERS EXPRESS INC. Online Box Status Inquiry</p>
                            <p class="mb-0" style="font-size:smaller;color:#000;">Please enter the Box number and lastname below then click SEARCH</p>
                        </div>
                    </div>
                    <form class="row" action="{{ route('search') }}" method="get" onsubmit="return validsearch()">
                        {{-- @csrf --}}
                        <div class="col-md px-1 mb-3">
                            <input class="form-control" name="boxno" type="text" placeholder="BOX NUMBER" autofocus required=""  oninvalid="this.setCustomValidity('Please Enter box number')"
                        oninput="setCustomValidity('')">
                        </div>
                        <div class="col-md-3 col-md-offset-3 px-1">
                            <button class="btn text-white btn-block px-4" style="background-color: #FF3414;" type="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->
@yield('body')
   
    <!-- footer start -->
    <footer class="footer">
        {{-- Footer Top Area --}}
        <div class="copy-right_text">
            <div class="container">
                <div class="footer_border"></div>
                <div class="row">
                    <div class="col-xl-12">
                        <p class="copy_right text-center">
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Powered By: <a href="https://robocoders.dev/" target="_blank">Robo Coders</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--/ footer end  -->
<!-- Button trigger modal -->
  
  <!-- Modal -->
  <div class="modal fade custom_search_pop" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="serch_form">
            <input type="text" placeholder="search" >
            <button type="submit">search</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

<div class="overlay">
    <div class="overlay__inner">
        <div class="overlay__content"><span class="spinner"></span></div>
    </div>
</div>



<script>

    function validsearch(){
        $(".overlay").show();
        return true;
    }
</script>