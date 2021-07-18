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
$idproyecto = $_GET['idproyecto'];
if (empty($idproyecto)) {
    header('Location: index.php');
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

//CONSULTA FINANCIERA
$consultafinanciera = $conexion->query("SELECT no.idnotificaciones, pr.nombreproyecto, pr.idproyecto, no.idtipomovimiento, no.titulo,no.fechareporte,
no.ingreso,DATE_FORMAT(no.fechareporte,'%d/%m/%y') AS fechapublicacion2
from proyecto pr, notificaciones no 
where no.idtipo=2 and no.idproyecto=pr.idproyecto 
and pr.idproyecto=" . $idproyecto . " ORDER BY no.fechareporte ASC");
$idnotificaciones = [];
while ($consultausuario = mysqli_fetch_array($consultafinanciera)) {
    $idnotificaciones[] = $consultausuario["idnotificaciones"];
    $idtipomov[] = $consultausuario["idtipomovimiento"];
    $movimiento[] = $consultausuario["ingreso"];
    $titulo[] = $consultausuario["titulo"];
    $nombreproyecto[0] = $consultausuario["nombreproyecto"];
    $fechapublicacion[] = $consultausuario["fechapublicacion2"];
}
if ($idnotificaciones != null) {
    $cantidadmov = sizeof($movimiento);
} else {
    $cantidadmov = 0;
}
$ingresos = 0;
$gastos = 0;
$suma[-1] = 0;
$suma[0] = 0;
if ($cantidadmov > 0) {
    for ($i = 0; $i < $cantidadmov; $i++) {
        if ($idtipomov[$i] == '1') {
            $ingresos = $ingresos + $movimiento[$i];
        } else {

            $gastos = $gastos + $movimiento[$i];
            $movimiento[$i] = $movimiento[$i] * (-1);
        }
        $suma[$i] = $suma[$i - 1] + $movimiento[$i];
        $total = $suma[$i];
    }
} else {
    $total = 0;
}


?>
<script type="text/javascript">
    let ultimoval = [];
    let fechas = [];
    let cantidadav = "<?php echo $cantidadmov ?>"
</script>
<?php
for ($i = 0; $i < $cantidadmov; $i++) {
?>
    <script type="text/javascript">
        fechas.push("<?php echo $fechapublicacion[$i]; ?>");
        ultimoval.push("<?php echo $suma[$i]; ?>");
    </script>
<?php
} ?>

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

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Configuración</span></a>
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
                        <a href="#" data-bs-toggle="modal" data-bs-target="#infoavances2" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generar reporte financiero</a>
                    </div>
                    <div class="modal fade" style="margin-top:140px" id="infoavances2" tabindex="-1" role="dialog" aria-labelledby="tituloavance" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class=modal-header>
                                    <h5 id="tituloavance">Registrar reporte financiero</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        <form action="finanzas.php?idproyecto=<?php print_r($idproyecto) ?>" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Título reporte (*)</label>
                                                <input type="text" name="nombre" class="form-control" id="exampleFormControlInput1" placeholder="Por ejemplo: Compra de materiales">
                                            </div>
                                            <?php

                                            $sql = "SELECT idtipomovimiento, nombretipomov FROM tipomovimiento";
                                            $resultados = $conexion->query($sql);
                                            echo 'Tipo movimiento(*): <select style="margin-bottom:10px" name="tipop" id="tipo" class="form-control">';
                                            echo '<option>Seleccione tipo de movimiento... </option>';
                                            while ($row = mysqli_fetch_array($resultados)) {
                                                if ($tipop == $row["nombretipomov"]) {
                                                    echo '<option selected="true" value="' . $row["idtipomovimiento"] . '">' . $row["nombretipomov"] . '</option>';
                                                } else {
                                                    echo '<option value="' . $row["idtipomovimiento"] . '">' . $row["nombretipomov"] . '</option>';
                                                }
                                            }
                                            echo '</select>';
                                            ?>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Cantidad (*)</label>
                                                <input type="text" onkeypress="return solonumeros(event)" name="precio" maxlength="7" class="form-control" id="exampleFormControlInput1" placeholder="Por ejemplo: 10000">
                                            </div>

                                            <label for="exampleFormControlInput1">Fecha reporte(*):</label>
                                            <input type="date" class="form-control mb-3" name="fechareporte" id="start" name="trip-start">


                                            <div class="form-group">
                                                <input style="margin-top:30px; color:white;" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" type="submit" name="ingresarfinanciamiento" value="Registrar">
                                            </div>
                                        </form>

                                        <?php
                                        if (isset($_POST['ingresarfinanciamiento'])) {
                                            $tituloreporte = $_POST['nombre'];
                                            $tipomov = $_POST['tipop'];
                                            $stock = $_POST['precio'];
                                            $fechahoy = date("Y-m-d H:i:s");
                                            $fechareporte = $_POST['fechareporte'];
                                            if ($tituloreporte == '') {
                                                $errores .= 'Ingrese todos los campos obligatorios';
                                            } else {

                                                $consultausuario = $conexion->query("INSERT INTO notificaciones values (null,'" . $tituloreporte . "',null," . $stock . ",'" . $fechahoy . "',null,
                                                " . $idproyecto . "," . $idusuario . "," . $tipomov . ",2,'" . $fechareporte . "')");
                                            } ?>
                                            <script>
                                                window.location.replace("finanzas.php?idproyecto=<?php echo $idproyecto ?>");
                                            </script>
                                        <?php
                                            if (!$errores) {
                                                $enviado = 'true';
                                                header('Location: finanzas.php?idproyecto=<?php print_r($idproyecto) ?>');
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-8 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Detalle movimientos</h6>
                                </div>
                                <div class="card shadow mb-4">
                                    <div class="card-body">
                                        <div style="overflow-x:hidden;" class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Fecha</th>
                                                        <th>Motivo</th>
                                                        <th>Valor</th>
                                                        <?php if ($rol == 1) { ?><th>Acciones</th> <?php } ?>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php for ($i = 0; $i < $cantidadmov; $i++) { ?>


                                                        <tr>
                                                            <form action="finanzas.php?idproyecto=<?php print_r($idproyecto) ?>" method="POST">
                                                                <input type="hidden" name="idavance" value="<?php echo $idnotificaciones[$i] ?> ">
                                                                <td><?php echo $fechapublicacion[$i]; ?></td>
                                                                <td><?php echo $titulo[$i];
                                                                    if ($idtipomov[$i] == '1') { ?></td>
                                                                <td class="text-success"><?php echo '$' . $movimiento[$i];
                                                                                        } else { ?></td>
                                                                <td class="text-danger"><?php echo '-$' . $movimiento[$i] * (-1);
                                                                                        } ?></td>
                                                                <?php if ($rol == 1) { ?><td><a href="<?php print_r($rutaarchivo[$i]) ?>" download="<?php echo $nombrearchivo[$i] ?>" class="btn btn-success mt-2">
                                                                            <i class="fas fa-edit"></i></a>

                                                                        <input name="eliminar" class="btn btn-danger mt-2" onclick="eliminar()" type="submit" value="Eliminar">

                                                                    </td> <?php } ?>

                                                            </form>
                                                        </tr>
                                                    <?php }
                                                    if (isset($_POST['eliminar'])) {
                                                        $idproyectoeliminar = $_POST['idavance'];
                                                        $consultausuario = $conexion->query("DELETE FROM notificaciones WHERE idnotificaciones=" . $idproyectoeliminar);

                                                    ?>
                                                        <script>
                                                            window.location.replace("finanzas.php?idproyecto=<?php echo $idproyecto ?>");
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
                        </div>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $('dataTable').DataTable();
                            });
                        </script>

                        <div class="col-xl-4 col-lg-7">

                            <!-- Area Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Últimos movimientos</h6>
                                </div>
                                <div class="card-body">
                                    <h3 class="text-success"> Ingresos</h3>
                                    <h5>$<?php echo $ingresos ?></h5>
                                    <h3 class="text-danger"> Gastos</h3>
                                    <h5>$<?php echo $gastos ?></h5>
                                    <hr>
                                    <h3 class="text-primary">Total</h3>
                                    <h5>$<?php echo $total ?></h5>
                                </div>
                            </div>

                            <!-- Bar Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Estado financiero</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                    <hr>
                                </div>
                            </div>


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
    <script src="vendor/chart.js/Chart.min.js"></script>

    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>
    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="js/demo/chart-bar-demo.js"></script>

</body>

</html>