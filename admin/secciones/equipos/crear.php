<!-- Aquí agregamos la cabecera del template -->
<?php
    # Conexión a la base de datos
    include("../../bd.php");

    # Agregar una validación para la recepción de datos del formulario
    if($_POST){
        # Recibiendo los datos los campos del formulario
        $nombre_completo = (isset($_POST["nombre_completo"])) ? $_POST["nombre_completo"] : "";
        $puesto = (isset($_POST["puesto"])) ? $_POST["puesto"] : "";
        $facebook = (isset($_POST["facebook"])) ? $_POST["facebook"] : "";
        $x = (isset($_POST["x"])) ? $_POST["x"] : "";
        $linkedin = (isset($_POST["linkedin"])) ? $_POST["linkedin"] : "";
        $imagen = (isset($_FILES["imagen"]["name"])) ? $_FILES["imagen"]["name"] : "";


        # Paramestros para el renombrado de la imagen
        $fechaImagen = new DateTime();
        $nombreArchivoImagen = ($imagen != "") ? $fechaImagen->getTimestamp()."_".$imagen:"";
        $tmpImagen = $_FILES["imagen"]["tmp_name"];
        if($tmpImagen  != ""){
            move_uploaded_file($tmpImagen, "../../../assets/img/team/".$nombreArchivoImagen);
        }

        # Creando instrucción de insercción de datos
        $sql = $cn->prepare(
            "INSERT INTO `tbl_equipos` (`id`, `imagen`, `nombre_completo`, `puesto`, `facebook`, `x`, `linkedin`) 
                    VALUES (NULL, :imagen, :nombre_completo, :puesto, :facebook, :x, :linkedin);"
        );

        # Vinculando las variables con los parametros de la sentencia
        $sql->bindParam(":nombre_completo", $nombre_completo);
        $sql->bindParam(":puesto", $puesto);
        $sql->bindParam(":facebook", $facebook);
        $sql->bindParam(":x", $x);
        $sql->bindParam(":linkedin", $linkedin);
        $sql->bindParam(":imagen", $nombreArchivoImagen);
        
        # Ejecutando consulta
        $sql->execute();
    }

    include("../../templates/header.php");
?>

<h1 class="display-5">Creando Nuevo Colaborador</h1>

<div class="card">
    <div class="card-header">Formulario</div>

    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen:</label>
                <input type="file" class="form-control" name="imagen" id="imagen" placeholder="Imagen"/>
            </div>

            <div class="mb-3">
                <label for="nombre_completo" class="form-label">Nombre Colaborador:</label>
                <input type="text" class="form-control" name="nombre_completo" id="nombre_completo" placeholder="Nombre Colaborador"/>
            </div>
            
            <div class="mb-3">
                <label for="puesto" class="form-label">Puesto:</label>
                <input type="text" class="form-control" name="puesto" id="puesto" placeholder="Puesto"/>
            </div>

            <div class="mb-3">
                <label for="facebook" class="form-label">URL Facebook:</label>
                <input type="text" class="form-control" name="facebook" id="facebook" placeholder="URL Facebook"/>
            </div>

            <div class="mb-3">
                <label for="x" class="form-label">URL X:</label>
                <input type="text" class="form-control" name="x" id="x" placeholder="URL X"/>
            </div>

            <div class="mb-3">
                <label for="linkedin" class="form-label">URL linkedIn:</label>
                <input type="text" class="form-control" name="linkedin" id="linkedin" placeholder="URL linkedIn"/>
            </div>
            
            <button type="submit" class="btn btn-success">Agregar Registros</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a> 
            
        </form>
    </div>

    <div class="card-footer text-muted">Sistema Administrador</div>
</div>

<!-- Aquí agregamos el pie de página del template -->
<?php include("../../templates/footer.php");?>