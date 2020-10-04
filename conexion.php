<?php 

$host = 'localhost';
$port = '3308';
$user = 'root';
$password = '';
$db = 'bd2020';

$conection = @mysqli_connect($host.':'.$port, $user, $password, $db);

if 
(!$conection)
{
echo "error en la conexion";
}



 ?>