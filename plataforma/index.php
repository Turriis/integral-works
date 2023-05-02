<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>HM Consultores | Ingresar</title>
  <link rel="stylesheet" href="vendors/typicons/typicons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="resources/css/vertical-layout-light/style.css">
  <link rel="stylesheet" href="resources/css/style.css">
  <link rel="shortcut icon" href="resources/images/favicon.png" />
</head>

<body>
  <div id="loader" class="center"></div>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="logo-pages-intro">
                <img src="resources/images/logo.jpeg" alt="logo">
              </div>
              <h4>HM Consultores Admin</h4>
              <h6 class="font-weight-light">Ingresa con tus credenciales.</h6>
              <form id="form-login" class="pt-3">
                <div class="form-group">
                  <input name="email" type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Correo electrónico">
                </div>
                <div class="form-group">
                  <input name="password" type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Contraseña">
                </div>
                <div class="mt-3">
                  <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn btn-hm-consultores" href="javascript:void(0)" onclick="login()">INGRESAR</a>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <a href="recovery.php" class="auth-link text-black">Recuperar contraseña</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="resources/js/functions.js"></script>
  <script src="resources/js/off-canvas.js"></script>
  <script src="resources/js/hoverable-collapse.js"></script>
  <script src="resources/js/template.js"></script>
  <script src="resources/js/settings.js"></script>
  <script src="resources/js/todolist.js"></script>
  <script>
    window.onload = checkSession2;
  </script>
</body>

</html>