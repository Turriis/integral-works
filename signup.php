<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>HM Consultores | Crear cuenta</title>
  <link rel="stylesheet" href="vendors/typicons/typicons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="resoruces/css/vertical-layout-light/style.css">
  <link rel="stylesheet" href="resources/css/style.css">
  <link rel="shortcut icon" href="resoruces/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="logo-pages-intro">
                <img src="resoruces/images/logo.jpeg" alt="logo">
              </div>
              <h4>HM Consultores Admin</h4>
              <h6 class="font-weight-light">Llena los siguientes campos para crear la cuenta</h6>
              <form id="form-signup" class="pt-3">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="name" placeholder="Nombre(s)">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="lastname" placeholder="Apellidos">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="password" placeholder="Contraseña">
                </div>
                <div class="form-group">
                  <select name="perfil" id="perfil" class="form-control form-control-lg">
                    <option>Perfil</option>
                    <!-- <option>United States of America</option>
                    <option>United Kingdom</option>
                    <option>India</option>
                    <option>Germany</option>
                    <option>Argentina</option> -->
                  </select>
                </div>
                
                <div class="mb-4">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Acepto los términos y condiciones
                    </label>
                  </div>
                </div>
                <div class="mt-3">
                  <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="javascript:void(0)" onclick="signup()">CREAR CUENTA</a>
                </div>
                <div class="text-center mt-4 font-weight-light">
                 ¿Ya tienes una cuenta? <a href="index.php" class="text-primary">Ingresa</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="resoruces/js/functions.js"></script>
  <script src="resoruces/js/off-canvas.js"></script>
  <script src="resoruces/js/hoverable-collapse.js"></script>
  <script src="resoruces/js/template.js"></script>
  <script src="resoruces/js/settings.js"></script>
  <script src="resoruces/js/todolist.js"></script>
  <script>
      getPrivileges();
  </script>
</body>

</html>
