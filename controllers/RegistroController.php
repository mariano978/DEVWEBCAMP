<?php

namespace Controllers;

use Model\Dia;
use Model\Hora;
use MVC\Router;
use Model\Evento;
use Model\Paquete;
use Model\Ponente;
use Model\Usuario;
use Model\Registro;
use Model\Categoria;

class RegistroController
{
    public static function crear(Router $router)
    {
        if (!is_auth()) {
            header('Location: /');
            return;
        }

        //verificar si el usuario ya tiene un plan
        $registro = Registro::where('usuario_id', $_SESSION['id']);

        if (isset($registro) && $registro->paquete_id === '3') {
            //si es gratis
            header('Location: /boleto?id=' . urlencode($registro->token));
        }

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

    public static function pagar()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (!is_auth()) {
                header('Location: /login');
                return;
            }

            if (empty($_POST)) {
                echo json_encode([]);
                return;
            }

            //crear registro
            $datos = $_POST;
            $datos['token'] =  substr(md5(uniqid(rand(), true)), 0, 8);
            $datos['usuario_id'] = $_SESSION['id'];

            try {
                $registro =  new Registro($datos);
                $resultado = $registro->guardar();
                echo json_encode(['resultado' => $resultado]);
            } catch (\Throwable $th) {
                echo json_encode(['resultado' => 'error']);
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

    public static function conferencias(Router $router)
    {
        if (!is_auth()) {
            header("Location: /login");
        }

        //hay q validar que el usurio tenga plan presencial
        $registro = Registro::where('usuario_id', $_SESSION['id']);

        if ($registro->paquete_id != 1) {
            //si no tiene presencial
            header("Location: /");
        }

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

        $router->render('registro/conferencias', [
            'titulo' => 'Elige WorkShops & Conferencias',
            'eventos' => $eventos_formateado
        ]);
    }
}
