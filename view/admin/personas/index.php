<h3>
    <a href="<?php echo $_SESSION['home'] ?>admin" title="Inicio">Inicio</a> <span>| Personas</span>
</h3>
<div class="row">
    <!--Nuevo-->
    <article class="col-4">

            <div class="card">
                <div class="card-content">
                    <i class="grey-text material-icons medium">person</i>
                    <h4 class="grey-text">
                        nuevo usuario
                    </h4><br><br>
                </div>
                <div class="card-action">
                    <a href="<?php echo $_SESSION['home']."admin/personas/crear" ?>" title="Añadir nuevo usuario">
                        <i class="material-icons">add_circle</i>
                    </a>
                </div>
            </div>

    </article>
    <?php foreach ($datos as $row){ ?>
        <article class="col-4">

                <div class="card">
                    <div class="card-body row">
                        <div class="col-6">
                        <i class="material-icons medium">person</i>
                        <h5>
                            <?php echo $row->nombre ?>
                        </h5>
                        </div>
                        <div class="col-6">
                        <strong>Usuarios: </strong><?php echo ($row->acceso) ? "Sí" : "No" ?><br>
                        <strong>Películas: </strong><?php echo ($row->peliculas) ? "Sí" : "No" ?>
                        </div>
                    </div>
                    <div class="card-action">
                        <a href="<?php echo $_SESSION['home']."admin/personas/editar/".$row->id ?>" title="Editar">                            <i class="material-icons">edit</i>
                        </a>
                        <?php $title = ($row->activo == 1) ? "Desactivar" : "Activar" ?>
                        <?php $color = ($row->activo == 1) ? "green-text" : "red-text" ?>
                        <?php $icono = ($row->activo == 1) ? "mood" : "mood_bad" ?>
                        <a href="<?php echo $_SESSION['home']."admin/personas/activar/".$row->id ?>" title="<?php echo $title ?>">
                            <i class="<?php echo $color ?> material-icons"><?php echo $icono ?></i>
                        </a>
                        <a href="<?php echo $_SESSION['home']."admin/personas/borrar/".$row->id ?>" class="activator" title="Borrar">
                            <i class="material-icons">delete</i>
                        </a>
                    </div>


            </div>
        </article>
    <?php } ?>
</div>