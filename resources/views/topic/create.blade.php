@extends('layouts.app')

@section('page-title', trans('app.topic'))

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                @lang('app.add_topic')
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                        <li><a href="{{ route('category.list') }}">@lang('app.topic')</a></li>
                        <li class="active">@lang('app.create')</li>
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
                            <label for="name" class="required">@lang('app.category_name')</label>
                            {!! Form::select('category_id', $categories, $edit ? $topic->category_id : '', ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label for="name" class="required">@lang('app.topic_name')</label>
                            <input type="text" class="form-control" id="topic_name" placeholder="(@lang('app.topic_name'))" name="topic_name" value="{{ $edit ? $topic->topic_name : '' }}">
                        </div>

                        <div class="form-group">
                            <label for="name">@lang('app.topic_picture')</label>
                            <input type="file" class="form-control" id="picture" placeholder="(@lang('app.topic_name'))" name="picture" value="{{ $edit ? $topic->topic_name : '' }}">
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
                            {!! Form::select('mentors[]', $users, $edit ? $userSelected : '', ['class' => 'form-control select2', 'multiple' => 'true']) !!}
                        </div>

                        <div class="form-group">
                            <label for="name">@lang('app.documents')</label>
                            <input type="file" class="form-control" id="documents" placeholder="(@lang('app.documents'))" name="documents" value="{{ '' }}">
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

@stop

@section('scripts')
    @if ($edit)
        {!! JsValidator::formRequest('SPCVN\Http\Requests\Topic\UpdateTopicRequest', '#topic-form') !!}
    @else
        {!! JsValidator::formRequest('SPCVN\Http\Requests\Topic\CreateTopicRequest', '#topic-form') !!}
    @endif

    {!! HTML::script('assets/plugins/bootstrap-switch/bootstrap-switch.min.js') !!}
    {!! HTML::script('assets/plugins/select2/select2.full.min.js') !!}
    <script>
        $(".switch").bootstrapSwitch({size: 'small'});
        $('.select2').select2({
            tags: true,
            theme: "classic",
            //placeholder: "@lang('app.topic_name')",

            ajax: {
                url: "{{ route('user.search-user-by-name') }}",
                method: "POST",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                  return {
                    q: params.term
                  };
                },
                processResults: function (data, params) {
                  // parse the results into the format expected by Select2
                  // since we are using custom formatting functions we do not need to
                  // alter the remote JSON data, except to indicate that infinite
                  // scrolling can be used
                  return {
                    results: data.items
                  };
                },
                cache: false
            },
            escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
            minimumInputLength: 1,
            //templateResult: formatRepo, // omitted for brevity, see the source of this page
            //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page

        });
    </script>
@stop

@section('styles')
    {!! HTML::style('assets/plugins/bootstrap-switch/bootstrap-switch.css') !!}
    {!! HTML::style('assets/plugins/select2/select2.min.css') !!}
@stop
