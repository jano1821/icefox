/*
_sumarRestarDias --------------- suma si le envias positivo y resta si le envias negativo
completaCaracterIzquierda ------ completa con el caracter enviado una cadena con la longitud enviada.
DateToStringDDMMYYYY------------ convierte una variable de tipo fecha a string con el formato dd/mm/yyyy
isEmpty ------------------------ comprueba si la variable esta vacia
myTrim ------------------------- quita los escacios en blanco de una cdena, si es indefinido o null igual devuelve cadena vacia
isDefined ---------------------- valida si la variable es diferente de undefined
validaLongitud ----------------- valida que la longitud de la cadena sea igual a la enviada como parametro
validaLongitudEntre ------------ valida que la cadena este entre las dos longitudes enviadas

*/

function checkKeyCode(evt)
{

var evt = (evt) ? evt : ((event) ? event : null);
var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
if(event.keyCode==116)
{
evt.keyCode=0;
return false
}
}
document.onkeydown=checkKeyCode;

function _sumarRestarDias(fecha,dias){
	var myDate = new Date(fecha);
	var dayOfMonth = myDate.getDate();
	myDate.setDate(dayOfMonth + dias);

	return DateToStringDDMMYYYY(myDate);
}

function completaCaracterIzquierda(numero, caracter, length) {
    var  cadena = numero.toString();
    while(cadena.length < length)
         cadena = caracter + cadena;
return cadena;
}

function DateToStringDDMMYYYY(myDate){
	return (completaCaracterIzquierda(myDate.getDate(),"0",2)+"/"+completaCaracterIzquierda((myDate.getMonth()+1),"0",2)+"/"+myDate.getFullYear());
}

function isEmpty(valor){
	return (valor==undefined || valor == null || myTrim(valor)=='');
}

function myTrim(x) {
	if(x==undefined)
		return '';
	if(x==null)
		return '';
    return x.replace(/^\s+|\s+$/gm,'');
}

function isDefined(variable) {
    return eval('typeof ' + variable + ' != "undefined"');
}

function validaLongitud(valor, tamanio){
	if(isEmpty(valor)){
		return false;
	}
	if(valor.length!=tamanio){
		return false;
	}
	return true;
}
function validaLongitudEntre(valor, tamanioInicio, tamanioFin){
	if(isEmpty(valor)){
		return false;
	}
	if(valor.length<tamanioInicio || valor.length>tamanioFin){
		return false;
	}
	return true;
}

function valida_monto(element){
	if(!valida_Cantidad_Entrero_Decimales(element.value,10,2)){
	    element.focus();
	    return false;
	}
	return true;
}

function valida_tasa(element){
	if(!valida_Cantidad_Entrero_Decimales(element.value,8,4)){
	    element.focus();
	    return false;
	}
	return true;
}

function valida_Cantidad_Entero_Decimales(numero, longEntera, longDecimal){
  numero = fmtoInv(numero);
  var indice = (numero + '').indexOf('.');
  if (indice > 0) {
	  var parteDecimal = (numero+'').substring(indice + 1,numero.length);
    if (parteDecimal.length > longDecimal){
      alert(m_9140);
      return false;
    }
  } else {
    indice = (numero+'').length;
  }
  var parteEntera = (numero+'').substring(0,indice);
  if (parteEntera.length > longEntera){
    alert(m_9139);
    return false;
  }
  return true;
}

function inListString(valor, listString, separador) {
	if (!listString) return false;
	if (!separador) separador = '|';
	var arrStr = listString.split(separador);
	for (var i = 0; i < arrStr.length; i++){
		if (valor == arrStr[i]){
			return true;
		}
	}
	return false;
}

