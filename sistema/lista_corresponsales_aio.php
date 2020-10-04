<?php 
	session_start();
	if($_SESSION['rol'] !=5 and $_SESSION['rol'] !=2 and $_SESSION['rol'] !=1)
	{
		header("location: ./");
	}
	include "../conexion.php";	

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista de corresponsales</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<h1>Lista de corresponsales</h1>
		<a href="registro_corresponsal_aio.php" class="btn_new">Registrar corresponsales</a>
		
		<form action="buscar_corresponsal.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
			<input type="submit" value="Buscar" class="btn_search">
		</form>

		<table>
			<tr>
			    <th>Distrito</th>
				<th>Corresponsal</th>
				<th>Teléfono</th>
				<th>Acciones</th>
			</tr>
		<?php 
			//Paginador
			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM corresponsal WHERE estatus = 1 ");
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

			$query = mysqli_query($conection,"SELECT * FROM corresponsal                     
				                              WHERE estatus = 1 ORDER BY codcorresponsal ASC LIMIT $desde,$por_pagina 
				");

			mysqli_close($conection);

			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					if($data["telefono"] == 0)
					{
						$telefono = 'Sin definir';
					}else{
						$telefono = $data["telefono"];
					}
					
			?>
				<tr>
					<td><?php echo $data['distrito']; ?></td>
					<td><?php echo $data['corresponsal']; ?></td>
					<td><?php echo $data['telefono']; ?></td>
					<td>
						<a class="link_edit" href="editar_corresponsal.php?cod=<?php echo $data['codcorresponsal']; ?>">Editar
						</a>
						<?php if($_SESSION['rol']==5) { ?>
						|
						<a class="link_delete" href="eliminar_confirmar_corresponsal.php?cod=<?php echo $data['codcorresponsal']; ?>">Eliminar</a>
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