<!-- Aquí agregamos la cabecera del template -->
<?php
    # Conexión a la base de datos
    include("../../bd.php");

    # Intrucción SQL para consulta
    $sql = $cn->prepare("SELECT * FROM tbl_entradas");
    $sql->execute();
    $listaEntradas = $sql->fetchAll(PDO::FETCH_ASSOC);

    # Instrucción para borrar registros de portafolio
    if(isset($_GET["txtID"])){
        $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "" ;

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

        # Instrucción para eliminar datos
        $sql = $cn->prepare("DELETE FROM tbl_entradas WHERE id = :id");
        $sql->bindParam(":id", $txtID);
        $sql->execute();
    }

    include("../../templates/header.php");
?>

<h1 class="display-5">Listando Entradas de Blog</h1>

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
                        <th scope="col">Fecha</th>
                        <th scope="col">Título</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach($listaEntradas as $le):?>
                    <tr class="">
                        <td><?php echo $le["id"];?></td>
                        <td><?php echo $le["fecha"];?></td>
                        <td><?php echo $le["titulo"];?></td>
                        <td><?php echo $le["descripcion"];?></td>
                        <td>
                            <img width="50" src="../../../assets/img/about/<?php echo $le['imagen'];?>" alt="img">
                        </td>
                        <td>
                            <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $le['id'];?>" role="button">Editar</a> 
                            |
                            <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $le['id'];?>" role="button">Eliminar</a> 
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