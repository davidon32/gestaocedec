<?php require_once(PATH.'/core/include.php');
        //require_once(PATH.'/administrator/classe/Classe.Conexao.php');

class EquipeFuncionario
{

	#@ Cadastro de funcionario no sistema
	public static function CadastrarFuncionario($_num_masp,
			$_nome,
			$_endereco,
			$_bairro,
			$_cidade,
			$_telefone,
			$_celular,
			$_posto,
			$_secao,
			$_funcao,
			$_desc_funcao,
			$_quinquenio,
			$_dt_nas,
			$_curso,
			$_email,
            $_email2,
            $_orgao,
            $_cpf,
            $tipoAbono,
            $_ci){
            	
            	

try{ 
	
	$dados = array();
	
	$sql = "INSERT INTO cedec_funcionario (num_masp,
	nome,
	endereco,
	bairro,
	cidade,
	telefone,
	celular,
	posto,
	secao,
	funcao,
	desc_funcao,
	quinquenio,
	dt_nasc,
	curso,
	email,
	email2,
	orgao,
	cpf,
	tipo_abono,
	ci) VALUES (:num_masp,
                :nome,
                :endereco,
                :bairro,
                :cidade,
                :telefone,
                :celular,
                :posto,
                :secao,
                :funcao,
                :desc_funcao,
                :quinquenio,
                :dt_nas,
                :curso,
                :email,
                :email2,
                :orgao,
                :cpf,
                :tipoAbono,
                :ci)";
	
	   $con = Conexao::getInstance();
	   
	   $result = $con->prepare($sql);
	
	   $result->bindValue(":num_masp"   , $_num_masp,    PDO::PARAM_STR);
	   $result->bindValue(":nome"       , $_nome,        PDO::PARAM_STR);
       $result->bindValue(":endereco"   , $_endereco,    PDO::PARAM_STR);
	   $result->bindValue(":bairro"     , $_bairro,      PDO::PARAM_STR);
	   $result->bindValue(":cidade"     , $_cidade,      PDO::PARAM_STR);
       $result->bindValue(":telefone"   , $_telefone,    PDO::PARAM_STR);
	   $result->bindValue(":celular"    , $_celular,     PDO::PARAM_STR);
	   $result->bindValue(":posto"      , $_posto,       PDO::PARAM_STR);
       $result->bindValue(":secao"      , $_secao,       PDO::PARAM_STR);
	   $result->bindValue(":funcao"     , $_funcao,      PDO::PARAM_STR);
	   $result->bindValue(":desc_funcao", $_desc_funcao, PDO::PARAM_STR);
       $result->bindValue(":quinquenio" , $_quinquenio,  PDO::PARAM_STR);
	   $result->bindValue(":dt_nas"     , $_dt_nas,      PDO::PARAM_STR);
	   $result->bindValue(":curso"      , $_curso,       PDO::PARAM_STR);
       $result->bindValue(":email"      , $_email,       PDO::PARAM_STR);
	   $result->bindValue(":email2"     , $_email2,      PDO::PARAM_STR);
	   $result->bindValue(":orgao"      , $_orgao,       PDO::PARAM_STR);
       $result->bindValue(":cpf"        , $_cpf,         PDO::PARAM_STR);
	   $result->bindValue(":tipoAbono"  , $tipoAbono,    PDO::PARAM_STR);
	   $result->bindValue(":ci"         , $_ci,          PDO::PARAM_STR);
	   
	   $result->execute();

	   $dados['result'] = true;
	   $dados['lastId'] = $con->lastInsertId();
	
		return $dados;
	
}catch (Exception $e){
	
	FuncaoBase::getError($e, "Esse usuário já existe na Base de Dados !");
}

}

