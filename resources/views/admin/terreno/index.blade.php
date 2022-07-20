@extends('layouts.principal')

@section('title', $title)

@section('before-style')
  
@endsection

@section('after-style')
<link rel="stylesheet" href="{{asset('componente/css/ol-ext.css')}}">
<link rel="stylesheet" href="{{asset('componente/css/ol.css')}}">
<link rel="stylesheet" href="{{asset('assets/bootstrapselect/css/bootstrap-select.css')}}">
<link rel="stylesheet" href="{{asset('assets/bootstrapselect/css/bootstrap-select.min.css')}}">
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
          <div class="col-md-9" style="border:dashed 1px #330000;">
            <label>Seleccione Poligono y empieze a trazar un terreno</label>
            <div id="map" ></div>
            <div class="row">
              <div class="col-md-2">Opacidad:</div>
              <div class="col-md-3" ><input id="opacity" name="opacity" class="option input-sm" type="range" value="0" min="0" max="1" step="0.1" class="slider" /></div>
            </div>
          </div>
          {!!Form::open(["route"=>["terrenos.store",$proyecto->id],"id"=>"form_terrenos","method"=>'post',"role"=>"form"])!!}
          <div class="col-md-3">
            
            <div class="row" style="border-bottom: 1px solid #000000;box-shadow: 6px 6px 6px #330000;">
              <div class="col-md-12">
                Propiedades del terreno.
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-4">Manzano:</label>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                      <input type="text" id="manzano" name="manzano" class="form-control">
                      <span class="fa fa-columns form-control-feedback right" aria-hidden="true"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-4">Nro:</label>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                      <input type="text" class="form-control" id="nro_lote" name="nro_lote">
                      <span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-4">Categoria:</label>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                      <select name="categoria_id" id="categoria_id" class="form-control">
                        <option value="">Seleccion una opcion</option>
                        @foreach($categoria as $cate)
                        <option data-preciom2="{{$cate->precio}}" value="{{$cate->id}}" style="background: {{$cate->color}};color:#000" data-content="<span class='{{$cate->icono}}'> {{$cate->nombre}}</span>">{{$cate->nombre}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-4">Superficie:</label>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                      <input type="text" class="form-control" id="superficie" name="superficie">
                      <span class="fa fa-flag form-control-feedback right" aria-hidden="true"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-4">Pre/Mtr<sup>2</sup> :</label>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                      <input type="text" class="form-control" id="precoi_x_mtr2" name="precoi_x_mtr2">
                      <span class="fa fa-retweet form-control-feedback right" aria-hidden="true"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-4">Valor Terr:</label>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                      <input type="text" class="form-control" name="valor_terreno" id="valor_terreno">
                      <span class="fa fa-dollar form-control-feedback right" aria-hidden="true"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-4">Des. Gral:</label>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                      <input type="text" class="form-control" name="descuento_general" id="descuento_general">
                      <span class="fa fa-minus-square form-control-feedback right" aria-hidden="true"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-4">Des. Prom:</label>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                      <input type="text" class="form-control" name="descuento_promocion" id="descuento_promocion">
                      <span class="fa fa-minus-square-o form-control-feedback right" aria-hidden="true"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-4">Precio Vta:</label>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                      <input type="text" class="form-control" name="precio_venta" id="precio_venta">
                      <span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-12 col-sm-12 col-xs-12">
                      <input type="checkbox" id="conservar"> Conservar los datos
                    </label>
                  </div>
              </div>
            </div>
            <label>Puntos Capturados:</label><div class="btn btn-sm" id="limpiar_tabla"><i class="fa fa-transh"></i>Limpiar Puntos</div> 
            <div class="row" style="border-top: 3px solid #ffff00">

                <div style="background: #fff;width: 100%;height: 170px;align-content: center;overflow-y: scroll;">
                  <table style="width: 100%" >
                    <thead>
                    <tr>
                      <th width="20%" style="border: 1px solid #000">Nro</th>
                      <th width="40%" style="border: 1px solid #000">X</th>
                      <th width="40%" style="border: 1px solid #000">Y</th>
                    </tr>
                    </thead>
                    <tbody id="table_points">
                      
                    </tbody>
                  </table>
                </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="button-group">
                  <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>Guardar</button>
                  <button class="btn btn-danger"><i class="fa fa-cancel"></i>Cancelar</button>
                </div>
              </div>
            </div>
            

          </div>
          {!!Form::close()!!}
        </div>
    </div>

    @include("admin.terreno.modaledit")
@endsection

@section('after-script')

<script src="{{asset('componente/js/ol.js')}}"></script>
<script src="{{asset('componente/js/ol-ext.js')}}"></script>
<script src="{{asset("assets/js/autonumeric/autoNumeric.js")}}"></script>

<script src="{{asset('assets/bootstrapselect/js/bootstrap-select.js')}}"></script>
<script src="{{asset('assets/bootstrapselect/js/bootstrap-select.min.js')}}"></script>

    
    <script type="text/javascript">
    var numero=1;
    var terreno_seleccionando=null;
    var vector = new ol.layer.Vector( { 
      source: new ol.source.Vector()
    });
    // The map
    var map = new ol.Map ({
        target: 'map',
        view: new ol.View ({
          zoom: 17,
          center: [Number({{$imagen->posx}}), Number({{$imagen->posy}})]
        }),
        layers: [
          new ol.layer.Tile({ source: new ol.source.OSM(),baseLayer: true })
        ]
      });
      map.addLayer(vector);
        
      

    var note = new ol.control.Notification();
    map.addControl(note)

  
    // Add the editbar
    var edit = new ol.control.EditBar({ source: vector.getSource() });
    map.addControl(edit);

    // Add a tooltip
    var tooltip = new ol.Overlay.Tooltip();
    map.addOverlay(tooltip);

    edit.getInteraction('Select').on('select', function(e){
      var elemento0=this.getFeatures().getArray()[0];
      terreno_seleccionando=elemento0;

          console.log(terreno_seleccionando);
      abrirmodal(elemento0);
      if (this.getFeatures().getLength()) {
        tooltip.setInfo('Drag points on features to edit...');
      }
      else tooltip.setInfo();
    });
    edit.getInteraction('Select').on('change:active', function(e){
      tooltip.setInfo('');
      console.log("2");
    });
    edit.getInteraction('DrawPolygon').on('drawstart', function(e){
      tooltip.setFeature(e.feature);
      console.log("8:");
      console.log(e.feature);
      tooltip.setInfo('Haga click para continuar dibujando el terreno ...');
    });

    edit.getInteraction('DrawPolygon').on(['change:active','drawend'], function(e){
      tooltip.setFeature();
      
      if(e.feature==undefined){
        console.log("aun no");
      }else{
        datosarray=e.feature.values_.geometry.flatCoordinates;
        for(var i=0;i<datosarray.length;i=i+2){
          $html='<tr><td width="20%" style="border: 1px solid #000"><a class="btn" onmouseout="quitarbton()" onmouseover=\'crearboton';
          $html+='("'+datosarray[i]+'","'+datosarray[i+1]+'")';
          $html+='\'>'+numero+'</a></td><td width="40%" style="border: 1px solid #000"><input value="'+datosarray[i]+'" readonly name="x[]" type="hidden">'+datosarray[i]+'</td><td width="40%" style="border: 1px solid #000"><input value="'+datosarray[i+1]+'" readonly name="y[]" type="hidden">'+datosarray[i+1]+'</td></tr>';
          $("#table_points").append($html);

          numero++;
        }
        objeto=e.feature;
      }
    });


    edit.on('info', function(e){
      console.log(e.features);
      note.show('<i class="fa fa-info-circle"></i> '+e.features.getLength()+' feature(s) selected');
    });
    map.addInteraction(new ol.interaction.Snap({ 
      source: vector.getSource() 
    }));


    map.addControl(new ol.control.ZoomSlider());
    $(".ol-offset").css("display", "none");
    $(".ol-split").css("display", "none");
    $(".ol-drawline").css("display", "none");
    $(".ol-drawpoint").css("display", "none");
    $(".ol-drawhole").css("display", "none");
    $(".ol-drawregular").css("display", "none");
    $(".ol-transform").css("display", "none");
    $(".ol-popup").css("color", "#ffff00");
    var f0=null;
    function crearboton(x,y){
      f0 = new ol.Feature(new ol.geom.Point([x, y]));
      vector.getSource().addFeature(f0);
    }
    function quitarbton(){
      vector.getSource().removeFeature(f0);
      f0=null;
    }
    function abrirmodal(e){
      $("#id_editm").val(e.id_);
      $.ajax({
        url:"{{route("terrenos.show")}}",
        type:"get",
        data:{id:e.id_,_token:'{{csrf_token()}}'},
        success:function(data){
          if(data.resp==200){
            $("#manzano_edit").val(data.dato.manzano);
            $("#nro_lote_edit").val(data.dato.nro_lote);
            $("#categoria_id_edit").val(data.dato.categoria_id);
            $("#superficie_edit").val(data.dato.superficie);
            $("#precio_edit").val(data.dato.precio);
            toastr.success(data.msn);
          }else{
            toastr.error(data.msn);
          }
        }
      }); 
      $("#editarterreno").modal("show");
    }
    function subiredicion(){
      $.ajax({
        url:"{{route("terrenos.update")}}",
        type:"put",
        data:{edit_id:$("#id_editm").val(),manzano:$("#manzano_edit").val(),nro_lote:$("#nro_lote_edit").val(),categoria_id:$("#categoria_id_edit").val(),superficie:$("#superficie_edit").val(),precio:$("#precio_edit").val(),_token:'{{csrf_token()}}'},
        success:function(data){
          if(data.resp==200){
            toastr.success(data.msn);
            setTimeout(function(){
              location.reload();
            }, 2000);
          }
          console.log(data);
        }
      }); 
    }
    $(window).on("load", function(){ 
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
            if(data.terrenos[i].categoria.tabla=="referencias"){
              nunn=data.terrenos[i].manzano;
            }else{
              nunn=data.terrenos[i].nro_lote;  
            }
            
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
  <script>
      var geoimg=null;
      var x=null;
      var y=null;
      var sx=null;
      var sy=null;
      var xmin=null;
      var ymin=null;
      var xmax=null;
      var ymax=null;
      var opacity=null;
      var rotate=null;
    $(document).ready(function(){
      //$("#nro_lote").autoNumeric("init", {pSign:'s',mDec: '0',aSep:'',vMin: '0', vMax: '99999999'});
      $("#categoria_id").selectpicker();
      $("#categoria_id_edit").selectpicker();
      
      $("#categoria_id").change(function(){
        $(".btn-default").css("background",$("#categoria_id option:selected").css("background"));
        $("#precoi_x_mtr2").autoNumeric("set",$("#categoria_id option:selected").data("preciom2"));
      });
      $("#categoria_id_edit").change(function(){
        $(".btn-default").css("background",$("#categoria_id_edit option:selected").css("background"));
      });
      $("#superficie").on("keyup",function(){
        calcularprecioterreno();
      });
      $("#descuento_general").on("keyup",function(){
        calcularprecioterreno();
      });
      $("#descuento_promocion").on("keyup",function(){
        calcularprecioterreno();
      });
      //btn dropdown-toggle btn-default
      $("#superficie").autoNumeric("init", {pSign:'s',mDec: '2',aSep:'',vMin: '0', vMax: '99999999'});
      $("#precio_venta").autoNumeric("init", {pSign:'s',mDec: '2',aSep:'',vMin: '0', vMax: '99999999'});
      $("#precoi_x_mtr2").autoNumeric("init", {pSign:'s',mDec: '2',aSep:'',vMin: '0', vMax: '99999999'});
      $("#valor_terreno").autoNumeric("init", {pSign:'s',mDec: '2',aSep:'',vMin: '0', vMax: '99999999'});
      $("#descuento_general").autoNumeric("init", {pSign:'s',mDec: '2',aSep:'',vMin: '0', vMax: '99999999'});
      $("#descuento_promocion").autoNumeric("init", {pSign:'s',mDec: '2',aSep:'',vMin: '0', vMax: '99999999'});
      
      idmap='{{$imagen->id}}';
      var _token="{{csrf_token()}}";
      $.ajax({
        url:"{{url("seleccionimagen")}}",
        type:"post",
        data:{id:idmap,_token:_token},
        success:function(data){
          x = Number(data.posx);
          y = Number(data.posy);
          sx = Number(data.w);
          sy = Number(data.h);
          xmin = Number(data.xminimo);
          ymin = Number(data.yminimo);
          xmax = Number(data.xmaximo);
          ymax = Number(data.ymaximo);
          $("#opacity").val(0.3)
          opacity = Number(0.3);
          rotate=Number(data.rotate);
          geoimg = new ol.layer.Image(
          { name: "Georef",
            opacity: opacity,
            source: new ol.source.GeoImage(
            { url: global_asset+data.url,
              imageCenter: [x,y],
              imageScale: [sx,sy],
              imageCrop: [xmin,ymin,xmax,ymax],
              imageRotate: Number(rotate*Math.PI/180),
              projection: 'EPSG:3857'
            })
          });
          map.addLayer(geoimg);
        }
      });
      $(".option").on("change", resetSource);
      $("#limpiar_tabla").on("click",function(){
        $("#table_points").html("");
        numero=1;
      });

      $("#form_terrenos").submit(function(e){
        e.preventDefault();
        ttam=$("#table_points tr").length;

        if(ttam!=0){
          var formData = new FormData($("#form_terrenos")[0]);
          $.ajax({
            url: "{{route("terrenos.store",$proyecto->id)}}",
            type: "POST",
            data: formData,
            contentType:false,
            processData:false,
            success:function(data){
              console.log(data);
                if(data.resp==200){
                  if($("#conservar").attr('checked')){
                      if(!isNaN($("#nro_lote").val())){
                        alert(Number($("#nro_lote").val())+1);
                        $("#nro_lote").val(Number($("#nro_lote").val())+1);
                      }
                  }else{
                    $("#manzano").val();
                    $("#nro_lote").val();
                    $("#categoria_id").val(1);
                    $("#superficie").val();
                    $("#precio").val();
                  }
                  ttam=$("#table_points").html("");
                    alert(data.msn);
                }else{
alert("fallo1");
                }
            },
            error:function(error){
               alert("fallo2");
            }
          });  
        }else{
          alert("selecione puntos");
          //toastr.error("No existen puntos indicadores del terreno.");
        }
        
      });
    });
    function resetSource ()
    { 
        var opacity = Number($("#opacity").val());
        if (opacity>1) opacity=1;
        else if (opacity<0) opacity=0;
        $("#opacity").val(opacity);
        geoimg.setOpacity(opacity);
        geoimg.getSource().setCenter([x,y]);
        geoimg.getSource().setRotation(rotate*Math.PI/180);
        geoimg.getSource().setScale([sx,sy]);
        geoimg.getSource().setCrop([xmin,ymin,xmax,ymax]);
        var crop = geoimg.getSource().getCrop();
        $("#xmin").val(crop[0]);
        $("#ymin").val(crop[1]);
        $("#xmax").val(crop[2]);
        $("#ymax").val(crop[3]);
    }
    function calcularprecioterreno(){
      $("#valor_terreno").autoNumeric("set",($("#superficie").val()*$("#precoi_x_mtr2").val()));
      $("#precio_venta").autoNumeric("set",($("#valor_terreno").val()-$("#descuento_promocion").val()-$("#descuento_general").val()))
      
    }
  </script>
  <script>
    /*$.ajax({
                url: url,
                type: tipo,
                data: datos,
                contentType:false,
                processData:false,
                success:function(data){
                    if(data.status==200){
                        callback(data,'success');
                    }else{
                        callback(data,'error');
                    }
                },
                error:function(error){
                    callback(error,'error');
                }
            });*/
  </script>

@endsection