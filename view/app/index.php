<h3>Inicio</h3>
<div class="row">
    <?php foreach ($datos as $row){ ?>
        <article class="col-sm-12 col-md-6 col-lg-6">
            <div class="card mb-3">
                <div class="card-img-top">
                    <img src="<?php echo $_SESSION['public']."img/".$row->imagen ?>" alt="<?php echo $row->titulo ?>">
                </div>
                <div class="card-body">
                    <div class="card-content">
                        <h4><?php echo $row->titulo ?></h4>
                        <p><?php echo $row->descripcion?></p>
                        <br/>

                        <p><b>Género: </b><?php echo $row->genero?></p>
                        <p><b>Duración: </b><?php echo $row->duracion?></p>

                        <br/>
                        <div class="card-info">
                            <p><?php echo date("d/m/Y", strtotime($row->fecha)) ?></p>
                        </div>
                    </div>
                    <div class="card-action">
                        <a href="<?php echo $_SESSION['home']."noticia/".$row->slug ?>">Más información</a>
                    </div>
                </div>
            </div>
        </article>
    <?php } ?>
</div>
