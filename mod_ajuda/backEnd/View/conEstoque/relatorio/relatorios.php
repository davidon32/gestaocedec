<?php

$_opcao = isset($_POST['ck_diario']) ? $_POST['ck_diario'] : "";

$_opcao2 = isset($_POST['ck_resumo_distr']) ? $_POST['ck_resumo_distr'] : "";

$_txt_id_deposito = isset($_POST['txt_id_deposito']) ? $_POST['txt_id_deposito'] : "";
$_txt_dt_inicial = isset($_POST['txt_dt_inicial']) ? $_POST['txt_dt_inicial'] : "";
$_txt_dt_final = isset($_POST['txt_dt_final']) ? $_POST['txt_dt_final'] : "";
$_txt_id_municipio = isset($_POST['txt_id_municipio']) ? $_POST['txt_id_municipio'] : "";

$_evento = isset($_POST['sel_evento']) ? $_POST['sel_evento'] : "";

$_txt_btn_enviar = isset($_POST['txt_btn_enviar']) ? $_POST['txt_btn_enviar'] : "";

$sel_material = isset($_POST['selMaterial']) ? $_POST['selMaterial'] : "";


//select sum(aju_item.quantidade) as quantidade, aju_unidade.singular 
//from aju_item
//inner join aju_unidade
//on aju_item.cod = aju_unidade.id_unidade 
//where aju_unidade.singular = "cesta"
//and YEAR(aju_item.dataLibera) = "2022" 
//group by aju_unidade.singular

if ($_opcao == '1') { // ok evento e todos
    include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/resumo_diario.php';
    exit();
} else if ($_opcao2 == '2') {
    include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/resumo_distribuicao_material.php';
    exit();
} else if ($sel_material) { // ok por evento e todos
    include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/por_material.php';
} else {
    include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/resumo_geral.php';
    exit();
}


?>


