@extends('app')

@section('styles')
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,800" rel="stylesheet">
<link rel="stylesheet" href="{{url('vendor/node_modules/bootstrap/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{url('vendor/node_modules/datatables/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{url('vendor/node_modules/template/app.css')}}">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{url('vendor/node_modules/template/skin-red-light.css')}}">
<style>
    .error{
        color:red;
    }
</style>    
@endsection

@section('scripts')
<script src="{{url('vendor/node_modules/jquery/jquery.min.js')}}"></script>
<script src="{{url('vendor/node_modules/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{url('vendor/node_modules/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('vendor/node_modules/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{url('vendor/node_modules/template/app.js')}}"></script>
<script src="{{url('vendor/node_modules/jquery/jquery.slimscroll.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.4.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.4.0/firebase-database.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyDxwrbKeh9OVuo3gwPcNkXXy8jLLn2KLuU",
    authDomain: "pethealthmonitoring.firebaseapp.com",
    databaseURL: "https://pethealthmonitoring.firebaseio.com",
    projectId: "pethealthmonitoring",
    storageBucket: "pethealthmonitoring.appspot.com",
    messagingSenderId: "337014160182"
  };
  firebase.initializeApp(config);
</script>
<script>
    $(document).ready(function(){
        $('body').addClass('fixed sidebar-mini skin-red-light')
    })
    function addFirebase(path,params){
        var rootRef = firebase.database().ref();
        var fireBaseRef = rootRef.child(path);
        var newFireBaseRef = fireBaseRef.push();
        newFireBaseRef.set(params);            
    }
    function updateFirebase(key,path,params){
        firebase.database().ref().child('/'+path+'/'+ key)
        .update(params);
    }
    function removeFirebase(key,path){
        firebase.database().ref('/'+path+'/'+ key).remove()
    }
</script>
@endsection

@section('layout')

<div class="wrapper">
    @include('admin.components.header')

    @include('admin.components.sidebar')

    <div class="content-wrapper">
        @yield('content')
    </div>    

    @include('admin.components.footer')
</div>
<!-- ./wrapper -->
@endsection