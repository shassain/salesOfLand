<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | @yield('title')</title>
    <link rel="shortcut icon" href="{{{ asset('assets/images/sedegesaddds.png') }}}" type="image/x-icon" />
    @yield('before-style')
    {!! Html::style('assets/js/bootstrap/dist/css/bootstrap.css') !!}
    {!! Html::style('assets/js/font-awesome/css/font-awesome.min.css') !!}
    {!! Html::style('assets/js/nprogress/nprogress.css') !!}
    {!! Html::style('assets/css/custom.css') !!}
    {!! Html::script('assets/js/jquery/dist/jquery.min.js') !!}
    @yield('after-style')
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{!!URL::to('home')!!}" class="site_title"><i class="fa fa-suitcase"></i> <span>@lang('validation.subtitulos.menu_title')</span></a>
            </div>
            <div class="clearfix"></div>
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{{ asset('assets/images/sedegses.png') }}}" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <h2>{{ Auth::user()->nombre_usuario}}</h2>
                <h6 style="color: #ffff00;">{{ Auth::user()->cargo_usuario }}</h6>
              </div>
            </div>
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              @section('menu')
              @show
            </div>
          </div>
        </div>
        <div class="top_nav">
          @section('bar_top')
          @show
        </div>
        <div class="right_col" role="main">
          @yield('content')
        </div>
      </div>
    </div>
      {!! Html::script('assets/js/bootstrap/dist/js/bootstrap.min.js') !!}
      {!! Html::script('assets/js/fastclick/lib/fastclick.js') !!}
      {!! Html::script('assets/js/nprogress/nprogress.js') !!}
      {!! Html::script('assets/js/custom.js') !!}
      @yield('after-script')
  </body>
</html>