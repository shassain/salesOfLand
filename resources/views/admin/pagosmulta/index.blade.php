@extends('layouts.principal')

@section('title', $title)

@section('before-style')
  
@endsection

@section('after-style')
<link href="{{asset("assets/css/colorpicker/bootstrap-colorpicker.min.css")}}"rel="stylesheet" type="text/css" />
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
        background: #4800ff;
        color: #fff;
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
      <div class="row" >
        <div class="col-md-6" style="border-bottom: 1px solid #000000;box-shadow: 6px 6px 6px #330000;">
          <div class="col-md-2">
            <label>Multas</label>
          </div>
          <a href="#" class="btn myappbtn " data-toggle="modal" data-target="#modal_multas" >
            <span class="badge bg-green">ac</span>
            <i class="fa fa-line-chart"></i> Nuevo
          </a>
        </div>
        <div class="col-md-6" style="border-bottom: 1px solid #000000;box-shadow: 6px 6px 6px #330000;">
          <div class="col-md-2">
            <label>Pronto Pagos</label>
          </div>
          <a href="#" class="btn myappbtn " data-toggle="modal" data-target="#modal_pagos" >
            <span class="badge bg-green">ac</span>
            <i class="fa fa-bar-chart"></i> Nuevo
          </a>
        </div>
      </div>
      <br>
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Lista de Multas</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>

              <div class="x_content">
                <table class="table table-striped responsive-utilities jambo_table bulk_action">
                  <thead>
                    <tr class="headings" style="background: #ffd700;color: #330000">
                      <th class="column-title" style="display: table-cell;">Nombre</th>
                      <th class="column-title" style="display: table-cell;">Dias</th>
                      <th class="column-title" style="display: table-cell;">Monto</th>
                      <th class="column-title" style="display: table-cell;">Porcentaje</th>
                      <th class="column-title" style="display: table-cell;">Multi Dias</th>
                    </tr>
                  </thead>

                  <tbody>
                   @foreach($multas as $dat)
                      <tr class="even pointer">
                        <td class=" ">{{$dat->nombre}}</td>
                        <td class=" " style="">{{$dat->dias}}</td>
                        <td class=" ">{{$dat->monto}}</td>
                        <td class="a-right a-right ">
                          @if($dat->porciento)
                              SI
                          @else
                              NO
                          @endif
                        </td>
                        <td class=" last">
                          @if($dat->pordia)
                              SI
                          @else
                              NO
                          @endif
                        </td>
                      </tr>
                   @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Datos de Tipos de Terreno</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>

              <div class="x_content">
                <table class="table table-striped responsive-utilities jambo_table bulk_action">
                  <thead>
                    <tr class="headings" style="background: #ffd700;color: #330000">
                      <th class="column-title" style="display: table-cell;">Nombre</th>
                      <th class="column-title" style="display: table-cell;">Icono y color</th>
                      <th class="column-title" style="display: table-cell;">Tipo</th>
                      <th class="column-title" style="display: table-cell;">Precio</th>
                      <th class="column-title" style="display: table-cell;">Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach($pagos as $dat)
                      <tr class="even pointer">
                        <td class=" ">{{$dat->nombre}}</td>
                        <td class=" " style="">{{$dat->dias}}</td>
                        <td class=" ">{{$dat->monto}}</td>
                        <td class="a-right a-right ">
                          @if($dat->porciento)
                              SI
                          @else
                              NO
                          @endif
                        </td>
                        <td class=" last">
                          @if($dat->pordia)
                              SI
                          @else
                              NO
                          @endif
                        </td>
                      </tr>
                   @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
    </div>
    @include("admin.pagosmulta.modalcreatemulta")
    @include("admin.pagosmulta.modalcreatepago")
@endsection

@section('after-script')
<script src="{{asset("assets/js/colorpicker/bootstrap-colorpicker.min.js")}}"></script>
<script src="{{asset("assets/js/autonumeric/autoNumeric.js")}}"></script>
  <script >
    $(function () {
      $('.demo2').colorpicker();
      $("#montop").autoNumeric("init", {pSign:'s',mDec: '2',aSep:'',vMin: '0', vMax: '99999999'});
      $("#diasp").autoNumeric("init", {pSign:'s',mDec: '0',aSep:'',vMin: '0', vMax: '99999999'});
      $("#montom").autoNumeric("init", {pSign:'s',mDec: '2',aSep:'',vMin: '0', vMax: '99999999'});
      $("#diasm").autoNumeric("init", {pSign:'s',mDec: '0',aSep:'',vMin: '0', vMax: '99999999'});
      $('.itemlinea').click(function(){
        $("#i_icono").attr("class",$(this).children("i").attr('class'));
        $("#input_icono").val($(this).children("i").attr('class'));
      });
    });
  </script>
@endsection
