<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">";
include_once PATH.'/include.php';

$_conexao = new ConexaoMysql();

$_dsp = new EquipeDSP();

$_id_dsp = isset($_GET['id']) ? $_GET['id'] : "";

$_dados = $_dsp -> buscaDspDadosId($_id_dsp);

$_cmd_dsp = $_dsp -> BuscaCmd($_id_dsp);

//var_dump($_chefeDireto);

//var_dump($_dados);

$_funcionario = new EquipeFuncionario();

//var_dump($_id_dsp);

//<!-- membrosCivil da equipe -->
$_membrosCivil = $_dsp -> buscaMembrosDSP($_id_dsp);

if($_membrosCivil == "") {
    
    
    print "<script type=\"text/javascript\">";
                        
    print "alert('Funcionário não possui Conta Bancária Cadastrada no Sistema !!');";
    
    print "window.location.href = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=equipe&secao=dsp&acao=buscar';";
                        
    print "</script>";

    
}

//var_dump($_membrosCivil);

$_chefeDireto = $_funcionario->pegaDadosFuncionario($_dados[0]['id_chefe']);

//var_dump($_chefeDireto);

//var_dump($modo);

?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php print TITULO; ?></title>
        <!--<link href="<?php #print SISTEMA; ?><!--/css/bootstrap.css" rel="stylesheet" media="print">-->
        <link href="<?php print SISTEMA; ?>/mod_equipe/css/estiloficha.css" rel="stylesheet">
        
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

                        
                        print "<a class='btn' href='index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=modulo&secao=dsp&acao=buscar'>Voltar</a>&nbsp;&nbsp;";
                        
                        print FuncaoBase::vifs('imprimir');  
                    }
