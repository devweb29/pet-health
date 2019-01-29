@extends('admin.layouts.index')

@push('styles')
  <style>
      .btn-social-icon.btn-xs {
        margin-left: 5px !important;
      }
  </style>
@endpush

@push('scripts')
<script>
    $(function () {
        
        var table_services = $('#services').DataTable ( {
        "bFilter": false,
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'autoWidth'   : false
        } );

        var rootRef = firebase.database().ref().child("services/")

        rootRef.on("child_added", snap => {
            var dataSet = [
                snap.child("name").val(), 
                snap.child("description").val(), 
                '  <a class="btn btn-xs btn-social-icon btn-dropbox btn-update" data-key="'+snap.key+'" data-name="'+snap.child("name").val()+'" data-description="'+snap.child("description").val()+'"><i class="fa fa-pencil"></i></a><a class="btn btn-xs btn-social-icon btn-google btn-delete" data-key="'+snap.key+'"><i class="fa fa-trash-o"></i></a>'];
                table_services.rows.add([dataSet]).draw().nodes().to$()
                .each(function() {
                    $(this).attr('id', snap.key);
                });
        });


        rootRef.on("child_changed", snap => {
          $("#"+ snap.key).html('<td class="sorting_1">'+snap.child("name").val()+'</td><td>'+snap.child("description").val()+'</td><td>  <a class="btn btn-xs btn-social-icon btn-dropbox btn-update" data-key="'+snap.key+'" data-name="'+snap.child("name").val()+'" data-description="'+snap.child("description").val()+'" ><i class="fa fa-pencil"></i></a><a class="btn btn-xs btn-social-icon btn-google btn-delete" data-key="'+snap.key+'"><i class="fa fa-trash-o"></i></a></td>');
        });

        rootRef.on("child_removed", snap => {
          $("#"+ snap.key).remove();
        });

        //show modal on click
        $('#service_btn').on('click',function(){
           $('#services_form')[0].reset();
           $('#type').val('add');
           $('#service_modal').modal('show');
           $('.modal-title').text('Add Service')
        })

        $('body').delegate('.btn-update','click',function(){

            $('.modal-title').text('Update Service')  

            var key = $(this).data('key');
            var name = $(this).data('name');
            var description = $(this).data('description');
            
            $("input[name=name]").val(name)
            $("#description").val(description)

            $('#key').val(key);
            $('#type').val('update');
            $('#service_modal').modal('show');

        });

        $('body').delegate('.btn-delete','click',function(){
            var key = $(this).data('key');
            var path = 'services';
            swal({
                title: "Are you sure?",
                text: "you want to delete this service",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    removeFirebase(key,path)
                }
            });
        });

        $('#save_service').on('click',function(){

            if($('#services_form').valid()){
       
                var params = {
                    name: $("input[name=name]").val(),
                    description: $("#description").val()
                };    

                var path = 'services';
                var text = '';
                var text1 = '';

                if($('#type').val() == 'update'){
                    text = "Edit Service";
                    text1 = 'updated';
                    var key =  $('#key').val();
                    updateFirebase(key,path,params);
                }else{
                    text = "Add Service";
                    text1 = 'added';
                    addFirebase(path,params);
                }

                $('#service_modal').modal('hide');

                swal({
                    title: text,
                    text: "Service successfully "+text1,
                    icon: "success",
                });

                $('#services_form')[0].reset();

            }
            
        })

    })
</script>
@endpush

@section('title')
Services
@endsection

@section('content')

<section class="content-header">
    <h1>
      Services Information
      <small>list of service</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Services</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <!-- /.box-header -->
          <div class="box-body">
            @if(Auth::user()->user_type == 1)
                <p><button type="button" class="btn btn-block btn-primary" id="service_btn">Add Service</button></p>
            @endif
            <table id="services" class="table table-bordered table-striped">
              <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    @if(Auth::user()->user_type == 1)
                        <th>Action</th>
                    @endif
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

  <div class="modal fade" id="service_modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add Service</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                <div class="box box-primary">
                        <!-- form start -->
                        <form role="form" id="services_form">
                                <input type="hidden" id="key">  
                                <input type="hidden" id="type"> 
                                <div class="box-body">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name" required="true">
                                  </div>
                                  <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" id="description" rows="3" placeholder="Enter Description" required="true"></textarea>
                                  </div>
                                </div>
                                <!-- /.box-body -->
                        </form>
                </div>
         </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="save_service">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
@endsection