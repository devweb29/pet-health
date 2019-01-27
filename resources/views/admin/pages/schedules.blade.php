@extends('admin.layouts.index')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.css" />
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.23.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.js"></script>
    <script>
        $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var base_url = $('#base_url').val();
            // page is now ready, initialize the calendar...

            // page is now ready, initialize the calendar...
            $('#schedules').fullCalendar({
                editable: true,
                eventDrop: function(event, delta, revertFunc) {

                    $.ajax({
                        url: base_url + '/admin/doctor/schedule/change',
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: event.id,
                            start: event.start.format()
                        },
                        success: function (response) {

                            swal({
                                title: 'Change Schedule Date',
                                text: event.title + " was dropped on " + event.start.format(),
                                icon: "success",
                            })

                        }

                    });

                },
                events : [
                        @foreach($schedules as $schedule)
                    {
                        id : '{{$schedule->id}}',
                        title : '{{ $schedule->title}}',
                        start : '{{ $schedule->start }}',
                        description : '{{ $schedule->description }}',
                        time : '{{ $schedule->time }}',
                    },
                        @endforeach
                ],
                dayClick: function(date, jsEvent, view) {

                    var date_selected = date.format();

                    $('#start').val(date_selected);

                    $('#schedule_modal').modal('show');
                    $('#type').val('create');
                },
                eventClick: function(calEvent, jsEvent, view) {

                    $('.modal-title').text('Edit Schedule')
                    $("input[name=id]").val(calEvent.id);
                    $("input[name=title]").val(calEvent.title);
                    $('#time option[value="'+calEvent.time+'"]').attr('selected','selected');
                    $("#description").val(calEvent.description);
                    $('#schedule_modal').modal('show');
                    $('#type').val('update');

                },
            });


            $('#save_schedule').on('click',function(){

                if($('#schedule_form').valid()){

                    var type = $('#type').val();


                    if(type == 'create'){
                        $.ajax({
                            url: base_url + '/admin/doctor/schedule/add',
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                doctor_key: $("input[name=doctor_key]").val(),
                                title: $("input[name=title]").val(),
                                description: $('#description').val(),
                                start: $("input[name=start]").val(),
                                time: $('#time').val()
                            },
                            success: function (response) {

                                $('#schedule_modal').modal('hide');

                                swal({
                                    title: 'Add Schedule',
                                    text: "Schedule successfully added",
                                    icon: "success",
                                }).then(function() {
                                    $('#schedule_form')[0].reset();
                                    location.reload();
                                })

                            }

                        });
                    }else{
                        $.ajax({
                            url: base_url + '/admin/doctor/schedule/edit',
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                id: $("input[name=id]").val(),
                                title: $("input[name=title]").val(),
                                description: $('#description').val(),
                                start: $("input[name=start]").val(),
                                time: $('#time').val()
                            },
                            success: function (response) {

                                $('#schedule_modal').modal('hide');

                                swal({
                                    title: 'Update Schedule',
                                    text: "Schedule successfully updated",
                                    icon: "success",
                                }).then(function() {
                                    $('#schedule_form')[0].reset();
                                    location.reload();
                                })

                            }

                        });
                    }

                }

            })

        });
    </script>
@endpush

@section('title')

@endsection

@section('content')

    <section class="content-header">
        <h1>
            Schedules Information
            <small>list of schedule</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Schedules</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id='schedules'></div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

    <div class="modal fade" id="schedule_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Schedule</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="box box-primary">
                            <!-- form start -->
                            <form role="form" id="schedule_form">
                                <input type="hidden" name="doctor_key" value="{{$doctor_id}}">
                                <input type="hidden" name="id">
                                <input type="hidden" name="type" id="type" value="add">
                                <input type="hidden" name="start" id="start">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Title</label>
                                        <input type="text" class="form-control" name="title" placeholder="Enter Title" required="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Time</label>
                                        <select class="form-control" name="time" id="time" required>
                                            <option value="">Select Time</option>
                                            <option value="07:30-8:00">07:30-8:00</option>
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
                                        <label>Description</label>
                                        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter Description" required="true"></textarea>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save_schedule">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@endsection