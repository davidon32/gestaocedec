<?php include_once $_SERVER['DOCUMENT_ROOT'].'/core/include.php';?>
<?php
    $_liberacao = new Liberacao();

        $_txt_id_libera = isset($_POST['id_liberacao']) ? (is_numeric($_POST['id_liberacao']) ? $_POST['id_liberacao'] : "") : ""; 
        $_txt_motivo    = isset($_POST['txt_motivo'])    ? $_POST['txt_motivo']    : ""; 
        $_btn_cancela   = isset($_POST['btn_cancela'])   ? true                    : "";
        /* cancelamento de liberacao */
            if($_btn_cancela && !empty($_txt_id_libera) && !empty($_txt_motivo)){
            
                $permissaoCancelaPago = Usuario::getPermissaoAction("aju_permissao", "cancLibPaga");

                if($permissaoCancelaPago) {
                    if($_liberacao->cancelaLiberacao($_txt_id_libera, $_txt_motivo, true)){
                        Log::GravaLog("Cancelamento liberacao Nr : ".$_txt_id_libera, "aju_log");
                        print "sucesso";
                    }else {
                        print "erro";
                    }
                }else {
                    if($_liberacao->cancelaLiberacao($_txt_id_libera, $_txt_motivo, false)){
                        Log::GravaLog("Cancelamento liberacao Nr : ".$_txt_id_libera, "aju_log");
                        print "sucesso";
                    }else {
                        print "semPermissao";
                    }
                }
            }else {

                print "aqui";
                print "<script type=\"text/javascript\">";
                print "alert(\"Favor preencher os campos\");";
                print "history.back();";
                print "</script>";
            }
?>