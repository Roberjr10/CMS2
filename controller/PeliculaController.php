<?php
namespace App\Controller;

use App\Helper\ViewHelper;
use App\Helper\DbHelper;
use App\Model\Pelicula;

class PeliculaController
{
    //Creamos dos variables
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
//Listado de noticias
    public function index(){

        //Comprobamos los permisos que tiene esa sesion
        $this->view->permisos("peliculas");

        //Recojo las noticias de la base de datos
        $rowset = $this->db->query("SELECT * FROM peliculas ORDER BY fecha DESC");

        //Asigno resultados a un array de instancias del modelo
        $peliculas = array();
        while ($row = $rowset->fetch(\PDO::FETCH_OBJ)){
            array_push($peliculas,new Pelicula($row));
        }
        //Llamo a la vista
        $this->view->vista("admin","peliculas/index", $peliculas);

    }
    //Para activar o desactivar
    public function activar($id){

        //Permisos
        $this->view->permisos("peliculas");

        //Obtengo la noticia
        $rowset = $this->db->query("SELECT * FROM peliculas WHERE id='$id' LIMIT 1");
        $row = $rowset->fetch(\PDO::FETCH_OBJ);
        $pelicula = new Pelicula($row);

        //Comprobamos que el valor activo de pelicula sea 1.
        if ($pelicula->activo == 1){

            //Desactivo la noticia
            $consulta = $this->db->exec("UPDATE peliculas SET activo=0 WHERE id='$id'");

            //Mensaje y redirección
            ($consulta > 0) ? //Compruebo consulta para ver que no ha habido errores
                $this->view->redireccionConMensaje("admin/peliculas","green","La noticia <strong>$pelicula->titulo</strong> se ha desactivado correctamente.") :
                $this->view->redireccionConMensaje("admin/peliculas","red","Hubo un error al guardar en la base de datos.");
        }

        else{

            //Activo la noticia
            $consulta = $this->db->exec("UPDATE peliculas SET activo=1 WHERE id='$id'");

            //Mensaje y redirección
            ($consulta > 0) ? //Compruebo consulta para ver que no ha habido errores
                $this->view->redireccionConMensaje("admin/peliculas","green","La noticia <strong>$pelicula->titulo</strong> se ha activado correctamente.") :
                $this->view->redireccionConMensaje("admin/peliculas","red","Hubo un error al guardar en la base de datos.");
        }

    }
    //Para mostrar o no en la home
    public function home($id){

        //Permisos
        $this->view->permisos("peliculas");

        //Obtengo la noticia
        $rowset = $this->db->query("SELECT * FROM peliculas WHERE id='$id' LIMIT 1");
        $row = $rowset->fetch(\PDO::FETCH_OBJ);
        $pelicula= new Pelicula($row);

        if ($pelicula->home == 1){

            //Quito la noticia de la home
            $consulta = $this->db->exec("UPDATE peliculas SET home=0 WHERE id='$id'");

            //Mensaje y redirección
            ($consulta > 0) ? //Compruebo consulta para ver que no ha habido errores
                $this->view->redireccionConMensaje("admin/peliculas","green","La noticia <strong>$pelicula->titulo</strong> ya no se muestra en la home.") :
                $this->view->redireccionConMensaje("admin/peliculas","red","Hubo un error al guardar en la base de datos.");
        }

        else{

            //Muestro la noticia en la home
            $consulta = $this->db->exec("UPDATE peliculas SET home=1 WHERE id='$id'");

            //Mensaje y redirección
            ($consulta > 0) ? //Compruebo consulta para ver que no ha habido errores
                $this->view->redireccionConMensaje("admin/noticias","green","La noticia <strong>$pelicula->titulo</strong> ahora se muestra en la home.") :
                $this->view->redireccionConMensaje("admin/noticias","red","Hubo un error al guardar en la base de datos.");
        }

    }
    public function borrar($id){

        //Permisos
        $this->view->permisos("peliculas");

        //Obtengo la noticia
        $rowset = $this->db->query("SELECT * FROM peliculas WHERE id='$id' LIMIT 1");
        $row = $rowset->fetch(\PDO::FETCH_OBJ);
        $pelicula = new Pelicula($row);

        //Borro la noticia
        $consulta = $this->db->exec("DELETE FROM peliculas WHERE id='$id'");

        //Borro la imagen asociada
        $archivo = $_SESSION['public']."img/".$pelicula->imagen;
        $texto_imagen = "";
        if (is_file($archivo)){
            unlink($archivo);
            $texto_imagen = " y se ha borrado la imagen asociada";
        }

        //Mensaje y redirección
        ($consulta > 0) ? //Compruebo consulta para ver que no ha habido errores
            $this->view->redireccionConMensaje("admin/peliculas","green","La película se ha borrado correctamente$texto_imagen.") :
            $this->view->redireccionConMensaje("admin/peliculas","red","Hubo un error al guardar en la base de datos.");

    }
    public function crear(){

        //Permisos
        $this->view->permisos("peliculas");

        //Creo un nuevo usuario vacío
        $pelicula = new Pelicula();

        //Llamo a la ventana de edición
        $this->view->vista("admin","peliculas/editar", $pelicula);

    }
    public function editar($id){

        //Permisos
        $this->view->permisos("peliculas");

        //Si ha pulsado el botón de guardar
        if (isset($_POST["guardar"])){

            //Recupero los datos del formulario
            $titulo = filter_input(INPUT_POST, "titulo", FILTER_SANITIZE_STRING);
            $descripcion = filter_input(INPUT_POST, "descripcion", FILTER_SANITIZE_STRING);
            $genero = filter_input(INPUT_POST, "genero", FILTER_SANITIZE_STRING);
            $fecha = filter_input(INPUT_POST, "fecha", FILTER_SANITIZE_STRING);
            $duracion = filter_input(INPUT_POST, "duracion", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //Formato de fecha para SQL
            $fecha = \DateTime::createFromFormat("d-m-Y", $fecha)->format("Y-m-d H:i:s");

            //Genero slug (url amigable)
            $slug = $this->view->getSlug($titulo);

            //Imagen
            $imagen_recibida = $_FILES['imagen'];
            $imagen = ($_FILES['imagen']['name']) ? $_FILES['imagen']['name'] : "";

            $imagen_subida = ($_FILES['imagen']['name']) ? '/var/www/html'.$_SESSION['public']."img/".$_FILES['imagen']['name'] : "";
            $texto_img = ""; //Para el mensaje

            if ($id == "nuevo"){

                //Creo una nueva noticia
                $consulta = $this->db->exec("INSERT INTO peliculas 
                    (titulo, descripcion, genero, fecha, duracion, slug, imagen) VALUES 
                    ('$titulo','$descripcion','$genero','$fecha','$duracion','$slug','$imagen')");

                //Subo la imagen
                if ($imagen){
                    if (is_uploaded_file($imagen_recibida['tmp_name']) && move_uploaded_file($imagen_recibida['tmp_name'], $imagen_subida)){
                        $texto_img = " La imagen se ha subido correctamente.";
                    }
                    else{
                        $texto_img = " Hubo un problema al subir la imagen.";
                    }
                }

                //Mensaje y redirección
                ($consulta > 0) ?
                    $this->view->redireccionConMensaje("admin/peliculas","green","La noticia <strong>$titulo</strong> se creado correctamente.".$texto_img) :
                    $this->view->redireccionConMensaje("admin/peliculas","red","Hubo un error al guardar en la base de datos.");
            }
            else{

                //Actualizo la noticia
                $this->db->exec("UPDATE peliculas SET 
                    titulo='$titulo',descripcion='$descripcion',genero='$genero',
                    fecha='$fecha',duracion='$duracion',slug='$slug' WHERE id='$id'");

                //Subo y actualizo la imagen
                if ($imagen){
                    if (is_uploaded_file($imagen_recibida['tmp_name']) && move_uploaded_file($imagen_recibida['tmp_name'], $imagen_subida)){
                        $texto_img = " La imagen se ha subido correctamente.";
                        $this->db->exec("UPDATE peliculas SET imagen='$imagen' WHERE id='$id'");
                    }
                    else{
                        $texto_img = " Hubo un problema al subir la imagen.";
                    }
                }

                //Mensaje y redirección
                $this->view->redireccionConMensaje("admin/noticias","green","La noticia <strong>$titulo</strong> se guardado correctamente.".$texto_img);

            }
        }

        //Si no, obtengo noticia y muestro la ventana de edición
        else{

            //Obtengo la noticia
            $rowset = $this->db->query("SELECT * FROM peliculas WHERE id='$id' LIMIT 1");
            $row = $rowset->fetch(\PDO::FETCH_OBJ);
            $pelicula = new Pelicula($row);

            //Llamo a la ventana de edición
            $this->view->vista("admin","peliculas/editar", $pelicula);
        }

    }


}