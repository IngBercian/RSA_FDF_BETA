<?php 
	
	session_start();
	if($_SESSION['rol'] !=5 and $_SESSION['rol'] !=2 and $_SESSION['rol'] !=1)
	{
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['pastor']) || empty($_POST['telefono']) || empty($_POST['direccion']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$idPastor = $_POST['idPastor'];
			$dui = $_POST['dui'];
			$pastor = $_POST['pastor'];
			$telefono  = $_POST['telefono'];
			$direccion   = $_POST['direccion'];

            $result = 0;

            if(is_numeric($dui) and $dui !=0)

            {

            $query = mysqli_query($conection,"SELECT * FROM pastor WHERE (dui = $dui AND codpastor != $idPastor)");

		    $result = mysqli_fetch_array($query);

            }

			if($result > 0){
				$alert='<p class="msg_error">El DUI ya fue registrado.</p>';
			}else{

				if($dui == '')
                 {
                 	$dui = 0;
                 }
				

			$sql_update = mysqli_query($conection,"UPDATE pastor
															SET dui = '$dui', pastor='$pastor', telefono='$telefono',direccion='$direccion'
															WHERE codpastor= $idPastor ");
		    
				if($sql_update){
					$alert='<p class="msg_save">Pastor actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el pastor.</p>';
				}

			}


		}

	}

	//Mostrar Datos
	if(empty($_REQUEST['cod']))
	{
		header('Location: lista_pastores.php');
		mysqli_close($conection);
	}
	$idUser = $_REQUEST['cod'];

	$sql= mysqli_query($conection,"SELECT * FROM pastor 
								   WHERE codpastor= $idUser ");
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: lista_pastores.php');
	}else{

		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$idUser  = $data['codpastor'];
			$dui  = $data['DUI'];
			$pastor  = $data['pastor'];
			$telefono = $data['telefono'];
			$direccion   = $data['direccion'];

		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Actualizar Pastor</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Actualizar Pastor</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<input type="hidden" name="idPastor" value="<?php echo $idUser; ?>">
				<label for="dui">DUI</label>
				<input type="number" name="dui" id="dui" placeholder="Número de DUI" value="<?php echo $dui; ?>">
				<label for="pastor">Pastor</label>
				<input type="text" name="pastor" id="pastor" placeholder="Nombre completo"value="<?php echo $pastor; ?>">
				<label for="telefono">Telefono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Teléfono"value="<?php echo $telefono; ?>">
				<label for="direccion">Direccion</label>
				<input type="text" name="direccion" id="direccion" placeholder="Direccion completa"value="<?php echo $direccion; ?>">
				
				<input type="submit" value="Actualizar Pastor" class="btn_save">

			</form>

		</div>

	</section>
	<?php include "includes/footer.php"; ?>

</body>
</html>