@extends('app')

@section('styles')

    <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Scada:400,400i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i" rel="stylesheet">

    <link rel="stylesheet" href="{{url('vendor/node_modules/new_front_template/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{url('vendor/node_modules/new_front_template/css/style.css')}}">
    <link rel="stylesheet" href="{{url('vendor/node_modules/new_front_template/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{url('vendor/node_modules/new_front_template/css/flexslider.css')}}">
    <link rel="stylesheet" href="{{url('vendor/node_modules/new_front_template/css/lightbox.css')}}">
    <link rel="stylesheet" href="{{url('vendor/node_modules/new_front_template/css/owl.carousel.css')}}">
    

@endsection


@section('layout')

    @include('default.components.header')

    @yield('content')

    @include('default.components.footer')

    @section('scripts')
    

        <script src="{{url('vendor/node_modules/new_front_template/js/jquery-2.2.3.min.js')}}"></script>


        <script src="{{url('vendor/node_modules/new_front_template/js/move-top.js')}}"></script>

        <script src="{{url('vendor/node_modules/new_front_template/js/easing.js')}}"></script>
        <script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
			
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
	    </script>

        <script src="{{url('vendor/node_modules/new_front_template/js/SmoothScroll.min.js')}}"></script>
        
        <script type="text/javascript" src="{{url('vendor/node_modules/new_front_template/js/bootstrap.js')}}"></script>
        

    @endsection
@endsection