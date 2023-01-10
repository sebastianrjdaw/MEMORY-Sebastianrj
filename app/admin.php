<?php
// MEMORY - Panel de Administrador
// SEBASTIAN RJ
// 13/12/2022

include('DAO.php');
include('usuario.class.php');
<<<<<<< HEAD
include('evento.class.php');
session_start();
=======
session_start();

>>>>>>> origin/master
//Control de acceso
if ($_SESSION['rol'] == 'user') {
  header('Location: index.php');
}

//Gestion Usuarios
$datos = obtenerUsuarios();
if (isset($_GET['eliminar'])) {
  $filaEliminar = $_GET['eliminar'];
  unset($datos[$filaEliminar]);
}


if (isset($_POST['add'])) {
  $username = $_POST['username'];
  $password = encriptar($_POST['password']);
  $email = $_POST['email'];
  $rol = $_POST['rol'];
  $usuario = new Usuario($username, $password, $email, $rol);
  $datos[] = $usuario;
}
escribirUsuarios($datos);

//Gestion de Eventos
$events = obtenerEventos();

if (isset($_GET['eliminarEvento'])) {
  $filaEliminar = $_GET['eliminarEvento'];
  unset($events[$filaEliminar]);
}

if (isset($_POST['event'])) {
  $fecha=strtotime($_POST['fecha']);
  $desc = $_POST['desc'];
  if ($fecha > time()) {
    $evento = new Evento($fecha, $desc);
    $events[] = $evento;
  } else {
    echo 'La fecha del evento no puede ser menor que la fecha actual';
  }
}
escribirEventos($events);
?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Administracion</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" media="screen" href="css/ranking_instructions.css" />
</head>

<body>
  <div class="main">
    <div class="logo">
      <img id="logo" src="img/MEMORY (1).png" />
    </div>
    <h2>gestion de usuarios</h2>
    <div class="users">
      <form action="admin.php" method="post">
        <input type="text" name="username" placeholder="Nombre de Usuario" />
        <input type="password" name="password" placeholder="Introduce Contraseña" />
        <input type="text" name="email" placeholder="Introduce Email" />
        <input type="text" name="rol" placeholder="ROL" />
        <button class="boton" type="sumbit" name="add">AÑADIR</button>
      </form>
    </div>
    <div class="puntuation">
      <table>
        <tr>
          <th>NOMBRE</th>
          <th>CONTRASEÑA</th>
          <th>EMAIL</th>
          <th>ROL</th>
          <th> X </th>
        </tr>
        <?php
        $contFila = 0;
        foreach ($datos as $usuario) {
        ?>
          <tr>
            <td><?php echo $usuario->getUsername(); ?></td>
            <td><?php echo $usuario->getPassword(); ?></td>
            <td><?php echo $usuario->getEmail(); ?></td>
            <td><?php echo $usuario->getRol(); ?></td>
            <td><a href="admin.php?eliminar=<?php echo $contFila++; ?>">Eliminar</a></td>
          </tr>
        <?php } ?>
      </table>
    </div>
      <h2>Gestion de eventos</h2>
      <div class="users">
        <form action='admin.php' method ='post'>
          <input type="date" name="fecha">
          <input type='text' name="desc" placeholder="Introduce descripcion del evento">
          <button class="boton" type="sumbit" name="event">AÑADIR</button>
        </form>
      </div>
      <div class="puntuation">
      <table>
        <tr>
          <th>FECHA</th>
          <th>DESCRIPCION</th>
          <th> X </th>
        </tr>
        <?php
        $contEvent = 0;
        foreach ($events as $evento) {
          if ($evento->getFecha() < time()) {
            unset($evento);
          }
        ?>
          <tr>
            <td><?php echo date("d-m-Y",$evento->getFecha()); ?></td>
            <td><?php echo $evento->getDescripcion() ?></td>
            <td><a href="admin.php?eliminarEvento=<?php echo $contEvent++; ?>">Eliminar</a></td>
          </tr>
        <?php } ?>
      </table>
    </div>


    <div class="ranking-button">
      <button class="boton" id="salir" role="link" onclick="window.location='index.php'">
        ATRAS
      </button>
    </div>
  </div>
</body>

</html>