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
	<title>Lista Familiar</title>
</head>
<body>
	<?php include "includes/header.php";

	?>
	<section id="container">
		
		<h1>Familias Registradas</h1>
		<a href="registro_familia.php" class="btn_new">Registrar Familia</a>
		
		<form action="buscar_familia.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
			<input type="submit" value="Buscar" class="btn_search">
		</form>

		<table>
			<tr>
				<!--<th>ID</th>-->
				<th>Familia</th>
				<th>Teléfono</th>
				<th>Ofrenda de Fe</th>
				<th>Acciones</th>
			</tr>
		<?php 
			//Paginador
			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM familia WHERE estatus = 1; ");
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

			$query = mysqli_query($conection,"SELECT * FROM familia          
				                              WHERE estatus = 1 ORDER BY codfamilia ASC LIMIT $desde,$por_pagina 
				");

			mysqli_close($conection);

			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					if($data["telefono"] == 0)
					{
						$dui = 'sin definir';
					}else{
						$dui = $data["telefono"];
					}

					$formato = 'Y-m-d H:i:s';
					$fecha = DateTime::createFromFormat($formato,$data["incorporacion"])

					
			?>
				<tr>
					<!--<td><?php echo $data['codfamilia']; ?></td>-->
					<td><?php echo $data['familia']; ?></td>
					<td><?php echo $data['telefono']; ?></td>
					<td><?php echo $data['donativo']; ?></td>
					<!--<td><?php echo $fecha->format('d-m-Y'); ?></td>-->
					<td>
						<a class="link_edit" href="editar_familia.php?cod=<?php echo $data['codfamilia']; ?>">Editar
						</a>

						<?php if($_SESSION['rol'] == 5 ) { ?>
						|
						<a class="link_delete" href="eliminar_confirmar_familia.php?cod=<?php echo $data['codfamilia']; ?>">Eliminar</a>
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