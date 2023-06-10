<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <?php
        //abrir conexion a la base de datos.
        //PDO INTERACTUA CON BASES DE DATOS Y ES UNA CLASE
        $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
        $conexion = new PDO('mysql:host=localhost;dbname=final_9861','root', '',$pdo_options);
        
        //para guardar datos desde la pagina
        if (isset($_POST["accion"])) {
            //echo "quieres " . $_POST["accion"];
            if ($_POST["accion"] == "crear"){
                $insert = $conexion->prepare("INSERT INTO alumno (carnet, nombre, grado, telefono) VALUES (:carnet, :nombre, :grado, :telefono)");
                $insert->bindvalue('carnet', $_POST['carnet']);
                $insert->bindvalue('nombre', $_POST['nombre']);
                $insert->bindvalue('grado', $_POST['grado']);
                $insert->bindvalue('telefono', $_POST['telefono']);
                $insert->execute();
            }
        }
        
        //ejecutamos la consulta
        $select = $conexion->query("SELECT carnet, nombre, grado, telefono FROM alumno");

    ?>

    <?php if (isset($_POST["accion"]) && $_POST["accion"] == "editar") { ?>
        <form method="POST" class="form">
            <input type="text" name="carnet" value = "<?php echo $_POST["carnet"]?>" placeholder="ingresa el carnet"/>
            <input type="text" name="nombre" placeholder="ingresa el nombre"/>
            <input type="text" name="grado" placeholder="ingresa el grado"/>
            <input type="text" name="telefono" placeholder="ingresa el telefono"/>
            <input type="hidden" name="accion" value="editado"/>
            <button type="sumit"> guardar </button>
        </form>
    <?php } ?>

    <table border="2">
        <thead>
            <tr>
                <th>Carnet</th>
                <th>Nombre</th>
                <th>DPI</th>
                <th>Direccion</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($select->fetchALL() as $alumno) { ?>
                <tr>
                    <td> <?php echo $alumno["carnet"]?> </td>
                    <td> <?php echo $alumno["nombre"]?> </td>
                    <td> <?php echo $alumno["grado"]?> </td>
                    <td> <?php echo $alumno["telefono"]?> </td>
                </tr>
           <?php } ?>
        </tbody>  
    </table>
</body>
</html>