<?php
namespace App\Controller;

use App\Model\Pelicula;
use App\Helper\ViewHelper;
use App\Helper\DbHelper;


class AppController
{
    var $db;
    var $view;

    function __construct()
    {
        //Conexión a la BBDD
        $dbHelper = new DbHelper();
        $this->db = $dbHelper->db;

        //Instancio el ViewHelper
        $viewHelper = new ViewHelper();
        $this->view = $viewHelper;
    }

    public function index(){

        //Consulta a la bbdd
        $rowset = $this->db->query("SELECT * FROM peliculas WHERE activo=1 AND home=1 ORDER BY fecha DESC");

        //Asigno resultados a un array de instancias del modelo
        $peliculas = array();
        while ($row = $rowset->fetch(\PDO::FETCH_OBJ)){
            array_push($peliculas,new Pelicula($row));
        }

        //Llamo a la vista
        $this->view->vista("app", "index", $peliculas);
    }

    public function acercade(){

        //Llamo a la vista
        $this->view->vista("app", "acerca-de");

    }

    public function peliculas(){

        //Consulta a la bbdd
        $rowset = $this->db->query("SELECT * FROM peliculas WHERE activo=1 ORDER BY fecha DESC");

        //Asigno resultados a un array de instancias del modelo
        $peliculas = array();
        while ($row = $rowset->fetch(\PDO::FETCH_OBJ)){
            array_push($peliculas,new Pelicula($row));
        }

        //Llamo a la vista
        $this->view->vista("app", "noticias", $peliculas);

    }

    public function pelicula($slug){

        //Consulta a la bbdd
        $rowset = $this->db->query("SELECT * FROM peliculas WHERE activo=1 AND slug='$slug' LIMIT 1");

        //Asigno resultado a una instancia del modelo
        $row = $rowset->fetch(\PDO::FETCH_OBJ);
        $pelicula= new Pelicula($row);

        //Llamo a la vista
        $this->view->vista("app", "noticia", $pelicula);

    }
}