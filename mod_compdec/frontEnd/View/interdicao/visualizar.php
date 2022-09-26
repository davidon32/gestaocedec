<?php include_once 'core/include.php'; ?>
<?php include_once 'core/Model/indexModel.php'; ?>
<?php include_once 'mod_compdec/Model/Model.php'; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php
include_once "template/page/header.php";

$ids = $dados->ids_vistoria;

$vistorias = interdicaoController::listagem_vistorias($ids);

$nr_vistorias = "";
$data_vistorias = "";
$endereco_Imovel = $vistorias[0]['endereco'];

if (count($vistorias) < 1) {
    $nr_vistorias = $vistorias[0]['numero'];
    $data_vistorias = $vistorias[0]['dt_vistoria'];
} else {
    foreach ($vistorias as $key => $vistoria) {
        $nr_vistorias .= $vistoria['numero'] . ", ";
        $data_vistorias .= DataMysql::dataVisual($vistoria['dt_vistoria']) . ", ";
    }
}
?>
<!DOCTYPE  html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt" lang="pt">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>-</title>
        <meta name="author" content="-"/>
        <style type="text/css"> * {margin:0; padding:0; text-indent:0; }
            h2 { color: #767070; font-family:Arial, sans-serif; font-style: normal; font-weight: bold; text-decoration: none; font-size: 11pt; }
            h1 { color: black; font-family:Calibri, sans-serif; font-style: normal; font-weight: bold; text-decoration: none; font-size: 12pt; }
            .s2 { color: #F00; font-family:Calibri, sans-serif; font-style: normal; font-weight: bold; text-decoration: none; font-size: 12pt; }
            .s3 { color: black; font-family:Calibri, sans-serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 12pt; }
            p { color: black; font-family:Calibri, sans-serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 10pt; margin:0pt; }
            li {display: block; }
            #l1 {padding-left: 0pt;counter-reset: c1 1; }
            #l1> li>*:first-child:before {counter-increment: c1; content: counter(c1, upper-roman)" "; color: black; font-family:Calibri, sans-serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 10pt; }
            #l1> li:first-child>*:first-child:before {counter-increment: c1 0;  }
            li {display: block; }
            #l2 {padding-left: 0pt;counter-reset: d1 9; }
            #l2> li>*:first-child:before {counter-increment: d1; content: counter(d1, upper-roman)" "; color: black; font-family:Calibri, sans-serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 10pt; }
            #l2> li:first-child>*:first-child:before {counter-increment: d1 0;  }
            
            @media print {
                .voltar{
                    display: none;
                }
                #impressao {
                    display: none;
                }
            }
        </style>
    </head>
    <body>

        <div class="container"><br>
                <div class='row'>
                    <div class="col-md-12 text-center voltar">
                        <a class='btn btn-success' href='<?= FuncaoBase::geraLink('compdec', 'interdicao', 'index') ?>'>Voltar</a>&nbsp;
                        <button class="btn btn-primary" id="impressao" onclick="window.print();">Imprimir</button></div>
                </div>
                <div class='row'>
                <div class="col-md-2 pull-left"><img width="100" src="/anexo/brasao/7221_brasao.png"></div>
                <div class="col-md-8">
                        <h2 style="text-indent: -27pt;text-align: center;">COORDENADORIA MUNICIPAL DE DEFESA CIVIL DE
                            <span style=" color: #808080;"><?= Municipio::PegaNomeMunicipio($dados->municipio_id); ?> </span>

                        </h2>
                    </div>
                </div>
                <div class="col-md-2"></div>
                     
                    <br>

                        <p class="s2" style="text-indent: 0pt;text-align: center;">
                            <span style=" color: #000;">NOTIFICAÇÃO DE INTERDIÇÃO Nº </span><?=$dados->numero?>
                        </p>
                        <p style="text-indent: 0pt;text-align: left;"><br/></p>
                        <p class="s3" style="padding-top: 1pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Vistoria(s)  realizada(s)  em  
                            <span style=" color: #F00;"><?= $data_vistorias; ?>  </span>pela  equipe  de  Proteção  e  Defesa  Civil  de <?= Municipio::PegaNomeMunicipio($dados->municipio_id); ?>

                            &nbsp;&nbsp; /MG, relacionado(s) no(s) Relatório(s) de Vistoria nº. 
                            <span style=" color: #F00;"><?= $nr_vistorias ?></span>respectivamente.
                        </p>
                        <p style="padding-left: 21pt;text-indent: 0pt;text-align: left;"/>
                        <p style="text-indent: 0pt;text-align: left;"><br/></p>
                        <p style="text-indent: 0pt;text-align: left;"><br/></p>
                        <h1 style="padding-top: 1pt;text-indent: 0pt;">LOCAL DA VISTORIA</h1>
                        <h1 style="text-indent: 0pt;line-height: 151%;">Logradouro: <?= $dados->endereco; ?> </h1>
                        <p style="text-indent: 0pt;text-align: left;"/>
                        <p style="text-indent: 0pt;text-align: left;"><br/></p>

                        <h1 style="text-indent: 0pt;">IDENTIFICAÇÃO DO NOTIFICADO</h1>
                        <h1 style="padding-left: 5pt;text-indent: 0pt;text-align: left;">
                            Nome: <u><?= $dados->notificado ?></u> <br>
                                RG:   <?= $dados->rg_notificado ?><br>
                                Endereço: <?= $dados->endereco; ?><br>
                        </h1>                    
                        <p style="padding-left: 21pt;text-indent: 0pt;text-align: left;"/>
                        <p style="text-indent: 0pt;text-align: left;"><br/></p>
                        <p style="text-indent: 0pt;text-align: left;"/>
                        <h1 style="padding-top: 2pt;text-indent: 0pt;text-align: center;">Motivo da Interdição</h1>
                        <p class="s3" style="padding-top: 7pt;padding-left: 27pt;text-indent: 0pt;line-height: 150%;text-align: justify;">Em decorrência das anomalias constatadas na edificação/solo pelo vistoriador de Proteção e Defesa Civil e relatadas no relatório de vistoria nº <span style=" color: #F00;"><?= $nr_vistorias ?></span>, fica I<b>NTERDITADO </b>o imóvel da <b>  <?= $endereco_Imovel; ?></b>.  As   manifestações patológicas comprometem o desempenho da construção e colocam em risco à vida de seus moradores/usuários.</p>
                        <p class="s3" style="padding-left: 27pt;text-indent: 0pt;line-height: 150%;text-align: justify;">O notificado deve providenciar a remoção imediata de todos os moradores e seus usuários, devendo a edificação permanecer <b>INTERDITADA </b>até que as condições de segurança e habitabilidade sejam restabelecidas.</p>
                        <p class="s3" style="padding-left: 27pt;text-indent: 0pt;line-height: 150%;text-align: justify;">O vistoriador atesta que a presente interdição obedece criteriosamente aos princípios da Lei Federal Nº 12.608, de 10 de abril de 2012, que aduz no Art.2º a seguinte redação:</p>
                        <p class="s3" style="padding-left: 27pt;text-indent: 0pt;line-height: 150%;text-align: justify;">Art. 2º É dever da União, dos Estados, do Distrito Federal e dos Municípios adotar as medidas necessárias à redução dos riscos de desastre.</p>
                        <p class="s3" style="padding-left: 27pt;text-indent: 0pt;line-height: 150%;text-align: justify;">§ 2o A incerteza quanto ao risco de desastre não constituirá óbice para a adoção das medidas preventivas e mitigadoras da situação de risco.</p>
                        <p class="s3" style="padding-top: 1pt;padding-left: 5pt;text-indent: 0pt;line-height: 300%;text-align: left;">
                            <br>
                                Local e data: <?= Municipio::PegaNomeMunicipio($dados->municipio_id) . ", " . DataMysql::dataExtensoDocumento(DataMysql::dataVisual($dados->dt_registro)) ?>.<br>

                                    Vistoriador (es/as): <?= $dados->vistoriador . "<br> Matricula: " . $dados->vistoriador_mat ?> <br>
                                        </p>
                                        <p class="s3" style="text-indent: 0pt;line-height: 15pt;text-align: center;"><br>Assinatura          do          notificado:   ___________________________________________</p>
                                        <br>
                                            <p style="page-break-after: always"></p>

                                            <p style="text-indent: 0pt;text-align: left;"><br/></p>
                                            <p style="padding-top: 2pt;padding-left: 27pt;text-indent: 0pt;line-height: 150%;text-align: left;">O artigo 8º da Lei Federal nº 12.608/2012, atribui aos municípios a competência na redução de desastres e apoio às comunidades locais,</p>
                                            <p style="text-indent: 0pt;text-align: left;"><br/></p>
                                            <p style="padding-top: 6pt;padding-left: 27pt;text-indent: 0pt;text-align: left;">Art. 8o Compete aos Municípios:</p>
                                            <ol id="l1">
                                                <li data-list-text="I">
                                                    <p style="padding-top: 6pt;padding-left: 31pt;text-indent: -4pt;text-align: left;">- executar a PNPDEC em âmbito local;</p>
                                                </li>
                                                <li data-list-text="II">
                                                    <p style="padding-top: 6pt;padding-left: 34pt;text-indent: -7pt;text-align: left;">- coordenar as ações do SINPDEC no âmbito local, em articulação com a União e os Estados;</p></li>
                                                <li data-list-text="III">
                                                    <p style="padding-top: 6pt;padding-left: 36pt;text-indent: -9pt;text-align: left;">- incorporar as ações de proteção e defesa civil no planejamento municipal;</p></li>
                                                <li data-list-text="IV">
                                                    <p style="padding-top: 6pt;padding-left: 37pt;text-indent: -10pt;text-align: left;">- identificar e mapear as áreas de risco de desastres;</p></li>
                                                <li data-list-text="V">
                                                    <p style="padding-top: 6pt;padding-left: 34pt;text-indent: -7pt;text-align: left;">- promover a fiscalização das áreas de risco de desastre e vedar novas ocupações nessas áreas;</p></li>
                                                <li data-list-text="VI">
                                                    <p style="padding-top: 6pt;padding-left: 37pt;text-indent: -10pt;text-align: left;">- declarar situação de emergência e estado de calamidade pública;</p></li>
                                                <li data-list-text="VII">
                                                    <p style="padding-top: 6pt;padding-left: 27pt;text-indent: 0pt;line-height: 150%;text-align: left;">- vistoriar edificações e áreas de risco e promover, quando for o caso, a intervenção preventiva e a evacuação da população das áreas de alto risco ou das edificações vulneráveis; VIII - organizar e administrar abrigos provisórios para assistência à população em situação de desastre, em condições adequadas de higiene e segurança;</p></li>
                                            </ol>
                                            <ol id="l2">
                                                <li data-list-text="IX">
                                                    <p style="padding-left: 36pt;text-indent: -10pt;line-height: 12pt;text-align: left;">- manter a população informada sobre áreas de risco e ocorrência de eventos extremos,</p>
                                                    <p style="padding-top: 6pt;padding-left: 27pt;text-indent: 0pt;line-height: 149%;text-align: left;">bem como sobre protocolos de prevenção e alerta e sobre as ações emergenciais em circunstâncias de desastres;</p></li>
                                                <li data-list-text="X">
                                                    <p style="padding-left: 34pt;text-indent: -7pt;text-align: left;">- mobilizar e capacitar os radioamadores para atuação na ocorrência de desastre;</p></li>
                                                <li data-list-text="XI">
                                                    <p style="padding-top: 6pt;padding-left: 36pt;text-indent: -10pt;text-align: left;">- realizar regularmente exercícios simulados, conforme Plano de Contingência de Proteção e Defesa Civil;</p></li>
                                                <li data-list-text="XII">
                                                    <p style="padding-top: 6pt;padding-left: 39pt;text-indent: -12pt;text-align: left;">- promover a coleta, a distribuição e o controle de suprimentos em situações de desastre;</p></li>
                                                <li data-list-text="XIII">
                                                    <p style="padding-top: 6pt;padding-left: 42pt;text-indent: -15pt;text-align: justify;">- proceder à avaliação de danos e prejuízos das áreas atingidas por desastres;</p></li>
                                                <li data-list-text="XIV">
                                                    <p style="padding-top: 6pt;padding-left: 27pt;text-indent: 0pt;line-height: 150%;text-align: justify;">- manter a União e o Estado informados sobre a ocorrência de desastres e as atividades de proteção civil no Município;</p></li>
                                                <li data-list-text="XV">
                                                    <p style="padding-left: 27pt;text-indent: 0pt;line-height: 150%;text-align: justify;">- estimular a participação de entidades privadas, associações de voluntários, clubes de serviços, organizações não governamentais e associações de classe e comunitárias nas ações do SINPDEC e promover o treinamento de associações de voluntários para atuação conjunta com as comunidades apoiadas; e</p></li>
                                                <li data-list-text="XVI">
                                                    <p style="padding-left: 42pt;text-indent: -15pt;text-align: justify;">- prover solução de moradia temporária às famílias atingidas por desastres.</p></li>
                                            </ol>
                                            </div>
                                            </body>
                                            <!-- =================== RODAPE CORPO ==================== -->
                                            <?php include_once "template/page/corpoRodape.php"; ?>
                                            <!-- =================== RODAPE  ======================== -->
                                            <?php include_once "template/page/rodape.php" ?>
                                            <?php include_once "template/page/barra_config_template.php"; ?>
                                            <!-- =============== HEADER HTML PAGE ================= -->
                                            <?php include_once "template/page/rodapePage.php"; ?>
                                            </html>
