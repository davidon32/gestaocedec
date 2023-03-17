<?php //include_once('Classe.FuncaoBase.php');

class Anexo extends FuncaoBase  {
	
	/**
	 *
	 * Fazer o upload de arquivos
	 * @param string $caminho - caminho do servidor para upload
	 * @param file $file - arquivo a ser enviado
	 * @param string $inputName - name do input do formulario
	 * @param string $hash - identificador unico do arquivo opcional
	 * @param string $nome_arquivo - um nome para o arquivo diferente do nome original
	 * @return upload de arquivos adicionando a hora no final do arquivo como hash.
	 */
	public static function upload($caminho, $file, $inputName, $hash = false, $nome_arquivo = false){
	
                $ext = Anexo::getExtensao(basename($file[$inputName]['name']));
		
                # verifica o hash para o novo nome do arquivo passado.
		if(strlen($nome_arquivo) > 0) {
                    
                
			# verifica o hash para o nome original do arquivo 
			$nomeArquivo = (strlen($hash) > 0) ? $hash."_".$nome_arquivo.".".$ext : $nome_arquivo.".".$ext; 

		}else {
                    $nome_regular = substr(FuncaoBase::sanitizeString(basename($file[$inputName]['name'])), 0, 20);
			$nomeArquivo = (strlen($hash) > 0) ? $hash."_".str_replace(" ", "_", $nome_regular).".".$ext : str_replace(" ", "_", $nome_regular).".".$ext ;
                        
		}
                
                
		 
		$uploadFile = $caminho."/".$nomeArquivo;

		 if(move_uploaded_file($file[$inputName]['tmp_name'], $uploadFile)  /*&& (Anexo::gravar($hash, $nomeArquivo))*/ ){
			return true;
		}else {
			return false;
		} 
	
	}


	/**
	 *
	 * Fazer o upload de arquivos
	 * @param string $caminho - caminho do servidor para upload
	 * @param file $file - arquivo a ser enviado
	 * @param string $nome_arquivo - um nome para o arquivo diferente do nome original
	 *
	 * @return upload de arquivos adicionando a hora no final do arquivo como hash.
	 */
	public static function uploadNovo($file, $caminho = '/anexo/', $nome =""){
	
		# verifica o hash para o novo nome do arquivo passado.
		if(strlen($nome) > 0) {
			# verifica o hash para o nome original do arquivo 
			$ext = Anexo::getExtensao(basename($file[key($file)]['name']));
			$ex = explode(".", $nome);
			$ex = end($ex);
			$nomePuro = substr($nome, 0, strpos($nome, $ex));
			
			$nomeArquivo = FuncaoBase::tirarAcentos($nomePuro).strtoupper($ext); 

		}else {
			#nome original padronizado com hash
			$nomeArquivo = FuncaoBase::retiraAcento(basename($file[key($file)]['name'])) ;
		}
		 
		$uploadFile = $caminho."/".$nomeArquivo;

		 if(move_uploaded_file($file[key($file)]['tmp_name'], $uploadFile)){
			return true;
		}else {
			return false;
		} 
	
	}

	/**
	 *
	 * Fazer o upload de arquivos com codido aleatorio (nao usar para)
	 * @param string $caminho - caminho do servidor para upload
	 * @param file $file - arquivo a ser enviado
	 * @param string $nome_arquivo - um nome para o arquivo diferente do nome original
	 *
	 * @return upload de arquivos adicionando a hora no final do arquivo como hash.
	 */
	public static function uploadHash($file, $caminho = '/anexo/', $nome =""){
	
		#hash 
		$hash = date('his');

		# verifica o hash para o novo nome do arquivo passado.
		if(strlen($nome) > 0) {
			# verifica o hash para o nome original do arquivo 
			$ext = Anexo::getExtensao(basename($file[key($file)]['name']));
			$nomeArquivo = FuncaoBase::tirarAcentos($nome)."_".$hash.".".$ext; 
		}else {
			#nome original padronizado com hash
			$nomeArquivo = $hash."_".FuncaoBase::retiraAcento(basename($file[key($file)]['name'])) ;
		}
		 
		$uploadFile = $caminho."/".$nomeArquivo;

		 if(move_uploaded_file($file[key($file)]['tmp_name'], $uploadFile)  /*&& (Anexo::gravar($hash, $nomeArquivo))*/ ){
			return true;
		}else {
			return false;
		} 
	
	}

	
	/**
	 *
	 * Fazer o upload de arquivos renomeando
	 * @param string $caminho - caminho do servidor para upload
	 * @param file $file - arquivo a ser enviado
	 * @param string $inputName - name do input do formulario
	 * @param string $hash - identificador unico do arquivo opcional
	 * @param string $renomear - nome para o arquivo
	 * @return faz upload de arquivos adicionando a hora no final do arquivo como hash.
	 */
	public static function uploadRen($caminho, $file, $inputName, $renomear){
		
		$uploadFile = $caminho."/".$renomear;

		if(move_uploaded_file($file[$inputName]['tmp_name'], $uploadFile)/*  && (Anexo::gravar($hash, $nomeArquivo)) */){
	
			return true;
	
		}else {
	
			return false;
		}
	
	}

	
	/**
	 *  Remover arquivo do arquivo
	 *  
	 *  @param nomeArquivo - string
	 *  @param caminho     - local arquivo
	 */
	public static function removerAnexo($nomeArquivo, $caminho){

		chdir(PATH.'/'.$caminho);
		$dirAnexo = getcwd();
                if(file_exists($dirAnexo.'/'.$nomeArquivo)){
                    unlink($dirAnexo.'/'.$nomeArquivo);
                }
		
	}
	
