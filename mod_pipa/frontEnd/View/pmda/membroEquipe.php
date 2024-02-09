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
    
    $dados = $_POST;
    
   
    if($dados['selFuncaoMembro'] == "COORDENADOR"){
        $numCoord = $eqCompdec->existeCoordMun($_POST['municipio_id']);
        
        if($numCoord['total'] == 0 ){
            return $eqCompdec->alterar($dados);
        }
    }else {
        return $eqCompdec->alterar($dados);
    }
    
}
    
    # atualizar cpf no lara
    
//    if (($_SERVER['HTTP_HOST'] == 'sistema.defesacivil.mg.gov.br') || ($_SERVER['HTTP_HOST'] == 'www.sistema.defesacivil.mg.gov.br')) {
//    $url = 'https://sdcmg.com.br/api/auth/cpf';
//    $log_path = '/web/anexo/curl.log';
//} else {
//    //var_dump($_SERVER['HTTP_HOST']);
//    //die();
//    $url = 'http://localhost:8081/api/auth/cpf';
//    $log_path = 'log/curl.log';
//}
//
//    FuncaoBase::Api([
//        'url'=>$url,
//        'items' => [
//                'cpf'        => str_replace(array('.','-'), "", $_POST['txtCpf']),
//                'id_usuario' => $_COOKIE['seguranca']['idUser'],
//                'email'      => $_COOKIE['seguranca']['email_rec'],
//                ],
//        ]);


print "<div class='col-md-12' id='tbl_membro'>";
print "<br><br><br>";
print "<span class='col-md-12' id='span_info'></span>";
print "<h4><p style=\"text-align:center;\">EQUIPE COMPDEC</p></h4>";
print "<table class='table table-bordered table-striped' id='tbl_equipe'>
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

$coordenador = false;


foreach ($listMembro as $value) {
$back ="";
    

        if( (empty($value['cpf']) && strtolower($value['funcao']) == 'coordenador') ){
            $back = " class='alert alert-danger' title='Favor Preencher este campo'";
            $info = "PARA Continuar, é necessário que o Coordenador Municipal tenha o cpf Cadastrado no sistema.";
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
        	
        if(!isset($_GET['mun'])){
            	print "<a onclick='javascript:alterarMembro(".$value['id_equipe'].", \"".$value['nome']."\", \"".$value['funcao']."\", \"".$value['telefone']."\", \"".$value['celular']."\", \"".$value['email']."\", \"".$value['cpf']."\")' title=\"Editar Membros Compdec\"><img width='30px' src='core/imagem/editar.png'></a>";
                print "<a onclick='javascript:deletarMembro(".$value['id_equipe'].")' title=\"Deletar Membros Compdec\"><img width='30px' src='core/imagem/delete.png'></a>";
        }
             
              	print "</td>";
              	print "</tr>";
    $num++;
    
   
    
    }
    
     
print "</table>";

print "<br>";



$listMembroDesat = $eqCompdec->listaMembro($id_municipio, 0);

print "<legend>Agentes / Coordenadores Anteriores da Equipe</legend>";
print "<table class='table table-bordered table-striped'>
            <th>#</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Função</th>
            <th>Telefone</th>
            <th>Celular</th>
            <th>Email</th>
            <th>Ação</th>";

foreach ($listMembroDesat as $value) {

    if ($value['status'] == 0) {
        
            $title = " title='Membro não faz parte da equipe de Compdec !' ";
        

        print "<tr>";
        print "<td style='background-color:#FA5858' title='Membro não faz parte da equipe de Compdec !'>" . $num . "</td>";
        print "<td style='background-color:#FA5858' title='Membro não faz parte da equipe de Compdec !' width='25%' >" . $value['nome'] . "</td>";
        print "<td style='background-color:#FA5858' title='Membro não faz parte da equipe de Compdec !' width='25%'>" . $value['cpf'] . "</td>";
        print "<td style='background-color:#FA5858' title='Membro não faz parte da equipe de Compdec !' width='20%'>" . $value['funcao'] . "</td>";
        print "<td style='background-color:#FA5858' title='Membro não faz parte da equipe de Compdec !' width='15%'>" . $value['telefone'] . "</td>";
        print "<td style='background-color:#FA5858' title='Membro não faz parte da equipe de Compdec !' width='15%'>" . $value['celular'] . "</td>";
        print "<td style='background-color:#FA5858' title='Membro não faz parte da equipe de Compdec !' width='10%'>" . $value['email'] . "</td>";
        print "<td style='background-color:#FA5858' title='Membro não faz parte da equipe de Compdec !' width='10%'>Inativo</td>";
        print "</tr>";
        $num++;
    }
}


print "</table>";

print "</div>";



?>