<?php
/***********************************************************************************
* 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
* 																					*
* 	Classe para controle de usuario login											*
* 																					*
* 	Autor: Demetrio da Silva Passos													*
* 																					*
* 	Criacao : 01/02/2012															*
************************************************************************************/

require_once PATH.'/mod_ajuda/classe/Classe.Liberacao.php';

class LoginExterno extends Log {

private static $login;

private static $nivel;

private static $acesso;

private static $id_usuario;

private static $_id_deposito;

private static $_nivelModulo;

private static $_id_municipio;

private $linha;

private $dados;




/**
 * 
 * Logar Externo
 * 
 * 
 */
public function logarExterno($_login, $senha, $redireciona = false){
    
    $_senha = "";
    
    $linha = array();
    
    if((($_login != "") && ($_login != null)) && (($senha !="") && ($senha != null))){
    
        $_senha = md5($senha);
        
        $sql = "Select cedec_user_ex.id,
		cedec_user_ex.usuario,
		cedec_user_ex.email_rec,
		cedec_user_ex.id_municipio,
		cedec_user_ex.trsenha,
		cedec_user_ex.situacao,
		cedec_user_ex.validade,
                cedec_user_ex.reset,
		cedec_municipio.nome
			FROM cedec_user_ex
			INNER JOIN cedec_municipio
			ON 
			cedec_user_ex.id_municipio = cedec_municipio.id_municipio
				WHERE cedec_user_ex.usuario = :login
				AND cedec_user_ex.senha = :senha
				OR
				cedec_user_ex .email_rec = :email_rec
				AND cedec_user_ex.senha = :senha";
    

        $result = Conexao::getInstance()->prepare($sql);
    
        $result->bindValue(":login", $_login);
        $result->bindValue(":email_rec", $_login);
        $result->bindValue(":senha", $_senha);
        $result->execute();
        
        while ($dados = $result->fetch(PDO::FETCH_ASSOC)) {
    
            $linha = $dados;
		}
        if(!$linha){
            
            Usuario::gravarLogin(array('login'=>$_login, 'acao'=>'Login: '.$_login." Senha: ". $senha));
            return false;

        }else if($linha && ($linha['situacao'] == "DESATIVADO")){
			
			print '<script> alert("Usuario EXPIRADO !");
			/* history.back(); */
			window.location = "index.php";
			</script>';
        }elseif ($linha && self::VerificaBrowser()) {
            
            
			
			self::$_id_municipio = $linha['id_municipio'];
			self::$login = $linha['usuario'];

			//$this->ultimoAcesso($linha['id']);
			
			
			/* controla o numero de acessos atualização dos dados */
			//$qtd_acesso = self::pegaQtdAcesso($linha['id']);
			
			//self::atualizaAcesso($linha['id'], 1);
			
			//var_dump($linha);
			self::SetCookieExterno($linha);
                        

            /* troca de senha */
            if($linha['trsenha'] == 1) {
				//self::SetCookieExterno($linha);
				return array('acesso' => "trsenha",
                                            'reset' => $linha['reset']);	
            }else {
				//if((int)$qtd_acesso >= 3){
					//self::atualizaAcesso($linha['id'], "0");
					//return "perfil";
					/* Log::GravaLogUserEx("Acesso ao Sistema", "cedec_user_ex_log", $linha['id_municipio'], false)); */
				//}else {
					return "index";
				//}

			}
			
        }else {
			return "mozila";
		}
		
    }else {
       return false;
    }  
}

/**
 * seta os cookie para sessao externo
 *  
 */
static function SetCookieExterno($dados){
	if(empty($dados)){
		try{
			ob_start();
				setcookie("seguranca[idUser]", 	    $_COOKIE['seguranca']['idUser'],        time()+SESSAOEX, "/");
				setcookie("seguranca[login]", 	    $_COOKIE['seguranca']['login'],         time()+SESSAOEX, "/");
				setcookie("seguranca[nome_usuario]",$_COOKIE['seguranca']['nome_usuario'],  time()+SESSAOEX, "/");
				setcookie("seguranca[email_rec]",   $_COOKIE['seguranca']['email_rec'],     time()+SESSAOEX, "/");				
				setcookie("seguranca[id_municipio]",$_COOKIE['seguranca']['id_municipio'],  time()+SESSAOEX, "/");
				setcookie("seguranca[externo]",     $_COOKIE['seguranca']['externo'],       time()+SESSAOEX, "/");
				setcookie("seguranca[tipo]",	    $_COOKIE['seguranca']['tipo'],          time()+SESSAOEX, "/"); //4 horas
				setcookie("seguranca[sessao]",	    $_COOKIE['seguranca']['sessao'],          time()+SESSAOEX, "/"); //4 horas
			ob_end_clean();

		}catch (Exception $e){

			print header('Location:/index.php');
		}


	}else {
		try{
			ob_start();
				setcookie("seguranca[idUser]",      $dados['id'],         time()+SESSAOEX, "/");
				setcookie("seguranca[login]",       self::$login,         time()+SESSAOEX, "/");
				setcookie("seguranca[nome_usuario]",$dados['nome'],       time()+SESSAOEX, "/");
				setcookie("seguranca[email_rec]",   $dados['email_rec'],  time()+SESSAOEX, "/");
				
				setcookie("seguranca[id_municipio]",self::$_id_municipio, time()+SESSAOEX, "/");
				setcookie("seguranca[externo]",     true,                 time()+SESSAOEX, "/");
				setcookie("seguranca[tipo]",        "e",                  time()+SESSAOEX, "/"); //4 horas
				setcookie("seguranca[sessao]",      time()+SESSAOEX,      time()+SESSAOEX, "/"); //4 horas
				
				if(isset($_COOKIE['seguranca']['sessao_id'])){
					session_regenerate_id();
				}else {
					setcookie("seguranca[sessao_id]", session_id(), time()+SESSAOEX, "/");
				}
			ob_end_clean();
			return true;
		}catch (Exception $e){
			print header('Location:/index.php');
		}

	}
}

/**
 * seta os cookie para sessao externo
 *  
 */
static function UnsetCookieExterno(){

	try{

			setcookie("seguranca[idUser]", 		null, -1);
			setcookie("seguranca[login]", 		null, -1);
			setcookie("seguranca[nome_usuario]",null, -1);
			setcookie("seguranca[email_rec]", 	null, -1);
			
			setcookie("seguranca[id_municipio]",null, -1);
			setcookie("seguranca[externo]", 	null, -1);
			setcookie("seguranca[tipo]", null, -1);
			setcookie("seguranca[sessao]", null, -1);
			setcookie("seguranca[sessao_id]", null, -1);

		}catch (Exception $e){

			print header('Location:/index.php');
		}

}

/**
 * Dados Usuario
 * 
 */
public function getUsuario($id){

	$sql = "SELECT
			id,
			usuario,
			senha,
			email_rec,
			acesso,
			id_municipio,
			trsenha,
			mod_pipa,
			mod_compdec,
			mod_ajuda,
			situacao,
			validade,
			cpf,
			tmpAnexo,
			obs,
			qtd_acesso
			FROM cedec_user_ex
			WHERE ID= :id";
			
	try {
		
		$result = Conexao::getInstance()->prepare($sql);
	    $result->bindValue(":id", $id);
	    $result->execute();
	    
		while ($dados = $result->fetch(PDO::FETCH_ASSOC)) {
    
        	$this->dados = $dados;
        }
        
        return $this->dados;
	
	}catch (Exception $e){
		Print "Erro".$e->getMessage();		
	}
}
/**
 * grava ultimo acesso ao sistema
 * 
 */
	public function ultimoAcesso($id_usuario){
		
		$sql = "Update cedec_user_ex set acesso ='".date('Y-m-d H:i:s')."'
				WHERE id = :id";
		try {
	        $result = Conexao::getInstance()->prepare($sql);
	        $result->bindValue(":id", $id_usuario);
	        $result->execute();
		}catch (Exception $e){
			
		}
	
	}

/**
 * 
 * 
 */
public function geraUsuario($dados){
    return substr(str_replace(" ", "", $dados), 0, 10).rand(1000, 5000);
    //return (strpos($dados, " ")) ? substr($dados, 0, strpos($dados, " ")).rand(1000, 5000) : $dados.rand(1000, 5000) ;
}
/**
 * @return quantidade de acessos do usuario
 * 
 */
 static function pegaQtdAcesso($_id_usuario){
     
 	$_sql = "SELECT qtd_acesso
              FROM cedec_user_ex
              WHERE id = :id_usuario";
     
     try {
        
        $result = Conexao::getInstance()->prepare($_sql);
        $result->bindValue(":id_usuario", $_id_usuario);
        $result->execute();
         
         while ($dados = $result->fetch(PDO::FETCH_ASSOC)) {
         	
         	$linha = $dados;
         }
     
         return $linha['qtd_acesso'];
         
     } catch (Exception $e) {
         
         return $e->getMessage()." Código 12";
     }      
 }
 