	/**
	 * @param string $arquivo - nome do arquivo para copiar
	 * @param string $origem - caminho da origem
	 * @param string $destino - destino do arquivo
	 * @param string $nomeArquivo - nome para gravar
	 */ 
	public function copiarArquivo($arquivo, $origem, $destino, $nomeArquivo){

		#origem
		chdir(PATH.'/'.$origem);
		$dirTmp = getcwd();
		
		#destino
		chdir(PATH.'/'.$destino);
		$dirAnexo = getcwd();
		
		return copy($dirTmp."/".$arquivo, $dirAnexo."/".$nomeArquivo);

	}


	static public function getExtensao($nome){
                
                
		$extensao = strtolower(substr($nome, -3, 3));
                $result = $extensao;
                
		if($extensao == "ocx"){
			$result = "docx";
		}else if($extensao == 'peg'){
			$result = "jpeg";
		}

		return $result;
	}

	/**
	 * Validar imagem
	 * @
	 * 
	 */
		public function validaUpload($arquivo, array $extensao = null, array $alturaLargura = null, $tamanho = null ){

			$image_info = getimagesize($arquivo); 
        	print_r($image_info); 
			
			/*if($extensao !=null) {
				foreach ($extensao as $key => $value) {
					if($image_info['type'] == $value) {
						return strsrt();
					}, 'image')){
						return false;
					}
				}return $image_info['type'] ;
				$result['extensao'] = $rExtensao;
			}*/
			

			return null ;#$result;
			
		}

	/**
	 *  Verifica Extensao
	 * @param $extensao array
	 */
	public function validaExtensao(array $extensao = null){
		foreach ($extensao as $key => $value) {
			$image_info = getimagesize($extensao); 
        	print_r($image_info); 

		}

	}


	/** *
	* @param $imput = nome do campo imput
	* @param $path = caminho para o upload ex. '/anexo/planoCont/'
	* @param $arquivo - nome para ser renomeado
	* @example uploadSimple('txtImputFile', 'anexo/fotos', '40_foto') ;
	* @param $redimensionar array LxA
	*/
	public function uploadSimple($input, $path, $arquivo =false, $redimensionar = null){

		if(!$arquivo){
			$nome = $_FILES[$input]['name'];
		}else {
			$nome = $arquivo;
		}

		if(0 < $_FILES[$input]['error']) {
			echo 'Error: ' . $_FILES[$input]['error'] . '<br>';
		}else {

			$result = move_uploaded_file($_FILES[$input]['tmp_name'], $_SERVER['DOCUMENT_ROOT'].$path ."/". $nome);

			return $result;			
			
		}
	}
        
        
        /**
	 * Returna a extensão do arquivo
	 * 
	 * @author Demetrio Passos @zinhoflag1
	 * @param $file - nome do arquivo
	 * 
	*/
	public static function getExtension($file){
		return strtolower(substr(strrchr($file, '.'), 1));
	}


	/**
	 * Verifica tamanho arquivo
	 * 
	 * @author Demetrio Passos @zinhoflag1
	 * @param $file - nome do arquivo
	 * 
	*/
	public static function getSizeUpload($file, $size){
		//return $_FILES[$file]['size'] <= 1024/$size;
		return 1024/$size;

	}


