<h3>
    <a href="<?php echo $_SESSION['home'] ?>admin" title="Inicio">Inicio</a> <span>| </span>
    <a href="<?php echo $_SESSION['home'] ?>admin/peliculas" title="Peliculas">Películas</a> <span>| </span>
    <?php if ($datos->id){ ?>
        <span>Editar <?php echo $datos->titulo ?></span>
    <?php } else { ?>
        <span>Nueva pelicula</span>
    <?php } ?>
</h3>
<div class="contenedor row card">
    <?php $id = ($datos->id) ? $datos->id : "nuevo" ?>
    <form class="col-12 form-group row" method="POST" enctype="multipart/form-data" action="<?php echo $_SESSION['home'] ?>admin/peliculas/editar/<?php echo $id ?>">
            <div class="datos col-6">
                    <label for="titulo">Título</label>
                    <input id="titulo" type="text" name="titulo" value="<?php echo $datos->titulo ?>"><br/>

                    <label for="duracion">Duracion</label>
                    <input id="duracion" type="text" name="duracion" value="<?php echo $datos->duracion ?>"><br/>
                <label for="genero">Género</label>
                <input id="genero" class="genero" name="genero"  value="<?php echo $datos->genero ?>"</input>
                <br/>

                    <?php $fecha = ($datos->fecha) ? date("d-m-Y", strtotime($datos->fecha)) : date("d-m-Y") ?>
                <label for="fecha">Fecha</label>
                    <input id="fecha" type="text" name="fecha" class="datepicker" value="<?php echo $fecha ?>">


            </div>

            <div class="imagen col-6">

                <div class="btn-image col-12">
                    <span>Imagen</span>
                    <input type="file" name="imagen">
                </div>

                <div class="col-12">
            <?php if ($datos->imagen){ ?>
                <img style="width: 100%; height: 300px"src="<?php echo $_SESSION['public']."img/".$datos->imagen ?>" alt="<?php echo $datos->titulo ?>">
            <?php } ?>

                </div>
        </div>
        <div class="col-12">

            <label for="descripcion">Descripción</label><br/>
                    <textarea id="descripcion" name="descripcion" class="descripcion"><?php echo $datos->descripcion ?></textarea>


        </div>



        <div class="botones col-12">

                <a href="<?php echo $_SESSION['home'] ?>admin/peliculass" title="Volver">
                    <button class="btn btn-warning" type="button">Volver
                        <i class="material-icons right">replay</i>
                    </button>
                </a>

                <button class="btn btn-success" type="submit" name="guardar">Guardar
                    <i class="material-icons right">save</i>
                </button>


        </div>
    </form>
</div>

