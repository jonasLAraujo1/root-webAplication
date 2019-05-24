<!DOCTYPE HTML>
<HTML lang="pt-br">
<head>
  <title>Novo Usuario</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="../css/bootstrap.css" />
  <meta http-equiv="refresh" url="../index.html"> <!--content=2; -->
</head>
<body>
  <?php
  include_once '../conectarBanco.php';
  echo session_status();
  echo "<br>";
  $usuario=$_POST['form_usuario'];
  $sql = "SELECT registro_usuario ,nome_usuario, senha FROM usuario WHERE registro_usuario='$usuario'";
  $query = mysqli_query($conexao,$sql)or die("Erro 1");
  $r=mysqli_num_rows($query);
  if ($r > 0){
    while($resultado = mysqli_fetch_array($query)){
      if ($usuario==$resultado['registro_usuario'] and $_POST['form_senha'] ==$resultado['senha']) {
        session_start();
        $_SESSION['user'] = $usuario;
        echo $_SESSION['user'];
        #echo session_status();
        header("location: ../main.php");
      }
      else{
        ?>
        <div class="alert alert-dark" style="width: 70%;margin-left: 15%;" role="alert">
          <h3 class="alert-heading">Senha Incorreta</h3>
          <hr>
          <p>Você será redirecionado a tela inicial automaticamente. </p>
        </div> 
        <?php
      }
    }
  }else{
    ?>
    <div class="alert alert-dark" style="width: 70%;margin-left: 15%;" role="alert">
      <h3 class="alert-heading">Usuario Não Registrado</h3>
      <hr>
      <p>Você será redirecionado a tela inicial automaticamente. </p>
    </div>
    <?php
  }
  ?>
</body>
</html>
