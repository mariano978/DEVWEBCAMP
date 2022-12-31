<?php

function debuguear($variable): string
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function s($dato)
{
    if (is_array($dato)) {
        return s_array($dato);
    }
    return htmlspecialchars($dato, ENT_NOQUOTES);
}

function s_array($datos): array
{

    $s = [];
    foreach ($datos as $key => $dato) {

        if (is_array($dato)) {
            //si hay otro arreglo dentro del arreglo se llamara recursivamente
            //sanitizando todos los subarreglos
            $s[$key] = s_array($dato);
        } else {
            //si es solo un dato se sanitiza
            $s[$key] = htmlspecialchars($dato, ENT_NOQUOTES);
        }
    }

    return $s;
}

function pagina_actual($path): bool
{
    return str_contains($_SERVER['PATH_INFO'] ?? "/", $path) ? true : false;
}

function is_auth(): bool
{
    if (!$_SESSION) {
        session_start();
    }
    return isset($_SESSION['nombre']) && !empty($_SESSION);
}

function is_admin(): bool
{
    if (!$_SESSION) {
        session_start();
    }
    return isset($_SESSION['admin']) && !empty($_SESSION['admin']);
}
