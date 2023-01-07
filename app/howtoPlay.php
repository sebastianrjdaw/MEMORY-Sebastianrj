<?php 
    // MEMORY - INSTRUCCIONES
    // SEBASTIAN RJ
    // 13/12/2022
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>¿COMO JUGAR?</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/ranking_instructions.css" />
  </head>
  <body>
    <div class="main">
      <div class="logo">
        <img id="logo" src="img/MEMORY (1).png" />
      </div>
      <h2>¿Como jugar a memory?</h2>
      <div class="instructions">
        <div class="instructions-text">
          <br>
          <p>Para empezar , lo primero sera registrarte para que cuando juegues se registre tu puntuacion en el ranking , si no tambien puedes jugar como invitado pero tu puntuacion no se guardara</p>
          <p>Jugar a memory es muy sencillo , en pantalla apareceran 12 cartas con sus respectivas parejas cada vez que hagas click en una carta esta se levantara , si la siguiente carta que levante es su pareja las dos se daran la vuelta si no las dos se ocultaran el objetivo es emparejar todas las cartas en el menor tiempo posible</p>
          <p>Si las partidas son muy faciles para ti , Podras cambiar la dificultad de la partida y el anverso de las cartas en la seccion de preferencias </p>
        </div>
        <div class="instructions-images">
          <img src="/app/img/example1.png">
          <img src="/app/img/example2.png">
          <img src="/app/img/example3.png">
        </div>
      </div>
      <div class="ranking-button">
        <button
          class="boton"
          id="salir"
          role="link"
          onclick="window.location='index.php'"
        >
          ATRAS
        </button>
      </div>
    </div>
  </body>
</html>
