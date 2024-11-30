<!-- Aquí agregamos la cabecera del template -->
<?php
    # Conexión a la base de datos
    include("../../bd.php");

    # Agregar una validación para la recepción de datos del formulario
    if($_POST){
        # Recibiendo los datos los campos del formulario
        $titulo = (isset($_POST["titulo"])) ? $_POST["titulo"] : "";
        $subtitulo = (isset($_POST["subtitulo"])) ? $_POST["subtitulo"] : "";
        $imagen = (isset($_FILES["imagen"]["name"])) ? $_FILES["imagen"]["name"] : "";
        $descripcion = (isset($_POST["descripcion"])) ? $_POST["descripcion"] : "";
        $cliente = (isset($_POST["cliente"])) ? $_POST["cliente"] : "";
        $categoria = (isset($_POST["categoria"])) ? $_POST["categoria"] : "";
        $url = (isset($_POST["url"])) ? $_POST["url"] : "";

        # Paramestros para el renombrado de la imagen
        $fechaImagen = new DateTime();
        $nombreArchivoImagen = ($imagen != "") ? $fechaImagen->getTimestamp()."_".$imagen:"";
        $tmpImagen = $_FILES["imagen"]["tmp_name"];
        if($tmpImagen  != ""){
            move_uploaded_file($tmpImagen, "../../../assets/img/portfolio/".$nombreArchivoImagen);
        }

        # Creando instrucción de insercción de datos
        $sql = $cn->prepare(
            "INSERT INTO `tbl_portafolio` (`id`, `titulo`, `subtitulo`, `imagen`, `descripcion`, `cliente`, `categoria`, `url`) 
                    VALUES (NULL, :titulo, :subtitulo, :imagen, :descripcion, :cliente, :categoria, :url);"
        );

        # Vinculando las variables con los parametros de la sentencia
        $sql->bindParam(":titulo", $titulo);
        $sql->bindParam(":subtitulo", $subtitulo);
        $sql->bindParam(":imagen", $nombreArchivoImagen);
        $sql->bindParam(":descripcion", $descripcion);
        $sql->bindParam(":cliente", $cliente);
        $sql->bindParam(":categoria", $categoria);
        $sql->bindParam(":url", $url);

        # Ejecutando consulta
        $sql->execute();
    }

    include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">Creando Datos de Portafolio</div>
    <div class="card-body">

        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Título"/>
            </div>

            <div class="mb-3">
                <label for="subtitulo" class="form-label">Subtítulo:</label>
                <input type="text" class="form-control" name="subtitulo" id="subtitulo" placeholder="Subtítulo"/>
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen:</label>
                <input type="file" class="form-control" name="imagen" id="imagen"/>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripción"/>
            </div>

            <div class="mb-3">
                <label for="cliente" class="form-label">Cliente:</label>
                <input type="text" class="form-control" name="cliente" id="cliente" placeholder="Cliente"/>
            </div>

            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría:</label>
                <input type="text" class="form-control" name="categoria" id="categoria" placeholder="Categoría"/>
            </div>

            <div class="mb-3">
                <label for="url" class="form-label">URL:</label>
                <input type="text" class="form-control" name="url" id="url" placeholder="URL"/>
            </div>

            <button type="submit" class="btn btn-success">Agregar Registros</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a> 
        </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>


<!-- Aquí agregamos el pie de página del template -->
<?php include("../../templates/footer.php");?>