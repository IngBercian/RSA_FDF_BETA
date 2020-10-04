<?php 
	
	session_start();
	if($_SESSION['rol'] !=5 and $_SESSION['rol'] !=1)
	{
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['tarjeta']) || empty($_POST['descripcion']) || empty($_POST['monto']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{
			
			$idTarjeta = $_POST['idTarjeta'];
			$tarjeta = $_POST['tarjeta'];
			$descripcion = $_POST['descripcion'];
			$monto  = $_POST['monto'];

			$result = 0;
			if($tarjeta !=0)

            {
            $query = mysqli_query($conection,"SELECT * FROM tarjeta WHERE (tarjeta = $tarjeta AND codtarjeta != $idTarjeta)");
		    $result = mysqli_fetch_array($query);
		    }
			if($result > 0){
				$alert='<p class="msg_error">La tarjeta ya fue registrada.</p>';
			}else{

			$sql_update = mysqli_query($conection,"UPDATE tarjeta
															SET tarjeta = '$tarjeta', descripcion='$descripcion', monto='$monto'
															WHERE codtarjeta= $idTarjeta ");
		    
				if($sql_update){
					$alert='<p class="msg_save">Datos actualizados correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar datos.</p>';
				}

			}


		}

	}

	//Mostrar Datos
	if(empty($_REQUEST['cod']))
	{
		header('Location: lista_tarjeta.php');
		mysqli_close($conection);
	}
	$idUser = $_REQUEST['cod'];

	$sql= mysqli_query($conection,"SELECT * FROM tarjeta
								   WHERE codtarjeta= $idUser ");
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: lista_tarjeta.php');
	}else{

		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$idUser  = $data['codtarjeta'];
			$tarjeta  = $data['tarjeta'];
			$descripcion  = $data['descripcion'];
			$monto = $data['monto'];

		




		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Actualizar Tarjeta</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Actualizar Tarjeta</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<input type="hidden" name="idTarjeta" value="<?php echo $idUser; ?>">
				<label for="tarjeta">Tarjeta</label>
				<input type="text" name="tarjeta" id="tarjeta" placeholder="Tarjeta (proyecto)" value="<?php echo $tarjeta; ?>">
				<label for="descripcion">Descripcion</label>
				<input type="text" name="descripcion" id="descripcion" placeholder="Descripcion"value="<?php echo $descripcion; ?>">
				<label for="monto">Monto</label>
				<input type="number" name="monto" id="monto" placeholder="Inversion estimada"value="<?php echo $monto; ?>">
				<input type="submit" value="Actualizar Tarjeta" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>