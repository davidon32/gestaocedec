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

$cat = isset($_GET['cat']) ? $_GET['cat'] : "";

$ultimas_postagens = $agora->listaPostagem(3, $cat);


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

$categorias = $agora->listaCategoria();

$categoria = isset($_GET['cat']) ? $_GET['cat'] : "";

$termo = isset($_GET['termo'])? $_GET['termo'] : "";

# dias postagens aleatorioas
$aleatorio = $agora->listaAleatorio();
if(!empty($termo)){
    $dados = $agora->postagemTermo($termo);
} elseif (!empty($id)) {
    $dados = $agora->postagem($id);
    $tabela = '';
} elseif (!empty($categoria)) {
    $dados = $agora->post_por_categoria($categoria);
    $tabela = '';
} else {
    $dados = '';
    $tabela = 'cedec_def_agora';
}

$paginacao = $agora->paginacao_dc_agora(array('dados'=> $dados,
    'tabela' => $tabela,
    'qtd_registro' => "5"));

?>
