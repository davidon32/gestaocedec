<?php 

try{
    $conn = new PDO('mysql:host=200.198.29.227;dbname=gestaocedec', 'usuario', 'usuario');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT * FROM aju_estoque WHERE saldo > 0";
    $result = $conn->query($sql);

    $sql_sec = "";

    while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
        $sql_sec .= "INSERT INTO aju_estoque_anterior (id_produto, id_deposito, saldo, data_saldo) VALUES ('".$linha['id_produto']."', '".$linha['id_deposito']."', '".$linha['saldo']."', '".date("Y-m-d")."'); ";
    }
    
    #insert Saldo Anterior tabela
    $result = $conn->query($sql_sec);
    
} catch (Exception $ex) {

}