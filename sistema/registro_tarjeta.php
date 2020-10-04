<?php 
	session_start();
	
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['tarjeta']) )
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$tarjeta     = $_POST['tarjeta'];
			$descripcion     = $_POST['descripcion'];
			$monto     = $_POST['monto'];
            $usuario_id  = $_SESSION['iduser'];

			$result = 0;
			
            $query = mysqli_query($conection,"SELECT * FROM tarjeta WHERE tarjeta = '$tarjeta' ");
            $result = mysqli_fetch_array($query);

            if($result > 0)
            {

            $alert='<p class="msg_error">La tarjeta ya existe.</p>';

            }else{

            $query_insert = mysqli_query($conection,"
            INSERT INTO
            tarjeta(tarjeta,descripcion,monto,usuario_id)
			VALUES('$tarjeta','$descripcion','$monto','$usuario_id')");

			if($query_insert){
					$alert='<p class="msg_save">Tarjeta registrada correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al registrar la tarjeta.</p>';
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
	<title>Registro tarjeta</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Registrar tarjeta</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				
				<label for="tarjeta">Tarjeta</label>
				<input type="text" name="tarjeta" id="tarjeta" placeholder="Tarjeta (proyecto)">
				<label for="descripcion">Descripcion</label>
				<input type="text" name="descripcion" id="descripcion" placeholder="Descripcion">
				<label for="monto">Monto</label>
				<input type="numeric" name="monto" id="monto" placeholder="Inversion estimada">
				<input type="submit" value="Guardar tarjeta" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>