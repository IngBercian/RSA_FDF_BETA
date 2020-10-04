<?php 

$alert='';
session_start();
if(!empty($_SESSION['active']))
{

        	header("location: sistema/");
        }else{

if(!empty($_POST))
{
	if (empty($_POST['usuario']) || empty($_POST['clave']))
	{
		$alert="Ingrese su Usuario y su Clave";
    }else{
    	require_once 'conexion.php';

        $user=mysqli_real_escape_string($conection,$_POST['usuario']);
        $pass=md5(mysqli_real_escape_string($conection,$_POST['clave']));

        $query=mysqli_query($conection,"SELECT * FROM
        	usuario WHERE usuario='$user' AND clave='$pass'");
        $result=mysqli_num_rows($query);

        if($result>0)
        {
        	$data=mysqli_fetch_array($query);

        	
        	$_SESSION['active']=true;
        	$_SESSION['iduser']=$data['codusuario'];
        	$_SESSION['nombre']=$data['nombre'];
        	$_SESSION['email']=$data['correo'];
        	$_SESSION['user']=$data['usuario'];
        	$_SESSION['rol']=$data['rol'];
        	
        	header("location: sistema/");
        	
        }else{
        	$alert="Usuario/Clave Incorrectos";
        	session_destroy();
        }

    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Acceso _ FDF </title>
<link rel="stylesheet" type="text/css" href="css/style.css">


	<body>

		<section id="container">

<form action="" method="post">
	
	<h3>Iniciar Sesion</h3>
	<img src="img/escudo.png" alt="acceso" width="80" height="80">

	<input type="text" name="usuario" placeholder="usuario">
	<input type="password" name="clave" placeholder="clave secreta">

	<div class="alert"><?php echo isset($alert) ?
	 $alert: ''; ?></div> 

	<input type="submit" name="" value="Ingresar">

</form>

		</section>
	</body>
</head>
</html>
