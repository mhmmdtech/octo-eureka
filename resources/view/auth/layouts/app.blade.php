<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en" > <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en" > <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en" > <![endif]-->
<!--[if lt IE 9]>
  <script src="<?=  asset('auth-assets/js/utilities/html5shiv-printshiv.min.js')  ?>"></script>
<![endif]-->
<html dir="ltr" class="no-js" lang="en">
  <head>
    @include('auth.layouts.head-tags')
    @yield('head-tags')

    @include('auth.layouts.css-tags')
    @yield('css-tags')
    
    @include('auth.layouts.script-tags')
    @yield('script-tags')
  </head>
  <body class="w-100 d-flex flex-column pos-relative primary-bg">
    @yield('content')
  </body>
</html>
