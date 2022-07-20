<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }} | @yield('title')</title>
  <link rel="shortcut icon" href="{{{ asset('assets/images/sedegesaddds.png') }}}" type="image/x-icon" />
  {!! Html::style('assets/js/bootstrap/dist/css/bootstrap.min.css') !!}
  {!! Html::style('assets/js/font-awesome/css/font-awesome.min.css') !!}
  {!! Html::style('assets/js/nprogress/nprogress.css') !!}
  {!! Html::style('assets/css/animate.min.css') !!}
  {!! Html::style('assets/css/custom.css') !!}
  @yield('after-style')
  {!! Html::script('assets/js/jquery/dist/jquery.min.js') !!}
</head>
<body class="login" >

      @yield('content')
    
  </div>
  @yield('after-script')
</body>
</html>