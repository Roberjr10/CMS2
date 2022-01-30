<?php
namespace App\Controller;

use App\Helper\ViewHelper;
use App\Helper\DbHelper;
use App\Model\Persona;
class PersonaController
{
 //Creamos las variables para guardar los datos de bbdd y de la vista
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
    public function admin(){

        //Compruebo permisos
        $this->view->permisos();

        //LLamo a la vista
        $this->view->vista("admin","index");

    }
    public function entrar(){

        //Si ya está autenticado, le llevo a la página de inicio del panel
        if (isset($_SESSION['persona'])){

            $this->admin();

        }
        //Si ha pulsado el botón de acceder, tramito el formulario
        else if (isset($_POST["acceder"])){

            //Recupero los datos del formulario
            $campo_usuario = filter_input(INPUT_POST, "usuario", FILTER_SANITIZE_STRING);
            $campo_clave = filter_input(INPUT_POST, "clave", FILTER_SANITIZE_STRING);

            //Busco al usuario en la base de datos
            $rowset = $this->db->query("SELECT * FROM personas WHERE nombre='$campo_usuario' AND activo=1 LIMIT 1");

            //Asigno resultado a una instancia del modelo
            $row = $rowset->fetch(\PDO::FETCH_OBJ);
            $persona = new Persona($row);

            //Si existe el usuario
            if ($persona->nombre){
                //Compruebo la clave
                if (password_verify($campo_clave,$persona->clave)) {

                    //Asigno el usuario y los permisos la sesión
                    $_SESSION["persona"] = $persona->nombre;
                    $_SESSION["personas"] = $persona->acceso;
                    $_SESSION["peliculas"] = $persona->peliculas;

                    //Guardo la fecha de último acceso
                    $ahora = new \DateTime("now", new \DateTimeZone("Europe/Madrid"));
                    $fecha = $ahora->format("Y-m-d H:i:s");
                    $this->db->exec("UPDATE personas SET fecha_acceso='$fecha' WHERE nombre='$campo_usuario'");

                    //Redirección con mensaje
                    $this->view->redireccionConMensaje("admin","green","Bienvenido al panel de administración.");
                }
                else{
                    //Redirección con mensaje
                    $this->view->redireccionConMensaje("admin","red","Contraseña incorrecta.");
                }
            }
            else{
                //Redirección con mensaje
                $this->view->redireccionConMensaje("admin","red","No existe ningún usuario con ese nombre.");
            }
        }
        //Le llevo a la página de acceso
        else{
            $this->view->vista("admin","personas/entrar");
        }

    }


    public function salir(){

        //Borro al usuario de la sesión
        unset($_SESSION['persona']);

        //Redirección con mensaje
        $this->view->redireccionConMensaje("admin","green","Te has desconectado con éxito.");

    }

    //Listado de usuarios
    public function index(){

        //Permisos
        $this->view->permisos("personas");

        //Recojo los usuarios de la base de datos
        $rowset = $this->db->query("SELECT * FROM personas ORDER BY nombre ASC");

        //Asigno resultados a un array de instancias del modelo
        $personas = array();
        while ($row = $rowset->fetch(\PDO::FETCH_OBJ)){
            array_push($personas, new Persona($row));
        }

        $this->view->vista("admin","personas/index", $personas);

    }
    public function borrar($id){

        //Permisos
        $this->view->permisos("personas");

        //Borro el usuario
        $consulta = $this->db->exec("DELETE FROM personas WHERE id='$id'");

        //Mensaje y redirección
        ($consulta > 0) ? //Compruebo consulta para ver que no ha habido errores
            $this->view->redireccionConMensaje("admin/personas","green","El usuario se ha borrado correctamente.") :
            $this->view->redireccionConMensaje("admin/personas","red","Hubo un error al guardar en la base de datos.");

    }
    public function crear(){

        //Permisos
        $this->view->permisos("personas");

        //Creo un nuevo usuario vacío
        $persona = new Persona();

        //Llamo a la ventana de edición
        $this->view->vista("admin","personas/editar", $persona);

    }
    public function editar($id){

        //Permisos
        $this->view->permisos("personas");

        //Si ha pulsado el botón de guardar
        if (isset($_POST["guardar"])){

            //Recupero los datos del formulario
            $usuario = filter_input(INPUT_POST, "usuario", FILTER_SANITIZE_STRING);
            $clave = filter_input(INPUT_POST, "clave", FILTER_SANITIZE_STRING);
            $usuarios = (filter_input(INPUT_POST, 'usuarios', FILTER_SANITIZE_STRING) == 'on') ? 1 : 0;
            $noticias = (filter_input(INPUT_POST, 'noticias', FILTER_SANITIZE_STRING) == 'on') ? 1 : 0;
            $cambiar_clave = (filter_input(INPUT_POST, 'cambiar_clave', FILTER_SANITIZE_STRING) == 'on') ? 1 : 0;

            //Encripto la clave
            $clave_encriptada = ($clave) ? password_hash($clave,  PASSWORD_BCRYPT, ['cost'=>12]) : "";

            if ($id == "nuevo"){

                //Creo un nuevo usuario
                $this->db->exec("INSERT INTO personas (usuario, clave, noticias, usuarios) VALUES ('$usuario','$clave_encriptada',$noticias,$usuarios)");

                //Mensaje y redirección
                $this->view->redireccionConMensaje("admin/personas","green","El usuario <strong>$usuario</strong> se creado correctamente.");
            }
            else{

                //Actualizo el usuario
                ($cambiar_clave) ?
                    $this->db->exec("UPDATE personas SET nombre='$usuario',clave='$clave_encriptada',noticias=$noticias,usuarios=$usuarios WHERE id='$id'") :
                    $this->db->exec("UPDATE personas SET nombre='$usuario',noticias=$noticias,usuarios=$usuarios WHERE id='$id'");

                //Mensaje y redirección
                $this->view->redireccionConMensaje("admin/usuarios","green","El usuario <strong>$usuario</strong> se actualizado correctamente.");
            }
        }

        //Si no, obtengo usuario y muestro la ventana de edición
        else{

            //Obtengo el usuario
            $rowset = $this->db->query("SELECT * FROM personas WHERE id='$id' LIMIT 1");
            $row = $rowset->fetch(\PDO::FETCH_OBJ);
            $usuario = new Persona($row);

            //Llamo a la ventana de edición
            $this->view->vista("admin","usuarios/editar", $usuario);
        }

    }



}