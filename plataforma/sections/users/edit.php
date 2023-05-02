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
            <h4 class="mb-0">Usuarios</h4>
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
          <!-- Aqui cargamos segun lo que necesitemos (Lista de usuarios) -->
          <div class="row">
          <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Actualizar usuario</h4>
                  <p class="card-description">
                    Por favor completa los campos obligatorios (*)
                  </p>
                  <form id="form-edit-user" class="forms-sample">
                    <div class="form-group">
                      <label for="name-user">* Nombre(s)</label>
                      <input type="text" class="form-control" id="edit-name-user" name="edit-name-user" placeholder="Escribe el nombre">
                    </div>
                    <div class="form-group">
                      <label for="lastname-user">Apellidos</label>
                      <input type="text" class="form-control" id="edit-lastname-user" name="edit-lastname-user" placeholder="Escribe los apellidos">
                    </div>
                    <div class="form-group">
                      <label for="email-user">* Correo electrónico</label>
                      <input type="email" class="form-control" id="edit-email-user" name="edit-email-user" placeholder="Escribe el correo electrónico">
                    </div>
                    <div class="form-group">
                      <label for="pass-user">* Perfil</label>
                      <select name="edit-perfil" id="edit-perfil" class="form-control form-control-lg">
                        <option>Perfil</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="edit-status-user">* Estatus</label>
                      <select name="edit-status-user" id="edit-status-user" class="form-control form-control-lg">
                        <option value="">Selecciona una opción</option>
                        <option value="0">Activo</option>
                        <option value="1">Inactivo</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Imagen de perfil</label>
                      <input type="file" name="img[]" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Imagen">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Elegir</button>
                        </span>
                      </div>
                    </div>
                    <input type="hidden" class="form-control" name="id" value="<?php echo $_GET['id']; ?>">
                    <button onclick="saveUser();" type="button" class="btn btn-primary mr-2">Actualizar usuario</button>
                    <button onclick="openPage('change-password.php?id=<?php echo $_GET['id']; ?>');" type="button" class="btn btn-success mr-2">Cambiar contraseña</button>
                  </form>
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
      //Funciones en especifico del archivo
      //Funcion para obtener la informacion del usuario
      getInfoUser();
  </script>
</body>

</html>

