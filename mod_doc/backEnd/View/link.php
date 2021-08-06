<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_doc/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>
<?php
$_funcaoBase = new FuncaoBase();

?>
    <legend>Links Úteis</legend>

    <ul>
        <li>
            <a href='https://smallpdf.com/pt'>Comprimir / Converter / Separar Juntar arquivos PDF</a>
        </li>
        <li>
            <a href='http://mail.ca.mg.gov.br'>Webmail Defesa Civil</a>
        </li>
        <li>
            <a href='https://pt.savefrom.net/7-como-baixar-vk-musica-videos-fotos.html'>Baixar Vídeos do youtube</a>
        </li>
        <li>
            <a href='https://www.flvto.biz/pt70/baixar-videos-youtube/'>Baixar Vídeos do youtube (opcao)</a>
        </li>
        <li>
            <a href='https://online-audio-converter.com/'>Converter / Cortar / Extrair audio de um Vídeo</a>
        </li>
        <li>
            <a href='http://mail.ca.mg.gov.br'>webmail Defesa Civil</a>
        </li>
    </ul>
                
    <?php
        $_funcaoBase->listaArquivoLink('/anexo/doc/interno/link');
    ?>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>