<?php 
	session_start();

	include "../conexion.php";	
	if($_SESSION['rol'] != 5 and $_SESSION['rol'] !=1 and $_SESSION['rol'] !=4)
	{
		header("location: ./");
	}
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista Distrital</title>
</head>
<body>
	<?php include "includes/header.php";

	?>
	<section id="container">
		
		<h1>Distritos Registrados</h1>
		<a href="registro_distrito.php" class="btn_new">Registrar Distrito</a>
		
		<form action="buscar_distrito.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
			<input type="submit" value="Buscar" class="btn_search">
		</form>

		<table>
			<tr>
				<!--<th>ID</th>-->
				<th>Distrito</th>
				<th>Zona</th>
				<th>Acciones</th>
			</tr>
		<?php 
			//Paginador
			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM distrito WHERE estatus = 1; ");
			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 10;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

			$query = mysqli_query($conection,"SELECT * FROM distrito         
				                              WHERE estatus = 1  ORDER BY coddistrito ASC LIMIT $desde,$por_pagina 
				");

			mysqli_close($conection);

			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					if($data["zona"] == 0)
					{
						$zona = 'sin definir';
					}else{
						$zona = $data["zona"];
					}

					$formato = 'Y-m-d H:i:s';
					$fecha = DateTime::createFromFormat($formato,$data["incorporacion"])

					
			?>
				<tr>
				    <td><?php echo $data['distrito']; ?></td>
					<td><?php echo $data['zona']; ?></td>
					<td>


						<a class="link_edit" href="editar_distrito.php?cod=<?php echo $data['coddistrito']; ?>">Editar
						</a>

						<?php if($_SESSION['rol'] == 5 || $_SESSION['rol'] == 4 ) { ?>
						|
						<a class="link_delete" href="eliminar_confirmar_distrito.php?cod=<?php echo $data['coddistrito']; ?>">Eliminar</a>
					<?php } ?>
						
					</td>
				</tr>
			
		<?php 
				}

			}
		 ?>


		</table>
		<div class="paginador">
			<ul>
			<?php 
				if($pagina != 1)
				{
			 ?>
				<li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>
			<?php 
				}
				for ($i=1; $i <= $total_paginas; $i++) { 
					# code...
					if($i == $pagina)
					{
						echo '<li class="pageSelected">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
					}
				}

				if($pagina != $total_paginas)
				{
			 ?>
				<li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?> ">>|</a></li>
			<?php } ?>
			</ul>
		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>