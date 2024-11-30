<!-- Aquí agregamos la cabecera del template -->
<?php
    # Conexión a la base de datos
    include("../../bd.php");

    # Instrucción para borrar registros de portafolio
    if(isset($_GET["txtID"])){
        $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "" ;

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

        # Instrucción para eliminar datos
        $sql = $cn->prepare("DELETE FROM tbl_portafolio WHERE id = :id");
        $sql->bindParam(":id", $txtID);
        $sql->execute();
    }

    # Intrucción SQL para consulta
    $sql = $cn->prepare("SELECT * FROM tbl_portafolio");
    $sql->execute();
    $listaPortafolio = $sql->fetchAll(PDO::FETCH_ASSOC);

    include("../../templates/header.php");
?>

<h1 class="display-5">Listando Datos del Portafolio</h1>

<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Registro</a>     
    </div>

    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Título</th>
                        <th scope="col">Subtítulo</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach($listaPortafolio as $lp):?>
                    <tr class="">
                        <td><?php echo $lp["id"];?></td>
                        <td><?php echo $lp["titulo"];?></td>
                        <td><?php echo $lp["subtitulo"];?></td>

                        <td>
                            <img src="../../../assets/img/portfolio/<?php echo $lp['imagen'];?>" alt="imagen" width="50">
                        </td>

                        <td><?php echo $lp["descripcion"];?></td>
                        <td><?php echo $lp["cliente"];?></td>
                        <td><?php echo $lp["categoria"];?></td>
                        <td>
                            <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $lp['id'];?>" role="button">Editar</a> 
                            |
                            <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $lp['id'];?>" role="button">Eliminar</a> 
                        </td>
                    </tr>
                    <?php endforeach;?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Aquí agregamos el pie de página del template -->
<?php include("../../templates/footer.php");?>