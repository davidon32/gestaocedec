<?php

	class Cquery{
		
		function Sel($a){
			
			$sql = $a;

			$result = mysql_query($sql);
			
			$linha = mysql_fetch_row($result);
			
			return $linha;
						
			
		}
		
	}
?>