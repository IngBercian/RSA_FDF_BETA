<?php 
	session_start();

	include "../conexion.php";	

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista de miembros</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<?php 

			$busqueda = strtolower($_REQUEST['busqueda']);
			if(empty($busqueda))
			{
				header("location: lista_familias.php");
				mysqli_close($conection);
			}


		 ?>
		
		<h1>Busqueda de miembros</h1>
		<a href="registro_familia.php" class="btn_new">Registrar familia</a>
		
		<form action="buscar_familia.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
			<input type="submit" value="Buscar" class="btn_search">
		</form>

		<table>
			<tr>
				
				<th>Familia</th>
				<th>Miembro</th>
				<th>Edad</th>
				<th>Nacimiento</th>
				<th>Acciones</th>
			</tr>
		<?php 
			//Paginador
		
			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM miembro
																WHERE ( codmiembro LIKE '%$busqueda%' OR 
																		familia LIKE '%$busqueda%' OR 
																		miembro LIKE '%$busqueda%' OR 
																		edad LIKE '%$busqueda%' OR
																		nacimiento LIKE '%$busqueda%'
																		) 
																AND estatus = 1  ");

			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 5;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

			$query = mysqli_query($conection,"SELECT * FROM miembro WHERE 
										( codmiembro LIKE '%$busqueda%' OR 
											familia LIKE '%$busqueda%' OR 
											miembro LIKE '%$busqueda%' OR 
											edad LIKE '%$busqueda%' OR 
											nacimiento    LIKE  '%$busqueda%' OR
											incorporacion    LIKE  '%$busqueda%' ) 
										AND
										estatus = 1 ORDER BY codmiembro ASC LIMIT $desde,$por_pagina 
				");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					$formato = 'Y-m-d H:i:s';
					$fecha = DateTime::createFromFormat($formato,$data["incorporacion"])
			?>
				<tr>
					
					<td><?php echo $data["familia"]; ?></td>
					<td><?php echo $data["miembro"]; ?></td>
					<td><?php echo $data["edad"]; ?></td>
					<td><?php echo $data['nacimiento'] ?></td>
					<!--<td><?php echo $fecha->format('d-m-Y'); ?></td>-->
					<td>
						<a class="link_edit" href="editar_miembro.php?cod=<?php echo $data["codmiembro"]; ?>">Editar</a>
					
					<?php if($_SESSION['rol']==5) { ?>
						|
						<a class="link_delete" href="eliminar_confirmar_miembro.php?id=<?php echo $data["codmiembro"]; ?>">Eliminar</a>
					<?php } ?>
						
					</td>
				</tr>
			
		<?php 
				}

			}
		 ?>


		</table>
<?php 
	
	if($total_registro != 0)
	{
 ?>
		<div class="paginador">
			<ul>
			<?php 
				if($pagina != 1)
				{
			 ?>
				<li><a href="?pagina=<?php echo 1; ?>&busqueda=<?php echo $busqueda; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>&busqueda=<?php echo $busqueda; ?>"><<</a></li>
			<?php 
				}
				for ($i=1; $i <= $total_paginas; $i++) { 
					# code...
					if($i == $pagina)
					{
						echo '<li class="pageSelected">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'&busqueda='.$busqueda.'">'.$i.'</a></li>';
					}
				}

				if($pagina != $total_paginas)
				{
			 ?>
				<li><a href="?pagina=<?php echo $pagina + 1; ?>&busqueda=<?php echo $busqueda; ?>">>></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?>&busqueda=<?php echo $busqueda; ?> ">>|</a></li>
			<?php } ?>
			</ul>
		</div>
<?php } ?>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>