<?php 


# deletar pmda cancelado
try{
    $conn = new PDO('mysql:host=200.198.29.229;dbname=gestaocedec', 'usuario', 'usuario');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "delete from pip_pmda where status = 8 and id_pmda > 0";
    $result = $conn->query($sql);

    
    
} catch (Exception $ex) {

}