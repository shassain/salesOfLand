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
          <div class="col-md-4 col-xs-12 col-sm-12">
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
                    <h2 id="manzano_name">{{$data->manzano}}</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <center>Terreno
                      <div style="text-align: center; margin-bottom: 17px;height: 80px;width: 80px;-moz-border-radius: 50%;-webkit-border-radius: 50%;border-radius: 50%;border: 1px solid #000;background: {{$data->categoria->color}};font-size: 50px" id="cajacolor">
                        {{$data->nro_lote}}
                      </div>  
                    </center>
                    <div class="form-group">
                      <label class="control-label col-md-4 col-sm-4 col-xs-4">Superficie:</label>
                      <div class="col-md-8 col-sm-8 col-xs-8">
                        <input type="text" class="form-control" id="superficie" name="superficie" readonly value="{{$data->superficie}}">
                        <span class="fa fa-flag form-control-feedback right" aria-hidden="true"></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-4 col-sm-4 col-xs-4">Pre/Mtr<sup>2</sup> :</label>
                      <div class="col-md-8 col-sm-8 col-xs-8">
                        <input type="text" class="form-control" id="precoi_x_mtr2" readonly name="precoi_x_mtr2" value="{{$data->precoi_x_mtr2}}">
                        <span class="fa fa-retweet form-control-feedback right" aria-hidden="true"></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-4 col-sm-4 col-xs-4">Valor Terr:</label>
                      <div class="col-md-8 col-sm-8 col-xs-8">
                        <input type="text" class="form-control" name="valor_terreno" readonly id="valor_terreno" value="{{$data->valor_terreno}}">
                        <span class="fa fa-dollar form-control-feedback right" aria-hidden="true"></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-4 col-sm-4 col-xs-4">Des. Gral:</label>
                      <div class="col-md-8 col-sm-8 col-xs-8">
                        <input type="text" class="form-control" name="descuento_general" id="descuento_general" value="{{$data->descuento_general}}">
                        <span class="fa fa-minus-square form-control-feedback right" aria-hidden="true"></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-4 col-sm-4 col-xs-4">Des. Prom:</label>
                      <div class="col-md-8 col-sm-8 col-xs-8">
                        <input type="text" class="form-control" name="descuento_promocion" id="descuento_promocion" value="{{$data->descuento_promocion}}">
                        <span class="fa fa-minus-square-o form-control-feedback right" aria-hidden="true"></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-4 col-sm-4 col-xs-4">Precio Vta:</label>
                      <div class="col-md-8 col-sm-8 col-xs-8">
                        <input type="text" style="background: #330000;color: #ffff00" class="form-control" name="precio_venta" readonly value="{{$data->precio_venta}}" id="precio_venta">
                        <span style="color: #ffff00" class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
                      </div>
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
          <div class="col-md-8" >
            <div class="x_panel">
                <div class="x_title">
                  <h2><i class="fa fa-bars"></i> Opciones de Venta de terreno</small></h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <div class="col-xs-10">
                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div class="tab-pane active" id="plazos_tab">
                        <p class="lead">Venta a Plazos</p>
                        @include("adminVentas.ventas.componentes.ventaplazos")
                      </div>
                      <div class="tab-pane" id="contado_tab">Venta al Contado.</div>
                      <div class="tab-pane" id="reserva_tab">Reserva de Terreno</div>
                    </div>
                  </div>

                  <div class="col-xs-2">
                    <!-- required for floating -->
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs tabs-right">
                      <li class="active"><a  href="#plazos_tab" data-toggle="tab"> <i class="fa fa-dollar"></i> Plazos</a>
                      </li>
                      <li><a href="#contado_tab" data-toggle="tab"><i class="fa fa-bitcoin"></i> Contado</a>
                      </li>
                      <li><a href="#reserva_tab" data-toggle="tab"><i class="fa fa-folder-open"></i> Reserva</a>
                      </li>
                    </ul>
                  </div>

                </div>

              </div>
          </div>
        </div>
    </div>

    
@endsection

@section('after-script')

<script src="{{asset("assets/js/autonumeric/autoNumeric.js")}}"></script>

    
    <script type="text/javascript">
    
        
    function calcularprecioterreno(){
      $("#valor_terreno").autoNumeric("set",($("#superficie").val()*$("#precoi_x_mtr2").val()));
      $("#precio_venta").autoNumeric("set",($("#valor_terreno").val()-$("#descuento_promocion").val()-$("#descuento_general").val()));  
    }
    $(document).ready(function(){
      $("#superficie").autoNumeric("init", {pSign:'s',mDec: '2',aSep:'',vMin: '0', vMax: '99999999'});
      $("#precio_venta").autoNumeric("init", {pSign:'s',mDec: '2',aSep:'',vMin: '0', vMax: '99999999'});
      $("#precoi_x_mtr2").autoNumeric("init", {pSign:'s',mDec: '2',aSep:'',vMin: '0', vMax: '99999999'});
      $("#valor_terreno").autoNumeric("init", {pSign:'s',mDec: '2',aSep:'',vMin: '0', vMax: '99999999'});
      $("#descuento_general").autoNumeric("init", {pSign:'s',mDec: '2',aSep:'',vMin: '0', vMax: '99999999'});
      $("#descuento_promocion").autoNumeric("init", {pSign:'s',mDec: '2',aSep:'',vMin: '0', vMax: '99999999'});
      $("#descuento_general").on("keyup",function(){
        calcularprecioterreno();
      });
      $("#descuento_promocion").on("keyup",function(){
        calcularprecioterreno();
      });
    });
  </script>


@endsection