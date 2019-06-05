<?php
require("mysql.php");
$db = new db();

if($_POST){
    print_r($_POST["txtId"]);
    $id_contacto = $_POST["txtId"];
    $nombre = $_POST["txtNombre"];
    $apellido = $_POST["txtApellido"];
    $direccion = $_POST["txtDireccion"];
    $telefono = $_POST["txtTelefono"];

    try {
        $db->mysql->beginTransaction();
        $post = $db->mysql->prepare("UPDATE contactos SET nombres = :nombre, apellidos = :apellido, direccion = :direccion WHERE id_contacto = :id_contacto");
        $post->bindParam(":id_contacto",$id_contacto,PDO::PARAM_STR);
        $post->bindParam(":nombre",$nombre,PDO::PARAM_STR);
        $post->bindParam(":apellido",$apellido,PDO::PARAM_STR);
        $post->bindParam(":direccion",$direccion,PDO::PARAM_STR);
        $post->execute();
        
        $post = $db->mysql->prepare("UPDATE telefonos SET telefono=:telefono WHERE id_contacto = :id_contacto");
        $post->bindParam(":id_contacto",$id_contacto,PDO::PARAM_STR);
        $post->bindParam(":telefono",$telefono,PDO::PARAM_STR);
        $post->execute();
        $db->mysql->commit();
        ?>
        <?php
        require('assets/head.php');
        ?>
        <div class="container text-center">
       
        
            <div class="alert alert-primary" role="alert">
                <h1>Se Actualizo con exito</h1><br>
                <h1>Por favor espere, Redireccionando... </h1><br>
                <br>
                <i class="fas fa-sync fa-spin fa-5x"></i>
                <br>
            </div>
            <div class="text-center">
            </div>
        
        

        </div>
        <script>
        setTimeout(()=>{
            window.location.replace("info.php");
        },4000);
        </script>
        <?php
    } catch (PDOException $th) {
        $db->mysql->rollback();
        print_r("ERORR{$th->getMessage()}");
    }
}
?>