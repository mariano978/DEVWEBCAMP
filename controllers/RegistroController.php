<?php

namespace Controllers;

use Locale;
use Model\Paquete;
use Model\Registro;
use Model\Usuario;
use MVC\Router;

class RegistroController
{
    public static function crear(Router $router)
    {
        $router->render('registro/crear', [
            'titulo' => 'Finalizar Registro'
        ]);
    }

    public static function gratis(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (!is_auth()) {
                header('Location: /login');
                return;
            }

            //verificamos que no haya un registro previo
            $registro = Registro::where('usuario_id', $_SESSION['id']);
            //debuguear($registro);
            if ($registro) {
                header('Location: /boleto?id=' . urlencode($registro->token));
                return;
            }

            $token = substr(md5(uniqid(rand(), true)), 0, 8);
            $datos = array(
                'paquete_id' => 3, //gratis
                'pago_id' => '',
                'token' => $token,
                'usuario_id' => $_SESSION['id']
            );

            $registro =  new Registro($datos);
            $resultado = $registro->guardar();

            if ($resultado) {
                header('Location: /boleto?id=' . urlencode($registro->token));
            }
        }
    }

    public static function boleto(Router $router)
    {
        $id = s($_GET['id']);

        if (!$id || !strlen($id) === 8) {
            header('Location: /');
        }

        $registro = Registro::where('token', $id);

        if (!$registro) {
            header('Location: /');
        }

        $registro->usuario = Usuario::find($registro->usuario_id);
        $registro->paquete = Paquete::find($registro->paquete_id);
        
        $router->render('registro/boleto', [
            'titulo' => 'Acistencia a DevWebCamp',
            'registro' => $registro
        ]);
    }
}
