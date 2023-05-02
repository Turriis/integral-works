<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex justify-content-center">
    <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
        <a class="logo-integral-dashboard" href="http://cencerro.com.mx/hmconsultores/dashboard.php"><img src="../../resources/images/logo.jpeg" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="http://cencerro.com.mx/hmconsultores/dashboard.php"><img src="../../resources/images/logo-mini.svg" alt="logo"/></a>
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="typcn typcn-th-menu"></span>
        </button>
    </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <ul class="navbar-nav mr-lg-2">
        <li class="nav-item nav-profile dropdown item-activate-user-info" style="display: flex !important;">
        <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
            <img id="img-session" src="../../resources/images/faces/user.png" alt="image"/>
            <span id="lbl-name-session" class="nav-profile-name"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a href="http://cencerro.com.mx/hmconsultores/sections/perfil/myinfo.php" class="dropdown-item">
                <i class="typcn typcn-cog-outline text-primary"></i>
                Mi perfil
              </a>
            <a onclick="closeSession();" class="dropdown-item">
            <i class="typcn typcn-eject text-primary"></i>
            Cerrar sesión
            </a>
        </div>
        </li>
    </ul>
    <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item nav-date dropdown">
        <a class="nav-link d-flex justify-content-center align-items-center" href="javascript:;">
            <h6 id="current-date" class="date mb-0"></h6>
            <i class="typcn typcn-calendar"></i>
        </a>
        </li>
        <li class="nav-item dropdown mr-0">
        <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
            <i class="typcn typcn-bell mx-0"></i>
            <span class="count"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
            <p class="mb-0 font-weight-normal float-left dropdown-header">Notificaciones</p>
            <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
                <div class="preview-icon bg-danger">
                <i class="typcn typcn-info mx-0"></i>
                </div>
            </div>
            <div class="preview-item-content">
                <h6 class="preview-subject font-weight-normal">Ver</h6>
                <p class="font-weight-light small-text mb-0 text-muted">
                (2) nuevos
                </p>
            </div>
            </a>
        </div>
    </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="typcn typcn-th-menu"></span>
    </button>
    </div>
</nav>