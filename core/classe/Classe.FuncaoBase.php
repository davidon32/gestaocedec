<?php

/************************************************************************************
 * 			Gabinete Militar do Governador
* 			Coordenadoria Estadual de Defesa Civil
*
* 			Descrição : Classe base do Sistema PHP
* 			Data      : 25/02/2014
* 			Autor     : Demetrio Silva Passos
*
************************************************************************************/

class FuncaoBase extends Exception{

	/**
     * Converter Texto em Letra Maiuscula
     * @author Demetrio S. Passos
     * @param string 
     * @return texto em caixa alta
     * 
     */  
	function formulario($texto){

	$_retorno = strtoupper(utf8_decode($texto));

	return $_retorno;

	}

	/**
	 * Gerar link sistema
	 * @param $acesso itn, etn
	 * @param $modulo
	 * @param $controller
	 * @param $action
	 * 
	* @example <?php $param = array("teste"=>"1", "teste2" => "2", "teste3"=>"3");
	*	echo FuncaoBase::geraLink("itn","ajuda","relatorio", "rel1", $param);?>
	*/
	public static function geraLink($modulo,$controller,$action, array $param=null){
		if(!is_null($param)){
			$strParam = "&".http_build_query($param);
		}else {
			$strParam = "";
		}
		return "?token=".hash('sha256', md5(VERSAO))."&modulo=".$modulo."&controller=".$controller."&action=".$action.$strParam;
	}
######################################################################################

/**
 * Retorna o numero no formato moeda monetário Brasil 1.000,00
 * @author Demetrio S. Passos
 * @param string valor 
 * @return texto string munérico
 */  
static function real($_valor) {

	return number_format($_valor, 2, ',', '.');
}


######################################################################################

/**
 * retorna um elemento HTML select com os meses do ano
 * @author Demetrio S. Passos
 * @param null
 * @return select html com os meses do ano
 * 
 */  
static function mes(){

	print '<select name="mes" id="mes" title="Escolha o Mês">
	<option>Mes</option>
	<option>Janeiro</option>
	<option>Fevereiro</option>
	<option>Março</option>
	<option>Abril</option>
	<option>Maio</option>
	<option>Junho</option>
	<option>Julho</option>
	<option>Agosto</option>
	<option>Setembro</option>
	<option>Outubro</option>
	<option>Novembro</option>
	<option>Dezembro</option>
	</select>';

}

######################################################################################

/**
 * Converter string do mes para o formato cardinal
 * @author Demetrio S. Passos
 * @param string mes
 * @return  transforma o mes no formato letra para o numero ex janeiro = 1, dezembro = 12
 * 
 */  
static function mesTonum($_mes){

	$num_mes = array('1'=>'Janeiro',
			'2'=>'Fevereiro',
			'3'=>'Março',
			'4'=>'Abril',
			'5'=>'Maio',
			'6'=>'Junho',
			'7'=>'Julho',
			'8'=>'Agosto',
			'9'=>'Setembro',
			'10'=>'Outubro',
			'11'=>'Novembro',
			'12'=>'Dezembro',);

	foreach ($num_mes as $key => $value) {

		if($_mes == $value) {

			return $key;

		}

	}
	 

}

######################################################################################

/**
 * transforma o mes no formato letra para o numero ex janeiro = 1, dezembro = 12
 * @author Demetrio S. Passos
 * @param $mes string
 * @return mes formato string
 * 
 */  
static function numTomes($_mes){

	$num_mes = array('1'=>'Janeiro',
			'2'=>'Fevereiro',
			'3'=>'Março',
			'4'=>'Abril',
			'5'=>'Maio',
			'6'=>'Junho',
			'7'=>'Julho',
			'8'=>'Agosto',
			'9'=>'Setembro',
			'10'=>'Outubro',
			'11'=>'Novembro',
			'12'=>'Dezembro',);

	foreach ($num_mes as $key => $value) {

		if($_mes == $key) {

			return $value;

		}

	}
	 

}

######################################################################################

/**
 * Funcao mensagem de ok na tela
 * @param $_msg  - string mensagem para o alerta 
 * @param $volta - booleano faz history.back(); 
 * @return null 
 */
static function alert($msg, $volta = false){

	if($volta) {

		print '<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
		alert ("'.$msg.'")
		history.back();
		</SCRIPT>
		';

	}else {

		print '<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
		alert ("'.$msg.'");
		</SCRIPT>';
		//FuncaoBase::vd($msg);

	}
}

######################################################################################

#@ function FuncaoBase::vd()
static function vd($_deb){

	if(DEBUG == 1){

		return print 'Modo debug Ativo <br />'.var_dump($_deb);

	}else {

		return '';

	}



}

######################################################################################

/**
 * Funcao para fechar janela (popup)
 * @param null
 * @return elemento HTML link botão fechar
 */
static function Fechar(){

	return print '<a class="btn btn-primary" href="#" onclick="javascript:window.close();" title="Fechar Janela">Fechar</a>';


}

######################################################################################

/**
 * Funcao para imprimir
 * @param null
 * @return elemento HTML link botão Imprimir
 */
static function Imprimir(){

	return print '<a class="btn btn-info" href="javascript:window.print();" title="Impressão">Impressão&nbsp;<i class="icon-list-alt"></i></a>';


}


######################################################################################

/**
 * Funcao para voltar com quantidade de páginas a retroceder, se nao for passado parametro volta uma página.
 * ex: print FuncaoBase::voltar();
 * @param  $pg - Inteiro opcional quantidade de páginas para history.back()
 * @return botão foltar
 */ 
static function voltar($pg = false, $link = ""){
    
    if(strlen($link) == 0) {
        $link = "javascript:history.back();";
    }

	if($pg == false){
		return '<div class="col-md-12 text-right"><a class="btn btn-success" href="'.$link.'" title="Volta Página">Voltar&nbsp;<i class="icon-chevron-left"></i></a></div>';
	}elseif (is_numeric($pg)) {
                $link = "javascript:history.back(-".$pg.");";
		return '<div class="col-md-12 text-right"><a class="btn btn-sucess" href="'.$link.'" title="Volta Página">Voltar</a></div>';
	}





}

######################################################################################

/**
 * Funcao para abrir janela popup
 * @param $pagina - endereco html
 * @return popup com página como parametro
 */
function AbriJanela($pagina){

	print "<script language=\"javascript\">window.open('.$pagina.', '_blank')></script>";

}

######################################################################################

#@ backup do sistema
function backup($nome) {

	$con = Conexao::getInstance();
	$sql = '' ;
	$result = $con->query($sql);

	while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
		//self::static_var[] = $linha;
	}

