<?php
namespace App\Model;

class Persona{

    //Variables o atributos
    var $id;
    var $nombre;
    var $clave;
    var $fecha_acceso;
    var $activo;
    var $acceso;
    var $peliculas;

    function __construct($data=null){

        $this->id = ($data) ? $data->id : null;
        $this->nombre = ($data) ? $data->nombre : null;
        $this->clave = ($data) ? $data->clave : null;
        $this->fecha_acceso = ($data) ? $data->fecha_acceso : null;
        $this->activo = ($data) ? $data->activo : null;
        $this->acceso = ($data) ? $data->usuarios : null;
        $this->peliculas = ($data) ? $data->noticias : null;

    }

}