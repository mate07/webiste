<!-- Aquí agregamos la cabecera del template -->
<?php
    # Abriendo conexiónn a la base de datos
    include("../../bd.php");

    # Recuperando información almacenada en la tabla
    if(isset($_GET["txtID"])){
        $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";

        # Instrucción de consulta de la tabal
        $sql = $cn->prepare("SELECT * FROM tbl_servicios WHERE id=:id");

        # Vinculando variable a parametro
        $sql->bindParam(":id", $txtID);

        # Ejecutando sentencia
        $sql->execute();

        # Guardando la consulta en una variable
        $registro = $sql->fetch(PDO::FETCH_LAZY);

        # Guardando los datos de la tabla
        $icono = $registro["icono"];
        $titulo = $registro["titulo"];
        $descripcion = $registro["descripcion"];
    }

    # Actualizando los registros
    if($_POST){
        # Recibiendo modificaciones en los campos
        $txtID = (isset($_POST["txtID"])) ? $_POST["txtID"] : "";
        $icono = (isset($_POST["icono"])) ? $_POST["icono"] : "";
        $titulo = (isset($_POST["titulo"])) ? $_POST["titulo"] : "";
        $descripcion = (isset($_POST["descripcion"])) ? $_POST["descripcion"] : "";

        # Instrucción de actualización
        $sql = $cn->prepare("UPDATE tbl_servicios
            SET icono = :icono, titulo = :titulo, descripcion = :descripcion
            WHERE id = :id"
        );
        
        # Vinculando variables a parametros
        $sql->bindParam(":icono", $icono);
        $sql->bindParam(":titulo", $titulo);
        $sql->bindParam(":descripcion", $descripcion);
        $sql->bindParam(":id", $txtID);

        # Ejecutando la sentencia
        $sql->execute();

        # Redirección de editar a index
        $mensaje = "Registro Actualizado";
        header("Location:index.php?mensaje=".$mensaje);
    }

    include("../../templates/header.php");
?>

<h1 class="display-5">Editando Datos de Servicio</h1>

<div class="card">
    <div class="card-header">Formulario</div>

    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="text" readonly class="form-control" name="txtID" id="txtID" value="<?php echo $txtID;?>"/>
            </div>

            <div class="mb-3">
                <label for="icono" class="form-label">Ícono:</label>
                <input type="text" class="form-control" name="icono" id="icono" value="<?php echo $icono;?>"/>
            </div>
            
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" value="<?php echo $titulo;?>"/>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" value="<?php echo $descripcion;?>"/>
            </div>

            <button type="submit" class="btn btn-success">Modificar Registro</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a> 
            
        </form>
    </div>

    <div class="card-footer text-muted">Sistema Administrador</div>
</div>

<!-- Aquí agregamos el pie de página del template -->
<?php include("../../templates/footer.php");?>