	//return self::static_var$;
}

######################################################################################

#@ tamanho da base
function TamanhoBase(){
	
	$tamanho = 0;
	
	$con = Conexao::getInstance();
	$sql = 'show table status from
			gestaocedec';
	$result = $con->query($sql);

	while($linha = $result->fetch(PDO::FETCH_ASSOC)){
		$tamanho += (($linha['Data_length'] + $linha['Index_length']) / 1024) /1024;
	}
	return $tamanho. ' MB';
}

######################################################################################

/**
 * Funcao retorna o ultimo dia do mes
 * @param $mes - inteiro 
 * @return ultimo dia do mes
 */
function UltimoDiaMes($mes = false){

	$ultimo = array('1'=> 31,
			'2'=> 28,
			'3'=> 31,
			'4'=> 30,
			'5'=> 31,
			'6'=> 30,
			'7'=> 31,
			'8'=> 31,
			'9'=> 30,
			'10'=> 31,
			'11'=> 30,
			'12'=> 31);

	for($i=1; $i< count($ultimo); $i++) {
		if(key($ultimo) == $mes){
			return $ultimo[$i];
		}
	}
}

######################################################################################
/**
 * Funcao para pular linhas, default uma linha quebrada
 * 
 * @param $nrLinha - inteiro opcional quantidade de linhas para espaco, 
 * @return elemento HTML "<br>" conforme quantidade passada no parametro
 */
function linha($nr_linha = 1){
	for ($i = 0; $i < $nr_linha; $i++){
		print '<br />';
	}
}

public static function espaco($nr){  
    for ($i=0; $i < $nr; $i++) {
        print "&nbsp;";       
    }   
}

######################################################################################
#@protecao imput
function prot(){
}

######################################################################################

