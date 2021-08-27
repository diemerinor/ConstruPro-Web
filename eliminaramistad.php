<?php
include('conexion.php');
session_start();
$idusuario1 = $_GET['idusuario1'];
$idusuario2 = $_GET['idusuario2'];


$consultausuario = $conexion->query("DELETE FROM amistad WHERE idusuario1=" . $idusuario1 . " AND idusuario2=" . $idusuario2);
$consultausuario = $conexion->query("DELETE FROM amistad WHERE idusuario2=" . $idusuario1 . " AND idusuario1=" . $idusuario2);
?>
 <script>
    window.location.replace("miscontactos.php");
</script> 