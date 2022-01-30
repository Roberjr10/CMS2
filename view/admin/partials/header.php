<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Panel de administración</title>

    <!--CSS-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['public'] ?>css/admin.css">
</head>

<body>
<nav>
    <div class="nav-wrapper" style="min-height: 80px";>
        <!--Logo-->
        <a href="<?php echo $_SESSION['home'] ?>admin" class="brand-logo" title="Inicio">
            <img src="<?php echo $_SESSION['public'] ?>img/logo.png" alt="Logo Pelicula">
        </a>

        <?php if (isset($_SESSION['persona'])){ ?>



            <!--Menú de navegación-->
            <ul  class="nav justify-content-end" style="margin-top: -50px";>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $_SESSION['home'] ?>admin" title="Inicio">Inicio</a>
                </li>
                <?php if ($_SESSION['peliculas'] == 1){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $_SESSION['home'] ?>admin/peliculas" title="Peliculas">Películas</a>
                    </li>
                <?php } ?>
                <?php if ($_SESSION['personas'] == 1){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $_SESSION['home'] ?>admin/personas" title="Personas">Personas</a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $_SESSION['home'] ?>admin/salir" title="Salir">Salir</a>
                </li>
            </ul>

        <?php } ?>

    </div>
</nav>


<!-- Si existen mensajes  -->
<?php if (isset($_SESSION["mensaje"])) { ?>

    <!-- Los muestro ocultos -->
    <input type="hidden" name="tipo-mensaje" value="<?php echo $_SESSION["mensaje"]['tipo'] ?>">
    <input type="hidden" name="texto-mensaje" value="<?php echo $_SESSION["mensaje"]['texto'] ?>">

    <!-- Borro mensajes -->
    <?php unset($_SESSION["mensaje"]) ?>

<?php } ?>

<main>

    <section class="container">
    <header>
        <h1>Panel de administración</h1>

        <?php if (isset($_SESSION['persona'])){ ?>

            <h2>
                Usuario: <strong><?php echo $_SESSION['persona'] ?></strong>
            </h2>

        <?php } else { ?>

            <h2>Bienvenido, introduce usuario y contraseña.</h2>

        <?php } ?>
    </header>
