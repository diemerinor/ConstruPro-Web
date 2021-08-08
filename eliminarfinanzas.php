<?php 
        include('conexion.php');
        session_start(); 
        $idreporte = $_GET['idfinanzas'];
        $idproyecto = $_GET['idproyecto'];
        echo $idproyecto;
        $consultausuario = $conexion->query("DELETE FROM notificaciones WHERE idnotificaciones=" . $idreporte);
?>
<script>
    window.location.replace("finanzas.php?idproyecto="+<?php echo $idproyecto?>);
</script>  

