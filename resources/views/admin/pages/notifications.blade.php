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

            jQuery('#account_form').validate({
                rules : {
                    confirm_password : {
                        equalTo : "#password"
                    }
                }
            });

            $('#accounts').DataTable ( {
                "bFilter": false,
                "bInfo" : false,
                'paging'      : true,
                'lengthChange': false,
                'searching'   : true,
                'ordering'    : true,
                'autoWidth'   : false
            } );


            //show modal on click
            $('#account_btn').on('click',function(){

                $('#account_form')[0].reset();

                $("input[name=password]").attr('required','required');
                $("input[name=confirm_password]").attr('required','required');

                $('#type').val('add');
                $('#account_modal').modal('show');
                $('.modal-title').text('Add Account')
            });

            $('body').delegate('.btn-update','click',function(){

                $('.modal-title').text('Update Account')

                var name = $(this).data('name');
                var email = $(this).data('email');
                var user_type = $(this).data('user_type');
                var user_id = $(this).data('user_id');

                $("#user_id").val(user_id);
                $("input[name=name]").val(name);
                $("input[name=email]").val(email);
                $('#account_type option[value="'+user_type+'"]').attr('selected','selected');

                $("input[name=password]").removeAttr('required','required');
                $("input[name=confirm_password]").removeAttr('required','required');

                $('#type').val('update');
                $('#account_modal').modal('show');
            });

            $('body').delegate('.btn-delete','click',function(){

                var user_id = $(this).data('user_id');

                swal({
                    title: "Are you sure?",
                    text: "you want to delete this account",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {

                            $.ajax({
                                url: base_url + '/admin/account/delete',
                                type: "POST",
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    user_id: user_id
                                },
                                success: function (response) {

                                    location.reload();

                                }

                            });

                        }
                    });

            });

            $('#save_account').on('click',function(){

                if($('#account_form').valid()){

                    if($('#type').val() == 'update'){

                        $.ajax({
                            url: base_url + '/admin/account/update',
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                user_id: $("#user_id").val(),
                                name: $("input[name=name]").val(),
                                email: $("input[name=email]").val(),
                                password: $("input[name=password]").val(),
                                user_type: $('#account_type').val()
                            },
                            success: function (response) {

                                $('#account_modal').modal('hide');

                                swal({
                                    title: 'Update Account',
                                    text: "Account successfully updated",
                                    icon: "success",
                                }).then(function() {
                                    $('#account_form')[0].reset();
                                    location.reload();
                                })

                            }

                        });

                    }else{


                        $.ajax({
                            url: base_url + '/admin/account/add',
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                name: $("input[name=name]").val(),
                                email: $("input[name=email]").val(),
                                password: $("input[name=password]").val(),
                                user_type: $('#account_type').val()
                            },
                            success: function (response) {

                                $('#account_modal').modal('hide');

                                swal({
                                    title: 'Add Account',
                                    text: "Account successfully added",
                                    icon: "success",
                                }).then(function() {
                                    $('#account_form')[0].reset();
                                    location.reload();
                                })

                            }

                        });

                    }


                    $('#account_form')[0].reset();

                }

            })

        })
    </script>
@endpush

@section('title')
Notifications
@endsection

@section('content')

    <section class="content-header">
        <h1>
            Notifications Information
            <small>list of notiifcation</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Notifications</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Notification</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <tbody>
                            <tr>
                                <td><div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div></td>
                                <td class="mailbox-name"><a href="read-mail.html">John Doe</a></td>
                                <td class="mailbox-subject"><b>Appointment</b> - John Doe set an appointment for tootshie on 12/12/2019
                                </td>
                              {{--  <td class="mailbox-attachment"></td>
                                <td class="mailbox-date">5 mins ago</td>--}}
                            </tr>
                            </tbody>
                        </table>
                        <!-- /.table -->
                    </div>
                    <!-- /.mail-box-messages -->
                </div>
            </div>
        </div>
    </div>
    </section>


@endsection