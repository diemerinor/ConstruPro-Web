<!DOCTYPE html>
<html lang="en">
<?php
include('conexion.php');
session_start();
$usuario = '';
$idusuario;
$cantidadmateriales = 0;
$cantidadeventos = 0;
$cantidadmateriales = 0;
$cantidadmateriales = 0;

if (!isset($_SESSION['loggeado'])) {
    $inicio = "no";
} else {
    $idusuario = $_SESSION['loggeado'];
    $inicio = "si";
}
$idproyecto = $_GET['idproyecto'];
if (empty($idproyecto)) {
    header('Location: index.php');
}
//CONSULTA USUARIO
$consultaavance = $conexion->query("SELECT * from usuario where
    idusuario=" . $idusuario);
while ($consultausuario = mysqli_fetch_array($consultaavance)) {
    $nombreusuario = $consultausuario["nombreusuario"];
    $apellidos = $consultausuario["apellidos"];
}
$consultaavance = $conexion->query("SELECT * from usuario us, proyecto pr, participa pa where
    pa.idproyecto= pr.idproyecto and pa.idusuario = us.idusuario and
    pr.idproyecto =" . $idproyecto . " and
    us.idusuario=" . $idusuario);
while ($consultausuario = mysqli_fetch_array($consultaavance)) {
    $idproyecto2 = $consultausuario["idproyecto"];
}
if (empty($idproyecto2)) {
    header('Location: index.php');
}


$consultamateriales = $conexion->query("SELECT * FROM proyecto pr, usuario us, participa pa, rol ro
where ro.CodigoRol = pa.codigorol and pr.idproyecto= pa.idproyecto and us.idusuario = pa.idusuario and pr.idproyecto=" . $idproyecto);
while ($consultausuario = mysqli_fetch_array($consultamateriales)) {
    $nombreparticipante[] = $consultausuario["nombreusuario"] . ' ' . $consultausuario["apellidos"];
    $nombrerol[] = $consultausuario["NombreRol"];
    $nombreproyecto[0] = $consultausuario["nombreproyecto"];
    $username2[] = $consultausuario["nombreusuario"];
}
$cantidadparticipantes = sizeof($nombreparticipante);

?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Participantes</title>
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
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background: url(img/fondo2.png);">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <img style="width:30%" class="sidebar-card-illustration mb-2" src="img/LOGOblanco.png" alt="...">
                <div class="sidebar-brand-text mx-3">Construpro</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="detalleproy.php?idproyecto=<?php print_r($idproyecto) ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Tablero</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Gestión
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item ">
                <a class="nav-link" href="charts.php?idproyecto=<?php print_r($idproyecto) ?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Avances</span></a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="finanzas.php?idproyecto=<?php print_r($idproyecto) ?>">
                    <i class="fas fa-fw fa-dollar-sign"></i>
                    <span>Finanzas</span></a>
            </li>

            <li class="nav-item ">
                <a class="nav-link" href="materiales.php?idproyecto=<?php print_r($idproyecto) ?>">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Materiales</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="participantes.php?idproyecto=<?php print_r($idproyecto) ?>">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Participantes</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="archivos.php?idproyecto=<?php print_r($idproyecto) ?>">
                    <i class="fas fa-fw fa-file"></i>
                    <span>Archivos</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Cuenta
            </div>

            <!-- Nav Item - Pages Collapse Menu -->


            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Cuenta</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item ">
                <a class="nav-link" href="contactos.php">
                    <i class="fas fa-fw fa-user-friends"></i>
                    <span>Contactos</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
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
                    <h4><?php echo $nombreproyecto[0] ?></h4>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
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
                                            <form action="participantes.php?idproyecto=<?php print_r($idproyecto) ?>" method="post" enctype="multipart/form-data">
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
                                        window.location.replace("participantes.php?idproyecto=<?php echo $idproyecto ?>");
                                    </script>
                                <?php
                                }
                                ?>

                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Buscar material" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Participantes</h1>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#infoavances2" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-download fa-sm text-white-50"></i> Agregar trabajador</a>
                    </div>
                    <div class="modal fade" style="margin-top:140px" id="infoavances2" tabindex="-1" role="dialog" aria-labelledby="tituloavance" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class=modal-header>
                                    <h5 id="tituloavance">Agregar trabajador</h5>
                                    <button type="button" class="fa fa-times" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Contactos</h6>
                                        </div>
                                        <?php
                                        $consultaamistad = $conexion->query("SELECT * FROM  usuario us, amistad am where (am.idusuario1 =" . $idusuario . " or am.idusuario2=" . $idusuario . ") and (am.idusuario1 = us.idusuario or am.idusuario2=us.idusuario)");
                                        $participa = [];

                                        while ($consultausuario = mysqli_fetch_array($consultaamistad)) {
                                            if ($consultausuario["idusuario"] != $idusuario) {
                                                $idusuarios[] = $consultausuario["idusuario"];
                                                $nombrecontacto[] = $consultausuario["nombreusuario"] . ' ' . $consultausuario["apellidos"];
                                                $result5 = $conexion->query("SELECT * from proyecto PR, participa PA, usuario US where PR.idproyecto=PA.idproyecto and
                                                PA.idusuario = US.idusuario and US.idusuario=" . $consultausuario["idusuario"] . " and PR.idproyecto=" . $idproyecto);
                                                while ($row3 = $result5->fetch_array()) {
                                                    $participa[] = $row3["codigorol"];
                                                }
                                            }
                                        }
                                        $cantidadcontactos = sizeof($nombrecontacto);
                                        ?>
                                        <div class="card-body">
                                            <div style="overflow-x:hidden;" class="table-responsive">
                                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>Nombre contacto</th>
                                                            <th>Acción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php for ($i = 0; $i < $cantidadcontactos; $i++) { ?>
                                                            <tr>
                                                                <td><?php echo $nombrecontacto[$i] ?></td>
                                                                <td><?php 
                                                                    if (!isset($participa[$i])) {
                                                                        echo '<a style="color:white" class="btn btn-success mt-2">Ya participa en el proyecto</a>';
                                                                    } else {
                                                                        echo '<a style="color:white" class="btn btn-primary mt-2">Agregar</a>';
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    if (isset($_GET['ingresar'])) {
                        $nombrebuscar = $_GET['nombre'];

                        $result3 = $conexion->query("SELECT * from usuario where nombreusuario like '%$nombrebuscar'");

                        while ($row = $result3->fetch_array()) {
                            echo $row['apellidos'];
                        }
                    }
                    ?>

                    <div class="container-fluid">



                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Trabajadores</h6>
                            </div>
                            <div class="card-body">
                                <div style="overflow-x:hidden;" class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nombre participante</th>
                                                <th>Rol</th>
                                                <th>Username</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for ($i = 0; $i < $cantidadparticipantes; $i++) { ?>
                                                <tr>
                                                    <td><?php echo $nombreparticipante[$i] ?></td>
                                                    <td><?php echo $nombrerol[$i] ?></td>
                                                    <td><?php echo $username2[$i] ?></td>
                                                    <td><a href="<?php print_r($rutaarchivo[$i]) ?>" download="<?php echo $nombrearchivo[$i] ?>" class="btn btn-success mt-2">Ver</a>
                                                        <a href="<?php print_r($rutaarchivo[$i]) ?>" download="<?php echo $nombrearchivo[$i] ?>" class="btn btn-danger mt-2">Eliminar</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
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

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Page level custom scripts -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>