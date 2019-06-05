<?php
    require('crud.php');
    $crud = new crud();
    if($_GET){
        $action = $_GET["action"];
        if(function_exists($action)){
            call_user_func($action);
        }
    }
    function guardarContacto(){
        $nombres = $_POST["nombres"];
        $apellidos = $_POST["apellidos"];
        $direccion = $_POST["direccion"];
        $telefono = $_POST["telefonos"];
    }
    try {
        $crud->mysql->beginTransaction();
        $crud->setContacto($nombre, $apellidos, $direccion);
        $id_contacto = $crud->mysql->lastInsertId();
        $crud->setTelefonos($id_contacto,$telefono);
        $crud->mysql->commit();
        echo $id_contacto;
    } catch (PDO::Exception $th) {
        $crud->mysql->rollback();
        die("El contacto no pudo ser guardado");
    }
?>