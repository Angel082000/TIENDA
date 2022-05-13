<?php
$alert = '';
session_start();
if (!empty($_SESSION['active'])) {
  header('location: sistema/');
   //  require_once('index.php');
} else {
  if (!empty($_POST)) {
    if (empty($_POST['usuario']) || empty($_POST['clave'])) {
      $alert = '<div class="alert alert-danger" role="alert">
  Ingrese su usuario y su clave
</div>';
    } else {
      require_once "conexion.php";
      $user = mysqli_real_escape_string($conexion, $_POST['usuario']);
      $clave = md5(mysqli_real_escape_string($conexion, $_POST['clave']));
      $query = mysqli_query($conexion, "SELECT u.idusuario, u.nombre, u.correo,u.usuario,r.idrol,r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol WHERE u.usuario = '$user' AND u.clave = '$clave'");
      mysqli_close($conexion);
      $resultado = mysqli_num_rows($query);
      if ($resultado > 0) {
        $dato = mysqli_fetch_array($query);
        $_SESSION['active'] = true;
        $_SESSION['idUser'] = $dato['idusuario'];
        $_SESSION['nombre'] = $dato['nombre'];
        $_SESSION['email'] = $dato['correo'];
        $_SESSION['user'] = $dato['usuario'];
        $_SESSION['rol'] = $dato['idrol'];
        $_SESSION['rol_name'] = $dato['rol'];
        header('location: sistema/');
      } else {
//        $alert = '<div class="alert alert-danger" role="alert">
//              Usuario o Contraseña Incorrecta
//            </div>';
           header('location: ./401.php');
        session_destroy();
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>TIENDA ONLINE</title>

  <!-- Custom fonts for this template-->
  <link href="sistema/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="sistema/css/sb-admin-2.min.css" rel="stylesheet">
   <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"
            />
        <link rel = "stylesheet" href="styles/styles.css">
        
           <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"
            />

</head>




<body  style="background-color: #15207D;">
    
    
     <div class="navbar-fixed">
    <nav>
        <div class="navbar navbar-expand navbar-light text-white topbar mb-4 static-top shadow" style="background-color: #001367;">

            <a href="#" class="brand-logo right"><img src="../images/campeche.png" alt="" width="290" height="70"  /></a>
            <ul id="nav-mobile" class="left hide-on-med-and-down">
                <li><h2><a href="../index.php">Inicio</a></h2></li>
             
             



            </ul>
        </div>
    </nav>
</div>
        
  <div class="container">
    
    <!-- Outer Row -->
    <div class="row justify-content-center">
 
      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-4">
            
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-7  ">
                  <img src="sistema/img/venta.png" class="img-thumbnail" width="1200px" height="1200px">
              </div>
              <div class="col-lg-5">
                <div class="p-5">
                  <div class="text-center">
                    
                    <h1 class="h4 text-gray-900 mb-4">Iniciar Sesión</h1>
                    <h2 class="h4 text-gray-900 mb-4">¡Ingresa y compra grandes productos!</h2>
                  </div>
                  <form class="user" method="POST">
                    <?php echo isset($alert) ? $alert : ""; ?>
                    <div class="form-group">
                      <label for="">Usuario</label>
                      <input type="text" class="form-control" placeholder="Usuario" name="usuario"></div>
                    <div class="form-group">
                      <label for="">Contraseña</label>
                      <input type="password" class="form-control" placeholder="Contraseña" name="clave">
                    </div>
                    <input type="submit" value="Iniciar" class="btn btn-primary">
                    <hr>
                  </form>
                  <hr>
                </div>
                  ¿No estás registrado?
                   <div class="card o-hidden border-0 shadow-lg my-4">
             <a href="registro_usuario_1.php" style="background-color: #E41919" class="btn btn-danger">Registrate aquí</a>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="sistema/vendor/jquery/jquery.min.js"></script>
  <script src="sistema/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="sistema/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="sistema/js/sb-admin-2.min.js"></script>

</body>

</html>