@extends('layouts.app')

@section('page-title', trans('app.category'))

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                @lang('app.category')
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                        <li class="active">@lang('app.category')</li>
                    </ol>
                </div>

            </h1>
        </div>
    </div>

    

    <div class="row tab-search">
        <div class="col-md-2">
            <a href="{{ route('category.create') }}" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i>
                @lang('app.add_category')
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
                            <a href="{{ route('category.list') }}" class="btn btn-danger" type="button">
                                <span class="glyphicon glyphicon-remove"></span>
                            </a>
                        @endif
                    </span>
                </div>
            </form>
        </div>
    </div>


    <div class="category" id="users-table-wrapper">
        @if (count($categories))
            <ol class="sortable">
            @foreach ($categories as $category)
                <li id="item_{{ $category['id'] }}" class="level-1" data-id="{{ $category['id'] }}" data-name="{{ $category['name'] }}">
                    <div class="item">
                        <div class="drag left"><i class="fa fa-crosshairs" aria-hidden="true"></i></div>
                        <div class="cat-name left">
                        <a>{{ $category['name'] }}</a>
                        </div>
                        <div class="action right">
                            <a href="{{ route('category.edit', $category['id']) }}" class="btn btn-primary btn-circle"
                               title="@lang('app.edit_category')" data-toggle="tooltip" data-placement="top">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <a href="{{ route('category.delete', $category['id']) }}" class="btn btn-danger btn-circle"
                               title="@lang('app.delete_category')"
                               data-toggle="tooltip"
                               data-placement="top"
                               data-method="DELETE"
                               data-confirm-title="@lang('app.please_confirm')"
                               data-confirm-text="@lang('app.are_you_sure_delete_category')"
                               data-confirm-delete="@lang('app.yes_delete_it')">
                                <i class="glyphicon glyphicon-trash"></i>
                            </a>
                        </div>
                        <div class="clear"></div>
                    </div>

                    @if (!empty($category['sub']))
                    <ol>
                    @foreach ($category['sub'] as $categorySub)
                        <li id="item_{{ $categorySub['id'] }}" class="level-2" data-id="{{ $categorySub['id'] }}" data-name="{{ $categorySub['name'] }}">
                            <div class="item">
                                <div class="drag left"><i class="fa fa-crosshairs" aria-hidden="true"></i></div>
                                <div class="cat-name left">
                                <a>{{ $categorySub['name'] }}</a>
                                </div>
                                <div class="action right">
                                    <a href="{{ route('category.edit', $categorySub['id']) }}" class="btn btn-primary btn-circle"
                                       title="@lang('app.edit_category')" data-toggle="tooltip" data-placement="top">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </a>
                                    <a href="{{ route('category.delete', $categorySub['id']) }}" class="btn btn-danger btn-circle"
                                       title="@lang('app.delete_category')"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       data-method="DELETE"
                                       data-confirm-title="@lang('app.please_confirm')"
                                       data-confirm-text="@lang('app.are_you_sure_delete_category')"
                                       data-confirm-delete="@lang('app.yes_delete_it')">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </a>
                                </div>
                                <div class="clear"></div>
                            </div>
                            
                            @if (!empty($categorySub['sub']))
                            <ol>
                            @foreach ($categorySub['sub'] as $categorySub2)
                                <li id="item_{{ $categorySub2['id'] }}" class="level-3" data-id="{{ $categorySub2['id'] }}" data-name="{{ $categorySub2['name'] }}">
                                    <div class="item">
                                        <div class="drag left"><i class="fa fa-crosshairs" aria-hidden="true"></i></div>
                                        <div class="cat-name left">
                                        <a>{{ $categorySub2['name'] }}</a>
                                        </div>
                                        <div class="action right">
                                            <a href="{{ route('category.edit', $categorySub2['id']) }}" class="btn btn-primary btn-circle"
                                               title="@lang('app.edit_category')" data-toggle="tooltip" data-placement="top">
                                                <i class="glyphicon glyphicon-edit"></i>
                                            </a>
                                            <a href="{{ route('category.delete', $categorySub2['id']) }}" class="btn btn-danger btn-circle"
                                               title="@lang('app.delete_category')"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               data-method="DELETE"
                                               data-confirm-title="@lang('app.please_confirm')"
                                               data-confirm-text="@lang('app.are_you_sure_delete_category')"
                                               data-confirm-delete="@lang('app.yes_delete_it')">
                                                <i class="glyphicon glyphicon-trash"></i>
                                            </a>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                
                                    @if (!empty($categorySub2['sub']))
                                    <ol>
                                    @foreach ($categorySub2['sub'] as $categorySub3)
                                        <li id="item_{{ $categorySub3['id'] }}" class="level-4" data-id="{{ $categorySub3['id'] }}" data-name="{{ $categorySub3['name'] }}">
                                            <div class="item">
                                                <div class="drag left"><i class="fa fa-crosshairs" aria-hidden="true"></i></div>
                                                <div class="cat-name left">
                                                <a>{{ $categorySub3['name'] }}</a>
                                                </div>
                                                <div class="action right">
                                                    <a href="{{ route('category.edit', $categorySub3['id']) }}" class="btn btn-primary btn-circle"
                                                       title="@lang('app.edit_category')" data-toggle="tooltip" data-placement="top">
                                                        <i class="glyphicon glyphicon-edit"></i>
                                                    </a>
                                                    <a href="{{ route('category.delete', $categorySub3['id']) }}" class="btn btn-danger btn-circle"
                                                       title="@lang('app.delete_category')"
                                                       data-toggle="tooltip"
                                                       data-placement="top"
                                                       data-method="DELETE"
                                                       data-confirm-title="@lang('app.please_confirm')"
                                                       data-confirm-text="@lang('app.are_you_sure_delete_category')"
                                                       data-confirm-delete="@lang('app.yes_delete_it')">
                                                        <i class="glyphicon glyphicon-trash"></i>
                                                    </a>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                        
                                            @if (!empty($categorySub3['sub']))
                                            <ol>
                                            @foreach ($categorySub3['sub'] as $categorySub4)
                                                <li id="item_{{ $categorySub4['id'] }}" class="level-5" data-id="{{ $categorySub4['id'] }}" data-name="{{ $categorySub4['name'] }}">
                                                    <div class="item">
                                                        <div class="drag left"><i class="fa fa-crosshairs" aria-hidden="true"></i></div>
                                                        <div class="cat-name left">
                                                        <a>{{ $categorySub4['name'] }}</a>
                                                        </div>
                                                        <div class="action right">
                                                            <a href="{{ route('category.edit', $categorySub4['id']) }}" class="btn btn-primary btn-circle"
                                                               title="@lang('app.edit_category')" data-toggle="tooltip" data-placement="top">
                                                                <i class="glyphicon glyphicon-edit"></i>
                                                            </a>
                                                            <a href="{{ route('category.delete', $categorySub4['id']) }}" class="btn btn-danger btn-circle"
                                                               title="@lang('app.delete_category')"
                                                               data-toggle="tooltip"
                                                               data-placement="top"
                                                               data-method="DELETE"
                                                               data-confirm-title="@lang('app.please_confirm')"
                                                               data-confirm-text="@lang('app.are_you_sure_delete_category')"
                                                               data-confirm-delete="@lang('app.yes_delete_it')">
                                                                <i class="glyphicon glyphicon-trash"></i>
                                                            </a>
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                </li>
                                             @endforeach
                                             </ol>
                                            @endif
                                        </li>
                                     @endforeach
                                     </ol>
                                    @endif
                                </li>
                             @endforeach
                             </ol>
                            @endif
                        </li>
                     @endforeach
                     </ol>
                    @endif

                </li>
            @endforeach
            </ol>
        @else
            <p><em>@lang('app.no_records_found')</em></p>
        @endif
    </div>

    @if (count($pagination))
        {!! $pagination->render() !!}
    @endif

