<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <meta name="author" content="Teqpace">
      <meta name="keywords" content="Reminder, Schedule emails, email reminder, Remifo">
      <meta name="description" content="Remifo is an application which schedules reminders to be sent out to emails at intervals">

      <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/favicon/apple-touch-icon.png') }}">
      <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon/favicon-32x32.png') }}">
      <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon/favicon-16x16.png') }}">
      <link rel="manifest" href="{{ asset('assets/images/favicon/site.webmanifest') }}">

      <title>{{ env('APP_NAME') }} Platform | Welcome</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-awesome.css')}}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/owlcarousel.css')}}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{asset('assets/css/color-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css')}}">

      <style>
          .navbar-toggler {
              padding: 0.25rem 0.50rem;
          }

          .navbar-toggler:focus {
              box-shadow: 0 0 0 0;
          }
          .navbar-toggler > span {
              height: 1px;
          }
      </style>
  </head>
  <body class="landing-page">
    <!-- page-wrapper Start-->
    <div class="page-wrapper landing-page">

        <!-- Page Header Start            -->
        <div class="container-fluid">
            <div class="sticky-header">
                <header>
                    <nav class="navbar navbar-b navbar-trans navbar-expand-xl fixed-top nav-padding" id="sidebar-menu">
                        <a class="navbar-brand p-0 txt-dark f-w-500 f-26 ms-0 ms-sm-3 ms-xl-5" href="#" aria-label="Remifo">
                            <img class="img-fluid" src="{{ asset('assets/images/logo.png') }}" width="36" alt="Remifo logo">&nbsp;{{ env('APP_NAME') }}
                        </a>

                        <button class="navbar-toggler navabr_btn-set custom_nav" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation"><span></span><span></span><span></span></button>

                        <div class="navbar-collapse justify-content-end collapse hidenav" id="navbarDefault">
                            <ul class="navbar-nav navbar_nav_modify me-1" id="scroll-spy">
                                @auth()
                                    <li class="nav-item buy-btn">
                                        <a class="nav-link js-scroll mx-0 mx-xl-4" href="{{ route('/') }}" aria-label="Login">
                                            <i class="fa fa-send-o"></i>&nbsp;Go to Dashboard
                                        </a>
                                    </li>
                                @else
                                    <li class="nav-item buy-btn">
                                        <a class="nav-link js-scroll" href="{{ route('login') }}" aria-label="Login">
                                            <i class="fa fa-sign-in"></i>&nbsp;Login
                                        </a>
                                    </li>
                                    <li class="nav-item mt-3 mt-xl-0">
                                        <a class="nav-link btn btn-outline-primary py-2 mx-0 mx-xl-4 js-scroll" href="{{ route('register') }}">Sign Up</a>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                    </nav>
                </header>
            </div>
        </div>

        <!-- Page Body Start            -->
        <section class="section-space cuba-demo-section app_bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 wow pulse" style="visibility: visible; animation-name: pulse;">
                        <div class="cuba-demo-content email-txt text-start">
                            <div class="couting mt-5 mt-md-0">
                                <h2 class="f-80 px-4 px-md-0"> Recurring Messaging Platform</h2>
{{--                                <br />--}}
{{--                                <p> Easily set up recurring reminder.</p>--}}
{{--                                <ul class="landing-ul">--}}
{{--                                    <li>With very easy steps;</li>--}}
{{--                                    <li>Initiate a recurring reminder once;</li>--}}
{{--                                    <li>And we do the follow up.</li>--}}
{{--                                    <li>Its absolutely free.</li>--}}
{{--                                </ul>--}}

{{--                                <h2 class="f-14 mt-4 mb-1 mb-md-0" aria-label="Do the set up and we'll do the follow up">--}}
{{--                                    DO THE SET UP & WE'LL DO THE FOLLOW UP.--}}
{{--                                </h2>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 wow pulse" style="visibility: visible; animation-name: pulse;">
                        <a href="#" data-bs-original-title="" title="">
                            <img class="img-fluid email-img" src="{{ asset('assets/images/landing/email-illustration.png') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-space cuba-demo-section frameworks-section" id="frameworks">
{{--            <div class="container">--}}
{{--          <div class="row">--}}
{{--            <div class="col-sm-12 wow pulse">--}}
{{--              <div class="cuba-demo-content mt50">--}}
{{--                <div class="couting">--}}
{{--                  <h2>--}}
{{--                      <span class="f-30">If it skips your mind, </span><br />--}}
{{--                      <span>Remifo reminds them.</span>--}}
{{--                  </h2>--}}
{{--                </div>--}}
{{--                <p class="mb-0"></p>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--            <div class="col-sm-12 framworks">--}}
{{--                <p>--}}
{{--                    There's so many things in our mind that makes it difficult for us to follow up or remind our friends, family, associates, colleagues or customers about essential things. You can now focus on other things while we take care of reminding them.--}}
{{--                </p>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--        </div>--}}

            <div class="container">
                <div class="landing-center">
                    <div class="footer-content text-center">
                        @guest()

                            <a class="btn btn-lg btn-primary mb-4 default-view" href="{{ route('login') }}">
                                Login
                            </a>
                            <a class="btn mrl5 btn-lg btn-outline-primary  mb-4 btn-md-res" href="{{ route('register') }}">Sign Up</a>
                        @endguest()

                        <a href="https://www.linkedin.com/showcase/remifo/" class="ms-2 txt-secondary mb-lg-0 mb-3" target="_blank">
                            <i class="fa fa-linkedin-square fa-3x" style="color: royalblue;"></i>
                        </a>

                        <a href="https://www.instagram.com/myremifo" class="ms-2 txt-secondary mb-lg-0 mb-3" target="_blank">
                            <i class="fa fa-instagram fa-3x"></i>
                        </a>
                    </div>
                </div>
            </div>

        </section>


    </div>

    <!-- latest jquery-->
    <script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
    <!-- Bootstrap js-->
    <script src="{{asset('assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <!-- feather icon js-->
    <!-- scrollbar js-->
    <!-- Sidebar jquery-->
    <script src="{{asset('assets/js/config.js')}}"></script>
    <!-- Plugins JS start-->
    <script src="{{asset('assets/js/owlcarousel/owl.carousel.js')}}"></script>
    <script src="{{asset('assets/js/tooltip-init.js')}}"></script>
    <script src="{{asset('assets/js/animation/wow/wow.min.js')}}"></script>
    <script src="{{asset('assets/js/landing_sticky.js')}}"></script>
    <script src="{{asset('assets/js/landing.js')}}"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{asset('assets/js/script.js')}}"></script>
    <!-- login js-->
    <!-- Plugin used-->
  </body>
</html>
