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
$idreporte = $_GET['idnotificacion'];
$idproyecto = $_GET['idproyecto'];
if (empty($idproyecto)) {
    header('Location: index.php');
}

$consultaavance = $conexion->query("SELECT titulo, descripcion, ingreso, idtipomovimiento, 
date_format(fechareporte,'%Y-%m-%d') as fechareportado 
from notificaciones where idnotificaciones=" . $idreporte);
while ($consultausuario = mysqli_fetch_array($consultaavance)) {
    $titulo = $consultausuario["titulo"];
    $idtipomov = $consultausuario["idtipomovimiento"];
    $descripcionnot = $consultausuario["descripcion"];
    $fechareporte = $consultausuario["fechareportado"];
    $ingreso = $consultausuario["ingreso"];
}

//CONSULTA PROYECTO
$consultaavance = $conexion->query("SELECT * from proyecto where idproyecto=" . $idproyecto);
while ($consultausuario = mysqli_fetch_array($consultaavance)) {
    $nombreproyecto = $consultausuario["nombreproyecto"];
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
    $rol = $consultausuario["codigorol"];
}
if (empty($idproyecto2)) {
    header('Location: index.php');
}





?>
<script type="text/javascript">
    let ultimoval = [];
    let fechas = [];
    let cantidadav = "<?php echo $cantidadmov ?>"
</script>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Finanzas</title>
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
            <li class="nav-item">
                <a class="nav-link" href="charts.php?idproyecto=<?php print_r($idproyecto) ?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Avances</span></a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link" href="#">
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

                    <!-- Topbar Search -->
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
                        <h1 class="h3 mb-0 text-gray-800">Gestión financiera</h1>
                    </div>
                    <div class="row">

                        <div class="col-xl-8 col-lg-7">

                            <!-- Area Chart -->
                            <div class="card shadow mb-4">

                                <div class="card-body">
                                    <form action="editarfinanzas.php?idnotificacion=<?php echo $idreporte ?>&idproyecto=<?php echo $idproyecto ?>" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Título reporte (*)</label>
                                            <input type="text" name="nombre" class="form-control" id="exampleFormControlInput1" placeholder="Por ejemplo: Compra de materiales" value="<?php echo $titulo ?>">
                                        </div>
                                        <?php
                                        $consultaidseccion = $conexion->query("SELECT idtipomovimiento from notificaciones WHERE idnotificaciones=" . $idreporte);
                                        $tipop = mysqli_fetch_array($consultaidseccion);
                                        $tipop = $tipop[0];

                                        $sql = "SELECT idtipomovimiento, nombretipomov FROM tipomovimiento";
                                        $resultados = $conexion->query($sql);
                                        echo 'Tipo movimiento(*): <select style="margin-bottom:10px" name="tipop" id="tipo" class="form-control">';
                                        echo '<option>Seleccione tipo de movimiento... </option>';
                                        while ($row = mysqli_fetch_array($resultados)) {
                                            if ($tipop == $row["idtipomovimiento"]) {
                                                echo '<option selected="true" value="' . $row["idtipomovimiento"] . '">' . $row["nombretipomov"] . '</option>';
                                            } else {
                                                echo '<option value="' . $row["idtipomovimiento"] . '">' . $row["nombretipomov"] . '</option>';
                                            }
                                        }
                                        echo '</select>';
                                        ?>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Cantidad (*)</label>
                                            <input type="text" onkeypress="return solonumeros(event)" name="precio" maxlength="7" class="form-control" id="exampleFormControlInput1" value="<?php echo $ingreso ?>" placeholder="Por ejemplo: 10000">
                                        </div>

                                        <label for="exampleFormControlInput1">Fecha reporte(*):</label>
                                        <input type="date" class="form-control mb-3" value="<?php echo $fechareporte ?>" name="fechareporte" id="start" name="trip-start">


                                        <div class="form-group">
                                            <input style="margin-top:30px; color:white;" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" type="submit" name="editarfinanciamiento" value="Editar">
                                        </div>
                                    </form>

                                    <?php
                                    if (isset($_POST['editarfinanciamiento'])) {
                                        $tituloreporte = $_POST['nombre'];
                                        $tipomov = $_POST['tipop'];
                                        $stock = $_POST['precio'];
                                        $fechahoy = date("Y-m-d H:i:s");
                                        $fechareporte = $_POST['fechareporte'];
                                        if ($tituloreporte == '') {
                                            $errores .= 'Ingrese todos los campos obligatorios';
                                        } else {
                                            $consultausuario = $conexion->query("UPDATE notificaciones SET titulo='" . $tituloreporte . "' where idnotificaciones=" . $idreporte);
                                            $consultausuario = $conexion->query("UPDATE notificaciones SET ingreso='" . $stock . "' where idnotificaciones=" . $idreporte);
                                            $consultausuario = $conexion->query("UPDATE notificaciones SET idtipomovimiento='" . $tipomov . "' where idnotificaciones=" . $idreporte);
                                            $consultausuario = $conexion->query("UPDATE notificaciones SET fechareporte='" . $fechareporte . "' where idnotificaciones=" . $idreporte);                                        } ?>
                                        <script>
                                            window.location.replace("finanzas.php?idproyecto=<?php echo $idproyecto ?>");
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
                            <button type="button" class="fa fa-times" data-bs-dismiss="modal" aria-label="Close"></button>
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
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->

            <script src="vendor/datatables/jquery.dataTables.min.js"></script>
            <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
            <script src="js/demo/datatables-demo.js"></script>
            <!-- Page level custom scripts -->
         

</body>

</html>