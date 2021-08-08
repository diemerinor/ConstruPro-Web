<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="get">
        <input type="text" name="nombre"  placeholder="Username del usuario">

        <input type="submit" name="ingresar" value="ingresar">

    </form>
    <?php
    include('conexion.php');
    if (isset($_GET['ingresar'])) {
        $nombrebuscar = $_GET['nombre'];

        $result3 = $conexion->query("SELECT * from usuario where nombreusuario like '%$nombrebuscar'");
        echo 'hola';
        while ($row = $result3->fetch_array()) {
            echo "entre";
            echo $row['apellidos'];
        }
    }
    ?>
</body>

</html>