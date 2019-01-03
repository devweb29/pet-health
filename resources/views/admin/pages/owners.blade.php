@extends('admin.layouts.index')

@push('styles')

@endpush

@push('scripts')
<script>
    $(function () {
        var table_owners = $('#owners').DataTable ( {
        "bFilter": false,
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'autoWidth'   : false
        } );

        var rootRef = firebase.database().ref().child("owners/")

        rootRef.on("child_added", snap => {
            var dataSet = [
                snap.child("firstname").val(), 
                snap.child("lastname").val(), 
                snap.child("email").val(),
                '  <a class="btn btn-xs btn-social-icon btn-dropbox"><i class="fa fa-pencil"></i></a><a class="btn btn-xs btn-social-icon btn-google"><i class="fa fa-trash-o"></i></a>'];
            table_owners.rows.add([dataSet]).draw();
        })
    })
</script>
@endpush

@section('title')

@endsection

@section('content')

<section class="content-header">
    <h1>
      Owners Information
      <small>list of customers</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Owners</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <!-- /.box-header -->
          <div class="box-body">
            <table id="owners" class="table table-bordered table-striped">
              <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
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