 /**
  * Incrementa a quantidade de acesso realizados
  * @param $idUsuario integer
  * @param @opcao integer 
  * @return atualiza acesso
  * 
  */
 static function atualizaAcesso($idUsuario, $opcao){
         
     $atualiza = ($opcao == "1") ? "qtd_acesso + 1" : "0";
     
     $sql = "UPDATE cedec_user_ex
              SET qtd_acesso = ".$atualiza."
              WHERE id = ".$idUsuario;
     
     
     try {

     	$result = Conexao::getInstance()->prepare($sql);
     	$result->execute();
     	
        return true;
         
     } catch (Exception $e) {
     	
	     return $e->getMessage().'Código: 13';
     	
     }

     
 }
 
 

/**
 * @return ultimo dia do acesso
 * 
 */
 function PegaUltimoAcesso($_id_usuario){
     
     $linha = array();
     
     $_sql = "SELECT dias_acesso
              FROM cedec_usuario
              WHERE id_usuario = :id_usuario";

     
     try {
    
         $result = Conexao::getInstance()->prepare($_sql);
         $result->bindValue("id_usuario", $_id_usuario);
         $result->execute();
         
         while ($dados = $result->fetch(PDO::FETCH_NUM)) {
         
             $linha[] = $dados;
         }

             
     } catch (Exception $e) {
     	
	     return $e->getMessage().'Código: 14';
     	
     }        
     
         return $linha;     
     
     
 } 


#@ verifica a senha do usuario
function TrocaSenha($login, $senha_nova) {
	
	$con = Conexao::getInstance();

    	$sql = "UPDATE cedec_user_ex
		              SET senha = :senha_nova,
                              trsenha = :trsenha,
                              reset = :reset
		              WHERE usuario = :usuario";
		
		try {
		    
    		$result = $con->prepare($sql);
    		$result->bindValue(":senha_nova", md5($senha_nova));
    		$result->bindValue(":trsenha", 0);
    		$result->bindValue(":reset", null);
    		$result->bindValue(":usuario", $login);
    		$result->execute();
    		
    		return true;

		}
		catch (Exception $e) {
		
		    return $e->getMessage()."Código: 15.1";

		}

}

/**
 * lista com usuario externos
 * @param
 * @return $dados array
 */
function ListUsuarioEx(){

	$dados = array();

	$sql = "select cedec_user_ex.id,
					cedec_user_ex.usuario,
					cedec_user_ex.id_municipio,
					cedec_municipio.nome
						from cedec_user_ex
						inner join cedec_municipio
						on cedec_user_ex.id_municipio = cedec_municipio.id_municipio";
	
	try {
	    
    	$result = Conexao::getInstance()->query($sql);
    	
    	while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
    
    		$dados[] = $linha;
    	}
    
    	return $dados;
    	
	} catch (Exception $e) {
	    
	    return $e->getMessage()."-";
	    
	}


}


