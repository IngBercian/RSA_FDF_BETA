<?php 
	session_start();
	if($_SESSION['rol'] !=3)
	{
		header("location: ./");
	}
	
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['rol']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$nombre = $_POST['nombre'];
			$email  = $_POST['correo'];
			$user   = $_POST['usuario'];
			$clave  = md5($_POST['clave']);
			$rol    = $_POST['rol'];


			$query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario = '$user' OR correo = '$email' ");
			$result = mysqli_fetch_array($query);

			if($result > 0){
				$alert='<p class="msg_error">El correo o el usuario ya existe.</p>';
			}else{

				$query_insert = mysqli_query($conection,"INSERT INTO usuario(nombre,correo,usuario,clave,rol)
																	VALUES('$nombre','$email','$user','$clave','$rol')");
				if($query_insert){
					$alert='<p class="msg_save">Usuario creado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al crear el usuario.</p>';
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
	<title>Registro Acceso</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Registro Acceso</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<label for="agente">Agente</label>

				<?php 

            $query_agente = mysqli_query($conection,"SELECT * FROM agente WHERE estatus=1 AND usuario_id = $_SESSION[iduser] " );
            $result_agente = mysqli_num_rows($query_agente);

            ?>

            <select name="nombre" id="nombre">
 
            <?php 
	        if($result_agente > 0)
	        {
		    while ($agente = mysqli_fetch_array($query_agente)) {
            ?>
		    <option value="<?php echo $agente['agente']; ?>"><?php echo $agente["agente"] ?></option>
            <?php 
			# code...
	   	    }
	      	
	        }
           ?>
           </select>

				<label for="correo">Correo electrónico</label>
				<input type="email" name="correo" id="correo" placeholder="Correo electrónico">
				<label for="usuario">Usuario</label>
				<input type="text" name="usuario" id="usuario" placeholder="Usuario">
				<label for="clave">Clave</label>
				<input type="password" name="clave" id="clave" placeholder="Clave de acceso">
				<label for="rol">Tipo Usuario</label>

				<?php 

					$query_rol = mysqli_query($conection,"SELECT * FROM rol WHERE codrol=4" );
					mysqli_close($conection);
					$result_rol = mysqli_num_rows($query_rol);

				 ?>

				<select name="rol" id="rol">
					
					<?php 
						if($result_rol > 0)
						{
							while ($rol = mysqli_fetch_array($query_rol)) {
					?>
							<option value="<?php echo $rol['codrol']; ?>"><?php echo $rol["rol"] ?></option>
					<?php 
								# code...
							}
							
						}
					 ?>
				</select>
				<input type="submit" value="Crear acceso" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>