@extends('layouts.app')

@section('page-title', trans('app.questions'))

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            {{trans('app.question_details') }}
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                    <li><a href="{{ route('question.index') }}">@lang('app.questions')</a></li>
                    <li class="active">{{trans('app.edit')}}</li>
                </ol>
            </div>
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <p style="font-weight: normal; font-size: 20px;">{{ $question["question"]->title }}</p>
                <i class="fa fa-user" aria-hidden="true"></i> <a href="">{{$question["question"]->user->present()->nameOrEmail}}</a>
                asked {{ $question["question"]->created_at->diffForHumans() }}
                <p class="pull-right"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>10  <i class="fa fa-comments-o" aria-hidden="true"></i> 3</p>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    {{$question["question"]->description}}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <h3 style="font-size: 20px; font-weight: normal;"> @if(!empty($question["answers"])){{count($question["answers"]) }}@else 0 @endif Comments</h3>
                </div>
            </div>
        </div>

        @include('partials.messages')

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="comment-post-0">
                    <div class="comment-user" style="width: 44px;position: absolute;">
                        <a href="{{ route('user.show', $question["question"]->user->id) }}">
                            <img alt="image" class="avatar" src="{{ Auth::user()->present()->avatar }}" width="44px;" style="border-radius: 3px;border-style: none;">
                        </a>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-8" style="padding-left: 60px;">
                        <div class="panel panel-default comment">
                            <div class="panel-heading" style="padding-bottom: 0px;">
                                <ul class="nav nav-tabs" style="margin-bottom: -1px;">
                                    <li class="active"><a data-toggle="tab" href="#write-comment-0" style="padding: 6px 15px;">Write</a></li>
                                    <li><a class="btn-preview-comment" data-toggle="tab" href="#pre-comment-0" style="padding: 6px 15px;">Preview</a></li>
                                </ul>
                            </div>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div id="write-comment-0" class="tab-pane fade in active" style="padding-top: 0px;">
                                        {!! Form::open(['route' => 'answer.store', 'id' => 'comment-form', 'class' => 'form-comment']) !!}
                                        <textarea id="0-textarea" name="0-textarea" class="form-control" rows="5" required></textarea>
                                        <button class="btn btn-success pull-right btn-add-comment" data-parent="0" data-item= "{{$question["question"]->id}}" data-user="{{Auth::user() ? Auth::user()->id : '0'}}" style="margin-top: 15px;">Comment</button>
                                    </div>
                                    <div id="pre-comment-0" class="tab-pane fade" style="padding-top: 0px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div><!---comment-main end-->
                @if(!empty($question["answers"]))
                    @foreach ($question["answers"] as $key => $answer)
                        <div class="comment-post-{{$answer["answer"]->id}}" data-constant="comment-show-{{$key}}">
                            <div class="comment-user">
                                <a href="{{ route('user.show', $answer["answer"]->user->id) }}">
                                    <img alt="image" class="avatar" src="{{ $answer["answer"]->user->present()->avatar }}" width="44px;" style="border-radius: 3px;border-style: none;">
                                </a>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 comment-item" id="parent-answer-{{$answer["answer"]->id}}">
                                <div class="panel panel-default comment">
                                    <div class="panel-heading">
                                        <i class="fa fa-user" aria-hidden="true"></i> <a href="">{{$answer["answer"]->user->present()->nameOrEmail}}</a>  commented {{ $answer["answer"]->created_at->diffForHumans() }}
                                        <p class="pull-right"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 10 <i class="fa fa-comments-o" aria-hidden="true"></i> 3</p>
                                    </div>
                                    <div class="panel-body">
                                        {!! $answer["answer"]->comment !!}
                                        </br>
                                        <a href="#answer-form-{{$answer["answer"]->id}}" class="reply-button" data-toggle="collapse">Reply</a>
                                    </div>
                                </div><!--answer form-->
                                @include('question.partials.answer')
                                <div class="clearfix"></div>
                                @if(!empty($answer["sub"]))
                                    @foreach ($answer["sub"] as $sub)
                                        <div class="comment-post-{{$sub->id}}">
                                            <div class="comment-user" style="width: 44px;position: absolute;">
                                                <a href="{{ route('user.show', $sub->user->id) }}">
                                                    <img alt="image" class="avatar" src="{{ $sub->user->present()->avatar }}" width="44px;" style="border-radius: 3px;border-style: none;">
                                                </a>
                                            </div>
                                            <div style="padding-left: 60px;">
                                                <div class="panel panel-default comment">
                                                    <div class="panel-heading">
                                                        <i class="fa fa-user" aria-hidden="true"></i> <a href="">{{$sub->user->present()->nameOrEmail}}</a>  commented {{ $sub->created_at->diffForHumans() }}
                                                        <p class="pull-right"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 10</p>
                                                    </div>
                                                    <div class="panel-body">
                                                        {!! $sub->comment !!}
                                                        {{-- <a href="#answer-form-{{$sub->id}}" class="reply-button" data-toggle="collapse">Reply</a> --}}
                                                    </div>
                                                </div><!--answer form-->
                                                @include('question.partials.answer')
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div><!---comment-post end-->
                                    @endforeach
                                @endif
                            </div>
                            <div class="clearfix"></div>
                        </div><!---comment-post end-->
                    @endforeach
                    <div class="clearfix"></div>
                    <button class="btn btn-default" id="showComment" data-show-comment="0" data-item-id="123" style="margin-top: 20px;">Load more</button>
                @endif
            </div>
        </div>
    </div>
</div>
@stop

@section('styles')
    {!! HTML::style('assets/css/question-comment.css') !!}
@stop

@section('scripts')
    {!! HTML::script('assets/js/comment.js') !!}
@stop
