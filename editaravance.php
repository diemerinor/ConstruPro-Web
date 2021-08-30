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
$errores = '';
$cantidadavances = 0;
$enviado = '';
$vartest = 0;

if (!isset($_SESSION['loggeado'])) {
    $inicio = "no";
} else {
    $idusuario = $_SESSION['loggeado'];
    $inicio = "si";
}
$idreporte = $_GET['idreporte'];
$idproyecto = $_GET['idproyecto'];
if (empty($idreporte)) {
    header('Location: index.php');
}

//CONSULTA PROYECTO
$consultaavance = $conexion->query("SELECT idseccion, descripcionavance,metrosavanzados, date_format(fechareporte,'%Y-%m-%d') as fechareportado from reporteavance where idreporteavance=" . $idreporte);
while ($consultausuario = mysqli_fetch_array($consultaavance)) {
    $idseccion = $consultausuario["idseccion"];
    $descripcionavance = $consultausuario["descripcionavance"];
    $fechareporte = $consultausuario["fechareportado"];
    $metrosavanzados = $consultausuario["metrosavanzados"];
}


//CONSULTA USUARIO
$consultaavance = $conexion->query("SELECT * FROM usuario WHERE
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
    $nombreproyecto = $consultausuario["nombreproyecto"];
    $idproyecto2 = $consultausuario["idproyecto"];
    $rol = $consultausuario["codigorol"];
}

$consultareporte = $conexion->query("SELECT * from reporteavance where
    idreporteavance=" . $idreporte);

$nombreunidad = [];


$cantidadseccion;






?>
<script type="text/javascript">
    let ultimoval = [];
    let fechas = [];
    let cantidadav = "<?php echo $cantidadavances ?>"
</script>
<?php
for ($i = 0; $i < $cantidadavances; $i++) {
?>
    <script type="text/javascript">
        fechas.push("<?php echo $fechacompleta[$i]; ?>");
        ultimoval.push("<?php echo $metrosavanzados[$i]; ?>");
    </script>
<?php
} ?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Avance</title>
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
            <li class="nav-item active">
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

            <li class="nav-item">
                <a class="nav-link" href="materiales.php?idproyecto=<?php print_r($idproyecto) ?>">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Materiales</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="participantes.php?idproyecto=<?php print_r($idproyecto) ?>">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Participantes</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="archivos.php?idproyecto=<?php print_r($idproyecto) ?>">
                    <i class="fas fa-fw fa-file"></i>
                    <span>Archivos</span></a>
            </li>

            <li class="nav-item ">
                <a class="nav-link" href="cargos.php?idproyecto=<?php print_r($idproyecto) ?>">
                    <i class="fas fa-fw fa-sitemap"></i>
                    <span>Cargos</span></a>
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
                <a class="nav-link" href="miperfil.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Mi perfil</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="miscontactos.php">
                    <i class="fas fa-users"></i>
                    <span>Mis contactos</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item ">
                <a class="nav-link" href="contactos.php">
                    <i class="fas fa-fw fa-search"></i>
                    <span>Buscar contactos</span></a>
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
                <a class="btn btn-success btn-sm" href="haztepremium.php">Hazte Premium</a>
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
                    <h4><?php echo $nombreproyecto ?></h4>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

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
                        <h1 class="h3 mb-0 text-gray-800">Editar reporte de avance</h1>
                    </div>


                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-8 col-lg-7">

                            <!-- Area Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Últimos avances</h6>
                                </div>
                                <div class="card-body">
                                    <form action="editaravance.php?idreporte=<?php echo $idreporte ?>&idproyecto=<?php echo $idproyecto ?>" method="post" enctype="multipart/form-data">
                                        <?php
                                        $sql = "SELECT se.idseccion,se.nombreseccion FROM secciones se, proyecto pr where se.idproyecto=pr.idproyecto and pr.idproyecto=" . $idproyecto;
                                        $resultados = $conexion->query($sql);

                                        $consultaidseccion = $conexion->query("SELECT idseccion from secciones WHERE idseccion=" . $idseccion);
                                        $tipop = mysqli_fetch_array($consultaidseccion);
                                        $tipop = $tipop[0];

                                        echo ' <div class="form-group"> Sección(*): <select style="margin-bottom:30px" name="seccion" id="tipo" class="form-control">';
                                        while ($row = mysqli_fetch_array($resultados)) {
                                            if ($tipop == $row["idseccion"]) {
                                                echo '<option selected="true" value="' . $idseccion . '">' . $row["nombreseccion"] . '</option>';
                                            } else {
                                                echo '<option value="' . $row["idseccion"] . '">' . $row["nombreseccion"] . '</option>';
                                            }
                                        }
                                        echo '</select> </div>';
                                        ?>

                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Ingrese descripción (*):</label>
                                            <textarea id="descripcion2" name="descripcion2" style="height:100px; resize:none;" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $descripcionavance ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Cantidad (*)</label>
                                            <input type="text" name="cantidad" maxlength="7" class="form-control" id="exampleFormControlInput1" placeholder="Por ejemplo: 10000" value="<?php echo $metrosavanzados ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Fecha reporte(*):</label>
                                            <input type="date" class="form-control mb-3" name="fechareporte" value="<?php echo $fechareporte ?>">
                                        </div>

                                        <div class="form-group">
                                            <input style="margin-top:30px; color:white;" class="btn-primary" type="submit" name="editaravance" value="Editar">
                                        </div>

                                    </form>

                                    <?php
                                    if (isset($_POST['editaravance'])) {
                                        $seccion = $_POST['seccion'];
                                        $descr = $_POST['descripcion2'];
                                        $descr = trim($descr); //la funcion trim borra los espacios de al principio y al final
                                        $descr = htmlspecialchars($descr);
                                        $descr = stripslashes($descr);
                                        $cantidad = $_POST['cantidad'];
                                        $fecha = $_POST['fechareporte'];

                                        if (!$descr) {
                                            $errores .= 'Ingrese todos los campos obligatorios';
                                        } else {
                                            $consultausuario = $conexion->query("UPDATE reporteavance SET idseccion='" . $seccion . "' where idreporteavance=" . $idreporte);
                                            $consultausuario = $conexion->query("UPDATE reporteavance SET metrosavanzados='" . $cantidad . "' where idreporteavance=" . $idreporte);
                                            $consultausuario = $conexion->query("UPDATE reporteavance SET fechareporte='" . $fecha . "' where idreporteavance=" . $idreporte);

                                            $consultausuario = $conexion->query("UPDATE reporteavance SET descripcionavance='" . $descr . "' where idreporteavance=" . $idreporte);
                                        }
                                    ?>
                                        <script>
                                            window.location.replace("charts.php?idproyecto=<?php echo $idproyecto ?>");
                                        </script>
                                    <?php
                                        if (!$errores) {
                                            $enviado = 'true';
                                        }
                                    }
                                    ?>
                                    <hr>
                                </div>
                            </div>
                            <script>
                                var valorreporte = 0;
                            </script>


                        </div>

                        <!-- Donut Chart -->

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
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-bar-demo.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>