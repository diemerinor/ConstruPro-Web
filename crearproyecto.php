<!DOCTYPE html>
<html lang="en">
<?php
include('conexion.php');
session_start();
$usuario = '';
$idusuario;
$enviado = '';
if (!isset($_SESSION['loggeado'])) {
    $inicio = "no";
} else {
    $idusuario = $_SESSION['loggeado'];
    $inicio = "si";
}
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Publicacion</title>
    <style>
        /* #mapitas{
            width: 500px;
            height: 400px;
            display: flex;
            
        } */
    </style>
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
</head>

<body class="hidden">

    <header>
        <nav id="nav" class="nav1">
            <div class="contenedor-nav">
                <div class="logo">
                <a href="index.php"><img src="img/LOGOblanco.png" style="transform:scale(1.3);" alt=""></a>
                </div>
                <div class="enlaces" id="enlaces">
                    <a href="index.php" id="enlace-inicio" class="btn-header">Inicio</a>
                    <a href="catalogo.php" id="enlace-catalogo" class="btn-header">Catálogo</a>
                    <a href="manualdeuso.php" id="enlace-catalogo" class="btn-header">Manual de uso</a>
                    <?php if ($inicio == 'no') { ?>
                        <a href="login.php" id="enlace-contacto" class="btn-header">Login</a>
                    <?php } else {
                        echo '|   ';
                        // echo 'Hola '.$nombre;
                    ?>
                        <a href="mispublicaciones.php" id="enlace-catalogo" class="btn-header">Mis publicaciones</a>
                        <a href="perfil.php" id="enlace-catalogo" class="btn-header">Mi perfil</a>
                        <a href="cerrarsesion.php" id="enlace-catalogo" class="btn-header">Cerrar Sesión</a>
                    <?php } ?>
                </div>
                <div class="icono" id="open">
                    <span>&#9776;</span>
                </div>
            </div>
        </nav>
    </header>

    <main>

        <section class="login2" id="login2" style="height: 1050px;">
            <h3>Crear proyecto</h3>
            <p class="after">* Rellena todos los campos obligatorios</p>

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">


                <div class="form-group">
                    <label for="exampleFormControlInput1">Nombre proyecto(*):</label>
                    <input type="text" name="nombre" class="form-control" id="exampleFormControlInput1" placeholder="Por ejemplo: Parque residencial">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Ingrese descripción (*):</label>
                    <textarea id="descripcion2" name="descripcion2" style="height:200px; resize:none;" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <label for="exampleFormControlInput1">Fecha inicio(*):</label>
                <input type="date" name="fechainicio" id="start" name="trip-start">
                <label for="exampleFormControlInput1">Fecha término(*):</label>
                <input type="date" name="fechatermino" id="start" name="trip-start">
                <br>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Capital inicial(*):</label>
                    <input type="text" name="capital" class="form-control" id="exampleFormControlInput1" placeholder="Por ejemplo: 40000">
                </div>
                <?php
                $sql = "SELECT idcomuna, nombrecomuna FROM comuna";
                $resultados = $conexion->query($sql);
                echo 'Comuna(*): <select style="margin-bottom:30px" name="comuna" id="tipo" class="form-control">';
                echo '<option>Seleccione comuna... </option>';
                while ($row = mysqli_fetch_array($resultados)) {
                    echo '<option value="' . $row["idcomuna"] . '">' . $row["nombrecomuna"] . '</option>';
                }
                echo '</select>'
                ?>
                <?php
                $sql = "SELECT idcategoria, nombrecategoria FROM categoria";
                $resultados = $conexion->query($sql);
                echo 'Categoria(*): <select style="margin-bottom:30px" name="categoria" id="tipo" class="form-control">';
                echo '<option>Seleccione categoria... </option>';
                while ($row = mysqli_fetch_array($resultados)) {
                    echo '<option value="' . $row["idcategoria"] . '">' . $row["nombrecategoria"] . '</option>';
                }
                echo '</select>'
                ?>


                <div class="form-group">
                    <label for="exampleFormControlFile1">Ingrese imagen de portada (*):</label>
                    <input name="fichero" class="fichero" type="file" class="form-control-file" id="exampleFormControlFile1">
                </div>

                <div class="form-group">
                    <input style="background-color:#002018; color:white;" type="submit" name="ingresar" class="usuario" value="Ingresar" style="margin-top:30 px">
                </div>

            </form>


            <?php
            if (isset($_POST['ingresar'])) {
                $nombreproyecto = $_POST['nombre'];
                $descr = $_POST['descripcion2'];
                $descr = trim($descr); //la funcion trim borra los espacios de al principio y al final
                $descr = htmlspecialchars($descr);
                $descr = stripslashes($descr);
                $capitalinicial = $_POST['capital'];
                $fechainicial = $_POST['fechainicio'];
                $fechatermino = $_POST['fechatermino'];
                $comuna = $_POST['comuna'];
                $categoria = $_POST['categoria'];


                if ($descr == '') {
                    $errores .= 'Ingrese todos los campos obligatorios';
                } else {

                    if (is_uploaded_file($_FILES['fichero']['tmp_name'])) {
                        //SE CREAN LAS VARIABLES PARA SUBIR A LA BASE DE DATOS
                        $ruta = "img/";
                        $ruta2 = "img/";
                        $nombrefinal = trim($_FILES['fichero']['name']);
                        $destino = "img/" . $nombrefinal;
                        $upload = $ruta . $nombrefinal;
                        $upload2 = $ruta2 . $nombrefinal;


                        if (move_uploaded_file($_FILES['fichero']['tmp_name'], $upload2)) {

                            $sql = "INSERT INTO proyecto VALUES (null,'" . $nombreproyecto . "',
                            '" . $descr . "'," . $categoria . "," . $idusuario . ",'" . $destino . "',
                            " . $comuna . ",0," . $capitalinicial . ",'" . $fechainicial . "','" . $fechatermino . "')";
                            $result = $conexion->query($sql);

                            $result3 = $conexion->query("SELECT MAX(idproyecto) from proyecto");
                            $idproyecto2 = mysqli_fetch_array($result3);
                            $idproyectocreado = $idproyecto2[0];


                            $consultausuario = $conexion->query("INSERT INTO participa VALUES (" . $idproyectocreado . "," . $idusuario . ",1)");
                            $consultausuario = $conexion->query("INSERT INTO secciones VALUES (null," . $idproyectocreado . ",'Principal', 'Secci贸n principal',0,0,1,1,0)");
                            $consultausuario = $conexion->query("INSERT INTO cargoproyecto VALUES (null,'Administrador'," . $idproyectocreado . ",'Tiene acceso total')");



                            $result3 = $conexion->query("SELECT MAX(idcargo) from cargoproyecto");
                            $idcargo = mysqli_fetch_array($result3);
                            $idcargocreado = $idcargo[0];

                            $consultausuario = $conexion->query("INSERT INTO permisocargo VALUES (null," . $idcargocreado . "," . $idproyectocreado . ",1,1)");
                            $consultausuario = $conexion->query("INSERT INTO permisocargo VALUES (null," . $idcargocreado . "," . $idproyectocreado . ",2,1)");
                            $consultausuario = $conexion->query("INSERT INTO permisocargo VALUES (null," . $idcargocreado . "," . $idproyectocreado . ",3,1)");
                            $consultausuario = $conexion->query("INSERT INTO permisocargo VALUES (null," . $idcargocreado . "," . $idproyectocreado . ",4,1)");

                            $fechahoy = date('Y-m-d');
                            $consultausuario = $conexion->query("INSERT INTO notificaciones values (null,'Inversión inicial',null,".$fechahoy."',null,
		                    ".$idproyectocreado.",".$idusuario.",1,2,'".$fechahoy."')");
                            $consultausuario = $conexion->query("INSERT INTO poseecargo VALUES (null," . $idusuario . "," . $idcargocreado . "," . $idproyectocreado . ")");
                        }
                    } else {
                        $errores .= 'Ingrese Una foto de su mascota';
                    }
                }
                if (!$errores) {
                    $enviado = 'true';
                }
            }
            ?>

            <?php if (!empty($errores)) { ?>
                <div class="alert error">
                <?php echo $errores;
            } ?>
                </div>

                <?php if ($enviado) { ?>
                    <div class="alert success">
                        <p>Registrado correctamente</p>
                    </div>
                <?php } ?>

        </section>

    </main>



    <footer id='footer'>
            <div class="footer footer-contenedor">
                <div class="marca-logo" style="padding:3px">
                    <img src="img/LOGOblanco.png" style="transform:scale(0.5);" alt="">
                </div>
            </div>
    </footer>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>