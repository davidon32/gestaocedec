<?php session_start();
	include_once PATH.'/include.php';

$id_pipeiro = "";



$placa = isset($_POST['txt_placa']) ? strtoupper(utf8_decode($_POST['txt_placa'])) : "";

$modelo = isset($_POST['txt_modelo']) ? strtoupper(utf8_decode($_POST['txt_modelo'])) : "";

$marca = isset($_POST['txt_marca']) ? strtoupper(utf8_decode($_POST['txt_marca'])): "";

$fabric = isset($_POST['txt_fabricacao']) ? strtoupper(utf8_decode($_POST['txt_fabricacao'])) : "";

$chassi = isset($_POST['txt_chassi']) ? strtoupper(utf8_decode($_POST['txt_chassi'])) : "";

$renavam = isset($_POST['txt_renavam']) ? strtoupper(utf8_decode($_POST['txt_renavam'])) : "";

$capacidade = isset($_POST['txt_capacidade']) ? strtoupper(utf8_decode($_POST['txt_capacidade'])) : "";

$id_caminhao = (int) isset($_POST['txt_id_caminhao']) ? $_POST['txt_id_caminhao'] : 0;

$id_rota = "0";

$id_motorista = "0";

$_btn_enviar = isset($_POST['cadastrar']) ? strtoupper(utf8_decode($_POST['cadastrar'])) : "";


$caminhao = new Caminhao();
$funcaoBase = new FuncaoBase();


$campos = array('Placa'=> $placa,
                'Podelo'=> $modelo,
                'Marca'=> $marca,
                'Ano Fabricacao'=> $fabric,
                'Chassi'=> $chassi,
                'Renavam'=> $renavam,
                'Capacidade'=> $capacidade);

/* cadastro */
if($funcaoBase->campoBranco($campos)){
    
    if(is_numeric($id_caminhao) && $id_caminhao == 0){
       	    
    		if($caminhao->cadastroCaminhao($placa,
                            				$modelo,
                            				$marca,
                            				$fabric,
                            				$chassi,
                            				$renavam,
                            				$capacidade,
                            				$id_rota,
                            				$id_motorista =0)){
    			
    
    			print "<script type='text/javascript'>";
    
    			print "alert('Cadastro Realizado com Sucesso !');";
    
    			print "window.location.href = '?modulo=pipa&secao=caminhao&acao=cadastro';";
    			
    			print "</script>";
    				
    		}
    	   			
    				
/* atualizacao */ 		
}else {
    
    if($caminhao->AlteraCaminhao($id_caminhao,
                                        $placa,
                        				$modelo,
                        				$marca,
                        				$fabric,
                        				$chassi,
                        				$renavam,
                        				$capacidade)){
        
           print "<script type='text/javascript'>";
                        				    
           print "alert('Cadastro Atualizacao com Sucesso !');";
                        				    
           print "window.location.href = '?modulo=pipa&secao=caminhao&acao=cadastro';";
                        				     
           print "</script>";
                        				                   				    
    }
    	    
}


}?>