function comparar_Fecha(String1,String2){
    String1 = String1 + "";
    String2 = String2 + "";

  // Si los dias y los meses llegan con un valor menor que 10 se concatena un 0 a cada valor dentro del string
  if (String1.substring(1,2) == "/")
      String1 = "0"+String1
  if (String1.substring(4,5) == "/")
      String1 = String1.substring(0,3)+"0"+String1.substring(3,9)
  if (String2.substring(1,2) == "/")
      String2 = "0"+String2
  if (String2.substring(4,5) == "/")
      String2 = String2.substring(0,3)+"0"+String2.substring(3,9)

  //Se obtiene el d�a, mes y a�o de las dos fechas
  dia1  = String1.substring(0,2);
  mes1  = String1.substring(3,5);
  anyo1 = String1.substring(6,10);
  dia2  = String2.substring(0,2);
  mes2  = String2.substring(3,5);
  anyo2 = String2.substring(6,10);

  //Se convierten en enteros para operar
  dia1  = parseInt(dia1,10);
  dia2  = parseInt(dia2,10);
  mes1  = parseInt(mes1,10);
  mes2  = parseInt(mes2,10);
  anyo1 = parseInt(anyo1,10);
  anyo2 = parseInt(anyo2,10);

    //Si el anio de la primera fecha es mayor se devuelve false
  if (anyo1 > anyo2)
      return false;

    //Si los a�os son iguales, pero el mes de la 1� es mayor se devuelve false
  if ((anyo1 == anyo2) && (mes1 > mes2))
      return false;

    //Si los a�os y meses son iguales, pero el d�a del 1� es mayor se devuelve false
  if ((anyo1 == anyo2) && (mes1 == mes2) && (dia1 > dia2))
      return false;

    //Si ha pasado todas las validaciones devuelve true
    return true;
}

// Funcion que retorna 0(iguales), 1 (String1 es mayor), 2 (String2 es mayor)
function compararFechasMMI(String1,String2){
    String1 = String1 + "";
    String2 = String2 + "";

  // Si los dias y los meses llegan con un valor menor que 10
  // Se concatena un 0 a cada valor dentro del string
  if (String1.substring(1,2) == "/")
      String1 = "0"+String1

  if (String1.substring(4,5) == "/")
      String1 = String1.substring(0,3)+"0"+String1.substring(3,9)

  if (String2.substring(1,2) == "/")
      String2 = "0"+String2

  if (String2.substring(4,5) == "/")
      String2 = String2.substring(0,3)+"0"+String2.substring(3,9)

  //Se obtiene el d�a, mes y a�o de las dos fechas
  dia1  = String1.substring(0,2);
  mes1  = String1.substring(3,5);
  anyo1 = String1.substring(6,10);
  dia2  = String2.substring(0,2);
  mes2  = String2.substring(3,5);
  anyo2 = String2.substring(6,10);

  //Se convierten en enteros para operar
  dia1  = parseInt(dia1,10);
  dia2  = parseInt(dia2,10);
  mes1  = parseInt(mes1,10);
  mes2  = parseInt(mes2,10);
  anyo1 = parseInt(anyo1,10);
  anyo2 = parseInt(anyo2,10);

    //Si el a�o de la primera fecha es mayor se devuelve 1
  if (anyo1 > anyo2){
      return 1;
  }else if (anyo1 == anyo2){
    //Si los a�os son iguales, pero el mes de la 1� es mayor se devuelve 1
    if (mes1 > mes2){
        return 1;
    }else if (mes1 == mes2){
      //Si los a�os y meses son iguales, pero el d�a del 1� es mayor se devuelve 1
      if (dia1 > dia2){
          return 1;
        }else if (dia1 == dia2){
          return 0;
        }else if (dia1 < dia2){
          return 2;
        }
    }else if (mes1 < mes2){
      return 2;
    }
  }else if (anyo1 < anyo2){
    return 2;
  }
    return 0;
}
//funcion que permite formatear la fecha en el formato AAAA-MM-DD al formato DD/MM/AAAA
function obtenerFecha(strCadena){
    var strResultado = strCadena;
    if(strCadena.length >= 10)
        strResultado = strCadena.substring(8,10)+"/"+strCadena.substring(5,7)+"/"+strCadena.substring(0,4);
    return strResultado;
}

//funcion que convierte cadana a fecha en formato mm/dd/yyyy
function parseDate(fecha){
    //Si la fecha no es 10 caracteres  se devuelve nom�s
    if(fecha.length < 10)
        return fecha;
  var strDate = fecha;
  var dd = strDate.substring(0,2);
  var mm = strDate.substring(3,5);
  var yyyy = strDate.substring(6,10);
  strDate = mm + '/' + dd + '/' + yyyy;
  strDate = Date.parse(strDate);
  return strDate;
}

