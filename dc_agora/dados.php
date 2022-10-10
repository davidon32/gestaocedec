<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/core/include.php');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$agora = new DefesaCivilAgoraModel();

# lista de categoria e quantidade
$categoria = $agora->listaCategoria();

$categ_validate = array("CEDEC-MG",
"AIPDC",
"Outros(descrever no texto)",
"Reunião",
"Diligência",
"Ajuda Humanitária",
"Vistoria/Fiscalização",
"Treinamento Capacitação",
"Elogios/Sugestões",
"Mapeamento de Área de Risco",
"Programa Agua Doce");


$cat =isset($_GET['cat']) ? $_GET['cat'] : "";

if(in_array($cat, $categ_validate)){
    $cat1 = $cat;
}elseif($cat == "") {
  $cat1 = "";  
}else {
    print "<script>";
    print "window.location = 'http://www.defesacivil.mg.gov.br'";
    print "</script>";
    
}

$ultimas_postagens = $agora->listaPostagem(3, $cat1);


foreach ($ultimas_postagens as $key => $value) {
    $ids[] = $value['id'];
}
//var_dump($ultimas_postagens);
# lista com postagens -3 ultimas 
$postagens = $agora->listaRestantePostagem($ids);

# 3 postagens apos a lista.
$post_recente = $agora->post_recente();

//var_dump($ultimas_postagens);


$id = isset($_GET['id']) ? (int)$_GET['id'] : "";


if($id === 0) {
    FuncaoBase::pgInicio('http://sistema.defesacivil.mg.gov.br/dc_agora');
}

$categorias = $agora->listaCategoria();

$termo = isset($_GET['termo'])? $_GET['termo'] : "";

# dias postagens aleatorioas
$aleatorio = $agora->listaAleatorio();


if(!empty($termo)){
    $dados = $agora->postagemTermo($termo);
} elseif (!empty($id)) {
    
    $dados = $agora->postagem($id);
    if($id !=0 && $dados == ""){
        FuncaoBase::pgInicio('http://sistema.defesacivil.mg.gov.br/dc_agora');
    }
    $tabela = 'cedec_def_agora';
} elseif (!empty($cat1)) {
    $dados = $agora->post_por_categoria($cat1);
    if($id !=0 && $dados == ""){
        FuncaoBase::pgInicio('http://sistema.defesacivil.mg.gov.br/dc_agora');
    }
    $tabela = 'cedec_def_agora';
} else {
    $dados = '';
    $tabela = 'cedec_def_agora';
    
}

$paginacao = $agora->paginacao_dc_agora(array('dados'=> $dados,
    'tabela' => $tabela,
    'qtd_registro' => "5"));


?>
