<?php 
	session_start();
	
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['miembro']) || empty($_POST['edad']) || empty($_POST['nacimiento']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$familia     = $_POST['familia'];
			$miembro     = $_POST['miembro'];
			$edad    = $_POST['edad'];
			$nacimiento   = $_POST['nacimiento'];
            $usuario_id  = $_SESSION['iduser'];

            $result = 0;

            if(is_numeric($edad) and $edad !=0)
            {

            $query = mysqli_query($conection,"SELECT * FROM miembro WHERE miembro = '$miembro' AND usuario_id = $_SESSION[iduser] ");
            $result = mysqli_fetch_array($query);

            }
            if($result > 0)
            {

            $alert='<p class="msg_error">El miembro ya existe.</p>';

            }else{

            $query_insert = mysqli_query($conection,"
            INSERT INTO
            miembro(familia,miembro,edad,nacimiento,usuario_id)
			VALUES('$familia','$miembro','$edad','$nacimiento','$usuario_id')");

			if($query_insert){
					$alert='<p class="msg_save">Miembro registrado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al registrar miembro.</p>';
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
	<title>Registro miembro</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Registrar Miembro</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">


			<label for="familia">Familia</label>

				<?php 

            $query_familia = mysqli_query($conection,"SELECT * FROM familia WHERE estatus=1 AND usuario_id = $_SESSION[iduser] " );
            $result_familia = mysqli_num_rows($query_familia);

            ?>

            <select name="familia" id="familia">
 
            <?php 
	        if($result_familia > 0)
	        {
		    while ($familia = mysqli_fetch_array($query_familia)) {
            ?>
		    <option value="<?php echo $familia['familia']; ?>"><?php echo $familia["familia"] ?></option>
            <?php 
			# code...
	   	    }
	      	
	        }
           ?>
           </select>
				<label for="miembro">Miembro</label>
				<input type="text" name="miembro" id="miembro" placeholder="Nombre de la Persona">
				<label for="edad">Edad</label>
				<input type="number" name="edad" id="edad" placeholder="Edad de la Persona">
				<label for="edad">Nacimiento</label>
				<input type="date" name="nacimiento" id="nacimiento" placeholder="Nacimiento (A-M-D)">
				
				<input type="submit" value="Guardar Miembro" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>