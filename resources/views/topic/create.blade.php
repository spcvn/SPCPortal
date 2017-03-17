@extends('layouts.app')

@section('page-title', trans('app.topic'))

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                @if ($edit)
                    @lang('app.edit_topic')
                @else
                    @lang('app.add_topic')
                @endif
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                        <li><a href="{{ route('topic.list') }}">@lang('app.topic')</a></li>
                        <li class="active">
                            @if ($edit)
                                @lang('app.edit_topic')
                            @else
                                @lang('app.add_topic')
                            @endif
                        </li>
                    </ol>
                </div>

            </h1>
        </div>
    </div>

    @include('partials.messages')

    @if ($edit)
        {!! Form::open(['route' => ['topic.edit', $topic->id], 'method' => 'PUT', 'files' => true, 'id' => 'topic-form']) !!}
    @else
        {!! Form::open(['route' => 'topic.create', 'files' => true, 'id' => 'topic-form']) !!}
    @endif
    <div class="add-new" id="add-new">
        <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{$user_login_id}}">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">@lang('app.topic_information')</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="category_id" class="required">@lang('app.category_name')</label>
                            {!! Form::select('category_id', $categories, $edit ? $topic->category_id : '', ['id' => 'category_id', 'class' => 'form-control', 'required' => true]) !!}
                        </div>
                        <div class="form-group">
                            <label for="name" class="required">@lang('app.topic_name')</label>
                            <input type="text" class="form-control" id="topic_name" placeholder="(@lang('app.topic_name'))" name="topic_name" value="{{ $edit ? $topic->topic_name : '' }}">
                        </div>

                        <div class="form-group">
                            <label for="picture">@lang('app.topic_picture')</label>
                            
                            @if ($edit && $topic->picture)
                                <br/>
                                <img class="form-control" style=" height: auto;" class="avatar avatar-preview img-circle" src="{{ url('/upload/topics/'. $topic->picture) }}">
                                <br/>
                            @endif

                            {!! Form::file('picture', ['id' => 'picture', 'class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <label for="description">@lang('app.description')</label>
                            <textarea name="description" id="description" rows="5" class="form-control">{{ $edit ? $topic->description : '' }}</textarea>
                        </div>
                    </div>
                </div>                
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">@lang('app.topic_options')</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="name">@lang('app.public')</label>
                            <br>
                            <input type="hidden" name="public" value="0">
                            <input type="checkbox" name="public" class="switch" value="1" data-on-text="@lang('app.yes')" data-off-text="@lang('app.no')" 
                                @if ($edit && $topic->public)
                                    {{ 'checked' }}
                                @else
                                    @if ($edit === false)
                                        {{'checked'}}
                                    @endif
                                @endif
                            >
                        </div>
                        <div class="form-group">
                            <label for="name">@lang('app.mentors')</label>
                            {!! Form::select('mentors[]', $users, $edit ? $userSelected : '', ['class' => 'form-control mentors select2', 'multiple' => 'true', 'style' => 'width: 100%;']) !!}
                        </div>

                        <div class="form-group">
                            <label for="tags">@lang('app.tag_name')</label>
                            {!! Form::select('tags[]', $tags, $edit ? $tagsSelected : '', ['class' => 'form-control tags select2', 'multiple' => 'true', 'style' => 'width: 100%;']) !!}
                        </div>

                        <div class="form-group">
                            <label for="picture">@lang('app.documents')</label>


                            @if ($edit && count(Storage::files('/upload/documents/' . $topic->encrypt_id)) > 0)
                                <button type="button" data-link="{{ route('topic.document', $topic->id) }}" class="btn show-document btn-success btn-circle"
                                   title="@lang('app.documents')" data-toggle="tooltip" data-placement="top"
                                   data-toggle="modal" data-target="#documentModal">
                                    <i class="fa fa-file-archive-o" aria-hidden="true"></i>
                                </button>
                            @endif



                            {!! Form::file('document[]', ['id' => 'document', 'class' => 'form-control', 'multiple' => 'true']) !!}
                        </div>

                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i>
                            @lang('app.save')
                        </button>
                    </div>
                </div>                
            </div>
        </div>

    </div>
    {!! Form::close() !!}

    <!-- Modal -->
    @include('topic.partials.modal')

@stop

@section('scripts')
    @if ($edit)
        {!! JsValidator::formRequest('SPCVN\Http\Requests\Topic\UpdateTopicRequest', '#topic-form') !!}
    @else
        {!! JsValidator::formRequest('SPCVN\Http\Requests\Topic\CreateTopicRequest', '#topic-form') !!}
    @endif

    {!! HTML::script('assets/plugins/bootstrap-switch/bootstrap-switch.min.js') !!}
    {!! HTML::style('assets/css/select2.min.css') !!}
    {!! HTML::script('assets/js/select2.full.js') !!}
    <script>
        $(".switch").bootstrapSwitch({size: 'small'});
        $('.mentors.select2').select2({
            placeholder: "@lang('app.topic_name')",
            minimumInputLength: 0,
            ajax: {
                url: "{{ route('user.search-user-by-name') }}",
                method: "POST",
                dataType: 'json',
                cache: false,
                data: function (params) {
                  return {
                    q: params.term
                  };
                },                
                processResults: function (data) {
                  return {
                    results: data
                  };
                }
            }
        });

        $('.tags.select2').select2({
            placeholder: "@lang('app.tag_name')",
            minimumInputLength: 0,
            ajax: {
                url: "{{ route('tag.find') }}",
                method: "GET",
                dataType: 'json',
                cache: false,
                data: function (params) {
                  return {
                    q: params.term
                  };
                },                
                processResults: function (data) {
                  return {
                    results: data
                  };
                }
            }
        });

        $(document).ready(function(){
            // load document to bootstrap modal
            $('.topic-table .show-document, #topic-form .show-document').on('click', function(e){
                var link = $(this).data('link');
                $('#documentModal').removeData('bs.modal');
                $('body').on('hidden.bs.modal', '.modal', function () {
                     $(this).removeData('bs.modal');
                });
                $('#documentModal').modal({remote: link});
                setTimeout(function(){
                    $('#documentModal').modal('show');
                }, 500);
            });
        });
    </script>
@stop

@section('styles')
    {!! HTML::style('assets/plugins/bootstrap-switch/bootstrap-switch.css') !!}
    {!! HTML::style('assets/plugins/select2/select2.min.css') !!}
@stop
