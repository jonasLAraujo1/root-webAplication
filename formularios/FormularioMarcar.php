<!DOCTYPE HTML>

<html lang="pt-br">
<head>
	<title>Agendar</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="../css/bootstrap.css" />
	<script src='../js/jquery.min.js'></script>
	<script src='../js/bootstrap.min.js'></script>
	<?php
	include_once '../conectarBanco.php';
	?>
</head>
<body>
	<?php
	session_start();
  #echo $_SESSION['user'];
  if (!isset($_SESSION['user'])){
    ?>
    <div class="alert alert-dark" style="width: 70%;margin-left: 15%;" role="alert">
      <h3 class="alert-heading">Você precisa fazer LOGIN primeiro</h3>
      <hr>
      <a href="index.html"><button class=" btn btn-lg btn-outline-info active" type="button" >Login</button> </a>
    </div>
    <?php
  }

  else{?>
	<!--MENU INICIO -->
	<div class="card" style="width: 100%;background-color: #f8f9fa">
		<div class="card-body">
			<nav class="navbar navbar-light bg-light">
				<form class="form-inline" >
					<a href="../main.php"><button class="btn btn-lg btn-outline-info" type="button">Inicio</button> </a>
					<ul class="nav" style="margin: 0px 5px"></ul>
					<a href="./FormularioMarcar.php"> <button class="btn btn-lg btn-outline-info active" type="button" >Agendar Reunião</button> </a>
				</form>
				<h1> Agendar Reunião </h1>
				<form class="form-inline"  method="POST" action="listaPesquisa.php">
					<input class="form-control-sm" type="name" placeholder="id range" name="busca" aria-label="Search">
					<button class="btn outline-primary" type="submit">Buscar</button>
				</form>
			</nav>
		</div>
	</div>
	<!--MENU FIM -->
	<div class="card" style="width: 70%;margin-left: 15%;background-color: #f8f9fa">
		<div class="card-body">
			<form class="form-inline"  method="post" action="ligacao_banco_marcar.php">
				<dl>
					<dt>Tipo</dt>
					<dt>
						<select name="TipoForm" required name=TipoForm class="form-control">
							<option>Selecionar</option>
							<?php
							$sql = "select  *  FROM tipo";
							$query = mysqli_query($conexao,$sql)or die("Não foi possivel fazer seleção");
							while($resultado = mysqli_fetch_array($query)){
								?>
								<option value= <?php echo $resultado['id_tipo'] ?>> <?php echo $resultado['nome_tipo'] ?> </option>
								<?php
							}
							?>
						</select>
					</dt>
					<dt><br></dt>
					<dt>Presidente</dt>
					<dt>
						<select name="PresidenteForm" required name=PresidenteForm  class="form-control" >
							<option>Selecionar</option>
							<?php
							$sql = "select  *  FROM presidente";
							$query = mysqli_query($conexao,$sql)or die("Não foi possivel fazer seleção");
							while($resultado = mysqli_fetch_array($query)){
								?>
								<option value=<?php echo $resultado['id_presidente'] ?>> <?php echo $resultado['nome_presidente'] ?> </option>
								<?php
							}
							?>
						</select>
					</dt>
					<dt><br></dt>
					<dt> Data</dt>
					<dt> <input name="DataForm" id="date" type="date" required name= DataForm class="form-control"> </dt>
					<dt><br></dt>
					<dt>
						Hora de Inicio
						<input name="InicioForm" id="time" type="time" required name=InicioForm class="form-control">
						Termino
						<input name="FimForm" id="time" type="time" required name=FimForm class="form-control">
					</dt>
					<dt><br></dt>
					<dt>Pauta</dt>
					<dt>
						<textarea  name="PautaForm" id="message" rows="4" cols="60" class="form-text"></textarea>
					</dt>
					<dt><br></dt>
					<!-- <dt><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#lista">Participantes</button>
					</dt>
					<dt><br></dt>
					<dt>
					<div  class="collapse" id="lista" >
					<?php $sql= "select  nome_usuario FROM usuario";
					$consulta=mysqli_query($conexao,$sql);
					while($resultado = mysqli_fetch_array($consulta)){ 
					?>
					<input  class="form-check-input"  type="checkbox"  id="defaultCheck1">
					<label   class="form-check-input form-check-label" for="defaultCheck1">
					<?php echo $resultado['nome_usuario'];  ?>
					</label>
					<?php } ?>
					</div>
					</dt>
				    <dt><br></dt> -->
				    <dt><input class="btn outline-primary" value="Confirmar" type="submit"></dt>
				    <!--<li><div class="button special">Confirmar </div></li> -->
				</dl>
			</form>
		</div>
	</div>
	<<?php } ?>
</body>
</html>