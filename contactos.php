<!DOCTYPE html>
<html lang="en">
<?php
include('conexion.php');
session_start();
$usuario = '';
$idusuario;
$cantidadavances = 0;
$cantidadeventos = 0;
$cantidadmateriales = 0;
$cantidadavances = 0;

if (!isset($_SESSION['loggeado'])) {
    $inicio = "no";
} else {
    $idusuario = $_SESSION['loggeado'];
    $inicio = "si";
}
if ($inicio == "no") {
    header('Location: login.php');
}
//CONSULTA USUARIO
$consultaavance = $conexion->query("SELECT nombreusuario,apellidos from usuario where idusuario=" . $idusuario);
while ($consultausuario = mysqli_fetch_array($consultaavance)) {
    $nombreusuario = $consultausuario["nombreusuario"];
    $apellidos = $consultausuario["apellidos"];
}
//CONSULTA PROYECTOS
$consulta = "SELECT * from proyecto PR, usuario US, participa PA WHERE 
            PR.idproyecto = PA.idproyecto AND 
            US.idusuario = PA.idusuario AND
            US.idusuario =" . $idusuario;
$resultado = $conexion->query($consulta);
$idproyectos = [];
while ($consultaproyecto = mysqli_fetch_array($resultado)) {
    $idproyectos[] = $consultaproyecto["idproyecto"];
    $nombreproyecto[] = $consultaproyecto["nombreproyecto"];
    $descripcionproyecto[] = $consultaproyecto["descripcionproyecto"];
    $imagen[] = $consultaproyecto["rutaimagen"];
}
if ($idproyectos != null) {
    $cantidadproyectos = sizeof($idproyectos);
} else {
    $cantidadproyectos = 0;
}

?>
<script type="text/javascript">
    let ultimoval = [];
    let fechas = [];
    let sumamts = [];
    let nombresec = [];
    let cantidadav = "<?php echo $cantidadavances ?>"
