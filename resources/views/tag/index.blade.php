@extends('layouts.app')

@section('page-title', trans('app.tag'))

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                @lang('app.tag')
                <small>@lang('app.available_system_roles')</small>
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                        <li class="active">@lang('app.tag')</li>
                    </ol>
                </div>

            </h1>
        </div>
    </div>

    @include('partials.messages')

    <div class="row tab-search">
        <div class="col-md-4">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-tag">
                  <i class="glyphicon glyphicon-plus"></i> @lang('app.add_tag')
            </button>
        </div>
        <div class="col-md-8">
            <div class="col-md-6"></div>
            <form method="GET" action="" accept-charset="UTF-8" id="users-form">
                <div class="col-md-6">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" name="search"
                               value="{{ Input::get('search') }}" placeholder="@lang('app.search_for_tag')">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" id="search-activities-btn">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                            @if (Input::has('search') && Input::get('search') != '')
                                <a href="{{ route('tag.index') }}" class="btn btn-danger" type="button">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </a>
                            @endif
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive" id="tags-table-wrapper">
        <table class="table">
            <thead>
                <th>ID</th>
                <th>@lang('app.name')</th>
                <th class="text-center">@lang('app.action')</th>
            </thead>
            <tbody>
            @if (count($tags))
                @foreach ($tags as $tag)
                    <tr>
                        <td>{{ $tag->id }}</td>
                        <td>{{ $tag->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('tag.edit', $tag->id) }}" class="btn btn-primary btn-circle"
                               title="@lang('app.edit_tag')" data-toggle="tooltip" data-placement="top">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                                <a href="{{ route('tag.delete', $tag->id) }}" class="btn btn-danger btn-circle"
                                   title="@lang('app.delete_tag')"
                                   data-toggle="tooltip"
                                   data-placement="top"
                                   data-method="DELETE"
                                   data-confirm-title="@lang('app.please_confirm')"
                                   data-confirm-text="@lang('app.are_you_sure_delete_tag')"
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

    {!! $tags->render() !!}

    <!-- Create Item Modal -->
    <div class="modal fade" id="create-tag" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myModalLabel">@lang('app.title_create_tag')</h4>
          </div>

          <div class="modal-body">
                <form data-toggle="validator" action="api/create.php" method="POST">

                    <div class="form-group">
                        <label class="control-label" for="title">@lang('app.name')</label>
                        <input type="text" name="title" class="form-control" placeholder="@lang('app.tag_name')" required />
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn crud-submit btn-success">
                            <i class="fa fa-save"></i>
                            {{ $edit ? trans('app.update_tag') : trans('app.create_tag') }}
                        </button>
                    </div>

                </form>

          </div>
        </div>

      </div>
    </div>

@stop
