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
            {{-- <thead>
                <th>@lang('app.name')</th>
                <th>@lang('app.topic_name')</th>
                <th>@lang('app.created_by')</th>
                <th>@lang('app.tag')</th>
                <th class="text-center">@lang('app.action')</th>
            </thead> --}}
            <tbody>
            @if (count($questions))
                @foreach ($questions as $question)
                    <tr class="question-list">
                        <td class="text-center" style="min-width: 165px;max-width: 200px;text-align: center;">
                            <div class="votes">
                                <div class="mini-counts"><span title="10 votes">10</span></div>
                                <div>votes</div>
                            </div>
                            <div class="status unanswered">
                                <div class="mini-counts"><span title="9 answers">9</span></div>
                                <div>answers</div>
                            </div>
                            <div class="views">
                                <div class="mini-counts"><span title="{{ $question->views }} view">{{ $question->views }}</span></div>
                                <div>views</div>
                            </div>
                        </td>
                        <td>
                            <a class="question-answer" href="{{route('question.answer', $question->id)}}" title="{{ $question->title }}">{{ $question->title }}</a>
                            </br>
                            <span class="question-tags">
                                @foreach ($question->question_tag as $tag)
                                    <span class="label label-info">{{$tag->name}}</span>
                                @endforeach
                            </span>
                            <span class="question-created-by">asked {{ $question->created_at->diffForHumans() }} by <a href="" >{{ $question->user->present()->nameOrEmail }}</a></span>
                        </td>
                        <td class="tools">
                            <a href="{{ route('question.edit', $question->id) }}" class="btn btn-primary btn-circle"
                               title="@lang('app.edit_question')" data-toggle="tooltip" data-placement="top">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <a href="{{ route('question.answer', $question->id) }}" class="btn btn-success btn-circle"
                               title="@lang('app.answer_question')" data-toggle="tooltip" data-placement="top">
                                <i class="glyphicon glyphicon-eye-open"></i>
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

    <style type="text/css">
        .tools {
            position: absolute;
            right: 45px;
            transition: all 0.5s;
            display: none;
        }

        tr.question-list:hover .tools {
            display: block;
        }

        .question-tags {
            width: 100%;
        }

        .question-created-by {
            width: auto;
            font-size: 12px;
            color: #9199a1;
            float: right;
        }

        .votes, .status, .views {
            padding: 8px 5px;
            line-height: 1;
        }

        .mini-counts {
            font-size: 17px;
            font-weight: 300;
            color: #6a737c;
            margin-bottom: 4px;
        }

        .votes {
            display: inline-block;
            height: 38px;
            min-width: 38px;
            margin: 0 6px 0 0;
            font-size: 11px;
            color: #848d95;
            padding: 5px 5px 6px 5px;
            float: left;
        }

        .status {
            display: inline-block;
            margin: 0 6px 0 0;
            min-width: 44px;
            height: auto;
            font-size: 11px;
            padding: 5px 5px 6px 5px;
            float: left;
        }

        .views {
            display: inline-block;
            height: 38px;
            min-width: 40px;
            margin: 0 7px 0 0;
            font-size: 11px;
            color: #848d95;
            padding: 5px 5px 6px 5px;
            float: left;
        }

        .question-answer {
            font-size: 16px;
        }
    </style>

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

