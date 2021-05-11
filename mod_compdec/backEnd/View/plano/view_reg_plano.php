<?php $id_session = session_id();
    if(empty($id_session)) session_start();
    
    include_once $_SERVER['DOCUMENT_ROOT'].'/include.php';
    
    $plano = new Plano();

    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    
    $id = isset($_GET['id']) ? $_GET['id'] : "";

    if($acao = 'conhencimento'){

        $dados = $plano->getViasAcesso($id);
  
        print "<table class=\"table table-bordered plano\" id=\"vias_de_acesso\">
							<tr>
								<th colspan=\"4\" class=\"text-center\">Vias de Acesso ao Município</th>
                            </tr>";
        print "<tr>
        <th colspan=\"2\" class=\"text-center\" width=\"50%\">Nomes dos Municípios Próximos</td>
        <th class=\"text-center\" colspan=\"2\" width=\"50%\">Acesso</td>
        </tr>";                    
        
        
        foreach ($dados as $key => $value) {
           print "<tr>";
           print "<td width=\"5%\">".($key+1)."</td>";
           print "<td class=\"text-center editavel\" width=\"40%\">".$value['mun_proximo']."</td>";
           print "<td class=\"text-center editavel\" width=\"40%\">".$value['acesso']."</td>";
           print "<td width=\"15%\"><button class=\"btn\" onclick=\"AddViasdeAcesso()\" type=\"button\" title=\"Adicionar Linha\"><span class=\"glyphicon glyphicon-plus\" aria-hidden=\"true\"></span></button>
                    <button class=\"btn\" onclick=\"GravaViasdeAcesso()\" type=\"button\" title=\"Gravar Alteração\"><span class=\"glyphicon glyphicon-floppy-save\" aria-hidden=\"true\"></span></button>
                    <button class=\"btn\" onclick=\"RemoverViasAcesso()\" type=\"button\" title=\"Deletar Registro\"><span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span></button>
           
           </td>";
           print "</tr>";
        }
        print "</table>";
  
      }
  


?>