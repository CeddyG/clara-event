@extends('admin/dashboard')

@section('CSS')
    <!-- Select 2 -->
    {!! Html::style('bower_components/select2/dist/css/select2.min.css') !!}
    
    <!-- Full Calendar -->
    {!! Html::style('bower_components/fullcalendar/dist/fullcalendar.min.css') !!}
    {!! Html::style('bower_components/fullcalendar/dist/fullcalendar.print.min.css', ['media' => 'print']) !!}
    
    <!-- daterange picker -->
    {!! Html::style('bower_components/bootstrap-daterangepicker/daterangepicker.css') !!}
    
    <style>
        .select2
        {
            width: 100% !important
        }
        
        .input-group
        {
            width: 100% !important
        }
        
        .input-group-addon:hover
        {
            color: black;
        }
        
        #color-viewer-container
        {
            width: 35px;
            margin-bottom: 8px;
            border: 1px solid #d2d6de;
            padding: 8px;
        }
        
        #color-viewer-modal
        {
            width: 16px;
            height: 16px;
        }
        
        .external-event
        {
            color: #ffffff;
        }
        
        .btn-delete-category
        {
            color: white;
            float: right;
            cursor: pointer;
        }
        
        #error-store
        {
            color: #dd4b39;
        }
    </style>
@stop

