<?php 
	session_start();
	if($_SESSION['rol'] != 5 and $_SESSION['rol'] !=1)
	{
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST))
	{
		if(empty($_POST['iddistrito']))
		{
			header("location: lista_distritos.php");
			mysqli_close($conection);
		}
		$iddistrito = $_POST['iddistrito'];

		//$query_delete = mysqli_query($conection,"DELETE FROM usuario WHERE idusuario =$idusuario ");
		$query_delete = mysqli_query($conection,"UPDATE distrito SET estatus = 0 WHERE coddistrito = $iddistrito ");
		mysqli_close($conection);
		if($query_delete){
			header("location: lista_distritos.php");
		}else{
			echo "Error al eliminar";
		}

	}




	if(empty($_REQUEST['cod']) )
	{
		header("location: lista_distritos.php");
		mysqli_close($conection);
	}else{

		$iddistrito = $_REQUEST['cod'];

		$query = mysqli_query($conection,"SELECT * FROM distrito WHERE coddistrito = $iddistrito ");
		
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				$zona = $data['zona'];
				$distrito = $data['distrito'];
			}
		}else{
			header("location: lista_distritos.php");
		}


	}


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Eliminar Distrito</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<div class="data_delete">
			<h2>¿Está seguro de eliminar el siguiente registro?</h2>
			<p>Distrito: <span><?php echo $distrito; ?></span></p>
			<p>Zona: <span><?php echo $zona; ?></span></p>

			<form method="post" action="">
				<input type="hidden" name="iddistrito" value="<?php echo $iddistrito; ?>">
				<a href="lista_distritos.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
			</form>
		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>