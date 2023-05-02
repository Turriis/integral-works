<!DOCTYPE html>
<html lang="en">

<?php include '../../includes/head.php'; ?>
<body>
  <div id="loader" class="center"></div>
  <div class="container-scroller">
    <?php include '../../includes/navbar.php'; ?>
    <!-- Aqui termina el nav de la pagina -->
    <nav class="navbar-breadcrumb col-xl-12 col-12 d-flex flex-row p-0">
      <div class="navbar-links-wrapper d-flex align-items-stretch">
        <div class="nav-link">
          <a href="javascript:;"><i class="typcn typcn-calendar-outline"></i></a>
        </div>
        <div class="nav-link">
          <a href="javascript:;"><i class="typcn typcn-mail"></i></a>
        </div>
        <div class="nav-link">
          <a href="javascript:;"><i class="typcn typcn-folder"></i></a>
        </div>
        <div class="nav-link">
          <a href="javascript:;"><i class="typcn typcn-document-text"></i></a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item ml-0">
            <h4 class="mb-0">Clientes</h4>
          </li>
          <!-- <li class="nav-item">
            <div class="d-flex align-items-baseline">
              <p class="mb-0">Inicio</p>
              <i class="typcn typcn-chevron-right"></i>
              <p class="mb-0">Clientes</p>
            </div>
          </li> -->
        </ul>
        <ul class="navbar-nav navbar-nav-right">
        </ul>
      </div>
    </nav>
    <!-- Aqui termina el nav de la pagina -->

    <!-- Div que contiene todo lo de abajo del header -->
    <div class="container-fluid page-body-wrapper">
      <!-- Menu que se carga con javascript segun los privilegios -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar"></nav>
      <!-- Fin de menu que se carga con javascript segun los privilegios -->

      <!-- Seccion principal -->
      <div class="main-panel">
        <div class="content-wrapper">
          <!-- Aqui cargamos segun lo que necesitemos (Lista de usuarios) -->
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="table-responsive pt-3">
                  <table class="table table-striped project-orders-table">
                    <thead>
                      <tr>
                        <th>
                          <button onclick="openPage('create.php');" type="button" class="btn btn-primary btn-sm btn-icon-text mr-1">Agregar<i class="typcn typcn-plus-outline btn-icon-append"></i></button>
                        </th>
                      </tr>
                      <tr>
                        <!-- <th>ID</th> -->
                        <th>Nombre</th>
                        <th>Correo electrónico</th>
                        <th>RFC</th>
                        <th>Teléfono</th>
                        <th>Tipo</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                      </tr>
                      <tr>
                        <!-- <th><input id="client_id_filt" onkeypress='filterClients(event);' value='<?php echo $_GET['client_id_filt'] ?>' class='input-filter'></th> -->
                        <th><input id="client_name_filt" onkeypress='filterClients(event);' value='<?php echo $_GET['client_name_filt'] ?>' class='input-filter'></th>
                        <th><input id="client_email_filt" onkeypress='filterClients(event);' value='<?php echo $_GET['client_email_filt'] ?>' class='input-filter'></th>
                        <th><input id="client_rfc_filt" onkeypress='filterClients(event);' value='<?php echo $_GET['client_rfc_filt'] ?>' class='input-filter'></th>
                        <th><input id="client_phone_filt" onkeypress='filterClients(event);' value='<?php echo $_GET['client_phone_filt'] ?>' class='input-filter'></th>
                        <th><input id="client_type_filt" onkeypress='filterClients(event);' value='<?php echo $_GET['client_type_filt'] ?>' class='input-filter'></th>
                        <th><input id="client_disabled_filt" onkeypress='filterClients(event);' value='<?php echo $_GET['client_disabled_filt'] ?>' class='input-filter'></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody id="table-list-clients"></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <nav aria-label="Page navigation example">
            <ul id="paginate-list-clients" class="pagination"></ul>
          </nav>
          <!-- Fin del contenedor que es en especifico de la seccion -->
        </div>
        <!-- Cargamos el footer -->
        <?php include '../../includes/footer.php'; ?>
        <!-- Fin del footer -->
      </div>
      <!-- Fin de seccion principal -->

    </div>
    <!-- Fin del div que contiene todo lo de abajo del header -->
   
  </div>
  <!-- Fin de container-scroller -->

  <?php include '../../includes/scripts.php'; ?>
  
  <script>
      //Funcion para validar sesión 
      window.onload = checkSession;
      //Funcion para obtener datos de la sesión
      getSession();
      //Funcion para inicializar el menu del lado izquierdo
      initMenu();
      //Funcion para poner la fecha actual
      currentDateNavBar();
      //Verificamos los privilegios del archivo
      const privilege = ['1'];
      verifyPrivileges(privilege);
      //Funciones en especifico del archivo
      //Funcion para obtener el listado de los usuarios registrados en el sistema
      getListClients();
      
  </script>
</body>

</html>