#@ Alterar Cadastro de funcionario no sistema
static function AlterarCadastrarFuncionario($_id_funcionario,
		$_num_masp,
		$_nome,
		$_endereco,
		$_bairro,
		$_cidade,
		$_telefone,
		$_celular,
		$_posto,
		$_secao,
		$_funcao,
		$_desc_funcao,
		$_quinquenio,
		$_dt_nas,
		$_curso,
		$_email,
        $_email2,
        $_situacao,
        $_orgao,
        $_cpf,
        $_tipoAbono,
        $_ci){

	$sql = "UPDATE cedec_funcionario
	               SET num_masp   = :num_masp,
                       nome       = :nome,
                       endereco   = :endereco,
                       bairro     = :bairro,
                       cidade     = :cidade,
                       telefone   = :telefone,
                       celular    = :celular,
                       posto      = :posto,
                       secao      = :secao,
                       funcao     = :funcao,
                       desc_funcao= :desc_funcao,
                       quinquenio = :quinquenio,
                       dt_nasc    = :dt_nasc,
                       curso      = :curso,
                       email      = :email,
                       email2     = :email2,
                       situacao   = :situacao,
                       orgao      = :orgao,
                       cpf        = :cpf,
                       tipo_abono = :tipo_abono,
                       ci         = :ci
                        WHERE id_funcionario = :id_funcionario";

	$con = Conexao::getInstance();
	
	$result = $con->prepare($sql);
	
	    $result->bindValue(":num_masp",   $_num_masp);
        $result->bindValue(":nome",       $_nome);
        $result->bindValue(":endereco",   $_endereco);
        $result->bindValue(":bairro",     $_bairro);
        $result->bindValue(":cidade",     $_cidade);
        $result->bindValue(":telefone",   $_telefone);
        $result->bindValue(":celular",    $_celular);
        $result->bindValue(":posto",      $_posto);
        $result->bindValue(":secao",      $_secao);
        $result->bindValue(":funcao",     $_funcao);
        $result->bindValue(":desc_funcao", $_desc_funcao);
        $result->bindValue(":quinquenio", $_quinquenio);
        $result->bindValue(":dt_nasc",    DataMysql::dataForm($_dt_nas));
        $result->bindValue(":curso",      $_curso);
        $result->bindValue(":email",      $_email);
        $result->bindValue(":email2",     $_email2);
        $result->bindValue(":situacao",   $_situacao);
        $result->bindValue(":orgao",      $_orgao);
        $result->bindValue(":cpf",        $_cpf);
        $result->bindValue(":tipo_abono", $_tipoAbono);
        $result->bindValue(":ci",         $_ci);
        $result->bindValue(":id_funcionario", $_id_funcionario);
        
    $result->execute();
    

	return true;

}


/**
 * Monta dropbox com os nomes dos funcionario
 * @return
 */

function ComboFuncionario($idFuncionario = '0', $opcao = false){
        

    if($idFuncionario != "0") {
            
        $nome = EquipeFuncionario::getFuncionarioId($idFuncionario);
        $option = "<option value=\"".$idFuncionario."\">".$nome."</option>";
        
    }else {
            
        $option = "<option value=\"0\">Selecione o Funcionário</option>";
        
    }
        

    $sql = "SELECT id_funcionario,
                   nome,
                   posto
                   FROM cedec_funcionario
                   WHERE situacao = 1
                   AND nome NOT LIKE 'DEP%'
                   ORDER by nome";
                   
    //print $sql;

    $result = mysql_query($sql) or die (mysql_error());

    print "<select name=\"".$opcao['name']."\" id=\"".$opcao['name']."\" ".$opcao['disabled'].">";

    print $option;

    while ($linha = mysql_fetch_array($result)) {

        print "<option value=\"".$linha[0]."\">".utf8_encode($linha[1]).", ".$linha[2]."</option>";
    }

    print "</select>";

}

/**
 * Combo Funcionario sem Cadastro de Usuario
 * 
 */
function ComboFuncionarioSemUsuario(){

    $sql = "SELECT id_funcionario, nome, posto
            FROM cedec_funcionario 
            WHERE situacao = 1
            AND nome NOT LIKE 'DEP%'
            AND id_funcionario NOT IN (SELECT id_funcionario FROM cedec_usuario WHERE id_funcionario IS NOT NULL)
            ORDER BY nome";

    $result = mysql_query($sql) or die (mysql_error());

    print "<select name=\"selNomeFuncionario\" id=\"selNomeFuncionario\">";

    print "<option value=\"0\">Selecione o Funcionário</option>";

    while ($linha = mysql_fetch_array($result)) {

        print "<option value=".$linha[0].">".utf8_encode($linha[1]).", ".$linha[2]."</option>";
    }

    print "</select>";

}


