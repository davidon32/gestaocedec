<?php 

class EquipeDSP {
    
    

	/**
     * Cadastro da DSP
     * @return boolean
     * 
     */
	function Cadastrar($_dt_dsp,
					   $_num_dsp,
					   $_missao,
					   $_destino,
					   $_id_cod_dsp,
					   $_partida,
					   $_chegada,
                       $_id_chefe,
                       $_ano,
                       $tpTransporte,
                       $tpDSP,
                       $onus){
	
		$sql = 'INSERT INTO equ_dsp (dt_dsp,
									 num_dsp,
									 missao,
									 destino,
									 id_cod_dsp,
									 partida,
									 chegada,
									 id_chefe,
									 ano,
                                     tp_transporte,
                                     tipo,
                                     onus)
									 VALUES ("'.$_dt_dsp.'",
											 "'.$_num_dsp.'",
											 "'.$_missao.'",
											 "'.$_destino.'",
											 "'.$_id_cod_dsp.'",
											 "'.$_partida.'",
											 "'.$_chegada.'",
											  '.$_id_chefe.',
											 "'.$_ano.'",
                                              '.$tpTransporte.',
                                              '.$tpDSP.',
                                             "'.$onus.'")';
	
		
		$result = mysql_query($sql) or die (mysql_error());
		
