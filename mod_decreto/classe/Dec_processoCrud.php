<?php
/**
* #####################################################
* #     GMG - GABINETE MILITAR DO GOVERNADOR          # 
* #     DEFESA CIVIL DO ESTADO DE MINAS GERAIS        # 
* #  Classe : Crud dec_processo                         #
* #  Data   : 12/11/2018                              #
* #  Autor  : Demetrio S. Passos - masp M1296844      #
* #####################################################
*/
//include_once "Classe.PDO.php";

include_once $_SERVER['DOCUMENT_ROOT']."/mod_decreto/modelo/Dec_processoModel.php";

class dec_processoController extends Dec_processoModel {
/**
* #  Insere novos dados do Tabela dec_processo          #
* #  Data: 12/11/2018                                 #
* #  Autor : Demetrio S. Passos - masp M1296844       # */

public function dec_processoInsert($dados){

     $this->setAno_processo($dados['ano_processo']);
     $this->setData_entrada($dados['data_entrada']);
     $this->setNum_processo($dados['num_processo']);
     $this->setId_municipio($dados['id_municipio']);
     $this->setNum_dec_munic($dados['num_dec_munic']);
     $this->setData_dec_munic($dados['data_dec_munic']);
     $this->setDec_vigencia_proc($dados['dec_vigencia_proc']);
     $this->setCod_desastre_cobr($dados['cod_desastre_cobr']);
     $this->setData_venc_process($dados['data_venc_process']);
     $this->setId_funcionario($dados['id_funcionario']);
     $this->setHomo_num_dec($dados['homo_num_dec']);
     $this->setHomo_dt_pub_dec($dados['homo_dt_pub_dec']);
     $this->setHomo_num_dt_port_dec_rec($dados['homo_num_dt_port_dec_rec']);
     $this->setHomo_num_dt_dou($dados['homo_num_dt_dou']);
     $this->setStat_rec_uniao($dados['stat_rec_uniao']);
     $this->setStat_n_rec_uniao($dados['stat_n_rec_uniao']);
     $this->setStat_arq_estado($dados['stat_arq_estado']);
     $this->setStat_hom_estado($dados['stat_hom_estado']);
     $this->setStat_analis_estado($dados['stat_analis_estado']);
     $this->setStat_aprov_pmda($dados['stat_aprov_pmda']);
     $this->setStat_em_analis_pmda($dados['stat_em_analis_pmda']);
     $this->setAnalista($dados['analista']);
     try {
          $con = Conexao::getInstance();

          $sql = "insert into dec_processo (
                              ano_processo,
                              data_entrada,
                              num_processo,
                              id_municipio,
                              num_dec_munic,
                              data_dec_munic,
                              dec_vigencia_proc,
                              cod_desastre_cobr,
                              data_venc_process,
                              id_funcionario,
                              homo_num_dec,
                              homo_dt_pub_dec,
                              homo_num_dt_port_dec_rec,
                              homo_num_dt_dou,
                              stat_rec_uniao,
                              stat_n_rec_uniao,
                              stat_arq_estado,
                              stat_hom_estado,
                              stat_analis_estado,
                              stat_aprov_pmda,
                              stat_em_analis_pmda,
                              analista)
                                   value (
                                        :ano_processo, 
                                        :data_entrada, 
                                        :num_processo, 
                                        :num_dec_munic, 
                                        :data_dec_munic, 
                                        :dec_vigencia_proc, 
                                        :cod_desastre_cobr, 
                                        :data_venc_process, 
                                        :homo_num_dec, 
                                        :homo_dt_pub_dec, 
                                        :homo_num_dt_port_dec_rec, 
                                        :homo_num_dt_dou, 
                                        :stat_rec_uniao, 
                                        :stat_n_rec_uniao, 
                                        :stat_arq_estado, 
                                        :stat_hom_estado, 
                                        :stat_analis_estado, 
                                        :stat_aprov_pmda, 
                                        :stat_em_analis_pmda, 
                                        :analista)"; 


          $result = $con->prepare($sql);

               $result->bindValue(":ano_processo"	, $this->getAno_processo());
               $result->bindValue(":data_entrada"	, $this->getData_entrada());
               $result->bindValue(":num_processo"	, $this->getNum_processo());
               $result->bindValue(":id_municipio"	, $this->getId_municipio());
               $result->bindValue(":num_dec_munic"	, $this->getNum_dec_munic());
               $result->bindValue(":data_dec_munic"	, $this->getData_dec_munic());
               $result->bindValue(":dec_vigencia_proc"	, $this->getDec_vigencia_proc());
               $result->bindValue(":cod_desastre_cobr"	, $this->getCod_desastre_cobr());
               $result->bindValue(":data_venc_process"	, $this->getData_venc_process());
               $result->bindValue(":id_funcionario"	, $this->getId_funcionario());
               $result->bindValue(":homo_num_dec"	, $this->getHomo_num_dec());
               $result->bindValue(":homo_dt_pub_dec"	, $this->getHomo_dt_pub_dec());
               $result->bindValue(":homo_num_dt_port_dec_rec"	, $this->getHomo_num_dt_port_dec_rec());
               $result->bindValue(":homo_num_dt_dou"	, $this->getHomo_num_dt_dou());
               $result->bindValue(":stat_rec_uniao"	, $this->getStat_rec_uniao());
               $result->bindValue(":stat_n_rec_uniao"	, $this->getStat_n_rec_uniao());
               $result->bindValue(":stat_arq_estado"	, $this->getStat_arq_estado());
               $result->bindValue(":stat_hom_estado"	, $this->getStat_hom_estado());
               $result->bindValue(":stat_analis_estado"	, $this->getStat_analis_estado());
               $result->bindValue(":stat_aprov_pmda"	, $this->getStat_aprov_pmda());
               $result->bindValue(":stat_em_analis_pmda"	, $this->getStat_em_analis_pmda());
               $result->bindValue(":analista"	, $this->getAnalista());


     $result->execute();
               return true;
     }catch (Exception $e){
          print $e->getMessage();
     }
}

