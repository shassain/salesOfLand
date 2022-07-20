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
      <div class="row" style="border-bottom: 1px solid #000000;box-shadow: 6px 6px 6px #330000;">
        <div class="col-md-12">
          <a href="#" class="btn myappbtn" data-toggle="modal" data-target=".bs-example-modal-sm" >
            <span class="badge bg-green">ac</span>
            <i class="fa fa-puzzle-piece"></i> Nuevo
          </a>
        </div>
      </div>
      <br>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
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
                      @foreach($datos as $dat)
                      <tr class="even pointer">
                        <td class=" ">{{$dat->nombre}}</td>
                        <td class=" " style=""><i class="{{$dat->icono}}" style="font-size: 25px;display: block; color:{{$dat->color}}"></i></td>
                        <td class=" ">{{$dat->tabla}}</td>
                        <td class="a-right a-right ">Bs. {{$dat->precio}}</td>
                        <td class=" last"><a href="#">editar</a></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

        </div>
    </div>
    @include("admin.tiposterreno.modalcreate")
@endsection

@section('after-script')
<script src="{{asset("assets/js/colorpicker/bootstrap-colorpicker.min.js")}}"></script>
<script src="{{asset("assets/js/autonumeric/autoNumeric.js")}}"></script>
  <script >
    $(function () {
      $('.demo2').colorpicker();
      $('#precio').autoNumeric("init");
      
      $('.itemlinea').click(function(){
        $("#i_icono").attr("class",$(this).children("i").attr('class'));
        $("#input_icono").val($(this).children("i").attr('class'));
      });
      $('#tablac').click(function(){
        if($('#tablac').val()=="referencias"){
          $("#precio").val(0);
          $("#precio").attr("readonly",true);
        }else{
          $("#precio").attr("readonly",false);
        }
      });
    });
  </script>
@endsection