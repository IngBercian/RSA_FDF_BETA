<?php 
	
	session_start();
	if($_SESSION['rol'] !=5 and $_SESSION['rol'] !=4 and $_SESSION['rol'] !=2 and $_SESSION['rol'] !=1)
	{
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['familia']) || empty($_POST['telefono']) || empty($_POST['donativo']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$idFamilia = $_POST['idFamilia'];
			$dui = $_POST['dui'];
			$familia = $_POST['familia'];
			$telefono  = $_POST['telefono'];
			$donativo   = $_POST['donativo'];

            $result = 0;

            if(is_numeric($dui) and $dui !=0)

            {

            $query = mysqli_query($conection,"SELECT * FROM familia WHERE (dui = $dui AND codfamilia != $idFamilia)");

		    $result = mysqli_fetch_array($query);

            }

			if($result > 0){
				$alert='<p class="msg_error">El DUI ya fue registrado.</p>';
			}else{

				if($dui == '')
                 {
                 	$dui = 0;
                 }
				

			$sql_update = mysqli_query($conection,"UPDATE familia
															SET dui = '$dui', familia='$familia', telefono='$telefono',donativo='$donativo'
															WHERE codFamilia= $idFamilia ");
		    
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
		header('Location: lista_familias.php');
		mysqli_close($conection);
	}
	$idUser = $_REQUEST['cod'];

	$sql= mysqli_query($conection,"SELECT * FROM familia 
								   WHERE codfamilia= $idUser ");
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: lista_familias.php');
	}else{

		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$idUser  = $data['codfamilia'];
			$dui  = $data['dui'];
			$familia  = $data['familia'];
			$telefono = $data['telefono'];
			$donativo   = $data['donativo'];

		




		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Actualizar Familias</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Actualizar Familia</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<input type="hidden" name="idFamilia" value="<?php echo $idUser; ?>">
				<label for="dui">DUI</label>
				<input type="number" name="dui" id="dui" placeholder="Número de DUI" value="<?php echo $dui; ?>">
				<label for="familia">Familia</label>
				<input type="text" name="familia" id="familia" placeholder="Apellidos padre/madre"value="<?php echo $familia; ?>">
				<label for="telefono">Telefono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Teléfono"value="<?php echo $telefono; ?>">
				<label for="donativo">Donativo</label>
				<input type="number" name="donativo" id="donativo" placeholder="Donativo anual"value="<?php echo $donativo; ?>">
				
				<input type="submit" value="Actualizar Familia" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>