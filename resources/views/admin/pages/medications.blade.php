@extends('admin.layouts.index')

@push('styles')
    <style>
        .btn-social-icon.btn-xs {
            margin-left: 5px !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.23.0/moment.min.js"></script>
    <script>
        $(function () {

            var count_user_notif = "";

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

                $('.modal-title').text('Update Medical History / Reports ');

                var key = $(this).data('key');
                var medication = $(this).data('medication');
                var condition = $(this).data('condition');
                var status = $(this).data('status');
                var user_id = $(this).data('user_id');
                var petname = $(this).data('name');


                $('#medication').val(medication);
                $('#condition').val(condition);
                $('#status').val(status);
                $('#user_id').val(user_id);
                $('#petname').val(petname);


                $('#key').val(key);
                $('#type').val('update');
                $('#pet_modal').modal('show');

            });

            $('body').delegate('.btn-delete','click',function(){

                var key = $(this).data('key');
                var user_id = $(this).data('user_id');

                var path_pet = 'Pets';

                swal({
                    title: "Are you sure?",
                    text: "you want to delete medical history / reports on this pet",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {

                        if (willDelete) {

                            var params = {
                                medication: "None",
                                condition: "None",
                                status: "None"
                            };

                            var key =  $('#key').val();
                            updateFirebase(key,path_pet,params);

                        }

                    });
            });


            $('#save_pet').on('click',function(){

                if($('#pets_form').valid()){

                    var params = {
                        medication: $('#medication').val(),
                        condition: $('#condition').val(),
                        status: $('#status').val()
                    };

                    var user_id = $('#user_id').val();
                    var path = 'Pets';
                    var text = '';
                    var text1 = '';

                    if($('#type').val() == 'update'){
                        text = "Edit Medical History / Reports";
                        text1 = 'updated';
                        var key =  $('#key').val();
                        updateFirebase(key,path,params);
                    }

                    $('#pet_modal').modal('hide');

                    swal({
                        title: text,
                        text: "Pet medical history / reports successfully "+text1,
                        icon: "success",
                    });

                    $('#pets_form')[0].reset();


                    //SEND NOTIFICATION

                    var petname = $('#petname').val();

                    var param_notif_list = {
                        notif_label: "Medical History / Reports",
                        notif_message: "Your medical history/reports request for "+petname+" is already updated",
                        notif_status: "open",
                        notif_type: "medication",
                    };

                    var today = moment(new Date()).format("MM/DD/YYYY");

                    var param_user_notif = {
                        date: today
                    };


                    var rootRefAppointmentCount =  firebase.database().ref('Notifications/'+ user_id + '/')

                    rootRefAppointmentCount.on("child_added", snap => {

                        var apt_count =  snap.node_.value_;
                        var count = "";

                        count = parseInt(apt_count) + 1;

                        getNotifCount(count)

                    });


                    var delayInMilliseconds = 3000;
                    setTimeout(function() {

                        var param_notif_count = {
                            count: count_user_notif
                        };

                        notificationFirebase(user_id,param_notif_list,param_user_notif,param_notif_count)

                    }, delayInMilliseconds);

                    //SEND NOTIFICATION
                }

            });

            function getNotifCount(count){
                count_user_notif = count
            }

        })
    </script>
@endpush

@section('title')

@endsection

@section('content')

    <section class="content-header">
        <h1>
            Medical History / Reports Information
            <small>list of medical history / report</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Medical History / Reports</li>
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
                                <input type="hidden" id="user_id">
                                <input type="hidden" id="petname">
                                <input type="hidden" id="type">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Condition</label>
                                        <textarea class="form-control" id="condition" rows="3" placeholder="Enter Condition" required="true"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Medication</label>
                                        <textarea class="form-control" id="medication" rows="3" placeholder="Enter Medication" required="true"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <textarea class="form-control" id="status" rows="3" placeholder="Enter Status" required="true"></textarea>
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