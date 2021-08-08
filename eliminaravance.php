<?php 
        include('conexion.php');
        session_start(); 
        $idreporte = $_GET['idavance'];
        $idproyecto = $_GET['idproyecto'];
        echo $idproyecto;
        $consultausuario = $conexion->query("DELETE FROM reporteavance WHERE idreporteavance=" . $idreporte);
?>
<script>
    window.location.replace("charts.php?idproyecto="+<?php echo $idproyecto?>);
</script>  

