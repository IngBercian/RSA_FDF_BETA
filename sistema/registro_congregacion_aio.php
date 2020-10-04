<?php 
	session_start();
	
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['congregacion']) || empty($_POST['distrito']) )
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{
			
			$distrito     = $_POST['distrito'];
			$congregacion = $_POST['congregacion'];
			$membresia    = $_POST['membresia'];
            $usuario_id   = $_SESSION['iduser'];

            $result = 0;

            if($membresia !=0)
            {

            $query = mysqli_query($conection,"SELECT * FROM iglesia WHERE congregacion = '$congregacion' ");
            $result = mysqli_fetch_array($query);

            }
            if($result > 0)
            {

            $alert='<p class="msg_error">El registro ya existe.</p>';

            }else{

            $query_insert = mysqli_query($conection,"
            INSERT INTO
            iglesia(distrito,congregacion,usuario_id)
			VALUES('$distrito','$congregacion','$usuario_id')");

			if($query_insert){
					$alert='<p class="msg_save">Iglesia registrada correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al registrar la iglesia.</p>';
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
	<title>Registro Iglesias</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Registrar Congregación</h1>
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

				
				<label for="congregacion">Congregación</label>
				<input type="text" name="congregacion" id="congregacion" placeholder="congregación">

				<label for="membresia">Familias de Fe</label>
				<input type="number" name="membresia" id="membresia" placeholder="cantidad de familias">

				<input type="submit" value="Guardar Congregación" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>