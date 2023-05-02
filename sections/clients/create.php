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
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Crear cliente</h4>
                  <p class="card-description">
                    Por favor completa los campos obligatorios (*)
                  </p>
                  <form id="form-create-client" class="forms-sample">
                    <div class="form-group">
                      <label for="pass-user">¿Es empresa?</label>
                      <select onchange="configEnterprise(this.value);" name="is_enterprise" id="is_enterprise" class="form-control form-control-lg">
                        <option selected value="0">No</option>  
                        <option value="1">Si</option>
                      </select>
                      <input type="hidden" class="form-control" id="flag-enterprise" name="flag-enterprise" value="0">
                    </div>
                    <div id="container-name" class="form-group">
                      <label for="name-client">* Nombre(s)</label>
                      <input type="text" class="form-control" id="name-client" name="name-client" placeholder="Escribe el nombre">
                    </div>
                    <div id="container-lastname" class="form-group">
                      <label for="lastname-client">Apellidos</label>
                      <input type="text" class="form-control" id="lastname-client" name="lastname-client" placeholder="Apellidos">
                    </div>
                    <div id="container-name-enterprise" style="display: none;" class="form-group">
                      <label for="name-enterprise">* Nombre</label>
                      <input type="text" class="form-control" id="name-enterprise" name="name-enterprise" placeholder="Escribe el nombre de la empresa">
                    </div>
                    <div class="form-group">
                      <label for="email-client">* Corrreo electrónico</label>
                      <input type="text" class="form-control" id="email-client" name="email-client" placeholder="Correo electrónico">
                    </div>
                    <div class="form-group">
                      <label for="phone-client">Teléfono</label>
                      <input type="number" class="form-control" id="phone-client" name="phone-client" placeholder="Teléfono">
                    </div>
                    <div class="form-group">
                      <label for="rfc-client">* RFC</label>
                      <input type="text" class="form-control" id="rfc-client" name="rfc-client" placeholder="RFC">
                    </div>
                    <div class="form-group">
                      <label for="address-client">Dirección</label>
                      <input type="text" class="form-control" id="address-client" name="address-client" placeholder="Dirección">
                    </div>
                    <div class="form-group">
                      <label for="pass-client">Contraseña</label>
                      <input type="password" class="form-control" id="pass-client" name="pass-client" placeholder="Contraseña">
                    </div>
                    <div class="form-group">
                      <label for="confirm-pass-client">Confirma la contraseña</label>
                      <input type="password" class="form-control" id="confirm-pass-client" name="confirm-pass-client" placeholder="Confirma la contraseña">
                    </div>
                    <div class="form-group">
                      <label for="credit-days-client">Días de crédito</label>
                      <input type="number" class="form-control" id="credit-days-client" name="credit-days-client" placeholder="Días de crédito">
                    </div>
                    <div id="container-contact-name-enterprise" style="display: none;" class="form-group">
                      <label for="client_contact_name">Nombre de contacto</label>
                      <input type="text" class="form-control" id="client_contact_name" name="client_contact_name" placeholder="Escribe el nombre del contacto">
                    </div>
                    <div id="container-contact-phone-enterprise" style="display: none;" class="form-group">
                      <label for="client_contact_phone">Teléfono de contacto</label>
                      <input type="text" class="form-control" id="client_contact_phone" name="client_contact_phone" placeholder="Escribe el teléfono del contacto">
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
                    
                    <button onclick="createClient();" type="button" class="btn btn-primary mr-2">Crear cliente</button>
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
      //Verificamos los privilegios del archivo
      const privilege = ['1'];
      verifyPrivileges(privilege);
  </script>
</body>

</html>