#@ combo, select dinamico universal
/*
 parametros:
- nometabela - nome da tabela
- nomeCampo - nome do Campo da tabela
- selected ? true, false
- dadoCampoSelected - valor para ser o selected
- nomeCampoMostraDados - campo para selected
- debug ? necessidade de analisar o sql ? true, false
*/
function comboDinamico($nomeTabela,
						 $nomeCampo,
						 $selected = false,
						 $dadoNomeCampoSelected = false,
						 $dadoCampoSelected = false,
						 $debub = true){

	$con = Conexao::getInstance();

	$sql = 'SELECT '.$nomeCampo.' FROM '.$nomeTabela;

	$result = $con->query($sql);

	print '<select name='.$nomeCampo.'>';

	if($selected == true){

		$sql1 = 'SELECT '.$nomeCampo.' FROM '.$nomeTabela.' WHERE '.$dadoCampoSelected.' = '.$dadoNomeCampoSelected;

		$result1 = $con->query($sql1);

		while ($linha1 = $result1->fetch(PDO::FETCH_ASSOC)){
			print '<option>'.$linha1[''.$nomeCampo.''].'</option>';
		}
	}else {
		print '<option></option>';
	}

	while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
		print '<option>'.$linha['nivel'].'</option>';
	}

	print '</select>';
	if($debub == true){
		print $sql.'<br />';
		print $sql1;
		var_dump($linha1);
		print '<option>'.$linha[''.$nomeCampo.''].'</option>';
	}
}

######################################################################################

#@ verifica campo em branco com mensagem de aviso
static function campoBranco($campos){

	$mensagem = array();

	foreach ($campos as $key => $value) {
		if(($value == "") || ($value == null)){	 
			$mensagem[] = $key;
		}
	}
 
	// Total campos em branco
	$totCampoBranco = count($mensagem);

	if($totCampoBranco > 0) {
		for ($i =0; $i < $totCampoBranco; $i++){	 
			print "<br><div class=\"col-md-12 text-center\">
					<span class='alert alert-error'>Campo <b> $mensagem[$i]</b> Não pode Ficar em Branco !</span><br><br><br></div>";
		}
		print "<p class=\"text-center\"><button class=\"btn btn-info\" type=\"button\" onclick=\"javascript:history.back();\" title=\"Voltar Página\">Voltar</button><p>";
	}else {
		return true;
	}
}

######################################################################################

#@ Faz a Validação de Campos em Branco
static function ValidaCampoBranco($campos){

	$mensagem = array();
	foreach ($campos as $key => $value) {
		if(($value == "") || ($value == null)){
			$mensagem[] = $key;
		}
	}

	//var_dump($mensagem)  ;
	$totCampoBranco = count($mensagem);
	if($totCampoBranco == 0) {
		return true;
	}else {
		return false;
	}
}

######################################################################################

#@ pesquisa generica
function pesquisaGenerica($campo, $tabela, $pesquisa) {
	
	$con = Conexao::getInstance();

	if(!empty($pesquisa)){
		
		$sql = "select $campo from $tabela where $campo like '$pesquisa[valor]%'";

		$result = $con->query($sql);
		$linha= $result->rowCount();
		 
		if($linha > 0){
			while($pegar=$result->fetch(PDO::FETCH_ASSOC)){
				echo "<a href=\"#\">$pegar[nome]<a/><br />";
			}			 
		} 
	} 
}

######################################################################################

#@ metodo para incluir javascript automaticamento da pasta js
function include_arquivos() {

	$diretorio = "js";
	$leitura = opendir('js');

	while($arquivo = readdir($leitura)) {

		if(($arquivo != "." && $arquivo != "..") && (substr($arquivo, -2) == "js"))
		{
			print "<script type=\"text/javascript\" src=\"".$diretorio."/".$arquivo."\"></script><p>";
		}
	}
}

######################################################################################
/**
 * Espacos para texto em html
 * @param $tamanho integer
 * @return elemento html espaco &nbsp
 * 
 */
function TamanhoCampo($tamanho) {
	for ($i=0; $i <= $tamanho; $i++) {
		print "&nbsp;";
	}
}

######################################################################################

/**
 * Faz a validação de email sem tem um comprimento minimo e existe arroba
 * @param $email String 
 * @return boolean
 * 
 */
public static function validarEmail($email, $dominio = false){

	if(strlen($dominio) == 0){
		$domino = "#[a-zA-Z0-9\._-]+.#";
	}

	$conta = "\"/^[a-zA-Z0-9\._-]+@\"/";
	$extensao = "([a-zA-Z]{2,4})$";
	$pattern = $conta.$domino.$extensao;

	if (preg_match($pattern, $email) || (strlen($email) == 0))
		return true;
	else
		return false;
}