?>
                </div>
        </div>
        <!--##########################################   ANEXO RELATORIO DE FUNCIONARIO CIVIL ######################################-->  
        
        <?php
               # Membros Civil da Equipe
                $_membrosCivil = $_dsp -> buscaMembrosDSP($_id_dsp, "SC");
                
                //var_dump($_membrosCivil);

             ?>
    <div class="pagina">
            
            <br>
            <table border="1" align="center" cellpadding="0" cellspacing="0" class="tabela_dsp">
                
                  <tr>
                    <td width="20%" valign="top"><div class="texto">1</div>
                        <div align="center" class="campo"><?php print DataMysql::dataVisual($_dados[0]['dt_dsp'])?></div></td>
                    <td>
                        <div class="texto">2</div>
                        <div class="campo" align="center">ORDEM DE SERVIÇO Nº &nbsp;&nbsp;<?php print $_dados[0]['num_dsp'] . "/" . $_dados[0]['ano']; ?><br>
                        PARA DILIGÊNCIA DO SERVIÇO PÚBLICO<br></br></div></td>
                    <td width="20%" valign="top">
                        <div class="texto">3</div>
                        <div class="campo" align="center"> 
                        SETOR 
                        CEDEC/MG</div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3"><div class="texto">4</div>
                      <div class="texto"><p class="texto">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          
                          Sr. Ten Cel Ordenador de Despesas,
                      <p class="texto">
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          Considerando o artigo 4º do Decreto 45618, de 09 de junho de 2011, 
                                        solicito a V.Sª. que o funcionário (a) civil abaixo relacionado(s) seja(m) despachado(s) 
                                        em Diligência do Serviço Público (DPS).</p></p>
                    </td>
                    </tr>
                    <td colspan="3"><div class="texto">5</div>
                        <div class="campo">&nbsp;&nbsp;Missão : &nbsp;&nbsp;<?php print utf8_encode($_dados[0]['missao']); ?><br><br></div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3"><div class="texto">6</div>
                      <div class="campo">&nbsp;&nbsp;DESTINO: &nbsp;&nbsp;<?php print utf8_encode($_dados[0]['destino']); ?><br><br></div></td>
                  </tr>
                  <tr>
                    <td colspan="3"><div class="texto">7</div>
                      <div class="campo">&nbsp;&nbsp;TIPO DE TRANSPORTE :</div>
                      <div class="texto">
                          
                          (&nbsp;<?php print ($_dados[0]['tp_transporte'] == "1") ? "X" : "";?>&nbsp;) veículo oficial,
                          (&nbsp;<?php print ($_dados[0]['tp_transporte'] == "2") ? "X" : "";?>&nbsp;) veículo particular (justificativa anexa),
                          (&nbsp;<?php print ($_dados[0]['tp_transporte'] == "3") ? "X" : "";?>&nbsp;) aeronave do estado,
                          (&nbsp;<?php print ($_dados[0]['tp_transporte'] == "4") ? "X" : "";?>&nbsp;) vôo comercial: solicito autorização p/ aquisição de passagens;
                          (&nbsp;<?php print ($_dados[0]['tp_transporte'] == "5") ? "X" : "";?>&nbsp;) ônibus rodoviário.<br><br>
                      </div>
                    </td>
                  </tr>
                   <tr>
                    <td colspan="3"><div class="texto">8</div>
                      <div class="campo">&nbsp;&nbsp;
                          POUSADA : &nbsp;&nbsp; 
                          (&nbsp;<?php print ($_dados[0]['onus'] == "1") ? "X" : "";?>&nbsp;) ônus para outros órgãos &nbsp;&nbsp;&nbsp;&nbsp;
                          (&nbsp;<?php print ($_dados[0]['onus'] == "2") ? "X" : "";?>&nbsp;) ônus para GMG &nbsp;&nbsp;&nbsp;&nbsp;
                          (&nbsp;<?php print ($_dados[0]['onus'] == "3") ? "X" : "";?>&nbsp;)sem ônus para o GMG / outros órgãos públicos <br><br></div></td>
                  </tr>
                  <tr>
                    <td colspan="3"><div class="texto">9</div>
                      <div class="campo">&nbsp;&nbsp;PREVISÃO&nbsp;&nbsp;  PARTIDA DA SEDE :&nbsp;&nbsp;
                                <?php print DataMysql::extraiData($_dados[0]['partida'])." ".DataMysql::extraiHora($_dados[0]['partida']);  ?></div>
                      <div class="campo">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                          CHEGADA À SEDE :&nbsp;&nbsp;
                                <?php print DataMysql::extraiData($_dados[0]['chegada'])." ".DataMysql::extraiHora($_dados[0]['chegada']); ?></div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3">
                    
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                            <td width="15%" style="border-right: 0.1em solid; border-bottom: 0.1em solid;"><div class="texto">10</div>
                            <div class="campo">&nbsp;&nbsp;MASP</div></td>
                            <td width="15%" style="border-right: 0.1em solid; border-bottom: 0.1em solid;"><div class="texto">11</div>
                            <div class="campo">&nbsp;&nbsp;CARGO</div></td>
                            <td width="40%" style="border-right: 0.1em solid; border-bottom: 0.1em solid;"><div class="texto">12</div>
                            <div class="campo">&nbsp;&nbsp;NOME</div></td>
                            <td width="15%" style="border-right: 0.1em solid; border-bottom: 0.1em solid;"><div class="texto">13</div>
                            <div class="campo">&nbsp;&nbsp;Nr.QQ/ADE</div></td>
                            <td width="15%" style="border-bottom: 0.1em solid;"><div class="texto">14</div>
                            <div class="campo">&nbsp;&nbsp;CURSO </div></td>
                            
                          </tr>
                          <tr>
                            <td class="texto" style="border-right: 0.1em solid; text-align: center">&nbsp;<br><?php print $_membrosCivil[0]['num_masp'];?></td>
                            <td class="texto" style="border-right: 0.1em solid; text-align: center">&nbsp;<?php print $_membrosCivil[0]['cargo']; ?></td>
                            <td class="texto" style="border-right: 0.1em solid;">&nbsp;<?php print utf8_encode($_membrosCivil[0]['nome']);?></td>
                            <td class="texto" style="border-right: 0.1em solid; text-align: center">&nbsp;0<?php //print $_membrosCivil[0]['quinquenio']; ?></td>
                            <td class="texto">&nbsp;<?php print $_membrosCivil[0]['curso']?><br></td>
                          </tr>
                        </table>
 
                   </td>
                  </tr>
                  <tr>
                    <td colspan="3">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td style="border-bottom: 0.1em solid;" colspan="5"><div class="texto">15</div>
                                <div align="center">
                                    <div class="campo">DADOS BANCÁRIOS</div>
                            </td>
                          </tr>
                          <tr>
                            <td align="center" style="border-right: 0.1em solid;"><div class="campo">NOME</div></td>
                            <td align="center" style="border-right: 0.1em solid;"><div class="campo">CPF</div></td>
                            <td align="center" style="border-right: 0.1em solid;"><div class="campo">BANCO</div></td>
                            <td align="center" style="border-right: 0.1em solid;"><div class="campo">CONTA</div></td>
                            <td align="center"><div class="campo">AGÊNCIA</div></td>
                          </tr>
                          <tr>
                            <td class="texto" style="border-right: 0.1em solid; border-bottom: 0.1em solid;">&nbsp;<?php print utf8_encode($_membrosCivil[0]['nome']);?></td>
                            <td class="texto" style="border-right: 0.1em solid; border-bottom: 0.1em solid;">&nbsp;<?php print $_membrosCivil[0]['cpf']?></td>
                            <td class="texto" style="border-right: 0.1em solid; border-bottom: 0.1em solid;">&nbsp;<?php print $_membrosCivil[0]['num_banco']?></td>
                            <td class="texto" style="border-right: 0.1em solid; border-bottom: 0.1em solid;">&nbsp;<?php print $_membrosCivil[0]['conta']?></td>
                            <td class="texto" style="border-bottom: 0.1em solid;">&nbsp;<?php print $_membrosCivil[0]['agencia']?></td>
                          </tr>
                        </table>
                        <br>
                        <div align="center" class="campo">______________________________________<br>
                            <?php print $_funcionario -> getFuncionarioId($_dados[0]['id_chefe']); ?><br>
                            <?php $dados_func = $_funcionario->pegaDadosFuncionario($_dados[0]['id_chefe']); print utf8_encode($dados_func['desc_funcao']); ?>
                        </div><br>
                      </td>
                  </tr>
                  <tr>
                  </tr>
                  <tr>
                    <td colspan="3">
                        <div class="texto">16
                              <p class="texto">
                              &nbsp;&nbsp;&nbsp;
                              À Superintendencia de Planejamento Gestão e Finanças, 
                              <p class="texto">
                              &nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;) Providenciar processo normal de pagamento em regime de adiatamento ao diligente através de
                                                processo ordinário.
                              <p class="texto">
                              &nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;) Providenciar processo de pagamento em regime de adiantamento atraves do Agente Suprido.
                                                <p class="texto">
                              &nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;) Providenciar processo de pagamento de diárias vencidas
                                                <p class="texto">
                              &nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;) Providenciar pagamento em regime de ressarcimento no valor da diária que o(s) militar(es) fizer(em) jus, nos termos
                              dos artigos 21 e 22 da Lei Delegada 37, de 13 de janeiro de 1989.<br>
                              <div align="right" class="texto" >Belo Horizonte, <?php print date("d"). " de ". FuncaoBase::numTomes(date("m")) ." de ".date("Y");?>
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              </div>
                        </div>
                    
                        <div align="center" class="campo">______________________________________<br>
                            <?php print ODESPESA; ?><br>
                            Ordenador de Despesa
                        </div><br>
                     </td>
                  </tr>
                  <tr>
                    <td colspan="3">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="50%" style="border-right: 0.1em solid;"><div class="texto alinha">17</div>
                                    <div class="campo">ORDEM DE SERVIÇO Nº : ___/_________</div></td>
                                    <td width="50%"><br><div class="texto alinha">17&nbsp;&nbsp;</div>
                                    <div class="campo">DATA ____/____/______</div>
                                    <br>
                                </td>
                            </tr>
                        </table>
                    </td>
                  </tr>  
            </table>
            <br><br>
            
            </div>
            <div style="page-break-after: auto;"></div>

        <!-- ########################################  BOLETIM DE VIAGEM CIVIL ############################### -->            
        <div class="pagina">
                
                <table border="1" align="center" cellpadding="0" cellspacing="0" class="tabela_dsp">
                    <tr>
                        <td colspan="2" align="right"><div class="texto"></div></td>
                        <td align="left"><div class="texto">Exercício :</div></td>
                        <td width="25" align="left"><div class="texto">Boletim de Viagem<br> Nº :</div></td>
                    </tr>
                    <tr>
                        <td width="20%"><img src="<?php print SISTEMA; ?>/imagem/logo_gab.png" /></td>
                        <td width="20%" align="center"><div class="campo">BOLETIM DE VIAGEM</div></td>
                        <td width="20%" align="center"><div class="campo"><?php print date("Y"); ?></div></td>
                        <td width="20%" align="center"><div class="campo">DATA DE EMISSÃO</div><br>
                            <div class="campo"><?php print HOJE; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" align="center"><div class="campo">UNIDADE ORÇAMENTÁRIA</div></td>
                        <td align="center"><div class="campo">CÓDIGO</div></td>
                    </tr>
                    <tr>
                        <td colspan="3"><div class="texto">&nbsp;&nbsp;Gabinete Militar do Governador</div></td>
                        <td align="center"> <div class="texto">1071.000</div></td>
                    </tr>
                    <tr>
                        <td colspan="3" align="center"><div class="campo">UNIDADE EXECUTORA</div></td>
                        <td align="center"><div class="campo">CÓDIGO</div></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="texto">&nbsp;&nbsp;Gabinete Militar do Governador</div></td>
                            <td align="center"><div class="texto">01</div>
                                
                            </td>
                    </tr>
                    
                        <tr>
                            <td colspan="2" align="center"><div class="campo">FAVORECIDO</div></td>
                            <td align="center"><div class="campo">MASP</div></td>
                            <td align="center"><div class="campo">CÓDIGO</div></td>
                        </tr>
                        <tr>
                            <td colspan="2"><div align="center" class="texto"><?php print utf8_encode($_membrosCivil[0]['nome']); ?></div></td>
                            <td align="center"><div class="texto"><?php print $_membrosCivil[0]['num_masp']; ?></div></td>
                            <td align="center"><div class="texto"><?php print $_dsp -> getCodDsp($_dados[0]['id_cod_dsp']); ?></div></td>
                        </tr>
                        <tr>
                            <td align="center"><div class="campo">CPF</div></td>
                            <td  align="center"><div class="campo">CARGO OU FUNÇÃO</div></td>
                            <td colspan="2" align="center"><div class="campo">SÍMBOLO / GRAU</div></td>
                        </tr>
                        <tr>
                            <td align="center"><div class="texto"><?php print $_membrosCivil[0]['cpf']; ?></div></td>
                            <td align="center"><div class="texto"><?php print $_membrosCivil[0]['tipo_abono']; ?></td>
                            <td colspan="2" align="center"></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><div class="campo">REMUNERAÇÃO</div></td>
                            <td colspan="2" align="center"><div class="campo">LOTAÇÃO</div></td>
    
                        </tr>
                        <tr>
                            <td colspan="2"><div class="campo">&nbsp;&nbsp;R$</div></td>
                            <td colspan="2">-</td>
                        </tr>
                        
                        <tr>
                            <td colspan="4">
                            <table width="100%" class="tabela_dsp" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center"><div class="campo" style="border-right: 0.1em solid; border-bottom: 0.1em solid;">Agência</div></td>
                                    <td align="center"><div class="campo" style="border-right: 0.1em solid; border-bottom: 0.1em solid;">Banco</div></td>
                                    <td align="center"><div class="campo" style="border-right: 0.1em solid; border-bottom: 0.1em solid;">Conta Corrente</div></td>
                                    <td align="center"><div class="campo" style="border-bottom: 0.1em solid;">Nº do Empenho</div></td>
                                </tr>
                                <tr>
                                    <td align="center"><div class="texto" style="border-right: 0.1em solid;"><?php print $_membrosCivil[0]['agencia']; ?></div></td>
                                    <td align="center"><div class="texto" style="border-right: 0.1em solid;"><?php print $_membrosCivil[0]['num_banco']; ?></div></td>
                                    <td align="center"><div class="texto" style="border-right: 0.1em solid;"><?php print $_membrosCivil[0]['conta']; ?></div></td>
                                    <td align="center"></td>
                                </tr>
                            </table>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" colspan="2"><div class="campo">TIPO DE OPERAÇÃO</div></td>
                            <td align="center" colspan="2"><div class="campo">QUANTIDADE</div></td>
                        </tr>
                        <tr>
                            <td align="center" colspan="2"><div class="campo">[&nbsp;&nbsp; ] DIÁRIAS ANTECIPADAS [&nbsp;&nbsp; ] DIÁRIAS VENCIDAS</div></td>
                            <td align="center" colspan="2"><div class="campo">[&nbsp;&nbsp; ] DIÁRIA INTEGRAL [&nbsp;&nbsp; ] 50% DIÁRIA INTEGRAL <br></bt>[&nbsp;&nbsp; ] 35% DIÁRIA INTEGRAL </div></td>
                        </tr>
                    
                        <tr>
                            <td colspan="4" align="center"><div class="campo">MISSÃO</div></td>
                        </tr>
                        <tr>
                            <td colspan="4"><div class="campo"><?php print utf8_encode($_dados[0]['missao']); ?></div></td>
                        </tr>
                        
                        <tr>
                            <td colspan="4"><div class="campo">TIPO DE TRANSPORTE : </div>
                                <div class="texto">
                                &nbsp;&nbsp;(<?php print ($_dados[0]['tp_transporte'] == '1') ? "X" : "&nbsp;&nbsp;";?>) veículo oficial;
                                &nbsp;&nbsp;(<?php print ($_dados[0]['tp_transporte'] == '2') ? "X" : "&nbsp;&nbsp;";?>) veículo particular, justificativa (Decreto nº 45260, Art 10);
                                &nbsp;&nbsp;(<?php print ($_dados[0]['tp_transporte'] == '3') ? "X" : "&nbsp;&nbsp;";?>) aeronave de Estado; 
                                &nbsp;&nbsp;(<?php print ($_dados[0]['tp_transporte'] == '4') ? "X" : "&nbsp;&nbsp;";?>) vôo comercial, solicito autorizaçã p/ aquisição de passagens;
                                &nbsp;&nbsp;(<?php print ($_dados[0]['tp_transporte'] == '5') ? "X" : "&nbsp;&nbsp;";?>) ônibus rodoviário</div>
                                
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><div class="campo">AUTORIDADE SOLICITANTE</div></td>
                            <td align="center"><div class="campo">Nº PM/MASP</div></td>
                            <td><div class="campo">CARGO OU FUNÇÃO</div></td>
                        </tr>
                         <tr>
                            <td colspan="2" align="center"><div class="texto"><?php print $_funcionario -> getFuncionarioId($_dados[0]['id_chefe']); ?></div></td>
                            <td align="center"><div class="campo"><?php print $_chefeDireto['num_masp']; ?></div></td>
                            <td align="center"><div class="campo"><?php print utf8_encode($_chefeDireto['desc_funcao']); ?></div></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><div class="campo">LOCAL</div></td>
                            <td align="center"><div class="campo">DATA</div></td>
                            <td align="center"><div class="campo">ASSINATURA</div></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><div class="texto">Belo Horizonte/MG</div></td>
                            <td><br></td>
                            <td></td>
                        </tr>
                                          
                        <tr>
                            <td colspan="4" align="center"><div class="campo">PRESTAÇÃO DE CONTAS</div></td>
                        </tr>  
                        <tr>
                            <td colspan="4" align="center"><div class="campo">RELATÓRIO DE VIAGENS REALIZADAS</div></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <table width="100%" class="" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td rowspan="2" align="center"><div class="campo" style="border-right: 0.1em solid; border-bottom: 0.1em solid; height: 30px;">DIA</div></td>
                                        <td rowspan="2" align="center"><div class="campo" style="border-right: 0.1em solid; border-bottom: 0.1em solid; height: 30px;">MÊS</div></td>
                                        <td rowspan="2" align="center"><div class="campo" style="border-right: 0.1em solid; border-bottom: 0.1em solid; height: 30px;">PROCEDÊNCIA</div></td>
                                        <td rowspan="2" align="center"><div class="campo" style="border-right: 0.1em solid; border-bottom: 0.1em solid; height: 30px;">DESTINO</div></td>
                                        <td align="center" style="border-bottom: 0.1em solid;"><div class="campo">HORÁRIO</div></td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 0.1em solid;"><table align="center" class="tabela_dsp" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td align="center" width="50%" class="campo" style="border-right: 0.1em solid;">Saída</td>
                                                    <td align="center" width="50%" class="campo">Chegada:</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border-right: 0.1em solid; border-bottom: 0.1em solid;"><br></td>
                                        <td style="border-right: 0.1em solid; border-bottom: 0.1em solid;"></td>
                                        <td style="border-right: 0.1em solid; border-bottom: 0.1em solid;"></td>
                                        <td style="border-right: 0.1em solid; border-bottom: 0.1em solid;"></td>
                                        <td style="border-bottom: 0.1em solid;"><div style="border-right: 0.1em solid; width: 50%;">&nbsp;</div></td>
                                    </tr>
                                    <tr>
                                        <td style="border-right: 0.1em solid; border-bottom: 0.1em solid;"><br></td>
                                        <td style="border-right: 0.1em solid; border-bottom: 0.1em solid;"></td>
                                        <td style="border-right: 0.1em solid; border-bottom: 0.1em solid;"></td>
                                        <td style="border-right: 0.1em solid; border-bottom: 0.1em solid;"></td>
                                        <td style="border-bottom: 0.1em solid;"><div style="border-right: 0.1em solid; width: 50%;">&nbsp;</div></td>
                                    </tr>
                                    <tr>
                                        <td style="border-right: 0.1em solid; border-bottom: 0.1em solid;"><br></td>
                                        <td style="border-right: 0.1em solid; border-bottom: 0.1em solid;"></td>
                                        <td style="border-right: 0.1em solid; border-bottom: 0.1em solid;"></td>
                                        <td style="border-right: 0.1em solid; border-bottom: 0.1em solid;"></td>
                                        <td style="border-bottom: 0.1em solid;"><div style="border-right: 0.1em solid; width: 50%;">&nbsp;</div></td>
                                    </tr>
                                    <tr>
                                        <td style="border-right: 0.1em solid;"><br></td>
                                        <td style="border-right: 0.1em solid;"></td>
                                        <td style="border-right: 0.1em solid;"></td>
                                        <td style="border-right: 0.1em solid;"></td>
                                        <td><div style="border-right: 0.1em solid; width: 50%;">&nbsp;</div></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td align="center"><div class="campo">VALOR ADIANTAMENTO</div></td>
                            <td align="center"><div class="campo">VALOR RECEBIDO</div></td>
                            <td align="center"><div class="campo">RESSARCIMENTO</div></td>
                            <td align="center"><div class="campo">DEVOLUÇÃO</div></td>
                        </tr>
                        <tr>
                            <td><br></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><br></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div class="texto">VALOR POR EXTENSO :<br><br></div> 
                                <div class="texto" style="float: left; width: 30%;">DATA _____/______/_________</div>
                                <div class="texto" align="center">___________________________________</div>
                                
                                <div class="texto" style="float: left; width: 30%;">&nbsp;</div><div class="texto" align="center">Assinatura do Diligente</div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4"><div class="texto">
                                &nbsp;&nbsp;&nbsp;&nbsp;Declaro que nao resido na(o) localidade(s) destino e que não houve pousada e alimentação com custo para outros órgãos públicos</div>
                                <br>
                                <div class="texto" style="float: left; width: 30%;">DATA _____/______/_________</div>
                                <div class="texto" align="center">___________________________________</div>
                                
                                <div class="texto" style="float: left; width: 30%;">&nbsp;</div><div class="texto" align="center">Assinatura do Diligente</div>
                            </td>
                       </tr>
                       <tr>
                        <td colspan="4">
                            <div class="texto" style="width: 35%; float:left;">APROVO O RELATÓRIO :</div>
                            <div class="texto" style="width: 65%; float:left; text-align: right;">APROVO A PRESTAÇÃO DE CONTAS&nbsp;&nbsp;&nbsp;</div>
                            <br>
                            <div class="texto" style="width: 35%; float: left; ">DATA _____/______/_________</div>
                            <div class="texto" style="width: 35%; float: right; text-align: right;">DATA _____/______/_________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><br><br>
                            <div class="texto" style="width: 35%; text-align: center; float: right;">______________________________________________</div>
                            <div class="texto" style="width: 35%; text-align: center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________________________</div>
                            <div class="texto" style="width: 35%; float:left; text-align: center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php print $_chefeDireto['nome']; ?></div>
                            <div class="texto" style="width: 35%; float: right; text-align: center"><?php print CHEFEDRH; ?>- DRH</div>
                            <div class="texto" style="width: 35%; float: left; text-align: center">&nbsp;<?php print utf8_encode($_chefeDireto['desc_funcao']);?></div>
                            <div class="texto" style="width: 35%; float: right; text-align: center">&nbsp;Diretoria de Recursos Humanos</div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <table>
                                     <tr>
                                        <td style="border-right: 0.1em solid;"><div class="texto">APROVO A PRESTAÇÃO DE CONTAS:</div></td>
                                        <td style="border-right: 0.1em solid; text-align: center; vertical-align: bottom"><div class="texto"><?php print ODESPESA."<br>Ordenador de Despesas";?></div></td>
                                        <td align="center" style="border-right: 0.1em solid;"><div class="texto"><br>____/_____/_____<br>
                                            DATA</div>
                                        </td>
                                        <td align="center" ><div class="texto"><br>Nº PM ORDENADOR : <?php print NUMODESPESA; ?></div></td>
                                    </tr>                   
                                </table>
                            
                            </td>
                        </tr>                   
            
                    </table>

                </table>  
           </div>       
</body>
</html>