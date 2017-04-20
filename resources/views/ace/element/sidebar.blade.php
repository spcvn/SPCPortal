<div id="sidebar" class="sidebar responsive ace-save-state">
    <script type="text/javascript">
        try{ace.settings.loadState('sidebar')}catch(e){}
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-warning">
                <i class="ace-icon fa fa-users"></i>
            </button>
            <button class="btn btn-danger">
                <i class="ace-icon fa fa-cogs"></i>
            </button>
        </div>

        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-warning"></span>
            <span class="btn btn-danger"></span>
        </div>
    </div><!-- /.sidebar-shortcuts -->

    <ul class="nav nav-list">
        <li class="{{ Request::is('/') ? 'active' : ''  }}">
            <a href="{{ route('dashboard') }}" class="{{ Request::is('/') ? 'active' : ''  }}">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text">@lang('app.dashboard')</span>
            </a>
            <b class="arrow"></b>
        </li>

        @permission('questions.manage')
            <li>
                <a href="{{ route('question.index') }}" class="{{ Request::is('question*') ? 'active' : ''  }}">
                <i class="menu-icon fa fa-question-circle" aria-hidden="true"></i>
                    <span class="menu-text">@lang('app.qa')</span>
                </a>
            </li>
        @endpermission

        @permission('tags.manage')
            <li class="{{ Request::is('tag*') ? 'active open' : ''  }}">
                <a href="{{ route('tag.index') }}" class="{{ Request::is('tag*') ? 'active' : ''  }}">
                    <i class="menu-icon fa fa-tags"></i>
                    <span class="menu-text">@lang('app.tag')</span>
                </a>
            </li>
        @endpermission

        @permission('users.activity')
            <li class="{{ Request::is('activity*') ? 'active' : ''  }}">
                <a href="{{ route('activity.index') }}" class="{{ Request::is('activity*') ? 'active' : ''  }}">
                    <i class="menu-icon fa fa-list-alt fa-fw"></i>
                    <span class="menu-text">@lang('app.activity_log')</span>
                </a>
            </li>
        @endpermission

        @permission('users.manage')
            <li class="{{ Request::is('user*') ? 'active' : ''  }}">
                <a href="{{ route('user.list') }}" class="{{ Request::is('user*') ? 'active' : ''  }}">
                    <i class="menu-icon fa fa-users fa-fw"></i>
                    <span class="menu-text">@lang('app.users')</span>
                </a>
            </li>
        @endpermission

        @permission(['roles.manage', 'permissions.manage'])
            <li class="{{ Request::is('role*') || Request::is('permission*') ? 'active open' : ''  }}">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-user fa-fw"></i>
                    <span class="menu-text">@lang('app.roles_and_permissions')</span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    @permission('roles.manage')
                        <li class="{{ Request::is('role*') ? 'active' : ''  }}">
                            <a href="{{ route('role.index') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                @lang('app.roles')
                            </a>
                            <b class="arrow"></b>
                        </li>
                    @endpermission
                    @permission('permissions.manage')
                        <li class="{{ Request::is('permission*') ? 'active' : ''  }}">
                            <a href="{{ route('permission.index') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                @lang('app.permissions')
                            </a>
                            <b class="arrow"></b>
                        </li>
                    @endpermission
                </ul>
            </li>
        @endpermission

        @permission(['settings.general', 'settings.auth', 'settings.notifications'])
            <li class="{{ Request::is('settings*') ? 'active open' : ''  }}">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-gear fa-fw"></i>
                    <span class="menu-text">@lang('app.settings')</span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    @permission('settings.general')
                        <li class="{{ Request::is('settings') ? 'active' : ''  }}">
                            <a href="{{ route('settings.general') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                @lang('app.general')
                            </a>
                            <b class="arrow"></b>
                        </li>
                    @endpermission
                    @permission('settings.auth')
                        <li class="{{ Request::is('settings/auth*') ? 'active' : ''  }}">
                            <a href="{{ route('settings.auth') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                @lang('app.auth_and_registration')
                            </a>
                            <b class="arrow"></b>
                        </li>
                    @endpermission
                    @permission('settings.notifications')
                        <li class="{{ Request::is('settings/notifications*') ? 'active' : ''  }}">
                            <a href="{{ route('settings.notifications') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                @lang('app.notifications')
                            </a>
                            <b class="arrow"></b>
                        </li>
                    @endpermission
                </ul>
            </li>
        @endpermission

        @permission('category.manage')
            <li class="{{ Request::is('category*') ? 'active open' : ''  }}">
                <a href="{{ route('category.list') }}" class="{{ Request::is('category*') ? 'active' : ''  }}">
                    <i class="menu-icon fa fa-list-alt fa-fw"></i> @lang('app.category')
                </a>
            </li>
        @endpermission

        @permission('topic.manage')
            <li class="{{ Request::is('topic*') ? 'active open' : ''  }}">
                <a href="{{ route('topic.list') }}" class="{{ Request::is('topic*') ? 'active' : ''  }}">
                    <i class="menu-icon fa fa-list-alt fa-fw"></i> @lang('app.topic')
                </a>
            </li>
        @endpermission

    </ul>
</div>
