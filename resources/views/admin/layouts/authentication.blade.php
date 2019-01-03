@extends('app')

@section('styles')
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,800" rel="stylesheet">
<link rel="stylesheet" href="{{url('vendor/node_modules/bootstrap/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{url('vendor/node_modules/template/app.css')}}">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{url('vendor/node_modules/template/skin-red-light.css')}}">
@endsection

@section('scripts')
<script src="{{url('vendor/node_modules/jquery/jquery.min.js')}}"></script>
<script src="{{url('vendor/node_modules/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{url('vendor/node_modules/template/app.js')}}"></script>
@endsection

@section('layout')

@yield('content')

@endsection