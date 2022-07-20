@extends('layouts.principal')

@section('title', $title)

@section('before-style')
  
@endsection

@section('after-style')
  
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
              	
            </div>
        </div>
    </div>
@endsection

@section('after-script')
  
@endsection