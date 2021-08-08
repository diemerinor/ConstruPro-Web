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
$consultaavance = $conexion->query("SELECT nombreusuario,apellidos from usuario where idusuario=" . $idusuario);
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
$nombreunidad = [];


//CONSULTA AVANCES
$consultaavance = $conexion->query("SELECT pr.nombreproyecto, udm.nombreunidad, ra.idreporteavance, DATE_FORMAT(ra.fechareporte,'%d/%m') AS fechareportado,DATE_FORMAT(ra.fechareporte,'%d/%m/%y') AS fechareportado3,
            DATE(ra.fechareporte) AS fechareportado2, pr.metrostotales, 
            ra.metrosavanzados, ra.descripcionavance FROM
            proyecto pr, secciones se, reporteavance ra, unidaddemedida udm where 
            pr.idproyecto=ra.idproyecto and 
            ra.idproyecto=se.idproyecto and 
            se.idproyecto = pr.idproyecto and 
            udm.idunidaddemedida = se.idunidaddemedida and
            ra.idseccion = se.idseccion
            and pr.idproyecto=" . $idproyecto . " ORDER BY fechareportado DESC, fechareportado3 DESC");
while ($consultausuario = mysqli_fetch_array($consultaavance)) {
    $nombreunidad[] = $consultausuario["nombreunidad"];
    $metrosavanzados[] = $consultausuario["metrosavanzados"];
    $fechareporte[] = $consultausuario["fechareportado"];
}
if ($nombreunidad != null) {
    $cantidadavances = sizeof($nombreunidad);
}
if ($cantidadavances > 0) {
    $consultaavance = $conexion->query("SELECT se.nombreseccion, SUM(ra.metrosavanzados) from 
        proyecto pr, secciones se, reporteavance ra where
        ra.idseccion = se.idseccion and
        pr.idproyecto = se.idproyecto
        and pr.idproyecto=" . $idproyecto);
    while ($consultausuario = mysqli_fetch_array($consultaavance)) {
        $nombreseccion[] = $consultausuario["nombreseccion"];
    }
    $cantidadsecciones = sizeof($nombreseccion);
} else {
    $cantidadsecciones = 0;
}

//CONSULTA EVENTOS
$tituloevento = [];
$consultaeventos = $conexion->query("SELECT no.idnotificaciones, DATE_FORMAT(no.fechaevento,'%d-%m-%y') AS fechaevento2,DATE_FORMAT(no.fechaevento,'%H:%i') AS hora,no.titulo,no.descripcion from notificaciones no
	where idtipo =1 and no.fechaevento >= CURDATE() and idproyecto=" . $idproyecto . "
	    ORDER BY fechapublicacion DESC");
while ($consultausuario = mysqli_fetch_array($consultaeventos)) {
    $tituloevento[] = $consultausuario["titulo"];
    $descripcionevento[] = $consultausuario["descripcion"];
    $fechaevento[] = $consultausuario["fechaevento2"];
    $horaevento[] = $consultausuario["hora"];
}
if ($tituloevento != null) $cantidadeventos = sizeof($tituloevento);
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
for ($i = 0; $i < $cantidadsecciones; $i++) { ?>
    <script type="text/javascript">
        nombresec.push("<?php echo $nombreseccion[$i]; ?>");
        sumamts.push("<?php echo $sumametros[$i]; ?>");
    </script>

<?php }

//CONSULTA FINANZAS
$consultaingreso = $conexion->query("SELECT SUM(ingreso) as ingresos FROM
            proyecto pr, notificaciones no where
            no.idproyecto = pr.idproyecto and
            no.idtipomovimiento = 1
            and pr.idproyecto=" . $idproyecto);
while ($consultausuario = mysqli_fetch_array($consultaingreso)) {
    $ingreso = $consultausuario['ingresos'];
}
if ($ingreso == null) {
    $ingreso = "0";
}
$gasto;
$consultagasto = $conexion->query("SELECT SUM(ingreso) as gastos FROM
            proyecto pr, notificaciones no where
            no.idproyecto = pr.idproyecto and
            no.idtipomovimiento = 2
            and pr.idproyecto=" . $idproyecto);
while ($consultausuario = mysqli_fetch_array($consultagasto)) {
    $gasto = $consultausuario['gastos'];
}
if ($gasto == null) {
    $gasto = "0";
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
            <li class="nav-item active">
                <a class="nav-link" href="#">
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
                    <span>Buscar contactos</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

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

                    <h4><?php echo $nombreproyecto ?></h4>

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
                                            <form action="detalleproy.php?idproyecto=<?php print_r($idproyecto) ?>" method="post" enctype="multipart/form-data">
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
                                        window.location.replace("detalleproy.php?idproyecto=<?php echo $idproyecto ?>");
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tablero</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Ingresos</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo '$' . $ingreso ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Gastos</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo '$' . $gasto ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Porcentaje avance
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Eventos próximos</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $cantidadeventos ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Últimos avances</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Próximos eventos</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>

                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#infoavances2" href="#">Crear evento</a>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" style="margin-top:140px" id="infoavances2" tabindex="-1" role="dialog" aria-labelledby="tituloavance" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class=modal-header>
                                                <h5 id="tituloavance">Crear evento</h5>
                                                <button type="button" class="fa fa-times" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div>
                                                    <form action="detalleproy.php?idproyecto=<?php print_r($idproyecto) ?>" method="post" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput1">Nombre evento (*)</label>
                                                            <input type="text" name="nombreevento" class="form-control" id="exampleFormControlInput1">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleFormControlTextarea1">Ingrese descripción (*):</label>
                                                            <textarea id="descripcion2" name="descripcion2" style="height:100px; resize:none;" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput1">Fecha evento(*):</label>
                                                            <input type="date" class="form-control mb-3" name="fechareporte" id="start" name="trip-start">
                                                        </div>

                                                        <div class="form-group">
                                                            <input style="margin-top:30px; color:white;" class="btn-primary" type="submit" name="ingresaravance" value="Ingresar">
                                                        </div>

                                                    </form>
                                                    <?php
                                                    if (isset($_POST['ingresaravance'])) {
                                                        $nombreevento = $_POST['nombreevento'];
                                                        $descr = $_POST['descripcion2'];
                                                        $descr = trim($descr); //la funcion trim borra los espacios de al principio y al final
                                                        $descr = htmlspecialchars($descr);
                                                        $descr = stripslashes($descr);
                                                        $fechaevento = $_POST['fechareporte'];
                                                        $fechahoy = date("Y-m-d H:i:s");

                                                        if (!$descr) {
                                                            $errores .= 'Ingrese todos los campos obligatorios';
                                                        } else {
                                                            $consultausuario = $conexion->query("INSERT INTO notificaciones values (null,'" . $nombreevento . "','" . $descr . "',null,'" . $fechahoy . "','" .
                                                                $fechaevento . "'," . $idproyecto . "," . $idusuario . ",null,1,null)");
                                                        }
                                                    ?>
                                                        <script>
                                                            window.location.replace("detalleproy.php?idproyecto=<?php echo $idproyecto ?>");
                                                        </script>
                                                    <?php
                                                        if (!$errores) {
                                                            $enviado = 'true';
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <?php
                                        if ($cantidadeventos == 0) {
                                        ?>
                                            <h3>No hay más eventos</h3>
                                            <?php
                                        } else {
                                            for ($i = 0; $i < $cantidadeventos; $i++) { ?>
                                                <h3><?php echo $tituloevento[$i] ?></h3>
                                                <?php echo $descripcionevento[$i] ?>
                                                <br>
                                                <i class="mr-2 fas fa-calendar-day"></i><?php echo $fechaevento[$i] ?>

                                                <i class="ml-1 mr-2 fas fa-clock"></i><?php echo $horaevento[$i] ?>
                                                <hr>
                                        <?php }
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Content Row -->


                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class=" sticky-footer bg-white">
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
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="js/demo/datatables-demo.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>