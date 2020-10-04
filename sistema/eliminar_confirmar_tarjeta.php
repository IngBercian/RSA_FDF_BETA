<?php 
	session_start();
	if($_SESSION['rol'] != 5 and $_SESSION['rol'] !=1)
	{
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST))
	{
		if(empty($_POST['idtarjeta']))
		{
			header("location: lista_tarjeta.php");
			mysqli_close($conection);
		}
		$idtarjeta = $_POST['idtarjeta'];

		//$query_delete = mysqli_query($conection,"DELETE FROM usuario WHERE idusuario =$idusuario ");
		$query_delete = mysqli_query($conection,"UPDATE tarjeta SET estatus = 0 WHERE codtarjeta = $idtarjeta ");
		mysqli_close($conection);
		if($query_delete){
			header("location: lista_tarjeta.php");
		}else{
			echo "Error al eliminar";
		}

	}




	if(empty($_REQUEST['cod']) )
	{
		header("location: lista_tarjeta.php");
		mysqli_close($conection);
	}else{

		$idtarjeta = $_REQUEST['cod'];

		$query = mysqli_query($conection,"SELECT * FROM tarjeta WHERE codtarjeta = $idtarjeta ");
		
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				$tarjeta = $data['tarjeta'];
				$monto = $data['monto'];
			}
		}else{
			header("location: lista_tarjeta.php");
		}


	}


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Eliminar Tarjeta</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<div class="data_delete">
			<h2>¿Está seguro de eliminar el siguiente registro?</h2>
			<p>Tarjeta: <span><?php echo $tarjeta; ?></span></p>
			<p>Monto: <span><?php echo $monto; ?></span></p>

			<form method="post" action="">
				<input type="hidden" name="idtarjeta" value="<?php echo $idtarjeta; ?>">
				<a href="lista_tarjeta.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
			</form>
		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>