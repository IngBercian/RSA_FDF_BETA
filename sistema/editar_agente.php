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
		if(empty($_POST['agente']) || empty($_POST['telefono']) )
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$idAgente = $_POST['idAgente'];
			$agente = $_POST['agente'];
			$telefono  = $_POST['telefono'];

            $result = 0;

            if(is_numeric($telefono) and $telefono !=0)

            {

            $query = mysqli_query($conection,"SELECT * FROM agente WHERE telefono = $telefono AND codagente != $idAgente)");


            }

			if($result > 0){
				$alert='<p class="msg_error">El agente ya fue registrado.</p>';
			}else{

				if($telefono == '')
                 {
                 	$telefono = 0;
                 }
				

			$sql_update = mysqli_query($conection,"UPDATE agente
															SET agente='$agente', telefono='$telefono',
															WHERE codagente= $idAgente ");
		    
				if($sql_update){
					$alert='<p class="msg_save">Agente actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el agente.</p>';
				}

			}


		}

	}

	//Mostrar Datos
	if(empty($_REQUEST['cod']))
	{
		header('Location: lista_agentes.php');
		mysqli_close($conection);
	}
	$idUser = $_REQUEST['cod'];

	$sql= mysqli_query($conection,"SELECT * FROM agente 
								   WHERE codagente= $idUser ");
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: lista_agentes.php');
	}else{

		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$idUser  = $data['codagente'];
			$agente  = $data['agente'];
			$telefono = $data['telefono'];

		




		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Actualizar Agente</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Actualizar Agente</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<input type="hidden" name="idAgente" value="<?php echo $idUser; ?>">
				<label for="agente">Agente</label>
				<input type="text" name="agente" id="agente" placeholder="Nombre completo"value="<?php echo $agente; ?>">
				<label for="telefono">Teléfono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Teléfono"value="<?php echo $telefono; ?>">
				
				<input type="submit" value="Actualizar Agente" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>