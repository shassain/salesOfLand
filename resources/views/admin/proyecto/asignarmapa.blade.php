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
              <label><h3>Seleccione una Imagen:</h3></label>
              <div class="linea">
                 @foreach($imagenes as $img)
                      <div class="image view view-first itemlinea" onclick="cambiarMapa(this)" data-id="{{$img->id}}">
                        <img src="{{asset($img->url)}}" alt="image" class="imgLinea">
                      </div>
                  @endforeach
              </div>
              <div class="row table-response">
                @foreach($imagenes as $img)
                  <div class="col-md-55">
                      
                  </div>
                @endforeach
              </div>
            </div>
            <br>
            <br>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-8">
                  <div id="map" ></div>
                </div>
                    @php 
                        $existe=$imagenes->where("enmapa",true)->first();
                    @endphp
                <div class="col-md-4">
                  {!!Form::open(["route"=>"savemapeste","method"=>"post","role"=>"form"])!!}
                  @include("admin.proyecto.form.create")
                  {!!Form::close()!!}
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
    $(document).ready(function(){
      $("body").attr('class', 'nav-sm');
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
    central=new ol.Overlay.Placemark ({
      position: [{{$proyecto->posx}}, {{$proyecto->posy}}],
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
        $("#x").val(central.values_.position[0]);
        $("#y").val(central.values_.position[1]);
        resetSource();
      }
    });

    $(".option").on("change", resetSource);

    function resetSource ()
    { 
      if($("#id_img").val()!=0){
        var x = Number($("#x").val());
        var y = Number($("#y").val());
        var sx = Number($("#w").val());
        var sy = Number($("#h").val());
        var xmin = Number($("#xmin").val());
        var ymin = Number($("#ymin").val());
        var xmax = Number($("#xmax").val());
        var ymax = Number($("#ymax").val());
        var opacity = Number($("#opacity").val());
        if (opacity>1) opacity=1;
        else if (opacity<0) opacity=0;
        $("#opacity").val(opacity);
        geoimg.setOpacity(opacity);
        geoimg.getSource().setCenter([x,y]);
        geoimg.getSource().setRotation($("#rotate").val()*Math.PI/180);
        geoimg.getSource().setScale([sx,sy]);
        geoimg.getSource().setCrop([xmin,ymin,xmax,ymax]);
        var crop = geoimg.getSource().getCrop();
        $("#xmin").val(crop[0]);
        $("#ymin").val(crop[1]);
        $("#xmax").val(crop[2]);
        $("#ymax").val(crop[3]);
      }
    }

  </script>
  <script>
    var _token="{{csrf_token()}}";
    var geoimg=null;
    @if($existe!=null)
    $(document).ready(function(){
      idmap='{{$existe->id}}';
      bool=confirm("Existe un mapa asignado. Desea Cargarlo?");
      if(bool==true){
        $("#subirform").attr("disabled",false);
        $.ajax({
          url:"{{url("seleccionimagen")}}",
          type:"post",
          data:{id:idmap,_token:_token},
          success:function(data){
            if(geoimg!=null){
              map.removeLayer(geoimg);
            }
            $("#id_img").val(data.id);
            var x = Number(data.posx);
            $("#x").val(Number(data.posx));
            var y = Number(data.posy);
            $("#y").val(Number(data.posy));
            var sx = Number(data.w);
            $("#w").val(data.w);
            var sy = Number(data.h);
            $("#h").val(data.h);
            var xmin = Number(data.xminimo);
            $("#xmin").val(data.xminimo);
            var ymin = Number(data.yminimo);
            $("#ymin").val(data.yminimo);
            var xmax = Number(data.xmaximo);
            $("#xmax").val(data.xmaximo);
            var ymax = Number(data.ymaximo);
            $("#ymax").val(data.ymaximo);
            var opacity = Number(data.opacity);
            $("#opacity").val(data.opacity);
            $("#rotate").val(data.rotate);
            geoimg = new ol.layer.Image(
            { name: "Georef",
              opacity: opacity,
              source: new ol.source.GeoImage(
              { url: global_asset+data.url,
                imageCenter: [x,y],
                imageScale: [sx,sy],
                imageCrop: [xmin,ymin,xmax,ymax],
                imageRotate: Number($("#rotate").val()*Math.PI/180),
                projection: 'EPSG:3857'
              })
            });
            map.addLayer(geoimg);
          }
        });
      }

    });
    @endif
    function cambiarMapa(este){
      var boolean=confirm("Desea cargar este mapa?");
      var ID=$(este).data("id");
      if(boolean==true){
        $("#subirform").attr("disabled",false);
        $.ajax({
          url:`{{url("seleccionimagen")}}`,
          type:"post",
          data:{id:ID,_token:_token},
          success:function(data){
            if(geoimg!=null){
              map.removeLayer(geoimg);
            }
            $("#id_img").val(data.id);
            var x = Number(data.posx);
            $("#x").val(Number(data.posx));
            var y = Number(data.posy);
            $("#y").val(Number(data.posy));
            var sx = Number(data.w);
            $("#w").val(data.w);
            var sy = Number(data.h);
            $("#h").val(data.h);
            var xmin = Number(data.xminimo);
            $("#xmin").val(data.xminimo);
            var ymin = Number(data.yminimo);
            $("#ymin").val(data.yminimo);
            var xmax = Number(data.xmaximo);
            $("#xmax").val(data.xmaximo);
            var ymax = Number(data.ymaximo);
            $("#ymax").val(data.ymaximo);
            var opacity = Number(data.opacity);
            $("#opacity").val(data.opacity);
            $("#rotate").val(data.rotate);
            geoimg = new ol.layer.Image(
            { name: "Georef",
              opacity: opacity,
              source: new ol.source.GeoImage(
              { url: global_asset+data.url,
                imageCenter: [x,y],
                imageScale: [sx,sy],
                imageCrop: [xmin,ymin,xmax,ymax],
                imageRotate: Number($("#rotate").val()*Math.PI/180),
                projection: 'EPSG:3857'
              })
            });
            map.addLayer(geoimg);
          }
        });
      }
    }
  </script>

<script>
        var kcRotateDial=function(elem){
            var output=this;
            //Preventing elem to being selected on IE
            if(document.all && !window.opera) elem.setAttribute("unselectable","on");
            //Public Properties
            output.rad=0;
            output.deg=0;
            output.per=0;
            output.fullRad=0;
            output.fullDeg=0;
            output.fullPer=0;
            output.spin=0;
            output.clock=false;
            //Private properties
            var drag=false;
            var pos=[];
            var size=[];
            var axis=[];
            var cursor=[];
            var rad=0;
            var lastRad=0;
            var lastPer=0;
            var lastFullRad=0;
            var maxRad=6.283185307179586;
            var maxDeg=360;
            var maxPer=100;
            var Dx=[];
            var Dy=[];
            //Public Methods
            output.onchange=function(){};
            //Private Methods
            function preventDefault(e){
                //prevent event's default action
                if(window.event) e=window.event;
                if(e.preventDefault){e.preventDefault()}else{e.returnValue=false};
            }
            function getPos(elem){
                //get the position [left,top] relative to whole document
                var tmp=elem;
                var left=tmp.offsetLeft;
                var top=tmp.offsetTop;
                while (tmp=tmp.offsetParent) left += tmp.offsetLeft;
                tmp=elem;
                while(tmp=tmp.offsetParent) top+=tmp.offsetTop;
                return [left,top];
            }
            function getSize(elem){
                //return the size [width,height] of the element
                return [elem.offsetWidth,elem.offsetHeight];
            }
            function getAxis(elem){
                //return the center point [left,top] of the element
                return [getPos(elem)[0]+getSize(elem)[0]/2,getPos(elem)[1]+getSize(elem)[1]/2];
            }
            function getCursorPos(e){
                //return the cursor's position [x,y]
                var cursorPos;
                if(window.event) e=window.event;
                if(e.clientX) cursorPos=[e.clientX,e.clientY];
                if(e.pageX) cursorPos=[e.pageX,e.pageY];
                try{if(e.targetTouches[0]) cursorPos=[e.targetTouches[0].pageX,e.targetTouches[0].pageY];}catch(err){};
                return cursorPos;
            }
            function getAngle(e){
                //getting rotation angle by Arc Tangent 2
                var rad;
                pos=getPos(elem);
                size=getSize(elem);
                axis=getAxis(elem);
                cursor=getCursorPos(e);
                rad=Math.atan2(cursor[1]-axis[1],cursor[0]-axis[0]);
                //correct the 90° of difference starting from the Y axis of the element
                rad+=maxRad/4;
                //transform opposite angle negative value, to possitive
                if(rad<0) rad+=maxRad;
                return rad;
            }
            function setDrag(e,bool){
                //set or unset the drag flag
                if(bool){
                    preventDefault(e);
                    rad=getAngle(e);
                    drag=true;
                }else{
                    drag=false;
                }
            }
            function rotate(e){
                //Rotate the element
                if(drag){
                    //setting control variables
                    var cursorRad;
                    var relativeRad;
                    var rotationRad;
                    cursorRad=getAngle(e);
                    relativeRad=cursorRad-rad;
                    var rotationRad=lastRad+relativeRad;
                    if(rotationRad<0) rotationRad=maxRad;
                    if(rotationRad>maxRad) rotationRad=0;
                    rad=cursorRad;
 
                    //applying rotation to element
                    elem.style.MozTransform="rotate("+rotationRad+"rad)";
                    elem.style.WebkitTransform="rotate("+rotationRad+"rad)";
                    elem.style.OTransform="rotate("+rotationRad+"rad)";
                    elem.style.MsTransform="rotate("+rotationRad+"rad)";
                    //rotation Matrix for IExplorer
                    if(document.all && !window.opera){
                        var iecos = Math.cos(cursorRad);
                        var iesin = Math.sin(cursorRad);
                        Dx[0]=-(size[0]/2)*iecos + (size[1]/2)*iesin + (size[0]/2);
                        Dx[1]=-(size[0]/2)*iesin - (size[1]/2)*iecos + (size[1]/2);
                        elem.style.filter="progid:DXImageTransform.Microsoft.Matrix(M11="+iecos+", M12="+-iesin+", M21="+iesin+", M22="+iecos+", Dx="+Dx[0]+", Dy="+Dx[1]+", SizingMethod=auto expand)";
                    }
                    //assigning values to public properties
                    output.rad=rotationRad;
                    output.deg=maxDeg*output.rad/(2*Math.PI);
                    $("#rotate").val(output.deg.toFixed(2));


                    var x = Number($("#x").val());
                    var y = Number($("#y").val());
                    var sx = Number($("#w").val());
                    var sy = Number($("#h").val());
                    var xmin = Number($("#xmin").val());
                    var ymin = Number($("#ymin").val());
                    var xmax = Number($("#xmax").val());
                    var ymax = Number($("#ymax").val());
                    var opacity = Number($("#opacity").val());
                    if (opacity>1) opacity=1;
                    else if (opacity<0) opacity=0;
                    $("#opacity").val(opacity);
                    geoimg.setOpacity(opacity);
                    geoimg.getSource().setCenter([x,y]);
                    geoimg.getSource().setRotation($("#rotate").val()*Math.PI/180);
                    geoimg.getSource().setScale([sx,sy]);
                    geoimg.getSource().setCrop([xmin,ymin,xmax,ymax]);
                    var crop = geoimg.getSource().getCrop();
                    $("#xmin").val(crop[0]);
                    $("#ymin").val(crop[1]);
                    $("#xmax").val(crop[2]);
                    $("#ymax").val(crop[3]);







                    output.per=(output.rad*maxPer)/maxRad;
 
                    if((lastPer<=100 && lastPer>=60) && (output.per>=0 && output.per<=30)) output.spin++;
                    if((lastPer<=30 && lastPer>=0) && (output.per>=60 && output.per<=100)) output.spin--;
 
                    output.fullRad=output.rad+(maxRad*output.spin);
                    output.fullDeg=output.deg+(maxDeg*output.spin);
                    output.fullPer=output.per+(maxPer*output.spin);
 
                    if(lastFullRad<output.fullRad) output.clock=true;
                    if(lastFullRad>output.fullRad) output.clock=false;
 
                    lastRad=rotationRad;
                    lastPer=output.per;
                    lastFullRad=output.fullRad;
                    output.onchange();
                }
            }
            //Listen events
            elem.onmousedown=function(e){setDrag(e,true);}
            document.onmouseup=function(e){setDrag(e,false);}
            document.onmousemove=function(e){rotate(e);}
            try{elem.addEventListener('touchstart',function(e){setDrag(e,true);})}catch(err){}
            try{document.addEventListener('touchend',function(e){setDrag(e,false);})}catch(err){}
            try{document.addEventListener('touchmove',function(e){rotate(e)})}catch(err){}
        }
 
        window.onload=function()
        {
            var elem=document.getElementById("spin-ball");
            var dial=kcRotateDial(elem);
        }
    </script>
@endsection