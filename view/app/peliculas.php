<h3>
    <a href="<?php echo $_SESSION['home'] ?>" title="Inicio">Inicio</a> <span>| Películas</span>
</h3>
<div class="row ">
    <?php foreach ($datos as $row){ ?>
        <article class="col col-sm-6 col-md-3 col-lg-6">
            <div class="card">
                <div class="card-img-top">
                    <img src="<?php echo $_SESSION['public']."img/".$row->imagen ?>" alt="<?php echo $row->titulo ?>">
                </div>
                <div class="card-body">
                    <div class="card-text">
                        <h4><?php echo $row->titulo ?></h4>
                    </div>
                    <div class="footer-card">
                    <div class="card-text">
                        <p><b>Fecha de estreno: </b><?php echo date("d/m/Y", strtotime($row->fecha)) ?></p>
                    </div>
                        <hr>
                    <div class="card-action">
                        <a href="<?php echo $_SESSION['home']."pelicula/".$row->slug ?>">Más información</a>
                    </div>
                    </div>
                </div>
            </div>
        </article>
    <?php } ?>
</div>