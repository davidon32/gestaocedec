<?php include_once '../../include.php';

$_conexao = new ConexaoMysql();

?>
<html>
<head>
<title><?php print TITULO;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../../css/estilo.css">
<script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
<style type="text/css" >
<!--
    @media print {
    
        .cabecalho {
            display: none;
        }
        
        #imprimir {
        
            display: none;
        
        }
        
        .margen {
	
            padding: 30px;
}
    
    }
-->
</style>

</head>
<body style="width: 800px;">
    <div class="margen">
<br />
	<form action="#" method="POST" name="pesq" id="pesq" class="" />

    	<table border="0" id="cabecalho" class="cabecalho" cellspacing="0" cellpadding="0" align="center" width="500">
    		<tr>
    			<th colspan="4"><span class="titulo">Relatório de Pagamento Anual de Pipeiros</span><br /><br /></th>
    		</tr>
    		<tr>
    			<td style="text-align: right;"><label for="campo">Ano</label></td>
    			<td style="text-align: left">:<input type="text" name="ano" id="campo" size="15" class="" maxlength="4" />
    			<td>
    			    <table width="150" border="0">
    			        <tr>
    			            <td style="vertical-align: middle;">
    			                Total Pago :<input type="radio" name="opcao" value="1" id="" class="" />
    			            </td>
    			        </tr>
    			        <tr>
    			            <td valign="middle">
    			                Detalhado :<input type="radio" name="opcao" value="2" id="" class="" />
    			            </td>
    			        </tr>
    			    </table>
    			</td>
    			<td><input type="submit" name="pesquisa" id="pesquisa" value="Pesquisar"/>
    			</td>
    		</tr>
    	</table>

	</form>



<?php 

$ano = isset($_POST['ano']) ? preg_replace('/[^[:alnum:]_]/', '', $_POST['ano']) : null;

$opcao = isset($_POST['opcao']) ? preg_replace('/[^[:alnum:]_]/', '', $_POST['opcao']) : null;

$enviar = isset($_POST['pesquisa']) ? preg_replace('/[^[:alnum:]_]/', '', $_POST['pesquisa']) : null;


if($enviar == 'Pesquisar') {

$dados = Relatorio::totalPagoAnual($ano, $opcao);

//var_dump($dados);

    print "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"500\">
                <tr><td colspan=\"2\" style=\"text-align:center;\"><input type=\"button\" onclick=\"window.print();\" name=\"imprimir\" id=\"imprimir\" value=\"Imprimir\"/><br /></br /></td></tr>
                <tr>
                <th colspan=\"2\" align=\"center\">VALOR BRUTO PAGAMENTO PIPEIRO EM ".$ano."<br /><br /></th>
                  </tr>
                  <tr>
                    <td valign=\"top\" align=\"center\">Nome</td>
                    <td valign=\"top\" algin=\"center\">Total Recebido<br /><br /></td>
                  </tr>";
    
    for ($i = 0; $i < count($dados); $i++) {
        
        if(($i % 2) == 0) {
        print "<tr><td style=\"text-align:left; background:silver; width:250px;\">".htmlentities($dados[$i]['nome'])."</td>
                   <td style=\"background:silver; text-align:left;width:150px;\">R$ ".number_format($dados[$i]['Pagamento'], 2, ',', '.')."</td>
              </tr>";
        }else {
            print "<tr><td style=\"text-align:left;\">".htmlentities($dados[$i]['nome'])."</td>
            <td style=\"text-align:left;\">R$ ".number_format($dados[$i]['Pagamento'], 2, ',', '.')."</td>
            </tr>";
            
        }
        
        
    }
    
    print "<tr>
                <td style=\"text-align:left;\">
                    <br /><br />
                    TOTAL
                </td>
                <td style=\"text-align:left;\">
                
                    <br /><br />
                    R$
                </td>
           </tr></table>";


}

?>


</div>

</body>
</html>



