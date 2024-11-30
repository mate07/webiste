<!-- Aquí agregamos la cabecera del template -->
<?php
    # Abriendo conexión a la base de datos
    include("../../bd.php");

    # Recuperando de consulta de datos
    if(isset($_GET["txtID"])){
        $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";

        # Intrucción SQL para consulta
        $sql = $cn->prepare("SELECT * FROM tbl_entradas WHERE id=:id");
        $sql->bindParam(":id", $txtID);
        $sql->execute();
        $registro = $sql->fetch(PDO::FETCH_LAZY);

        # Recepcionando los valores de los campos del formulario
        $fecha =  $registro["fecha"];
        $titulo =  $registro["titulo"];
        $descripcion =  $registro["descripcion"];
        $imagen =  $registro["imagen"];
    }

    # Actualizando los datos desde el formulario a la tabla
    if($_POST){
        # Recibiendo los datos los campos del formulario
        $fecha = (isset($_POST["fecha"])) ? $_POST["fecha"] : "";
        $titulo = (isset($_POST["titulo"])) ? $_POST["titulo"] : "";
        $descripcion = (isset($_POST["descripcion"])) ? $_POST["descripcion"] : "";

        # Intrucción SQL para actualziar
        $sql = $cn->prepare("UPDATE tbl_entradas
            SET fecha = :fecha, titulo = :titulo, descripcion = :descripcion
            WHERE id = :id"
        );

        $sql->bindParam(":fecha", $fecha);
        $sql->bindParam(":titulo", $titulo);
        $sql->bindParam(":descripcion", $descripcion);
        $sql->bindParam(":id", $txtID);

        # Ejecutando consulta
        $sql->execute();

        # Paramestros para el renombrado de la imagen
        if($_FILES["imagen"]["tmp_name"] != ""){
            $imagen = (isset($_FILES["imagen"]["name"])) ? $_FILES["imagen"]["name"] : "";
            $fechaImagen = new DateTime();
            $nombreArchivoImagen = ($imagen != "") ? $fechaImagen->getTimestamp()."_".$imagen:"";

            $tmpImagen = $_FILES["imagen"]["tmp_name"];
            move_uploaded_file($tmpImagen, "../../../assets/img/about/".$nombreArchivoImagen);

            # Elimininar la imagen
            # Intrucción SQL para consulta
            $sql = $cn->prepare("SELECT imagen FROM tbl_entradas WHERE id = :id");
            $sql->bindParam(":id", $txtID);
            $sql->execute();
            $registroImagen = $sql->fetch(PDO::FETCH_LAZY);

            # Validando la existencia de la imagen
            if(isset($registroImagen["imagen"])){
                if(file_exists("../../../assets/img/about/".$registroImagen["imagen"])){
                    unlink("../../../assets/img/about/".$registroImagen["imagen"]);
                }
            }
        
            # Intrucción SQL para actualziar
            $sql = $cn->prepare("UPDATE tbl_entradas SET imagen = :imagen WHERE id = :id");
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

<h1 class="display-5">Creando Entrada de Blog</h1>

<div class="card">
    <div class="card-header">Formulario</div>

    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="text" readonly class="form-control" name="txtID" id="txtID" value="<?php echo $txtID;?>"/>
            </div>

            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo $fecha;?>"/>
            </div>
            
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" value="<?php echo $titulo;?>"/>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" value="<?php echo $descripcion;?>"/>
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen:</label>
                <img width="50" src="../../../assets/img/about/<?php echo $imagen;?>" alt="img">
                <input type="file" class="form-control" name="imagen" id="imagen" placeholder="Imagen"/>
            </div>

            <button type="submit" class="btn btn-success">Modificar Registros</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a> 
            
        </form>
    </div>

    <div class="card-footer text-muted">Sistema Administrador</div>
</div>

<!-- Aquí agregamos el pie de página del template -->
<?php include("../../templates/footer.php");?>