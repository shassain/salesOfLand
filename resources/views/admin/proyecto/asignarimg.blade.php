@extends('layouts.principal')

@section('title', $title)

@section('before-style')
  
@endsection

@section('after-style')
<link rel="stylesheet" href="{{asset('componente/css/ol-ext.css')}}">
<link rel="stylesheet" href="{{asset('componente/css/ol.css')}}">

{!! Html::style('inputfile/css/fileinput.min.css') !!}
    

  <style>
      textarea{
        max-width:250;
        min-width:250;
        max-height:750; 
        min-height:750;
      }
  </style>
  <style>
    .ol-button i {
      color: inherit;
    }
    .ol-button.red button,
    .ol-button.green button,
    .ol-button.blue button {
      color: #f00;
      background-color: currentColor;
      border: 2px solid currentColor;
      width: 1em;
      height: 1em;
      border-radius: 0;
    }
    .ol-button.green button {
      color: #0f0;
    }
    .ol-button.blue button {
      color: #00f;
    }
    .ol-button.red button:hover,
    .ol-button.green button:hover,
    .ol-button.blue button:hover {
      background-color: currentColor!important;
      border-color: #000;
    }
    .placemark .content * {
      color: inherit!important;
    }
    .popupcentral {
      width: 20px;
      height: 20px;
      border: 1px solid #08F;
      border-radius: 10px;
      background-color: rgba(0,128,255,.5);
      cursor: move;
      position: relative;
      font-family: Arial, Helvetica, sans-serif;
      text-align: center;
    }
    div.linea {
        overflow-x: scroll;
        display:-ms-flexbox!important;
        display:flex!important;
    }
     
    div.linea > .itemlinea {
        display: inline-block;
        color: #fff;
    }
    .imgLinea{
      width: 150px;
      height: 150px;
      border: 2px #330000 solid;
    }
    .imgLinea:hover{
      width: 155px;
      height: 155px;
      border: 2px #ffd700 solid;
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
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label><h3>Seleccione la imagen promocional:</h3></label>
              <div class="linea">
                 @foreach($imagenes as $img)
                      <div class="image view view-first itemlinea" onclick="cambiarMapa(this)" data-id="{{$img->id}}">
                        <img src="{{asset($img->url)}}" alt="image" class="imgLinea">
                      </div>
                  @endforeach
              </div>
            </div>
            <br>
            <br>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-8">
                  <img src="" id="imgnext" title="seleccione una imagen" style="width: 700px;height: 450px">
                </div>
                <div class="col-md-4">
                  {!!Form::open(["route"=>["proyecto.saveimgpromo",$proyecto->id],"method"=>"post"])!!}
                    <input type="hidden" name="id_img" value="0" id="id_img_pro">
                    <button type="submit" class="btn btn-lg btn-success"><i class="fa fa-save"></i> Guardar imagen promocional</button>
                    <a href="{{URL::previous()}}" class="btn btn-lg btn-danger"> <i class="fa fa-close"></i> Cancelar la operacion</a>
                  {!!Form::close()!!}
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection

@section('after-script')

    {!! Html::script('inputfile/js/fileinput.js') !!}
    {!! Html::script('inputfile/js/locales/es.js') !!}
    {!! Html::script('assets/js/wizard/jquery.smartWizard.js') !!}


<script>
  function cambiarMapa(este){
    var id=$(este).data("id");
    var src=$(este).children("img")[0].src;
    $("#id_img_pro").val(id);
    $("#imgnext").attr("src",src);
    

  }
    
</script>
    
@endsection