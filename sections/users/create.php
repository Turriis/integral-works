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
                  <h4 class="card-title">Crear usuario</h4>
                  <p class="card-description">
                    Por favor completa los campos obligatorios (*)
                  </p>
                  <form id="form-create-user" class="forms-sample">
                    <div class="form-group">
                      <label for="name-user">* Nombre(s)</label>
                      <input type="text" class="form-control" id="name-user" name="name-user" placeholder="Escribe el nombre">
                    </div>
                    <div class="form-group">
                      <label for="lastname-user">Apellidos</label>
                      <input type="text" class="form-control" id="lastname-user" name="lastname-user" placeholder="Escribe los apellidos">
                    </div>
                    <div class="form-group">
                      <label for="email-user">* Correo electrónico</label>
                      <input type="email" class="form-control" id="email-user" name="email-user" placeholder="Escribe el correo electrónico">
                    </div>
                    <div class="form-group">
                      <label for="pass-user">* Contraseña</label>
                      <input type="password" class="form-control" id="pass-user" name="pass-user" placeholder="Escribe la contraseña">
                    </div>
                    <div class="form-group">
                      <label for="confirm-pass-user">* Confirmar contraseña</label>
                      <input type="password" class="form-control" id="confirm-pass-user" name="confirm-pass-user" placeholder="Confirma la contraseña">
                    </div>
                    <div class="form-group">
                      <label for="pass-user">* Perfil</label>
                      <select name="perfil" id="perfil" class="form-control form-control-lg">
                        <option>Perfil</option>
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

                    <button onclick="createUser();" type="button" class="btn btn-primary mr-2">Crear usuario</button>
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
      //Funciones en especifico del archivo
      //Funcion para obtener el listado de los privilegios
      getPrivileges();
  </script>
</body>

</html>

