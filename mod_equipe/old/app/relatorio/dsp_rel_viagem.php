<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">";
include_once PATH.'/include.php';

$_conexao = new ConexaoMysql();

$_dsp = new EquipeDSP();

$_id_dsp = isset($_GET['id']) ? $_GET['id'] : "";

$_dados = $_dsp -> buscaDspDados($_id_dsp);

$_cmd_dsp = $_dsp -> BuscaCmd($_id_dsp);

//var_dump($_cmd_dsp);

//var_dump($_dados);

$_funcionario = new EquipeFuncionario();

//var_dump();

//<!-- membros da equipe -->
$_membros = $_dsp -> buscaMembrosDSP($_id_dsp);

//var_dump($_membros);
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php print TITULO; ?></title>
        <!--<link href="<?php #print SISTEMA; ?><!--/css/bootstrap.css" rel="stylesheet" media="print">
        <link href="<?php #print SISTEMA; ?>/css/bootstrap-responsive.css" rel="stylesheet" media="print" >-->
        <style type="text/css">
        
            * {
                
                font: 12pt "Tahoma";
                box-sizing: border-box;
                -moz-box-sizing: border-box;
            }
            
            
            .texto {
            
                font-size: 10px;
                padding: 0;
                margin: 0;
                border-spacing :0;
           
            }

            .campo {
            
                font-size: 11px;
                padding: 0;
                margin: 0;
                border-spacing :0;
           
            }
            
            .noquebralinha {
            
                white-space: nowrap;
            
            }
           
 
            @media screen{
                
                
        
                body {
                    margin: 0;
                    padding: 0;
                    background-color: #FAFAFA;
                    
                }
                
                 .paginaLandscape {
                    width: 29.7cm;
                    min-height: 21cm;
                    padding: 0.5cm;
                    margin: 0.5cm auto;
                    border: 1px #D3D3D3 solid;
                    border-radius: 5px;
                    background: white;
                    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
                }
                
                table {
    
                    width: 100%;
                    margin: 0;
                    padding: 0;
                   
                }
                
                
            }
            
            
            @media print {
            
                .imprimir {
            
                display: none;
            
            }
                
   
                body {
                    margin: 0;
                    padding: 0;
                    
                }
                
                .paginaLandscape {
                    min-width: 29.7cm;
                    /* min-height: 28cm; */
                   min-height: 21cm;
                    padding: 0.5cm;
                    margin: 0.5cm auto;
                }
                                
                
    
                
                table {
    
                    width: 100%;
                    margin: 0;
                    padding: 0;
                    border-collapse: collapse;
                    
                    
                }
                
                
            }

</style>
</head>
    <body>
        <div class="topo">
            <br>
                <div class="imprimir" style="text-align: center">
                    <?php print FuncaoBase::voltar(); ?>
                    <?php print FuncaoBase::vifs('imprimir'); ?>
                </div>
        </div>
        


        <!--##########################################   ANEXO RELATORIO DE VIAGEM MILITAR ################################################-->
        <div class="paginaLandscape">
            
            <table class="tabela_dsp" border="1" align="left" cellpadding="0" cellspacing="0" >
                <tr>
                    <td colspan="13" align="center"><br>
                        <img src="/imagem/logo_gab.png" /><br><br>
                    </td>
                </tr>
                <tr>
                    <td class="campo" colspan="13" align="center">
                        <br>
                        Anexo ao Relatório de Viagem nº ______/____________
                        <br><br>
                    </td>
                </tr>
                <tr>
                    <th><span class="texto">Número PM/BM</span></th>
                    <th><span class="texto">Posto</span></th>
                    <th><span class="texto">Nome</span></th>
                    <th><span class="texto">QQ</span></th>
                    <th><span class="texto">&nbsp;&nbsp;Diárias Adiantadas&nbsp;&nbsp;</span></th>
                    <th><span class="texto">&nbsp;&nbsp;Valor de Diárias Adiantadas&nbsp;&nbsp;</span></th>
                    <th><span class="texto">&nbsp;&nbsp;Diárias a Complementar&nbsp;&nbsp;</span></th>
                    <th><span class="texto">&nbsp;&nbsp;Valor de Diárias a Complementar&nbsp;&nbsp;</span></th>
                    <th><span class="texto">&nbsp;&nbsp;Diárias Recebidas&nbsp;&nbsp;</span></th>
                    <th><span class="texto">&nbsp;&nbsp;Valor diárias empenh.a receber&nbsp;&nbsp;</span></th>
                    <th><span class="texto">&nbsp;&nbsp;Diárias a devolver&nbsp;&nbsp;</span></th>
                    <th><span class="texto">&nbsp;&nbsp;valor Diárias a Devolver&nbsp;&nbsp;</span></th>
                    <th><span class="texto">&nbsp;&nbsp;Total Recebido&nbsp;&nbsp;</span></th>
                </tr>
                
                <?php
                
                $_qtd_membro = count($_membros);
                
                
                for ($k = 1; $k < $_qtd_membro; $k++) {
        
                    //var_dump($_qtd_membro)
        
                    print "<tr>
                        <td class=\"noquebralinha\">&nbsp;&nbsp;<span class=\"texto\">" . $_membros[$k]['num_masp'] . "&nbsp;&nbsp;</td>
                        <td class=\"noquebralinha\">&nbsp;&nbsp;<span class=\"texto\">" . $_membros[$k]['posto'] . "&nbsp;&nbsp;</td>
                        <td class=\"noquebralinha\">&nbsp;&nbsp;<span class=\"texto\">" . utf8_encode($_membros[$k]['nome']) . "&nbsp;&nbsp;</td>
                        <td>&nbsp;&nbsp;<span class=\"texto\">" . $_membros[$k]['quinquenio'] . "&nbsp;&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>";
        
                }
                ?>
                
                
               
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="campo">Soma :</div><br></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="texto">
                            <br>
                        &nbsp;&nbsp;Em ___/____/______ O(s) militar(es) relacionado(s) acima participou/participaram da DSP autorizada pelo Ordenador de Despesas.<br>
                        <br>
                        &nbsp;&nbsp;Diligente :<br>
                        
                        <div class="campo" style="text-align: center">______________________________________<br>
                        <?php print utf8_encode($_cmd_dsp['nome']) . ", " . $_cmd_dsp['posto']; ?><br>
                        Responsável pela Diligência</div>
                        
                    </td>
                    <td colspan="7">
                        <div class="texto">
                            <br>
                        &nbsp;&nbsp;Em: ____/_____/________<br>
                        <br>
                        &nbsp;&nbsp;(&nbsp;&nbsp;) Os Valores lançados acima estão corretos.</div><br>
                        <div class="campo" style="text-align: center">______________________________________<br>
                        <?php print CHEFEDRH; ?><br>
                        Diretoria de Recursos Humanos</div>
                        
                    </td>
                </tr>
                <tr>
                    <td colspan="13">
                        <div class="campo">
                        &nbsp;&nbsp;Data _____/____/_________
                        </div>
                        <div class="texto">               
                        &nbsp;&nbsp;(&nbsp;&nbsp;) Ciente<br>
                        &nbsp;&nbsp;(&nbsp;&nbsp;) Retornar para Correção<br><br></div>
                        
                    <div class="campo" style="text-align: center">
                        <span class="texto">_____________________________________&nbsp;&nbsp;<br>
                        <?php print ODESPESA; ?>&nbsp;&nbsp;&nbsp;&nbsp;<br>
                        Ordenador de Despesas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div>
        
                    </td>           
                </tr>
           
            </table>
            
        </div>