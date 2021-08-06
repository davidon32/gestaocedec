<?php $id_session = session_id();
    if(empty($id_session)) session_start(); 
    print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
    include_once PATH.'/include.php';

$con = Conexao::getInstance();

$_funcaoBase = new FuncaoBase();

$_municipio = new Municipio();

$_compdec = new Compdec();

$eqCompdec = new MembroEqCompdec();

$_regiao = new Regiao();

$_associacao = new Associacao();

$acessoEx = isset($_SESSION['seguranca']['ex']) ? $_SESSION['seguranca']['ex'] : "";

$_id = isset($_GET['id']) ? (int)$_GET['id'] :"";

$repCompdec = array();

/* acesso compdec */
if(isset($_SESSION['seguranca']['ex'])){
	
	$_loginEx = new LoginExterno();
	 
	$_loginEx->logadoExterno();
	 
	$_loginEx->Sessao();
	
	$_dados = $_compdec->buscaCompdec($_SESSION['seguranca']['id_municipio']);
	$repCompdec = $eqCompdec->listaMembro($_SESSION['seguranca']['id_municipio']);
	
/* acesso cedec */	
}else {
	
	$_login = new Login();
	
	$_login->logado();

	if(is_int($_id)){
	
	    $_dados = $_compdec->buscaCompdec($_id);
	    $repCompdec = $eqCompdec->listaMembro($_id);
	}
}
    
	$coordCompdec['nome'] = "-";
    $coordCompdec['telefone'] = "-";
    $coordCompdec['celular'] = "-";
    $coordCompdec['email'] = "-";
    
    foreach ($repCompdec as $value) {
    	if($value['funcao'] == 'Coordenador'){
    	
    		$coordCompdec['nome'] = (isset($value['nome'])) ? $value['nome'] : "-" ;
    		$coordCompdec['telefone'] = (isset($value['telefone'])) ? $value['telefone'] : "-" ;
    		$coordCompdec['celular'] = (isset($value['celular'])) ? $value['celular'] : "-" ;
    		$coordCompdec['email'] = (isset($value['email'])) ? $value['email'] : "-" ;
    		
    	}
    }
    
    $voltar = "<a class='btn' href='javascript:history.back();'>Voltar</a>"

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo TITULO; ?></title>
<link href="/css/bootstrap.css" rel="stylesheet" >
<link href="/css/bootstrap-responsive.css" rel="stylesheet" >
<style type="text/css">

	@media print {
	
		#menu { display:none;}
		#barra_usuario { display:none;}
	
	
	
	}


</style>
</head>

<body>
    <!-- TOPO /system/topo.php-->
    <?php include_once(PATH.'/system/topo.php'); ?>
    
    <div class="container">
        
        <!-- MENU -->
        <div class="row-fluid">
            <div class="span2" id="menu">
                <?php ($acessoEx) ? print $voltar : include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
            </div>

            <div class="span9">
                <div class="span12 text-center"><legend>Dados Compdec</legend></div>
                
                <table class="table table-striped table-bordered" align="center" width="100%">
                	<tr>
                		<td style="text-align: center;"><img src="/imagem/compdec/<?=AnexoCompdec::Foto($_dados[0]['id_municipio']);?>" style="padding-bottom: 3px;"></td>
                		<td colspan="3">Nome : <?=$coordCompdec['nome'];?><br>
                						Telefone: <?=$coordCompdec['telefone'];?><br>
                						Celular: <?=$coordCompdec['celular'];?><br>
                						Email: <?=$coordCompdec['email'];?></td>
                	</tr>
                    <tr>
                        <td width="15%"><b>Municipio</b></td>
                        <td width="35%"><?php print $_municipio->PegaNomeMunicipio($_dados[0]['id_municipio']);?></td>
                        <td width="15%"><b>Região</b></td>
                        <td width="35%"><?php print $_regiao->PegaNomeRegiao($_dados[0]['regiao']);?></td>
                    </tr>
                    <tr>
                        <td width="15%"><b>Associação</b></td>
                        <td colspan="3" width="85%"><?php print utf8_decode($_associacao->PegaNomeAssociacao($_dados[0]['associacao']));?></td>
                    </tr>
                    <tr>
                        <td width="15%"><b>Lei nº</b></td>
                        <td width="35%"><?php print $_dados[0]['num_lei'];?></td>
                        <td width="15%"><b>Data Lei</b></td>
                        <td width="35%"><?php print DataMysql::dataVisual($_dados[0]['dt_lei']);?></td>
                    </tr>
                    <tr>
                        <td width="15%"><b>Decreto nº</b></td>
                        <td width="35%"><?php print $_dados[0]['num_decreto'];?></td>
                        <td width="15%"><b>Data Decreto</b></td>
                        <td width="35%"><?php print DataMysql::dataVisual($_dados[0]['dt_decreto']);?></td>
                    </tr>
                    <tr>
                        <td width="15%"><b>Portaria nº</b></td>
                        <td width="35%"><?php print $_dados[0]['num_portaria'];?></td>
                        <td width="15%"><b>Data Portaria</b></td>
                        <td width="35%"><?php print DataMysql::dataVisual($_dados[0]['dt_portaria']);?></td>
                    </tr>
                    <tr>
                        <td width="15%"><b>Endereço</b></td>
                        <td colspan="3" width="85%"><?php print utf8_encode($_dados[0]['endereco']);?></td>
                    </tr>
                    <tr>
                        <td width="15%"><b>Fone 1</b></td>
                        <td width="35%"><?php print $_dados[0]['fone_com1'];?></td>
                        <td width="15%"><b>Fone 2</b></td>
                        <td width="35%"><?php print $_dados[0]['fone_com2'];?></td>
                    </tr>
                    <tr>
                        <td width="15%"><b>Email</b></td>
                        <td width="35%"><?php print $_dados[0]['email'];?></td>
                        <td width="15%"><b>Efetivo nº</b></td>
                        <td width="35%"><?php print ($_dados[0]['efetivo'] == 0) ? "0" : $_dados[0]['efetivo'];?></td>
                    </tr>
                    <tr>
                        <td width="15%"><b>Possui Nudec ?</b></td>
                        <td width="35%"><?php print ($_dados[0]['regiao'] == 0) ? "Não" : "Sim";?></td>
                        <td width="15%"></td>
                        <td width="35%"></td>
                    </tr>
                  </table>
                  <table class="table table-striped table-bordered" align="center" width="100%">
                    <tr>
                        <td width="40%"><b>Nome</b></td>
                        <td width="15%"><b>Função</b></td>
                        <td width="15%"><b>Fone</b></td>
                        <td width="15%"><b>Cel</b></td>
                        <td width="15%"><b>Email</b></td>
                    </tr>
                    
                    <?php foreach ($repCompdec as $value) {
                    	print "<tr>";
                    	print "<td>".$value['nome']."</td>";
                    	print "<td>".$value['funcao']."</td>";
                    	print "<td>".$value['telefone']."</td>";
                    	print "<td>".$value['celular']."</td>";
                    	print "<td>".$value['email']."</td>";
                    	print "<tr>";
                    }
              
                    ?>
  
                </table>
             
            </div>
        </div>

        <!-- RODAPE -->
        <div class="row-fluid">
            <div class="span12 text-center">
                <hr>
                <small><?php print RODAPE;?></small>
            </div>
        </div>
    </div>
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/jasny-bootstrap.js"></script>
    <script src="/js/funcaobase.js"></script>
</body>
</html>
