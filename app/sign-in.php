<?php
    // MEMORY - REGISTRO
    // SEBASTIAN RJ
    // 13/12/2022

include('DAO.php');
include('usuario.class.php');
$datos=obtenerUsuarios(); //leer Csv de objetos
$errores=array();
$datosValidos=array();
$valido=false;
$fallos=false;
if(isset($_POST['back'])){
  header('Location: index.php');
}

if (isset($_POST['sign-in'])) {
  vNombre($_POST['username'],$valido);
  vPassword($_POST['password'],$_POST['vPassword'],$valido);
  vEmail($_POST['email'],$valido);
  if(!empty($errores)){
    $fallos=true;
  }else{
    $registro= new Usuario ($datosValidos[0],$datosValidos[1],$datosValidos[2],'user');
    $datos[] = $registro;
    escribirUsuarios($datos);
    session_start();
    $_SESSION['username'] = $registro->getUsername();
    $_SESSION['rol'] == 'user';
    header('Location: index.php');
  }
  
}


?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Registro</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
</head>

<body>
  <div class="main">
    <img id="logo" src="img/MEMORY (1).png" />
    <div class="main-buttons">
      <div class="mensaje">
        <ul>
          <?php if($fallos){
            foreach ($errores as $error) {
              echo '<li>' . $error . '</li>';
          }
          } ?>
        </ul>
      </div>
      <form action="sign-in.php" method="post" id="registro">
        <input type="text" name="username" placeholder="Nombre de Usuario" />
        <input type="password" name="password" placeholder="Introduce Contraseña" />
        <input type="password" name="vPassword" placeholder="Verifica Contraseña" />
        <input type="text" name="email" placeholder="Introduce Email" />
        <button class="boton" type="sumbit" name="sign-in">REGISTRARSE</button>
        <button class="boton" id="salir" name="back">ATRAS</button>
      </form>
      
    </div>
  </div>
</body>

</html>