function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

//http://www.ribosomatic.com/articulos/ajax-php-mysql-consulta-de-registros/
function MostrarConsulta(datos){
    
    //alert("Hola1");
	divResultado = document.getElementById('marcas');
	ajax=objetoAjax();
	ajax.open("GET", datos);
	ajax.onreadystatechange=function() {
            //alert("Hola2");
		if (ajax.readyState==4) {
                    //alert("Hola3");
			divResultado.innerHTML = ajax.responseText
                      //  alert(ajax.responseText);
		}
	}
	ajax.send(null)
}