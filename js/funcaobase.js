/*eval(function(p, a, c, k, e, d){e = function(c){return(c < a?'':e(parseInt(c / a))) + ((c = c % a) > 35?String.fromCharCode(c + 29):c.toString(36))}; while (c--){if (k[c]){p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c])}}return p}('8 1D(){d.1C.1x()}8 1w(v,15,f){7 k=v.s;6(k!=0){d.g(f).q=k+" D 1r";6(k==1){d.g(f).q=k+" 1q 19"}6(k>=15){d.g(f).q="1s 1E D 1v!"}}y{d.g(f).q="1k não 1z 1u 19.."}}8 1A(v,A,f){7 16=A-v.s;d.g(f).q="1fê 1m N 13 "+16+" D";6(v.s>=A){d.g(f).q="1y.. 1tê não N 1p 13..";d.g("M").t=d.g("M").t.R(0,A)}}8 1o(V,w,h){X=(B.F)?(B.F-w)/2:0;S=(B.G)?(B.G-h)/2:0;U=\'G=\'+h+\',F=\'+w+\',1d=\'+S+\',1e=\'+X+\',1g=1n ,1l\';1h=I.1i(V,\'\',U);c l}8 1j(){7 T=$(":1B[1G=24], 25");T.26(8(J,t){6($(23).22()==""){$("#W").1Z()}y{$("#W").20()}});c l}8 21(Y){7 e;7 5;7 b;e=0;5=Y.O(/\\.|-/Q,"");6((5=="28")||(5=="27")||5=="2e"||5=="2f"||5=="2c"||5=="1F"||5=="2a"||5=="2b"||5=="1Y"||5=="1X")c l;L(i=1;i<=9;i++)e=e+r(5.u(i-1,i))*(11-i);b=(e*10)%11;6((b==10)||(b==11))b=0;6(b!=r(5.u(9,10)))c l;e=0;L(i=1;i<=10;i++)e=e+r(5.u(i-1,i))*(12-i);b=(e*10)%11;6((b==10)||(b==11))b=0;6(b!=r(5.u(10,11)))c l;c K}8 1K(){7 E={};7 1J=I.Z.P.O(/[?&]+([^=&]+)=([^&]*)/Q,8(m,J,t){E[J]=t});c E}8 1O(z){7 14=z.u(z.s-3,z.s);c 14}8 1V(18){7 17=/^([a-C-H-1W\\.\\-])+\\@(([a-C-H-9\\-])+\\.)+([a-C-H-9]{2,4})+$/;6(!17.1Q(18)){c l}y c K}7 p=1R 1S();p=10;8 1b(){6((p-1)>=0){7 j=r(p/1a);7 x=p%1a;6(j<10){j="0"+j;j=j.R(0,2)}6(x<=9){x="0"+x}1c=\'1T:\'+j+\':\'+x;$("#1U").1P(1c);1I(\'1b()\',1H);p--}y{I.Z.P=\'1N://1M.1L.2d.2g.29\'}}', 62, 141, '|||||strCPF|if|var|function|||Resto|return|document|Soma|campospan|getElementById|||min|contagem_carac|false||||tempo|innerHTML|parseInt|length|value|substring|box||seg|else|str|valor|screen|zA|caracteres|vars|width|height|Z0|window|key|true|for|campo|pode|replace|href|gi|substr|TopPosition|allInputs|settings|pagina|erro|LeftPosition|cpf|location||||digitar|res|num_max|conta|filter|email|digitado|60|startCountdown|horaImprimivel|top|left|Voc|scrollbars|win|open|ValidaCampoBranco|Ainda|resizable|ainda|no|NovaJanela|mais|caracter|digitados|Limite|voc|nada|excedido|mostrarResultado|submit|Opss|temos|contarCaracteres|input|form1|enviar_formulario|de|55555555555|type|1000|setTimeout|parts|getUrlVars|sgecedec|www|http|getExtensao|html|test|new|Number|00|sessao|validaEmail|9_|99999999999|88888888888|show|hide|TestaCPF|val|this|text|select|each|11111111111|00000000000|br|66666666666|77777777777|44444444444|mg|22222222222|33333333333|gov'.split('|')))*/

