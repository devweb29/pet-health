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
        $(function(){

            var count_user_notif = "";
            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            });

            //APPOINTMENTS

            var table_appointments = $('#appointments_table').DataTable ( {
                "bFilter": false,
                "bInfo" : false,
                'paging'      : true,
                'lengthChange': false,
                'searching'   : true,
                'ordering'    : true,
                'autoWidth'   : false
            } );

            var rootRefAppointment = firebase.database().ref().child("Appointments/")

            rootRefAppointment.on("child_added", snap => {

                var appointment_status = snap.child("status").val();

                var status_color = '';

                switch(appointment_status) {
                    case "pending":
                        status_color = "bg-green";
                        break;
                    case "upcoming":
                        status_color = "bg-yellow";
                        break;
                    case "cancelled":
                        status_color = "bg-red";
                        break;
                }

                var dataSet = [
                    snap.child("customer_name").val(),
                    snap.child("petname").val(),
                    snap.child("date").val(),
                    snap.child("preferred_time").val(),
                    snap.child("preferred_doctor").val(),
                    '<small class="label pull-left '+status_color+'">'+snap.child("status").val()+'</small>',
                    '<a class="btn btn-xs btn-social-icon btn-dropbox btn-approved" data-key="'+snap.key+'" data-user_id="'+snap.child("user_id").val()+'" data-petname="'+snap.child("petname").val()+'" data-date="'+snap.child("date").val()+'" ><i class="fa fa-check"></i></a><a class="btn btn-xs btn-social-icon btn-google btn-declined" data-key="'+snap.key+'" data-user_id="'+snap.child("user_id").val()+'" data-petname="'+snap.child("petname").val()+'" data-date="'+snap.child("date").val()+'"><i class="fa fa-times"></i></a><a class="btn btn-xs btn-social-icon btn-dropbox btn-update" data-key="'+snap.key+'" data-comment="'+snap.child("comment").val()+'" data-customer_name="'+snap.child("customer_name").val()+'" data-customer_phone="'+snap.child("customer_phone").val()+'" data-date="'+snap.child("date").val()+'" data-petname="'+snap.child("petname").val()+'" data-preferred_doctor="'+snap.child("preferred_doctor").val()+'" data-preferred_time="'+snap.child("preferred_time").val()+'" data-service="'+snap.child("service").val()+'" data-user_id="'+snap.child("user_id").val()+'"><i class="fa fa-pencil"></i></a><a class="btn btn-xs btn-social-icon btn-google btn-delete" data-key="'+snap.key+'" data-user_id="'+snap.child("user_id").val()+'"><i class="fa fa-trash-o"></i></a>'];

                table_appointments.rows.add([dataSet]).draw().nodes().to$()
                    .each(function() {
                        $(this).attr('class', snap.key);
                    });
            });

            rootRefAppointment.on("child_changed", snap => {

                var appointment_status = snap.child("status").val();

                var status_color = '';

                switch(appointment_status) {
                    case "pending":
                        status_color = "bg-green";
                        break;
                    case "upcoming":
                        status_color = "bg-yellow";
                        break;
                    case "cancelled":
                        status_color = "bg-red";
                        break;
                }

                $('.'+ snap.key).html('<td>'+snap.child("customer_name").val()+'</td><td>'+snap.child("petname").val()+'</td><td>'+snap.child("date").val()+'</td><td>'+snap.child("preferred_time").val()+'</td><td>'+snap.child("preferred_doctor").val()+'</td><td><small class="label pull-left '+status_color+'">'+snap.child("status").val()+'</small></td>  <td><a class="btn btn-xs btn-social-icon btn-dropbox btn-approved" data-key="'+snap.key+'" data-user_id="'+snap.child("user_id").val()+'" data-petname="'+snap.child("petname").val()+'" data-date="'+snap.child("date").val()+'"><i class="fa fa-check"></i></a><a class="btn btn-xs btn-social-icon btn-google btn-declined" data-key="'+snap.key+'" data-user_id="'+snap.child("user_id").val()+'" data-petname="'+snap.child("petname").val()+'" data-date="'+snap.child("date").val()+'"><i class="fa fa-times"></i></a><a class="btn btn-xs btn-social-icon btn-dropbox btn-update" data-key="'+snap.key+'" data-comment="'+snap.child("comment").val()+'" data-customer_name="'+snap.child("customer_name").val()+'" data-customer_phone="'+snap.child("customer_phone").val()+'" data-date="'+snap.child("date").val()+'" data-petname="'+snap.child("petname").val()+'" data-preferred_doctor="'+snap.child("preferred_doctor").val()+'" data-preferred_time="'+snap.child("preferred_time").val()+'" data-service="'+snap.child("service").val()+'" data-user_id="'+snap.child("user_id").val()+'"><i class="fa fa-pencil"></i></a><a class="btn btn-xs btn-social-icon btn-google btn-delete" data-key="'+snap.key+'" data-user_id="'+snap.child("user_id").val()+'"><i class="fa fa-trash-o"></i></a></td>');
            });

            rootRefAppointment.on("child_removed", snap => {
                $("."+ snap.key).remove();
            });


            //APPOINTMENTS

            //PENDING APPOINTMENTS

            var table_pending = $('#pending').DataTable ( {
                "bFilter": false,
                "bInfo" : false,
                'paging'      : true,
                'lengthChange': false,
                'searching'   : true,
                'ordering'    : true,
                'autoWidth'   : false
            } );

            var rootRefPending = firebase.database().ref('Appointments/').orderByChild('status').startAt("pending").endAt("pending");

            rootRefPending.on("child_added", snap => {
                var dataSet = [
                    snap.child("customer_name").val(),
                    snap.child("petname").val(),
                    snap.child("date").val(),
                    snap.child("preferred_time").val(),
                    snap.child("preferred_doctor").val(),
                    '<a class="btn btn-xs btn-social-icon btn-dropbox btn-approved" data-key="'+snap.key+'" data-user_id="'+snap.child("user_id").val()+'" data-petname="'+snap.child("petname").val()+'" data-date="'+snap.child("date").val()+'"><i class="fa fa-check"></i></a><a class="btn btn-xs btn-social-icon btn-google btn-declined" data-key="'+snap.key+'" data-user_id="'+snap.child("user_id").val()+'" data-petname="'+snap.child("petname").val()+'" data-date="'+snap.child("date").val()+'"><i class="fa fa-times"></i></a><a class="btn btn-xs btn-social-icon btn-dropbox btn-update" data-key="'+snap.key+'" data-comment="'+snap.child("comment").val()+'" data-customer_name="'+snap.child("customer_name").val()+'" data-customer_phone="'+snap.child("customer_phone").val()+'" data-date="'+snap.child("date").val()+'" data-petname="'+snap.child("petname").val()+'" data-preferred_doctor="'+snap.child("preferred_doctor").val()+'" data-preferred_time="'+snap.child("preferred_time").val()+'" data-service="'+snap.child("service").val()+'" data-user_id="'+snap.child("user_id").val()+'"><i class="fa fa-pencil"></i></a><a class="btn btn-xs btn-social-icon btn-google btn-delete" data-key="'+snap.key+'" data-user_id="'+snap.child("user_id").val()+'"><i class="fa fa-trash-o"></i></a>'];
                table_pending.rows.add([dataSet]).draw().nodes().to$()
                    .each(function() {
                        $(this).attr('id', snap.key);
                    });
            });

            rootRefPending.on("child_changed", snap => {
                $("#pending #"+ snap.key).html('<td>'+snap.child("customer_name").val()+'</td><td>'+snap.child("petname").val()+'</td><td>'+snap.child("date").val()+'</td><td>'+snap.child("preferred_time").val()+'</td><td>'+snap.child("preferred_doctor").val()+'</td><td><a class="btn btn-xs btn-social-icon btn-dropbox btn-approved" data-key="'+snap.key+'" data-user_id="'+snap.child("user_id").val()+'" data-petname="'+snap.child("petname").val()+'" data-date="'+snap.child("date").val()+'"><i class="fa fa-check"></i></a><a class="btn btn-xs btn-social-icon btn-google btn-declined" data-key="'+snap.key+'" data-user_id="'+snap.child("user_id").val()+'" data-petname="'+snap.child("petname").val()+'" data-date="'+snap.child("date").val()+'"><i class="fa fa-times"></i></a><a class="btn btn-xs btn-social-icon btn-dropbox btn-update" data-key="'+snap.key+'" data-comment="'+snap.child("comment").val()+'" data-customer_name="'+snap.child("customer_name").val()+'" data-customer_phone="'+snap.child("customer_phone").val()+'" data-date="'+snap.child("date").val()+'" data-petname="'+snap.child("petname").val()+'" data-preferred_doctor="'+snap.child("preferred_doctor").val()+'" data-preferred_time="'+snap.child("preferred_time").val()+'" data-service="'+snap.child("service").val()+'" data-user_id="'+snap.child("user_id").val()+'"><i class="fa fa-pencil"></i></a><a class="btn btn-xs btn-social-icon btn-google btn-delete" data-key="'+snap.key+'" data-user_id="'+snap.child("user_id").val()+'"><i class="fa fa-trash-o"></i></a></td>');
            });

            rootRefPending.on("child_removed", snap => {
                $("#pending #"+ snap.key).remove();
            });


            $('body').delegate('.btn-approved','click',function(){

                var key = $(this).data('key');
                var user_id = $(this).data('user_id');

                var path_appointments = 'Appointments';
                var path_user_appointment = 'User_appointments';

                var params = {
                    status: "upcoming"
                };

                updateFirebase(key,path_appointments,params);

                firebase.database().ref().child('/'+path_user_appointment+'/'+ user_id + '/' + key)
                    .update(params);

                //SEND NOTIFICATION

                var date = $(this).data('date');
                var petname = $(this).data('petname');

                var param_notif_list = {
                    notif_label: "Appointment",
                    notif_message: "Your appointment for "+petname+" on "+date+" is already approved",
                    notif_status: "open",
                    notif_type: "apt",
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


                swal({
                    title: "Approved Appointment",
                    text: "Appointment successfully approved",
                    icon: "success",
                });

                var delayInMilliseconds = 3000;
                setTimeout(function() {

                    var param_notif_count = {
                        count: count_user_notif
                    };

                    notificationFirebase(user_id,param_notif_list,param_user_notif,param_notif_count)

                }, delayInMilliseconds);

                //SEND NOTIFICATION

            });

            function getNotifCount(count){
                count_user_notif = count
            }


            $('body').delegate('.btn-declined','click',function(){

                var key = $(this).data('key');
                var user_id = $(this).data('user_id');

                var path_appointments = 'Appointments';
                var path_user_appointment = 'User_appointments';

                var params = {
                    status: "cancelled"
                };

                swal({
                    title: "Are you sure?",
                    text: "you want to cancelled this appointment",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            updateFirebase(key,path_appointments,params);
                            firebase.database().ref().child('/'+path_user_appointment+'/'+ user_id + '/' + key)
                                .update(params);

                            //SEND NOTIFICATION

                            var date = $(this).data('date');
                            var petname = $(this).data('petname');

                            var param_notif_list = {
                                notif_label: "Appointment",
                                notif_message: "Your appointment for "+petname+" on "+date+" is cancelled/declined",
                                notif_status: "open",
                                notif_type: "apt",
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


                            swal({
                                title: "Cancelled/Declined Appointment",
                                text: "Appointment successfully cancelled/declined",
                                icon: "success",
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

            });

            //PENDING APPOINTMENTS


            //UPCOMING APPOINTMENTS

            var table_upcoming = $('#upcoming').DataTable ( {
                "bFilter": false,
                "bInfo" : false,
                'paging'      : true,
                'lengthChange': false,
                'searching'   : true,
                'ordering'    : true,
                'autoWidth'   : false
            } );

            var rootRefUpcoming = firebase.database().ref('Appointments/').orderByChild('status').startAt("upcoming").endAt("upcoming");

            rootRefUpcoming.on("child_added", snap => {
                var dataSet = [
                    snap.child("customer_name").val(),
                    snap.child("petname").val(),
                    snap.child("date").val(),
                    snap.child("preferred_time").val(),
                    snap.child("preferred_doctor").val(),
                    '<a class="btn btn-xs btn-social-icon btn-google btn-declined" data-key="'+snap.key+'" data-user_id="'+snap.child("user_id").val()+'" data-petname="'+snap.child("petname").val()+'" data-date="'+snap.child("date").val()+'"><i class="fa fa-times"></i></a><a class="btn btn-xs btn-social-icon btn-dropbox btn-update" data-key="'+snap.key+'" data-comment="'+snap.child("comment").val()+'" data-customer_name="'+snap.child("customer_name").val()+'" data-customer_phone="'+snap.child("customer_phone").val()+'" data-date="'+snap.child("date").val()+'" data-petname="'+snap.child("petname").val()+'" data-preferred_doctor="'+snap.child("preferred_doctor").val()+'" data-preferred_time="'+snap.child("preferred_time").val()+'" data-service="'+snap.child("service").val()+'" data-user_id="'+snap.child("user_id").val()+'"><i class="fa fa-pencil"></i></a><a class="btn btn-xs btn-social-icon btn-google btn-delete" data-key="'+snap.key+'" data-user_id="'+snap.child("user_id").val()+'"><i class="fa fa-trash-o"></i></a>'];
                table_upcoming.rows.add([dataSet]).draw().nodes().to$()
                    .each(function() {
                        $(this).attr('id', snap.key);
                    });
            });

            rootRefUpcoming.on("child_changed", snap => {
                $("#upcoming #"+ snap.key).html('<td>'+snap.child("customer_name").val()+'</td><td>'+snap.child("petname").val()+'</td><td>'+snap.child("date").val()+'</td><td>'+snap.child("preferred_time").val()+'</td><td>'+snap.child("preferred_doctor").val()+'</td><td><a class="btn btn-xs btn-social-icon btn-google btn-declined" data-key="'+snap.key+'" data-user_id="'+snap.child("user_id").val()+'" data-petname="'+snap.child("petname").val()+'" data-date="'+snap.child("date").val()+'"><i class="fa fa-times"></i></a><a class="btn btn-xs btn-social-icon btn-dropbox btn-update" data-key="'+snap.key+'" data-comment="'+snap.child("comment").val()+'" data-customer_name="'+snap.child("customer_name").val()+'" data-customer_phone="'+snap.child("customer_phone").val()+'" data-date="'+snap.child("date").val()+'" data-petname="'+snap.child("petname").val()+'" data-preferred_doctor="'+snap.child("preferred_doctor").val()+'" data-preferred_time="'+snap.child("preferred_time").val()+'" data-service="'+snap.child("service").val()+'" data-user_id="'+snap.child("user_id").val()+'"><i class="fa fa-pencil"></i></a><a class="btn btn-xs btn-social-icon btn-google btn-delete" data-key="'+snap.key+'" data-user_id="'+snap.child("user_id").val()+'"><i class="fa fa-trash-o"></i></a></td>');
            });

            rootRefUpcoming.on("child_removed", snap => {
                $("#upcoming #"+ snap.key).remove();
            });

            //UPCOMING APPOINTMENTS


            //CANCELLED APPOINTMENTS

            var table_cancelled = $('#cancelled').DataTable ( {
                "bFilter": false,
                "bInfo" : false,
                'paging'      : true,
                'lengthChange': false,
                'searching'   : true,
                'ordering'    : true,
                'autoWidth'   : false
            } );

            var rootRefCancelled = firebase.database().ref('Appointments/').orderByChild('status').startAt("cancelled").endAt("cancelled");

            rootRefCancelled.on("child_added", snap => {
                var dataSet = [
                    snap.child("customer_name").val(),
                    snap.child("petname").val(),
                    snap.child("date").val(),
                    snap.child("preferred_time").val(),
                    snap.child("preferred_doctor").val(),
                    '<a class="btn btn-xs btn-social-icon btn-google btn-declined" data-key="'+snap.key+'" data-user_id="'+snap.child("user_id").val()+'" data-petname="'+snap.child("petname").val()+'" data-date="'+snap.child("date").val()+'"><i class="fa fa-times"></i></a><a class="btn btn-xs btn-social-icon btn-dropbox btn-update" data-key="'+snap.key+'" data-comment="'+snap.child("comment").val()+'" data-customer_name="'+snap.child("customer_name").val()+'" data-customer_phone="'+snap.child("customer_phone").val()+'" data-date="'+snap.child("date").val()+'" data-petname="'+snap.child("petname").val()+'" data-preferred_doctor="'+snap.child("preferred_doctor").val()+'" data-preferred_time="'+snap.child("preferred_time").val()+'" data-service="'+snap.child("service").val()+'" data-user_id="'+snap.child("user_id").val()+'"><i class="fa fa-pencil"></i></a><a class="btn btn-xs btn-social-icon btn-google btn-delete" data-key="'+snap.key+'" data-user_id="'+snap.child("user_id").val()+'"><i class="fa fa-trash-o"></i></a>'];
                table_cancelled.rows.add([dataSet]).draw().nodes().to$()
                    .each(function() {
                        $(this).attr('id', snap.key);
                    });
            });

            rootRefCancelled.on("child_changed", snap => {
                $("#declined #"+ snap.key).html('<td>'+snap.child("customer_name").val()+'</td><td>'+snap.child("petname").val()+'</td><td>'+snap.child("date").val()+'</td><td>'+snap.child("preferred_time").val()+'</td><td>'+snap.child("preferred_doctor").val()+'</td><td><a class="btn btn-xs btn-social-icon btn-google btn-declined" data-key="'+snap.key+'" data-user_id="'+snap.child("user_id").val()+'" data-petname="'+snap.child("petname").val()+'" data-date="'+snap.child("date").val()+'"><i class="fa fa-times"></i></a><a class="btn btn-xs btn-social-icon btn-dropbox btn-update" data-key="'+snap.key+'" data-comment="'+snap.child("comment").val()+'" data-customer_name="'+snap.child("customer_name").val()+'" data-customer_phone="'+snap.child("customer_phone").val()+'" data-date="'+snap.child("date").val()+'" data-petname="'+snap.child("petname").val()+'" data-preferred_doctor="'+snap.child("preferred_doctor").val()+'" data-preferred_time="'+snap.child("preferred_time").val()+'" data-service="'+snap.child("service").val()+'" data-user_id="'+snap.child("user_id").val()+'"><i class="fa fa-pencil"></i></a><a class="btn btn-xs btn-social-icon btn-google btn-delete" data-key="'+snap.key+'" data-user_id="'+snap.child("user_id").val()+'"><i class="fa fa-trash-o"></i></a></td>');
            });

            rootRefCancelled.on("child_removed", snap => {
                $("#declined #"+ snap.key).remove();
            });

            //CANCELLED APPOINTMENTS

            $('body').delegate('.btn-update','click',function(){

                $('.modal-title').text('Update Appointment');

                var key = $(this).data('key');

                var comment = $(this).data('comment');
                var customer_name = $(this).data('customer_name');
                var customer_phone = $(this).data('customer_phone');
                var date = $(this).data('date');
                var petname = $(this).data('petname');
                var preferred_doctor = $(this).data('preferred_doctor');
                var preferred_time = $(this).data('preferred_time');
                var service = $(this).data('service');

                $("#comment").val(comment);
                $("input[name=customer_name]").val(customer_name);
                $("input[name=customer_phone]").val(customer_phone);
                $("input[name=date]").val(date);
                $("input[name=petname]").val(petname);
                $("input[name=preferred_doctor]").val(preferred_doctor);

                $('#preferred_time option[value="'+preferred_time+'"]').attr('selected','selected');
                $('#service option[value="'+service+'"]').attr('selected','selected');


                $('#key').val(key);
                $('#type').val('update');

                $('#appointment_modal').modal('show');

            });

            $('#save_appointment').on('click',function(){

                if($('#appointments_form').valid()){

                    var params = {
                        comment: $("#comment").val(),
                        customer_name: $("input[name=customer_name]").val(),
                        customer_phone: $("input[name=customer_phone]").val(),
                        date: $("input[name=date]").val(),
                        petname: $("input[name=petname]").val(),
                        preferred_doctor: $("input[name=preferred_doctor]").val(),
                        preferred_time: $("#preferred_time").val(),
                        service: $("#service").val()
                    };

                    var path = 'Appointments';
                    var text = '';
                    var text1 = '';

                    if($('#type').val() == 'update'){
                        text = "Edit Appointment";
                        text1 = 'updated';
                        var key =  $('#key').val();
                        updateFirebase(key,path,params);
                    }else{
                        text = "Add Appointment";
                        text1 = 'added';
                        addFirebase(path,params);
                    }

                    $('#appointment_modal').modal('hide');

                    swal({
                        title: text,
                        text: "Appointment successfully "+text1,
                        icon: "success",
                    });

                    $('#appointments_form')[0].reset();

                }

            })


            $('body').delegate('.btn-delete','click',function(){

                var key = $(this).data('key');
                var path_appointment = 'Appointments';

                var user_id = $(this).data('user_id');

                var path_user_appointment = 'User_appointments';


                swal({
                    title: "Are you sure?",
                    text: "you want to delete this appointment",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            removeFirebase(key,path_appointment)
                            firebase.database().ref('/'+path_user_appointment+'/'+ user_id + '/' + key).remove()
                        }
                    });
            });

        });
    </script>

@endpush

@section('title')

@endsection

@section('content')

    <input type="hidden" id="count_notifications">

    <section class="content-header">
        <h1>
            Appointments Information
            <small>list of appointment</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Appointments</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Custom Tabs -->
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab_1" data-toggle="tab">Appointments</a></li>
                                        <li><a href="#tab_2" data-toggle="tab">Pending</a></li>
                                        <li><a href="#tab_3" data-toggle="tab">Upcoming</a></li>
                                        <li><a href="#tab_4" data-toggle="tab">Cancelled</a></li>
                                    </ul>
                                    <!-- /.tab-pane -->

                                    <div class="tab-content">

                                        <div class="tab-pane active" id="tab_1">
                                            <table id="appointments_table" class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>Customer Name</th>
                                                    <th>Pet Name</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Doctor</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="tab-pane" id="tab_2">
                                            <table id="pending" class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>Customer Name</th>
                                                    <th>Pet Name</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Doctor</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="tab_3">
                                            <table id="upcoming" class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>Customer Name</th>
                                                    <th>Pet Name</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Doctor</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="tab_4">
                                            <table id="cancelled" class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>Customer Name</th>
                                                    <th>Pet Name</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Doctor</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.tab-pane -->


                                    </div>
                                    <!-- /.tab-content -->
                                </div>
                                <!-- nav-tabs-custom -->
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

    <div class="modal fade" id="appointment_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Appointment</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="box box-primary">
                            <!-- form start -->
                            <form role="form" id="appointments_form">
                                <input type="hidden" id="key">
                                <input type="hidden" id="type">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Date:</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" name="date" id="datepicker">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <div class="form-group">
                                        <label for="preferred_time">Preferred Time</label>
                                        <select class="form-control" name="preferred_time" id="preferred_time" required>
                                            <option value="">Select Time</option>
                                            <option value="07:30-08:00">07:30-8:00</option>
                                            <option value="08:00-09:00">08:00-09:00</option>
                                            <option value="09:00-10:00">09:00-10:00</option>
                                            <option value="10:00-11:00">10:00-11:00</option>
                                            <option value="11:00-12:00">11:00-12:00</option>
                                            <option value="12:00-13:00">12:00-13:00</option>
                                            <option value="13:00-14:00">13:00-14:00</option>
                                            <option value="14:00-15:00">14:00-15:00</option>
                                            <option value="15:00-16:00">15:00-16:00</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="petname">Pet Name</label>
                                        <input type="text" class="form-control" name="petname" placeholder="Enter Name" required="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="customer_name">Customer Name</label>
                                        <input type="text" class="form-control" name="customer_name" placeholder="Enter Name" required="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="customer_phone">Customer Phone</label>
                                        <input type="text" class="form-control" name="customer_phone" placeholder="Enter Phone" required="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="preferred_doctor">Preferred Doctor</label>
                                        <input type="text" class="form-control" name="preferred_doctor" placeholder="Enter Doctor" required="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="service">Type of service</label>
                                        <select class="form-control" name="service" id="service" required>
                                            <option value="">Select Service</option>
                                            <option value="Grooming">Grooming</option>
                                            <option value="Nail Trim">Nail Trim</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Comment</label>
                                        <textarea class="form-control" id="comment" rows="3" placeholder="Enter Comment" required="true"></textarea>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save_appointment">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection