<?php 
	$path= PATH."\mod_decreto\\";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<style type="text/css">

	body{
			/*width-max: 700px; */
			color: #FFFFFF;
			font-family: tahoma;
			background: url("/mod_decreto/image/image_bol/fdo.png");

			
	}

	#titulo {
		min-height: 100px;
		background: url("/mod_decreto/image/image_bol/bg_pg.png");
		background-size: 100%;
		text-align: center;
		
	}

	#titulo_1-1{
		font-size: 30px;
	}
	#titulo_1-2{
		font-size: 20px;
	}

	#container {
		max-width: 700px;
		height: auto;
		margin: 0 auto;
	}

	.bg{
		background: url("/mod_decreto/image/image_bol/bg_pg.png");
	}
	#header {
		background: url("/mod_decreto/image/image_bol/header.png");
		background-repeat: no-repeat;
		width: 100%;
		text-align: center;
	}
	#header_logo_cedec{
		width: 60px;
		margin-left: 50px;
		margin-top: 20px;
	}
	#header_logo_gmg{
		width: 140px;
		margin-left: 10px;
		margin-top: -50px;
		vertical-align: center;

	}

	#bl_1{
		margin: 0px;
		width: 100%;
		min-height: 260px;
		background: url("/mod_decreto/image/image_bol/bg_pg.png");
		background-size: 100%;
	}

	#bl_1_previsao{
		margin-top: 5px;
		margin-left: 10px;
		float: left;
		min-width: 300px;
		height: auto;
		background: url("/mod_decreto/image/image_bol/bl_1_previsao.png") no-repeat;
		background-size: 100%;
	}

	#bl_1_div_img_previsao{
		width: 150px;
		vertical-align: top;
		float: left;
	}

	#bl_1_div_img_previsao, img{
		width: 150px;
		margin: 5px;

	}

	#bl_1_div_texto_previsao{
		width: 170px;
		margin: 5px;
		min-height: 210px;
		float: right;
		font-size: 10px;
		text-align: justify;
		vertical-align: top
	}

	#bl_1_climatempo{
		width: 150px;
		display: block;
	}
	#bl_1_s2id{
		margin-top: 5px;
		margin-right: 10px;
		min-width: 300px;
		min-height: auto;
		background: url("/mod_decreto/image/image_bol/bl_1_s2id.png") no-repeat;
		float: right;
		background-size: 100%;
		background-size:cover;
	}

	#bl_1_div_img_decretacao{
		min-width: 300px;
		height: auto;
		text-align: center;

	}

	#bl_1_img_decretacao {
		width: 255px;

	}
	
	.bl_1_img{
		text-align: center;
	}



	#bl_2{

		width: 100%;
		margin: 0px;
		width: 100%;
		min-height: 210px;
		background: url("/mod_decreto/image/image_bol/bg_pg.png");
		background-size: 100%;
		
	}

	#bl_2_chuva{
		background: url("/mod_decreto/image/image_bol/bl_3_chuva.png") no-repeat;
		background-size: 100%;
		background-position: center right;
		float: left;
		min-width: 245px;
		height: auto;
		margin-left: 40px;

	}
	

	#bl_2_chuva_div {
		margin: 10px;

	}
	#bl_2_chuva_img {
		margin-top: -10; 
		text-align: center;
		position: relative;


	}

	#span1_chuva{
		position: absolute;
		top: 120px;
  		right: 30px;
		font-size: 10px;
	}

	#span2_chuva{
		position: absolute;
		top: 145px;
  		right: 45px;
		font-size: 10px;
	}

	#bl_2_seca{
		background: url("/mod_decreto/image/image_bol/bl_3_chuva.png") no-repeat;
		float: right;
		min-width: 245px;
		height: auto;
		background-size: 100%;
		margin-right: 50px;
	}
	#bl_2_seca_div {
		margin: 10px;

	}
	#bl_2_seca_img {
		text-align: center;
		position: relative;

	}

	#bl_2_img_img{

	}

	#span1_seca{
		position: absolute;
		top: 120px;
  		right: 30px;
		font-size: 10px;
	}

	#span2_seca{
		position: absolute;
		top: 25px;
  		right: 15px;
		font-size: 10px;
	}

	/*     */
	
	#bl_3{
		width: 100%;
		margin: 0px;
		width: 100%;
		min-height: 250px;
		background: url("/mod_decreto/image/image_bol/bg_pg.png");
		background-size: 100%;
	}

	#bl_3_outros{
		background: url("/mod_decreto/image/image_bol/bl_3_chuva.png") no-repeat;
		background-size: 100%;
		float: left;
		min-width: 245px;
		height: 211px;
		margin-top: 10px;
		margin-left: 40px;

	}

	#bl_3_outros_div {
		margin: 10px;
	}
	#bl_3_outros_img {
		text-align: center;
		position: relative;
	}

	#bl_3_outros_img_img{
		width: 120px;

	}

	#span1_outros{
		position: absolute;
		top: 120px;
  		right: 30px;
		font-size: 10px;
	}

	#span2_outros{
		position: absolute;
		top: 20px;
  		right: 25px;
		font-size: 10px;
	}

	#bl_3_hidro{
		background: url("/mod_decreto/image/image_bol/bl_3_chuva.png") no-repeat;
		float: left;
		min-width: 245px;
		height: 211px;
		background-size: 100%;
		margin-top: 10px;
		margin-left: 120px;
	}

	#bl_3_hidro_div {
		margin: 10px;
	}
	#bl_3_hidro_img {
		text-align: center;
		position: relative;
	}

	#span1_hidro{
		position: absolute;
		top: 140px;
  		right: 20px;
		font-size: 10px;
	}

	#span2_hidro{
		position: absolute;
		top: 15px;
  		right: 20px;
		font-size: 10px;
	}

	

	.titulo1 {
		margin: 10px 0 0 5px;	
	}

	.titulo2 {
		margin-top:5px;	
		font-size: 12px;
		font-weight: bold;
		text-align: center;
	}

	#bl_rodape{
		text-align: center;
		background: url("/mod_decreto/image/image_bol/rodape.png");
		min-height: 81px;
	}
	#bl_impressao{
		text-align: left;
		background: url("/mod_decreto/image/image_bol/impressao.png") no-repeat;
		min-height: 81px;	
	}
