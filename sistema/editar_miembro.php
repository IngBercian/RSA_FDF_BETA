<?php 
	
	session_start();
	if($_SESSION['rol'] !=5 and $_SESSION['rol'] !=4 and $_SESSION['rol'] !=2 and $_SESSION['rol'] !=1 and $_SESSION['rol'] !=30)
	{
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['miembro']) || empty($_POST['edad']) || empty($_POST['nacimiento']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$idMiembro = $_POST['idMiembro'];
			$miembro = $_POST['miembro'];
			$edad  = $_POST['edad'];
			$nacimiento   = $_POST['nacimiento'];

            $result = 0;

            if(is_numeric($edad) and $edad !=0)

            {

            $query = mysqli_query($conection,"SELECT * FROM miembro WHERE usuario_id = $_SESSION[iduser] ");


            }

			if($result > 0){
				$alert='<p class="msg_error">El miembro ya fue registrado.</p>';
			}else{

				if($edad == '')
                 {
                 	$edad = 0;
                 }
				

			$sql_update = mysqli_query($conection,"UPDATE miembro
															SET miembro='$miembro', edad='$edad',nacimiento='$nacimiento'
															WHERE codmiembro= $idMiembro ");
		    
				if($sql_update){
					$alert='<p class="msg_save">Miembro actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar miembro.</p>';
				}

			}


		}

	}

	//Mostrar Datos
	if(empty($_REQUEST['cod']))
	{
		header('Location: lista_miembros.php');
		mysqli_close($conection);
	}
	$idUser = $_REQUEST['cod'];

	$sql= mysqli_query($conection,"SELECT * FROM miembro
								   WHERE codmiembro= $idUser ");
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: lista_miembros.php');
	}else{

		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$idUser  = $data['codmiembro'];
			$miembro  = $data['miembro'];
			$edad = $data['edad'];
			$nacimiento = $data['nacimiento'];

		




		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Actualizar Miembro</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Actualizar Miembro</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<input type="hidden" name="idMiembro" value="<?php echo $idUser; ?>">
				<label for="miembro">Miembro</label>
				<input type="text" name="miembro" id="miembro" placeholder="Nombre de la Persona"value="<?php echo $miembro; ?>">
				<label for="telefono">Edad</label>
				<input type="number" name="edad" id="edad" placeholder="Edad de la Persona"value="<?php echo $edad; ?>">
				<label for="nacimiento">Nacimiento</label>
				<input type="date" name="nacimiento" id="nacimiento" placeholder="Nacimiento (Mes/Dia/Año)"value="<?php echo $nacimiento; ?>">
				
				<input type="submit" value="Actualizar Agente" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>