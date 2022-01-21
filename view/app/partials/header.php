<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Información de peliculas</title>

    <!--CSS-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['public'] ?>css/app.css">
   </head>
<body>
<nav>
    <div class="nav-wrapper">
        <!--Logo-->
        <a href="<?php echo $_SESSION['home'] ?>" class="brand-logo" title="Inicio">
            <img src="<?php echo $_SESSION['public'] ?>img/logo.png" alt="Logo Pelicula">
        </a>

        <!--Botón menú móviles-->
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>

        <!--nav boostrap-->
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo $_SESSION['home'] ?>" title="Inicio">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $_SESSION['home'] ?>peliculas" title="Peliculas">Peliculas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $_SESSION['home'] ?>acerca-de" title="Acerca de">Acerca de</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $_SESSION['home'] ?>admin" title="Panel de administracion" target="_blank">Admin</a>
            </li>
        </ul>

    </div>
</nav>
<!--Menú de navegación móvil-->
<ul class="sidenav" id="mobile-demo">
    <li>
        <a href="<?php echo $_SESSION['home'] ?>" title="Inicio">Inicio</a>
    </li>
    <li>
        <a href="<?php echo $_SESSION['home'] ?>noticias" title="Noticias">Películas</a>
    </li>
    <li>
        <a href="<?php echo $_SESSION['home'] ?>acerca-de" title="Acerca de">Acerca de</a>
    </li>
    <li>
        <a href="<?php echo $_SESSION['home'] ?>admin" title="Panel de administración"
           target="_blank" class="grey-text">
            Admin
        </a>
    </li>
</ul>
<main>

    <header class="container">
        <div class="row">
        <h1>Información de películas</h1>
        </div>
    </header>

    <section class="container">

