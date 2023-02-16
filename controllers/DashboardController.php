<?php

namespace Controllers;

use Model\Evento;
use Model\Registro;
use Model\Usuario;
use MVC\Router;

class DashboardController
{

    public static function index(Router $router)
    {
        //obtener ultimos registros
        $registros = Registro::get(5);

        foreach ($registros as $registro) {
            $registro->usuario = Usuario::find($registro->usuario_id);
        }

        //obtener ingresos
        $presenciales = Registro::count('paquete_id', 1);
        $virtuales = Registro::count('paquete_id', 2);
        $ingresos = $virtuales * 46.41 + $presenciales * 189.54;

        //obtener los eventos con mas y menos lugares disponibles
        $eventos_menos_disp = Evento::ordenarLimite('disponibles', 'ASC', 5);
        $eventos_mas_disp = Evento::ordenarLimite('disponibles', 'DESC', 5);
      
        $router->render('admin/dashboard/index', [
            'titulo' => 'Panel de administracion',
            'registros' => $registros,
            'ingresos' => $ingresos,
            'eventosMenosDisp' => $eventos_menos_disp,
            'eventosMasDisp' => $eventos_mas_disp
        ]);
    }
}
