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
        
        var table_services = $('#pet_owners').DataTable ( {
        "bFilter": false,
        "bInfo" : false,
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'autoWidth'   : false
        } );

        var rootRef = firebase.database().ref().child("Users/")

        rootRef.on("child_added", snap => {
            var dataSet = [
                snap.child("firstName").val(), 
                snap.child("lastName").val(), 
                snap.child("userEmail").val(), 
                '<a class="btn btn-xs btn-social-icon btn-dropbox btn-update" data-key="'+snap.key+'" data-fname="'+snap.child("firstName").val()+'" data-lname="'+snap.child("lastName").val()+'" data-email="'+snap.child("userEmail").val()+'" data-phone="'+snap.child("userPhone").val()+'"><i class="fa fa-pencil"></i></a>'];
                table_services.rows.add([dataSet]).draw().nodes().to$()
                .each(function() {
                    $(this).attr('id', snap.key);
                });;
        })


        rootRef.on("child_changed", snap => {
          $("#"+ snap.key).html('<td class="sorting_1">'+snap.child("firstName").val()+'</td><td>'+snap.child("lastName").val()+'</td><td>'+snap.child("userEmail").val()+'</td><td>  <a class="btn btn-xs btn-social-icon btn-dropbox btn-update" data-key="'+snap.key+'" data-fname="'+snap.child("firstName").val()+'" data-lname="'+snap.child("lastName").val()+'" data-email="'+snap.child("userEmail").val()+'" data-phone="'+snap.child("userPhone").val()+'"><i class="fa fa-pencil"></i></a>');
        })


        $('body').delegate('.btn-update','click',function(){

            $('.modal-title').text('Update Pet Owner')  

            var key = $(this).data('key');
            var fname = $(this).data('fname');
            var lname = $(this).data('lname');
            var email = $(this).data('email');
            var phone = $(this).data('phone');

            $("input[name=fname]").val(fname)
            $("input[name=lname]").val(lname)
            $("input[name=email]").val(email)
            $("input[name=phone]").val(phone)

            $('#key').val(key);
            $('#type').val('update');
            $('#pet_owner_modal').modal('show');

        })

      
        $('#save_pet_owner').on('click',function(){

            if($('#pet_owners_form').valid()){
       
                var params = {
                  firstName: $("input[name=fname]").val(),
                  lastName: $("input[name=lname]").val(),
                  userEmail: $("input[name=email]").val(),
                  userPhone: $("input[name=phone]").val()
                };

                var path = 'Users';
                var text = '';
                var text1 = '';

                if($('#type').val() == 'update'){
                    text = "Edit Pet Owner";
                    text1 = 'updated';
                    var key =  $('#key').val();
                    updateFirebase(key,path,params);
                }

                $('#pet_owner_modal').modal('hide');

                swal({
                    title: text,
                    text: "Pet Owner successfully "+text1,
                    icon: "success",
                });

                $('#pet_owners_form')[0].reset();

            }
            
        })

    })
</script>
@endpush

@section('title')
Owners
@endsection

@section('content')

<section class="content-header">
    <h1>
      Pet Owner Information
      <small>list of service</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Pet Owners</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <!-- /.box-header -->
          <div class="box-body">
            <table id="pet_owners" class="table table-bordered table-striped">
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

  <div class="modal fade" id="pet_owner_modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add Pet Owner</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                <div class="box box-primary">
                        <!-- form start -->
                        <form role="form" id="pet_owners_form">
                                <input type="hidden" id="key">  
                                <input type="hidden" id="type"> 
                                <div class="box-body">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">First Name</label>
                                    <input type="text" class="form-control" name="fname" placeholder="Enter First Name" required="true">
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Last Name</label>
                                    <input type="text" class="form-control" name="lname" placeholder="Enter Last Name" required="true">
                                  </div>
                                  <div class="form-group">
                                        <label for="exampleInputEmail1">Phone</label>
                                        <input type="text" class="form-control" name="phone" placeholder="Enter Phone" required="true">
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter Email" required="true">
                                  </div>
                                </div>
                                <!-- /.box-body -->
                        </form>
                </div>
         </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="save_pet_owner">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
@endsection