		return true;

	}
                       
                       /**
     * Alterar da DSP
     * @return boolean
     * 
     */
    function alterar($_dt_dsp,
                       $_num_dsp,
                       $_missao,
                       $_destino,
                       $_id_cod_dsp,
                       $_partida,
                       $_chegada,
                       $_id_chefe,
                       $_ano,
                       $tpTransporte,
                       $idDsp,
                       $tpDSP){
                           
      
    
        $sql = 'UPDATE equ_dsp SET dt_dsp     = "'.$_dt_dsp.'",
                                   num_dsp    = "'.$_num_dsp.'",
                                   missao     = "'.$_missao.'",
                                   destino    = "'.$_destino.'",
                                   id_cod_dsp = "'.$_id_cod_dsp.'",
                                   partida    = "'.$_partida.'",
                                   chegada    = "'.$_chegada.'",
                                   id_chefe   = "'.$_id_chefe.'",
                                   ano        = "'.$_ano.'",
                                   tp_transporte = "'.$tpTransporte.'",
                                   tipo       = "'.$tpDSP.'"
                                   WHERE id_dsp = '.$idDsp;
    
        //print $sql;
        
        $result = mysql_query($sql) or die (mysql_error());
        
        return true;

    }
	
	#@ inserir funcionarios na dsp
	function InsereFuncionario($_id_dsp,
							   $_id_funcionario,
							   $_tipo){
		
		$sql = "INSERT INTO equ_diligente (id_dsp,
										   id_funcionario,
										   tipo) 
											VALUES ('".$_id_dsp."',
													'".$_id_funcionario."',
													'".$_tipo."')";
		
		$result = mysql_query($sql) or die (mysql_error());
		
		return true;
		
	}
	
	static function ComboCodDsp($id_dsp = false, $opcao = false) {
	    
        $op = ($opcao) ? 'readonly=\"readonly\"' : '';

		$sql = "SELECT id_cod_dsp, cod_dsp FROM equ_cod_dsp ORDER BY cod_dsp";

		$result = mysql_query($sql) or die (mysql_error());

		print "<select name=\"sel_cod_dsp\" id=\"sel_cod_dsp\" ".$op.">";
        
        if(!$id_dsp) {
        
            print "<option value=\"\"></option>";    
            
        }else {
            
            $sql1 = "SELECT equ_cod_dsp.id_cod_dsp, equ_cod_dsp.cod_dsp FROM equ_cod_dsp
            INNER JOIN equ_dsp
            ON equ_dsp.id_cod_dsp = equ_cod_dsp.id_cod_dsp
            WHERE equ_dsp.id_dsp =".$id_dsp;
            
            $result1 =mysql_query($sql1) or die(mysql_error());
            
            $dados1 = mysql_fetch_array($result1);
            
            print "<option value=\"".$dados1[0]."\">".$dados1[1]."</option>";  
  
        }

        if(!$opcao) {
            
    		while ($linha = mysql_fetch_array($result)) {
    
    			print "<option value=".$linha[0].">".$linha[1]."</option>";
    		}
        }

		print "</select>";
	}
	
	#@ busca identificados DSP
	function BuscaIdDsp($_num_dsp, $_dt_dsp){
		
		$sql = "SELECT id_dsp FROM equ_dsp WHERE num_dsp = '".$_num_dsp."' AND dt_dsp = '".$_dt_dsp."'";
		
		$result = mysql_query($sql) or die (mysql_error());
		
		$linha = mysql_fetch_assoc($result);
        
        //print $sql;

		return $linha['id_dsp'];
	}
    
   /**
    * Busca dos dados da DSP Para Impressão
    * @param Integer $id_dsp
    * @param Integer $numDsp
    * @param String $ano
    * @param Strin $dtDsp
    * @return array
    */
    function buscaDspDados($numDsp, $ano = false, $dtDsp = false){

        $dados = array();
        $filtro = "";

            if(is_numeric($numDsp)) {
            
                $filtro = "WHERE num_dsp =".$numDsp;    
                
            }else if(is_numeric($numDsp) && ($dtDsp != null)) {
                
                $filtro = "WHERE num_dsp =".$numDsp." AND dt_dsp = ".DataMysql::dataForm($dtDsp);    
                
            }else if((is_numeric($numDsp)) && ($ano != "")){
                
                $filtro = "WHERE num_dsp =".$numDsp." AND ano = ".$ano;    
                
            }else if($ano != false){
                
                $filtro = "WHERE ano = '".$ano."'";
                
            } else {
                    
                die();
            }
                
            $sql = "SELECT dt_dsp,
                           num_dsp,
                           missao,
                           destino,
                           tp_transporte,
                           partida,
                           chegada,
                           id_chefe,
                           id_cod_dsp,
                           ano,
                           id_dsp,
                           situacao,
                           tipo
                           FROM equ_dsp ".$filtro;
                           
            //print $sql;
            
            $result = mysql_query($sql) or die (mysql_error());
            
            while ($linha = mysql_fetch_assoc($result)){
                    
                $dados[] = $linha;
                
            }
            
            
                        
            return $dados;
        
        
    }
    
    /**
    * Busca dos dados da DSP Alteração
    * @param Integer $id_dsp
    * @return array
    */
    function buscaDspDadosId($id_dsp){

        $dados = array();

        if(is_numeric($id_dsp)){ 
  
            $sql = "SELECT dt_dsp,
                           num_dsp,
                           missao,
                           destino,
                           onus,
                           partida,
                           chegada,
                           id_chefe,
                           id_cod_dsp,
                           ano,
                           id_dsp,
                           tp_transporte,
                           tipo
                           FROM equ_dsp WHERE id_dsp = ".$id_dsp;

            
            $result = mysql_query($sql) or die (mysql_error());
            
            while ($linha = mysql_fetch_assoc($result)){
                    
                $dados[] = $linha;
                
            }
            
            return $dados;
            
        }else {
                    
            die();
        }
   
    }
    
    
    
    /**
     * Busca os membros da DSP, informacoes dos Integrantes da DSP
     * @author Demetrio da Silva Passos
     * @param integer $_id_dsp
     * @param 
     * @return array
     * 
     * 
     */	
	   function buscaMembrosDSP($_id_dsp){
	           
	       $dados = "";
	       
	       //$filtro = ($tipo != false ? "AND f.posto = \"".$tipo."\"" : "AND f.posto NOT IN ('SC', 'FC') ");
	       
           $sql = "SELECT f.id_funcionario as id_funcionario,
                          f.num_masp as num_masp,
                          f.posto as posto,
                          f.nome as nome,
                          f.quinquenio as quinquenio,
                          f.curso as curso,
                          b.num_banco as num_banco,
                          b.conta as conta,
                          b.agencia as agencia,
                          f.secao as secao, 
                          f.cpf as cpf,
                          e.tipo as tipo,
                          f.cargo as cargo,
                          f.ci as ci,
                          f.tipo_abono                         
                          FROM cedec_funcionario f
                          INNER JOIN equ_diligente e
                          ON f.id_funcionario = e.id_funcionario
                          inner join equ_banco b
                          ON f.id_funcionario = b.id_funcionario
                          WHERE e.id_dsp = ".$_id_dsp."
                          AND b.principal = 1
                          ORDER BY e.tipo DESC";
                          
                          //print $sql;
                          
           $result = mysql_query($sql) or die (mysql_error());
           
           while($linha = mysql_fetch_assoc($result)){
               
               $dados[] = $linha;
           }
           
           return $dados;
           
	   }
	   
	   /**
        * Busca o CMd do DSP
        * 
        * @return id do CMD dsp 
        */
        function BuscaCmd($_id_dsp){
            
            $sql = "SELECT d.id_funcionario,
                           f.nome,
                           f.num_masp,
                           f.posto,
                           f.quinquenio,
                           f.secao,
                           f.tipo_abono,
                           f.orgao
                           FROM equ_diligente d
                           INNER JOIN cedec_funcionario f
                           ON d.id_funcionario = f.id_funcionario
                           WHERE d.tipo = 1
                           AND d.id_dsp = ".$_id_dsp;

           // print $sql;

           $result = mysql_query($sql) or die (mysql_error());
           
           $linha = mysql_fetch_assoc($result);

           return $linha;
                
        }
        
        /**
         * 
         * Gerar numero dsp
         */
         function GerarOrdemServico($_ano){
             
             $sql = "SELECT max(num_dsp) as num_dsp FROM equ_dsp WHERE ano = ".$_ano;
             
             $result = mysql_query($sql) or die (mysql_error());
             
             $linha = mysql_fetch_assoc($result);
             
             $_resultado = ($linha['num_dsp'] == null) ? "1" : (int) $linha['num_dsp'] + 1; 

             return $_resultado;
   
         }
         
         
         /**
          * Retorna o códido da DSP
          * 
          */
       function getCodDsp($_id_cod){
                   
               $sql = "SELECT cod_dsp
                        FROM equ_cod_dsp
                        WHERE id_cod_dsp = ".$_id_cod;
               
               $result = mysql_query($sql) or die(mysql_error());
               
               $linha = mysql_fetch_assoc($result);
               
               return $linha['cod_dsp']; 
    
       }
       
       /**
        * 
        * 
        * */
        function buscaNomeFuncionario($id_funcionario) {
         
            $sql = "SELECT nome, posto FROM cedec_funcionario WHERE id_funcionario = ".$id_funcionario;
            
            $result = mysql_query($sql) or die (mysql_error());
            
            $linha = mysql_fetch_assoc($result);

            return $linha;
            
        }
        
        
        /**
         *  Busca os nomes e identificador dos integrantes da DSP
         *  @author Demetrio da Silva Passos
         *  @param integer $id_dsp
         *  @return array nome, id_funcionario
         */
         function buscaIdNomeDiligente($id_dsp) {
                 
             $dados = array();

             $sql = "SELECT cedec_funcionario.nome as nome, equ_diligente.id_funcionario as idFuncionario 
                        FROM equ_diligente
                        INNER JOIN cedec_funcionario
                        ON equ_diligente.id_funcionario = cedec_funcionario.id_funcionario
                        WHERE equ_diligente.id_dsp = ".$id_dsp."
                        ORDER BY equ_diligente.tipo DESC";
                        
              $result = mysql_query($sql) or die(mysql_error());
              
              while($linha = mysql_fetch_assoc($result)){
                $dados[] = $linha;               
              }

              return $dados;
                        
         }
         
         /**
          * Remove os Diligentes da DSP para alteração.
          * @param inteiro $idDsp
          * @return boolean
          * 
          */
            function removeDiligente($idDsp){
                
                $sql = "DELETE FROM equ_diligente
                        WHERE id_dsp = ".$idDsp."
                        AND id_diligente > 0";
                
                $result = mysql_query($sql) or die (mysql_error());
                
                return true;
            }
            
         /**
          * Formata hora PM ex. 2015-12-31 09:00:00 para 310900DEZ-15
          * @param data String 
          * @return data String
          */
            function formataDataHoraPM($data){
                
               
               $dia = substr($data, 8, 2);
               $numMes = substr($data, 5, 2);
               $ano = substr($data, 2, 2);
               $hora = substr($data, 11, 2);
               $minuto = substr($data, 14, 2);
               
               $mes = "";
                
               switch ($numMes) {
                case '01':
                    $mes = "JAN";
                    break;
                
                case '02':
                    $mes = "FEV";
                    break;
                case '03':
                    $mes = "MAR";
                    break;
                
                case '04':
                    $mes = "ABR";
                    break;
                case '05':
                    $mes = "MAI";
                    break;
                case '06':
                    $mes = "JUN";
                    break;
                case '07':
                    $mes = "JUL";
                    break;        
                case '08':
                    $mes = "AGO";
                    break;
                case '09':
                    $mes = "SET";
                    break;
                case '10':
                    $mes = "OUT";
                    break;
                case '11':
                    $mes = "NOV";
                    break;
                case '12':
                    $mes = "DEZ";
                    break;
                
                default:
                    $mes = "-";
                    break;
            }

               $dataFormatada = $dia.$hora.$minuto.$mes."-".$ano;
                
               return $dataFormatada; 
            }  

 /**
     * verifica se o funcionario é militares,
     * @param array $idFuncionario
     * return boolean
     */
    function verificaFuncionarioMilitar($idFuncionario) {

        $sql = "SELECT posto
        FROM cedec_funcionario
        WHERE id_funcionario = ".$idFuncionario;


        $result = mysql_query($sql) or die(mysql_error());
                    
        $linha = mysql_fetch_assoc($result);

        if($linha['posto'] == "SC"){
                            
            return false;

        }else {
        
            return true;    
            
        }

   }
}?>