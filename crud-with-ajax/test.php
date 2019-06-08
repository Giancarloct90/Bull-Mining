<?php
    error_reporting(E_ERROR | E_PARSE);
    require('crud.php');
    
    // $contactos = $crud->getContactos();
    //     echo "***************** Contactos *****************";
    // $contactosTel = [];
    // foreach ($contactos as $key => $value) {
    //     echo "<br>";
    //     print_r($value['id_contacto']);
    //     echo "<br>";
    //     print_r($value['nombres']);
    //     echo "<br>";
    //     print_r($value['apellidos']);
    //     echo "<br>";
    //     print_r($value['direccion']);
    //     echo "<br>";
    //     $telefonos = $crud->getTelefonos($value['id_contacto']);
    //     foreach($telefonos as $telefono){
    //         echo "{$value[telefono]} - ";
    //         array_push($contactosTel, $value['telefono']);
    //     }
    //     echo "<br>";
    //     echo "**************** FIN DE CONTACTOS ************";
    // }
    // echo "<br>";
    // print_r($contactosTel);



    // $contactos = $crud->getContacto('104');
    // //print_r($contactos);
    // echo "<br>";
    // $telefonos = $crud->getTelefonos('104');
    // //print_r($telefonos);
    // echo "<br>";
    // foreach($telefonos as $telefono){
    //     array_push($contactos, $telefono['telefono']);
    // }
    // print_r($contactos);
    // echo "<br>";
    // echo "<table border='1'>";
    // echo "<tr>";
    //     echo "<th>ID</>";
    //     echo "<th>Nombre</th>";
    //     echo "<th>apelliho</th>";
    //     echo "<th>Direccion</th>";
    //     echo "<th>telefono</th>";
    // echo "</tr>";
    // echo "<tr>";
    //         echo "<td>{$contactos['id_contacto']}</td>";
    //         echo "<td>{$contactos['nombres']}</td>";
    //         echo "<td>{$contactos['apellidos']}</td>";
    //         echo "<td>{$contactos['direccion']}</td>";
    //         //echo "<td>{$contactos[0]}</td>";
    //         $size = sizeof($contactos) -5;
    //         $i =0;
    //         echo "<td>";
    //         for($i;$i <= $size; $i++){                
    //             echo "<li>{$contactos[$i]}</li>";
    //         }
    //         echo "</td>";
    // echo "<tr>";

    
    
    // echo "<>";

    // echo "</table>";

    function getContactos2(){
        $crud = new crud();
        $contactos = $crud->getContactos();
        $contactosConTel = array();
        foreach($contactos as $contacto){
            $telefonos = $crud->getTelefonos($contacto['id_contacto']);
            foreach($telefonos as $telefono){
                array_push($contacto, $telefono['telefono']);
            }
            array_push($contactosConTel, $contacto);

        }
        print_r($contactosConTel);
        echo ">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>";
        echo "<br>";
        echo "<table border='1'>";
        echo "<tr>";
            echo "<th>ID</>";
            echo "<th>Nombre</th>";
            echo "<th>apelliho</th>";
            echo "<th>Direccion</th>";
            echo "<th>telefono</th>";
        echo "</tr>";
        foreach($contactosConTel as $contacto){
            echo "<tr>";
            echo "<td>{$contacto['id_contacto']}</td>";
            echo "<td>{$contacto['nombres']}</td>";
            echo "<td>{$contacto['apellidos']}</td>";
            echo "<td>{$contacto['direccion']}</td>";
            //echo "<td>{$contactos[0]}</td>";
            $size = sizeof($contacto) -5;
            $i =0;
            echo "<td>";
            for($i;$i <= $size; $i++){                
                echo "<li>{$contacto[$i]}</li>";
            }
            echo "</td>";
        echo "<tr>";
        }
        echo "</table>";
    }
    getContactos2();
?>

