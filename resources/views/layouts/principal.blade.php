<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="dos.cristian.us@gmail.com">
    <title>{{ config('app.name') }} | @yield('title')</title>
    <link rel="shortcut icon" href="{{{ asset('assets/images/sedegesaddds.png') }}}" type="image/x-icon" />
    @yield('before-style')
    {!! Html::style('assets/js/bootstrap/dist/css/bootstrap.css') !!}
    {!! Html::style('assets/js/font-awesome/css/font-awesome.min.css') !!}
    {!! Html::style('assets/js/nprogress/nprogress.css') !!}
    {!! Html::style('assets/css/custom.css') !!}
    <link href="{{ asset('assets/toastr/toastr.min.css') }}" rel="stylesheet">
    @yield('after-style')
    {!! Html::script('assets/js/jquery/dist/jquery.min.js') !!}
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{!!URL::to('home')!!}" class="site_title"><i class="fa fa-suitcase"></i><span>@lang('validation.subtitulos.menu_title')</span></a>
            </div>
            <div class="clearfix"></div>
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{{ asset('assets/images/sedegses.png') }}}" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <h2>nombre de usuario</h2>
                <h6 style="color: #ffff00;">cargo de usuario</h6>
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
      <script src="{{ asset('assets/toastr/toastr.min.js') }}"></script>
      {!! Html::script('assets/js/custom.js')!!}
      <script>
        var global_url="{{url('/')}}";
        var global_asset="{{asset('')}}";
      </script>
      @if(session()->has('notification'))
      <script>
         toastr.{{session()->get('notification')['type']}}('{{session()->get('notification')['message']}}');
      </script>
      @endif

      @if(isset($notification))
      <script>
         toastr.{{$notification['type']}}('{{$notification['message']}}');
      </script>
      @endif
      @yield('after-script')
  </body>
</html>