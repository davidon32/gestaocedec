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
                            <div class="table table-responsive">
                                <p style="text-align:center"><legend>Regionais de Defesa Civil de Minas Gerais</legend></p>
                                <!--<label>Total Registros : <?= count($dados) ?> </label><span style="font-size: 10pt; color: silver"> ( Usuarios Ativos )</span>-->
                                <div class='col-md-3 text-left pull-left'><img width="150" src='/core/imagem/DEFESACIVILMG_400.png'></div>
                                <div class='col-md-3 text-right pull-right'><img width="150" src='http://www.sistema.defesacivil.mg.gov.br/logo/imagens/logomarca_gabinete_militar_nova_sem_fundo.png'></div>
                                <div class='col-md-3 text-center'><img width="150" src='http://desenvolvimento.gestaocedec:8082/logo/imagens/brasao-minas-gerais-logo-vector.png'></div>
                                <div class='col-md-12 text-center'><a href='#' onclick="history.back()" class='btn btn-primary'>Voltar</a><br><br></div>
                                            <table class='table table-bordered'>
                                                <tr>
                                                    <th title='Regiao Defesa Civil'>Regiao DC</th>
                                                    <th title='Município'>Município</th>
                                                    <th title='Número de Polícia'>Nº Polícia</th>
                                                    <th title='Posto / Graduação'>Posto</th>
                                                    <th title='Nome do Usuário' style="min-width: 110px;">Nome</th>
                                                    <th title='Telefone do Usuário' style="min-width: 110px;">Telefone</th>
                                                    <th title='Email de contato'>email</th>
                                                    <th title='Email de contato'>Municípios Atendidos</th>
                                                </tr>
                                                <?php
                                                foreach ($dados as $key => $value) {
                                                    print "<tr>";
                                                    print "<td>" . $value['rpm'] . "</td>";
                                                    print "<td>" . $value['dep_avancado'] . "</td>";
                                                    print "<td>" . $value['num_masp'] . "</td>";
                                                    print "<td>" . $value['posto'] . "</td>";
                                                    #print "<td>" . $value['nome']. "</td>";
                                                    print "<td>" . ($value['desc_funcao'] == 'Agente Regional de DC' ? "<a href='" . FuncaoBase::geraLink('index', 'index', 'lista_munic_reg_site', array('id_rpm' => $value['id_rpm'], 'nome' => $value['nome'])) . "' title='Municipios Relativos a àrea de atuação do Agente Regional'>" . $value['nome'] : $value['nome']) . "</td>";
                                                    print "<td>" . $value['telefone'] . "<br>" . $value['celular'] . "</td>";
                                                    print "<td>" . $value['email_rec'] . "<br>".$value['email2']."</td>";
                                                    print "<td> <a href='" . FuncaoBase::geraLink('index', 'index', 'lista_munic_reg_site', array('id_rpm' => $value['id_rpm'], 'nome' => $value['nome'])) . "' title='Municipios Relativos ao Agente Regional'><img src='/core/imagem/listagem.png'></a></td>";
                                                    print "</tr>";
                                                }
                                                ?>


                                            </table>    
                                            </div>
                                            </div>
                                            </body>
                                            </html>
                                            <script src="/js/jquery.js"></script>
                                            <script src="/js/bootstrap.js"></script>
                                            <script src="/js/jasny-bootstrap.js"></script>
