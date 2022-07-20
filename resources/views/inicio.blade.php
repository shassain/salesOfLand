@extends('layouts.home')

@section('title', 'LOGIN')

@section('after-style')
<link rel="stylesheet" href="{{asset('componente/css/ol-ext.css')}}">
<link rel="stylesheet" href="{{asset('componente/css/ol.css')}}">
<style>
    .ol-zoom {
      left: auto;
      right: .5em;
    }
    .ol-scroll-top,
    .ol-scroll-next {
      height: 2.5em;
      text-align: center;
      cursor: pointer;
    }
    .ol-scroll-top {
      padding-top: 1.3em;
    }

    #story {
      height: 400px;
    }
    #story img {
      display: block;
      margin: auto;
      max-width: 100%;
    }
    #story .chapter {
      opacity: .4;
      transition: .3s;
      background-color: transparent;
      padding: .5em;
    }
    #story .chapter.select {
      opacity: 1;
      background-color: rgba(255,255,255,.8);
    }
    .options a {
      cursor: pointer;
    }
  </style>
  <style>
  .myappbtn{
     background: #ffff00;
     color: #330000;
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

@section('content')
<div class="x_panel" style="padding:0;margin:0;background:radial-gradient(black 15%, transparent 16%) 0 0,radial-gradient(black 15%, transparent 16%) 8px 8px,radial-gradient(rgba(255,255,255,.1) 15%, transparent 20%) 0 1px,radial-gradient(rgba(255,255,255,.1) 15%, transparent 20%) 8px 9px;background-color:#330000;background-size:16px 16px;font-family: 'Lato', sans-serif !important;">
        <div class="x_title" style="color: #ffff00">
            <div class="row">
                <div class="col-md-8">
                  <h1 style="margin-left: 50px">Proyectos MegaTerra</h1>  
                </div>      
                <div class="col-md-2">
                    <a href="http://megaterrabo.com" target="_black" class="btn myappbtn" >
                        <i class="fa fa-reply-all"></i> Volver a pagina principal
                    </a>
                </div>      
                <div class="col-md-2">
                    <a href="{{url("/")}}" class="btn myappbtn" >
                        <i class="fa fa-sign-in"></i> Iniciar Sesion
                    </a>
                </div>      
            </div>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <div class="col-md-8 col-sm-8 col-xs-12">
              
            <div id="map"></div>
          </div>

          <div class="col-md-4 col-sm-4 col-xs-12" style="border:0px solid #e5e5e5;">
            <div id="story">
              <div class="chapter" name="start">
                <h2>Proyectos Megaterra</h2>
                <p>
                  Para 
                  <br/>
                  <span style="font-size: .8em;">
                    text & images &copy; Wikipedia
                  </span>
                </p>
                <div class="ol-scroll-next">Start</div>
              </div>
              @foreach($proyectos as $pro)
              @php
                $imgs=$pro->imagenes->where("promocional",true)->first();
              @endphp
              <div class="chapter" name="{{$pro->id}}">

                <h2>{{$pro->nombre}}</h2>
                @if($imgs!=null)
                  <img src="{{asset($imgs->mini)}}" alt="..." style="width: 250px;height: 200px">
                @else
                  <img src="{{asset("logots/logo.jpg")}}" alt="..." >
                @endif

                <p>
                  {!!$pro->descripcion!!} mmuy larga
                   mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga mmuy larga
                </p>
                <div class="ol-scroll-top">Top</div>
              </div>
              @endforeach
          </div>

        </div>
    </div>

    
@endsection

@section('after-script')
<script src="{{asset('componente/js/ol.js')}}"></script>
<script src="{{asset('componente/js/ol-ext.js')}}"></script>
<script type="text/javascript">
    var numero=1;
    var vector = new ol.layer.Vector( { 
      source: new ol.source.Vector()
    });
    // The map
    var posx=-7033200.28;
    var posy=-2012204.76;
    var map = new ol.Map ({
        target: 'map',
        view: new ol.View ({
          zoom: 8,
          center: [posx, posy]
        }),
        layers: [
          new ol.layer.Tile({ source: new ol.source.OSM()})
        ]
      });
      map.addLayer(vector);
        
      

   


    map.addControl(new ol.control.ZoomSlider());
    var placemark = new ol.Overlay.Placemark();
  map.addOverlay (placemark);

  // The storymap
  var story = new ol.control.Storymap({
    target: document.getElementById('story')
  });

  var positions = {
    start: { xy: [-7326460.49,-2217911.14], z: 9 },
    @foreach($proyectos as $pro)
    {{$pro->id}}: { xy: [{{$pro->posx}},{{$pro->posy}}], z:16 },
    @endforeach
  }
  // ly to the chapter on the map
  story.on('scrollto', function(e){
    $('#story .chapter').removeClass('select');
    $(e.element).addClass('select');
    map.getView().cancelAnimations();
    if (e.name==='start') {
      placemark.hide();
      map.getView().animate ({
        center: positions[e.name].xy,
        zoom: positions[e.name].z
      })
    } else {
        console.log(e.name);
      placemark.show(positions[e.name].xy);
      // Fly to destination
      var duration = 2000;
      map.getView().animate ({
        center: positions[e.name].xy,
        duration: duration
      });
      map.getView().animate ({
        zoom: Math.min(map.getView().getZoom(), positions[e.name].z)-1,
        duration: duration/2
      },{
        zoom: positions[e.name].z,
        duration: duration/2
      });
    }
  });
  map.addControl (story);
    
  
  $(document).ready(function(){
      var ffff=null; 
      $.ajax({
        url:"{{url("coordenadas")}}",
        type:"get",
        success:function(data){
          console.log(data);
          for(w=0;w < data.length;w++){
            for(i=0;i<data[w].terrenos.length;i++){
              coordenadas=data[w].terrenos[i].coordenadas;
              coord=new Array();
              for(j=0;j<coordenadas.length;j++){
                coord.push([Number(coordenadas[j].posx),Number(coordenadas[j].posy)]);
              }
              nnn=data[w].terrenos[i].categoria.color;
              nunn=data[w].terrenos[i].nro_lote;
              var ffff = new ol.Feature(new ol.geom.Polygon([coord]));
              ffff.setStyle (new ol.style.Style({
                fill: new ol.style.Fill({ color: nnn  }),
                stroke: new ol.style.Stroke({ color: "#000", width: 1}),//, lineDash:[5,8]
                text:new ol.style.Text({text: nunn+"" ,scale:1,rotation:120,font:'bold 18px serif'}),
              }));
              ffff.setId(data[w].terrenos[i].id);
              vector.getSource().addFeature(ffff);

            }
          }
        }
      }); 
    });
    
  </script>
@endsection