function LisUsuarioAtivar(){

	$dados = array();

	$sql = "select cedec_user_ex.id,
					cedec_user_ex.usuario,
					cedec_user_ex.id_municipio,
					cedec_user_ex.situacao,
					cedec_municipio.nome
						from cedec_user_ex
						inner join cedec_municipio
						on cedec_user_ex.id_municipio = cedec_municipio.id_municipio
						where cedec_user_ex.situacao ='PENDENTE'";

	try {
	  
		$result = Conexao::getInstance()->query($sql);
		 
		while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

			$dados[] = $linha;
		}

		return $dados;
		 
	} catch (Exception $e) {
	  
		return $e->getMessage()."-";
	  
	}


}


/* dados do usuario */

	public function dadosUsu($id_municipio = false){
		
		$dados = array();
		
		if(!empty($id_municipio)){
			$filtro = 'where cedec_municipio.id_municipio = '.$id_municipio;
		}else {
			$filtro = "";			
		}
		
		$sql = "select cedec_user_ex.id,
					cedec_user_ex.usuario,
					cedec_user_ex.email_rec,
					cedec_user_ex.acesso,
					cedec_user_ex.id_municipio,
					cedec_user_ex.situacao,
					cedec_user_ex.cpf,
					cedec_municipio.nome
						from cedec_user_ex
						inner join cedec_municipio
						on cedec_user_ex.id_municipio = cedec_municipio.id_municipio
						".$filtro;

		try {
		
			$result = Conexao::getInstance()->query($sql);
			//$result->execute();
			
			while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
			
				$dados[] = $linha;
			}
		
			return $dados;
		}
		catch (Exception $e) {
		
			return $e->getMessage()."Código: 15.1";
		
		}

		
	}
	


