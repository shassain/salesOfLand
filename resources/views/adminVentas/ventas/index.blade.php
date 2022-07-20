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

    .ol-popup{
      color:red;
    }
 
 .chart {
    position: relative;
    display: inline-block;
    width: 100px;
    height: 100px;
    margin-top: 5px;
    margin-bottom: 5px;
    text-align: center;
}
.widget_tally_box .name_title {
    text-align: center;
    margin: 5px;
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
          <div class="col-md-9" >
            <label>Seleccione Proyecto:</label>
            <select name="proyecto_id" id="proyecto_id" onchange="cambiardecambio(this)">
              <option value="0">Seleccione un Proyecto</option>
              @foreach($proyectos as $proy)
              <option value="{{$proy->id}}">{{$proy->nombre}}</option>
              @endforeach
            </select>
            <div id="map" ></div>
            <div class="row">
              <div class="col-md-2">Opacidad:</div>
              <div class="col-md-3" ><input id="opacity" name="opacity" class="option input-sm" type="range" value="0" min="0" max="1" step="0.1" class="slider" /></div>
            </div>
          </div>
          
          <div class="col-md-3 col-xs-12 col-sm-12">
            
            <div class="row" style="border-bottom: 1px solid #000000;box-shadow: 6px 6px 6px #330000;">
              <div class="col-md-12 col-xs-12 col-sm-12"  >
                Propiedades del terreno.
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel ui-ribbon-container fixed_height_390">
                  <div class="ui-ribbon-wrapper">
                    <div class="ui-ribbon" id="descuento_name">
                         30%
                    </div>
                  </div>
                  <div class="x_title">
                    <h2 id="manzano_name">Manzano</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <center>Terreno
                      <div style="text-align: center; margin-bottom: 17px;height: 80px;width: 80px;-moz-border-radius: 50%;-webkit-border-radius: 50%;border-radius: 50%;border: 1px solid #000;background: #fff;font-size: 50px" id="cajacolor">
                      </div>  
                    </center>
                    <h4 class="name_title" id="precio_name">Precio:</h4>
                    <div class="form-group">
                      <label id="proyecto_name">Proyecto:</label>
                    </div>
                    <div class="divider"></div>
                    <div class="form-group">
                      <label id="superficie_name">Superficie:</label>
                      <br>
                      <label id="estado_name">Estado:</label>
                    </div>
                    <div class="divider"></div>
                  </div>
                </div>    
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6">
                    <a class="btn btn-lg btn-success" id="a_vender" href="#" style="color:#000">
                      <i class="fa fa-barcode"></i> Vender
                    </a>  
                  </div>
                  <div class="col-md-6">
                    <button class="btn btn-lg btn-warning" style="color:#000">
                      <i class="fa fa-calendar"></i> Reservar
                    </button>  
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
<script src="{{asset("assets/js/autonumeric/autoNumeric.js")}}"></script>

    {!! Html::script('inputfile/js/fileinput.js') !!}
    {!! Html::script('inputfile/js/locales/es.js') !!}
    {!! Html::script('assets/js/wizard/jquery.smartWizard.js') !!}
    
    <script type="text/javascript">
    var numero=1;
    var terreno_seleccionando=null;
    var vector = new ol.layer.Vector( { 
      source: new ol.source.Vector()
    });
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
        
      


    map.addInteraction(new ol.interaction.Snap({ 
      source: vector.getSource() 
    }));


    
    
    $(window).on("load", function(){ 
      var ffff=null; 
      $.ajax({
        url:"{{url("coordenadaspost")}}",
        type:"post",
        data:{_token:'{{csrf_token()}}'},
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


  // Dsiplay the style on select
  var legend = new ol.control.Legend({ 
    title: 'Legend',
    collapsed: false
  });
  var select = new ol.interaction.Select({ hitTolerance: 3 });
  map.addInteraction(select);

  select.on('select', function(e){
    var f = e.selected[0];
    var id_f=f.id_;
    $.ajax({
      url:"{{route("terrenos.show")}}",
      type:"get",
      data:{id:id_f,_token:'{{csrf_token()}}'},
      success:function(data){
        if(data.resp==200){
          var tdes=Number(data.dato.descuento_general)+Number(data.dato.descuento_promocion);
          var pd=((tdes/Number(data.dato.valor_terreno))*100).toFixed(0);
          $("#descuento_name").html(pd+" %");
          $("#manzano_name").html(data.dato.manzano);
          $("#proyecto_name").html("Proyecto: "+data.dato.proyecto.nombre);
          $("#superficie_name").html("Superficie: "+data.dato.superficie);
          $("#precio_name").html("Precio: "+data.dato.precio_venta+" $");
          $("#cajacolor").html(data.dato.nro_lote);
          $("#estado_name").html("Estado: "+data.dato.estado);
          $("#cajacolor").css("background",data.dato.categoria.color);
          var url="{{url('admterrenos/')}}";
          $("#a_vender").attr("href",url+"/"+id_f+"/ventas");
          
          toastr.success(data.msn);

        }else{
          toastr.error(data.msn);
        }
      }
    });
  });

  // Add selection to legend
  function addToLegend() {
    var f = select.getFeatures().item(0);
    if (f) {
      legend.addRow({
        title: $(".options .row input").val(),
        feature: f
      });
    }
  }




  var positions = {
    start: { xy: [posx,posy], z: 9 },
    @foreach($proyectos as $pro)
    {{$pro->id}}: { xy: [{{$pro->posx}},{{$pro->posy}}], z:16 },
    @endforeach
  }
  function cambiardecambio(este){
    var idu=$(este).val();
      // Fly to destination
      var duration = 3000;
      map.getView().animate ({
        center: positions[idu].xy,
        duration: duration
      });
      map.getView().animate ({
        zoom: Math.min(map.getView().getZoom(), positions[idu].z)-1,
        duration: duration/2
      },{
        zoom: positions[idu].z,
        duration: duration/2
      });
  }
  

  $(window).on("load", function(){ legend.refresh();vector.changed(); });









    
    
  </script>

@endsection