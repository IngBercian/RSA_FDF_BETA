<?php 
	
	session_start();
	if($_SESSION['rol'] !=5 and $_SESSION['rol'] !=3 and $_SESSION['rol'] !=2 and $_SESSION['rol'] !=1)
	{
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['distrito']) || empty($_POST['zona']) )
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$idDistrito = $_POST['idDistrito'];
			$distrito = $_POST['distrito'];
			$zona  = $_POST['zona'];

            $result = 0;

            if(is_numeric($zona) and $zona !=0)

            {

            $query = mysqli_query($conection,"SELECT * FROM distrito WHERE distrito = $distrito AND coddistrito != $idDistrito)");


            }

			if($result > 0){
				$alert='<p class="msg_error">El distrito ya fue registrado.</p>';
			}else{

				if($zona == '')
                 {
                 	$zona = 0;
                 }
				

			$sql_update = mysqli_query($conection,"UPDATE distrito
															SET distrito='$distrito', zona='$zona',
															WHERE coddistrito= $idDistrito ");
		    
				if($sql_update){
					$alert='<p class="msg_save">Distrito actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el distrito.</p>';
				}

			}


		}

	}

	//Mostrar Datos
	if(empty($_REQUEST['cod']))
	{
		header('Location: lista_distritos.php');
		mysqli_close($conection);
	}
	$idUser = $_REQUEST['cod'];

	$sql= mysqli_query($conection,"SELECT * FROM distrito 
								   WHERE coddistrito= $idUser ");
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: lista_distritos.php');
	}else{

		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$idUser  = $data['coddistrito'];
			$distrito  = $data['distrito'];
			$zona = $data['zona'];

		




		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Actualizar Distrito</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Actualizar Distrito</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<input type="hidden" name="idDistrito" value="<?php echo $idUser; ?>">
				<label for="distrito">Distrito</label>
				<input type="text" name="distrito" id="distrito" placeholder="Distrito"value="<?php echo $distrito; ?>">
				<label for="zona">Zona</label>
				<input type="number" name="zona" id="zona" placeholder="Zona"value="<?php echo $zona; ?>">
				
				<input type="submit" value="Actualizar Distrito" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>