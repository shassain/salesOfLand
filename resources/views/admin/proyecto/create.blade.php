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
                @component("component.xpanel",["title"=>"Registrar Proyecto"])
                  {!!Form::open(["route"=>"proyecto.store","method"=>"post","role"=>"form"])!!}
                    <div id="wizard" class="form_wizard wizard_horizontal">
                    <ul class="wizard_steps">
                      <li>
                        <a href="#step-1">
                          <span class="step_no">D</span>
                          <span class="step_descr">
                                            Paso 1<br />
                                            <small>Datos</small>
                                        </span>
                        </a>
                      </li>
                      <li>
                        <a href="#step-2">
                          <span class="step_no">M</span>
                          <span class="step_descr">
                                            Paso 2<br />
                                            <small>Mapa</small>
                                        </span>
                        </a>
                      </li>
                      <li>
                        <a href="#step-3">
                          <span class="step_no">A</span>
                          <span class="step_descr">
                                            Paso 3<br />
                                            <small>Archivos</small>
                                        </span>
                        </a>
                      </li>
                    </ul>
                    <div id="step-1">
                      <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3"><label>NOMBRE:</label></div>
                                    <div class="col-md-9"><input name="nombre" type="text" class="form-control input-sm"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><label>LUGAR:</label></div>
                                    <div class="col-md-9"><input name="lugar" type="text" class="form-control input-sm"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><label>ALCALDIA:</label></div>
                                    <div class="col-md-9"><input name="alcaldia" type="text" class="form-control input-sm"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12"><label>DESCRIPCION:</label></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea name="descripcion" id="configtextarea" cols="30" rows="6" ></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12"><label>CARACTERISTICAS:</label></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                      <textarea name="lista" id="configtextarea2" cols="30" rows="11" ></textarea>
                                        @include("component.textarea")
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div id="step-2">
                      <h2 class="StepTitle">Marque la ubicacion del proyecto</h2>
                      <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8">
                          <div id="map" style="background: #fcfcfc;width:99%; height:99%;border:1px #fcfcfc solid">
                          </div>  
                        </div>
                        <div class="col-md-2">
                          <button type="button" class="btn btn-success" onclick="centrarelcentro()">
                            <i class="fa fa-map-marker"></i> Centrar
                          </button>
                        </div>
                      </div>
                        
                    </div>
                    <div id="step-3">
                      <h2 class="StepTitle">Subir Imagenes del proyecto</h2>
                      <input id="imagen" name="imagen[]" type="file" multiple class="file-loading" onchange="">
                          
                    </div>
                    

                  </div>
                  <input type="hidden" id="posx" name="posx" value="-7033200.28">
                  <input type="hidden" id="posy" name="posy" value="-2012204.76">
                  {!!Form::close()!!}
                @endcomponent
            </div>
            <div class="col-md-12">
              
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
    
    // The map
    var map = new ol.Map ({
        target: 'map',
        view: new ol.View ({
          zoom: 14,
          center: [-7033200.28, -2012204.76]
        }),
        layers: [
          new ol.layer.Tile({ source: new ol.source.OSM() })
        ]
      });
    central=new ol.Overlay.Placemark ({
      position: [-7033200.28, -2012204.76],
      popupClass:"popupcentral",

      stopEvent: false
    });
    central.id="puntocentral"
    map.addOverlay(central);

    var drag = new ol.interaction.DragOverlay({
      overlays: central
    });
  map.addInteraction(drag);
  drag.on('dragend', function(e){
    if (e.overlay===central) {
      central.show(true);
      $("#posx").val(central.values_.position[0]);
      $("#posy").val(central.values_.position[1]);
    }
  });
  function centrarelcentro(){
    central.show(map.getView().getCenter());
    $("#posx").val(central.values_.position[0]);
    $("#posy").val(central.values_.position[1]);
  }
  </script>

  <script>
    var $input = $("#imagen");
    $input.fileinput({
        uploadUrl: "{{url('subirimagenproyecto')}}",
        uploadAsync: false,
        minFileCount: 1,
        maxFileCount: 25,
        allowedFileExtensions:['jpg','jpeg','png','bmc'],
        @if(count($res1)>0)
        initialPreview:[
            @foreach($res1 as $r)
            "{{Request::root().$r}}",
            @endforeach
        ],
        initialPreviewConfig: [
            @foreach($res2 as $r)
            {caption: "{{$r['caption']}}", size: "{{$r['size']}}", width: "{{$r['width']}}", url: "{{$r['url']}}", key: "{{$r['key']}}",extra:{_token:"{{csrf_token()}}"}, },
            @endforeach
        ],
        @endif
        overwriteInitial: false,
        initialPreviewAsData:true,
        uploadExtraData:function() {
                            return {
                                _token: '{{csrf_token()}}',
                                tipo:'proyecto'
                            };
                        }
    }).on("filebatchselected", function(event, files) {
        $input.fileinput("upload");
    }).on('fileuploaded', function(event, data, previewId, index) {
        console.log(data.response.initialPreviewConfig.url);

    });

</script>
<script type="text/javascript">
    $(document).ready(function() {
     var a= $('#wizard').smartWizard({
        transitionEffect: 'fade',
        labelFinish:"Guardar Cambios"
        
      });
     
    });
    
    

  </script>
@endsection