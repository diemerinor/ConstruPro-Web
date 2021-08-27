<?php 
        include('conexion.php');
        session_start(); 
        $idreporte = $_GET['idavance'];
        $idproyecto = $_GET['idproyecto'];
        echo $idproyecto;
        $consultausuario = $conexion->query("DELETE FROM archivos WHERE idarchivo=" . $idreporte);
?>
<script>
    window.location.replace("archivos.php?idproyecto="+<?php echo $idproyecto?>);
</script>  

