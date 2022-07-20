@extends('layouts.principal')

@section('title', $title)

@section('before-style')
  
@endsection

@section('after-style')
<style>
  .myappbtn{
     background: #330000;
     color: #fff;
         position: relative;
    padding: 12px 3px;
    margin: 0 0 8px 8px;
    min-width: 80px;
    height: 60px;
    box-shadow: none;
    border-radius: 0;
    text-align: center;
    border: 1px solid #ddd;
    font-size: 11px;
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

.profile_view {
  margin-bottom: 20px;
  display: inline-block;
  width: 100%;
}
.well.profile_view {
  padding: 10px 0 0;
}
.well.profile_view .divider {
  border-top: 1px solid #e5e5e5;
  padding-top: 5px;
  margin-top: 5px;
}
.well.profile_view .ratings {
  margin-bottom: 0;
}
.pagination.pagination-split li {
  display: inline-block;
  margin-right: 3px;
}
.pagination.pagination-split li a {
  border-radius: 4px;
  color: #768399;
  -moz-border-radius: 4px;
  -webkit-border-radius: 4px;
}
.well.profile_view {
  background: #fff;
}
.well.profile_view .bottom {
  margin-top: -20px;
  background: #F2F5F7;
  padding: 9px 0;
  border-top: 1px solid #E6E9ED;
}
.well.profile_view .left {
  margin-top: 20px;
}
.well.profile_view .left p {
  margin-bottom: 3px;
}
.well.profile_view .right {
  margin-top: 0px;
  padding: 10px;
}
.well.profile_view .img-circle {
  border: 1px solid #E6E9ED;
  padding: 2px;
}
.well.profile_view h2 {
  margin: 5px 0;
}
.well.profile_view .ratings {
  text-align: left;
  font-size: 16px;
}
.well.profile_view .brief {
  margin: 0;
  font-weight: 300;
}
.profile_left {
  background: white;
}
</style>
@endsection

@section('menu')
    @include('menus.primary')
@endsection

@section('bar_top')
    @include('navs.principal')
@endsection

@section('content')
    <div class="">
        <div class="row" style="border-bottom: 1px solid #000000;box-shadow: 6px 6px 6px #330000;">
        <div class="col-md-12">
          <a href="{{route("cliente.create")}}" class="btn myappbtn" >
            <span class="badge bg-green">{{count($clientes)}}</span>
            <i class="fa fa-puzzle-piece"></i> Nuevo
          </a>
        </div>
      </div>
      <br>
        <div class="row">
          <div class="col-md-12">
            <div class="x_panel">
              <div class="x-content">
                <div class="row">
                  @foreach($clientes as $clie)
                    <div class="col-md-4 col-sm-4 col-xs-12 animated fadeInDown">
                      <div class="well profile_view">
                        <div class="col-sm-12" style="height: 170px">
                          <h4 class="brief"><i>cliente</i></h4>
                          <div class="left col-xs-7">
                            <h2>{{ "$clie->nombre $clie->apellidos"}}</h2>
                            <p><strong> <span class="fa fa-credit-card"></span> CI: </strong> {{$clie->ci}} </p>
                            <ul class="list-unstyled">
                              <li><i class="fa fa-home"></i> <b>Direccion:</b>  {{$clie->direccion}} </li>
                              <li><i class="fa fa-phone"></i> <b>Address:</b> {{$clie->telefono}}</li>

                            </ul>
                          </div>
                          <div class="right col-xs-5 text-center">
                            <img src="{{$clie->avatar}}" alt="" class="img-circle" style="width: 100%;height: 115px">
                          </div>
                        </div>
                        <div class="col-xs-12 bottom text-center">
                          <div class="col-xs-12 col-sm-6 emphasis">
                            <p class="ratings">
                              <a>4.0</a>
                              <a href="#"><span class="fa fa-star"></span></a>
                              <a href="#"><span class="fa fa-star"></span></a>
                              <a href="#"><span class="fa fa-star"></span></a>
                              <a href="#"><span class="fa fa-star"></span></a>
                              <a href="#"><span class="fa fa-star-o"></span></a>
                            </p>
                          </div>
                          <div class="col-xs-12 col-sm-6 emphasis">
                            <button type="button" class="btn btn-success btn-xs"> <i class="fa fa-user">
                                                            </i> <i class="fa fa-comments-o"></i> </button>
                            <button type="button" class="btn btn-primary btn-xs"> <i class="fa fa-user">
                                                            </i> View Profile </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    @endforeach 
                </div>
              </div>
            </div>
            
          </div>
           
        </div>
    </div>

    
@endsection

@section('after-script')

<script src="{{asset('componente/js/ol.js')}}"></script>
<script src="{{asset('componente/js/ol-ext.js')}}"></script>
<script src="{{asset("assets/js/autonumeric/autoNumeric.js")}}"></script>

    {!! Html::script('inputfile/js/fileinput.js') !!}
    {!! Html::script('inputfile/js/locales/es.js') !!}
    {!! Html::script('assets/js/wizard/jquery.smartWizard.js') !!}
    
    
@endsection