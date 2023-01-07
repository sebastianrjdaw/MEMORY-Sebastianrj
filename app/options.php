<?php
// MEMORY - OPCIONES
// SEBASTIAN RJ
// 13/12/2022
session_start();

//Control de acceso
if (!isset($_SESSION['username'])) {
  header('Location: pre-play.php');
}
$mensaje = "";



//Guardar dificultad y tema
if (isset($_POST['save'])) {
  $dificultad = $_POST['dificultad'][0];
  $tema = $_POST['tema'][0];
  if ($dificultad != 'n' && $tema != 'n') {
    setcookie('dificultad', $dificultad);
    setcookie('tema', $tema);
    $mensaje = "Cambios guardados";
    if (isset($_SESSION['partida'])) {              
      unset($_SESSION['partida']);
    }
  } else {
    $mensaje = "Debes seleccionar tema y dificultad";
  }
}
if (isset($_POST['default'])) {
  setcookie('dificultad', 1);
  setcookie('tema', 1);
  $mensaje = "Aplicados valores por defecto";
}



if (isset($_POST['back'])) {
  header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Options</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
</head>

<body>
  <div class="main">
    <img id="logo" src="img/MEMORY (1).png" />
    <div class="main-buttons">
      <div class="change-name">
        <form action="options.php" method="post" id="option-name">
      </div>
      <select name="dificultad[]" class="option-select">
        <option value="n" hidden selected>SELECIONA DIFICULTAD</option>
        <option value="1" <?php if (isset($_POST['dificultad']) && (in_array("1", $_POST['dificultad'])))
                            echo "selected";
                          ?>>FACIL</option>
        <option value="2" <?php if (isset($_POST['dificultad']) && (in_array("2", $_POST['dificultad'])))
                            echo "selected";
                          ?>>NORMAL</option>
        <option value="3" <?php if (isset($_POST['dificultad']) && (in_array("3", $_POST['dificultad'])))
                            echo "selected";
                          ?>>DIFICIL</option>
      </select>
      <select name="tema[]" class="option-select">
        <option value="n" hidden selected>TEMA DE CARTA</option>
        <option value="memory" <?php if (isset($_POST['tema']) && (in_array("memory", $_POST['tema'])))
                                  echo "selected";
                                ?>>MEMORY</option>
        <option value="future" <?php if (isset($_POST['tema']) && (in_array("future", $_POST['tema'])))
                                  echo "selected";
                                ?>>FUTURE</option>
        <option value="classic" <?php if (isset($_POST['tema']) && (in_array("classic", $_POST['tema'])))
                                  echo "selected";
                                ?>>CLASSIC</option>
      </select>
      <div class="btn-preferencias">
        <p class="mensaje"><?php echo $mensaje ?></p>
        <button class="boton" type="sumbit" name="save">GUARDAR</button>
        <button class="boton" type="sumbit" name="default">
          VALORES POR DEFECTO
        </button>
      </div>
      <button class="boton" id="salir-op" name="back">ATRAS</button>
    </div>
    </form>
  </div>
</body>

</html>