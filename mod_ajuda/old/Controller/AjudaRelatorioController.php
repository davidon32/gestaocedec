<?php require_once('AppController.php');
    
/**
 * 
 */
class AjudaRelatorioController extends AppController {
	
	public function relResumoLiberacaoDados(){
	    
        $con = Conexao::getInstance();
        
            try {
                      
                $statement = $con->prepare("select Deposito,
                                            sum(if(Mes=01,Quantidade,0)) as Janeiro,
                                            sum(if(Mes=02,Quantidade,0)) as Fevereiro,
                                            sum(if(Mes=03,Quantidade,0)) as Marco,
                                            sum(if(Mes=04,Quantidade,0)) as Abril,
                                            sum(if(Mes=05,Quantidade,0)) as Maio,
                                            sum(if(Mes=06,Quantidade,0)) as Junho,
                                            sum(if(Mes=07,Quantidade,0)) as Julho,
                                            sum(if(Mes=08,Quantidade,0)) as Agosto,
                                            sum(if(Mes=09,Quantidade,0)) as Setembro,
                                            sum(if(Mes=10,Quantidade,0)) as Outubro,
                                            sum(if(Mes=11,Quantidade,0)) as Novembro,
                                            sum(if(Mes=12,Quantidade,0)) as Dezembro
                                            from resumoLiberacao
                                            group by Deposito");
    
                $statement->execute();
                
                $linha = $statement->fetchAll(PDO::FETCH_ASSOC);
                
                return $linha;
                //return print_r($statement);
            
            }catch(PDOException $e) {
                
                print $e->getMessage()."1";
                print "<br><a href='javascript:history.back();'>Voltar</a>";
                
            } 
        
        
        
	}

	/**
     * criar tabela temporaria
     * @param id_material
     * @param dtInicial
     * @param dtFinal
     * 
     */ 
    public function tabelaAuxiliarResumo(AjudaRelatorioModel $ajudaRelatorioModel){
            
            
        $con = Conexao::getInstance();
        
            try {
                      
                $statement = $con->query("drop temporary table if exists resumoLiberacao;");
                $statement->execute();
                
                $statement = $con->query("create temporary table if not exists resumoLiberacao as (
                                            select aju_item.id_dep_origem,
                                                     aju_deposito.nome as 'Deposito',
                                                     aju_item.cod as 'id_material',
                                                     aju_unidade.nome as 'Material',
                                                     Case (date_format(dataLibera, '%m')) 
                                                                    WHEN 01 THEN '01'
                                                                    WHEN 02 THEN '02'
                                                                    WHEN 03 THEN '03'
                                                                    WHEN 04 THEN '04'
                                                                    WHEN 05 THEN '05'
                                                                    WHEN 06 THEN '06'
                                                                    WHEN 07 THEN '07'
                                                                    WHEN 08 THEN '08'
                                                                    WHEN 09 THEN '09'
                                                                    WHEN 10 THEN '10'
                                                                    WHEN 11 THEN '11'
                                                                    WHEN 12 THEN '12'   
                                                                    ELSE 'Sem registro'
                                                                    END as 'Mes', sum(quantidade) as 'Quantidade'
                                            from aju_item
                                            inner join aju_deposito
                                            on aju_item.id_dep_origem = aju_deposito.id_deposito
                                            inner join aju_unidade
                                            on aju_item.cod = aju_unidade.id_unidade 
                                            where aju_item.dataLibera >= '".$ajudaRelatorioModel->getDt_inicial()."' and aju_item.dataLibera <= '".$ajudaRelatorioModel->getDt_final()."'
                                            and aju_item.cod = ".$ajudaRelatorioModel->getMaterial()."
                                            group by aju_item.cod, aju_item.dataLibera, aju_item.id_dep_origem
                                            order by aju_item.id_dep_origem, aju_item.dataLibera);");
               
               //$statement->bindValue(':dtInicial', $ajudaRelatorioModel->getDt_inicial(), PDO::PARAM_STR);
               //$statement->bindValue(':dtFinal', $ajudaRelatorioModel->getDt_final(), PDO::PARAM_STR);
               //$statement->bindValue(':id_material', $ajudaRelatorioModel->getMaterial(), PDO::PARAM_STR);
               
               $statement->execute();
               
               //$linha = $statement->fetchAll(PDO::FETCH_ASSOC);
                
               //print_r($statement);  
               return true;
            
            }catch(PDOException $e) {
                
                print $e->getMessage();
                
                print "<br><a href='javascript:history.back();'>Voltar</a>";
                return false;
                
            } 
    }
	
	/**
 *  Relatorio de Materiais Transferidos 
 *
 * @param dtInicio
 * @param dtFinal
 * @param idDeposito
 * @param idMunicipio
 */
static function materialTransferencia(AjudaRelatorioModel $ajudaRelatorioModel) {
    
    $con = Conexao::getInstance();

            try {
                
                 $statement = "";
                    
               if( (strlen($ajudaRelatorioModel->getDt_inicial())) <= 10 && ( strlen($ajudaRelatorioModel->getDt_final()) <= 10) ){ 
                      
                    $statement = $con->prepare("select aju_transferencia.id_transferencia,
                                                aju_transferencia.dt_transferencia,
                                                aju_transferencia.motorista,
                                                aju_transferencia.veiculo,
                                                aju_transferencia.placa,
                                                aju_transferencia.dt_saida,
                                                aju_transferencia.dt_chegada,
                                                aju_transferencia.id_dep_destino,
                                                aju_transferencia.situacao,
                                                aju_transferencia.responsavel,
                                                aju_transferencia.doc_res,
                                                aju_transferencia.obs,
                                                aju_transferencia.baixa,
                                                aju_transferencia.motivo,
                                                aju_transferencia.id_dep_origem
                                                from aju_transferencia
                                                where aju_transferencia.dt_transferencia >= :dtInicio and aju_transferencia.dt_transferencia <= :dtFinal
                                                order by aju_transferencia.dt_transferencia");
                    
                    }
                    //return print($statement);
                    
                    $statement->bindValue(':dtInicio', $ajudaRelatorioModel->getDt_inicial(), PDO::PARAM_STR);
                    $statement->bindValue(':dtFinal', $ajudaRelatorioModel->getDt_final(), PDO::PARAM_STR);
               
                
                $statement->execute();
                
                $linha = $statement->fetchAll(PDO::FETCH_ASSOC);
                
                //return print_r($statement);
       
                return $linha;
            
            }catch(PDOException $e) {
                
                print $e->getMessage()."1";
                print "<br><a href='javascript:history.back();'>Voltar</a>";
                
            } 
    
    
}

function itemTransferencia(AjudaRelatorioModel $ajudaItemTransferenciaModel){
            
        $con = Conexao::getInstance();

            try {

                $statement = $con->prepare("select aju_item_transf.id_produto,
                                            aju_unidade.nome,
                                            aju_item_transf.descricao,
                                            aju_item_transf.quantidade
                                            from aju_item_transf
                                            inner join aju_unidade
                                            on aju_item_transf.id_produto = aju_unidade.id_unidade
                                            where id_transferencia = :id_transferencia
                                            order by aju_unidade.nome");
                    
                $statement->bindValue(':id_transferencia', $ajudaItemTransferenciaModel->getId_transferencia(), PDO::PARAM_STR);
                
                $statement->execute();
                
                $linha = $statement->fetchAll(PDO::FETCH_ASSOC);
                
                //return print_r($statement);
       
                return $linha;
            
            }catch(PDOException $e) {
                
                print $e->getMessage()."1";
                print "<br><a href='javascript:history.back();'>Voltar</a>";
                
            } 
  
}

function relatorioCadastroMaterial(AjudaRelatorioModel $ajudaRelatorioModel) {
    
        $con = Conexao::getInstance();
        
            $ordem = '';
        
            switch ($ajudaRelatorioModel->getOrdem()) {
                case '0':
                    $ordem = 'nome';
                    break;
                case '1':
                    $ordem = 'dtEntradaSaida';
                    break;
                case '2':
                    $ordem = 'origem';
                    break;
                case '3':
                    $ordem = 'depDestino';
                    break;
                case '4':
                    $ordem = 'validade';
                    break;
                default:
                    
                    break;
            }

            try {

                $statement = $con->prepare("select id_produto,
                                            codProd,
                                            nome,
                                            dtEntradaSaida,
                                            origem,
                                            obs,
                                            quantidade,
                                            depDestino,
                                            validade
                                            from aju_produto
                                            where dtEntradaSaida >= :dtInicio
                                            and dtEntradaSaida <= :dtFinal
                                            order by :ordem");
                    
                $statement->bindValue(':dtInicio', $ajudaRelatorioModel->getDt_inicial(), PDO::PARAM_STR);
                $statement->bindValue(':dtFinal', $ajudaRelatorioModel->getDt_final(), PDO::PARAM_STR);
                $statement->bindValue(':ordem', $ordem, PDO::PARAM_STR);
                
                $statement->execute();
                
                $linha = $statement->fetchAll(PDO::FETCH_ASSOC);
                
                //return print_r($statement);
                
                //return $ordem;
       
                return $linha;
            
            }catch(PDOException $e) {
                
                print $e->getMessage()."1";
                print "<br><a href='javascript:history.back();'>Voltar</a>";
                
            } 
    
}
	
	
}?>