<?php

namespace Controllers;

use Classes\Paginacion;
use MVC\Router;
use Model\Ponente;
use Intervention\Image\ImageManagerStatic as Image;

class PonentesController
{

    public static function index(Router $router)
    {
        if (!is_admin()) {
            header('Location: /login');
        }

        //Paginacion ->
        //Pagina Actual
        $pagina_actual = s($_GET['page']);
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/ponentes?page=1');
        }
        //Total de objetos
        $total = Ponente::count();
        //registros por pagina
        $registros_por_pagina = 6;

        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/ponentes?page=1');
        }

        //traer objetos
        $ponentes = Ponente::paginar($registros_por_pagina, $paginacion->offset());
        // <-


        $router->render('admin/ponentes/index', [
            'titulo' => 'Ponentes / Conferencistas',
            'ponentes' => $ponentes,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function crear(Router $router)
    {
        if (!is_admin()) {
            header('Location: /login');
        }

        $alertas = [];
        $ponente = new Ponente();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            debuguear($_FILES['imagen']);
            //leer imagen
            if (!empty($_FILES['imagen']['tmp_name'])) {
                //si hay imagen
                $carpeta_imagenes = '../public/build/img/speakers';

                if (!is_dir($carpeta_imagenes)) {
                    //crear carpeta si no existe
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600)->encode('png', '80');
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600)->encode('webp', '80');

                $nombre_imagen = md5(uniqid(rand(), true));

                $_POST['imagen'] = $nombre_imagen;
            }

            $_POST['redes'] = json_encode(s($_POST['redes']), JSON_UNESCAPED_SLASHES);


            $ponente->sincronizar(s($_POST));


            $alertas = $ponente->validar();

            if (empty($alertas)) {
                //guardamos las imagenes
                $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . '.png');
                $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . '.webp');

                //guardar en DB

                $resultado = $ponente->guardar();

                if ($resultado) {
                    header('Location: /admin/ponentes');
                }
            }
        }

        $router->render('admin/ponentes/crear', [
            'titulo' => 'Registrar ponente',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => json_decode($ponente->redes)
        ]);
    }

    public static function editar(Router $router)
    {

        if (!is_admin()) {
            header('Location: /login');
        }

        $alertas = [];
        $id = s($_GET['id']);

        if (!is_numeric($id)) {
            header('Location: /admin/ponentes');
        }

        $ponente = Ponente::find($id);

        if (!$ponente) {
            header('Location: /admin/ponentes');
        }


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //leer imagen

            if (!empty($_FILES['imagen']['tmp_name'])) {
                //si hay imagen
                $carpeta_imagenes = '../public/build/img/speakers';

                if (!is_dir($carpeta_imagenes)) {
                    //crear carpeta si no existe
                    mkdir($carpeta_imagenes, 0755, true);
                }

                //eliminar la anterior
                $imagenAnterior = $carpeta_imagenes . '/' . $ponente->imagen;

                unlink($imagenAnterior . '.png');
                unlink($imagenAnterior . '.webp');

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600)->encode('png', '80');
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600)->encode('webp', '80');

                $nombre_imagen = md5(uniqid(rand(), true));

                $_POST['imagen'] = $nombre_imagen;
            }


            $_POST['redes'] = json_encode(s($_POST['redes']), JSON_UNESCAPED_SLASHES);


            $ponente->sincronizar(s($_POST));


            $alertas = $ponente->validar();

            if (empty($alertas)) {

                if ($imagen_png && $imagen_webp) {
                    //guardamos las imagenes
                    $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . '.png');
                    $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . '.webp');
                }
                //guardar en DB
                $resultado = $ponente->guardar();

                if ($resultado) {
                    header('Location: /admin/ponentes');
                }
            }
        }

        $router->render('admin/ponentes/editar', [
            'titulo' => 'Editar ponente',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => json_decode($ponente->redes)
        ]);
    }

    public static function eliminar()
    {

        if (!is_admin()) {
            header('Location: /login');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = s($_POST['id']);
            $ponente = Ponente::find($id);
            if (!isset($ponente)) {
                header('Location: /admin/ponentes');
            }

            $resultado = $ponente->eliminar();

            if ($resultado) {
                header('Location: /admin/ponentes');
            }
        }
    }
}
