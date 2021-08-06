<?php


class RPA {

	#@ impressao de rpa com uma lista de numeros de rpa
	public function rpaLista($_lista = false, $num_lote = false){
	    
        $dados = array();
		
		if($_lista != false)
			{
				
				$filtro = 'co.id_conta in ("'.$_lista.'")';
			
			}
			elseif($num_lote != false)
				{
				
					$filtro = 'co.lote ='.$num_lote; 
				
				}

		

		$sql ='select co.id_conta, co.id_pipeiro, co.inss, co.data, co.mes, co.km, co.id_motorista, co.irrf, co.sestsenat,
		co.gfip, co.placa, co.valor, m.nome as "motorista", m.cpf_cnpj, m.rg, m.orgao, co.situacao, m.id_motorista, m.pis_pasep
		from pip_conta co
		inner join pip_caminhao c
		on co.placa = c.placa
		inner join pip_motorista m
		on m.placa = c.placa
		where '.$filtro;

		//var_dump($sql);

		$result = mysql_query($sql) or die (mysql_error());

		while ($linha = mysql_fetch_array($result))
		{

			$dados[] = $linha;

		}

		return $dados;

	}

	#@ busca o rpa lancado 
	public function BuscaNumRpa($id_motorista, $placa, $mes, $_ano){

		$sql = "select id_conta from pip_conta where id_motorista = ".$id_motorista." and placa = '".$placa."' and mes = ".$mes." and ano = '".$_ano."'";

		//print $sql;

		$result = mysql_query($sql) or die (mysql_error());

		$linha = mysql_fetch_assoc($result);

		return $linha['id_conta'];

	}

	


}?>