//funcion que vuelve una cadena a fecha en formato dd/mm/yyyy
function vuelveFecha(fecha){
    if(fecha.length < 10)
        return fecha;
    var strDate = fecha;
    var dd   = strDate.substring(0,2);
    var mm   = strDate.substring(3,5);
    var yyyy = strDate.substring(6,10);
    strDate  = dd + '/' + mm + '/' + yyyy;
    return strDate;

}
//funcion que vuelve una cadena a fecha en formato dd/mm/yyyy
function vuelveFecha2(fecha){
    //Si la fecha no es 10 caracteres  se devuelve nom�s
    if(fecha.length < 10)
        return fecha;
    var strDate = fecha;
    var dd   = strDate.substring(8,10);
    var mm   = strDate.substring(5,7);
    var yyyy = strDate.substring(0,4);
    strDate  = dd + '/' + mm + '/' + yyyy;
    return strDate;
}

//funci�n que formatea y redondea dos decimales
function formateador(valor){
    return fmtoNum(redondear(fmtoInv(valor)));
}

//funci�n que formatea y redondea a la cantidad de decimales especificados
function formateadorParam(valor, dec){
    return fmtoNum(redondearFormato(fmtoInv(valor),dec));
}

//funci�n que te permite redondear un n�mero a dos decimales
function redondear(val){
  var negativo = false,v = "";
  val = val + "";
  if(val.charAt(0) == '-'){
    for(i=1;i<val.length;i++)
      v+= val.charAt(i);
    val = v;
    negativo = true;
  }

  var whole = "" + Math.round(val * Math.pow(10, 2));
    var decPoint = whole.length - 2;
  if(eval(decPoint)<0){
    result = "0.0"+whole;
    }else if(decPoint != 0){
        result = whole.substring(0, decPoint);
           result += ".";
        result += whole.substring(decPoint, whole.length);
  }else
        result = "0." + whole.substring(decPoint, whole.length);
    if(result==".0")
    result="0.00";

  var signo = negativo == true?"-":"";

    return signo+result;
}

//Redondea a n decimales
function redondearFormato(val,n){
  var negativo = false,v="";
  val = val + "";
  if(val.charAt(0)=='-'){
    for(i=1;i<val.length;i++)
      v+= val.charAt(i);
    val = v;
    negativo = true;
  }

  var whole = "" + Math.round(val * Math.pow(10, n));
  var decPoint = whole.length - n;
  if(decPoint<0){
    result="0.";
    for(i=0;i<(decPoint*-1);i++)
      result+="0";
    result+=whole
  }else if(decPoint != 0){
      result = whole.substring(0, decPoint);
      result += ".";
      result += whole.substring(decPoint, whole.length);
  }else
      result = "0." + whole.substring(decPoint, whole.length);

  var r = "0.";
  if(result==".0"){
    for(i=0;i<n;i++)
      r = r +"0";
    result = r;
  }

  var signo = negativo == true?"-":"";

    return signo+result;
}

//funcion que  da formato a un numero
function fmtoNum(val){//Pone a formato #'###,###
  var negativo = false,v="";
  val = val + "";
  if(val.charAt(0)=='-'){
    for(i=1;i<val.length;i++)
      v+= val.charAt(i);
    val = v;
    negativo = true;
  }
  var cadena = val.split(".");
  var num = cadena[0];
  var fmto = "";
  var ind = 1;
  for(i=num.length-1;i>=0;i--){
    fmto=num.charAt(i)+fmto;
    if(ind%3==0 && ind != 3 && ind != num.length)//para poner las '
      fmto=","+fmto;
    else if(ind == 3 && ind != num.length)//para poner las ,
      fmto=","+fmto;
    ind++;
  }

  var signo = negativo == true?"-":"";
  if(typeof(cadena[1])!="undefined")//si no es undefined
    return signo+fmto+"."+cadena[1];
  else
    return signo+fmto;
}

