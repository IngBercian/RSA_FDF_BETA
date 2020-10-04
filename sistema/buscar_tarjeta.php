<?php 
	session_start();

	include "../conexion.php";	

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista de tarjetas</title>
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
		
		<h1>Lista de tarjetas</h1>
		<a href="registro_familia.php" class="btn_new">Registrar tarjeta</a>
		
		<form action="buscar_tarjeta.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
			<input type="submit" value="Buscar" class="btn_search">
		</form>

		<table>
			<tr>
				<!--<th>ID</th>-->
				<th>Tarjeta</th>
				<th>Descripcion</th>
				<th>Monto</th>
				<th>Apertura</th>
				<th>Acciones</th>
			</tr>
		<?php 
			//Paginador
		
			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM tarjeta
																WHERE ( codtarjeta LIKE '%$busqueda%' OR 
																		tarjeta LIKE '%$busqueda%' OR 
																		descripcion LIKE '%$busqueda%' OR 
																		monto LIKE '%$busqueda%' 
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

			$query = mysqli_query($conection,"SELECT * FROM tarjeta WHERE 
										( codtarjeta LIKE '%$busqueda%' OR 
											tarjeta LIKE '%$busqueda%' OR 
											descripcion LIKE '%$busqueda%' OR 
											monto LIKE '%$busqueda%' OR 
											apertura    LIKE  '%$busqueda%' ) 
										AND
										estatus = 1 ORDER BY codtarjeta ASC LIMIT $desde,$por_pagina 
				");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					$formato = 'Y-m-d H:i:s';
					$fecha = DateTime::createFromFormat($formato,$data["apertura"])
			?>
				<tr>
					<!--<td><?php echo $data["codtarjeta"]; ?></td>-->
					<td><?php echo $data["tarjeta"]; ?></td>
					<td><?php echo $data["descripcion"]; ?></td>
					<td><?php echo $data["monto"]; ?></td>
					<td><?php echo $fecha->format('d-m-Y'); ?></td>
					<td>
						<a class="link_edit" href="editar_tarjeta.php?id=<?php echo $data["codtarjeta"]; ?>">Editar</a>

					<?php if($_SESSION['rol']==5) { ?>
						|
						<a class="link_delete" href="eliminar_confirmar_tarjeta.php?id=<?php echo $data["codtarjeta"]; ?>">Eliminar</a>
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