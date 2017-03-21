@extends('layouts.app')

@section('page-title', trans('app.topic'))

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                @lang('app.topic')
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                        <li class="active">@lang('app.topic')</li>
                    </ol>
                </div>

            </h1>
        </div>
    </div>

    @include('partials.messages')

    <div class="row tab-search">
        <div class="col-md-2">
            <a href="{{ route('topic.create') }}" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i>
                @lang('app.add_topic')
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
                            <a href="{{ route('topic.list') }}" class="btn btn-danger" type="button">
                                <span class="glyphicon glyphicon-remove"></span>
                            </a>
                        @endif
                    </span>
                </div>
            </form>
        </div>
        
    </div>


    <div class="table-responsive topic-table" id="users-table-wrapper">
        <table class="table" width="100%" cellpadding="0" cellspacing="0" border="0">
            <thead>
                <!--<th style="width: 2%;">@lang('app.sort_category')</th>-->
                <th style="width: 10%;" class="text-center">@lang('app.topic_picture')</th>
                <th style="width: 30%;">@lang('app.topic_name')</th>
                <th style="width: 15%;">@lang('app.tag')</th>
                <th style="width: 15%;">@lang('app.created_by')</th>
                <th style="width: 15%; text-align: center;">@lang('app.status')</th>
                <th style="width: 15%;" class="text-center">@lang('app.action')</th>
                </thead>
            <tbody>
            @if (count($topics))
                @foreach ($topics as $topic)
                    <tr id="cat-{{$topic->id}}">
                        <td style="text-align: center;">
                            <a href="{{ route('topic.edit', $topic->id) }}">
                                @php
                                    if ($topic->picture) {
                                        $source = url('/upload/topics/'. $topic->picture);
                                    } else {
                                        $source = url('assets/img/profile.png');
                                    }
                                @endphp

                                <img style="max-width: 100px; max-height: 100px;" class="avatar avatar-preview img-circle" src="{{ $source }}">
                            </a>
                        </td>
                        <td><a href="{{ route('topic.edit', $topic->id) }}">{{ $topic->topic_name }}</a></td>
                        <td class="tags">
                            @foreach ($topic->topics_tags as $tag)
                            <span style="padding: 2px 5px; font-size: 11px; display: inline-block; background: #0080ff; color: #fff;">{{$tag->name}}</span>
                            @endforeach
                        </td>
                        <td><a href="{{ route('user.show', $topic->user_id) }}">{{ $topic->user->first_name }} {{ $topic->user->last_name }}</a></td>
                        
                        <td style="text-align: center;">
                            @if ($topic->public)
                            <i class="fa fa-circle" title="@lang('app.public')" data-toggle="tooltip" data-placement="top" style="color: #328EFE;" aria-hidden="true"></i>
                            @else
                            <i class="fa fa-circle-o" title="@lang('app.private')" data-toggle="tooltip" data-placement="top" style="color: #328EFE;" aria-hidden="true"></i>
                            @endif
                        </td>

                        <td class="text-center">
                        @if (count(Storage::files('/upload/documents/' . $topic->encrypt_id)) > 0)
                            <button type="button" data-link="{{ route('topic.document', $topic->id) }}" class="btn show-document btn-success btn-circle"
                               title="@lang('app.documents')" data-toggle="tooltip" data-placement="top"
                               data-toggle="modal" data-target="#documentModal">
                                <i class="fa fa-file-archive-o" aria-hidden="true"></i>
                            </button>
                        @endif
                            <a href="{{ route('topic.edit', $topic->id) }}" class="btn btn-primary btn-circle"
                               title="@lang('app.edit_topic')" data-toggle="tooltip" data-placement="top">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <a href="{{ route('topic.delete', $topic->id) }}" class="btn btn-danger btn-circle"
                               title="@lang('app.delete_topic')"
                               data-toggle="tooltip"
                               data-placement="top"
                               data-method="DELETE"
                               data-confirm-title="@lang('app.please_confirm')"
                               data-confirm-text="@lang('app.are_you_sure_delete_topic')"
                               data-confirm-delete="@lang('app.yes_delete_it')">
                                <i class="glyphicon glyphicon-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="10"><em>@lang('app.no_records_found')</em></td>
                </tr>
            @endif
            </tbody>
        </table>

        @if (count($topics))
            {!! $topics->render() !!}
        @endif

    </div>

    <!-- Modal -->
    @include('topic.partials.modal')

@stop

@section('scripts')
    <script>
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
