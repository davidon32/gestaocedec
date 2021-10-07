<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";

    $_conexao = new ConexaoMysql();

    $_login = new Login();

    $_login->logado();
    
    $_funcaBase = new FuncaoBase();
    
    $_saldo = new ControleSaldo();

    $_transferencia = new TransferenciaMaterial();

    if(isset($_SESSION['cesta'])){

        $_material = $_SESSION['cesta'];

    }

        $_txt_dep_destino      = isset($_POST['id_deposito'])          ? $_POST['id_deposito']              : "" ;
        $_txt_dt_transferencia = isset($_POST['txt_dt_transferencia']) ? $_POST['txt_dt_transferencia']     : "" ;
        $_txt_motorista        = isset($_POST['txt_motorista'])        ? strtoupper($_POST['txt_motorista']): "" ;
        $_txt_veiculo          = isset($_POST['txt_veiculo'])          ? strtoupper($_POST['txt_veiculo'])  : "" ;
        $_txt_placa            = isset($_POST['txt_placa'])            ? $_POST['txt_placa']                : "" ;
        $_txt_saida            = isset($_POST['txt_saida'])            ? $_POST['txt_saida']                : "" ;
        $_txt_hora_saida       = isset($_POST['txt_hora_saida'])       ? $_POST['txt_hora_saida']           : "" ;
        $_txt_chegada          = isset($_POST['txt_chegada'])          ? $_POST['txt_chegada']              : "" ;
        $_txt_hora_chegada     = isset($_POST['txt_hora_chegada'])     ? $_POST['txt_hora_chegada']         : "" ;
        $_btn_enviar           = isset($_POST['btn_enviar'])           ? true                               : "" ;
        
        $_opcao = isset($_GET['opcao']) ? $_GET['opcao'] : "";
        
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo TITULO; ?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="/js/funcaobase.js"></script>
</head>

<body>
    
<?php    


if($_opcao == "transferir") {


        //var_dump($_POST);

        //var_dump($_SESSION);

        $_campos =  array("Deposito"=>$_txt_dep_destino,
                            "Data Transferencia"=>$_txt_dt_transferencia,
                            "Nome Motorista"=>$_txt_motorista,
                            "Veículo"=>$_txt_veiculo,
                            "Placa"=>$_txt_placa,      
                            "Data Saida"=>$_txt_saida,
                            "Data Chegada"=>$_txt_chegada);

        if($_btn_enviar) {

                /* $_SESSION['cesta'][0] => 
                0 => string '5' - ID_DEPOSITO ORIGEM
                1 => string '1' - ID_PRODUTO
                2 => string '-' - DESCRICAO
                3 => string '10'- QUANTIDADE */

            if(FuncaoBase::campoBranco($_campos)){

                $_tot_cesta = count($_material);

                //var_dump($_tot_cesta);

                if($_tot_cesta > 0){

                    #@ lanca na tabela ajuda_transferencia
                        $_transferencia->CadastraTransferencia(DataMysql::dataForm($_txt_dt_transferencia),
                                                                $_txt_motorista,
                                                                $_txt_veiculo,
                                                                $_txt_placa,
                                                                DataMysql::dataForm($_txt_saida)." ".$_txt_hora_saida,
                                                                DataMysql::dataForm($_txt_chegada)." ".$_txt_hora_chegada,
                                                                $_txt_dep_destino,
                                                                0,
                                                                $_material[0][0]);

                        $_id_transferencia = $_transferencia->getUltimoId();

                    for ($i=0; $i < $_tot_cesta ; $i++) { 

                        

                        #@ debita saldo deposito origem
                        $_transferencia->DebitarOrigem($_material[$i][0], $_material[$i][1], $_material[$i][3]);

                        #@ Lanca os itens da tranferencia tabela aju_item_transf
                        $_transferencia->LancaItemTransferencia($_id_transferencia, $_material[$i][1], $_material[$i][2], $_material[$i][3]);


                        /*$_gerTransito->Transito($_material[1],
                                                $_material[0],
                                                $_txt_dep_destino,
                                                $_material[3],
                                                $_txt_veiculo,
                                                $_txt_motorista,
                                                $_txt_placa,
                                                $_txt_saida);*/
                    }
                    #@ limpa a cesta
                    unset($_SESSION['cesta']);
                    
                    $id_transferencia = $_transferencia->getUltimoId();
                    
                    Log::GravaLog("Realizada Transferencia de materiais Nr : ".$id_transferencia, "aju_log");

                    print "<script type='text/javascript'>";

                    print "alert('Transferência Realizada Com Sucesso !');";
                    
                    print "window.location = 'index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=&modulo=ajuda&secao=transferencia&acao=guia_transferencia';";
                    
                    print "</script>";


                }else {

                    print "<script type='text/javascript'>";

                    print "alert('Nenhum Material Foi Selecionado para Transferência !');";
                    
                    print "history.back();";
                    
                    print "</script>";

                }
            }
        }

}elseif($_opcao == "cancelar") {
    
    //var_dump($_POST);

        $_txt_id_transferencia = isset($_POST['txt_id_transferencia']) ? $_POST['txt_id_transferencia'] : ""; 
        //$_txt_dt_cancela      = isset($_POST['txt_dt_cancela'])      ? $_POST['txt_dt_cancela'] : ""; 
        $_txt_dt_cancela      = date("d/m/Y"); 
        
        $_txt_observacao      = isset($_POST['txt_observacao'])      ? $_POST['txt_observacao'] : ""; 
        $_btn_enviar          = isset($_POST['btn_enviar'])          ? true : ""; 
    
        if($_btn_enviar){

            $_campos = array("Número Transferência"=>$_txt_id_transferencia,
                             "Data"=>$_txt_dt_cancela,
                             "Observação"=>$_txt_observacao);

            $_dados = $_transferencia->ListaItemTransferenciaCancela($_txt_id_transferencia);

            /*
                $_dados[] = 0 - id_transferencia
                            1 - id_produto
                            2 - id dep destino
                            3 - quantidade
             *              4 - id dep origem

            */

            if($_funcaBase->campoBranco($_campos)){

                #@ marca como cancelado na tabela aju_transferencia
                if($_transferencia->CancelaTransferencia($_txt_id_transferencia,
                                                      $_txt_dt_cancela,
                                                      $_txt_observacao)){

                    for ($i=0; $i < count($_dados); $i++) { 

                        #@ marca nos itens da transferencia como cancelado
                        // na tabela aju_item_transf (codigo situacao 2 - cancelado)
                        $_transferencia->CancelaItemTransferencia($_dados[$i][0]);

                        #@ credita o saldo na origem
                        $_saldo->CreditarSaldo($_dados[$i][1], $_dados[$i][4], $_dados[$i][3]);
                        

                    }
                    
                    Log::GravaLog("Cancelamento da Transferencia de Nr: ".$_dados[0][0] , "aju_log");
                    
                    print "Cancelamento Realizado Com Sucesso !<br />";
                    print "<a class=\"btn\" href=\"javascript: window.close();\">Voltar<a/>";
                }
            }
        }
    
    
}
       
?>