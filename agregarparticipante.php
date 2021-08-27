<?php
include('conexion.php');
session_start();
$idusuario = $_GET['idusuario'];
$idproyecto = $_GET['idproyecto'];
$idcargo = $_GET['idcargo'];
$consultausuario = $conexion->query("INSERT INTO participa VALUES(".$idproyecto.",".$idusuario.",1)");
$consultausuario = $conexion->query("INSERT INTO poseecargo VALUES(null,".$idusuario.",".$idcargo.",".$idproyecto.")");?>
<script>
    window.location.replace("participantes.php?idproyecto=" + <?php echo $idproyecto ?>);
</script>