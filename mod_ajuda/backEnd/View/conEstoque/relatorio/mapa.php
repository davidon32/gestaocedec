<?php include_once 'core/include.php';
?>

<?php


$post = isset($_POST) ? $_POST :"";
$icone = '/core/imagem/maps30.png';
//var_dump($post);
$voltar = "<p style='text-align: center'><a class='button' href='?token=".hash('sha256', md5(VERSAO).date('dmY'))."&modulo=ajuda&controller=relatorio&action=buscamapa'>Voltar</a></p>";

if(empty($post)) {
    
  
  $data_final = date('d/m/Y');
  $post['id_deposito'] = "";
  $post['txtDtInicial'] = "01/10/2022";
  $post['txtDtFinal'] = $data_final;
  $post['id_municipio'] = "";
  //$post['sel_evento'] = "COVID-19";
  $post['sel_evento'] = "CHUVA";

  $icone = ''; //'/core/imagem/covid_40.png';

  $voltar = "";
  
  
    /* print "<label>Filtrar por Evento</label>
				<select class=\"form-control\" name=\"sel_evento\" id=\"sel_evento\">
					<option>Selecione o Evento</option>";

						print $evento = Material::EventoList();

						foreach ($evento as $key => $value) {
							print "<option>".$value['nome']."</option>";
						}
						
    			print "</select>"; */

  }else{
    
  }
  
 

 $municipios = Liberacao::buscaMunicipioLiberacaoMapa($post);

  if(empty($municipios)){

    print "Não existe resgistro para o filtro escolhido";

  }else {
  
  $dadosMapa = ""; 

  
  # quantidade de liberacoes
  $quantidade_liberacoes = Liberacao::liberacaoPorMunicipio($post);
  
  # materiais Liberados
  $material = Unidade::getIdNome();
  
  $dadosMun = "";


  
  foreach ($municipios as $value) {
    $lat = str_replace(",", ".", $value['LATITUDE']);
    $long = str_replace(",", ".", $value['LONGITUDE']);

    $materiais_liberados[] = Liberacao::totMaterialLiberadoMapa($value['id_municipio'], $post);
    
    
    $dadosMapa .= "['".$value['nome']."', '".$value['id_municipio']."', ".$lat.", ".$long.", ".json_encode($materiais_liberados).", '".$value['qtd_lib']."'],";
    
    $mapCenter = array($lat, $long);
  }
  
	
?>
<!DOCTYPE html>
<html>
  <head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { 
        height: 100%;
        margin: 0; padding: 0;
        background: url("/core/imagem/back.png");
        background-repeat: repeat;
        background-size: 50px, 50px;
        background-position: center;
        text-align: center;
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
       }
      .wrap { min-height: 40em; height:100%; width:100%; margin: 0 auto; padding-top: 1.5%;}
      #map-canvas { height: 95%; width: 100%; }
      .button {
          background-color: #008CBA;
          border: none;
          color: white;
          padding: 5px 5px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 16px;
          font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}
    </style>
    <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApZ7DJU0Yb3FZODEsuD1uO7F3XCS_Zlrs"
  type="text/javascript"></script>
  <!-- API KEY atendimentopmda@gmail.com -->
    <script type="text/javascript">
      var map;
      var centerPos = new google.maps.LatLng(<?=$mapCenter[0].",".$mapCenter[1]?>);
      var zoomLevel = 7;
      function initialize() {
        var mapOptions = {
          center: centerPos,
          zoom: zoomLevel,
          mapTypeId: google.maps.MapTypeId.ROADMAP 
        };

        map = new google.maps.Map( document.getElementById("map-canvas"), mapOptions );


        var locations = [
           <?=$dadosMapa;?>
        ];
        

        //console.log(locations);
        
        var image = '<?=$icone?>';
        //var image1 = 'core/imagem/covid.png';

          for (i = 0; i < locations.length; i++) {
              
            marker = new google.maps.Marker({
              position: new google.maps.LatLng(locations[i][2], locations[i][3]),
                  title: locations[i][0],
                  map: map,
                  icon: image,
                  label: {
                    text: locations[i][0],
                    color: "",
                    fontSize: "10px",
                    fontWeight: "bold"
                  },
                });
              

              var infowindow = new google.maps.InfoWindow();

              google.maps.event.addListener(marker, 'click', (function(marker, i) {
                  return function(){

                    var linha = "";
                     for (var j = 0; j < locations[i][4].length; j++) {

                       for (var k = 0; k < locations[i][4][j].length; k++) {

                          if(locations[i][4][j][k]['id_municipio'] == locations[i][1] ){
                            linha += "<tr><td>"+locations[i][4][j][k]['nome']+"</td><td>: "+locations[i][4][j][k]['qtd']+"</td></tr>";
                          } 
                       }
                      }
                      //console.log(linha);
                    
                    var contentString = '<div id="content">'+
                                      '<div id="siteNotice">'+
                                      '</div>'+
                                      '<h2 id="firstHeading" class="firstHeading">'+locations[i][0]+'</h2>'+
                                      '<div id="bodyContent"><table><tr><th colspan=\'2\'>Materiais de Ajuda H. Recebidos</th></tr>'+
                                      '<tr><td>Qtd Lib. Recebidas </td><td>: '+locations[i][5]+'</td></tr>'+
                                      linha
                                      +
                                      '</table></div>'+
                                      '</div>';
                  infowindow.setContent(contentString);
                  infowindow.open(map, marker);
                  }
              })(marker, i));
 

          }

          var myKmlOptions = {
                preserveViewport: true,
                suppressInfoWindows: false
          }
          //var kmzLayer = new google.maps.KmlLayer("https://sites.google.com/a/gmapas.com/home/poligonos-ibge/poligonos-ibge-municipios-minas-gerais/Municipios_MG.kmz", myKmlOptions);
          //kmzLayer.setMap(map);

          /* var myKmlOptions = {
                preserveViewport: true,
                suppressInfoWindows: true
          }
          */

          var minasCoords = [
{lat: -19.920383232438862,  lng: -51.00805721592139},
{lat: -19.21756887954398,   lng: -50.73324517362687},
{lat: -18.635600263792604,  lng: -50.17294243925187},
{lat: -18.46895377818306,   lng: -49.34896782987687},
{lat: -18.323005134931577,  lng: -48.75570611112687},
{lat: -18.46895377818306,   lng: -47.81088189237687},
{lat: -17.758913674047324,  lng: -47.23959282987687},
{lat: -16.427159525195346,  lng: -47.50923530214402},
{lat: -15.721712676469139,  lng: -46.85602621191117},
{lat: -15.03503388680934,   lng: -46.92791477792832},
{lat: -14.771478684856742,  lng: -46.47245959394547},
{lat: -15.288230583748435,  lng: -45.79321698301408},
{lat: -14.240808365795255,  lng: -44.25895051115128},
{lat: -14.866164558132198,  lng: -43.8271363174257},
{lat: -14.670877076596241,  lng: -43.227179804974526},
{lat: -15.214717983466,     lng: -41.76359490507218},
{lat: -15.875910173271356,  lng: -39.891112605267494},
{lat: -16.43453023198782,   lng: -40.18911675565812},
{lat: -17.546916710767036,  lng: -40.34567193143937},
{lat: -18.338648398354742,  lng: -41.18612603300187},
{lat: -19.89565530129049,   lng: -41.20809868925187},
{lat: -20.21549792553586,   lng: -41.41083077543347},
{lat: -20.21026251108545,   lng: -41.73441247099011},
{lat: -20.36467327457096,   lng: -41.83225945585339},
{lat: -20.61134485683443,   lng: -41.80822686307995},
{lat: -21.062484198768143,  lng: -42.14468316190808},
{lat: -21.37868650433169,   lng: -42.24630669706437},
{lat: -21.713346195072067,  lng: -42.41659478300187},
{lat: -21.87146458420437,   lng: -42.88900689237687},
{lat: -22.007764858145414,  lng: -43.327086726361244},
{lat: -22.072684374171907,  lng: -43.69924859159562},
{lat: -22.125489041405157,  lng: -44.01167229765031},
{lat: -22.229132176246118,  lng: -44.291137019329994},
{lat: -22.37524678548669,   lng: -44.79513482206437},
{lat: -22.613782039146407,  lng: -45.62460259550187},
{lat: -22.98850995404155,   lng: -46.25082329862687},
{lat: -22.5760625189566,    lng: -46.41561822050187},
{lat: -22.34540101407383,   lng: -46.66830376737687},
{lat: -21.433664434161045,  lng: -46.60238579862687},
{lat: -21.342875813337145,  lng: -46.97592095487687},
{lat: -20.298033068812515,  lng: -47.23959282987687},
{lat: -19.93180826131803,   lng: -47.59115532987687},
{lat: -19.98344099754484,   lng: -48.33822564237687},
{lat: -20.29288093993136,   lng: -49.08529595487687},
{lat: -19.92147968752846,   lng: -50.09603814237687},
{lat: -19.807983276793653,  lng: -50.50253228300187},
{lat: -19.992669563317172,  lng: -50.92565975498389}
];

          var mapaMinas = new google.maps.Polyline({
            path: minasCoords,
            geodesic: true,
            strokeColor: '#FF0000',
            strokeOpacity: 1.0,
            strokeWeight: 2
          });

          mapaMinas.setMap(map);
          //mapaMinas.setMap(covid);

          
      }
      google.maps.event.addDomListener(window, 'load', initialize);
      
      </script>
    <?php }?>
  </head>
  <body>
  <div class="wrap">
    <?=$voltar?>
      <span style='text-align: center'>Mapa de Distribuição de Material de Ajuda Humanitária <br> <!--<?=$post['txtDtInicial'];?> a <?=$post['txtDtFinal'];?>--></span>
    <div id="map-canvas"></div>
  </div>
  </body>
</html>