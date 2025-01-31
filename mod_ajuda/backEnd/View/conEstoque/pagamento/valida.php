<?php include_once $_SERVER['DOCUMENT_ROOT'].'/core/include.php';

    $_compdec = new Compdec();

    $_funcaoBase = new FuncaoBase();
    
    $_pagamento = new Pagamento();


    if($_POST['opcao'] == "pagamento") {
     
        #@ variaveis do post
        $_nRecibo   = 0;
        $_nLibera   = isset($_POST['nLibera'])      ? $_POST['nLibera']                                     : "";
        $_dtLibera  = isset($_POST['dtLibera'])     ? $_POST['dtLibera']                                    : "";
        $_dtPgto    = isset($_POST['dtPgto'])       ? htmlentities(htmlspecialchars($_POST['dtPgto']))      : "";
        $_benef     = isset($_POST['beneficiario']) ? $_POST['beneficiario']                                : "";
        $_endereco  = isset($_POST['endereco'])     ? $_POST['endereco']                                    : "";
        $_bairro    = isset($_POST['bairro'])       ? $_POST['bairro']                                      : "";
        $cpfCnpjDest= isset($_POST['cpfCnpj'])       ? $_POST['cpfCnpj']                                    : "";

        $_resp      = isset($_POST['responsavel'])  ? htmlentities(htmlspecialchars($_POST['responsavel'])) : "";
        $_nDoc      = isset($_POST['nDoc'])         ? htmlentities(htmlspecialchars($_POST['nDoc']))        : "";
        $_dtLimite  = isset($_POST['dtLimite'])     ? $_POST['dtLimite']                                    : "";
        $_veiculo   = isset($_POST['veiculo'])      ? $_POST['veiculo']                                     : "";
        $_obs       = isset($_POST['obs'])          ? $_POST['obs']                                         : "";
        $_n_end_resp= isset($_POST['numero'])       ? $_POST['numero']                                      : "";
        $_municipio = isset($_POST['municipio'])    ? $_POST['municipio']                                   : "";
        $_cpfResp   = isset($_POST['cpfResp'])      ? $_POST['cpfResp']                                     : "";
        $_placa     = isset($_POST['placa'])        ? $_POST['placa']                                       : "";
        $_tel_dest  = isset($_POST['tel_dest'])     ? $_POST['tel_dest']                                    : "";
        $_cel_dest  = isset($_POST['cel_dest'])     ? $_POST['cel_dest']                                    : "";
             
        // cpf do beneficiario
        $campos = array('Número Liberação'=>$_nLibera,
                        'Data Liberação'=>$_dtLibera,
                        'Data Pagamento'=>$_dtPgto,
                        'Beneficiário'=>$_benef,
                        'Endereco'=>$_endereco,
                        'Bairro'=>$_bairro,
                        'cpfCnpjDEst'=>$cpfCnpjDest,
                        
                        'Responsável'=>$_resp,
                        'Nº Documento'=>$_nDoc,
                        'Data Limite Pagamento'=>$_dtLimite,
                        'Veículo'=>$_veiculo,
                        'Endereço Responsável'=>$_n_end_resp,
                        'Municipio'=>$_municipio,
                        'CPF_Responsável'=>$_cpfResp,
                        'Placa'=>$_placa);
        
        if(FuncaoBase::campoBranco($campos)){
            
            if(true) {

                $liberacao = new Liberacao();
                $dado_benef = $liberacao->buscaLiberacaoId($_nLibera);

                $benef = [
                            'resp_receb' => $_resp,
                            'resp_receb_ci' => $_nDoc,
                            'resp_receb_cpf' => $_cpfResp,
                            'resp_receb_veiculo' => $_veiculo,
                            'resp_receb_placa' => $_placa,
                            'id_liberacao'  => $_nLibera
                ];

        
                    if ($_pagamento->Pagar($_dtLibera,
                            $_nLibera,
                            $_dtLimite,
                            $_dtPgto,
                            $_benef,
                            $_resp,
                            $_nDoc,
                            $_nRecibo,
                            $_endereco,
                            $_bairro,
                            $cpfCnpjDest,
                            $_veiculo,
                            $_obs,
                            $_n_end_resp,
                            $_municipio,
                            $_cpfResp,
                            $_placa,
                            $_tel_dest,
                            $_cel_dest)){


                        $liberacao->atualizaBenef($benef);
                        $_pagamento->marcarPagoAjuItem($_nLibera);


                         
                        Log::GravaLog("Foi realizado o pagamento da liberacao : ".$_nLibera." Recibo Nr: ".$_nRecibo, "aju_log");
                        
                        print "<script text/javascript>";
        
                        print "alert('Pagamento Realizado com Sucesso !');";
                                
                        print "window.location.href = 'index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&controller=conestoque&action=recibopg&id=".$_nLibera."';";
        
                        print "</script>";

                    }
            }else {
                
            }
        }
    }elseif($_POST['opcao'] =="upload_rec_pgto"){

        $_id_pgto    = isset($_POST['id_pagamento'])    ? $_POST['id_pagamento']    : "";
        $_nota       = isset($_FILES['fl_nota'])           ? $_FILES['fl_nota']      : "";

	        $campos = array("id_pagamento"        => $_id_pgto);  
					
			if(FuncaoBase::CampoBranco($campos)){
					
				if(!empty($_nota)){
                                    Anexo::upload(PATH.'/anexo/recibo_pgto', $_FILES, "fl_nota", $_id_pgto."_".date("his"));
                                    //Log::GravaLog("upload_re_pgto:".$_nota['name'], "aju_log");			
                                    print "sucesso";
				}

			}
    }elseif($_POST['opcao'] == 'busca_pgto'){
        $id_pagamento = $_POST['id_pagamento'];
        $dados = $_pagamento->pagamentoId($id_pagamento);
               
        if(count($dados > 0)) {
            $linha = "<tr>
                        <th>Nº Pagto</th>
                        <th>Nº Liberação</th>
                        <th>Municipio</th>
                    </tr>";
            foreach ($dados as $key => $value) {
                $linha .= "<tr><td>".$value['id_pagamento']."</td>
                                <td>".$value['id_liberacao']."</td>
                                <td>".$value['municipio']."</td>
                                <td>".$value['municipio']."</td>
                            </tr>";
            }
            print $linha;
        }else {
            print "<tr><td colspan='3'>A Pesquisa não encontrou resultados</td>";
        }
        
    }
?>