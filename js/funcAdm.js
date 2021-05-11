/* script javascript
 * 09/08/2017
 * mod_pipa\app\pmda\adm.php
 * 
 */
	
$(document).ready(function(){


			$("#btnConfirm").hide();
			$("#txtProtocolo").hide();


			$("#lk_alteracao").click(function(){
				$("#btnConfirm").show();
				$("#txtProtocolo").show();
			});
			$("#btnConfirm").click(function(){
				alert("ok");
			});


});


	