#################################################################################################
/**
* #  Atualiza novos dados do Tabela dec_processo        #
* #  Data: 12/11/2018                                 #
* #  Autor : Demetrio S. Passos - masp M1296844       # */

	public function dec_processoUpdate($dados){

     $this->setId_processo($dados['id_processo']);
     $this->setAno_processo($dados['ano_processo']);
     $this->setData_entrada($dados['data_entrada']);
     $this->setNum_processo($dados['num_processo']);
     $this->setId_municipio($dados['id_municipio']);
     $this->setNum_dec_munic($dados['num_dec_munic']);
     $this->setData_dec_munic($dados['data_dec_munic']);
     $this->setDec_vigencia_proc($dados['dec_vigencia_proc']);
     $this->setCod_desastre_cobr($dados['cod_desastre_cobr']);
     $this->setData_venc_process($dados['data_venc_process']);
     $this->setId_funcionario($dados['id_funcionario']);
     $this->setHomo_num_dec($dados['homo_num_dec']);
     $this->setHomo_dt_pub_dec($dados['homo_dt_pub_dec']);
     $this->setHomo_num_dt_port_dec_rec($dados['homo_num_dt_port_dec_rec']);
     $this->setHomo_num_dt_dou($dados['homo_num_dt_dou']);
     $this->setStat_rec_uniao($dados['stat_rec_uniao']);
     $this->setStat_n_rec_uniao($dados['stat_n_rec_uniao']);
     $this->setStat_arq_estado($dados['stat_arq_estado']);
     $this->setStat_hom_estado($dados['stat_hom_estado']);
     $this->setStat_analis_estado($dados['stat_analis_estado']);
     $this->setStat_aprov_pmda($dados['stat_aprov_pmda']);
     $this->setStat_em_analis_pmda($dados['stat_em_analis_pmda']);
     $this->setAnalista($dados['analista']);
     
     try {
          $con = Conexao::getInstance();
          $sql = "update dec_processo set
                              ano_processo =:ano_processo,
                              data_entrada =:data_entrada,
                              num_processo =:num_processo,
                              id_municipio =:id_municipio,
                              num_dec_munic =:num_dec_munic,
                              data_dec_munic =:data_dec_munic,
                              dec_vigencia_proc =:dec_vigencia_proc,
                              cod_desastre_cobr =:cod_desastre_cobr,
                              data_venc_process =:data_venc_process,
                              id_funcionario =:id_funcionario,
                              homo_num_dec =:homo_num_dec,
                              homo_dt_pub_dec =:homo_dt_pub_dec,
                              homo_num_dt_port_dec_rec =:homo_num_dt_port_dec_rec,
                              homo_num_dt_dou =:homo_num_dt_dou,
                              stat_rec_uniao =:stat_rec_uniao,
                              stat_n_rec_uniao =:stat_n_rec_uniao,
                              stat_arq_estado =:stat_arq_estado,
                              stat_hom_estado =:stat_hom_estado,
                              stat_analis_estado =:stat_analis_estado,
                              stat_aprov_pmda =:stat_aprov_pmda,
                              stat_em_analis_pmda =:stat_em_analis_pmda,
                              analista =:analista
                                   where id_processo =:id_processo";

          $result = $con->prepare($sql);
          $result->bindValue(":id_processo", $this->getId_processo());
          $result->bindValue(":ano_processo", $this->getAno_processo());
          $result->bindValue(":data_entrada", $this->getData_entrada());
          $result->bindValue(":num_processo", $this->getNum_processo());
          $result->bindValue(":id_municipio", $this->getId_municipio());
          $result->bindValue(":num_dec_munic", $this->getNum_dec_munic());
          $result->bindValue(":data_dec_munic", $this->getData_dec_munic());
          $result->bindValue(":dec_vigencia_proc", $this->getDec_vigencia_proc());
          $result->bindValue(":cod_desastre_cobr", $this->getCod_desastre_cobr());
          $result->bindValue(":data_venc_process", $this->getData_venc_process());
          $result->bindValue(":id_funcionario", $this->getId_funcionario());
          $result->bindValue(":homo_num_dec", $this->getHomo_num_dec());
          $result->bindValue(":homo_dt_pub_dec", $this->getHomo_dt_pub_dec());
          $result->bindValue(":homo_num_dt_port_dec_rec", $this->getHomo_num_dt_port_dec_rec());
          $result->bindValue(":homo_num_dt_dou", $this->getHomo_num_dt_dou());
          $result->bindValue(":stat_rec_uniao", $this->getStat_rec_uniao());
          $result->bindValue(":stat_n_rec_uniao", $this->getStat_n_rec_uniao());
          $result->bindValue(":stat_arq_estado", $this->getStat_arq_estado());
          $result->bindValue(":stat_hom_estado", $this->getStat_hom_estado());
          $result->bindValue(":stat_analis_estado", $this->getStat_analis_estado());
          $result->bindValue(":stat_aprov_pmda", $this->getStat_aprov_pmda());
          $result->bindValue(":stat_em_analis_pmda", $this->getStat_em_analis_pmda());
          $result->bindValue(":analista", $this->getAnalista());
          $result->execute();
               return true;
          }catch (Exception $e){
               print $e->getMessage();
               }
}
#################################################################################################
/**
* Delete registro
* Data: 01/10/2018/
* Autor : Demetrio S. Passos
* email : demetriosilvap@hotmail.com 
**/

     public function deleteDec_processo($id){
          $con = Conexao::getInstance();
               try{
                    $sql = "DELETE FROM dec_processo where id_processo = :id";
                    $result = $con->prepare($sql);
                    $result->bindValue(":id", $id);
                    $result->execute();
                    return true;
               }catch (Exception $e){
               }
     }
     
     
     
     public function listagemId($id){
     	
     	$dados = array();
     	
     	$con = Conexao::getInstance();
     	try{
     		$sql = "SELECT * FROM dec_processo where id_processo = :id";
     		$result = $con->prepare($sql);
     		$result->bindValue(":id", $id);
     		$result->execute();
     		
     		//$result = $con->query($sql);
			
			while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					
					$dados = $linha; 
				}
				
			return $dados;
     		
     		return true;
     	}catch (Exception $e){
     	}
     	
     	
     }
     
     public function listagemMunicipio($_municipio){
     
     	$dados = array();
     
     	$con = Conexao::getInstance();
     	try{
     		$sql = "SELECT dec_processo.id_processo,
     					dec_processo.num_processo,
     					dec_processo.ano_processo,
     					cedec_municipio.nome
     						FROM dec_processo
								inner join cedec_municipio 
								on dec_processo.id_municipio = cedec_municipio.id_municipio
								where cedec_municipio.nome like :municipio";
     		
     		$result = $con->prepare($sql);
     		$result->bindValue(":municipio", '%'.$_municipio.'%');
     		$result->execute();
     		 
     		//$result = $con->exec($sql);
     			
     		while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
     				
     			$dados[] = $linha;
     		}
     
     		return $dados;
     		 
     		return true;
     	}catch (Exception $e){
     	}
     
     
     }
   
     
     /**
      * Get nome Cobrade
      * @param string $id_cobrade
      */
     public function getCobradeId($id_cobrade){
     	 
     	try {
     		 
     		$dados = array();
     
     		$con = Conexao::getInstance();
     
     		$sql = "SELECT codigo, descricao, id_cobrade FROM dec_cobrade where id_cobrade = ".$id_cobrade;
     
     		$result = $con->query($sql);
     
     		$result->execute();
     		 
     		while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
     			 
     			$dados = $linha;
     		}
     
     		return $dados['codigo']."-".$dados['descricao'];
     
     
     	}catch (Exception $e){
     		 
     	}
     }
     
     
}?>