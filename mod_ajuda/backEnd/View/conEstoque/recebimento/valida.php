<?php include_once PATH.'/core/include.php';  
include_once "template/page/headerPageSimples.php";
    $_funcaBase = new FuncaoBase();
    
    $_saldo = new ControleSaldo();

    $_transferencia = new TransferenciaMaterial();

    
    if(isset($_SESSION['cesta'])){

        $_material = $_SESSION['cesta'];

    }

    print "<br>";
    $_txt_id_transferencia = isset($_POST['txt_id_transferencia']) ? $_POST['txt_id_transferencia'] : "";
    $_txt_dtChegada        = isset($_POST['txt_dtChegada'])        ? $_POST['txt_dtChegada']        : "";
    $_txt_hrChegada        = isset($_POST['txt_hrChegada'])        ? $_POST['txt_hrChegada']        : "";
    $_txt_responsavel      = isset($_POST['txt_responsavel'])      ? $_POST['txt_responsavel']      : "";
    $_txt_doc_resp         = isset($_POST['txt_doc_resp'])         ? $_POST['txt_doc_resp']         : "";
    $_txt_obs              = isset($_POST['txt_obs'])              ? $_POST['txt_obs']              : "";
    $_txt_baixa            = isset($_POST['txt_baixa'])            ? $_POST['txt_baixa']            : "";
    $_txt_motivo           = isset($_POST['txt_motivo'])           ? $_POST['txt_motivo']           : "";
    $_txt_id_dep_destino   = isset($_POST['txt_id_dep_destino'])   ? $_POST['txt_id_dep_destino']   : "";
    $_btn_enviar           = isset($_POST['btn_enviar'])           ? $_POST['btn_enviar']           : "";
    $_id_dep_origem        = isset($_POST['id_dep_origem'])        ? $_POST['id_dep_origem']           : "";

        // valida campo em branco
        $_campos = array("Numero Transferencia"=>$_txt_id_transferencia,
                            "Data Chegada"=>$_txt_dtChegada,       
                            "Hora Chegada"=>$_txt_hrChegada,       
                            "Nome Responsável"=>$_txt_responsavel,     
                            "Documento Responsável"=>$_txt_doc_resp);

        if($_funcaBase->campoBranco($_campos)){

            // efetiva o recebimento de materiais
            if($_transferencia->MaterialEfetivarReceber($_txt_id_transferencia, 
                                                        $_txt_responsavel,      
                                                        $_txt_doc_resp,         
                                                        $_txt_obs,              
                                                        $_txt_baixa,            
                                                        $_txt_motivo,
                                                        DataMysql::dataForm($_txt_dtChegada)." ".$_txt_hrChegada)){

                //lista com itens para fazer a transferencia de saldo de materiais
                $dados = $_transferencia->ListaItensTransferencia($_txt_id_transferencia);

               
                for ($i=0; $i < count($dados) ; $i++) { 

                    // realiza o crédito no saldo do deposito de destino
                    if($_saldo->CreditarSaldo($dados[$i]['id_produto'], $_txt_id_dep_destino, $dados[$i]['quantidade'])){

                        // realiza o registro do material que foi transferido
                        $_transferencia->RegistraMaterial($dados[$i]['id_produto'],
                                                         $dados[$i]['nome']."- ".$dados[$i]['descricao'],
                                                         DataMysql::dataForm($_txt_dtChegada),
                                                         "Transferencia entre Depositos",
                                                         "-",
                                                         $dados[$i]['quantidade'],
                                                         "'".Deposito::PegaNomeDeposito($_txt_id_dep_destino)."'",
                                                         $_id_dep_origem);
                    }
                    
                }
                
                Log::GravaLog("Recebimento de Transferencia de Material Nr: ".$_txt_id_transferencia, "aju_log");

                print "<script type=\"text/javascript\">";
                
                print "alert('Recebimento de materiais Realizada com Sucesso');";
                
                print "window.location = 'index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&controller=conestoque&action=recebmat&id=".$_txt_id_transferencia."';";
                print "</script>";
                
            }
        }