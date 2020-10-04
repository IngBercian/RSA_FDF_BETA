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
		if(empty($_POST['telefono']) || empty($_POST['corresponsal']) )
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$distrito       = $_POST['distrito'];
			$corresponsal   = $_POST['corresponsal'];
			$telefono       = $_POST['telefono'];
            $usuario_id     = $_SESSION['iduser'];

            $result = 0;

            if(is_numeric($telefono) and $telefono !=0)
            {

            $query = mysqli_query($conection,"SELECT * FROM corresponsal WHERE telefono = '$telefono' ");
            $result = mysqli_fetch_array($query);

            }
            if($result > 0)
            {

            $alert='<p class="msg_error">El corresponsal ya existe.</p>';

            }else{

            $query_insert = mysqli_query($conection,"
            INSERT INTO
            corresponsal(distrito,corresponsal,telefono,usuario_id)
			VALUES('$distrito','$corresponsal','$telefono','$usuario_id')");

			if($query_insert){
					$alert='<p class="msg_save">Corresponsal registrado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al registrar corresponsal.</p>';
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
	<title>Registro corresponsal</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Registrar Corresponsal</h1>
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
		   
				<label for="corresponsal">Corresponsal</label>
				<input type="text" name="corresponsal" id="corresponsal" placeholder="Nombre completo">
				<label for="telefono">Teléfono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Teléfono">
				
				<input type="submit" value="Guardar Corresponsal" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>