<?php 
	session_start();
	if($_SESSION['rol'] != 5 and $_SESSION['rol'] !=1 and $_SESSION['rol'] !=4)
	{
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST))
	{
		if(empty($_POST['idmiembro']))
		{
			header("location: lista_miembros.php");
			mysqli_close($conection);
		}
		$idmiembro = $_POST['idmiembro'];

		//$query_delete = mysqli_query($conection,"DELETE FROM usuario WHERE idusuario =$idusuario ");
		$query_delete = mysqli_query($conection,"UPDATE miembro SET estatus = 0 WHERE codmiembro = $idmiembro ");
		mysqli_close($conection);
		if($query_delete){
			header("location: lista_miembros.php");
		}else{
			echo "Error al eliminar";
		}

	}




	if(empty($_REQUEST['cod']) )
	{
		header("location: lista_miembros.php");
		mysqli_close($conection);
	}else{

		$idmiembro = $_REQUEST['cod'];

		$query = mysqli_query($conection,"SELECT * FROM miembro WHERE codmiembro = $idmiembro ");
		
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				$familia = $data['familia'];
				$miembro = $data['miembro'];
			}
		}else{
			header("location: lista_miembros.php");
		}


	}


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Eliminar Miembro</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<div class="data_delete">
			<h2>¿Está seguro de eliminar el siguiente registro?</h2>
			<p>Familia: <span><?php echo $familia; ?></span></p>
			<p>Miembro: <span><?php echo $miembro; ?></span></p>

			<form method="post" action="">
				<input type="hidden" name="idmiembro" value="<?php echo $idmiembro; ?>">
				<a href="lista_miembros.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
			</form>
		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>