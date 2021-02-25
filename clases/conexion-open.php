<?php 
$host = "localhost";
$user = "root";
$password = "";
$database = "negocio";
$tbusuarios = "usuarios";
$tbempleados = "empleados";

error_reporting(0);

$conexion = new mysqli($host, $user, $password, $database);

if ($conexion->connect_errno) {
    echo "lo sentimos, hay problemas y estamos trabajando para solucionarlo";
}
?>