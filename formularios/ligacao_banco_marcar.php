<!DOCTYPE HTML>
<HTML lang="pt-br">
<head>
    <title>MARCAR</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <meta http-equiv="refresh" content=2;url="../main.php"> <!--  -->
</head>
<body>
    <?php
    include_once '../conectarBanco.php';
    $tipo = $_POST['TipoForm'];
    $presidente = $_POST['PresidenteForm'];
    $data = $_POST['DataForm'];
    $horaI = $_POST['InicioForm'];
    $horaF = $_POST['FimForm'];
    $pauta = $_POST['PautaForm'];
    
    $sql = "INSERT INTO horario (inicio,fim) VALUES ('$data $horaI','$data $horaF')";
    mysqli_query($conexao,$sql) or die("EROO ao Inserir DADOS na Tabela HORARIO");

    $sql = "SELECT * FROM horario ORDER BY id_horario DESC LIMIT 1"; 
    $query = mysqli_query($conexao,$sql)or die("Erro 1");
    while($resultado = mysqli_fetch_array($query)){
        $id_data = $resultado['id_horario'];
    }

    $sql = "INSERT INTO reunioes (data_reuniao,tipo_reuniao,status_reuniao,presidente_reuniao,pauta) VALUES ('$id_data','$tipo',1,'$presidente','$pauta')";
    mysqli_query($conexao,$sql) or die("ERRO ao Inserir DADOS na Tabela REUNIÕES"); 
    mysqli_close($conexao);
    ?>
    <div class="alert alert-dark" style="width: 70%;margin-left: 15%;" role="alert">
        <h3 class="alert-heading">Dados Salvos Com Sucesso </h3>
        <hr>
        <p>Você será redirecionado a tela inicial automaticamente. </p>
    </div>
</body>
</html>