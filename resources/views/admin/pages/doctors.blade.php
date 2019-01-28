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

        var base_url = $('#base_url').val();

        var table_doctors = $('#doctors').DataTable ( {
        "bFilter": false,
        "bInfo" : false,
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'autoWidth'   : false
        } );

        var rootRef = firebase.database().ref().child("Doctors/")

        rootRef.on("child_added", snap => {

            var url = base_url+'/admin/doctor/schedule/'+snap.key;
            var dataSet = [
                snap.child("name").val(), 
                snap.child("position").val(),
                snap.child("age").val(),
                snap.child("specialization").val(),
                '<a class="btn btn-xs btn-social-icon btn-dropbox" href="'+url+'"><i class="fa fa-eye"></i></a><a class="btn btn-xs btn-social-icon btn-dropbox btn-update" data-key="'+snap.key+'" data-name="'+snap.child("name").val()+'" data-position="'+snap.child("position").val()+'" data-age="'+snap.child("age").val()+'" data-specialization="'+snap.child("specialization").val()+'"><i class="fa fa-pencil"></i></a>'+
                '<a class="btn btn-xs btn-social-icon btn-google btn-delete" data-key="'+snap.key+'"><i class="fa fa-trash-o"></i></a>'];
                table_doctors.rows.add([dataSet]).draw().nodes().to$()
                .each(function() {
                    $(this).attr('id', snap.key);
                    $(this).attr('class', 'cancelled_row');
                });;
        })

        //show modal on click
        $('#doctor_btn').on('click',function(){
           $('#doctors_form')[0].reset();
           $('#type').val('add');
           $('#doctor_modal').modal('show');
           $('.modal-title').text('Add Doctor')
        })

        rootRef.on("child_changed", snap => {
          $("#"+ snap.key).html('<td>'+snap.child("name").val()+'</td><td>'+snap.child("position").val()+'</td><td>'+snap.child("age").val()+'</td><td>'+snap.child("specialization").val()+'</td><td><a class="btn btn-xs btn-social-icon btn-dropbox btn-update" data-key="'+snap.key+'" data-name="'+snap.child("name").val()+'" data-position="'+snap.child("position").val()+'" data-age="'+snap.child("age").val()+'" data-specialization="'+snap.child("specialization").val()+'"><i class="fa fa-pencil"></i></a>'+
                '<a class="btn btn-xs btn-social-icon btn-google btn-delete" data-key="'+snap.key+'"><i class="fa fa-trash-o"></i></a></td>');
        })

        rootRef.on("child_removed", snap => {
          $("#"+ snap.key).remove();
        })


        $('body').delegate('.btn-update','click',function(){

            $('.modal-title').text('Update Doctor')  

            var key = $(this).data('key');
            var name = $(this).data('name');
            var position = $(this).data('position');
            var age = $(this).data('age');
            var specialization = $(this).data('specialization');


            $("input[name=name]").val(name)
            $("input[name=position]").val(position)
            $("input[name=age]").val(age)
            $("input[name=specialization]").val(specialization)


            $('#key').val(key);
            $('#type').val('update');
            $('#doctor_modal').modal('show');

        })

        $('body').delegate('.btn-delete','click',function(){

            var key = $(this).data('key');

            var path_doctor = 'Doctors';
  

            swal({
                title: "Are you sure?",
                text: "you want to delete this doctor",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    removeFirebase(key,path_doctor)
                }
            });
        })

        $('#save_doctor').on('click',function(){

            if($('#doctors_form').valid()){
       
                var params = {
                  name: $("input[name=name]").val(),
                  position: $("input[name=position]").val(),
                  age: $("input[name=age]").val(),
                  specialization: $("input[name=specialization]").val(),
                };    

                var path = 'Doctors';
                var text = '';
                var text1 = '';

                if($('#type').val() == 'update'){
                    text = "Edit Doctors";
                    text1 = 'updated';
                    var key =  $('#key').val();
                    updateFirebase(key,path,params);
                }else{
                    text = "Add Doctor";
                    text1 = 'added';
                    addFirebase(path,params);
                }

                $('#doctor_modal').modal('hide');

                swal({
                    title: text,
                    text: "Doctor successfully "+text1,
                    icon: "success",
                });

                $('#doctors_form')[0].reset();

            }
            
        })

    })
</script>
@endpush

@section('title')

@endsection

@section('content')

<section class="content-header">
    <h1>
      Doctors Information
      <small>list of doctor</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Doctors</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <!-- /.box-header -->
          <div class="box-body">
            <p><button type="button" class="btn btn-block btn-primary" id="doctor_btn">Add Doctor</button></p>    
            <table id="doctors" class="table table-bordered table-striped">
              <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Age</th>
                    <th>Specialization</th>
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

  <div class="modal fade" id="doctor_modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add Doctor</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                <div class="box box-primary">
                        <!-- form start -->
                        <form role="form" id="doctors_form">
                                <input type="hidden" id="key">  
                                <input type="hidden" id="type"> 
                                <div class="box-body">
                                  <div class="form-group">
                                      <label for="name">Name</label>
                                      <input type="text" class="form-control" name="name" placeholder="Enter Name" required="true">
                                  </div>
                                  <div class="form-group">
                                      <label for="position">Position</label>
                                      <input type="text" class="form-control" name="position" placeholder="Enter Position" required="true">
                                  </div>
                                  <div class="form-group">
                                    <label for="age">Age</label>
                                    <input type="text" class="form-control" name="age" placeholder="Enter Age" required="true">
                                  </div>
                                  <div class="form-group">
                                      <label for="species">Specialization</label>
                                      <input type="text" class="form-control" name="specialization" placeholder="Enter Specialization" required="true">
                                  </div>  
                            
                                </div>
                                <!-- /.box-body -->
                        </form>
                </div>
         </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="save_doctor">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
@endsection