<!-- Aquí agregamos la cabecera del template -->
<?php
    # Conexión a la base de datos
    include("../../bd.php");

    # Intrucción SQL para consulta
    $sql = $cn->prepare("SELECT * FROM tbl_equipos");
    $sql->execute();
    $listaTeam = $sql->fetchAll(PDO::FETCH_ASSOC);

    # Instrucción para borrar registros de portafolio
    if(isset($_GET["txtID"])){
        $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "" ;

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

        # Instrucción para eliminar datos
        $sql = $cn->prepare("DELETE FROM tbl_equipos WHERE id = :id");
        $sql->bindParam(":id", $txtID);
        $sql->execute();
    }
    include("../../templates/header.php");
?>

<h1 class="display-5">Listando Colaboradores</h1>

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

                    <?php foreach($listaTeam as $lt):?>
                    <tr class="">
                        <td><?php echo $lt["id"];?></td>
                        <td><?php echo $lt["nombre_completo"];?></td>
                        <td><?php echo $lt["puesto"];?></td>
                        <td><?php echo $lt["facebook"];?></td>
                        <td><?php echo $lt["x"];?></td>
                        <td><?php echo $lt["linkedin"];?></td>
                        <td>
                            <img width="50" src="../../../assets/img/team/<?php echo $lt['imagen'];?>" alt="img">
                        </td>
                        <td>
                            <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $lt['id'];?>" role="button">Editar</a> 
                            |
                            <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $lt['id'];?>" role="button">Eliminar</a> 
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