@extends('layouts.principal')

@section('title', 'INICIO')

@section('after-style')
    {!! Html::style ('assets/mapa/css/jquery.orgchart.css')!!}
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
                <div class="x_panel">
                    <h1 style="text-align: center;color: blue;font-weight: bold;font-family: fantasy;text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.3);">SISTEMA DE ADMINISTRACIÓN FINANCIERA</h1>
                    <div class="clearfix"></div>
                    
                    <div class="x_content">
                        <div class="col-md-12">
                            <div id="chart_homecontainercontainer"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="row top_tiles">
                                    
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
    
@endsection