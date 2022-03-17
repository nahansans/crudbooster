<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
            </a>
        </li>

        
        <!-- User Account Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <img src="{{ CRUDBooster::myPhoto() }}" class="user-image" alt="User Image" style="width: 25px; height: 25px; border-radius: 50%;"/>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-item dropdown-header">
                    <img src="{{ CRUDBooster::myPhoto() }}" class="img-circle" alt="User Image" style="z-index: 5; height: 90px; width: 90px; border: 3px solid; border-color: transparent; border-color: rgba(255,255,255,0.2); border-radius: 50%;"/>
                    <p class="d-flex flex-column ">
                        {{ CRUDBooster::myName() }}
                        <small>{{ CRUDBooster::myPrivilegeName() }}</small>
                        <small><em><?php echo date('d F Y')?></em></small>
                    </p>
                </div>
                <div class="dropdown-divider"></div>
                <a href="{{ route('AdminCmsUsersControllerGetProfile') }}" class="dropdown-item">
                    <i class="fa fa-user mr-2"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('getLockScreen') }}" class="dropdown-item">
                    <i class="fa fa-key mr-2"></i> Lock Screen
                </a>
                <div class="dropdown-divider"></div>
                <a href="javascript:void(0)" onclick="swal({
                    title: '{{cbLang('alert_want_to_logout')}}',
                    type:'info',
                    showCancelButton:true,
                    allowOutsideClick:true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: '{{cbLang('button_logout')}}',
                    cancelButtonText: '{{cbLang('button_cancel')}}',
                    closeOnConfirm: false
                    }, function(){
                    location.href = '{{ route("getLogout") }}';

                    });" class="dropdown-item text-danger">
                    <i class="fa fa-power-off mr-2"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->