#@ Busca Funcionario para alteração e retorna o id
static function BuscaFuncionarioAlterar($_nome){
	
	$con = Conexao::getInstance();


	$sql = "select nome, id_funcionario from cedec_funcionario where nome like '%".$_nome."%'";
	
	$result = $con->query($sql);

	
	print "<table class=\"table\">";

	while($linha = $result->fetch(PDO::FETCH_ASSOC)){

		print "<tr><td>".utf8_encode($linha['nome'])."</td>
		<td><a href=\"index.php?modulo=equipe&secao=funcionario&acao=alterar&id=".$linha['id_funcionario']."\">&nbsp;&nbsp;<i class=\"icon-edit\" title=\"Alterar Dados\"></i></a></td></tr>";

	}

	print "</table>";

}

#@ Busca todos dados do funcionario para alterar
static function BuscarFuncionario($_id_funcionario) {
	
	$con = Conexao::getInstance();
	
	$dados = array();

	$sql = "SELECT id_funcionario,
	num_masp,
	nome,
	endereco,
	bairro,
	cidade,
	telefone,
	celular,
	posto,
	secao,
	funcao,
	desc_funcao,
	quinquenio,
	dt_nasc,
	curso,
	email,
	email2,
	situacao,
	cpf,
	orgao,
	tipo_abono,
	ci
	FROM cedec_funcionario
	WHERE id_funcionario = :id_funcionario";


	$result = $con->prepare($sql);
	
	$result->bindValue(":id_funcionario", $_id_funcionario);
	$result->execute();
	
	while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
		$dados = $linha;
	}
	return $dados;

}

#@ Relatorio Geral de funcionários
static function RelatorioGeralFuncionario($id = false){

	$dados = array();
    
    $filtro = ((int)$id) ? "and id_funcionario = ".$id : ""; 

	$sql = "SELECT id_funcionario,
	num_masp,
	nome,
	endereco,
	bairro,
	cidade,
	telefone,
	celular,
	posto,
	secao,
	funcao,
	desc_funcao,
	quinquenio,
	dt_nasc,
	curso,
	email
	FROM cedec_funcionario
	WHERE situacao = 1 {$filtro} 
	ORDER BY nome";
    
    //print $sql;

	$result = mysql_query($sql) or die (mysql_error());

	while($linha = mysql_fetch_array($result)) {

		$dados[] = $linha;

	}

	return $dados;

}

#@ Relatorio lista de funcionario para email
function ListaEmail(){

	$dados = array();

	$sql = "SELECT num_masp, nome, email
	FROM cedec_funcionario
	WHERE situacao = 1 
	ORDER BY nome";

	$result = mysql_query($sql) or die (mysql_error());


	while($linha = mysql_fetch_array($result)){

		$dados[] = $linha;
	}

	return $dados;


}

#@ Listagem de email
function ListagemEmail(){

    $dados = array();

    $sql = "SELECT num_masp,
                    nome,
                    email,
                    email2,
                    secao,
                    posto
                    FROM cedec_funcionario
                    WHERE situacao = 1
                    ORDER BY nome";

    $result = mysql_query($sql) or die (mysql_error());


    while($linha = mysql_fetch_array($result)){

        $dados[] = $linha;
    }

    return $dados;


}

/**
 * Retorna o nome e posto do funcionario
 * @param Identificador do Usuario
 * @return nome e posto do funcionario
 * 
 */
 static function getFuncionarioId($id_user) {
 	
 		$con = Conexao::getInstance();
 	
 		$dados = array();
    
        $sql = 'select nome, posto
        from cedec_funcionario
        where id_funcionario = :id_user';
        
        $result = $con->prepare($sql);
        
        $result->bindValue(":id_user", $id_user);
        $result->execute();
        
        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
        	$dados = $linha;
        }
        
        
        return $dados['nome']." ".$dados['posto'];
     
    
    }
 
