<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">";
include_once PATH.'/include.php';

$_conexao = new ConexaoMysql();

$_dsp = new EquipeDSP();

$_id_dsp = isset($_GET['id']) ? $_GET['id'] : "";

$_dados = $_dsp -> buscaDspDadosId($_id_dsp);

$_cmd_dsp = $_dsp -> BuscaCmd($_id_dsp);

$_funcionario = new EquipeFuncionario();


//<!-- membros Militares da equipe -->
$_membrosMilitar = $_dsp -> buscaMembrosDSP($_id_dsp);

//var_dump($_membrosMilitar);

?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php print TITULO; ?></title>
        <!--<link href="<?php #print SISTEMA; ?><!--/css/bootstrap.css" rel="stylesheet" media="print">-->
        <link href="css/estiloficha.css" rel="stylesheet">
        
</head>
    <body>
        <div class="topo">
            
            <br>
                <div class="imprimir" style="text-align: center">
                    <!--implementa o metodo voltar -->
                    <?php 
                    
                    $modo = isset($_GET['mod']) ? $_GET['mod'] : "";
                    
                    if($modo =="") {
                        
                      print FuncaoBase::voltar();
                    
                    }else {

                        
                        print "<a class='btn' href='secao.php?secao=dsp&acao=dspBuscarAlterar'>Voltar</a>&nbsp;&nbsp;";
                        
                        print FuncaoBase::vifs('imprimir');  
                    }
