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
                <th>@lang('app.tag')</th>
                <th>@lang('app.created_by')</th>
                <th style="text-align: center;">@lang('app.status')</th>
                <th style="width: 15%; text-align: center;">@lang('app.votes')</th>
                <th style="width: 15%;" class="text-center">@lang('app.action')</th>
                </thead>
            <tbody>
            @if (count($topics))
                @foreach ($topics as $topic)
                    <tr id="cat-{{$topic->id}}">
                        <td style="text-align: center; vertical-align: middle;">
                            <a href="{{ route('topic.edit', $topic->id) }}">
                                @php
                                    if ($topic->picture) {
                                        $source = url('/upload/topics/'. $topic->picture);
                                    } else {
                                        $source = url('assets/img/profile.png');
                                    }
                                @endphp

                                <img style="max-width: 70px; max-height: 70px;" class="avatar avatar-preview img-circle" src="{{ $source }}">
                            </a>
                        </td>
                        <td style="vertical-align: middle;"><a href="{{ route('topic.edit', $topic->id) }}">{{ $topic->topic_name }}</a></td>
                        <td class="tags" style="vertical-align: middle;">
                            @foreach ($topic->topics_tags as $tag)
                            <span style="padding: 2px 5px; font-size: 11px; display: inline-block; background: #0080ff; color: #fff;">{{$tag->name}}</span>
                            @endforeach
                        </td>
                        <td style="vertical-align: middle;"><a href="{{ route('user.show', $topic->user_id) }}">{{ $topic->user->first_name }} {{ $topic->user->last_name }}</a></td>
                        
                        <td style="text-align: center; vertical-align: middle;">
                            @if ($topic->public)
                            <i class="fa fa-circle" title="@lang('app.public')" data-toggle="tooltip" data-placement="top" style="color: #328EFE;" aria-hidden="true"></i>
                            @else
                            <i class="fa fa-circle-o" title="@lang('app.private')" data-toggle="tooltip" data-placement="top" style="color: #328EFE;" aria-hidden="true"></i>
                            @endif
                        </td>

                        <td style="text-align: center; vertical-align: middle;" class="rating-voter">
                            
                        @php                       
                        $readonly = false;                       
                        if (isset($topic->topics_votes) and  !empty($topic->topics_votes)) {
                            foreach ($topic->topics_votes as $votes) {
                                if ($votes->user->id == Auth::id()) {
                                    $readonly = true;
                                }
                            }
                        }

                        if (Auth::id() == $topic->user_id) {
                            $readonly = true;
                        }
                        @endphp


                            <div class="topic-rating">
                                <input id="rating-{{ $topic->id }}" data-readonly="{{ $readonly }}" data-id="{{ $topic->id }}" data-size="xs" data-show-clear="false" data-show-caption="false" name="input-{{ $topic->id }}" value="{{ $topic->votes }}" class="rating topic-rating-item rating-loading">
                            </div>

                            @if (isset($topic->topics_votes[0]) and !empty($topic->topics_votes[0]))
                            <div class="tooltipvote">
                                <ul>
                                @foreach ($topic->topics_votes as $votes)
                                    <li>{{ $votes->user->full_name }}</li>
                                @endforeach
                                </ul>
                            </div>
                            @endif

                        </td>

                        <td class="text-center" style="vertical-align: middle;">
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

    <!-- Modal files document -->
    @include('topic.partials.modal')

    <!-- Modal (Pop up when click vote for topic) -->
    <div class="modal fade" id="votesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">@lang('app.votes')</h4>
                </div>
                <div class="modal-body">
                <form id="frmComment" name="frmComment" class="form-horizontal" data-toggle="validator">
                    {!! Form::hidden('user_id', Auth::user()->present()->id) !!}
                    <input type="hidden" id="topic_id" name="topic_id" value="0">
                    <input type="hidden" id="point" name="point" value="0">
                    <label class="control-label required" for="comments">@lang('app.comments')</label>
                    <textarea name="comments" required="true" id="comments" placeholder="@lang('app.comments')" rows="5" class="form-control"></textarea>
                    <p class="text-danger" style='padding:3px 2px;'></p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-save-comment" class="btn crud-submit btn-success">
                        <i class="fa fa-save"></i>
                        @lang('app.save_comment')
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('app.close')</button>
                </div>

            </div>
        </div>
    </div>

