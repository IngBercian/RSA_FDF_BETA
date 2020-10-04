<?php 
	session_start();
	if($_SESSION['rol'] != 5 and $_SESSION['rol'] !=1)
	{
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST))
	{
		if(empty($_POST['idpastor']))
		{
			header("location: lista_pastores.php");
			mysqli_close($conection);
		}
		$idpastor = $_POST['idpastor'];

		//$query_delete = mysqli_query($conection,"DELETE FROM usuario WHERE idusuario =$idusuario ");
		$query_delete = mysqli_query($conection,"UPDATE pastor SET estatus = 0 WHERE codpastor = $idpastor ");
		mysqli_close($conection);
		if($query_delete){
			header("location: lista_pastores.php");
		}else{
			echo "Error al eliminar";
		}

	}




	if(empty($_REQUEST['cod']) )
	{
		header("location: lista_pastores.php");
		mysqli_close($conection);
	}else{

		$idpastor = $_REQUEST['cod'];

		$query = mysqli_query($conection,"SELECT * FROM pastor WHERE codpastor = $idpastor ");
		
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				$pastor = $data['pastor'];
				$telefono = $data['telefono'];
			}
		}else{
			header("location: lista_pastores.php");
		}


	}


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Eliminar Pastor</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<div class="data_delete">
			<h2>¿Está seguro de eliminar el siguiente registro?</h2>
			<p>Pastor: <span><?php echo $pastor; ?></span></p>
			<p>Teléfono: <span><?php echo $telefono; ?></span></p>

			<form method="post" action="">
				<input type="hidden" name="idpastor" value="<?php echo $idpastor; ?>">
				<a href="lista_pastores.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
			</form>
		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>