/**
 * Cadastro banco funcionario
 * @author Demetrio S. Passos
 * @param id_funcionario
 * @param non_banco
 * @param num_banco
 * @param conta
 * @param tipo
 * @param agencia
 * @return
 */
        function CadastroBanco($_id_funcionario,
                               $_nom_banco,
                               $_num_banco,
                               $_conta,
                               $_tipo,
                               $_agencia,
                               $_principal){
                                   
            $sql = "INSERT INTO equ_banco ( id_funcionario,
                                            nom_banco,
                                            num_banco,
                                            conta,
                                            tipo,
                                            agencia,
                                            principal)
                                            VALUES ('".$_id_funcionario."',
                                                    '".$_nom_banco."',
                                                    '".$_num_banco."',
                                                    '".$_conta."',
                                                    '".$_tipo."',
                                                    '".$_agencia."',
                                                    '".$_principal."')"; 
                                                    
             //print $sql;
             
             $_result = mysql_query($sql) or die (mysql_error()."opa"); 
             
             return true;
                                
        }

        /**
         * Atualiza Cadastro banco funcionario
         * @author Demetrio S. Passos
         * @param id_banco
         * @param non_banco
         * @param num_banco
         * @param conta
         * @param tipo
         * @param agencia
         * @param principal
         * @return boolean
         */
        function alterarBanco($idBanco,
                               $nomBanco,
                               $numBanco,
                               $conta,
                               $tipo,
                               $agencia,
                               $principal){
                                   
            $sql = "UPDATE equ_banco 
                    SET nom_banco = '".$nomBanco."',
                    num_banco = '".$numBanco."',
                    conta = '".$conta."',
                    tipo = '".$tipo."',
                    agencia = '".$agencia."',
                    principal = '".$principal."'
                    WHERE id_banco = '".$idBanco."'";                                       
             
             //print $sql;
             
             $_result = mysql_query($sql) or die (mysql_error()); 
             
             return true;
                                
        }
        

