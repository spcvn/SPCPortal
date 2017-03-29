<div id="answer-form-{{$answer["answer"]->id}}" class="collapse">
    <div class="comment-user">
        <a href="{{ route('user.show', $answer["answer"]->user->id) }}">
            <img alt="image" class="avatar" src="{{ $answer["answer"]->user->present()->avatar }}" width="44px;" style="border-radius: 3px;border-style: none;">
        </a>
    </div>
    <div class="col-lg-9 col-md-12 col-sm-12" style="padding-left: 60px;max-width: 100%;">
        <div class="panel panel-default comment">
            <div class="panel-heading" style="padding-bottom: 0px;">
                <ul class="nav nav-tabs" style="margin-bottom: -1px;">
                    <li class="active"><a data-toggle="tab" href="#write-comment-{{$answer["answer"]->id}}" style="padding: 6px 15px;">Write</a></li>
                    <li><a data-toggle="tab" href="#pre-comment-{{$answer["answer"]->id}}" style="padding: 6px 15px;">Preview</a></li>
                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div id="write-comment-{{$answer["answer"]->id}}" class="tab-pane fade in active" style="padding-top: 0px;">
                        {!! Form::open(['route' => 'answer.store', 'id' => 'comment-form-{{$answer["answer"]->id}}', 'class' => 'form-comment-{{$answer["answer"]->id}}']) !!}
                        <textarea id="{{ $answer["answer"]->id }}-textarea" class="form-control" rows="5" required></textarea>
                        <button class="btn btn-success pull-right btn-add-comment" data-parent="{{$answer["answer"]->id}}" data-item= "{{$question["question"]->id}}" data-user="{{Auth::user() ? Auth::user()->id : '0'}}" style="margin-top: 15px;">Comment</button>
                    </div>
                    <div id="pre-comment-{{$answer["answer"]->id}}" class="tab-pane fade" style="padding-top: 0px;">
                        Until now all of the examples were activated by the data attribute data-toggle="tab". The other approach you can use to activate Toggable Tabs/Pills is to use a script. The Bootstrap website gives the markup for this under the heading “Methods”.Below I show you an adapted version where I have used Pills instead of Tabs and where a pane is shown on hover instead of click:
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--end answer form-->