//funcion que quita formato a un numero
function fmtoInv(val){//Le quita el formato #'###,###
  val = val + "";
  var cadena1 = val.split(",");
  if(cadena1.length == 1)//No tiene ,
        if(isNaN(val))
            return "0.00"
        else{
        if (val!=""){
          return parseFloat(val);
        }else{
          return "0.00";
        }
      }
  else{
    var fmto = "";
    var cadena2 = cadena1[0].split(",");
    if(cadena2.length == 1)//No tiene '
      for(i=0;i<cadena1.length;i++)
        fmto += cadena1[i];
    else{
      for(i=0;i<cadena2.length;i++)
        fmto += cadena2[i];

      fmto += cadena1[1];
    }

        if(isNaN(fmto))
            return "0.00";
        else
            return fmto;
  }
}

//Dada una cadena la rellena con un par�metro hasta una cantidad dada y en una direcci�n determinada
function rellenar(cadena,relleno,cantidad,direccion){
  while(cadena.length<cantidad)
    if(direccion=="0")//derecha
      cadena = cadena + relleno;
    else      //izquierda
      cadena = relleno + cadena;

  return cadena;
}

//funcion que quita un relleno
function quitaRelleno(cadena,relleno,direccion){
  if(direccion=="0")//derecha
    while(cadena.charAt(cadena.length-1)==relleno){
      cad="";
      for(i=0;i<cadena.length-1;i++)
        cad = cad+cadena.charAt(i);
      cadena = cad;
    }
  else      //izquierda
    while(cadena.charAt(0)==relleno){
      cad="";
      for(i=cadena.length-1;i>0;i--)
        cad = cadena.charAt(i)+cad;
      cadena = cad;
    }
  return cadena;
}

//funcion que valida numero
function valida_numero(xinput,tipval){
    var xkey = event.keyCode;
    //Validaci�n de enteros
  if(tipval=="int")
    if ((xkey < 48) || (xkey > 57) ) event.returnValue = false;

  if(tipval=="int2")
    if ((xkey < 48) || (xkey > 57)) {
      if (xkey!=46)
        event.returnValue = false;
    }
  //Validacion de decimales
  if(tipval=="dec")
    if ((xkey < 46) || (xkey > 57)) event.returnValue = false;
//Validaci�n de decimales sin /
  if(tipval=="dec2")
    if ((xkey < 46) || (xkey > 57) || (xkey == 47)) event.returnValue = false;
  //Validaci�n de cadenas
  if(tipval=="str")
    if (((xkey != 32) && (xkey < 65)) || ((xkey > 90) && (xkey < 97))) event.returnValue = false;
  if(tipval=="tlf")
    if (((xkey != 32) && (xkey < 45)) || (xkey > 57)) event.returnValue = false;
  if(tipval=="hora")
    if (((xkey < 48) || (xkey > 57)) && xkey!=58) event.returnValue = false;
    if(tipval=="especial")

    if ((xkey == 34) || (xkey == 39) || (xkey == 124)) event.returnValue = false;

    if(tipval=="neg")
        if ((xkey < 45) || (xkey > 57) || (xkey == 47)) event.returnValue = false;
}

