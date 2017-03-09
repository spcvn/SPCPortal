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
    {!! Form::open(['route' => ['role.update', $role->id], 'method' => 'PUT', 'id' => 'role-form']) !!}
@else
    {!! Form::open(['route' => 'role.store', 'id' => 'role-form']) !!}
@endif

<div class="row">
    <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">@lang('app.question_details_big')</div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="name">@lang('app.name')</label>
                    <input type="text" class="form-control" id="name"
                           name="name" placeholder="@lang('app.role_name')" value="{{ $edit ? $question->name : old('name') }}">
                </div>
                <div class="form-group">
                    <label for="topic_name">@lang('app.topic_name')</label>
                    {!! Form::select('topic', $topics, $edit ? $question->topics->first()->id : '',
                        ['class' => 'form-control', 'id' => 'topic']) !!}
                </div>
                <div class="form-group">
                    <label for="topic_name">@lang('app.topic_name')</label>
                    <input type="text" class="form-control" id="topic_name"
                           name="topic_name" placeholder="@lang('app.topic_name')" value="{{ $edit ? $question->topic_name : old('topic_name') }}">
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
        {!! JsValidator::formRequest('SPCVN\Http\Requests\Role\UpdateRoleRequest', '#role-form') !!}
    @else
        {!! JsValidator::formRequest('SPCVN\Http\Requests\Role\CreateRoleRequest', '#role-form') !!}
    @endif
@stop
