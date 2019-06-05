<?php
require('mysql.php');
class crud extends db{

    function __construnct(){
        parent::__construnct;
    }
    public function getContactos(){
        $contactos = $this->mysql->query("SELECT * FROM contactos");
        return $contactos->fetchAll();
    }
    
    public function setContacto($nombre, $apellido, $direccion){
        $pst = $this->mysql->prepare("INSERT INTO contacto VALUES (null, :nombres, :apellidos, :direccion):");
        $pst->bindParam(":nombres",$nombre,PDO::PARAM_STR);
        $pst->bindParam(":apellidos",$apellido,PDO::PARAM_STR);
        $pst->bindParam(":direccion",$direccion,PDO::PARAM_STR);
        return $pst->execute();

    }

    public function updateContacto($id_contacto, $nombre, $apellido, $direccion)
    {
        $pst = $this->mysql->prepare("UPDATE contacto set nombres=:nombres, apellidos=:apellidos, direccion=:direccion WHERE id_contacto = :id_contacto):");
        $pst->bindParam(":id_contacto",$id_contacto,PDO::PARAM_STR);
        $pst->bindParam(":nombres",$nombre,PDO::PARAM_STR);
        $pst->bindParam(":apellidos",$apellido,PDO::PARAM_STR);
        $pst->bindParam(":direccion",$direccion,PDO::PARAM_STR);
        return $pst->execute(); 
   }

   public function deleteContacto ($id_contacto){
       $pst = $this->mysql->prepare("DELETE contactos WHERE id_contacto = :id_contacto");
       $pst->bindParam(":id_contacto",$id_contacto,PDO::PARAM_STR);
       return $pst->execute();
   }

   public function getTelefonos($id_contacto){
    $telefonos = $this->mysql->query("SELECT * FROM telefonos WHERE id_contactos = :id_contactos");
    return $telefonos->fetchArray();
   }

   public function setTelefonos($id_contacto,$telefono){
       $pst = $this->mysql->prepare("INSERT INTO telefonos VALUES (null,:id_contacto,:telefono):");
       $pst->bindParam(":id_contacto",$id_contacto,PDO::PARAM_STR);
       $pst->bindParam(":telefono",$nombre,PDO::PARAM_STR);
       return $pst->execute();
   }
   public function updateTelefonos($id_contacto,$telefono){
        $pst = $this->mysql->prepare("UPDATE telefonos set id_contacto = :id_contacto");
   }
}
?>