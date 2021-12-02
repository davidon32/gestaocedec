<?php

    ob_start();
        setcookie("transferencia[id_material]",     $_POST['id_material'], time()+ (86400), "/");
        setcookie("transferencia[id_almoxarifado]", $_POST['id_almoxarifado'], time()+ (86400), "/");
        setcookie("transferencia[id_tp_pedido]",    $_POST['id_tp_pedido'], time()+ (86400), "/");
        setcookie("transferencia[saldo]",           $_POST['saldo'], time()+ (86400), "/");
        setcookie("transferencia[val_unit]",        $_POST['val_unit'], time()+ (86400), "/");
        setcookie("transferencia[val_total]",        $_POST['val_total'], time()+ (86400), "/");
        setcookie("transferencia[id_nota]",        $_POST['id_nota'], time()+ (86400), "/");
    ob_end_clean();  
    
