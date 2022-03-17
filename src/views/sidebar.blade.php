<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url(config('crudbooster.ADMIN_PATH'))}}" title='{{Session::get('appname')}}' class="brand-link">
        <span class="brand-text font-weight-bold ml-3">{{CRUDBooster::getSetting('appname')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
            <li class="nav-header">{{ cbLang('menu_navigation') }}</li>
                <!-- Optionally, you can add icons to the links -->

            <?php $dashboard = CRUDBooster::sidebarDashboard();?>
            @if($dashboard)
                <li data-id='{{$dashboard->id}}' class="nav-item {{ (Request::is(config('crudbooster.ADMIN_PATH'))) ? 'active' : '' }}">
                    <a href='{{CRUDBooster::adminPath()}}' class='nav-link {{($dashboard->color)?"text-".$dashboard->color:""}}'>
                        <i class="nav-icon fa fa-tachometer-alt"></i>
                        <p>
                            {{cbLang("text_dashboard")}}
                        </p>
                    </a>
                </li>
            @endif

            @foreach(CRUDBooster::sidebarMenu() as $menu)
                <li data-id='{{$menu->id}}' class='{{(!empty($menu->children))?"treeview":""}} {{ (Request::is($menu->url_path."*"))?"active":""}}'>
                    <a href='{{ ($menu->is_broken)?"javascript:alert('".cbLang('controller_route_404')."')":$menu->url }}'
                        class='{{($menu->color)?"text-".$menu->color:""}}'>
                        <i class='{{$menu->icon}} {{($menu->color)?"text-".$menu->color:""}}'></i> <span>{{$menu->name}}</span>
                        @if(!empty($menu->children))<i class="fa fa-angle-{{ cbLang("right") }} pull-{{ cbLang("right") }}"></i>@endif
                    </a>
                    @if(!empty($menu->children))
                        <ul class="treeview-menu">
                            @foreach($menu->children as $child)
                                <li data-id='{{$child->id}}' class='{{(Request::is($child->url_path .= !Str::endsWith(Request::decodedPath(), $child->url_path) ? "/*" : ""))?"active":""}}'>
                                    <a href='{{ ($child->is_broken)?"javascript:alert('".cbLang('controller_route_404')."')":$child->url}}'
                                        class='{{($child->color)?"text-".$child->color:""}}'>
                                        <i class='{{$child->icon}}'></i> <span>{{$child->name}}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach



            @if(CRUDBooster::isSuperadmin())
                <li class="nav-header">{{ cbLang('SUPERADMIN') }}</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-key"></i>
                    <p>
                        {{ cbLang('Privileges_Roles') }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ (Request::is(config('crudbooster.ADMIN_PATH').'/privileges/add*')) ? 'active' : '' }}">
                            <a href='{{Route("PrivilegesControllerGetAdd")}}' class="nav-link">
                                {{ isset($current_path)?:'' }}
                                <i class='nav-icon fa fa-plus'></i>
                                <span>{{ cbLang('Add_New_Privilege') }}</span>
                            </a>
                        </li>
                        <li class="nav-item {{ (Request::is(config('crudbooster.ADMIN_PATH').'/privileges')) ? 'active' : '' }}">
                            <a href='{{Route("PrivilegesControllerGetIndex")}}' class="nav-link">
                                <i class='nav-icon fa fa-bars'></i>
                                <span>{{ cbLang('List_Privilege') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                    <p>
                        {{ cbLang('Users_Management') }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ (Request::is(config('crudbooster.ADMIN_PATH').'/users/add*')) ? 'active' : '' }}">
                            <a href='{{Route("AdminCmsUsersControllerGetAdd")}}' class="nav-link">
                                {{ isset($current_path)?:'' }}
                                <i class='nav-icon fa fa-plus'></i>
                                <span>{{ cbLang('add_user') }}</span>
                            </a>
                        </li>
                        <li class="nav-item {{ (Request::is(config('crudbooster.ADMIN_PATH').'/users')) ? 'active' : '' }}">
                            <a href='{{Route("AdminCmsUsersControllerGetIndex")}}' class="nav-link">
                                <i class='nav-icon fa fa-bars'></i>
                                <span>{{ cbLang('List_users') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ (Request::is(config('crudbooster.ADMIN_PATH').'/menu_management*')) ? 'active' : '' }}">
                    <a href="{{ Route('MenusControllerGetIndex') }}" class="nav-link">
                        <i class="nav-icon fa fa-bars"></i>
                        <p>
                            {{ cbLang('Menu_Management') }}
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-wrench"></i>
                    <p>
                        {{ cbLang('settings') }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ (Request::is(config('crudbooster.ADMIN_PATH').'/settings/add*')) ? 'active' : '' }}">
                            <a href='{{Route("SettingsControllerGetAdd")}}' class="nav-link">
                                {{ isset($current_path)?:'' }}
                                <i class='nav-icon fa fa-plus'></i>
                                <span>{{ cbLang('Add_New_Setting') }}</span>
                            </a>
                        </li>
                        <?php
                        $groupSetting = DB::table('cms_settings')->groupby('group_setting')->pluck('group_setting');
                        foreach($groupSetting as $gs):
                        ?>
                        <li class="nav-item {{ <?=($gs == Request::get('group')) ? 'active' : ''?> }}">
                            <a href='{{route("SettingsControllerGetShow")}}?group={{urlencode($gs)}}&m=0' class="nav-link">
                                <i class='nav-icon fa fa-wrench'></i>
                                <span>{{ $gs }}</span>
                            </a>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-th"></i>
                    <p>
                        {{ cbLang('Module_Generator') }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ (Request::is(config('crudbooster.ADMIN_PATH').'/module_generator/add*')) ? 'active' : '' }}">
                            <a href='{{Route("ModulsControllerGetStep1")}}' class="nav-link">
                                {{ isset($current_path)?:'' }}
                                <i class='nav-icon fa fa-plus'></i>
                                <span>{{ cbLang('Add_New_Module') }}</span>
                            </a>
                        </li>
                        <li class="nav-item {{ (Request::is(config('crudbooster.ADMIN_PATH').'/module_generator')) ? 'active' : '' }}">
                            <a href='{{Route("ModulsControllerGetIndex")}}' class="nav-link">
                                <i class='nav-icon fa fa-bars'></i>
                                <span>{{ cbLang('List_Module') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-tachometer-alt"></i>
                    <p>
                        {{ cbLang('Statistic_Builder') }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ (Request::is(config('crudbooster.ADMIN_PATH').'/statistic_builder/add*')) ? 'active' : '' }}">
                            <a href='{{Route("StatisticBuilderControllerGetAdd")}}' class="nav-link">
                                {{ isset($current_path)?:'' }}
                                <i class='nav-icon fa fa-plus'></i>
                                <span>{{ cbLang('Add_New_Statistic') }}</span>
                            </a>
                        </li>
                        <li class="nav-item {{ (Request::is(config('crudbooster.ADMIN_PATH').'/statistic_builder')) ? 'active' : '' }}">
                            <a href='{{Route("StatisticBuilderControllerGetIndex")}}' class="nav-link">
                                <i class='nav-icon fa fa-bars'></i>
                                <span>{{ cbLang('List_Statistic') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-fire"></i>
                    <p>
                        {{ cbLang('API_Generator') }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ (Request::is(config('crudbooster.ADMIN_PATH').'/api_generator/generator*')) ? 'active' : '' }}">
                            <a href='{{Route("ApiCustomControllerGetGenerator")}}' class="nav-link">
                                <i class='nav-icon fa fa-plus'></i>
                                <span>{{ cbLang('Add_New_API') }}</span>
                            </a>
                        </li>
                        <li class="nav-item {{ (Request::is(config('crudbooster.ADMIN_PATH').'/api_generator')) ? 'active' : '' }}">
                            <a href='{{Route("ApiCustomControllerGetIndex")}}' class="nav-link">
                                <i class='nav-icon fa fa-bars'></i>
                                <span>{{ cbLang('list_API') }}</span>
                            </a>
                        </li>
                        <li class="nav-item {{ (Request::is(config('crudbooster.ADMIN_PATH').'/screet-key*')) ? 'active' : '' }}">
                            <a href='{{Route("ApiCustomControllerGetScreetKey")}}' class="nav-link">
                                <i class='nav-icon fa fa-bars'></i>
                                <span>{{ cbLang('Generate_Screet_Key') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-envelope"></i>
                    <p>
                        {{ cbLang('Email_Templates') }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ (Request::is(config('crudbooster.ADMIN_PATH').'/email_templates/add*')) ? 'active' : '' }}">
                            <a href='{{Route("EmailTemplatesControllerGetAdd")}}' class="nav-link">
                                {{ isset($current_path)?:'' }}
                                <i class='nav-icon fa fa-plus'></i>
                                <span>{{ cbLang('Add_New_Email') }}</span>
                            </a>
                        </li>
                        <li class="nav-item {{ (Request::is(config('crudbooster.ADMIN_PATH').'/email_templates')) ? 'active' : '' }}">
                            <a href='{{Route("EmailTemplatesControllerGetIndex")}}' class="nav-link">
                                <i class='nav-icon fa fa-bars'></i>
                                <span>{{ cbLang('List_Email_Template') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ (Request::is(config('crudbooster.ADMIN_PATH').'/logs*')) ? 'active' : '' }}">
                    <a href="{{ Route('LogsControllerGetIndex') }}" class="nav-link">
                        <i class="nav-icon fa fa-flag"></i>
                        <p>
                            {{ cbLang('Log_User_Access') }}
                        </p>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>