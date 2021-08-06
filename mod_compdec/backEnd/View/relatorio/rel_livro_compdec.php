<?php include_once PATH.'/core/include.php';

$con = Conexao::getInstance();

//$_login = new Login();

//$_login->logado();

$_funcaoBase = new FuncaoBase();

$_municipio = new Municipio();

$_compdec = new Compdec();

$eqCompdec = new MembroEqCompdec();

$_regiao = new Regiao();

$_associacao = new Associacao();

$_dados = $_compdec->buscaDadosCompdec();

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo TITULO; ?></title>
<link href="/css/bootstrap.css" rel="stylesheet" >
<link href="/css/bootstrap-responsive.css" rel="stylesheet" >
<link href="/css/impressaoa4.css?q=1" rel="stylesheet" >

<style type="text/css">
	#rodape {page-break-after: always};	
	* {
		font-size: 10px;
	}
</style>
</head>
<body>
        <?php

        	foreach ($_dados as $dadosCompdec) {
        		$dadosMunicipio = $_municipio->dadosMunicipio($dadosCompdec['id_municipio']);
        ?>
				    <div class="page">
	                <div class="text-center"><legend><?=$_municipio->PegaNomeMunicipio($dadosCompdec['id_municipio']); ?></legend></div>
	                <div class="">Situação Compdec: <?=($dadosCompdec['com_const']) == 0 ? "<span style='color: red;'>Inativo</span>" : "Ativo";?></div>
	                <br>
	                <table class="table table-striped table-bordered table-condensed" align="center">
	                	<tr>	
                                    <td style="text-align: center;"><img src="/anexo/compdec/<?=AnexoCompdec::Foto($dadosCompdec['id_municipio']);?>" style="padding-bottom: 3px; max-width: 80px;"></td>
	                		<td colspan="3">Prefeito : <?=(isset($dadosMunicipio['nome'])) ? $dadosMunicipio['nome'] : "-";?><br>
	                						Telefone: <?=(isset($dadosMunicipio['telefone'])) ? $dadosMunicipio['telefone'] : "-";?><br>
	                						Celular: <?=(isset($dadosMunicipio['celular'])) ? $dadosMunicipio['celular'] : "-";?><br>
	                						Email: <?=(isset($dadosMunicipio['email'])) ? $dadosMunicipio['email'] : "-";?></td>
	                	</tr>
	                    <tr>
	                        <td width="20%"><b>Municipio</b></td>
	                        <td width="30%"><?php print $_municipio->PegaNomeMunicipio($dadosCompdec['id_municipio']);?></td>
	                        <td width="20%"><b>Região</b></td>
	                        <td width="30%"><?php print $_regiao->PegaNomeRegiao($dadosCompdec['regiao']);?></td>
	                    </tr>
	                    <tr>
	                        <td width="15%"><b>Associação</b></td>
	                        <td colspan="3" width="85%"><?php print utf8_decode($_associacao->PegaNomeAssociacao($dadosCompdec['associacao']));?></td>
	                    </tr>
	                    <tr>
	                        <td width="15%"><b>Lei nº</b></td>
	                        <td width="35%"><?php print $dadosCompdec['num_lei'];?></td>
	                        <td width="15%"><b>Data Lei</b></td>
	                        <td width="35%"><?php print DataMysql::dataVisual($dadosCompdec['dt_lei']);?></td>
	                    </tr>
	                    <tr>
	                        <td width="15%"><b>Decreto nº</b></td>
	                        <td width="35%"><?php print $dadosCompdec['num_decreto'];?></td>
	                        <td width="15%"><b>Data Decreto</b></td>
	                        <td width="35%"><?php print DataMysql::dataVisual($dadosCompdec['dt_decreto']);?></td>
	                    </tr>
	                    <tr>
	                        <td width="15%"><b>Portaria nº</b></td>
	                        <td width="35%"><?php print $dadosCompdec['num_portaria'];?></td>
	                        <td width="15%"><b>Data Portaria</b></td>
	                        <td width="35%"><?php print DataMysql::dataVisual($dadosCompdec['dt_portaria']);?></td>
	                    </tr>
	                    <tr>
	                        <td width="15%"><b>Endereço</b></td>
	                        <td colspan="3" width="85%"><?php print utf8_encode($dadosCompdec['endereco']);?></td>
	                    </tr>
	                    <tr>
	                        <td width="15%"><b>Fone 1</b></td>
	                        <td width="35%"><?php print $dadosCompdec['fone_com1'];?></td>
	                        <td width="15%"><b>Fone 2</b></td>
	                        <td width="35%"><?php print $dadosCompdec['fone_com2'];?></td>
	                    </tr>
	                    <tr>
	                        <td width="15%"><b>Email</b></td>
	                        <td width="35%"><?php print $dadosCompdec['email'];?></td>
	                        <td width="15%"><b>Efetivo nº</b></td>
	                        <td width="35%"><?php print ($dadosCompdec['efetivo'] == 0) ? "0" : $dadosCompdec['efetivo'];?></td>
	                    </tr>
	                    <tr>
	                        <td width="15%"><b>Possui Nudec :</b></td>
	                        <td width="35%"><?php print ($dadosCompdec['regiao'] == 0) ? "Não" : "Sim";?></td>
	                        <td width="15%"><b>Quantos Nupde's :</b></td>
	                        <td width="35%"><?=$dadosCompdec['qtd_nudec'];?></td>
	                    </tr>
	                    <tr>
	                        <td width="15%"><b>Capacitação Membros :</b></td>
	                        <td width="35%"><?=$dadosCompdec['capacitacao_nupdec'];?></td>
	                        <td width="15%"><b>Possui Plano Cont.</b></td>
	                        <td width="35%"><?php print ($dadosCompdec['plano_cont'] == 0) ? "Não" : "Sim";?></td>
	                    </tr>
	                    <tr>
	                        <td width="15%"><b>Possui Capacitação :</b></td>
	                        <td width="35%"><?php print ($dadosCompdec['capacitacao']== 0) ? "Não": "Sim";?></td>
	                        <td width="15%"><b>Data :</b></td>
	                        <td width="35%"><?=DataMysql::dataVisual($dadosCompdec['dt_curso_capac']);?></td>
	                    </tr>
	                    <tr>
	                        <td width="15%"><b>Possui Cartão PDC :</b></td>
	                        <td width="35%"><?=print ($dadosCompdec['cartao_pdc']== 0) ? "Não": "Sim";?></td>
	                        <td width="15%"><b>Estrutura Compdec :</b></td>
	                        <td width="35%"><?="Sede Própria:".($dadosCompdec['sede_propria'] ==0 ? "Não" :"Sim");?><br>
	                        				<?="Viatura:".($dadosCompdec['viatura'] ==0 ? "Não" :"");?><br>
	                        				<?="Computadores:".($dadosCompdec['computador'] ==0 ? "Não" :"Sim");?>
	                        
	                        </td>
	                         <tr>
	                        <td width="15%"><b>Realiza Simulado :</b></td>
	                        <td width="35%"><?=($dadosCompdec['simulado']== 0) ? "Não": "Sim";?></td>
	                        <td width="15%"><b>Possui Mapeamento :</b></td>
	                        <td width="35%"><?=($dadosCompdec['mapeamento'] == 0 ? "Não" : "Sim");?></td>
	                    	</tr>
	                    	<tr>
	                    		<td colspan="4" style="text-align:center;">Sobre a Capacidade Gerencial da COMPDEC</td>
	                    	</tr>
	                    	 <tr>
	                        	<td width="15%"><b title="Curso de Gestão em Proteção e Defesa Civil e Mudanças Climáticas">Possui CGPDCMC :</b></td>
	                        	<td width="35%"><?=($dadosCompdec['curso_gestao']== 0) ? "Não": "Sim";?></td>
	                        	<td width="15%"><b>Data Curso Gestão :</b></td>
	                        	<td width="35%"><?=$dadosCompdec['dt_curso_gestao'];?></td>
	                        </tr>
	                        <tr>
	                        	<td width="15%"><b>Possui Curso de SCO :</b></td>
	                        	<td width="35%"><?=($dadosCompdec['curso_sco'] == 0 ? "Não" : "Sim");?></td>
	                        	<td width="15%"><b>Data SCO :</b></td>
	                        	<td width="35%"><?=$dadosCompdec['dt_curso_sco'];?></td>
	                    	</tr>
	                    	 <tr>
	                        	<td width="15%"><b>Particiou WorkShop :</b></td>
	                        	<td width="35%"><?=($dadosCompdec['particip_workshop']== 0) ? "Não": "Sim";?></td>
	                        	<td width="15%"><b>Data Partic. Workshop:</b></td>
	                        	<td width="35%"><?=$dadosCompdec['dt_partic_workshop'];?></td>
	                    	</tr>
	                    	 <tr>
	                        	<td width="15%"><b>Possui Experiência àrea DC :</b></td>
	                        	<td width="35%"><?=($dadosCompdec['exp_dc']== 0) ? "Não": "Sim";?></td>
	                        	<td width="15%"><b>Tempo Experiênciap:</b></td>
	                        	<td width="35%"><?=$dadosCompdec['tp_ex_dc'];?></td>
	                    	</tr>
	                  </table>
	                  <table class="table table-striped table-bordered table-condensed" align="center" width="100%">
	                    <tr>
	                        <td width="30%"><b>Nome</b></td>
	                        <td width="15%"><b>Função</b></td>
	                        <td width="20%"><b>Fone</b></td>
	                        <td width="20%"><b>Cel</b></td>
	                        <td width="15%"><b>Email</b></td>
	                    </tr>
	                    
	                    <?php
	                    
	                    /* representantes compdec */
	                    $repCompdec = $eqCompdec->listaMembro($dadosCompdec['id_municipio']);
	                    	
	                    foreach ($repCompdec as $value) {
	                    	print "<tr>";
	                    	print "<td>".$value['nome']."</td>";
	                    	print "<td>".$value['funcao']."</td>";
	                    	print "<td>".$value['telefone']."</td>";
	                    	print "<td>".$value['celular']."</td>";
	                    	print "<td>".$value['email']."</td>";
	                    	print "<tr>";
	                    }
	              
	                    ?>
	  
	                </table>
	            </div>
   
	        	<?php
	        	/* fecha foreach */
                        
					 }
					 
				?>
	</div>
        <!-- RODAPE -->
        <div class="row-fluid" id="rodape">
            <div class="span12 text-center">
                <hr>
                <small><?php print RODAPE;?></small>
            </div>
        </div>

    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/jasny-bootstrap.js"></script>
    <script src="/js/funcaobase.js"></script>
</body>
</html>
