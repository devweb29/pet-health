@extends('admin.layouts.index')

@push('styles')

@endpush

@push('scripts')
<script>
    $(function () {
        var table_pets = $('#pets').DataTable ( {
        "bFilter": false,
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'autoWidth'   : false
        } );

        var rootRef = firebase.database().ref().child("pets/")

        rootRef.on("child_added", snap => {
            var dataSet = [
                '<img src="'+snap.child("photo").val()+'">',
                snap.child("name").val(), 
                snap.child("species").val(), 
                snap.child("owner_name").val(),
                '  <a class="btn btn-xs btn-social-icon btn-dropbox"><i class="fa fa-pencil"></i></a><a class="btn btn-xs btn-social-icon btn-google"><i class="fa fa-trash-o"></i></a>'];
            table_pets.rows.add([dataSet]).draw();
        })


        //show modal on click
        $('#pet_modal').on('click',function(){
            alert();
        })
    })
</script>
@endpush

@section('title')

@endsection

@section('content')

<section class="content-header">
    <h1>
      Pets Information
      <small>list of pets</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Pets</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <!-- /.box-header -->
          <div class="box-body">
            <p><button type="button" class="btn btn-block btn-primary" id="pet_modal">Add Pet</button></p>    
            <table id="pets" class="table table-bordered table-striped">
              <thead>
                <tr>
                    <th></th>
                    <th>Pet Name</th>
                    <th>Species</th>
                    <th>Owner</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
              
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>

@endsection