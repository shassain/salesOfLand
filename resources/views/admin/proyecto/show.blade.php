@extends('layouts.principal')

@section('title', $title)

@section('before-style')
  
@endsection

@section('after-style')
<link rel="stylesheet" href="{{asset('componente/css/ol-ext.css')}}">
<link rel="stylesheet" href="{{asset('componente/css/ol.css')}}">

{!! Html::style('inputfile/css/fileinput.min.css') !!}
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
      <div class="row" style="border-bottom: 1px solid #000000;box-shadow: 6px 6px 6px #330000;position: float;">
        <div class="col-md-7">
          <h1>{{$proyecto->nombre}}</h1>
        </div>
        <div class="col-md-1">
          <a href="{{route("terrenos.index",$proyecto->id)}}" class="btn myappbtn" >
            <span class="badge bg-green">3</span>
            <i class="fa fa-puzzle-piece"></i> Crear Terrenos
          </a>
        </div>
        <div class="col-md-1">
          <a href="{{route("proyecto.create")}}" class="btn myappbtn" >
            <span class="badge bg-green">3</span>
            <i class="fa fa-puzzle-piece"></i> Tipos de pago
          </a>
        </div>
        <div class="col-md-1">
          <a href="{{route("proyecto.asing_map",$proyecto->id)}}" class="btn myappbtn" >
            <span class="badge bg-green">3</span>
            <i class="fa fa-puzzle-piece"></i> Asignar Plano
          </a>
        </div>
        <div class="col-md-1">
          <a href="{{route("proyecto.asing_img",$proyecto->id)}}" class="btn myappbtn" >
            <span class="badge bg-green">3</span>
            <i class="fa fa-puzzle-piece"></i> Img Promo
          </a>
        </div>
      </div>
      <br>
        <div class="row">
          <div class="col-md-12">
            <label><h3>Imagenes:</h3></label>
            <div class="linea">
               @foreach($imagenes as $img)
                    <img src="{{asset($img->url)}}" class="itemlinea imgLinea">
                @endforeach
            </div>
          </div>
          <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                  <h2>Proyecto: {{$proyecto->nombre}}</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="row">
                    <div class="col-md-12">
                      <label>Descripcion:</label>
                      {!!$proyecto->descripcion!!}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-8">
                      <label>Ubicacion:</label>
                      <div id="map"></div>
                    </div>
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-12">
                          <label>Propiedades:</label>
                          {!!$proyecto->lista!!}
                        </div>
                      </div>
                    </div>
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


    {!! Html::script('inputfile/js/fileinput.js') !!}
    {!! Html::script('inputfile/js/locales/es.js') !!}
    {!! Html::script('assets/js/wizard/jquery.smartWizard.js') !!}
  <script type="text/javascript">
    
    var vector = new ol.layer.Vector( { 
      source: new ol.source.Vector()
    });
    // The map
    var map = new ol.Map ({
        target: 'map',
        view: new ol.View ({
          zoom: 14,
          center: [{{$proyecto->posx}}, {{$proyecto->posy}}]
        }),
        layers: [
          new ol.layer.Tile({ source: new ol.source.OSM() })
        ]
      });
    map.addLayer(vector);
    
    central=new ol.Overlay.Placemark ({
      position: [{{$proyecto->posx}}, {{$proyecto->posy}}],
      popupClass:"popupcentral",

      stopEvent: false
    });
    central.id="puntocentral"
    map.addOverlay(central);
    $(document).ready(function(){
      var id_p='{{$proyecto->id}}';
      var _token="{{csrf_token()}}";
      var ffff=null; 
      $.ajax({
        url:"{{url("coordenadas")}}/"+id_p,
        type:"get",
        data:{id:id_p,_token:_token},
        success:function(data){
          console.log(data);
          for(i=0;i<data.terrenos.length;i++){
            coordenadas=data.terrenos[i].coordenadas;
            coord=new Array();
            for(j=0;j<coordenadas.length;j++){
              coord.push([Number(coordenadas[j].posx),Number(coordenadas[j].posy)]);
            }
            nnn=data.terrenos[i].categoria.color;
            nunn=data.terrenos[i].nro_lote;
            var ffff = new ol.Feature(new ol.geom.Polygon([coord]));
            ffff.setStyle (new ol.style.Style({
              fill: new ol.style.Fill({ color: nnn  }),
              stroke: new ol.style.Stroke({ color: "#000", width: 1}),//, lineDash:[5,8]
              text:new ol.style.Text({text: nunn+"" ,scale:1,rotation:120,font:'bold 18px serif'}),
            }));
            ffff.setId(data.terrenos[i].id);
            vector.getSource().addFeature(ffff);

          }
        }
      }); 
    });

    
  </script>

    
@endsection