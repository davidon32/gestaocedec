<?php /***********************************************************************************
* 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
* 																					*
* 	Classe para controle de usuario login											*
* 																					*
* 	Autor: Demetrio da Silva Passos													*
* 																					*
* 	Criacao : 01/02/2012															*
************************************************************************************/
require_once PATH.'/mod_ajuda/classe/Classe.Liberacao.php';


class Login extends Liberacao {

private static $login;

private static $nivel;

private static $acesso;

private static $id_usuario;

private static $_id_deposito;

private static $_nivelModulo;

private static $_id_municipio;

private $linha;

public function __contructor(){

}

/**
 * Autenticar usuario no sistema
 * @param $login string        - usuario do sistema
 * @param $senha string        - senha de acesso
 * @param $redireciona boolean - true, false  
 * 
 */
function logar($_login, $_senha, $redireciona = true) {
	
	$linha = array();
	
	if((($_login != "") && ($_login != null)) && (($_senha !="") && ($_senha != null))){	

		$sql = "SELECT 	cedec_usuario.login as login,
		cedec_usuario.id_usuario as id_usuario,
		cedec_usuario.nivel as nivel,
		cedec_usuario.it_m_deposito as m_deposito,
		cedec_usuario.it_m_pipa as m_pipa,
		cedec_usuario.it_m_cce as m_cce,
		cedec_usuario.it_m_decretacao as m_decretacao,
		cedec_usuario.id_deposito as id_deposito,
		cedec_usuario.trsenha as trsenha,
		cedec_usuario.email_rec as email_rec,
		cedec_funcionario.id_funcionario as id_funcionario,
		cedec_funcionario.nome as nome,
		cedec_funcionario.num_masp,
                cedec_funcionario.id_rpm,
                cedec_funcionario.posto
		FROM cedec_usuario
		INNER JOIN cedec_funcionario
		ON cedec_usuario.id_funcionario = cedec_funcionario.id_funcionario
		WHERE cedec_usuario.login = :login
		AND cedec_usuario.senha = :senha
		OR
		cedec_usuario.email_rec = :login
		AND cedec_usuario.senha = :senha
		AND cedec_usuario.situacao = 1";
		
		$result = Conexao::getInstance()->prepare($sql);
		
		$result->bindValue(":login", $_login);
		$result->bindValue(":senha", $_senha);
		$result->execute();
		
		while ($dados = $result->fetch(PDO::FETCH_ASSOC)) {
			$linha = $dados;
		}

		
		if($linha){
			self::$nivel = $linha['nivel'];
			
			self::$login = $linha['login'];

			self::$_id_deposito = $linha['id_deposito'];
			
			/* troca de senha */
			if($linha['trsenha'] == 1) {
				self::SetCookieAdm($linha);
				return "trsenha";
			 }else {

                                Login::ultimoAcesso($linha['id_usuario']);
                                
				 // abre sessão login
				 return (self::SetCookieAdm($linha)) ? true : false;
                                 
			 }	
		}else{
			return false;
		}
	}

}

/**
 * seta os cookie para sessao
 *  
 */
static function SetCookieAdm($dados = ""){

	$date = new DateTime();

	if(empty($dados)){
		try{
			ob_start();
			setcookie("seguranca[acesso][m_deposito]",   $_COOKIE['seguranca']['acesso']['m_deposito'], time()+SESSAOADM);
			setcookie("seguranca[acesso][m_pipa]",       $_COOKIE['seguranca']['acesso']['m_pipa'], time()+SESSAOADM);
			setcookie("seguranca[acesso][m_cce]",        $_COOKIE['seguranca']['acesso']['m_cce'], time()+SESSAOADM);
			setcookie("seguranca[acesso][m_decretacao]", $_COOKIE['seguranca']['acesso']['m_decretacao'], time()+SESSAOADM);

			setcookie("seguranca[idUser]",       $_COOKIE['seguranca']['idUser'], time()+SESSAOADM);
			setcookie("seguranca[login]",        $_COOKIE['seguranca']['login'], time()+SESSAOADM);
			setcookie("seguranca[nome_usuario]", $_COOKIE['seguranca']['nome_usuario'], time()+SESSAOADM);
			setrawcookie("seguranca[email_rec]",    $_COOKIE['seguranca']['email_rec'], time()+SESSAOADM);
				
			setcookie("seguranca[nivel]", 		  $_COOKIE['seguranca']['nivel'], time()+SESSAOADM);
			setcookie("seguranca[id_deposito]",   $_COOKIE['seguranca']['id_deposito'], time()+SESSAOADM);
			setcookie("seguranca[id_funcionario]",$_COOKIE['seguranca']['id_funcionario'], time()+SESSAOADM);
			setcookie("seguranca[adm]",			  $_COOKIE['seguranca']['adm'], time()+SESSAOADM);
			setcookie("seguranca[tipo]",		  $_COOKIE['seguranca']['tipo'], time()+SESSAOADM); //4 horas
			setcookie("seguranca[sessao]",		  $_COOKIE['seguranca']['sess'], time()+SESSAOADM); //4 horas tempo sessao
			setcookie("seguranca[matricula]",$_COOKIE['seguranca']['matricula'], time()+SESSAOADM);
			setcookie("seguranca[rpm]",$_COOKIE['seguranca']['rpm'], time()+SESSAOADM);
			setcookie("seguranca[posto]",$_COOKIE['seguranca']['posto'], time()+SESSAOADM);
			ob_end_clean();

			return true;
		}catch (Exception $e){

			print header('Location:/index.php');
		}


	}else {

		try{
		ob_start();
		setcookie("seguranca[acesso][m_deposito]", $dados['m_deposito'], time()+SESSAOADM);
		setcookie("seguranca[acesso][m_pipa]", $dados['m_pipa'], time()+SESSAOADM);
		setcookie("seguranca[acesso][m_cce]", $dados['m_cce'], time()+SESSAOADM);
		setcookie("seguranca[acesso][m_decretacao]", $dados['m_decretacao'], time()+SESSAOADM);
		
		setcookie("seguranca[idUser]", $dados['id_usuario'], time()+SESSAOADM);
		setcookie("seguranca[login]", self::$login, time()+SESSAOADM);
		setcookie("seguranca[nome_usuario]", $dados['nome'], time()+SESSAOADM);
		setcookie("seguranca[email_rec]", $dados['email_rec'], time()+SESSAOADM);
		
		setcookie("seguranca[nivel]", self::$nivel, time()+SESSAOADM);
		setcookie("seguranca[id_deposito]", self::$_id_deposito,time()+SESSAOADM);
		setcookie("seguranca[id_funcionario]", $dados['id_funcionario'],time()+SESSAOADM);
		setcookie("seguranca[adm]", true, time()+SESSAOADM); // 30 min
		setcookie("seguranca[tipo]", "i", time()+SESSAOADM); //4 horas
		setcookie("seguranca[sessao]", time()+SESSAOADM, time()+SESSAOADM); //4 horas
		setcookie("seguranca[matricula]",$dados['num_masp'], time()+SESSAOADM);
		setcookie("seguranca[sess]", date('dmY'), time()+SESSAOADM);
		setcookie("seguranca[rpm]", $dados['id_rpm'], time()+SESSAOADM);
		setcookie("seguranca[posto]", $dados['posto'], time()+SESSAOADM);
		
		if(isset($_COOKIE['seguranca']['sessao_id'])){
			session_regenerate_id();
		}else {
			setcookie("seguranca[sessao_id]", session_id(), time()+SESSAOADM);
		}
		ob_end_clean();

		return true;
		}catch (Exception $e){
			print header('Location:/index.php');
		}

	}
}



/**
 * seta os cookie para sessao
 *  
 */
static function UnsetCookieAdm(){

	ob_start();
		setcookie("seguranca", null, -3600);
		setcookie("seguranca[acesso][m_pipa]", null, - 3600);
		setcookie("seguranca[acesso][m_cce]", null, - 3600);
		setcookie("seguranca[acesso][m_decretacao]", null, - 3600);
		setcookie("seguranca[acesso][m_deposito]", null, - 3600);
		
		setcookie("seguranca[idUser]",  null, - 3600);
		setcookie("seguranca[login]",  null, - 3600);
		setcookie("seguranca[nome_usuario]",  null, - 3600);
		setcookie("seguranca[email_rec]",  null, - 3600);
		
		setcookie("seguranca[nivel]",  null, - 3600);
		setcookie("seguranca[id_deposito]",  null, - 3600);
		setcookie("seguranca[id_funcionario]",  null, - 3600);
		setcookie("seguranca[adm]",  null, - 3600);
		setcookie("seguranca[tipo]",  null, - 3600);
		setcookie("seguranca[sessao]", null, - 3600);
		setcookie("seguranca[matricula]", null, - 3600);
		setcookie("seguranca[sessao_id]", null, - 3600);
		setcookie("seguranca[sess]", null, - 3600);
	ob_end_clean();
}

/**
 * @return quantidade de acessos do usuario
 * 
 */
 static function pegaQtdAcesso($_id_usuario){
    
 	$linha = array();
     
 	$_sql = "SELECT qtd_acesso
              FROM cedec_usuario
              WHERE id_usuario = :id_usuario";
     
     try {
        
        $result = Conexao::getInstance()->prepare($_sql);
        $result->bindValue(":id_usuario", $_id_usuario);
        $result->execute();
         
         while ($dados = $result->fetch(PDO::FETCH_ASSOC)) {
         	
         	$linha[] = $dados;
         }
     
         return $linha;
         
     } catch (Exception $e) {
         
         return $e->getMessage." Código 12";
     }
     
      
 }
 
