<?php 
	session_start();
	
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['distrito']) || empty($_POST['zona'])  )
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$distrito        = $_POST['distrito'];
			$zona           = $_POST['zona'];
            $usuario_id     = $_SESSION['iduser'];
			

			$result = 0;
			

            if($zona !=0)
            {

            $query = mysqli_query($conection,"SELECT * FROM distrito WHERE distrito = '$distrito' ");
            $result = mysqli_fetch_array($query);

            }
            if($result > 0)
            {

            $alert='<p class="msg_error">El registro ya existe.</p>';

            }else{

            $query_insert = mysqli_query($conection,"
            INSERT INTO
            distrito(distrito,zona,usuario_id)
			VALUES('$distrito','$zona','$usuario_id')");

			if($query_insert){
					$alert='<p class="msg_save">Distrito registrado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al registrar el distrito.</p>';
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
	<title>Registro Distrital</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Registrar Distrito</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			
			<form action="" method="post" >
				
				<label for="distrito">Distrito</label>
				<input type="text" name="distrito" id="distrito" placeholder="Distrito">
				<label for="zona">Zona</label>
				<input type="number" name="zona" id="zona" placeholder="Zona">
				
				<input type="submit" value="Guardar Distrito" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>