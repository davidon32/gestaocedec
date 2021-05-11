<?php 

	/*	0.0.0.0.0
	 *  | | | |__ Atualizações de Correçoes de erros
	*   | | |______ Atualizações de Melhorias
	*   | |	|________ Atualizações de Banco de Dados
		| |____________	Implementação
	*   |________________ Atualizações de Layout
	*/

	$_data = '06/02/2014';

	###################################### CORREÇOES #########################################

	$_correcoes[] = 'Correções de acesso';
	$_correcoes[] = '';

	###################################### MELHORIAS #########################################

	$_melhorias[] = 'performance do relatorio de rpa';
	$_melhorias[] = 'sistema de validação de formulario';

	###################################### BANCO DE DADOS #########################################

	$_banco_dados[] = 'remodelar a transferencia de materiais';


	###################################### IMPLEMENTAÇÕES #########################################

	$_implementacoes[] = 'cadastro de usuario do sistema';
	$_implementacoes[] = '';


	###################################### LAYOUT #########################################

	$_layout[] = 'acesso paginas via include';
	$_layout[] = 'padrao bootstrap';

	end($_layout);
	end($_correcoes);
	end($_melhorias);
	end($_banco_dados);
	end($_implementacoes);

	$_versao = key($_correcoes).".".key($_melhorias).".".key($_banco_dados).".".key($_implementacoes).".".key($_layout);

	
	
	 key($_layout);

	print $_versao;

 ?>