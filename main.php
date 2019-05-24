<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset='utf-8' />
  <link href='css/fullcalendar.min.css' rel='stylesheet' />
  <link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
  <link rel="stylesheet" href="css/bootstrap.css" />
  <script src='js/moment.min.js'></script>
  <script src='js/jquery.min.js'></script>
  <script src='js/bootstrap.min.js'></script>
  <script src='js/fullcalendar.min.js'></script>
  <script src='locale/pt-br.js'></script>
  <?php
  include_once("conectarBanco.php");
  $result_events = "SELECT id_reuniao, nome_tipo , cor, inicio , fim ,nome_status FROM reunioes, tipo, horario, status where id_horario = data_reuniao and id_tipo = tipo_reuniao and id_status = status_reuniao";
  $resultado_events = mysqli_query($conexao, $result_events);
  #$status_seção= @session_status();
  ?>
  <script>
    $(document).ready(function() {
      $('#calendar').fullCalendar({
        header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listMonth'
      },
      defaultDate: Date(),
      navLinks: true, // can click day/week names to navigate views
      editable: false,
      eventLimit: true, // allow "more" link when too many events

      eventClick: function(event) {
        $('#visualizar #id').text(event.id);
        $('#visualizar #id').val(event.id);
        $('#visualizar #title').text(event.title);
        $('#visualizar #start').text(event.start.format('DD/MM/YYYY HH:mm:ss'));
        $('#visualizar #end').text(event.end.format('DD/MM/YYYY HH:mm:ss'));
        $('#visualizar #info').text(event.info);
        $('#eventUrl').attr('href',event.url);
        $('#visualizar').modal('show');
        return false;
      },
      events: [
      <?php
      while($row_events = mysqli_fetch_array($resultado_events)){
        $status=$row_events['nome_status'];?>
        {
          id: '<?php echo $row_events['id_reuniao']; ?>',
          title: '<?php echo $row_events['nome_tipo']; ?>',
          start: '<?php echo  $row_events['inicio']; ?>',
          end: '<?php echo   $row_events['fim']; ?>',
          color :'<?php echo   $row_events['cor']; ?>',
          info: '<?php echo   $row_events['nome_status']; ?>'
        },
        <?php
      }
      ?>
      ],
    });});
  </script>
</head>
<body>
  <?php
  session_start();

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
    <!--MENU INICIO  bg-light-->
    <div class="card" style="width: 100%;background-color: #28a745">
      <div class="card-body" >
        <div class="navbar navbar-light " style="background-color: #28a745"  >
          <form class=" form-inline " >
            <a href="#"><button class=" btn btn-lg  active" type="button" >Inicio</button> </a>
            <ul class="nav" style=" margin: 0px 5px"></ul>
            <a href="./formularios/FormularioMarcar.php"> <button class=" btn btn-lg " type="button" >Agendar Reunião</button> </a>
            <!--<a href="#"><button type="button" class="btn btn-lg btn-primary">Notificações <span class="badge badge-light">3</span></button></a>-->
          </form>
          <h1>Agenda de Reuniões</h1>
          <form class="form-inline"  method="POST" action="./formularios/listaPesquisa.php">
            <input class=" form-control " type="name" placeholder="id range" name="busca" aria-label="Search">
            <ul class="nav" style=" margin: 0px 5px"></ul>
            <button class="btn btn-utline-primary" type="submit">Buscar</button>
          </form>

        </div>
      </div>
    </div>
    <!--MENU FIM -->
    <div class="card" style="width: 100%;background-color: #81C784">
      <div class="card" style="width: 80%;margin-left: 10%">
        <div class="card-body">
          <div  id='calendar' style="text-transform: capitalize;"></div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title text-center">Dados da Reunião</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <dl class="dl-horizontal">
              <dt>ID da Reunião</dt>
              <dd id="id"></dd>
              <dt>Tipo da Reunião</dt>
              <dd id="title"></dd>
              <dt>Inicio </dt>
              <dd id="start"></dd>
              <dt>Termino </dt>
              <dd id="end"></dd>
              <dt>Status da Reunião</dt>
              <dd id="info"></dd>
            </dl>
          </div>
          <div class="modal-content">
            <div class="modal-body">
              <nav class="navbar navbar-light bg-light" >
                <form class="form-horizontal" method="POST" action="./formularios/FormularioAlterar.php">
                  <input type="hidden" class="form-control" name="id" id="id">
                  <button  class="btn btn-outline-info " type="submit">Alterar</button>
                </form>
                <form class="form-horizontal" method="POST" action="./formularios/FormularioConsolidar.php">
                  <input type="hidden" class="form-control" name="id" id="id">
                  <button  class="btn btn-outline-info " type="submit">Consolidar</button>
                </form>
                <form class="form-horizontal" method="POST" action="./formularios/cancelar.php">
                  <input type="hidden" class="form-control" name="id" id="id">
                  <button  class="btn btn-outline-info "  type="submit">Cancelar</button>
                </form>
                <form class="form-horizontal" method="POST" action="#">
                  <input type="hidden" class="form-control" name="id" id="id">
                  <button  class="btn  btn-outline-info" type="submit">Gerar ATA</button>
                </form>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
  }
  ?>
</body>
</html>
