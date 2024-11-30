<!-- Aquí agregamos la cabecera del template -->
<?php
    # Abriendo conexión a la base de datos
    include("../../bd.php");

    # Recuperando de consulta de datos
    if(isset($_GET["txtID"])){
        $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";

        # Intrucción SQL para consulta
        $sql = $cn->prepare("SELECT * FROM tbl_equipos WHERE id=:id");
        $sql->bindParam(":id", $txtID);
        $sql->execute();
        $registro = $sql->fetch(PDO::FETCH_LAZY);

        # Recepcionando los valores de los campos del formulario
        $nombre_completo =  $registro["nombre_completo"];
        $puesto =  $registro["puesto"];
        $facebook =  $registro["facebook"];
        $x =  $registro["x"];
        $linkedin =  $registro["linkedin"];
        $imagen =  $registro["imagen"];
    }

    # Actualizando los datos desde el formulario a la tabla
    if($_POST){
        # Recibiendo los datos los campos del formulario
        $nombre_completo = (isset($_POST["nombre_completo"])) ? $_POST["nombre_completo"] : "";
        $puesto = (isset($_POST["puesto"])) ? $_POST["puesto"] : "";
        $facebook = (isset($_POST["facebook"])) ? $_POST["facebook"] : "";
        $x = (isset($_POST["x"])) ? $_POST["x"] : "";
        $linkedin = (isset($_POST["linkedin"])) ? $_POST["linkedin"] : "";
        $imagen = (isset($_FILES["imagen"]["name"])) ? $_FILES["imagen"]["name"] : "";

        # Intrucción SQL para actualziar
        $sql = $cn->prepare("UPDATE tbl_equipos
            SET nombre_completo = :nombre_completo, puesto = :puesto, facebook = :facebook, x = :x, linkedin = :linkedin
            WHERE id = :id"
        );

        $sql->bindParam(":nombre_completo", $nombre_completo);
        $sql->bindParam(":puesto", $puesto);
        $sql->bindParam(":facebook", $facebook);
        $sql->bindParam(":x", var: $x);
        $sql->bindParam(":linkedin", $linkedin);
        $sql->bindParam(":id", $txtID);

        # Ejecutando consulta
        $sql->execute();

        # Paramestros para el renombrado de la imagen
        if($_FILES["imagen"]["tmp_name"] != ""){
            $imagen = (isset($_FILES["imagen"]["name"])) ? $_FILES["imagen"]["name"] : "";
            $fechaImagen = new DateTime();
            $nombreArchivoImagen = ($imagen != "") ? $fechaImagen->getTimestamp()."_".$imagen:"";

            $tmpImagen = $_FILES["imagen"]["tmp_name"];
            move_uploaded_file($tmpImagen, "../../../assets/img/team/".$nombreArchivoImagen);

            # Elimininar la imagen
            # Intrucción SQL para consulta
            $sql = $cn->prepare("SELECT imagen FROM tbl_equipos WHERE id = :id");
            $sql->bindParam(":id", $txtID);
            $sql->execute();
            $registroImagen = $sql->fetch(PDO::FETCH_LAZY);

            # Validando la existencia de la imagen
            if(isset($registroImagen["imagen"])){
                if(file_exists("../../../assets/img/team/".$registroImagen["imagen"])){
                    unlink("../../../assets/img/team/".$registroImagen["imagen"]);
                }
            }
        
            # Intrucción SQL para actualziar
            $sql = $cn->prepare("UPDATE tbl_equipos SET imagen = :imagen WHERE id = :id");
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

<h1 class="display-5">Creando Nuevo Colaborador</h1>

<div class="card">
    <div class="card-header">Formulario</div>

    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="text" readonly class="form-control" name="txtID" id="txtID" value="<?php echo $txtID;?>"/>
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen:</label>
                <img width="50" src="../../../assets/img/team/<?php echo $imagen;?>" alt="img">
                <input type="file" class="form-control" name="imagen" id="imagen" placeholder="Imagen"/>
            </div>

            <div class="mb-3">
                <label for="nombre_completo" class="form-label">Nombre Colaborador:</label>
                <input type="text" class="form-control" name="nombre_completo" id="nombre_completo" value="<?php echo $nombre_completo;?>"/>
            </div>
            
            <div class="mb-3">
                <label for="puesto" class="form-label">Puesto:</label>
                <input type="text" class="form-control" name="puesto" id="puesto" value="<?php echo $puesto;?>"/>
            </div>

            <div class="mb-3">
                <label for="facebook" class="form-label">URL Facebook:</label>
                <input type="text" class="form-control" name="facebook" id="facebook" value="<?php echo $facebook;?>"/>
            </div>

            <div class="mb-3">
                <label for="x" class="form-label">URL X:</label>
                <input type="text" class="form-control" name="x" id="x" value="<?php echo $x;?>"/>
            </div>

            <div class="mb-3">
                <label for="linkedin" class="form-label">URL linkedIn:</label>
                <input type="text" class="form-control" name="linkedin" id="linkedin" value="<?php echo $linkedin;?>"/>
            </div>
            
            <button type="submit" class="btn btn-success">Modificar Registros</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a> 
            
        </form>
    </div>

    <div class="card-footer text-muted">Sistema Administrador</div>
</div>

<!-- Aquí agregamos el pie de página del template -->
<?php include("../../templates/footer.php");?>