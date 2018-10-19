@extends('admin/dashboard')

@section('CSS')
    <!-- Select 2 -->
    {!! Html::style('bower_components/select2/dist/css/select2.min.css') !!}

    <style>
        .input-group-addon:hover
        {
            color: black;
        }
    </style>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <br>
            <div class="box box-info">	
                <div class="box-header with-border">
                    @if(isset($oItem))
                        <h3 class="box-title">Modification</h3>
                    @else
                        <h3 class="box-title">Ajouter</h3>
                    @endif
                </div>
                <div class="box-body"> 
                    @if(isset($oItem))
                        {!! BootForm::open()->action( route('admin.event.update', $oItem->id_event) )->put() !!}
                        {!! BootForm::bind($oItem) !!}
                    @else
                        {!! BootForm::open()->action( route('admin.event.store') )->post() !!}
                    @endif

                        
                        @if(isset($oItem))
                            {!! BootForm::select(trans('event-category.event_category'), 'fk_event_category')
                                ->class('select2 form-control')
                                ->options([$oItem->fk_event_category => $oItem->event_category->name_event_category])
                                ->data([
                                    'url-select'    => route('admin.event-category.select.ajax'), 
                                    'url-create'    => route('admin.event-category.create'),
                                    'field'         => 'name_event_category'
                            ]) !!}
                        @else
                            {!! BootForm::select(trans('event-category.event_category'), 'fk_event_category')
                                ->class('select2 form-control')
                                ->data([
                                    'url-select'    => route('admin.event-category.select.ajax'), 
                                    'url-create'    => route('admin.event-category.create'),
                                    'field'         => 'name_event_category'
                            ]) !!}
                        @endif

                        {!! BootForm::text(trans('event.name_event'), 'name_event') !!}
                        {!! BootForm::text(trans('event.date_begin'), 'date_begin') !!}
                        {!! BootForm::text(trans('event.date_end'), 'date_end') !!}
                        {!! BootForm::text(trans('event.color_event'), 'color_event') !!}
                        {!! BootForm::textarea(trans('event.description_event'), 'description_event')->addClass('ckeditor') !!}
                        

                    {!! BootForm::submit('Envoyer', 'btn-primary')->addClass('pull-right') !!}

                    {!! BootForm::close() !!}
                </div>
            </div>
            <a href="javascript:history.back()" class="btn btn-primary">
                    <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
            </a>
        </div>
    </div>
@stop

@section('JS')
    <!-- Select 2 -->
    {!! Html::script('bower_components/select2/dist/js/select2.full.min.js') !!}
    
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').wrap('<div class="input-group input-group-select2"></div>');
            $( ".input-group-select2" ).each(function () {
                var url = $(this).find('.select2').attr(('data-url-create'));
                $(this).prepend('<a href="'+ url +'" target="_blank" class="input-group-addon"><i class="glyphicon glyphicon-plus"></i></a>');
            });
            
            $('.select2').select2({
                ajax: {
                    url: function () {
                        return $(this).attr('data-url-select');
                    },
                    dataType: 'json',
                    delay: 10,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            field: $(this).attr('data-field'),
                            page: params.page
                        };
                    },
                    processResults: function (data, params) {
                        // parse the results into the format expected by Select2.
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data
                        params.page = params.page || 1;
                
                        return {
                            results: data.items,
                            pagination: {
                                more: (params.page * 30) < data.total_count 
                }
                        };
                    },
                    cache: true
                },
                them: 'bootstrap'
            });
        } );
    </script> 

    {!! Html::script('bower_components/ckeditor/ckeditor.js') !!}
    
    <script>
        $(function () {
          // Replace the <textarea id="editor1"> with a CKEditor
          // instance, using default configuration.
          CKEDITOR.replace('.ckeditor');
        });
    </script>

@stop