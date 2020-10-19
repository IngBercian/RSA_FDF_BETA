<?php 

$host = 'localhost';
$port = '3306';
$user = 'root';
$password = '';
$db = 'base_datos_2020';

$conection = @mysqli_connect($host.':'.$port, $user, $password, $db);

if 
(!$conection)
{
echo "error en la conexion";
}



 ?>