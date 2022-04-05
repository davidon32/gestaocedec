<?php include_once PATH . '/core/include.php'; ?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="/css/bootstrap.css" rel="stylesheet" media="screen">
                <link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
                    <style type="text/css">

                        body{	
                            background-color: #F6F6F8;
                        }

                        *{

                            /*font-weight: bold*/
                            font-size: 10pt;

                        }
                        table th{
                            color: #444;
                        }

                        table, tr, td{
                            background-color: #ffffff;
                        }
                    </style>
                    </head>
                    <body>
                        <div class='container'>
                        
                                                    <!--<label>Total Registros : <?= count($dados) ?> </label><span style="font-size: 10pt; color: silver"> ( Usuarios Ativos )</span>-->
                        <div class='col-md-3 text-left pull-left'><img width="150" src='/core/imagem/DEFESACIVILMG_400.png'></div>
                        <div class='col-md-3 text-right pull-right'><img width="150" src='http://www.sistema.defesacivil.mg.gov.br/logo/imagens/logomarca_gabinete_militar_nova_sem_fundo.png'></div>
                        <div class='col-md-3 text-center'><img width="150" src='http://desenvolvimento.gestaocedec:8082/logo/imagens/brasao-minas-gerais-logo-vector.png'></div>
                            <p class='text-center'><button class='btn btn-primary' onclick="javascript:history.back();">Voltar</button></p>
                            <p style="text-align:center">Regionais de Defesa Civil de Minas Gerais</p>

                        
                            <div class="table table-responsive">

                                <table class='table'>
                                <tr>
                                    <td>Agente :</td><td><?= $_GET['nome'] ?></td>
                                </tr>
                                <tr>
                                    <td>Região :</td><td><?= $_GET['id_rpm'] ?> RDC - Regiões de Defesa Civil</td>
                                </tr>
                                <tr>
                                    <td>Total de Municípios :</td><td><?= count($dados) ?> </td>
                                </tr>
                                </table>

                                <table class="table table-bordered table-condensed">
                                    <tr>
                                        <th class="col-md-1">#</th>
                                        <th class="text-center col-md-1">Cód.</th>
                                        <th class="text-center">Municipio</th>
                                        <th class="text-center">Situação Usuário</th>
                                        <th class="text-center">Situação Compdec</th>
                                    </tr>
                                    <?php
                                    foreach ($dados as $key => $value) {
                                        $situacao = "";
                                        if (($value['com_const'] == 0) || ($value['situacao'] == 'DESATIVADO')) {
                                            $situacao = "style='background:#FF0000;color:#FFFFFF' title='Municipio sem COMPDEC !'";
                                        }
                                        print "<tr>";
                                        print "<td " . $situacao . ">" . ($key + 1) . "</td>";
                                        print "<td " . $situacao . ">" . $value['id_municipio'] . "</td>";
                                        print "<td " . $situacao . ">" . $value['nome'] . "</td>";
                                        print "<td " . $situacao . ">" . $value['situacao'] . "</td>";
                                        print "<td " . $situacao . ">" . (($value['com_const'] == 1) ? "ATIVO" : "INATIVO") . "</td>";
                                        print "</tr>";
                                    }
                                    ?>
                                </table>

                            </div>



                        </div>

                    </body>
</html>