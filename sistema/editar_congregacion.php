<?php 
	
	session_start();
	if($_SESSION['rol'] !=5 and $_SESSION['rol'] !=2 and $_SESSION['rol'] !=1 and $_SESSION['rol'] !=3  )
	{
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['corresponsal']) || empty($_POST['telefono']) )
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$idCorresponsal = $_POST['idCorresponsal'];
			$corresponsal = $_POST['corresponsal'];
			$telefono  = $_POST['telefono'];

            $result = 0;

            if(is_numeric($telefono) and $telefono !=0)

            {

            $query = mysqli_query($conection,"SELECT * FROM corresponsal WHERE (telefono = $telefono AND codCorresponsal != $idCorresponsal)");

		    $result = mysqli_fetch_array($query);

            }

			if($result > 0){
				$alert='<p class="msg_error">El telefono ya fue registrado.</p>';
			}else{

				if($telefono == '')
                 {
                 	$telefono = 0;
                 }
				

			$sql_update = mysqli_query($conection,"UPDATE corresponsal
															SET corresponsal='$corresponsal', telefono='$telefono'
															WHERE codcorresponsal= $idCorresponsal ");
		    
				if($sql_update){
					$alert='<p class="msg_save">Corresponsal actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el corresponsal.</p>';
				}

			}


		}

	}

	//Mostrar Datos
	if(empty($_REQUEST['cod']))
	{
		header('Location: lista_corresponsales.php');
		mysqli_close($conection);
	}
	$idUser = $_REQUEST['cod'];

	$sql= mysqli_query($conection,"SELECT * FROM corresponsal 
								   WHERE codcorresponsal= $idUser ");
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: lista_corresponsales.php');
	}else{

		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$idUser  = $data['codcorresponsal'];
			$corresponsal  = $data['corresponsal'];
			$telefono = $data['telefono'];

		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Actualizar Corresponsal</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Actualizar Corresponsal</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<input type="hidden" name="idCorresponsal" value="<?php echo $idUser; ?>">
				<label for="corresponsal">Corresponsal</label>
				<input type="text" name="corresponsal" id="corresponsal" placeholder="Nombre completo"value="<?php echo $corresponsal; ?>">
				<label for="telefono">Telefono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Teléfono"value="<?php echo $telefono; ?>">

				<input type="submit" value="Actualizar Corresponsal" class="btn_save">

			</form>

		</div>

	</section>
	<?php include "includes/footer.php"; ?>

</body>
</html>