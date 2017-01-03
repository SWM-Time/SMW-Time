// ---------------------------------------------------------------------
// Funciones para calcular puntos FINA correspondientes a un tiempo dado
// segun tablas alemanas
// Los tiempos se indican en segundos de la siguiente manera:
// 01 :   50 libres
// 02 :  100 libres
// 03 :  200 libres
// 04 :  400 libres
// 05 :  800 libres
// 06 : 1500 libres
// 07 :   50 mariposa
// 08 :  100 mariposa
// 09 :  200 mariposa
// 10 :   50 espalda
// 11 :  100 espalda
// 12 :  200 espalda
// 13 :   50 braza
// 14 :  100 braza
// 15 :  200 braza
// 16 :  100 estilos
// 17 :  200 estilos
// 18 :  400 estilos
// 19 :  4x50 libres
// 20 :  4x50 estilos
// En femenino se suma 20 a estos valores
// En piscina de 50 se suma 40 al valor resultante

function setfocus()
{
document.forms[0].minutos.focus()
}

function CalcPtosFINA (form)

{
  var  Base = new Array();
	Base[1]=2128;
	Base[2]=4679;
	Base[3]=10328;
	Base[4]=21914;
	Base[5]=45912;		
	Base[6]=87241;		
	Base[7]=2295;		
	Base[8]=5054;		
	Base[9]=11245;		
	Base[10]=2373;		
	Base[11]=5114;		
	Base[12]=11194;		
	Base[13]=2671;		
	Base[14]=5820;		
	Base[15]=12624;		
	Base[16]=5331;		
	Base[17]=11521;		
	Base[18]=24479;
	Base[19]=8569;
	Base[20]=9521;
	Base[21]=2419;
	Base[22]=5280;
	Base[23]=11502;		
	Base[24]=24127;		
	Base[25]=49649;		
	Base[26]=95632;		
	Base[27]=2600;		
	Base[28]=5715;		
	Base[29]=12557;		
	Base[30]=2724;		
	Base[31]=5828;		
	Base[32]=12489;		
	Base[33]=3027;		
	Base[34]=6544;		
	Base[35]=14032;		
	Base[36]=6020;		
	Base[37]=12880;		
	Base[38]=27134;		
	Base[39]=9861;		
	Base[40]=10942;		
	Base[41]=2188;
	Base[42]=4830;
	Base[43]=10594;
	Base[44]=22430;
	Base[45]=46850;		
	Base[46]=88888;		
	Base[47]=2354;		
	Base[48]=5173;		
	Base[49]=11514;		
	Base[50]=2514;		
	Base[51]=5393;		
	Base[52]=11669;		
	Base[53]=2751;		
	Base[54]=6016;		
	Base[55]=13024		
	Base[56]=0;		
	Base[57]=11875;		
	Base[58]=25218;
	Base[59]=8760;
	Base[60]=9807;
	Base[61]=2461;
	Base[62]=5401;
	Base[63]=11731;		
	Base[64]=24564;		
	Base[65]=51184;		
	Base[66]=96414;		
	Base[67]=2624;		
	Base[68]=5565;		
	Base[69]=12661;		
	Base[70]=2850;		
	Base[71]=6029;		
	Base[72]=12840;		
	Base[73]=3106;		
	Base[74]=6702;		
	Base[75]=14385;		
	Base[76]=0;		
	Base[77]=13144;		
	Base[78]=27582;		
	Base[79]=9968;		
	Base[80]=11133;
	var tiempo = 0;		
	var puntos = 0;
	var indice = parseInt(form.prueba.value);
 	if (form.piscina.value == "50")
    {
      indice = parseInt(parseInt(indice) + 40);
    }
 	if (form.sexo.value == "F")
    {
      indice = parseInt(parseInt(indice) + 20);
    }
	if (Base[indice]==0)
	{
	  alert("Esta prueba no tiene equivalencia según las tablas FINA");
      form.puntos.value="0";
	}
	else
    {
      tiempo=(parseInt(form.minutos.value)*6000)+(parseInt(form.segundos.value)*100)+(parseInt(form.centesimas.value));
      form.puntos.value=Math.round(Math.pow((Base[indice]/tiempo), 3)*1000);
	}
}