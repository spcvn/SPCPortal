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
        {!! Form::open(['route' => ['category.edit', $category->id], 'method' => 'PUT', 'id' => 'category-form']) !!}
    @else
        {!! Form::open(['route' => 'category.create', 'files' => true, 'id' => 'category-form']) !!}
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
                            <label for="name">@lang('app.parent_name')</label>
                            {!! Form::select('parent_id', $categories, $edit ? $category->parent_id : '', ['class' => 'form-control']) !!}
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="name" class="required">@lang('app.name')</label>
                            <input type="text" class="form-control" id="name" placeholder="(@lang('app.name'))" name="name" value="{{ $edit ? $category->name : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="description">@lang('app.description')</label>
                            <textarea name="description" id="description" class="form-control">{{ $edit ? $category->description : '' }}</textarea>
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
@stop
