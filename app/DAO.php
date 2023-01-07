<?php

// MEMORY - DAO
// SEBASTIAN RJ
// 13/12/2022
//Funciones de lectura/escritura csv
function leerPuntuacion()
{
    $fichero = 'csv/puntuaciones.csv';
    $arrayDatos = array();
    if ($fp = fopen($fichero, "r")) {
        while ($filaDatos = fgetcsv($fp, 0, ",")) {
            $arrayDatos[] = $filaDatos;
        }
    } else {
        echo "No se encontró el fichero " . $fichero;
    }
    fclose($fp);
    return $arrayDatos;
}

function escribirPuntuacion($arrayEscribir)
{
    $fichero = 'csv/puntuaciones.csv';
    if ($fp = fopen($fichero, "w")) {
        foreach ($arrayEscribir as $filaDatos) {
            fputcsv($fp, $filaDatos);
        }
    } else {
        echo "No se puede entrar en el fichero";
        return false;
    }
    fclose($fp);
    return true;
}

//Validacion de Campos
function vNombre($nombre, $valido)
{
    if (preg_match("/^[a-zA-Z]+/", $nombre)) { //Solo se perminten entradas con letras mayusc. y minusc.
        $valido = true;
        global $datosValidos;
        $datosValidos[] = $nombre;
    }
    if (empty($nombre)) {
        global $errores;
        $errores[] = 'Introduce Nombre de Usuario';
    }
    return $valido;
}

function vPassword($pass, $vpass, $valido)
{
    if (empty($pass)) {
        global $errores;
        $errores[] = 'Introduce Contraseña';
    }
    if (empty($vpass)) {
        global $errores;
        $errores[] = 'Introduce verificacion Contraseña';
    }
    if ($pass !== $vpass) {
        global $errores;
        $errores[] = 'Las contraseñas no coinciden';
    } else {
        $hash = crypt($pass, '$1$rasmusle$');
        global $datosValidos;
        $datosValidos[] = $hash;
        $valido = true;
    }
    return $valido;
}

function encriptar($pass)
{
    $hash = crypt($pass, '$1$rasmusle$');
    return $hash;
}

function vEmail($email, $valido)
{
    global $datosValidos;
    global $errores;

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) { //Solo pemite entradas de tipo (xxxxx@xxxx.xx)
        $datosValidos[] = $email;
        $valido = true;
    }
    if (empty($email)) {
        $errores[] = 'Introduce Email';
    }
    if ($valido == false) {
        $errores[] = 'Formato de email no valido';
    }

    return $valido;
}



//Gestion de usuarios 
function obtenerUsuarios()
{
    $fichero = 'csv/usuarios.csv';
    $arrayDatos = array();
    if ($fp = fopen($fichero, "r")) {
        while ($filaDatos = fgetcsv($fp, 0, ",")) {
            $usuario = new Usuario($filaDatos[0], $filaDatos[1], $filaDatos[2], $filaDatos[3]);
            $arrayDatos[] = $usuario;
        }
    } else {
        echo "Error no se puede acceder al fichero";
        return false;
    }
    fclose($fp);
    return $arrayDatos;
}

function escribirUsuarios($arrayEscribir)
{
    $fichero = 'csv/usuarios.csv';
    if ($fp = fopen($fichero, "w")) {
        foreach ($arrayEscribir as $usuario) {
            $filaDatos = [$usuario->getUsername(), $usuario->getPassword(), $usuario->getEmail(), $usuario->getRol()];
            fputcsv($fp, $filaDatos);
        }
    } else {
        echo "Error no se puede aceder al fichero";
        return false;
    }
    fclose($fp);
    return true;
}

//Funcion Ranking , ordenar puntuaciones de mayor a menor 

function array_sort_by(&$arrIni, $col, $order = SORT_ASC)
{
    $arrAux = array();
    foreach ($arrIni as $key => $row) {
        $arrAux[$key] = is_object($row) ? $arrAux[$key] = $row->$col : $row[$col];
        $arrAux[$key] = strtolower($arrAux[$key]);
    }
    array_multisort($arrAux, $order, $arrIni);
}

//Funcion de Control de eventos
function obtenerEventos()
{
    $fichero = 'csv/eventos.csv';
    $arrayDatos = array();
    if ($fp = fopen($fichero, "r")) {
        while ($filaDatos = fgetcsv($fp, 0, ",")) {
            $evento = new Evento($filaDatos[0], $filaDatos[1]);
            $arrayDatos[] = $evento;
        }
    } else {
        echo "Error no se puede acceder al fichero";
        return false;
    }
    fclose($fp);
    return $arrayDatos;
}

function escribirEventos($arrayEscribir)
{
    $fichero = 'csv/eventos.csv';
    if ($fp = fopen($fichero, "w")) {
        foreach ($arrayEscribir as $evento) {
            $filaDatos = [$evento->getFecha(),$evento->getDescripcion()];
            fputcsv($fp, $filaDatos);
        }
    } else {
        echo "Error no se puede aceder al fichero";
        return false;
    }
    fclose($fp);
    return true;
}
