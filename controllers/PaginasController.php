<?php

namespace Controllers;

use Model\Dia;
use Model\Hora;
use MVC\Router;
use Model\Evento;
use Model\Ponente;
use Model\Categoria;

class PaginasController
{
    public static function index(Router $router)
    {
        $eventos = Evento::ordenar('hora_id', 'ASC');


        $eventos_formateado = [];
        foreach ($eventos as $evento) {

            //remplazamos solo la id por el objeto completo
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->ponente = Ponente::find($evento->ponente_id);

            if ($evento->dia_id === "1" && $evento->categoria_id === "1") {
                $eventos_formateado['conferencias_viernes'][] = $evento;
            }
            if ($evento->dia_id === "2" && $evento->categoria_id === "1") {
                $eventos_formateado['conferencias_sabado'][] = $evento;
            }
            if ($evento->dia_id === "1"  && $evento->categoria_id === "2") {
                $eventos_formateado['workshops_viernes'][] = $evento;
            }
            if ($evento->dia_id === "2" && $evento->categoria_id === "2") {
                $eventos_formateado['workshops_sabado'][] = $evento;
            }
        }

        //obtener total de cada bloque
        $total['ponentes'] = Ponente::count();
        $total['conferencias'] = Evento::count('categoria_id', 1);
        $total['workshops'] = Evento::count('categoria_id', 2);


        //todos los ponenetes
        $ponentes = Ponente::all();

        $router->render('paginas/index', [
            'titulo' => 'Inicio',
            'eventos' => $eventos_formateado,
            'total' => $total,
            'ponentes' => $ponentes
        ]);
    }

    public static function evento(Router $router)
    {



        $router->render('paginas/devwebcamp', [
            'titulo' => 'Sobre Devwebcamp'
        ]);
    }

    public static function paquetes(Router $router)
    {


        $router->render('paginas/paquetes', [
            'titulo' => 'Paquetes Devwebcamp'
        ]);
    }

    public static function conferencias(Router $router)
    {

        //pido los eventos ordenados por hora
        $eventos = Evento::ordenar('hora_id', 'ASC');


        $eventos_formateado = [];
        foreach ($eventos as $evento) {

            //remplazamos solo la id por el objeto completo
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->ponente = Ponente::find($evento->ponente_id);

            if ($evento->dia_id === "1" && $evento->categoria_id === "1") {
                $eventos_formateado['conferencias_viernes'][] = $evento;
            }
            if ($evento->dia_id === "2" && $evento->categoria_id === "1") {
                $eventos_formateado['conferencias_sabado'][] = $evento;
            }
            if ($evento->dia_id === "1"  && $evento->categoria_id === "2") {
                $eventos_formateado['workshops_viernes'][] = $evento;
            }
            if ($evento->dia_id === "2" && $evento->categoria_id === "2") {
                $eventos_formateado['workshops_sabado'][] = $evento;
            }
        }
        //debuguear( $eventos_formateado);
        $router->render('paginas/conferencias', [
            'titulo' => 'Conferencias & Workshops',
            'eventos' => $eventos_formateado
        ]);
    }

    public static function error(Router $router)
    {
        $router->render('paginas/error', [
            'titulo' => 'Página no encontrada'
        ]);
    }
}
