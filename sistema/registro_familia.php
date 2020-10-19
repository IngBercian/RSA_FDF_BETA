<?php 
	session_start();
	
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['familia']) || empty($_POST['telefono']) || empty($_POST['donativo']) || empty($_POST['plan']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$familia      = $_POST['familia'];
			$telefono    = $_POST['telefono'];
			$donativo   = $_POST['donativo'];
			$plan   = $_POST['plan'];

            $usuario_id  = $_SESSION['iduser'];

            $result = 0;

            if(is_numeric($telefono) and $telefono !=0)
            {

            $query = mysqli_query($conection,"SELECT * FROM familia WHERE telefono = '$telefono' AND estatus = 1; " );
            $result = mysqli_fetch_array($query);

            }
            if($result > 0)
            {

            $alert='<p class="msg_error">El número de teléfono ya existe.</p>';

            }else{

            $query_insert = mysqli_query($conection,"
            INSERT INTO
            familia(familia,telefono,donativo,plan,usuario_id)
			VALUES('$familia','$telefono','$donativo','$plan','$usuario_id')");

			if($query_insert){
					$alert='<p class="msg_save">Familia registrada correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al registrar la familia.</p>';
				}
            }

        } 
        
        
	
    }

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Registro familiar</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Registrar Familia</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<label for="familia">Familia</label>
				<input type="text" name="familia" id="familia" placeholder="Apellidos">
				<label for="telefono">Teléfono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Teléfono">
				<label for="donativo">Ofrenda</label>
				<input type="number" name="donativo" id="donativo" placeholder="Ofrenda">
				<label for="rol">Tipo de plan</label>

				<?php 

					$query_plan = mysqli_query($conection,"SELECT * FROM plan");
					mysqli_close($conection);
					$result_plan = mysqli_num_rows($query_plan);

				 ?>

				<select name="plan" id="plan">
					
					<?php 
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
				
				<input type="submit" value="Guardar Familia" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>