</script>
<?php
for ($i = 0; $i < $cantidadavances; $i++) {
?>
    <script type="text/javascript">
        fechas.push("<?php echo $fechareporte[$i]; ?>");
        ultimoval.push("<?php echo $metrosavanzados[$i]; ?>");
    </script>
<?php
}
?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Construpro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background: url(img/fondo2.png);">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <img style="width:30%" class="sidebar-card-illustration mb-2" src="img/LOGOblanco.png" alt="...">
                <div class="sidebar-brand-text mx-3">Construpro</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item ">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Inicio</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Cuenta
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Mi perfil</span></a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-user-friends"></i>
                    <span>Buscar contactos</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Super Admin
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Crear cuenta</span></a>
            </li>



            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>ConstruPro Premium</strong> está repleto de características premium, componentes y mucho más.</p>
                <a class="btn btn-success btn-sm" href="#">Hazte Premium</a>
            </div>

        </ul>
        <!-- End of Sidebar -->


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <?php
                        $cantidadsolicitudes = 0;
                        $idusuario1 = [];
                        $nombresolicitante = [];
                        $consultaavance = $conexion->query("SELECT * from solicitudamistad where idusuario2=" . $idusuario);
                        while ($consultausuario = mysqli_fetch_array($consultaavance)) {
                            $idusuario1[] = $consultausuario["idusuario1"];
                            $idusuario2[] = $consultausuario["idusuario2"];
                            $idsolicitudamistad[] = $consultausuario["idsolicitudamistad"];
                            $consultaavance2 = $conexion->query("SELECT * from usuario US where 
    US.idusuario=" . $consultausuario["idusuario1"]);
                            while ($consultausuarios = mysqli_fetch_array($consultaavance2)) {
                                $nombresolicitante[] = $consultausuarios["nombreusuario"] . " " . $consultausuarios["apellidos"];
                                $imagensolicitante[] = $consultausuarios["fotoperfil"];
                            }
                        }

                        if ($idusuario1) {
                            $cantidadsolicitudes = sizeof($idusuario1);
                        }

                        ?>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user-plus fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter"><?php echo $cantidadsolicitudes ?></span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Solicitudes de amistad
                                </h6>
                                <?php for ($i = 0; $i < $cantidadsolicitudes; $i++) { ?>
                                    <div class="dropdown-item d-flex align-items-center">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="<?php echo $imagensolicitante[$i]; ?>" alt="...">
                                            <div class="status-indicator bg-success"></div>
                                        </div>
                                        <div class="font-weight-bold">
                                            <div class="text-truncate"><?php echo $nombresolicitante[$i]; ?></div>
                                        </div>
                                        <div class="d-flex ml-2">
                                            <form action="contactos.php" method="post" enctype="multipart/form-data">
                                                <input style="margin-top:10px; color:white;" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" type="submit" name="aceptarsolicitud" value="Aceptar">

                                                <input style="margin-top:10px; color:white;" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" type="submit" name="rechazarsolicitud" value="Eliminar">

                                                <input type="hidden" name="idsolicitud" value="<?php echo $idsolicitudamistad[$i] ?>">
                                                <input type="hidden" name="idsolicitante" value="<?php echo $idusuario1[$i] ?>">

                                            </form>
                                        </div>

                                    </div>
                                <?php }
                                if (isset($_POST['aceptarsolicitud'])) {
                                    $solicitudid = $_POST['idsolicitud'];
                                    $idusuariosol = $_POST['idsolicitante'];
                                    $consultausuario = $conexion->query("INSERT INTO amistad VALUES (null," . $idusuariosol . ",$idusuario)");
                                    $consultausuario = $conexion->query("DELETE FROM solicitudamistad WHERE idsolicitudamistad=" . $solicitudid);
                                ?>
                                    <script>
                                        window.location.replace("contactos.php");
                                    </script>
                                <?php
                                }
                                ?>

                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $nombreusuario . ' ' . $apellidos ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->

                    <form class="d-flex mb-3" action="" method="get">
                        <input style="width:50%" type="text" name="nombre" class="form-control" id="exampleFormControlInput1" placeholder="Escribe el usuario que deseas buscar">
                        <!-- <a type="submit" style="color:white" class="ml-2 btn btn-primary" name="ingresar">Buscar</a> -->
                        <input type="submit" class="ml-2 btn btn-primary" name="ingresar" value="Buscar">

                    </form>

                    <?php
                    include('conexion.php');
                    $nombrecontactos = [];
                    $apellidocontactos = [];
                    $idusuarios = [];
                    $agregado = [];
                    $solicitud = [];
                    $cantidadcontactos = 0;

                    if (isset($_GET['ingresar'])) {
                        $nombrebuscar = $_GET['nombre'];
                        if ($nombrebuscar != '') {
                            $result3 = $conexion->query("SELECT * from usuario where (nombreusuario LIKE '%$nombrebuscar' or apellidos LIKE '%$nombrebuscar') and
                        idusuario !=" . $idusuario);

                            while ($row = $result3->fetch_array()) {
                                $result4 = $conexion->query("SELECT * from amistad where (idusuario1 =" . $idusuario . " && idusuario2=" . $row["idusuario"] . ") or
                                (idusuario1 =" . $row["idusuario"] . " && idusuario2=" . $idusuario . ")
                                ");
                                while ($row2 = $result4->fetch_array()) {
                                    $agregado[] = $row2["idamistad"];
                                }
                                if ($agregado == null) {
                                    $result5 = $conexion->query("SELECT * from solicitudamistad where (idusuario1 =" . $idusuario . " && idusuario2=" . $row["idusuario"] . ") or
                                (idusuario1 =" . $row["idusuario"] . " && idusuario2=" . $idusuario . ")");
                                    while ($row3 = $result5->fetch_array()) {
                                        $solicitud[] = $row3["idsolicitudamistad"];
                                    }
                                }

                                $nombrecontactos[] = $row["nombreusuario"];
                                $apellidocontactos[] = $row["apellidos"];
                                $idusuarios[] = $row["idusuario"];
                            }
                            if ($nombrecontactos != null) {
                                $cantidadcontactos = sizeof($nombrecontactos);
                            }
                        }
                    }
                    ?>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Usuarios</h6>
                        </div>
                        <div class="card-body">
                            <div style="overflow-x:hidden;" class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        for ($i = 0; $i < $cantidadcontactos; $i++) {

                                        ?>
                                            <tr>
                                                <form action="contactos.php" method="POST">
                                                    <input type="hidden" name="idusuario" value="<?php echo $idusuarios[$i] ?> ">

                                                    <td name="nombreseccion"><?php echo $nombrecontactos[$i] . " " . $apellidocontactos[$i]; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($agregado == null && $solicitud == null) {
                                                        ?>
                                                            <input name="agregar" class="btn btn-primary mt-2" onclick="eliminar()" type="submit" value="Agregar">

                                                        <?php
                                                        } else if ($agregado) {
                                                        ?>
                                                            <button class="btn btn-success" type="button">Ya son amigos</button>
                                                        <?php
                                                        } else if ($solicitud) {
                                                        ?>
                                                            <button class="btn btn-success" type="button">Hay una solicitud pendiente</button>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>

                                                </form>
                                            </tr>
                                        <?php } ?>

                                        <?php
                                        if (isset($_POST['agregar'])) {
                                            $idusuarioagregado = $_POST['idusuario'];
                                            $consultausuario = $conexion->query("INSERT INTO solicitudamistad VALUES (null," . $idusuario . "," . $idusuarioagregado . ")");

                                        ?>
                                            <script>
                                                window.location.replace("contactos.php");
                                            </script>
                                        <?php

                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>





                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Construpro &copy; </span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cerrar sesión</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">¿Estás seguro de cerrar sesión?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="cerrarsesion.php">Logout</a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>