@stop

@section('styles')
    {!! HTML::style('assets/css/jquery-ui.css') !!}
    <style type="text/css">
        .placeholder {
            outline: 1px dashed #4183C4;
            /*-webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            margin: -1px;*/
        }

        .mjs-nestedSortable-error {
            background: #fbe3e4;
            border-color: transparent;
        }

        ol {
            margin: 0;
            padding: 0;
            padding-left: 30px;
        }

        ol.sortable, ol.sortable ol {
            margin: 0 0 0 25px;
            padding: 0;
            list-style-type: none;
        }

        ol.sortable {
            margin:  0;
        }

        .sortable li {
            margin: 5px 0 0 0;
            padding: 0;
        }

        .sortable li div.item  {
            border: 1px solid #d4d4d4;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            border-color: #D4D4D4 #D4D4D4 #BCBCBC;
            padding: 6px;
            margin: 0;
            position: relative;
            background: #f6f6f6;
            background: -moz-linear-gradient(top,  #ffffff 0%, #f6f6f6 47%, #ededed 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(47%,#f6f6f6), color-stop(100%,#ededed));
            background: -webkit-linear-gradient(top,  #ffffff 0%,#f6f6f6 47%,#ededed 100%);
            background: -o-linear-gradient(top,  #ffffff 0%,#f6f6f6 47%,#ededed 100%);
            background: -ms-linear-gradient(top,  #ffffff 0%,#f6f6f6 47%,#ededed 100%);
            background: linear-gradient(to bottom,  #ffffff 0%,#f6f6f6 47%,#ededed 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ededed',GradientType=0 );
        }
        .sortable li div.item .drag {
            cursor: move;
            display: inline-block;
            line-height: 25px;
            position: absolute;
            top: 0;
            left: 0;
            width: 42px;
            height: 42px;
            font-size: 25px;
            padding: 10px;
        }
        .sortable li div.item .cat-name {
            margin-left: 40px;
        }
        .sortable li.mjs-nestedSortable-branch div.item {
            background: -moz-linear-gradient(top,  #ffffff 0%, #f6f6f6 47%, #f0ece9 100%);
            background: -webkit-linear-gradient(top,  #ffffff 0%,#f6f6f6 47%,#f0ece9 100%);

        }

        .sortable li.mjs-nestedSortable-leaf div.item {
            background: -moz-linear-gradient(top,  #ffffff 0%, #f6f6f6 47%, #bcccbc 100%);
            background: -webkit-linear-gradient(top,  #ffffff 0%,#f6f6f6 47%,#bcccbc 100%);

        }

        li.mjs-nestedSortable-collapsed.mjs-nestedSortable-hovering div.item {
            border-color: #999;
            background: #fafafa;
        }

        .disclose {
            cursor: pointer;
            width: 10px;
            display: none;
        }

        .sortable li.mjs-nestedSortable-collapsed > ol {
            display: none;
        }

        .sortable li.mjs-nestedSortable-branch > div.item > .disclose {
            display: inline-block;
        }

        .sortable li.mjs-nestedSortable-collapsed > div.item > .disclose > span:before {
            content: '+ ';
        }

        .sortable li.mjs-nestedSortable-expanded > div.item > .disclose > span:before {
            content: '- ';
        }

        .sortable li div.item .cat-name {
            display: inline-block;
            line-height: 30px;
        }
        .sortable li div.item .cat-name a {
            cursor: pointer;
        }

        .item {

        }

        .clear {
            clear: both;
        }

        .left {
            float: left;
        }
        .right {
            float: right;
        }

    </style>
@stop

@section('scripts')
    {!! HTML::script('assets/js/jquery-ui.min.js') !!}
    {!! HTML::script('assets/js/jquery.mjs.nestedSortable.js') !!}

    <script>
        $(document).ready(function(){
            var level;
            var ok = true;
            $('ol.sortable').nestedSortable({
                forcePlaceholderSize: true,
                handle: '.drag',
                helper: 'clone',
                items: 'li',
                opacity: .6,
                placeholder: 'placeholder',
                revert: 250,
                tabSize: 25,
                tolerance: 'pointer',
                toleranceElement: '> div',
                maxLevels: 5,
                isTree: true,
                expandOnHover: 700,
                startCollapsed: true,

                update: function( e, ui ) {
                    var ok      = true;
                    level       = ui.item.parents('ol').length;
                    var _this   = ui.item;
                    var id      = $.trim($(_this).data('id'));
                    var value   = $.trim($(_this).data('name'));
                    $(_this).attr('class', 'level-'+ level);

                    $(_this).siblings().each(function(){
                        if ($.trim($(this).data('name')) == value) {
                            ok = false;
                        }
                    });

                    // update parentID for category
                    var parentID = 0;
                    if (ui.item.parent().parent().data('id')) {
                        parentID = ui.item.parent().parent().data('id');
                    }

                    var myData = {
                            parent_id: parentID,
                            id: id
                        };

                    if (ok === true) {
                        $.ajax({
                            url: "{{ route('category.update-category') }}",
                            method: "PUT",
                            dataType: 'json',
                            data: myData,
                            cache: false,
                            async: false,
                            success: function (data) {
                                ok = data.status;
                                
                            }
                        });
                    }

                    if (ok) {
                        toastr.success( "@lang('app.category_updated')" , "@lang('app.category')" );
                    } else {
                        toastr.error( "@lang('app.name_exists')" , "@lang('app.category')" );
                    }
                    
                    return ok;
                }
            });
        });

        function checkDuplicationName(obj)
        {
            if(typeof(obj) == 'object') {

                for(var item in obj) {
                    
                    var value = obj[item];
                    if(typeof(value) == 'object') { //If it is an array,
                        checkDuplicationName(value);
                    } else {
                        var $element    = $('#item_'+ value);
                        var name        = $element.data('name');
                        var className   = $element.attr('class');
                        
                        level++;
                    }
                }
            } else {
                
            }
        }

        function customizeClass(obj, level) {

            // console.log(obj);

            if (!level) {
                level = 1;
            }

            if (typeof(obj) == 'object') {
                for (var item in obj) {
                    var value = obj[item];

                    if (typeof(value) == 'object') {
                        customizeClass(value, level);
                    } else {
                        $('#item_'+ value).attr('class','');
                        $('#item_'+ value).attr('class','level-'+ level);
                        level++;
                    }
                    
                }
            }

            return true;
        }

        function dump(arr,level) {
            var dumped_text = "";
            if(!level) level = 0;

            //The padding given at the beginning of the line.
            var level_padding = "";
            for(var j=0;j<level+1;j++) level_padding += "    ";

            if(typeof(arr) == 'object') { //Array/Hashes/Objects
                for(var item in arr) {
                    var value = arr[item];

                    if(typeof(value) == 'object') { //If it is an array,
                        dumped_text += level_padding + "'" + item + "' ...\n";
                        dumped_text += dump(value,level+1);
                    } else {
                        dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
                    }
                }
            } else { //Strings/Chars/Numbers etc.
                dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
            }
            return dumped_text;
        }
    </script>
@stop