#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function setId() {
	//$this -> idUser = $id;
	//return $id;
}

#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function getId($id) {
	$this -> idUser = $id;
	return $this -> idUser;
}

#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * Verifica se o usuario tem sessao aberta
 * @param
 * @return void (alert)
 */
static function verificaLog() {

	if(LoginExterno::VerificaBrowser()){
	    
	    $index = "../index.php";
	    
		if(!isset($_SESSION['seguranca']['id_municipio'])){

			print "<script type='text/javascript'>";
			
			print "alert('Voce deve estar Logado para Acesso !');";
						  
			print "window.location.href = '".$index."';";

			print "</script>";


		}
	}
	

}

#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * Verifica se o usuario está logado e permissao de acesso
 * @param nome coluna acesso
 * @param nome do módulo
 * 
 */
static function logadoExterno($_acesso = false, $_modulo = false) {

	/* verifica se esta logado */
	if(!$_acesso && !$_modulo) {

        /* verifica se o usuario está logado */
		LoginExterno::verificaLog();
    
    /* verifica se esta logado e acesso */
    }else if($_acesso && $_modulo) {    
    
        /* verifica se o usuario está logado */
        LoginExterno::verificaLog();
        
        /* verifica o acesso ao modulo */
        LoginExterno::verificaAcesso($_acesso, $_modulo);

    }
}

#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/**
 * 
 * @param $_acesso String 
 * @param $_modulo String
 * @return 
 * 
 */

static function verificaAcesso($_modulo){

    $dados = array();

    $sql = "SELECT usuario,
                   mod_pipa
                   FROM cedec_user_ex
                   WHERE usuario = :login";
	//print $sql;
	
	$_acesso = 0;

    try {
        $result = Conexao::getInstance()->prepare($sql);
        $result->bindValue(":modulo", $_modulo);
        $result->bindValue(":login", $_SESSION['seguranca']['login']);
        $result->execute();
           
        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
    
            $dados = $linha;
        }
        
        if($dados[$_acesso] == "0"){
    
                print "<script type='text/javascript'>";
    
                print "alert('Acesso Negado !');";
    
                print "window.location.href = '".SISTEMA."/core/logout.php?logout=s';";
    
                print "</script>";
        }else {
            
            return $dados;
        }
    }
    catch (Exception $e) {
        
        return $e->getMessage()."Código : 18";
    }

}

