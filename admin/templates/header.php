<!-- Aqui vamos a crear una variable que será como variable global para armar la URL -->
<!-- En el caso de la mayoria debe ser http://localhost/website/admin/ -->
<?php $urlBase = "http://localhost:8060/website/admin/";?>

<!doctype html>
<html lang="en">
    <head>
        <title>Bienvenida | Sistema de Control</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>

            <!-- Agregar el menú del sistema -->
             <nav class="navbar navbar-expand navbar-light bg-dark border-bottom border-body" data-bs-theme="dark">
                <div class="nav navbar-nav">
                    <a class="nav-item nav-link active" href="#" aria-current="page">Administrador <span class="visually-hidden">(current)</span></a>
                    <a class="nav-item nav-link" href="<?php echo $urlBase;?>secciones/servicios">Servicios</a>
                    <a class="nav-item nav-link" href="<?php echo $urlBase;?>secciones/portafolio">Portafolio</a>
                    <a class="nav-item nav-link" href="<?php echo $urlBase;?>secciones/entradas">Entradas</a>
                    <a class="nav-item nav-link" href="<?php echo $urlBase;?>secciones/equipos">Equipo</a>
                    <a class="nav-item nav-link" href="<?php echo $urlBase;?>secciones/configuraciones">Configuraciones</a>
                    <a class="nav-item nav-link" href="<?php echo $urlBase;?>secciones/usuarios">Usuarios</a>
                    <a class="nav-item nav-link" href="<?php echo $urlBase;?>login.php">Cerrar Sesión</a>
                </div>
             </nav>
             
        </header>
        <main class="container">
            <br/>