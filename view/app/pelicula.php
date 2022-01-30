<h3>
    <a href="<?php echo $_SESSION['home'] ?>" title="Inicio">Inicio</a> <span>| </span>
    <a href="<?php echo $_SESSION['home'] ?>peliculas" title="Películas">Películas</a> <span>| </span>
    <span><?php echo $datos->titulo ?></span>
</h3>
<div class="row justify-content-md-center align-items-center">
    <article class="col-8">
        <div class="card">
            <div class="card-image  col-12" style="width: 100%;">
                <img src="<?php echo $_SESSION['public']."img/".$datos->imagen ?>" alt="<?php echo $datos->titulo ?>">
            </div>
            <div class="card-body col-12">
                <div class="card-text">
                    <h3><?php echo $datos->titulo ?></h3>
                    <p><b>Descripción.</b><br/><?php echo $datos->descripcion ?></p>
                    <p><b>Duración: </b><?php echo $datos->duracion ?></p>

                    <p>
                        <strong>Fecha</strong>: <?php echo date("d/m/Y", strtotime($datos->fecha)) ?><br>

                    </p>
                </div>
            </div>
        </div>
    </article>
</div>