//Funci�n que valida fecha
function esFecha(fecha){
    //si fecha es vacia entonces retornar true
    if (fecha==""){
      return true;
    }
    //La fecha debe estar en fomato dd/MM/yyyy
    if(fecha.length != 10)
        return false;
  //Se verifica que la fecha s�lo tenga caracteres num�ricos y el caracter "/"
  for (var i = 0; i < fecha.length; i++) {
    var carac = fecha.charAt(i);
    if ((carac < "0" || carac > "9") && carac != "/")
      return false;
  }
  //Obtenemos el dia de la fecha
  var pos1 = fecha.indexOf("/");
  aux = fecha.substring(0,pos1);

  //verificamos que la parte del dia tenga dos caracteres
  if (aux.length != 2) return false;
  if(aux.charAt(0) == "0") {
    aux = aux.substr(1,1);
  }
  var dia = parseInt(aux,10);

  //Obtenemos el mes de la fecha
  var pos2 = fecha.indexOf("/",pos1+1);
  var aux = fecha.substring(pos1+1,pos2);
  //verificamos que la parte del mes tenga dos caracteres
  if (aux.length != 2) return false;
  if(aux.charAt(0) == "0") {
    aux = aux.substr(1,1);
  }
  var mes = parseInt(aux,10);

  //Obtenemos el a�o de la fecha
  aux = fecha.substring(pos2+1,fecha.length);
  //verificamos que la parte del a�o tenga cuatro caracteres
  if (aux.length != 4) return false;
  var anno = parseInt(aux,10);

  if (isNaN(dia) || isNaN(mes) || isNaN(anno)){
	  return false;
  }

  if (mes < 1 || mes > 12){
        return false;
    }  //el mes debe estar entre 1 y 12
  if (dia < 1 || dia > 31){
        return false
        };  //el dia debe estar entre 1 y 31
  if (anno < 1754 || anno > 9999) {
        return false;
    }  //el anio debe estar entre 1754 y 9999
  if (mes == 2 && dia > 29) return false;  //valida Febrero: el d�a debe estar entre 1 y 29
  if ((anno%4)!=0 && dia==29 && (mes == 2)) return false; //A�o Bisiesto: se verifica que febrero tenga 29 d�as
  if ((mes == 4 || mes == 6 || mes == 9 || mes == 11) & dia > 30) {
        return false;
    }  //Meses de 30 dias.
  return true;
}

//Funcion que valida el email
function validarEmail(valor) {
  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(valor)){
    return (true)
  } else {
    alert("La direcci�n de email es incorrecta.");
    return (false);
  }
}
//Remueve espacios en blanco al inicio
function LTrim( value ) {
    var re = /\s*((\S+\s*)*)/;
    return value.replace(re, "$1");
}
//Remueve espacios en blanco al final
function RTrim( value ) {
    var re = /((\s*\S+)*)\s*/;
    return value.replace(re, "$1");
}
//Remueve espacios en blanco al inicio y al final
function trim( value ) {
    return LTrim(RTrim(value));
}

function clickNS(e) {
  if(document.layers||(document.getElementById&&!document.all)){
    if (e.which==2||e.which==3) {
      (message);
      return false;
    }
  }
}

//function encargada de la visibilidad de un objeto segun su Id
function setVisible(id,valor){
  document.getElementById(id).style.display = valor;
}

//funci�n que muestra la hora
function mostrar() {
    var  dia = new Date();
    var  hora = dia.getHours();
    var  minutos = dia.getMinutes();
    var  segundos = dia.getSeconds();
    var year=dia.getYear();
  if (year < 1000)
    year+=1900;
  var day=dia.getDay();
  var month=dia.getMonth()+1;
  if (month<10)
    month="0"+month;
  var daym=dia.getDate();
  if (daym<10)
    daym="0"+daym;

    if ((hora >= 0)&&(hora <= 9)){
        hora="0"+hora;
    }

    if ((minutos >= 0)&&(minutos <= 9)){
        minutos="0"+minutos;
    }

    if ((segundos >= 0)&&(segundos <= 9)){
        segundos="0"+segundos;
    }

    document.forms[0].hora.value =" " +hora + ":" + minutos + ":" + segundos;

    window.setTimeout("mostrar()",1000);
}

function esHora(hora){
  //si hora es vacia entonces retornar true
    if (hora==""){
      return true;
    }

    //La hora debe estar en fomato hh:mm
    if(hora.length != 5)
        return false;

    //Se verifica que la hora s�lo tenga caracteres num�ricos y el caracter "/"
  for (var i = 0; i < hora.length; i++) {
    var carac = hora.charAt(i);
    if ((carac < "0" || carac > "9") && carac != ":")
      return false;
  }

  //Obtenemos la hora
  var pos1 = hora.indexOf(":");
  aux = hora.substring(0,pos1);

  //verificamos que la parte de la hora tenga dos caracteres
  if (aux.length != 2) return false;
  if(aux.charAt(0) == "0") {
    aux = aux.substr(1,1);
  }
  var hh = parseInt(aux,10);


  //Obtenemos los minutos
  aux = hora.substring(pos1+1,hora.length);
  //verificamos que la parte del minuto tenga dos caracteres
  if (aux.length != 2) return false;
  if(aux.charAt(0) == "0") {
    aux = aux.substr(1,1);
  }
  var mm = parseInt(aux,10);

  //la hora debe estar entre 0 y 23
  if (hh < 0 || hh > 23){
        return false;
    }
    //el minuto debe estar entre 0 y 59
  if (mm < 0 || mm > 59){
        return false
    };
  return true;

}

