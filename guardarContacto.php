<?php
if($_POST){

    require("mysql.php");
    $db = new db();
   
    $nombre =$_POST["txtNombre"];
    $apellido = $_POST["txtApellido"];
    $direccion = $_POST["txtDireccion"];
    $telefono = $_POST["txtTelefono"];
    try {
        $db->mysql->beginTransaction();
        $pst = $db->mysql->prepare("INSERT INTO contactos VALUES(null, :nombres, :apellidos, :direccion)");
        $pst->bindParam(":nombres", $nombre, PDO::PARAM_STR);
        $pst->bindParam(":apellidos", $apellido, PDO::PARAM_STR);
        $pst->bindParam(":direccion",$direccion, PDO::PARAM_STR);
        $pst->execute();
        
        $id_contacto = $db->mysql->lastInsertId();
        $pst = $db->mysql->prepare("INSERT INTO telefonos VALUES(null,{$id_contacto},{$telefono});");
        $pst->execute();
        $db->mysql->commit();
        ?>
        <?php
        require('assets/head.php');
        ?>
        <div class="container text-center">
            <div class="alert alert-primary" role="alert">
                <h1>Se Guardo con exito</h1><br>
                <h2>Por favor espere, Redireccionando... </h2><br>
                <br>
                <i class="fas fa-sync fa-spin fa-4x"></i>
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
        echo "Hubo un error{$th}";
        echo "hello";
    }
}
?>