@extends('layouts.app')

@section('page-title', trans('app.category'))

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                @if ($edit)
                    @lang('app.edit_category')
                @else
                    @lang('app.add_category')
                @endif
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                        <li><a href="{{ route('category.list') }}">@lang('app.category')</a></li>
                        <li class="active">
                            @if ($edit)
                                @lang('app.edit_category')
                            @else
                                @lang('app.add_category')
                            @endif
                        </li>
                    </ol>
                </div>

            </h1>
        </div>
    </div>

    @include('partials.messages')

    @if ($edit)
        {!! Form::open(['route' => ['category.edit', $category->id], 'method' => 'PUT', 'id' => 'category-form', 'onsubmit' => 'return check_validation();']) !!}
    @else
        {!! Form::open(['route' => 'category.create', 'files' => true, 'id' => 'category-form', 'onsubmit' => 'return check_validation();']) !!}
    @endif
    <div class="add-new" id="add-new">
        <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{$user->id}}">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">@lang('app.add_category')</h3>
                    </div>
                    <div class="panel-body">
                        @if (count($categories) > 1)
                        <div class="form-group">
                            <label for="parent_id">@lang('app.parent_name')</label>
                            {!! Form::select('parent_id', $categories, $edit ? $category->parent_id : '', ['class' => 'form-control']) !!}
                        </div>
                        @endif
                        <div class="form-group" id="name-require">
                            <label for="name" class="required">@lang('app.name')</label>
                            <input type="text" class="form-control" id="name" placeholder="(@lang('app.name'))" name="name" value="{{ $edit ? $category->name : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="description">@lang('app.description')</label>
                            <textarea name="description" id="description" class="form-control">{{ $edit ? $category->description : '' }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="back">@lang('app.back_to_this_page')</label>
                            <br>
                            <input type="hidden" name="back" value="0">
                            <input type="checkbox" {{ 'checked' }} name="back" class="switch" value="1" data-on-text="@lang('app.yes')" data-off-text="@lang('app.no')" >
                        </div>
                        
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i>
                            @lang('app.save')
                        </button>
                    </div>
                </div>                
            </div>
        </div>

    </div>
    {!! Form::close() !!}

@stop

@section('scripts')
    @if ($edit)
        {!! JsValidator::formRequest('SPCVN\Http\Requests\Category\UpdateCategoryRequest', '#category-form') !!}
    @else
        {!! JsValidator::formRequest('SPCVN\Http\Requests\Category\CreateCategoryRequest', '#category-form') !!}
    @endif

    {!! HTML::script('assets/plugins/bootstrap-switch/bootstrap-switch.min.js') !!}

    <script type="text/javascript">
        $(".switch").bootstrapSwitch({size: 'small'});
        $(document).ready(function(){
            $('input[name=name], textarea').on('blur', function(){
                $(this).val($.trim($(this).val()));
            });
        });

        // check validation form
        function check_validation() {
            var name        = $.trim($('input[name=name]').val());
            var parent_id   = $.trim($('select[name=parent_id]').val());
            var category_id = {{ $edit ? $category->id : 0 }};

            var myData = {
                category_id: category_id,
                parent_id: parent_id,
                name: name
            };

            return checkExistsName(myData);
        }

        function checkExistsName(myData) 
        {
            var ok = false;
            $.ajax({
                url: "{{ route('category.check-exists', $edit ? $category->id : 0) }}",
                method: "GET",
                dataType: 'json',
                data: myData,
                cache: false,
                async: false,
                success: function (data) {
                    if (data.status === false) {

                        $('#name-require').removeClass('form-group has-success');
                        $("span[id=name-error]").each(function(){
                            $(this).remove();  
                        });

                        setTimeout(function(){
                            $('#name-require').addClass('form-group has-error');
                            $('#name-require').append('<span id="name-error" class="help-block error-help-block">'+ data.message +'</span>'); 
                        }, 100);
                        
                        ok = false;
                    } else {
                        $('#name-require').removeClass('has-error');
                        $("#name-error").html('');
                        ok = true;
                    }
                }
            });

            return ok;
        }

        
    </script>
@stop

@section('styles')
    {!! HTML::style('assets/plugins/bootstrap-switch/bootstrap-switch.css') !!}
@stop
