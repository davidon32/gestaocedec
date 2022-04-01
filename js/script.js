
    // JavaScript Document
    // FUNÇÃO RESPONSÁVEL DE CONECTAR A UMA PAGINA EXTERNA NO NOSSO CASO A BUSCA_NOME.PHP
    // E RETORNAR OS RESULTADOS
     
    function ajax(url)
    {
     
    //alert(nick);
    //alert(dest);
    //alert(msg);
     
    req = null;
    // Procura por um objeto nativo (Mozilla/Safari)
    if (window.XMLHttpRequest) {
    req = new XMLHttpRequest();
    req.onreadystatechange = processReqChange;
    req.open("GET",url,true);
    req.send(null);
    // Procura por uma versão ActiveX (IE)
    } else if (window.ActiveXObject) {
    req = new ActiveXObject("Microsoft.XMLHTTP");
    if (req) {
     
    req.onreadystatechange = processReqChange;
    req.open("GET",url,true);
     
    req.send();
    }
    }
    }
     
    function processReqChange()
    {
     
    // apenas quando o estado for "completado"
    if (req.readyState == 4) {
     
    // apenas se o servidor retornar "OK"
     
    if (req.status ==200) {
     
    // procura pela div id="pagina" e insere o conteudo
    // retornado nela, como texto HTML
     
    document.getElementById('pagina').innerHTML = req.responseText;
     
    } else {
    alert("Houve um problema ao obter os dados:n" + req.statusText);
    }
    }
    } 



/**
 * Number.prototype.format(n, x, s, c)
 * 
 * @param integer n: length of decimal
 * @param integer x: length of whole part
 * @param mixed   s: sections delimiter
 * @param mixed   c: decimal delimiter
 */
Number.prototype.format = function(n, x, s, c) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
        num = this.toFixed(Math.max(0, ~~n));

    return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
};


function dataForm(data){
    
    var dia = data.substring(0, 2);
    var mes = data.substring(3, 5);
    var ano = data.substring(6, 10);
    
    return ano+"-"+mes+"-"+dia;
    
}


function dataVisual(data){ 
    var ano = data.substring(0, 4);
    var mes = data.substring(5, 7);
    var dia = data.substring(8, 10);
    
    return dia+"/"+mes+"/"+ano;  
}

function geraLink(){
    
}

function checkmobile(){
    const toMatch = [
        /Android/i,
        /webOS/i,
        /iPhone/i,
        /iPad/i,
        /iPod/i,
        /BlackBerry/i,
        /Windows Phone/i
    ];
    
    return toMatch.some((toMatchItem) => {
        return navigator.userAgent.match(toMatchItem);
        console.log(navigator.userAgent.match(toMatchItem));
    });
}



