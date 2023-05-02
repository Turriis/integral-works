<!DOCTYPE html>
<html lang="en">

<?php include '../../includes/head.php'; ?>
<body>
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
            <h4 class="mb-0">Mi Perfil</h4>
          </li>
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
          <!-- Aqui cargamos segun lo que necesitemos (Info del usuario) -->
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Información basica</h4>
                  <form id="form-perfil-basic" class="forms-sample">
                    <div class="form-group">
                      <label for="name-perfil">Nombre(s)</label>
                      <input type="text" class="form-control" id="name-perfil" name="name-perfil" placeholder="Nombre(s)">
                    </div>
                    <div id="container-lastname-perfil" class="form-group">
                      <label for="name-perfil">Apellidos</label>
                      <input type="text" class="form-control" id="lastname-perfil" name="lastname-perfil" placeholder="Apellidos">
                    </div>
                    <div class="form-group">
                      <label for="email-perfil">Correo electrónico</label>
                      <input type="email" class="form-control" id="email-perfil" name="email-perfil" disabled placeholder="Correo electrónico">
                    </div>
                    <div id="container-image-perfil" class="form-group">
                      <label>Imagen de perfil</label>
                      <input type="file" name="img[]" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Imagen">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Elegir</button>
                        </span>
                      </div>
                    </div>
                    <button id="btn-save-info-basic" type="button" class="btn btn-primary mr-2">Guardar</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Cambiar contraseña</h4>
                  <form id="form-perfil-password" class="forms-sample">
                    <div class="form-group">
                      <label for="name-perfil">Nueva contraseña</label>
                      <input type="password" class="form-control" id="new-pass-perfil" name="edit-pass-user" placeholder="*******">
                    </div>
                    <div class="form-group">
                      <label for="name-perfil">Confirmar contraseña</label>
                      <input type="password" class="form-control" id="new-pass-c-perfil" name="new-pass-c-perfil" placeholder="*******">
                    </div>
                    <button id="btn-save-info-pass" type="button" class="btn btn-primary mr-2">Cambiar contraseña</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
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
      //Funciones en especifico del archivo
      //Funcion para obtener el listado de los usuarios registrados en el sistema
      getMyInfo();
  </script>
</body>

</html>

