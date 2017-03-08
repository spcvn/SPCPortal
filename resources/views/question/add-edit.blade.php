@extends('layouts.app')

@section('page-title', trans('app.roles'))

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                @lang('app.roles')
                <small>@lang('app.available_system_roles')</small>
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                        <li class="active">@lang('app.roles')</li>
                    </ol>
                </div>

            </h1>
        </div>
    </div>

    @include('partials.messages')

    <div class="row tab-search">
        <div class="col-md-2">
            <a href="{{ route('question.create') }}" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i>
                @lang('app.add_role')
            </a>
        </div>
    </div>

    @if ($edit)
        {!! Form::open(['route' => ['question.update', $question->id], 'method' => 'PUT', 'id' => 'question-form']) !!}
    @else
        {!! Form::open(['route' => 'question.store', 'id' => 'question-form']) !!}
    @endif
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('app.role_details_big')</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="name">@lang('app.name')</label>
                        <input type="text" class="form-control" id="name"
                               name="name" placeholder="@lang('app.role_name')" value="{{ $edit ? $role->name : old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="display_name">@lang('app.display_name')</label>
                        <input type="text" class="form-control" id="display_name"
                               name="display_name" placeholder="@lang('app.display_name')" value="{{ $edit ? $role->display_name : old('display_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="description">@lang('app.description')</label>
                        <textarea name="description" id="description" class="form-control">{{ $edit ? $role->description : old('description') }}</textarea>
                    </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="row">
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary btn-block">
                <i class="fa fa-save"></i>
                {{ $edit ? trans('app.update_role') : trans('app.create_role') }}
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
@stop
