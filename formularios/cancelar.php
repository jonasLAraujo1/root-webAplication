<!DOCTYPE HTML>
<HTML lang="pt-br">
<head>
    <title>MARCAR</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <meta http-equiv="refresh" content=2;url="../main.php"> <!-- -->
</head>
<body>
    <?php
    if (isset($_POST['id'])) {
        $codigoURL = $_POST['id'];
    } else{
        $codigoURL = $_GET['codurl'];
    }

    include_once '../conectarBanco.php';
    $sql = "SELECT status_reuniao FROM  reunioes WHERE id_reuniao=$codigoURL";
    $sql = "select  id_reuniao, nome_status FROM reunioes  INNER JOIN status ON status.id_status =status_reuniao  WHERE id_reuniao =$codigoURL";
    $query = mysqli_query($conexao,$sql)or die("Não foi possivel fazer seleção");
    while($resultado = mysqli_fetch_array($query)){
        $status=$resultado['nome_status'];
    }
    
    if ($status=="Consolidada") {
        ?>
        <div class="alert alert-dark" style="width: 70%;margin-left: 15%;" role="alert">
            <h3 class="alert-heading">Não é Possivel  Cancelar Reunião Consolidada </h3>
            <hr>
            <p>Você será redirecionado a tela inicial automaticamente. </p>
        </div>
        <?php
    }
    else{
        $sql = "delete from horario where id_horario=$codigoURL";
        mysqli_query($conexao,$sql) or die("ERRO ao Deletar DADOS Tabela Horario");
        $sql = "delete from reunioes where id_reuniao=$codigoURL";
        mysqli_query($conexao,$sql) or die("ERRO ao Deletar DADOS Tabela Reuniões");
        $query = mysqli_query($conexao,$sql)or die("Erro 1");
        mysqli_close($conexao);
        ?>
        <div class="alert alert-dark" style="width: 70%;margin-left: 15%;" role="alert">
            <h3 class="alert-heading">Dados Excluidos Com Sucesso </h3>
            <hr>
            <p>Você será redirecionado a tela inicial automaticamente. </p>
        </div>
        <?php 
    }
    ?>
</body>
</HTML>