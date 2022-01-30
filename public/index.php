<?php
namespace App;

//Inicializamos la sesión para poder guardar variables entre páginas
session_start();

//Incluyo los controladores que voy a utilizar para que seran cargados por Autoload
use App\Controller\AppController;
use App\Controller\PeliculaController;
use App\Controller\PersonaController;

//Guardo la ruta de public y la home para ruta que posteriormente utilizaremos para enlazar imagenes, css y js
$_SESSION['public'] = '/cms2/public/';
$_SESSION['home'] = $_SESSION['public'].'index.php/';

//Defino y llamo a la función que autocargará las clases cuando se instancien
spl_autoload_register('App\autoload');

function autoload($clase,$dir=null){

    //Directorio raíz de mi proyecto
    if (is_null($dir)){
        $dirname = str_replace('/public', '', dirname(__FILE__));
        $dir = realpath($dirname);
    }

    //Escaneo en busca de la clase de forma recursiva
    foreach (scandir($dir) as $file){
        //Si es un directorio (y no es de sistema) accedo y
        //busco la clase dentro de él
        if (is_dir($dir."/".$file) AND substr($file, 0, 1) !== '.'){
            autoload($clase, $dir."/".$file);
        }
        //Si es un fichero y el nombr conicide con el de la clase
        else if (is_file($dir."/".$file) AND $file == substr(strrchr($clase, "\\"), 1).".php"){
            require($dir."/".$file);
        }
    }

}

function controlador($nombre=null){

    switch($nombre){
        default: return new AppController;
        case "peliculas": return new PeliculaController;
        case "personas": return new PersonaController;
    }

}

//Creo una variable llamada ruta a la que le quito la ruta por defecto y solo añado la ruta apartir de la ip
$ruta = str_replace($_SESSION['home'], '', $_SERVER['REQUEST_URI']);

//Encamino cada ruta al controlador y acción correspondientes
switch ($ruta){

    //Front-end
    case "":
    case "/":
        controlador()->index();
        break;
    case "acerca-de":
        controlador()->acercade();
        break;
    case "peliculas":
        controlador()->peliculas();
        break;
    case (strpos($ruta,"pelicula/") === 0):
        controlador()->pelicula(str_replace("pelicula/","",$ruta));
        break;

    //Back-end
    case "admin":
    case "admin/entrar":
        controlador("personas")->entrar();
        break;
    case "admin/salir":
        controlador("personas")->salir();
        break;
    case "admin/personas":
        controlador("personas")->index();
        break;
    case "admin/personas/crear":
        controlador("personas")->crear();
        break;
    case (strpos($ruta,"admin/personas/editar/") === 0):
        controlador("personas")->editar(str_replace("admin/personas/editar/","",$ruta));
        break;
    case (strpos($ruta,"admin/personas/activar/") === 0):
        controlador("personas")->activar(str_replace("admin/personas/activar/","",$ruta));
        break;
    case (strpos($ruta,"admin/personas/borrar/") === 0):
        controlador("personas")->borrar(str_replace("admin/personas/borrar/","",$ruta));
        break;
    case "admin/peliculas":
        controlador("peliculas")->index();
        break;
    case "admin/peliculas/crear":
        controlador("peliculas")->crear();
        break;
    case (strpos($ruta,"admin/peliculas/editar/") === 0):
        controlador("peliculas")->editar(str_replace("admin/peliculas/editar/","",$ruta));
        break;
    case (strpos($ruta,"admin/peliculas/activar/") === 0):
        controlador("peliculas")->activar(str_replace("admin/peliculas/activar/","",$ruta));
        break;
    case (strpos($ruta,"admin/peliculas/home/") === 0):
        controlador("peliculas")->home(str_replace("admin/peliculas/home/","",$ruta));
        break;
    case (strpos($ruta,"admin/peliculas/borrar/") === 0):
        controlador("peliculas")->borrar(str_replace("admin/peliculas/borrar/","",$ruta));
        break;
    case (strpos($ruta,"admin/") === 0):
        controlador("personas")->entrar();
        break;

    //Resto de rutas
    default:
        controlador()->index();

}
