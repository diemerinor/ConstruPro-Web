<!DOCTYPE html>
<html lang="en">
<?php
include('conexion.php');
session_start();
if (isset($_SESSION['loggeado'])) {
    header('Location: index.php');
}
$errores = '';
$enviado = '';
$rut = '';
$clave2 = '';
$idusuario = null;
//$clave2 = '';

?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block " style="background: url(images/destination-4.jpg); background-size: cover;"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Bienvenido!</h1>
                                    </div>
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <input name="usuario" class="form-control" id="exampleFormControlInput1" placeholder="Username">
                                        </div>

                                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <input type="password" name="clave" class="form-control" id="exampleFormControlInput1" placeholder="Password">
                                            </div>
                                            <button type="submit" class="btn btn-block" style="background:black; color:white; margin-top:25px; font-size: 20px;" name="submit" onclick="login.submit()">Ingresar</button>

                                        </form>
                                        <?php

                                        if (isset($_POST['submit'])) {
                                            $usuario = $_POST['usuario'];
                                            $clave = $_POST['clave'];

                                            //$clave = hash('sha256',$clave);

                                            //MUESTRA DE ERROR Y ACCESO   
                                            if (empty($usuario) or empty($clave)) {
                                                $errores .= 'Ingrese todos los datos';
                                            } else if (empty($usuario) && empty($clave)) {
                                                $errores .= 'Ingrese todos los datos';
                                            } else {

                                                $consulta = "SELECT * from usuario WHERE nombreusuario='" . $usuario . "'";
                                                $resultado = $conexion->query($consulta);
                                                while ($consultausuario = mysqli_fetch_array($resultado)) {
                                                    $clave2 = $consultausuario["password"];
                                                    $idusuario = $consultausuario["idusuario"];
                                                    $tipo = $consultausuario["codigorol"];
                                                }

                                                if (!$clave2) {
                                                    $errores = 'El usuario o la contraseña no es correcta';
                                                } else if ($clave == $clave2) {
                                                    $_SESSION['loggeado'] = $idusuario;
                                                    header('Location: index.php');
                                                } else {
                                                    $errores = 'El usuario o la contraseña no es correcta';
                                                }
                                            }
                                        } ?>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="forgot-password.html">¿Olvidaste la contraseña?</a>
                                        </div>
                                        <div class="text-center">
                                            <a class="small" href="register.html">Crea una cuenta</a>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>