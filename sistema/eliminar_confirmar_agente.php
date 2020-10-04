<?php 
	session_start();
	if($_SESSION['rol'] != 3 and $_SESSION['rol'] !=1)
	{
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST))
	{
		if(empty($_POST['idagente']))
		{
			header("location: lista_agentes.php");
			mysqli_close($conection);
		}
		$idagente = $_POST['idagente'];

		//$query_delete = mysqli_query($conection,"DELETE FROM usuario WHERE idusuario =$idusuario ");
		$query_delete = mysqli_query($conection,"UPDATE agente SET estatus = 0 WHERE codagente = $idagente ");
		mysqli_close($conection);
		if($query_delete){
			header("location: lista_agentes.php");
		}else{
			echo "Error al eliminar";
		}

	}




	if(empty($_REQUEST['cod']) )
	{
		header("location: lista_agentes.php");
		mysqli_close($conection);
	}else{

		$idagente = $_REQUEST['cod'];

		$query = mysqli_query($conection,"SELECT * FROM agente WHERE codagente = $idagente ");
		
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				$telefono = $data['telefono'];
				$agente = $data['agente'];
			}
		}else{
			header("location: lista_agentes.php");
		}


	}


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Eliminar Agente</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<div class="data_delete">
			<h2>¿Está seguro de eliminar el siguiente registro?</h2>
			<p>Agente: <span><?php echo $agente; ?></span></p>
			<p>Teléfono: <span><?php echo $telefono; ?></span></p>

			<form method="post" action="">
				<input type="hidden" name="idagente" value="<?php echo $idagente; ?>">
				<a href="lista_agentes.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
			</form>
		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>