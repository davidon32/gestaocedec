<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/core/include.php';
include_once( $_SERVER['DOCUMENT_ROOT'].'/core/Model/indexModel.php');


$eqCompdec = new MembroEqCompdec();


$id = isset($_POST['id_equipe']) ? (int)$_POST['id_equipe'] : null;

$opcao = isset($_POST['opcao']) ? $_POST['opcao'] : "";

if(isset($pageSession['session']['seguranca']['externo'])){
    $id_municipio = $pageSession['session']['seguranca']['id_municipio'];
}else {
    $id_municipio = isset($_GET['mun']) ? $_GET['mun'] :"";
}


$admin = isset($_SESSION['seguranca']['adm']) ? true : false;

if(is_null($id) && $opcao == "novo") {
    $eqCompdec->novo($_POST);
    
}else if($opcao == "delete"){
    
    $eqCompdec->delete($id);
    
}else if($opcao == "alterar"){
    
    $eqCompdec->alterar($_POST);
}

print "<div class='col-md-12' id='tbl_membro'>";
print "<br><br><br>";
print "<span class='col-md-12' id='span_info'></span>";
print "<h4><p style=\"text-align:center;\">EQUIPE COMPDEC</p></h4>";
print "<table class='table table-bordered table-striped'>
<th>#</th>
<th>Nome</th>
<th>CPF</th>
<th>Função</th>
<th>Telefone</th>
<th>Celular</th>
<th>Email</th>
<th>Ação</th>";

$listMembro = $eqCompdec->listaMembro($id_municipio);

$num = 1;

$info = '';
foreach ($listMembro as $value) {
    $back ="";
    if( (empty($value['cpf']) && strtolower($value['funcao']) == 'coordenador') ){
        $back = " class='alert alert-danger' title='Favor Preencher este campo'";
        $info = "É necessário que o Coordenador Municipal tenha o cpf Cadastrado no sistema.";
    }
    
    print "<tr>";
        print "<td>".$num."</td>";
        print "<td width='25%'>".$value['nome']."</td>";
        print "<td width='20%' ".$back.">".$value['cpf']."</td>";
        print "<td width='20%'>".$value['funcao']."</td>";
        print "<td width='15%'>".$value['telefone']."</td>";
        print "<td width='15%'>".$value['celular']."</td>";
        print "<td width='10%'>".$value['email']."</td>";
        print "<td width='10%'>";
        	
            	print "<a onclick='javascript:alterarMembro(".$value['id_equipe'].", \"".$value['nome']."\", \"".$value['funcao']."\", \"".$value['telefone']."\", \"".$value['celular']."\", \"".$value['email']."\", \"".$value['cpf']."\")' title=\"Editar Membros Compdec\"><img width='30px' src='core/imagem/editar.png'></a>";
                print "<a onclick='javascript:deletarMembro(".$value['id_equipe'].")' title=\"Deletar Membros Compdec\"><img width='30px' src='core/imagem/delete.png'></a>";
             
              	print "</td>";
              	print "</tr>";
    $num++;
    }
    
print "</table>";
print "</div>";

?>