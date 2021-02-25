<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>practicando consultas</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</head>
<body>
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-3">
        <h1>Practicando consultas</h1>
        <form action="index.php" method="post" class="form-inline">
        <label for="id" class="form-group">Doc:</label><br>
        <input type="text" name="id" id="id" class="form-control" placeholder="Documento"><br><br>
        <label for="nombre" class="form-group">Nombre:</label><br>
        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre"><br><br>
        <label for="apellido" class="form-group">Primer Apellido:</label><br>
        <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellido"><br><br>
        <label for="apellido2" class="form-group">Segundo Apellido</label><br>
        <input type="text" name="apellido2" id="apellido2" class="form-control" placeholder="Segundo Apellido"><br><br>
        <label for="telefono" class="form-group">Telefono:</label><br>
        <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Telefono"><br><br>
        <label for="usuario" class="form-group">Usuario</label><br>
        <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario"><br><br>
        <label for="contraseña" class="form-group">Contraseña:</label><br>
        <input type="password" name="contraseña" id="contraseña" class="form-control" placeholder="Contraseña"><br><br>
        <label for="contraseña2" class="form-group">Confirmar contraseña:</label><br>
        <input type="password" name="contraseña2" id="contraseña2" class="form-control" placeholder="Contraseña"><br><br>
        <input type="submit" value="Ingresar" name="registrar" class="btn btn-primary"><br><br>
        </form><br>

        <?php 
        
        if (isset($_POST['registrar'])) {
            $_id = $_POST['id'];
            $_nombre = $_POST['nombre'];
            $_apellido1 = $_POST['apellido'];
            $_apelido2 = $_POST['apellido2'];
            $_telefono = $_POST['telefono'];
            $_usuario = $_POST['usuario'];
            $_contraseña = $_POST['contraseña'];
            $_contraseña2 = $_POST['contraseña2'];

            if ($_contraseña === $_contraseña2) {
                include('./clases/conexion-open.php');
                $conexion->query("INSERT INTO $tbusuarios(user, pass) VALUES('$_usuario','$_contraseña')");
                $conexion->query("INSERT INTO $tbempleados(id, nombre, apellido, apellido2, telefono, user) 
                VALUES('$_id','$_nombre','$_apellido1','$_apelido2','$_telefono','$_usuario')");
                include("./clases/conexion-close.php");
                echo "Su registro a sido añadido correctamente";
            }else {
                echo "Las contraseñas no coinciden";
            }
        }


        ?>

        </div>
        <div class="col-md-4">
        <h1>Busqueda</h1>
        <form action="index.php" method="post">
        <label for="id"class="form-group">Ingrese id a buscar</label>
        <input type="search" class="form-control" name="id" id="id" placeholder="ingrese ID"><br><br>
        <input type="submit" value="Buscar" name="btnbuscar" class="btn btn-success"><br><br><br>
        </form>
        
        <?php 
            if (isset($_POST['btnbuscar'])) {
                include("./clases/conexion-open.php");
                $resultados = mysqli_query($conexion, ("SELECT * FROM $tbempleados WHERE id=$_id"));
                while ($consulta = mysqli_fetch_array($resultados)) {
                    echo "
                    <table width=\"100%\" class=\"table\">
                    <tr>
                    <td><b><center>Documento</center></b></td><td><b><center>Nombre</center></b></td><td><b><center>Apellido</center></b></td><td><b><center>Apellido2</center></b></td><td><b><center>Telefono</center></b></td><td><b><center>Usuario</center></b></td>
                    </tr>
                    <tr>
                        <td>".$consulta['id']."</td>
                        <td>".$consulta['nombre']."</td>
                        <td>".$consulta['apellido']."</td>
                        <td>".$consulta['apellido2']."</td>
                        <td>".$consulta['telefono']."</td>
                        <td>".$consulta['user']."</td>
                    </tr>
                    </table>
                    ";
                    echo $consulta['nombre'];
                }
                include("./clases/conexion-close.php");
            }
        ?>
        </div>
</div>
</body>
</html>