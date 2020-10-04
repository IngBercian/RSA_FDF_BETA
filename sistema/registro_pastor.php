<?php 
	session_start();
	if($_SESSION['rol'] != 5 and $_SESSION['rol'] !=1)
	{
		header("location: ./");
	}
	
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['pastor']) || empty($_POST['telefono']) )
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

            $distrito         = $_POST['distrito'];
			$pastor      = $_POST['pastor'];
			$telefono    = $_POST['telefono'];
            $usuario_id  = $_SESSION['iduser'];

            $result = 0;

            if($telefono !=0)
            {

            $query = mysqli_query($conection,"SELECT * FROM pastor WHERE pastor = '$pastor' ");
            $result = mysqli_fetch_array($query);

            }
            if($result > 0)
            {

            $alert='<p class="msg_error">El registro ya existe.</p>';

            }else{

            $query_insert = mysqli_query($conection,"
            INSERT INTO
            pastor(distrito,pastor,telefono,usuario_id)
			VALUES('$distrito','$pastor','$telefono','$usuario_id')");

			if($query_insert){
					$alert='<p class="msg_save">Pastor registrado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al registrar al pastor.</p>';
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
	<title>Registrar Pastor</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Registrar Pastor</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">


			<label for="distrito">Distrito</label>

            <?php 

            $query_distrito = mysqli_query($conection,"SELECT * FROM distrito WHERE estatus=1 " );
            $result_distrito = mysqli_num_rows($query_distrito);

            ?>

			<select name="distrito" id="distrito">
 
            <?php 
	        if($result_distrito > 0)
	        {
		    while ($distrito = mysqli_fetch_array($query_distrito)) {
            ?>
		    <option value="<?php echo $distrito['distrito']; ?>"><?php echo $distrito["distrito"] ?></option>
            <?php 
			# code...
	   	    }
	      	
	        }
           ?>
           </select>

				<label for="pastor">Pastor</label>
				<input type="text" name="pastor" id="pastor" placeholder="Nombre completo">
				<label for="telefono">Telefono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Teléfono">
					
				<input type="submit" value="Guardar Pastor" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>