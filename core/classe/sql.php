<?php

    function QueryBD($_tipo, $_tabela, $_campos, $_parametro){
        
        $sql = $_tipo." ".$_campos." from ".$_tabela;
        
        $result = mysql_query($query);
        
        //print $sql;       
        
    }
    QueryBD('select', 'cliente', 'id_cliente, nome', 'demetrio');


?>