/**
 * Controle Permissao (permissao: CAMPO tabela de permissao), (modulo nome tabela) 
 * @param $_permissao String 
 * @param $_modulo String
 * @return 
 * 
 */

function verificaPermissao($_permissao, $_modulo){

    $con = Conexao::getInstance();
    
    $dados = array();
    
    try {

    $sql = "SELECT login, ".$_permissao." FROM ".$_modulo." WHERE login = '".$_SESSION['seguranca']['login']."'";
        
       $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
            
            $dados = $linha;
        }
        
         return $dados[$_permissao];
        
    } catch (Exception $e) {
        
        $e->getMessage()."Código: 29";
    }


}

#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * Realiza o logout do sistema
 * @param $redirecioma
 * @return void elemento javascript window.location
 */
function logout($redireciona = false) {

	$_SESSION = array();
	// Destroi a Sessão
	session_destroy();
	// Se for necessário redirecionar
	if ($redireciona){

		print "<script text/javascript>";

		print "window.location ='".$redireciona."';";
		
		print "</script>";

	}
		
}

#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
#@ filtro de acesso ao menu principal do site
function acessoMenu($idUser) {

	# itens do Menu Principal

	$item_cad_liberacao = "<li>
	<a href=\"index2.php?secao=lib\" title=\"Libera&ccedil;&atilde;o de Materiais\">Libera&ccedil;&atilde;o</a>
	</li>";

	$item_cad_pagamento = "<li>
	<a href=\"#\">Dep&oacute;sito</a> 
	<ul>
	<li>
	<a href=\"index2.php?secao=pag\" title=\"Pagamento de Materiais para o Benefici&aacute;rio\">Pagamento</a>
	</li>
	<li>
	<a href=\"index2.php?secao=rec\" title=\"Recebimento de Materiais Transferidos\">Recebimento de Material</a>
	</li>
	</ul>";


	$item_cad_material = "<li>
	<a href=\"index2.php?secao=cmat\" title=\"Cadastro de Materiais no Sistema\">Cadastro Material</a>
	</li>";

	$item_cad_transito = "<li>
	<a href=\"index2.php?secao=trant\" title=\"Material em Transito\">Material em Transito</a>
	</li>";

	$item_cad_transf_mat = "<li>
	<a href=\"index2.php?secao=tran\" title=\"Transfer&ecirc;ncia de Materiais entre Depositos\">Transfer&ecirc;ncia de Materiais</a>
	</li>";

	$item_cad_rel_cons = "<li>
	<a href=\"index2.php?secao=rcon\" title=\"Consulta Posi&ccedil;&atilde;o dos Estoque dos Dep&oacute;sitos e Relat&oacute;rios em Geral\">Consultas e Relat&oacute;rios</a>
	</li> ";

	$item_cad_config = "<li>
	<a href=\"index2.php?secao=conf\" title=\"Configura&ccedil;&otilde;es\">Configura&ccedil;&otilde;es</a>
	</li>";
	
	$item_cad_ajuda_sup = "<li>
	<a href=\"index2.php?secao=asup\" title=\"Ajuda e Informa&ccedil;&otilde;es sobre o Sistema\">Ajuda/Suporte</a>
	</li>";

	# @ array contendo o indice para mostra de menu de cadastros
	$mostra = array($item_cad_liberacao,
		$item_cad_pagamento,
		$item_cad_material,
		$item_cad_transito,
		$item_cad_transf_mat,
		$item_cad_rel_cons,
		$item_cad_config,
		$item_cad_ajuda_sup);
	
	$dados = array();

	#@ sql que filtra dos dados de permissao aos cadastros gerais
	$sql = "SELECT cad_liberacao,
	cad_pagamento,
	cad_material,
	cad_transito,
	cad_transferencia,
	cad_cons_relatorio,
	cad_conf_ger,
	cad_ajuda_suporte
	FROM permissao
	WHERE login = :id_usuario";
	
	try {
	         
	    $result = Conexao::getInstance()->prepare($sql);
	    $result->bindValue(":id_usuario", $idUser);
	    $result->execute();
	    
	    while($linha = $result->fetch(PDO::FETCH_NUM)){
	        
	       $dados = $linha; 
	        
	    }
	    
    	//FuncaoBase::vd($linha);	
    	//FuncaoBase::vd(count($mostra));
    	# busca os campos na tabela do banco que refere-se ao cadastro
    	for ($i = 0; $i < count($mostra); $i++) {
    
    		if ($linha[$i] != 0) {
    
    			echo $mostra[$i];
    
    		}
    
    	}
    	
	} catch (Exception $e) {

	    $e->getMessage()."Código: 19";
	}
	


}


