<h3>
    <a href="<?php echo $_SESSION['home'] ?>admin" title="Inicio">Inicio</a> <span>| </span>
    <a href="<?php echo $_SESSION['home'] ?>admin/personas" title="Personas">Personas</a> <span>| </span>
    <?php if ($datos->id){ ?>
        <span>Editar <?php echo $datos->nombre ?></span>
    <?php } else { ?>
        <span>Nuevo usuario</span>
    <?php } ?>
</h3>
<div class="row">
    <?php $id = ($datos->id) ? $datos->id : "nuevo" ?>
    <form class="col-12 form-group row" method="POST" action="<?php echo $_SESSION['home'] ?>admin/personas/editar/<?php echo $id ?>">
        <div class="row">
            <div class="datos col-12">
                <label for="usuario">Usuario</label>
                <input id="usuario" type="text" name="usuario" value="<?php echo $datos->nombre ?>">


            <?php $clase = ($datos->id) ? "hide" : "" ?>

                <label for="clave">Contraseña</label>
                <input id="clave" type="password" name="clave" value="">


            <?php $clase = ($datos->id) ? "" : "hide" ?>
            <p class="<?php echo $clase ?>">
                <label for="cambiar_clave">
                    <input id="cambiar_clave" name="cambiar_clave" type="checkbox">
                    <span>Pulsa para cambiar la clave</span>
                </label>
            </p>

        <div class="col-12">
            <p>Permisos</p>
            <p>
                <label for="peliculas">
                    <input id="peliculas" name="peliculas" type="checkbox" <?php echo ($datos->acceso == 1) ? "checked" : "" ?>>
                    <span>Películas</span>
                </label>
            </p>
            <p>
                <label for="personas">
                    <input id="personas" name="personas" type="checkbox" <?php echo ($datos->acceso == 1) ? "checked" : "" ?>>
                    <span>Personas</span>
                </label>
            </p>
            <?php $clase = ($datos->id) ? "" : "hide" ?>
            <p class="<?php echo $clase ?>">
                Último acceso: <strong><?php echo date("d/m/Y H:i", strtotime($datos->fecha_acceso)) ?></strong>
            </p>
            <div class="col-12">
                <a href="<?php echo $_SESSION['home'] ?>admin/personas" title="Volver">
                    <button class="btn btn-warning" type="button">Volver
                        <i class="material-icons right">replay</i>
                    </button>
                </a>
                <button class="btn btn-success" type="submit" name="guardar">Guardar
                    <i class="material-icons right">save</i>
                </button>
            </div>
        </div>
            </div>
        </div>
    </form>
</div>