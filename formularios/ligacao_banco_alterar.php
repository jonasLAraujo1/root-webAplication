<!DOCTYPE HTML>

<html lang="pt-br">
<head>
  <title>Alterar</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="../css/bootstrap.css" />
  <meta http-equiv="refresh" content=2;url="../main.php"> <!--  -->
</head>
<body>
  <?php
  include_once '../conectarBanco.php';
  $codigo = $_POST['cod'];
  $sql = "select  id_reuniao, data_reuniao FROM reunioes  WHERE id_reuniao = $codigo";
  $query = mysqli_query($conexao,$sql)or die("Não foi possivel fazer seleção");
  while($resultado = mysqli_fetch_array($query)){
    $codigoD = $resultado['data_reuniao'];
  }
  $tipo = $_POST['novoTipo'];
  $presidente = $_POST['novoPresidente'];
  $data = $_POST['novoData'];
  $horai = $_POST['novoHoraI'];
  $horaf = $_POST['novoHoraF'];
  $pauta = $_POST['novoPauta'];
  $participantes = $_POST['novoParticipantes'];
  $observacoes = $_POST['novoObservacoes'];
  $deliberacoes = $_POST['novoDeliberacoes'];
  
  $sql = "update horario set  inicio='$data $horai', fim='$data $horaf' WHERE id_horario='$codigoD'";
  mysqli_query($conexao,$sql) or die("ERRO ao ATUALIZAR tabela DATA");
  
  $sql = "UPDATE reunioes  set tipo_reuniao= '$tipo', presidente_reuniao='$presidente' ,pauta='$pauta',deliberacoes='$deliberacoes', observacoes='$observacoes',participantes='$participantes' WHERE id_reuniao = '$codigo'";
  mysqli_query($conexao,$sql) or die("ERRO ao ATUALIZAR tabela REUNIÕES");
  mysqli_close($conexao);
  ?>
  <div class="alert alert-dark" style="width: 70%;margin-left: 15%;" role="alert">
    <h3 class="alert-heading">Dados Alterados Com Sucesso </h3>
    <hr>
    <p>Você será redirecionado a tela inicial automaticamente. </p>
  </div>
</body>
</html>