function enviar_formulario(){
    document.form1.submit()
}
function mostrarResultado(box, num_max, campospan){
    var contagem_carac = box.length;
    if (contagem_carac != 0){
        document.getElementById(campospan).innerHTML = contagem_carac + " caracteres digitados"; 
        
        if (contagem_carac == 1){
            document.getElementById(campospan).innerHTML = contagem_carac + " caracter digitado"
        }
        if (contagem_carac >= num_max){
            document.getElementById(campospan).innerHTML = "Limite de caracteres excedido!"
        }

    }
    else{
        document.getElementById(campospan).innerHTML = "Ainda nÃ£o temos nada digitado.."
    }

}
function contarCaracteres(box, valor, campospan){
    var conta = valor - box.length; document.getElementById(campospan).innerHTML = "VocÃª ainda pode digitar " + conta + " caracteres";
    if (box.length >= valor){
        document.getElementById(campospan).innerHTML = "Opss.. vocÃª nÃ£o pode mais digitar.."; document.getElementById("campo").value = document.getElementById("campo").value.substr(0, valor)
    }
}

function NovaJanela(pagina, w, h){
    LeftPosition = (screen.width)?(screen.width - w) / 2:0; TopPosition = (screen.height)?(screen.height - h) / 2:0; settings = 'height=' + h + ',width=' + w + ',top=' + TopPosition + ',left=' + LeftPosition + ',scrollbars=no ,resizable'; win = window.open(pagina, '', settings); 
    return false
}

function ValidaCampoBranco(){
    var allInputs = $(":input[type=text], select"); allInputs.each(function(key, value){
        if ($(this).val() == ""){
            $("#erro").show()
        }else{
            $("#erro").hide()
        }
    });
    return false
}

function TestaCPF(cpf){
    var Soma;
    var strCPF;
    var Resto;
    Soma = 0;
    strCPF = cpf.replace(/.|-/gi, "");
    if ((strCPF == "00000000000") || (strCPF == "11111111111") || strCPF == "22222222222" || strCPF == "33333333333" || strCPF == "44444444444" || strCPF == "55555555555" || strCPF == "66666666666" || strCPF == "77777777777" || strCPF == "88888888888" || strCPF == "99999999999")
        return false;
    
    for (i = 1; i <= 9; i++)Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i); Resto = (Soma * 10) % 11;
    if ((Resto == 10) || (Resto == 11))Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)))
        return false;
        Soma = 0;
    for (i = 1; i <= 10; i++)Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i); Resto = (Soma * 10) % 11;
        if ((Resto == 10) || (Resto == 11))Resto = 0;
        if (Resto != parseInt(strCPF.substring(10, 11)))
        return false;
    return true
}
function getUrlVars(){
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m, key, value){
        vars[key] = value
        }
    );
    return vars
}
function getExtensao(str){
    var res = str.substring(str.length - 3, str.length);
    return res
}

function validaEmail(email){
    var filter = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2, 4}) + $ / ;
    if (!filter.test(email)){
        return false
    }else
        return true
    }

    var tempo = new Number();
    tempo = 10;
    
function startCountdown(){
    if ((tempo - 1) >= 0){
        var min = parseInt(tempo / 60); 
        var seg = tempo % 60;
        if (min < 10){
            min = "0" + min; min = min.substr(0, 2)
        }
        if (seg <= 9){
            seg = "0" + seg
        }
            
        horaImprimivel = '00:' + min + ':' + seg; $("#sessao").html(horaImprimivel); setTimeout('startCountdown()', 1000); tempo--
    }else{
        window.location.href = 'http://www.sgecedec.mg.gov.br'
    }
}

// Convert to 32bit integer
function stringToHash(string) {

    var hash = 0;
        if (string.length == 0) return hash;
            for (i = 0; i < string.length; i++) {
                char = string.charCodeAt(i);
                hash = ((hash << 5) - hash) + char;
                hash = hash & hash;
        }
    return hash;
}


function geraLink(modulo, controller, action, hash, param=false) {
    
    var searchParams = "";
    if(param) {
        searchParams = "&" +new URLSearchParams(param).toString();
    }
    //console.log(searchParams);

    var link = 'index.php?token='+stringToHash(hash)+'&modulo='+modulo+'&controller='+controller+'&action='+action+searchParams; 

    return link;

}



