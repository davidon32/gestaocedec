<?php

/* manipulacao de registro da tabela eventos 
 * seleção, atualizacao, relatorio, inclusão
 * */
class Evento extends DataMysql {
	
		function BuscaEvento($_id_municipio, $dt_inicial = false, $dt_final = false) {
			
			$dados = '';
			
			$_filtro = '';
	
			if(($_id_municipio != "") and ($dt_inicial == "") and ($dt_final == "")) {
				
				$_filtro = $_id_municipio;
			
			}elseif (($_id_municipio != "") and ($dt_inicial != "") and ($dt_inicial != "")){
				
				$_filtro = 'WHERE m.id_municipio = '.$_id_municipio.' and e.dt_ocorrencia between '.DataMysql::dataVisual($dt_inicial).' and '.$dt_final.'';
				
			}
			
			
			$sql = 'SELECT	e.id_evento, e.num_processo, e.id_municipio, m.nome, e.data, e.tipo_evento, e.codar, e.dt_ocorrencia,
					e.hr_ocorrencia, e.localidade_atingida, e.existe_comdec, e.descricao, e.desalojado, e.desabrigado, e.deslocados,
					e.desaparecido, e.morto, e.enfermo,	e.ferido_leve, e.ferido_grave, e.afetado, e.residencia_danificada, e.residencia_destruida,
					e.publica_danificada, e.publica_destruida, e.comunitaria,  e.comunitaria_destruida, e.particular_danificada, e.particular_destruida,
					e.ponte, e.estrada, e.dano_ambiental, e.documento_enviado, e.decreto, e.num_decreto, e.dt_decreto, e.resp_mun, e.necessita,
					e.orgao_acionado, e.resp_preenchimento, e.dt_homologacao 
					FROM cce_evento e
					INNER JOIN cedec_municipio m
					ON m.id_municipio = e.id_municipio
					WHERE m.id_municipio = '.$_filtro;
		
			print $sql;
			
			$result = mysql_query($sql) or die (mysql_error()); 
	
			if (mysql_num_rows($result) > 0) {
				
				while ($linha = mysql_fetch_array($result)) {
				
					$dados[] = $linha;
						
				}
					
				return $dados;
				
			
			
			}
				
			
			
		}
		


}?>