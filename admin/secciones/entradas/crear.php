<!-- Aquí agregamos la cabecera del template -->
<?php
    # Conexión a la base de datos
    include("../../bd.php");

    # Agregar una validación para la recepción de datos del formulario
    if($_POST){
        # Recibiendo los datos los campos del formulario
        $fecha = (isset($_POST["fecha"])) ? $_POST["fecha"] : "";
        $titulo = (isset($_POST["titulo"])) ? $_POST["titulo"] : "";
        $descripcion = (isset($_POST["descripcion"])) ? $_POST["descripcion"] : "";
        $imagen = (isset($_FILES["imagen"]["name"])) ? $_FILES["imagen"]["name"] : "";


        # Paramestros para el renombrado de la imagen
        $fechaImagen = new DateTime();
        $nombreArchivoImagen = ($imagen != "") ? $fechaImagen->getTimestamp()."_".$imagen:"";
        $tmpImagen = $_FILES["imagen"]["tmp_name"];
        if($tmpImagen  != ""){
            move_uploaded_file($tmpImagen, "../../../assets/img/about/".$nombreArchivoImagen);
        }

        # Creando instrucción de insercción de datos
        $sql = $cn->prepare(
            "INSERT INTO `tbl_entradas` (`id`, `fecha`, `titulo`, `descripcion`, `imagen`) 
                    VALUES (NULL, :fecha, :titulo, :descripcion, :imagen);"
        );

        # Vinculando las variables con los parametros de la sentencia
        $sql->bindParam(":fecha", $fecha);
        $sql->bindParam(":titulo", $titulo);
        $sql->bindParam(":descripcion", $descripcion);
        $sql->bindParam(":imagen", $nombreArchivoImagen);
        
        # Ejecutando consulta
        $sql->execute();
    }
    
    include("../../templates/header.php");
?>

<h1 class="display-5">Creando Entrada de Blog</h1>

<div class="card">
    <div class="card-header">Formulario</div>

    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo date('Y-m-d');?>"/>
            </div>
            
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Título"/>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripción"/>
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen:</label>
                <input type="file" class="form-control" name="imagen" id="imagen" placeholder="Imagen"/>
            </div>

            <button type="submit" class="btn btn-success">Agregar Registros</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a> 
            
        </form>
    </div>

    <div class="card-footer text-muted">Sistema Administrador</div>
</div>

<!-- Aquí agregamos el pie de página del template -->
<?php include("../../templates/footer.php");?>