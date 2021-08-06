<?php session_start();  
print "<!DOCTYPE html>";
include_once PATH.'/include.php';
/************************************************************************************+
 #	Secretária  : Gabinete Militar do Governado de Minas Gerais                      #
 #	Órgão       : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais   #
 #  Autor       : Demetrio S. Passos     											 #
 #  Criação     : 18/12/2013														 #
 #	Descrição   :
 #
 +************************************************************************************/


$_conexao = new ConexaoMysql();

$id = isset($_GET['id']) ? $_GET['id'] : "";


$dados = EquipeFuncionario::RelatorioGeralFuncionario($id);


?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO;?></title>
<link href="/css/bootstrap.css" rel="stylesheet">
<link href="/css/bootstrap-responsive.css" rel="stylesheet">
<style type="text/css">

    @media print {

        .imprimir {

            display: none;
        }
        
        small{
            
            font-size: 10px;
        }
        
        legend {
            
            text-align: center;
        }
        
        border {
            border :0.1em solid;
        }

    }

</style>
</head>
<body>
    <div class="container">
        <div class="span12 text-center imprimir">
            <br />
            <?php FuncaoBase::imprimir(); print "&nbsp;&nbsp;". FuncaoBase::voltar();?>
        </div>
		<div class="span2">&nbsp;</div>
		<div class="span8"><br><br>
		    <legend>Relatorio de Cadastro de Funcionários</legend><br />
				<?php

					for ($i=0; $i < count($dados); $i++) {
					
				        print "<table align=\"center\" class=\"table table-condensed\" width=\"80%\" >
                            
            				<tr>
            					<td>Código</td><td>:".$dados[$i]['id_funcionario']."</td>
            				</tr>
                 			<tr>
                 				<td>Nº Polícia / Masp</td><td>: ".$dados[$i]['num_masp']."</td>
                 			</tr>
                 			<tr>
                 				<td>Nome</td><td>:".utf8_encode($dados[$i]['nome'])."</td>
                 			</tr>
                 			<tr>
                 				<td>Endereco</td><td>:".utf8_encode($dados[$i]['endereco'])."</td>
                 			</tr>
                 			<tr>
                 				<td>Bairro</td><td>:".utf8_encode($dados[$i]['bairro'])."</td>
                 			</tr>
                 			<tr>
                 				<td>Cidade</td><td>:".Municipio::PegaNomeMunicipio($dados[$i]['cidade'])."</td>
                 			</tr>
                 			<tr>
                 				<td>Telefone</td><td>:".$dados[$i]['telefone']."</td>
                 			</tr>
                 			<tr>
                 				<td>Celular</td><td>:".$dados[$i]['celular']."</td>
                 			</tr>
                 			<tr>
                 				<td>Posto</td><td>:".$dados[$i]['posto']."</td>
                 			</tr>
                 			<tr>
                 				<td>Seção</td><td>:".$dados[$i]['secao']."</td>
                 			</tr>
                 			<tr>
                 				<td>Função</td><td>:".utf8_encode($dados[$i]['funcao'])."</td>
                 			</tr>
                 			<tr>
                 				<td>Descr. Função</td><td>:".utf8_encode($dados[$i]['desc_funcao'])."</td>
                 			</tr>
                 			<tr>
                 				<td>Quinquênio</td><td>:".$dados[$i]['quinquenio']."</td>
                 			</tr>
                 			<tr>
                 				<td>Data Nasc.</td><td>:".DataMysql::dataVisual($dados[$i]['dt_nasc'])."</td>
                 			</tr>
                 			<tr>
                 				<td>Curso</td><td>:".$dados[$i]['curso']."</td>
                 			</tr>
                 			<tr>
                 				<td>E-mail</td><td>:".$dados[$i]['email']."</td>
                 			</tr>
                 			<tr>
                 			<td align=\"center\" colspan=\"2\">
                            <br>";
                            
                                $conta = EquipeFuncionario::ContaBanco($dados[$i]['id_funcionario']);
         			    
                 			    for ($j=0; $j < count($conta); $j++) {
                 			        
                                    $principal = ($conta[$j]['principal'] == '1') ? "Sim": "Não"; 
                                    $tipoConta = ($conta[$j]['tipo'] == "1") ? "CC" : "Poupanca";
									 
								    print "<table class='table table-bordered' width='100%'>
                 				       <tr>
                 				           <td align=\"center\" colspan=\"6\" > Dados Bancários</td>
                 				       </tr>
                 				       <tr>
                 				           <td width='10%'>Banco</td>
                 				           <td width='10%'><i>{$conta[$j]['nom_banco']}</i></td>
                 				           <td width='10%'>Nr Banco</td>
                 				           <td width='25%'><i>{$conta[$j]['num_banco']}</i></td>
                 				           <td width='24%'>Conta</td>
                 				           <td width='25%'><i>{$conta[$j]['conta']}</i></td>
                 				       </tr>
                 				       <tr>
                 				           <td>Agencia</td>
                 				           <td><i>{$conta[$j]['agencia']}</i></td>
                 				           <td>Tipo</td>
                 				           <td><i>{$tipoConta}</i></td>
                 				           <td>Conta Principal</td>
                 				           <td><i>{$principal}</i></td>
                 				       </tr>
                 				   </table>";
                                }
                                
                                print "
                 				</td>
                			</tr>
                			<tr>
                                <td colspan=\"2\"><hr></td>
                            </tr>
                		</table>";

                print "<div style=\"page-break-before: always\"><br><br></div>";

}
?>

</div>
</div>
			
	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.js"></script>
	<script src="/js/jasny-bootstrap.js"></script>
	<script src="/js/funcaobase.js"></script>
</body>
</html>