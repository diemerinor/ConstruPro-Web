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

    <title>Registrar usuario</title>

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
                                        <h1 class="h4 text-gray-900 mb-4">Crear usuario</h1>
                                    </div>
                                    <form action="crearcuenta.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group d-flex">
                                            <div class="col-lg-6">
                                                <label for="">Nombres</label>
                                                <input name="usuario" class="form-control" id="exampleFormControlInput1">
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="">Apellidos</label>
                                                <input name="apellidos" class="form-control" id="exampleFormControlInput1">
                                            </div>

                                        </div>
                                        <div class="form-group d-flex">
                                            <div class="col-lg-6">
                                                <label for="">Contraseña</label>
                                                <input type="password" name="clave" class="form-control" id="exampleFormControlInput1">
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="">Telefono</label>
                                                <input name="telefono" class="form-control" id="exampleFormControlInput1">
                                            </div>

                                        </div>
                                        <div class="form-group d-flex">
                                            <div class="col-lg-12">
                                                <label for="">Correo</label>
                                                <input name="correo" type="email" class="form-control" id="exampleFormControlInput1">
                                            </div>
                                        </div>


                                        <form action="crearcuenta.php" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                            </div>
                                            <button type="submit" class="btn btn-block" style="background:black; color:white; margin-top:25px; font-size: 20px;" name="submit" onclick="login.submit()">Registrar</button>

                                        </form>
                                        <?php

                                        if (isset($_POST['submit'])) {
                                            $usuario = $_POST['usuario'];
                                            $apellidos = $_POST['apellidos'];
                                            $telefono = $_POST['telefono'];
                                            $clave = $_POST['clave'];
                                            $correo = $_POST['correo'];

                                            $consulta = "SELECT * from usuario WHERE correousuario='" . $correo . "'";
                                            $resultado = $conexion->query($consulta);
                                            while ($consultausuario = mysqli_fetch_array($resultado)) {
                                                $idusuario = $consultausuario["idusuario"];
                                            }
                                            if ($idusuario != null) {
                                        ?>
                                                <div class="mt-2 alert alert-danger">
                                                    El correo ingresado ya está siendo utilizado
                                                </div>
                                            <?php
                                            } else {
                                                $consultausuario = $conexion->query("INSERT INTO usuario VALUES(null,'" . $usuario . "','" . $clave . "','" . $telefono . "','" . $correo . "',
                                                    null,2,'" . $apellidos . "',null,null)");
                                            ?>
                                                <script>
                                                    window.location.replace("login.php");
                                                </script>
                                        <?php
                                            }
                                        } ?>
                                        <hr>
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