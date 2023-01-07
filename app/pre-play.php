<?php

// MEMORY - REGISTRO/LOGIN/JUGAR COMO INVITADO
// SEBASTIAN RJ
// 13/12/2022
include('DAO.php');
include('usuario.class.php');
session_start();
$datos = obtenerUsuarios();
$registrado = false;
$admin = false;
$mensaje = "";


if (isset($_POST['login'])) {
  foreach ($datos as $usuario) {
    if ($_POST['username'] == $usuario->getUsername() && hash_equals(encriptar($_POST['password']), $usuario->getPassword())) {
      $registrado = true;
      $_SESSION['username'] = $_POST['username'];
      if ($registrado && $usuario->getRol() == "admin") {
        $_SESSION['rol'] = 'admin';
        header('Location: index.php');
      } else {
        $_SESSION['rol'] = 'user';
      }
      header('Location: index.php');
    } else {
      $mensaje = "El usuario o contraseña es incorrecto";
    }
  }
}

if (isset($_POST['sign-in'])) {
  header('Location: sign-in.php');
}
if (isset($_POST['playGuest'])) {
  header('Location: play.php');
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
  <title>Pre-Play</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
</head>

<body>
  <div class="main">
    <img id="logo" src="img/MEMORY (1).png" />
    <p class="mensaje"><?php echo $mensaje ?></p>
    <div class="main-buttons">
      <form action="pre-play.php" method="post" id="pre-play">
        <input type="text" name="username" placeholder="Introduce Usuario" />
        <input type="password" name="password" placeholder="Introduce Contraseña" />
        <button class="boton" type="sumbit" name="login">
          INICIAR SESION
        </button></br>

        <button class="boton" name="sign-in">REGISTRARSE</button>
        <button title="ADVERTENCIA si juegas como invitado tu puntuacion no se guardara ni podras cambiar la dificultad" class="boton" name="playGuest">
          JUGAR COMO INVITADO
        </button>
        <button class="boton" id="salir" name="back">ATRAS</button>
      </form>
    </div>
  </div>
</body>

</html>