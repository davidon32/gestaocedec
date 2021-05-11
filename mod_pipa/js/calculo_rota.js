		function load(){
		
			//jQuery("#ck_trator").attr("checked",false);
			jQuery("#lb_trator").hide();
			jQuery("#trator").hide();
			
		}
			
	
		function vr_momento(){
			
			/*	regra de momento de viagem
			 * 	Estrada Pavimentada : 0.43
			 * Estrada mista Mais Pavimentada que Terra : 0.45
			 * Estrada mista Mais Terra que Pavimento : 0.47
			 * Estrada nao Pavimentada : 0.49
			 * Necessita de Reboque : 0.93
			 */
			
			//Estrada Pavimentada : 0.43
			if(jQuery("#asfalto").val() > 0 && jQuery("#terra").val() == 0){
				
				jQuery("#momento").val(0.43);
				jQuery("#m_des").val("Estrada Pavimentada");
			
			
			}
			//Estrada nao Pavimentada : 0.49
			if(jQuery("#terra").val() > 0 && jQuery("#asfalto").val() == 0){
			
				jQuery("#momento").val(0.49);
				jQuery("#m_des").val("Estrada nao Pavimentada");
			
			//Estrada mista Mais Pavimentada que Terra : 0.45
			}
			
			if(jQuery("#asfalto").val() > jQuery("#terra").val() && jQuery("#terra").val() > 0){
				
				jQuery("#momento").val(0.45);
				jQuery("#m_des").val("Estrada mista Mais Pavimentada que Terra");
			
			//Estrada mista Mais Terra que Pavimento : 0.47
			}
			
			if((jQuery("#asfalto").val() != 0) && (jQuery("#asfalto").val() < jQuery("#terra").val())){
				
				jQuery("#momento").val(0.47);
				jQuery("#m_des").val("Estrada mista Mais Terra que Pavimento");
			
			//Necessita de Reboque : 0.93
			}
			
			if(jQuery("#trator").val() > 0){
			
				jQuery("#momento").val(0.93);
				jQuery("#m_des").val("Necessidade de Trator / Reboque");
				
			
			}
			
		}
		
		function vr_trator() {
			
			if(jQuery("#ck_trator").is(":checked")){
				
				jQuery("#lb_asfalto").hide("slow");
				jQuery("#asfalto").hide("slow");
				jQuery("#lb_terra").hide("slow");
				jQuery("#terra").hide("slow");
				jQuery("#asfalto").val(null);
				jQuery("#terra").val(null);
				jQuery("#lb_trator").show("slow");
				jQuery("#trator").show("slow");
				jQuery("#km").val(0);
					
			}else if(jQuery("#ck_trator").attr("checked",false)){
				
				
				jQuery("#lb_asfalto").show("slow");
				jQuery("#asfalto").show("slow");
				jQuery("#lb_terra").show("slow");
				jQuery("#terra").show("slow");
				jQuery("#asfalto").val(0);
				jQuery("#terra").val(0);
				jQuery("#trator").val(null);
				jQuery("#lb_trator").hide("slow");
				jQuery("#trator").hide("slow");
				jQuery("#km").val(0);	
			}
			
	  
		}
		
		function distancia_trator(){
			jQuery("#km").val(jQuery("#trator").val());
			
		}
		
		function necessidade(){

			var nece_d = jQuery("#pop").val() * 20;			
			
			jQuery("#necessidade_d").val(nece_d);
			
			var nece_m = jQuery("#pop").val() * 20 * 30;
			
			jQuery("#necessidade_m").val(nece_m);
			
		}
		
		function nr_viagem(){
			
			var viagem = jQuery("#necessidade_m").val() / (jQuery("#capacidade").val() * 1000);
			
			jQuery("#n_viagem").val(Math.abs(viagem));
		}
		
		
		// calculo do valor final da rota PF
		function valorFinal(){
					
			var km = jQuery("#km").val();
			var momento = jQuery("#momento").val();
			var capacidade = jQuery("#capacidade").val();
			var viagem_real = jQuery("#viagem_real").val();
			var valor_rota = km * momento * capacidade * viagem_real;
			
			jQuery("#vr_rota").val(valor_rota);
			
		}
				
		/*jQuery(function() {
			jQuery('#vr_rota').priceFormat({
			prefix: 'RjQuery',
			centsSeparator: ',',
			thousandsSeparator: '.',
			centsLimit: 4			
			});
		});
		*/
		
		function casaDd() {
		  
		  jQuery('#necessidade_d').priceFormat({
			prefix: '',
			centsSeparator: ',',
			thousandsSeparator: '.',
			limit: 4,
			centsLimit: 3			
			});
		  
		}
		function casaDm() {
		  
		  jQuery('#necessidade_m').priceFormat({
			prefix: '',
			centsSeparator: ',',
			thousandsSeparator: '.',
			limit: 4,
			centsLimit: 3			
			});
		  
		}
		
		function distanciaTotal(){
			
			var dist_total = 0;
			
			var n_asfalto = Number(jQuery("#asfalto").val());
			
			var n_terra = Number(jQuery("#terra").val());
			
			var n_trator = Number(jQuery("#trator").val());
			
			if(jQuery("#trator").val() != 0) {
				
				dist_total = n_trator;
				
			}else {
				
				dist_total = n_asfalto + n_terra;
			} 
			
				
						
			jQuery("#km").val(dist_total);
			
			
		}
		
		function Confirmacao() {
			var resposta = confirm("Deseja Gerar os Valores ?");
			
			var valor = jQuery("#vr_rota").val();
			
			if (resposta == true && valor != 0){
				
				jQuery("#frm_calcula").submit();
				
				}else{
					
					alert('A "Data de Acerto" ou o "Valor da Rota" não pode Ficar em branco!');
				}
		}
		
		function removeVirgula(){
			
			var valor = jQuery("#vr_rota").val();
			
			valor = valor.replace( ",", "." );
			
			jQuery("#vr_rota").val(valor);
			
		}
		
