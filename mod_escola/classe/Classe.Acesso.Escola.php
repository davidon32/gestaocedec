<?php

 
 /**	
  * @param Classe para Controle de Acesso de Usuários do Modulo Escola
  * 
  * 
  * 
  **/
class AcessoEscola {
				
		function acessoMenu($_login) {
			
			$sql = 'SELECT login,
			        cadastro,
			        consulta,
			        cad_professor,
			        cad_curso,
			        cad_materia,
			        cad_aluno,
			        cad_turma
			        FROM esc_permissao WHERE login ="'.$_login.'"';
			
			//print $sql;
			
			$result = mysql_query($sql) or die (mysql_error());
			
			$linha = mysql_fetch_array($result);
			
			//FuncaoBase::vd($linha);
			
			if($linha['cadastro'] == 1){
				print "<li class=\"dropdown-submenu\">
					       <a href=\"#\" title=\"Cadastros em Geral \">Cadastro</a>
					       <ul class=\"dropdown-menu\">";
					       
                           if($linha['cad_professor'] == 1) {
					           print "<li class=\"dropdown-submenu\">
					                   <a href=\"#\" title=\"Cadastro de Professor\">Professor</a>
					                   <ul class=\"dropdown-menu\">
					       		          <li><a href=\"secao.php?secao=professor&acao=cadastrar\" title=\"Cadastrar Professor\">Cadastrar</a></li>
					       		          <li><a href=\"secao.php?secao=professor&acao=pesquisarAlterar\" title=\"Alterar Cadastro de Professor\">Alterar</a></li>
					       		       </ul>
					       		       </li>";
                           }
                           if($linha['cad_curso'] == 1) {  
                               print "<li class=\"dropdown-submenu\">
                                        <a href=\"#\" title=\"Cadastro de Curso\">Curso</a>
                                       <ul class=\"dropdown-menu\">
                                          <li><a href=\"secao.php?secao=curso&acao=cadastrar\" title=\"Cadastrar Curso\">Cadastrar</a></li>
                                          <li><a href=\"secao.php?secao=curso&acao=pesquisarAlterar\" title=\"Alterar Cadastro de Curso\">Alterar</a></li>
                                       </ul>
                                       </li>"; }
                           if($linha['cad_materia'] == 1) {  
                               print "<li class=\"dropdown-submenu\">
                                        <a href=\"#\" title=\"Cadastro de Materia\">Materia</a>
                                       <ul class=\"dropdown-menu\">
                                          <li><a href=\"secao.php?secao=materia&acao=cadastrar\" title=\"Cadastrar Materia\">Cadastrar</a></li>
                                          <li><a href=\"secao.php?secao=materia&acao=pesquisarAlterar\" title=\"Alterar Cadastro de Materia\">Alterar</a></li>
                                       </ul>
                                       </li>";}
                           if($linha['cad_aluno'] == 1) {  
                               print "<li class=\"dropdown-submenu\">
                                        <a href=\"#\" title=\"Cadastro de Aluno\">Aluno</a>
                                       <ul class=\"dropdown-menu\">
                                          <li><a href=\"secao.php?secao=aluno&acao=cadastrar\" title=\"Cadastrar Aluno\">Cadastrar</a></li>
                                          <li><a href=\"secao.php?secao=aluno&acao=pesquisarAlterar\" title=\"Alterar Cadastro de Aluno\">Alterar</a></li>
                                       </ul>
                                       </li>";}
                           if($linha['cad_turma'] == 1) {  
                               print "<li class=\"dropdown-submenu\">
                                        <a href=\"#\" title=\"Cadastro de Turma\">Turma</a>
                                       <ul class=\"dropdown-menu\">
                                          <li><a href=\"secao.php?secao=turma&acao=cadastrar\" title=\"Cadastrar Turma\">Cadastrar</a></li>
                                          <li><a href=\"secao.php?secao=turma&acao=pesquisarAlterar\" title=\"Alterar Cadastro de Turma\">Alterar</a></li>
                                       </ul>
                                       </li>";}
				       print "</ul></li>";
					
				}
            
				
				#@ cadastro de motorista
				if($linha['consulta'] == 1){
				
					print "<li class=\"dropdown\">
					<a href=\"#\">Consulta/Relatório</a>
				            	<ul class=\"dropdown-menu\">
				            		<!--<li><a href=\"secao.php?secao=pagamento&acao=pagar\">Professor</a></li>-->
					            	
				            	</ul>
			            	</li> ";
						
				}
				
                                
                
		}
	
}?>