@extends('layouts.homelogin')

@section('title', 'LOGIN')

@section('after-style')
<style>
  .myappbtn{
     background: #ffff00;
     color: #330000;
         position: relative;
    padding: 12px 3px;
    margin: 10px 10px 0px 0px;
    min-width: 80px;
    height: 60px;
    box-shadow: none;
    border-radius: 0;
    text-align: center;
    border: 1px solid #ddd;
    font-size: 11px;
    width: 100%;
  }
  .myappbtn:hover{
     background: #fff;
     color: #330000;
  }
  .btn.myappbtn>.badge {
    position: absolute;
    top: -3px;
    right: -10px;
    font-size: 10px;
    font-weight: 400;
}
.btn.myappbtn>.fa {
    font-size: 16px;
    display: block;
}
</style>
@endsection

@section('content')
    <div class="row animate form login_form">
        <div class="x_panel login_content" style="width: 100%;margin: 0 auto 0 auto;background-size:cover;-webkit-background-size: cover;-o-background-size: cover;-ms-background-size: cover;-moz-background-size: cover;min-height:416px;position: relative;box-shadow: 7px 6px 7px #4c5178;-o-box-shadow: 7px 6px 7px #4c5178;-moz-box-shadow: 7px 6px 7px #4c5178;-webkit-box-shadow: 7px 6px 7px #4c5178;">
            <div class="x_title">
                <center>
                    <img src="{{asset("logots/logo.jpg")}}" width="200px" height="200px">
                </center>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    {!! Form::open(['url'=>'login', 'method'=>'post', 'role'=>'form', 'class' => 'form-signin']) !!}
                        {{ csrf_field() }}
                        <div class="text-left form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="control-label" id="email">EMAIL:</label>
                            {!! Form::email('email', old('email'), ['id'=>'email','class'=>'form-control', 'placeholder' => 'email', 'required'=>'true', 'autofocus'=>'true']) !!}
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="text-left form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="control-label" for="password">CONTRASEÑA:</label>
                            <input type="password" class="form-control" placeholder="Password" id="password" name="password" required />
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <center>
                            <div class="item form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-sm btn-primary btn-block" type="submit"><i class="fa fa-sign-in"></i> Ingresar</button>
                                </div>
                            </div>
                        </center>
                    {!! Form::close() !!}
                </div>
                <a class="reset_pass" href="{{ url('/password/reset') }}">Perdiste tu contraseña?</a>
                 
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <a href="http://megaterrabo.com" class="btn myappbtn" >
                    <i class="fa fa-reply-all"></i> Pagina Principal
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{url("/inicio")}}" class="btn myappbtn" >
                    <i class="fa fa-home"></i> Volver A inicio
                </a>
            </div>
        </div>
    </div>
@endsection

@section('after-script')

@endsection