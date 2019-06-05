<?php
    if($_GET["id_contacto"]){
        $id_contacto = $_GET["id_contacto"];
        require('mysql.php');
        $db = new db();
        try {
            $db->mysql->beginTransaction();
            
            $post = $db->mysql->prepare("DELETE FROM telefonos WHERE id_contacto = :id_contacto");
            $post->bindParam(":id_contacto",$id_contacto,PDO::PARAM_STR);
            $post->execute();

            $post = $db->mysql->prepare("DELETE FROM contactos WHERE id_contacto = :id_contacto");
            $post->bindParam(":id_contacto",$id_contacto,PDO::PARAM_STR);
            $post->execute();

            $db->mysql->commit();
            ?>
            <?php
            require('assets/head.php');
            ?>
            <div class="container text-center">
                <div class="alert alert-danger" role="alert">
                    <h1>Se Borro con exito</h1><br>
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
            print_r($th->getMessage());
        }

    }
    
?>