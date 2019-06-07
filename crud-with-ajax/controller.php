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
        //print_r($_POST);
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

    function obtenerContactos(){
        $crud = new crud();
        if(!$_GET){
            die("no se recibio ningun dato");
        }else{ 
            try {
                echo json_encode($crud->getContactos());
            } catch (PDOException $th) {
                $th->getMessage();
            }

        }
    }

    function obtenerTelefonos(){
        $crud = new crud();
        print_r($_POST);
        $$id_contactos = $_POST("id_contacto") ;
        if(!$_POST){
            die("no se recibio ningun dato");
        }
        else{
            try {
                echo "Hello";
            } catch (PDOException $th) {
                $th->getMessage();
            }
        }
        getTelefonos($id_contacto);
    }
?>