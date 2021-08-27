<?php
include('conexion.php');
session_start();
$idreporte = $_GET['idusuario'];
$idproyecto = $_GET['idproyecto'];
$consultausuario = $conexion->query("DELETE FROM poseecargo WHERE idusuario=" . $idreporte);
$consultausuario = $conexion->query("DELETE FROM participa WHERE idusuario=" . $idreporte);
?>
<script>
    window.location.replace("participantes.php?idproyecto=" + <?php echo $idproyecto ?>);
</script>