@extends('app')

@section('styles')
<link rel="stylesheet" href="{{url('vendor/node_modules/bootstrap/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{url('vendor/node_modules/template/app.css')}}">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{url('vendor/node_modules/template/skin-red-light.css')}}">
@endsection

@section('scripts')
<script src="{{url('vendor/node_modules/jquery/jquery.min.js')}}"></script>
<script src="{{url('vendor/node_modules/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{url('vendor/node_modules/template/app.js')}}"></script>
<script src="{{url('vendor/node_modules/jquery/jquery.slimscroll.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $('body').addClass('fixed sidebar-mini skin-red-light')
    })
</script>
@endsection

@section('layout')

<div class="wrapper">
    @include('admin.components.header')

    @include('admin.components.sidebar')

    <div class="content-wrapper">
        <section class="content">
            @yield('content')
        </section>
    </div>    

    @include('admin.components.footer')
</div>
<!-- ./wrapper -->
@endsection