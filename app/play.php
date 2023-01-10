<?php

// MEMORY - PLAY
// SEBASTIAN RJ
// 13/12/2022

include('carta.class.php');
include('partida.class.php');
session_start();
include('DAO.php');

if (isset($_POST['play-again'])) {              //Borrar la sesion para empezar de nuevo
    unset($_SESSION['partida']);
}

if (isset($_POST['options'])) {
    header('Location: options.php');
}

if (isset($_POST['back'])) {
    unset($_SESSION['partida']);
    header('Location:index.php');
}

if (!isset($_COOKIE["tema"])) {
    $tema = 'classic';
} else {
    $tema = $_COOKIE["tema"];
}
if (!isset($_COOKIE["dificultad"])) {
    $dificultad = 1;
} else {
    $dificultad = $_COOKIE["dificultad"];
}
if (!isset($_SESSION['username'])) {
    $nombre = 'anonimo';
    $tema = 'classic';
    $dificultad = 1;
} else {
    $nombre = $_SESSION['username'];
}
if (!isset($_SESSION['partida'])) {
    $cartas = array();
    $ids = ['a', 'a', 'b', 'b', 'c', 'c', 'd', 'd', 'e', 'e', 'f', 'f', 'g', 'g', 'h', 'h', 'i', 'i', 'j', 'j', 'k', 'k', 'l', 'l'];
    for ($k = 0; $k < 24; $k++) {
        $cartas[] = $carta = new carta($ids[$k], false, false);
        shuffle($cartas);
    }
    $tiempoInicio = time();
    $p = new partida($nombre, $dificultad, $tema, $cartas, 0, $tiempoInicio, false, 12);
    $_SESSION['partida'] = $p;
} else {
    $p = $_SESSION['partida'];
}

if (isset($_GET['carta'])) {
    $tiempoInicio = time();
    $id = $p->getCartas()[$_GET['carta']];
    $levantadas = $p->getLevantadas();

    if ($p->getLevantadas() == 0) {
        $p->setCarta1($id);
        $p->getCarta1()->enseñar();
        $p->setLevantadas($levantadas + 1);
    } elseif ($p->getLevantadas() == 1) {
        $p->setCarta2($id);
        $p->getCarta2()->enseñar();
        $p->setLevantadas($levantadas + 1);
    } elseif ($p->getLevantadas() == 2) {
        $id1 = $p->getCarta1()->getId();
        $id2 = $p->getCarta2()->getId();
        if ($id1 == $id2) {
            $parejasRest = $p->getParejaR();
            $p->setParejaR($parejasRest - 1);
            $p->getCarta1()->setVista(true);
            $p->getCarta2()->setVista(true);
        } else {
            $p->getCarta2()->ocultar();
            $p->getCarta1()->ocultar();
        }
        $p->setLevantadas(0);
    }

    if ($p->getParejaR() <= 1) {
        if ($p->getParejaR() <= 0) {
            $p->setParejaR(0);
            $p->setPartidaGanada(true);
        } else {
            $p->setParejaR($parejasRest - 1);
        }
         
    }


    if ($p->getPartidaGanada() == true) {
        $mensaje = " ";
        $tiempoFinal = time();
        $p->getCarta2()->enseñar();
        $puntos = ( $dificultad * 2000 - ((($tiempoFinal - $p->getTiempoI()) * 10)) );
        if ($puntos > 0) {
            $p->setPtosJ($puntos);
            if (isset($_SESSION['username'])) {
                $datos = leerPuntuacion();
                $encontrado = false;
                for ($i = 0; $i < count($datos); $i++) {
                    if (($datos[$i][0] == $p->getNombreJ()) && ($datos[$i][1] <= $p->getPtosJ())) {
                        $datos[$i][1] = $p->getPtosJ();
                        $encontrado = true;
                    }
                }
                if (!$encontrado) {
                    $datos[] = [$p->getNombreJ(), $p->getPtosJ()];
                }
                escribirPuntuacion($datos);
            }
        } else {
            $mensaje = " pero.... Has tardado demasiado en completar las parejas";
        }
    }
}


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
    <form method="post" action="play.php">
        <div class="main-play">
            <div class="info">
                <p class="mensaje">jugador</p>
                <p class="mensaje"><?php echo $p->getNombreJ() ?></p>
                <br />
                <p class="mensaje">Tema</p>
                <p class="mensaje"><?php echo $p->getTema() ?></p>
                <br />
                <p class="mensaje">Dificultad</p>
                <p class="mensaje">nivel : <?php echo $p->getDificultad() ?> </p>
                <br />
                <p class="mensaje">Resultado</p>
                <p class="mensaje"><?php if ($p->getPartidaGanada() == true) echo 'Enhorabuena Has Ganado' . $mensaje ?></p>
                <p class="mensaje">Parejas Restantes: <?php  echo $p->getParejaR() ?></p>
                <p class="mensaje">PUNTOS: <?php echo $p->getPtosJ() ?></p>
                <br />
                <div class="play-buttons">
                    <?php if (($p->getNombreJ() != 'anonimo')) {
                        echo '<button class="boton" name="options">Preferencias</button>';
                        if (isset($_POST['options'])) {
                            header('Location: options.php');
                        }
                    } ?>

                    <button class="boton" name="play-again">Jugar Otra Vez</button>
                    <button class="boton" name="back">Salir</button>
                </div>
            </div>
            <div class="main-table">
                <table>
                    <?php


                    $c = 0;
                    for ($i = 0; $i < 4; $i++) {
                        echo "<tr>";
                        for ($j = 0; $j < 6; $j++) {

                            if ($p->getCartas()[$c]->getVista() == false) {
                                $ruta = 'temas/' . $p->getTema();
                                $activo = '';
                            } else {
                                $ruta = 'level/' . $p->getDificultad() . '/' . $p->getCartas()[$c]->getId();
                                $activo = 'not-active';
                            }
                            echo '<td><a href="play.php?carta=' . $c . '">' . '<img class="carta ' . $activo . '" src="/cards/' . $ruta . '.png"></a>' . '</td>';
                            $c++;
                        }
                        echo "</tr>";
                    }

                    ?>
                </table>
            </div>
        </div>
    </form>
</body>

</html>
<?php
$_SESSION['partida'] = $p;
?>