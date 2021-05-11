<?php include_once(PATH.'/core/include.php');

class Boletim {
	
	public function Boletim(){
		
		
	}
	
	public function listBoletim($limit = false){
		
		$con = Conexao::getInstance();
		
		$linha = array();
		
		$param = (!$limit) ? "" : 'limit '.$limit;
		 
		$sql ='SELECT
				id,
				nome,
				data,
				plantonista,
				descricao,
				tamanho,
				complemento
				FROM cce_boletim order by data desc '.$param;
		
		$result = $con->query($sql);
		
		while ($dados = $result->fetch(PDO::FETCH_ASSOC)) {
			$linha[] = $dados;
		}
		
		return $linha;
		
	}
	
	public function deletar($id){
		
		$con = Conexao::getInstance();
		
		$sql ='delete from cce_boletim where id= '.$id;
		
		if($result = $con->query($sql) === true){
			return true;
		}else {
			return false;
		}	
	}
	
	public function relatoriosite(){
	
		$con = Conexao::getInstance();
	
		$linha = array();
		
		$sql ='SELECT
				id,
				nome,
				data,
				descricao,
				tamanho,
				complemento
				FROM cce_boletim order by data desc limit 122' ;
	
		$result = $con->query($sql);
	
		while ($dados = $result->fetch(PDO::FETCH_ASSOC)) {
			$linha[] = $dados;
		}
	
		return $linha;
	
	}
	
	
	
}