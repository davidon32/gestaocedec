<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/core/include.php';
include_once( $_SERVER['DOCUMENT_ROOT'] . '/core/Model/indexModel.php');


$eqCompdec = new MembroEqCompdec();

$id = isset($_POST['id_equipe']) ? (int) $_POST['id_equipe'] : null;

$opcao = isset($_POST['opcao']) ? $_POST['opcao'] : "";

if (isset($pageSession['session']['seguranca']['externo'])) {
    $id_municipio = $pageSession['session']['seguranca']['id_municipio'];
} else {
    $id_municipio = isset($_GET['mun']) ? $_GET['mun'] : "";
}



$admin = isset($_SESSION['seguranca']['adm']) ? true : false;

if (is_null($id) && $opcao == "novo") {
    $eqCompdec->novo($_POST);
} else if ($opcao == "delete") {

    $eqCompdec->delete($id);
} else if ($opcao == "alterar") {
    
    $dados = $_POST;
    
   
    if($dados['selFuncaoMembro'] == "COORDENADOR"){
        $numCoord = $eqCompdec->existeCoordMun($_POST['municipio_id']);
        
        if($numCoord['total'] == 0 ){
            return $eqCompdec->alterar($dados);
        }
    }else {
        $eqCompdec->alterar($dados);
    }
    
}


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
foreach ($listMembro as $value) {

    print "<tr>";
    print "<td>" . $num . "</td>";
    print "<td width='25%'>" . $value['nome'] . "</td>";
    print "<td width='25%'>" . $value['cpf'] . "</td>";
    print "<td width='20%'>" . $value['funcao'] . "</td>";
    print "<td width='15%'>" . $value['telefone'] . "</td>";
    print "<td width='15%'>" . $value['celular'] . "</td>";
    print "<td width='10%'>" . $value['email'] . "</td>";
    print "<td width='10%'>";
        print "<a onclick='javascript:alterarMembro(" . $value['id_equipe'] . ", \"" . $value['nome'] . "\", \"" . $value['funcao'] . "\", \"" . $value['telefone'] . "\", \"" . $value['celular'] . "\", \"" . $value['email'] . "\", \"" . $value['cpf'] . "\")' title=\"Editar Membros Compdec\"><img width='30px' src='core/imagem/editar.png'></a>";
        //if(strtolower($value['funcao']) != "coordenador"){
            print "<a onclick='javascript:deletarMembro(" . $value['id_equipe'] . ")' title=\"Deletar Membros Compdec\"><img width='30px' src='core/imagem/delete.png'></a>";
        //}
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
?>