#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
#@ filtro de acesso ao relatório do sistema 
function acessoRel($_login) {

	# item do relatórios do sistema

	#@ Tela de relatorio posicao geral dos depositos
	$item_rel_pos_geral = "<a href=\"?op=posg\">- Posi&ccedil;&atilde;o Geral do Estoque</a>";

	#@ tela de relatorio posicao geral filtrado por deposito
	$item_rel_pos_dep = "<a href=\"?op=posd\">- Posi&ccedil;&atilde;o Saldo por Dep&oacute;sito</a>";

	#@ tela de tela de relatório de materiais pagos
	$item_rel_cons_mat_pago = "<a href=\"?secao=cmatp\">- Consulta Material Pago </a>";

	#@ tela de relatórios de recebimento de materiais
	$item_rel_recebimento = "<a href=\"#\">- Recebimento de Materiais</a>";

	#@ relatórios de materiais em trânsito
	$item_rel_mat_transito = "<a href=\"?op=cmatt\">- Consulta Material em Tr&acirc;nsito </a>";

	#@ relatórios de Transferencia de Materiais 
	$item_rel_transferencia = "<a href=\"#\">- Transferencia de Materiais</a>";

	#@ relatorio consulta de materiais liberados (liberacoes)
	$item_rel_cons_mat_lib = "<a href=\"?secao=rlib\">- Consulta Material Liberado</a>";

	#@ tela de relatório consulta materia esperando pagamento
	$item_rel_cons_mat_espera = "<a href=\"core/sc.consulta.material.espera.pgto.php\">- Consulta Material Esperando Pagamento </a>";

	#@ relatorio de material em transito
	$item_rel_cons_mar_transito = "<a href=\"rel.consulta.material.transito.php\">- Consulta Material em Tr&acirc;nsito </a>";
	
	$mostraRel = array($item_rel_pos_geral, $item_rel_pos_dep, $item_rel_cons_mat_pago, $item_rel_recebimento, $item_rel_mat_transito, $item_rel_transferencia, $item_rel_cons_mat_lib, $item_rel_cons_mat_espera);


		#@ sql que filtra dos dados de permissao aos cadastros

	$sql = "SELECT rel_saldo_geral,
	rel_saldo_p_deposito,
	rel_pagmto,
	rel_transf_mat,
	rel_mat_transito,
	rel_liberacao,
	rel_mat_liberado,
	rel_mat_espera_pgto
	FROM permissao
	WHERE login = :login";
	
	$dados = array();
	
	try {
	    
	    $result = Conexao::getInstance()->prepare($sql);
	    $result->bindValue(":login", $_login);
	    $result->execute();
	       
        while ($linha = $result->fetch(PDO::FETCH_NUM)){
	    
    	   $dados[] = $linha;
    	
        }
    
    		# busca os campos de 2 a 9 na tabela do banco que refere-se ao cadastro
    	for ($i = 0; $i < count($mostraRel); $i++) {
    
    		if ($dados[$i] != 0) {
    
    			echo $mostraRel[$i] . "<br />";
    
    		}
    
    	}
	} catch (Exception $e) {
	    
	    return $e->getMessage()."Codigo: 20";
	    
	}


}