//valida que el campo sea alfanumerico
function esTeclaAlfanumerico(e,flg) {
  var valid = "abcdefghijklm�nopqrstuvwxyzABCDEFGHIJKLMN�OPQRSTUVWXYZ���������� 0123456789";
  //stacanga 09.01.2013 variable flg agregada para aceptar el '&' si es requerido
  if(flg == 1){// aceptara el caracter & ampersand
    valid = valid.concat("&");
  }
  var key = String.fromCharCode(event.keyCode);
  if (valid.indexOf("" + key) == "-1") return false;
}

//Funci�n de Comparaci�n de Fechas
function devuelveMes(fecha){
    //Si la fecha no es 10 caracteres  se devuelve nom�s
    if(fecha.length < 10)
        return fecha;
  var strDate = fecha;
  var mm = strDate.substring(3,5);
  return mm;
}

//Funci�n de Comparaci�n de Fechas
function devuelveDia(fecha){
  alert('Entra devuelve dia');
    //Si la fecha no es 10 caracteres  se devuelve nom�s
    if(fecha.length < 10)
        return fecha;
  var strDate = fecha;
  var dd = strDate.substring(0,2);
  return dd;
}

//funci�n de Comparaci�n de Fechas
function devuelveAno(fecha){
    //Si la fecha no es 10 caracteres  se devuelve nom�s
    if(fecha.length < 10)
        return fecha;
  var strDate = fecha;
  var yyyy = strDate.substring(6,10);
  return yyyy;
}

function validacionCarateresEspeciales(xinput){
  xinput=value.replace("\"", "");
  return xinput;
}

function abrir_ventana(ruta,props,raiz){
  var url = raiz + ruta;
    window.showModalDialog(url,window,props);
}

//valida fecha
function validarFecha(nombreCampo){
    if (!isEmpty(document.getElementById(nombreCampo).value)){
	  if(!esFecha(document.getElementById(nombreCampo).value)) {
	    alert("Fecha Inválida");
	    document.getElementById(nombreCampo).value="";
	    document.getElementById(nombreCampo).focus();
	    document.getElementById(nombreCampo).select();
	    return;
	  }
	}
}

function pr_maxDecimalValue(precision, scale) {
    return Math.pow(10,precision-scale) - Math.pow(10,-scale);
}

function pr_validaNumero(number, negativo, precision, scale){
	var maximo = pr_maxDecimalValue(precision,scale);
	var minimo = maximo * -1;
	if (number > maximo){
		return {
			flag : 1,
			maximo: maximo
		};
	}
	if (negativo){
		if (number < minimo){
			return {
				flag : -1,
				minimo: minimo
			};
		}
	}
	return {
		flag : 0
	};
}

function gl_validaMonto(number, validaNegativos){
	if (typeof validaNegativos == "undefined"){
		validaNegativos = false;
	}
	var res = pr_validaNumero(number, validaNegativos, 12, 2);
	if (res.flag == 1){
		alert("El m�ximo monto permitido es de: "+formateador(res.maximo));
		return false;
	}
	if (res.flag == -1){
		alert("El minimo monto permitido es de: "+formateador(res.minimo));
		return false;
	}
	return true;
}

function gl_validaNumero(number, negativo, precision, scale){
	var res = pr_validaNumero(number, negativo, precision, scale);
	if (res.flag != 0){
		if (res.flag == 1){
			alert("El maximo permitido es de: "+res.maximo);
			return false;
		}
		if (res.flag == -1){
			alert("El minimo permitido es de: "+res.minimo);
			return false;
		}
	}
	return true;
}