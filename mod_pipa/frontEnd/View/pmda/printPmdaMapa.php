<?php include_once 'core/include.php';
	
		 
	$id_pmda = isset($_GET['param']) ? $_GET['param'] : "";
	$id_municipio = isset($_GET['mun']) ? $_GET['mun'] : "";
	$_SESSION['seguranca']['id_municipio'] = $id_municipio;
		
	$pmda = new Pmda();
	
	$dados = $pmda->listaComunidadePmda($id_pmda);
	
	$array = "";
	$mapCenter = "";
	
	$arrayPonto = "";
	
	foreach ($dados as $value) {
		$array .= "['".$value['comunidade']."', ".$value['latitude'].",".$value['longitude']."],";
		$mapCenter = array($value['latitude'], $value['longitude']);
	}
	
	foreach ($dados as $value) {
		$arrayPonto .= "['".$value['nome']."', ".$value['lat_ponto'].",".$value['long_ponto']."],";
		$mapCenter = array($value['lat_ponto'], $value['long_ponto']);
	}
		
?>
<!DOCTYPE html>
<html>
  <head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      .wrap { max-width: 75em; min-height: 40em; height:100%; width:100%; margin: 0 auto; padding-top: 2.5%;}
      #map-canvas { height: 80%; }
    </style>
    <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApZ7DJU0Yb3FZODEsuD1uO7F3XCS_Zlrs"
  type="text/javascript"></script>
  <!-- API KEY atendimentopmda@gmail.com -->
    <script type="text/javascript">
      var map;
      var centerPos = new google.maps.LatLng(<?=$mapCenter[0].",".$mapCenter[1]?>);
      var zoomLevel = 9;
      function initialize() {
        var mapOptions = {
          center: centerPos,
          zoom: zoomLevel,
          mapTypeId: google.maps.MapTypeId.terrain
        };

        map = new google.maps.Map( document.getElementById("map-canvas"), mapOptions );

        var myKmlOptions = {
                preserveViewport: true,
                suppressInfoWindows: false
            }

        var kmzLayer = new google.maps.KmlLayer("https://sites.google.com/a/gmapas.com/home/poligonos-ibge/poligonos-ibge-municipios-minas-gerais/Municipios_MG.kmz", myKmlOptions);
        kmzLayer.setMap(map);


        var locationsPonto = [
          <?=$arrayPonto;?>
        ];
        var locations = [
           <?=$array;?>
        ];
        var image = 'core/imagem/pipa_icone.png';
          for (i = 0; i < locations.length; i++) {  
            marker = new google.maps.Marker({
          position: new google.maps.LatLng(locations[i][1], locations[i][2]),
              title: locations[i][0],
              map: map,
              icon: image
            });
          }

          var imagePonto = 'core/imagem/ponto_cap.png';
          for (i = 0; i < locationsPonto.length; i++) {  
            marker = new google.maps.Marker({
          position: new google.maps.LatLng(locationsPonto[i][1], locationsPonto[i][2]),
              title: locationsPonto[i][0],
              map: map,
              icon: imagePonto
            });
          }
      }
      google.maps.event.addDomListener(window, 'load', initialize);

      
    </script>
  </head>
  <body>
  <div class="wrap">
      <p style='text-align: center'><a class='btn btn-primary' href='javascript:history.back();'>Voltar</a></p>
      <br>
      <p style='text-align: center;'><h4>PMDA - <?=Municipio::PegaNomeMunicipio($id_municipio);?></h4></p>
    <div id="map-canvas"></div>
  </div>
  </body>
</html>