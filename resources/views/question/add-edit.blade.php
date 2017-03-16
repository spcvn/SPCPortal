@extends('layouts.app')

@section('page-title', trans('app.questions'))

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            {{ $edit ? $role->name : trans('app.create_new_question') }}
            <small>{{ $edit ? trans('app.edit_question_details') : trans('app.question_details') }}</small>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                    <li><a href="{{ route('question.index') }}">@lang('app.questions')</a></li>
                    <li class="active">{{ $edit ? trans('app.edit') : trans('app.create') }}</li>
                </ol>
            </div>
        </h1>
    </div>
</div>

@include('partials.messages')

@if ($edit)
    {!! Form::open(['route' => ['question.update', $question->id], 'method' => 'PUT', 'id' => 'question-form']) !!}
@else
    {!! Form::open(['route' => 'question.store', 'id' => 'question-form']) !!}
@endif
    {!! Form::hidden('user_id', Auth::user()->present()->id) !!}
<div class="row">
    <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">@lang('app.question_details_big')</div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="title">@lang('app.question_name')</label>
                    <input type="text" class="form-control" id="title"
                           name="title" placeholder="@lang('app.question_name')" value="{{ $edit ? $question->title : old('title') }}">
                </div>
                <div class="form-group">
                    <label for="topic_id">@lang('app.topic_name')</label>
                    {!! Form::select('topic_id', $topics, $edit ? $question->topics->first()->id : '',['class' => 'form-control', 'id' => 'topic-id']) !!}
                </div>
                <div class="form-group">
                    <label for="tag_id">@lang('app.tag_name')</label>
                    <select id="tag_ids" name="tag_ids[]" class="form-control" multiple></select>
                </div>
                <div class="form-group">
                    <label for="description">@lang('app.description')</label>
                    <textarea name="description" id="description" class="form-control">{{ $edit ? $question->description : old('description') }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-2">
        <button type="submit" class="btn btn-primary btn-block">
            <i class="fa fa-save"></i>
            {{ $edit ? trans('app.update_question') : trans('app.create_question') }}
        </button>
    </div>
</div>

@stop

@section('scripts')
    @if ($edit)
        {!! JsValidator::formRequest('SPCVN\Http\Requests\Question\UpdateQuestionRequest', '#question-form') !!}
    @else
        {!! JsValidator::formRequest('SPCVN\Http\Requests\Question\CreateQuestionRequest', '#question-form') !!}
    @endif

    <script type="text/javascript">

        //autocomplete tags
        $('#tag_ids').select2({
            placeholder: "@lang('app.placeholder_for_tag')",
            tags: "true",
            allowClear: true,
            tokenSeparators: [',', ' '],
            ajax: {
                url: "{{ route('tag.find') }}",
                dataType: "json",
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    </script>
@stop
