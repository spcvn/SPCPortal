@extends('layouts.app')

@section('page-title', trans('app.category'))

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                @lang('app.category')
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                        <li class="active">@lang('app.category')</li>
                    </ol>
                </div>

            </h1>
        </div>
    </div>

    @include('partials.messages')

    <div class="row tab-search">
        <div class="col-md-2">
            <a href="{{ route('category.create') }}" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i>
                @lang('app.add_category')
            </a>
        </div>
        <div class="col-md-6"></div>
        <div class="col-md-4">
            <form method="GET" action="" accept-charset="UTF-8" id="users-form">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" name="search"
                           value="{{ Input::get('search') }}" placeholder="@lang('app.search_for_action')">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit" id="search-activities-btn">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                        @if (Input::has('search') && Input::get('search') != '')
                            <a href="{{ route('category.list') }}" class="btn btn-danger" type="button">
                                <span class="glyphicon glyphicon-remove"></span>
                            </a>
                        @endif
                    </span>
                </div>
            </form>
        </div>
    </div>


    <div class="table-responsive" id="users-table-wrapper">
        <table id="sortable" class="table" width="100%" cellpadding="0" cellspacing="0" border="0">
            <thead>
                <th style="width: 2%;">@lang('app.sort_category')</th>
                <th style="width: 80%;">@lang('app.name')</th>
                <th style="width: 18%;" class="text-center">@lang('app.action')</th>
                </thead>
            <tbody>
            @if (count($categories))
                @foreach ($categories as $category)
                    <tr id="cat-{{$category->id}}">
                        <td style="width: 2%;" class="text-center move"><i title="move" data-toggle="tooltip" data-placement="top" class="glyphicon glyphicon-resize-vertical"></i></td>
                        <td style="width: 80%;"><a href="{{ route('category.edit', $category->id) }}">{{ $category->name }}</a></td>
                        <td style="width: 18%;" class="text-center">
                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary btn-circle"
                               title="@lang('app.edit_category')" data-toggle="tooltip" data-placement="top">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <a href="{{ route('category.delete', $category->id) }}" class="btn btn-danger btn-circle"
                               title="@lang('app.delete_category')"
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

        @if (count($categories))
            {!! $categories->render() !!}
        @endif

    </div>

@stop

@section('styles')
    {!! HTML::style('assets/css/jquery-ui.css') !!}
@stop

@section('scripts')
    {!! HTML::script('assets/js/jquery-ui.min.js') !!}

    <script>
        $( function() {
            $( "#sortable tbody" ).sortable({
                placeholder: "ui-state-highlight",
                cursor: 'move',
                update: function(event, ui) {
                    var info = $("#sortable tbody").sortable("serialize");
                    $.ajax({
                        type: "POST",
                        url: "{{ route('category.sort') }}",
                        data: info,
                        success: function(msg) {
                            //alert(msg.message);
                        }
                    });
                }
            });
            $( "#sortable tbody" ).disableSelection();
        } );
    </script>
@stop
