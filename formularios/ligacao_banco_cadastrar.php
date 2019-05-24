<!DOCTYPE HTML>

<html lang="pt-br">
<head>
    <title>Novo Usuario</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <meta http-equiv="refresh" content=2;url="../index.html">
</head>
<body>
    <?php
    include_once '../conectarBanco.php';
    $nome = $_POST['nome_usuario'];
    $registro = $_POST['registro'];
    $email = $_POST['email_usuario'];
    $senha = $_POST['senha_usuario'];
    $lotacao = $_POST['lotacao_usuario'];
    $sql = "INSERT INTO usuario (nome_usuario,registro_usuario,email_usuario,senha,lotacao) VALUES ('$nome','$registro','$email','$senha','$lotacao')";
    mysqli_query($conexao,$sql) or die("Erro ao Cadsatrar Usuário");
    mysqli_close($conexao);
    ?>
    <div class="alert alert-dark" style="width: 70%;margin-left: 15%;" role="alert">
        <h3 class="alert-heading">Novo Usuario Registrado</h3>
        <hr>
        <p>Você será redirecionado a tela inicial automaticamente. </p>
    </div>
</body>
</html>