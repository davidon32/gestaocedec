<?php
	/* 	Classe teste de Calculo de valores
	 * 
	 * */


include 'Class.Calculo.php';


	#@ teste calculo inss
	function TesteInss(){
	
		$resultado = Calculo::Inss(14858.00);
		if($resultado >438) {
			
			print 'erro do calculo';
			
		}
	
	
	}

		TesteInss();	

?>