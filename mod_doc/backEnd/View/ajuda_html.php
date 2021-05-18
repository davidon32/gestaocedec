<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_doc/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php"; ?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<style>
    
    *{
        font-size: 15pt;
    }
    
    img {
        width: 300;
    }
    
    span.destaque1{
        font-size: 15pt;
        color: red;
        font-weight: bold;
    }
    
    
    
</style>
    

<div class="row">
    <div class="col-md-3">
        <a href="<?=FuncaoBase::geraLink("doc", "doc", "index")?>" class="btn btn-success">Voltar</a>
        <nav class="bs-docs-sidebar hidden-print hidden-sm hidden-xs affix">
            <legend><p>Indice</p></legend>
            <p><a href="#">Glossário</a> </p> 
            <p><a href="#id_funcionalidade">Funcionalidades</a></p>
            
            <ul>
                <li class="fa fa-yelp">&nbsp;&nbsp;&nbsp;<a href="">ACESSO EMAIL INSTITUCIONAL <span class="label label-default">Novo</span></a>
                    <ul>
                        <li class="fa fa-check">&nbsp;&nbsp;&nbsp;<a href="#acessowebmail">Acesso WEB email</a></li><br>
                        <li class="fa fa-check">&nbsp;&nbsp;&nbsp;<a href="">Acesso caixa email diretoria </a></li><br>
                        <li class="fa fa-check">&nbsp;&nbsp;&nbsp;<a href="">Redirecionar email </a></li>
                    </ul>
                </li>
                <br>
                <li class="fa fa-yelp">&nbsp;&nbsp;&nbsp;<a href="">INFORMAÇÕES COMPDEC <span class="label label-default">Novo</span></a></li><br>
                <ul>
                    <li class="fa fa-check">&nbsp;&nbsp;&nbsp;<a href="">Acesso WEB email</a></li><br>
                    <li class="fa fa-check">&nbsp;&nbsp;&nbsp;<a href="">Acesso caixa email diretoria </a></li><br>
                    <li class="fa fa-check">&nbsp;&nbsp;&nbsp;<a href="">Redirecionar email </a></li>
                </ul>
            </ul>
        </nav>
    </div>    
    <div class="col-md-9">
        <div class="panel panel-default">
            <div id="acessowebmail" class="panel-heading">Acesso WebMail</div>
            <div class="panel-body">
                <p>Acesse : www.mail.ca.mg.gov.br </p>
                <p>no campo usuário coloque o <span class="destaque1">mesmo que é usado para acessar os computadores da CA</span></p>
                <p><img src="core/imagem/img_ajuda/webmail_01.png"></p>
                <p>Abrir Caixa de Email da seção, ex: defesacivil@defesacivil.mg.gov.br</p>
                <p>No canto superior direito</p>
                
                <p><img src="core/imagem/img_ajuda/webmail_02.png"></p>
            </div>
            <!-- # inicio grupo -->
            <div id="id_grupo" class="panel-heading">
                Titulo Grupo
            </div>
            <div class="panel-body">
                <p>informações</p>
                <p><img src="imagens"></p>
            </div>
             <!-- # fim grupo  -->
             
            <!-- # inicio funcionalidades -->
            <div id="id_funcionalidade" class="panel-heading">
                Funcionalidades Disponíveis
            </div>
            <div class="panel-body">
                <p>informações</p>
                <p><img src="imagens"></p>
            </div>
             <!-- # fim funcionalidades  -->
        </div<br><br><br>
        

    </div>
</div>

<?php
/*
 * <!-- menu -->
<ul>
    <li class="fa fa-yelp">&nbsp;&nbsp;&nbsp;<a href="">TITULO 1<span class="label label-default">Novo</span></a>
        <ul>
            <li class="fa fa-check">&nbsp;&nbsp;&nbsp;<a href="">opção 1</a></li><br>
            <li class="fa fa-check">&nbsp;&nbsp;&nbsp;<a href="">opção 2</a></li><br>
        </ul>
    </li>
    <br>
    <li class="fa fa-yelp">&nbsp;&nbsp;&nbsp;<a href="">TITULO 2 <span class="label label-default">Novo</span></a></li><br>
    <ul>
        <li class="fa fa-check">&nbsp;&nbsp;&nbsp;<a href="">opcao 1</a></li><br>
        <li class="fa fa-check">&nbsp;&nbsp;&nbsp;<a href="">opcao 2</a></li><br>
    </ul>
</ul>

/*<!-- conteudo informações -->
<div class="panel panel-default">
    <div class="panel-heading">Template Titulo</div>
    <div class="panel-body">
        Conteudo
    </div>
</div>*/
?>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
