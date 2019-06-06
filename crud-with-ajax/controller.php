<?php
    require('crud.php');
    if($_GET){
        $action = $_GET["action"];
        if(function_exists($action)){
            call_user_func($action);
        }
    }
    
    function guardarContacto(){
        $crud = new crud();
        $nombres = $_POST["txtNombre"];
        $apellidos = $_POST["txtApellido"];
        $direccion = $_POST["txtDireccion"];
        $telefono = $_POST["txtTelefono"];
        try {
            $crud->mysql->beginTransaction();
            $crud->setContacto($nombres, $apellidos, $direccion);
            $id_contacto = $crud->mysql->lastInsertId();
            $crud->setTelefonos($id_contacto,$telefono);
            $crud->mysql->commit();
            echo $id_contacto;
        } catch (PDOException $th) {
            $crud->mysql->rollback();
            die("El contacto no pudo ser guardado {$th}");
        }
    }
?>