</style>
<body>
<div id="container">
	<div id="header">
		<a href="http://www.defesacivil.mg.gov.br"><img id="header_logo_cedec" src="/mod_decreto/image\image_bol/logo_cedec.png"></a>
		<a href="http://www.gabinetemilitar.mg.gov.br"><img id="header_logo_gmg" src="/mod_decreto/image\image_bol/logo_gmg.png"></a>
	</div>
	<div id="titulo">
		<span id="titulo_1-1">BOLETIM ESTADUAL</span><br>
		<span id="titulo_1-2">DE PROTEÇÃO E DEFESA CIVIL</span>
	</div>
	<div id="bl_1">
		<div id="bl_1_previsao">
			<div class="titulo1">PREVISAO METEOROLÓGICA</div>	
			<div id="bl_1_div_img_previsao">
				<a href="http://www.inmet.gov.br"><img src="/mod_decreto/image\image_bol/img_boletim/boletim305.gif" width=""
						title="Verifique a previsão Completa do Tempo no Site do INMET"></a>
				<a href="http://www.clipatempo.com.br"><img src="/mod_decreto/image\image_bol/climatempo_site.png" 
						title="Verifique a previsão Completa do Tempo no Site do Climatempo"></a>
			</div>

			<div id="bl_1_div_texto_previsao">
				Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
			</div>
		</div>

		<div id="bl_1_s2id">
			<div class="titulo1">DECRETAÇÃO FEDERAL</div>	
			<div id="bl_1_div_img_decretacao">
				<a href="https://s2id.mi.gov.br"><img id="bl_1_img_decretacao" src="/mod_decreto/image\image_bol/s2id_animado.gif" width=""
						title="No site do Ministério da Integração é possível ver a Situação dos Decretos Federais em Tudo nosso Estado !"></a>
			</div>
		</div>
	</div>
	<div style="clear: both;"></div>

	<div id="bl_2">
		<div id="bl_2_chuva">
			<div class="titulo2">PERÍODO CHUVOSO 2017/2018</div>	
			<div id="bl_2_chuva_img">
				<img src="/mod_decreto/image\image_bol\animated\rainy-1.svg" width="">
					<span id="span1_chuva">Estado de Calamidade Pública (ECP)</span>
					<span  id="span2_chuva">Situação de Emergência (ECP)</span>
			</div>
				
		</div>
		<div id="bl_2_seca">
			<div class="titulo2">PERÍODO ESTIAGEM 2017/2018</div>	
			<div id="bl_2_seca_img">
				<img id="bl_2_img_img" src="/mod_decreto/image\image_bol\animated\day.svg" width="">
				<span id="span1_seca">Estado de Calamidade Pública (ECP)<span>
				<span id="span2_seca">Situação de Emergência (ECP)<span>
			</div>
				
		</div>
	</div>
	<div style="clear: both;"></div>

	<div id="bl_3">
		<div id="bl_3_outros">
			<div class="titulo2">OUTROS DESASTRES 2017/2018</div>	
			<div id="bl_3_outros_img">
				<img id="bl_3_outros_img_img" src="/mod_decreto/image\image_bol\acidentesQuimicos.png" width="">
				<span id="span1_outros">Estado de Calamidade Pública (ECP)<span>
				<span id="span2_outros">Situação de Emergência (ECP)<span>
			</div>
				
		</div>
		<div id="bl_3_hidro">
			<div class="titulo2">HIDROLÓGICO,GEOLÓGICO<br> E METEOROLÓGICO 2017</div>	
			<div id="bl_3_hidro_img">
				<img id="bl_3_hidro1_img" src="/mod_decreto/image\image_bol\animated\weather.svg" width="">
				<span id="span1_hidro">Estado de Calamidade Pública (ECP)<span>
				<span id="span2_hidro">Situação de Emergência (ECP)<span>
			</div>
				
		</div>
	</div>
	<div style="clear: both;"></div>
	<div id="bl_rodape">
	</div>
	<div id="bl_impressao">
			<a href="#" title="Clique aqui para a versao de impressão do Boletim">
				<div id="link"><br><br></div>
			</a>
	</div>
</div>

<!--<iframe style="clip: rect(300px, 300px, 300px, 100px);" src="https://s2id.mi.gov.br/"></iframe>-->



</body>
</html>