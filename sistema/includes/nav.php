		<nav>
			<ul>
				<li><a  href="index.php">Inicio</a></li>
			<?php 
				if($_SESSION['rol'] == 5){
			 ?>
				<li class="principal">

					<a href="#">Usuarios</a>
					<ul>
						<li><a href="registro_usuario.php">Nuevo Usuario</a></li>
						<li><a href="lista_usuarios.php">Lista de Usuarios</a></li>
					</ul>
				</li>
			<?php } ?>

			<?php 
				if($_SESSION['rol'] == 5){
			 ?>


				<li class="principal">
					<a href="#">Consultar</a>
					<ul>
						<li><a href="lista_pastores_aio.php">Pastor</a></li>
						<li><a href="lista_corresponsales_aio.php">Corresponsal</a></li>
						<li><a href="lista_agentes_aio.php">Agente</a></li>
						<li><a href="lista_congregaciones_aio.php">Iglesia</a></li>
						<li><a href="lista_familias_aio.php">Familia</a></li>
						<li><a href="lista_miembros_aio.php">Miembro</a></li>

					</ul>
 
					    <li class="principal">
					    <a href="#">Accesos</a>
					    <ul>
						<li><a href="acclist_pastores">Pastor</a></li>
						<li><a href="acclist_corresponsales_aio.php">Corresponsal</a></li>
						<li><a href="acclist_agentes">Agente</a></li>
				       </ul>
				       </li>


				<?php } ?>

				<?php 
				if($_SESSION['rol'] == 2 ){
			 ?>

                <li class="principal">
					<a href="#">Distrito</a>
					<ul>
						<li><a href="registro_distrito.php">Agregar Distrito</a></li>
					</ul>

					

				</li>
 
				<li class="principal">
					<a href="#">Corresponsales</a>
					<ul>
						<li><a href="registro_corresponsal">Nuevo Corresponsal</a></li>
						<li><a href="lista_corresponsales">Lista de Corresponsales</a></li>
					</ul>
				</li>


				<li class="principal">
					    <a href="#">Accesos</a>
					    <ul>
						<li><a href="acclist_corresponsales.php">Corresponsal</a></li>
				       </ul>
					   </li>
					   

				<?php } ?>

				<?php 

				if($_SESSION['rol'] == 3 ){
			 ?>

                <li class="principal">
					<a href="#">Distrito</a>
					<ul>
						<li><a href="registro_distrito.php">Agregar Distrito</a></li>
					</ul>
				</li>

                <li class="principal">
					<a href="#">Congregaciones</a>
					<ul>
						<li><a href="registro_congregacion.php">Nueva Congregacion</a></li>
						<li><a href="lista_congregaciones.php">Lista de Congregaciones</a></li>
					</ul>
				</li>

				<li class="principal">
					<a href="#">Agentes</a>
					<ul>
						<li><a href="registro_agente.php">Nuevo Agente</a></li>
						<li><a href="lista_agentes.php">Lista de Agentes</a></li>
					</ul>
				</li>
				<li class="principal">
					<a href="#">Accesos</a>
					<ul>
						<li><a href="acceso_agentes.php">Nuevo Acceso</a></li>
						<li><a href="acclist_agentes.php">Lista de Accesos</a></li>
					</ul>
				</li>

                <?php } ?>



				<?php 
				if($_SESSION['rol'] == 4 ){
			 ?>

                <li class="principal">
					<a href="#">Familias</a>
					<ul>
						<li><a href="registro_familia.php">Nueva Familia</a></li>
						<li><a href="lista_familias.php">Lista de Familias</a></li>
					</ul>
					</li>

					<li class="principal">
					<a href="#">Miembros</a>
					<ul>
						<li><a href="registro_miembro.php">Nuevo Miembro</a></li>
						<li><a href="lista_miembros.php">Lista de Miembros</a></li>
					</ul>
					</li>


				<?php } ?>


			
		</nav>