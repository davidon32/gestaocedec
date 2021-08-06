<?php

$_loginEx = new LoginExterno();

$acessoModulo = $_loginEx->acessoModulo($page['session']['seguranca']['idUser']);

  					print ($acessoModulo['mod_pipa'] == '1') ? 
	  					'<li><a class="" href="?modulo=pipa&controller=pmda&acao=index" title="Acesso ao PMDA on-line"><i class="fa fa-th"></i>PMDA on-line</a></li>' : '';
	  				
	  				print ($acessoModulo['mod_compdec'] == '1') ? 
	  						'<li><a class="" href="?modulo=compdec&controller=compdec&action=menucompdec" title="Acesso Cadastro de Compdecs"><i class="fa fa-th"></i>Dados Compdec</a></li>' : '';
	  				
	  				print ($acessoModulo['mod_ajuda'] == '1') ? 
	  						'<li><a class="" href="?modulo=ajuda&secao=liberacao&acao=index" title="Ajuda Humanitária"><i class="fa fa-th"></i>Ajuda Humanitária</a></li>' : '';
								
	  				print ($acessoModulo['mod_plano'] == '1') ? 
	  						'<li><a class="" href="?modulo=compdec&controller=plano&action=planobusca" title="Confecção do Plano de Contingencia"><i class="fa fa-th"></i>Plano de Contingencia</a></li>' : '';
  				?>
