<!-- Aquí agregamos la cabecera del template -->
<?php
    # Abriendo conexiónn a la base de datos
    include("../../bd.php");

    # Recuperando información almacenada en la tabla
    if(isset($_GET["txtID"])){
        $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";

        # Instrucción de consulta de la tabal
        $sql = $cn->prepare("SELECT * FROM tbl_portafolio WHERE id=:id");
        $sql->bindParam(":id", $txtID);
        $sql->execute();

        # Guardando la consulta en una variable
        $registro = $sql->fetch(PDO::FETCH_LAZY);

        # Guardando los datos de la tabla
        $titulo = $registro["titulo"];
        $subtitulo = $registro["subtitulo"];
        $imagen = $registro["imagen"];
        $descripcion = $registro["descripcion"];
        $cliente = $registro["cliente"];
        $categoria = $registro["categoria"];
        $url = $registro["url"];
    }

    # Actualizando los datos desde el formulario a la tabla
    if($_POST){
        # Recibiendo los datos los campos del formulario
        $titulo = (isset($_POST["titulo"])) ? $_POST["titulo"] : "";
        $subtitulo = (isset($_POST["subtitulo"])) ? $_POST["subtitulo"] : "";
        $descripcion = (isset($_POST["descripcion"])) ? $_POST["descripcion"] : "";
        $cliente = (isset($_POST["cliente"])) ? $_POST["cliente"] : "";
        $categoria = (isset($_POST["categoria"])) ? $_POST["categoria"] : "";
        $url = (isset($_POST["url"])) ? $_POST["url"] : "";

        # Intrucción SQL para actualziar
        $sql = $cn->prepare("UPDATE tbl_portafolio
            SET titulo = :titulo, subtitulo = :subtitulo,
            descripcion = :descripcion, cliente = :cliente, categoria = :categoria, url = :url
            WHERE id = :id
        ");

        # Vinculando las variables con los parametros de la sentencia
        $sql->bindParam(":titulo", $titulo);
        $sql->bindParam(":subtitulo", $subtitulo);
        $sql->bindParam(":descripcion", $descripcion);
        $sql->bindParam(":cliente", $cliente);
        $sql->bindParam(":categoria", $categoria);
        $sql->bindParam(":url", $url);
        $sql->bindParam(":id", $txtID);

        # Ejecutando consulta
        $sql->execute();

        # Paramestros para el renombrado de la imagen
        if($_FILES["imagen"]["tmp_name"] != ""){
            $imagen = (isset($_FILES["imagen"]["name"])) ? $_FILES["imagen"]["name"] : "";
            $fechaImagen = new DateTime();
            $nombreArchivoImagen = ($imagen != "") ? $fechaImagen->getTimestamp()."_".$imagen:"";

            $tmpImagen = $_FILES["imagen"]["tmp_name"];
            move_uploaded_file($tmpImagen, "../../../assets/img/portfolio/".$nombreArchivoImagen);

            # Elimininar la imagen
            # Intrucción SQL para consulta
            $sql = $cn->prepare("SELECT imagen FROM tbl_portafolio WHERE id = :id");
            $sql->bindParam(":id", $txtID);
            $sql->execute();
            $registroImagen = $sql->fetch(PDO::FETCH_LAZY);

            # Validando la existencia de la imagen
            if(isset($registroImagen["imagen"])){
                if(file_exists("../../../assets/img/portfolio/".$registroImagen["imagen"])){
                    unlink("../../../assets/img/portfolio/".$registroImagen["imagen"]);
                }
            }
        
            # Intrucción SQL para actualziar
            $sql = $cn->prepare("UPDATE tbl_portafolio SET imagen = :imagen WHERE id = :id");
            $sql->bindParam(":imagen", $nombreArchivoImagen);
            $sql->bindParam(":id", $txtID);
            $sql->execute();
        }
        
        # Redirección
        $mensaje = "Registro Actualizado";
        header("Location:index.php?mensaje=".$mensaje);
    }


    include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">Creando Datos de Portafolio</div>
    <div class="card-body">

        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="text" readonly class="form-control" name="txtID" id="txtID" value="<?php echo $txtID;?>"/>
            </div>

            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" value="<?php echo $titulo;?>"/>
            </div>

            <div class="mb-3">
                <label for="subtitulo" class="form-label">Subtítulo:</label>
                <input type="text" class="form-control" name="subtitulo" id="subtitulo" value="<?php echo $subtitulo;?>"/>
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen:</label>
                <img src="../../../assets/img/portfolio/<?php echo $imagen;?>" alt="imagen" width="50">
                <input type="file" class="form-control" name="imagen" id="imagen" value="<?php echo $imagen;?>"/>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" value="<?php echo $descripcion;?>"/>
            </div>

            <div class="mb-3">
                <label for="cliente" class="form-label">Cliente:</label>
                <input type="text" class="form-control" name="cliente" id="cliente" value="<?php echo $cliente;?>"/>
            </div>

            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría:</label>
                <input type="text" class="form-control" name="categoria" id="categoria" value="<?php echo $categoria;?>"/>
            </div>

            <div class="mb-3">
                <label for="url" class="form-label">URL:</label>
                <input type="text" class="form-control" name="url" id="url" value="<?php echo $url;?>"/>
            </div>

            <button type="submit" class="btn btn-success">Modificar Registros</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>

        </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>

<!-- Aquí agregamos el pie de página del template -->
<?php include("../../templates/footer.php");?>