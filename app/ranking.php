<?php

// MEMORY - RANKING
// SEBASTIAN RJ
// 13/12/2022


include('DAO.php');
$datos = leerPuntuacion();

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>RANKING</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" media="screen" href="css/ranking_instructions.css" />
</head>

<body>
  <div class="main">
    <div class="logo">
      <img id="logo" src="img/MEMORY (1).png" />
    </div>
    <div class="puntuation">
      <table>
        <tr>
          <th>NOMBRE</th>
          <th>PUNTUACION</th>
        </tr>

        <?php
        foreach ($datos as $key => $row) {
          $aux[$key] = $row[1];
        }
        array_multisort($aux, SORT_DESC, $datos);
        ?>
        <?php foreach ($datos as $puntuacion) { ?>

          <tr>
            <td><?php echo $puntuacion[0] ?></td>
            <td><?php echo $puntuacion[1] ?></td>
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