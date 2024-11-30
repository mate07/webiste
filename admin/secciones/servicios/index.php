<!-- Aquí agregamos la cabecera del template -->
<?php
    # Abriendo la conexión a la base de datos
    include("../../bd.php");

    # Instrucción para consultar datos a la tabla
    $sql = $cn->prepare("SELECT * FROM `tbl_servicios`");

    # Ejecutar la sentencia y guardar el resultado en una variable
    $sql->execute();
    $listaServicios = $sql->fetchAll(PDO::FETCH_ASSOC);

    # Instrucción para borrar registros de servicios
    if(isset($_GET["txtID"])){
       $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "" ;

       # Instrucción para eliminar datos
       $sql = $cn->prepare("DELETE FROM tbl_servicios WHERE id=:id");

       # Vinculando variable a parametro
       $sql->bindParam(":id", $txtID);

       # Ejecutando la sentencia
       $sql->execute();
    }

    include("../../templates/header.php");
?>

<h1 class="display-5">Listando Servicios</h1>

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
                        <th scope="col">Ícono</th>
                        <th scope="col">Título</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach($listaServicios as $ls):?>
                    <tr class="">
                        <td><?php echo$ls["id"];?></td>
                        <td><?php echo $ls["icono"];?></td>
                        <td><?php echo $ls["titulo"];?></td>
                        <td><?php echo $ls["descripcion"];?></td>
                        <td>
                            <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $ls['id'];?>" role="button">Editar</a> 
                            |
                            <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $ls['id'];?>" role="button">Eliminar</a> 
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