<?php
include('conexion.php');
session_start();
$idreporte = $_GET['idcargo'];
$idproyecto = $_GET['idproyecto'];
$consultausuario = $conexion->query("DELETE FROM poseecargo WHERE idcargo=" . $idreporte);
$consultausuario = $conexion->query("DELETE FROM permisocargo WHERE idcargo=" . $idreporte);
$consultausuario = $conexion->query("DELETE FROM cargoproyecto WHERE idcargo=" . $idreporte);
?>
<script>
    window.location.replace("cargos.php?idproyecto=" + <?php echo $idproyecto ?>);
</script>