######################################################################################

/** 
 * funcao para auxiliar nos botoes de voltar, imprimir, fechar, sucesso de operação
 *
 * @param String $_tipo "voltar" para voltar a página
 * @param String $_tipo "imprimir" para imprimir a página
 * @param String $_tipo "fechar" para fechar a página
 * @param String $_tipo "sucesso" para enviar um alerta de confirmação e voltar pagina
 * @param String $_redireciona URL linha para redireciomanento de página
 * @param string $_msg mensagem personalizada no botal
 * @return elemento HTML
 */
static function vifs($_tipo = false, $_redireciona = false, $_msg = 'Procedimento realizado com Sucesso !'){

	($_tipo == "volta") ? print "<a href=\"#\" class=\"btn btn-success\" onclick=\"javascript:window.location = '".$_redireciona."';\">Voltar</a>" : "";
	($_tipo == "imprimir") ? print "<a href=\"#\" class=\"btn btn-success\" onclick=\"javascript:window.print();\">Imprimir</a>" : "";
	($_tipo == "fechar") ? print "<a href=\"#\" class=\"btn btn-success\" onclick=\"javascript:window.close();\">Fechar</a>" : "";
	($_tipo == "sucesso") ? print "<script type='text/javascript'> alert('".$_msg."'); window.location = '".$_redireciona."';</script>" : "";
    ($_tipo == "alerta") ? print "<script type='text/javascript'> alert('".$_msg."'); window.location = '".$_redireciona."';</script>" : "";
 
}
/**
     * Limpa texto, remove caracteres especiais
     * @author Demetrio S. Passos
     * @param $texto string 
     * @return texto sem caracteres especiais
     * 
     */  
    public static function noSqlInjection($texto){
    
    $texto = str_replace(array("<", ">", "\\", "/", "=", "'", "?"), "", $texto);

    return $texto;
}
    
           
    /**
     * Função que valida o CPF
     * @param $cpf String 
     * @return true / false
     */
    function validaCPF($cpf){
            
            // Verifiva se o número digitado contém todos os digitos
            $cpf = str_pad(preg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);

            // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
            if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {

                return false;
            
            }else {
                
                // Calcula os números para verificar se o CPF é verdadeiro
                for ($t = 9; $t < 11; $t++) {

                    for ($d = 0, $c = 0; $c < $t; $c++) {

                        $d += $cpf{$c} * (($t + 1) - $c);
                    }

                    $d = ((10 * $d) % 11) % 10;

                        if ($cpf{$c} != $d) {
                            
                            return false;
                    }
                }

                return true;
            }
        }


    /**
     * Pega parametros de configuração do sistema
     * 
     * @return array
     * 
     */
     static function pegaParametro() {
      
        $array = array();
        
        $con = Conexao::getInstance();
        
        $sql = "SELECT * FROM cedec_param";
        
        $result = $con->prepare($sql);
        
        $result->execute();
        
        try {
        
            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            
                $dados[] = $linha; 
            }
        
            return $linha;
        
        }catch (Exception $e){
            
            return $e->getMessage." ";
        }
         
     } 
     
     /*
      * REMOVER ACENTOS 
      * */
     static function tirarAcentos($string){
         
         $result = self::sanitizeString($string);
             	
     	//$result = preg_replace('/\'|"|´|`/', ' ', $string);
     	
		 //$result = trim(preg_replace('/[\\\|\/]/', '_', $result));
		 
		 //$result = strtoupper($result);
     	
     	//return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"),$result);
         return $result;
     }
    
     /* retirar acentos e espaco string */
    static function sanitizeString($string) {

        // matriz de entrada
        $what = array( 'ä','ã','à','á','â','ê','ë','è','é','ï','ì','í','ö','õ','ò','ó','ô','ü','ù','ú','û','À','Á','É','Í','Ó','Ú','ñ','Ñ','ç','Ç','-','(',')',',',';',':','|','!','"','#','$','%','&','/','=','?','~','^','>','<','ª','º' );
        // matriz de saída
        $by   = array( 'a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','u','A','A','E','I','O','U','n','n','c','C','_','' ,'' ,'_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_' );

        // devolver a string
        return str_replace($what, $by, $string);
    }

     /**
     * 
     * Converte String em mauisculo
     * 
     */
    static function maiusculoAcento($_campo){
        
    	return strtoupper(preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$_campo));
    	//$_campo = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $_campo) );
        //return strtoupper($_campo);
        
    }
    
    
    static function getModulo($_modulo) {
            
        switch ($_modulo) {

            case 'pipa':
                return "TDAP - Transporte e Distribuição de Água Potável";
                break;
            case 'ajuda':
                return "AJUDA HUMANITÁRIA";
                break;
            case 'equipe':
                return "EQUIPE DE APOIO";
                break;
            case 'cedec':
                return "SECRETARIA";
                break;
            case 'cce':
                return "CONTROLE DE EMERGÊNCIA";
                break;
            case 'decreto':
                return "PROCESSO DE DECRETAÇÃO";
                break;
            case 'compdec':
                return "COMPDEC";
                break;
            case 'escola':
                return "ESCOLA DE DEFESA CIVIL";
                break;
            case 'menu':
                return "SISTEMA DE GESTÃO ESTRATÉGICA";
                break;
            case 'admin':
                return "CONFIGURAÇÃO";
               	break;
            default :
                return "Opção Inválida !";
                break;
        }
        
        
    }
    
    
    
    /**
     * 
     * Mensagem registro duplicado 
     * @param $e - string $e->getMessage()
     * @param $mensagem - string - Mensagem a ser exibida
     * @param $volta - bool - opção botão voltar
     * 
     * 
     */
      public static function getError($e, $mensagem = 'Erro !', $volta = true){
          
           /* sem botão voltar */ 
          if(!$volta){
          
              if(strpos($e, "Duplicate") != 0){
                  print "<br><div align='center' width='100%'><span class='alert alert-danger'>".$mensagem.",  <b>Registro Duplicado !</b></span></div><br><br>";
              }else {
                  
                  print "<br><div align='center' width='100%'><span class='alert alert-error'>".$e." ".$mensagem."</span><br><br>";
              }
    		    
          }else {
              
              if(strpos($e, "Duplicate") != 0){
                  print "<br><div align='center' width='100%'><span class='alert alert-error'>Registro Duplicado !</span><br><br>
    		               <input class='btn' type='button' value='Voltar' onclick='history.back();'></div>";
              }else {
              
                  print "<br><div align='center' width='100%'><span class='alert alert-error'>".$e." ".$mensagem."</span><br><br>
    		               <input class='btn' type='button' value='Voltar' onclick='history.back();'></div>";
              }
              
              
          }
      }
      
   
      /**
       * Lista arquivos PDF de um diretorio e cria um link para download
       * $path - caminho do diretorio
       */
      function listaArquivoLink($path, $semLista = false){
          
          $interno = "";
          
          if(true) {
          }else {
              $interno = "( <i>Documento Uso Interno</i> )";
          }
      
      	$dir = opendir(PATH.$path);
      
      	$_num = 1;
      	while (false !== ($file = readdir($dir))) {
      		 
      		$_form = substr($file, -3, 3);
			$old = substr($file, -7, 3);
			$title = "Manual de ajuda em formato PDF !";
			if($old == "old") {
				$title = "Documento obsoleto busque uma versão atual !";
			}

			  
      
      		if ( ($_form == "pdf") && (!$semLista) ) {
      
      			print ($old == "old") ? "<strike>" : "";
      			print $_num++." ) <a href='".$path."/" . utf8_encode($file) . "' title='".$title."'>" . utf8_encode($file) . "</a> ".$interno."<br><br>";
      			print ($old == "old") ? "</strike>" : "";
      		}elseif ( ($_form == "pdf") && ($semLista) ) {
      			print ($old == "old") ? "<strike>" : "";
      			print "<a href='".$path."/" . utf8_encode($file) . "' title='".$title."' class='alert' style='text-decoration:none'><img src='core/imagem/help.png' width='25'>&nbsp;&nbsp;&nbsp;&nbsp;" . utf8_encode($file) . "</a> ".$interno;
      			print ($old == "old") ? "</strike>" : "";
                
            }
      	}
	  }
          
          
          public static function mensagem($voltar, $classMsg, $texto) {

                include_once PATH."/mod_index/View/mensagem.php";
              
          }
          
          public static function slug($string) {
              $result = self::tirarAcentos($string);
              $result = strtolower($result);
              $result = str_replace(array(" ", "(", ")"), "_", $result);
              
              return $result;
              
          }
	  




}?>