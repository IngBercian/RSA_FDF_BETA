<?php 
	session_start();
	if($_SESSION['rol'] != 5 and $_SESSION['rol'] !=1)
	{
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST))
	{
		if(empty($_POST['idcorresponsal']))
		{
			header("location: lista_corresponsales.php");
			mysqli_close($conection);
		}
		$idcorresponsal = $_POST['idcorresponsal'];

		//$query_delete = mysqli_query($conection,"DELETE FROM usuario WHERE idusuario =$idusuario ");
		$query_delete = mysqli_query($conection,"UPDATE corresponsal SET estatus = 0 WHERE codcorresponsal = $idcorresponsal ");
		mysqli_close($conection);
		if($query_delete){
			header("location: lista_corresponsales.php");
		}else{
			echo "Error al eliminar";
		}

	}




	if(empty($_REQUEST['cod']) )
	{
		header("location: lista_corresponsales.php");
		mysqli_close($conection);
	}else{

		$idcorresponsal = $_REQUEST['cod'];

		$query = mysqli_query($conection,"SELECT * FROM corresponsal WHERE codcorresponsal = $idcorresponsal ");
		
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				$telefono = $data['telefono'];
				$corresponsal = $data['corresponsal'];
			}
		}else{
			header("location: lista_corresponsales.php");
		}


	}


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Eliminar Corresponsal</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<div class="data_delete">
			<h2>¿Está seguro de eliminar el siguiente registro?</h2>
			<p>Corresponsal: <span><?php echo $corresponsal; ?></span></p>
			<p>Teléfono: <span><?php echo $telefono; ?></span></p>

			<form method="post" action="">
				<input type="hidden" name="idcorresponsal" value="<?php echo $idcorresponsal; ?>">
				<a href="lista_corresponsales.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
			</form>
		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>