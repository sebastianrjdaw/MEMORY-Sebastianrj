<?php
// MEMORY - INDEX
// SEBASTIAN RJ
// 13/12/2022
session_start();
include('DAO.php');
include('evento.class.php');
if (isset($_POST['play'])) {
  if (isset($_SESSION['username'])) { // Si esta loggeado ya manda directamente a jugar
    header('Location: play.php');
  } else {
    header('Location: pre-play.php');
  }
}
if (isset($_POST['howtoPlay'])) {
  header('Location: howtoPlay.php');
}
if (isset($_POST['ranking'])) {
  header('Location: ranking.php');
}
if (isset($_POST['options'])) {
  if (!isset($_SESSION['rol'])) {
    $mensaje = 'Debes estar registrado para elegir las preferencias';
  } else
  if ($_SESSION['rol'] == 'admin') {
    header('Location: admin.php');
  } else if ($_SESSION['rol'] == 'user') {
    header('Location: options.php');
  }
}
if (isset($_POST['exit'])) {
  header('Location: logoff.php');
}

//Gestion de Eventos
$events = obtenerEventos();


var_dump($_SESSION['rol']);
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>MEMORY</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
</head>

<body>
  <div class="eventos">
    <h3>Proximos Eventos</h3>
        <?php
        foreach ($events as $evento) {
          if ($evento->getFecha() < (time() + 604800 )) { //Enseñar el evento semanal mas proximo
            ?>
            <p><?php echo date("d-m-Y", $evento->getFecha()); ?></p>
            <p><?php echo $evento->getDescripcion() ?></p>
        <?php }
        } ?>
  </div>  
  <div class="main">
    <img id="logo" src="img/MEMORY (1).png" />
    <p class="created">CREATED BY SEBASTIANRJ 2022 &copy;</p>
    <p class="mensaje" id="wellcome"><?php if (isset($_SESSION['username'])) {
                                        echo 'Bienvenido  ' . $_SESSION['username'];
                                      } ?></p>
    <form action="index.php" method="post">
      <p class="mensaje"><?php if (isset($mensaje)) echo $mensaje ?>
      <p>
      <div class="main-buttons">
        <button class="boton" name="play">JUGAR</button>
        <button class="boton" name="howtoPlay">COMO JUGAR</button>
        <button class="boton" name="ranking">RANKING</button>
        <button class="boton" name="options">PREFERENCIAS</button>
        <button class="boton" id="salir" name="exit">SALIR</button>
      </div>
    </form>
  </div>
</body>
<<<<<<< HEAD
=======


>>>>>>> 1d499d94584ed84caf5977f4d517bb5fef73be1a
</html>