@stop

@section('styles')
    {!! HTML::style('assets/css/star-rating.css') !!}
    {!! HTML::style('assets/plugins/qtip2/jquery.qtip.min.css') !!}
    <style type="text/css">
        .tooltipvote{
            display: none;
        }
        .qtip-content
        {
            min-width: 250px;
            max-height: 200px;
            overflow: auto;
        }
    </style>
@stop

@section('scripts')
    {!! HTML::script('assets/js/star-rating.js') !!}
    {!! HTML::script('assets/plugins/qtip2/jquery.qtip.min.js') !!}
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


            // rating
            @foreach ($topics as $topic)
                $("#rating-{{ $topic->id }}").rating({
                    hoverOnClear: false,
                    hoverChangeCaption: false,
                    stars: 5
                });
            @endforeach

            // get rating value
            $('.topic-rating-item').rating().on("rating.change", function(event, value, caption) {
                var topicID = $(this).data('id');
                $('#votesModal #point').val(value);
                $('#votesModal #topic_id').val(topicID);
                $('#votesModal').modal('show');
            });

            $('#votesModal').on('hidden.bs.modal', function (e) {
                var topicID = $('#topic_id').val();
                $(this).find("input,textarea,select").val('').end()
                .find("input[type=checkbox], input[type=radio]").prop("checked", "").end();

                // reset rating
                $("#rating-"+ topicID).rating('reset').val();
            });

            // event when mouseenter textarea comment.
            $('#frmComment #comments').blur(function() {
                var comment = $.trim($(this).val());
                if (comment == '' || comment == undefined) {
                    $(this).css("border", "1px solid #a94442");
                    $('#frmComment p.text-danger').html("@lang('app.comment_is_required')");
                } else {
                    $(this).css("border", "1px solid #ccc");
                    $('#frmComment p.text-danger').html("");
                }
            });

            // update rating to DB
            $('#btn-save-comment').on('click', function(){
                var topicID = $.trim($('#topic_id').val());
                var comment = $.trim($('#comments').val());
                var point   = parseFloat($.trim($('#point').val()));
                
                if (comment == '') {
                    $('#frmComment #comments').css("border", "1px solid #a94442");
                    $('#frmComment p.text-danger').html("@lang('app.comment_is_required')");
                } else {
                    var myData = {
                        'type'      : 'topic',
                        'object_id' : topicID,
                        'user_id'   : {{Auth::id()}},
                        'point'     : point,
                        'comments'  : comment
                    }

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('topic.votes') }}",
                        data: myData,
                        dataType: 'json',
                        async: true,
                        success: function (data) {

                            $('#votesModal').trigger("reset");
                            $('#votesModal').modal('hide');

                            if (data.status == true) {
                                $(document).find('#rating-'+ topicID).attr('value', data.item.average);
                                toastr.success( data.message , "@lang('app.votes')" );
                            } else {
                                toastr.error( data.message , "@lang('app.votes')" );
                            }
                        }
                    });

                    $( document ).ajaxComplete(function( event, request, settings ) {
                        var data = JSON.parse(request.responseText);
                        if (data.status == true) {
                            console.log('log');
                            $(document).find('#rating-'+ data.item.object_id).rating('update', data.item.average);
                            $(document).find('#rating-'+ data.item.object_id).rating('refresh', {disabled: true, showClear: false, showCaption: false});
                        }
                    });
                }

            });

            // qtip2
            $('.topic-rating').each(function() {
                var check = $(this).parent().find('div.tooltipvote');
                if (check.length > 0) {
                    $(this).qtip({
                        content: {
                            title: 'User Voted',
                            text: $(this).next('.tooltipvote'),
                            button: 'Close'
                        },
                        position: {
                            my: 'bottom center',  // Position my top left...
                            at: 'top center', // at the bottom right of...
                            target: 'event',
                            adjust: { scroll: true }
                        },
                        hide: {
                            when: { event: 'click' }
                        },
                        style: {
                            classes: 'qtip-blue qtip-bootstrap'
                        }
                    });
                }
            });


        });
    </script>
@stop
