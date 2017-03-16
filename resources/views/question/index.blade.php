@extends('layouts.app')

@section('page-title', trans('app.questions'))

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                @lang('app.questions')
                <small>@lang('app.available_system_questions')</small>
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                        <li class="active">@lang('app.questions')</li>
                    </ol>
                </div>

            </h1>
        </div>
    </div>

    @include('partials.messages')

    <div class="row tab-search">
        <div class="col-md-4">
            <a href="{{ route('question.create') }}" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i>
                @lang('app.add_question')
            </a>
        </div>
        <div class="col-md-8">
            <div class="col-md-6"></div>
            <form method="GET" action="" accept-charset="UTF-8" id="users-form">
                <div class="col-md-6">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" name="search"
                               value="{{ Input::get('search') }}" placeholder="@lang('app.search_for_question')">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" id="search-activities-btn">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                            @if (Input::has('search') && Input::get('search') != '')
                                <a href="{{ route('activity.index') }}" class="btn btn-danger" type="button">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </a>
                            @endif
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="table-responsive" id="users-table-wrapper">
        <table class="table">
            <thead>
                <th>@lang('app.name')</th>
                <th>@lang('app.topic_name')</th>
                <th>@lang('app.created_by')</th>
                <th>@lang('app.users_with_this_role')</th>
                <th class="text-center">@lang('app.action')</th>
            </thead>
            <tbody>
            @if (count($questions))
                @foreach ($questions as $question)
                    <tr>
                        <td>{{ $question->title }}</td>
                        <td>{{ $question->topic_id }}</td>
                        <td>{{ $question->user_id }}</td>
                        <td>{{ $question->views }}</td>
                        <td class="text-center">
                            <a href="{{ route('question.edit', $question->id) }}" class="btn btn-primary btn-circle"
                               title="@lang('app.edit_question')" data-toggle="tooltip" data-placement="top">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                                <a href="{{ route('question.delete', $question->id) }}" class="btn btn-danger btn-circle"
                                   title="@lang('app.delete_role')"
                                   data-toggle="tooltip"
                                   data-placement="top"
                                   data-method="DELETE"
                                   data-confirm-title="@lang('app.please_confirm')"
                                   data-confirm-text="@lang('app.are_you_sure_delete_role')"
                                   data-confirm-delete="@lang('app.yes_delete_it')">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4"><em>@lang('app.no_records_found')</em></td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>

@stop
