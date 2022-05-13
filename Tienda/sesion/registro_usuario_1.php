<?php // include_once "../views/header.php";
include "../conexion.php";
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave'])  || empty($_POST['telefono']) || empty($_POST['direccion'])  ) {
        $alert = '<div class="alert alert-primary" role="alert">
                    Todo los campos son obligatorios
                </div>';
    } else {

        $nombre = $_POST['nombre'];
        $email = $_POST['correo'];
        $user = $_POST['usuario'];
        $clave = md5($_POST['clave']);
        $rol = 2;
        $telefono=$_POST['telefono'];
         $direccion=$_POST['direccion'];

        $query = mysqli_query($conexion, "SELECT * FROM usuario where correo = '$email'");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                        El correo ya existe
                    </div>';
        } else {
            $query_insert = mysqli_query($conexion, "INSERT INTO usuario(nombre,correo,usuario,clave,rol,telefono,direccion) values ('$nombre', '$email', '$user', '$clave', '$rol','$telefono','$direccion')");
            
          $query_ = mysqli_query($conexion, "INSERT INTO cliente(nombre,telefono,direccion) values ('$nombre','$telefono','$direccion')");
            
            if ($query_insert && $query_) {
                $alert = '<div class="alert alert-primary" role="alert">
                            Usuario registrado
                        </div>';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                        Error al registrar
                    </div>';
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




<body class="bg-light">

     

    
    <div class="navbar-fixed">
    <nav>
        <div class="navbar navbar-expand navbar-light text-white topbar mb-4 static-top shadow" style="background-color: #001367;">

            <a href="#" class="brand-logo right"><img src="../images/campeche.png" alt="" width="290" height="70"  /></a>
            <ul id="nav-mobile" class="left hide-on-med-and-down">
                <li><a href="../index.php">Inicio</a></li>
             
                <li><a href="index.php">Iniciar Sesión</a></li>



            </ul>
        </div>
    </nav>
</div>
    
    
    
    
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="">
      
        <h1 class="h3 mb-0 text-blue-1000">PANEL DE REGISTRO</h1>
       
 <h4 class="h3 mb-0 text-gray-800">Registrate y disfruta haciendo compras con nosotros.</h4>
    </div>
 
        
    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 m-auto">
            <form action="" method="post" autocomplete="off">
                <?php echo isset($alert) ? $alert : ''; ?>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" placeholder="Ingrese Nombre" name="nombre" id="nombre">
                </div>
                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="email" class="form-control" placeholder="Ingrese Correo Electrónico" name="correo" id="correo">
                </div>
                <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <input type="text" class="form-control" placeholder="Ingrese Usuario" name="usuario" id="usuario">
                </div>
                <div class="form-group">
                    <label for="clave">Contraseña</label>
                    <input type="password" class="form-control" placeholder="Ingrese Contraseña" name="clave" id="clave">
                </div>
                
                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="text" class="form-control" placeholder="Ingrese Número telefónico" name="telefono" id="telefono">
                </div><!-- comment -->
                <div class="form-group">
                    <label for="direccion">Direccion</label>
                    <input type="text" class="form-control" placeholder="Ingrese su dirección" name="direccion" id="direccion">
                </div>
                
                
                
             
                <input type="submit" value="Registrate" class="btn btn-primary">
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

  <!-- Bootstrap core JavaScript-->
  <script src="sistema/vendor/jquery/jquery.min.js"></script>
  <script src="sistema/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="sistema/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="sistema/js/sb-admin-2.min.js"></script>

</body>

</html>




















