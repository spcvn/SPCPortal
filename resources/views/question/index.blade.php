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
                                <a href="{{ route('question.index') }}" class="btn btn-danger" type="button">
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
                <th>@lang('app.tag')</th>
                <th class="text-center">@lang('app.action')</th>
            </thead>
            <tbody>
            @if (count($questions))
                @foreach ($questions as $question)
                    <tr>
                        <td>
                            {{-- <a href="javascript:void(0)" class="grid-editable-name editable editable-click" id="questions_name_edit" data-type="text" data-pk="{{$question->id}}" data-name="questions_name_edit" data-url="{{route('question.update', $question->id)}}" data-original-title="Enter question name"> --}}
                                {{ $question->title }}
                            {{-- </a> --}}
                        </td>
                        <td>
                            {{-- <a href="#" id="topics" data-type="select" data-pk="{{ $question->topic->id }}" data-url="{{route('topic.list')}}" data-title="Select topic name"> --}}
                                {{ $question->topic->topic_name or 'Not selected' }}
                            {{-- </a> --}}
                        </td>
                        <td>{{ $question->user->present()->nameOrEmail }}</td>
                        <td>
                            @foreach ($question->question_tag as $tag)
                                <span class="label label-success">{{$tag->name}}</span>
                            @endforeach
                        </td>
                        <td class="text-center">
                            <a href="{{ route('question.edit', $question->id) }}" class="btn btn-primary btn-circle"
                               title="@lang('app.edit_question')" data-toggle="tooltip" data-placement="top">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <a href="{{ route('question.delete', $question->id) }}" class="btn btn-danger btn-circle"
                               title="@lang('app.delete_question')"
                               data-toggle="tooltip"
                               data-placement="top"
                               data-method="DELETE"
                               data-confirm-title="@lang('app.please_confirm')"
                               data-confirm-text="@lang('app.are_you_sure_delete_question')"
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
        {!! $questions->render() !!}
    </div>

@stop

@section('scripts')
    <script type="text/javascript">

        $(document).on("mouseup", "#questions_name_edit", function() {

            $(this).editable({
                validate: function (value) {
                    // var regex = /^[a-zA-Z0-9\-_ \.]+$/;
                    // if(!regex.test(value)) {

                    //     return "@lang('app.tag_name_invalid')";
                    // }

                    if ($.trim(value) === '') {

                        return  "@lang('app.tag_name_require')";

                    } else if($.trim(value).length>255) {

                        return 'Only 100 charateres are allowed';
                    }
                },
                success: function (response) {

                    if(response.status === "EXISTS") {

                        return  "@lang('app.tag_name_exists')";
                    }

                    toastr.success( "@lang('app.tag_updated')" , "@lang('app.edit_tag')" );
                },
                error: function (response) {
                    return 'remote error';
                }
            });
        });

        $(document).on("mouseup", "#topics", function() {

            $(this).editable({
                value: 2,
                source: "{{route('topic.list')}}"
            })
        });
    </script>
@stop