/**
 * 
 * Faz a regularizacao dos dados bancários setando a principal (deixa uma como principal)
 * 
 */
    function ContaPrincipal($_id_funcionario){
        $sql ="UPDATE equ_banco
                SET principal = 0
                WHERE id_funcionario = ".$_id_funcionario;
        
        //print $sql;        
        
        $result = mysql_query($sql) or die (mysql_error());
                
        return true;
        
    }
    
    /**
     * Busca cadastro de banco
     * @param string nome funcionario
     * @return array
     */
     function buscaBancoFuncionario($_nome){
                 
         $dados = array();
         
         $sql = "SELECT equ_banco.id_banco,
                        cedec_funcionario.nome,
                        equ_banco.principal,
                        equ_banco.conta,
                        equ_banco.agencia,
                        equ_banco.tipo 
                        FROM equ_banco 
                        INNER JOIN cedec_funcionario 
                        ON equ_banco.id_funcionario = cedec_funcionario.id_funcionario
                        WHERE cedec_funcionario.nome LIKE '%".$_nome."%'";
                        
         $result = mysql_query($sql) or die (mysql_error());
         
         while ($linha = mysql_fetch_array($result)) {
                 
             $dados[] = $linha;
             
         }
         
         return $dados;
         
     }
     
     /**
     * busca dados banco funcionario com Identificador
     * @param integer id_banco
     * @return array
     */
     function buscaBancoFuncionarioId($_idBanco){
                 
         $dados = array();
         
         $sql = "SELECT nom_banco,
                        num_banco,
                        conta,
                        tipo,
                        agencia,
                        principal,
                        id_funcionario
                        FROM equ_banco 
                        WHERE id_banco = ".$_idBanco;
                        
         $result = mysql_query($sql) or die (mysql_error());
         
         $linha = mysql_fetch_array($result);
                 
             $dados[] = $linha;

         return $dados;
         
     }
     
     /**
      * Busca conta bancária de Funcionario com o identificador do Funcionario
      * @param Integer $id_funcionario
      * @return array(); 
      */
      
      static function ContaBanco($id_funcionario) {
          
          $dados = array();
          
          $sql = "SELECT nom_banco,
                  num_banco,
                  conta,
                  tipo,
                  agencia,
                  principal
                  FROM equ_banco
                  WHERE id_funcionario = {$id_funcionario}
                  ORDER BY nom_banco";
                  
          $result = mysql_query($sql) or die (mysql_error());
          
          while ($linha = mysql_fetch_array($result)) {
              $dados[] = $linha;
              
          }
          
          return $dados;
   
      }
    
    /**
     *  Combobox com os nomes e postos do chefe e diretores
     * @param booleano $opcao * opcao para desabilitar o elemento
     * @param int $colunas numero de colunas do bootstrap para tamanho do input
     * @param booleano $id Identificador para mostrar o funcionario selecionado
     * 
     */
     function getNomeDiretoria($opcao, $colunas = "12", $id = false){
            
        $op = ($opcao) ?  'disabled=\"disabled\"' : '';
        
        if($id) {
                
           $nome = EquipeFuncionario::getFuncionarioId($id); 
            
        }else {
            
            $nome = "Selecione o Nome";
        }
            
                
        $con = Conexao::getInstance();    
         
        $sql = "SELECT id_funcionario, nome, posto
                FROM cedec_funcionario
                WHERE funcao
                IN (\"CHEFIA\", \"DIRETORIA\")
                AND situacao = 1
                ORDER BY nome";
       
        try {
            
            $result = $con->query($sql);
            
            $result->execute();
            
            
            print "<select class=\"span".$colunas."\" name=\"sel_nDiretoria\" id=\"sel_nDiretoria\" ".$op.">";
            
            print "<option value=\"0\">".$nome."</option>";
            
            while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
                   
                print "<option value=\"".$linha['id_funcionario']."\">".utf8_encode($linha['nome']).", ".$linha['posto']."</option>";
            }
            print "</select>";
            
        
        }catch (Exception $e){
            
            return $e->getMessage." ";
        }
     }
       
       
    /**
     * Busca dados do funcionario 
     * @param integer $id_funcionario
     * @return array
     * 
     */
     function pegaDadosFuncionario($id_funcionario) {
         
         
         $sql = "SELECT nome, num_masp, funcao, desc_funcao FROM cedec_funcionario WHERE id_funcionario =".$id_funcionario;
         
         
         
         $result = mysql_query($sql) or die (mysql_error());
         
         $linha = mysql_fetch_assoc($result);
         
         return $linha;
         
         
     }
     
     /**
      * 
      * 
      * 
      * 
      *
      */
      function alterarOrdenador($id_funcionario) {
       
        $sql = "UPDATE cedec_param SET ordDespesa = ".$id_funcionario;
        
        $result = mysql_query($sql) or die (mysql_error());   
        
        //print $sql;
        
        return true;
          
      }
      
      
      /**
       * 
       * 
       * 
       */
       static function dadosCombo(){
               
           $dados = array();
           
        
           $con = Conexao::getInstance();
           
           $sql = "SELECT id_funcionario, nome, posto FROM cedec_funcionario ORDER BY nome";
           
           
           $result = $con->query($sql);

           $result->execute();
            
           while($linha = $result->fetch(PDO::FETCH_ASSOC)){
           		$dados[] = $linha;
           }
            
           return $dados;
 
       }
      

    public function buscaEmailFuncionario($login){
    	
    	try {
	    	$dados = array();
	        
	        $con = Conexao::getInstance();
	        
	        $sql = 'SELECT cedec_funcionario.email
	                     FROM cedec_funcionario
	                     INNER JOIN cedec_usuario
	                     ON cedec_funcionario.id_funcionario = cedec_usuario.id_funcionario
	                     WHERE cedec_usuario.login = :login';
	        
	        $result = $con->prepare($sql);
	        
	        $result->bindParam(":login", $login);
	        $result->execute();
	        
	        while($linha = $result->fetch(PDO::FETCH_ASSOC)){
	        	
	        	$dados = $linha;
	        }
	        
	        return $dados;
    	
    	}catch (Exception $e){
    		
    		print $e->getMessage();
    	}
        
    }    
    
    
    static public function postoGraduacao($default = "Selecione uma opção"){

        print "<label>Posto/Graduação</label>
                <select class='form form-control' title='Posto /Graduação' name='txt_posto'>
                            <option>".$default."</option>
                            <option>Cel PM</option>
                            <option>Ten Cel PM</option>
                            <option>Maj PM</option>
                            <option>Maj BM</option>
                            <option>Cap PM</option>
                            <option>Cap BM</option>
                            <option>Ten PM</option>
                            <option>Ten BM</option>
                            <option>Sub Ten PM</option>
                            <option>Sub Ten BM</option>
                            <option>1º Sgt PM </option>
                            <option>1º Sgt BM </option>
                            <option>2º Sgt PM </option>
                            <option>2º Sgt BM </option>
                            <option>3º Sgt PM </option>
                            <option>3º Sgt BM </option>
                            <option>Cb PM</option>
                            <option>Cb BM</option>
                            <option>Sd PM</option>
                            <option>Sd BM</option>
                            <option>SC</option>
                            <option>FC</option>
                        </select>";
    } 
    
    
    static public function secaoDiretoria($default = "Selecione uma opção"){
        print "<label>Seção/Diretoria</label>
                        <select class='form form-control' title='Seção / Diretoria' name='txt_secao'>
                            <option>".$default."</option> 
                            <option>DRRD</option>
                            <option>DRD</option>
                            <option>ADS</option>
                            <option>DEPDC</option>
                            <option>DLOG</option>
                            <option>SECRETARIA</option>
                            <option>CCE</option>
                            <option>CHEFIA</option>
                            <option>DADM</option>
                            <option>DCS</option>
                            <option>DEPOS</option>
                            <option>DPLAN</option>
                            <option>DTEC</option>
                            <option>GMG</option>
                            <option>NCO</option>
                            <option>STO</option>
                            <option>SADM</option>
                            <option>DEDC</option>
                            <option>DAR</option>
                        </select>";
    } 
    
    
    static function funcaoCargo($default ="Selecione uma opção"){
    
        print "<label>Função/Cargo</label>
            <select class='form form-control' title='Função Cargo' name='txt_funcao'>
                <option>".$default."</option>
                <option>CHEFIA</option>
                <option>SUPERINTENDÊNCIA</option>
                <option>DIRETORIA</option>
                <option>ASSESSORIA</option>
                <option>AUXILIAR I</option>
                <option>AUXILIAR II</option>
                <option>MOTORISTA</option>
                <option>VISITANTE</option>
                <option>VOLUNTARIO</option>
                <option>REDEC</option>
             </select> "; 
                        
         }
         
         
     static function funcaoExercida($default = "Selecione uma opção"){
                 
         print "<label>Função Exercida</label>";
         print "<select class='form form-control' title='Descrição da Função Exercida' name='txt_descr_funcao'>";
         print "<option>".$default."</option>";
         print "<option>Função exercida</option>";
         print "<option>Auxiliar Administrativo</option>";
         print "<option>Motorista</option>";                      
         print "<option>Chefe do Gabinete Militar do Governador e Coordenador Estadual de Defesa Civil</option>";
         print "<option>Subchefe do Gabinete Militar do Governador</option>";
         print "<option>Secretário Executivo de Defesa Civil</option>";
         print "<option>Diretor de Recursos Humanos</option>";
         print "<option>Diretor Administrativo da CEDEC/MG</option>";
         print "<option>Diretor de Planejamento da CEDEC/MG</option>";
         print "<option>Diretor Técnico da CEDEC/MG</option>";
         print "<option>Diretor de Comunicação Social da CEDEC/MG</option>";
         print "<option>Diretor de Ensino em Defesa Civil</option>";
         print "<option>Diretor de Apoio as Regionais</option>";
         print "<option>Superintendente de Planejamento, Gestão e Finanças</option>";
         print "<option>Superintendente Administrativo</option>";
         print "<option>Superintendente Técnico Operacional</option>";
         print "<option>Chefe do Centro de Controle de Emergências da CEDEC/MG</option>";
         print "<option>Chefe do Depósito da CEDEC/MG</option>";
         print "<option>Secretária da CEDEC/MG</option>";
         print "<option>Subsecretário Executivo de Defesa Civil</option>";
         print "<option>Subchefe do Centro de Controle de Emergências da CEDEC/MG</option>";
         print "<option>Técnico em Informática</option>";
         print "<option>Agente Regional de DC</option>";
         print "</select>";
                        }
     
}?>