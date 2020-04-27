<?php
//entry.php
session_start();
if(!isset($_SESSION["username"]))
{
     header("location:index.php?action=login");
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/estilos.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>ADULTOS MAYORES</title>
</head>
<body class="bg-secondary">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">::..FIVE SYSTEMS..::</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto ">

                <li class="nav-item">
                    <a class="nav-link mostrar-hombres" data-modulo="hombres" data-form="hombres" href="#">Hombres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mostrar-mujeres" data-modulo="mujeres" data-form="mujeres" href="#">Mujeres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mostrar-rurales" data-modulo="rurales" data-form="rurales" href="#">Zona Rural</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mostrar-urbanas" data-modulo="urbanas" data-form="urbanas" href="#">Zona Urbana</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mostrar-expedientes" data-modulo="expedientes" data-form="expedientes" href="#">Expediente clinico</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mostrar-expedientes" data-modulo="ubicacion" data-form="ubicacion" href="#">Ubicación</a>
                </li>
                </ul>

                  <ul class="navbar-nav ml-auto ">
                <li class="nav-item">
                  <?php
                  echo '
                  <a class="nav-link mostrar-expedientes"  href="#" >Usuario - '.$_SESSION["username"].'</a>';
                  ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link mostrar-expedientes"  href="logout.php">Cerrar Sesion</a>
                </li>


            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="modulos" id="vista-hombres"></div>
        <div class="modulos" id="vista-buscar-hombres"></div>
        <div class="modulos" id="vista-mujeres"></div>
        <div class="modulos" id="vista-buscar-mujeres"></div>
        <div class="modulos" id="vista-rurales"></div>
        <div class="modulos" id="vista-buscar-rurales"></div>
        <div class="modulos" id="vista-urbanas"></div>
        <div class="modulos" id="vista-buscar-urbanas"></div>
        <div class="modulos" id="vista-expedientes"></div>
        <div class="modulos" id="vista-buscar-expedientes"></div>


    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="public/js/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script type="module" src="public/js/app.js"></script>
</form>
</body>
</html>
