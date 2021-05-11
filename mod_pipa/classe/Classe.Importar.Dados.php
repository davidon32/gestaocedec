<?php
	
	
	/**
	 * 
	 */
	class ImportarDados {
		
	
		private static $dados;
		
		function Importar($_txt) {
			
			$_arquivo = @fopen($_txt, "r");
			
			
				while ($_linha = fgetcsv($_arquivo, 4096, ",")){
					
					self::$dados[] = $_linha;
				}
				
				return self::$dados;
			
				fclose($_arquivo);
		}
			
	
	
}?>


<?php
	//iconv("UTF-8","ISO-8859-1",
	
	$_da = ImportarDados::Importar("../dados.csv");
	
	//print $_da[1][9];
	
	
	#@ busca o cpf no arquivo csv para importacao
	function BuscaCpf($_cpf){
		
		// cpf sem formato = 11
		// cpf com formato = 14
		
		$num_string = strlen($_cpf);
		
		if($num_string == 11) {
			
			$_primeiro = substr($_cpf, 0, 3);
			$_segundo = substr($_cpf, 3, 3);
			$_terceiro = substr($_cpf, 6, 3);
			$_digito = substr($_cpf, 9, 2);
			
			return $_primeiro.".".$_segundo.".".$_terceiro."-".$_digito;
		
		}elseif($num_string == 14) {
				
				return $_cpf;
					

		}elseif(($num_string != 11) && ($num_string != 14)) {
				
				print '<script>
							alert("Cpf Invalido");
							history.back();
						</script>';
				
			}
	
	
}
	//FuncaoBase::vd(BuscaCpf('0326041460600'));
	
	//substr($cep, $iniciio, $fim);
	
	



?>