@section('content')

    <div class="row">
        <div class="col-md-3">
            
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h4 class="box-title">{{ __('clara-event::event.type_event') }}</h4>
                </div>
                <div class="box-body">
                    <!-- the events -->
                    <div id="external-events">
                        @foreach ($oCategories as $oCategory)
                        <div class="external-event"
                            data-id="{{ $oCategory->id_event_category }}"
                            style="
                                background-color: {{ $oCategory->color_event_category }}; 
                                border-color: {{ $oCategory->color_event_category }}">
                            {{ $oCategory->name_event_category }}
                            <span data-id="{{ $oCategory->id_event_category }}" class="glyphicon glyphicon-trash btn-delete-category"></span>
                        </div>
                        @endForeach
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
            
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ __('clara-event::event.create_event') }}</h3>
                </div>
                <div class="box-body">
                    <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                        <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                        <ul class="fc-color-picker" id="color-chooser">
                            <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
                        </ul>
                    </div>
                    <!-- /btn-group -->
                    <div class="input-group">
                        <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                        <div class="input-group-btn">
                            <button id="add-new-event" type="button" class="btn btn-primary btn-flat">{{ __('clara-event::event.add') }}</button>
                        </div>
                        <!-- /btn-group -->
                    </div>
                    <!-- /input-group -->
                    <p class="help-block" id="error-store"></p>
                </div>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-body no-padding">
                    <!-- THE CALENDAR -->
                    <div id="calendar"></div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      
    <div class="modal fade" id="modal-info">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                {!! BootForm::open() !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{ __('clara-event::event.event') }}</h4>
                </div>
                <div class="modal-body">
                    {!! BootForm::hidden('id_event')->id('id_event') !!}
                    {!! BootForm::hidden('id_event_calendar')->id('id_event_calendar') !!}
                    {!! BootForm::text(__('clara-event::event.type_event'), 'event_type')->disable() !!}
                    {!! BootForm::text(__('clara-event::event.name_event'), 'name_event') !!}
                    {!! BootForm::textarea(__('clara-event::event.description_event'), 'description_event')->addClass('ckeditor') !!}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! BootForm::label(__('clara-event::event.color_event'))->forId('color_event')->class('control-label') !!}
                                {!! BootForm::hidden('color_event')->id('color_event') !!}

                                <div id="color-viewer-container">
                                    <div id="color-viewer-modal"></div>
                                </div>

                                <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                    <ul class="fc-color-picker" id="color-chooser-modal">
                                        <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
                                        <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                                        <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
                                        <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
                                        <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                                        <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
                                        <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                                        <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                                        <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                                        <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                                        <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                                        <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            {!! BootForm::inputGroup(__('clara-event::event.date'), 'date_event')
                                ->type('text')
                                ->class('daterange form-control')
                                ->beforeAddon('<i class="fa fa-calendar"></i>') 
                            !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ __('general.close') }}</button>
                    <button type="button" class="btn btn-danger" id="delete-btn">{{ __('general.delete') }}</button>
                    <button type="button" class="btn btn-primary" id="update-btn">{{ __('general.save') }}</button>
                </div>
                {!! BootForm::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@section('JS')
    <!-- Select 2 -->
    {!! Html::script('bower_components/select2/dist/js/select2.full.min.js') !!}
    
    <!-- Full Calendar -->
    {!! Html::script('bower_components/jquery-ui/jquery-ui.min.js') !!}
    {!! Html::script('bower_components/moment/moment.js') !!}
    {!! Html::script('bower_components/fullcalendar/dist/fullcalendar.min.js') !!}
    {!! Html::script('bower_components/fullcalendar/dist/locale-all.js') !!}
    
    <!-- date-range-picker -->
    {!! Html::script('bower_components/moment/min/moment.min.js') !!}
    {!! Html::script('bower_components/moment/locale/fr.js') !!}
    {!! Html::script('bower_components/bootstrap-daterangepicker/daterangepicker.js') !!}
    
    <script type="text/javascript">
        $('.select2').select2();
        
        //date-range-picker
        $('.daterange').daterangepicker({
            timePicker: true,
            timePicker24Hour: true,
            drops: 'up',
            locale: {
                format: 'DD/MM/YYYY H:mm'
            }
        });
        
        $(function () {

            /* initialize the external events
             -----------------------------------------------------------------*/
            function init_events(ele) {
                ele.each(function () {

                    // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                    // it doesn't need to have a start or end
                    var eventObject = {
                        title: $.trim($(this).text()), // use the element's text as the event title
                        type_name: $.trim($(this).text()),
                        id_event_category: $(this).data('id')
                    };

                    // store the Event Object in the DOM element so we can get to it later
                    $(this).data('eventObject', eventObject);

                    // make the event draggable using jQuery UI
                    $(this).draggable({
                        zIndex        : 1070,
                        revert        : true, // will cause the event to go back to its
                        revertDuration: 0  //  original position after the drag
                    });

                });
            }

            init_events($('#external-events div.external-event'));

            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date();
            var d    = date.getDate(),
                m    = date.getMonth(),
                y    = date.getFullYear();
                
            $('#calendar').fullCalendar({
                locale: 'fr',
                header    : {
                    left  : 'prev,next today',
                    center: 'title',
                    right : 'month,agendaWeek,agendaDay'
                },
                buttonText: {
                    today: 'aujourd\'hui',
                    month: 'mois',
                    week : 'semaine',
                    day  : 'jour'
                },
                events    : '{{ route('api.admin.event.index') }}',
                editable  : true,
                droppable : true, // this allows things to be dropped onto the calendar !!!
                drop      : function (date, allDay) { // this function is called when something is dropped

                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');

                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);

                    // assign it the date that was reported
                    copiedEventObject.start             = date.time('08:00:00');
                    copiedEventObject.end               = date.clone().time('17:00:00');
                    copiedEventObject.allDay            = allDay;
                    copiedEventObject.backgroundColor   = $(this).css('background-color');
                    copiedEventObject.borderColor       = $(this).css('background-color');
                    copiedEventObject.color_event       = $(this).css('background-color');

                    $.ajax
                    ({
                        url: '{{ route('api.admin.event.store') }}',
                        type: 'POST',    
                        async: false,
                        data: { 
                            'fk_event_category': copiedEventObject.id_event_category,
                            'date_begin': date.format('Y-M-D 08:00:00'),
                            'date_end': date.format('Y-M-D 17:00:00'), 
                            'color_event': $(this).css('background-color') 
                        },
                        success: function (response)
                        {
                            copiedEventObject.id_event = response.id;
                        }
                    });

                    // render the event on the calendar
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject);

                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove();
                    }
                },
                eventDrop: function(event, delta, revertFunc) {
                    var url = '{{ route('api.admin.event.update', 'dummyId') }}';

                    url = url.replace('dummyId', event.id_event);

                    $.ajax
                    ({
                        url: url,
                        type: 'PUT',
                        data: { 
                            'id_event': event.id_event, 
                            'date_begin': event.start.format('Y-M-D H:mm:00'),
                            'date_end': event.end.format('Y-M-D H:mm:00') 
                        },
                        success: function (response)
                        {
                            
                        }
                    });

                },
                eventClick: function(calEvent, jsEvent, view) {
                    
                    $('#color-viewer-modal').css('background-color', calEvent.color_event);
                    
                    $('#id_event').val(calEvent.id_event);
                    $('#id_event_calendar').val(calEvent._id);
                    $('#event_type').val(calEvent.type_name);
                    $('#name_event').val(calEvent.name_event);
                    $('#color_event').val(calEvent.color_event);
                    $('#date_event').data('daterangepicker').setStartDate(calEvent.start.format('D/M/Y H:mm'));
                    $('#date_event').data('daterangepicker').setEndDate(calEvent.end.format('D/M/Y H:mm'));
                    
                    CKEDITOR.instances['description_event'].setData(calEvent.description_event);
                    
                    $('#modal-info').modal();
                }
            });
            
            //Update event
            $('#update-btn').on('click', function(){
                var url = '{{ route('api.admin.event.update', 'dummyId') }}';

                url = url.replace('dummyId', $('#id_event').val());
                
                $.ajax
                ({
                    url: url,
                    type: 'PUT',
                    data: { 
                        'id_event': $('#id_event').val(), 
                        'name_event': $('#name_event').val(),
                        'date_begin': $('#date_event').data('daterangepicker').startDate.format('YYYY-MM-DD H:mm:00'),
                        'date_end': $('#date_event').data('daterangepicker').endDate.format('YYYY-MM-DD H:mm:00'),
                        'color_event': $('#color_event').val(),
                        'description_event': CKEDITOR.instances['description_event'].getData()
                    },
                    success: function (response)
                    {
                        var aEvent = $('#calendar').fullCalendar('clientEvents', function(event){
                            return event._id === $('#id_event_calendar').val();
                        });
                        
                        var oEvent = aEvent[0];
                        
                        oEvent.title             = oEvent.type_name+' - '+$('#name_event').val();
                        oEvent.name_event        = $('#name_event').val();
                        oEvent.description_event = CKEDITOR.instances['description_event'].getData();
                        oEvent.start             = $('#date_event').data('daterangepicker').startDate.format('YYYY-MM-DD H:mm:00');
                        oEvent.end               = $('#date_event').data('daterangepicker').endDate.format('YYYY-MM-DD H:mm:00');
                        oEvent.backgroundColor   = $('#color_event').val();
                        oEvent.borderColor       = $('#color_event').val();
                        oEvent.color_event       = $('#color_event').val();
                        
                        $('#calendar').fullCalendar('updateEvent', oEvent);
                        $('#calendar').fullCalendar('refetchEvents');
                        
                        $('#modal-info').modal('hide');
                    }
                });                
            });
            
            //Delete event
            $('#delete-btn').on('click', function(){
                var url = '{{ route('api.admin.event.destroy', 'dummyId') }}';
                url = url.replace('dummyId', $('#id_event').val());

                $.ajax
                ({
                    url: url,
                    type: 'DELETE',
                    success: function (response)
                    {
                        console.log($('#id_event_calendar').val());
                        $('#calendar').fullCalendar('removeEvents', function(event){
                            return event._id === $('#id_event_calendar').val();
                        });
                        
                        $('#modal-info').modal('hide');
                    }
                });
            });

            /* ADDING EVENTS */
            var currColor = '#3c8dbc'; //Red by default
            //Color chooser button
            var colorChooser = $('#color-chooser-btn');
            $('#color-chooser > li > a').click(function (e) {
                e.preventDefault();
                //Save color
                currColor = $(this).css('color');
                //Add color effect to button
                $('#add-new-event').css({
                    'background-color': currColor, 
                    'border-color': currColor 
                });
            });
            
            //Add a category
            $('#add-new-event').click(function (e) {
                e.preventDefault();
                //Get value and make sure it is not null
                var val = $('#new-event').val();
                if (val.length == 0) {
                    return;
                }
                
                $.post(
                    '{{ route('api.admin.event-category.store') }}', 
                    {
                        name_event_category: val,
                        color_event_category: currColor
                    },
                )
                .done(function(data) {
                    //Create events
                    var event = $('<div />');
                    event.css({
                        'background-color': currColor,
                        'border-color'    : currColor,
                        'color'           : '#fff'
                    }).addClass('external-event');
                    
                    event.attr('data-id', data.id);
                    
                    event.html(val+'<span data-id="'+data.id+'" class="glyphicon glyphicon-trash btn-delete-category"></span>');
                    
                    $('#external-events').prepend(event);

                    //Add draggable funtionality
                    init_events(event);

                    //Remove event from text input
                    $('#new-event').val('');
                    
                    $('#error-store').html('');
                })
                .fail(function(oXhr){
                    var sMessage = '';
                    var sReturnMessage = oXhr.responseJSON;
                    
                    $.each(sReturnMessage.errors, function(index, value) {
                        sMessage += index+': '+value+'<br />';
                    }); 
                    
                    $('#error-store').html(sMessage);
                });
            });
            
            //Delete a category
            $('#external-events').on('click', '.btn-delete-category', function(){
                var btn = $(this);
                var id = btn.data('id');
                
                var url = '{{ route('api.admin.event-category.destroy', 'dummyId') }}';
                url = url.replace('dummyId', id);

                $.ajax
                ({
                    url: url,
                    type: 'DELETE',
                    success: function (response)
                    {
                        btn.closest('.external-event').remove();
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        var curentColor = $('input[name=color]').val();
        
        if (curentColor != '')
        {
            $('#color-viewer').addClass('bg-'+curentColor);
        }
        
        $('#color-chooser-modal > li > a').click(function (e) {
            e.preventDefault();
            
            var currColor = $(this).css('color');
            
            $('#color-viewer-modal').css('background-color', currColor);
            
            $('input[name=color_event]').val(currColor);
        });
    </script>

    {!! Html::script('bower_components/ckeditor/ckeditor.js') !!}
    
    <script>
        $(function () {
          // Replace the <textarea id="editor1"> with a CKEditor
          // instance, using default configuration.
          CKEDITOR.replace('.ckeditor');
        });
    </script>
@endsection