	/**
	 *  Captura o codigo do erro do FILES
	 * 
	 *  @author Demetrio Passos @zinhoflag1
	 *  @param $code - codigo do erro no FILES
	 * 
	 **/
	public static function getCodErroFiles($code){

		/*0 => 'There is no error, the file uploaded with success',
	    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
	    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
	    3 => 'The uploaded file was only partially uploaded',
	    4 => 'No file was uploaded',
	    6 => 'Missing a temporary folder',
	    7 => 'Failed to write file to disk.',
	    8 => 'A PHP extension stopped the file upload.',*/

	    switch ($code) {
	    	case 0:
	    		return 'There is no error, the file uploaded with success';
	    		break;

	    	case 1:
	    		return 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
	    		break;
	    	case 2:
	    		return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
	    		break;

	    	case 3:
	    		return 'The uploaded file was only partially uploaded';
	    		break;

	    	case 4:
	    		return 'No file was uploaded';
	    		break;

	    	case 5:
	    		return 'sem mensagem para esse codigo :)';
	    		break;

	    	case 6:
	    		return 'Missing a temporary folder';
	    		break;

	    	case 7:
	    		return 'Failed to write file to disk';
	    		break;

	    	case 8:
	    		return 'A PHP extension stopped the file upload.';
	    		break;


	    	case 9:
	    		return 'O Arquivo é maior que o tamanho máximo expecificado na regra de negócio !';
	    		break;
	    	
	    	default:
	    		// code...
	    		break;
	    }

	}


	/**
	* 	Upload arquivos	( revisado novo )
	* 
	*	<form action="#" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	*
	*	<input type="hidden" name="MAX_FILE_SIZE" value="548576" /> <!-- este campo deve preceder o input File-->
	*
	*	<input type="file" name="file" accept="image/png, .pdf, application/msword">
	* 
	*   png = image/png
	*	pdf = .pdf ou application/pdf
	*	.doc = .doc ou application/msword
	*
	*		Max File
	*			548576 = 512k
	*			1048576 = 1M
	*			2097152 = 2M
	*			10485760= 10M
	*
	 * 
	*	@info - accept-charset="utf-8" enctype="multipart/form-data" 
	*	@info <!-- este campo deve preceder o input File--> <input type="hidden" name="MAX_FILE_SIZE" value="548576" /> 
	*	@info O valor deve ser em bytes - 1Mb = 1024* (1024*1)
	*	@param $field - nome do campo do form
	*	@param path   - diretorio para upload
	* 	@param $maxsize - tamanho maximo do arquivo em bytes
	*	@param $file  - nome personalizado para o arquivo sem entensao
	*
	*/
	public static function upload20($field, $path, $maxsize, $file = null){


		$files = $_FILES;

		$nome_arquivo = "Upload_".date('YdmHis').".".self::getExtension($files[$field]['name']);

		$path_root = $_SERVER['DOCUMENT_ROOT']."/upload/".$path;

		if(!is_null($file))
			$nome_arquivo = $file."_".date('ydmHis').".".self::getExtension($files[$field]['name']);

		/* valida o tamanho do arquivo expecificado na regra de negocio */
		if($files[$field]['size'] > $maxsize){
				
				return [
					'return'=> false,
					'size' =>number_format($files[$field]['size'] /MB, 2, ".")."MB",
					'max_upload_php_ini' => ini_get('upload_max_filesize'),
					'cod_erro_files'=> "9",
					'erro' => self::getCodErroFiles($files[$field]['error']),
					'original_name' => $files[$field]['name'],
					'file_name' => $nome_arquivo,
				   ];

		}else if(move_uploaded_file($files[$field]['tmp_name'], $path_root."/".$nome_arquivo )){
			return [
					'return'=> true,
					'size' =>number_format($files[$field]['size'] /MB, 2, ".")."MB",
					'max_upload_php_ini' => ini_get('upload_max_filesize'),
					'cod_erro_files'=> $files[$field]['error'],
					'erro' => self::getCodErroFiles($files[$field]['error']),
					'original_name' => $files[$field]['name'],
					'file_name' => $nome_arquivo,
				   ];

		}else {
			return [
					'return'=> false,
					'size' =>number_format($files[$field]['size'] /MB, 2, ".")."MB",
					'max_upload_php_ini' => ini_get('upload_max_filesize'),
					'cod_erro_files'=> $files[$field]['error'],
					'erro' => self::getCodErroFiles($files[$field]['error']),
					'original_name' => $files[$field]['name'],
					'file_name' => $nome_arquivo,
				   ];
		}
	}

}?>