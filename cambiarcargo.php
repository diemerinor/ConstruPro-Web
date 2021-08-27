<?php
include('conexion.php');
session_start();
$idposee = $_GET['idposee'];
$idcargo = $_GET['idcargo'];
$idproyecto = $_GET['idproyecto'];
$consultausuario = $conexion->query("UPDATE poseecargo SET idcargo=" . $idcargo. " where idposee=" . $idposee);

?>
 <script>
    window.location.replace("participantes.php?idproyecto=<?php echo $idproyecto?>");
</script> 