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
		if(empty($_POST['telefono']) || empty($_POST['agente']) )
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$congregacion   = $_POST['congregacion'];
			$agente         = $_POST['agente'];
			$telefono       = $_POST['telefono'];
            $usuario_id     = $_SESSION['iduser'];

            $result = 0;

            if($congregacion !=0)
            {

            $query = mysqli_query($conection,"SELECT * FROM agente WHERE congregacion = '$congregacion' ");
            $result = mysqli_fetch_array($query);

            }
            if($result > 0)
            {

            $alert='<p class="msg_error">El agente ya existe.</p>';

            }else{

            $query_insert = mysqli_query($conection,"
            INSERT INTO
            agente(congregacion,agente,telefono,usuario_id)
			VALUES('$congregacion','$agente','$telefono','$usuario_id')");

			if($query_insert){
					$alert='<p class="msg_save">Agente registrado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al registrar al agente.</p>';
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
	<title>Registro gente</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Registrar Agente</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">

				<label for="congregacion">Congregacion</label>

            <?php 

            $query_congregacion = mysqli_query($conection,"SELECT * FROM iglesia WHERE estatus=1 AND usuario_id = $_SESSION[iduser]" );
            $result_congregacion = mysqli_num_rows($query_congregacion);

            ?>

			<select name="congregacion" id="congregacion">
 
            <?php 
	        if($result_congregacion > 0)
	        {
		    while ($congregacion = mysqli_fetch_array($query_congregacion)) {
            ?>
		    <option value="<?php echo $congregacion['congregacion']; ?>"><?php echo $congregacion["congregacion"] ?></option>
            <?php 
			# code...
	   	    }
	      	
	        }
           ?>
           </select>
		   
				<label for="agente">Agente</label>
				<input type="text" name="agente" id="agente" placeholder="Nombre completo">
				<label for="telefono">Teléfono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Teléfono">
				
				<input type="submit" value="Guardar Agente" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>