
/* CORRETA MASCARA COM DATA */
jQuery(function(){
    jQuery(".mask-data").mask("99/99/9999"); //data
    jQuery(".mask-hora").mask("99:99"); //hora
    jQuery(".mask-fone").mask("(99)9999-9999"); //telefone
    jQuery(".mask-cep").mask("99999-999");
    jQuery(".mask-rg").mask("99.999.999-9"); //RG
    jQuery(".mask-cpf").mask("999.999.999-99");
    jQuery(".mask-cnpj").mask("99.999.999/9999-99");
    jQuery(".mask-pis").mask("9.999.999.999-9");
    jQuery(".mask-inscr").mask("999.999.999.999");
    jQuery(".mask-placa").mask("aaa-9999");
    jQuery(".mask-ano").mask("9999");
    jQuery(".mask-hora").mask("99:99");
});

/*
 * PROBLEMA COM MASCARA COM DATA
jQuery.noConflict();
(function($) {
$(function() {
$('.mask-data').mask('99/99/9999'); //data
$('.mask-hora').mask('99:99'); //hora
$('.mask-fone').mask('(99)9999-9999'); //telefone
$('.mask-rg').mask('99.999.999-9'); //RG
$('.mask-ag').mask('9999-9'); //Agência
$('.mask-ag').mask('9.999-9'); //Conta
$('.placa').mask('aaa-9999');
$('.cep').mask('99999-999');//cep
$('.cpf').mask('999.999.999-99');
$('.cnpj').mask('99.999.999/9999-99');
$('.pis').mask('9.999.999.999-9');
});
})(jQuery);

*/
