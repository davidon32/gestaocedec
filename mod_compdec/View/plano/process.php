<?php include_once $_SERVER['DOCUMENT_ROOT'].'/core/include.php';
    
    $dados = $_POST;
    $plano = new Plano();
    $anexo = new Anexo();
    $identificador = isset($_POST['identificador']) ? $_POST['identificador'] : "";

    # grava vias de acesso
    if($identificador == "viasAcesso") {
    
        $dados = json_decode(stripslashes($_POST['dadAjax']));
        
        foreach ($dados as $key => $value) {
           
            if($plano->buscaDuplicidade($value) > 0){
                echo $plano->buscaDuplicidade($value);
                echo "duplicado";
                break;
            }else {
                $plano->GravarViasAcesso($value);
            }
        }
    # cria um novo plano
    }elseif($identificador == "novoPlano"){
        $dados['id_municipio'] = $_POST['id'];
        
        if($plano->novoPlano($dados)){
            $pageSession['session']['seguranca']['id_plano'] = $plano->ultimoID();
            print "sucesso";
            
        };
        
    /*   UPLOAD DO PLANO */
    }elseif($identificador == 'upload'){

        if(!isset($_FILES['file'])){
            print "Favor Carregar o arquivo !";
        }else {
            
            $extensao = $anexo->getExtensao($_FILES['file']['name']);

            $data_upload = date('Y-m-d H:i:s');
            //isset($_POST['dt_upload']) ? $_POST['dt_upload'] :""; # DATA HORA
            

            $descricao = isset($_POST['descricao']) ? FuncaoBase::slug($_POST['descricao']) : "";
                    
            $arquivo = "PLACON_". FuncaoBase::slug($_COOKIE['seguranca']['nome_usuario'])."_".$descricao."_". FuncaoBase::slug($data_upload);

            $id_municipio = isset($_POST['id']) ? $_POST['id'] :"";
            
            $tamanho_size = isset($_POST['tamanho']) ? $_POST['tamanho'] :"";
 
            # dados para gravar registro upload
            $dados = array('id_municipio'=>$id_municipio,
                            'id_plano'=> "0",
                            'filePlano'=> strtoupper($arquivo).".".$extensao,
                            'versao' => '-',
                            'dt_upload' => $data_upload,
                            'tamanho_size' => $tamanho_size
            );


            $result = Upload2mb::upload("/anexo/planoCont", $arquivo, array("pdf", "doc", "docx"), '20971520');
            if($result){
                if($plano->gravaUpload($dados)) {
                    print "sucesso";
                }
            }else {
                print $result['msg'];
            }
        }

        
       

    }elseif ($identificador == "removerPlano") {
       
        chdir(PATH.'/anexo/planoCont');
        $dirAnexo = getcwd();
        
        if(file_exists($dirAnexo.'/'.$plano->visualizarDoc($_POST['id_plano']))){
            unlink($dirAnexo.'/'.$plano->visualizarDoc($_POST['id_plano']));
        }
        $plano->removerPlano($_POST['id_plano']);
        print "sucesso";
    }

    
?>