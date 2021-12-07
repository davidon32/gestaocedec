<?php
    ob_start();
        setcookie("transferencia[id_material]",     $_POST['id_material'], time()+ (86400), "/");
        setcookie("transferencia[id_almoxarifado]", $_POST['id_almoxarifado'], time()+ (86400), "/");
        setcookie("transferencia[id_tp_pedido]",    $_POST['id_tp_pedido'], time()+ (86400), "/");
        setcookie("transferencia[saldo]",           $_POST['saldo'], time()+ (86400), "/");
        setcookie("transferencia[val_unit]",        $_POST['val_unit'], time()+ (86400), "/");
        setcookie("transferencia[id_nota]",        $_POST['id_nota'], time()+ (86400), "/");
        
        /*setcookie("transferencia[id_material]",    null, -1, '/');
        setcookie("transferencia[id_almoxarifado]",null, -1, '/');
        setcookie("transferencia[id_tp_pedido]",   null, -1, '/');
        setcookie("transferencia[saldo]",          null, -1, '/');
        setcookie("transferencia[val_unit]",       null, -1, '/');
        setcookie("transferencia[id_nota]",        null, -1, '/');*/
    ob_end_clean();  
    
