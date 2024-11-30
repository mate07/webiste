<!-- Aquí agregamos la cabecera del template -->
<?php
    # Abriendo la conexión a la base de datos
    include("../../bd.php");

    # Agregar una validación para la recepción de datos del formulario
    if($_POST){
        # Recibiendo los datos los campos del formulario
        $icono = (isset($_POST["icono"])) ? $_POST["icono"] : "";
        $titulo = (isset($_POST["titulo"])) ? $_POST["titulo"] : "";
        $descripcion = (isset($_POST["descripcion"])) ? $_POST["descripcion"] : "";

        # Creando instrucción de insercción de datos
        $sql = $cn->prepare(
            "INSERT INTO `tbl_servicios` (`id`, `icono`, `titulo`, `descripcion`) VALUES (NULL, :icono, :titulo, :descripcion);"
        );

        # Vinculando las variables con los parametros de la sentencia
        $sql->bindParam(":icono", $icono);
        $sql->bindParam(":titulo", $titulo);
        $sql->bindParam(":descripcion", $descripcion);

        # Ejecutar la sentencia
        $sql->execute();
    }

    include("../../templates/header.php");

?>

<h1 class="display-5">Creando Servicios</h1>

<div class="card">
    <div class="card-header">Formulario</div>

    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="icono" class="form-label">Ícono:</label>
                <input type="text" class="form-control" name="icono" id="icono" placeholder="Ícono"/>
            </div>
            
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Título"/>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripción"/>
            </div>

            <button type="submit" class="btn btn-success">Agregar Registros</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a> 
            
        </form>
    </div>

    <div class="card-footer text-muted">Sistema Administrador</div>
</div>


<!-- Aquí agregamos el pie de página del template -->
<?php include("../../templates/footer.php");?>