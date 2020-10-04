<?php 
	session_start();
	
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['familia']) || empty($_POST['telefono']) || empty($_POST['donativo']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$familia      = $_POST['familia'];
			$telefono    = $_POST['telefono'];
			$donativo   = $_POST['donativo'];
            $usuario_id  = $_SESSION['iduser'];

            $result = 0;

            if(is_numeric($telefono) and $telefono !=0)
            {

            $query = mysqli_query($conection,"SELECT * FROM familia WHERE telefono = '$telefono' ");
            $result = mysqli_fetch_array($query);

            }
            if($result > 0)
            {

            $alert='<p class="msg_error">El número de teléfono ya existe.</p>';

            }else{

            $query_insert = mysqli_query($conection,"
            INSERT INTO
            familia(familia,telefono,donativo,usuario_id)
			VALUES('$familia','$telefono','$donativo','$usuario_id')");

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
				<label for="donativo">Ofrenda de Fe</label>
				<input type="number" name="donativo" id="donativo" placeholder="Ofrenda">
				
				<input type="submit" value="Guardar Familia" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>