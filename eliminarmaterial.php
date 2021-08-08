<?php
include('conexion.php');
session_start();
$idreporte = $_GET['idmaterial'];
$idproyecto = $_GET['idproyecto'];
$consultausuario = $conexion->query("DELETE FROM poseerecurso WHERE idrecursomat=" . $idreporte);
$consultausuario = $conexion->query("DELETE FROM recursosmat WHERE idrecursomat=" . $idreporte);
?>
<script>
    window.location.replace("materiales.php?idproyecto=" + <?php echo $idproyecto ?>);
</script>