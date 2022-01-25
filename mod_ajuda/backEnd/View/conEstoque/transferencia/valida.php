<?php include_once PATH.'/core/include.php';
include_once "template/page/headerPageSimples.php";
    
    $_funcaBase = new FuncaoBase();
    
    $_saldo = new ControleSaldo();

    $_transferencia = new TransferenciaMaterial();

     if(isset($_SESSION['cesta'])){

        $_material = $_SESSION['cesta'];
       
    }

        $_txt_dep_origem       = isset($_POST['id_dep_origem'])          ? $_POST['id_deposito']              : "" ;
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
        
        $_opcao = isset($_POST['opcao']) ? $_POST['opcao'] : "";
        

    if($_opcao == "transferir") {

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

                        $id_transferencia = $_transferencia->getUltimoId();
                        
                    for ($i=0; $i < $_tot_cesta ; $i++) { 

                        #@ debita saldo deposito origem
                        $_transferencia->DebitarOrigem($_material[$i][0], $_material[$i][1], $_material[$i][3]);
                        

                        #@ Lanca os itens da tranferencia tabela aju_item_transf
                        $_transferencia->LancaItemTransferencia($id_transferencia, $_material[$i][1], $_material[$i][2], $_material[$i][3]);

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
                                      
                    Log::GravaLog("Realizada Transferencia de materiais Nr : ".$id_transferencia, "aju_log");

                    print "<script type='text/javascript'>";

                    print "alert('Transferência Realizada Com Sucesso !');";
                    
                    print "window.location = '?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&controller=relatorio&action=rec_transf_mat&id=".$id_transferencia."';";
                    
                    print "</script>";


                }else {

                    print "<script type='text/javascript'>";

                    print "alert('Nenhum Material Foi Selecionado para Transferência !');";
                    
                    print "history.back();";
                    
                    print "</script>";

                }
            }
        }

}elseif($_opcao == "cancela") {
    

        $_txt_id_transferencia = isset($_POST['txt_id_transferencia']) ? $_POST['txt_id_transferencia'] : ""; 
        //$_txt_dt_cancela      = isset($_POST['txt_dt_cancela'])      ? $_POST['txt_dt_cancela'] : ""; 
        $_txt_dt_cancela      = date("d/m/Y"); 
        
        $_txt_observacao      = isset($_POST['txt_observacao'])      ? $_POST['txt_observacao'] : ""; 
        $_btn_enviar          = isset($_POST['btn_enviar'])          ? true : ""; 
    
        if($_btn_enviar){

            $_campos = array("Número Transferência"=>$_txt_id_transferencia,
                             "Data"=>$_txt_dt_cancela,
                             "Observação"=>$_txt_observacao);

            # busca itens para cancelamento de transferencia
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

                    foreach ($_dados as $value) { 

                        #@ marca nos itens da transferencia como cancelado
                        // na tabela aju_item_transf (codigo situacao 2 - cancelado)

                        $_transferencia->CancelaItemTransferencia($value['id_transferencia']);

                        #@ credita o saldo na origem
                        $_saldo->CreditarSaldo($value['id_produto'], $value['id_dep_origem'], $value['quantidade']);                       

                    }
                    
                    Log::GravaLog("Cancelamento da Transferencia de Nr: ".$value['id_transferencia'] , "aju_log");
                    
                    print "<script type='text/javascript'>";

                    print "alert('Transferência Realizada Com Sucesso !');";
                    
                    print "window.location = '".FuncaoBase::geraLink("ajuda", "conestoque", "idxtransf")."';";
                    
                    print "</script>";
                }
            }
        }
    
    
}
       
?>