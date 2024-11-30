<?php include("./bd.php");?>

<!doctype html>
<html lang="en">
    <head>
        <title>Inicio de Sesión | Sistema de Control</title>
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
            <!-- place navbar here -->
        </header>

        <main>

            <div class="container">
                <div class="row">

                    <div class="col-4"></div>

                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">Inicio de Sesión</div>
                            <div class="card-body">

                                <form action="" method="post">
                                    <div class="mb-3">
                                        <label for="txtUsuario" class="form-label">Usuario</label>
                                        <input type="text" class="form-control" name="txtUsuario" id="txtUsuario" placeholder="Usuario"/>
                                    </div>

                                    <div class="mb-3">
                                        <label for="txtPassword" class="form-label">Contraseña</label>
                                        <input type="text" class="form-control" name="txtPassword" id="txtPassword" placeholder="Contraseña"/>
                                    </div>

                                    <a name="" id="" class="btn btn-success" href="index.php" role="button">Iniciar Sesión</a>
                                </form>
                                
                            </div>
                            <div class="card-footer text-muted"></div>
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </main>

        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
