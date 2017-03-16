@extends('layouts.app')

@section('page-title', trans('app.tag'))

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                @lang('app.tag')
                <small>@lang('app.available_system_tags')</small>
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
            <button type="button" class="btn btn-success" id="btn-add-tag">
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
            <tbody id="tag-list" name="tag-list">
            @if (count($tags))
                @foreach ($tags as $tag)
                    <tr id="tag{{$tag->id}}">
                        <td>{{ $tag->id }}</td>
                        <td>{{ $tag->name }}</td>
                        <td class="text-center">
                            <button class="btn btn-primary btn-circle open-modal" title="@lang('app.edit_tag')" value="{{$tag->id}}"><i class="glyphicon glyphicon-edit"></i></button>
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

    <!-- Modal (Pop up when detail button clicked) -->
    <div class="modal fade" id="tagModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">@lang('app.title_create_tag')</h4>
                </div>
                <div class="modal-body">
                <form id="frmTag" name="frmTag" class="form-horizontal" data-toggle="validator">
                    {!! Form::hidden('user_id', Auth::user()->present()->id) !!}
                        <label class="control-label" for="title">@lang('app.name')</label>
                        <input type="text" name="name" class="form-control required" id="tag_name" placeholder="@lang('app.tag_name')" value=""/>
                        <p class="error"></p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn-save-tag" class="btn crud-submit btn-success">
                        <i class="fa fa-save"></i>
                        @lang('app.create_tag')
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="hidden" id="tag_id" name="tag_id" value="0">
                </div>

            </div>
        </div>
    </div>

@stop

@section('scripts')
    <script type="text/javascript">

        var url = "{{ route('tag.index') }}";

        //display modal form for tag editing
        $(document).on('click', '.open-modal', function() {

            $('#tag_name').css("border", "1px solid #ccc");
            $('.text-danger').remove();

            var tag_id = $(this).val();
            $.get(url + '/' + tag_id  + '/edit', function (data) {

                $('#tag_id').val(data.id);
                $('#tag_name').val(data.name);
                $('#btn-save-tag').val("update");
                $('#btn-save-tag').html('<i class="fa fa-refresh"></i>' + ' @lang('app.update_tag')');
                $('h4.modal-title').text("@lang('app.update_tag')");

                $('#tagModel').modal('show');
            })
        });

        //display modal form for creating new task
        $('#btn-add-tag').click(function() {

            $('#tag_name').css("border", "1px solid #ccc");
            $('.text-danger').remove();

            $('#btn-save-tag').val("add");
            $('#btn-save-tag').html('<i class="fa fa-save"></i>' + ' @lang('app.create_tag')');
            $('h4.modal-title').text("@lang('app.title_create_tag')");
            $('#frmTag').trigger("reset");
            $('#tagModel').modal('show');
        });

        //delete tag and remove it from list
        // $('.delete-task').click(function(){
        //     var task_id = $(this).val();

        //     $.ajax({

        //         type: "DELETE",
        //         url: url + '/' + task_id,
        //         success: function (data) {
        //             console.log(data);

        //             $("#task" + task_id).remove();
        //         },
        //         error: function (data) {
        //             console.log('Error:', data);
        //         }
        //     });
        // });


        //create new task / update existing task
        $(document).on('click','#btn-save-tag', function (e) {
            if($('#tag_name').val().trim()=="") {

                $('.text-danger').remove();
                $('#tag_name').css("border", "1px solid #a94442");
                $('#tag_name').after("<span class='text-danger' style='padding:3px 2px;float:left;'>"+"@lang('app.tag_name_require')"+"</span>");

                return false;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            })

            e.preventDefault();

            var state = $('#btn-save-tag').val();

            var type = "POST";
            var tag_id = $('#tag_id').val();
            var tag_url = "{{ route('tag.store') }}";

            var formData = {

                name: $('#tag_name').val().trim(),
                user_id: $('input[name="user_id"]').val(),
                tag_id: !!tag_id?tag_id:'0',
            }

            if (state == "update"){

                type = "PUT";
                tag_url = url + '/' + tag_id +'/update';
            }

            $.ajax({

                type: type,
                url: tag_url,
                data: formData,
                dataType: 'json',
                success: function (data) {

                    $('#tag_name').css("border", "1px solid #ccc");
                    $('.text-danger').remove();

                    if(data.status !== undefined && data.status === "EXISTS") {

                            $('#tag_name').css("border", "1px solid #a94442");
                            $('#tag_name').after("<span class='text-danger' style='padding:3px 2px;float:left;'>"+"@lang('app.tag_name_exists')"+"</span>");

                            return false;
                    }

                    var task = '<tr id="tag' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td>';
                    task += '<td class="text-center"><button class="btn btn-primary btn-circle open-modal" title="' + data.name + '" value="' + data.id + '"><i class="glyphicon glyphicon-edit"></i></button>';
                    task += ' <a href="/tag/' + data.id + '/delete" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="top" data-method="DELETE" data-confirm-title="@lang('app.please_confirm')" data-confirm-text="@lang('app.are_you_sure_delete_tag')" data-confirm-delete="@lang('app.yes_delete_it')" data-original-title="Delete tag"><i class="glyphicon glyphicon-trash"></i></a></td></tr>';

                    if (state == "add"){

                            if($("#tag-list tr").length < 10) $('#tag-list').append(task);
                            if(data.status == "YES") toastr.success( "@lang('app.tag_created')" , "@lang('app.add_tag')" );

                    }else{

                            $("#tag" + tag_id).replaceWith(task);
                            if(data.status == "YES")  toastr.success( "@lang('app.tag_updated')" , "@lang('app.edit_tag')" );
                    }

                    $('#frmTag').trigger("reset");
                    $('#tagModel').modal('hide')
                },
                error: function (data) {

                        if(data.status == 'Error') {

                                toastr.error( "@lang('app.tag_updated_false')" , "Error" );
                        }
                }
            });
        });
    </script>
@stop
