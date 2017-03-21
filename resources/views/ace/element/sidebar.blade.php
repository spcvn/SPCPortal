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
		<li class="{{ Request::is('acelayout') ? 'active' : ''  }}">
			<a href="/acelayout">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text">@lang('app.dashboard')</span>
            </a>
			<b class="arrow"></b>
		</li>

        <li class="{{ Request::is('acelayout/uielement*') ? 'active open' : ''  }}">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-desktop"></i>
                <span class="menu-text">UI &amp; Elements</span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>

            <ul class="submenu">
                <li class="{{ Request::is('acelayout/uielement/typography*') ? 'active' : ''  }}">
                    <a href="/acelayout/uielement/typography">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Typography
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ Request::is('acelayout/uielement/elements*') ? 'active' : ''  }}">
                    <a href="/acelayout/uielement/elements">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Elements
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ Request::is('acelayout/uielement/buttonico*') ? 'active' : ''  }}">
                    <a href="/acelayout/uielement/buttonico">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Buttons &amp; Icons
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ Request::is('acelayout/uielement/contentslide*') ? 'active' : ''  }}">
                    <a href="/acelayout/uielement/contentslide">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Content Sliders
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ Request::is('acelayout/uielement/treeview*') ? 'active' : ''  }}">
                    <a href="/acelayout/uielement/treeview">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Treeview
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ Request::is('acelayout/uielement/jqueryui*') ? 'active' : ''  }}">
                    <a href="/acelayout/uielement/jqueryui">
                        <i class="menu-icon fa fa-caret-right"></i>
                        jQuery UI
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>

        <li class="{{ Request::is('acelayout/tables*') ? 'active open' : ''  }}">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-list"></i>
                <span class="menu-text">Tables</span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>

            <ul class="submenu">
                <li class="{{ Request::is('acelayout/tables/simple*') ? 'active' : ''  }}">
                    <a href="/acelayout/tables/simple">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Simple & Dynamic
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ Request::is('acelayout/tables/jqgrid*') ? 'active' : ''  }}">
                    <a href="/acelayout/tables/jqgrid">
                        <i class="menu-icon fa fa-caret-right"></i>
                        jqGrid plugin
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ Request::is('acelayout/tables/tablecus*') ? 'active' : ''  }}">
                    <a href="/acelayout/tables/tablecus">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Custom table
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>

        <li class="{{ Request::is('acelayout/forms*') ? 'active open' : ''  }}">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-list"></i>
                <span class="menu-text">Forms</span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>

            <ul class="submenu">
                <li class="{{ Request::is('acelayout/forms/formele1*') ? 'active' : ''  }}">
                    <a href="/acelayout/forms/formele1">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Form element 1
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ Request::is('acelayout/forms/formele2*') ? 'active' : ''  }}">
                    <a href="/acelayout/forms/formele2">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Form element 2
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>

        @permission('users.manage')
            <li class="{{ Request::is('user*') ? 'active' : ''  }}">
                <a href="{{ route('user.list') }}">
                    <i class="menu-icon fa fa-users"></i>
                    <span class="menu-text">@lang('app.users')</span>
                </a>
            </li>
        @endpermission

        @permission('users.activity')
            <li class="{{ Request::is('activity*') ? 'active' : ''  }}">
                <a href="{{ route('activity.index') }}">
                    <i class="menu-icon fa fa-list-alt"></i>
                    <span class="menu-text">@lang('app.activity_log')</span>
                </a>
            </li>
        @endpermission

        @permission(['roles.manage', 'permissions.manage'])
            <li class="{{ Request::is('role*') || Request::is('permission*') ? 'active open' : ''  }}">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-user"></i>
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
                    <i class="menu-icon fa fa-gear"></i>
                    <span class="menu-text">@lang('app.settings')</span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
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
	</ul><!-- /.nav-list -->

	<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
		<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
	</div>
</div>