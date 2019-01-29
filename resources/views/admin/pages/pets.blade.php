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
        
        var table_pets = $('#pets').DataTable ( {
        "bFilter": false,
        "bInfo" : false,
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'autoWidth'   : false
        } );

        var rootRef = firebase.database().ref().child("Pets/")

        rootRef.on("child_added", snap => {
            var dataSet = [
                '<img src="'+snap.child("image").val()+'" width="80" height="80"/>', 
                snap.child("name").val(), 
                snap.child("breed").val(), 
                '<a class="btn btn-xs btn-social-icon btn-dropbox btn-update" data-key="'+snap.key+'" data-age="'+snap.child("age").val()+'" data-breed="'+snap.child("breed").val()+'" data-condition="'+snap.child("condition").val()+'" data-gender="'+snap.child("gender").val()+'" data-medication="'+snap.child("medication").val()+'" data-name="'+snap.child("name").val()+'" data-species="'+snap.child("species").val()+'" data-status="'+snap.child("status").val()+'" data-weight="'+snap.child("weight").val()+'" data-user_id="'+snap.child("user_id").val()+'"><i class="fa fa-pencil"></i></a>'+
                '<a class="btn btn-xs btn-social-icon btn-google btn-delete" data-key="'+snap.key+'" data-user_id="'+snap.child("user_id").val()+'"><i class="fa fa-trash-o"></i></a>'];
                table_pets.rows.add([dataSet]).draw().nodes().to$()
                .each(function() {
                    $(this).attr('id', snap.key);
                });;
        })


        rootRef.on("child_changed", snap => {
          $("#"+ snap.key).html('<td><img src="'+snap.child("image").val()+'" width="80" height="80"/></td><td>'+snap.child("name").val()+'</td><td>'+snap.child("breed").val()+'</td><td><a class="btn btn-xs btn-social-icon btn-dropbox btn-update" data-key="'+snap.key+'" data-age="'+snap.child("age").val()+'" data-breed="'+snap.child("breed").val()+'" data-condition="'+snap.child("condition").val()+'" data-gender="'+snap.child("gender").val()+'" data-medication="'+snap.child("medication").val()+'" data-name="'+snap.child("name").val()+'" data-species="'+snap.child("species").val()+'" data-status="'+snap.child("status").val()+'" data-weight="'+snap.child("weight").val()+'" data-user_id="'+snap.child("user_id").val()+'"><i class="fa fa-pencil"></i></a>'+
                '<a class="btn btn-xs btn-social-icon btn-google btn-delete" data-key="'+snap.key+'" data-user_id="'+snap.child("user_id").val()+'"><i class="fa fa-trash-o"></i></a></td>');
        })

        rootRef.on("child_removed", snap => {
          $("#"+ snap.key).remove();
        })


        $('body').delegate('.btn-update','click',function(){

            $('.modal-title').text('Update Pet')  

            var key = $(this).data('key');
            var age = $(this).data('age');
            var breed = $(this).data('breed');
            var gender = $(this).data('gender');
            var image = $(this).data('image');
            var name = $(this).data('name');
            var species = $(this).data('species');
            var weight = $(this).data('weight');


            $("input[name=age]").val(age)
            $("input[name=breed]").val(breed)
            $("input[name=gender]").val(gender)
            $("input[name=name]").val(name)
            $("input[name=species]").val(species)


            $('#key').val(key);
            $('#type').val('update');
            $('#pet_modal').modal('show');

        })

        $('body').delegate('.btn-delete','click',function(){

            var key = $(this).data('key');
            var user_id = $(this).data('user_id');

            var path_pet = 'Pets';
            var path_user_pet = 'User_pets';

            swal({
                title: "Are you sure?",
                text: "you want to delete this pet",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {

                    removeFirebase(key,path_pet)

                    firebase.database().ref('/'+path_user_pet+'/'+ user_id +'/'+ key).remove()

                }
            });
        })

        $('#save_pet').on('click',function(){

            if($('#pets_form').valid()){
       
                var params = {
                  age: $("input[name=age]").val(),
                  breed: $("input[name=breed]").val(),
                  gender: $("input[name=gender]").val(),
                  name: $("input[name=name]").val(),
                  species: $("input[name=species]").val(),
                };    

                var path = 'Pets';
                var text = '';
                var text1 = '';

                if($('#type').val() == 'update'){
                    text = "Edit Pet";
                    text1 = 'updated';
                    var key =  $('#key').val();
                    updateFirebase(key,path,params);
                }

                $('#pet_modal').modal('hide');

                swal({
                    title: text,
                    text: "Pet successfully "+text1,
                    icon: "success",
                });

                $('#pets_form')[0].reset();

            }
            
        })

    })
</script>
@endpush

@section('title')
Pets
@endsection

@section('content')

<section class="content-header">
    <h1>
      Pets Information
      <small>list of pet</small>
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
            <table id="pets" class="table table-bordered table-striped">
              <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Breed</th>
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

  <div class="modal fade" id="pet_modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add Pet</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                <div class="box box-primary">
                        <!-- form start -->
                        <form role="form" id="pets_form">
                                <input type="hidden" id="key">  
                                <input type="hidden" id="type"> 
                                <div class="box-body">
                                  <div class="form-group">
                                      <label for="name">Name</label>
                                      <input type="text" class="form-control" name="name" placeholder="Enter Name" required="true">
                                  </div>
                                  <div class="form-group">
                                      <label for="gender">Gender</label>
                                      <input type="text" class="form-control" name="gender" placeholder="Enter Breed" required="true">
                                  </div>
                                  <div class="form-group">
                                    <label for="age">Age</label>
                                    <input type="text" class="form-control" name="age" placeholder="Enter Age" required="true">
                                  </div>

                                  <div class="form-group">
                                      <label for="species">Species</label>
                                      <input type="text" class="form-control" name="species" placeholder="Enter Species" required="true">
                                  </div>  

                                  <div class="form-group">
                                      <label for="breed">Breed</label>
                                      <input type="text" class="form-control" name="breed" placeholder="Enter Breed" required="true">
                                  </div>
                  
                          
                                </div>
                                <!-- /.box-body -->
                        </form>
                </div>
         </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="save_pet">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
@endsection