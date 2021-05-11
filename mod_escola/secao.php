<?php
################################ INDEX ###################################
if(isset($_GET['secao']) && $_GET['secao'] == "menu") {

	include_once "sistema/index.php";

}
################################ PROFESSOR ###################################
if((isset($_GET['secao']) && $_GET['secao'] == "professor") && (isset($_GET['acao']) && $_GET['acao'] == "cadastrar")) {

	include_once "visao/sc.professor.cadastrar.php";
    exit();

}

if((isset($_GET['secao']) && $_GET['secao'] == "professor") && (isset($_GET['acao']) && $_GET['acao'] == "pesquisarAlterar")) {

    include_once "visao/sc.professor.pesquisar.alterar.php";
    exit();

}

if((isset($_GET['secao']) && $_GET['secao'] == "professor") && (isset($_GET['acao']) && $_GET['acao'] == "validarCadastro")) {

    $_request = $_REQUEST;

    include_once "controle/valida.professor.cadastrar.php";
    exit();

}

if((isset($_GET['secao']) && $_GET['secao'] == "professor") && (isset($_GET['acao']) && $_GET['acao'] == "alterar")) {

    $_request = $_REQUEST;

    include_once "controle/valida.professor.alterar.php";
    exit();

}




################################ CURSO ###################################
if((isset($_GET['secao']) && $_GET['secao'] == "curso") && (isset($_GET['acao']) && $_GET['acao'] == "cadastrar")){

	include_once "controle/valida.curso.cadastrar.php";
    exit();

}

if((isset($_GET['secao']) && $_GET['secao'] == "curso") && (isset($_GET['acao']) && $_GET['acao'] == "pesquisarAlterar")) {

    include_once "visao/sc.curso.pesquisar.alterar.php";
    exit();

}


################################ MATERIA ###################################
if((isset($_GET['secao']) && $_GET['secao'] == "materia") && (isset($_GET['acao']) && $_GET['acao'] == "cadastrar")){

	include_once "visao/sc.materia.cadastrar.php";

}

if((isset($_GET['secao']) && $_GET['secao'] == "materia") && (isset($_GET['acao']) && $_GET['acao'] == "pesquisarAlterar")) {

    include_once "visao/sc.materia.pesquisar.alterar.php";
    exit();
}

################################ ALUNO ###################################
if((isset($_GET['secao']) && $_GET['secao'] == "aluno") && (isset($_GET['acao']) && $_GET['acao'] == "cadastrar")){

	include_once "visao/sc.aluno.cadastrar.php";
}

if((isset($_GET['secao']) && $_GET['secao'] == "aluno") && (isset($_GET['acao']) && $_GET['acao'] == "pesquisarAlterar")) {

    include_once "visao/sc.aluno.pesquisar.alterar.php";
    exit();
}

################################ TURMA ###################################
if((isset($_GET['secao']) && $_GET['secao'] == "turma") && (isset($_GET['acao']) && $_GET['acao'] == "cadastrar")){

	include_once "visao/sc.turma.cadastrar.php";
}

if((isset($_GET['secao']) && $_GET['secao'] == "turma") && (isset($_GET['acao']) && $_GET['acao'] == "pesquisarAlterar")) {

    include_once "visao/sc.turma.pesquisar.alterar.php";
    exit();
}

########################### CONSULTA/ RELATORIO############################
if((isset($_GET['secao']) && $_GET['secao'] == "consulta") && (isset($_GET['acao']) && $_GET['acao'] == "cadastrar")){

	include_once "visao/sc.consulta.menu.php";

}




?>