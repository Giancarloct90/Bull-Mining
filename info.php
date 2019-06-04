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
        ?>
        <br>
        <br><br>
        <div class="container">
        <h1>Nuevo Contacto</h1>
        <form action="guardarContacto.php" method="post">
            <div class="col-6">
            
            <input type="text" name="txtNombre" class="form-control" placeholder="Nombre" required="true"><br>
            <input type="text" name="txtApellido" class="form-control" placeholder="Apellido" required="true"><br>
            <input type="text" name="txtDireccion" class="form-control" placeholder="Direccion" required="true"><br>
            <input type="text" name="txtTelefono" class="form-control" placeholder="Telefono" required="true"><br>
            <input type="submit" class="btn btn-primary" style="width: 49%;" value="Guardar">
            <input type="reset" class="btn btn-secondary" style="width: 49%;" value="Limpiar">
            </div>
        </form>
        <br><br>
        <h1>Contactos</h1>
        <?php 
                require("mysql.php");
                $db = new db();
                
                $contactos = $db->mysql->query("SELECT * FROM contactos;");
                // $cont = $contactos->fetch();
                
                
            if(!($contactos->rowCount() > 0) ){
                
                ?>
               <div class="alert alert-primary" role="alert">
                No hay Contactos registrados.
                </div>
                <?php
            }else{
                ?>       
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%"> 
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Telefonos</th>
                    <th scope="col" colspan="2">Opciones</th>
                    
                </tr>
            </thead>
            <tbody>
                
                <?php
    

    
}
foreach($contactos as $contacto){
    
    echo "<tr>";
    echo  "<td>{$contacto['id_contacto']}</td>";
    echo  "<td>{$contacto['nombres']}</td>";
    echo  "<td>{$contacto['apellidos']}</td>";
    echo  "<td>{$contacto['direccion']}</td>";
    echo "<td> ";
    $telefonos = $db->mysql->query("SELECT telefono FROM telefonos WHERE id_contacto = {$contacto['id_contacto']}");
    foreach($telefonos as $telefono){
        echo "<li>{$telefono['telefono']}</li>";
    }
    
    echo "</td> ";
    echo "<td><a href='modificacionContacto.php?id_contacto={$contacto['id_contacto']}'> <i class='fas fa-pencil-alt'></i>Update</a></td>";
    echo "<td><a href='eliminarContacto.php?id_contacto={$contacto['id_contacto']}'><i class='fas fa-trash-alt'></i>Delete</a></td>";
    
    
    echo "</tr>";
    
}
echo "</tbody>";
echo "</table>";
?>


</div>
<?php
    require('assets/footer.php');
?>
<script src="assets/js/index.js"></script>
</body>
</html>