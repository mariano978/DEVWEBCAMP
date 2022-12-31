<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Categoria;
use Model\Dia;
use Model\Evento;
use Model\Hora;
use Model\Ponente;
use MVC\Router;

class EventosController
{

    public static function index(Router $router)
    {

        if (!is_admin()) {
            header('Location: /login');
        }

        $pagina_actual = s($_GET['page']);
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/eventos?page=1');
        }

        $registros_por_pagina = 10;
        $total_registros = Evento::count();

        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total_registros);

        $eventos = Evento::paginar($registros_por_pagina, $paginacion->offset());

        foreach ($eventos as $evento) {
            //remplazamos solo la id por el objeto completo
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->ponente = Ponente::find($evento->ponente_id);
        }

        $router->render('admin/eventos/index', [
            'titulo' => 'Conferencias y Workshops',
            'paginacion' => $paginacion->paginacion(),
            'eventos' => $eventos
        ]);
    }

    public static function crear(Router $router)
    {
        if (!is_admin()) {
            header('Location: /login');
        }

        $alertas = [];

        $categorias = Categoria::all();
        $dias = Dia::all('ASC');
        $horas = Hora::all('ASC');

        $evento = new Evento();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $evento->sincronizar(s($_POST));

            //debuguear($evento);
            $alertas = $evento->validar();

            if (empty($alertas)) {
                $resultado = $evento->guardar();
                if ($resultado) {
                    header('Location: /admin/eventos');
                }
            }
        }



        $router->render('admin/eventos/crear', [
            'titulo' => 'Agregar evento',
            'alertas' => $alertas,
            'categorias' => $categorias,
            'dias' => $dias,
            'horas' => $horas,
            'evento' => $evento
        ]);
    }

    public static function editar(Router $router)
    {
        if (!is_admin()) {
            header('Location: /login');
        }

        $alertas = [];

        $categorias = Categoria::all();
        $dias = Dia::all('ASC');
        $horas = Hora::all('ASC');

        $id = s($_GET['id']);
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id || $id < 1) {
            header('Location: /admin/eventos');
        }

        $evento = Evento::find($id);

        if (!$evento) {
            header('Location: /admin/eventos');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $evento->sincronizar(s($_POST));

            //debuguear($evento);
            $alertas = $evento->validar();

            if (empty($alertas)) {
                $resultado = $evento->guardar();
                if ($resultado) {
                    header('Location: /admin/eventos');
                }
            }
        }



        $router->render('admin/eventos/editar', [
            'titulo' => 'Agregar evento',
            'alertas' => $alertas,
            'categorias' => $categorias,
            'dias' => $dias,
            'horas' => $horas,
            'evento' => $evento
        ]);
    }

    public static function eliminar()
    {

        if (!is_admin()) {
            header('Location: /login');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = s($_POST['id']);
            $evento = Evento::find($id);
            if (!isset($evento)) {
                header('Location: /admin/eventos');
            }

            $resultado = $evento->eliminar();

            if ($resultado) {
                header('Location: /admin/eventos');
            }
        }
    }
}
