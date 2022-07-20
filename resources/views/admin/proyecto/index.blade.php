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
          <a href="{{route("proyecto.create")}}" class="btn myappbtn" >
            <span class="badge bg-green">{{count($proyectos)}}</span>
            <i class="fa fa-puzzle-piece"></i> Nuevo
          </a>
        </div>
      </div>
      <br>
        <div class="row">
          @foreach($proyectos as $pro)
          <div class="col-md-3 col-xs-12 widget widget_tally_box">
            <div class="x_panel fixed_height_300" style="box-shadow: 6px 6px 6px #330000;">
              <div class="x_content">
                <div class="flex">
                  <ul class="list-inline widget_profile_box">
                    <li>
                      <a href="{{route("proyecto.edit",$pro->id)}}">
                        <i class="fa fa-edit"></i>
                      </a>
                    </li>
                    @php 
                        $exite=$pro->imagenes->where("promocional",true)->first();
                    @endphp
                    <li>
                      <a href="{{route("proyecto.asing_img",$pro->id)}}">
                        @if($exite!=null)
                        <img src="{{asset($exite->mini)}}" alt="..." class="img-circle profile_img">
                        @else
                        <img src="{{asset("logots/logo.jpg")}}" alt="..." class="img-circle profile_img">
                        @endif
                      </a>
                    </li>
                    <li>
                      <a href="{{route("proyecto.show",$pro->id)}}">
                        <i class="fa fa-eye"></i>
                      </a>
                    </li>
                  </ul>
                </div>

                <h5 class="name"><b>{{$pro->nombre}}</b></h5>

                <div class="flex">
                  <ul class="list-inline count2">
                    <li>
                      <h3>123</h3>
                      <span>Articles</span>
                    </li>
                    <li>
                      <h3>1234</h3>
                      <span>Followers</span>
                    </li>
                    <li>
                      <h3>123</h3>
                      <span>Following</span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          @endforeach  
        </div>
    </div>
@endsection

@section('after-script')

@endsection