#@ pega o nome do usuario 
function PegaNomeUsuario($_login){

	$dados = array();
	
    $sql ='SELECT nome
	FROM cedec_usuario
	WHERE login = :login';
	
	try {

	    $result = Conexao::getInstance()->prepare($sql);
	    $result->bindValue(":login", $_login);
	    $result->execute();
	    
	    while ($linha = $result->fetch(PDO::FETCH_NUM)) {
	        
	        $dados[] = $linha;;
	    }
    
    	return $dados[0];
	    
	} catch (Exception $e) {
	    
	    return $e->getMessage()."Código: 26";
	}


}


	#@ nivel de permissao acesso
function getNivel($nivel){

	if(($nivel == 2) || ($nivel == 33)){

		return true;

	}elseif (($nivel == 0) || ($nivel == 4)){

		return false;
	}


}


/**
 * Select acesso permissao ao modulo
 * @param $_login String
 * @return array
 */
function acessoModulo($id_login){

	$con = Conexao::getInstance();

	$linha = array();
	
	$sql = "SELECT mod_pipa,
					mod_compdec,
					mod_ajuda,
					mod_plano,
                                        mod_registro
						FROM cedec_user_ex
							WHERE id = :id_user";

	$result = $con->prepare($sql);
	$result->bindValue(":id_user", $id_login);
	$result->execute();
	
	while ($dados = $result->fetch(PDO::FETCH_ASSOC)) {
			
		$linha = $dados;
	}
	
	return $linha;

}

/**
 * Faz verificacao do navegador testando o google chrome
 * @param null
 * @return boolean
 */
	static function VerificaBrowser(){

		$useragent = $_SERVER['HTTP_USER_AGENT'];
	 
	   	 if(!preg_match('|Chrome|',$useragent)) {
	    
	    	print "<script type='text/javascript'>";

	    	print "alert('Navegador não Homologado! \\n \\n Favor Entrar pelo Google Chrome.');";

	    	print "window.location.href = 'http://www.defesacivil.mg.gov.br';";

	    	print "</script>";

    	}else {

    		return true;
    	}
    }

    /**
     * 
     * #@ tempo de sessao
     * @param $opcao - string 
     * trata browser ou popup ou boolean
     */
    function Sessao($opcao = null){

        $temposessao = 0;
        
        if($_SERVER['DOCUMENT_ROOT'] == 'C:/xampp/htdocs'){
            
            # em segundos 
            $temposessao = 4800; // 8 minutos
            //$temposessao = 60; // 8 minutos
            
        }else {

        	# em segundos 
    	    $temposessao = 36000; // 20 minutos
    	    //$temposessao = 3600; // 1 minuto
	    
	    }
	    
	    if (isset($_SESSION["sessiontime"])) { 
	        
	        if ($_SESSION["sessiontime"] < (time() - $temposessao)) { 
	            
	            try {
	                session_unset();
                
                }catch (Exception $e){
                   
                    
                }
                
                	if(is_null($opcao)){
                		
		                $index = "../index2.php?i=".$_SESSION['id'];
			            
			            print "<script type='text/javascript'>";
		
			            print "alert('Sua sessão Expirou !');";
		
			            print "window.location.href = '/".$index."';";
		
			            print "</script>";
                		
                	}elseif($opcao == 'popup') {
                		
			            print "<script type='text/javascript'>";
		
			            print "alert('Sua sessão Expirou !');";
		
			            print "window.close();";
		
			            print "</script>";
                		
	            
                	}elseif($opcao == 'verifica') {
                		
                		return 'erro';
                		
                	}
	            
	        }else {

	            $_SESSION["sessiontime"] = time();
				return 'sucesso';
	        } 
	        
	    } else { 
	    
	        session_unset();
	        return 'erro';
	        
	    }
	}
	
	/**
	 * 
	 * 
	 * 
	 */
	 public function ckSessao(){
	 	
	 	//alert("sessao acabou !");
	 	//var_dump($_SESSION);
	 	return false;
	 	
	 }
  	
}?>