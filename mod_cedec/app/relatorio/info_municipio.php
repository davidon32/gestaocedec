<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">";
include_once PATH.'/include.php';

//$_conexao = new ConexaoMysql();

$_id = isset($_GET['id']) ? $_GET['id'] : "";

$dadosMunicipio = "";
$dadosCompdec = "";
$dadosLiberacao = "";
$dados


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
                                                                
                        print "<a class='btn' href='index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=&modulo=cedec&secao=municipio&acao=filtro_info_municipio'>Voltar</a>&nbsp;&nbsp;";
                        
                        print FuncaoBase::vifs('imprimir');  
                   
                    ?>
                </div>
        </div>
         
        <!-- ORDEM DE SERVICO MILITAR -->
        <div class="pagina">
            <div style="text-align: center">
                Relatório de Informações Municipais
            </div>
            
            <div>
                <hr>
                <!-- DADOS DO MUNICIPIO-->
                <table>
                    <tr>
                        <th colspan="2" align="center">Dados do Município</th>
                    </tr>
                    <tr>
                        <td width="20%">Nome</td>
                        <td>:</td>
                    </tr>
                    <tr>
                        <td>Distância</td>
                        <td>:</td>
                    </tr>
                    <tr>
                        <td>Depósito Avançado</td>
                        <td>:</td>
                    </tr>
                </table>  
            </div>
            <div>
                <hr>
                <table>
                    <tr>
                        <th colspan="6">Dados do Compdec</th>
                    </tr>
                    <tr>
                        <td width="15%">Lei de Criação</td>
                        <td width="15%">:</td>
                        <td width="15%">Decreto</td>
                        <td width="15%">:</td>
                        <td width="15%">Portaria</td>
                        <td width="15%">:</td>
                    </tr>
                    <tr>
                        <td colspan="2">Coordenador Municipal</td>
                        <td>:</td>
                    </tr>
                </table>
            </div>
            <div>
                <hr>
                <table>
                    <tr>
                        <th>Liberações</th>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div>
                <hr>
                <table>
                    <tr>
                        <th colspan="4">Processos</th>
                    </tr>
                    <tr>
                        <td>
                            ___________________________<br><br>
                            ___________________________<br><br>
                            ___________________________<br><br>
                            ___________________________<br><br>
                        </td>
                        
                        <td><br>Situação<br><br>
                            <input type="checkbox" />Análise<br><br>
                            <input type="checkbox" />Homologado/Reconhecido<br><br>
                            <input type="checkbox" />Arquivado<br><br>
                        </td>
                    </tr>
                </table>
                
            </div>
            <div>
                
                Determino-lhe proceder a liberação dos seguintes materiais<br>
                <br>
                <table>
                    <tr>
                        <td width="50%">
                            (&nbsp;&nbsp;&nbsp;&nbsp;) __________ Cestas básicas de 10k<br><br>
                            (&nbsp;&nbsp;&nbsp;&nbsp;) __________ Cestas Básicas de 18k<br><br>
                            (&nbsp;&nbsp;&nbsp;&nbsp;) __________ Cestas Básicas SERVAS<br><br>
                            (&nbsp;&nbsp;&nbsp;&nbsp;) __________ Colchões<br><br>
                            (&nbsp;&nbsp;&nbsp;&nbsp;) __________ Cobertores<br><br>
                            (&nbsp;&nbsp;&nbsp;&nbsp;) __________ Bobinas de lina Plástica<br><br>
                            (&nbsp;&nbsp;&nbsp;&nbsp;) __________ Sacos de Roupas<br><br>
                            (&nbsp;&nbsp;&nbsp;&nbsp;) __________ Telhas de amianto<br><br>            
                        </td>
                        <td width="50%">
                            Beneficiado : ________________________________<br><br>
                            Depósito&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ________________________________<br>
                            <br>
                            
                            <input type="checkbox"> : O municício virá buscar <br><br>
                            <input type="checkbox"> : Entregar no local <br>           
                        </td>
                    </tr>
                </table>
                <div align="center">_________________________________________<br>
                    <?=SECEXEC;?>
                </div>
                
            </div>
            
               
        </div>