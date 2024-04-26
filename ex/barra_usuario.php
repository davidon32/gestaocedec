<?php $id_session = session_id();
    if(empty($id_session)) session_start();
?>
<div class="col-xs-12 imprimir" style="background-color: #000000; color: #FFFFFF;">
  		<div class="col-xs-7" style="height: 50px; line-height: 50px;">
  			<b><i><?php print Municipio::PegaNomeMunicipio($_SESSION['seguranca']['id_municipio']);?></i></b> 

  		</div>
		<!-- TESTE UPLOAD-->
  		<?php if(isset($_GET['a'])){
  			
	  			print "<div class='col-xs-5' style='height: 50px; line-height: 50px; text-align:rigth'>
    						<p style='text-align:right;'><a href='?modulo=pipa&secao=pmda&acao=adm' class='btn btn-primary' >Voltar</a><p/>
    					</div>";
	  			
	  		}else { ?>
	  		<div class="col-xs-2" style="height: 50px; line-height: 50px;">
  		</div>
  		<div class="col-xs-3" style="height: 50px; line-height: 50px;">
  			<a href="?secao=login&acao=logoutEx" title="Sair do Sistema"  id="logout" class="itemMenu">Sair do Sistema</a>&nbsp;&nbsp;&nbsp;&nbsp; 
  			<a href="index.php?secao=usuario&acao=trSenha?p=<?=date('h');?>" title="Trocar Senha"  id="trSemha" class="itemMenu">Troca de Senha</a>&nbsp;&nbsp;&nbsp;&nbsp; 
  			<a href="?secao=usuario&acao=user" title="Dados Usuário"  id="trSemha" class="itemMenu">Dados Usuário</a> 
  		</div>
</div>
<div class="col-xs-12 text-center">
	<div class="col-xs-3">
		<br>
		<img src="imagem/logo_novo_2.png" class="img-responsive">
	</div>
<?php
		if($secao == "menu"){
			print '<div class="col-xs-9 text-left">
						<h1>Serviços para o Município</h1>
						<h4>Coordenadoria Estadual de Defesa Civil de Minas Gerais</h4>
					</div>'; 
		} else if($secao == 'compdec'){
			print '<div class="col-xs-9">
						<h2> Coordenadoria Municipal de Proteção e Defesa Civil </h2>
						<h4>Dados do COMPDEC</h4>
					</div>'; 
		} else if($secao == 'liberacao') {
			print '<div class="col-xs-9">
						<h1>Ajuda Humanitária</h1>
						<h4>-</h4>
					</div>'; 

		} else if($secao == 'pmda'){
			print '<div class="col-xs-9">
						<h1>TDAP - Transporte e Distribuição de Água Potável</h1>
						<h4>PMDA - Plano Municipal de Distribuição de Água</h4>
					</div>'; 
		} else {

			
			print '<div class="col-xs-9">
						<h1>Plano de Contingência</h1>
						<h4>Plano de Contingência on-line</h4>
						<br>
					</div>'; 
	 	}
	 		
	 		
  		}
	?>
</div>