 /**
  * Incrementa a quantidade de acesso realizados
  * @param $idUsuario integer
  * @param @opcao integer 
  * @return atualiza acesso
  * 
  */
 static function ultimoAcesso($idUsuario){
         
     $sql = "UPDATE cedec_usuario
              SET ultimo_acesso = '".date('Y-m-d h:i:s')."'
              WHERE id_usuario = :idUsuario";
     try {

     	$result = Conexao::getInstance()->prepare($sql);
     	$result->bindValue(":idUsuario", $idUsuario);
     	
     	$result->execute();
        return true;
         
     } catch (Exception $e) {
	     return $e->getMessage().'Código: 13';
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
     
     $sql = "UPDATE cedec_usuario
              SET qtd_acesso = $atualiza,
              dias_acesso = null
              WHERE id_usuario = :idUsuario";
     try {

     	$result = Conexao::getInstance()->prepare($sql);
     	$result->bindValue(":idUsuario", $idUsuario);
     	
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

	$sql = "UPDATE cedec_usuario
		              SET senha = :senha_nova,
                              trsenha = :trsenha,
                              reset = :reset
		              WHERE login = :login";
		try {
		    
    		$result = Conexao::getInstance()->prepare($sql);
    		$result->bindValue(":senha_nova", md5($senha_nova));
    		$result->bindValue(":trsenha", 0);
    		$result->bindValue(":reset", null);
    		$result->bindValue(":login", $login);
    		$result->execute();
    		
    		return true;
		}
		catch (Exception $e) {
		
		    return $e->getMessage()."Código: 15.1";

		}
}


/**
 * valida acesso administrativo  
 * 
 */
function logarAdm($_login, $_senha, $redireciona = false) {

		$linha = array();
    
        $sql = "SELECT login,
		id_usuario,
		nivel,
		m_deposito,
		m_pipa,
		m_cce,
		m_decretacao,
		id_funcionario
		FROM cedec_usuario
		WHERE login = :login
		AND senha = :senha
		AND situacao = 1
		AND nivel = 3";
		
		
		try {
		    
		    $result = Conexao::getInstance()->prepare($sql);
		    $result->bindValue(":login", $_login);
		    $result->bindValue(":senha", $_senha); 
    		$result->execute();
    		//print $sql;
    		
    		while ($dados_busca = $result->fetch(PDO::FETCH_NUM)) {
    		
    		    $linha[] = $dados_busca;
    		}
    
            
            if(!$linha) {
                
                print "<script type='text/javascript'>";
                
                print "alert('Usuário ou Senha Inválidas');";
                              
                print "history.back();";
    
                print "</script>";
       
            }else {
    
                return $linha;
                
            } 
            
		} catch (Exception $e) {
		    
		    return $e->getMessage()."Código: 16 erro select user";
		}


}

/**
 * pega os funcionarios, com direito a realizar liberações
 * @param
 * @return $dados array
 */
function getFuncionario(){

	$dados = array();

	$sql = "select id_funcionario,
	               nome,
	               posto
	               from cedec_funcionario
	               where libera = 1
	               and situacao = 1";
	
	try {
	    
    	$result = Conexao::getInstance()->query($sql);
    	
    	while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
    
    		$dados[] = $linha;
    	}
    
    	return $dados;
    	
	} catch (Exception $e) {
	    
	    return $e->getMessage()."Código: 17";
	    
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

	//if(Login::VerificaBrowser()){

	    $index = "/index.php";

		if(!isset($_COOKIE['seguranca']['login'])){

			print "<script type='text/javascript'>";
			
			//print "alert('Voce deve estar Logado para Acesso !');";
						  
			print "window.location.href = '".$index."';";

			print "</script>";

		}else {
			if(($_COOKIE['seguranca']['tipo']) == "e"){
				LoginExterno::SetCookieExterno(false);
			}else {
				Login::SetCookieAdm(false);
			}
		}
	//}
	

}

#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * Verifica se o usuario está logado e permissao de acesso
 * @param nome coluna acesso
 * @param nome do módulo
 * 
 */
static function logado($id) {

	Login::verificaLog();

		if(isset($_COOKIE['seguranca']['sessao_id'])){
			
			if($id == $_COOKIE['seguranca']['sessao_id']){

			}
		}else {
			$login = new Login();
			//$login->logout("?token=".hash('sha256', md5(VERSAO).date('dmY'))."&modulo=index&controller=index&action=index");
		}

		$tipoAcesso = $_COOKIE['seguranca']['tipo'];

		
}

#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/**
 * Controle Acesso a página (acesso: CAMPO tabela de permissao), (modulo nome tabela) 
 * @param $_acesso String 
 * @param $_modulo String
 * @return 
 * 
 */

static function verificaAcesso($_acesso, $_modulo){

    $dados = array();

    $sql = "SELECT login,
                   :acesso
                   FROM :modulo
                   WHERE login = :login";
    try {
        $result = Conexao::getInstance()->prepare($sql);
        $result->bindValue(":acesso", $_acesso);
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

function verificaPermissao($_permissao, $_modulo, $login){

    $con = Conexao::getInstance();
    
    $dados = array();
    
    try {

    $sql = "SELECT login, ".$_permissao." FROM ".$_modulo." WHERE login = '".$login."'";
        
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
	self::UnsetCookieAdm();
	LoginExterno::UnsetCookieExterno();

	// Se for necessário redirecionar
	if ($redireciona){

		print "<script text/javascript>";

		print "alert('Você foi deslogado do sistema ! \\nfavor fechar as abas \"do Sistema\" e refazer o Login. ');";
		
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


#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	

	#@ Lembrete de liberacoes na tela inicial
function lembreteLiberacao($_id_dep_destino = false){
	
   $filtro = "";
     
    if($_id_dep_destino){
        
       $filtro = "AND depDestino = ".$_id_dep_destino.""; 
        
    }else {
        
    }

	$sql = "SELECT dataLibera,
	id_municipio,
	depDestino,
	evento,
	id_liberacao,
	dtLimite
	FROM aju_liberacao
	WHERE dataLibera
	AND situacao = 0 ".$filtro;

	//print $sql;
	
	try{
	    
	    $result = Conexao::getInstance()->query($sql);
	    
    	while($linha = $result->fetch(PDO::FETCH_ASSOC)){
    		    
                // icone de material liberado como verde e vermelho quando faltar
                // 5 dias para vencer o prazo de pagamento
                $_imagem = Liberacao::iconLembrete($linha['id_liberacao'], $linha['dtLimite']);
                
                $diasRestantePgto = DataMysql::diferencaData(DataMysql::dataVisual($linha['dtLimite']), date("d/m/Y"));
                $diasRestantePgto = ($diasRestantePgto <= 5) ? "<span style='color:red;'>".$diasRestantePgto."</span>" : $diasRestantePgto;
                
    
    			print "<a style=\"text-decoration:none;\" href=\"javascript:NovaJanela('index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&controller=conestoque&action=lembrete_liberacao&id=".$linha['id_liberacao']."', 600, 400)\">
    			             &nbsp;&nbsp;<img style=\"vertical-align:middle\" src=\"/mod_ajuda/imagem/".$_imagem."\">
    			             &nbsp;&nbsp;<span style='font-size:10px;'>
    			                             Libera&ccedil;&atilde;o Nº: ".$linha['id_liberacao']." - ".DataMysql::dataVisual($linha['dataLibera'])." - ".$diasRestantePgto." dia(s) restante(s)</a>
                			             </span><br />";
    		}
    
    	
	}catch (Exception $e){
	    
	    return $e->getMessage()."Código: 21";
	    
	}
}

	#@ filtro de acesso lembrete de Liberacoes
function acessoLembrete($login, $_id_dep_destino) {
	
	$dados = array();
    
    #@ sql que filtra dos dados de permissao aos cadastros
	$sql = "SELECT lembrete_libera
	FROM aju_permissao
	WHERE login = '".$login."'";

	//print $sql;
	
	try {
	    
	    $result = Conexao::getInstance()->prepare($sql);
	    $result->bindValue(":login", $login);
	    $result->execute();
	    
    	
    	while ($linha = $result->fetch(PDO::FETCH_NUM)) {
    	
    	       $dados[] = $linha;
    	
    	}
    	
    	if ($dados[0] != 0) {
                
            # busca o usuario da CEDEC do deposito de BH 
            if(Login::buscaUsuarioDepositoBh($login)){
               
               // mostra todas as liberacoes    
               echo Login::LembreteLiberacao();               
            
            # imprimi somente a liberaçao pertinente ao seu deposito cadastrado
            }else {
                    
                echo Login::LembreteLiberacao($_id_dep_destino);    
            }
    
    	}
	    
	    
	} catch (Exception $e) {
	    
	    return $e->getMessage()."Código: 22";
	}
	
	
}

#@ Lembrete de Material em Transito / Lista Material para Recebimento
function lembreteTransito($_id_dep_destino = false){

	$filtro = '';

	if(is_int($_id_dep_destino)) {

		$filtro = ' and id_dep_destino = '.$_id_dep_destino.'';

	}else {

		$filtro = '';
	}

	$sql = 'SELECT t.id_transferencia,
					t.veiculo,
					t.motorista,
					t.dt_saida,
					t.id_dep_destino,
					t.dt_transferencia,
					d.nome
					FROM aju_transferencia t
					INNER JOIN aju_deposito d
					ON t.id_dep_destino = d.id_deposito
					WHERE situacao = 0 '.$filtro;

		//print $sql;
		
	try {

	    $result = Conexao::getInstance()->query($sql);
    	
    	while($linha = $result->fetch(PDO::FETCH_NUM)){
    
    		print "&nbsp;&nbsp;<img style=\"vertical-align:middle\" src=\"/mod_ajuda/imagem/transito.png\">&nbsp;&nbsp;<a href=\"javascript:NovaJanela('index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=&modulo=ajuda&secao=transferencia&acao=lembrete_transito&id=".$linha[0]."', 600, 600)\"><span style='font-size:10px;'>Transf. Nº ".$linha[0]." ".$linha[6]." - ".DataMysql::dataVisual(substr($linha[5], 0, 10))."</a></span></br />";
    	
    	}
	    
	} catch (Exception $e) {
	    
	    return $e->getMessage()."Código: 23";
	}
	

}

#@ Lembrete de Material em Transito / Lista Material para Recebimento ( todos depositos )
function LembreteLiberacaoTodosDepositos($_id_dep_destino = false){

    $filtro = '';

    if(is_int($_id_dep_destino)) {

        $filtro = ' and id_dep_destino = '.$_id_dep_destino.'';

    }else {

        $filtro = '';
    }

    $sql = 'SELECT t.id_transferencia,
                    t.veiculo,
                    t.motorista,
                    t.dt_saida,
                    t.id_dep_destino,
                    t.dt_transferencia,
                    d.nome
                    FROM aju_transferencia t
                    INNER JOIN aju_deposito d
                    ON t.id_dep_destino = d.id_deposito
                    WHERE situacao = 0 '.$filtro;

        //print $sql;
        
    try {

        $result = Conexao::getInstance()->query($sql);
         
        while($linha = $result->fetch(PDO::FETCH_NUM)){
            
            print "<a href=\"javascript:NovaJanela('core/sc.mostra.material.transito.php', 800, 900)\">&nbsp;&nbsp;<img style=\"vertical-align:middle\" src=\"".SISTEMA."/mod_ajuda/imagem/user-available.png\">&nbsp;&nbsp; Transf. Nº".$linha[0]." ".$linha[6]." - ".DataMysql::dataVisual(substr($linha[5], 0, 10))."</a></br />";
        
        }
        
    } catch (Exception $e) {
        
        return $e->getMessage()."Código: 2";
        
    }


}


/**
 * Filtra o acesso ao lembrete de transito
 * @param $_idUser integer
 * @param $_id_deposito integer
 * @return void  
 * 
 */
function acessoLembreteTransito($_idUser, $_id_deposito = false){

    $dados = array();
	
    #@ sql que filtra dos dados de permissao aos cadastros
	$sql = "SELECT lembrete_transito
	FROM aju_permissao
	WHERE login = :id_usuario";
	
	//print $sql;
		
	try {
	    
	    $result = Conexao::getInstance()->prepare($sql);
	    $result->bindValue(":id_usuario", $_idUser);
	    $result->execute();

	    while ($linha = $result->fetch(PDO::FETCH_NUM)) {
	    
    	    $dados[] = $linha;
    	
    	}
    
    	if ($dados[0] == 1) {
    		
    		if($_id_deposito == false) {
    		
                print Login::lembreteTransito();    
                
    		}else {
    		
              print Login::lembreteTransito($_id_deposito);
            
            }
    		
    	}
	    
	} catch (Exception $e) {
	
	    return $e->getMessage()."Código: 25";
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
static function acessoModulo($_login){

	$linha = array();
	
	$sql = "SELECT it_m_deposito,
	it_m_pipa,
	it_m_cce,
	it_m_decretacao,
	it_m_comdec,
	it_m_apoio,
	it_m_poco,
	it_m_escola,
	cedec_admin			
	FROM cedec_usuario
	WHERE login = :login";

		//print $sql;
		
	$result = Conexao::getInstance()->prepare($sql);
	$result->bindValue(":login", $_login);
	$result->execute();
	
	while ($dados = $result->fetch(PDO::FETCH_NUM)) {
			
		$linha = $dados;
	}
	
	return $linha;

}

	#@ mostra Modulos
static function mostraModulos($_acesso){

		/* 0 - modulo central
		 * 1 - modulo pipa
		 * 2 - modulo cce
		 * 3 - modulo decretacao
		 * 4 - modulo comdec
		 * 5 - modulo equipe apoio
		 * 6 - modulo cedec
		 * 7 - modulo escola
		 * */
		
		
		$chave_acesso = array('0'=>'<a href="?token='.hash("sha256", md5(VERSAO).date('dmY')).'&ac=itn&modulo=ajuda&controller=index&action=index" title="Módulo Ajuda Humanitária"><img src="core/imagem/ajuda.png"><br />Ajuda Humanitária</a>',
							  '1'=>'<a href="?token='.hash("sha256", md5(VERSAO).date('dmY')).'&ac=itn&modulo=pipa&controller=pipa&action=index" title="Módulo TDAP Transporte e Distribuição de Água Potável"><img src="core/imagem/pipa.png"><br />TDAP</a>',
						  	  '2'=>'<a href="?token='.hash("sha256", md5(VERSAO).date('dmY')).'&ac=itn&modulo=cce&controller=cce&action=index" title="Módulo Controle de Emergência"><img src="core/imagem/cce.png"><br />Controle de Emergência</a>',
							  '3'=>'<a href="?token='.hash("sha256", md5(VERSAO).date('dmY')).'&ac=itn&modulo=decreto&controller=index&action=index" title="Módulo Processo de Decretação"><img src="core/imagem/processo.png"><br />Processo de Decretação</a>',
							  '4'=>'<a href="?token='.hash("sha256", md5(VERSAO).date('dmY')).'&ac=itn&modulo=compdec&controller=compdec&action=index" title="Módulo Cadastro Compdec"><img src="core/imagem/comdec.png"><br />Informações Compdec</a>',
						 	  '5'=>'<a href="?token='.hash("sha256", md5(VERSAO).date('dmY')).'&ac=itn&modulo=equipe&secao=menu" title="Módulo Equipe de Apoio"><img src="core/imagem/equipe.png"><br />Equipe de Apoio</a>',
							  '6'=>'<a href="?token='.hash("sha256", md5(VERSAO).date('dmY')).'&ac=itn&modulo=cedec&controller=index&action=index" title="Módulo CEDEC"><img src="core/imagem/cedec.png"><br />CEDEC</a>',
							  '7'=>'<a href="?token='.hash("sha256", md5(VERSAO).date('dmY')).'&ac=itn&modulo=escola&secao=menu" title="Módulo Escola de Defesa Civil"><img src="core/imagem/escola.png"><br />Escola de Defesa Civil</a>',
							  '8'=>'<a href="?token='.hash("sha256", md5(VERSAO).date('dmY')).'&ac=itn&modulo=admin&controller=index&action=index" title="Configurações"><img src="core/imagem/config.png"><br />Configurações</a>');


		$acesso = array();
		
		for ($i = 0; $i < count($_acesso); $i++) {
			if($_acesso[$i] == 1) {
				$acesso[] = $chave_acesso[$i];
				print '<div class="col-md-3 text-center">'.$chave_acesso[$i].'</div>';
			}
		}					
}

/**
 * Faz verificacao do navegador testando o google chrome
 * @param null
 * @return boolean
 */
	static function VerificaBrowser(){

		$useragent = $_SERVER['HTTP_USER_AGENT'];
	 
	   	// if(!preg_match('|Chrome|',$useragent)) {
	    
	    // 	print "<script type='text/javascript'>";

	    // 	print "alert('Navegador não Homologado! \\n \\n Favor Entrar pelo Google Chrome.');";

	    // 	print "window.location.href = 'http://www.defesacivil.mg.gov.br';";

	    // 	print "</script>";

    	// }else {

    		return true;
    	//}
    }

    #@ tempo de sessao
    function Sessao(){

        $temposessao = 0;
        
        if($_SERVER['DOCUMENT_ROOT'] == 'C:/xampp_php5/htdocs'){
            
            # em segundos 
            $temposessao = 3600; // 1 minuto debug
            
        }else {

        	# em segundos 
    	    $temposessao = 36000; // 10 minutos
    	    //$temposessao = 3600; // 1 minuto debug
	    
	    }
	    if (isset($_SESSION["sessiontime"])) { 
	        
	        if ($_SESSION["sessiontime"] < (time() - $temposessao)) { 
	            
	            try {
	                session_unset();
                
                }catch (Exception $e){
                	
                	print "aqui";
                   
                    
                }
	            
                $index = "../index.php";
	            
	            print "<script type='text/javascript'>";

	            print "alert('Sua sessão Expirou !');";

	            print "window.location.href = '/".$index."';";

	            print "</script>";
	        }else {

	            $_SESSION["sessiontime"] = time();

	        } 
	        
	    } else { 
	    
	        session_unset();
	        
	    }
	}


/**
 * 
 * 
 * 
 */
 function buscaUsuarioDepositoBh($login){
         
     $dados = array();
     
     $sql = "SELECT login 
             FROM cedec_usuario
             WHERE login = :login
             AND id_deposito = 1
             AND nivel = 3";
     
     try {

         $result = Conexao::getInstance()->prepare($sql);
         $result->bindValue(":login", $login);
         $result->execute();

         while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
             
             $dados[] = $linha;
         }
         
         if($result->rowCount() == 1){
             
             return true;
         
         }else {
             
            return false; 
         }
         
     } catch (Exception $e) {
         
         return $e->getMessage()."Código : 28";
     }
     

 }


 /**
  * pega dados login 
  *
  *
  */
  public function pegaDadosLogin($usuario, $senha){

	$con = Conexao::getInstance();

		try{
			$sql = "INSERT INTO ";
		}catch (Exception $e ){
			
		}
  }
 
  	
}?>