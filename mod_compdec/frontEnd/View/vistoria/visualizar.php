<?php include_once 'core/include.php'; ?>
<?php include_once 'core/Model/indexModel.php'; ?>
<?php include_once 'mod_compdec/Model/Model.php'; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php
include_once "template/page/header.php";
?>
<!DOCTYPE  html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt" lang="pt">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>RELATÓRIO DE VISTORIA NO</title>
        <meta name="author" content="975250"/>

        <style type="text/css">
            * {
                margin:0; padding:0; text-indent:0;
            }
            
            @media print {
                .voltar{
                    display: none;
                }
                #impressao {
                    display: none;
                }
            }
            
            p.dest { 
                color: black;
                font-family:Calibri,
                sans-serif; font-style: normal;
                font-weight: bold;
                text-decoration: none;
                font-size: 11pt;
                margin:0pt;
                text-align: justify;
            }
            
            p.tx {
                text-align: justify;
                font-weight: normal;
                padding-left: 30px;
            }
            .s1 {
                color: black; font-family:Calibri, sans-serif; font-style: normal; font-weight: bold; text-decoration: none; font-size: 11pt;
            }
            .s2 { color: black; font-family:Calibri, sans-serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 11pt; }
            li {display: block; }
            #l1 {padding-left: 0pt;counter-reset: c1 5; }
            #l1> li>*:first-child:before {counter-increment: c1; content: counter(c1, decimal)". "; color: black; font-family:Calibri, sans-serif; font-style: normal; font-weight: bold; text-decoration: none; font-size: 11pt; }
            #l1> li:first-child>*:first-child:before {counter-increment: c1 0;  }
            #l2 {padding-left: 0pt;counter-reset: c2 1; }
            #l2> li>*:first-child:before {counter-increment: c2; content: counter(c1, decimal)"."counter(c2, decimal)" "; color: black; font-family:Calibri, sans-serif; font-style: normal; font-weight: bold; text-decoration: none; font-size: 11pt; }
            #l2> li:first-child>*:first-child:before {counter-increment: c2 0;  }
            table, tbody {vertical-align: top; overflow: visible; }
            
            
        </style>
    </head>
    <body>
        

        <div class="container">
            <br>
                <div class="col-md-12 text-center voltar"><a class='btn btn-success' href='<?= FuncaoBase::geraLink('compdec', 'vistoria', 'index')?>'>Voltar</a>&nbsp;<button class="btn btn-primary" id="impressao" onclick="window.print();">Imprimir</button></div>
            <div class="col-md-6 pull-left"><img width="100" src="/anexo/brasao/7221_brasao.png"></div>
            <div class="col-md-6 text-right"><!--<img width="100" src="/anexo/brasao/7221_brasao.png">--></div>
            <br>
            <div class="col-md-12">
                

            <p class='dest' style="padding-top: 2pt;padding-left: 71pt;text-indent: 0pt;text-align: center;">RELATÓRIO DE VISTORIA DE ATENDIMENTO EMERGENCIAL Nº <span style=" color: #F00;"><?= $dados->numero ?></span></p>
            <p class='dest' style="text-indent: 0pt;text-align: left;"><br/></p>
            <p class='dest' style="padding-left: 5pt;text-indent: 0pt;line-height: 189%;text-align: left;">
                1. Proprietário/Morador: <i><?= $dados->prop ?></i><br>
                    Endereço do local da vistoria: Município: <i><?= $dados->endereco ?></i><br>
                        Contato/Telefone: <i><?= $dados->tel ?></i></p><br>
                            <p class='dest' style="padding-left: 5pt;text-indent: 0pt;line-height: 190%;text-align: left;">Data da vistoria: Tipo da Ocorrência: Tipo de Imóvel:</p>
                            <p class='dest' style="padding-left: 5pt;text-indent: 0pt;text-align: left;"/>
                            <p class='dest' style="text-indent: 0pt;text-align: left;"><br/></p>
                            <p class='dest' style="padding-top: 2pt;padding-left: 11pt;text-indent: 0pt;text-align: left;">2. CONDIÇÃO DO LOCAL (marcar sim ou não para cada anomalia visualizada)</p>
                            <p class='dest' style="text-indent: 0pt;text-align: left;"><br/></p>
                            
                            <table style="border-collapse:collapse;margin:auto" cellspacing="0">
                                <tr style="height:21pt">
                                    <td style="width:204pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p class="s1" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Trincas nos elementos estruturais</p>
                                    </td>
                                    <td style="width:128pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p class="s1" style="padding-left: 55pt;padding-right: 54pt;text-indent: 0pt;line-height: 13pt;text-align: center;">sim</p>
                                    </td>
                                    <td style="width:134pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p class="s1" style="padding-left: 57pt;padding-right: 57pt;text-indent: 0pt;line-height: 13pt;text-align: center;">não</p>
                                    </td></tr>
                                <tr style="height:21pt">
                                    <td style="width:204pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p class="s2" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Pilar</p>
                                    </td>
                                    <td style="width:128pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->tr_pilar == 1) ? "X" : "" ?></p>
                                    </td>
                                    <td style="width:134pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->tr_pilar == 0) ? "X" : "" ?><br/></p>
                                    </td></tr>
                                <tr style="height:21pt">
                                    <td style="width:204pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p class="s2" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Viga</p>
                                    </td>
                                    <td style="width:128pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->tr_viga == 1) ? "X" : "" ?><br/></p>
                                    </td>
                                    <td style="width:134pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->tr_viga == 0) ? "X" : "" ?><br/></p>
                                    </td></tr>
                                <tr style="height:21pt">
                                    <td style="width:204pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p class="s2" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Laje</p>
                                    </td>
                                    <td style="width:128pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->tr_laje == 1) ? "X" : "" ?><br/></p>
                                    </td>
                                    <td style="width:134pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->tr_laje == 0) ? "X" : "" ?><br/></p>
                                    </td></tr>
                                <tr style="height:21pt">
                                    <td style="width:466pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="3">
                                        <p class="s1" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Trincas nos elementos construtivos</p>
                                    </td></tr>
                                <tr style="height:21pt">
                                    <td style="width:204pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p class="s2" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Parede</p>
                                    </td>
                                    <td style="width:128pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->parede == 1) ? "X" : "" ?><br/></p>
                                    </td>
                                    <td style="width:134pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->parede == 0) ? "X" : "" ?><br/></p>
                                    </td></tr>
                                <tr style="height:21pt">
                                    <td style="width:204pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p class="s2" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Piso</p>
                                    </td>
                                    <td style="width:128pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->piso == 1) ? "X" : "" ?><br/></p>
                                    </td>
                                    <td style="width:134pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->piso == 0) ? "X" : "" ?><br/></p>
                                    </td></tr>
                                <tr style="height:21pt">
                                    <td style="width:204pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p class="s2" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Muro</p>
                                    </td>
                                    <td style="width:128pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->muro == 1) ? "X" : "" ?><br/></p>
                                    </td>
                                    <td style="width:134pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->muro == 0) ? "X" : "" ?><br/></p>
                                    </td></tr>
                                <tr style="height:21pt">
                                    <td style="width:466pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="3">
                                        <p class="s1" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Risco de colapso</p>
                                    </td></tr>
                                <tr style="height:21pt">
                                    <td style="width:204pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p class="s2" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Elementos estruturais</p>
                                    </td>
                                    <td style="width:128pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->r_col_estrutural == 1) ? "X" : "" ?><br/></p>
                                    </td>
                                    <td style="width:134pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->r_col_estrutural == 0) ? "X" : "" ?><br/></p>
                                    </td></tr>
                                <tr style="height:21pt">
                                    <td style="width:204pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p class="s2" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Elementos construtivos</p>
                                    </td>
                                    <td style="width:128pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->r_col_construtivo == 1) ? "X" : "" ?><br/></p>
                                    </td>
                                    <td style="width:134pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->r_col_construtivo == 0) ? "X" : "" ?><br/></p>
                                    </td></tr>
                                <tr style="height:21pt">
                                    <td style="width:204pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p class="s2" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Risco externos</p>
                                    </td>
                                    <td style="width:128pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->r_externo == 1) ? "X" : "" ?><br/></p>
                                    </td>
                                    <td style="width:134pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->r_externo == 0) ? "X" : "" ?><br/></p>
                                    </td></tr>
                                <tr style="height:21pt">
                                    <td style="width:204pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p class="s2" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Vazamentos</p>
                                    </td>
                                    <td style="width:128pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->r_vazamento == 1) ? "X" : "" ?><br/></p>
                                    </td>
                                    <td style="width:134pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->r_vazamento == 0) ? "X" : "" ?><br/></p>
                                    </td></tr>
                                <tr style="height:21pt">
                                    <td style="width:466pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="3">
                                        <p class="s1" style="padding-left: 5pt;text-indent: 0pt;text-align: left;">Agentes externos</p>
                                    </td></tr>
                                <tr style="height:21pt">
                                    <td style="width:204pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p class="s2" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Deformações no muro</p>
                                    </td>
                                    <td style="width:128pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->ae_muro == 1) ? "X" : "" ?><br/></p>
                                    </td>
                                    <td style="width:134pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->ae_muro == 0) ? "X" : "" ?><br/></p>
                                    </td></tr>
                                <tr style="height:21pt">
                                    <td style="width:204pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p class="s2" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Ruptura de redes hidráulicas</p>
                                    </td>
                                    <td style="width:128pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->ae_rede_hidraulica == 1) ? "X" : "" ?><br/></p>
                                    </td>
                                    <td style="width:134pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->ae_rede_hidraulica == 0) ? "X" : "" ?><br/></p>
                                    </td></tr>
                                <tr style="height:21pt">
                                    <td style="width:204pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p class="s2" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Deslizamentos de encosta/talude</p>
                                    </td>
                                    <td style="width:128pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->ae_deslizamento == 1) ? "X" : "" ?><br/></p>
                                    </td>
                                    <td style="width:134pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->ae_deslizamento == 0) ? "X" : "" ?><br/></p>
                                    </td></tr>
                                <tr style="height:21pt">
                                    <td style="width:204pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p class="s2" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Inundação</p>
                                    </td>
                                    <td style="width:128pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->ae_inundacao == 1) ? "X" : "" ?><br/></p>
                                    </td>
                                    <td style="width:134pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->ae_inundacao == 0) ? "X" : "" ?><br/></p>
                                    </td></tr>
                                <tr style="height:21pt">
                                    <td style="width:204pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p class="s2" style="padding-left: 5pt;text-indent: 0pt;text-align: left;">Outros</p>
                                    </td>
                                    <td style="width:128pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->ae_outros == 1) ? "X" : "" ?><br/></p>
                                    </td>
                                    <td style="width:134pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                        <p style="text-indent: 0pt;text-align: center;"><?= ($dados->ae_outros == 0) ? "X" : "" ?><br/></p>
                                    </td></tr>
                                <tr style="height:21pt">
                                    <td style="width:466pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="3">
                                        <p class="s1" style="padding-left: 5pt;text-indent: 0pt;text-align: left;">Outras anomalias (detalhar)</p>
                                    </td></tr>
                                <tr style="height:21pt">
                                    <td style="width:466pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="3">
                                        <p style="text-indent: 0pt;text-align: left;"><?= $dados->ae_outros_txt ?><br/></p>
                                    </td></tr>
                            </table>
                            <p style="text-indent: 0pt;text-align: left;"><br/></p>
                            <p style="padding-left: 5pt;text-indent: 0pt;text-align: left;">3. CARACTERIZAÇÃO DO LOCAL (Relatar qual a condição do terreno onde está a edificação)</p>
                            <p style="padding-left: 5pt;text-indent: 0pt;text-align: left;"/>
                            <p class='tx'><?= $dados->caracterizacao ?><br/></p>
                            <p style="padding-left: 5pt;text-indent: 0pt;text-align: left;">4. PARECER/CONCLUSÃO</p>
                            <p style="padding-left: 5pt;text-indent: 0pt;text-align: left;"/>
                            <p class='tx'><?= $dados->parecer ?><br/></p>
                                    <p style="padding-left: 16pt;text-indent: -11pt;text-align: left;">RECOMENDAÇÃO/CONSIDERAÇÃO</p>
                            <ol id="l1">
                                <li>
                                    <ol id="l2">
                                        <li data-list-text="">
                                            <p style="padding-top: 2pt;padding-left: 22pt;text-indent: -16pt;text-align: left;">Providências imediatas</p>
                                            <p class='tx'><?= $dados->rec_prov_imediata ?><br/></p>
                                        </li>
                                        <li data-list-text="">
                                            <p style="padding-left: 22pt;text-indent: -16pt;text-align: left;">Medidas para recuperação</p>
                                            <p class='tx'><?= $dados->rec_medidas_recuperacao ?><br/></p>
                                        </li>
                                    </ol>
                                </li>
                            </ol>
                            <p style="padding-left: 5pt;text-indent: 0pt;text-align: left;"/>
                            <p style="text-indent: 0pt;text-align: left;"><br/></p>
                            <p style="padding-left: 5pt;text-indent: 0pt;text-align: left;">6. CONSIDERAÇÕES FINAIS</p>
                            <p style="padding-left: 5pt;text-indent: 0pt;text-align: left;"/>
                            <p class='tx'><?= $dados->considera_finais ?><br/></p>
                            <p style="padding-left: 5pt;text-indent: 0pt;text-align: left;">7. RESPONSÁVEL/VISTORIADOR</p>
                            <p style="padding-left: 5pt;text-indent: 0pt;text-align: left;"/>
                            <?= $dados->resp_vistoriador ?>
                            </div>
            </div>


                            <!-- =================== RODAPE CORPO ==================== -->
                            <?php include_once "template/page/corpoRodape.php"; ?>
                            <!-- =================== RODAPE  ======================== -->
                            <?php include_once "template/page/rodape.php" ?>
                            <?php include_once "template/page/barra_config_template.php"; ?>
                            <!-- =============== HEADER HTML PAGE ================= -->
                            <?php include_once "template/page/rodapePage.php"; ?>
