<?php

#@ opcao para
$_cad_pipeiro = isset($_POST['cad_pipeiro']) ? $_POST['cad_pipeiro'] : 0;

#@ opcao para
$_cad_motorista = isset($_POST['cad_motorista']) ? $_POST['cad_motorista'] : 0;

#@ opcao para
$_cad_caminhao = isset($_POST['cad_caminhao']) ? $_POST['cad_caminhao'] : 0;

#@ opcao para
$_cad_contrato = isset($_POST['cad_contrato']) ? $_POST['cad_contrato'] : 0;

#@ opcao para
$_cad_acerto = isset($_POST['cad_acerto']) ? $_POST['cad_acerto'] : 0;

#@ opcao para
$_cad_rota = isset($_POST['cad_rota']) ? $_POST['cad_rota'] : 0;

#@ opcao para
$_rel = isset($_POST['rel']) ? $_POST['rel'] : 0;

#@ opcao para
$_rel_rpa = isset($_POST['rel_rpa']) ? $_POST['rel_rpa'] : 0;

#@ opcao para
$_rel_bb = isset($_POST['rel_bb']) ? $_POST['rel_bb'] : 0;

#@ opcao para
$_rel_imposto = isset($_POST['rel_imposto']) ? $_POST['rel_imposto'] : 0;

#@ opcao para
$_rel_cadastro = isset($_POST['rel_cadastro']) ? $_POST['rel_cadastro'] : 0;

#@ opcao para
$_rel_contrato = isset($_POST['rel_contrato']) ? $_POST['rel_contrato'] : 0;











$_cad_permissao = Usuario::CadastraPermissao($_login, $_cad_pipeiro, $_cad_motorista, $_cad_caminhao, $_cad_contrato, $_cad_acerto, $_rel_rpa, $_rel_bb, $_rel_imposto, $_rel_cadastro, $_rel_contrato, $_cad_rota, $_rel, $_modulo);
	