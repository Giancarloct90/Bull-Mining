<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require('assets/head.php');
    ?>
</head>
<body>
<?php
    require('assets/navbar.php');
    require('mysql.php');
    $db = new db();
    try {
        $id_contacto = $_GET["id_contacto"];
        $datosContacto = $db->mysql->prepare('SELECT * FROM contactos WHERE id_contacto = :id_contacto');
        $datosContacto->bindParam(":id_contacto",$id_contacto, PDO::PARAM_INT);
        $datosContacto->execute();
        $contacto = $datosContacto->fetch();

        $telefonos = $db->mysql->prepare('SELECT * FROM telefonos WHERE id_contacto = :id_contacto');
        $telefonos->bindParam(":id_contacto", $id_contacto, PDO::PARAM_STR);
        $telefonos->execute();
        $telefono = $telefonos->fetch();
    } catch (PDOException $th) {
        print_r($th.getMessage());
    }
?>

<br>
<div class="container">
<h1>Actulizar</h1>

<form action="actualizarContacto.php" method="post">
            <div class="col-6">
            <input type="text" name="txtId" class="form-control"  value="<?php echo $id_contacto?>" required="true"><br>            
            <input type="text" name="txtNombre" class="form-control" value="<?php echo $contacto['nombres']?>" required="true"><br>
            <input type="text" name="txtApellido" class="form-control" value="<?php echo $contacto['apellidos']?>" required="true"><br>
            <input type="text" name="txtDireccion" class="form-control" value="<?php echo $contacto['direccion']?>" required="true"><br>
            <input type="text" name="txtTelefono" class="form-control"  value="<?php echo $telefono['telefono']?>" required="true"><br>
            <input type="submit" class="btn btn-primary" style="width: 49%;" value="Actualizar">
            <input type="reset" class="btn btn-secondary" style="width: 49%;" value="Limpiar">
            </div>
 </form>
</div>
<?php
    require('assets/footer.php');
?>
</body>
</html>