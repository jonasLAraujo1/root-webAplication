<!DOCTYPE HTML>

<html lang="pt-br">
<head>
	<title>Alterar</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="../css/bootstrap.css" />
	<?php
	if (isset($_POST['id'])) {
		$codigoURL = $_POST['id'];
	}
	else{
		$codigoURL = $_GET['codurl'];
	}
	include_once '../conectarBanco.php';
	?>
</head>
<body>
	<?php
	$sql = "select  *  FROM reunioes where id_reuniao=$codigoURL";
	$query = mysqli_query($conexao,$sql);
	while($resultado = mysqli_fetch_array($query)){
		$codigoT = $resultado['tipo_reuniao'];
		$codigoP = $resultado['presidente_reuniao'];
		$codigoD = $resultado['data_reuniao'];
		$atualPauta = $resultado['pauta'];
		$atualParticipantes = $resultado['participantes'];
		$atualDeliberacoes = $resultado['deliberacoes'];
		$atualObservacoes = $resultado['observacoes'];
	}
	$sql = "select  *  FROM horario where id_horario=$codigoD";
	$query = mysqli_query($conexao,$sql);
	while($resultado = mysqli_fetch_array($query)){
		$atualD = $resultado['id_horario'];
		$atualData= substr($resultado['inicio'], 0, 10);
		$atualI = substr($resultado['inicio'], 0, 10);
		$atualF =substr($resultado['fim'], 0, 10); 
	}
	$sql = "select  *  FROM presidente where id_presidente=$codigoP";
	$query = mysqli_query($conexao,$sql);
	while($resultado = mysqli_fetch_array($query)){
		$atualPresidente=$resultado['nome_presidente'];
	}
	$sql = "select  *  FROM tipo where id_tipo=$codigoT";
	$query = mysqli_query($conexao,$sql);
	while($resultado = mysqli_fetch_array($query)){
		$atualTipo = $resultado['nome_tipo'];
	}
	?>
	<!--MENU INICIO -->
	<div class="card" style="width: 100%;background-color: #f8f9fa">
		<div class="card-body">
			<nav class="navbar navbar-light bg-light">
				<form class="form-inline" >
					<a href="../main.php"><button class="btn btn-lg btn-outline-info" type="button" >Inicio</button> </a>
					<ul class="nav" style="margin: 0px 5px"></ul>
					<a href="./FormularioMarcar.php"> <button class="btn btn-lg btn-outline-info" type="button" >Marcar</button> </a>
				</form>
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
			<h2>Alterar Reunião</h2>
			<form class="form-inline"  method="post" action="ligacao_banco_alterar.php">
				<dl>
					<dt>ID</dt>
					<dt>
						<input name="cod" type="text" readonly value=<?php echo $codigoURL ?> >
					</dt>
					<dt><br></dt>
					<dt>Tipo</dt>
					<dt>
						<select name="novoTipo" class="form-control">
							<option value= <?php echo $codigoT ?>><?php echo $atualTipo ?>  </option>
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
						<select   name="novoPresidente" class="form-control">
							<option value= <?php echo $codigoP ?>><?php echo $atualPresidente ?></option>
							<?php
							$sql = "select  *  FROM presidente";
							$query = mysqli_query($conexao,$sql)or die("Não foi possivel fazer seleção");
							while($resultado = mysqli_fetch_array($query)){
								?>
								<option value= <?php echo $resultado['id_presidente'] ?>> <?php echo $resultado['nome_presidente'] ?></option>
								<?php
							}
							?>
						</select>
					</dt>
					<dt><br></dt>
					<dt>
						<input type="date" name="novoData" required name=novoData  class="form-control" value= <?php echo $atualData ?>>
					</dt>
					<dt><br></dt>
					<dt>
						Hora de Inicio
						<input type="time" name="novoHoraI" required name=novoHoraI class="form-control"  >
						Termino
						<input type="time" name="novoHoraF" required name=novoHoraF class="form-control">
					</dt>
					<dt><br></dt>
					<dt>Pauta</dt>
					<dt>
						<textarea name="novoPauta" class="form-control"  rows='4' cols="60"><?php echo $atualPauta ?> </textarea>
					</dt>
					<dt><br></dt>
					<dt>Deliberações</dt>
					<dt>
						<textarea name="novoDeliberacoes"  class="form-control" rows='4' cols="60" ><?php echo $atualDeliberacoes ?> </textarea>
					</dt>
					<dt><br></dt>
					<dt>Observações</dt>
					<dt>
						<textarea name="novoObservacoes"  class="form-control" rows='5' cols="60" ><?php echo $atualObservacoes ?></textarea>
					</dt>
					<dt><br></dt>
					<dt>Participantes</dt>
					<dt>
						<textarea name="novoParticipantes"  class="form-control" rows='5' cols="60" ><?php echo $atualParticipantes?>		
						</textarea>
					</dt>
					<dt><input value="Confirmar" type="submit"></dt>
				</dl>
			</form>
		</div>
	</div>
</body>
</html>