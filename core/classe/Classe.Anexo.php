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

}?>