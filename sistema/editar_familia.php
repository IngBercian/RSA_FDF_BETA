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
		if(empty($_POST['familia']) || empty($_POST['telefono']) || empty($_POST['donativo']) || empty($_POST['plan']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$idFamilia = $_POST['idFamilia'];
			$familia = $_POST['familia'];
			$telefono  = $_POST['telefono'];
			$donativo   = $_POST['donativo'];
			$plan = $_POST['plan'];

            $result = 0;

            if(is_numeric($telefono) and $telefono !=0)

            {

            $query = mysqli_query($conection,"SELECT * FROM familia WHERE (telefono = $telefono AND codfamilia != $idFamilia)");

		    $result = mysqli_fetch_array($query);

            }

			if($result > 0){
				$alert='<p class="msg_error">El telefono ya fue registrado.</p>';
			}else{

				if($telefono == '')
                 {
                 	$telefono = 0;
                 }
				

			$sql_update = mysqli_query($conection,"UPDATE familia
															SET familia='$familia', telefono='$telefono',donativo='$donativo',plan='$plan'
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

	$sql= mysqli_query($conection,"SELECT * FROM familia u
									INNER JOIN plan r
									on u.plan = r.idplan
									WHERE codfamilia= $idUser ");

	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: lista_familias.php');
	}else{
			$option = '';
			while ($data = mysqli_fetch_array($sql)) {
				# code...
				$idUser  = $data['codfamilia'];
			    $familia  = $data['familia'];
			    $telefono = $data['telefono'];
				$donativo   = $data['donativo'];
				$idplan   = $data['idplan'];
				$plan    = $data['plan'];
	
				if($idplan == 1){
					$option = '<option value="'.$idplan.'" select>'.$plan.'</option>';
				}else if($idplan == 1){
					$option = '<option value="'.$idplan.'" select>'.$plan.'</option>';	
				}else if($idplan == 2){
					$option = '<option value="'.$idplan.'" select>'.$plan.'</option>';
				}else if($idplan == 3){
					$option = '<option value="'.$idplan.'" select>'.$plan.'</option>';
				}else if($idplan == 4){
					$option = '<option value="'.$idplan.'" select>'.$plan.'</option>';
				}else if($idplan == 5){
					$option = '<option value="'.$idplan.'" select>'.$plan.'</option>';
				}
	
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
				<label for="familia">Familia</label>
				<input type="text" name="familia" id="familia" placeholder="Apellidos"value="<?php echo $familia; ?>">
				<label for="telefono">Telefono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Teléfono"value="<?php echo $telefono; ?>">
				<label for="donativo">Ofrenda</label>
				<input type="number" name="donativo" id="donativo" placeholder="Ofrenda"value="<?php echo $donativo; ?>">
				<label for="plan">Plan</label>
				
				<?php 
					include "../conexion.php";
					$query_plan = mysqli_query($conection,"SELECT * FROM plan");
					mysqli_close($conection);
					$result_plan = mysqli_num_rows($query_plan);

				 ?>

				<select name="plan" id="plan" class="notItemOne">
					<?php
						echo $option; 
						if($result_plan > 0)
						{
							while ($plan = mysqli_fetch_array($query_plan)) {
					?>
							<option value="<?php echo $plan["idplan"]; ?>"><?php echo $plan["plan"] ?></option>
					<?php 
								# code...
							}
							
						}
					 ?>
				</select>

				<input type="submit" value="Actualizar Familia" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>