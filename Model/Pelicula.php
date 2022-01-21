<?php
namespace App\Model;

class Pelicula
{
    //Variables o atributos
    var $id;
    var $titulo;
    var $slug;
    var $descripcion;
    var $activo;
    var $home;
    var $fecha;
    var $genero;
    var $imagen;
    var $duracion;

    function __construct($data=null){

        $this->id = ($data) ? $data->id : null;
        $this->titulo = ($data) ? $data->titulo : null;
        $this->slug = ($data) ? $data->slug : null;
        $this->descripcion = ($data) ? $data->descripcion : null;
        $this->activo = ($data) ? $data->activo : null;
        $this->home = ($data) ? $data->home : null;
        $this->fecha = ($data) ? $data->fecha : null;
        $this->genero = ($data) ? $data->genero : null;
        $this->imagen = ($data) ? $data->imagen : null;
        $this->duracion = ($data) ? $data->duracion: null;


    }
}