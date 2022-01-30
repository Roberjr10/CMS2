<h3>
    <a href="<?php echo $_SESSION['home'] ?>admin" title="Inicio">Inicio</a> <span>| Películas</span>
</h3>
<div class="row">
    <!--Nuevo-->
    <article class="col-6">
        <div class="card" style="height: 220px">
            <div class="card-body">
                <div class="card-content">
                    <i class="grey-text material-icons medium">image</i>
                    <h4 class="grey-text">
                        nueva película
                    </h4><br><br>
                </div>
                <div class="card-action">
                    <a href="<?php echo $_SESSION['home']."admin/peliculas/crear" ?>" title="Añadir nueva noticia">
                        <i class="material-icons">add_circle</i>
                    </a>
                </div>
            </div>
        </div>
    </article>
    <?php foreach ($datos as $row){ ?>
        <article class="col-6">
            <div class="card">
                <div class="card-body row">
                    <?php if ($row->imagen){ ?>
                        <div class="card-img">
                            <img src="<?php echo $_SESSION['public']."img/".$row->imagen ?>" alt="<?php echo $row->titulo ?>">
                        </div>
                    <?php } ?>
                    <div class="card-content col-6">
                        <?php if (!$row->imagen){ ?>
                            <i class="grey-text material-icons medium">image</i>
                        <?php } ?>
                        <h4>
                            <?php echo $row->titulo ?>
                        </h4>
                        <strong>Duración:</strong> <?php echo $row->duracion ?><br>
                        <strong>Fecha:</strong> <?php echo date("d/m/Y", strtotime($row->fecha)) ?>
                    </div>

                    <div class="card-action col-12">
                        <hr/>
                        <a href="<?php echo $_SESSION['home']."admin/peliculas/editar/".$row->id ?>" title="Editar">
                            <i class="material-icons">edit</i>
                        </a>
                        <?php $title = ($row->activo == 1) ? "Desactivar" : "Activar" ?>
                        <?php $color = ($row->activo == 1) ? "green-text" : "red-text" ?>
                        <?php $icono = ($row->activo == 1) ? "mood" : "mood_bad" ?>
                        <a href="<?php echo $_SESSION['home']."admin/peliculas/activar/".$row->id ?>" title="<?php echo $title ?>">
                            <i class="<?php echo $color ?> material-icons"><?php echo $icono ?></i>
                        </a>
                        <?php $title = ($row->home == 1) ? "Quitar de la home" : "Mostrar en la home" ?>
                        <?php $color = ($row->home == 1) ? "green-text" : "red-text" ?>
                        <a href="<?php echo $_SESSION['home']."admin/peliculas/home/".$row->id ?>" title="<?php echo $title ?>">
                            <i class="<?php echo $color ?> material-icons">home</i>
                        </a>
                        <a href="#" class="activator" title="Borrar">
                            <i class="material-icons">delete</i>
                        </a>
                    </div>
                </div>

            </div>
        </article>
    <?php } ?>
</div>