?>
                </div>
        </div>
         
        <!-- ORDEM DE SERVICO MILITAR -->
        <div class="pagina">
                
                <br>
                <table border="1" align="center" cellpadding="0" cellspacing="0" class="tabela_dsp">
                   
                    <tr>
                        <td colspan="4">
                            <table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td valign="top" width="30%" style="border-right: 0.1em solid;">
                                        <div class="texto">1</div>
                                        <div class="campoTitulo">&nbsp;&nbsp;DATA:<br>
                                        <?php print DataMysql::dataVisual($_dados[0]['dt_dsp'])?><br><br></div>
                                        
                                    </td>
                                    <td style="border-right: 0.1em solid;">
                                        <div class="texto">2</div>
                                        <div class="campoTitulo" style="text-align: center;">ORDEM DE SERVIÇO Nº
                                            <?php print $_dados[0]['num_dsp'] . "/" . $_dados[0]['ano']; ?>
                                            <br>
                                            PARA DILIGÊNCIA DO SERVIÇO PÚBLICO
                                        </div>
                                    </td>
                                    <td valign="top" width="30%">
                                        <div class="texto">3</div>
                                        <div class="campoTitulo" style="text-align: center; vertical-align: ">
                                        SETOR<br> CEDEC-MG</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="texto">4</div>
                            <p class="texto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Ao Sr. Ten Cel PM Ordenador de Despesas,
                            <p class="texto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                             Considenrando os artigos, 21 e 22 da Lei Delegada 37, de 13 de Janeiro de 1989,
                                              Decreto Estadual 45260, de 22 de Dezembro de 2009, e Decreto Estadual 45618, 
                                              de 09 de junho de 2011, solicito a V.Sª. que o(s) militar(es) abaixo 
                                              relacionado(s) seja(m) despachado(s) em Diligência do Serviço Público (DSP).</p><br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="texto">5</div>
                            <div class="campo alinha">&nbsp;&nbsp;Missão:&nbsp;&nbsp;<?php print utf8_encode($_dados[0]['missao']); ?><br><br></div>
                            <div class="texto alinha"></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="texto">6</div>
                            <div class="campo alinha">&nbsp;&nbsp;Destino:&nbsp;&nbsp;<?php print utf8_encode($_dados[0]['destino']); ?><br><br></div>
                            <div class="texto alinha"></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="texto">7</div>
                            <div class="campo">&nbsp;&nbsp;Tipo de Transporte:
                                &nbsp;&nbsp;
                                (&nbsp;<?php print ($_dados[0]['tp_transporte'] == "1")? "X": "";?>&nbsp;) Veículo Oficial&nbsp;&nbsp;
                                (&nbsp;<?php print ($_dados[0]['tp_transporte'] == "2")? "X": "";?>&nbsp;) Veículo particular, justificativa (Decreto nº 45.260, Art. 10);&nbsp;&nbsp;
                                (&nbsp;<?php print ($_dados[0]['tp_transporte'] == "3")? "X": "";?>&nbsp;) Aeronave do estado&nbsp;&nbsp;
                                (&nbsp;<?php print ($_dados[0]['tp_transporte'] == "4")? "X": "";?>&nbsp;) Vôo comercial&nbsp;&nbsp;
                                (&nbsp;<?php print ($_dados[0]['tp_transporte'] == "5")? "X": "";?>&nbsp;) Ônibus rodoviário.
                                <br><br></div>
                            <div class="texto alinha"></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="texto">8</div>
                            <div colspan="3" class="campo">
                            Pousada : ônus para outros órgãos (&nbsp;&nbsp;<?=($_dados[0]['onus'] == "1") ? "X": ""?>&nbsp;&nbsp;)
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            ônus para o GMG (&nbsp;&nbsp;<?=($_dados[0]['onus'] == "0") ? "X": ""?>&nbsp;&nbsp;)
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            sem ônus para o GMG/outros órgãos públicos (&nbsp;&nbsp;<?=($_dados[0]['onus'] == "2") ? "X": ""?>&nbsp;&nbsp;)
                            </div>
                        </td>
                    </tr>
                        
                    <tr>
                        <td colspan="2" width="50%">
                            <table>
                                <tr>
                                    <td colspan="3"><div class="texto">9</div></td>
                                </tr>
                                <tr>
                                    <td width="80"><div class="campo alinha">&nbsp;&nbsp;Previsão</div></td>
                                    <td width="110"><div class="campo alinha">
                                        &nbsp;&nbsp;Partida da Sede :&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td><div class="campo alinha">Data <?php print DataMysql::extraiData($_dados[0]['partida'])." Hora ".DataMysql::extraiHora($_dados[0]['partida']);//$_dsp->formataDataHoraPM($_dados[0]['partida']); ?></div></td>
                                </tr>
                                <tr>
                                    <td>
                                        
                                                    
                                    </td>
                                    <td><div class="campo alinha">&nbsp;&nbsp;Chegada à Sede:</div></td>
                                    <td><div class="campo text-left">Data <?php print DataMysql::extraiData($_dados[0]['chegada'])." Hora ".DataMysql::extraiHora($_dados[0]['chegada']);//$_dsp->formataDataHoraPM($_dados[0]['chegada']); ?></div></td>
                                </tr>
                                
                            </table>

                            </div>
                        </td>
                        <td colspan="2" width="50%">
                            <div class="campo alinha"></div>

                            <div class="texto">&nbsp;&nbsp;</div>
                        </td>
                    </tr>
                     
                    <!-- TABELA PARA MEMBRO DAS EQUIPE MILITAR -->
                    <tr>
                        <td colspan="4">
                            <?php
                            
                            $_qtd_membroMilitar = count($_membrosMilitar);
                            
                            //var_dump($_qtd_membroMilitar);
                            //var_dump($_membrosMilitar);
                        
                            print "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"tabela_dsp\">";

                            print "<tr>
                                        <td><div class=\"texto\" style=\"border-right: 0.1em solid; border-bottom: 0.1em solid;\">10</div></td>
                                        <td><div class=\"texto\" style=\"border-right: 0.1em solid; border-bottom: 0.1em solid;\">11</div></td>
                                        <td><div class=\"texto\" style=\"border-right: 0.1em solid; border-bottom: 0.1em solid;\">12</div></td>
                                        <td><div class=\"texto\" style=\"border-right: 0.1em solid; border-bottom: 0.1em solid;\">13</div></td>
                                        <td><div class=\"texto\" style=\"border-bottom: 0.1em solid;\">14</div></td>
                                   </tr>
                                   <tr>
                                        <th class=\"campo\" style=\"border-right: 0.1em solid; border-bottom: 0.1em solid;\">Número</th>
                                        <th class=\"campo\" style=\"border-right: 0.1em solid; border-bottom: 0.1em solid;\">P/G</th>
                                        <th class=\"campo\" style=\"border-right: 0.1em solid; border-bottom: 0.1em solid;\">Nome</th>
                                        <th class=\"campo\" style=\"border-right: 0.1em solid; border-bottom: 0.1em solid;\">Número de QQ</th>
                                        <th class=\"campo\" style=\"border-bottom: 0.1em solid;\">Curso</th>";

                                for ($i = 0; $i < $_qtd_membroMilitar; $i++) {
                                        
                                    if($_membrosMilitar[$i]['tipo_abono'] == "DAD") {
                                    
                                        $abono = $_membrosMilitar[$i]['tipo_abono']." ".$_membrosMilitar[$i]['quinquenio'];
                                    
                                    }else {
                                        
                                        $abono = $_membrosMilitar[$i]['quinquenio'] . " ".$_membrosMilitar[$i]['tipo_abono'];
                                    }

                                        print "<tr>
                                                    <td class=\"texto\" style=\"border-right: 0.1em solid; padding-top: 10px;\">&nbsp;&nbsp;" . $_membrosMilitar[$i]['num_masp'] . "</td>
                                                    <td class=\"texto\" style=\"border-right: 0.1em solid; padding-top: 10px;\">&nbsp;&nbsp;" . $_membrosMilitar[$i]['posto'] . "</td>
                                                    <td class=\"texto\" style=\"border-right: 0.1em solid; padding-top: 10px;\">&nbsp;&nbsp;" . utf8_encode($_membrosMilitar[$i]['nome']) . "</td>
                                                    <td align=\"center\" class=\"texto\" style=\"border-right: 0.1em solid; padding-top: 10px;\">&nbsp;&nbsp;" . $abono."</td>
                                                    <td class=\"texto\" style=\"border-right: 0.1em solid; padding-top: 10px;\">&nbsp;&nbsp;" . $_membrosMilitar[$i]['curso'] . "</td>
                                                </tr>";
                                    }
                                
                                
                                # final tabela dos membros
                                print "</table>";
                            ?>
                            
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="border-top: none;">
                            <div class="texto" style="width:5%; float: left;">15</div>

                            <div class="campo" style="width:95%;">Dados Bancários<br><br></div>
                            
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <!-- tabela dados bancarios -->
                            <?php print "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"tabela_dsp\">";

                                print "<tr>
                                              <th class=\"campo\" style=\"border-right: 0.1em solid; border-bottom: 0.1em solid;\">Nome</th>
                                              <th class=\"campo\" style=\"border-right: 0.1em solid; border-bottom: 0.1em solid;\">CPF</th>
                                              <th class=\"campo\" style=\"border-right: 0.1em solid; border-bottom: 0.1em solid;\">Banco</th>
                                              <th class=\"campo\" style=\"border-right: 0.1em solid; border-bottom: 0.1em solid;\">Agencia</th>
                                              <th class=\"campo\" style=\"border-bottom: 0.1em solid;\">Conta</th>";

                                //var_dump($_membros);

                                for ($j = 0; $j < $_qtd_membroMilitar; $j++) {

                                        print "<tr>
                                                <td class=\"texto\" style=\"border-right: 0.1em solid; border-bottom: 0.1em solid; padding-top: 10px;\">&nbsp;&nbsp;" . utf8_encode($_membrosMilitar[$j]['nome']) . "</td>
                                                <td class=\"texto\" style=\"border-right: 0.1em solid; border-bottom: 0.1em solid; padding-top: 10px;\">&nbsp;&nbsp;" . $_membrosMilitar[$j]['cpf'] . "</td>
                                                <td class=\"texto\" style=\"border-right: 0.1em solid; border-bottom: 0.1em solid; padding-top: 10px;\">&nbsp;&nbsp;" . $_membrosMilitar[$j]['num_banco'] . "</td>
                                                <td class=\"texto\" style=\"border-right: 0.1em solid; border-bottom: 0.1em solid; padding-top: 10px;\">&nbsp;&nbsp;" . $_membrosMilitar[$j]['agencia'] . "</td>
                                                <td class=\"texto\" style=\"border-bottom: 0.1em solid; padding-top: 10px;\">&nbsp;&nbsp;" . $_membrosMilitar[$j]['conta'] . "</td>
                                                </tr>";

                                }
                                print "</table>";
                            ?>
                        
                    
                            <div style="text-align: center; font-size: 11px;">
                                <br><br><br>
                                
                                _____________________________________________________
                                <br>
                                <div class="campo" style="padding-bottom: 5px;"><?php print $_funcionario -> getFuncionarioId($_dados[0]['id_chefe']); ?></div>
                                <?php $dados_func = $_funcionario->pegaDadosFuncionario($_dados[0]['id_chefe']); print utf8_encode($dados_func['desc_funcao']); ?>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="4">
                            <div class="texto" style="width:3%; float: left;">16</div>

                            <div class="campo" style="width:97%;"> À Superintendência de Planejamento Gestão e Finanças,</div>

                            <p class="texto">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
                                             (&nbsp;&nbsp;) Providenciar processo normal de pagamento em regime de adiatamento ao diligente através de
                            processo ordinário.
                            <p class="texto">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            (&nbsp;&nbsp;) Providenciar pagamento em regime de adiantamento atraves do Agente Suprido.
                            <p class="texto">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            (&nbsp;&nbsp;) Providenciar pagamento de diárias vencidas.
                            <p class="texto">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            (&nbsp;&nbsp;) Providenciar pagamento em regime de ressarcimento no valor da diária que o(s) 
                            militar(es) fizer(em) jus, nos termos dos artigos 21 e 22 da Lei Delegada 37, de 13 de junho de 1989.
                        

                        
                            <div class="campo" style="text-align: center">
                                <p class="texto" style="margin:0px;">Belo Horizonte, <?php print DataMysql::dataExtensoDocumento(date('d/m/Y')); ?>.<br><br><br> 
                                
                            </div>
                            <div class="campo" style="text-align: center;">
                                _____________________________________________________<br>
                                <b><div class="campo" "><?php print ODESPESA; ?></div>
                            <div class="texto" style="padding-bottom: 5px;">Ordenador de Despesas do GMG</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <table class="tabela_dsp" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="50%" align="center" class="campo" style="border-right: 0.1em solid;"><br>RELATORIO DE VIAGEM Nº_____/_____<br><br></td>
                                    <td width="50%" align="center" class="campo">DATA _____/______/______<br></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
            </table>
        </div> 
         
        <div style="page-break-after: always;"></div>

        <!--  CHEFE DSP RELATORIO DE VIAGEM *** quebra de pagina ###################################################-->
                
        <div class="pagina">
            <table border="1" align="center" cellpadding="0" cellspacing="0" class="tabela_dsp">
                <tr>
                    <td colspan="4" style="text-align: center; border-bottom: none;"><img src="<?php print SISTEMA; ?>/imagem/logo_gab.png" /></td>
                </tr>
                
                <tr>
                    <td class="campo" colspan="4" style="text-align: center; border-top:none; padding-bottom: 5px;">RELATÓRIO DE VIAGEM Nº ___________/__________________<br></td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="campo alinha">NÚMERO DE PM/BM :
                         &nbsp;&nbsp;<?php print $_cmd_dsp['num_masp']; ?>
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        POSTO/GRADUAÇÃO :
                         &nbsp;&nbsp;<?php print $_cmd_dsp['posto']; ?></div><br>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="campo alinha">NOME :&nbsp;&nbsp;<?php print utf8_encode($_cmd_dsp['nome']); ?></div>
                    </td>
                </tr>
                <tr>
                    <td width="33%">
                        <div class="campo alinha">COD DA DILIGÊNCIA : &nbsp;&nbsp;<?php print $_dsp -> getCodDsp($_dados[0]['id_cod_dsp']); ?></div>
                    </td>
                    <td width="33%">
                        <div class="campo alinha">Nº DE QQ :&nbsp;&nbsp;<?php print $_cmd_dsp['quinquenio']." ".$_cmd_dsp['tipo_abono'] ; ?></div>
                    </td>
                    <td width="34%">
                        <div class="campo alinha">SETOR DE TRABALHO :&nbsp;&nbsp;<?php print $_cmd_dsp['orgao']; ?></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="campo alinha">MISSÃO : &nbsp;&nbsp;<?php print utf8_encode($_dados[0]['missao']); ?></div>
                    </td>
                    
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="campo alinha">TRANSPORTE OFICIAL : &nbsp;&nbsp;<?php print ($_dados[0]['tp_transporte'] == "1")? "( X ) Sim (&nbsp;&nbsp;&nbsp;) Não" : "(&nbsp;&nbsp;&nbsp;) Sim ( X ) Não"?>&nbsp;&nbsp; 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        DESTINO : &nbsp;&nbsp;<?php print utf8_encode($_dados[0]['destino']); ?></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="texto" style="border-right: none; width: 50%; margin-top: 15px;float: left">&nbsp;&nbsp;Data : ___/_____/______</div>
                        <div class="texto" style="width:50%; float: left;text-align: right;margin-top: 15px">Assinatura do diligente :________________________&nbsp;&nbsp;&nbsp;</div>
                        <div class="texto" style="text-align: right"><?php print utf8_encode($_cmd_dsp['nome']) . ", " . $_cmd_dsp['posto']; ?>&nbsp;&nbsp;&nbsp;</span></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <table border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_dsp">
                            <tr>
                                <th width="20%" style="border-right: 0.1em solid; border-bottom: 0.1em solid;"><div class="campo">DISCRIMINAÇÃO</div></th>
                                <th width="20%" style="border-right: 0.1em solid; border-bottom: 0.1em solid;"><div class="campo">DATA</div></th>
                                <th width="10%" style="border-right: 0.1em solid; border-bottom: 0.1em solid;"><div class="campo">HORA</div></th>
                                <th width="35%" style="border-right: 0.1em solid; border-bottom: 0.1em solid;"><div class="campo">ASSINATURA</div></th>
                                <th width="15%" style="border-bottom: 0.1em solid;"><div class="campo">FUNÇÃO</div></th>
                            </tr>
                            <tr>
                                <td align="center" class="texto" style="border-right: 0.1em solid; border-bottom: 0.1em solid; padding-bottom: 20px; ">Partida da Sede</td>
                                <td align="center" class="texto" style="border-right: 0.1em solid; border-bottom: 0.1em solid;"> ___ /____ /______</td>
                                <td align="center" class="texto" style="border-right: 0.1em solid; border-bottom: 0.1em solid;"> ___:____</td>
                                <td align="center" style="border-right: 0.1em solid; border-bottom: 0.1em solid;"><!--&nbsp;__________________________________&nbsp;-->
                                        <span class="texto" style="border-bottom: 0.1em solid;"><?php //print $_funcionario -> getFuncionarioId($_dados[0]['id_chefe']); ?></span></td>
                                <td align="center" class="texto" style="border-bottom: 0.1em solid;"><!--Chefe Direto--><br></td>
                            </tr>
                            <tr>
                                <td align="center" class="texto" style="border-right: 0.1em solid; border-bottom: 0.1em solid; padding-bottom: 20px;">Chegada ao Destino</td>
                                <td align="center" class="texto" style="border-right: 0.1em solid; border-bottom: 0.1em solid;"> ___ /____ /______</td>
                                <td align="center" class="texto" style="border-right: 0.1em solid; border-bottom: 0.1em solid;"> ___:____</td>
                                <td align="center" style="border-right: 0.1em solid; border-bottom: 0.1em solid;"><!--&nbsp;__________________________________&nbsp;--><br>
                                    <span class="texto"><?php //print utf8_encode($_cmd_dsp['nome']) . ", " . $_cmd_dsp['posto']; ?></span></td>
                                <td align="center" class="texto" style="border-bottom: 0.1em solid;"><!--Diligente--></td>
                            </tr>
                            <tr>
                                <td align="center" class="texto" style="border-right: 0.1em solid; border-bottom: 0.1em solid; padding-bottom: 20px;">Partida do Destino</td>
                                <td align="center" class="texto" style="border-right: 0.1em solid; border-bottom: 0.1em solid;"> ___ /____ /______</td>
                                <td align="center" class="texto" style="border-right: 0.1em solid; border-bottom: 0.1em solid;"> ___:____</td>
                                <td align="center" style="border-right: 0.1em solid; border-bottom: 0.1em solid;"><!--&nbsp;__________________________________&nbsp;--><br>
                                    <span class="texto" ><?php //print utf8_encode($_cmd_dsp['nome']) . ", " . $_cmd_dsp['posto']; ?></span></td>
                                <td align="center" class="texto" style="border-bottom: 0.1em solid;"><!--Diligente --></td>
                            </tr>
                            <tr>
                                <td align="center" class="texto" style="border-right: 0.1em solid;">Chegada da Sede</td>
                                <td align="center" class="texto" style="border-right: 0.1em solid;"> ___ /____ /______</td>
                                <td align="center" class="texto" style="border-right: 0.1em solid;"> ___:____</td>
                                <td align="center" style="border-right: 0.1em solid;"><!--&nbsp;__________________________________&nbsp;-->
                                    <span class="texto"><?php //print $_funcionario -> getFuncionarioId($_dados[0]['id_chefe']); ?></span></td>
                                <td align="center" class="texto"><br><!--Chefe Direto--></td>
                            </tr>
                        </table>
                    </td>
                <tr>
                    <td colspan="3" style="text-align: center" class="texto">RELATÓRIO</td>
                </tr>
                <tr>
                    <td colspan="3"><div class="campo">&nbsp;&nbsp;&nbsp;&nbsp;CITAR SE HOUVE POUSADA E ALIMENTAÇÃO COM CUSTOS PARA ÓRGÃOS PÚBLICOS<div>
                        
                        <div class="texto">&nbsp;&nbsp;(&nbsp;&nbsp;) HOUVE</div>
                        <div class="texto">&nbsp;&nbsp;(&nbsp;&nbsp;) NÃO HOUVE</div>
                        &nbsp;&nbsp;&nbsp;_____________________________________________________________________________________<br>
                        &nbsp;&nbsp;&nbsp;_____________________________________________________________________________________<br>
                        &nbsp;&nbsp;&nbsp;_____________________________________________________________________________________<br>
                        
                        <br>
                        <div class="texto" style="border-right: none; width: 50%; margin: 0;float: left">&nbsp;&nbsp;Data : ___/_____/______</div>
                        <div class="texto" style="width:50%; float: left;text-align: right">Assinatura do diligente :________________________&nbsp;&nbsp;&nbsp;</div>
                        <div class="texto" style="text-align: right"><?php print utf8_encode($_cmd_dsp['nome']) . ", " . $_cmd_dsp['posto']; ?>&nbsp;&nbsp;&nbsp;</span></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="campo" colspan="3" style="text-align: center">DIRETORIA DE RECURSOS HUMANOS</td>
                </tr>
                <tr>
                    <td colspan="3">
                        <table class="tabela_dsp" >
                            <tr>
                                <td class="campo">DIÁRIAS ADIANTADAS :</td>
                                <td class="campo">_______(DI)</td>
                                <td class="campo">e ________ (PA)</td>
                                <td class="campo">Valor R$ : __________</td>
                            </tr>
                            <tr>
                                <td class="campo">COMPLEMENTAÇÃO :</td>
                                <td class="campo">_______(DI)</td>
                                <td class="campo">e ________ (PA)</td>
                                <td class="campo">Valor R$ : __________</td>
                            </tr>
                            <tr>
                                <td colspan="4"><hr style="padding: 0"></td>
                            </tr>
                             <tr>
                                <td class="campo">DIÁRIAS EMPENHADAS :</td>
                                <td class="campo">_______(DI)</td>
                                <td class="campo">e ________ (PA)</td>
                                <td class="campo">Valor R$ : __________</td>
                            </tr>
                            <tr>
                                <td colspan="4"><hr style="padding: 0"></td>
                            </tr>
                             <tr>
                                <td class="campo">Total Diárias Recebidas :</td>
                                <td class="campo">_______(DI)</td>
                                <td class="campo">e ________ (PA)</td>
                                <td class="campo">Valor R$ : __________</td>
                            </tr>
                            <tr>
                                <td colspan="4"><hr style="padding: 0"></td>
                            </tr>
                             <tr>
                                <td class="campo">DEVOLUÇÃO DE DIÁRIAS :</td>
                                <td class="campo">_______(DI)</td>
                                <td class="campo">e ________ (PA)</td>
                                <td class="campo">Valor R$ : __________</td>
                            </tr>
                            
                        </table>
                      </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="campo">(&nbsp;&nbsp;) Pela concessão<br>
                        <div class="campo">(&nbsp;&nbsp;) Pela não concessão.  Justificativa :_______________________________________________________________________<br>
                        <br>
                     <div class="campo">Data : _____/______/______</div>
                     <div style="text-align: right"><span class="texto">Assunatura : _______________________________&nbsp;&nbsp;<br>
                     <?php print CHEFEDRH; ?>&nbsp;&nbsp;&nbsp;&nbsp;<br>
                     Diretoria de Recursos Humanos&nbsp;&nbsp;</span></div></td>
                </tr>
                <tr>
                    <td class="campo" colspan="3" style="text-align: center">DESPACHO DO ORDENADOR DE DESPESAS</div></td>
                </tr>
                <tr>
                    <td colspan="3">&nbsp;
                        <div class="campo" style="float: left;">(&nbsp;&nbsp;) Concedo _____ DI ______ PA&nbsp;&nbsp;&nbsp;&nbsp;</div>
                        <div class="campo">(&nbsp;&nbsp;) Não concedo justificativa ____________________________________</div>
                        <br>
                        <div class="campo">Data _____/_____/______</div><br>
                        <div class="campo" style="text-align: center">
                            <span class="texto">___________________________________<br>
                            <?php print ODESPESA; ?><br>
                            Ordenador de Despesas</span></div>
                    </td>
                </tr>
               
            </table>
        </div>
</body>
</html>