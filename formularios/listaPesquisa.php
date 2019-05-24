<!DOCTYPE HTML>

<html lang="pt-br">
<head>
	<title>REUNIÕES</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="../css/bootstrap.css" />
</head>
<body>
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
	<div class="card" style="width: 60%;margin-left: 20%;background-color: #f8f9fa">
		<div class="card-body">
			<?php
			include_once '../conectarBanco.php';
			$val = $_POST['busca'];
			$valores=explode(" ", $val);
			$sql = "select  id_reuniao, inicio, nome_tipo, nome_status FROM reunioes INNER JOIN horario ON horario.id_horario = reunioes.data_reuniao  INNER JOIN tipo ON tipo.id_tipo =tipo_reuniao INNER JOIN status ON status.id_status =status_reuniao  WHERE id_reuniao >= $valores[0] and id_reuniao <= $valores[1]"; 
			$query = mysqli_query($conexao,$sql)or die("Não foi possivel fazer seleção");
			echo "<table class='table'>";
			echo "<tr>";
			echo "<td> CODIGO(id) </td> <td> DATA </td> <td> TIPO </td><td>";
			echo"</tr><tr>";
			while($resultado = mysqli_fetch_array($query)){
				echo "<tr>";
				$status=$resultado['nome_status'];
				$codigoRetorno = $resultado['id_reuniao'];
				$inicioRetorno = $resultado['inicio'];
				$dataRetorno = substr($inicioRetorno, 0, 10); 
				#$horaRetorno = substr($inicioRetorno, 11, 8);
				$tipo = $resultado['nome_tipo']  ?>
				<?php
				echo "<td> $codigoRetorno </td> <td> $dataRetorno </td> <td> $tipo </td> <td> <a href='FormularioAlterar.php?codurl=$codigoRetorno'>"?>
				<button class="btn btn-outline-info" <?php if ($status=="Consolidada") {echo "disabled";}?> type="button">Alterar</button>
				<?php echo"</a> </td> <td> <a href='FormularioConsolidar.php?codurl=$codigoRetorno'>";?>
				<button class="btn btn-outline-info" <?php if ($status=="Consolidada") {echo "disabled";}?> type="button">Consolidar</button>
				<?php echo"</a> </td> <td> <a href='cancelar.php?codurl=$codigoRetorno'>";?>
				<button class="btn btn-outline-info" <?php if ($status=="Consolidada") {echo "disabled";}?> type="button">Cancela</button>
				<?php echo"</a> </td> <td> <a href='gerarAta.php?codurl=$codigoRetorno'>";?>
				<button class="btn btn-outline-info" type="button">Ata</button>
				<?php
				echo"</tr>";
			}
			echo " </table>";
			?>
		</div>
	</div>
</body>
</html>