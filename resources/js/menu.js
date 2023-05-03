function initMenu(){

    //Obtenemos la sesion
    var session = JSON.parse(localStorage.getItem('sessionHM'));
    console.log(session.privileges);

    //Menu para superadmin
    if(session.privileges == '1'){
        document.getElementById("sidebar").innerHTML = '<ul class="nav">'+
        '<li class="nav-item">'+
        '<a class="nav-link" href="http://localhost/integral-works/dashboard.php">'+
            '<i class="typcn typcn-device-desktop menu-icon"></i>'+
            '<span class="menu-title">Dashboard</span>'+
        '</a>'+
        '</li>'+
        '<li class="nav-item">'+
        '<a class="nav-link" href="http://localhost/integral-works/sections/users/list.php">'+
            '<i class="fas fa-users"></i>'+
            '<span class="menu-title">Usuarios</span>'+
        '</a>'+
        '</li>'+
        '<li class="nav-item">'+
        '<a class="nav-link" data-toggle="collapse" href="#ui-catalog" aria-expanded="false" aria-controls="ui-basic">'+
            '<i class="fas fa-user-tie"></i>'+
                '<span class="menu-title">Catálogo</span>'+
            '<i class="menu-arrow"></i>'+
        '</a>'+
        '<div class="collapse" id="ui-catalog">'+
            '<ul class="nav flex-column sub-menu">'+
            '<li class="nav-item"> <a class="nav-link" href="#">Oficinas</a></li>'+
            '<li class="nav-item"> <a class="nav-link" href="#">Dependencias</a></li>'+
            '</ul>'+
        '</div>'+
        '</li>'+
        '<li class="nav-item">'+
        '<a class="nav-link" data-toggle="collapse" href="#ui-clients" aria-expanded="false" aria-controls="ui-basic">'+
            '<i class="fas fa-star"></i>'+
                '<span class="menu-title">Clientes</span>'+
            '<i class="menu-arrow"></i>'+
        '</a>'+
        '<div class="collapse" id="ui-clients">'+
            '<ul class="nav flex-column sub-menu">'+
            '<li class="nav-item"> <a class="nav-link" href="http://localhost/integral-works/sections/clients/list.php">Lista</a></li>'+
            '</ul>'+
        '</div>'+
        '</li>'+
    '</ul>';
    }


    if (session.privileges == '2') {
        document.getElementById("sidebar").innerHTML = '<ul class="nav">'+
        '<li class="nav-item">'+
        '<a class="nav-link" href="http://localhost/integral-works/dashboard.php">'+
            '<i class="typcn typcn-device-desktop menu-icon"></i>'+
            '<span class="menu-title">Dashboard</span>'+
        '</a>'+
        '</li>'+
        '<li class="nav-item">'+
        '<a class="nav-link" href="http://localhost/integral-works/sections/users/list.php">'+
            '<i class="fas fa-box-open"></i>'+
            '<span class="menu-title">Inventario</span>'+
        '</a>'+
        '</li>'+
        '<li class="nav-item">'+
        '<a class="nav-link" href="http://localhost/integral-works/sections/users/list.php">'+
            '<i class="fas fa-receipt"></i>'+
            '<span class="menu-title">Nominas</span>'+
        '</a>'+
        '</li>'+
        '<li class="nav-item">'+
        '<a class="nav-link" data-toggle="collapse" href="#ui-empleados" aria-expanded="false" aria-controls="ui-basic">'+
            '<i class="fas fa-user-tie"></i>'+
                '<span class="menu-title">Empleados</span>'+
            '<i class="menu-arrow"></i>'+
        '</a>'+
        '<div class="collapse" id="ui-empleados">'+
            '<ul class="nav flex-column sub-menu">'+
            '<li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Asistencias</a></li>'+
            '<li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Bonos</a></li>'+
            '<li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Reportes</a></li>'+
            '</ul>'+
        '</div>'+
        '</li>'+
        '<li class="nav-item">'+
        '<a class="nav-link" data-toggle="collapse" href="#ui-vehiculos" aria-expanded="false" aria-controls="ui-basic">'+
            '<i class="fas fa-truck-pickup"></i>'+
            '<span class="menu-title">Vehiculos</span>'+
            '<i class="menu-arrow"></i>'+
        '</a>'+
        '<div class="collapse" id="ui-vehiculos">'+
            '<ul class="nav flex-column sub-menu">'+
            '<li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Catálogo</a></li>'+
            '<li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Servicios</a></li>'+
            '</ul>'+
        '</div>'+
        '</li>'+
        '<li class="nav-item">'+
        '<a class="nav-link" href="https://bootstrapdash.com/demo/polluxui-free/docs/documentation.html">'+
            '<i class="fas fa-file-invoice-dollar"></i>'+
            '<span class="menu-title">Cotizaciones</span>'+
        '</a>'+
        '</li>'+
        '<li class="nav-item">'+
        '<a class="nav-link" href="https://bootstrapdash.com/demo/polluxui-free/docs/documentation.html">'+
            '<i class="fas fa-file-invoice"></i>'+
            '<span class="menu-title">Facturación</span>'+
        '</a>'+
        '</li>'+
        '<li class="nav-item">'+
        '<a class="nav-link" href="https://bootstrapdash.com/demo/polluxui-free/docs/documentation.html">'+
            '<i class="fas fa-money-bill"></i>'+
            '<span class="menu-title">Pagos</span>'+
        '</a>'+
        '</li>'+
    '</ul>';
    }

    if (session.privileges == '3') {
        document.getElementById("sidebar").innerHTML = '<ul class="nav">'+
        '<li class="nav-item">'+
        '<a class="nav-link" href="http://localhost/integral-works/dashboard.php">'+
            '<i class="typcn typcn-device-desktop menu-icon"></i>'+
            '<span class="menu-title">Dashboard</span>'+
        '</a>'+
        '</li>'+
        '<li class="nav-item">'+
        '<a class="nav-link" data-toggle="collapse" href="#ui-empleados" aria-expanded="false" aria-controls="ui-basic">'+
            '<i class="fas fa-user-tie"></i>'+
                '<span class="menu-title">Empleados</span>'+
            '<i class="menu-arrow"></i>'+
        '</a>'+
        '<div class="collapse" id="ui-empleados">'+
            '<ul class="nav flex-column sub-menu">'+
            '<li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Asistencias</a></li>'+
            '<li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Bonos</a></li>'+
            '<li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Reportes</a></li>'+
            '</ul>'+
        '</div>'+
        '</li>'+
    '</ul>';
    }


if (session.privileges == '4') {
    document.getElementById("sidebar").innerHTML = '<ul class="nav">'+
    '<li class="nav-item">'+
    '<a class="nav-link" href="http://localhost/integral-works/dashboard.php">'+
        '<i class="typcn typcn-device-desktop menu-icon"></i>'+
        '<span class="menu-title">Dashboard</span>'+
    '</a>'+
    '</li>'+
    '<li class="nav-item">'+
    '<a class="nav-link" href="http://localhost/integral-works/sections/users/list.php">'+
        '<i class="fas fa-receipt"></i>'+
        '<span class="menu-title">Nominas</span>'+
    '</a>'+
    '</li>'+
'</ul>';
}

if (session.privileges == '5') {
    document.getElementById("sidebar").innerHTML = '<ul class="nav">'+
    '<li class="nav-item">'+
    '<a class="nav-link" href="http://localhost/integral-works/dashboard.php">'+
        '<i class="typcn typcn-device-desktop menu-icon"></i>'+
        '<span class="menu-title">Dashboard</span>'+
    '</a>'+
    '</li>'+
    '<li class="nav-item">'+
        '<a class="nav-link" href="http://localhost/integral-works/sections/users/list.php">'+
            '<i class="fas fa-box-open"></i>'+
            '<span class="menu-title">Inventario</span>'+
        '</a>'+
    '</li>'+
    '<li class="nav-item">'+
        '<a class="nav-link" data-toggle="collapse" href="#ui-vehiculos" aria-expanded="false" aria-controls="ui-basic">'+
            '<i class="fas fa-truck-pickup"></i>'+
            '<span class="menu-title">Vehiculos</span>'+
            '<i class="menu-arrow"></i>'+
        '</a>'+
        '<div class="collapse" id="ui-vehiculos">'+
            '<ul class="nav flex-column sub-menu">'+
            '<li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Catálogo</a></li>'+
            '<li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Servicios</a></li>'+
            '</ul>'+
        '</div>'+
    '</li>'+
    '<li class="nav-item">'+
        '<a class="nav-link" href="https://bootstrapdash.com/demo/polluxui-free/docs/documentation.html">'+
            '<i class="fas fa-money-bill"></i>'+
            '<span class="menu-title">Pagos</span>'+
        '</a>'+
    '</li>'+
'</ul>';
}

if (session.privileges == '6') {
    document.getElementById("sidebar").innerHTML = '<ul class="nav">'+
    '<li class="nav-item">'+
    '<a class="nav-link" href="http://localhost/integral-works/dashboard.php">'+
        '<i class="typcn typcn-device-desktop menu-icon"></i>'+
        '<span class="menu-title">Dashboard</span>'+
    '</a>'+
    '</li>'+
    '<li class="nav-item">'+
        '<a class="nav-link" href="https://bootstrapdash.com/demo/polluxui-free/docs/documentation.html">'+
            '<i class="fas fa-file-invoice"></i>'+
            '<span class="menu-title">Facturación</span>'+
        '</a>'+
    '</li>'+
    '<li class="nav-item">'+
        '<a class="nav-link" href="https://bootstrapdash.com/demo/polluxui-free/docs/documentation.html">'+
            '<i class="fas fa-money-bill"></i>'+
            '<span class="menu-title">Pagos</span>'+
        '</a>'+
    '</li>'+
'</ul>';
}

if (session.privileges == '7') {
    document.getElementById("sidebar").innerHTML = '<ul class="nav">'+
    '<li class="nav-item">'+
    '<a class="nav-link" href="http://localhost/integral-works/dashboard.php">'+
        '<i class="typcn typcn-device-desktop menu-icon"></i>'+
        '<span class="menu-title">Dashboard</span>'+
    '</a>'+
    '</li>'+
    '<li class="nav-item">'+
        '<a class="nav-link" data-toggle="collapse" href="#ui-empleados" aria-expanded="false" aria-controls="ui-basic">'+
            '<i class="fas fa-user-tie"></i>'+
                '<span class="menu-title">Empleados</span>'+
            '<i class="menu-arrow"></i>'+
        '</a>'+
        '<div class="collapse" id="ui-empleados">'+
            '<ul class="nav flex-column sub-menu">'+
            '<li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Asistencias</a></li>'+
            '<li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Bonos</a></li>'+
            '<li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Reportes</a></li>'+
            '</ul>'+
        '</div>'+
    '</li>'+
    '<li class="nav-item">'+
        '<a class="nav-link" href="https://bootstrapdash.com/demo/polluxui-free/docs/documentation.html">'+
            '<i class="fas fa-clipboard-check"></i>'+
            '<span class="menu-title">Mis asistencias</span>'+
        '</a>'+
    '</li>'+
'</ul>';
}

if (session.privileges == '8') {
    document.getElementById("sidebar").innerHTML = '<ul class="nav">'+
    '<li class="nav-item">'+
    '<a class="nav-link" href="http://localhost/integral-works/dashboard.php">'+
        '<i class="typcn typcn-device-desktop menu-icon"></i>'+
        '<span class="menu-title">Dashboard</span>'+
    '</a>'+
    '</li>'+
    '<li class="nav-item">'+
        '<a class="nav-link" data-toggle="collapse" href="#ui-reclutados" aria-expanded="false" aria-controls="ui-basic">'+
            '<i class="fas fa-users"></i>'+
                '<span class="menu-title">Mis reclutados</span>'+
            '<i class="menu-arrow"></i>'+
        '</a>'+
        '<div class="collapse" id="ui-reclutados">'+
            '<ul class="nav flex-column sub-menu">'+
            '<li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Seguimiento</a></li>'+
            '<li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Prospectos</a></li>'+
            '</ul>'+
        '</div>'+
    '</li>'+
    '<li class="nav-item">'+
        '<a class="nav-link" href="https://bootstrapdash.com/demo/polluxui-free/docs/documentation.html">'+
            '<i class="fas fa-clipboard-check"></i>'+
            '<span class="menu-title">Mis asistencias</span>'+
        '</a>'+
    '</li>'+
'</ul>';
}

if (session.privileges == '9') {
    document.getElementById("sidebar").innerHTML = '<ul class="nav">'+
    '<li class="nav-item">'+
    '<a class="nav-link" href="http://localhost/integral-works/dashboard.php">'+
        '<i class="typcn typcn-device-desktop menu-icon"></i>'+
        '<span class="menu-title">Dashboard</span>'+
    '</a>'+
    '</li>'+
    '<li class="nav-item">'+
    '<a class="nav-link" href="http://localhost/integral-works/sections/users/list.php">'+
        '<i class="fas fa-clipboard-check"></i>'+
        '<span class="menu-title">Mis asistencias</span>'+
    '</a>'+
    '</li>'+
'</ul>';
}

if (session.privileges == '10') {
    document.getElementById("sidebar").innerHTML = '<ul class="nav">'+
    '<li class="nav-item">'+
    '<a class="nav-link" href="http://localhost/integral-works/dashboard.php">'+
        '<i class="typcn typcn-device-desktop menu-icon"></i>'+
        '<span class="menu-title">Dashboard</span>'+
    '</a>'+
    '</li>'+
    '<li class="nav-item">'+
    '<a class="nav-link" href="http://localhost/integral-works/sections/my_debts/list.php">'+
        '<i class="fas fa-dollar-sign"></i>'+
        '<span class="menu-title">Cuentas por pagar</span>'+
    '</a>'+
    '</li>'+
    '<li class="nav-item">'+
    '<a class="nav-link" href="http://localhost/integral-works/sections/my_pays/list.php">'+
        '<i class="fas fa-credit-card"></i>'+
        '<span class="menu-title">Mis pagos</span>'+
    '</a>'+
    '</li>'+
'</ul>';
}

}