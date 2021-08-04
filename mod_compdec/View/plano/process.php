<?php include_once $_SERVER['DOCUMENT_ROOT'].'/core/include.php';
    
    $plano = new Plano();
    $anexo = new Anexo();

    $dados = $_POST;

   

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
    }elseif($identificador == 'upload'){

        if(!isset($_FILES['file'])){
            print "Favor Carregar o arquivo !";
        }elseif($_POST['versao'] == '0') {
            print "Escolha a Versão do Plano de Contigencia !";
        }else {
            

            $extensao = $anexo->getExtensao($_FILES['file']['name']);

            $data_upload = isset($_POST['dt_upload']) ? $_POST['dt_upload'] :"";
            
            $versao = isset($_POST['versao']) ? $_POST['versao'] : "";
                    
            $arquivo = "Plano_".date('d-m-Y_h-i-s')."_V.".$_POST['versao'];

            $id_municipio = isset($_POST['id']) ? $_POST['id'] :"";
 
            # dados para gravar registro upload
            $dados = array('id_municipio'=>$id_municipio,
                            'id_plano'=> "0",
                            'filePlano'=> $arquivo.".".$extensao,
                            'versao' => $versao,
                            'dt_upload' => $data_upload           
            );


            if($extensao == 'pdf' || $extensao == 'doc' || $extensao == 'docx'){
                if($anexo->uploadSimple('file', '/anexo/planoCont', $dados['filePlano']) &&
                $plano->gravaUpload($dados)){
                    print "sucesso";
                }
                


            }else {
                print $extensao.'Extensao Inválida !';
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