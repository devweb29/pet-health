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

@endsection

@section('content')

    <section class="content-header">
        <h1>
            Accounts Information
            <small>list of account</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Accounts</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <p><button type="button" class="btn btn-block btn-primary" id="account_btn">Add Account</button></p>
                        <table id="accounts" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{($user->user_type == 2) ? 'Doctor' : 'Staff'}}</td>
                                        <td>
                                            <a class="btn btn-xs btn-social-icon btn-dropbox btn-update" data-user_id="{{$user->id}}" data-name="{{$user->name}}" data-email="{{$user->email}}" data-user_type="{{$user->user_type}}"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-xs btn-social-icon btn-google btn-delete" data-user_id="{{$user->id}}"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
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

    <div class="modal fade" id="account_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Account</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="box box-primary">
                            <!-- form start -->
                            <form role="form" id="account_form">
                                <div class="box-body">
                                    <input type="hidden" id="type">
                                    <input type="hidden" id="user_id">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Account Type</label>
                                        <select class="form-control" name="account_type" id="account_type" required>
                                            <option value="">Select Type</option>
                                            <option value="2">Doctor</option>
                                            <option value="3">Staff</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter Name" required="true">
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" name="email" placeholder="Enter Email" required="true">
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_password">Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm_password" placeholder="Enter Confirm Password" required="true">
                                    </div>

                                </div>
                                <!-- /.box-body -->
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save_account">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- /.modal -->
@endsection